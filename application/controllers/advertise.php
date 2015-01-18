<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ADVERTISE extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('advertise_model');
        $this->load->model('common_model');
    }

    #function to list all the advertises

    public function listAdvertises() {

        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_advertise_ids = $this->input->post('checkbox');
                if (count($arr_advertise_ids) > 0) {
                    if (count($arr_advertise_ids) > 0) {
                        foreach ($arr_advertise_ids as $id) {
                            $arr_advertise = $this->common_model->getRecords('mst_advertises', 'image_name', array('advertise_id' => intval(($id))), $order_by = '', $limit = '', $debug = 0);
                            $upload_dir = 'media/front/img/advertise/';
                            $old_name = $upload_dir . $arr_advertise[0]['image_name'];
                            unlink($old_name);
                        }
                        #deleting the admin selected                        
                        $this->common_model->deleteRows($arr_advertise_ids, "mst_advertises", "advertise_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Records deleted successfully!</span>");
                } else {
                    echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
                    die;
                }
            }
        }
        //get all advertises
        $data['arr_adverties'] = $this->advertise_model->getAdvertiseList('', '', '');
        $data['header'] = array('title' => 'Manage Advertises');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/advertises/list', $data);
        $this->load->view('backend/sections/footer');
    }

    function changeAdvertiseStatus($advertise_id, $status) {
        $update_data = array(
            "status" => $status
        );
        $this->common_model->updateRow('mst_advertises', $update_data, array('advertise_id' => intval(($advertise_id))));
        $this->session->set_userdata("msg", "<span class='success'>Advertise status updated successfully!</span>");
        redirect(base_url() . 'backend/advertises');
    }

    function previewAdvertise($advertise_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        //get advertise by id
        $data['arr_advertise'] = $this->common_model->getRecords('mst_advertises', '*', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        //get page and position id by advertise id
        $data['arr_relational_page'] = $this->common_model->getRecords('trans_advertise_page_position', 'page_id,position_id', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        $data['header'] = array('title' => 'Preview Advertise');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/advertises/preview-advertise', $data);
        $this->load->view('backend/sections/footer');
    }

    function addAdvertise() {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            $arr_ex = explode('*', $_POST['size']);
            $arr_size = explode('-', $arr_ex[1]);
            //image upload section
            if ($_FILES['input_image']['name'] != '') {
                list($w, $h) = getimagesize($_FILES['input_image']['tmp_name']);
//                if ($w > $arr_size[0] || $h > $arr_size[1]) {
//                    $this->session->set_userdata('post', $_POST);
//                    $this->session->set_userdata("msg", "<span class='error'>Please upload proper size image as per selected size.</span>");
//                    redirect(base_url() . 'backend/add-advertise');
//                    exit();
//                }
                $arr_file = $this->findExtension($_FILES['input_image']['name']);
                $image_name = time() . '.' . $arr_file['ext'];
                $upload_dir = 'media/front/img/advertise/';
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'gif|jpg|jpeg|png|ico|bmp';
                $config['max_width'] = '102400';
                $config['max_height'] = '76800';
                $config['file_name'] = $image_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('input_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('msg', $error['error']);
                    redirect(base_url() . 'backend/add-advertise');
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $absolute_path = $this->common_model->absolutePath();
                    $image_path = $absolute_path . $upload_dir;
                    $image_main = $image_path . "/" . $image_name;
                    $thumbs_image1 = $image_path . "/thumbs/" . $image_name;
                    if ($this->input->post("size") == "large rectangle *300-400") {
//                        $strConsole = 'convert ' . $image_main . ' -crop 240!X400!-10-10 "' . $thumbs_image1 . '"';
//                        exec($strConsole);
                        $str_console1 = "convert " . $image_main . " -resize 300!X400! " . $thumbs_image1;
                        exec($str_console1);
                    } else {
//                        $strConsole = 'convert ' . $image_main . ' -crop 300!X250!-10-10 "' . $thumbs_image1 . '"';
//                        exec($strConsole);
                        $str_console1 = "convert " . $image_main . " -resize 300!X250! " . $thumbs_image1;
                        exec($str_console1);
                    }
                }
            }
            //Insert advertise
            $arr_fields = array(
                "title" => addslashes($_POST['input_title']),
                "advertise_type" => addslashes($_POST['select_ads_type_id']),
                "script" => addslashes($_POST['textarea_script']),
                "image_name" => $image_name,
                "redirect_url" => urlencode($_POST['input_redirect_url']),
                "advertise_size" => addslashes($_POST['size']),
                "expired_start_date" => date('Y-m-d H:i:s', strtotime($_POST['input_start_date'])),
                "expired_end_date" => date('Y-m-d H:i:s', strtotime($_POST['input_end_date'])),
                "status" => ($_POST['select_status']),
                "created_on" => date('Y-m-d H:i:s')
            );
            if ($_FILES['input_image']['name'] == '') {
                unset($arr_fields['image_name']);
            }
            if ($arr_fields['script'] == '') {
                unset($arr_fields['script']);
            }
            $last_insert_ads_id = $this->common_model->insertRow($arr_fields, 'mst_advertises');
            $this->session->unset_userdata('post');
            //Insert advertise categories
            foreach ($_POST['select_category'] as $key => $value) {
                $arr_cat_fields = array(
                    "advertise_id" => $last_insert_ads_id,
                    "category_id" => $value
                );
                $this->common_model->insertRow($arr_cat_fields, 'trans_advertise_category');
            }
            //Insert advertise page, position
            foreach ($_POST['input_advertise_page'] as $key => $value) {
                $arr_post_position = array();
                $arr_post_position[] = $_POST['input_advertise_position'];
                foreach ($arr_post_position as $position_key => $position_value) {
                    $arr_fields = array(
                        "advertise_id" => $last_insert_ads_id,
                        "page_id" => $value,
                        "position_id" => $position_value
                    );
                    $this->common_model->insertRow($arr_fields, 'trans_advertise_page_position');
                }
            }
            $this->session->set_userdata("msg", "<span class='success'>Advertise added successfully!</span>");
            redirect(base_url() . 'backend/advertises');
        }
        $data['title'] = "Add Advertise";
        //get advertise by id
        $data['arr_advertie'] = $this->common_model->getRecords('mst_advertises', '*', array('advertise_id' => intval(isset($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        //get page and position id by advertise id
        $data['arr_relational_page'] = $this->common_model->getRecords('trans_advertise_page_position', 'page_id,position_id', array('advertise_id' => intval(isset($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        //get all advertise display pages array
        $data['arr_advertise_pages'] = $this->common_model->getRecords('mst_advertise_pages', '*', '', $order_by = '', $limit = '', $debug = 0);
        //get all advertise display position array
        $data['arr_advertise_position'] = $this->common_model->getRecords('mst_advertise_position', '*', '', $order_by = '', $limit = '', $debug = 0);
        //get all advertise category array
        $data['arr_advertise_category'] = $this->common_model->getRecords('mst_advertise_category', '*', array('status' => 'Active'), $order_by = '', $limit = '', $debug = 0);
        $data['header'] = array('title' => 'Add Advertise');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/advertises/add-advertise', $data);
        $this->load->view('backend/sections/footer');
    }

    function editAdvertise($advertise_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            $arr_ex = explode('*', $_POST['size']);
            $arr_size = explode('-', $arr_ex[1]);
            //image upload section
            if ($_FILES['input_image']['name'] != '') {
                list($w, $h) = getimagesize($_FILES['input_image']['tmp_name']);
                $arr_file = $this->findExtension($_FILES['input_image']['name']);
                $image_name = time() . '.' . $arr_file['ext'];
                $upload_dir = 'media/front/img/advertise/';
                $old_name = $upload_dir . $_POST['hidden_image'];
                unlink($old_name);
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'gif|jpg|jpeg|png|ico|bmp';
                $config['max_width'] = '102400';
                $config['max_height'] = '76800';
                $config['file_name'] = $image_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('input_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('msg', $error['error']);
                    redirect(base_url() . 'backend/edit-advertise/' . $advertise_id);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $absolute_path = $this->common_model->absolutePath();
                    $image_path = $absolute_path . $upload_dir;
                    $image_main = $image_path . "/" . $image_name;
                    $thumbs_image1 = $image_path . "/thumbs/" . $image_name;
                    if ($this->input->post("size") == "large rectangle *300-400") {
//                        $strConsole = 'convert ' . $image_main . ' -crop 240!X400!-10-10 "' . $thumbs_image1 . '"';
//                        exec($strConsole);
                        $str_console1 = "convert " . $image_main . " -resize 300!X400! " . $thumbs_image1;
                        exec($str_console1);
                    } else {
//                        $strConsole = 'convert ' . $image_main . ' -crop 300!X250!-10-10 "' . $thumbs_image1 . '"';
//                        exec($strConsole);
                        $str_console1 = "convert " . $image_main . " -resize 300!X250! " . $thumbs_image1;
                        exec($str_console1);
                    }
                }
            }
            if ($_POST['textarea_script'] != '') {
                $script = $_POST['textarea_script'];
                $upload_dir = 'media/front/img/advertise/';
                unlink($upload_dir . $_POST['hidden_image']);
                $image_name = '';
            } else
                $script = $arr_advertise[0]['script'];
            //Insert advertise
            $arr_fields = array(
                "title" => addslashes($_POST['input_title']),
                "advertise_type" => addslashes($_POST['select_ads_type_id']),
                "script" => addslashes($_POST['textarea_script']),
                "image_name" => $image_name,
                "redirect_url" => urlencode($_POST['input_redirect_url']),
                "advertise_size" => addslashes($_POST['size']),
                "expired_start_date" => date('Y-m-d H:i:s', strtotime($_POST['input_start_date'])),
                "expired_end_date" => date('Y-m-d H:i:s', strtotime($_POST['input_end_date'])),
                "status" => ($_POST['select_status']),
                "created_on" => date('Y-m-d H:i:s')
            );
            if ($_FILES['input_image']['name'] == '') {
                unset($arr_fields['image_name']);
            }
            if ($arr_fields['script'] == '') {
                unset($arr_fields['script']);
            }
            $this->common_model->updateRow('mst_advertises', $arr_fields, array('advertise_id' => $advertise_id));
            //Delete categories of advertise               
            $this->common_model->deleteRows(array('advertise_id' => $advertise_id), 'trans_advertise_category', 'advertise_id');
            //Insert advertise categories
            foreach ($_POST['select_category'] as $key => $value) {
                $arr_cat_fields = array(
                    "advertise_id" => $advertise_id,
                    "category_id" => $value
                );
                $this->common_model->insertRow($arr_cat_fields, 'trans_advertise_category');
            }
            //Delete advertise page, position    
            $this->common_model->deleteRows(array('advertise_id' => $advertise_id), 'trans_advertise_page_position', 'advertise_id');
            //Insert advertise page, position
            foreach ($_POST['input_advertise_page'] as $key => $value) {
                $arr_post_position = array();
                $arr_post_position[] = $_POST['input_advertise_position'];
                foreach ($arr_post_position as $position_key => $position_value) {
                    $arr_fields = array(
                        "advertise_id" => $advertise_id,
                        "page_id" => $value,
                        "position_id" => $position_value
                    );
                    if (empty($arr_fields['position_id']))
                        unset($arr_fields['position_id']);
                    $this->common_model->insertRow($arr_fields, 'trans_advertise_page_position');
                }
            }
            $this->session->set_userdata("msg", "<span class='success'>Advertise updated successfully!</span>");
            redirect(base_url() . 'backend/advertises');
        }
        //get advertise by id
        $data['arr_advertie'] = $this->common_model->getRecords('mst_advertises', '*', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        //get page and position id by advertise id
        $data['arr_relational_page'] = $this->common_model->getRecords('trans_advertise_page_position', 'page_id,position_id', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        //get all advertise display pages array
        $data['arr_advertise_pages'] = $this->common_model->getRecords('mst_advertise_pages', '*', '', $order_by = '', $limit = '', $debug = 0);
        //get all advertise display position array
        $data['arr_advertise_position'] = $this->common_model->getRecords('mst_advertise_position', '*', '', $order_by = '', $limit = '', $debug = 0);
        //get all advertise category array
        $data['arr_advertise_category'] = $this->common_model->getRecords('mst_advertise_category', '*', array('status' => 'Active'), $order_by = '', $limit = '', $debug = 0);
        //get advertise by id        
        $data['arr_advertise'] = $this->common_model->getRecords('mst_advertises', '*', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        //get category by advertise id        
        $arr_relational_cat = $this->common_model->getRecords('trans_advertise_category', 'category_id', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        $arr_temp = array();
        foreach ($arr_relational_cat as $val) {
            $arr_temp[] = $val['category_id'];
        }
        $data['arr_relational_cat'] = $arr_temp;
        unset($arr_temp);
        //get page and position id by advertise id        
        $arr_relational_page = $this->common_model->getRecords('trans_advertise_page_position', 'page_id,position_id', array('advertise_id' => intval(($advertise_id))), $order_by = '', $limit = '', $debug = 0);
        $arr_position = 0;
        foreach ($arr_relational_page as $val) {
            $arr_temp[] = $val['page_id'];
            $arr_position = $val['position_id'];
        }
        $data['arr_position'] = $arr_position;
        $data['arr_relational_page'] = $arr_temp;
        unset($arr_temp);
        $data['header'] = array('title' => 'Edit Advertise');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/advertises/edit-advertise', $data);
        $this->load->view('backend/sections/footer');
    }

    /*
     * get file name and extension array
     *
     */

    function findExtension($filename) {
        $filename = strtolower($filename);
        $exts = explode(".", $filename);
        $file_name = '';
        for ($i = 0; $i <= count($exts) - 2; $i++) {
            $file_name .=$exts[$i];
        }
        $n = count($exts) - 1;
        $exts = $exts[$n];
        $arr_return = array(
            'file_name' => $file_name,
            'ext' => $exts
        );
        return $arr_return;
    }

    /*
     * END findExtension
     *
     */

    public function listAdsCategories() {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_category_ids = $this->input->post('checkbox');
                if (count($arr_category_ids) > 0) {
                    if (count($arr_category_ids) > 0) {
                        #deleting the admin selected                        
                        $this->common_model->deleteRows($arr_category_ids, "mst_advertise_category", "category_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Records deleted successfully!</span>");
                } else {
                    echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
                    die;
                }
            }
        }
        $data['title'] = "Manage Advsertise Categories";
        /**
         * get advertise category list
         */
        $data['arr_ads_categories'] = $this->common_model->getRecords('mst_advertise_category', '', '', $order_by = 'category_id desc', $limit = '', $debug = 0);
        $data['header'] = array('title' => 'Manage Advsertise Categories');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/advertises/category-list', $data);
        $this->load->view('backend/sections/footer');
    }

    function addAdvertiseCategoryStatus($category_id, $status) {
        /**
         * checking admin is logged in or not
         */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $update_data = array(
            "status" => $status
        );
        $this->common_model->updateRow('mst_advertise_category', $update_data, array("category_id" => $category_id));
        $this->session->set_userdata("msg", "<span class='success'>Category status is updated successfully!</span>");
        redirect(base_url() . 'backend/advertise-categories');
    }

    function addAdvertiseCategory($category_id = '') {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            if ($_POST['edit_id'] != '') {
                // update category
                $update_data = array("category_name" => mysql_real_escape_string($_POST['input_name']));
                $this->common_model->updateRow('mst_advertise_category', $update_data, array("category_id" => $_POST['edit_id']));
                $this->session->set_userdata("msg", "<span class='success'>Category updated successfully!</span>");
            } else {
                // insert new record
                $arr_to_insert = array(
                    "category_name" => mysql_real_escape_string($_POST['input_name'])
                );
                $this->common_model->insertRow($arr_to_insert, 'mst_advertise_category');
                $this->session->set_userdata("msg", "<span class='success'>Category added successfully!</span>");
            }
            redirect(base_url() . 'backend/advertise-categories');
        }
        if ($category_id == '') {
            $data['header'] = array('title' => 'Add Advsertise Category');
            $data['edit_id'] = $category_id;
        } else {
            $data['title'] = "Update Advsertise Category";
            $data['header'] = array('title' => 'Update Advsertise Category');
            //get advertise category list
            $data['edit_id'] = $category_id;
            $condition_to_pass = array('category_id' => $category_id);
            $data['arr_ads_categories'] = $this->common_model->getRecords('mst_advertise_category', '', $condition_to_pass, $order_by = 'category_id desc', $limit = '', $debug = 0);
        }
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/advertises/add-category', $data);
        $this->load->view('backend/sections/footer');
    }

    function advertiseCheckDuplicateCategoryName() {
        //get category name
        if ($this->input->post('action') == 'Update') {
                       
            
            $arr_count = $this->common_model->getRecords("mst_advertise_category", "category_name", array("category_name" => mysql_real_escape_string($this->input->post('input_name')), "category_id !=" => $this->input->post('edit_id')));
        } else {
            
            
            $arr_count = $this->common_model->getRecords("mst_advertise_category", "category_name", array("category_name" => mysql_real_escape_string($this->input->post('input_name'))));
        }
        if (count($arr_count) > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function advertiseImage() {
        $data['arr_advertise'] = $this->advertise_model->getAllAdvertisePagePosition($page_name = 'home', $position_name = 'right');
        $this->load->view('front/advertise/advertise-image', $data);
    }

    public function postAdd() {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if ($this->input->post('add_title') != '' && $this->input->post('select_category') != '' && $this->input->post('select_ads_type') != '') {
            if ($_FILES['input_image']['name'] != '') {
                $arr_file = $this->findExtension($_FILES['input_image']['name']);
                $image_name = time() . '.' . $arr_file['ext'];
                $upload_dir = 'media/front/img/advertise/';
                $old_name = $upload_dir . $_POST['hidden_image'];
                unlink($old_name);
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'gif|jpg|jpeg|png|ico|bmp';
                $config['max_width'] = '102400';
                $config['max_height'] = '76800';
                $config['file_name'] = $image_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('input_image')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_userdata('msg', $error['error']);
                    redirect(base_url() . 'backend/edit-advertise/' . $advertise_id);
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $absolute_path = $this->common_model->absolutePath();
                    $image_path = $absolute_path . $upload_dir;
                    $image_main = $image_path . "/" . $image_name;
                    $thumbs_image_one = $image_path . "/thumbs/" . $image_name;
                    $thumbs_image_two = $image_path . "/upper-thumbs/" . $image_name;
                    $str_console_two = "convert " . $image_main . " -resize 300!X250! " . $thumbs_image_one;
                    exec($str_console_two);
                    $str_console1 = "convert " . $image_main . " -resize 300!X400! " . $thumbs_image_two;
                    exec($str_console1);
                }
            }
            $data['user_session'] = $this->session->userdata('user_account');
            if (!empty($data['user_session'])) {
                //Insert advertise
                $arr_fields = array(
                    "title" => addslashes($this->input->post('add_title')),
                    "advertise_type" => addslashes($this->input->post('select_ads_type')),
                    "script" => addslashes($this->input->post('textarea_script')),
                    "image_name" => $image_name,
                    "status" => 'Inactive',
                    "created_on" => date('Y-m-d H:i:s'),
                    "added_by" => $data['user_session']['user_id']
                );
                if ($_FILES['input_image']['name'] == '') {
                    unset($arr_fields['image_name']);
                }
                if ($arr_fields['script'] == '') {
                    unset($arr_fields['script']);
                }
                $last_insert_ads_id = $this->common_model->insertRow($arr_fields, 'mst_advertises');
                $this->session->unset_userdata('post');
                //Insert advertise categories
                foreach ($this->input->post('select_category') as $key => $value) {
                    $arr_cat_fields = array(
                        "advertise_id" => $last_insert_ads_id,
                        "category_id" => $value
                    );
                    $this->common_model->insertRow($arr_cat_fields, 'trans_advertise_category');
                }
                //Insert advertise page, position
                foreach ($this->input->post('input_advertise_page') as $key => $value) {
                    $arr_post_position = array();
                    $arr_post_position[] = $this->input->post('input_advertise_position');
                    foreach ($arr_post_position as $position_key => $position_value) {
                        $arr_fields = array(
                            "advertise_id" => $last_insert_ads_id,
                            "page_id" => $value,
                            "position_id" => '1'
                        );
                        $this->common_model->insertRow($arr_fields, 'trans_advertise_page_position');
                    }
                }
                $this->session->set_userdata("message", "<span class='success'>Advertise has been posted successfully!</span>");
                redirect(base_url());
            } else {
                $postarr = array();
                $postarr = $this->input->post();
                $postarr['image_name'] = $image_name;
                $this->session->set_userdata('post_advertise', $postarr);
                redirect(base_url() . 'signin');
            }
        }
        /** Get advertise category * */
        $data['arr_advertise_pages'] = $this->common_model->getRecords('mst_advertise_pages', '*', '', $order_by = '', $limit = '', $debug = 0);
        /** Get advertise category * */
        $data['arr_advertise_category'] = $this->common_model->getRecords('mst_advertise_category', '*', array('status' => 'Active'), $order_by = '', $limit = '', $debug = 0);
        /** Get Advertisement  * */
        $data['arr_advertise_upper'] = $this->advertise_model->getAllAdvertisePagePosition($page_name = 'blog', 'upper side');
        $data['arr_advertise_lower'] = $this->advertise_model->getAllAdvertisePagePosition($page_name = 'blog', 'lower side');
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/includes/header-2');
        $this->load->view('front/advertise/post-add', $data);
        $this->load->view('front/includes/footer');
    }

}

/* End of file advertise.php */
/* Location: ./application/controllers/advertise.php */