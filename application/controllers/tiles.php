<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tiles extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('common_model');
        $this->load->model('user_model');
        $this->load->model('category_model');
        $this->load->model('friend_model');
    }

    public function index() {

        $this->load->view('front/includes/ui1-header1');
        $this->load->view('front/includes/ui1-header2');

        $this->load->view('front/UI1/home');
        $this->load->view('front/includes/ui1-footer');
    }

    public function personal_brownies() {
        $data["arr_personal_brownies"] = $this->category_model->getTilesPersonalBrownies();
        for ($i = 0; $i < count($data["arr_personal_brownies"]); $i++) {
            $arr_personal_brownies_count[] = $this->category_model->getDigitalRecordsCount($data["arr_personal_brownies"][$i]['category_id']);
        }
        $data['arr_personal_brownies_count'] = $arr_personal_brownies_count;
        $this->load->view('front/UI1/tiles/personal-browni/personal-brownies',$data);
    }

    public function institute_brownies() {
        $data["arr_institute_brownies"] = $this->category_model->getTilesInstituteBrownies();
        for ($i = 0; $i < count($data["arr_institute_brownies"]); $i++) {
            $arr_institute_brownies_count[] = $this->category_model->getDigitalRecordsCount($data["arr_institute_brownies"][$i]['category_id']);
        }
        $data['arr_institute_brownies_count'] = $arr_institute_brownies_count;
        $this->load->view('front/UI1/tiles/insititue-browni/insititue-brownies',$data);
    }

    public function me_tile() {
        $data = $this->common_model->commonFunction(); 
        $this->load->view('front/UI1/tiles/click-edit/click-edit',$data);
    }

    public function timeline() {
        
        $data = $this->common_model->commonFunction(); 
        $this->load->helper('my_date_helper');
        $user_account = ($data['user_account']);
      //  print_r($user_account);
        if(!(empty($data['user_account']))){
           $data['timeline'] = $this->friend_model->getMyNotificationFeed($user_account['user_id']); 
           //print_r($data['timeline'] );
        }
        
        
        $this->load->view('front/UI1/tiles/timeline/timeline',$data);
    }

    public function ad1() {
        $this->load->view('front/UI1/tiles/ad-1/ad-1');
    }

    public function ad2() {
        $this->load->view('front/UI1/tiles/ad-1/ad-2');
    }

    public function ad3() {
        $this->load->view('front/UI1/tiles/ad-1/ad-3');
    }

    public function second_ad1() {
        $this->load->view('front/UI1/tiles/ad-2/ad-1');
    }

    public function second_ad2() {
        $this->load->view('front/UI1/tiles/ad-2/ad-2');
    }

    public function second_ad3() {
        $this->load->view('front/UI1/tiles/ad-2/ad-3');
    }

    public function digital_record() {
        $data["arr_digital_records"] = $this->category_model->getTilesDigitalRecords();
        for ($i = 0; $i < count($data["arr_digital_records"]); $i++) {
            $arr_digital_records_count[] = $this->category_model->getDigitalRecordsCount($data["arr_digital_records"][$i]['category_id']);
        }
        $data['arr_digital_records_count'] = $arr_digital_records_count;
        $this->load->view('front/UI1/tiles/digital-record/digital-record', $data);
    }

    public function site_info1() {
        $this->load->view('front/UI1/tiles/siteinfo/siteinfo1');
    }

    public function site_info2() {
        $this->load->view('front/UI1/tiles/siteinfo/siteinfo2');
    }

    public function site_info3() {
        $this->load->view('front/UI1/tiles/siteinfo/siteinfo3');
    }

    public function friend_tile1() {
       
        
        $data = $this->common_model->commonFunction(); 
        $data['header'] = array('title'=>'Home');
        $data['user_role'] = 0;
       
        $user_session = $this->session->userdata('user_account');
        $data['user_session'] = $user_session;
        $this->load->helper('my_date_helper'); 
        if(!(empty($user_session))){
           $condition = array("user_id"=>$user_session['user_id']);
           $data['user_details'] = $this->common_model->getRecords('mst_users',"*",$condition);
           $condition1 = array("user_id"=>$data['user_details'][0]['institute_id']);
           $data['banner'] = $this->common_model->getRecords('mst_banner',"*",$condition1);
           $data['friends'] = $this->friend_model->getNotificationFriend($user_session['user_id']); 
        }
        
      // print_r($data['friends']);
        $this->load->view('front/UI1/tiles/myfriends/myfriends1',$data);
    }

    public function friend_tile2() {
        $this->load->view('front/UI1/tiles/myfriends/myfriends2');
    }

    public function friend_tile3() {
        $this->load->view('front/UI1/tiles/myfriends/myfriends3');
    }

    public function social() {
        $this->load->view('front/UI1/tiles/social/social');
    }

    public function news1_tile() {
        $this->load->view('front/UI1/tiles/social/social');
    }

    public function newsrender() {
        $this->load->view('front/UI1/tiles/newrender/app/FlickrApp');
    }

    public function calender() {
        $this->load->view('front/UI1/tiles/calender/app/FlickrApp');
    }

    public function my_gaming1() {
        $this->load->view('front/UI1/tiles/mygaming/mygaming1');
    }

    public function my_gaming2() {
        $this->load->view('front/UI1/tiles/mygaming/mygaming2');
    }

    public function my_gaming3() {
        $this->load->view('front/UI1/tiles/mygaming/mygaming3');
    }

    public function my_music1() {
        $this->load->view('front/UI1/tiles/mymusic/mymusic1');
    }

    public function my_music2() {
        $this->load->view('front/UI1/tiles/mymusic/mymusic2');
    }

    public function my_video1() {
        $this->load->view('front/UI1/tiles/myvideo/myvideo1');
    }

    public function my_video2() {
        $this->load->view('front/UI1/tiles/myvideo/myvideo2');
    }

    public function my_video3() {
        $this->load->view('front/UI1/tiles/myvideo/myvideo3');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */