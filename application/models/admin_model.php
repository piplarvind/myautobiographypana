<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_Model extends CI_Model {
    #function to get admin list from the database 
    public function getAdminDetails($user_id = '') {
        $this->db->select('u.user_id,u.user_name,u.first_name,u.last_name,u.user_email,u.user_status,u.user_type,u.register_date,u.role_id,u.gender,r.role_name');
        $this->db->from('mst_users as u');
        $this->db->join('mst_role as r', 'u.role_id = r.role_id', 'left');
        if ($user_id != '') {
            $this->db->where("u.user_id", $user_id);
        }
        $this->db->where("u.user_type", 2);
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Admin_Model',
                'model_method_name' => 'getAdminDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    /* Updating Blocked user list */
    public function updateBlockedUserFile($absolute_path, $status, $user_id) {
      //echo $absolute_path."=". $status ."=". $user_id;
        /* checking file is exists or not */
		if(!file_exists($absolute_path."media/front/user-status/blocked-user"))
		{ 
			/*if not update the first blocked user to file */
			$blocked_user=array();
			if($status=='2')
			{
				$blocked_user[0]=$user_id;
			}
		}
		else
		{
			/* getting all blocked user from file*/ 
			$blocked_user=$this->read_file($absolute_path."media/front/user-status/blocked-user");
                        if(!is_array($blocked_user)){$blocked_user =array();}
                        
			if($status=='2')
			{
				if(!in_array($user_id,$blocked_user))
				{
                                        if(empty($blocked_user)){$blocked_user[0]=$user_id;}
                                        else{array_push($blocked_user,$user_id);}
					/* Adding new blocked user to file*/
                                         print_r($blocked_user);
				}
			}
			else
			{
				$key = array_search($user_id,$blocked_user);				
				if($key!==false){
					/* Removing the user from bloked list */
					unset($blocked_user[$key]);
				}
			}
		}
                
              
		$this->write_file($absolute_path."media/front/user-status/blocked-user",$blocked_user);
              
                
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();        
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Admin_Model',
                'model_method_name' => 'updateBlockedUserFile',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    /* Updating Blocked user list */

    public function updateInactiveUserFile($absolute_path, $status, $user_id) {
        
//        echo $absolute_path.",".$status.",". $user_id;
        /* checking file is exists or not */
        if (!file_exists($absolute_path . "media/front/user-status/inactive-user")) {
            /* if not update the first inactive user to file */
            $inactive_user = array();
            if ($status == '0') {
                $inactive_user[0] = $user_id;
            }
        } else {
            /* getting all inactive user from file */
            $inactive_user = $this->read_file($absolute_path . "media/front/user-status/inactive-user");
            if ($status == '0') {
                if (!in_array($user_id, $inactive_user)) {
                    /* Adding new blocked user to file */
                    array_push($inactive_user, $user_id);
                }
            } else {
                $key = array_search($user_id, $inactive_user);
                if ($key !== false) {
                    /* Removing the user from inactive list */
                    unset($inactive_user[$key]);
                }
            }
        }
        $this->write_file($absolute_path . "media/front/user-status/inactive-user", $inactive_user);
        $this->write_file($absolute_path . "media/front/user-status/blocked-user", $blocked_user);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Admin_Model',
                'model_method_name' => 'updateInactiveUserFile',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    
    /* Updating Deleted user list */
    public function updateDeletedUserFile($absolute_path, $user_id) {
        /* checking file is exists or not */
        if (!file_exists($absolute_path . "media/front/user-status/deleted-user")) {
            /* if not update the first deleted user to file */
            $deleted_user = array();
            $deleted_user[0] = $user_id;
        } else {
            /* getting all deleted user from file */
            $deleted_user = $this->read_file($absolute_path . "media/front/user-status/deleted-user");
            if (!in_array($user_id, $deleted_user)) {
                /* Adding new deleted user to file */
                array_push($deleted_user, $user_id);
            }
        }
        $this->write_file($absolute_path . "media/front/user-status/deleted-user", $deleted_user);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Admin_Model',
                'model_method_name' => 'updateDeletedUserFile',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    
    public function write_file($file_path, $file_data) {
        #Opening the file for writing.
        $fp = fopen($file_path, "w+");
        #wrinting into file
        fwrite($fp, serialize($file_data));
        #closing the file for writing.
        fclose($fp);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Admin_Model',
                'model_method_name' => 'write_file',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    
    public function read_file($file_path) {
        $file_content = file_get_contents($file_path);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Admin_Model',
                'model_method_name' => 'read_file',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return unserialize($file_content);
    }

}
