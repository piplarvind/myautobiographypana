<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_AccountB extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model("common_model");
        $this->load->model('user_model');
    }

    public function userProfile() {

        $data = $this->common_model->commonFunction();
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        if ($data['user_session']['user_role'] == '0') {
            redirect('usera-private-timeline');
        }

        $data['title_for_layout'] = 'User B Dashboard';
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $data['header'] = array('title' => 'Institute Dashboard');
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        
        
        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/300X300/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }
        $condition = array("institute_type_status" => '1');
        $data['arr_institute_type'] = $this->common_model->getRecords("mst_institute_type", "*", $condition, $order_by = '', $limit = '', $debug = 0);
        
        $condition = array("status" => '1');
        $data['arr_geoname_details'] = $this->common_model->getRecords("mst_geoname", "*", $condition, $order_by = '', $limit = '', $debug = 0);
        $data['arr_country_details'] = $this->common_model->getRecords("mst_country", "*", $condition = "", $order_by = '', $limit = '', $debug = 0);
        $country_id = $data['arr_user_data']["country_id"];
        $data['arr_states'] = $this->user_model->getStates($country_id);
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/main-timelineB',$data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function userBProfile() {

        $data = $this->common_model->commonFunction();
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['title_for_layout'] = 'User B Dashboard';
        $data['user_session'] = $this->session->userdata('user_account');
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $user_id = $data['user_session']['user_id'];
        $data['header'] = array('title' => 'Institute User Profile');
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $condition = array("institute_type_status" => '1');
        $data['arr_institute_type'] = $this->common_model->getRecords("mst_institute_type", "*", $condition, $order_by = '', $limit = '', $debug = 0);
        $condition = array("status" => '1');
        $data['arr_geoname_details'] = $this->common_model->getRecords("mst_geoname", "*", $condition, $order_by = '', $limit = '', $debug = 0);
        $data['arr_country_details'] = $this->common_model->getRecords("mst_country", "*", $condition = "", $order_by = '', $limit = '', $debug = 0);
        $country_id = $data['arr_user_data']["country_id"];
        $data['arr_states'] = $this->user_model->getStates($country_id);
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['arr_terms_condtion'] = $this->common_model->getTermsCondtions();
        $data['arr_terms_condtion'] = $data['arr_terms_condtion'][0];
        
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
//        echo '<pre>';print_r($data['arr_terms_condtion']);die;
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userB-edit-profile', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function instituteTimeLine($sub_category_id, $category_id) {
        $data = $this->common_model->commonFunction();
        $this->load->helper('my_date_helper');
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);

        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        #[Start: ]Get & Timeline Timeline media
        $data['arr_get_time_line'] = $this->user_model->getTimeLineForUserB($category_id, $sub_category_id,$user_id);
        
        for($i=0;$i<count($data['arr_get_time_line']);$i++){
            $arr_get_time_line_media[] = $this->user_model->getTimeLineMedia($data['arr_get_time_line'][$i]['timeline_id']);

            #Get Comment
            $arr_get_timeline_comments[] = $this->user_model->getTimeLineCommentsUserB($data['arr_get_time_line'][$i]['timeline_id']);
        }

        $data['arr_timeline_media'] = $arr_get_time_line_media;
        $data['arr_get_timeline_comments'] = $arr_get_timeline_comments;

        #[End: ]Get Timeline & Timeline media
        $data['arr_visibility'] = $this->common_model->getRecords("mst_visibility", "*", array("visibility_status" => '1'), $order_by = '', $limit = '', $debug = 0);
        $data['category_id'] = $category_id;
        $data['sub_category_id'] = $sub_category_id;
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();

        $data['header'] = array('title' => 'Institute Timeline');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userB-time-line', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /*
     * Edit user profile information 
     */

    public function editUserBProfile() {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $data = $this->common_model->commonFunction();
        
        $absolute_path =$data['absolute_path'];
        
        if ($this->input->post()) {
            if ($_FILES['profile_picture']['name'] != "") {
                $image_data = array();
                //config initialise for uploading image 
                $config['upload_path'] = './media/front/img/user-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '5000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = time();
                //loading upload library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile_picture')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    error_reporting(E_ALL);
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $file_name = $image_data['file_name'];
                    
                    $target_path = $absolute_path.'media/front/img/user-images/thumbs/'.$file_name;
                    $target_path1 = $absolute_path.'media/front/img/user-images/50/'.$file_name;
                    
                    exec("convert " . $image_data['full_path'] . " -resize 110X110 " . $target_path);
                    exec("convert " . $image_data['full_path'] . " -resize 50X50 " . $target_path1);
                    

//
//                    $config = array(
//                        'source_image' => $image_data['full_path'],
//                        'new_image' => './media/front/img/user-images/thumbs/',
//                        'create_thumb' => FALSE,
//                        'maintain_ratio' => TRUE,
//                        'width' => 110,
//                        'height' => 110
//                    );
//
//                    $this->load->library('image_lib', $config);
//                    $this->image_lib->initialize($config);
//                    $this->image_lib->resize();
//
//                    $config1 = array(
//                        'source_image' => $image_data['full_path'],
//                        'new_image' => 'media/front/img/user-images/50/',
//                        'create_thumb' => FALSE,
//                        'maintain_ratio' => TRUE,
//                        'width' => 50,
//                        'height' => 50
//                    );
//                    $this->image_lib->initialize($config1);
//                    $this->image_lib->resize();

                }
                $file_name = $image_data['file_name'];
            } else {
                $file_name = $_POST['old_image_name'];
            }
            if ($this->input->post('user_email') != $this->input->post('old_user_email')) {
                $status = '0';
                $email_verified = '0';
            } else {
                $status = '1';
                $email_verified = '1';
            }
            #setting variable to update or add user record.
            $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => $user_id));

            if ($this->input->post('user_email') != $this->input->post('old_user_email')) {
                $activation_code = time();
            } else {
                $activation_code = $arr_user_detail[0]['activation_code'];
            }
            $update_data = array(
                "user_name" => $this->input->post('user_name'),
                "name_of_institute" => $this->input->post('Name_of_institute'),
                "address_1" => $this->input->post('Address_line1'),
                "address_2" => $this->input->post('Address_line2'),
                "country_id" => $this->input->post('country_id'),
                "state_id" => $this->input->post('state_id'),
                "user_city" => $this->input->post('Village_city'),
                "pin_code" => $this->input->post('pin_code'),
                "contact_no" => $this->input->post('contact_number'),
                "country_code" => $this->input->post('country_code'),
                "user_email" => $this->input->post('user_email'),
                "user_status" => $status,
                "email_verified" => $email_verified,
                "date_of_birth" => date('Y-m-d', strtotime($dob)),
                "institute_type" => $this->input->post('Type_of_institution'),
                "established_in" => $this->input->post('Established'),
                "name_of_founder" => $this->input->post('Name_of_founder'),
                "institute_website" => $this->input->post('institute_website'),
                'profile_picture' => $file_name,
                "terms_condition" => $this->input->post('terms'),
                "activation_code" => $activation_code,
            );

            $condition = array("user_id" => $user_id);
    
//                $data['user_session']['user_name'] = $this->input->post('user_name');
//                $this->session->set_userdata('user_account', $data['user_session']);
                $cnf_profile = $this->common_model->updateRow('mst_users', $update_data, $condition);
            
            if ($this->input->post('user_email') != $this->input->post('old_user_email')) {
                $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => $user_id));
                #sending account verification link mail to user
                $lang_id = 17;
                $activation_link = '<a href="' . base_url() . 'userB-activation-front/' . $activation_code . '">Activate Account</a>';
                $macros_array_details = array();
                $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                $macros_array = array();
                foreach ($macros_array_details as $row) {
                    $macros_array[$row['macros']] = $row['value'];
                }
                $reserved_words = array
                    ("||SITE_TITLE||" => $data['global']['site_title'],
                    "||SITE_PATH||" => base_url(),
                    "||USER_NAME||" => $this->input->post('user_name'),
                    "||NEW_EMAIL||" => $this->input->post('user_email'),
                    "||PASSWORD||" => $arr_user_detail[0]['user_password'],
                    "||ADMIN_ACTIVATION_LINK||" => $activation_link
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                $template_title = 'email-updated';
                $email_content = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved);
                $recipeinets = $this->input->post('user_email');
                $data['global'] = $this->common_model->getGlobalSettings();
                $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
                $subject = $email_content['subject'];
                $message = $email_content['content'];
                $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                if ($mail) {
                    $this->session->set_userdata('profile_edit_success', "<strong>Congratulations!</strong> You have profile edit successfully. We have sent email to activate your account on <strong>" . $this->input->post('user_email') . "</strong>.");
                }
                $this->session->set_userdata('message', 'profile edit has been successfuly done');
                $this->session->unset_userdata('user_account');
                redirect(base_url() . 'signin');
            } else {
//                $this->session->set_userdata('message', '<strong>Congratulations!</strong> Profile settings has been updated successfully!');
                $this->session->set_userdata("msg", "<span class='success'>Profile has been updated successfully.</span>");
                redirect(base_url() . 'institute-user-profile');
            }
        }
    }

    /*
     * Change user's account setting
     */

    public function userBAcoountSetting() {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        

        /*
         * Starts Action :: Change Password.
         */
        if ($_POST['btn_change_passwd'] == 'Change Password') {
            $table_name = 'mst_users';
            $update_data = array('user_password' => base64_encode($this->input->post('new_user_password')));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
            if ($cnf_profile) {
                $this->session->set_userdata("msg", "<span class='success'>Your password has been updated successfully.</span>");
                redirect(base_url() . 'institute/user-account-setting');
                exit;
            }
        }
        /*
         * START :: Fetch User Profile Data :
         */
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];

        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }
        $condition = array("news_status" => '1');
        $data['arr_news_details'] = $this->common_model->getRecords("trans_rss_news", "*", $condition, $order_by = '', $limit = '', $debug = 0);
        $data['header'] = array('title' => 'Setting');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/account-setting', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /*     * ********************time line setting************************** */
    /*
     * Change user's account setting
     */

    public function timeLineSetting() {

        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        $data['user_session'] = $this->session->userdata('user_account');
        $data['header'] = array('title' => 'timeline setting');
        
        if ($_POST['btn_timeline_setting'] == 'Save changes') {
            $table_name = 'mst_users';
            $update_data = array('Automatically_approve_comments' => $this->input->post('automatic_approve_comment'));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
            if (count($cnf_profile) > 0) {
                $this->session->set_userdata("msg", "<span class='success'>Your timeline setting has been updated successfully.</span>");
                redirect(base_url() . 'institute/user-account-setting');
                exit;
            }
        }
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userB-left-menu');
        $this->load->view('front/user-accountB/account-setting', $data);
    }

    /*     * ********************My News**************************** */
/*
    public function myNews() {

        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $data['header'] = array('title' => 'My news');
        

        $post_visibility_news = implode(",", $this->input->post("post_visibility_news"));
        if ($_POST['btn_my_news'] == 'Save changes') {

            $table_name = 'mst_users';
            $update_data = array('rss_newsletter' => $post_visibility_news);
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);

            if (count($cnf_profile) > 0) {
                $this->session->set_userdata("msg", "<span class='success'>Your News has been updated successfully.</span>");
                redirect(base_url() . 'institute/user-account-setting');
                exit;
            }
        }
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userB-left-menu');
        $this->load->view('front/user-accountB/account-setting', $data);
    }
*/
    public function userBMessages() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        

        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];

        $data['header'] = array('title' => 'Institute Private Messages');
        $condition_to_pass = array("interest_status" => '1');
        $data['arr_interest_details'] = $this->common_model->getRecords("mst_interest", "*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userB-private-messages', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /*     * **************get user A list which is added by user B****************** */

    public function addUserList() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        
        
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        $data['arr_userA'] = $this->user_model->getApprovedPendingUserList($user_id);
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        $data['header'] = array('title' => 'Institute Student List');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userA-list', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function validEditProfile() {
        $this->load->library('form_validation');
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');

        /* Settning the validation rules */
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        $this->form_validation->set_rules('user_name', 'user name', 'required|callback_chkEditUsernameDuplicateCI');
        $this->form_validation->set_rules('user_email', 'email', 'required|valid_email|callback_chkEditEmailDuplicateCI');
        /* Cheacking the form is valid or not */
        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Check user email for dupliation for server Side
     */

    public function chkEditEmailDuplicateCI($user_email) {
        
        if ($user_email == $this->input->post('user_email_old')) {
            return true;
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_email');
            $condition_to_pass = array("user_email" => $user_email);
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if (count($arr_login_data)) {
                $this->form_validation->set_message('chkEditEmailDuplicateCI', 'This email address is already registered with site.');
                return false;
            } else {
                return true;
            }
        }
    }

    /*
     * Check username for dupliation 
     */

    public function chkEditUsernameDuplicateCI($user_name) {
        
        if ($user_name == $this->input->post('user_name_old')) {
            return true;
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_name');
            $condition_to_pass = array("user_email" => $user_name);
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                $this->form->validation->set_message('chkEditUsernameDuplicateCI');
                return false;
            }

            /* Validation for character accepting */
            if (!preg_match("/^[a-zA-Z\.\_\-]{5,20}+$/", $user_name)) {
                $this->form_validation->set_message('chkEditUsernameDuplicateCI', 'Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.');
                return false;
            }
            /* If all right return true */
            return true;
        }
    }

    /*
     * Check user email for dupliation 
     */

    public function chkEditEmailDuplicate() {
        
        if ($this->input->post('user_email') == $this->input->post('user_email_old')) {
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

    /*
     * Check username for dupliation 
     */

    public function chkEditUsernameDuplicate() {
        
        if ($this->input->post('user_name') == $this->input->post('user_name_old')) {
            echo 'true';
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_name');
            $condition_to_pass = array("user_email" => $this->input->post('user_name'));
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * Change user's account setting
     */

    public function accountSetting() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        
        if ($this->validAccountSetting()) {
            $table_name = 'mst_users';
            $update_data = array('user_password' => base64_encode($this->input->post('new_user_password')));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
            if ($cnf_profile) {
                $this->session->set_userdata('edit_profile_success', "Your account setting has been updated successfully.");
                redirect(base_url() . 'profile');
            }
        }

        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $data['header'] = array("title" => "Account Setting", "keywords" => "", "description" => "");
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/account-setting', $data);
        $this->load->view('front/includes/footer');
    }

    /* Function to validate the account settings server side */

    public function validAccountSetting() {

        $this->load->library('form_validation');
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');

        /* Settning the validation rules */
        $this->form_validation->set_rules('old_user_password', 'old password', 'required|callback_editUserPasswordChkCI');
        $this->form_validation->set_rules('new_user_password', 'new password', 'required|min_length[8]|callback_chkPasswordStrenth');
        $this->form_validation->set_rules('cnf_user_password', 'confirm password', 'required|matches[new_user_password]');
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
        /* Checking the password is valid or not usering the reguler expression */
        if (!preg_match("/^(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!%&@#$^({{}})*?_~]).*$/", $password)) {
            $this->form_validation->set_message('chkPasswordStrenth', 'Password must be strong.');
            return false;
        } else {
            return true;
        }
    }

    /*
     * Check user password for edit
     */

    public function editUserPasswordChkCI($old_user_password) {
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_password');
        $condition_to_pass = array("user_password" => base64_encode($old_user_password));
        $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            return true;
        } else {
            $this->form_validation->set_message('editUserPasswordChkCI', 'Incorrect old password.');
            return false;
        }
    }

    /*
     * Check user password for edit
     */

    public function editUserPasswordChk() {
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_password');
        $condition_to_pass = array("user_password" => base64_encode($this->input->post('old_user_password')));
        $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Edit user's profile image
     */

    public function changeProfilePicture() {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        if ($this->input->post('btn_upload') != "") {
            if (isset($_FILES['upload_profile_picture']) && $_FILES['upload_profile_picture']['name'] != '') {

                $data = $this->common_model->commonFunction();
                $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
                $max_file_size = 2000 * 1024; #2000kb
                $nw = $nh = 200;
                if (!$_FILES['upload_profile_picture']['error'] && $_FILES['upload_profile_picture']['size'] < $max_file_size) {
                    $ext = strtolower(pathinfo($_FILES['upload_profile_picture']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, $valid_exts)) {
                        $profile_picture = uniqid() . '.' . $ext;
                        $file_path = $data['absolute_path'] . 'media/front/users/';
                        chmod($file_path, 0777);
                        if (file_exists($file_path . $this->input->post('old_profile_picture'))) {
                            unlink($file_path . $this->input->post('old_profile_picture'));
                        }
                        $path = $file_path . $profile_picture;

                        $size = getimagesize($_FILES['upload_profile_picture']['tmp_name']);

                        $x = (int) $this->input->post('x');
                        $y = (int) $this->input->post('y');
                        $w = (int) $this->input->post('w') ? $this->input->post('w') : $size[0];
                        $h = (int) $this->input->post('h') ? $this->input->post('h') : $size[1];

                        $data = file_get_contents($_FILES['upload_profile_picture']['tmp_name']);

                        $vImg = imagecreatefromstring($data);
                        $dstImg = imagecreatetruecolor($nw, $nh);
                        imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
                        imagejpeg($dstImg, $path);
                        imagedestroy($dstImg);
                        $table_name = 'mst_users';
                        $update_data = array(
                            'profile_picture' => $profile_picture
                        );
                        $condition = array("user_id" => $this->input->post('user_id'));
                        $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
                        if ($cnf_profile) {
                            $this->session->set_userdata('edit_profile_picture_success', "Your profile picture has been updated successfully.");
                            redirect(base_url() . "profile");
                        }
                    } else {
                        $this->session->set_userdata('edit_profile_picture_success', "Invalid file format.");
                        redirect(base_url() . "profile");
                    }
                } else {
                    $this->session->set_userdata('edit_profile_picture_success', "File is too small or large.");
                    redirect(base_url() . "profile");
                }
            } else {
                //$this->session->set_userdata('edit_profile_picture_success', "Please select file to upload.");
                redirect(base_url() . "profile/change-profile-picture");
            }
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $user_account = $this->session->userdata('user_account');
        $condition_to_pass = array("user_id" => $user_account['user_id']);
        $arr_user_data = array();
        
        $arr_user_data = $this->common_model->getRecords("mst_users", "*", array("user_id" => $user_account['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        if (is_null($data['arr_user_data']['profile_picture']) && $data['arr_user_data']['profile_picture'] == '') {
            if ($arr_user_data['gender'] == 1) {
                $data['profile_img_path'] = base_url() . 'media/front/img/male.png';
            } else {
                $data['profile_img_path'] = base_url() . 'media/front/img/female.png';
            }
        } else {
            $data['profile_img_path'] = base_url() . 'media/front/users/' . $data['arr_user_data']['profile_picture'];
        }
        $data['header'] = array("title" => "Change Profile Picture", "keywords" => "", "description" => "");
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/change-profile-picture', $data);
        $this->load->view('front/includes/footer');
    }

    /*
     * Destroy the user session
     */

    function logout() {
        $this->session->unset_userdata('user_account');
        redirect(base_url());
    }

    public function userActivation($activation_code) {

        $user_data = $this->session->userdata('user_account');
        if (!empty($user_data)) {
            $this->session->set_userdata('message', '<div class="page_holder"><div class="success_msg">Your account is already active.</div> </div>');
            if ($this->session->userdata('prev_url') != '') {
                redirect(base_url() . $this->session->userdata('prev_url'));
            }
            redirect(base_url() . 'profileB');
        }
        $user_dtl_arr = $this->common_model->getRecords('mst_users', '', array("activation_code" => $activation_code));
        if ($user_dtl_arr[0]['email_verified'] != '1') {
            $table_name = 'mst_users';
            $update_data = array("user_status" => '1', 'email_verified' => '1');
            $condition_to_pass = array("user_id" => $user_dtl_arr[0]['user_id']);
            $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
            $this->session->set_userdata('message', '<b>Congratulations! </b>Your account has been activated, please login.');
            $this->session->set_userdata('invalid_credentials', '1');
            redirect(base_url() . 'signin');
        } else {
            $this->session->set_userdata('message-error', '<b>Sorry! </b>Your account is already active, please login.');
            $this->session->set_userdata('invalid_credentials', '1');
            redirect(base_url() . 'signin');
        }
    }

    public function profileB() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['title_for_layout'] = 'User A profile';
        $data['user_session'] = $this->session->userdata('user_account');
        
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformationById($data['user_session']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/300X300/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }
        $data['interest'] = unserialize($data['arr_user_data']['interest']);
        $this->load->view('front/user-accountB/profileB', $data);
    }

    public function institutionalBrownies($category_id) {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $category_id = base64_decode($category_id);
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $condition_to_pass = array("category_id" => $category_id);
        $data['arr_institutional_brownies_details'] = $this->common_model->getRecords("mst_categories", "*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        $data['category_id'] = base64_encode($category_id);
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['header'] = array('title' => 'Institutional Brownies Details');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/institutional-brownies', $data);
    }

    /*     * ********************edit institutional browines****************************** */

    public function editIinstitutionalBbrownies($category_id) {

        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "signin");
        }
        $category_id = base64_decode($category_id);
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            $category_id = base64_decode($this->input->post('category_id'));
            $image_data = array();
            if ($_FILES['category_image']['name'] != "") {
                $old_img = $this->input->post("old_filename");
                @unlink("media/front/img/category-images/" . $old_img);
                @unlink("media/front/img/category-images/thumbs/" . $old_img);
                @unlink("media/front/img/category-images/thumbs-for-backend/" . $old_img);
                $config['upload_path'] = 'media/front/img/category-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                //loading uploda librarydie("1");    

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('category_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    for ($i = 0; $i < 2; $i++) {
                        if ($i == 0) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/thumbs',
                                'maintain_ratio' => true,
                                'width' => 18,
                                'height' => 18
                            );
                        } else {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/thumbs-for-backend',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );
                        }
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
                $cat_img = $image_data['file_name'];
            } else {
                $cat_img = $this->input->post('old_filename');
            }

            $arr_to_update = array(
                "category_name" => $this->input->post('category_name'),
                "category_image" => $cat_img,
                'page_title' => $this->input->post('category_title'),
                'page_keywords' => $this->input->post('meta_keyword'),
                'page_description' => $this->input->post('meta_description'),
            );

            $this->common_model->updateRow('mst_categories', $arr_to_update, array("category_id" => $category_id));
//            die("4");
            $arr_to_update_lang = array(
                "category_name" => $this->input->post('category_name'),
                'page_title' => $this->input->post('category_title'),
                'page_keywords' => $this->input->post('meta_keyword'),
            );
            $this->common_model->updateRow('trans_categories_lang_map', $arr_to_update_lang, array("category_id" => $category_id, "lang_id" => 17));
//            $url = $this->common_model->seoUrl(trim($this->input->post('category_name'))) . '-' . $category_id;
//            $rel_id = $Category_id;
//            $arr_insert_url = array(
//                "url" => $url
//            );
//            $this->common_model->updateRow('mst_uri_map', $arr_insert_url, array('type' => 'Category', 'rel_id' => $this->input->post('edit_id')));
            $this->session->set_userdata("msg", "<span class='success'>Institutional brownies information updated successfully!</span>");
            redirect(base_url() . 'institutional-brownies/' . base64_encode($category_id));
        }
    }

    /* Below is for user B(institution) Public Profile i.e My Profile(Public Profile) */

    public function userBMyProfile() {


        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('login_error', "Please login to upload photos.");
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
       
        $user_id = $data['user_session']['user_id'];
        $data['user_id'] = $user_id;
        /* Create folder for particular user. */
        $parentDir = $data["absolute_path"] . 'media/front/UI-2-media/images/album_photos/user_' . $user_id;
        if (!is_dir($parentDir)) {
            // Check if the parent directory is a directory.
            mkdir($parentDir, 0777);
            $config['upload_path'] = './media/front/UI-2-media/images/album_photos/user_' . $user_id;
        } else {
            $config['upload_path'] = './media/front/UI-2-media/images/album_photos/user_' . $user_id;
        }

        if (!empty($_POST) && $_POST['btn-create'] == 'Save changes') { 
            $this->session->set_userdata('album_added', "Album <b>" . trim($this->input->post('album_name')) . "</b> created successfully!");
            $data['active_class_album'] = 'active';
            $data['active_class_photo'] = '';
            $data['active_class_album_in'] = 'active in';
            $data['active_class_photo_in'] = '';
        } else {
            $data['active_class_album'] = '';
            $data['active_class_photo'] = 'active';
            $data['active_class_album_in'] = '';
            $data['active_class_photo_in'] = 'active in';
        }

        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $user_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        $data['arr_user_data'] = $arr_user_data[0];
        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }

        
        $table_to_pass = 'mst_album';
        $fields_to_pass = array('album_id,album_name,created_date');
        $condition_to_pass = array("user_id" => $user_id, 'album_status' => '1');
        $data['user_albums'] = $this->common_model->getRecords($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = 'album_id DESC', $limit_to_pass = '', $debug_to_pass = 0);
        
        foreach ($data['user_albums'] as $key => $value) {
            $data['user_albums'][$key]['front_photo'] = $this->common_model->getRecords('trans_album_media', array('album_image_path'), array('album_id' => $value['album_id']), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '1', $debug_to_pass = 0);
            $data['user_albums'][$key]['photos_count'] = $this->common_model->getRecords('trans_album_media', array('COUNT(*) as cnt'), array('album_id' => $value['album_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        }

        $data['session_user_id'] = $user_id;
        $data['arr_user_data'] = $arr_user_data[0];
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['timelinephotolist'] = $this->common_model->getTimeLinePhoto($user_id);
//        echo '<pre>';print_r($data['timelinephotolist']['timeline_image']);die;
        
        $data['header'] = array('title' => 'My Profile');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/my-profile-userB', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /* Time Line Images upload function thorugh ajax */

    public function ajaxImageUpload() {

        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->helper('my_date_helper');
        $user_id = $data['user_session']['user_id'];
        /* Insert Timeline details. */
        if($data['user_session']['user_role'] == '0'){ //User A
            $arr_institute_id = $this->common_model->getRecords("mst_users", "institute_id", array('user_id' => $user_id));
            $institute_id = $arr_institute_id[0]['institute_id'];
        }else{
            $institute_id = $user_id;
        }
        
        $arr_to_insert_files = array(
            'user_id' => $user_id,
            'institute_id' => $institute_id,
            "category_id" => base64_decode($this->input->post('category_id')),
            "sub_category_id" => base64_decode($this->input->post('sub_category_id')),
            "timeline_post_data" => mysql_real_escape_string($this->input->post('post_data')),
            'timeline_posted_date' => date('Y-m-d H:i:s'),
            'timeline_status' => '1',
            'timeline_visibility' => $this->input->post('visibility')
        );

        $last_insert_id = $this->common_model->insertRow($arr_to_insert_files, "mst_timeline");
        $cat_name = $this->common_model->getRecords("mst_categories", "category_name", array('category_id' => base64_decode($this->input->post('category_id'))), $order_by = '', $limit = '', $debug = 0);
        $sub_cat_name = $this->common_model->getRecords("mst_categories", "category_name", array('parent_id' => base64_decode($this->input->post('category_id')), 'category_id' => base64_decode($this->input->post('sub_category_id'))), $order_by = '', $limit = '', $debug = 0);
        $data_to_insert = array(
            'from_id' => $user_id,
            "timeline_id" => $last_insert_id,
            "subject" => "Time line post on " . $cat_name[0]['category_name'] . ' : ' . $sub_cat_name[0]['category_name'],
            'message_date' => date('Y-m-d H:i:s'),
            'status' => '1'
        );

        $this->common_model->insertRow($data_to_insert, "mst_notifications");

        /* [Start]: Upload TimeLine Images. */
        if ($_FILES['upFile']['name'] != '') {
            for ($i = 0; $i < count($_FILES['upFile']['name']); $i++) {
                $_FILES['userfile']['name'] = $_FILES['upFile']['name'][$i];
                $_FILES['userfile']['type'] = $_FILES['upFile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['upFile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $_FILES['upFile']['error'][$i];
                $_FILES['userfile']['size'] = $_FILES['upFile']['size'][$i];
                $config['file_name'] = time() . rand(1000, 9999) . $i;
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['overwrite'] = FALSE;
                $config['upload_path'] = './media/front/img/post-images/';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userfile')) {
                    //$upload_result = $this->upload->data();

//                    $data["image_file"] = $this->upload->data();
//                    $img_name = $data ["image_file"]['file_name'];
//                    $im = "$img_name";
                    $data = $this->upload->data();
                    $upload_result = $this->upload->data();
                    $img_name = $upload_result['file_name'];
                    
                    
                    $target_path = $absolute_path.'media/front/img/post-images/400x400/'.$img_name;
                    $target_path1 = $absolute_path.'media/front/img/post-images/thumbs/'.$img_name;

                    
                    exec("convert " . $data['full_path'] . " -resize \!400X400 " . $target_path);
                    exec("convert " . $data['full_path'] . " -resize \!100x100 " . $target_path1);

                    
                    

//                    $config['source_image'] = '';
//                    $config['image_library'] = 'gd2';
//                    $config['overwrite'] = FALSE;
//                    $config['source_image'] = './media/front/img/post-images/';
//                    $this->load->library('image_lib', $config);
//                    $this->image_lib->clear();
//                    $this->image_lib->initialize($config);
//                    $image_config = array(
//                        'source_image' => $data["image_file"]['full_path'],
//                        'new_image' => 'media/front/img/post-images/thumbs/',
//                        'maintain_ratio' => TRUE,
//                        'width' => 100,
//                        'height' => 100
//                    );
//                    $this->image_lib->initialize($image_config);
//                    $resize_rc = $this->image_lib->resize();
                } else {
                    $msg = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('image_error', 'Sorry!Their is problem in loading images that "' . $msg . '" Please try again.');
                }

                $file_name = $img_name;
                $media_type = '0';
                if ($file_name == "" && $media_type == "") {
                    $file_name = "";
                    $media_type = "";
                }

                $arr_to_insert = array(
                    'timeline_id' => $last_insert_id,
                    "timeline_media_path" => $file_name,
                    "timeline_media_type" => '0',
                    'timeline_media_status' => '1'
                );
                $id = $this->common_model->insertRow($arr_to_insert, "trans_timeline_media");
            }
        }
        /* [Ends]: Upload TimeLine Images. */

        /* [Start]: Upload TimeLine Video. */
        if ($_FILES['upVideoFile']['name'] != '') {
            $file_unique_name = uniqid();
            $config['allowed_types'] = 'avi|flv|wmv|mpeg|mp3|mp4|mov|ogg';
            $config['upload_path'] = './media/front/post-video/';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('upVideoFile')) {
                $this->session->set_userdata('error_message', 'Opps !! Something went wrong while uploading video.');
                $error = array('error' => $this->upload->display_errors());
            } else {
                $upload_data = array('upload_data' => $this->upload->data());
                $image_data = $this->upload->data();
                $image_name = $image_data['file_name'];
                
                $avi_filename_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $image_data["file_name"];
                $flv_file_from_avi_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $file_unique_name . ".flv";
                    #Org. FLV Format Video:
                exec('ffmpeg -i ' . $avi_filename_wthBasePath . ' -ar 44100 ' . $flv_file_from_avi_wthBasePath . ''); 
                    
                    
                $arr_to_insert = array(
                    'timeline_id' => $last_insert_id,
                    "timeline_media_path" => $file_unique_name . ".flv",
                    "timeline_media_type" => '1',
                    'timeline_media_status' => '1'
                );
                $id = $this->common_model->insertRow($arr_to_insert, "trans_timeline_media");
            }
        }
        /* [Ends]: Upload TimeLine Video. */

        /* [Start]: Upload TimeLine Doc. */
        
         if ($_FILES['upDocFile']['name'] != '') {
            for ($i = 0; $i < count($_FILES['upDocFile']['name']); $i++) {
                $_FILES['userfile']['name'] = $_FILES['upDocFile']['name'][$i];
                $_FILES['userfile']['type'] = $_FILES['upDocFile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $_FILES['upDocFile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $_FILES['upDocFile']['error'][$i];
                $_FILES['userfile']['size'] = $_FILES['upDocFile']['size'][$i];
                $config['file_name'] = time() . rand(1000, 9999) . $i;
                $config['allowed_types'] = 'doc|docx|txt|pdf';
                $config['upload_path'] = './media/front/img/post-images/';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userfile')) {
                   
                    $data = $this->upload->data();
                    $upload_result = $this->upload->data();
                    $img_name = $upload_result['file_name'];
                    
                } else {
                    $msg = $this->upload->display_errors('', '');
                    $this->session->set_flashdata('image_error', 'Sorry!Their is problem in loading file that "' . $msg . '" Please try again.');
                }

                $arr_to_insert = array(
                    'timeline_id' => $last_insert_id,
                    "timeline_media_path" => $img_name,
                    "timeline_media_type" => '2',
                    'timeline_media_status' => '1'
                );
                $id = $this->common_model->insertRow($arr_to_insert, "trans_timeline_media");
            }
        }
        /* [Ends]: Upload TimeLine Video. */


        #**********************************Start**********************
        $data['arr_user'] = $this->common_model->getRecords("mst_users", "profile_picture,first_name,last_name,user_name,user_role,name_of_institute", array('user_id' => $data['user_session']['user_id']));
        $data['arr_get_time_line'] = $this->common_model->getRecords("mst_timeline", "*", array('timeline_id' => $last_insert_id));
        $data['arr_timeline_media'] = $this->common_model->getRecords("trans_timeline_media", "*", array('timeline_id' => $last_insert_id));

        
        $filenames = "";
        $filenames.= '<li class="media single-post">';
        $filenames.= '<div class="pull-left timeline-user-pic">';
        if ($data['arr_user'][0]['profile_picture'] != '') {
            $filenames.= '<a class="timeline-user-thumb" href="'.  base_url().'profile/'.$data['arr_user'][0]['user_name'].'" >';
            $filenames.= '<img width="80" class="img-circle" alt="people" src="' . base_url() . 'media/front/img/user-images/thumbs/' . $data['arr_user'][0]['profile_picture'] . '" alt="' . ucfirst(stripslashes($data['arr_user'][0]['first_name'])) . ' Profile Photo">';
            $filenames.= '</a>';
        }
        
        if($data['arr_user'][0]['user_role'] == '0') {
            $filenames.= '<div><a href="javascript:void(0);">' . ucfirst(stripslashes($data['arr_user'][0]['first_name'])) . ' ' . ucfirst(substr(stripslashes($data['arr_user'][0]['last_name']), 0, 1)) . '.</a></div>';
        }else{
             $filenames.= '<div><a href="javascript:void(0);">' . ucfirst(stripslashes($data['arr_user'][0]['user_name'])) . '</a></div>'; 
        }
        
        
        
        $filenames.= '<div class="date">';
        $filenames.= '<div class="post-date-time-cont">';
        $filenames.= '<span class="life-event">Life event #50</span>';
        $filenames.= '<div class="date-time"><p>Date:'.date('d M').'</p>';
        $filenames.= '<p>Time: '.date('h:i A').'</p></div>';
        $filenames.= '</div>';
        $filenames.= '</div>';
        
        $filenames.= '</div>';

        $filenames.= '<div class="media-body">';
        $filenames.= '<div class="panel panel-default">';


        if (count($data['arr_timeline_media']) > 0) {

            if (count($data['arr_timeline_media']) == 1) {
                #Show Single Image or Video
                if ($data['arr_timeline_media'][0]['timeline_media_type'] == '0') {
                    #[Start] Show Single Image

                    $filenames.= '<div class="panel-body">';
                    $filenames.= '<div class="boxed">';
                    $filenames.= '<div class="media">';

                    $filenames.= '<a href="#" class="media-object pull-left">';
                    $filenames.= '<img width="80" alt="photos" src="' . base_url() . 'media/front/img/post-images/thumbs/' . $data['arr_timeline_media'][0]["timeline_media_path"] . '">';
                    $filenames.= '</a>';

                    $filenames.= '</div>';
                    $filenames.= '<ul class="icon-list">';
                    $filenames.= '<li><i class="fa fa-star fa-fw"></i> 4.8</li>';
                    $filenames.= '<li><i class="fa fa-clock-o fa-fw"></i>' . relative_time($data['arr_get_time_line'][0]['timeline_posted_date']) . '</li>';
                    $filenames.= '<li><i class="fa fa-graduation-cap fa-fw"></i> Beginner</li>';
                    $filenames.= '</ul>';
                    $filenames.= '</div>';
                    $filenames.= '</div>';
                } else {
                    #[Start] Show Single Video
                    $filenames.= '<div class="panel-body">';
                    $filenames.= '<p>' . $this->input->post('post_data') . '</p>';
                    $filenames.= '</div>';
                    $filenames.= '<div class="videoWrapper">';
                    $filenames.= '<iframe src="//player.vimeo.com/video/50522981?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                    $filenames.= '</div>';
                }
            }

            if (count($data['arr_timeline_media']) > 1) {
                #Show multiple Image
                $filenames.= '<div class="panel-body">';
                $filenames.= '<p>' . $this->input->post('post_data') . '</p>';

                $filenames.= '<div class="timeline-added-images">';
                for ($j = 0; $j < count($data['arr_timeline_media']); $j++) {
                    $filenames.= '<img width="80" alt="photos" src="' . base_url() . 'media/front/img/post-images/thumbs/' . $data['arr_timeline_media'][$j]["timeline_media_path"] . '">';
                }
                $filenames.= '</div>';
                $filenames.= '</div>';
            }
        } else {
            #Show Only post data   
            $filenames.= '<div class="panel-body">';
            $filenames.= '<p>' . $this->input->post('post_data') . '</p>';
            $filenames.= '</div>';
        }


        $filenames.= '</div>';
        $filenames.= '</div>';

        $filenames.= '</li>';

        echo $filenames;

        //$this->session->set_userdata('success_message', "Time Line posted successfully.");
    }

    function getMoreTimeLine() {
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $pg = $_REQUEST['pg'];
        $data['arr_get_time_line'] = $this->user_model->getTimeLine($_POST['category'], $_POST['sub_category'], $pg);
        if (count($data['arr_get_time_line']) > 0) {
            $this->load->view('front/includes/timeline_ajax', $data);
        } else {
            echo '1';
        }
    }

    /*     * **************manage friends add function by yogesh on 3 jan 15************************************** */

    public function userBManageFriends() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $data['user_id'] = $user_id;
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $data['header'] = array('title' => 'Manage Friends');
        $condition_to_pass = array("interest_status" => '1');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['arr_interest_details'] = $this->common_model->getRecords("mst_interest", "*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/manage-friendsB', $data);
    }

    /*     * **************manage friends follow add by yogesh on 3 jan 15********************** */

    public function followFriendsUser() {
        
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_session_id = $data['user_session']['user_id'];
        
        if ($this->input->post('friend_id') != "") {
            
            if($this->input->post('status') == 'Yes'){// delete record [Unfollow]
                
                $this->common_model->UnfollowFriends($user_session_id, $this->input->post('friend_id'));
                $this->common_model->UnfollowFriends($this->input->post('friend_id'),$user_session_id);
                
                echo json_encode(array("error" => "0", "error_message" => "This user has been successfully unfollowed by you."));
            }else{ // Add record
                
                $insert_data = array(
                    'from_user_id' => $user_session_id,
                    'to_user_id' => $this->input->post('friend_id'),
                    'friends_on' => date('Y-m-d H:i:s')
                );
                $this->common_model->insertRow($insert_data, "mst_user_friends");
                echo json_encode(array("error" => "0", "error_message" => "This user has been successfully followed by you."));
            }
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }
         
    /*     * **********public profile************** */

    public function publicProfile($username) {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $session_user_id = $data['user_session']['user_id'];
        
        
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $session_user_id);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        
        
        $public_profile_data = $this->common_model->getRecords('mst_users', '*', array("user_name" => $username), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        $data['public_profile_data'] = $public_profile_data[0];
        $user_id = $public_profile_data[0]['user_id'];
        $data['public_profile_user_id'] = $public_profile_data[0]['user_id'];
        $data['username'] = $username;

        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }

        $table_to_pass = 'mst_album';
        $fields_to_pass = array('album_id,album_name,created_date');
        $condition_to_pass = array("user_id" => $data['public_profile_user_id'], 'album_status' => '1');
        $data['user_albums'] = $this->common_model->getRecords($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = 'album_id DESC', $limit_to_pass = '', $debug_to_pass = 0);

        foreach ($data['user_albums'] as $key => $value) {
            $data['user_albums'][$key]['front_photo'] = $this->common_model->getRecords('trans_album_media', array('album_image_path'), array('album_id' => $value['album_id']), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '1', $debug_to_pass = 0);
            $data['user_albums'][$key]['photos_count'] = $this->common_model->getRecords('trans_album_media', array('COUNT(*) as cnt'), array('album_id' => $value['album_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        }
//        $data['public_profile_user_id'] = $user_id;
        
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['timelinephotolist'] = $this->common_model->getTimeLinePhoto($user_id);
        
        
        #[Start: ]Get Friend list
        $condition_friends = "to_user_id ='" . $user_id . "' OR from_user_id ='" . $user_id . "' ";
        $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);
//        echo '<pre>';print_R($friends_details);die;
        $arr_friends_id = array();
        foreach ($friends_details as $friend) {

            if ($friend['to_user_id'] == $user_id) {
                
                $arr_friends_id[] = $friend['from_user_id'];
                
            } else {
                
                $arr_friends_id[] = $friend['to_user_id'];
                
            }
        }
        //print_R($arr_friends_id);
        for($i=0;$i<count($arr_friends_id);$i++){
        
            $arr_friends[] = $this->common_model->getRecords("mst_users", "user_name,profile_picture", array("user_id" => $arr_friends_id[$i]), $order_by = '', $limit = '', $debug = 0);
        }
        $data['publicfriendsfollowlist'] = $arr_friends;

        #[End: ]Get Friend list

        #[Start] check already friend
        if(in_array($session_user_id,$arr_friends_id)){
            
            $data['already_friend'] = 'Yes';
        }else{
            $data['already_friend'] = 'No';
        }
        #[End] check already friend
        
        $data['header'] = array('title' => 'Public Profile');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        
        if($data['user_session']['user_role'] == '0'){ 
            #For User A
            $this->load->view('front/includes/ui2-userA-left-menu', $data);
        }else{
            #For User B
            $this->load->view('front/includes/ui2-userB-left-menu', $data);
        }
        $this->load->view('front/user-accountB/public-profile', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }
    
    public function ViewAllFriends($username) {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $session_user_id = $data['user_session']['user_id'];
        
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $session_user_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        $data['public_profile_data'] = $this->common_model->getRecords('mst_users', 'user_id,user_name,first_name,last_name', array("user_name" => $username), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        #[Start: ]Get My Friend list
        $condition_my_friends = "to_user_id ='" . $session_user_id . "' OR from_user_id ='" . $session_user_id . "' ";
        $my_friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_my_friends);
        
        $arr_my_friends_id = array();
        foreach ($my_friends_details as $my_friend) {

            if ($my_friend['to_user_id'] == $session_user_id) {
                $arr_my_friends_id[] = $my_friend['from_user_id'];
            } else {
                $arr_my_friends_id[] = $my_friend['to_user_id'];
            }
        }
        array_push($arr_my_friends_id, $session_user_id);
        $data['arr_my_friends_id'] = $arr_my_friends_id;
        #[Start: ]Get My Friend list
        
        
       // print_R($data['arr_my_friends_id']);
        
        #[Start: ]Get public profile Friend list
        $condition_friends = "to_user_id ='" . $data['public_profile_data'][0]['user_id'] . "' OR from_user_id ='" . $data['public_profile_data'][0]['user_id'] . "' ";
        $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);

        $arr_friends_id = array();
        foreach ($friends_details as $friend) {

            if ($friend['to_user_id'] == $data['public_profile_data'][0]['user_id']) {
                $arr_friends_id[] = $friend['from_user_id'];
            } else {
                $arr_friends_id[] = $friend['to_user_id'];
            }
        }
        
        //print_R($arr_friends_id);die;
        for($i=0;$i<count($arr_friends_id);$i++){
            $arr_friends[] = $this->common_model->getAllFriendsTotalCount($arr_friends_id[$i]);
        }
        $data['publicfriendsfollowlist'] = $arr_friends;
        #[Start: ]Get public profile Friend list
        

        #[Start: ] Get Common friends
        $arr_friends_of_friend_id = array();
        for($i=0;$i<count($arr_friends_id);$i++){
         #Get friend list - public profile friend of friend   
            $condition_public_friend_of_friend = "to_user_id ='" . $arr_friends_id[$i] . "' OR from_user_id ='" . $arr_friends_id[$i] . "' ";
            $friend_of_friend_list[] = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_public_friend_of_friend, $order_by = '', $limit = '', $debug = 0);
            
            foreach ($friend_of_friend_list[$i] as $friend) {
                if ($friend['to_user_id'] == $arr_friends_id[$i]) {
                    $arr_friends_of_friend_id[$i][] = $friend['from_user_id'];
                } else {
                    $arr_friends_of_friend_id[$i][] = $friend['to_user_id'];
                }
             }
             #[Start: ] Common friend array
             $arr_common_friend[] = array_intersect($arr_my_friends_id, $arr_friends_of_friend_id[$i]);
             #[End: ] Common friend array
             
             #[Start: ] Common friend information
             foreach ($arr_common_friend[$i] as $common_friend) {
                 $arr_common_friend_info[$i][] = $this->common_model->getRecords('mst_users', 'user_id,first_name,last_name,user_name,profile_picture', array("user_id" => $common_friend));
             }
             #[End: ] Common friend information
        }
         
        //$data['arr_friends_of_friend_id'] = $arr_friends_of_friend_id;
        //$data['arr_common_friend'] = $arr_common_friend;
         $data['arr_common_friend_info'] = $arr_common_friend_info;
      
        #[End: ] Get Common friends
        
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['timelinephotolist'] = $this->common_model->getTimeLinePhoto($session_user_id);
        $data['header'] = array('title' => 'Friend List');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        
        if($data['user_session']['user_role'] == '0'){ 
            #For User A
            $this->load->view('front/includes/ui2-userA-left-menu', $data);
        }else{
            #For User B
            $this->load->view('front/includes/ui2-userB-left-menu', $data);
        }
        $this->load->view('front/user-accountB/manage-friendsB', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function changeInstituteCoverPhoto() {

        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $user_details = $this->common_model->getRecords('mst_users', $fields = '*', $condition = array('user_id' => $user_id), $order_by = '', $limit = '', $debug = 0);
        $user_name = $user_details[0]['user_name'];
        $filenames = "";
        if ($_FILES['upFile']['name'] != "") {
            $config['upload_path'] = './media/front/UI-2-media/images/cover-photos/';
            $config['allowed_types'] = 'jpeg|JPEG|png|PNG|gif|GIF|jpg';
            $config['file_name'] = time();
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('upFile')) {
                $this->session->set_userdata('error_message', 'image_uploading_error!');
                redirect(base_url() . 'public-profile-buisness-user/' . $user_name . '/' . base64_encode($user_id));
            } else {
                $this->load->library('image_lib');
                $image_details = array('upload_data' => $this->upload->data());
                $image_data = $this->upload->data();
                $file_name = $image_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $table_name = 'mst_users';
                $update_data = array('profile_cover' => $file_name);
                $this->common_model->updateRow($table_name, $update_data, array("user_id" => $user_id));
                $condition_friends = "to_user_id ='" . $user_id . "' OR from_user_id ='" . $user_id . "' ";
                $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);
                $arr_friends_id = array();
                
                foreach ($friends_details as $friend) {

                    if ($friend['to_user_id'] == $user_id) {
                        $arr_friends_id[] = $friend['from_user_id'];
                    } else {
                        $arr_friends_id[] = $friend['to_user_id'];
                    }
                }
                    $arr_friends_id[]= '1';
                    for ($i = 0; $i < count($arr_friends_id); $i++) {
                        $table = 'mst_notifications';
                        $fields = array(
                            'from_id' => $user_id,
                            'to_id' => $arr_friends_id[$i],
                            'subject' => 'cover_photo_update',
                            'status' => '1',
                            'message_date' => date('Y-m-d H:i:s')
                        );
                        $insert_id = $this->common_model->insertRow($fields, $table);
                    }
                $this->session->set_userdata('success_message', 'Cover photo uploaded successfully!');
            }
            echo $file_name;
        }
    }
    
    
    /***********user B timeline gallery ************/
    public function timelineGallery($username) {
        
        
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $album_id=  base64_decode($album_id);
        $data['user_session'] = $this->session->userdata('user_account');
        $session_user_id = $data['user_session']['user_id'];
        $data['session_user_id'] = $session_user_id;
      
       
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $session_user_id);
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        
        $data['header'] = array('title' => 'Gallery');

        $arr_timeline_details = $this->user_model->getUserInformation('mst_users', '*', array("user_name" => $username), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0); 
        $timeline_user_id =  $arr_timeline_details[0]['user_id'];
        
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['timelinephotolist'] = $this->common_model->getTimeLinePhoto($timeline_user_id);
        
        $this->load->view('front/includes/ui2-header1',$data);
        $this->load->view('front/includes/ui2-header2');
        
        if($data['user_session']['user_role'] == '0'){ #For User A 
            $this->load->view('front/includes/ui2-userA-left-menu',$data);
        }else{
            $this->load->view('front/includes/ui2-userB-left-menu',$data);
        }
        
        $this->load->view('front/user-accountB/gallery',$data);
        $this->load->view('front/includes/ui2-footer', $data);
        
       }   
       


}
?>

