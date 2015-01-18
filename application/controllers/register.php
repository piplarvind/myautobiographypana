<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
    }

    public function reset() {
        setcookie('p');
        redirect(base_url()."home");
    }
    function logout() {
        setcookie('p');
        
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
//        print_r(date('Y-m-d H:i:s'));die;
        $table_name = 'mst_users';
        $update_data = array('is_login' => '0');
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
        
        $this->session->unset_userdata('user_account');
        redirect(base_url()."home");
    }
    public function validRegistration() {
        $this->load->library('form_validation');
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');

        /* Settning the validation rules */
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        $this->form_validation->set_rules('user_name', 'user name', 'required|callback_chkUserNameCI');
        $this->form_validation->set_rules('user_email', 'email', 'required|valid_email|callback_chkEmailDuplicateCI');
        $this->form_validation->set_rules('user_password', 'password', 'required|min_length[8]|callback_chkPasswordStrenth');
        $this->form_validation->set_rules('cnf_user_password', 'confirm password', 'required|matches[user_password]');
        $this->form_validation->set_rules('terms', 'terms and conditions', 'required');
        $this->form_validation->set_rules('input_captcha_value', 'security code', 'required|callback_checkCaptchaCI');
        /* Cheacking the form is valid or not */
        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Password validation server side
     */

    public function chkPasswordStrenth($password) {
        /* Checking the password is valid or not useing the reguler expression */
        if (!preg_match("/^(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!%&@#$^({{}})*?_~]).*$/", $password)) {
            $this->form_validation->set_message('chkPasswordStrenth', 'Password must be strong.');
            return false;
        } else {
            return true;
        }
    }

    /*
     * User name validation server side
     */

    public function chkUserNameCI($user_name) {
        /* Validation for duplicate user name */
        $this->load->model('register_model');
        $user_name = $user_name;
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_name');
        $condition_to_pass = array("user_name" => $user_name);
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            $this->form_validation->set_message('chkUserNameCI', 'This username is already registered with site.');
            return false;
        }
        /* Validation for character accepting */
        if (!preg_match("/^[a-zA-Z\.\_\-]{5,20}+$/", $user_name)) {
            $this->form_validation->set_message('chkUserNameCI', 'Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.');
            return false;
        }
        /* If all right return true */
        return true;
    }

    /*
     * Check the captcha validation server side 
     */

    public function checkCaptchaCI($input_captha) {

        if ($this->session->userdata('security_answer') != $input_captha) {
            $this->form_validation->set_message('checkCaptchaCI', 'Please enter valid security code.');
            return false;
        } else {
            return true;
        }
    }

    /*
     * Normal user registration process
     */

    public function userRegistrationB() {

        $data = $this->common_model->commonFunction();


        if ($this->input->post('user_email') != '') { 

            $table = 'mst_users';
            $activation_code = time();
            $fields = array('name_of_institute' => $this->input->post('Name_of_institute'),
                'address_1' => $this->input->post('Address_line1'),
                'address_2' => $this->input->post('Address_line2'),
                'country_id' => $this->input->post('country_id'),
                'state_id' => $this->input->post('state_id'),
                'user_city' => $this->input->post('Village_city'),
                'pin_code' => $this->input->post('pin_code'),
                'contact_no' => $this->input->post('contact_number'),
                'user_email' => $this->input->post('user_email'),
                'institute_type' => $this->input->post('Type_of_institution'),
                'user_password' => base64_encode($this->input->post('password')),
                'established_in' => $this->input->post('Established'),
                'name_of_founder' => $this->input->post('Name_of_founder'),
                'user_name' => $this->input->post('user_name'),
                'terms_condition' => $this->input->post('terms'),
                'user_type' => '1',
                'user_status' => '0',
                'user_role' => '1',
                'activation_code' => $activation_code,
                'email_verified' => '0',
                'newsletter' => '1',
                'register_date' => date("Y-m-d H:i:s"),
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );
            $this->load->model('register_model');
            $condition = '';
            $insert_id = $this->common_model->insertRow($fields, $table);
            
            /*Start : Notification*/
            $notification_fields = array('from_id' => $insert_id,
                'subject' => $this->input->post('user_name').' has registered.',
                'status' => '1',
                'message_date' => date("Y-m-d H:i:s")
            );
            $this->common_model->insertRow($notification_fields, 'mst_notifications');
            /*End : Notification*/
            
            //Send account activation email to user
            $login_link = '<a href="' . base_url() . 'signin">Click here.</a>';
            $lang_id = $this->session->userdata('lang_id');
            if (isset($lang_id) && $lang_id != '') {
                $lang_id = $this->session->userdata('lang_id');
            } else {
                $lang_id = 17; // Default is 17(English)

            }
            $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Click here</a>';
            $macros_array_details = array();
            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_details as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            
            $reserved_words = array
                (
                "||USER_NAME||" => $this->input->post('user_name'),
                "||USER_EMAIL||" => $this->input->post('user_email'),
                "||PASSWORD||" => $this->input->post('password'),
                "||ACTIVATION_LINK||" => $activation_link,
                "||SITE_URL||" => base_url(),
                "||SITE_TITLE||" => $data['global']['site_title']
            );
             $reserved = array_replace_recursive($macros_array, $reserved_words);
            $template_title = 'registration-successful';
            $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved);
            $recipeinets = $this->input->post('user_email');
            $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
            $subject = $arr_emailtemplate_data['subject'];
            $message = $arr_emailtemplate_data['content'];
            $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
            if (count($mail)>0) { 
                $this->session->set_userdata('msg', "<strong>Congratulations!</strong> You have registered successfully. We have sent email to activate your account on <strong>" . $this->input->post('user_email') . "</strong>.");
            
//            $this->session->set_userdata('message', 'registration has been successfuly done');
            redirect(base_url() . "signin");
            }
        }

        $data['header'] = array("title" => "Institute Registration", "keywords" => "", "description" => "");
        $data['page_title'] = "Institute registration";
        $condition=array("institute_type_status" =>'1');
        $data['arr_institute_type'] = $this->common_model->getRecords("mst_institute_type","*", $condition, $order_by = '', $limit = '', $debug = 0);
        $condition=array("status" =>'1');
        $data['arr_geoname_details'] = $this->common_model->getRecords("mst_geoname","*", $condition, $order_by = '', $limit = '', $debug = 0);
        $data['arr_country_details'] = $this->common_model->getRecords("mst_country","*", $condition="", $order_by = '', $limit = '', $debug = 0);
        
        
        
        $this->load->view('front/includes/ui1-header1', $data);
        $this->load->view('front/includes/ui1-header2', $data);
        $this->load->view('front/registration/registerUserB',$data);
        $this->load->view('front/includes/ui1-footer', $data);
        

    }

    public function userRegistrationStep1() {
//        echo '<pre>';print_r($_POST);die;
        $data = $this->common_model->commonFunction();

        $data['selected_gender'] = $data['user_session']['gender'];
        $data['lang'] = $this->lang->language;
        $lang = $data['lang'];
        $data['page_title'] = "user registration";

        if ($this->input->post('user_email') != '') {

            $image_data = array();
            if ($_FILES['profile_picture']['name'] != "") {
                $config['upload_path'] = 'media/front/img/user-images/';
                $config['file_name'] = $_FILES['profile_picture']['name'];
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                //loading uploda library
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('profile_picture')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data["img_data"] = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $config = array(
                        'source_image' => $image_data['full_path'],
                        'new_image' => 'media/front/img/user-images/thumbs',
                        'maintain_ratio' => false,
                        'width' => 100,
                        'height' => 100
                    );
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            $dob = $this->input->post('year') . "-" . $this->input->post('month') . '-' . $this->input->post('day');
            $registration_step1['user_name'] = $this->input->post('user_name');
            $registration_step1['gender'] = $this->input->post('gender');
            $registration_step1['pin_code'] = $this->input->post('pin_code');
            $registration_step1['user_email'] = $this->input->post('user_email');
            $registration_step1['confirm_email'] = $this->input->post('confirm_email');
            $registration_step1['user_password'] = base64_encode($this->input->post('password'));
            $registration_step1['confirm_password'] = base64_encode($this->input->post('confirm_password'));
            $registration_step1['profile_picture'] = $image_data['file_name'];
            $registration_step1['date_of_birth'] = date('Y-m-d', strtotime($dob));
            $registration_step1['contact_no'] = $this->input->post('contact_number');
            $registration_step1['newsletter'] = $this->input->post('newsletter');
            $registration_step1['terms_condition'] = $this->input->post('terms');
            $this->session->set_userdata('registration_step1', $registration_step1);
            redirect(base_url() . 'registration/step2');
            exit;
        }

   
        $this->load->view('front/registration/register');
    }

    public function userRegistrationStep2() {
       
        $data = $this->common_model->commonFunction();
        $data['page_title'] = "registration step2";
        $data['user_session'] = $this->session->userdata('registration_step1');
         $condition_to_pass = array("interest_status" => '1');
       $data['arr_interest_details'] = $this->common_model->getRecords("mst_interest","*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        if (empty($data['user_session'])) {
            redirect(base_url() . 'signup');
            exit;
        }
        if ($this->input->post('check_interest') != '') {

            $age = "";

            $dob = explode('-', $data['user_session']['date_of_birth']);

            $dd = $dob[2];
            $mm = $dob[1];
            $yy = $dob[0];

            if ($dd != "" && $mm != "" && $yy != "") {
                $age = (date("md", date("U", mktime(0, 0, 0, $dd, $mm, $yy))) > date("md") ? ((date("Y") - $yy) - 1) : (date("Y") - $yy));
            }

            $table1 = 'mst_users';
            $table2 = 'mst_interest';
            $interest = implode(",", $this->input->post("interest"));
            $activation_code = time();
            $fields = array('user_name' => $data['user_session']['user_name'],
                'gender' => $data['user_session']['gender'],
                'pin_code' => $data['user_session']['pin_code'],
                'user_email' => $data['user_session']['user_email'],
                'user_password' => $data['user_session']['user_password'],
                'user_type' => '1',
                'user_status' => '0',
                'user_role' => '0',
                'activation_code' => $activation_code,
                'email_verified' => '0',
                'register_date' => date("Y-m-d H:i:s"),
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'gender' => $data['user_session']['gender'],
                'profile_picture' => $data['user_session']['profile_picture'],
                'date_of_birth' => $data['user_session']['date_of_birth'],
                'contact_no' => $data['user_session']['contact_no'],
                'newsletter' => $data['user_session']['newsletter'],
                'terms_condition' => $data['user_session']['terms_condition'],
                'interest_id' => $interest,
            );
            $user_id = $this->common_model->insertRow($fields, $table1);
            
            /*Start : Notification*/
            $notification_fields = array('from_id' => $user_id,
                'subject' => $data['user_session']['user_name'].' has registered.',
                'status' => '1',
                'message_date' => date("Y-m-d H:i:s")
            );
            $this->common_model->insertRow($notification_fields, 'mst_notifications');
            /*End : Notification*/
            
            
            $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Click here</a>';
            $macros_array_details = array();
            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_details as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            
            $reserved_words = array
                (
                "||USER_NAME||" => $data['user_session']['user_name'],
                "||USER_EMAIL||" => $data['user_session']['user_email'],
                "||PASSWORD||" => $data['user_session']['user_password'],
                "||ACTIVATION_LINK||" => $activation_link,
                "||SITE_URL||" => base_url(),
                "||SITE_TITLE||" => $data['global']['site_title'],
                "||SITE_PATH||" => base_url()
            );

            $reserved = array_replace_recursive($macros_array, $reserved_words);
            $lang_id = 17;
            $template_title = 'registration-successful';
            $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved);

            $recipeinets = $data['user_session']['user_email'];
            $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
            $subject = $arr_emailtemplate_data['subject'];
            $message = $arr_emailtemplate_data['content'];

            $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);

            if ($mail) {

                $this->session->set_userdata('success_message', '<div class="page_holder"><div class="success_msg"><strong>' . $this->lang->line('SEARCH_CONG') . '</strong> ' . $this->lang->line('USER_AUTH_ACT') . '</div> </div>');
                $this->session->set_userdata('invalid_credentials', '1');
                $this->session->unset_userdata('registration_start');
            }
            $this->session->set_userdata('message', 'registration has been successfuly done');
            redirect(base_url()."home");
            exit;
        }




        $this->load->view('front/registration/registrationStep2', $data);
    }

    /*
     * Facebook registration process
     */

    public function fbUserRegistration() {
        $this->load->model('register_model');
        $data = $this->common_model->commonFunction();
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_email', 'user_name', 'first_name', 'last_name', 'user_type', 'role_id','user_role');
        $condition_to_pass = array("user_email" => $_REQUEST['user_email']);
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data) > 0) {
            $user_data['user_id'] = $arr_login_data[0]['user_id'];
            $user_data['user_name'] = $arr_login_data[0]['user_name'];
            $user_data['first_name'] = $arr_login_data[0]['first_name'];
            $user_data['last_name'] = $arr_login_data[0]['last_name'];
            $user_data['user_email'] = $arr_login_data[0]['user_email'];
            $user_data['user_type'] = $arr_login_data[0]['user_type'];
            $user_data['role_id'] = $arr_login_data[0]['role_id'];
            $user_data['user_role'] = $arr_login_data[0]['user_role'];
            
            $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $arr_login_data[0]['role_id']));
            /* serializing the user privilegse and setting into the session. While ussing user privileges use unserialize this session to get user privileges */
            if (count($arr_privileges) > 0) {
                foreach ($arr_privileges as $privilege) {
                    $user_privileges[] = $privilege['privilege_id'];
                }
            } else {
                $user_privileges = array();
            }
            $user_data['user_privileges'] = serialize($user_privileges);
            $this->session->set_userdata('user_account', $user_data);
            echo 'true';
        } else {

            $pass_generated = $this->randamPass();
            
            $facebook_user_id = $this->input->post('fb_id');
            $image_url = "http://graph.facebook.com/" . $facebook_user_id . "/picture?type=large";
            $img_array = get_headers($image_url);
            $img_url = str_replace('Location: ', '', $img_array[1]);
            $img = file_get_contents($img_url);
            $file_name = time() . '.jpg';
            
            $file = $data['absolute_path'] . 'media/front/img/user-images/thumbs/' . $file_name;
            file_put_contents($file, $img);
            
            $file1 = $data['absolute_path'] . 'media/front/img/user-images/' . $file_name;
            file_put_contents($file1, $img);
            
            $file2 = $data['absolute_path'] . 'media/front/img/user-images/50/' . $file_name;
            file_put_contents($file2, $img);
            
            
            $this->load->library('image_lib');
            $this->image_lib->clear();
            
            $table = 'mst_users';
            $fields = array('first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'user_email' => $this->input->post('user_email'),
                'user_name' => '',
                'user_password' => base64_encode($pass_generated),
                'profile_picture' => $file_name,
                'user_type' => '1',
                'user_role' => '1',//User B
                'user_status' => '1',
                'email_verified' => '1',
                'fb_id' => $this->input->post('fb_id'),
                'register_date' => date("Y-m-d H:i:s")
            );
            $this->session->set_userdata('facebook_data_register', $fields);
            echo "new_user";
            //$insert_id = $this->common_model->insertRow($fields, $table);
           /*
            if ($insert_id) {
                $table_to_pass = 'mst_users';
                $fields_to_pass = array('user_id', 'user_email', 'user_email', 'user_type', 'first_name', 'last_name', 'user_password', 'role_id','user_role');
                $condition_to_pass = array("user_id" => $insert_id);
                $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

                $user_data['user_id'] = $arr_login_data[0]['user_id'];
                $user_data['user_name'] = $arr_login_data[0]['user_name'];
                $user_data['user_email'] = $arr_login_data[0]['user_email'];
                $user_data['user_type'] = $arr_login_data[0]['user_type'];
                $user_data['first_name'] = $arr_login_data[0]['first_name'];
                $user_data['last_name'] = $arr_login_data[0]['last_name'];
                $user_data['role_id'] = $arr_login_data[0]['role_id'];
                $user_data['user_role'] = $arr_login_data[0]['user_role'];
                $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $arr_login_data[0]['role_id']));
                // serializing the user privilegse and setting into the session. While ussing user privileges use unserialize this session to get user privileges 
                if (count($arr_privileges) > 0) {
                    foreach ($arr_privileges as $privilege) {
                        $user_privileges[] = $privilege['privilege_id'];
                    }
                } else {
                    $user_privileges = array();
                }
                $user_data['user_privileges'] = serialize($user_privileges);
               
                $this->session->set_userdata('user_account', $user_data);

                $macros_array_details = array();
                $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                $macros_array = array();
                foreach ($macros_array_details as $row) {
                    $macros_array[$row['macros']] = $row['value'];
                }
                $reserved_words = array
                    (
                    "||USER_NAME||" => stripslashes($arr_login_data[0]["first_name"]) . " " . stripslashes($arr_login_data[0]["last_name"]),
                    "||USER_PASS||" => base64_decode($arr_login_data[0]['user_password']),
                    "||USER_EMAIL||" => stripslashes($this->input->post('user_email')),
                    "||SITE_URL||" => base_url(),
                    "||SITE_TITLE||" => $data['global']['site_title']
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                $template_title = 'fb-registration-successful';
                $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $this->session->userdata('lang_id'), $reserved);
                $recipeinets = $arr_login_data[0]['user_email'];
                $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);

                $subject = $arr_emailtemplate_data['subject'];
                $message = $arr_emailtemplate_data['content'];
                $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                echo 'true';
            } else {
                echo 'false';
            }
            */
            
        }
    }

    
    public function fbUserRegistrationAction() {
        
        if($this->input->post()) {
            
            $this->load->model('register_model');
            $data = $this->common_model->commonFunction();
            
            $facebook_data_register = $this->session->userdata('facebook_data_register');
            
            $facebook_data_register['name_of_institute'] = $this->input->post('Name_of_institute');
            $this->session->set_userdata('facebook_data_register', $facebook_data_register);
            
            $table = 'mst_users';
            $facebook_data_register = $this->session->userdata('facebook_data_register'); 
            $insert_id = $this->common_model->insertRow($facebook_data_register, $table);

            if ($insert_id) {
                $table_to_pass = 'mst_users';
                $fields_to_pass = array('user_id', 'user_email', 'user_email', 'user_type', 'first_name', 'last_name', 'user_password', 'role_id','user_role');
                $condition_to_pass = array("user_id" => $insert_id);
                $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

                $user_data['user_id'] = $arr_login_data[0]['user_id'];
                $user_data['user_name'] = $arr_login_data[0]['user_name'];
                $user_data['user_email'] = $arr_login_data[0]['user_email'];
                $user_data['user_type'] = $arr_login_data[0]['user_type'];
                $user_data['first_name'] = $arr_login_data[0]['first_name'];
                $user_data['last_name'] = $arr_login_data[0]['last_name'];
                $user_data['role_id'] = $arr_login_data[0]['role_id'];
                $user_data['user_role'] = $arr_login_data[0]['user_role'];
                $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $arr_login_data[0]['role_id']));
                // serializing the user privilegse and setting into the session. While ussing user privileges use unserialize this session to get user privileges 
                if (count($arr_privileges) > 0) {
                    foreach ($arr_privileges as $privilege) {
                        $user_privileges[] = $privilege['privilege_id'];
                    }
                } else {
                    $user_privileges = array();
                }
                $user_data['user_privileges'] = serialize($user_privileges);
               
                $this->session->set_userdata('user_account', $user_data);

                $macros_array_details = array();
                $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                $macros_array = array();
                foreach ($macros_array_details as $row) {
                    $macros_array[$row['macros']] = $row['value'];
                }
                $reserved_words = array
                    (
                    "||USER_NAME||" => stripslashes($arr_login_data[0]["first_name"]) . " " . stripslashes($arr_login_data[0]["last_name"]),
                    "||USER_PASS||" => base64_decode($arr_login_data[0]['user_password']),
                    "||USER_EMAIL||" => stripslashes($this->input->post('user_email')),
                    "||SITE_URL||" => base_url(),
                    "||SITE_TITLE||" => $data['global']['site_title']
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                $template_title = 'fb-registration-successful';
                $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $this->session->userdata('lang_id'), $reserved);
                $recipeinets = $arr_login_data[0]['user_email'];
                $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);

                $subject = $arr_emailtemplate_data['subject'];
                $message = $arr_emailtemplate_data['content'];
                $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                
                $this->session->unset_userdata('facebook_data_register');
                redirect(base_url() . 'institute-private-timeline');
            
            }else {
                redirect(base_url() . 'signin');
            } 
            
            
            
        }
    }
    /*
     * User's account activation by email
     */

    public function userActivation($activation_code) {
        $this->load->model('register_model');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status');
        $condition_to_pass = array("activation_code" => $activation_code);
        /* get user details to verify the email address */
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            if ($arr_login_data[0]['email_verified'] == 1) {
                $this->session->set_userdata('activation_error', "You have already activated your account. Please login.");
            } else {

                $user_detail = $this->common_model->getRecords("mst_users", "user_id", array("activation_code" => $activation_code));
                $this->load->model('admin_model');
                /* 	Removing the user if he is exists in inactiveated list */
                $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 1, intval($user_detail[0]['user_id']));
                $table_name = 'mst_users';
                $update_data = array("user_status" => '1', 'email_verified' => '1');
                $condition_to_pass = array("activation_code" => $activation_code);
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                $this->session->set_userdata('activation_error', "Your account has been activated successfully. Please login.");
            }
        } else {
            $this->session->set_userdata('activation_error', "Invalid activation link.");
        }
        redirect(base_url() . "signin");
    }

    /*
     * Check email duplication
     */

    public function chkEmailDuplicate() {
        $this->load->model('register_model');
        $user_email = $this->input->post('user_email');

        if ($this->input->post('user_email') == $this->input->post('old_email')) {
            echo 'true';
        } else {


            $table_to_pass = 'mst_users ';
            $fields_to_pass = array('user_id', 'user_email');
            $condition_to_pass = array("user_email" => $user_email);
            $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }
    
    
    public function chkAlbumDuplicate() {
        
        
        $data = $this->common_model->commonFunction();
        $this->load->model('register_model');
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        
        $album_name = $this->input->post('album_name');

        if ($this->input->post('album_name') == $this->input->post('old_album_name')) {
            echo 'true';
        } else {
        
            $table_to_pass = 'mst_album';
            $fields_to_pass = array('user_id', 'album_name','created_date');
            $condition_to_pass = array("album_name" => $album_name,"user_id" => $user_id);
            $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * Check email duplication for server side validation
     */

    public function chkEmailDuplicateCI($user_email) {
        $this->load->model('register_model');
        $user_email = $user_email;
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_email');
        $condition_to_pass = array("user_email" => $user_email);
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            $this->form_validation->set_message('chkEmailDuplicateCI', 'This email address is already registered with site.');
            return false;
        } else {
            return true;
        }
    }

    /*
     * Check email availability 
     */

    public function chkEmailExist() {
        ob_clean();
        $this->load->model('register_model');
        $user_email = $this->input->post('user_email');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_email');
        if (isset($_POST['action'])) {
            $condition_to_pass = "`user_email` = '" . $user_email . "' or `user_name` = '" . $user_email . "'";
        } else {
            $condition_to_pass = array("user_email" => $user_email);
        }
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Chekc duplicate username
     */

    public function chkUserDuplicate() {
        $this->load->model('register_model');
        $user_name = $this->input->post('user_name');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_name');
        $condition_to_pass = array("user_name" => $user_name);
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /*
     * create captcha image
     */

    public function generateCaptcha($rand) {
        ob_clean();
        $data = $this->common_model->commonFunction();
        $arr1 = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
        $arr2 = array();
        foreach ($arr1 as $val)
            $arr2[] = strtoupper($val);
        $arr3 = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $str = "";
        $arr_all_characters = array_merge($arr1, $arr2, $arr3);
        for ($i = 0; $i < 5; $i++) {
            $str.=$arr_all_characters[array_rand($arr_all_characters)] . "";
        }
        $this->session->set_userdata('security_answer', $str);
        putenv('GDFONTPATH=' . realpath('.'));
        //$font = '/var/www/ci-pipl-code-library/user-module/media/front/captcha/ariblk.ttf';
        $font = $data['absolute_path'] . 'media/front/captcha/ariblk.ttf';
        $IMGVER_IMAGE = imagecreatefromjpeg(base_url() . "media/front/captcha/bg1.jpg");
        $IMGVER_COLOR_WHITE = imagecolorallocate($IMGVER_IMAGE, 0, 0, 0);
        $text = $str;
        $IMGVER_COLOR_BLACK = imagecolorallocate($IMGVER_IMAGE, 255, 255, 255);
        imagefill($IMGVER_IMAGE, 0, 0, $IMGVER_COLOR_BLACK);
        imagettftext($IMGVER_IMAGE, 24, 0, 20, 28, $IMGVER_COLOR_WHITE, $font, $text);
        //header("Content-type: image/jpeg");
        imagejpeg($IMGVER_IMAGE);
    }

    /*
     * Check the captcha validation 
     */

    public function checkCaptcha() {
        if ($this->input->post('input_captcha_value') == $this->session->userdata('security_answer')) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Login into website
     */

    public function signin() {
        
        if ($this->common_model->isLoggedIn()) {
            
            $user_data = $this->session->userdata('user_account');
            if($user_data['user_role'] == '0'){
                redirect('usera-private-timeline');
            }else{
                redirect('institute/add-User-list');
            }
        }
        
        $data = $this->common_model->commonFunction(); 
        $this->load->model("register_model");
        if ($this->validSignin()) {
           
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status', 'user_password', 'role_id','user_role','profile_picture');
            $condition_to_pass = "user_name = '" . $this->input->post('user_email') . "' or user_email = '" . $this->input->post('user_email') . "'";
           
            $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
           
            if (count($arr_login_data)>0) {
                if ($arr_login_data[0]['user_password'] != base64_encode($_POST['user_password'])) {
                    
                    $this->session->set_userdata('login_error', "Please enter correct password.");
                    redirect(base_url() . 'signin');
                }
                elseif ($arr_login_data[0]['email_verified'] == 1) { 
                   
                    if ($arr_login_data[0]['user_status'] == 2) {
                        $this->session->set_userdata('login_error', "Your account has been blocked by administrator.");
                        redirect(base_url() . 'signin');
                    } else {
                       
                        $user_data['user_id'] = $arr_login_data[0]['user_id'];
                        $user_data['user_name'] = $arr_login_data[0]['user_name'];
                        $user_data['user_email'] = $arr_login_data[0]['user_email'];
                        $user_data['first_name'] = $arr_login_data[0]['first_name'];
                        $user_data['last_name'] = $arr_login_data[0]['last_name'];
                        $user_data['user_type'] = $arr_login_data[0]['user_type'];
                        $user_data['user_role'] = $arr_login_data[0]['user_role'];
                        $user_data['role_id'] = $arr_login_data[0]['role_id'];
                        $user_data['profile_picture'] = $arr_login_data[0]['profile_picture'];
                        $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $arr_login_data[0]['role_id']));

                        /* serializing the user privilegse and setting into the session. While ussing user privileges use unserialize this session to get user privileges */
                        if (count($arr_privileges) > 0) {
                            foreach ($arr_privileges as $privilege) {
                                $user_privileges[] = $privilege['privilege_id'];
                            }
                        } else {
                            $user_privileges = array();
                        }
                        $user_data['user_privileges'] = serialize($user_privileges);
                        /*
                         * Set the user's session
                         */
                        #[Start:]code for set cookies
               
                        if ($this->input->post('remember_me') == "on") {
                            $this->load->helper('cookie');
                            $useremailC = array(
                                'name' => 'user_email',
                                'value' => $this->input->post('user_email'),
                                'expire' => '86500'
                            );
                            $passwordC = array(
                                'name' => 'user_password',
                                'value' => $this->input->post('user_password'),
                                'expire' => '86500'
                            );
                            
                            $profilepictureC = array(
                                'name' => 'profile_picture',
                                'value' => $arr_login_data[0]['profile_picture'],
                                'expire' => '86500'
                            );
                            $this->input->set_cookie($useremailC);
                            $this->input->set_cookie($passwordC);
                            $this->input->set_cookie($profilepictureC);
                        } else {
                            $this->load->helper('cookie');
                            delete_cookie("user_email");
                            delete_cookie("user_password");
                            delete_cookie("profile_picture");
                        }
                        #[End:]code for set cookies
                              
                              
                        $this->session->set_userdata('user_account', $user_data);
                        $user_account = $this->session->userdata('user_account');
//                        echo '<pre>';print_r($user_account['user_id']);die;
                        $table_name = 'mst_users';
                        $update_data = array('is_login' => '1','last_login' => date('Y-m-d H:i:s'));
                        $condition_to_pass = array("user_id" => $user_account['user_id']);
                        $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                              
                        if($arr_login_data[0]['user_role'] == '0'){ 
                          //  $this->session->set_userdata('msg', 'login has been successfuly done');
                            
                             if($this->input->post('back_url') == 'userA-signin'){
                              $this->session->set_userdata('msg', 'login has been successfully done,Please update your profile!');
                                 redirect(base_url() . 'student-user-profile');
                             }else{
                                 redirect(base_url() . 'usera-private-timeline');
                             }
                            
                        }
                        else
                        {
                            //redirect(base_url() . 'institute-private-timeline');
                            redirect(base_url() . 'institute/add-User-list');
                        }
                    }
                } else {

                    $this->session->set_userdata('login_error', "Please activate your account.");
                    redirect(base_url() . 'signin');
                }
            } else {
                $this->session->set_userdata('login_error', "Invalid email/username.");
                redirect(base_url() . 'signin');
            }
        }

        $data['header'] = array("title" => "User Login", "keywords" => "", "description" => "");
        $data['back_url'] = $this->uri->segment(1);
        
        $this->load->view('front/includes/ui1-header1', $data);
        //$this->load->view('front/includes/ui1-header2', $data);
        $this->load->view('front/login/login', $data);
       // $this->load->view('front/includes/ui1-footer', $data);
       
    }

    public function validSignin() {
 
        
        $this->load->library('form_validation');
        $this->common_model->commonFunction();
        
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');
        $this->form_validation->set_rules('user_email', 'email', 'required');
        $this->form_validation->set_rules('user_password', 'password', 'required');

        if ($this->form_validation->run()) {
//             die("1");
            return true;
        } else {
//            die("2");
            return false;
        }
    }

    /*
     * Send the reset password link
     */

    public function passwordRecovery() {
        
        $data = $this->common_model->commonFunction();
        $this->load->model("register_model");

        /* Get user information to send password detail. */
        if ($this->input->post('user_email') != '') {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_email', 'user_password');
//            $condition_to_pass = "`user_email` = '" . $this->input->post('user_email') . "' or `user_email` = '" . $this->input->post('user_email') . "'";
            $condition_to_pass = array("user_email" => $this->input->post('user_email'));
            $arr_password_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
    
            if (count($arr_password_data)) {
                
                $activation_code = time();
                $table_name = 'mst_users';
                $update_data = array('reset_password_code' => $activation_code);

                $condition_to_pass = array("user_email" => $arr_password_data[0]['user_email']);
                
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
                $reset_password_link = '<a href="' . base_url() . 'reset-password/' . base64_encode($activation_code) . '">Click here</a>';
                $lang_id = $this->session->userdata('lang_id');
                if (isset($lang_id) && $lang_id != '') {
                    $lang_id = $this->session->userdata('lang_id');
                } else {
                    $lang_id = 17; // Default is 17(English)
                }
                
                $macros_array_details = array();
                $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                $macros_array = array();
                foreach ($macros_array_details as $row) {
                    $macros_array[$row['macros']] = $row['value'];
                }
                $reserved_words = array
                    (
                    "||USER_NAME||" => $arr_password_data[0]['first_name'],
                    "||FIRST_NAME||" => $arr_password_data[0]['first_name'],
                    "||LAST_NAME||" => $arr_password_data[0]['last_name'],
                    "||USER_EMAIL||" => $arr_password_data[0]['user_email'],
                    "||RESET_PASSWORD_LINK||" => $reset_password_link,
                    "||SITE_TITLE||" => $data['global']['site_title'],
                    "||SITE_PATH||" => base_url()
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                $template_title = 'forgot-password';
                $arr_emailtemplate_data = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved);
                $recipients = $arr_password_data[0]['user_email'];
                $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
                $subject = $arr_emailtemplate_data['subject'];
                $message = $arr_emailtemplate_data['content'];
                $mail = $this->common_model->sendEmail($recipients, $from, $subject, $message);
                if (count($mail) > 0) {
                    // $this->session->set_userdata('success_message', "We have sent reset password link on your email <strong>" . $arr_password_data[0]['user_email'] . "</strong>.");
                    $this->session->set_userdata('success_message', $this->lang->line('regis_reset') . " <strong>" . $arr_password_data[0]['user_email'] . "</strong>.");
                    redirect(base_url() . 'signin');
                }
       

     }
        }
    }
    /*
     * Change new user's password
     */
public function resetPassword($activation_code) {
          

        $data = $this->common_model->commonFunction();
        if ($activation_code != '') {

            $data['activation_code'] = $activation_code;

      }
//      else {
//          die("else");
//            $this->session->set_userdata('error_message', "Invalid reset password link.");
//            redirect(base_url() . 'signin');
//        }

        $this->load->model("register_model");
        /* cheaking password link expirted or not using reset_password_code; */
        $user_detail = $this->common_model->getRecords("mst_users", "user_id", array("reset_password_code" => base64_decode($data['activation_code'])));
        

        if (count($user_detail) == 0) {

            $this->session->set_userdata('error_message', $this->lang->line('regis_invalid'));
            redirect(base_url() . 'signin');
        }
     
        if ($this->input->post() != '') {

            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_password');

           $condition_to_pass = array("reset_password_code" => $this->input->post('activation_code'));
            $arr_password_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_password_data) > 0) {
                $table_name = 'mst_users';
                $update_data = array('user_password' =>base64_encode($this->input->post('user_password')), "reset_password_code" => "");
                $condition_to_pass = array("reset_password_code" => $this->input->post('activation_code'));
                $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);

                $this->session->set_userdata('success_message','password has been reset successfully');
                redirect(base_url() . 'signin');
            } else {


                $this->session->set_userdata('error_message', 'please try again sorry');
                redirect(base_url() . 'signin');
            }
        }

        $data['header'] = array("title" => "Change Password", "keywords" => "", "description" => "");

        $this->load->view('front/includes/ui1-header1',$data);
        $this->load->view('front/includes/ui1-header2');
        $this->load->view('front/forgot-password/reset-password',$data);
        $this->load->view('front/includes/ui1-footer');
        

    }

    /*
     * Check email availability 
     */

    public function chkEmailExistCI($user_email) {
        $this->load->model('register_model');
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_email');
        $condition_to_pass = "`user_email` = '" . $user_email . "' or `user_name` = '" . $user_email . "'";
        $arr_login_data = $this->register_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            return true;
        } else {
            $this->form_validation->set_message('chkEmailExistCI', 'This username or email address is not registered with site');
            return false;
        }
    }

    /*
     * Change new user's password
     */

    public function validResetPassword() {

        $this->load->library('form_validation');
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');

        /* Settning the validation rules */
        $this->form_validation->set_rules('user_password', 'password', 'required|min_length[8]|callback_chkPasswordStrenth');
        $this->form_validation->set_rules('cnf_user_password', 'confirm password', 'required|matches[user_password]');
        /* Cheacking the form is valid or not */
        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }

    /* Random password generating for fb user */

    private function randamPass($num = 8) {
        $alpha_num = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generated_str = '';
        for ($i = 0; $i < $num; $i++) {
            $generated_str .= substr($alpha_num, mt_rand(0, strlen($alpha_num) - 1), 1);
        }
        return $generated_str;
    }

    /*     * ***********forgot password**************** */

    public function forgot_password() {

         
         $data = $this->common_model->commonFunction();

         $data['page_title'] = "Forgot Password";

         $data['header'] = array("title" => "Forgot Password", "keywords" => "", "description" => "");
         
        $this->load->view('front/includes/ui1-header1',$data);
        $this->load->view('front/includes/ui1-header2');
        $this->load->view('front/forgot-password/forgot_password');
        $this->load->view('front/includes/ui1-footer');
        

    }

   
    /* [Start] :: User forgot password action */

    public function forgot_password_action() {


        $data = $this->common_model->commonFunction();
        if ($this->common_model->isLoggedIn()) {
            redirect('home');
        }

        $query = "select * from " . $this->db->dbprefix . "mst_users as a," . $this->db->dbprefix . "user_security_answer as ans where a.user_id=ans.user_id and a.user_email='" . addslashes($this->input->post('forgot_email')) . "'  and ans.security_question_id='" . $this->input->post('forgot_security_question') . "' and ans.security_answer='" . addslashes($this->input->post('forgot_security_answer')) . "' ";

        $data['userDetails'] = $this->common_model->GET_ALL_RECORDS($query);

        if (count($data['userDetails']) > 0) {
            
            $this->session->set_userdata('forgot', 'yes');
            $email = $this->input->post('forgot_email');

            $password_link = '<a href="' . base_url() . "password-reset/" . ($data['userDetails'][0]["verification_code"]) . '" target="_blank">Click here</a>';

            /* [Start Action]:: sending registration email to user as he registered to site. */
            $config['protocol'] = 'mail';
            $config['wordwrap'] = FALSE;
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $this->load->library('email', $config);
            $this->email->initialize($config);
            $this->email->from($data['global_site']['SITE_EMAIL']);
            $this->email->to($email);

            // getting registration template content by email title and lang ig(17 for english)
            $data['registration_successful_template'] = $this->common_model->GET_EMAIL_TEMPLATE('forgot_password');

            $this->email->subject($data['registration_successful_template'][0]['mail_subject']);

            $var_array = array("%%username%%" => ucfirst($data['userDetails'][0]['first_name']), "%%email%%" => $email, "%%password%%" => $data['userDetails'][0]['password'], "%%link%%" => $password_link);

            $description = base64_decode($data['registration_successful_template'][0]['mail_description']);

            foreach ($var_array as $k => $v) {
                $description = str_replace($k, $v, $description);
            }
            $this->email->message($description);
           
            if ($this->email->send()) {
                $this->session->set_userdata('forgot_password_success', '<div id="msg" class="go_green"><button type="button" data-dismiss="alert" class="close" onclick="msghidegreen();">×</button>
																	A reset password link has been sent to your email address.</div>');
             
                redirect(base_url() . $this->session->userdata("current_url"));
            }
        } else {
            $this->session->set_userdata('forgot_password_success', '<div id="msg" class="go_red"><button type="button" data-dismiss="alert" class="close" onclick="msghidegreen();">×</button>
																	 	We were unable to find any accounts that matched the verification data you provided.<br>You can <a href="' . base_url() . 'forgot-password">Try Again</a>!</div>');
            redirect('signin');
        }


        /* [End Action]:: sending registration email to user as he registered to site. */
    }

    /* [End] :: User forgot password */

    public function password_reset($verification_code) {

        $data = $this->common_model->commonFunction();
        $data['global'] = $this->common_model->getGlobalSettings();
        if ($this->common_model->isLoggedIn()) {
            redirect('home');
        }
        $data['userDtl'] = $this->common_model->GET_ANY_DETAILS('', "user_details WHERE verification_code='" . $verification_code . "'");
        $user_id = $data['userDtl'][0]["user_id"];
        $data[] = $this->common_model->commonFunction();

        $data['page_title'] = "Password reset";
        $data['security_question'] = $this->common_model->GET_SECURITY_QUESTION_LIST();

        $this->load->view('front/login/password_reset');

    }

    /* [End] :: this is for password reset */

    /* [Start] :: this is for password reset action */
    
    
    /*
     * Check user email for dupliation 
     */
    public function chkEditEmailDuplicate() {
        $this->load->model("user_model");
        if ($this->input->post('user_email') == $this->input->post('old_user_email')) {
            echo 'true';
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_email');
            $condition_to_pass = array("user_email" => $this->input->post('user_email'));
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }
    
    
    /* [Start] :: Forgot password Email Exist */
	public function check_user_email_forgot_password()
	{
		
  	       $email_to_check= $this->input->post('user_email');
		if($this->common_model->EMAIL_EXISTS($email_to_check))
		{
				die("true");
		}
		else
		{
				die("false");	
		}
	}
	 /* [End] :: Forgot password Email Exist */
    
}

/* End of file register.php */
    /* Location: ./application/controllers/register.php */ 