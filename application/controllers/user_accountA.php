<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_AccountA extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
    }

    /*
     * Get user's profile information
     */

    public function userAProfile() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        $data['header'] = array('title' => 'Edit Profile');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($data['user_session']['user_id']);

        $condition_to_pass = "parent_id = 18 AND status = 1";
        $data['arr_interest_details'] = $this->common_model->getRecords("mst_categories", "*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        $data['arr_other_interest'] = $this->common_model->getRecords('trans_temp_interest', '*', array("user_id" => $data['user_session']['user_id']));
        $data['arr_other_interest'] = end($data['arr_other_interest']);
        $data['arr_terms_condtion'] = $this->common_model->getTermsCondtions();
        $data['arr_terms_condtion'] = $data['arr_terms_condtion'][0];

        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/userA-profile', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /* Below is for user A Public Profile i.e My Profile(Public Profile) */

    public function userAMyProfile() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $this->load->model("user_model");
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }
        $table_to_pass = 'mst_album';
        $fields_to_pass = array('album_id,album_name,created_date');
        $condition_to_pass = array("user_id" => $data['user_account']['user_id'], 'album_status' => '1');
        $data['user_albums'] = $this->common_model->getRecords($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = 'album_id DESC', $limit_to_pass = '', $debug_to_pass = 0);
        foreach ($data['user_albums'] as $key => $value) {
            $data['user_albums'][$key]['front_photo'] = $this->common_model->getRecords('trans_album_media', array('album_image_path'), array('album_id' => $value['album_id']), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '1', $debug_to_pass = 0);
            $data['user_albums'][$key]['photos_count'] = $this->common_model->getRecords('trans_album_media', array('COUNT(*) as cnt'), array('album_id' => $value['album_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        }
        $data['session_user_id'] = $user_id;
        $data['arr_user_data'] = $arr_user_data[0];
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['timelinephotolist'] = $this->common_model->getTimeLinePhoto($user_id);
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($user_id);
//       echo '<pre>';print_r($data['timelinephotolist']);die;
        $data['header'] = array('title' => 'Public Profile');

        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/my-profile-userA', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function userProfile_NEW() {

        $data = $this->common_model->commonFunction();
        $this->load->helper('my_date_helper');
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $this->load->model("user_model");
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        #[Start: ]Get Friend list
        //$data['arr_category_id'] = $this->user_model->getCategoryID($category_url);
        //$sub_category_id = base64_encode($data['arr_category_id'][0]['sub_category_id']);
        //$category_id = base64_encode($data['arr_category_id'][0]['category_id']);
        
        
        $condition_friends = "to_user_id ='" . $user_id . "' OR from_user_id ='" . $user_id . "' ";
        $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);
        $arr_friends_id = array();
        foreach ($friends_details as $friend) {

            if ($friend['to_user_id'] == $user_id) {
                $arr_friends_id[] = $friend['from_user_id'];
            } else {
                $arr_friends_id[] = $friend['to_user_id'];
            }
        }
        array_push($arr_friends_id, $data['user_session']['user_id']);
        array_push($arr_friends_id, $data['arr_user_data']['institute_id']);
        $arr_friends_id = array_unique($arr_friends_id);
        #[End: ]Get Friend list
        
        # Get visibility friend status
        for($i = 0; $i<count($arr_friends_id); $i++){
            //echo $arr_friends_id[$i]."</br>";
            $friend_condition = "to_user_id ='" . $arr_friends_id[$i] . "' AND from_user_id ='" . $user_id . "' OR to_user_id ='" . $user_id . "' AND from_user_id ='" . $arr_friends_id[$i] . "'";
            $friends_visibility_status[] = $this->common_model->getRecords('mst_user_friends', $fields = '*', $friend_condition, $order_by = '', $limit = '', $debug = 0);
        }
        
        $arr_inner_circle_friends = array();
        $arr_outer_circle_friends = array();
        $arr_my_id = array($user_id);
        $arr_my_institute_id = array($data['arr_user_data']['institute_id']);
        
        for($j = 0; $j<count($friends_visibility_status);$j++){
      
            if ($friends_visibility_status[$j][0]['to_user_id'] == $user_id) {
                
                if($friends_visibility_status[$j][0]['visibility_id'] == '3'){
                    array_push($arr_inner_circle_friends, $friends_visibility_status[$j][0]['from_user_id']);
                }
                if($friends_visibility_status[$j][0]['visibility_id'] == '4'){
                   array_push($arr_outer_circle_friends, $friends_visibility_status[$j][0]['from_user_id']);
                }
            
            }else{
                
                if($friends_visibility_status[$j][0]['visibility_id'] == '3'){
                    array_push($arr_inner_circle_friends, $friends_visibility_status[$j][0]['to_user_id']);
                }
                if($friends_visibility_status[$j][0]['visibility_id'] == '4'){
                   array_push($arr_outer_circle_friends, $friends_visibility_status[$j][0]['to_user_id']);
                }
            }
            
        }
             
        #[Start: ]Get & Timeline Timeline media
        /*** getting all friends time lines ***/
        //print_R($arr_outer_circle_friends);die;
        
        $data['arr_get_time_line_inner_circle'] = $this->user_model->getTimeLineForUserAOfcircle_friendsForMainTimeline($arr_inner_circle_friends, '3');
        $data['arr_get_time_line_outer_circle'] = $this->user_model->getTimeLineForUserAOfcircle_friendsForMainTimeline($arr_outer_circle_friends, '4');
        $data['arr_get_my_time_line'] = $this->user_model->getTimeLineForUserAOfcircle_friendsForMainTimeline($arr_my_id);
        $data['arr_get_my_institute_time_line'] = $this->user_model->getTimeLineForUserAOfcircle_friendsForMainTimeline($arr_my_institute_id,'1');
        
        
        /*
        print_R($data['arr_get_time_line_inner_circle']);
        echo "<br />";
        print_R($data['arr_get_time_line_outer_circle']);
        echo "<br />";
        print_R($data['arr_get_my_time_line']);
        echo "<br />";
        die;
        */
        $data['arr_get_time_line_temp'] = array_merge($data['arr_get_time_line_inner_circle'],$data['arr_get_time_line_outer_circle'],$data['arr_get_my_time_line'],$data['arr_get_my_institute_time_line']);
        
        foreach($data['arr_get_time_line_temp'] as $timeline){
            $arr_get_time_line[$timeline['timeline_id']] = $timeline;
        }
        sort($arr_get_time_line);
        array_unique($arr_get_time_line);
        rsort($arr_get_time_line);
        $data['arr_get_time_line'] = $arr_get_time_line;
        
        
        //$data['arr_get_time_line'] = $this->user_model->getTimeLineForUserA($category_id, $sub_category_id, $data['arr_user_data']['institute_id'], $arr_friends_id);
        
        for ($i = 0; $i < count($data['arr_get_time_line']); $i++) {
            $arr_get_time_line_media[] = $this->user_model->getTimeLineMedia($data['arr_get_time_line'][$i]['timeline_id']);
            #Get Comment
            $arr_get_timeline_comments[] = $this->user_model->getTimeLineCommentsUserB($data['arr_get_time_line'][$i]['timeline_id']);
            
            $arr_life_event_count[] = $this->user_model->getLifeEventCountUserA($category_id,$sub_category_id,$data['arr_get_time_line'][$i]['user_id']);
            
        }
        $data['arr_life_event_count'] = $arr_life_event_count;
        $data['arr_my_life_event_count'] = $this->user_model->getLifeEventCountUserA($category_id,$sub_category_id,$user_id);
        
        
        $data['arr_timeline_media'] = $arr_get_time_line_media;
        $data['arr_get_timeline_comments'] = $arr_get_timeline_comments;
        #[End: ]Get Timeline & Timeline media
        $data['arr_visibility'] = $this->common_model->getRecords("mst_visibility", "*", array("visibility_status" => '1'), $order_by = '', $limit = '', $debug = 0);
        $data['category_id'] = $category_id;
        $data['sub_category_id'] = $sub_category_id;
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['arr_category_name'] = $this->common_model->getRecords("mst_categories", "category_name", array("category_id" => base64_decode($sub_category_id)));
        $data['header'] = array('title' => 'Institute Timeline');
        
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/main-timeline', $data);
        $this->load->view('front/includes/ui2-footer', $data);
        
    }
    public function userProfile() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $user_id = $data['user_session']['user_id'];
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $data['header'] = array('title' => 'User Dashboard');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($user_id);
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/main-timeline');
        $this->load->view('front/includes/ui2-footer', $data);
        
    }

    public function studentTimeLine($category_url) {
        $data = $this->common_model->commonFunction();
        $this->load->helper('my_date_helper');
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $this->load->model("user_model");
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        #[Start: ]Get Friend list
        $data['arr_category_id'] = $this->user_model->getCategoryID($category_url);
        $sub_category_id = base64_encode($data['arr_category_id'][0]['sub_category_id']);
        $category_id = base64_encode($data['arr_category_id'][0]['category_id']);
        $parent_id = base64_encode($data['arr_category_id'][0]['parent_id']);
        $condition_friends = "to_user_id ='" . $user_id . "' OR from_user_id ='" . $user_id . "' ";
        $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);
        $arr_friends_id = array();
        foreach ($friends_details as $friend) {

            if ($friend['to_user_id'] == $user_id) {
                $arr_friends_id[] = $friend['from_user_id'];
            } else {
                $arr_friends_id[] = $friend['to_user_id'];
            }
        }
        array_push($arr_friends_id, $data['user_session']['user_id']);
        array_push($arr_friends_id, $data['arr_user_data']['institute_id']);
        $arr_friends_id = array_unique($arr_friends_id);
        #[End: ]Get Friend list
        
        # Get visibility friend status
        for($i = 0; $i<count($arr_friends_id); $i++){
            //echo $arr_friends_id[$i]."</br>";
            $friend_condition = "to_user_id ='" . $arr_friends_id[$i] . "' AND from_user_id ='" . $user_id . "' OR to_user_id ='" . $user_id . "' AND from_user_id ='" . $arr_friends_id[$i] . "'";
            $friends_visibility_status[] = $this->common_model->getRecords('mst_user_friends', $fields = '*', $friend_condition, $order_by = '', $limit = '', $debug = 0);
        }
        
        $arr_inner_circle_friends = array();
        $arr_outer_circle_friends = array();
        $arr_my_id = array($user_id);
        $arr_my_institute_id = array($data['arr_user_data']['institute_id']);
        
        for($j = 0; $j<count($friends_visibility_status);$j++){
      
            if ($friends_visibility_status[$j][0]['to_user_id'] == $user_id) {
                
                if($friends_visibility_status[$j][0]['visibility_id'] == '3'){
                    array_push($arr_inner_circle_friends, $friends_visibility_status[$j][0]['from_user_id']);
                }
                if($friends_visibility_status[$j][0]['visibility_id'] == '4'){
                   array_push($arr_outer_circle_friends, $friends_visibility_status[$j][0]['from_user_id']);
                }
            
            }else{
                
                if($friends_visibility_status[$j][0]['visibility_id'] == '3'){
                    array_push($arr_inner_circle_friends, $friends_visibility_status[$j][0]['to_user_id']);
                }
                if($friends_visibility_status[$j][0]['visibility_id'] == '4'){
                   array_push($arr_outer_circle_friends, $friends_visibility_status[$j][0]['to_user_id']);
                }
            }
            
        }
             
        #[Start: ]Get & Timeline Timeline media
        /*** getting all friends time lines ***/
        //print_R($arr_outer_circle_friends);die;
        
        $data['arr_get_time_line_inner_circle'] = $this->user_model->getTimeLineForUserAOfcircle_friends($category_id, $sub_category_id, $arr_inner_circle_friends, '3');
        $data['arr_get_time_line_outer_circle'] = $this->user_model->getTimeLineForUserAOfcircle_friends($category_id, $sub_category_id, $arr_outer_circle_friends, '4');
        $data['arr_get_my_time_line'] = $this->user_model->getTimeLineForUserAOfcircle_friends($category_id, $sub_category_id, $arr_my_id);
        $data['arr_get_my_institute_time_line'] = $this->user_model->getTimeLineForUserAOfcircle_friends($category_id, $sub_category_id, $arr_my_institute_id,'1');
        
        
        /*
        print_R($data['arr_get_time_line_inner_circle']);
        echo "<br />";
        print_R($data['arr_get_time_line_outer_circle']);
        echo "<br />";
        print_R($data['arr_get_my_time_line']);
        echo "<br />";
        die;
        */
        $data['arr_get_time_line_temp'] = array_merge($data['arr_get_time_line_inner_circle'],$data['arr_get_time_line_outer_circle'],$data['arr_get_my_time_line'],$data['arr_get_my_institute_time_line']);
        
        foreach($data['arr_get_time_line_temp'] as $timeline){
            $arr_get_time_line[$timeline['timeline_id']] = $timeline;
        }
        sort($arr_get_time_line);
        array_unique($arr_get_time_line);
        rsort($arr_get_time_line);
        $data['arr_get_time_line'] = $arr_get_time_line;
        
        
        //$data['arr_get_time_line'] = $this->user_model->getTimeLineForUserA($category_id, $sub_category_id, $data['arr_user_data']['institute_id'], $arr_friends_id);
        
        for ($i = 0; $i < count($data['arr_get_time_line']); $i++) {
            $arr_get_time_line_media[] = $this->user_model->getTimeLineMedia($data['arr_get_time_line'][$i]['timeline_id']);
            #Get Comment
            $arr_get_timeline_comments[] = $this->user_model->getTimeLineCommentsUserB($data['arr_get_time_line'][$i]['timeline_id']);
            
            $arr_life_event_count[] = $this->user_model->getLifeEventCountUserA($category_id,$sub_category_id,$data['arr_get_time_line'][$i]['user_id']);
            
        }
        $data['arr_life_event_count'] = $arr_life_event_count;
        $data['arr_my_life_event_count'] = $this->user_model->getLifeEventCountUserA($category_id,$sub_category_id,$user_id);
        
        
        $data['arr_timeline_media'] = $arr_get_time_line_media;
        $data['arr_get_timeline_comments'] = $arr_get_timeline_comments;
        #[End: ]Get Timeline & Timeline media
        $data['arr_visibility'] = $this->common_model->getRecords("mst_visibility", "*", array("visibility_status" => '1'), $order_by = '', $limit = '', $debug = 0);
        $data['category_id'] = $category_id;
        $data['sub_category_id'] = $sub_category_id;
        $data['parent_id'] = $parent_id;
        
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['arr_category_name'] = $this->common_model->getRecords("mst_categories", "category_name", array("category_id" => base64_decode($sub_category_id)));
        $data['header'] = array('title' => 'Institute Timeline');
        
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/userA-time-line', $data);
        $this->load->view('front/includes/ui2-footer', $data);
        
    }

    /* To Post Comment On Timeline. */

    public function postCommentOnTimeline() {

        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
        $this->load->model("common_model");
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $arr_user_details = $this->common_model->getRecords("mst_users", "profile_picture,first_name,last_name,user_name", array("user_id" => $user_id));
        if ($this->input->post('post_comments') != '') {
            $arr_to_insert_comment = array(
                "user_id" => $user_id,
                "timeline_id" => $this->input->post('timeline_id'),
                'comments_posted_date' => date('Y-m-d H:i:s'),
                "comments" => $this->input->post('post_comments'),
                "comments_status" => '1'
            );
            $insertID = $this->common_model->insertRow($arr_to_insert_comment, "trans_timeline_comments");
            $str.='<li>';
            $str.='<div class="media" id="' . $this->input->post('timeline_id') . '">';
            $str.='<a href="' . base_url() . 'profile/' . $arr_user_details[0]['user_name'] . '" class="pull-left">';
            $str.='<img src="' . base_url() . 'media/front/img/user-images/50/' . $arr_user_details[0]['profile_picture'] . '" class="media-object">';
            $str.='</a>';
            $str.='<div class = "pull-right dropdown" data-show-hover = "li">';
            $str.='<a href = "#" data-toggle = "dropdown" class = "toggle-button">';
            $str.='<i class = "fa fa-pencil"></i>';
            $str.='</a>';
            $str.='<ul class = "dropdown-menu" role = "menu">';
            $str.='<li><a href = "#">Edit</a>';
            $str.='</li>';
            $str.='<li><a href = "#">Delete</a>';
            $str.='</li>';
            $str.='</ul>';
            $str.='</div>';
            $str.='<div class = "media-body">';
            $str.='<a href = "' . base_url() . 'profile/' . $arr_user_details[0]['user_name'] . '" class = "comment-author">' . ucfirst($arr_user_details[0]['first_name']) . ' ' . substr(ucfirst($arr_user_details[0]['last_name']), 0, 1) . '</a>';
            $str.=' <span>' . $this->input->post('post_comments') . '</span>';
            $str.='<div class = "comment-date">0 min</div>';
            $str.='</div>';
            $str.='</div>';
            $str.='</li>';
            sleep(1);
            echo $this->input->post('timeline_id') . '|' . $str;
        }
    }

    public function studentTimeLine_BKKK($sub_category_id, $category_id) {
        $data = $this->common_model->commonFunction();
        $this->load->helper('my_date_helper');
        $data['global'] = $this->common_model->getGlobalSettings();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $this->load->model("user_model");
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];

        #[Start: ]Get Friend list

        $condition_friends = "to_user_id ='" . $user_id . "' OR from_user_id ='" . $user_id . "' ";
        $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);

        $arr_friends_id = array();
        foreach ($friends_details as $friend) {

            if ($friend['to_user_id'] == $user_id) {
                $arr_friends_id[] = $friend['from_user_id'];
            } else {
                $arr_friends_id[] = $friend['to_user_id'];
            }
        }
        array_push($arr_friends_id, $data['user_session']['user_id']);
        array_push($arr_friends_id, $data['arr_user_data']['institute_id']);
        //print_R($arr_friends_id);die;
        #[End: ]Get Friend list
        #[Start: ]Get & Timeline Timeline media
        $data['arr_get_time_line'] = $this->user_model->getTimeLineForUserA($category_id, $sub_category_id, $data['arr_user_data']['institute_id'], $arr_friends_id);
        //print_R($data['arr_get_time_line']);die;
        for ($i = 0; $i < count($data['arr_get_time_line']); $i++) {
            $arr_get_time_line_media[] = $this->user_model->getTimeLineMedia($data['arr_get_time_line'][$i]['timeline_id']);
            #Get Comment
            $arr_get_timeline_comments[] = $this->user_model->getTimeLineCommentsUserB($data['arr_get_time_line'][$i]['timeline_id']);
        }

        $data['arr_timeline_media'] = $arr_get_time_line_media;
        $data['arr_get_timeline_comments'] = $arr_get_timeline_comments;

        #[End: ]Get Timeline & Timeline media
        $data['arr_visibility'] = $this->common_model->getRecords("mst_visibility", "*", array("visibility_status" => '1'), $order_by = '', $limit = '', $debug = 0);
        $data['category_id'] = $category_id;
        $data['sub_category_id'] = $sub_category_id;
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();

        $data['arr_category_name'] = $this->common_model->getRecords("mst_categories", "category_name", array("category_id" => base64_decode($sub_category_id)));

        $data['header'] = array('title' => 'Institute Timeline');
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/userA-time-line', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /* public function userAFriends() {
      $data['global'] = $this->common_model->getGlobalSettings();
      $data = $this->common_model->commonFunction();
      if (!$this->common_model->isLoggedIn()) {
      redirect('signin');
      }
      $data['user_session'] = $this->session->userdata('user_account');
      $this->load->model("user_model");
      $data['header'] = array('title'=>'User Dashboard');
      $condition_to_pass = array("interest_status" => '1');
      $data['arr_interest_details'] = $this->common_model->getRecords("mst_interest","*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
      $this->load->view('front/includes/ui2-header1',$data);
      $this->load->view('front/includes/ui2-header2');
      $this->load->view('front/includes/ui2-userA-left-menu');
      $this->load->view('front/user-accountA/friends');
      } */

    public function userAManageFriends() {

        $data = $this->common_model->commonFunction();
        $data['global'] = $this->common_model->getGlobalSettings();

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $this->load->model("user_model");

        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $data['user_session']['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];



        #[Start: ]Get Friend list
        $condition_friends = "to_user_id ='" . $user_id . "' OR from_user_id ='" . $user_id . "' ";
        $friends_details = $this->common_model->getRecords('mst_user_friends', $fields = '*', $condition_friends, $order_by = '', $limit = '', $debug = 0);
//        echo '<pre>';print_R($friends_details);die;
        $arr_friends_id = array();
        foreach ($friends_details as $friend) {

            if ($friend['to_user_id'] == $user_id) {

                $arr_friends_id[] = $friend['from_user_id'];
            } else {

                $arr_friends_id[] = $friend['to_user_id'];
            }
        }
        //print_R($arr_friends_id);die;

        for ($i = 0; $i < count($arr_friends_id); $i++) {
            $arr_friends[] = $this->common_model->getAllFriendsTotalCount($arr_friends_id[$i]);
        }
        $data['arr_friends_list'] = $arr_friends;
        //print_R($data['arr_friends_list']);die;

        $data['arr_my_friends_id'] = $arr_friends_id;
        #[End: ]Get Friend list


        $data['arr_visibility'] = $this->common_model->getRecords("mst_visibility", "*", array("visibility_status" => '1'), $order_by = 'visibility_id DESC', $limit = '', $debug = 0);
        $data['header'] = array('title' => 'Manage Friends');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($user_id);

        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/manage-friends', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    public function userAMessages() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];

        $this->load->model("user_model");
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];

        $data['user_session'] = $this->session->userdata('user_account');

        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($user_id);

        $data['header'] = array('title' => 'User Dashboard');
        $condition_to_pass = array("interest_status" => '1');
        $data['arr_interest_details'] = $this->common_model->getRecords("mst_interest", "*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/userA-private-messages', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /*
     * Change user's account setting
     */

    public function userAAcoountSetting() {

        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $this->load->model("user_model");
        /*
         * Starts Action :: Change Password.
         */
        if ($_POST['btn_change_passwd'] == 'Change Password') {
            $table_name = 'mst_users';
            $update_data = array('user_password' => base64_encode($this->input->post('new_user_password')));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
            if ($cnf_profile) {
                $this->session->set_userdata("msg", "<span class='success'>Your password has been updated successfully.</span>");
                redirect(base_url() . 'student/user-account-setting');
                exit;
            }
        }
        /*
         * START :: Fetch User Profile Data :
         */
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        $condition = array("news_status" => '1');
        $data['arr_news_details'] = $this->common_model->getRecords("trans_rss_news", "*", $condition, $order_by = '', $limit = '', $debug = 0);
        $data['header'] = array('title' => 'Account Setting');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($user_id);
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2', $data);
        $this->load->view('front/includes/ui2-userA-left-menu', $data);
        $this->load->view('front/user-accountA/account-setting', $data);
        $this->load->view('front/includes/ui2-footer', $data);
    }

    /*     * ********************time line setting************************** */
    /*
     * Change user's account setting
     */

    public function timeLineSetting() {

        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $data['header'] = array('title' => 'timeline setting');
        $this->load->model("user_model");
        $post_visibility = implode(",", $this->input->post("post_visibility"));
        if ($_POST['btn_timeline_setting'] == 'Save changes') {
            $table_name = 'mst_users';
            $update_data = array('Automatically_approve_comments' => $this->input->post('automatic_approve_comment'));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);

            if (count($cnf_profile) > 0) {
                $this->session->set_userdata("msg", "<span class='success'>Your timeline has been updated successfully.</span>");
                redirect(base_url() . 'student/user-account-setting');
                exit;
            }
        }
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];

        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userA-left-menu');
        $this->load->view('front/user-accountA/account-setting', $data);
    }

    /*     * ********************My News**************************** */

    public function myNews() {

        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }

        $data['user_session'] = $this->session->userdata('user_account');
        $data['header'] = array('title' => 'My news');
        $this->load->model("user_model");
        $post_visibility_news = implode(",", $this->input->post("post_visibility_news"));
        if ($_POST['btn_my_news'] == 'Save changes') {
            $table_name = 'mst_users';
            $update_data = array('rss_newsletter' => $post_visibility_news);
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);

            if (count($cnf_profile) > 0) {
                $this->session->set_userdata("msg", "<span class='success'>Your News has been updated successfully.</span>");
                redirect(base_url() . 'student/user-account-setting');
                exit;
            }
        }
        $arr_user_data = $this->user_model->getUserInformationById($data['user_account']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userA-left-menu');
        $this->load->view('front/user-accountA/account-setting', $data);
    }

    public function aboutUserA() {

        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        $data['header'] = array('title' => 'User Dashboard');
        $condition_to_pass = array("interest_status" => '1');
        $data['arr_interest_details'] = $this->common_model->getRecords("mst_interest", "*", $condition_to_pass, $order_by = '', $limit = '', $debug = 0);
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userA-left-menu');
        $this->load->view('front/user-accountA/about-user');
    }

    public function editUserAProfile() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $data = $this->common_model->commonFunction();
        $this->load->model("user_model");
        if ($this->input->post()) {
            if ($_FILES['profile_picture']['name'] != "") {
                $image_data = array();
//config initialise for uploading image 
                $config['upload_path'] = './media/front/img/user-images/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '5000';
                $config['max_width'] = '12024';
                $config['max_height'] = '7268';
                $config['file_name'] = time();
//loading upload library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('profile_picture')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {

                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $this->upload->data();
                    $file_name = $image_data['file_name'];

                    $target_path = $absolute_path . 'media/front/img/user-images/thumbs/' . $file_name;
                    $target_path1 = $absolute_path . 'media/front/img/user-images/50/' . $file_name;

                    exec("convert " . $image_data['full_path'] . " -resize 100X110 " . $target_path);
                    exec("convert " . $image_data['full_path'] . " -resize 50X50 " . $target_path1);
//                    $config = array(
//                        'source_image' => $image_data['full_path'],
//                        'new_image' => './media/front/img/user-images/thumbs/',
//                        'create_thumb' => FALSE,
//                        'maintain_ratio' => TRUE,
//                        'width' => 110,
//                        'height' => 110
//                    );
//
//                    $this->load->library('image_lib', $config);
//                    $this->image_lib->initialize($config);
//                    $this->image_lib->resize();
//
//                    $config1 = array(
//                        'source_image' => $image_data['full_path'],
//                        'new_image' => 'media/front/img/user-images/50/',
//                        'create_thumb' => FALSE,
//                        'maintain_ratio' => TRUE,
//                        'width' => 50,
//                        'height' => 50
//                    );
//                    $this->image_lib->initialize($config1);
//                    $this->image_lib->resize();
                }
                $file_name = $image_data['file_name'];
            } else {
                $file_name = $_POST['old_image_name'];
            }


            if ($this->input->post('user_email') != $this->input->post('old_user_email')) {
                $status = '0';
                $email_verified = '0';
            } else {
                $status = '1';
                $email_verified = '1';
            }

