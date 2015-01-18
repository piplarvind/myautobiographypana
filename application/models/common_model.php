<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_Model extends CI_Model {
    #function to get global setttings from the database  	   

    public function getGlobalSettings($lang_id = '') {
        $global = array();
        $this->db->select('mst_global.*,trans_global.*');
        $this->db->from('mst_global_settings as mst_global');
        $this->db->join('trans_global_settings as trans_global', 'mst_global.global_name_id = trans_global.global_name_id', 'left');
        if ($lang_id != '') {
            $this->db->where("trans_global.lang_id", $lang_id); /* for lnag id passed ie. english */
        } else {
            $this->db->where("trans_global.lang_id", 17); /* for default language ie. english */
        }
        $result = $this->db->get();
        foreach ($result->result_array() as $row) {
            $global[$row['name']] = $row['value'];
        }
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getGlobalSettings',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $global;
    }

    #common function to get records from the database table	

    public function getRecords($table, $fields = '', $condition = '', $order_by = '', $limit = '', $debug = 0) {
        $str_sql = '';
        if (is_array($fields)) {  #$fields passed as array
            $str_sql.=implode(",", $fields);
        } elseif ($fields != "") {   #$fields passed as string
            $str_sql .= $fields;
        } else {
            $str_sql .= '*';  #$fields passed blank
        }

        $this->db->select($str_sql, FALSE);

        if (is_array($condition)) {  #$condition passed as array
            if (count($condition) > 0) {
                foreach ($condition as $field_name => $field_value) {
                    if ($field_name != '' && $field_value != '') {
                        $this->db->where($field_name, $field_value);
                    }
                }
            }
        } else if ($condition != "") { #$condition passed as string
            $this->db->where($condition);
        }

        if ($limit != "")
            $this->db->limit($limit);#limit is not blank

        if (is_array($order_by)) {
            $this->db->order_by($order_by[0], $order_by[1]);  #$order_by is not blank
        } else if ($order_by != "") {
            $this->db->order_by($order_by);  #$order_by is not blank
        }


        $this->db->from($table);  #getting record from table name passed
        $query = $this->db->get();
        
        if ($debug) {
            die($this->db->last_query());
        }
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getRecords',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }

        return $query->result_array();
    }

    #function to get common record for the user	ie. absoulute path, global settings.

    public function commonFunction() {

        if ($this->session->userdata('lang_id') == "") {
            $this->session->set_userdata('lang_id', 17);
        }

        $global = array();
        #geting global settings from file
        $lang_id = $this->session->userdata('lang_id'); #default is 17 for english set lang id from session if global setting required for different language.
        $file_name = "global-settings-" . $lang_id;
        $resp = file_get_contents($this->absolutePath() . "application/views/backend/global-setting/" . $file_name);
        $data['global'] = unserialize($resp);
        $data['absolute_path'] = $this->absolutePath();
        $data['user_account'] = $this->session->userdata('user_account');

        $data['cmsPage'] = $this->common_model->getActiveCms('about-my-autobiography',$lang_id = '');

        $data['user_notification_count'] = $this->common_model->getUserNotificationCount();

        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'commonFunction',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return($data);
    }

    public function getActiveCms($page_alias = '' ,$lang_id = '') {

        if ($this->session->userdata('lang_id') == "") {
            $this->session->set_userdata('lang_id', 17);
        }

        $this->db->select('mst_cms.*,cms.*');
        $this->db->from('mst_cms as mst_cms');
        $this->db->join('trans_cms as cms', 'cms.cms_id=mst_cms.cms_id', 'left');

        $this->db->where('mst_cms.status', 'Published');

        if ($page_alias != '') {
            $this->db->where('mst_cms.page_alias', $page_alias);
        }
        if ($lang_id != '') {
            $this->db->where("cms.lang_id", $lang_id);
        } else {
            $this->db->where("cms.lang_id", 17);
        }
        $result = $this->db->get();
        return $result->result_array();
    }

    #function to check user loged in or not.

    public function isLoggedIn() {

        $user_account = $this->session->userdata('user_account');
//        print_r($user_account);die;
        if (isset($user_account['user_id']) && $user_account['user_id'] != '') {
            /* checking if user into blocked list or not */
            /* checking file is exists or not */
            $absolute_path = $this->absolutePath();
            if (file_exists($absolute_path . "media/front/user-status/blocked-user")) {
                /* getting all blocked user from file */
                $blocked_user = $this->read_file($absolute_path . "media/front/user-status/blocked-user");

                if (in_array($user_account['user_id'], $blocked_user)) {
                    /* removing the user from the bloked file list 
                      $key = array_search($user_account['user_id'], $blocked_user);
                      if ($key !== false) {
                      unset($blocked_user[$key]);
                      }
                      $this->write_file($absolute_path . "media/front/user-status/blocked-user", $blocked_user); */
                    /* unsetting the session and redirecting to user to login */

                    $this->session->unset_userdata("user_account");
                    if ($user_account['user_type'] == "2") {
//                        $msg = '<div class="alert alert-block"><strong>Sorry!</strong> Your account has been blocked by Administrator.</div>';
                        $error_msg = '<strong>Sorry!</strong> Your account has been blocked by Administrator.';
                        $this->session->set_userdata('error_msg', $error_msg);
//                      $this->session->set_userdata("msg", $msg);
                        redirect(base_url() . "backend/login");
                    } else {
//                      $msg = '<strong>Sorry!</strong> Your account has been blocked by Administrator.';
//                      $this->session->set_userdata("msg_account_updated", $msg);
                        $error_msg = '<strong>Sorry!</strong> Your account has been blocked by Administrator.';
                        $this->session->set_userdata('error_msg', $error_msg);
                        redirect(base_url());
                    }
                }
            }

            if (file_exists($absolute_path . "media/front/user-status/inactive-user")) {
                /* getting all blocked user from file */
                $inactive_user = $this->read_file($absolute_path . "media/front/user-status/inactive-user");

                if (in_array($user_account['user_id'], $inactive_user)) {
                    /* removing the user from the inactive file list 
                      $key = array_search($user_account['user_id'], $inactive_user);
                      if ($key !== false) {
                      unset($inactive_user[$key]);
                      }
                      $this->write_file($absolute_path . "media/front/user-status/inactive-user", $inactive_user); */

                    /* unsetting the session and redirecting to user to login */
                    $this->session->unset_userdata("user_account");
                    if ($user_account['user_type'] == "2") {
//                        $msg = '<div class="alert alert-block"><strong>Sorry!</strong> Your account has been inactivated due to your email address updated by Administrator, please contact with Administrator for more detail.</div>';
//                        $this->session->set_userdata("msg", $msg);
                        $error_msg = '<strong>Sorry!</strong> Your account has been inactivated due to your email address updated by Administrator, please contact with Administrator for more detail.';
                        $this->session->set_userdata('error_msg', $error_msg);
                        redirect(base_url() . "backend/login");
                    } else {
                        $error_msg = '<strong> Sorry!</strong> Your account has been inactivated due to your email address updated by Administrator, please contact with Administrator for more detail.';
                        $this->session->set_userdata('error_msg', $error_msg);
                        redirect(base_url());
                    }
                }
            }
            /* checking if user into deleted list or not */
            if (file_exists($absolute_path . "media/front/user-status/deleted-user")) {
                /* getting all blocked user from file */
                $deleted_user = $this->read_file($absolute_path . "media/front/user-status/deleted-user");
                if (in_array($user_account['user_id'], $deleted_user)) {

                    /* removing the user from the deleted file list 
                      $key = array_search($user_account['user_id'], $deleted_user);
                      if ($key !== false) {
                      unset($deleted_user[$key]);
                      }
                      $this->write_file($absolute_path . "media/front/user-status/deleted-user", $deleted_user);
                     */

                    /* unsetting the session and redirecting to user to login */
                    $this->session->unset_userdata("user_account");
                    if ($user_account['user_type'] == "2") {
//                        $msg = '<div class="alert alert-block"><strong>Sorry!</strong> Your account has been deleted by Administrator.</div>';
//                        $this->session->set_userdata("msg", $msg);
                        $error_msg = '<strong> Sorry!</strong> Your account has been deleted by Administrator.';
                        $this->session->set_userdata('error_msg', $error_msg);
                        redirect(base_url() . "backend/login");
                    } else {
                        $error_msg = '<strong>Sorry!</strong> Your account has been deleted by Administrator.';
                        $this->session->set_userdata('error_msg', $error_msg);
//                        $msg = '<strong>Sorry!</strong> Your account has been deleted by Administrator.';
//                        $this->session->set_userdata("msg_account_updated", $msg);
                        redirect(base_url());
                    }
                }
            }
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Common_Model',
                    'model_method_name' => 'isLoggedIn',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return true;
        } else {
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Common_Model',
                    'model_method_name' => 'isLoggedIn',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return false;
        }
    }

    #function to insert record into the database	

    public function insertRow($insert_data, $table_name) {
        $this->db->insert($table_name, $insert_data);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'insertRow',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $this->db->insert_id();
    }
    #function to update record in the database	

    public function updateRow($table_name, $update_data, $condition) {
//        echo '<pre>';print_r($table_name);die;
        if (is_array($condition)) {
            if (count($condition) > 0) {
                foreach ($condition as $field_name => $field_value) {
                    if ($field_name != '' && $field_value != '') {
                        $this->db->where($field_name, $field_value);
                    }
                }
            }
        } else if ($condition != "") {
            $this->db->where($condition);
        }
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'updateRow',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $this->db->update($table_name, $update_data);
    }

    #common function to delete rows from the table

    public function deleteRows($arr_delete_array, $table_name, $field_name) {
        if (count($arr_delete_array) > 0) {
            foreach ($arr_delete_array as $id) {
                $this->db->where($field_name, $id);
                $query = $this->db->delete($table_name);
                $error = $this->db->_error_message();
                $error_number = $this->db->_error_number();
                if ($error) {
                    $controller = $this->router->fetch_class();
                    $method = $this->router->fetch_method();
                    $error_details = array(
                        'error_name' => $error,
                        'error_number' => $error_number,
                        'model_name' => 'Common_Model',
                        'model_method_name' => 'deleteRows',
                        'controller_name' => $controller,
                        'controller_method_name' => $method
                    );
                    $this->common_model->errorSendEmail($error_details);
                    redirect(base_url() . 'page-not-found'); //create this route
                }
            }
        }
    }

    public function UnfollowFriends($user_id, $friends_id) {

        $this->db->where('to_user_id', $user_id);
        $this->db->where('from_user_id', $friends_id);
        $this->db->delete('mst_user_friends');
    }

    #function to get absolute path for project

    public function absolutePath($path = '') {
        $abs_path = str_replace('system/', $path, BASEPATH);
        //Add a trailing slash if it doesn't exist.
        $abs_path = preg_replace("#([^/])/*$#", "\\1/", $abs_path);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'absolutePath',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $abs_path;
    }

    public function getEmailTemplateInfo($template_title, $lang_id, $reserved_words) {

        // gather information for database table
        $template_data = $this->getRecords('mst_email_templates', '', array("email_template_title" => $template_title, "lang_id" => $lang_id));
        $content = $template_data[0]['email_template_content'];
        $subject = $template_data[0]['email_template_subject'];

        // replace reserved words if any
        foreach ($reserved_words as $k => $v) {
            $content = str_replace($k, $v, $content);
        }
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getEmailTemplateInfo',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return array("subject" => $subject, "content" => $content);
    }

    public function sendEmail($recipeinets, $from, $subject, $message) {
        // ci email helper initialization
        $config['protocol'] = 'mail';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $this->load->library('email', $config);
        $this->email->initialize($config);

        // set the from address
        $this->email->from($from['email'], $from['name']);

        // set the subject
        $this->email->subject($subject);

        // set recipeinets
        $this->email->to($recipeinets);

        // set mail message
        $this->email->message($message);

        // return boolean value for email send

        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'sendEmail',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $this->email->send();
    }

    public function getPageInfoByUrl($uri) {
        $arr_to_return = $this->getRecords(
                "mst_uri_map", "*", array("url" => $uri)
        );
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getPageInfoByUrl',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $arr_to_return;
    }

    public function validateUriForExists($arr, $arr_exists) {
        $str_condition = "`url` = '" . $arr['uri'] . "' and `type` = '" . $arr['type'] . "'";

        if (count($arr_exists) > 0) {
            $str_condition.=" and rel_id !='" . $arr_exists['rel_id'] . "'";
        }

        $arr_to_return = $this->getRecords(
                "mst_uri_map", "*", $str_condition
        );
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'validateUriForExists',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $arr_to_return;
    }

    public function updateURI($arr_fields, $arr_condition) {
        $this->db->update("mst_uri_map", $arr_fields, $arr_condition);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'updateURI',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    public function insertURI($arr_fields) {
        $this->db->insert("mst_uri_map", $arr_fields);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'insertURI',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    public function getDefaultLanguages() {
        $arr_to_return = $this->getRecords(
                "mst_languages", "*", array("status" => 'A')
        );
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getDefaultLanguages',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $arr_to_return;
    }

    public function getNonDefaultLanguages() {
        $arr_to_return = $this->getRecords(
                "mst_languages", "*", array("is_default" => 'N')
        );
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getNonDefaultLanguages',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $arr_to_return;
    }

    /* function to writer serialize data to file */

    public function write_file($file_path, $file_data) {
        /* Opening the file for writing. */
        $fp = fopen($file_path, "w+");
        /* wrinting into file */
        fwrite($fp, serialize($file_data));
        /* closing the file for writing. */
        fclose($fp);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'write_file',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    /* function to read file from the specified path */

    public function read_file($file_path) {
        /* reading content for file */
        $file_content = file_get_contents($file_path);
        /* returning the unsearilized array of file data */
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'read_file',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return unserialize($file_content);
    }

    public function getDefaultLanguageId() {
        $arr_to_return = $this->getRecords("mst_languages", "lang_id", array("is_default" => 'Y'));
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'getDefaultLanguageId',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $arr_to_return[0]['lang_id'];
    }

    // function to get seo url from give url
    public function seoUrl($string) {
        $string = trim($string);
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);

        /* if string becomes empty then it will take current time stamp */
        if ($string != "") {
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Common_Model',
                    'model_method_name' => 'seoUrl',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return $string;
        } else {
            $error = $this->db->_error_message();
            $error_number = $this->db->_error_number();
            if ($error) {
                $controller = $this->router->fetch_class();
                $method = $this->router->fetch_method();
                $error_details = array(
                    'error_name' => $error,
                    'error_number' => $error_number,
                    'model_name' => 'Common_Model',
                    'model_method_name' => 'seoUrl',
                    'controller_name' => $controller,
                    'controller_method_name' => $method
                );
                $this->common_model->errorSendEmail($error_details);
                redirect(base_url() . 'page-not-found'); //create this route
            }
            return time();
        }
    }

    /*
      Function create and returns the pagination links
      1. Total count of records
      2. baseurl for the links
      3. Page no which is loading
      4. Number of record for per page
      5. Number of "digit" links to show before/after the currently viewed page
     */

    public function createPagination($total_rows, $base_url, $cur_page, $per_page = '', $num_links = '') {
        if ($per_page == '') {
            $per_page = 10;
        }
        if ($num_links == '') {
            $num_links = 5;
        }
        /* Loading the pagination library */
        $this->load->library('pagination');

        /* Setting the config for pagination */
        $config['base_url'] = $base_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['cur_page'] = $cur_page;
        $config['num_links'] = $num_links;
        $config['full_tag_open'] = '<ul style="display: inline-block;">';
        $config['full_tag_close'] = '</ul>';

        $config['first_tag_open'] = '<li>';
        $config['first_link'] = '<< Start';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_link'] = 'End >> ';
        $config['last_tag_close'] = '</li></ul>';
        $config['next_tag_open'] = '<li>';
        $config['next_link'] = "Next&gt;";
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_link'] = "&lt;Previous";
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        /* Initializing the library */
        $this->pagination->initialize($config);
        /* creating the links */
        $links = $this->pagination->create_links();

        /* returning the links */
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Common_Model',
                'model_method_name' => 'createPagination',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $links;
    }

    public function errorSendEmail($error_details) {
        // ci email helper initialization
        $config['protocol'] = 'mail';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $this->load->library('email', $config);
        $this->email->initialize($config);
        // set the from address
        $data['global'] = $this->getGlobalSettings();
        $from = array(
            'email' => $data['global']['site_email'],
            'name' => $data['global']['site_title']
        );
        $this->email->from($from['email'], $from['name']);

        // set the subject
        $subject = 'Error in model file';
        $this->email->subject($subject);

        // set recipeinets
        $recipeinets = $data['global']['developers_email']; //create this in global settings
        $this->email->to($recipeinets);

        // set mail message
        $message = 'You got an error  <b>' . $error_details['error_name'] .
                '</b> error no - <b>' . $error_details['error_number'] . '</b><br/> Model Name:- <b>' . $error_details['model_name'] . '</b> <br/>  model method is :-<b>' . $error_details['model_method_name'] . '</b><br/> Controller <b>' . $error_details['controller_name'] .
                '</b>  <br/> Controller method is :<b>' . $error_details['controller_method_name'] .
                '</b>' . '<br/>On Host :' . base_url();


        $this->email->message($message);

        // return boolean value for email send

        return $this->email->send();
    }

    public function GET_SECURITY_QUESTION_LIST() {
        $lang_id = ($this->session->userdata('lang_id') ? $this->session->userdata('lang_id') : 1);
        $this->db->select('*');
        $this->db->from('user_security_question');
        $this->db->join('user_security_question_lang_content', 'user_security_question_lang_content.security_question_id  = user_security_question.security_question_id');
        $this->db->where('user_security_question.status =1');
//        $this->db->where('user_security_question_lang_content.lang_id ="' . $lang_id . '"');
//        $this->db->where('user_security_question_lang_content.lang_id ="17"');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function GET_ALL_RECORDS($query) {
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
    }

    public function GET_EMAIL_TEMPLATE($email_title) {

        $lang_id = ($this->session->userdata('lang_id') ? $this->session->userdata('lang_id') : 1);
        $this->db->select('*');
        $this->db->where('mail_page_id', $email_title);
        $this->db->where('mail_lang', $lang_id);
        $query = $this->db->get('mail_bodies');
        return $query->result_array();
    }

    public function GET_ANY_DETAILS($fields = '', $tablename, $condition = '', $limit = 0, $offset = 0) {
        if ($fields == '') {
            $fields = '*';
        }
        if ($condition == '') {
            $query = "SELECT " . $fields . " FROM " . $this->db->dbprefix . $tablename;
        } else {
            $query = "SELECT " . $fields . " FROM " . $this->db->dbprefix . $tablename . $condition;
        }
        if ($limit > 0) {
            $query .= " Limit {$offset},{$limit}";
        }
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
    }

    // For registration
    public function EMAIL_EXISTS($email) {
        $this->db->where('user_email', $email);
        $query = $this->db->get('mst_users');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getMainCategoryList() {

        $user_session = $this->session->userdata('user_account');
        $user_id = $user_session['user_id'];

        $this->db->select('mct.category_id,mct.category_name,mct.parent_id,mum.url');
        $this->db->from('mst_categories mct');
        $this->db->join("mst_uri_map as mum", "mum.rel_id = mct.category_id", "left");
        $this->db->where('mct.parent_id', '1'); //Digital Record
        $this->db->where('mct.status', '1');
        $query_digital = $this->db->get();
        $data['digital_list'] = $query_digital->result_array();

        $this->db->select('mct.category_id,mct.category_name,mct.parent_id,mum.url');
        $this->db->from('mst_categories mct');
        $this->db->join("mst_uri_map as mum", "mum.rel_id = mct.category_id", "left");
        $this->db->where('mct.parent_id', '2'); //Institutional Record
        $this->db->where('mct.status', '1');
        $query_institutional = $this->db->get();
        $data['institutional_list'] = $query_institutional->result_array();

        $this->db->select('mct.category_id,mct.category_name,mct.parent_id,mum.url');
        $this->db->from('mst_categories mct');
        $this->db->join("mst_uri_map as mum", "mum.rel_id = mct.category_id", "left");
        $this->db->where('mct.parent_id', '3'); //Personal Record
        $this->db->where('mct.status', '1');
        $query_personal = $this->db->get();
        $data['personal_list'] = $query_personal->result_array();

        $this->db->select('mct.category_id,mct.category_name,mct.parent_id,mum.url');
        $this->db->from('mst_categories mct');
        $this->db->join("mst_uri_map as mum", "mum.rel_id = mct.category_id", "left");
        $this->db->where('mct.parent_id', '18'); //Intrest Record
        $this->db->where('mct.status', '1');
        $query_intrest = $this->db->get();
        $data['intrest_list'] = $query_intrest->result_array();

        $this->db->select('mst.timeline_id,mst.timeline_posted_date,mst.timeline_post_data,trans.timeline_media_id,trans.timeline_id,trans.timeline_media_path,trans.timeline_media_type,trans.timeline_media_status');
        $this->db->from('mst_timeline as mst');
        $this->db->join('trans_timeline_media as trans', 'mst.timeline_id = trans.timeline_id', 'left');
        $this->db->where("trans.timeline_media_type", '0');
        $this->db->where("trans.timeline_media_status", '1');
        $this->db->where("mst.user_id", $user_id);
        $this->db->order_by("mst.timeline_id", 'DESC');
        $this->db->limit('8');
        $query_timeline_photo = $this->db->get();
        $data['timeline_photo'] = $query_timeline_photo->result_array();

        return $data;
    }

    public function getNotification() {

        $this->db->select('mn.*,mu.user_name,mu.user_id,mu.user_role');
        $this->db->from('mst_notifications as mn');
        $this->db->join('mst_users as mu', 'mu.user_id  = mn.from_id');
        $this->db->order_by('mn.notifications_id', 'DESC');
        $this->db->limit('10');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function manageNotificationForAdmin() {
        $this->db->select('mn.*,mu.user_name,mu.user_id,mu.user_role');
        $this->db->from('mst_notifications as mn');
        $this->db->join('mst_users as mu', 'mu.user_id  = mn.from_id');
        $this->db->order_by('mn.notifications_id', 'DESC');
//         $this->db->where('mn.to_id',"1");
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getUserNotificationCount() {

        $user_session = $this->session->userdata('user_account');
        $user_id = $user_session['user_id'];

        $this->db->select('mn.notifications_id');
        $this->db->from('mst_notifications as mn');
        $this->db->join('mst_users as mu', 'mu.user_id  = mn.from_id');
        $this->db->where('mn.status', '1');
        $this->db->where('mn.to_id', $user_id);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function getUserNotification() {

        $user_session = $this->session->userdata('user_account');
        $user_id = $user_session['user_id'];

        $this->db->select('mn.*,mu.user_name,mu.profile_picture');
        $this->db->from('mst_notifications as mn');
        $this->db->join('mst_users as mu', 'mu.user_id  = mn.from_id');
        $this->db->where('mn.to_id', $user_id);
        $this->db->order_by('mn.notifications_id', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getTimeLinePhoto($user_id) {

//        $this->db->select('mst.timeline_id,mst.timeline_posted_date,mst.timeline_post_data,trans.timeline_media_id,trans.timeline_id,trans.timeline_media_path,trans.timeline_media_type,trans.timeline_media_status');
        $this->db->select('mst.timeline_posted_date,trans.timeline_media_path,cat.category_name');
        $this->db->from('mst_timeline as mst');
        $this->db->join('trans_timeline_media as trans', 'mst.timeline_id = trans.timeline_id', 'left');
        $this->db->join('mst_categories as cat', 'mst.sub_category_id = cat.category_id', 'left');
        $this->db->where("trans.timeline_media_type", '0');
        $this->db->where("trans.timeline_media_status", '1');
        $this->db->where("mst.user_id", $user_id);
        $this->db->order_by('mst.timeline_id', 'DESC');
        $timeline_image = $this->db->get();
        $data['timeline_image'] = $timeline_image->result_array();
//        return $result->result_array();

        $this->db->select('mst.timeline_id,mst.timeline_posted_date,mst.timeline_post_data,trans.timeline_media_id,trans.timeline_id,trans.timeline_media_path,trans.timeline_media_type,trans.timeline_media_status');
        $this->db->from('mst_timeline as mst');
        $this->db->join('trans_timeline_media as trans', 'mst.timeline_id = trans.timeline_id', 'left');
        $this->db->where("trans.timeline_media_type", '1');
        $this->db->where("trans.timeline_media_status", '1');
        $this->db->where("mst.user_id", $user_id);
        $this->db->order_by('mst.timeline_id', 'DESC');
        $timeline_videos = $this->db->get();
        $data['timeline_videos'] = $timeline_videos->result_array();

        $this->db->select('mst.timeline_id,mst.timeline_posted_date,mst.timeline_post_data,trans.timeline_media_id,trans.timeline_id,trans.timeline_media_path,trans.timeline_media_type,trans.timeline_media_status');
        $this->db->from('mst_timeline as mst');
        $this->db->join('trans_timeline_media as trans', 'mst.timeline_id = trans.timeline_id', 'left');
        $this->db->where("trans.timeline_media_type", '2');
        $this->db->where("trans.timeline_media_status", '1');
        $this->db->where("mst.user_id", $user_id);
        $this->db->order_by('mst.timeline_id', 'DESC');
        $timeline_files = $this->db->get();
        $data['timeline_files'] = $timeline_files->result_array();

        return $data;
    }

    public function getFollowUsers($user_id) {

        $this->db->select('mst.user_id,mst.user_name,mst.user_email,mst.profile_picture,mst.address_1,mst.address_2,trans.user_friends_id,trans.to_user_id,trans.from_user_id,trans.visibility_id,trans.friends_on');
        $this->db->from('mst_users as mst');
        $this->db->join('mst_user_friends as trans', 'mst.user_id = trans.from_user_id', 'left');
        $this->db->where("trans.to_user_id", $user_id);

        $result = $this->db->get();
        return $result->result_array();
    }

    public function getTermsCondtions() {

        $this->db->select('mc.cms_id,mc.page_alias,tc.page_content');
        $this->db->from('mst_cms as mc');
        $this->db->join('trans_cms as tc', 'mc.cms_id  = tc.cms_id', 'left');
        $this->db->where("mc.page_alias", "terms-and-conditions");
        $this->db->where("tc.lang_id", 17);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getCountryName($country_id) {
        $lang_id = 17;
        $this->db->select('c.iso,c.country_name');
        $this->db->from('mst_country as c');
        $this->db->where("c.country_id", $country_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAllFriendsTotalCount($user_id) {


        $this->db->select('user_id,first_name,last_name,user_name,profile_picture');
        $this->db->from('mst_users');
        $this->db->where('user_id', $user_id);
        $user_list = $this->db->get();
        $data['user_list'] = $user_list->result_array();


        $this->db->select('count(trans.timeline_media_id) as img_count');
        $this->db->from('mst_timeline as mst');
        $this->db->join('trans_timeline_media as trans', 'mst.timeline_id = trans.timeline_id', 'left');
        $this->db->where("trans.timeline_media_type", '0'); // For Image
        $this->db->where("trans.timeline_media_status", '1');
        $this->db->where("mst.user_id", $user_id);
        $img_count = $this->db->get();
        $data['img_count'] = $img_count->result_array();

        $this->db->select('count(trans.timeline_media_id) as video_count');
        $this->db->from('mst_timeline as mst');
        $this->db->join('trans_timeline_media as trans', 'mst.timeline_id = trans.timeline_id', 'left');
        $this->db->where("trans.timeline_media_type", '1'); // For Video
        $this->db->where("trans.timeline_media_status", '1');
        $this->db->where("mst.user_id", $user_id);
        $video_count = $this->db->get();
        $data['video_count'] = $video_count->result_array();

        //$this->db->select('count(mst.from_user_id) as friend_count');
        $this->db->select('mst.to_user_id,mst.from_user_id');
        $this->db->from('mst_user_friends as mst');
        $this->db->where("mst.to_user_id", $user_id);
        $this->db->or_where("mst.from_user_id", $user_id);
        $friend_count = $this->db->get();
        $data['friend_count'] = $friend_count->result_array();


        return $data;
    }

    public function getLoginFriendDetails($user_id) {


        $this->db->select('muf.from_user_id,muf.to_user_id,mu.user_name,mu.user_id,mu.user_role,mu.last_login,mu.is_login');
        $this->db->from('mst_user_friends as muf');
        $this->db->join('mst_users as mu', 'mu.user_id  = muf.to_user_id');
        $this->db->where("muf.from_user_id", $user_id);
        $this->db->where("mu.is_login", '1');
        $login_friend = $this->db->get();
        $data['login_friend'] = $login_friend->result_array();
        $this->db->select('mn.*,mu.user_name,mu.profile_picture');
        $this->db->from('mst_notifications as mn');
        $this->db->join('mst_users as mu', 'mu.user_id  = mn.from_id');
        $this->db->where('mn.to_id', $user_id);
        $this->db->order_by('mn.notifications_id', 'DESC');
        $timeline = $this->db->get();
        $data['timeline'] = $timeline->result_array();

        return $data;
    }

}
