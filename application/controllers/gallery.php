<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('gallery_model');
    }

    public function manageGallery() {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_album_id = $this->input->post('checkbox');
                if (count($arr_album_id) > 0) {
                    if (count($arr_album_id) > 0) {
                        foreach ($arr_album_id as $album_id) {
                            $arr_gallery = $this->common_model->getRecords('mst_album', '*', array('album_id' => intval(($album_id))));
                            $arr_img = $this->common_model->getRecords('trans_album_media', '*', array('album_id' => intval(($album_id))));
                            $user_id = $arr_gallery[0]["user_id"];
                            foreach ($arr_img as $img) {
                                $upload_dir = 'media/front/UI-2-media/images/album_photos/user_'.$user_id.'/';
                                $old_image = $upload_dir . $img[0]['album_image_path'];
                                unlink($old_image);
                            }
                        }
                        #deleting the admin selected                        
                        $this->common_model->deleteRows($arr_album_id, "mst_album", "album_id");
                        $this->common_model->deleteRows($arr_album_id, "trans_album_media", "album_id");
                    }
                    $this->session->set_userdata("msg", "<span class='success'>Records deleted successfully!</span>");
                } else {
                    echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
                    die;
                }
            }
        }
        $data["arr_user_gallery"] = $this->gallery_model->getGallery();
        $data['header'] = array('title' => 'Manage Gallery');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/gallery/list', $data);
        $this->load->view('backend/sections/footer');
    }

    function changeGalleryStatus() {

        if ($this->input->post('album_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "album_status" => $this->input->post('album_status')
            );
            #condition to update record	for the user status
            $condition_array = array('album_id' => intval($this->input->post('album_id')));
            $this->common_model->updateRow('mst_album', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    public function editGallery($album_id) {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            $arr_to_update = array("album_name" => mysql_real_escape_string($this->input->post("album_name")));
            $table = 'mst_album';
            $condition = array("album_id" => $album_id);
            $this->common_model->updateRow($table, $arr_to_update, $condition);
            $this->session->set_userdata("msg", "<span class='success'>Gallery Updated successfully!</span>");
            redirect(base_url() . "backend/manage-gallery");
        }
        $data['header'] = array('title' => 'Photo Gallery');
        $data["arr_album_gallery"] = $this->common_model->getRecords("mst_album", "album_name,album_id,album_status,created_date,user_id", array("album_id" => $album_id));
        $data["arr_album_gallery"] = end($data["arr_album_gallery"]);
        $data["arr_album_image"] = $this->common_model->getRecords("trans_album_media", "album_image_path,album_media_id", array("album_id" => $album_id));
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/gallery/edit-gallery', $data);
        $this->load->view('backend/sections/footer');
    }

    public function deleteGalleryImage($album_media_id) {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $img_info = $this->common_model->getRecords("trans_album_media", "*", array("album_media_id" => $album_media_id));
        $img_info = end($img_info);
        $user_id = $this->gallery_model->getGalleryAlbumId($img_info["album_id"]);
        $user_id = end($user_id);
        $user_id = $user_id["user_id"];
        $album_image = $data["absolute_path"] . "media/front/UI-2-media/images/album_photos/user_" . $user_id . "/" . $img_info["album_image_path"];
        @unlink($album_image);
        $album_media_id = array($album_media_id);
        $this->common_model->deleteRows($album_media_id, "trans_album_media", "album_media_id");
        $this->session->set_userdata("msg", "<span class='success'>Photo deleted successfully!</span>");
        redirect(base_url() . 'backend/edit-gallery/' . $img_info["album_id"]);
    }

}