#setting variable to update or add user record.
            $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => $user_id));

            if ($this->input->post('user_email') != $this->input->post('old_user_email')) {
                $activation_code = time();
            } else {
                $activation_code = $arr_user_detail[0]['activation_code'];
            }
            $dob = $this->input->post('year') . "-" . $this->input->post('month') . '-' . $this->input->post('day');
            $interest = implode(",", $this->input->post("interest"));
//            echo $this->input->post('newsletter');die;
            $update_data = array(
                "user_name" => $this->input->post('user_name'),
                "pin_code" => $this->input->post('pin_code'),
                "contact_no" => mysql_real_escape_string($this->input->post('contact_number')),
                "country_code" => mysql_real_escape_string($this->input->post('country_code')),
                "user_email" => $this->input->post('user_email'),
                "user_status" => $status,
                "email_verified" => $email_verified,
                "gender" => $this->input->post('gender'),
                "interest_id" => $interest,
                "date_of_birth" => date('Y-m-d', strtotime($dob)),
                'profile_picture' => $file_name,
                "send_email_notification" => $this->input->post('newsletter'),
                "terms_condition" => $this->input->post('terms'),
                "activation_code" => $activation_code,
            );
            $condition = array("user_id" => $user_id);
            $cnf_profile = $this->common_model->updateRow('mst_users', $update_data, $condition);
            if ($_POST["other_interest"] == "1") {
                $other_interest = $this->common_model->getRecords("trans_temp_interest", "*", array("user_id" => $user_id));
                if (!empty($other_interest)) {
                    $arr_to_update_interest = array("comment" => mysql_real_escape_string($this->input->post("new_interest")));
                    $this->common_model->updateRow("trans_temp_interest", $arr_to_update_interest, array("user_id" => $user_id));
                } else {
                    $arr_to_insert_interest = array("user_id" => $user_id,
                        "comment" => mysql_real_escape_string($this->input->post("new_interest")),
                        "status" => "0");
                    $this->common_model->insertRow($arr_to_insert_interest, "trans_temp_interest");
                }
            } else {
                $this->common_model->deleteRows(array($user_id), "trans_temp_interest", "user_id");
            }
            if ($this->input->post('user_email') != $this->input->post('old_user_email')) {
                $arr_user_detail = $this->common_model->getRecords("mst_users", "", array("user_id" => $user_id));
#sending account verification link mail to user
                $lang_id = 17;
                $activation_link = '<a href="' . base_url() . 'user-activation-front/' . $activation_code . '">Activate Account</a>';
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
                    "||NEW_EMAIL||" => $this->input->post('user_email'),
                    "||PASSWORD||" => $arr_user_detail[0]['user_password'],
                    "||ADMIN_ACTIVATION_LINK||" => $activation_link
                );
                $reserved = array_replace_recursive($macros_array, $reserved_words);
                $template_title = 'email-updated';
                $email_content = $this->common_model->getEmailTemplateInfo($template_title, $lang_id, $reserved);
                $recipeinets = $this->input->post('user_email');
                $data['global'] = $this->common_model->getGlobalSettings();
                $from = array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']);
                $subject = $email_content['subject'];
                $message = $email_content['content'];
                $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                if ($mail) {
                    $this->session->set_userdata('profile_edit_success', "<strong>Congratulations!</strong> You have profile edit successfully. We have sent email to activate your account on <strong>" . $this->input->post('user_email') . "</strong>.");
                }
                $this->session->unset_userdata('user_account');
                redirect(base_url() . 'signin');
            } else {

                $this->session->set_userdata('msg', '<strong>Congratulations!</strong> Profile has been updated successfully!');
                redirect(base_url() . 'student-user-profile');
            }
        }
    }

    public function validEditProfile() {
        $this->load->library('form_validation');
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');

        /* Settning the validation rules */
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        $this->form_validation->set_rules('user_name', 'user name', 'required|callback_chkEditUsernameDuplicateCI');
        $this->form_validation->set_rules('user_email', 'email', 'required|valid_email|callback_chkEditEmailDuplicateCI');
        /* Cheacking the form is valid or not */
        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Check user email for dupliation for server Side
     */

    public function chkEditEmailDuplicateCI($user_email) {
        $this->load->model("user_model");
        if ($user_email == $this->input->post('user_email_old')) {
            return true;
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_email');
            $condition_to_pass = array("user_email" => $user_email);
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

            if (count($arr_login_data)) {
                $this->form_validation->set_message('chkEditEmailDuplicateCI', 'This email address is already registered with site.');
                return false;
            } else {
                return true;
            }
        }
    }

    /*
     * Check username for dupliation 
     */

    public function chkEditUsernameDuplicateCI($user_name) {
        $this->load->model("user_model");
        if ($user_name == $this->input->post('user_name_old')) {
            return true;
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_name');
            $condition_to_pass = array("user_email" => $user_name);
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                $this->form->validation->set_message('chkEditUsernameDuplicateCI');
                return false;
            }
            /* Validation for character accepting */
            if (!preg_match("/^[a-zA-Z\.\_\-]{5,20}+$/", $user_name)) {
                $this->form_validation->set_message('chkEditUsernameDuplicateCI', 'Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.');
                return false;
            }
            /* If all right return true */
            return true;
        }
    }

    /*
     * Check user email for dupliation 
     */

    public function chkEditEmailDuplicate() {
        $this->load->model("user_model");
        if ($this->input->post('user_email') == $this->input->post('user_email_old')) {
            echo 'true';
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_email');
            $condition_to_pass = array("user_email" => $this->input->post('user_email'));
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * Check username for dupliation 
     */

    public function chkEditUsernameDuplicate() {
        $this->load->model("user_model");
        if ($this->input->post('user_name') == $this->input->post('user_name_old')) {
            echo 'true';
        } else {
            $table_to_pass = 'mst_users';
            $fields_to_pass = array('user_id', 'user_name');
            $condition_to_pass = array("user_email" => $this->input->post('user_name'));
            $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            if (count($arr_login_data)) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }

    /*
     * Change user's account setting
     */

    public function accountSetting() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        if ($this->validAccountSetting()) {
            $table_name = 'mst_users';
            $update_data = array('user_password' => base64_encode($this->input->post('new_user_password')));
            $condition = array("user_id" => $data['user_session']['user_id']);
            $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
            if ($cnf_profile) {
                $this->session->set_userdata('edit_profile_success', "Your account setting has been updated successfully.");
                redirect(base_url() . 'profile');
            }
        }
        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $data['header'] = array("title" => "Account Setting", "keywords" => "", "description" => "");
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/account-setting', $data);
        $this->load->view('front/includes/footer');
    }

    /* Function to validate the account settings server side */

    public function validAccountSetting() {

        $this->load->library('form_validation');
        /* Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
        $this->form_validation->set_error_delimiters('<label class="text-danger">', '</label>');

        /* Settning the validation rules */
        $this->form_validation->set_rules('old_user_password', 'old password', 'required|callback_editUserPasswordChkCI');
        $this->form_validation->set_rules('new_user_password', 'new password', 'required|min_length[8]|callback_chkPasswordStrenth');
        $this->form_validation->set_rules('cnf_user_password', 'confirm password', 'required|matches[new_user_password]');
        /* Cheacking the form is valid or not */
        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Password validation server side
     */

    public function chkPasswordStrenth($password) {
        /* Checking the password is valid or not usering the reguler expression */
        if (!preg_match("/^(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!%&@#$^({{}})*?_~]).*$/", $password)) {
            $this->form_validation->set_message('chkPasswordStrenth', 'Password must be strong.');
            return false;
        } else {
            return true;
        }
    }

    /*
     * Check user password for edit
     */

    public function editUserPasswordChkCI($old_user_password) {
        $this->load->model("user_model");
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_password');
        $condition_to_pass = array("user_password" => base64_encode($old_user_password));
        $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            return true;
        } else {
            $this->form_validation->set_message('editUserPasswordChkCI', 'Incorrect old password.');
            return false;
        }
    }

    /*
     * Check user password for edit
     */

    public function editUserPasswordChk() {
        $this->load->model("user_model");
        $table_to_pass = 'mst_users';
        $fields_to_pass = array('user_id', 'user_password');
        $condition_to_pass = array("user_password" => base64_encode($this->input->post('old_user_password')));
        $arr_login_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        if (count($arr_login_data)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /*
     * Edit user's profile image
     */

    public function changeProfilePicture() {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        if ($this->input->post('btn_upload') != "") {
            if (isset($_FILES['upload_profile_picture']) && $_FILES['upload_profile_picture']['name'] != '') {

                $data = $this->common_model->commonFunction();
                $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
                $max_file_size = 2000 * 1024; #2000kb
                $nw = $nh = 200;
                if (!$_FILES['upload_profile_picture']['error'] && $_FILES['upload_profile_picture']['size'] < $max_file_size) {
                    $ext = strtolower(pathinfo($_FILES['upload_profile_picture']['name'], PATHINFO_EXTENSION));
                    if (in_array($ext, $valid_exts)) {
                        $profile_picture = uniqid() . '.' . $ext;
                        $file_path = $data['absolute_path'] . 'media/front/users/';
                        chmod($file_path, 0777);
                        if (file_exists($file_path . $this->input->post('old_profile_picture'))) {
                            unlink($file_path . $this->input->post('old_profile_picture'));
                        }
                        $path = $file_path . $profile_picture;
                        $size = getimagesize($_FILES['upload_profile_picture']['tmp_name']);
                        $x = (int) $this->input->post('x');
                        $y = (int) $this->input->post('y');
                        $w = (int) $this->input->post('w') ? $this->input->post('w') : $size[0];
                        $h = (int) $this->input->post('h') ? $this->input->post('h') : $size[1];
                        $data = file_get_contents($_FILES['upload_profile_picture']['tmp_name']);
                        $vImg = imagecreatefromstring($data);
                        $dstImg = imagecreatetruecolor($nw, $nh);
                        imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
                        imagejpeg($dstImg, $path);
                        imagedestroy($dstImg);
                        $table_name = 'mst_users';
                        $update_data = array(
                            'profile_picture' => $profile_picture
                        );
                        $condition = array("user_id" => $this->input->post('user_id'));
                        $cnf_profile = $this->common_model->updateRow($table_name, $update_data, $condition);
                        if ($cnf_profile) {
                            $this->session->set_userdata('edit_profile_picture_success', "Your profile picture has been updated successfully.");
                            redirect(base_url() . "profile");
                        }
                    } else {
                        $this->session->set_userdata('edit_profile_picture_success', "Invalid file format.");
                        redirect(base_url() . "profile");
                    }
                } else {
                    $this->session->set_userdata('edit_profile_picture_success', "File is too small or large.");
                    redirect(base_url() . "profile");
                }
            } else {
//$this->session->set_userdata('edit_profile_picture_success', "Please select file to upload.");
                redirect(base_url() . "profile/change-profile-picture");
            }
        }
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        $table_to_pass = 'mst_users';
        $fields_to_pass = 'user_id,first_name,last_name,user_email,user_name,user_type,user_status,profile_picture,gender';
        $user_account = $this->session->userdata('user_account');
        $condition_to_pass = array("user_id" => $user_account['user_id']);
        $arr_user_data = array();
//$arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $arr_user_data = $this->common_model->getRecords("mst_users", "*", array("user_id" => $user_account['user_id']), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        if (is_null($data['arr_user_data']['profile_picture']) && $data['arr_user_data']['profile_picture'] == '') {
            if ($arr_user_data['gender'] == 1) {
                $data['profile_img_path'] = base_url() . 'media/front/img/male.png';
            } else {
                $data['profile_img_path'] = base_url() . 'media/front/img/female.png';
            }
        } else {
            $data['profile_img_path'] = base_url() . 'media/front/users/' . $data['arr_user_data']['profile_picture'];
        }
        $data['header'] = array("title" => "Change Profile Picture", "keywords" => "", "description" => "");
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/user-account/change-profile-picture', $data);
        $this->load->view('front/includes/footer');
    }

    /*
     * Destroy the user session
     */

    function logout() {
        $this->session->unset_userdata('user_account');
        redirect(base_url() . "home");
    }

    public function profileA() {
        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['title_for_layout'] = 'User A profile';
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->model("user_model");
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformationById($data['user_session']['user_id']);
        $data['arr_user_data'] = $arr_user_data[0];
        if ($data['arr_user_data']['profile_picture'] != "") {
            $data['profile_pictures'] = base_url() . 'media/front/img/user-images/300X300/' . $data['arr_user_data']['profile_picture'];
        } else {
            $data['profile_pictures'] = base_url() . 'media/front/img/boy.jpg';
        }
        $data['interest'] = unserialize($data['arr_user_data']['interest']);
        $this->load->view('front/user-accountA/profileA', $data);
    }

    public function userActivation($activation_code) {
        $user_data = $this->session->userdata('user_account');
        if (!empty($user_data)) {
            $this->session->set_userdata('message', '<div class="page_holder"><div class="success_msg">Your account is already active.</div> </div>');
            if ($this->session->userdata('prev_url') != '') {
                redirect(base_url() . $this->session->userdata('prev_url'));
            }
            redirect(base_url() . 'profileA');
        }
        $user_dtl_arr = $this->common_model->getRecords('mst_users', '', array("activation_code" => $activation_code));
        if ($user_dtl_arr[0]['email_verified'] != '1') {
            $table_name = 'mst_users';
            $update_data = array("user_status" => '1', 'email_verified' => '1');
            $condition_to_pass = array("user_id" => $user_dtl_arr[0]['user_id']);
            $this->common_model->updateRow($table_name, $update_data, $condition_to_pass);
            $this->session->set_userdata('message', '<b>Congratulations! </b>Your account has been activated, please login.');
            $this->session->set_userdata('invalid_credentials', '1');
            redirect(base_url() . 'signin');
        } else {
            $this->session->set_userdata('message-error', '<b>Sorry! </b>Your account is already active, please login.');
            $this->session->set_userdata('invalid_credentials', '1');
            redirect(base_url() . 'signin');
        }
    }

    public function newUserActivation($activation_code) {

        $data = $this->common_model->commonFunction();
        $arr_user_dtl = $this->common_model->getRecords('trans_temp_users', '*', array("activation_code" => $activation_code));

        if (count($arr_user_dtl) > 0) {

            $table = 'mst_users';
            $fields = array(
                'user_email' => $arr_user_dtl[0]['user_email'],
                'first_name' => $arr_user_dtl[0]['first_name'],
                'last_name' => $arr_user_dtl[0]['last_name'],
                'user_password' => base64_encode($arr_user_dtl[0]['user_password']),
                'institute_id' => $arr_user_dtl[0]['from_user_id'],
                'user_type' => '1',
                'user_status' => '1',
                'user_role' => '0', // User A
                'activation_code' => $arr_user_dtl[0]['activation_code'],
                'email_verified' => '1',
                'send_email_notification' => '1',
                'terms_condition' => '1',
                'register_date' => date("Y-m-d H:i:s"),
                'ip_address' => $_SERVER['REMOTE_ADDR']
            );

            $insert_id = $this->common_model->insertRow($fields, $table);

            /* Start : Notification */
            $notification_fields = array('from_id' => $insert_id,
                'subject' => $arr_user_dtl[0]['first_name'] . ' has registered.',
                'status' => '1',
                'message_date' => date("Y-m-d H:i:s")
            );
            $this->common_model->insertRow($notification_fields, 'mst_notifications');
            /* End : Notification */

//Send Email To User B
            $arr_userb_dtl = $this->common_model->getRecords('mst_users', 'first_name,last_name,user_email', array("user_id" => $arr_user_dtl[0]['from_user_id']));
            $macros_array_details = array();
            $macros_array_details = $this->common_model->getRecords("mst_email_template_macros", $fields_to_pass = 'macros,value', $condition_to_pass = '', $order_by = '', $limit = '', $debug = 0);
            $macros_array = array();
            foreach ($macros_array_details as $row) {
                $macros_array[$row['macros']] = $row['value'];
            }
            $reserved_words = array(
                "||SITE_TITLE||" => $data['global']['site_title'],
                "||SITE_PATH||" => base_url(),
                "||ADMIN_NAME||" => $arr_userb_dtl[0]['first_name'] . ' ' . $arr_userb_dtl[0]['last_name'],
                "||FIRST_NAME||" => $arr_user_dtl[0]['first_name'],
                "||LAST_NAME||" => $arr_user_dtl[0]['last_name'],
                "||USER_EMAIL||" => $arr_user_dtl[0]['user_email'],
            );
            $reserved = array_replace_recursive($macros_array, $reserved_words);
#getting mail subect and mail message using email template title and lang_id and reserved works
            $email_content = $this->common_model->getEmailTemplateInfo('new-user-login-successfull', 17, $reserved);
#sending admin added mail to added admin mail id.
#1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body
            $mail = $this->common_model->sendEmail(array($arr_userb_dtl[0]['user_email']), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
//Delete Temp Record
            $activation_code_arr = array("activation_code" => $activation_code);
            $this->common_model->deleteRows($activation_code_arr, "trans_temp_users", "activation_code");
            $this->session->set_userdata('message', '<b>Congratulations! </b>Your account has been activated, please login!');
            redirect(base_url() . 'userA-signin');
        } else {
            $this->session->set_userdata('login_error', '<b>Sorry! </b>Invalid activation code!');
            $this->session->set_userdata('invalid_credentials', '1');
            redirect(base_url() . 'signin');
        }
    }

}

?>
