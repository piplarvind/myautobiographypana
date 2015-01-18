<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Model extends CI_Model {

    public function getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0) {
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from($table_to_pass);
        if ($condition_to_pass != '')
            $this->db->where($condition_to_pass);


        if ($order_by_to_pass != '')
            $this->db->order_by($order_by_to_pass);


        if ($limit_to_pass != '')
            $this->db->limit($limit_to_pass);

        $query = $this->db->get();

        if ($debug_to_pass)
            echo $this->db->last_query();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getUserInformation',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    #function to get user list from the database

    public function getUserDetailsA($user_id = '') {
        $this->db->select('u.user_id,u.user_name,u.first_name,u.last_name,u.user_email,u.user_status,u.user_type,u.register_date,u.role_id,u.gender,u.country_code,u.contact_no,u.pin_code,u.interest_id,u.user_registered,u.send_email_notification,u.date_of_birth,u.profile_picture,r.role_name,ur.name_of_institute');
        $this->db->from('mst_users as u');
        $this->db->join('mst_role as r', 'u.role_id = r.role_id', 'left');
        $this->db->join('mst_users as ur', 'ur.user_id = u.institute_id', 'left');
        if ($user_id != '') {
            $this->db->where("u.user_id", $user_id);
        } else {
            $this->db->order_by('user_id', 'DESC');
        }
        $this->db->where("u.user_type", '1');
        $this->db->where("u.user_role", '0');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getUserDetailsA',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function getStates($country_id) {
        $this->db->select('g.geoname_id as state_id ,g.geoname as state_name ,g.status as status');
        $this->db->from('mst_geoname as g');
        $this->db->where('g.state_id =', '0');
        $this->db->where('g.country_id =', $country_id);
        $this->db->where('g.status =', '1');
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getStates',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    /* function to get user list by search keyword */

    public function getUserDetailsBySearchA($search_data) {
        $keyword = $search_data['keyword'];
        $this->db->select('u.user_id,u.user_name,u.first_name,u.last_name,u.user_email,u.user_status,u.user_type,u.register_date,u.role_id,u.gender,r.role_name');
        $this->db->from('mst_users as u');
        $this->db->join('mst_role as r', 'u.role_id = r.role_id', 'left');
        $condition = "(u.first_name LIKE '%" . $keyword . "%' OR u.last_name LIKE '%" . $keyword . "%' OR u.user_name LIKE '%" . $keyword . "%' OR u.user_email LIKE '%" . $keyword . "%')";
        $this->db->where($condition);
        $this->db->where("u.user_type", '1');
        $this->db->where("u.user_role", '0');
        $this->db->order_by('user_id', 'DESC');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getUserDetailsBySearchA',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function getUserDetailsB($user_id = '') {
        $this->db->select('u.*,mc.country_name as country_name,geo.geoname as state_name,it.institute_type as institute_type_name ');
        $this->db->from('mst_users as u');
        $this->db->join('mst_country as mc', 'mc.country_id = u.country_id', 'left');
        $this->db->join('mst_geoname as geo', 'geo.geoname_id= u.state_id', 'left');
        $this->db->join('mst_institute_type as it', 'it.institute_type_id= u.institute_type', 'left');
        $this->db->join('mst_role as r', 'u.role_id = r.role_id', 'left');
        if ($user_id != '') {
            $this->db->where("u.user_id", $user_id);
        } else {
            $this->db->order_by('user_id', 'DESC');
        }
        $this->db->where("u.user_type", '1');
        $this->db->where("u.user_role", '1');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getUserDetailsB',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    /* function to get user list by search keyword */

    public function getUserDetailsBySearchB($search_data) {
        $keyword = $search_data['keyword'];
        $this->db->select('u.*');
        $this->db->from('mst_users as u');
        $this->db->join('mst_role as r', 'u.role_id = r.role_id', 'left');
        $condition = "(u.first_name LIKE '%" . $keyword . "%' OR u.last_name LIKE '%" . $keyword . "%' OR u.user_name LIKE '%" . $keyword . "%' OR u.user_email LIKE '%" . $keyword . "%')";
        $this->db->where($condition);
        $this->db->where("u.user_type", '1');
        $this->db->where("u.user_role", '1');
        $this->db->order_by('user_id', 'DESC');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getUserDetailsBySearchB',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function getUserInformationById($user_id = '') {
        //$fields_to_pass = 'user_id,title,user_password,first_name,last_name,user_email,user_name,user_type,user_role,user_status,profile_picture,register_date,contact_no,profile_picture';
        $fields_to_pass = '*';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_users');
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRoleName($role_name = '') {

        $fields_to_pass = '*';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_role');
        $this->db->where("role_name", $role_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTimeLineForUserB($category_id, $sub_category_id,$user_id) {

        $fields_to_pass = 't.*,u.first_name,u.last_name,u.user_name,u.profile_picture,user_role';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_timeline as t');
        $this->db->join('mst_users as u', 't.user_id = u.user_id', 'left');
        $this->db->where("t.category_id", base64_decode($category_id));
        $this->db->where("t.sub_category_id", base64_decode($sub_category_id));
        $this->db->where("t.user_id", $user_id);
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTimeLineForUserAOfcircle_friends($category_id, $sub_category_id,$arr_circle_friends, $timeline_visibility = '') {

        
        $fields_to_pass = 't.*,u.first_name,u.last_name,u.user_name,u.profile_picture,user_role';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_timeline as t');
        $this->db->join('mst_users as u', 't.user_id = u.user_id', 'left');
        $this->db->where("t.category_id", base64_decode($category_id));
        $this->db->where("t.sub_category_id", base64_decode($sub_category_id));
        if($timeline_visibility!=''){
             $this->db->where("t.timeline_visibility", $timeline_visibility);
        }
        if(!empty($arr_circle_friends)){
         $this->db->where_in("t.user_id", $arr_circle_friends);
        }
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTimeLineForUserAOfcircle_friendsForMainTimeline($arr_circle_friends, $timeline_visibility = '') {

        
        $fields_to_pass = 't.*,u.first_name,u.last_name,u.user_name,u.profile_picture,user_role';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_timeline as t');
        $this->db->join('mst_users as u', 't.user_id = u.user_id', 'left');
        if($timeline_visibility!=''){
             $this->db->where("t.timeline_visibility", $timeline_visibility);
        }
        if(!empty($arr_circle_friends)){
         $this->db->where_in("t.user_id", $arr_circle_friends);
        }
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTimeLineForUserA($category_id, $sub_category_id,$institute_id,$arr_friends_id) {

        $fields_to_pass = 't.*,u.first_name,u.last_name,u.user_name,u.profile_picture,user_role';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_timeline as t');
        $this->db->join('mst_users as u', 't.user_id = u.user_id', 'left');
        $this->db->where("t.category_id", base64_decode($category_id));
        $this->db->where("t.sub_category_id", base64_decode($sub_category_id));
        
        //$this->db->where("t.institute_id", $institute_id); // Show only my institute post
        //$this->db->where("t.timeline_visibility !=", '2'); // Not Show Private post
        
        $this->db->where_in("t.user_id", $arr_friends_id);
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getLifeEventCountUserA($category_id, $sub_category_id,$user_id) {

        
        $this->db->select('count(t.timeline_id) as event_count');
        $this->db->from('mst_timeline as t');
        $this->db->where("t.category_id", base64_decode($category_id));
        $this->db->where("t.sub_category_id", base64_decode($sub_category_id));
        $this->db->where("t.user_id", $user_id);
        //$this->db->where("t.timeline_visibility", '1'); // Show only public post
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getCategoryID($category_url) {

        $this->db->select('mct.parent_id as category_id, mct.category_id as sub_category_id, mct.parent_id as parent_id');
        $this->db->from('mst_categories as mct');
        $this->db->join("mst_uri_map as mum","mum.rel_id = mct.category_id","left");
        $this->db->where("mum.url", $category_url);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTimeLineMedia($timeline_id) {

        $this->db->select('*');
        $this->db->from('trans_timeline_media');
        $this->db->where("timeline_id", $timeline_id);
        $this->db->where("timeline_media_status", '1');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getTimeLineCommentsUserB($timeline_id) {

        
        $this->db->select('ttc.*,u.first_name,u.last_name,u.user_name,u.profile_picture,u.user_role');
        $this->db->from('trans_timeline_comments as ttc');
        $this->db->join('mst_users as u', 'ttc.user_id = u.user_id', 'left');
        $this->db->where("u.user_status !=", '2');//Blocked user
        $this->db->where("ttc.timeline_id", $timeline_id);
        $this->db->where("ttc.comments_status", '1');
        
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getTimeLineDetails($category_id, $sub_category_id, $user_id) {
        //$fields_to_pass = 'user_id,title,user_password,first_name,last_name,user_email,user_name,user_type,user_role,user_status,profile_picture,register_date,contact_no,profile_picture';
        $fields_to_pass = '*';
        $this->db->select($fields_to_pass, FALSE);
        $this->db->from('mst_timeline as t');
        $this->db->join('trans_timeline_media as tt', 't.timeline_id = tt.timeline_id', 'left');
        $this->db->join('mst_users as u', 't.user_id = u.user_id', 'left');
        $this->db->where("t.category_id", $category_id);
        $this->db->where("t.sub_category_id", $sub_category_id);
        $this->db->where("t.user_id", $user_id);
        //$this->db->where("t.timeline_visibility", '1');
        $this->db->where("t.timeline_posted_date", date('Y-m-d H:i:s'));
        $this->db->order_by("t.timeline_posted_date", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getNewUserDetailsBySearch($search_data) {
        $keyword = $search_data['keyword'];
        $this->db->select('tu.*,mu.user_name');
        $this->db->from('trans_temp_users as tu');
        $this->db->join('mst_users as mu', 'mu.user_id = tu.from_user_id', 'left');
        $condition = "(tu.first_name LIKE '%" . $keyword . "%' OR tu.last_name LIKE '%" . $keyword . "%' OR tu.user_email LIKE '%" . $keyword . "%' OR mu.user_name LIKE '%" . $keyword . "%')";
        $this->db->where($condition);
        $this->db->order_by('tu.temp_id', 'DESC');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getNewUserDetailsBySearch',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function getNewUserDetails() {

        $this->db->select('tu.*,mu.user_name');
        $this->db->from('trans_temp_users as tu');
        $this->db->join('mst_users as mu', 'mu.user_id = tu.from_user_id', 'left');
        $this->db->order_by('tu.temp_id', 'DESC');
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'User_Model',
                'model_method_name' => 'getNewUserDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    
    public function getApprovedPendingUserList($user_id){
        
        $this->db->select('user_id,first_name,last_name,user_email,user_name,register_date');
        $this->db->from('mst_users');
        $this->db->where('institute_id', $user_id);
        $query_approved = $this->db->get();
        $data['userA_approved'] = $query_approved->result_array();
        
        $this->db->select('*');
        $this->db->from('trans_temp_users');
        $this->db->where('from_user_id', $user_id);
        $query_pending = $this->db->get();
        $data['userA_pending'] = $query_pending->result_array();
        
        return $data;
        
    }
    public function set_album_data( $dataArray ){
        $this->db->insert('mst_album', $dataArray);
        return $this->db->insert_id();        
    }
    
}

?>
