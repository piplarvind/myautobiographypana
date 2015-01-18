<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Class to Manage all newsletters function
 */

// Class to manage all newsletter functionality
class Newsletter extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('newsletter_model');
        $this->load->model('common_model');
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
    }

    /*
     * function to List all newsletters 
     */

    public function listNewsletter() {
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');

            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(6, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage newsletter!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        #using the newsletter model
        $this->load->model('newsletter_model');
        if (count($this->input->post()) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                #getting all ides selected
                $arr_newsletter_ids = $this->input->post('checkbox');
                if (count($arr_newsletter_ids) > 0) {
                    #deleting the newsletter selected
                    $this->common_model->deleteRows($arr_newsletter_ids, "mst_newsletter", "newsletter_id");
                }
                $msg_data = array('msg_type' => 'success', 'newsletter_msg_val' => 'Newsletter has deleted successfully.');
                $this->session->set_userdata('newsletter_msg', $msg_data);
            }
        }
        $data['header'] = array('title' => 'Manage Newsletter');
        $data['arr_newsletter_list'] = $this->newsletter_model->getNewsletterDetails();
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/newsletter/list', $data);
        $this->load->view('backend/sections/footer');
    }

    /*
     * function to change newsletter Status
     */

    public function changeStatus() {
        if ($this->input->post('newsletter_id') != "") {
            #updating the newsletter status.
            $arr_to_update = array(
                "newsletter_status" => $this->input->post('newsletter_status')
            );
            #condition to update record	for the newsletter status
            $condition_array = array('newsletter_id' => intval($this->input->post('newsletter_id')));
            $this->common_model->updateRow('mst_newsletter', $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has been changed successfully."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    /*
     * function to Add New newsletter 
     */

    public function addNewsletter() {
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(6, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage newsletter!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="validationError">', '</p>');
        $this->form_validation->set_rules('input_subject', 'newsletter subject', 'required');
        $this->form_validation->set_rules('input_content', 'newsletter content', 'required');
        if ($this->form_validation->run() == true) {
            $newsletter_details = array("newsletter_subject" => $this->input->post('input_subject'), "newsletter_content" => $this->input->post('input_content'), "lang_id" => 17, "add_date" => date('Y-m-d H:i:s'), "update_date" => date('Y-m-d H:i:s'));
            $this->newsletter_model->addNewsletterDetails($newsletter_details);
            $this->session->set_userdata("msg", "<span class='success'>Newsletter added successfully!</span>");
            redirect(base_url() . "backend/newsletter/list");
        }
        #using the newsletter model
        $this->load->model('newsletter_model');
        $data['header'] = array('title' => 'Add Newsletter');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/newsletter/add', $data);
        $this->load->view('backend/sections/footer');
    }

    /*
     * function to upload Editor Image 
     */

    function uploadClEditorImage() {
        if ($_FILES["imageName"]['name'] != "") {
            $file_destination = "media/backend/userfiles/" . str_replace(" ", "_", microtime()) . "." . strtolower(end(explode(".", $_FILES["imageName"]['name'])));
            move_uploaded_file($_FILES['imageName']['tmp_name'], $file_destination);
            ?>
            <div id="image"><?php echo base_url() . $file_destination; ?></div>
            <?php
        } else {
            echo "false";
        }
    }

    /*
     * function to Edit newsletter 
     */

    public function editNewsletter($newsletter_id) {
        #Getting Common data
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /** getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(6, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage newsletter!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        $this->load->model('newsletter_model');
        $arr_newsletter_data = array();
        /*
         * Get newsletter details by id
         */
        $arr_newsletter_data = $this->newsletter_model->getNewsletterDetailById($newsletter_id);
        /*
         * If invalid newsletter id the requiret to newsletter listing page
         */
        if (!count($arr_newsletter_data)) {
            $msg_data = array('msg_type' => 'error', 'newsletter_msg_val' => 'Invalid url.');
            $this->session->set_userdata('newsletter_msg', $msg_data);
            redirect(base_url() . "backend/newsletter/list");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="validationError">', '</p>');
        $this->form_validation->set_rules('input_subject', 'newsletter subject', 'required');
        $this->form_validation->set_rules('input_content', 'newsletter content', 'required');
        if ($this->form_validation->run() == true) {
            $newsletter_details = array("newsletter_subject" => $this->input->post('input_subject'), "newsletter_content" => $this->input->post('input_content'), "update_date" => date('Y-m-d H:i:s'));
            $condition = array('newsletter_id' => $newsletter_id);
            $this->newsletter_model->updateNewsletterDetails($newsletter_details, $condition);
            $this->session->set_userdata("msg", "<span class='success'>Newsletter updated successfully!</span>");
            redirect(base_url() . "backend/newsletter/list");
        }
        #using the newsletter model
        $this->load->model('newsletter_model');
        $data['header'] = array('title' => 'Update Newsletter');
        $data['arr_newsletter_data'] = $arr_newsletter_data[0];
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/newsletter/edit', $data);
        $this->load->view('backend/sections/footer');
    }

    /*
     * function to send newsletter 
     */

    public function sendNewsletter($newsletter_id = '') {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['email_template'] = $this->newsletter_model->getNewsletterDetailsById($newsletter_id);
        if ($_FILES['attachement']['name'] == "") {
            $attachement = "No";
            $attachement_path = "";
        } else {
            $attachement = "Yes";
            //config initialise for uploading image 
            $config['upload_path'] = './media/backend/newsletter_attachment/';
            $config['allowed_types'] = '*';
            $config['max_size'] = '9000000';
            $config['max_width'] = '12024';
            $config['max_height'] = '7268';
            $config['file_name'] = time();
            //loading uploda library
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('attachement')) {
                $error = array('error' => $this->upload->display_errors());
                $msg_data = array('msg_type' => 'error', 'newsletter_msg_val' => $this->upload->display_errors());
                $this->session->set_userdata('newsletter_msg', $msg_data);
                redirect("backend/newsletter/list");
                $this->session->set_userdata('image_not_uploaded', 'yes');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $image_data = $this->upload->data();
            }
            $attachement_path = $image_data['file_name'];
        }
        if (count($_POST) > 0) {
            if (isset($_POST['send_nessletter'])) {
                #getting all ides selected
                $arr_user_ids = $this->input->post('checkbox');
                if (count($arr_user_ids) > 0) {
                    $newsletter_subject = $data['email_template'][0]["newsletter_subject"];
                    $newsletter_content = $data['email_template'][0]["newsletter_content"];
                    foreach ($arr_user_ids as $u_id) {
                        $condition_array = array('user_id' => $u_id);
                        $emails = $this->common_model->getRecords("mst_users", 'user_email ', $condition_array, $order_by = '', $limit = '', $debug = 0);
                        $user_email = $emails[0]['user_email'];
                        $newsletter_details = array("user_email" => $user_email, "user_id" => $u_id, "newsletter_id" => $newsletter_id, "newsletter_subject" => $newsletter_subject, "newsletter_content" => $newsletter_content, "attachement" => $attachement, "attachement_path" => $attachement_path, "date_created" => date('Y-m-d H:i:s'));
                        $this->newsletter_model->sendNewsletterDetails($newsletter_details);
                        $recipeinets = $user_email;
                        $from = array("email" => stripslashes($data['global']['site_email']), "name" => stripslashes($data['global']['site_title']));
                        $subject = $newsletter_subject;
                        $message = $newsletter_content;
                        $mail = $this->common_model->sendEmail($recipeinets, $from, $subject, $message);
                    }
                }
                $this->session->set_userdata('msg', 'Newsletter sent successfully.');
//                $msg_data = array('msg_type' => 'success', 'newsletter_msg_val' => 'Newsletter sent successfully.');
//                $this->session->set_userdata('newsletter_msg', $msg_data);
                redirect("backend/newsletter/list");
            }
        }
        $data['logged_username'] = $this->session->userdata('admin_name');
        $data['newsletter_id'] = $newsletter_id;
        $data['header'] = array('title' => 'Send Newsletter');
        $data['arr_user_list'] = $this->newsletter_model->getNewsLetterSubscribersListByNewsletterId();
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/newsletter/send-newsletter', $data);
        $this->load->view('backend/sections/footer');
    }

    /*
     * function to email templet for newsletter 
     */

    public function emailTemplates($templateDetails, $global, $to_email, $attachement, $attachement_path) {
        $data['global'] = $this->common_model->getGlobalSettings();
        $fromUser = $data['global']['site_email'];
        $config['protocol'] = 'mail';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $this->load->library('email', $config);
        $this->email->initialize($config);
        // set the from address
        $this->email->from($fromUser);
        //$this->email->from('dhiraj@panaceatek.com');
        // set the subject
        $this->email->subject($templateDetails[0]['newsletter_subject']);
        // set recipeinets
        $this->email->to($to_email);
        // set mail message
        $this->email->message($templateDetails[0]['newsletter_content']);
        // return boolean value for email send
        return $this->email->send();
    }

    /*
     * function to get all users to send newsletter on selected conditions
     */

    function gettingAllUsersByStatus() {
        $user_status = $this->input->post('user_status');
        $users['user_list'] = $this->newsletter_model->getAllUsersByStatus($user_status);
        $i = 0;
        foreach ($users['user_list'] as $userEmail) {
            if ($i > 0)
                echo ",";
            $userEmail['user_id'];
            echo $userEmail['user_email'];
            $i++;
        }
    }

}
