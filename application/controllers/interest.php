<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Interest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function listInterest() { 
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
            if (!in_array(9, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage interest!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                /* getting all ides selected */
                $arr_interest_ids = $this->input->post('checkbox');
                if (count($arr_interest_ids) > 0) {
                    /* deleting the Voucher selected */
                    $this->common_model->deleteRows($arr_interest_ids, "mst_interest", "interest_id");
                    $this->session->set_userdata("msg", "<span class='success'>Record deleted successfully!</span>");
                }
            }
        }
        $data['arr_interest'] = $this->common_model->getRecords("mst_interest", '*', '', 'interest_id DESC', '');

        $data['header'] = array('title' => 'Manage Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/interest/list', $data);
        $this->load->view('backend/sections/footer');
    }

    public function changeStatus() {
        if ($this->input->post('interest_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "interest_status" => $this->input->post('interest_status')
            );
            #condition to update record	for the user status
            $condition_array = array('interest_id' => intval($this->input->post('interest_id')));
            $this->common_model->updateRow('mst_interest', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function addInterest() {
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
                'interest_name' => mysql_real_escape_string($this->input->post('interest_name')),
                'interest_status' => mysql_real_escape_string($this->input->post('interest_status'))
            );
            $this->common_model->insertRow($arr_to_add, 'mst_interest');
            $this->session->set_userdata("msg", "<span class='success'>Record added successfully!</span>");
            redirect(base_url() . 'backend/manage-interest');
        }
        $data['header'] = array('title' => 'Add Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/interest/add-interest', $data);
        $this->load->view('backend/sections/footer');
    }

    public function editInterest($edit_id) {
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
                'interest_name' => mysql_real_escape_string($this->input->post('interest_name')),
                'interest_status' => mysql_real_escape_string($this->input->post('interest_status'))
            );
            $this->common_model->updateRow('mst_interest', $arr_to_update, array("interest_id" => $edit_id));
            $this->session->set_userdata("msg", "<span class='success'>Record updated successfully!</span>");
            redirect(base_url() . 'backend/manage-interest');
        }
        $data['arr_interest'] = $this->common_model->getRecords('mst_interest', "*", array("interest_id" => $edit_id));
        $data['arr_interest'] = end($data['arr_interest']);

        $data['header'] = array('title' => 'Update Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/interest/edit-interest', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to check product name exist or not */

    public function checkInterestName() {

        if (isset($_POST['type'])) {
            if (strtolower($this->input->post('interest_name')) == strtolower($this->input->post('old_interest_name'))) {
                echo "true";
            } else {
                $arr_interest = $this->common_model->getRecords('mst_interest', 'interest_name', array("interest_name" => mysql_real_escape_string($this->input->post('interest_name'))));
                if (count($arr_interest) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            $arr_interest = $this->common_model->getRecords('mst_interest', 'interest_name', array("interest_name" => mysql_real_escape_string($this->input->post('interest_name'))));
            if (count($arr_interest) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

}
