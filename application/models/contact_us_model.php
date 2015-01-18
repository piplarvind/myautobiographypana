<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_Us_Model extends CI_Model {

    // common function for absolute path
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
                'model_name' => 'Contact_Us_Model',
                'model_method_name' => 'absolutePath',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $abs_path;
    }

    public function insertContactUs($arr_fields) {
        $this->db->insert("mst_contact_us", $arr_fields);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Contact_Us_Model',
                'model_method_name' => 'insertContactUs',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $this->db->insert_id();
    }

    public function getContactUs($fields_to_pass = '', $condition_to_pass = '', $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0) {

        $fields_to_pass = '';
        $str_sql = '';
        if (is_array($fields_to_pass)) {
            $str_sql.="`" . implode("`,`", $fields_to_pass) . "`";
        } elseif ($fields_to_pass != "") {
            $str_sql .= $fields_to_pass;
        } else {
            $str_sql .= "*";
        }

        $this->db->select($str_sql);

        $this->db->from("mst_contact_us");

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
                'model_name' => 'Contact_Us_Model',
                'model_method_name' => 'getContactUs',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

}
