<?php   


if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->model('common_model');
        $this->load->model('category_model');
    }

    public function index() {  
        $this->load->model('friend_model');
        
        $data = $this->common_model->commonFunction(); 
        $data['header'] = array('title'=>'Home');
        $data['user_role'] = 0;
       
        $user_session = $this->session->userdata('user_account');
        $data['user_session'] = $user_session;
        
        if(!(empty($user_session))){
           $condition = array("user_id"=>$user_session['user_id']);
           $data['user_details'] = $this->common_model->getRecords('mst_users',"*",$condition);
           $condition1 = array("user_id"=>$data['user_details'][0]['institute_id']);
           $data['banner'] = $this->common_model->getRecords('mst_banner',"*",$condition1);
           $data['friends'] = $this->friend_model->getNotificationFriend($user_session['user_id']); 
        }
        if(!(empty($user_session)) && $user_session['user_role']==1 ){
            redirect("institute-private-timeline");
        }

        
        $this->load->view('front/includes/ui1-header1',$data);
        $this->load->view('front/includes/ui1-header2',$data);
        $this->load->view('front/UI1/home',$data);
        $this->load->view('front/includes/ui1-footer',$data);
    }
     public function digital_record() {  
        
        $data = $this->common_model->commonFunction();
        $data['header'] = array('title'=>'Digital Record');
        $data["arr_digital_records"] = $this->category_model->getDigitalRecords();
        $this->load->view('front/includes/ui1-header1',$data);
        $this->load->view('front/includes/ui1-header2');
        $this->load->view('front/UI1/degital_record');
        $this->load->view('front/includes/ui1-footer');
    }
     public function digital_record_details($url) {  
        $data = $this->common_model->commonFunction();
        $data['header'] = array('title'=>'Digital Record Details');
        $data["arr_digital_record_details"] = $this->category_model->getDigitalRecordsById($url);
        $data["arr_digital_record_details"] = end($data["arr_digital_record_details"] );
        $this->load->view('front/includes/ui1-header1',$data);
        $this->load->view('front/includes/ui1-header2');
        $this->load->view('front/UI1/digital_record_details');
        $this->load->view('front/includes/ui1-footer');
    }
     public function tiles() {  
        $data = $this->common_model->commonFunction();
        $data['header'] = array('title'=>'Tiles');
        $this->load->view('front/includes/ui1-header1',$data);
        $this->load->view('front/includes/ui1-header2');
        $this->load->view('front/UI1/tiles');
        $this->load->view('front/includes/ui1-footer');
    }
    public function getUserNotification() { 
       
        $this->load->helper('my_date_helper');
        $user_session = $this->session->userdata('user_account');
        $user_id = $user_session['user_id'];
        
        #[Start]: Update Notification Status
        $arr_to_update = array( "status" => '0' );
        $condition_array = array('to_id' => intval($user_id));
        $this->common_model->updateRow('mst_notifications', $arr_to_update, $condition_array);
        #[End]: Update Notification Status
        
        $json_array['arr_user_notification'] = $this->common_model->getUserNotification();
        
        for($i=0;$i<count($json_array['arr_user_notification']); $i++){
            $posted_date[] = relative_time($json_array['arr_user_notification'][$i]['message_date']);
        }
        $json_array['posted_date'] = $posted_date;

        echo json_encode($json_array);

    }
    public function showUserNotification() { 
        
        $data = $this->common_model->commonFunction();
        $this->load->helper('my_date_helper');
        
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        
        $arr_user_data = array();
        $arr_user_data = $this->user_model->getUserInformation('mst_users', '*', array("user_id" => $user_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        
        
        #[Start]: Update Notification Status
        $arr_to_update = array( "status" => '0' );
        $condition_array = array('to_id' => intval($user_id));
        $this->common_model->updateRow('mst_notifications', $arr_to_update, $condition_array);
        #[End]: Update Notification Status
        
        $data['arr_user_notification'] = $this->common_model->getUserNotification();
        
        for($i=0;$i<count($data['arr_user_notification']); $i++){
            $posted_date[] = relative_time($data['arr_user_notification'][$i]['message_date']);
        }
        $data['posted_date'] = $posted_date;
        
        $data['header'] = array('title' => 'User Notification');
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
        $this->load->view('front/includes/ui2-userB-left-menu', $data);
        $this->load->view('front/user-accountB/all-notification', $data);
        $this->load->view('front/includes/ui2-footer', $data);
        

    }
    
    /*************delete notification************/
    public function deleteNotification($notification_id) {
        
        
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $album_id=  base64_decode($album_id);
        $data['user_session'] = $this->session->userdata('user_account');
        $session_user_id = $data['user_session']['user_id'];
        $data['session_user_id'] = $session_user_id;
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $session_user_id);
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        $country_id = $data['arr_user_data']['country_id'];
        $data['arr_country_list'] = $this->common_model->getCountryName($country_id);
        $data['arr_counrty_name'] = $data['arr_country_list'][0];
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['arr_timeline_photos'] = $this->common_model->getTimeLinePhoto($session_user_id);
        $data['header'] = array('title' => 'Notification');
        if($notification_id != "")
        {
        $arr_delete_array = array('notifications_id' => $notification_id);
        $this->common_model->deleteRows($arr_delete_array, 'mst_notifications', 'notifications_id');
        redirect(base_url()."show-user-notification");
        }
        else
        {
        redirect(base_url()."show-user-notification");
        }
//        $this->load->view('front/includes/ui2-header1',$data);
//        $this->load->view('front/includes/ui2-header2');
//        $this->load->view('front/includes/ui2-userB-left-menu',$data);
//        $this->load->view('front/user-accountB/gallery',$data);
//        $this->load->view('front/includes/ui2-footer', $data);
        
       }   

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */