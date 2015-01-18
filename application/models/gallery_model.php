<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Gallery_Model extends CI_Model {
    function getGallery()
    {
        $this->db->select("mu.first_name,mu.last_name,ma.album_name,ma.album_status,ma.created_date,ma.album_id");
        $this->db->from("mst_album as ma");
        $this->db->join("mst_users as mu","mu.user_id = ma.user_id", "left");
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Gallery_Model',
                'model_method_name' => 'getGallery',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }
    
    
    function getGalleryAlbumId($album_id)
    {
        $this->db->select("mu.first_name,mu.last_name,ma.album_name,ma.album_status,ma.created_date,ma.album_id,ma.user_id");
        $this->db->from("mst_album as ma");
        $this->db->join("mst_users as mu","mu.user_id = ma.user_id", "left");
        $this->db->where("ma.album_id",$album_id);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Gallery_Model',
                'model_method_name' => 'getGallery',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
         $this->session->set_userdata("msg", "<span class='success'>Image deleted successfully!</span>");
        return $result->result_array();
    }
    
}


