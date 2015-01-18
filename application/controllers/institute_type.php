<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Institute_Type extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function listInstituteType() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the email template model ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges'); 
        if ($data['user_account']['role_id'] != 1) { 
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');

            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(7, $user_priviliges)) { 
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage interest!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                /* getting all ides selected */
                $arr_type_ids = $this->input->post('checkbox');
                if (count($arr_type_ids) > 0) {
                    /* deleting the Voucher selected */
                    $this->common_model->deleteRows($arr_type_ids, "mst_institute_type", "institute_type_id");
                    $this->session->set_userdata("msg", "<span class='success'>Record deleted successfully!</span>");
                }
            }
        }
        $data['arr_institute_type'] = $this->common_model->getRecords("mst_institute_type", '*', '', 'institute_type_id DESC', '');
        $data['header'] = array('title' => 'Manage Institute Type');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/institute-type/list', $data);
        $this->load->view('backend/sections/footer');
    }

    public function changeStatus() {
        if ($this->input->post('institute_type_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "institute_type_status" => $this->input->post('institute_type_status')
            );
            #condition to update record	for the user status
            $condition_array = array('institute_type_id' => intval($this->input->post('institute_type_id')));
            $this->common_model->updateRow('mst_institute_type', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function addInstituteType() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');

            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(13, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage interest!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            $arr_to_add = array(
                'institute_type' => mysql_real_escape_string($this->input->post('institute_type')),
                'institute_type_status' => mysql_real_escape_string($this->input->post('institute_type_status'))
            );
            $this->common_model->insertRow($arr_to_add, 'mst_institute_type');
            $this->session->set_userdata("msg", "<span class='success'>Record added successfully!</span>");
            redirect(base_url() . 'backend/manage-institute-type');
        }
        $data['header'] = array('title' => 'Add Institute Type');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/institute-type/add-institute-type', $data);
        $this->load->view('backend/sections/footer');
    }

    public function editInstituteType($edit_id) {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');

            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(13, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage interest!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            $arr_to_update = array(
                'institute_type' => mysql_real_escape_string($this->input->post('institute_type')),
                'institute_type_status' => mysql_real_escape_string($this->input->post('institute_type_status'))
            );
            $this->common_model->updateRow('mst_institute_type', $arr_to_update, array("institute_type_id" => $edit_id));
            $this->session->set_userdata("msg", "<span class='success'>Record updated successfully!</span>");
            redirect(base_url() . 'backend/manage-institute-type');
        }
        $data['arr_institute_type'] = $this->common_model->getRecords('mst_institute_type', "*", array("institute_type_id" => $edit_id));
        $data['arr_institute_type'] = end($data['arr_institute_type']);


        $data['header'] = array('title' => 'Update Institute Type');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/institute-type/edit-institute-type', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to check product name exist or not */

    public function checkInstituteType() {

        if (isset($_POST['type'])) {
            if (strtolower($this->input->post('institute_type')) == strtolower($this->input->post('old_institute_type'))) {
                echo "true";
            } else {
                $arr_institute = $this->common_model->getRecords('mst_institute_type', 'institute_type', array("institute_type" => mysql_real_escape_string($this->input->post('institute_type'))));
                if (count($arr_institute) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            $arr_institute = $this->common_model->getRecords('mst_institute_type', 'institute_type', array("institute_type" => mysql_real_escape_string($this->input->post('institute_type'))));
            if (count($arr_institute) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

}
