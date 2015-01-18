<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Model extends CI_Model {

    function getcategoryList() {
        $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('mst_categories') . " c2 ";
        $fields.="where c2.category_id = c.parent_id limit 1),'-') as parent_category,(select `url` from ";
        $fields.=$this->db->dbprefix('mst_uri_map') . " u where u.type='category' and u.rel_id=c.category_id limit 1) as page_url";
        $this->db->select($fields, FALSE);
        $this->db->from("mst_categories as c");

        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getcategoryList',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    function getcategoryListByParentId($parent_id) {
        $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('mst_categories') . " c2 ";
        $fields.="where c2.category_id = c.parent_id limit 1),'-') as parent_category,(select `url` from ";
        $fields.=$this->db->dbprefix('mst_uri_map') . " u where u.type='category' and u.rel_id=c.category_id limit 1) as page_url";
        $this->db->select($fields, FALSE);
        $this->db->from("mst_categories as c");
        $this->db->where("c.parent_id", $parent_id);
        $this->db->order_by('c.category_id', 'DESC');
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getcategoryListByParentId',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
    
    
    function getDigitalRecords() {
        $this->db->select("c.*,mum.*");
        $this->db->from("mst_categories as c");
        $this->db->join("mst_uri_map as mum","mum.rel_id = c.category_id","left");
        $this->db->where("c.parent_id", "1");
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getDigitalRecords',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
    
    
    
     function getTilesDigitalRecords() {
       $this->db->select("c.*,mum.*");
        $this->db->from("mst_categories as c");
        $this->db->join("mst_uri_map as mum","mum.rel_id = c.category_id","left");
        $this->db->where("c.parent_id", "1");
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getTilesDigitalRecords',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
     function getDigitalRecordsCount($category_id) {
        $this->db->select("count(mt.timeline_id) as timeline_count");
        $this->db->from("mst_timeline as mt");
        $this->db->where("mt.sub_category_id", $category_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getDigitalRecordsCount',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
    
      function getTilesInstituteBrownies() {
        $this->db->select("c.*");
        $this->db->from("mst_categories as c");
        $this->db->where("c.parent_id", "2");
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getTilesInstituteBrownies',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
    
    function getTilesPersonalBrownies() {
        $this->db->select("c.*");
        $this->db->from("mst_categories as c");
        $this->db->where("c.parent_id", "3");
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getTilesPersonalBrownies',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
    
    function getDigitalRecordsById($url) {
        $this->db->select("c.*,mum.*");
        $this->db->from("mst_categories as c");
        $this->db->join("mst_uri_map as mum","mum.rel_id = c.category_id","left");
        $this->db->where("mum.url", $url);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getDigitalRecordsById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }
    
    
    function getCategoryMedia($cat_id) {
        $this->db->select('mt.timeline_id,mt.user_id,mt.category_id,mt.sub_category_id,mt.timeline_post_data,mt.timeline_visibility,mt.timeline_posted_date,mt.timeline_status,ttm.timeline_media_id,ttm.timeline_media_path,ttm.timeline_media_type,ttm.timeline_media_status,mu.first_name,mu.last_name,');
        $this->db->from('mst_timeline as mt');
        $this->db->join('trans_timeline_media as ttm', 'ttm.timeline_id = mt.timeline_id', 'left');
        $this->db->join('mst_users as mu', 'mu.user_id = mt.user_id', 'left');
        #if edit id not blank passed it will return all records
        $this->db->where("mt.sub_category_id", $cat_id);
        $this->db->order_by('mt.timeline_id', 'DESC');
        $this->db->group_by('mt.timeline_id');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getCategoryMedia',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }

    function getOtherInterest() {
        $this->db->select('tti.*,mu.first_name,mu.last_name');
        $this->db->from('trans_temp_interest as tti');
        $this->db->join('mst_users as mu', 'mu.user_id = tti.user_id', 'left');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getOtherInterest',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }

    
    function getOtherInterestById($other_interest_id) {
        $this->db->select('tti.*,mu.first_name,mu.last_name');
        $this->db->from('trans_temp_interest as tti');
        $this->db->join('mst_users as mu', 'mu.user_id = tti.user_id', 'left');
          $this->db->where("tti.temp_interest_id", $other_interest_id);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getOtherInterestById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }
    
    function getTimelineComments($timeline_id) {
        $this->db->select('ttc.*,mu.first_name,mu.last_name,tcm.*');
        $this->db->from('trans_timeline_comments as ttc');
        $this->db->join('mst_users as mu', 'mu.user_id = ttc.user_id', 'left');
        $this->db->join('trans_comment_media as tcm', 'tcm.comments_id = ttc.comments_id', 'left');
        #if edit id not blank passed it will return all records
        $this->db->where("ttc.timeline_id", $timeline_id);
        $this->db->order_by('ttc.comments_id', 'DESC');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getTimelineComments',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }

    function getTimelineCommentById($comment_id) {
        $this->db->select('ttc.*,tcm.*');
        $this->db->from('trans_timeline_comments as ttc');
        $this->db->join('trans_comment_media as tcm', 'tcm.comments_id = ttc.comments_id', 'left');
        #if edit id not blank passed it will return all records
        $this->db->where("ttc.comments_id", $comment_id);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getTimelineCommentById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }

    function getMediaByTimelineId($timeline_id) {
        $this->db->select('mt.*,ttm.*');
        $this->db->from('mst_timeline as mt');
        $this->db->join('trans_timeline_media as ttm', 'ttm.timeline_id = mt.timeline_id', 'left');
        #if edit id not blank passed it will return all records
        $this->db->where("mt.timeline_id", $timeline_id);
//        $this->db->group_by("mt.timeline_id");
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getMediaByTimelineId',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }

    function getCategoryListIDS($Category_id) {
        $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('mst_categories') . " c2 ";
        $fields.="where c2.category_id = c.parent_id limit 1),'-') as parent_category,(select `url` from ";
        $fields.=$this->db->dbprefix('mst_uri_map') . " u where u.type='category' and u.rel_id=c.category_id limit 1) as page_url";
        $this->db->select($fields, FALSE);
        $this->db->from("mst_categories as c");
        $this->db->where("c.category_id !=", $Category_id);
        // $this->db->where('c.shop_id', '0');
        //$this->db->where('c.store_id', $store_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getCategoryListIDS',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    function getcategoryDetails($category_page_id) {
        $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('mst_categories') . " c2 ";
        $fields.="where c2.category_id = c.parent_id limit 1),'-') as parent_category,(select `url` from ";
        $fields.=$this->db->dbprefix('mst_uri_map') . " u where u.type='category' and u.rel_id=c.category_id limit 1) as page_url";
        $this->db->select($fields, FALSE);
        $this->db->from("mst_categories as c");
        $this->db->where('c.category_id', $category_page_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getcategoryDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    #function to get category from the database if edit_id and lang_id black then it will return all reacords   

    public function getcategory($edit_id = '', $lang_id = '') {
        $this->db->select('mst_categories.*,category.*');
        $this->db->from('mst_categories as mst_categories');
        $this->db->join('trans_categories_lang_map as category', 'mst_categories.category_id = category.category_id', 'left');
        if ($edit_id != '') { #if edit id not blank passed it will return all records
            $this->db->where("category.category_id", $edit_id);
        }

        if ($lang_id != '') {
            $this->db->where("category.lang_id", $lang_id);
        } else {
            $this->db->where("category.lang_id", 17);
        }
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getcategory',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found');
        }
        return $result->result_array();
    }

    public function validatecategory($edit_id = '', $name = '') {
        $this->db->select('mst_categories.*');
        $this->db->from('mst_categories as mst_categories');
        if ($edit_id != '') { #if edit id not blank passed it will return all records
            $this->db->where('category_id !=', $edit_id);
        }
        $this->db->where("category_name", $name);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'validatecategory',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function validatePageURL($edit_id = '', $name = '') {
        $this->db->select('mst_uri_map.*');
        $this->db->from('mst_uri_map as mst_uri_map');
        if ($edit_id != '') { #if edit id not blank passed it will return all records
            $this->db->where('rel_id !=', $edit_id);
        }
        //$this->db->where("type", 'category	');
        $this->db->where('url', $name);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'validatePageURL',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function deleteurimap($arr_delete_array, $table_name, $field_name) {
        if (count($arr_delete_array) > 0) {
            foreach ($arr_delete_array as $id) {
                $this->db->where($field_name, $id);
                $this->db->where('type', 'category');
                $query = $this->db->delete($table_name);
                $error = $this->db->_error_message();
                $error_number = $this->db->_error_number();
                if ($error) {
                    $controller = $this->router->fetch_class();
                    $method = $this->router->fetch_method();
                    $error_details = array(
                        'error_name' => $error,
                        'error_number' => $error_number,
                        'model_name' => 'Category_Model',
                        'model_method_name' => 'deleteurimap',
                        'controller_name' => $controller,
                        'controller_method_name' => $method
                    );
                    $this->common_model->errorSendEmail($error_details);
                    redirect(base_url() . 'page-not-found'); //create this route
                }
            }
        }
    }

    public function getcategorylang() {
        $lang_id = ($this->session->userdata('lang_id') ? $this->session->userdata('lang_id') : 17);
        if ($lang_id == 17) {
            $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('mst_categories') . " c2 ";
            $fields.="where c2.category_id = c.parent_id limit 1),'-') as parent_category,(select `url` from ";
            $fields.=$this->db->dbprefix('mst_uri_map') . " u where u.type='category' and u.rel_id=c.category_id limit 1) as page_url";
            $this->db->select($fields, FALSE);
            $this->db->from("mst_categories as c");
            $this->db->where('c.parent_id', 0);
            // $this->db->where('c.shop_id', 0);
            $query = $this->db->get();
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Category_Model',
                    'model_method_name' => 'getcategorylang',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return $query->result_array();
        } else {
            $this->db->select('tclm.*,mcat.category_image');
            $this->db->from('trans_categories_lang_map as tclm');
            $this->db->join('mst_categories as mcat', 'mcat.category_id = tclm.category_id', 'left');
            $this->db->where('tclm.lang_id', $lang_id);
            $this->db->where('mcat.parent_id', 0);
            //  $this->db->where('c.shop_id', 0);
            $result = $this->db->get();
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Category_Model',
                    'model_method_name' => 'getcategorylang',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return $result->result_array();
        }
    }

    function getcategoryChildList($cat_id) {
        $this->db->select('mcat.category_id,mcat.category_name,mcc.category_id as child_id,mcc.category_name as cat_name');
        $this->db->from('mst_categories as mcat');
        $this->db->join('mst_categories as mcc', 'mcc.parent_id = mcat.category_id', 'left');
        $this->db->where('mcat.category_id', $cat_id);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getcategoryChildList',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    function getSubCategoryList($cat_id) {
        $this->db->select('category_id,category_name');
        $this->db->from('mst_categories');
        $this->db->where('parent_id', $cat_id);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getSubCategoryList',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function getSubCategoryListlang($cat_id) {
        $lang_id = ($this->session->userdata('lang_id') ? $this->session->userdata('lang_id') : 17);
        if ($lang_id == 17) {
            return $this->getSubCategoryList($cat_id);
        } else {
            $this->db->select('mcat.category_id,tclm.category_name');
            $this->db->from('trans_categories_lang_map as tclm');
            $this->db->join('mst_categories as mcat', 'mcat.category_id = tclm.category_id', 'left');
            $this->db->where('tclm.lang_id', $lang_id);
            $this->db->where('mcat.parent_id', $cat_id);
            $result = $this->db->get();
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Category_Model',
                    'model_method_name' => 'getSubCategoryListlang',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return $result->result_array();
        }
    }

    function getShopCategoryList($user_id) {

        $fields = "c.*,IF(c.parent_id > 0,(select category_name from " . $this->db->dbprefix('mst_categories') . " c2 ";
        $fields.="where c2.category_id = c.parent_id limit 1),'-') as parent_category,(select `url` from ";
        $fields.=$this->db->dbprefix('mst_uri_map') . " u where u.type='category' and u.rel_id=c.category_id limit 1) as page_url";
        $this->db->select($fields, FALSE);
        $this->db->from("mst_categories as c");
        $this->db->join('mst_user_myshop as mum', 'mum.myshop_id = c.shop_id', 'left');
        $this->db->where('mum.user_id', $user_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getShopCategoryList',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    function getShopCategoryById($category_id) {
        $this->db->select('c.*,mum.user_id');
        $this->db->from("mst_categories as c");
        $this->db->join('mst_user_myshop as mum', 'mum.myshop_id = c.shop_id', 'left');
        $this->db->where('c.category_id', $category_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Category_Model',
                'model_method_name' => 'getShopCategoryById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

}

?>
