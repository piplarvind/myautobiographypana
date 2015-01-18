<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_Photos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("user_model");

    }

    #Get user albums

    public function userAlbumsAction() {
        
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];
        $user_name = $data['user_session']['user_name'];
        $data['user_id'] = $user_id;
        
        /* Create folder for particular user. */
        $parentDir = $data["absolute_path"] . 'media/front/UI-2-media/images/album_photos/user_' . $user_id;
        if (!is_dir($parentDir)) {
            // Check if the parent directory is a directory.
            mkdir($parentDir, 0777);
            $config['upload_path'] = './media/front/UI-2-media/images/album_photos/user_' . $user_id;
        } else {
            $config['upload_path'] = './media/front/UI-2-media/images/album_photos/user_' . $user_id;
        }

        
          $data_arr = array(
                "user_id" => $data['user_session']['user_id'],
                "album_name" => mysql_real_escape_string(trim($this->input->post('album_name'))),
                "album_status" => '1',
                "created_date" => date("Y-m-d H:i:s")
            );
            $album_name = $this->input->post('album_name');
            $album_id = $this->user_model->set_album_data($data_arr);
            $album_data = $this->common_model->getRecords('mst_album', array('album_id,album_name,created_date'), array("user_id" => $data['user_account']['user_id'], 'album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
            
            $albums =$album_data[0];
            $date=explode(" ",$albums['created_date']);
          

            $albumstr .='<div id="photo_'. $albums['album_id'].'" class="single-album album_'. $albums['album_id'].'">';
            $albumstr .='<span class="select_item"><input type="checkbox" value="'.$albums['album_id'].'" class="select-photo" name="select-photo[]"></span>';
            $albumstr .='<a href="'.base_url().'show-album-images/'.base64_encode($albums['album_id']).'">';
            
            $front_photo = (empty($albums['front_photo'])) ? "no_image.jpeg" : $albums['front_photo'][0]['album_image_path'];
            if ($front_photo == "no_image.jpeg") { 
                  $albumstr .='<img  title="'.stripcslashes($albums['album_name']).'" src="'.base_url().'media/front/UI-2-media/images/album_photos/'.$front_photo.'" >';

            }else{
                  $albumstr .='<img  title="'.stripcslashes($albums['album_name']).'" src="'.base_url().'media/front/UI-2-media/images/album_photos/user_'.$user_id .'/'.$front_photo.'">';

            }
            
        $albumstr .= '</a>';
        $albumstr .= '<div class="album-info">';
        $albumstr .= '<div class="album-name"><a href="'.base_url().'show-album-images/'.base64_encode($albums['album_id']).'">'.stripcslashes($albums['album_name']).'</a></div>';
        $albumstr .='<div class="photos-no">Photos:<b>'."0".'</b></div>';
        $albumstr .='<div class="basic-info">';
        $albumstr .='<div class="album-craeted-on">created date<b>'.$date[0].'</b></div>';
        $albumstr .='<div class="album-craeted-by">By: '.$data['user_session']['user_name'].'</div>';
//        $albumstr .='<span class="select_item"><input type="checkbox" value="'.$albums['album_id'].'" class="select-photo" name="select-photo[]"></span>';
        $albumstr .='</div></div></div>';
        echo $albumstr;
      
    }

    #Get Album Photos by Album Id

    public function userPhotos($album_id) {

        if (!$this->common_model->isLoggedIn()) {
            redirect('signin');
        }
        if ($this->session->userdata('order_details') != '') {
            $this->session->unset_userdata('order_details');
        }
        $data = $this->common_model->commonFunction();
        $user_session = $this->session->userdata('user_account');
        $data['user_id'] = $user_session['user_id'];
        $user_session['album_id'] = $album_id;
        $this->session->set_userdata('user_account', $user_session);
        $data['user_session'] = $this->session->userdata('user_account');
//        $data['header'] = "My Photos";

        $data['header'] = array('title' => 'My Photos');
        #Check if album exits or not
        $data['album_data'] = $this->common_model->getRecords('mst_album', array('album_id,album_name,created_date'), array("user_id" => $data['user_account']['user_id'], 'album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);

        if (empty($data['album_data'])) {
            redirect(base_url() . 'institution-my-profile');
            exit;
        }
        $data['album_photos'] = $this->common_model->getRecords('trans_album_media', array('album_image_path,album_media_id'), array('album_id' => $album_id), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_datas'] = $this->common_model->getRecords('mst_album', array('created_date'), array('album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_id'] = $album_id;
        $data['album_name'] = stripcslashes($data['album_data'][0]['album_name']);
        $data['user_id'] = $data['user_session']['user_id'];
        $this->load->view('front/user-accountA/user-photos', $data);
        $this->load->view('front/includes/ui2-header1', $data);
        $this->load->view('front/includes/ui2-header2');
    }

    public function showAlbumImages($album_id) {
        
        $album_id=  base64_decode($album_id);
        $data = $this->common_model->commonFunction();
        $user_session = $this->session->userdata('user_account');
        $data['user_session'] = $this->session->userdata('user_account');
        
        
        $data['user_id'] = $user_session['user_id'];
        $user_session['album_id'] = $album_id;
        

        $data['header'] = array('title' => 'My Photos');
        #Check if album exits or not
        $data['album_data'] = $this->common_model->getRecords('mst_album', array('album_id,album_name,created_date'), array("user_id" => $data['user_account']['user_id'], 'album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['created_date'] = $data['album_data'][0]['created_date'];

        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $data['user_id']);
//        $condition_to_pass = array("user_id" => $data['user_session']['user_id']);
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        
        $data['album_photos'] = $this->common_model->getRecords('trans_album_media', array('album_image_path,album_media_id'), array('album_id' => $album_id), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_datas'] = $this->common_model->getRecords('mst_album', array('created_date'), array('album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_id'] = $album_id;
        $data['album_name'] = stripcslashes($data['album_data'][0]['album_name']);
//        $data['user_id'] = $data['user_session']['user_id'];
        
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        
        $this->load->view('front/includes/ui2-header1',$data);
        $this->load->view('front/includes/ui2-header2',$data);
        if($user_session['user_role'] == '0'){ 
            #For User A
            $this->load->view('front/includes/ui2-userA-left-menu', $data);
        }else{
            #For User B
            $this->load->view('front/includes/ui2-userB-left-menu', $data);
        }
//        $this->load->view('front/includes/ui2-userB-left-menu',$data);
        $this->load->view('front/user-accountB/institute-albums',$data);
        $this->load->view('front/includes/ui2-footer',$data);
       }
       
    
    public function publicProfileAlbumImages($username,$album_id) {
        
        
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $album_id=  base64_decode($album_id);
        $data['user_session'] = $this->session->userdata('user_account');
//        print_r($data['user_session']['user_role'] );die;;
        $session_user_id = $data['user_session']['user_id'];
        
//        $data['user_id'] = $user_session['user_id'];

        $user_session['album_id'] = $album_id;
//        $this->session->set_userdata('user_account', $user_session);
//        $data['user_session'] = $this->session->userdata('user_account');
       
        $table_to_pass = 'mst_users';
        $fields_to_pass = '*';
        $condition_to_pass = array("user_id" => $session_user_id);
        
        $arr_user_data = $this->user_model->getUserInformation($table_to_pass, $fields_to_pass, $condition_to_pass, $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['arr_user_data'] = $arr_user_data[0];
        
        
        $public_profile_data = $this->common_model->getRecords('mst_users','*', array("user_name" => $username), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['public_profile_data'] = $public_profile_data[0];
        $user_id = $public_profile_data[0]['user_id'];
        $data['user_id'] = $user_id;
        $data['username'] = $username;

        $data['header'] = array('title' => 'My Photos');
        $data['album_data'] = $this->common_model->getRecords('mst_album', array('album_id,album_name,created_date'), array("user_id" => $user_id, 'album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_photos'] = $this->common_model->getRecords('trans_album_media', array('album_image_path,album_media_id'), array('album_id' => $album_id), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_datas'] = $this->common_model->getRecords('mst_album', array('created_date'), array('album_id' => $album_id), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
        $data['album_id'] = $album_id;
        $data['album_name'] = stripcslashes($data['album_data'][0]['album_name']);
        $data['user_id'] = $user_id;
        
        $data['arr_category_list'] = $this->common_model->getMainCategoryList();
        $data['login_friend_details'] = $this->common_model->getLoginFriendDetails($session_user_id);
        
        $this->load->view('front/includes/ui2-header1',$data);
        $this->load->view('front/includes/ui2-header2');
        if($data['user_session']['user_role'] == '0'){ 
            #For User A
            $this->load->view('front/includes/ui2-userA-left-menu', $data);
        }else{
            #For User B
            $this->load->view('front/includes/ui2-userB-left-menu', $data);
        }
        $this->load->view('front/user-accountB/public-profile-album-images',$data);
        
       }   
       
       
    #Upload album photos ajax

    public function ajax_photo_upload($album_id) {

        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];

        /* Create folder for particular user. */
        $parentDir = $data["absolute_path"] . 'media/front/UI-2-media/images/album_photos/user_' . $user_id;
        if (!is_dir($parentDir)) {
            // Check if the parent directory is a directory.
            mkdir($parentDir, 0777);
            $config['upload_path'] = './media/front/UI-2-media/images/album_photos/user_' . $user_id;
        } else {
            $config['upload_path'] = './media/front/UI-2-media/images/album_photos/user_' . $user_id;
        }
        
        
        
        $filenames = "";
        /*  Upload multiple images */
        $temp_arr = array();
        for ($i = 0; $i < count($_FILES['upFile']['name']); $i++) {
            
             $_FILES['userfile']['name'] = $_FILES['upFile']['name'][$i];
             $_FILES['userfile']['type'] = $_FILES['upFile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $_FILES['upFile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $_FILES['upFile']['error'][$i];
            $_FILES['userfile']['size'] = $_FILES['upFile']['size'][$i];
            $config['file_name'] = time() . rand(1000, 9999) . $i;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['overwrite'] = FALSE;
            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('userfile')) {
                
                $data = $this->upload->data();
                $upload_result = $this->upload->data();
                $img_name = $upload_result['file_name'];
                $target_path = $absolute_path.'media/front/UI-2-media/images/album_photos/400x400/'.$img_name;
                $target_path1 = $absolute_path.'media/front/UI-2-media/images/album_photos/120x120/'.$img_name;
                    
                    exec("convert " . $data['full_path'] . " -resize \!400X400 " . $target_path);
                    exec("convert " . $data['full_path'] . " -resize \!120X120 " . $target_path1);
                   
                /* store record to add */
                $arr_to_insert_files = array(
                    'album_id' => $this->input->post('album_id'),
                    'album_image_path' => $upload_result["file_name"],
                );
                $id = $this->common_model->insertRow($arr_to_insert_files, "trans_album_media");
                
                array_push($temp_arr, $id);
                
                
//                $albums = $this->common_model->getRecords('trans_album_media', array('album_image_path,album_media_id'), array('album_id' => $this->input->post('album_id')), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '', $debug_to_pass = 0);
//               
//                $filenames.= '<div class="panel" id="photo_'. $albums['album_media_id'].'" style="margin-bottom: 10px; zoom: 1; opacity: 1;">';
////                $filenames.= '<a href="#" data-toggle="modal" onclick="'.view_img($user_id,$albums[$i]['album_media_id']).'">';
//                $filenames.= '<img  src="'. base_url().'media/front/UI-2-media/images/album_photos/400x400/'. $albums['album_image_path'].'" alt="image" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;"/>';
//                $filenames.= '</a>';
//                $filenames.= '<span class="select_item"> <input type="checkbox" value="'. $albums['album_media_id'].'" class="select-photo" name="select-photo[]"></span>';
//                $filenames.= '</div>';
               
                
                
                $this->session->set_userdata('success_message', "Gallery photo uploaded successfully.");
            } else {
               
                $msg = $this->upload->display_errors('', '');
                $this->session->set_userdata('image_error', 'Sorry!Their is problem in loading images that "' . $msg . '" Please try again.');
            }
        }
        
        for($i=0;$i<count($temp_arr);$i++){
           $albums[] = $this->common_model->getRecords('trans_album_media', array('album_image_path,album_media_id'), array('album_media_id' => $temp_arr[$i]), $order_by_to_pass = 'album_media_id ASC', $limit_to_pass = '', $debug_to_pass = 0);
        }
//        $url = base_url();
        for($i=0;$i<count($albums);$i++){
            
//            $filenames.= '<ul id="album_photo" class="grid"><li class="grid-sizer"></li>';
            $filenames.= '<li id="photo_'.$albums[$i][0]['album_media_id'].'" style="left:0!important;top:0!important;position:relative!important;">';
            $filenames.= '<figure style="background:#fff url('. base_url() .'media/front/UI-2-media/images/album_photos/400x400/'.$albums[$i][0]['album_image_path'].') center center no-repeat;"></figure>';
            $filenames.= '<span class="select_item"> <input type="checkbox" value="'.$albums[$i][0]['album_media_id'].'" class="select-photo" name="select-photo[]"></span>';
            $filenames.= '</li>';
        }            
//            $filenames.= '<div class="galcolumn" style="width: 24.7799%; padding-left: 10px; padding-bottom: 10px; float: left; box-sizing: border-box;">';
//            $filenames.= '<div class="panel" id="photo_'. $albums[$i][0]['album_media_id'].'" style="margin-bottom: 10px; opacity: 1;">';
//            $filenames.= '<a href="#" data-toggle="modal">';
//            $filenames.= '<img  src="'. base_url().'media/front/UI-2-media/images/album_photos/400x400/'. $albums[$i][0]['album_image_path'].'" alt="image" style="width: 100%; height: auto; display: block; margin-left: auto; margin-right: auto;"/>';
//            $filenames.= '</a>';
//            $filenames.= '<span class="select_item"> <input type="checkbox" value="'. $albums[$i][0]['album_media_id'].'" class="select-photo" name="select-photo[]"></span>';
//            $filenames.= '</div>';
//            $filenames.= '</div>';
            
            
//            
           
//        }
        
        
        
        sleep(2);
        echo $filenames;
    }

//    public function view_img($user_id,$albums_id) {
//        $view_html = '';
//        echo $view_html = '<img class="img-responsive" src="'.  base_url().'media/front/UI-2-media/images/album_photos/user_'.$user_id.'/'.$albums_id.'" alt="Place" width="100%">';
//        
//    }
    
    
    #Delete Album Photos By Photo Ids
    public function deleteAlbumPhoto() {
        
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        $user_id = $data['user_session']['user_id'];

        if (!$this->common_model->isLoggedIn()) {
            echo "false";
        } else {
            $photo_ids = array();
            $photo_ids = $_POST['photo_ids'];

            foreach ($photo_ids as $ids) {

                $photo = $this->common_model->getRecords('trans_album_media', array('album_image_path'), array("album_media_id" => $ids), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
                $photo_names[] = $photo[0]['album_image_path'];
                
            }
            
            $this->common_model->deleteRows($photo_ids, "trans_album_media", "album_media_id");

            foreach ($photo_names as $filename) {

                unlink($data['absolute_path'] . 'media/front/UI-2-media/images/album_photos/user_' . $user_id . "/" . $filename);
            }
            echo "true";
        }
    }

    #Delete Album Photos By Album Ids

    public function deleteAlbum() {
        $data = $this->common_model->commonFunction();
        if (!$this->common_model->isLoggedIn()) {
            echo "false";
        } else {
            $photo_ids = array();

            $photo_ids = $_POST['photo_ids'];
            foreach ($photo_ids as $ids) {
                $photo = $this->common_model->getRecords('mst_album', array('album_name'), array("album_id" => $ids), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
                $photo_names[] = $photo[0]['album_name'];
            }
            $this->common_model->deleteRows($photo_ids, "mst_album", "album_id");

            foreach ($photo_ids as $ids) {
                $this->common_model->getRecords('trans_album_media', array('album_image_path'), array("album_id" => $ids), $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0);
                $this->common_model->deleteRows($photo_ids, "trans_album_media", "album_id");
            }

            foreach ($photo_names as $filename) {

                unlink($data['absolute_path'] . 'media/front/UI-2-media/images/album_photos/' . $filename);
                unlink($data['absolute_path'] . 'media/front/UI-2-media/images/album_photos/' . $filename);
            }
            echo "true";
        }
    }

}

?>
