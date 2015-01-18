<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {
    /*     * *
     * An Controller having functions to manage user login,add, edit, forgot password, profile and activating user account
     * * */

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('user_model');
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
    }

    /*
     * function to list all the users
     */

    public function listUserA($all = 0, $pg = 0) {
        /*
         * Getting Common data
         */
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_user_ids = $this->input->post('checkbox');
                if (count($arr_user_ids) > 0) {
                    foreach ($arr_user_ids as $user_id) {
                        #getting user details
                        $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
                        if (count($arr_user_detail) > 0) {
                            #setting reserved_words for email content
                            $lang_id = 17;
                            $macros_array_details = array();
                            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                            $macros_array = array();
                            foreach ($macros_array_details as $row) {
                                $macros_array[$row['macros']] = $row['value'];
                            }
                            $reserved_words = array("||SITE_TITLE||" => $data['global']['site_title'],
                                "||SITE_PATH||" => base_url(),
                                "||ADMIN_NAME||" => $arr_user_detail[0]['user_name']
                            );
                            $reserved = array_replace_recursive($macros_array, $reserved_words);
                            $template_title = 'admin-deleted';
                            #getting mail subject and mail message using email template title and lang_id and reserved works
                            $email_content = $this->common_model->getEmailTemplateInfo('admin-deleted', 17, $reserved);
                            #sending admin user mail for account deletion.
                            #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                            $mail = $this->common_model->sendEmail(array($arr_user_detail[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                            /* Addmin the user in deleted list into file */
                            $this->load->model('admin_model');
                            $this->admin_model->updateDeletedUserFile($this->common_model->absolutePath(), intval($user_id));
                            @unlink("media/front/img/user-images/" . $arr_user_detail[0]["profile_picture"]);
                            @unlink("media/front/img/user-images/thumbs/" . $arr_user_detail[0]['profile_picture']);
                        }
                    }
                    if (count($arr_user_ids) > 0) {
                        #deleting the user selected
                        $this->common_model->deleteRows($arr_user_ids, "mst_users", "user_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>User deleted successfully!</span>");
                }
            }
        }
        /* using the user model */
        $this->load->model('user_model');
        $data['title'] = "Manage User A";
        /* get all post to list. */
        if ($all == 0) {
            if ($this->input->post('search_post') == "Submit") {
                $this->session->set_userdata('search_post_data', $_POST);
            }
            $data['arr_user_list'] = $this->user_model->getUserDetailsBySearchA($this->session->userdata('search_post_data'));
            $base_url = base_url() . 'backend/user-a/list/0';
        } else {
            /* Listing all users */
            $this->session->unset_userdata('search_post_data');
            $data['arr_user_list'] = $this->user_model->getUserDetailsA('');
            $base_url = base_url() . 'backend/user-a/list/10';
        }
        /* Getting the per page record from the global settings */
        $per_page_record = 25; //$data['global']['per_page_record'];
        /*
          Create pagination of all the records it required  parameter
          1. Total count of records
          2. baseurl for the links
          3. Page no which is loading
          4. Number of record for per page
          5. Number of "digit" links to show before/after the currently viewed page
         */
        $data['pagination_links'] = $this->common_model->createPagination(count($data['arr_user_list']), $base_url, $pg, $per_page_record, 2);
        if ($pg == "") {
            $pg1 = 0;
        } else {
            $pg1 = $pg - 1;
        }
        $from = intval(($pg1) * $per_page_record);
        if ($per_page_record == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($per_page_record);
        }
        $data['arr_user_list'] = array_slice($data['arr_user_list'], $from, $lenth);
        $data['header'] = array('title' => 'Manage User A');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/list', $data);
        $this->load->view('backend/sections/footer');
    }

    /* Delete individual user by user id */

    public function deleteUserA($user_id) {
        $user_id = base64_decode($user_id);
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* getting user details */
        $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
        if (count($arr_user_detail) > 0) {
            /*             * setting reserved_words for email content */
            $lang_id = 17;
            $macros_array_details = array();
            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_details as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            $reserved_words = array("||SITE_TITLE||" => $data['global']['site_title'],
                "||SITE_PATH||" => base_url(),
                "||ADMIN_NAME||" => $arr_user_detail[0]['user_name']
            );
            $reserved = array_replace_recursive($macros_array, $reserved_words);
            $template_title = 'admin-deleted';
            /** getting mail subject and mail message using email template title and lang_id and reserved works */
            $email_content = $this->common_model->getEmailTemplateInfo('admin-deleted', 17, $reserved);
            /** sending admin user mail for account deletion. */
            /** 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
            $mail = $this->common_model->sendEmail(array($arr_user_detail[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
            /* Addmin the user in deleted list into file */
            $this->load->model('admin_model');
            $this->admin_model->updateDeletedUserFile($this->common_model->absolutePath(), intval($user_id));
        }
        if ($user_id) {
            /** deleting the selected user */
            $this->common_model->deleteRows(array($user_id), "mst_users", "user_id");
        }
        $this->session->set_userdata("msg", "<span class='success'>User deleted successfully!</span>");
        redirect(base_url() . 'backend/user-a/list');
    }

    /** Change user status */
    public function changeStatusA() {
        if ($this->input->post('user_id') != "") {
            /* updating the user status. */
            $arr_to_update = array(
                "user_status" => $this->input->post('user_status')
            );
            /* condition to update record for the user status */
            $condition_array = array('user_id' => intval($this->input->post('user_id')));
            $this->common_model->updateRow('mst_users', $arr_to_update, $condition_array);
            $this->load->model('admin_model');
            $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $this->input->post('user_status'), intval($this->input->post('user_id')));
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    
    #function to check existancs of username
    public function checkUserUsernameA() {
        if (isset($_POST['type'])) {
            #checking username already exist or not for edit user
            if (strtolower($this->input->post('user_name')) == strtolower($this->input->post('old_username'))) {
                echo "true";
            } else {
                $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_name', array("user_name" => mysql_real_escape_string($this->input->post('user_name'))));
                if (count($arr_user_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            #checking username already exist or not for add user
            $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_name', array("user_name" => mysql_real_escape_string($this->input->post('user_name'))));
            if (count($arr_user_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    #function to check existancs of user email

    public function checkUserEmailA() {
        if (isset($_POST['type'])) {
            #checking user email already exist or not for edit user
            if (strtolower($this->input->post('user_email')) == strtolower($this->input->post('old_email'))) {
                echo "true";
            } else {
                $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_email', array("user_email" => mysql_real_escape_string($this->input->post('user_email'))));
                if (count($arr_user_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            #checking user email already exist or not for add user
            $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_email', array("user_email" => mysql_real_escape_string($this->input->post('user_email'))));
            if (count($arr_user_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    #function to add new user from backend 

    public function addUserA() {
        #getting common data
        $data = $this->common_model->commonFunction();
        #checking user has privilige for the Manage Admin
        if (count($_POST) > 0) {
            if ($this->input->post('user_nws') == '1') {
                $user_newsletter = "1";
            } else {
                $user_newsletter = "0";
            }
            if ($this->input->post('btn_submit') != "") {
                $activation_code = time();
                #user record to add
                $image_data = array();
                if ($_FILES['profile_picture']['name'] != "") {
                    $config['upload_path'] = 'media/front/img/user-images/';
                    $config['file_name'] = $_FILES['profile_picture']['name'];
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '9000000';
                    $config['max_width'] = '12024';
                    $config['max_height'] = '7268';
                    $config['file_name'] = rand();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('profile_picture')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data["image_data"] = array('upload_data' => $this->upload->data());
                        $image_data = $this->upload->data();

                        for ($t = 0; $t < 2; $t++) {
                            if ($t == 0) {
                                $config = array(
                                    'source_image' => $image_data['full_path'],
                                    'new_image' => 'media/front/img/user-images/thumbs/',
                                    'create_thumb' => FALSE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 110,
                                    'height' => 110
                                );
                            } else {
                                $config = array(
                                    'source_image' => $image_data['full_path'],
                                    'new_image' => 'media/front/img/user-images/50/',
                                    'create_thumb' => FALSE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 50,
                                    'height' => 50
                                );
                            }

                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                        }
                    }
                }
                $birth_date = $this->input->post('year') . "-" . $this->input->post('month') . "-" . $this->input->post('day');
                $interest = implode(",", $this->input->post("interest_id"));
                $arr_to_insert = array(
                    "user_name" => $this->input->post('user_name'),
                    "first_name" => $this->input->post('first_name'),
                    "last_name" => $this->input->post('last_name'),
                    'gender' => $this->input->post('gender'),
                    "interest_id" => $interest,
                    'date_of_birth' => $birth_date,
                    'institute_id' => $this->input->post('institute_id'),
                    'institute_website' => $this->input->post('user_institute_website'),
                    'country_code' => $this->input->post('user_country_code'),
                    'profile_picture' => $image_data['file_name'],
                    "pin_code" => $this->input->post('pin_code'),
                    "user_email" => $this->input->post('user_email'),
                    "user_role" => '0',
                    "user_password" => base64_encode($this->input->post('user_password')),
                    'contact_no' => $this->input->post('user_contact_no'),
                    'user_registered' => $this->input->post('user_registered'),
                    "send_email_notification" => $user_newsletter,
                    'user_type' => "1",
                    'user_status' => '0',
                    'activation_code' => $activation_code,
                    'email_verified' => "0",
                    'role_id' => "0",
                    'register_date' => date("Y-m-d H:i:s")
                );
                #inserting user details into the database
                $last_insert_id = $this->common_model->insertRow($arr_to_insert, "mst_users");
                if ($_POST["other_interest"] == "1") {
                    $arr_to_insert_other_interest = array(
                        "user_id" => $last_insert_id,
                        "comment" => mysql_real_escape_string($this->input->post("new_interest")),
                        "status" => "0"
                    );
                    $this->common_model->insertRow($arr_to_insert_other_interest, "trans_temp_interest");
                }
                #Activation link 
                $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Activate Account</a>';
                #setting reserved_words for email content
                $macros_array_details = array();
                $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                $macros_array = array();
                foreach ($macros_array_details as $row) {
                    $macros_array[$row['macros']] = $row['value'];
                }
                $reserved_words = array(
                    "||SITE_TITLE||" => $data['global']['site_title'],
                    "||SITE_PATH||" => base_url(),
                    "||USER_NAME||" => $this->input->post('user_name'),
                    "||ADMIN_NAME||" => $this->input->post('user_name'),
                    "||USER_EMAIL||" => $this->input->post('user_email'),
                    "||PASSWORD||" => $this->input->post('user_password'),
                    "||ACTIVATION_LINK||" => $activation_link
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                #getting mail subect and mail message using email template title and lang_id and reserved works
                $email_content = $this->common_model->getEmailTemplateInfo('user-added-by-admin', 17, $reserved);
                #sending admin added mail to added admin mail id.
                #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                $this->session->set_userdata("msg", "<span class='success'>User added successfully!</span>");
                redirect(base_url() . "backend/user-a/list");
            }
        }
        $arr_privileges = array();
        #getting all privileges 
        $data['arr_interest'] = $this->common_model->getRecords('mst_categories', 'category_id,category_name', array("status" => "1", "parent_id" => "18"));
        $data['arr_institute_name'] = $this->common_model->getRecords('mst_users', 'user_id,name_of_institute', array("user_status" => "1", "user_role" => "1"));
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $data['title'] = "Add User A";
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $data['header'] = array('title' => 'Add User A');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/add', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to activate user account */

    public function activateAccountA($activation_code) {
        $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status');
        // get user details to verify the email address
        $arr_login_data = $this->common_model->getRecords("mst_users", $fields_to_pass, array("activation_code" => $activation_code));
        if (count($arr_login_data)) {
            #if email already verified
            if ($arr_login_data[0]['email_verified'] == 1) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your have already activated your account. Please login.</div>');
            } else {
                #if email not verified.
                $update_data = array('email_verified' => '1', 'user_status' => '1');
                $this->common_model->updateRow("mst_users", $update_data, array("activation_code" => $activation_code));
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your account has been activated successfully. Please login.</div>');
            }
        } else {
            #if any error invalid activation link found account
            $this->session->set_userdata('msg', '<div class="alert alert-error">Invalid activation code.</div>');
        }
        redirect(base_url() . "backend/login");
    }

    /* function to edit user details for the backend */

    public function editUserA($edit_id = '') {

        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if ($this->input->post('edit_id') != "") {
                $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($this->input->post('edit_id'))));
                // single row fix
                $arr_user_detail = end($arr_user_detail);
                #setting variable to update or add user record.
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    if ($this->input->post('user_status') != "") {
                        $status = $this->input->post('user_status');
                        $email_verified = '1';
                    } else {
                        $status = '0';
                        $email_verified = '0';
                    }
                    $activation_code = $arr_user_detail['activation_code'];
                } else {
                    $status = '0';
                    $email_verified = '0';
                    $activation_code = time();
                }
                if ($_FILES['profile_picture']['name'] != "") {
                    $old_image = $this->input->post("old_profile_picture");
                    $config['upload_path'] = 'media/front/img/user-images/';
                    @unlink($config['upload_path'] . $old_image);
                    @unlink($config['upload_path'] . "thumbs/" . $old_image);
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
                        $data["image_data"] = array('upload_data' => $this->upload->data());
                        $image_data = $this->upload->data();

                        for ($t = 0; $t < 2; $t++) {
                            if ($t == 0) {
                                $config = array(
                                    'source_image' => $image_data['full_path'],
                                    'new_image' => 'media/front/img/user-images/thumbs/',
                                    'create_thumb' => FALSE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 110,
                                    'height' => 110
                                );
                            } else {
                                $config = array(
                                    'source_image' => $image_data['full_path'],
                                    'new_image' => 'media/front/img/user-images/50/',
                                    'create_thumb' => FALSE,
                                    'maintain_ratio' => TRUE,
                                    'width' => 50,
                                    'height' => 50
                                );
                            }
                            $this->load->library('image_lib', $config);
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                        }
                    }
                    $profile_picture = $image_data['file_name'];
                } else {
                    $profile_picture = $this->input->post("old_profile_picture");
                }
                $birth_date = $this->input->post('year') . "-" . $this->input->post('month') . "-" . $this->input->post('day');
                if ($this->input->post('user_news') == '1') {
                    $user_newsletter = "1";
                } else {
                    $user_newsletter = "0";
                }
                $interest = implode(",", $this->input->post("interest_id"));
                if ($this->input->post('change_password') == 'on') {
                    $user_password = $_POST['user_password'];
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        'date_of_birth' => $birth_date,
                        'profile_picture' => $profile_picture,
                        "pin_code" => $this->input->post('pin_code'),
                        'institute_website' => $this->input->post('user_institute_website'),
                        'country_code' => $this->input->post('user_country_code'),
                        'contact_no' => $this->input->post('user_contact_no'),
                        'institute_id' => $this->input->post('institute_id'),
                        "interest_id" => $interest,
                        'user_registered' => $this->input->post('user_registered'),
                        "user_role" => '0',
                        "send_email_notification" => $user_newsletter,
                        "user_email" => $this->input->post('user_email'),
                        "user_password" => base64_encode($this->input->post('user_password')),
                        "user_status" => $status,
                        'email_verified' => $email_verified,
                        'gender' => $this->input->post('gender'),
                        'activation_code' => $activation_code,
                    );
                } else {
                    $user_password = base64_decode($arr_user_detail['user_password']);
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "user_email" => $this->input->post('user_email'),
                        'institute_id' => $this->input->post('institute_id'),
                        'country_code' => $this->input->post('user_country_code'),
                        'date_of_birth' => $birth_date,
                        'profile_picture' => $profile_picture,
                        "user_role" => '0',
                        "interest_id" => $interest,
                        "pin_code" => $this->input->post('pin_code'),
                        'contact_no' => $this->input->post('user_contact_no'),
                        'user_registered' => $this->input->post('user_registered'),
                        "send_email_notification" => $user_newsletter,
                        "user_status" => $status,
                        'gender' => $this->input->post('gender'),
                        'email_verified' => $email_verified,
                        'activation_code' => $activation_code,
                    );
                }
                /* if status blocked  by admin */
                if ($status == '2') {
                    $this->load->model('admin_model');
                    $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $status, intval($this->input->post('edit_id')));
                }
                /* if status activated by admin */
                if ($status == '1') {
                    $this->load->model('admin_model');
                    $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 1, intval($this->input->post('edit_id')));
                    $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $status, intval($this->input->post('edit_id')));
                }
                #updating the user details
                $this->common_model->updateRow("mst_users", $arr_to_update, array("user_id" => base64_decode($this->input->post('edit_id'))));
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    #sending account updating mail to user
                    $admin_login_link = '<a href="' . base_url() . '/signin" target="_new">Please login</a>';
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
                        "||ADMIN_NAME||" => $this->input->post('user_name'),
                        "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                        "||PASSWORD||" => $user_password,
                        "||ADMIN_LOGIN_LINK||" => $admin_login_link
                    );
                    $reserved = array_replace_recursive($macros_array, $reserved_words);
                    #getting mail subect and mail message using email template title and lang_id and reserved works
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-updated', 17, $reserved);
                    #sending the mail to deleting user
                    #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                    $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                } else {
                    $this->load->model('admin_model');
                    $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 0, intval($this->input->post('edit_id')));
                    #sending account verification link mail to user
                    $lang_id = 17;
                    $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Activate Account</a>';
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
                        "||ADMIN_NAME||" => $this->input->post('user_name'),
                        "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                        "||PASSWORD||" => $user_password,
                        "||ADMIN_ACTIVATION_LINK||" => $activation_link
                    );
                    $reserved = array_replace_recursive($macros_array, $reserved_words);
                    #getting mail subect and mail message using email template title and lang_id and reserved works
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-email-updated', 17, $reserved);
                    #sending the mail to deleting user
                    #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                    $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                }
                if ($_POST["other_interest"] == "1") {
                    $other_interest = $this->common_model->getRecords("trans_temp_interest", "*", array("user_id" => base64_decode($this->input->post("edit_id"))));
                    if (!empty($other_interest)) {
                        $arr_to_update_interest = array("comment" => mysql_real_escape_string($this->input->post("new_interest")));
                        $this->common_model->updateRow("trans_temp_interest", $arr_to_update_interest, array("user_id" => base64_decode($this->input->post("edit_id"))));
                    } else {
                        $arr_to_insert_interest = array("user_id" => base64_decode($this->input->post("edit_id")),
                            "comment" => mysql_real_escape_string($this->input->post("new_interest")),
                            "status" => "0");
                        $this->common_model->insertRow($arr_to_insert_interest, "trans_temp_interest");
                    }
                } else {
                    $this->common_model->deleteRows(array(base64_decode($this->input->post("edit_id"))), "trans_temp_interest", "user_id");
                }
                $this->session->set_userdata("msg", "<span class='success'>User updated successfully.</span>");
                redirect(base_url() . "backend/user-a/list");
            }
        }
        $arr_privileges = array();
        #getting all privileges 
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        #getting user details from $edit_id from function parameter
        $data['arr_admin_detail'] = $this->common_model->getRecords("mst_users", "", array("user_id" => intval(base64_decode($edit_id))));
        // single row fix
        $data['arr_admin_detail'] = end($data['arr_admin_detail']);
        $data['arr_institute_name'] = $this->common_model->getRecords('mst_users', 'user_id,name_of_institute', array("user_status" => "1", "user_role" => "1"));
        $data['arr_interest'] = $this->common_model->getRecords('mst_categories', 'category_id,category_name', array("status" => "1", "parent_id" => "18"));
        $data['arr_other_interest'] = $this->common_model->getRecords('trans_temp_interest', '*', array("user_id" => intval(base64_decode($edit_id))));
        $data['arr_other_interest'] = end($data['arr_other_interest']);
        $data['title'] = "Edit User A";
        $data['edit_id'] = $edit_id;
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $data['header'] = array('title' => 'Edit User A');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/edit', $data);
        $this->load->view('backend/sections/footer');
    }

    
    #function to display admin profile
    public function userProfileA($user_id) {
        $user_id = base64_decode($user_id);
        #using the user model
        $this->load->model('user_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        #getting all privileges 
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $data['arr_interest'] = $this->common_model->getRecords('mst_categories', 'category_id,category_name', array("status" => "1", "parent_id" => "18"));
        #getting user details from user id from function parameter        
        $data['arr_user_detail'] = $this->user_model->getUserDetailsA($user_id);
        // single row fix
        $data['arr_user_detail'] = end($data['arr_user_detail']);
        $data['arr_other_interest'] = $this->common_model->getRecords('trans_temp_interest', '*', array("user_id" => intval($user_id)));
        $data['arr_other_interest'] = end($data['arr_other_interest']);
        $data['header'] = array('title' => 'User A Profile ');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/user-profile', $data);
        $this->load->view('backend/sections/footer');
    }

    public function listUserB($all = 0, $pg = 0) {
        /** Getting Common data */
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_user_ids = $this->input->post('checkbox');
                if (count($arr_user_ids) > 0) {
                    foreach ($arr_user_ids as $user_id) {
                        #getting user details
                        $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
                        if (count($arr_user_detail) > 0) {
                            #setting reserved_words for email content
                            $lang_id = 17;
                            $macros_array_details = array();
                            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                            $macros_array = array();
                            foreach ($macros_array_details as $row) {
                                $macros_array[$row['macros']] = $row['value'];
                            }
                            $reserved_words = array("||SITE_TITLE||" => $data['global']['site_title'],
                                "||SITE_PATH||" => base_url(),
                                "||ADMIN_NAME||" => $arr_user_detail[0]['user_name']
                            );
                            $reserved = array_replace_recursive($macros_array, $reserved_words);
                            $template_title = 'admin-deleted';
                            #getting mail subject and mail message using email template title and lang_id and reserved works
                            $email_content = $this->common_model->getEmailTemplateInfo('admin-deleted', 17, $reserved);
                            #sending admin user mail for account deletion.
                            #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                            $mail = $this->common_model->sendEmail(array($arr_user_detail[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                            /* Addmin the user in deleted list into file */
                            $this->load->model('admin_model');
                            $this->admin_model->updateDeletedUserFile($this->common_model->absolutePath(), intval($user_id));
                        }
                    }
                    if (count($arr_user_ids) > 0) {
                        #deleting the user selected
                        $this->common_model->deleteRows($arr_user_ids, "mst_users", "user_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>User deleted successfully!</span>");
                }
            }
        }
        /* using the user model */
        $this->load->model('user_model');
        $data['title'] = "Manage User B";
        /* get all post to list. */
        /* Checking if search is happen */
        if ($all == 0) {
            if ($this->input->post('search_post') == "Submit") {
                $this->session->set_userdata('search_post_data', $_POST);
            }
            $data['arr_user_list'] = $this->user_model->getUserDetailsBySearchB($this->session->userdata('search_post_data'));
            $base_url = base_url() . 'backend/user-b/list/0';
        } else {
            /* Listing all users */
            $this->session->unset_userdata('search_post_data');
            $data['arr_user_list'] = $this->user_model->getUserDetailsB('');
            $base_url = base_url() . 'backend/user-b/list/10';
        }
        /* Getting the per page record from the global settings */
        $per_page_record = 25; //$data['global']['per_page_record'];
        /*
          Create pagination of all the records it required  parameter
          1. Total count of records
          2. baseurl for the links
          3. Page no which is loading
          4. Number of record for per page
          5. Number of "digit" links to show before/after the currently viewed page
         */
        $data['pagination_links'] = $this->common_model->createPagination(count($data['arr_user_list']), $base_url, $pg, $per_page_record, 2);
        if ($pg == "") {
            $pg1 = 0;
        } else {
            $pg1 = $pg - 1;
        }
        $from = intval(($pg1) * $per_page_record);
        if ($per_page_record == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($per_page_record);
        }
        $data['arr_user_list'] = array_slice($data['arr_user_list'], $from, $lenth);
        $data['header'] = array('title' => 'Manage User B');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/list-b', $data);
        $this->load->view('backend/sections/footer');
    }

    
    public function deleteUserB($user_id) {
        $user_id = base64_decode($user_id);
        /** Getting Common data */
        $data = $this->common_model->commonFunction();
        /** getting user details */
        $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
        if (count($arr_user_detail) > 0) {
            /** setting reserved_words for email content */
            $lang_id = 17;
            $macros_array_details = array();
            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_details as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            $reserved_words = array("||SITE_TITLE||" => $data['global']['site_title'],
                "||SITE_PATH||" => base_url(),
                "||ADMIN_NAME||" => $arr_user_detail[0]['user_name']
            );
            $reserved = array_replace_recursive($macros_array, $reserved_words);
            $template_title = 'admin-deleted';
            /** getting mail subject and mail message using email template title and lang_id and reserved works */
            $email_content = $this->common_model->getEmailTemplateInfo('admin-deleted', 17, $reserved);
            /** sending admin user mail for account deletion. */
            /** 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
            $mail = $this->common_model->sendEmail(array($arr_user_detail[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
            /* Addmin the user in deleted list into file */
            $this->load->model('admin_model');
            $this->admin_model->updateDeletedUserFile($this->common_model->absolutePath(), intval($user_id));
        }
        if ($user_id) {
            /** deleting the selected user */
            $this->common_model->deleteRows(array($user_id), "mst_users", "user_id");
        }
        $this->session->set_userdata("msg", "<span class='success'>User deleted successfully!</span>");
        redirect(base_url() . 'backend/user-b/list');
    }

    /** Change user status */
    public function changeStatusB() {
        if ($this->input->post('user_id') != "") {
            /* updating the user status. */
            $arr_to_update = array(
                "user_status" => $this->input->post('user_status')
            );
            /* condition to update record	for the user status */
            $condition_array = array('user_id' => intval($this->input->post('user_id')));
            $this->common_model->updateRow('mst_users', $arr_to_update, $condition_array);
            $this->load->model('admin_model');
            $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $this->input->post('user_status'), intval($this->input->post('user_id')));
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    #function to check existancs of username

    public function checkUserUsernameB() {
        if (isset($_POST['type'])) {
            #checking username already exist or not for edit user
            if (strtolower($this->input->post('user_name')) == strtolower($this->input->post('old_username'))) {
                echo "true";
            } else {
                $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_name', array("user_name" => mysql_real_escape_string($this->input->post('user_name'))));
                if (count($arr_user_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            #checking username already exist or not for add user
            $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_name', array("user_name" => mysql_real_escape_string($this->input->post('user_name'))));
            if (count($arr_user_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    /* function to check existancs of user email */

    public function checkUserEmailB() {
        if (isset($_POST['type'])) {
            #checking user email already exist or not for edit user
            if (strtolower($this->input->post('user_email')) == strtolower($this->input->post('old_email'))) {
                echo "true";
            } else {
                $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_email', array("user_email" => mysql_real_escape_string($this->input->post('user_email'))));
                if (count($arr_user_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            #checking user email already exist or not for add user
            $arr_user_detail = $this->common_model->getRecords('mst_users', 'user_email', array("user_email" => mysql_real_escape_string($this->input->post('user_email'))));
            if (count($arr_user_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    public function addUserB() {
        #getting common data
        $data = $this->common_model->commonFunction();
        $activation_code = time();
        if (count($_POST) > 0) {
            if ($this->input->post('btn_submit') != "") {
                $arr_to_insert = array(
                    "user_name" => $this->input->post('user_name'),
                    "name_of_institute" => $this->input->post('name_of_institute'),
                    "address_1" => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    'user_city' => $this->input->post('user_city'),
                    'institute_type' => $this->input->post('institute_type'),
                    'name_of_founder' => $this->input->post('name_of_founder'),
                    "pin_code" => $this->input->post('pin_code'),
                    'institute_website' => $this->input->post('user_institute_website'),
                    'country_code' => $this->input->post('user_country_code'),
                    "established_in" => $this->input->post('established_in'),
                    "user_email" => $this->input->post('user_email'),
                    "user_role" => '1',
                    "user_password" => base64_encode($this->input->post('user_password')),
                    'contact_no' => $this->input->post('user_contact_no'),
                    'user_type' => "1",
                    'user_status' => '0',
                    'activation_code' => $activation_code,
                    'email_verified' => "0",
                    'role_id' => "0",
                    'register_date' => date("Y-m-d H:i:s")
                );
                #inserting user details into the database
                $last_insert_id = $this->common_model->insertRow($arr_to_insert, "mst_users");
                #Activation link 
                $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Activate Account</a>';
                #setting reserved_words for email content
                $macros_array_details = array();
                $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                $macros_array = array();
                foreach ($macros_array_details as $row) {
                    $macros_array[$row['macros']] = $row['value'];
                }
                $reserved_words = array(
                    "||SITE_TITLE||" => $data['global']['site_title'],
                    "||SITE_PATH||" => base_url(),
                    "||USER_NAME||" => $this->input->post('user_name'),
                    "||ADMIN_NAME||" => $this->input->post('user_name'),
                    "||USER_EMAIL||" => $this->input->post('user_email'),
                    "||PASSWORD||" => $this->input->post('user_password'),
                    "||ACTIVATION_LINK||" => $activation_link
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                #getting mail subect and mail message using email template title and lang_id and reserved works
                $email_content = $this->common_model->getEmailTemplateInfo('user-added-by-admin', 17, $reserved);
                #sending admin added mail to added admin mail id.
                #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                $this->session->set_userdata("msg", "<span class='success'>User added successfully!</span>");
                redirect(base_url() . "backend/user-b/list");
            }
        }
        $arr_privileges = array();
        #getting all privileges 
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $data['title'] = "Add User B";
        $data['arr_country'] = $this->common_model->getRecords("mst_country");
        $data['arr_institute_type'] = $this->common_model->getRecords("mst_institute_type", "*", array("institute_type_status" => "1"));
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $data['header'] = array('title' => 'Add User B');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/add-b', $data);
        $this->load->view('backend/sections/footer');
    }

    public function editUserB($edit_id = '') {
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if ($this->input->post('edit_id') != "") {
                $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($this->input->post('edit_id'))));
                // single row fix
                $arr_user_detail = end($arr_user_detail);
                #setting variable to update or add user record.
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    if ($this->input->post('user_status') != "") {
                        $status = $this->input->post('user_status');
                        $email_verified = '1';
                    } else {
                        $status = '0';
                        $email_verified = '0';
                    }
                    $activation_code = $arr_user_detail['activation_code'];
                } else {
                    $status = '0';
                    $email_verified = '0';
                    $activation_code = time();
                }
                if ($this->input->post('change_password') == 'on') {
                    $user_password = $_POST['user_password'];
                    #if password need to change
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "name_of_institute" => $this->input->post('name_of_institute'),
                        "address_1" => $this->input->post('address_1'),
                        'address_2' => $this->input->post('address_2'),
                        'country_id' => $this->input->post('country_id'),
                        'state_id' => $this->input->post('state_id'),
                        'user_city' => $this->input->post('user_city'),
                        'institute_type' => $this->input->post('institute_type'),
                        'name_of_founder' => $this->input->post('name_of_founder'),
                        'institute_website' => $this->input->post('user_institute_website'),
                        'country_code' => $this->input->post('user_country_code'),
                        "established_in" => $this->input->post('established_in'),
                        "pin_code" => $this->input->post('pin_code'),
                        'contact_no' => $this->input->post('user_contact_no'),
                        "user_role" => '1',
                        "send_email_notification" => $user_newsletter,
                        "user_email" => $this->input->post('user_email'),
                        "user_password" => base64_encode($this->input->post('user_password')),
                        "user_status" => $status,
                        'email_verified' => $email_verified,
                        'gender' => $this->input->post('gender'),
                        'activation_code' => $activation_code,
                    );
                } else {
                    $user_password = base64_decode($arr_user_detail['user_password']);
                    #if passwording need not need to change
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "name_of_institute" => $this->input->post('name_of_institute'),
                        "address_1" => $this->input->post('address_1'),
                        'address_2' => $this->input->post('address_2'),
                        'country_id' => $this->input->post('country_id'),
                        'state_id' => $this->input->post('state_id'),
                        'user_city' => $this->input->post('user_city'),
                        'institute_type' => $this->input->post('institute_type'),
                        'name_of_founder' => $this->input->post('name_of_founder'),
                        'institute_website' => $this->input->post('user_institute_website'),
                        'country_code' => $this->input->post('user_country_code'),
                        "pin_code" => $this->input->post('pin_code'),
                        "established_in" => $this->input->post('established_in'),
                        'contact_no' => $this->input->post('user_contact_no'),
                        "user_role" => '1',
                        "user_email" => $this->input->post('user_email'),
                        "pin_code" => $this->input->post('pin_code'),
                        'contact_no' => $this->input->post('user_contact_no'),
                        'user_registered' => $this->input->post('user_registered'),
                        "send_email_notification" => $user_newsletter,
                        "user_status" => $status,
                        'gender' => $this->input->post('gender'),
                        'email_verified' => $email_verified,
                        'activation_code' => $activation_code,
                    );
                }
                /* if status blocked  by admin */
                if ($status == '2') {
                    $this->load->model('admin_model');
                    $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $status, intval($this->input->post('edit_id')));
                }
                /* if status activated by admin */
                if ($status == '1') {
                    $this->load->model('admin_model');
                    $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 1, intval($this->input->post('edit_id')));
                    $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $status, intval($this->input->post('edit_id')));
                }
                #updating the user details
                $this->common_model->updateRow("mst_users", $arr_to_update, array("user_id" => $this->input->post('edit_id')));
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    #sending account updating mail to user
                    $admin_login_link = '<a href="' . base_url() . '/signin" target="_new">Please login</a>';
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
                        "||ADMIN_NAME||" => $this->input->post('user_name'),
                        "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                        "||PASSWORD||" => $user_password,
                        "||ADMIN_LOGIN_LINK||" => $admin_login_link
                    );
                    $reserved = array_replace_recursive($macros_array, $reserved_words);

                    #getting mail subect and mail message using email template title and lang_id and reserved works
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-updated', 17, $reserved);
                    #sending the mail to deleting user
                    #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                    $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                } else {
                    $this->load->model('admin_model');
                    $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 0, intval($this->input->post('edit_id')));
                    #sending account verification link mail to user
                    $lang_id = 17;
                    $activation_link = '<a href="' . base_url() . 'user-activation/' . $activation_code . '">Activate Account</a>';
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
                        "||ADMIN_NAME||" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                        "||PASSWORD||" => $user_password,
                        "||ADMIN_ACTIVATION_LINK||" => $activation_link
                    );
                    $reserved = array_replace_recursive($macros_array, $reserved_words);
                    #getting mail subect and mail message using email template title and lang_id and reserved works
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-email-updated', 17, $reserved);
                    #sending the mail to deleting user
                    #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                    $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                }
                $this->session->set_userdata("msg", "<span class='success'>User updated successfully.</span>");
                redirect(base_url() . "backend/user-b/list");
            }
        }
        $arr_privileges = array();
        #getting all privileges 
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        #getting user details from $edit_id from function parameter
        $data['arr_admin_detail'] = $this->common_model->getRecords("mst_users", "", array("user_id" => intval(base64_decode($edit_id))));
        // single row fix
        $data['arr_admin_detail'] = end($data['arr_admin_detail']);

        $data['edit_id'] = $edit_id;
        $data['arr_country'] = $this->common_model->getRecords("mst_country");
        $country_id = $data['arr_admin_detail']["country_id"];
        $data['arr_states'] = $this->user_model->getStates($country_id);
        $data['arr_institute_type'] = $this->common_model->getRecords("mst_institute_type", "*", array("institute_type_status" => "1"));
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $data['header'] = array('title' => 'Edit User B');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/edit-b', $data);
        $this->load->view('backend/sections/footer');
    }

    public function activateAccountB($activation_code) {
        $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status');
        // get user details to verify the email address
        $arr_login_data = $this->common_model->getRecords("mst_users", $fields_to_pass, array("activation_code" => $activation_code));
        if (count($arr_login_data)) {
            #if email already verified
            if ($arr_login_data[0]['email_verified'] == 1) {
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your have already activated your account. Please login.</div>');
            } else {
                #if email not verified.
                $update_data = array('email_verified' => '1', 'user_status' => '1');
                $this->common_model->updateRow("mst_users", $update_data, array("activation_code" => $activation_code));
                $this->session->set_userdata('msg', '<div class="alert alert-success">Your account has been activated successfully. Please login.</div>');
            }
        } else {
            #if any error invalid activation link found account
            $this->session->set_userdata('msg', '<div class="alert alert-error">Invalid activation code.</div>');
        }
        redirect(base_url() . "backend/login");
    }

    public function userProfileB($user_id) {
        $user_id = base64_decode($user_id);
        #using the user model
        $this->load->model('user_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        #getting all privileges 
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        #getting user details from user id from function parameter        
        $data['arr_user_detail'] = $this->user_model->getUserDetailsB($user_id);
        // single row fix
        $data['arr_user_detail'] = end($data['arr_user_detail']);
        $data['header'] = array('title' => 'User B Profile');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/user-profile-b', $data);
        $this->load->view('backend/sections/footer');
    }

    public function bulkUploadUser() {
        #getting common data
        $data = $this->common_model->commonFunction();
        #checking user has privilige for the Manage Admin
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        #getting all privileges 
        $data['title'] = "Bulk Upload Users";
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['header'] = array('title' => 'Bulk Upload Users');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/bulk-upload-user', $data);
    }

    public function bulkUploadUserAction() {
        #getting common data
        $data = $this->common_model->commonFunction();
        $user_account = $this->session->userdata('user_account');
        $this->load->library('upload');
        $this->load->helper('file');
        $this->upload->set_allowed_types('*');
        $config['upload_path'] = './media/backend/bulk-upload-files/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 0;
        $config['file_name'] = rand();
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file_source')) {
            echo $this->upload->display_errors();
            $this->session->set_userdata('msg', 'Please select xls File only!');
            redirect(base_url() . 'institute/add-User-list');
        } else {
            $file_data = $this->upload->data();
            chmod($file_data['full_path'], 0777);
        }
        header('Content-Type: text/plain');
        $Filepath = "media/backend/bulk-upload-files/" . $file_data['file_name'];
        require('php-excel-reader/excel_reader2.php');
        require('SpreadsheetReader.php');
        date_default_timezone_set('UTC');
        $StartMem = memory_get_usage();
        try {
            $Spreadsheet = new SpreadsheetReader($Filepath);
            $BaseMem = memory_get_usage();
            $Sheets = $Spreadsheet->Sheets();
            foreach ($Sheets as $Index => $Name) {
                $Time = microtime(true);
                $Spreadsheet->ChangeSheet($Index);
                foreach ($Spreadsheet as $Key => $Row) {
                    if ($Row) {
                        if ($Key != 1) {// For first line
                            //Check Duplicate Email already exit
                            $arr_user_email = $this->common_model->getRecords("mst_users", "user_email", array("user_email" => $Row[2]));
                            $arr_user_email_temp = $this->common_model->getRecords("trans_temp_users", "user_email", array("user_email" => $Row[2]));
                            if (count($arr_user_email) <= 0) { //[Start Chk User Email]
                                if (count($arr_user_email_temp) <= 0) { //[Start Chk User Email Temp]
                                    $arr_to_insert = array(
                                        "from_user_id" => $user_account['user_id'],
                                        "first_name" => $Row[0],
                                        "last_name" => $Row[1],
                                        "user_email" => $Row[2],
                                        "date_time" => date("Y-m-d H:i:s"),
                                    );
                                    #inserting user details into the database
                                    $insert_id = $this->common_model->insertRow($arr_to_insert, 'trans_temp_users');
                                }//[End Chk User Email Temp]
                            }//[End Chk User Email]
                        }
                    } else {
                        var_dump($Row);
                    }
                    $CurrentMem = memory_get_usage();
                }
                if ($insert_id != '') { // Send Email to admin
                    $new_user_link = '<a href="' . base_url() . 'backend/user-a/list/1">New User List</a>';
                    $reserved_words = array(
                        "||SITE_TITLE||" => $data['global']['site_title'],
                        "||SITE_PATH||" => base_url(),
                        "||USER_NAME||" => $user_account['user_name'],
                        "||NEW_USER_LINK||" => $new_user_link,
                    );
                    $email_content = $this->common_model->getEmailTemplateInfo('new-user-added-by-user-b', 17, $reserved_words);
                    #sending admin added mail to added admin mail id.
                    #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
                    $mail = $this->common_model->sendEmail(array($data['global']['site_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                }
            }

            $this->session->set_userdata('msg', 'The excel file has been uploaded successfully, please wait for approval by MYAutobiography.in');
            redirect(base_url() . 'institute/add-User-list');
        } catch (Exception $E) {
            echo $E->getMessage();
        }
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userA-list', $data);
    }

    public function listNewUploadedUser($all = 0, $pg = 0) {
        /*
         * Getting Common data
         */
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_user_ids = $this->input->post('checkbox');
                if (count($arr_user_ids) > 0) {

                    #deleting the user selected
                    $this->common_model->deleteRows($arr_user_ids, "trans_temp_users", "temp_id");
                    $this->session->set_userdata("msg", "<span class='success'>User deleted successfully!</span>");
                }
            }
        }
        /* using the user model */
        $this->load->model('user_model');
        $data['title'] = "Manage New User";
        /* get all post to list. */
        if ($all == 0) {
            if ($this->input->post('search_post') == "Submit") {
                $this->session->set_userdata('search_post_data', $_POST);
            }
            $data['arr_user_list'] = $this->user_model->getNewUserDetailsBySearch($this->session->userdata('search_post_data'));
            $base_url = base_url() . 'backend/user-a/list/0';
        } else {
            /* Listing all users */
            $this->session->unset_userdata('search_post_data');
            $data['arr_user_list'] = $this->user_model->getNewUserDetails();
            $base_url = base_url() . 'backend/new-user/list/10';
        }
        /* Getting the per page record from the global settings */
        $per_page_record = 25; //$data['global']['per_page_record'];
        /*
          Create pagination of all the records it required  parameter
          1. Total count of records
          2. baseurl for the links
          3. Page no which is loading
          4. Number of record for per page
          5. Number of "digit" links to show before/after the currently viewed page
         */
        $data['pagination_links'] = $this->common_model->createPagination(count($data['arr_user_list']), $base_url, $pg, $per_page_record, 2);
        if ($pg == "") {
            $pg1 = 0;
        } else {
            $pg1 = $pg - 1;
        }

        $from = intval(($pg1) * $per_page_record);
        if ($per_page_record == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($per_page_record);
        }
        $data['arr_user_list'] = array_slice($data['arr_user_list'], $from, $lenth);
//        echo '<pre>';print_r($data['arr_user_list']);die;
        //$this->load->view('backend/user/new-list', $data);
        $data['header'] = array('title' => 'Manage New User');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/user/new-list', $data);
        $this->load->view('backend/sections/footer');
    }

    
    public function NewUserSendActivation($temp_id) {

//        $arr_user_ids = $this->input->post('checkbox');
        

//        foreach($arr_user_ids as $temp_id) {
            
       echo  $temp_id = base64_decode($temp_id);
        $data = $this->common_model->commonFunction();
        $activation_code = time() . $temp_id;
        $arr_to_update = array(
            "activation_code" => $activation_code,
            "user_password" => '1234' . $temp_id . '',
            "send_link" => '1'
        );
        
        $condition_array = array('temp_id' => $temp_id);
        $this->common_model->updateRow('trans_temp_users', $arr_to_update, $condition_array);
        $arr_user = $this->common_model->getRecords("trans_temp_users", "from_user_id,first_name,last_name,user_email,user_password,activation_code", array("temp_id" => $temp_id));
        $arr_institute_user = $this->common_model->getRecords("mst_users", "user_id,first_name,last_name,user_email,user_password,activation_code", array("user_id" => $arr_user[0]['from_user_id']));

        #sending Activation link to user
        $activation_link = '<a href="' . base_url() . 'new-user-activation/' . $arr_user[0]['activation_code'] . '" target="_new">Click</a>';
//        $activation_link_institute = '<a href="' . base_url() . 'user-activation/' . $arr_institute_user[0]['activation_code'] . '" target="_new">Click</a>';
        
        $macros_array_details = array();
        $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
        $macros_array = array();
        foreach ($macros_array_details as $row) {
            $macros_array[$row['macros']] = $row['value'];
        }
        $reserved_words = array(
            "||SITE_TITLE||" => $data['global']['site_title'],
            "||SITE_PATH||" => base_url(),
            "||USER_NAME||" => $arr_user[0]['user_name'],
            "||USER_EMAIL||" => $arr_user[0]['user_email'],
            "||PASSWORD||" => $arr_user[0]['user_password'],
            "||NEW_USER_LINK||" => $activation_link
        );
        
        $reserved_words_institute = array(
            "||SITE_TITLE||" => $data['global']['site_title'],
            "||SITE_PATH||" => base_url(),
            "||USER_NAME||" => $arr_institute_user[0]['user_name'],
            "||USER_EMAIL||" => $arr_institute_user[0]['user_email'],
            "||PASSWORD||" => base64_decode($arr_institute_user[0]['user_password']),
//            "||NEW_USER_LINK||" => $activation_link_institute
        );
        
        
        
        $reserved = array_replace_recursive($macros_array, $reserved_words);
        $reserved1 = array_replace_recursive($macros_array, $reserved_words_institute);
        
        #getting mail subect and mail message using email template title and lang_id and reserved works
        $email_content = $this->common_model->getEmailTemplateInfo('new-user-activation-link', 17, $reserved);
        $email_content_institute = $this->common_model->getEmailTemplateInfo('new-institute-activation-link', 17, $reserved1);
        #sending the mail to deleting user
        #1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
        $mail = $this->common_model->sendEmail(array($arr_user[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
        $mail1 = $this->common_model->sendEmail(array($arr_institute_user[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content_institute['subject'], $email_content_institute['content']);
//         }
        $this->session->set_userdata("msg", "<span class='success'>Activation link sent successfully!</span>");
        redirect(base_url() . 'backend/new-user/list');
    }

}
