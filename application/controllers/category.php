<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('category_model');
    }

    function listCategory($parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_cat_ids = $this->input->post('checkbox');
                if (count($arr_cat_ids) > 0) {
                    #deleting the user selected
                    foreach ($arr_cat_ids as $cat_id) {
                        $cat_img = $this->common_model->getRecords("mst_categories", "category_image", array("category_id" => $cat_id));
                        $cat_img = $cat_img[0]["category_image"];
                        @unlink("media/front/img/category-images/" . $cat_img);
                        @unlink("media/front/img/category-images/thumbs/" . $cat_img);
                        @unlink("media/front/img/category-images/thumbs-for-backend/" . $cat_img);
                        @unlink("media/front/img/category-images/204X159/" . $cat_img);
                        @unlink("media/front/img/category-images/79X103/" . $cat_img);
                    }
                    $this->common_model->deleteRows($arr_cat_ids, "mst_categories", "category_id");
                    $this->common_model->deleteRows($arr_cat_ids, "trans_categories_lang_map", "category_id");
                    $this->category_model->deleteurimap($arr_cat_ids, "mst_uri_map", "rel_id");
                }
                $parent_category = $this->common_model->getRecords("mst_categories", "category_name", array("category_id" => $parent_id));
                $parent_category = $parent_category[0]["category_name"];
                $this->session->set_userdata("msg", "<span class='success'>" . $parent_category . " deleted successfully!</span>");
                redirect(base_url() . 'backend/category/list/' . $parent_id);
            }
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        #using the admin model
        $this->load->model('admin_model');
        $data['title'] = "Manage Category";
        $data['msg'] = '';
        $data['arr_interests'] = $this->common_model->getRecords("mst_categories", "category_id,category_name", array("category_id" => "18"));
        $data['arr_interests'] = end($data['arr_interests']);
        $data['arr_categories'] = $this->category_model->getcategoryListByParentId($parent_id);
        $category = $data['arr_categories'][0]["parent_category"];
        $data['category'] = $category;
        $data['parent_id'] = $parent_id;
        $data['header'] = array('title' => 'Manage ' . $category);
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/list', $data);
        $this->load->view('backend/sections/footer');
    }

    /* Function To Check Category Name Already Exists Or Not. */

    public function checkCategoryNameExist() {
        if ($_POST['type'] == "edit") {
            #checking username already exist or not for edit user
            if (strtolower($this->input->post('category_name')) == strtolower($this->input->post('old_category_name'))) {
                echo "true";
            } else {
                $arr_cat_detail = $this->common_model->getRecords('mst_categories', "", array("category_name" => $this->input->post('category_name')));
                if (count($arr_cat_detail) > 0) {
                    echo "false";
                } else {
                    echo "true";
                }
            }
        } else {
            #checking username already exist or not for add user
            $arr_cat_detail = $this->common_model->getRecords('mst_categories', "", array("category_name" => $this->input->post('category_name')));

            if (count($arr_cat_detail) > 0) {
                echo "false";
            } else {
                echo "true";
            }
        }
    }

    function editCategory($Category_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $this->load->model('admin_model');
        $Category_id = base64_decode($Category_id);
        $data['arr_Category'] = $this->category_model->getCategoryDetails($Category_id);
        $data['arr_category'] = $data['arr_Category'][0];
        $category = $data['arr_category']["parent_category"];
        if ($this->input->post()) {
            $image_data = array();
            if ($_FILES['category_image']['name'] != "") {
                $old_img = $this->input->post("old_filename");
                @unlink("media/front/img/category-images/" . $old_img);
                @unlink("media/front/img/category-images/thumbs/" . $old_img);
                @unlink("media/front/img/category-images/thumbs-for-backend/" . $old_img);
                @unlink("media/front/img/category-images/79X103/" . $old_img);
                @unlink("media/front/img/category-images/204X159/" . $old_img);
                $config['upload_path'] = 'media/front/img/category-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                //loading uploda library
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('category_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    for ($i = 0; $i < 4; $i++) {
                        if ($i == 0) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/thumbs',
                                'maintain_ratio' => true,
                                'width' => 18,
                                'height' => 18
                            );
                        } elseif ($i == 1) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/thumbs-for-backend',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );
                        } elseif ($i == 2) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/79X103',
                                'maintain_ratio' => false,
                                'width' => 79,
                                'height' => 103
                            );
                        } elseif ($i == 3) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/204X159',
                                'maintain_ratio' => false,
                                'width' => 204,
                                'height' => 159
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
            $Category_id = $this->input->post('edit_id');
            $parent_cat = $this->input->post("parent_cat");
            $arr_to_update = array(
                "category_name" => mysql_real_escape_string($this->input->post('category_name')),
                "category_image" => $cat_img,
                'parent_id' => mysql_real_escape_string(intval($this->input->post('parent_id'))),
                'page_title' => mysql_real_escape_string($this->input->post('category_title')),
                'page_keywords' => addslashes($this->input->post('meta_keyword')),
                'page_description' => addslashes($this->input->post('text_content'))
            );
            $this->common_model->updateRow('mst_categories', $arr_to_update, array("category_id" => $this->input->post('edit_id')));
            $arr_to_update = array(
                "category_name" => $this->input->post('category_name'),
                'page_title' => $this->input->post('category_title'),
                'page_keywords' => $this->input->post('meta_keyword'),
            );
            $this->common_model->updateRow('trans_categories_lang_map', $arr_to_update, array("category_id" => $this->input->post('edit_id'), "lang_id" => 17));
            $url = $this->common_model->seoUrl(trim($this->input->post('category_name'))) . '-' . $this->input->post('edit_id');
            $rel_id = $Category_id;
            $arr_insert_url = array(
                "url" => $url
            );
            $this->common_model->updateRow('mst_uri_map', $arr_insert_url, array('type' => 'Category', 'rel_id' => $this->input->post('edit_id')));

            $this->session->set_userdata("msg", "<span class='success'>" . $parent_cat . " updated successfully!</span>");
            redirect(base_url() . 'backend/category/list/' . $this->input->post('parent_id'));
        }
        #using the admin model
        $data['msg'] = '';
        $data['category_id'] = $Category_id;
        $data['parent_category'] = $category;
        $data['arr_all_categories'] = $this->category_model->getCategoryList();
        $data['header'] = array('title' => 'Edit ' . $category);
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/edit-category', $data);
        $this->load->view('backend/sections/footer');
    }

    public function editCategoryLanguage($edit_id) {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* getting commen data required */
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if ($this->input->post('inputName') != "") {
                if ($this->input->post('category_id') != '' && $this->input->post('lang_id') != '') {
                    $edit_id = $this->input->post('category_id');
                    $arr_Category = $this->category_model->getCategory(intval(($edit_id)), intval($this->input->post('lang_id')));
                    if (isset($arr_Category[0]['category_name'])) {
                        $arr_to_update = array(
                            "category_name" => mysql_real_escape_string($_POST['inputName']),
                            'page_title' => mysql_real_escape_string($_POST['inputPageTitle']),
                            'page_keywords' => mysql_real_escape_string($_POST['inputPageKeywords']),
                            'page_keyword_content' => mysql_real_escape_string($_POST['inputPageDescription'])
                        );
                        /* condition to update record	 */
                        $condition_array = array('lang_id' => intval($this->input->post('lang_id')), 'category_id' => intval(($this->input->post('category_id'))));
                        /* updating the Category into database */
                        $this->common_model->updateRow('trans_categories_lang_map', $arr_to_update, $condition_array);
                    } else {
                        $arr_to_insert = array(
                            "category_name" => mysql_real_escape_string($this->input->post('inputName')),
                            'page_title' => mysql_real_escape_string($this->input->post('inputPageTitle')),
                            'page_keywords' => mysql_real_escape_string($this->input->post('inputPageKeywords')),
                            'page_keyword_content' => mysql_real_escape_string($this->input->post('inputPageDescription')),
                            'category_id' => $this->input->post('category_id'),
                            'lang_id' => $this->input->post('lang_id')
                        );
                        $this->common_model->insertRow($arr_to_insert, 'trans_categories_lang_map');
                    }
                    /* setting session for displaying notiication message. */
                    $this->session->set_userdata('msg', "<span class='success'>Record updated successfully!</span>");
                }
                /* redirecting to Category list */
                redirect(base_url() . "backend/category/list");
            }
        }
        $data['title'] = "Edit Multi-Langual Category";
        $data['edit_id'] = $edit_id;
        $arr_Category = $this->category_model->getCategoryDetails(intval(($edit_id)));
        // single row fix
        $data['arr_Category'] = end($arr_Category);
        /* getting all the active languages from the database */
        $data['arr_languages'] = $this->common_model->getRecords("mst_languages", "", array("lang_id" => 12));
        $data['msg'] = '';
        $this->load->view('backend/category/edit-language-category', $data);
    }

    function getCategoryLanguage() {
        if ($this->input->post('lang_id') != "") {
            //echo '<pre>'; print_r($this->input->post); echo '</pre>';
            /* getting the global settings using the language id and parameter id. */
            $arr_language_values = $this->category_model->getcategory(intval($this->input->post('edit_id')), intval($this->input->post('lang_id')));
            $arr_to_return = array();
            if (count($arr_language_values) > 0) {
                $arr_to_return["Category_name"] = $arr_language_values[0]["Category_name"];
                $arr_to_return["page_title"] = $arr_language_values[0]["page_title"];
                $arr_to_return["page_keywords"] = $arr_language_values[0]["page_keywords"];
                $arr_to_return["page_keyword_content"] = $arr_language_values[0]["page_keyword_content"];
                $arr_to_return["is_inserted"] = "Y";
            } else {
                $arr_to_return["Category_name"] = "";
                $arr_to_return["page_title"] = "";
                $arr_to_return["page_keywords"] = "";
                $arr_to_return["page_keyword_content"] = "";
                $arr_to_return["is_inserted"] = "N";
            }
            /* encodeing the array into json format */
            echo json_encode($arr_to_return);
        }
    }

    public function uploadImage() {
        if ($_FILES["imageName"]['name'] != "") {
            $file_destination = "media/backend/img/cle-images/" . str_replace(" ", "_", microtime()) . "." . strtolower(end(explode(".", $_FILES["imageName"]['name'])));
            move_uploaded_file($_FILES['imageName']['tmp_name'], $file_destination);
            echo '<div id="image">' . base_url() . $file_destination . '</div>';
        } else
            echo "false";
    }

    public function getlanguageforcategories() {
        $lang_id = $this->input->post('lang');
        $category_id = $this->input->post('category_id');
        if ($lang_id != '17') {
            $arr_language_values = $this->common_model->getRecords("trans_categories_lang_map", "", array("category_id" => $category_id, "lang_id" => $lang_id));
        } else {
            $arr_language_values1 = $this->common_model->getRecords("trans_categories_lang_map", "", array("category_id" => $category_id, "lang_id" => $lang_id));
            if (count($arr_language_values1) > 0) {
                $arr_language_values = $this->common_model->getRecords("trans_categories_lang_map", "", array("category_id" => $category_id, "lang_id" => $lang_id));
            } else {
                $arr_language_values = $this->common_model->getRecords("mst_categories", "", array("category_id" => $category_id));
            }
        }
        $arr_to_return = array();
        if (count($arr_language_values) > 0) {
            $arr_to_return["category_name"] = stripslashes($arr_language_values[0]["category_name"]);
            $arr_to_return["page_title"] = stripslashes($arr_language_values[0]["page_title"]);
            $arr_to_return["page_keywords"] = stripslashes($arr_language_values[0]["page_keywords"]);
            if (!empty($arr_language_values[0]["page_description"])) {
                $arr_to_return["page_keyword_content"] = stripslashes($arr_language_values[0]["page_description"]);
            } else {
                $arr_to_return["page_keyword_content"] = stripslashes($arr_language_values[0]["page_keyword_content"]);
            }
            $arr_to_return["is_inserted"] = "Y";
        } else {
            $arr_to_return["category_name"] = '';
            $arr_to_return["page_title"] = '';
            $arr_to_return["page_keywords"] = '';
            $arr_to_return["page_keyword_content"] = '';
            $arr_to_return["is_inserted"] = "N";
        }
        /* encodeing the array into json format */
        echo json_encode($arr_to_return);
    }

    function addCategory($parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            $image_data = array();
            if ($_FILES['category_image']['name'] != "") {
                $config['upload_path'] = 'media/front/img/category-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                //loading uploda library
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('category_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    for ($i = 0; $i < 4; $i++) {
                        if ($i == 0) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/thumbs/',
                                'maintain_ratio' => false,
                                'width' => 18,
                                'height' => 18
                            );
                        } elseif ($i == 1) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/thumbs-for-backend',
                                'maintain_ratio' => false,
                                'width' => 100,
                                'height' => 100
                            );
                        } elseif ($i == 2) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/79X103',
                                'maintain_ratio' => false,
                                'width' => 79,
                                'height' => 103
                            );
                        } elseif ($i == 3) {
                            $config = array(
                                'source_image' => $image_data['full_path'],
                                'new_image' => 'media/front/img/category-images/204X159',
                                'maintain_ratio' => false,
                                'width' => 204,
                                'height' => 159
                            );
                        }
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            $arr_to_insert = array(
                "category_name" => mysql_real_escape_string($this->input->post('category_name')),
                "category_image" => $image_data['file_name'],
                'parent_id' => intval($this->input->post('parent_id')),
                'page_title' => mysql_real_escape_string($this->input->post('category_title')),
                'page_keywords' => addslashes($this->input->post('meta_keyword')),
                'page_description' => addslashes($this->input->post('text_content'))
            );
            $arr_cat_detail = $this->common_model->getRecords('mst_categories', "", array("category_name" => $this->input->post('category_name')));
            if (count($arr_cat_detail) == 0) {
                $insert_id = $this->common_model->insertRow($arr_to_insert, 'mst_categories');
            }
            $arr_to_insert_lang = array(
                "category_name" => mysql_real_escape_string($this->input->post('category_name')),
                'category_id ' => $insert_id,
                'lang_id' => 17,
                'page_title' => mysql_real_escape_string($this->input->post('category_title')),
                'page_keywords' => addslashes($this->input->post('meta_keyword')),
            );
            if (count($arr_cat_detail) == 0) {
                $this->common_model->insertRow($arr_to_insert_lang, 'trans_categories_lang_map');
            }
            $url = $this->common_model->seoUrl(trim($this->input->post('category_url'))) . '-' . $insert_id;
            $arr_insert_url = array(
                "url" => $url,
                'type' => 'Category',
                'rel_id' => $insert_id
            );
            $this->common_model->insertRow($arr_insert_url, 'mst_uri_map');
            $parent_category = $this->input->post("parent_category");
            $this->session->set_userdata("msg", "<span class='success'>" . $parent_category . " added successfully!</span>");
            redirect(base_url() . 'backend/category/list/' . intval($this->input->post('parent_id')));
        }
        #using the admin model
        $this->load->model('admin_model');
        $data['title'] = "Manage Category";
        $data['arr_category'] = array();
        $data['arr_category'] = array(
            "category_name" => '',
            'parent_id' => '',
            'page_title' => '',
            'page_keywords' => '',
            'page_description' => '',
            'page_url' => ''
        );
        $data['arr_all_categories'] = $this->category_model->getCategoryList();
        $data['msg'] = '';
        $data['edit_id'] = '';
        $category = $this->common_model->getRecords("mst_categories", "category_name", array("category_id" => $parent_id));
        $category = $category[0]["category_name"];
        $data['category'] = $category;
        $data['parent_id'] = $parent_id;
        $data['header'] = array('title' => 'Add ' . $category);
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/add', $data);
        $this->load->view('backend/sections/footer');
    }

    function addInterest($parent_id, $other_interest_id = '') {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            $image_data = array();
            if ($_FILES['category_image']['name'] != "") {
                $config['upload_path'] = 'media/front/img/category-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '9000000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = rand();
                //loading uploda library
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
                                'new_image' => 'media/front/img/category-images/thumbs/',
                                'maintain_ratio' => false,
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
            }
            $arr_to_insert = array(
                "category_name" => mysql_real_escape_string($this->input->post('category_name')),
                "category_image" => $image_data['file_name'],
                'parent_id' => intval($this->input->post('parent_id')),
                'page_title' => mysql_real_escape_string($this->input->post('category_title')),
                'page_keywords' => mysql_real_escape_string($this->input->post('meta_keyword')),
                'page_description' => addslashes($this->input->post('text_content'))
            );
            $arr_cat_detail = $this->common_model->getRecords('mst_categories', "", array("category_name" => $this->input->post('category_name')));
            if (count($arr_cat_detail) == 0) {
                $insert_id = $this->common_model->insertRow($arr_to_insert, 'mst_categories');
            }
            if ($this->uri->segment(5) != "") {
                $this->common_model->updateRow("trans_temp_interest", array("status" => "1"), array("temp_interest_id" => $other_interest_id));
            }
            $arr_to_insert_lang = array(
                "category_name" => mysql_real_escape_string($this->input->post('category_name')),
                'category_id ' => $insert_id,
                'lang_id' => 17,
                'page_title' => mysql_real_escape_string($this->input->post('category_title')),
                'page_keywords' => mysql_real_escape_string($this->input->post('meta_keyword')),
            );
            if (count($arr_cat_detail) == 0) {
                $this->common_model->insertRow($arr_to_insert_lang, 'trans_categories_lang_map');
            }

            $url = $this->common_model->seoUrl(trim($this->input->post('category_url'))) . '-' . $insert_id;
            $arr_insert_url = array(
                "url" => $url,
                'type' => 'Category',
                'rel_id' => $insert_id
            );
            $this->common_model->insertRow($arr_insert_url, 'mst_uri_map');
            $parent_category = $this->input->post("parent_category");

            $this->session->set_userdata("msg", "<span class='success'>Interest added successfully!</span>");
            redirect(base_url() . 'backend/categories/list-interest/' . $parent_id);
        }
        #using the admin model
        $this->load->model('admin_model');
        $data['title'] = "Manage Category";
        $data['arr_category'] = array();
        $data['arr_category'] = array(
            "category_name" => '',
            'parent_id' => '',
            'page_title' => '',
            'page_keywords' => '',
            'page_description' => '',
            'page_url' => ''
        );
        $data['arr_all_categories'] = $this->category_model->getCategoryList();
        if ($other_interest_id != "") {
            $data["arr_other_interest"] = $this->category_model->getOtherInterestById($other_interest_id);
        }
        $data['msg'] = '';
        $data['edit_id'] = '';
        $data['parent_id'] = $parent_id;
        $data['header'] = array('title' => 'Add Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/add-interest', $data);
        $this->load->view('backend/sections/footer');
    }

    public function listInterest($parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_cat_ids = $this->input->post('checkbox');
                if (count($arr_cat_ids) > 0) {
                    #deleting the user selected
                    foreach ($arr_cat_ids as $cat_id) {
                        $cat_img = $this->common_model->getRecords("mst_categories", "category_image", array("category_id" => $cat_id));
                        $cat_img = $cat_img[0]["category_image"];
                        @unlink("media/front/img/category-images/" . $cat_img);
                        @unlink("media/front/img/category-images/thumbs/" . $cat_img);
                        @unlink("media/front/img/category-images/thumbs-for-backend/" . $cat_img);
                    }
                    $this->common_model->deleteRows($arr_cat_ids, "mst_categories", "category_id");
                    $this->common_model->deleteRows($arr_cat_ids, "trans_categories_lang_map", "category_id");
                    $this->category_model->deleteurimap($arr_cat_ids, "mst_uri_map", "rel_id");
                }
                $parent_category = $this->common_model->getRecords("mst_categories", "category_name", array("category_id" => $parent_id));
                $parent_category = $parent_category[0]["category_name"];
                $this->session->set_userdata("msg", "<span class='success'>Interest deleted successfully!</span>");
                redirect(base_url() . 'backend/categories/list-interest/' . $parent_id);
            }
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        #using the admin model
        $this->load->model('admin_model');
        $data['title'] = "Manage Category";
        $data['msg'] = '';
        $data['arr_interests'] = $this->common_model->getRecords("mst_categories", "category_id,category_name", array("category_id" => "18"));
        $data['arr_interests'] = end($data['arr_interests']);
        $data['arr_categories'] = $this->category_model->getcategoryListByParentId(base64_decode($parent_id));
        $category = $data['arr_categories'][0]["parent_category"];
        $data['category'] = $category;
        $data['parent_id'] = base64_decode($parent_id);
        $data['header'] = array('title' => 'Manage Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/list-interest', $data);
        $this->load->view('backend/sections/footer');
    }

    public function editInterest($Category_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $this->load->model('admin_model');
        $Category_id = base64_decode($Category_id);
        $data['arr_Category'] = $this->category_model->getCategoryDetails($Category_id);
        $data['arr_category'] = $data['arr_Category'][0];
        $category = $data['arr_category']["parent_category"];
        if ($this->input->post()) {
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
                //loading uploda library
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
                "category_name" => mysql_real_escape_string($this->input->post('category_name')),
                "category_image" => $cat_img,
                'parent_id' => mysql_real_escape_string(intval($this->input->post('parent_id'))),
                'page_title' => mysql_real_escape_string($this->input->post('category_title')),
                'page_keywords' => mysql_real_escape_string($this->input->post('meta_keyword')),
                'page_description' => addslashes($this->input->post('text_content'))
            );
            $this->common_model->updateRow('mst_categories', $arr_to_update, array("category_id" => $this->input->post('edit_id')));
            $arr_to_update = array(
                "category_name" => $this->input->post('category_name'),
                'page_title' => $this->input->post('category_title'),
                'page_keywords' => $this->input->post('meta_keyword'),
            );
            $this->common_model->updateRow('trans_categories_lang_map', $arr_to_update, array("category_id" => $this->input->post('edit_id'), "lang_id" => 17));
            $url = $this->common_model->seoUrl(trim($this->input->post('category_name'))) . '-' . $this->input->post('edit_id');
            $rel_id = $Category_id;
            $arr_insert_url = array(
                "url" => $url
            );
            $this->common_model->updateRow('mst_uri_map', $arr_insert_url, array('type' => 'Category', 'rel_id' => $this->input->post('edit_id')));
            $this->session->set_userdata("msg", "<span class='success'>Interest updated successfully!</span>");
            redirect(base_url() . 'backend/categories/list-interest/' . base64_encode($this->input->post('parent_id')));
        }
        #using the admin model
        $data['msg'] = '';
        $data['category_id'] = $Category_id;
        $data['parent_category'] = $category;
        $data['header'] = array('title' => 'Edit Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/edit-interest', $data);
        $this->load->view('backend/sections/footer');
    }

    function postForTimeline($category_id, $parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {

            if ($_FILES['post_image']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                    if ($_FILES['post_image']['size'][$i] > 10240000) {
                        $this->session->set_userdata("msg", "<span class='success'>Only 10MB jpg|jpeg|gif|png files size  are allowed!</span>");
                        redirect(base_url() . 'backend/categories/post-for-timeline/' . $category_id . '/' . intval($this->input->post('parent_id')));
                    }
                }
            } elseif ($_FILES['post_video']['name'] != "") {
                if ($_FILES['post_video']['size'] > 512000000) {
                    $this->session->set_userdata("msg", "<span class='success'>Only 512MB avi|flv|wmv|mpeg|mp3|mp4|mov|ogg files size  are allowed!</span>");
                    redirect(base_url() . 'backend/categories/post-for-timeline/' . $category_id . '/' . intval($this->input->post('parent_id')));
                }
            } elseif ($_FILES['post_files']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_files']['name']); $i++) {
                    if ($_FILES['post_files']['size'][$i] > 10240000) {
                        $this->session->set_userdata("msg", "<span class='success'>Only 10MB size doc|docx|txt|pdf files are allowed!</span>");
                        redirect(base_url() . 'backend/categories/post-for-timeline/' . $category_id . '/' . intval($this->input->post('parent_id')));
                    }
                }
            }
            $arr_to_insert = array(
                "user_id" => $data["user_account"]["user_id"],
                "category_id" => intval($this->input->post('parent_id')),
                'sub_category_id' => intval($this->input->post('category_id')),
                'timeline_post_data' => mysql_real_escape_string($this->input->post('post_title')),
                'timeline_visibility' => "1",
                'timeline_posted_date' => date("Y-m-d H:i:s"),
                'timeline_status' => "1"
            );
            $insert_id = $this->common_model->insertRow($arr_to_insert, 'mst_timeline');
            if ($_FILES['post_image']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                    $_FILES['userfile']['name'] = $_FILES['post_image']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['post_image']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['post_image']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['post_image']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['post_image']['size'][$i];
                    $config['file_name'] = time();
                    $config['allowed_types'] = 'jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG';
                    $config['max_size'] = '10000';
                    $config['upload_path'] = './media/front/img/post-images/';
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload()) {
                        $data["image_file"] = $this->upload->data();
                        $img_name = $data ["image_file"]['file_name'];
                        $im = "$img_name";
                        $config['source_image'] = '';
                        $config['image_library'] = 'gd2';
                        $config['overwrite'] = FALSE;
                        $config['source_image'] = './media/front/img/post-images/';
                        $this->load->library('image_lib', $config);
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $image_config = array(
                            'source_image' => $data["image_file"]['full_path'],
                            'new_image' => 'media/front/img/post-images/thumbs/',
                            'maintain_ratio' => TRUE,
                            'width' => 100,
                            'height' => 100
                        );
                        $this->image_lib->initialize($image_config);
                        $resize_rc = $this->image_lib->resize();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                    }
                    $file_name = $img_name;
                    $media_type = '0';
                    if ($file_name == "" && $media_type == "") {
                        $file_name = "";
                        $media_type = "";
                    }
                    $arr_to_insert_img = array(
                        "timeline_id" => $insert_id,
                        'timeline_media_path ' => $file_name,
                        'timeline_media_type' => $media_type,
                        'timeline_media_status' => "1"
                    );
                    $this->common_model->insertRow($arr_to_insert_img, 'trans_timeline_media');
                }
            }


            if ($_FILES['post_video']['name'] != "") {
                $file_unique_name = uniqid();
                $config['allowed_types'] = 'avi|flv|wmv|mpeg|mp3|mp4|mov|ogg';
                $config['upload_path'] = './media/front/post-video/';
                $config['max_size'] = '512000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('post_video')) {
                    $this->session->set_userdata('mess', 'image_uploading_error');
                    $error = array('error' => $this->upload->display_errors());
                    redirect(base_url() . 'backend/categories/post-for-timeline/' . ($category_id) . '/' . $parent_id);
                } else {

                    $this->load->library('image_lib');
                    $upload_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $image_name = $image_data['file_name'];
                    $avi_filename_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $image_data["file_name"];
                    $flv_file_from_avi_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $file_unique_name . ".flv";
                    exec('ffmpeg -i ' . $avi_filename_wthBasePath . '-ar 44100 ' . $flv_file_from_avi_wthBasePath . '');
                    $media = explode('/', $upload_data['upload_data']['file_type']);
                    $file_name = $file_unique_name . ".flv";
                    $media_type = '1';
                }
                if ($file_name == "" && $media_type == "") {
                    $file_name = "";
                    $media_type = "";
                }
                $arr_to_insert_media = array(
                    "timeline_id" => $insert_id,
                    'timeline_media_path ' => $file_name,
                    'timeline_media_type' => $media_type,
                    'timeline_media_status' => "1"
                );
                $this->common_model->insertRow($arr_to_insert_media, 'trans_timeline_media');
            }

            if ($_FILES['post_files']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_files']['name']); $i++) {
                    $_FILES['userfile']['name'] = $_FILES['post_files']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['post_files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['post_files']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['post_files']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['post_files']['size'][$i];
                    $config['file_name'] = time() . rand(1000, 9999) . $i;
                    $config['allowed_types'] = 'doc|docx|txt|pdf';
                    $config['max_size'] = '10000';
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
                    $file_name = $img_name;
                    $media_type = '2';
                    if ($file_name == "" && $media_type == "") {
                        $file_name = "";
                        $media_type = "";
                    }
                    $arr_to_insert_img = array(
                        "timeline_id" => $insert_id,
                        'timeline_media_path ' => $file_name,
                        'timeline_media_type' => $media_type,
                        'timeline_media_status' => "1"
                    );
                    $this->common_model->insertRow($arr_to_insert_img, 'trans_timeline_media');
                }
            }
            $this->session->set_userdata("msg", "<span class='success'>Timeline post added successfully!</span>");
            redirect(base_url() . 'backend/categories/view-timeline/' . $category_id . '/' . intval($this->input->post('parent_id')));
        }
        #using the admin model
        $data['category_id'] = base64_decode($category_id);
        $data['parent_id'] = $parent_id;
        $data['header'] = array('title' => 'Post For Timeline');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/post-for-timeline', $data);
        $this->load->view('backend/sections/footer');
    }

    function editPostTimeline($timeline_id, $parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            $post_timeline_media = $this->input->post("timeline_media_type");
            $timeline_media_path = $this->common_model->getRecords('trans_timeline_media', "timeline_media_path,timeline_media_type", array("timeline_id" => base64_decode($timeline_id)));
            if ($post_timeline_media == 0) {
                foreach ($timeline_media_path as $media_path) {
                    if ($media_path["timeline_media_type"] == "1") {
                        @unlink("media/front/post-video/" . $media_path["timeline_media_path"]);
                        $this->common_model->deleteRows(array(base64_decode($timeline_id)), "trans_timeline_media", "timeline_id");
                    } elseif ($media_path["timeline_media_type"] == "2") {
                        @unlink("media/front/img/post-images/" . $media_path["timeline_media_path"]);
                        $this->common_model->deleteRows(array(base64_decode($timeline_id)), "trans_timeline_media", "timeline_id");
                    }
                }
            } elseif ($post_timeline_media == 1) {
                foreach ($timeline_media_path as $media_path) {
                    if ($media_path["timeline_media_type"] == "0") {
                        @unlink("media/front/img/post-images/" . $media_path["timeline_media_path"]);
                        @unlink("media/front/img/post-images/thumbs/" . $media_path["timeline_media_path"]);
                        $this->common_model->deleteRows(array(base64_decode($timeline_id)), "trans_timeline_media", "timeline_id");
                    } elseif ($media_path["timeline_media_type"] == "2") {
                        @unlink("media/front/img/post-images/" . $media_path["timeline_media_path"]);
                        $this->common_model->deleteRows(array(base64_decode($timeline_id)), "trans_timeline_media", "timeline_id");
                    }
                }
            } elseif ($post_timeline_media == 2) {

                foreach ($timeline_media_path as $media_path) {
//                    print_r($media_path); die;
                    if ($media_path["timeline_media_type"] == "0") {
                        @unlink("media/front/img/post-images/" . $media_path["timeline_media_path"]);
                        @unlink("media/front/img/post-images/thumbs/" . $media_path["timeline_media_path"]);
                        $this->common_model->deleteRows(array(base64_decode($timeline_id)), "trans_timeline_media", "timeline_id");
                    } elseif ($media_path["timeline_media_type"] == "1") {
                        @unlink("media/front/post-video/" . $media_path["timeline_media_path"]);
                        $this->common_model->deleteRows(array(base64_decode($timeline_id)), "trans_timeline_media", "timeline_id");
                    }
                }
            }



            if ($_FILES['post_image']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                    if ($_FILES['post_image']['size'][$i] > 10240000) {
                        $this->session->set_userdata("msg", "<span class='success'>Only 10MB jpg|jpeg|gif|png files size  are allowed!</span>");
                        redirect(base_url() . 'backend/categories/edit-post-timeline/' . $timeline_id . '/' . $parent_id);
                    }
                }
            } elseif ($_FILES['post_video']['name'] != "") {
                if ($_FILES['post_video']['size'] > 512000000) {
                    $this->session->set_userdata("msg", "<span class='success'>Only 512MB avi|flv|wmv|mpeg|mp3|mp4|mov|ogg files size  are allowed!</span>");
                    redirect(base_url() . 'backend/categories/edit-post-timeline/' . $timeline_id . '/' . $parent_id);
                }
            } elseif ($_FILES['post_files']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_files']['name']); $i++) {
                    if ($_FILES['post_files']['size'][$i] > 10240000) {
                        $this->session->set_userdata("msg", "<span class='success'>Only 10MB size doc|docx|txt|pdf files are allowed!</span>");
                        redirect(base_url() . 'backend/categories/edit-post-timeline/' . $timeline_id . '/' . $parent_id);
                    }
                }
            }
            $arr_to_update = array(
                "category_id" => intval($this->input->post('parent_id')),
                'sub_category_id' => intval($this->input->post('category_id')),
                'timeline_post_data' => mysql_real_escape_string(($this->input->post('post_title'))),
            );
            $this->common_model->updateRow('mst_timeline', $arr_to_update, array("timeline_id" => base64_decode($timeline_id)));
            if ($_FILES['post_image']['name'][0] != "") {

                for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                    $_FILES['userfile']['name'] = $_FILES['post_image']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['post_image']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['post_image']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['post_image']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['post_image']['size'][$i];
                    $config['file_name'] = time();
                    $config['allowed_types'] = 'jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG';
                    $config['max_size'] = '10000';
                    $config['upload_path'] = './media/front/img/post-images/';
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload()) {
                        $data["image_file"] = $this->upload->data();
                        $img_name = $data ["image_file"]['file_name'];
                        $im = "$img_name";
                        $config['source_image'] = '';
                        $config['image_library'] = 'gd2';
                        $config['overwrite'] = FALSE;
                        $config['source_image'] = './media/front/img/post-images/';
                        $this->load->library('image_lib', $config);
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $image_config = array(
                            'source_image' => $data["image_file"]['full_path'],
                            'new_image' => 'media/front/img/post-images/thumbs/',
                            'maintain_ratio' => TRUE,
                            'width' => 100,
                            'height' => 100
                        );
                        $this->image_lib->initialize($image_config);
                        $resize_rc = $this->image_lib->resize();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                    }
                    $file_name = $img_name;
                    $media_type = '0';
                    if ($file_name == "" && $media_type == "") {
                        $file_name = "";
                        $media_type = "";
                    }
                    $arr_to_update_img = array(
                        "timeline_id" => base64_decode($timeline_id),
                        'timeline_media_path ' => $file_name,
                        'timeline_media_type' => $media_type,
                        'timeline_media_status' => "1"
                    );
                    $this->common_model->insertRow($arr_to_update_img, 'trans_timeline_media', array("timeline_id" => base64_decode($timeline_id)));
                }
            }
            if ($_FILES['post_video']['name'] != "") {
                $file_unique_name = uniqid();
                $config['allowed_types'] = 'avi|flv|wmv|mpeg|mp3|mp4|mov|ogg';
                $config['upload_path'] = './media/front/post-video/';
                $config['max_size'] = '512000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('post_video')) {
                    $this->session->set_userdata('mess', 'image_uploading_error');
                    $error = array('error' => $this->upload->display_errors());
                    redirect(base_url() . 'backend/categories/edit-post-timeline/' . ($timeline_id) . '/' . $parent_id);
                } else {
                    $this->load->library('image_lib');
                    $upload_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $image_name = $image_data['file_name'];
                    $avi_filename_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $image_data["file_name"];
                    $flv_file_from_avi_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $file_unique_name . ".flv";
                    exec('ffmpeg -i ' . $avi_filename_wthBasePath . '-ar 44100 ' . $flv_file_from_avi_wthBasePath . '');
                    $media = explode('/', $upload_data['upload_data']['file_type']);
                    $file_name = $file_unique_name . ".flv";
                    $media_type = '1';
                }
                if ($file_name == "" && $media_type == "") {
                    $file_name = "";
                    $media_type = "";
                }
                $arr_to_update_media = array(
                    "timeline_id" => base64_decode($timeline_id),
                    'timeline_media_path ' => $file_name,
                    'timeline_media_type' => $media_type,
                    'timeline_media_status' => "1"
                );
                $this->common_model->insertRow($arr_to_update_media, 'trans_timeline_media', array("timeline_id" => base64_decode($timeline_id)));
            }
            if ($_FILES['post_files']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_files']['name']); $i++) {
                    $_FILES['userfile']['name'] = $_FILES['post_files']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['post_files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['post_files']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['post_files']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['post_files']['size'][$i];
                    $config['file_name'] = time() . rand(1000, 9999) . $i;
                    $config['allowed_types'] = 'doc|docx|txt|pdf';
                    $config['max_size'] = '10000';
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
                    $file_name = $img_name;
                    $media_type = '2';
                    if ($file_name == "" && $media_type == "") {
                        $file_name = "";
                        $media_type = "";
                    }
                    $arr_to_insert_img = array(
                        "timeline_id" => base64_decode($timeline_id),
                        'timeline_media_path ' => $file_name,
                        'timeline_media_type' => $media_type,
                        'timeline_media_status' => "1"
                    );
                    $this->common_model->insertRow($arr_to_insert_img, 'trans_timeline_media');
                }
            }
            if ($file_name == "" && $media_type == "") {
                $file_name = $this->input->post("old_post_file");
                $media_type = $this->input->post("old_media_type");
            }
            $this->session->set_userdata("msg", "<span class='success'>Timeline post updated successfully!</span>");
            redirect(base_url() . 'backend/categories/view-timeline/' . base64_encode($this->input->post("category_id")) . '/' . intval($this->input->post('parent_id')));
        }
        #using the admin model
        $data['arr_timeline'] = $this->common_model->getRecords("mst_timeline", "*", array("timeline_id" => base64_decode($timeline_id)));
        $data['arr_timeline'] = end($data['arr_timeline']);
        $data['arr_timeline_media'] = $this->common_model->getRecords("trans_timeline_media", "*", array("timeline_id" => base64_decode($timeline_id)));
        $data['parent_id'] = $parent_id;
        $data['header'] = array('title' => 'Edit Timeline Post');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/edit-post-timeline', $data);
        $this->load->view('backend/sections/footer');
    }

    function editPostTimelinebk($timeline_id, $parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            if ($_FILES['post_image']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                    if ($_FILES['post_image']['size'][$i] > 10240000) {
                        $this->session->set_userdata("msg", "<span class='success'>Only 10MB jpg|jpeg|gif|png files size  are allowed!</span>");
                        redirect(base_url() . 'backend/categories/edit-post-timeline/' . $timeline_id . '/' . $parent_id);
                    }
                }
            } elseif ($_FILES['post_video']['name'] != "") {
                if ($_FILES['post_video']['size'] > 512000000) {
                    $this->session->set_userdata("msg", "<span class='success'>Only 512MB avi|flv|wmv|mpeg|mp3|mp4|mov|ogg files size  are allowed!</span>");
                    redirect(base_url() . 'backend/categories/edit-post-timeline/' . $timeline_id . '/' . $parent_id);
                }
            } elseif ($_FILES['post_files']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_files']['name']); $i++) {
                    if ($_FILES['post_files']['size'][$i] > 10240000) {
                        $this->session->set_userdata("msg", "<span class='success'>Only 10MB size doc|docx|txt|pdf files are allowed!</span>");
                        redirect(base_url() . 'backend/categories/edit-post-timeline/' . $timeline_id . '/' . $parent_id);
                    }
                }
            }
            $arr_to_update = array(
                "category_id" => intval($this->input->post('parent_id')),
                'sub_category_id' => intval($this->input->post('category_id')),
                'timeline_post_data' => mysql_real_escape_string(($this->input->post('post_title'))),
            );
            $this->common_model->updateRow('mst_timeline', $arr_to_update, array("timeline_id" => base64_decode($timeline_id)));
            if ($_FILES['post_image']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_image']['name']); $i++) {
                    $_FILES['userfile']['name'] = $_FILES['post_image']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['post_image']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['post_image']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['post_image']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['post_image']['size'][$i];
                    $config['file_name'] = time();
                    $config['allowed_types'] = 'jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG';
                    $config['max_size'] = '10000';
                    $config['upload_path'] = './media/front/img/post-images/';
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload()) {
                        $data["image_file"] = $this->upload->data();
                        $img_name = $data ["image_file"]['file_name'];
                        $im = "$img_name";
                        $config['source_image'] = '';
                        $config['image_library'] = 'gd2';
                        $config['overwrite'] = FALSE;
                        $config['source_image'] = './media/front/img/post-images/';
                        $this->load->library('image_lib', $config);
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $image_config = array(
                            'source_image' => $data["image_file"]['full_path'],
                            'new_image' => 'media/front/img/post-images/thumbs/',
                            'maintain_ratio' => TRUE,
                            'width' => 100,
                            'height' => 100
                        );
                        $this->image_lib->initialize($image_config);
                        $resize_rc = $this->image_lib->resize();
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                    }
                    $file_name = $img_name;
                    $media_type = '0';
                    if ($file_name == "" && $media_type == "") {
                        $file_name = "";
                        $media_type = "";
                    }
                    $arr_to_update_img = array(
                        "timeline_id" => base64_decode($timeline_id),
                        'timeline_media_path ' => $file_name,
                        'timeline_media_type' => $media_type,
                        'timeline_media_status' => "1"
                    );
                    $this->common_model->insertRow($arr_to_update_img, 'trans_timeline_media', array("timeline_id" => base64_decode($timeline_id)));
                }
            }
            if ($_FILES['post_video']['name'] != "") {
                $file_unique_name = uniqid();
                $config['allowed_types'] = 'avi|flv|wmv|mpeg|mp3|mp4|mov|ogg';
                $config['upload_path'] = './media/front/post-video/';
                $config['max_size'] = '512000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('post_video')) {
                    $this->session->set_userdata('mess', 'image_uploading_error');
                    $error = array('error' => $this->upload->display_errors());
                    redirect(base_url() . 'backend/categories/edit-post-timeline/' . ($timeline_id) . '/' . $parent_id);
                } else {
                    $this->load->library('image_lib');
                    $upload_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $image_name = $image_data['file_name'];
                    $avi_filename_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $image_data["file_name"];
                    $flv_file_from_avi_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $file_unique_name . ".flv";
                    exec('ffmpeg -i ' . $avi_filename_wthBasePath . '-ar 44100 ' . $flv_file_from_avi_wthBasePath . '');
                    $media = explode('/', $upload_data['upload_data']['file_type']);
                    $file_name = $file_unique_name . ".flv";
                    $media_type = '1';
                }
                if ($file_name == "" && $media_type == "") {
                    $file_name = "";
                    $media_type = "";
                }
                $arr_to_update_media = array(
                    "timeline_id" => base64_decode($timeline_id),
                    'timeline_media_path ' => $file_name,
                    'timeline_media_type' => $media_type,
                    'timeline_media_status' => "1"
                );
                $this->common_model->insertRow($arr_to_update_media, 'trans_timeline_media', array("timeline_id" => base64_decode($timeline_id)));
            }
            if ($_FILES['post_files']['name'][0] != "") {
                for ($i = 0; $i < count($_FILES['post_files']['name']); $i++) {
                    $_FILES['userfile']['name'] = $_FILES['post_files']['name'][$i];
                    $_FILES['userfile']['type'] = $_FILES['post_files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['post_files']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $_FILES['post_files']['error'][$i];
                    $_FILES['userfile']['size'] = $_FILES['post_files']['size'][$i];
                    $config['file_name'] = time() . rand(1000, 9999) . $i;
                    $config['allowed_types'] = 'doc|docx|txt|pdf';
                    $config['max_size'] = '10000';
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
                    $file_name = $img_name;
                    $media_type = '2';
                    if ($file_name == "" && $media_type == "") {
                        $file_name = "";
                        $media_type = "";
                    }
                    $arr_to_insert_img = array(
                        "timeline_id" => base64_decode($timeline_id),
                        'timeline_media_path ' => $file_name,
                        'timeline_media_type' => $media_type,
                        'timeline_media_status' => "1"
                    );
                    $this->common_model->insertRow($arr_to_insert_img, 'trans_timeline_media');
                }
            }
            if ($file_name == "" && $media_type == "") {
                $file_name = $this->input->post("old_post_file");
                $media_type = $this->input->post("old_media_type");
            }
            $this->session->set_userdata("msg", "<span class='success'>Timeline post updated successfully!</span>");
            redirect(base_url() . 'backend/categories/view-timeline/' . base64_encode($this->input->post("category_id")) . '/' . intval($this->input->post('parent_id')));
        }
        #using the admin model
        $data['arr_timeline'] = $this->common_model->getRecords("mst_timeline", "*", array("timeline_id" => base64_decode($timeline_id)));
        $data['arr_timeline'] = end($data['arr_timeline']);
        $data['arr_timeline_media'] = $this->common_model->getRecords("trans_timeline_media", "*", array("timeline_id" => base64_decode($timeline_id)));
        $data['parent_id'] = $parent_id;
        $data['header'] = array('title' => 'Edit Timeline Post');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/edit-post-timeline', $data);
        $this->load->view('backend/sections/footer');
    }

    public function deleteTimelineImage($timeline_media_id, $timeline_id) {
        $cat = $this->common_model->getRecords("mst_timeline", "category_id,sub_category_id", array("timeline_id" => $timeline_id));
        $media = $this->common_model->getRecords("trans_timeline_media", "timeline_media_path,timeline_media_type", array("timeline_media_id" => $timeline_media_id));
        $media = $media[0];
        if ($media["timeline_media_type"] == 0) {
            @unlink("media/front/img/post-images/" . $media["timeline_media_path"]);
            @unlink("media/front/img/post-images/thumbs/" . $media["timeline_media_path"]);
        } else if ($media["timeline_media_type"] == 1) {
            @unlink("media/front/post-video/" . $media["timeline_media_path"]);
        } else if ($media["timeline_media_type"] == 2) {
            @unlink("media/front/img/post-images/" . $media["timeline_media_path"]);
        }
        $this->common_model->deleteRows(array($timeline_media_id), "trans_timeline_media", "timeline_media_id");
        $category_id = $cat[0]["category_id"];
        $this->session->set_userdata("msg", "<span class='success'>Media deleted successfully!</span>");
        redirect(base_url() . "backend/categories/edit-post-timeline/" . base64_encode($timeline_id) . "/" . $category_id);
    }

    public function viewTimeline($category_id, $parent_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_timeline_id = $this->input->post('checkbox');
                if (count($arr_timeline_id) > 0) {
                    #deleting the user selected
                    foreach ($arr_timeline_id as $timeline_id) {
                        $timeline_media_path = $this->common_model->getRecords("trans_timeline_media", "timeline_media_path", array("timeline_id" => $timeline_id));
                        $timeline_media_path = $timeline_media_path[0]["timeline_media_path"];
                        @unlink("media/front/img/post-images/" . $timeline_media_path);
                        @unlink("media/front/img/post-images/thumbs/" . $timeline_media_path);
                        @unlink("media/front/post-video/" . $timeline_media_path);
                    }
                    $this->common_model->deleteRows($arr_timeline_id, "trans_timeline_media", "timeline_id");
                    $this->common_model->deleteRows($arr_timeline_id, "mst_timeline", "timeline_id");
                }
                $this->session->set_userdata("msg", "<span class='success'>"
                        . "Post deleted successfully!</span>");
                redirect(base_url() . 'backend/categories/view-timeline/' . $category_id . '/' . $parent_id);
            }
        }
        $data = $this->common_model->commonFunction();
        $data['category_id'] = base64_decode($category_id);
        $data['parent_id'] = $parent_id;
        $data['arr_timeline_media'] = $this->category_model->getCategoryMedia(base64_decode($category_id));
        $data["parent_id"] = $parent_id;
        $data['header'] = array('title' => 'View Timeline Post');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/view-timeline', $data);
        $this->load->view('backend/sections/footer');
    }

    public function viewComments($timeline_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_comment_id = $this->input->post('checkbox');
                if (count($arr_comment_id) > 0) {
                    #deleting the user selected
                    foreach ($arr_comment_id as $comment_id) {
                        $comment_media_path = $this->common_model->getRecords("trans_comment_media", "comments_media_path", array("comments_id" => $comment_id));
                        $comment_media_path = $comment_media_path[0]["comments_media_path"];
                        @unlink("media/front/img/post-images/" . $comment_media_path);
                        @unlink("media/front/img/post-images/thumbs/" . $comment_media_path);
                        @unlink("media/front/post-video/" . $comment_media_path);
                    }
                    $this->common_model->deleteRows($arr_comment_id, "trans_timeline_comments", "comments_id");
                    $this->common_model->deleteRows($arr_comment_id, "trans_comment_media", "comments_id");
                }
                $this->session->set_userdata("msg", "<span class='success'>Comment deleted successfully!</span>");
                redirect(base_url() . 'backend/categories/view-comments/' . $timeline_id);
            }
        }
        $data = $this->common_model->commonFunction();
        $data['timeline_id'] = $timeline_id;
        $data['arr_timeline_comments'] = $this->category_model->getTimelineComments(base64_decode($timeline_id));
        $cat_info = $this->common_model->getRecords("mst_timeline", "category_id,sub_category_id", array("timeline_id" => base64_decode($timeline_id)));
        $data['parent_id'] = $cat_info[0]["category_id"];
        $data['category_id'] = base64_encode($cat_info[0]["sub_category_id"]);
        $data['header'] = array('title' => 'View Timeline Comments');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/view-comments', $data);
        $this->load->view('backend/sections/footer');
    }

    public function commentStatus() {
        if ($this->input->post('comments_id') != "") {
            /* updating the user status. */
            $arr_to_update = array(
                "comments_status" => $this->input->post('comments_status')
            );
            /* condition to update record for the user status */
            $condition_array = array('comments_id' => intval($this->input->post('comments_id')));
            $this->common_model->updateRow('trans_timeline_comments', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function timelineStatus() {
        if ($this->input->post('timeline_id') != "") {
            /* updating the user status. */
            $arr_to_update = array(
                "timeline_status" => $this->input->post('timeline_status')
            );
            /* condition to update record for the user status */
            $condition_array = array('timeline_id' => intval($this->input->post('timeline_id')));
            $this->common_model->updateRow('mst_timeline', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function validateCategory() {
        if ($this->input->post('edit_id')) {
            $found_rows = $this->category_model->validateCategory($this->input->post('edit_id'), $this->input->post('inputName'));
        } else {
            $found_rows = $this->category_model->validateCategory('', $this->input->post('inputName'));
        }
        if (count($found_rows) > 0) {
            echo "false";
        } else
            echo "true";
    }

    public function validatePageUrl() {
        $found_rows = $this->category_model->validatePageURL($this->input->post('edit_id'), $this->input->post('inputPageUrl'));
        if (count($found_rows) > 0) {
            echo "false";
        } else
            echo "true";
    }

    public function deleteCategory() {
        if ($this->input->post('category_id')) {
            $cat = $this->input->post('category_id');
            $arr_user_ids = array('category_id' => $cat);
        } else {
            $arr_user_ids = $this->input->post('category_ids');
        }
        $this->common_model->deleteRows($arr_user_ids, "mst_categories", "category_id   ");
        $this->common_model->deleteRows($arr_user_ids, "trans_categories_lang_map", "category_id");
        $this->category_model->deleteurimap($arr_user_ids, "mst_uri_map", "rel_id");
        $this->session->set_userdata("msg", "<span class='success'>Record deleted successfully!</span>");
        echo json_decode(0);
        //redirect(base_url().'backend/Category/list');
    }

    function addComment($timeline_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {

            if ($_FILES['comment_file']['name'] != "") {
                $file_unique_name = uniqid();
                $config['allowed_types'] = 'gif|jpg|png|jpeg|avi|flv|wmv|mpeg|mp3|mp4|mov|ogg';
                $config['file_name'] = time();
                $file_type = explode('/', $_FILES['comment_file']['type']);
                if ($file_type[0] == 'image') {
                    $config['upload_path'] = './media/front/img/post-images/';
                } elseif ($file_type[0] == 'video') {
                    $config['upload_path'] = './media/front/post-video/';
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('comment_file')) {
                    $this->session->set_userdata('message', 'image_uploading_error');
                    $error = array('error' => $this->upload->display_errors());
                    redirect(base_url() . 'backend/categories/add-timeline-comment/' . $timeline_id);
                } else {
                    $this->load->library('image_lib');
                    $upload_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $image_name = $image_data['file_name'];
                    $width = 100;
                    $height = 100;
                    $config = array(
                        'source_image' => $image_data['full_path'],
                        'new_image' =>
                        'media/front/img/post-images/thumbs/',
                        'maintain_ratio' => false,
                        'width' => $width,
                        'height' => $height
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $avi_filename_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $image_data["file_name"];
                    $flv_file_from_avi_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $file_unique_name . ".flv";
                    #Org. FLV Format Video:
                    exec('ffmpeg -i ' . $avi_filename_wthBasePath . '-ar 44100 ' . $flv_file_from_avi_wthBasePath . '');
                    $media = explode('/', $upload_data['upload_data']['file_type']);
                    if ($media[0] == 'video') {
                        $file_name = $file_unique_name . ".flv";
                        $media_type = '1';
                    } else if ($media[0] == 'image') {

                        $file_name = $image_name;
                        $media_type = '0';
                    }
                }
            }
            $arr_to_insert = array(
                "user_id" => $data["user_account"]["user_id"],
                "timeline_id" => intval($this->input->post('timeline_id')),
                'comments' => mysql_real_escape_string($this->input->post('comment')),
                'comments_posted_date' => date("Y-m-d H:i:s"),
                'comments_status' => "1"
            );
            $insert_id = $this->common_model->insertRow($arr_to_insert, 'trans_timeline_comments');
            if ($file_name == "" && $media_type == "") {
                $file_name = "";
                $media_type = "";
            }
            $arr_to_insert_media = array(
                "comments_id" => $insert_id,
                'comments_media_path ' => $file_name,
                'comments_media_type' => $media_type,
                'comments_media_status' => "1"
            );
            $this->common_model->insertRow($arr_to_insert_media, 'trans_comment_media');
            redirect(base_url() . 'backend/categories/view-comments/' . $timeline_id);
        }
        #using the admin model
        $data['timeline_id'] = $timeline_id;
        $data['header'] = array('title' => 'Add Comment');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/add-comment', $data);
        $this->load->view('backend/sections/footer');
    }

    function editComment($comment_id) {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if ($this->input->post()) {
            if ($_FILES['comment_file']['name'] != "") {
                $file_unique_name = uniqid();
                $config['allowed_types'] = 'gif|jpg|png|jpeg|avi|flv|wmv|mpeg|mp3|mp4|mov|ogg';
                $config['file_name'] = time();
                $file_type = explode('/', $_FILES['comment_file']['type']);
                if ($file_type[0] == 'image') {
                    $config['upload_path'] = './media/front/img/post-images/';
                    @unlink($config['upload_path'] . $this->input->post("old_comments_media_path"));
                    @unlink($config['upload_path'] . "/thumbs/" . $this->input->post("old_comments_media_path"));
                } elseif ($file_type[0] == 'video') {
                    $config['upload_path'] = './media/front/post-video/';
                    @unlink($config['upload_path'] . $this->input->post("old_comments_media_path"));
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('comment_file')) {
                    $this->session->set_userdata('message', 'image_uploading_error');
                    $error = array('error' => $this->upload->display_errors());
                    redirect(base_url() . 'backend/categories/edit-timeline-comment/' . base64_encode($comment_id));
                } else {
                    $this->load->library('image_lib');
                    $upload_data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $image_name = $image_data['file_name'];
                    $width = 100;
                    $height = 100;
                    $config = array(
                        'source_image' => $image_data['full_path'],
                        'new_image' =>
                        'media/front/img/post-images/thumbs/',
                        'maintain_ratio' => false,
                        'width' => $width,
                        'height' => $height
                    );
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $avi_filename_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $image_data["file_name"];
                    $flv_file_from_avi_wthBasePath = $data["absolute_path"] . "media/front/post-video/" . $file_unique_name . ".flv";
                    #Org. FLV Format Video:
                    exec('ffmpeg -i ' . $avi_filename_wthBasePath . '-ar 44100 ' . $flv_file_from_avi_wthBasePath . '');
                    $media = explode('/', $upload_data['upload_data']['file_type']);
                    if ($media[0] == 'video') {
                        $file_name = $file_unique_name . ".flv";
                        $media_type = '1';
                    } else if ($media[0] == 'image') {
                        $file_name = $image_name;
                        $media_type = '0';
                    }
                }
            }
            $arr_to_update = array(
                'comments' => mysql_real_escape_string($this->input->post('comment')),
                'comments_status' => mysql_real_escape_string($this->input->post('comments_status'))
            );
            $this->common_model->updateRow('trans_timeline_comments', $arr_to_update, array("comments_id" => $this->input->post("comments_id")));
            if ($_FILES['comment_file']['name'] == "") {
                $file_name = $this->input->post("old_comments_media_path");
                $media_type = $this->input->post("old_comments_media_type");
            }
            $arr_to_update_media = array(
                'comments_media_path ' => $file_name,
                'comments_media_type' => $media_type,
                'comments_media_status' => "1"
            );
            $this->common_model->updateRow('trans_comment_media', $arr_to_update_media, array("comments_id" => $this->input->post("comments_id")));
            redirect(base_url() . 'backend/categories/view-comments/' . $this->input->post("timeline_id"));
        }
        #using the admin model
        $data['arr_timeline_comment'] = $this->category_model->getTimelineCommentById(base64_decode($comment_id));
        $data['arr_timeline_comment'] = end($data['arr_timeline_comment']);
        $data['header'] = array('title' => 'Edit Comment');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/edit-comment', $data);
        $this->load->view('backend/sections/footer');
    }

    public function allcategory($cat_id = '') {
        error_reporting(0);
        $cat = $this->category_model->getcategoryDetails($cat_id);
        $this->load->model('common_model');
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $data['lang'] = $this->lang->language;
        if ($cat_id != '') {
            $category = $this->common_model->getRecords('mst_categories', '*', array('category_id' => $cat_id), '', 0);
            $ccategory = $this->common_model->getRecords('mst_categories', '*', array('parent_id' => $cat_id), '', 0);
            $data['ccategory'] = $ccategory;
            for ($i = 0; $i < count($ccategory); $i++) {
                $sub_categories[] = $this->category_model->getSubCategoryListlang($ccategory[$i]['category_id']);
            }
            $data['sub_categories'] = $sub_categories;
            $category = $category[0];
            $array = array();
            $array[] = array_merge($category, array('children' => $ccategory));
            $data['categories'] = $array;
            $this->load->model('products_model');
            $data['productID'] = $this->products_model->get_product_id_by_category_id($cat_id);
            for ($i = 0; $i < count($data['productID']); $i++) {
                $productDetails = $this->products_model->get_product_details_by_product_id($data['productID'][$i]['product_id']);
                if (count($productDetails) > 0) {
                    $productDetailsArr[] = $productDetails;
                }
            }
            $data['product_details'] = $productDetailsArr;
            //[latest product]
            $data['latest_product'] = $this->products_model->get_latest_product();
            //[latest product]
            $data['title_for_layout'] = $data['lang']['CATEGORY_LISTING'];
            $this->load->view('front/includes/header', $data);
            $this->load->view('front/includes/header_nav', $data);
            $this->load->view('front/categories-list', $data);
            $this->load->view('front/includes/footer');
        } else {
            $category = $this->common_model->getRecords('mst_categories', 'category_name,category_id', array('parent_id' => '0', 'shop_id' => '0'), 'category_name');
            for ($i = 0; $i < count($category); $i++) {
                $cat = $this->category_model->getSubCategoryListlang($category[$i]['category_id']);
                if ($cat) {
                    $category[$i]['child'] = $cat;
                }
            }
            $letters = range('A', 'Z');
            $array_alpha = array();
            foreach ($letters as $one) {
                $array_alpha[$one] = array();
            }
            $data['alpha'] = $array_alpha;
            foreach ($category as $value) {
                $firstLetter = strtoupper(substr($value['category_name'], 0, 1));
                if ($firstLetter)
                    array_push($array_alpha[$firstLetter], $value);
            }
            $data['categories'] = $array_alpha;
            $data['title_for_layout'] = $data['lang']['CATEGORY_LISTING'];
            $this->load->view('front/includes/header', $data);
            $this->load->view('front/includes/header_nav', $data);
            $this->load->view('front/all-categories', $data);
            $this->load->view('front/includes/footer');
        }
    }

    function manageOtherInterest() {
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_temp_interest_id = $this->input->post('checkbox');
                if (count($arr_temp_interest_id) > 0) {
                    #deleting the user selected
                    $this->common_model->deleteRows($arr_temp_interest_id, "trans_temp_interest", "temp_interest_id");
                }
                $this->session->set_userdata("msg", "<span class='success'>Post deleted successfully!</span>");
                redirect(base_url() . 'backend/manage-other-interest');
            }
        }
        $data = $this->common_model->commonFunction();
        $data['arr_other_interest'] = $this->category_model->getOtherInterest();
//        print_r($data['arr_other_interest']); die;
        $data['header'] = array('title' => 'Manage Other Interest');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/category/manage-other-interest', $data);
        $this->load->view('backend/sections/footer');
    }

}

?>
