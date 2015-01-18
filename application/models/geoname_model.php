<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Geoname_Model extends CI_Model {

    public function viewStates() {
        $this->db->select('g.geoname_id,g.geoname,g.status,mc.country_name as country_name');
        $this->db->from('mst_geoname  as g');
        $this->db->join('mst_country as mc', 'mc.country_id= g.country_id', 'left');
        $this->db->where('g.state_id =', '0');
        $this->db->order_by('g.geoname_id', 'DESC');
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Geoname_Model',
                'model_method_name' => 'viewStates',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
//         echo $this->db->last_query(); die;
        return $query->result_array();
    }

    public function viewStatesById($state_id) {

        $this->db->select('g.geoname_id,g.geoname,g.status,mc.country_name as country_name');
        $this->db->from('mst_geoname  as g');
        $this->db->join('mst_country as mc', 'mc.country_id= g.country_id', 'left');
        $this->db->where('g.geoname_id', $state_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Geoname_Model',
                'model_method_name' => 'viewStatesById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    public function viewCities() {
        $this->db->select('g.geoname_id,g.country_id,g.geoname as city_name,g.status,mc.country_name as country_name,geo.geoname as state_name');
        $this->db->from('mst_geoname  as g');
        $this->db->join('mst_geoname as geo', 'geo.geoname_id= g.state_id', 'left');
        $this->db->join('mst_country as mc', 'mc.country_id= g.country_id', 'left');
        $this->db->where('g.state_id !=', '0');
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Geoname_Model',
                'model_method_name' => 'viewCities',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    public function viewCityById($city_id) {
        $this->db->select('g.geoname_id,g.country_id,g.state_id,g.geoname as city_name,g.status,mc.country_name as country_name,geo.geoname as state_name');
        $this->db->from('mst_geoname  as g');
        $this->db->join('mst_geoname as geo', 'geo.geoname_id= g.state_id', 'left');
        $this->db->join('mst_country as mc', 'mc.country_id= g.country_id', 'left');
        $this->db->where('g.state_id !=', '0');
        $this->db->where('g.geoname_id', $city_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Geoname_Model',
                'model_method_name' => 'viewCityById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    public function getStates($country_id) {
        $this->db->select('g.geoname_id as state_id ,g.geoname as state_name ,g.status as status');
        $this->db->from('mst_geoname  as g');
        $this->db->where('g.state_id =', '0');
        $this->db->where('g.country_id', $country_id);
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Geoname_Model',
                'model_method_name' => 'getStates',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

}
