<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter_Model extends CI_Model {
    #function to get newsletter list from the database

    public function getNewsletterDetails() {
        $this->db->select('*');
        $this->db->order_by('newsletter_id', 'DESC');
        $query = $this->db->get('mst_newsletter');
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'getNewsletterDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    public function getNewsletterDetailById($newsletter_id) {
        $this->db->select('*');
        $this->db->where('newsletter_id', $newsletter_id);
        $query = $this->db->get('mst_newsletter');
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'getNewsletterDetailById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    function addNewsletterDetails($data) {
        $this->db->insert('mst_newsletter', $data);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'addNewsletterDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    function updateNewsletterDetails($data, $condition) {
        $this->db->where($condition);
        $this->db->update('mst_newsletter', $data);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'updateNewsletterDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    function getNewsletterDetailsById($id) {
        $this->db->select('*');
        $this->db->where('newsletter_id', $id);
        $query = $this->db->get('mst_newsletter');
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'getNewsletterDetailsById',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    function sendNewsletterDetails($data) {
        $this->db->insert('trans_newsletter_send', $data);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'sendNewsletterDetails',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    function getAllUsersByStatus($user_status) {
        $this->db->where('user_status', $user_status);
        $query = $this->db->get('mst_users');
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'getAllUsersByStatus',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    function addNewsletters($data) {
        $this->db->insert('trans_newsletter', $data);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'addNewsletters',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    function deleteNewsletters($data) {
        $this->db->delete('trans_newsletter', $data);
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'deleteNewsletters',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
    }

    function SendNewsletters2($newsletter_id) {

        $this->db->select('mst_news.*,trans_news.*');
        $this->db->from('mst_users as mst_news');
        $this->db->join('trans_newsletter as trans_news', 'mst_news.user_id=trans_news.user_id', 'left');
        if ($newsletter_id != '') { #if edit id not blank passed it will return all records
            $this->db->where("trans_news.newsletter_id", $newsletter_id);
        }


        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'SendNewsletters2',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

    public function getNewsletterDetailsbyID2($id, $user_id) {
        $this->db->select('*');
        $this->db->from('trans_newsletter as trans_news');
        if ($id != '') { #if edit id not blank passed it will return all records
            $this->db->where("trans_news.newsletter_id", $id);
        }
        if ($user_id != '') { #if edit id not blank passed it will return all records
            $this->db->where("trans_news.user_id", $user_id);
        }
        $query = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'getNewsletterDetailsbyID2',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $query->result_array();
    }

    /* Function To Get Newsletter Subscribers List. */
    public function getNewsLetterSubscribersListByNewsletterId() {
        $this->db->select('user_id,first_name,last_name,user_email');
        $this->db->from('mst_users');
        $this->db->where("send_email_notification", "1");
        $result = $this->db->get();
        $error = $this->db->_error_message();
        $error_number = $this->db->_error_number();
        if ($error) {
            $controller = $this->router->fetch_class();
            $method = $this->router->fetch_method();
            $error_details = array(
                'error_name' => $error,
                'error_number' => $error_number,
                'model_name' => 'Newsletter_Model',
                'model_method_name' => 'getNewsLetterSubscribersListByNewsletterId',
                'controller_name' => $controller,
                'controller_method_name' => $method
            );
            $this->common_model->errorSendEmail($error_details);
            redirect(base_url() . 'page-not-found'); //create this route
        }
        return $result->result_array();
    }

}

?>