<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_template extends CI_Controller {
    /*     * * 
      An Controller having functions to manage email template  functionalities ie. listing, editing at back end.
     * * */

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    /*
     * function to display all the email templates pages 
     */

    public function index() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the email template model ** */
        $this->load->model('email_template_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        
        
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            
            
            if (!in_array(2, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage email template!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        /*         * getting all email templates from email template table. ** */
        $data['arr_email_templates'] = $this->email_template_model->getEmailTemplateDetails();
        $data['header'] = array('title' => 'Manage Email Templates');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/email-template/list', $data);
        $this->load->view('backend/sections/footer');
    }

    /*
     * function for edi temail template 
     */

    public function editEmailTemplate($email_template_id = '') {
        /*         * * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        /*         * using the email template model ** */
        $this->load->model('email_template_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');

        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(2, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage email template.</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if ($this->input->post('input_subject') != '') {
            $arr_to_update = array("email_template_subject" => mysql_real_escape_string($this->input->post('input_subject')), "email_template_content" => $this->input->post('text_content'), "date_updated" => date("Y-m-d H:i:s"));
            $email_template_id_to_update = $this->input->post('email_template_hidden_id');
            $this->email_template_model->updateEmailTemplateDetailsById($email_template_id_to_update, $arr_to_update);
            $this->session->set_userdata('msg', 'Email Template details has been updated successfully.');
            redirect(base_url() . "backend/email-template/list");
        }

        /* getting all email templates from email template table */
        $data['arr_email_template_details'] = $this->email_template_model->getEmailTemplateDetailsById($email_template_id);
        $data['macro_list'] = $this->email_template_model->getEmailTemplateMacroList($email_template_id);
        if (count($data['macro_list']) == 0) {
            $data['macro_list'] = $this->email_template_model->getMacros();
        }
         $data['macros_array_detail'] = array();
        $data['macros_array_detail'] = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass='macros',  $condition_to_pass='', $order_by='',$limit='',$debug = 0);
//        print_r($data['macros_array_detail']);die;
        $data['email_template_id'] = $email_template_id;
        $data['arr_email_template_details'] =$data['arr_email_template_details'][0];
        $data['header'] = array('title' => 'Edit Email Templates');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/email-template/edit-email-template', $data);
        $this->load->view('backend/sections/footer');
    }

    public function assignEmailTemplateMacro($email_template_id = '') {
        /*         * * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        /*         * using the email template model ** */
        $this->load->model('email_template_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');

        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(2, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage email template.</span>");
                redirect(base_url() . "backend/home");
            }
        }

        if ($this->input->post('btnsubmit') == "Submit") {
            /* Deleting the previous tags id of product from the database */
            $this->email_template_model->deleteEmailTemplateMacros($this->input->post('email_template_id'));

            /* Inserting the new tags for the products */
            $email_template_macros = $this->input->post('checkbox');

            if (count($email_template_macros) > 0) {
                foreach ($email_template_macros as $macro_id) {
                    $insert_data = array("email_template_id" => $this->input->post('email_template_id'), "macro_id" => $macro_id);
                    $this->common_model->insertRow($insert_data, "trans_email_template_macros");
                }
            }
            $this->session->set_userdata("msg", "<span class='success'>Email template macros added successfully.</span>");
            redirect(base_url() . "backend/email-template/list");
        }

        /* Getting all macros */
        $data['arr_macros'] = $this->email_template_model->getMacros();

        /* Getting email templage macros */
        $arr_email_templage_macros = $this->email_template_model->getEmailTemplateMacroList($email_template_id);
        $assigned_macro_id = array();
        foreach ($arr_email_templage_macros as $email_template_macro) {
            array_push($assigned_macro_id, $email_template_macro['macro_id']);
        }
        $data['email_template_id'] = $email_template_id;
        $data['assigned_macro_id'] = $assigned_macro_id;
        $data["title"] = "Assign macro to email template";
        $this->load->view('backend/email-template/email-template-macros', $data);
    }

    public function emailTemplateMacros() {
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the email template model ** */
        $this->load->model('email_template_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(2, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage email template.</span>");
                redirect(base_url() . "backend/home");
            }
        }

        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all macro id seleted selected
                $arr_macro_ids = $this->input->post('checkbox');
                if (count($arr_macro_ids) > 0) {
                    if (count($arr_macro_ids) > 0) {
                        #deleting the macro selected
                        $this->common_model->deleteRows($arr_macro_ids, "mst_macros", "macro_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Email template macro deleted successfully.</span>");
                }
            }
        }

        /*         * getting all email templates Macros from email template table. ** */
        $data['arr_email_template_macros'] = $this->email_template_model->getMacros();
        $data['title'] = "Manage Email Tempate Macros";
        $this->load->view('backend/email-template/list-email-template-macros', $data);
    }

    public function addTemplateMacros($email_template_macro_id = '') {

        /*         * * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        /*         * using the email template model ** */
        $this->load->model('email_template_model');
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');

        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(2, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage email template.</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            if ($this->input->post('email_template_macro_id') != "") {
                $arr_to_update = array("macro_title" => str_replace(" ", "_", strtoupper($this->input->post('input_macro_title'))), "macro_comment" => $this->input->post('input_macro_comment'));
                $arr_condition = array("macro_id" => $this->input->post('email_template_macro_id'));
                $this->common_model->updateRow("mst_macros", $arr_to_update, $arr_condition);
                $this->session->set_userdata('msg', 'Email template macro has been updated sucessfully.');
            } else {
                $arr_to_insert = array("macro_title" => str_replace(" ", "_", strtoupper($this->input->post('input_macro_title'))), "macro_comment" => $this->input->post('input_macro_comment'));
                $this->common_model->insertRow($arr_to_insert, "mst_macros");
                $this->session->set_userdata('msg', 'Email template macro has been added sucessfully.');
            }
            redirect(base_url() . "backend/email-template-macros");
        }

        if ($email_template_macro_id != '') {
            /* getting all email templates from email template table */
            $data['arr_email_template_macro_details'] = $this->email_template_model->getEmailTemplateMacroDetailsById($email_template_macro_id);
            $data['title'] = "Update Email Template Macro";
            $data['email_template_macro_id'] = $email_template_macro_id;
        } else {
            $data['email_template_macro_id'] = '';
            $data['title'] = "Add Email Template Macro";
        }
        $this->load->view('backend/email-template/add-email-template-macro', $data);
    }

}
