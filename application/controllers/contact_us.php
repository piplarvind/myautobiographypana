<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CONTACT_US extends CI_Controller {  
    public function __construct() {
        parent::__construct();
        $this->load->model('contact_us_model');
        $this->load->model('common_model');
    }

    public function index() {
		#Getting Common data
        $data = $this->common_model->commonFunction();
		
		if ($this->validContact()) {
            /* insert contact details */
            $arr_fields = array(
                "contact_name" => $this->input->post('user_name'),
                "contact_email" => $this->input->post('email'),
                "contact_message" => $this->input->post('content'),
                "contact_reply_status" => '0',
                "contact_created_date" => date('Y-m-d H:i:s')
            );

            $last_insert_id = $this->contact_us_model->insertContactUs($arr_fields);
            
             if ($last_insert_id > 0) 
             {
              //$this->session->set_userdata('msg','Thanks');
               $this->session->set_userdata('msg', 'Thank you for contacting us. We will get back to you soon.');   
               redirect(base_url().'contact-us');
               
             }
            
           /* if ($last_insert_id > 0) {
                
                
                $reserved_words = array(
                "||SITE_TITLE||" => $data['global']['site_title'],
                "||SITE_URL||" => base_url(),
                "||USER_NAME||" => $this->input->post('first_name'),
                "||EMAIL_ID||" => $this->input->post('email'),
                "||SUBJECT||" => $this->input->post('subject'),
                "||MESSAGE||" =>$this->input->post('message'),
            );
            
            $email_content = $this->common_model->getEmailTemplateInfo('contact-us', 17, $reserved_words);
            
            $mail = $this->common_model->sendEmail(array($data['global']['site_email']), array("email" => $this->input->post('email'), "name" => $data['global']['site_title']), $email_content['subject'],  $email_content['content']);
                if ($mail) {
                    $this->session->set_userdata('msg', 'Thank you for contacting us. We will get back to you soon.');
                } else {
                    $this->session->set_userdata('msg', 'Error in sending mail, please try again.');
                }
            } else {
                $this->session->set_userdata('msg', 'Error in sending mail, please try again.');
            } 

            redirect(base_url()); */
        }
        
        redirect(base_url().'home');
        /* $data['header'] = array("title" => "Contact Us", "keywords" => "", "description" => "");
	$this->load->view("front/includes/header", $data);
        $this->load->view('front/contact-us', $data);
        $this->load->view("front/includes/footer", $data); */
    }
	
	public function validContact()
	{
		$this->load->library('form_validation');
		/*Setting the error delimeter to show error message, make it as that of jquery validation message if possible */
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		
		/*Setting the validation rules */
		
		$this->form_validation->set_rules('user_name', 'full name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('content', 'message', 'required');
		
		/* cheacking the form is valid or not */
		if ($this->form_validation->run())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*
     * Check the captcha validation server side 
     */
    public function checkCaptchaCI($input_captcha) {
	
		if ($this->session->userdata('security_answer')!=$input_captcha) {
            $this->form_validation->set_message('checkCaptchaCI','Please enter valid security code.');
            return false;
        } else {
			return true; 
        }
    }
	
    public function checkCaptcha() {
        if ($this->input->post('input_captcha_value') == $this->session->userdata('security_answer')) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    #function to list all the roles
    public function listContactUs() {
        
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        #Getting Common data
        $data = $this->common_model->commonFunction();
        
        $data['user_session_data'] = $this->session->userdata('user_account');

        if (count($_POST) > 0) {
               
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
               
                $arr_contact_ids = $this->input->post('checkbox');
                
               
                
                if (count($arr_contact_ids) > 0) {


                    if (count($arr_contact_ids) > 0) {
                        #deleting the admin selected
                        $this->common_model->deleteRows($arr_contact_ids, "mst_contact_us", "contact_id");
                        $this->common_model->deleteRows($arr_contact_ids, "trans_contact_feedback_reply", "contact_id");
                    }

                    $this->session->set_userdata("msg", "<span class='success'>Records deleted successfully.</span>");
                }
            }
        }
                
        $data['title'] = "Manage Contact Us";
        $data['arr_contact_us'] = $this->contact_us_model->getContactUs('', '', 'contact_id desc');
        
        $data['header'] = array('title' => 'Manage Contact Us');
        
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/contact-us/list', $data);
        $this->load->view('backend/sections/footer');
        
    }

    function view($contact_id = 0) {
        
        $contact_id = base64_decode($contact_id);

        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        #Getting Common data
        $data = $this->common_model->commonFunction();
        
        $data['title'] = "Message Detail";

        /* get user message */
        $data['arr_contact'] = $this->common_model->getRecords("mst_contact_us", "*", array("contact_id" => intval($contact_id)));
        /* get all replied messages */
        $data['arr_feedback_contact'] = $this->common_model->getRecords("trans_contact_feedback_reply", "message_body,message_subject,reply_date", array("contact_id" => intval($contact_id)));
        /* Appending messages */
        $message = '';
        foreach ($data['arr_feedback_contact'] as $val) {
            $reply_msg = 'Please see below you replied to user message on ' . date($data['global']['date_format'], strtotime($val['reply_date'])) . ':- <br>' . PHP_EOL . PHP_EOL;
            $message .= $reply_msg . $val['message_body'] . PHP_EOL . PHP_EOL;
        }
        $reply_msg = 'Please see user message on ' . date($data['global']['date_format'], strtotime($data['arr_contact'][0]['contact_created_date'])) . ':- <br>' . PHP_EOL . PHP_EOL;
        $message .= $reply_msg . $data['arr_contact'][0]['contact_message'] . PHP_EOL . PHP_EOL;
        $data['reply_msg'] = $reply_msg;
        $data['message'] = $message;

        $data['header'] = array('title' => 'Manage Contact Us');
        
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/contact-us/view', $data);
        $this->load->view('backend/sections/footer');
        
        
    }

    function reply($contact_id = 0) {
       
        $contact_id = base64_decode($contact_id);

        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        #Getting Common data
        $data = $this->common_model->commonFunction();

        if (isset($_POST) && $_POST['contact_id'] > 0) {

            /* insert contact feedback details */
            $arr_insert_fields = array(
                "contact_id" => $_POST['contact_id'],
                "message_to" => addslashes($_POST['to']),
                "message_from_name" => addslashes($_POST['from_name']),
                "message_from_email" => addslashes($_POST['from_email']),
                "message_subject" => addslashes($_POST['subject']),
                "message_body" => $_POST['message'],
                "reply_date" => date('Y-m-d H:i:s')
            );

            $last_id = $this->common_model->insertRow($arr_insert_fields, 'trans_contact_feedback_reply');

            $arr_update_fields = array(
                "contact_reply_status" => '1'
            );

            /* update reply status */
            $arr_condition = array("contact_id" => $_POST['contact_id']);

            $this->common_model->updateRow('mst_contact_us', $arr_update_fields, $arr_condition);

            /* send mail */ 
            
            

            
           
            //$mail = $this->common_model->sendEmail(array($this->input->post('to')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['message']);
            
            
            
            
            
            
            

            $mail = $this->common_model->sendEmail(array($this->input->post('to')), array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $this->input->post('subject'), $this->input->post('message'));
            if ($mail) {
               $this->session->set_userdata("msg", "<span class='success'>Reply message has been sent successfully.</span>");
            } else {
                $this->session->set_userdata("msg", "<span class='success'>Reply message sent failed.</span>");
           }                       

            redirect(base_url() . 'backend/contact-us');
        }

        $data['title'] = "Reply Message";

        /* get user message */
        $data['arr_contact'] = $this->common_model->getRecords("mst_contact_us", "*", array("contact_id" => intval($contact_id)));
		/* get all replied messages */
        $data['arr_feedback_contact'] = $this->common_model->getRecords("trans_contact_feedback_reply", "message_body,message_subject,reply_date", array("contact_id" => intval($contact_id)));
		
        /* Appending messages */
        $message = PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL;
        foreach ($data['arr_feedback_contact'] as $val) {
            $reply_msg = 'Please see below you replied to user message on ' . date($data['global']['date_format'], strtotime($val['reply_date'])) . ':- <br>' . PHP_EOL . PHP_EOL;
            $message .= $reply_msg . $val['message_body'] . PHP_EOL . PHP_EOL;
        }
        $reply_msg = 'Please see user message on ' . date($data['global']['date_format'], strtotime($data['arr_contact'][0]['contact_created_date'])) . ':- <br>' . PHP_EOL . PHP_EOL;
        $message .= $reply_msg . $data['arr_contact'][0]['contact_message'] . PHP_EOL . PHP_EOL;
        $data['reply_msg'] = $reply_msg;
        $data['message'] = $message;

        
        $data['header'] = array('title' => 'Manage Contact Us');
        
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/contact-us/reply', $data);
        $this->load->view('backend/sections/footer');
        
        
        
    }

}

/* End of file contact-us.php */
/* Location: ./application/controllers/contact_us.php */