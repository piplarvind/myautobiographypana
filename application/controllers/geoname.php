<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Geoname extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('geoname_model');
    }

    /* function to list all states */

    public function listStates() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the email template model ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(10, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage geoname!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                /* getting all ides selected */
                $arr_state_ids = $this->input->post('checkbox');
                if (count($arr_state_ids) > 0) {
                    /* deleting the geoname selected */
                    $this->common_model->deleteRows($arr_state_ids, "mst_geoname", "geoname_id");
                    $this->session->set_userdata("msg", "<span class='success'>Record deleted successfully!</span>");
                }
            }
        }
        $data['arr_states'] = $this->geoname_model->viewStates();
        $data['header'] = array('title' => 'Manage States');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/geoname/list-states', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to change state status */

    public function changeStateStatus() {
        if ($this->input->post('state_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "status" => $this->input->post('state_status')
            );
            #condition to update record	for the user status
            $condition_array = array('geoname_id' => intval($this->input->post('state_id')));
            $this->common_model->updateRow('mst_geoname', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    /* function to add new state */

    public function addStates() {
       
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
            if (!in_array(10, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage geoname!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) { 
           
            $arr_to_add = array(
                'country_id' => mysql_real_escape_string($this->input->post('country_id')),
                'state_id' => "0",
                'geoname' => mysql_real_escape_string($this->input->post('state_name')),
                'status' => mysql_real_escape_string($this->input->post('state_status'))
            );
            $this->common_model->insertRow($arr_to_add, 'mst_geoname');
            $this->session->set_userdata("msg", "<span class='success'>Record added successfully!</span>");
            redirect(base_url() . 'backend/manage-states');
        }
        $data['arr_country'] = $this->common_model->getRecords('mst_country', '*', '', 'country_name');
        $data['header'] = array('title' => 'Add States');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/geoname/add-states', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to edit state */

    public function editStates($state_id) {
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
            if (!in_array(10, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage geoname!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if ($this->input->post()) {
            $arr_to_update = array(
                'country_id' => mysql_real_escape_string($this->input->post('country_id')),
                'state_id' => "0",
                'geoname' => mysql_real_escape_string($this->input->post('state_name')),
                'status' => mysql_real_escape_string($this->input->post('state_status'))
            );
            $this->common_model->updateRow('mst_geoname', $arr_to_update, array("geoname_id" => base64_decode($state_id)));
            $this->session->set_userdata("msg", "<span class='success'>Record updated successfully!</span>");
            redirect(base_url() . 'backend/manage-states');
        }
        $data['arr_states'] = $this->geoname_model->viewStatesById(base64_decode($state_id));
        $data['arr_country'] = $this->common_model->getRecords('mst_country', '*', '', 'country_name');
        $data['arr_states'] = end($data['arr_states']);
        $data['header'] = array('title' => 'Update States');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/geoname/edit-states', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to list all the cities */

    public function listCities() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the email template model ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(10, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage geoname!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                /* getting all ides selected */
                $arr_state_ids = $this->input->post('checkbox');
                if (count($arr_state_ids) > 0) {
                    /* deleting the geoname selected */
                    $this->common_model->deleteRows($arr_state_ids, "mst_geoname", "geoname_id");
                    $this->session->set_userdata("msg", "<span class='success'>Record deleted successfully!</span>");
                }
            }
        }
        $data['arr_cities'] = $this->geoname_model->viewCities();
        $data['header'] = array('title' => 'Manage Cities');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/geoname/list-cities', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to change city status */

    public function changeCityStatus() {
        if ($this->input->post('city_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "status" => $this->input->post('city_status')
            );
            #condition to update record	for the user status
            $condition_array = array('geoname_id' => intval($this->input->post('city_id')));
            $this->common_model->updateRow('mst_geoname', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    /* function to select state */

    public function SelectStates() {
        if ($this->input->post('country_id') != "") {
            #updating the user status.
            
            $condition = array("country_id" => intval($this->input->post('country_id')),
                "state_id" => "0",
                "status" => "1"
            );
            $arr_states = $this->common_model->getRecords("mst_geoname", "geoname,geoname_id", $condition);
          
            $arr_state_return = array();
            foreach ($arr_states as $key => $state) {
                $arr_state_return[$key]["state_id"] = $state["geoname_id"];
                $arr_state_return[$key]["state_name"] = $state["geoname"];
            }
        } else {
            $arr_state_return[""];
        }
        echo json_encode($arr_state_return);
    }

    /* function to add new city */

    public function addCities() {
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
            if (!in_array(10, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage geoname!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        if (count($_POST) > 0) {
            $arr_to_add = array(
                'country_id' => mysql_real_escape_string($this->input->post('country_id')),
                'state_id' => mysql_real_escape_string($this->input->post('state_id')),
                'geoname' => mysql_real_escape_string($this->input->post('city_name')),
                'status' => mysql_real_escape_string($this->input->post('city_status'))
            );
            $this->common_model->insertRow($arr_to_add, 'mst_geoname');
            $this->session->set_userdata("msg", "<span class='success'>Record added successfully!</span>");
            redirect(base_url() . 'backend/manage-cities');
        }
        $data['arr_country'] = $this->common_model->getRecords('mst_country', '*', '', 'country_name');
        $data['header'] = array('title' => 'Add City');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/geoname/add-cities', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to edit city */

    public function editCities($city_id) {
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
            if (!in_array(10, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage geoname!</span>");
                redirect(base_url() . "backend/home");
            }
        }

        if ($this->input->post()) {
            $arr_to_update = array(
                'country_id' => mysql_real_escape_string($this->input->post('country_id')),
                'state_id' => mysql_real_escape_string($this->input->post('state_id')),
                'geoname' => mysql_real_escape_string($this->input->post('city_name')),
                'status' => mysql_real_escape_string($this->input->post('city_status'))
            );
            $this->common_model->updateRow('mst_geoname', $arr_to_update, array("geoname_id" => base64_decode($city_id)));
            $this->session->set_userdata("msg", "<span class='success'>Record updated successfully!</span>");
            redirect(base_url() . 'backend/manage-cities');
        }
        $data['arr_cities'] = $this->geoname_model->viewCityById(base64_decode($city_id));
        $data['arr_country'] = $this->common_model->getRecords('mst_country', '*', '', 'country_name');
        $data['arr_cities'] = end($data['arr_cities']);
        $country_id = $data['arr_cities'] ["country_id"];
        $data['arr_states'] = $this->geoname_model->getStates($country_id);
        $data['header'] = array('title' => 'Update Cities');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/geoname/edit-cities', $data);
        $this->load->view('backend/sections/footer');
    }

    /* function to check geoname exist or not */

    public function checkStateName() {
        if (isset($_POST['type'])) {
            if (strtolower($this->input->post('state_name')) == strtolower($this->input->post('old_state_name'))) {
                echo "true";
            } else {
                $arr_geoname = $this->common_model->getRecords('mst_geoname', 'geoname', array("geoname" => mysql_real_escape_string($this->input->post('state_name'))));
                if (count($arr_geoname) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            $arr_geoname = $this->common_model->getRecords('mst_geoname', 'geoname', array("geoname" => mysql_real_escape_string($this->input->post('state_name'))));
            if (count($arr_geoname) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

    public function checkCityName() {
        if (isset($_POST['type'])) {
            if (strtolower($this->input->post('city_name')) == strtolower($this->input->post('old_city_name'))) {
                echo "true";
            } else {
                $arr_geoname = $this->common_model->getRecords('mst_geoname', 'geoname', array("geoname" => mysql_real_escape_string($this->input->post('city_name'))));
                if (count($arr_geoname) == 0) {
                    echo "true";
                } else {
                    echo "false";
                }
            }
        } else {
            $arr_geoname = $this->common_model->getRecords('mst_geoname', 'geoname', array("geoname" => mysql_real_escape_string($this->input->post('city_name'))));
            if (count($arr_geoname) == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }
    }

}
