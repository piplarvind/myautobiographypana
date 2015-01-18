<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banner extends CI_Controller {

    /**
     * An Controller having functions to manage user role
     */
    /* construction function used to load all the models used in the controller.	   */
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('user_model');
    }

    /* function to list all the roles */

    public function uploadBanner() {
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
        if ($this->input->post('upload_banner') != '') {
            if ($_FILES['banner_image']['name'] != "") {
                if ($_FILES['banner_image']['size'] <= "1000000") {
                    $this->session->set_userdata("msg", "Please select maximum 1Mb and 851X180 dimensional file to upload.");
                    redirect(base_url() . "institute/banner");
                }
                $image_data = array();
                $config['upload_path'] = 'media/front/img/banner-images/';
                $config['file_name'] = $_FILES['banner_image']['name'];
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('banner_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $file_name = $image_data['file_name'];
                    $target_path = $absolute_path . 'media/front/img/banner-images/thumbs/' . $file_name;
                    $target_path1 = $absolute_path . 'media/front/img/banner-images/851X180/' . $file_name;
                    exec("convert " . $image_data['full_path'] . " -resize 283X60 " . $target_path);
                    exec("convert " . $image_data['full_path'] . " -resize 851X180 " . $target_path1);
                }
            }
            $table = 'mst_banner';
            $fields = array('banner_title' => $this->input->post('banner_title'),
                'banner_text' => $this->input->post('banner_text'),
                'banner_image' => $image_data["file_name"],
                'banner_url' => $this->input->post('banner_url'),
                'banner_status' => $this->input->post('banner_status'),
                'created_on' => date("Y-m-d H:i:s"),
                'user_id' => $user_id
            );
            $this->session->set_userdata("msg", "Banner added successfully!");
            $insert_id = $this->common_model->insertRow($fields, $table);
            redirect(base_url() . "institute/banner-management");
        }
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['header'] = array('title' => 'Add Banner');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userB-banner', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function bannerManagement() {
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
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data["arr_banner"] = $this->common_model->getRecords("mst_banner", "*", array("user_id" => $user_id), 'banner_id DESC', "");
        $data['header'] = array('title' => 'Banner Management');
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userB-banner-management', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function editBanner($banner_id) {
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
        $data['arr_banner_detail'] = $this->common_model->getRecords("mst_banner", "", array("banner_id" => intval(base64_decode($banner_id))));
        if ($this->input->post('edit_banner') != '') {
            $image_data = array();
            if ($_FILES['banner_image']['name'] != "") {
                if ($_FILES['banner_image']['size'] <= "1000000") {
                    $this->session->set_userdata("msg", "Please select maximum 1Mb and 851X180 dimensional file to upload.");
                    redirect(base_url() . "institute/edit-banner/" . $banner_id);
                }
                $config['upload_path'] = 'media/front/img/banner-images/';
                $old_image = $data['arr_banner_detail'][0]['banner_image'];
                unlink($config['upload_path'] . '' . $old_image);
                unlink($config['upload_path'] . 'thumbs/' . $old_image);
                unlink($config['upload_path'] . '851X180/' . $old_image);
                $config['file_name'] = $_FILES['banner_image']['name'];
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('banner_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $file_name = $image_data['file_name'];
                    $target_path = $absolute_path . 'media/front/img/banner-images/thumbs/' . $file_name;
                    $target_path1 = $absolute_path . 'media/front/img/banner-images/851X180/' . $file_name;
                    exec("convert " . $image_data['full_path'] . " -resize 283X60 " . $target_path);
                    exec("convert " . $image_data['full_path'] . " -resize 851X180 " . $target_path1);
                    $bnr_img = $image_data["file_name"];
                }
            } else {
                #if image not need to change
                $bnr_img = $data['arr_banner_detail'][0]['banner_image'];
            }
            $table = 'mst_banner';
            $arr_to_update = array('banner_title' => $this->input->post('banner_title'),
                'banner_text' => $this->input->post('banner_text'),
                'banner_image' => $bnr_img,
                'banner_url' => $this->input->post('banner_url'),
                'banner_status' => $this->input->post('banner_status'),
            );
            $condition = array('banner_id' => intval(base64_decode($banner_id)));
            $this->common_model->updateRow($table, $arr_to_update, $condition);
            $this->session->set_userdata("msg", "Banner updated successfully!");
            redirect(base_url() . "institute/banner-management");
        }
        $data['arr_banner_detail'] = end($data['arr_banner_detail']);
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['header'] = array('title' => 'Edit Banner');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/userB-edit-banner', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function changeStatus() {
        if ($this->input->post('banner_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "banner_status" => $this->input->post('banner_status')
            );
            #condition to update record	for the user status
            $condition_array = array('banner_id' => intval($this->input->post('banner_id')));
            $this->common_model->updateRow('mst_banner', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function deleteBanner($banner_id) {
        $banner = $this->common_model->getRecords("mst_banner", "*", array("banner_id" => base64_decode($banner_id)));
        if ($banner[0]["banner_image"] != "") {
            @unlink("media/front/img/banner-images/" . $banner[0]["banner_image"]);
            @unlink("media/front/img/banner-images/thumbs/" . $banner[0]["banner_image"]);
            @unlink("media/front/img/banner-images/851X180/" . $banner[0]["banner_image"]);
        }
        $this->common_model->deleteRows(array(base64_decode($banner_id)), "mst_banner", "banner_id");
        $this->session->set_userdata("msg", "Banner delete successfully!");
        redirect(base_url() . "institute/banner-management");
    }

}
