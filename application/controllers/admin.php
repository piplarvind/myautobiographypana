<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {
    /*     * * 
     * An Controller having functions to manage admin user login,add edit, forgot password, profile and activating user account
     * * */

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /* function for admin login  */

    public function index() {

        if ($this->common_model->isLoggedIn()) {
            $user_account = $this->session->userdata('user_account');
            if ($user_account['user_type'] != 2) {
                redirect(base_url());
            }
            redirect(base_url() . "backend/dashboard");
        }
        if (count($_POST) > 0) {
            $arr_admin_details_with_username = $this->common_model->getRecords("mst_users", "*", array("user_name" => $this->input->post('user_name')));
            if (count($arr_admin_details_with_username) > 0) {

                /* admin details with user_name and user_password : */
                $arr_admin_details_username_password = $this->common_model->getRecords("mst_users", "*", array("user_name" => $this->input->post('user_name'), "user_password" => base64_encode($this->input->post('user_password'))), '', '', 0);
                if (count($arr_admin_details_username_password) > 0) {
                    if ($arr_admin_details_username_password[0]['user_status'] == 1) {
                        /* addding user data into the session */
                        $user_account['user_id'] = $arr_admin_details_username_password[0]['user_id'];
                        $user_account['user_name'] = stripslashes($arr_admin_details_username_password[0]['user_name']);
                        $user_account['user_email'] = $arr_admin_details_username_password[0]['user_email'];
                        $user_account['user_type'] = $arr_admin_details_username_password[0]['user_type'];
                        $user_account['role_id'] = $arr_admin_details_username_password[0]['role_id'];
                        $user_account['first_name'] = stripslashes($arr_admin_details_username_password[0]['first_name']);
                        $user_account['last_name'] = stripslashes($arr_admin_details_username_password[0]['last_name']);
                        $user_account['admin_image'] = stripslashes($arr_admin_details_username_password[0]['profile_picture']);
                        $arr_privileges = $this->common_model->getRecords('trans_role_privileges', 'privilege_id', array("role_id" => $arr_admin_details_username_password[0]['role_id']));
                        /* serializing the user privilegse and setting into the session. While ussing user privileges use unserialize this session to get user privileges */
                        if (count($arr_privileges) > 0) {
                            foreach ($arr_privileges as $privilege) {
                                $user_privileges[] = $privilege['privilege_id'];
                            }
                        } else {
                            $user_privileges = array();
                        }
                        $user_account['user_privileges'] = serialize($user_privileges);
                        $this->session->set_userdata('user_account', $user_account);
                        $user_account = $this->session->userdata('user_account');
                        redirect("backend/home");
                    } else if ($arr_admin_details_username_password[0]['user_status'] == 2) {
                        /* user account is blocked by admin */
                        /* getting all blocked user from file */
                        $absolute_path = $this->common_model->absolutePath();
                        if (file_exists($absolute_path . "media/front/user-status/blocked-user")) {
                            $blocked_user = $this->common_model->read_file($absolute_path . "media/front/user-status/blocked-user");
                            if (in_array($arr_admin_details_username_password[0]['user_id'], $blocked_user)) {
                                /* removing the user from the bloked file list */
                                $key = array_search($arr_admin_details_username_password[0]['user_id'], $blocked_user);
                                if ($key !== false) {
                                    unset($blocked_user[$key]);
                                }
                                $this->common_model->write_file($absolute_path . "media/front/user-status/blocked-user", $blocked_user);
                            }
                        }
                        $error_msg = '<strong>Sorry!</strong> Your account has been blocked by Administrator.';
                        $this->session->set_userdata('error_msg', $error_msg);
                        redirect("backend/login");
                    } else if ($arr_admin_details_username_password[0]['user_status'] == 0) {
                        /* user account is in inactive status  */
                        $error_msg = 'Please activate your account through link provided on your email address.';
                        $this->session->set_userdata('error_msg', $error_msg);
                        redirect("backend/login");
                    }
                } else {
                    /* alerting message for invalid password */
                    $error_msg = '<strong>Sorry!</strong> Invalid password.';
                    $this->session->set_userdata('error_msg', $error_msg);
                    redirect("backend/login");
                }
            } else {
                /* alerting message for invalid usename */
                $error_msg = '<strong>Sorry!</strong> Invalid username.';
                $this->session->set_userdata('error_msg', $error_msg);
                redirect("backend/login");
            }
        }
        $data['global'] = $this->common_model->getGlobalSettings();
        $data['get_admin_image'] = $this->common_model->getRecords("mst_users", "profile_picture", array("role_id" => '1'));
        $data['header'] = array('title' => 'Login To Admin Panel');
        $this->load->view('backend/log-in/login', $data);
    }

    /* function for admin dashbaord */

    public function home() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $user_account = $this->session->userdata('user_account');
        $data = $this->common_model->commonFunction();
        $data['title'] = "Dashboard";
        $data['current_page_path'] = '<div class="breadcrumbDivider"></div><a class="current">Dashboard</a>';
        /* geting logged in admin details */
        $data['arr_admin_details_with_username'] = $this->common_model->getRecords('mst_users', '', array('user_type' => 2));
        /* getting total count of admin */
        $data['totalCount'] = count($data['arr_admin_details_with_username']);
        //Notification
        $data['arr_notification'] = $this->common_model->getNotification();
        $data['header'] = array('title' => 'Dashboard');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/index');
        $this->load->view('backend/sections/footer');
    }

    /* function for logour user from admin panel.	 */

    public function logout() {
        /* unseting the user session data. */
        $this->session->unset_userdata("user_account");
        redirect(base_url() . "backend/login");
    }

    /* function for admin forgot password functionality */

    public function forgotPassword() {
        if (count($_POST) > 0) {
            if ($_POST['btn_submit'] == 'Submit') {
                /* getting admin details if exist from email */
                $arr_admin_detail = $this->common_model->getRecords("mst_users", '', array("user_email" => $this->input->post('user_email')));
                $arr_admin_detail = end($arr_admin_detail);
                if (count($arr_admin_detail) > 0) {
                    $data['global'] = $this->common_model->getGlobalSettings();
                    /* sending admin credentail on admin account mail on user email */
                    $lang_id = 17;
                    $admin_login_link = '<a href="' . base_url() . 'backend/login" target="_new">Log in to ' . $data['global']['site_title'] . ' administration</a>';
                    /* setting reserved_words for email content */
                    $reserved_words = array(
                        "||SITE_TITLE||" => $data['global']['site_title'],
                        "||SITE_PATH||" => base_url(),
                        "||USER_NAME||" => $arr_admin_detail['user_name'],
                        "||ADMIN_NAME||" => $arr_admin_detail['first_name'] . ' ' . $arr_admin_detail['last_name'],
                        "||ADMIN_EMAIL||" => $arr_admin_detail['user_email'],
                        "||PASSWORD||" => base64_decode($arr_admin_detail['user_password']),
                        "||ADMIN_LOGIN_LINK||" => $admin_login_link
                    );

                    /* getting mail subect and mail message using email template title and lang_id and reserved works */
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-forgot-password', 17, $reserved_words);
                    /* sending admin user mail for forgot password */
                    /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                    $mail = $this->common_model->sendEmail(array($arr_admin_detail['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                    if ($mail) {
                        $this->session->set_userdata('success_msg', 'Your login details has been sent successfully.');
                        redirect(base_url() . "backend/login");
                        exit;
                    } else {
                        $this->session->set_userdata('error_msg', 'Error occurred during sending mail, please try latter.');
                        redirect(base_url() . "backend/forgot-password");
                        exit;
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Your email is not registered with us.');
                    redirect(base_url() . "backend/forgot-password");
                    exit;
                }
            }
        }
        $data['get_admin_image'] = $this->common_model->getRecords("mst_users", "profile_picture", array("role_id" => '1'));
        $data['global'] = $this->common_model->getGlobalSettings();
        $data['header'] = array('title' => 'Forgot Password');
        $this->load->view('backend/log-in/forgot-password', $data);
    }

    public function checkForgotPasswordEmail() {
        /* checking email is exist or not for forgot password email entry */
        $arr_admin_detail = $this->common_model->getRecords('mst_users', "", array("user_email" => $this->input->post('user_email')));
        if (count($arr_admin_detail) == 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

    /* function to list all the roles */

    public function listAdmin() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            /* an admin which is not super admin not privileges to access Manage Role */
            /* setting session for displaying notiication message. */
            $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage admin.</span>");
            redirect(base_url() . "backend/home");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                /* getting all ides selected */
                $arr_user_ids = $this->input->post('checkbox');
                if (count($arr_user_ids) > 0) {
                    foreach ($arr_user_ids as $user_id) {
                        /* getting admin details */
                        $arr_admin_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($user_id)));
                        $macros_array_details = array();
                        $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                        $macros_array = array();
                        foreach ($macros_array_details as $row) {
                            $macros_array[$row['macros']] = $row['value'];
                        }
                        if (count($arr_admin_detail) > 0) {
                            /* setting reserved_words for email content */
                            $lang_id = 17;
                            $reserved_words = array("||SITE_TITLE||" => $data['global']['site_title'],
                                "||SITE_PATH||" => base_url(),
                                "||ADMIN_NAME||" => $arr_admin_detail[0]['first_name'] . ' ' . $arr_admin_detail[0]['last_name']
                            );
                            $reserved = array_replace_recursive($macros_array, $reserved_words);
                            $template_title = 'admin-deleted';
                            /* getting mail subject and mail message using email template title and lang_id and reserved works */
                            $email_content = $this->common_model->getEmailTemplateInfo('admin-deleted', 17, $reserved);
                            /* sending admin user mail for account deletion. */
                            /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                            $mail = $this->common_model->sendEmail(array($arr_admin_detail[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                            /* Addmin the user in deleted list into file */
                            $this->load->model('admin_model');
                            $this->admin_model->updateDeletedUserFile($this->common_model->absolutePath(), intval($user_id));
                        }
                    }
                    if (count($arr_user_ids) > 0) {
                        /* deleting the admin selected */
                        $this->common_model->deleteRows($arr_user_ids, "mst_users", "user_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Admin deleted successfully.</span>");
                }
            }
        }
        /* using the admin model */
        $this->load->model('admin_model');
        $data['arr_admin_list'] = $this->admin_model->getAdminDetails('');
        $data['header'] = array('title' => 'Manage Super Admin');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/admin/list', $data);
        $this->load->view('backend/sections/footer');
    }

    public function changeStatus() {
        if ($this->input->post('user_id') != "") {
            /* updating the user status. */
            $arr_to_update = array("user_status" => $this->input->post('user_status'));
            /* condition to update record	for the admin status */
            $condition_array = array('user_id' => intval($this->input->post('user_id')));
            /* updating the global setttings parameter value into database */
            $this->common_model->updateRow('mst_users', $arr_to_update, $condition_array);
            /* Addmin the user in bloked list into file */
            $this->load->model('admin_model');
            $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $this->input->post('user_status'), intval($this->input->post('user_id')));
            echo json_encode(array("error" => "0", "error_message" => ""));
        } else {
            /* if something going wrong providing error message.  */
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    /* function to check existancs of user name */

    public function checkAdminUsername() {
        if (isset($_POST['type'])) {
            /* checking admin user name already exist or not for edit Admin */
            if (strtolower($this->input->post('user_name')) == strtolower($this->input->post('old_username'))) {
                echo "true";
            } else {
                $arr_admin_detail = $this->common_model->getRecords('mst_users', 'user_name', array("user_name" => mysql_real_escape_string($this->input->post('user_name'))));
                if (count($arr_admin_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            /* checking admin user name already exist or not for add admin  */
            $arr_admin_detail = $this->common_model->getRecords('mst_users', 'user_name', array("user_name" => mysql_real_escape_string($this->input->post('user_name'))));
            if (count($arr_admin_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    /* function to check existancs of user email */

    public function checkAdminEmail() {
        if (isset($_POST['type'])) {
            /* checking admin email already exist or not for edit Admin */
            if (strtolower($this->input->post('user_email')) == strtolower($this->input->post('old_email'))) {
                echo "true";
            } else {
                $arr_admin_detail = $this->common_model->getRecords('mst_users', 'user_email', array("user_email" => mysql_real_escape_string($this->input->post('user_email'))));
                if (count($arr_admin_detail) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            /* checking admin email already exist or not for add admin */
            $arr_admin_detail = $this->common_model->getRecords('mst_users', 'user_email', array("user_email" => mysql_real_escape_string($this->input->post('user_email'))));
            if (count($arr_admin_detail) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    /* function to add new admin user from backend  */

    public function addAdmin() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* getting common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            /* an admin which is not super admin not privileges to access Manage Admin */
            /* setting session for displaying notiication message. */
            $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage admin.</span>");
            redirect(base_url() . "backend/home");
        }
        if (count($_POST) > 0) {
            if ($this->input->post('btn_submit') != "") {
                if ($_FILES['upload_profile_photo']['name'] != "") {
                    $config['upload_path'] = './media/backend/images/admin_user/';
                    $config['allowed_types'] = 'jpeg|JPEG|png|PNG|gif|GIF|jpg';
                    $config['file_name'] = time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_profile_photo')) {
                        $this->session->set_userdata('error_message', 'image_uploading_error!');
                        redirect(base_url() . 'backend/admin/add');
                    } else {
                        $this->load->library('image_lib');
                        $image_details = array('upload_data' => $this->upload->data());
                        $image_data = $this->upload->data();
                        $file_name = $image_data['file_name'];
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
                $activation_code = time();
                /* user record to add */
                $arr_to_insert = array(
                    "user_name" => $this->input->post('user_name'),
                    "first_name" => $this->input->post('first_name'),
                    "last_name" => $this->input->post('last_name'),
                    "user_email" => $this->input->post('user_email'),
                    "user_password" => base64_encode($this->input->post('user_password')),
                    'gender' => $this->input->post('gender'),
                    'user_type' => '2',
                    'user_status' => '0',
                    'activation_code' => $activation_code,
                    'email_verified' => '0',
                    'role_id' => $this->input->post('role_id'),
                    'register_date' => date("Y-m-d H:i:s"),
                    'profile_picture' => $file_name
                );
                /* inserting admin details into the dabase */
                $last_insert_id = $this->common_model->insertRow($arr_to_insert, "mst_users");
                /* Activation link  */
                $activation_link = '<a href="' . base_url() . 'backend/admin/account-activate/' . $activation_code . '">Activate Account</a>';
                /* setting reserved_words for email content */
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
                    "||ADMIN_NAME||" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                    "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                    "||PASSWORD||" => $this->input->post('user_password'),
                    "||ADMIN_ACTIVATION_LINK||" => $activation_link
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                /* getting mail subect and mail message using email template title and lang_id and reserved works */
                $email_content = $this->common_model->getEmailTemplateInfo('admin-added', 17, $reserved);
                /* sending admin added mail to added admin mail id. */
                /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                $this->session->set_userdata("msg", "<span class='success'>Admin added successfully and verification email sent to this email address.</span>");
                redirect(base_url() . "backend/admin/list");
            }
        }
        $arr_privileges = array();
        /* getting all privileges */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $data['title'] = "Add Admin User";
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $data['header'] = array('title' => 'Add Admin User');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/admin/add', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to activate user account */

    public function activateAccount($activation_code) {
        $fields_to_pass = array('user_id', 'first_name', 'last_name', 'user_name', 'user_email', 'user_type', 'email_verified', 'user_status');
        /* get user details to verify the email address */
        $arr_login_data = $this->common_model->getRecords("mst_users", $fields_to_pass, array("activation_code" => $activation_code));
        if (count($arr_login_data)) {
            /* if email already verified */
            if ($arr_login_data[0]['email_verified'] == 1) {
                $this->session->set_userdata('msg', 'Your have already activated your account. Please login.');
            } else {
                $user_detail = $this->common_model->getRecords("mst_users", "user_id", array("activation_code" => $activation_code));
                $this->load->model('admin_model');
                /* 	Removing the user if he is exists in inactiveated list */
                $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 1, intval($user_detail[0]['user_id']));
                /* if email not verified. */
                $update_data = array('email_verified' => '1', 'user_status' => '1');
                $this->common_model->updateRow("mst_users", $update_data, array("activation_code" => $activation_code));
                $this->session->set_userdata('msg', '<strong>Congratulations!</strong> Your account has been activated successfully. Please login.');
            }
        } else {
            /* if any error invalid activation link found account */
            $_SESSION['msg'] = '<div class="alert alert-error">Invalid activation code.</div>';
        }
        redirect(base_url() . "backend/login");
    }

    
    public function editAdmin($edit_id = '') {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if (count($_POST) > 0) {
            if ($this->input->post('edit_id') != "") {
                $arr_admin_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($this->input->post('edit_id'))));
                /* single row fix */
                $arr_admin_detail = end($arr_admin_detail);
                /* setting variable to update or add admin record. */
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    if ($this->input->post('user_status') != "") {// echo 'IF';
                        $status = $this->input->post('user_status');
                        $email_verified = '1';
                    } else { //echo 'else';
                        $status = '0';
                        $email_verified = '0';
                    }
                    $activation_code = $arr_admin_detail['activation_code'];
                } else {

                    if ($arr_admin_detail['role_id'] != 1) {
                        $status = '0';
                        $email_verified = '0';
                        $activation_code = time();
                    } else {

                        $status = '1';
                        $email_verified = '0';
                        $activation_code = time();
                    }
                }
                $this->load->model('admin_model');
                /* if status blocked  by admin */
                if ($status == '2') {
                    $this->admin_model->updateBlockedUserFile($this->common_model->absolutePath(), $status, intval($this->input->post('edit_id')));
                }
                /* if status activated by admin */
                if ($status == '1') {
                    $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 1, intval($this->input->post('edit_id')));
                }
                if ($_FILES['upload_profile_photo']['name'] != "") {
                    $config['upload_path'] = './media/backend/images/admin_user/';
                    $config['allowed_types'] = 'jpeg|JPEG|png|PNG|gif|GIF|jpg';
                    $config['file_name'] = time();
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('upload_profile_photo')) {
                        $this->session->set_userdata('error_message', 'image_uploading_error!');
                        redirect(base_url() . 'backend/admin/edit/' . $edit_id);
                    } else {
                        $this->load->library('image_lib');
                        $image_details = array('upload_data' => $this->upload->data());
                        $image_data = $this->upload->data();
                        $file_name = $image_data['file_name'];
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                } else {
                    $file_name = $this->input->post('old_pic');
                }

                if ($this->input->post('change_password') == 'on') {
                    $user_password = $_POST['user_password'];
                    /* if password need to change */
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "user_email" => $this->input->post('user_email'),
                        "user_password" => base64_encode($this->input->post('user_password')),
                        "user_status" => $status,
                        'email_verified' => $email_verified,
                        'gender' => $this->input->post('gender'),
                        'activation_code' => $activation_code,
                        'role_id' => $this->input->post('role_id'),
                        'profile_picture' => $file_name
                    );
                } else {
                    $user_password = base64_decode($arr_admin_detail['user_password']);
                    /* if passwording need not need to change */
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "user_email" => $this->input->post('user_email'),
                        "user_status" => $status,
                        'gender' => $this->input->post('gender'),
                        'email_verified' => $email_verified,
                        'activation_code' => $activation_code,
                        'role_id' => $this->input->post('role_id'),
                        'profile_picture' => $file_name,
                    );
                }
                /* updating the user details */
                $this->common_model->updateRow("mst_users", $arr_to_update, array("user_id" => $this->input->post('edit_id')));
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    if ($arr_admin_detail['role_id'] != 1) {
                        /* sending account updating mail to user */
                        $admin_login_link = '<a href="' . base_url() . 'backend/login" target="_new">Log in to ' . base_url() . 'administration</a>';
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
                            "||ADMIN_LOGIN_LINK||" => $admin_login_link
                        );
                        $reserved = array_replace_recursive($macros_array, $reserved_words);
                        /* getting mail subect and mail message using email template title and lang_id and reserved works */
                        $email_content = $this->common_model->getEmailTemplateInfo('admin-updated', 17, $reserved);
                        /* sending the mail to deleting user */
                        /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                        $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Admin updated successfully.</span>");
                } else {
                    $this->admin_model->updateInactiveUserFile($this->common_model->absolutePath(), 0, intval($this->input->post('edit_id')));
                    /* sending account verification link mail to user */
                    $lang_id = 17;
                    $activation_link = '<a href="' . base_url() . 'backend/admin/account-activate/' . $activation_code . '">Activate Account</a>';
                    $macros_array_details = array();
                    $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
                    $macros_array = array();
                    foreach ($macros_array_details as $row) {
                        $macros_array[$row['macros']] = $row['value'];
                    }
                    $reserved_words = array
                        (
                        "||SITE_TITLE||" => $data['global']['site_title'],
                        "||SITE_PATH||" => base_url(),
                        "||USER_NAME||" => $this->input->post('user_name'),
                        "||ADMIN_NAME||" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                        "||PASSWORD||" => $user_password,
                        "||ADMIN_ACTIVATION_LINK||" => $activation_link
                    );
                    $reserved = array_replace_recursive($macros_array, $reserved_words);
                    /* getting mail subect and mail message using email template title and lang_id and reserved works */
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-email-updated', 17, $reserved);
                    /* sending the mail to deleting user */
                    /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                    $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                    $this->session->set_userdata("msg", "<span class='success'>Admin updated successfully and verification mail has been sent on updated email address.</span>");
                }
                if ($arr_admin_detail['role_id'] == 1) {
                    $user_account = $this->session->userdata('user_account');
                    $arr_admin_details = $this->common_model->getRecords("mst_users", "*", array("user_id" => $user_account['user_id']));
                    $arr_admin_details = end($arr_admin_details);
                    $user_account['user_name'] = stripslashes($arr_admin_details['user_name']);
                    $user_account['user_email'] = $arr_admin_details['user_email'];
                    $user_account['first_name'] = stripslashes($arr_admin_details['first_name']);
                    $user_account['last_name'] = stripslashes($arr_admin_details['last_name']);
                    $this->session->set_userdata('user_account', $user_account);
                }
                $this->session->set_userdata("msg", "<span class='success'>Admin updated successfully</span>");
                redirect(base_url() . "backend/admin/list");
            }
        }
        $arr_privileges = array();
        /* getting all privileges  */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        /* getting admin details from $edit_id from function parameter */
        $data['arr_admin_detail'] = $this->common_model->getRecords("mst_users", "", array("user_id" => intval(base64_decode($edit_id))));
        /* single row fix */
        $data['arr_admin_detail'] = end($data['arr_admin_detail']);
        $data['edit_id'] = $edit_id;
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $data['header'] = array('title' => 'Edit Admin User');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/admin/edit', $data);
        $this->load->view('backend/sections/footer');
    }

    
    /* function to display admin profile */
    public function adminProfile() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* using the admin model */
        $this->load->model('admin_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /* getting all privileges  */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        /* getting admin details from user id from function parameter */
        $user_account = $this->session->userdata('user_account');
        $data['arr_admin_detail'] = $this->admin_model->getAdminDetails($user_account['user_id']);
        /* single row fix */
        $data['arr_admin_detail'] = end($data['arr_admin_detail']);
        $data['title'] = "Profile";
        $this->load->view('backend/admin/admin-profile', $data);
    }

    
    public function editProfile() {
        $user_account = $this->session->userdata('user_account');
        $edit_id = $user_account['user_id'];
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if ($this->input->post('user_name') != "") {
                $arr_admin_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($edit_id)));
                /* single row fix */
                $arr_admin_detail = end($arr_admin_detail);
                /* setting variable to update or add admin record. */
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    $status = '1';
                    $email_verified = '1';
                    $activation_code = $arr_admin_detail['activation_code'];
                } else {

                    if ($arr_admin_detail['role_id'] != 1) {
                        $status = '0';
                        $email_verified = '0';
                        $activation_code = time();
                    } else {
                        $status = '1';
                        $email_verified = '1';
                        $activation_code = time();
                    }
                }
                if ($this->input->post('change_password') == 'on') {
                    $user_password = $_POST['user_password'];
                    /* if password need to change */
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "user_email" => $this->input->post('user_email'),
                        "user_password" => base64_encode($this->input->post('user_password')),
                        "user_status" => $status,
                        'email_verified' => $email_verified,
                        'gender' => $this->input->post('gender'),
                        'activation_code' => $activation_code
                    );
                } else {
                    $user_password = base64_decode($arr_admin_detail['user_password']);
                    /* if passwording need not need to change */
                    $arr_to_update = array(
                        "user_name" => $this->input->post('user_name'),
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "user_email" => $this->input->post('user_email'),
                        "user_status" => $status,
                        'gender' => $this->input->post('gender'),
                        'email_verified' => $email_verified,
                        'activation_code' => $activation_code
                    );
                }
                /* updating the user details */
                $this->common_model->updateRow("mst_users", $arr_to_update, array("user_id" => $edit_id));
                if ($this->input->post('user_email') == $this->input->post('old_email')) {
                    if ($arr_admin_detail['role_id'] != 1) {
                        /* sending account updating mail to user */
                        $admin_login_link = '<a href="' . base_url() . 'backend/login" target="_new">Log in to ' . base_url() . 'administration</a>';
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
                            "||ADMIN_LOGIN_LINK||" => $admin_login_link
                        );
                        $reserved = array_replace_recursive($macros_array, $reserved_words);
                        /* getting mail subect and mail message using email template title and lang_id and reserved works */
                        $email_content = $this->common_model->getEmailTemplateInfo('admin-updated', 17, $reserved);
                        /* sending the mail to deleting user */
                        /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                        $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                    }
                } else {
                    /* sending account verification link mail to user */
                    $lang_id = 17;
                    $activation_link = '<a href="' . base_url() . 'backend/admin/account-activate/' . $activation_code . '">Activate Account</a>';
                    $reserved_words = array
                        ("||SITE_TITLE||" => $data['global']['site_title'],
                        "||SITE_PATH||" => base_url(),
                        "||USER_NAME||" => $this->input->post('user_name'),
                        "||ADMIN_NAME||" => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                        "||ADMIN_EMAIL||" => $this->input->post('user_email'),
                        "||PASSWORD||" => $user_password,
                        "||ADMIN_ACTIVATION_LINK||" => $activation_link
                    );
                    /* getting mail subect and mail message using email template title and lang_id and reserved works */
                    $email_content = $this->common_model->getEmailTemplateInfo('admin-email-updated', 17, $reserved_words);
                    /* sending the mail to deleting user */
                    /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */
                    $mail = $this->common_model->sendEmail(array($this->input->post('user_email')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
                    $this->session->set_userdata('msg', '<div class="alert alert-success">Your account is inactivated for email verification. Account activation link has been sent on updated email address.</div>');
                    $this->logout();
                }
                $user_account = $this->session->userdata('user_account');
                $arr_admin_details = $this->common_model->getRecords("mst_users", "*", array("user_id" => $user_account['user_id']));
                $arr_admin_details = end($arr_admin_details);
                $user_account['user_name'] = stripslashes($arr_admin_details['user_name']);
                $user_account['user_email'] = $arr_admin_details['user_email'];
                $user_account['first_name'] = stripslashes($arr_admin_details['first_name']);
                $user_account['last_name'] = stripslashes($arr_admin_details['last_name']);
                $this->session->set_userdata('user_account', $user_account);
                $this->session->set_userdata("msg", "<span class='success'>Profile has been updated successfully</span>");
                redirect(base_url() . "backend/admin/profile");
            }
        }
        $arr_privileges = array();
        /* getting all privileges  */
        //$data['arr_privileges']=$this->common_model->getRecords('mst_privileges');
        /* getting admin details from $edit_id from function parameter */
        $data['arr_admin_detail'] = $this->common_model->getRecords("mst_users", "", array("user_id" => intval($edit_id)));
        /* single row fix */
        $data['arr_admin_detail'] = end($data['arr_admin_detail']);
        $data['title'] = "Edit Profile";
        $data['edit_id'] = $edit_id;
        $data['arr_roles'] = $this->common_model->getRecords("mst_role");
        $this->load->view('backend/admin/edit-profile', $data);
    }

    
    public function manageNotification() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* Getting Common data */
        $data = $this->common_model->commonFunction();
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1) {
            /* an admin which is not super admin not privileges to access Manage Role */
            /* setting session for displaying notiication message. */
            $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage admin.</span>");
            redirect(base_url() . "backend/home");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                /* getting all ides selected */
                $arr_notification_ids = $this->input->post('checkbox');
                if (count($arr_notification_ids) > 0) {
                    /* deleting the admin selected */
                    $this->common_model->deleteRows($arr_notification_ids, "mst_notifications", "notifications_id");
                    $this->session->set_userdata("msg", "<span class='success'>Notification deleted successfully.</span>");
                }
            }
        }
        /* using the admin model */
        $data['arr_notification'] = $this->common_model->manageNotificationForAdmin();
        $data['header'] = array('title' => 'Manage Notifications');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/admin/manage-notification', $data);
        $this->load->view('backend/sections/footer');
    }

    
    public function deleteNotification($notification_id) {
        $this->common_model->deleteRows(array(base64_decode($notification_id)), "mst_notifications", "notifications_id");
        $this->session->set_userdata("msg", "<span class='success'>Notification deleted successfully.</span>");
        redirect(base_url() . "backend/admin/manage-notification");
    }

}
