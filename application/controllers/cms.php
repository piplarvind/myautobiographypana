<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CMS extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('cms_model');
    }

    function listCMS() {	
		#checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        #Getting Common data
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
            if (!in_array(4, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage CMS!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        #using the admin model
        $this->load->model('admin_model');
        $data['title'] = "Manage CMS";
        $data['get_cms_list'] = $this->cms_model->getCmsList();
        $data['header'] = array('title' => 'Manage CMS');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/cms/cms-list', $data);
        $this->load->view('backend/sections/footer');
    }

    function editCMS($cms_id = 0) {
		
        #checking admin is logged in or not
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        #Getting Common data
        $data = $this->common_model->commonFunction();
		/* getting default lang_id from the database */ 
        
         if ($data['user_account']['role_id'] != 1) { 
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(4, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage CMS!</span>");
                redirect(base_url() . "backend/home");
            }
        }
        $lang_id= $this->common_model->getDefaultLanguageId();
		
        if ($this->input->post()) {		
			/*Updating master cms table for status*/
		    $arr_set_fields = array("status" => $this->input->post('status'),"on_date" => date('Y-m-d H:i:s'));
			$this->common_model->updateRow('mst_cms', $arr_set_fields, array("cms_id" => $cms_id));
			
			/*Updating transaction cms table for other detaile*/
			$arr_trans_set_fields= array(
                                "page_title" => $this->input->post('cms_page_title'),
				"page_content" => $this->input->post('content'),
				"page_meta_keyword" => $this->input->post('cms_page_meta_keywords'),
				"page_meta_description" => $this->input->post('cms_page_meta_description'),
				"page_seo_title" => $this->input->post('cms_page_seo_title')
            );
            $this->common_model->updateRow('trans_cms', $arr_trans_set_fields, array("cms_id" => $cms_id,"lang_id"=>$lang_id));
            $this->session->set_userdata("msg", "<span class='success'>Cms page updated successfully.</span>");
            redirect(base_url() . 'backend/cms');
        }
		
		
        #using the admin model
        $this->load->model('admin_model');
        $data['arr_cms_details'] = $this->cms_model->getCMS($cms_id, $lang_id);
        $data['header'] = array('title' => 'Edit CMS');
        $this->load->view('backend/sections/header', $data);
        $this->load->view('backend/sections/top-nav');
        $this->load->view('backend/sections/leftmenu');
        $this->load->view('backend/cms/edit-cms', $data);
        $this->load->view('backend/sections/footer');
    }

    public function editCmsLanguage($edit_id = '') {

        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        /* getting commen data required */
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {
            if ($this->input->post('cms_page_title') != "") {
                if ($this->input->post('edit_id') != '' && $this->input->post('lang_id') != '') {
					$arr_cms = $this->cms_model->getCMS(intval(($edit_id)), intval($this->input->post('lang_id')));
                    if ($arr_cms[0]['page_title'] != '') {
                        $arr_to_update = array(
                            "page_title" => $this->input->post('cms_page_title'),
                            "page_content" => $this->input->post('content'),
                            "page_seo_title" => $this->input->post('cms_page_seo_title'),
                            "page_meta_keyword" => $this->input->post('cms_page_meta_keywords'),
                            "page_meta_description" => $this->input->post('cms_page_meta_description')
                        );

                        /* condition to update record	 */
                        $condition_array = array('lang_id' => intval($this->input->post('lang_id')), 'cms_id' => intval(($this->input->post('edit_id'))));

                        /* updating the cms into database */
                        $this->common_model->updateRow('trans_cms', $arr_to_update, $condition_array);
                    } else {
                        
                         $arr_to_insert = array(
                            "page_title" => $this->input->post('cms_page_title'),
                            "page_content" => $this->input->post('content'),
                            "page_seo_title" => $this->input->post('cms_page_seo_title'),
                            "page_meta_keyword" => $this->input->post('cms_page_meta_keywords'),
                            "page_meta_description" => $this->input->post('cms_page_meta_description'),
                            "lang_id" => $this->input->post('lang_id'),
                            "cms_id" => $this->input->post('cms_id')
                        );
                         $this->common_model->insertRow($arr_to_insert,'trans_cms');
                        
                    }
                    /* setting session for displaying notiication message. */
                    $this->session->set_userdata('msg', "<span class='success'>Record updated successfully.</span>");
                }
                /* redirecting to cms list */
                redirect(base_url() . "backend/cms");
            }
        }

        $data['title'] = "Edit Cms Language";

        if (($edit_id != '')) {
            $data['edit_id'] = $edit_id;
            $arr_cms = $this->cms_model->getCMS(intval(($edit_id)));
            // single row fix
            $data['arr_cms'] = end($arr_cms);
			
			/* getting default lang_id from the database */
            $lang_id= $this->common_model->getDefaultLanguageId();

            /* getting all the active languages from the database */
            $data['arr_languages'] = $this->common_model->getRecords("mst_languages", "", array("status" => 'A',"lang_id !="=>$lang_id));

            $this->load->view('backend/cms/edit-language-cms', $data);
        } else {
            /* go to the page not found */
        }
    }

    function getCmsLanguage() {

        if ($this->input->post('lang_id') != "") {
            /* getting the global settings using the language id and parameter id. */
            $arr_language_values = $this->cms_model->getCMS(intval($this->input->post('edit_id')), intval($this->input->post('lang_id')));
            $arr_to_return = array();
            if (count($arr_language_values) > 0) {
                $arr_to_return["page_content"] = $arr_language_values[0]["page_content"];
                $arr_to_return["page_title"] = $arr_language_values[0]["page_title"];
                $arr_to_return["page_seo_title"] = $arr_language_values[0]["page_seo_title"];
                $arr_to_return["page_meta_keyword"] = $arr_language_values[0]["page_meta_keyword"];
                $arr_to_return["page_meta_description"] = $arr_language_values[0]["page_meta_description"];
            } else {
                $arr_to_return["page_content"] = "";
                $arr_to_return["page_title"] = "";
                $arr_to_return["page_seo_title"] = "";
                $arr_to_return["page_meta_keyword"] = "";
                $arr_to_return["page_meta_description"]="";
            }
            /* encodeing the array into json format */
            echo json_encode($arr_to_return);
        }
    }

    // This code is used for displaying cms page.
    public function cmsPage($page_name) {
        

	$global = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        
	    $data['arr_cms'] = $this->cms_model->getCMSByAlias($page_name,$this->session->userdata('lang_id'));
        if (count($data['arr_cms']) == 0)
            //redirect(base_url());
            redirect(base_url().'home');
			
        if ($data['arr_cms'][0]['cms_title'] == 'contact-us') {
            $var_array = array(
                "%%contact_mail%%" => $global['contact_mail'],
                "%%email%%" => $global['email'],
                "%%contact_phone_number%%" => $global['contact_phone_number']
            );

            foreach ($var_array as $k => $v) {
                $data['arr_cms'][0]['page_content'] = str_replace($k, $v, $data['arr_cms'][0]['page_content']);
            }
        }

        /* if ($data['arr_cms'][0]['page_title'] == '') {
            $data['header']['title'] = ucwords($global['site_title']);
        } else {
            $data['header']['title'] = ucwords($data['arr_cms'][0]['page_title']);
		}
		
                $this->load->view("front/includes/header",$data);
                $this->load->view('front/cms', $data);
		$this->load->view("front/includes/footer"); */
        
        
        if ($data['arr_cms'][0]['page_title'] == '') {
            $data['title_for_layout'] = ucwords($global['site_title']);
        } else {
            $data['title_for_layout'] = ucwords($data['arr_cms'][0]['page_title']);
        }
       
        /*
         * START Action :: Load Front-end View Pages :
         */   
           $this->load->view('front/includes/ui1-header1', $data);
           $this->load->view('front/includes/ui1-header2');
           $this->load->view('front/cms/cms', $data);
           $this->load->view('front/includes/ui1-footer');
    
           
        }
        
        
    /*
     * START :: Function for contact us page :
     * By Vaibhv Pathak On 25-Sep-2014 :
     */
   
    public function contactUs()
    {
        
        $data = $this->common_model->commonFunction();
        $data['lang'] = $this->lang->language;
        $data['title_for_layout'] = 'Countact Us';
        
        
        $data['user_session'] = $this->session->userdata('user_account');
        
        /*
         * START Action :: Load Front-end View Pages :
         */   
        $data['global'] = $this->common_model->getGlobalSettings();
//        echo '<pre>';print_r($data['global']);die;
           $this->load->view('front/includes/ui1-header1', $data);
           $this->load->view('front/includes/ui1-header2');
           $this->load->view('front/cms/contact_us', $data);
           $this->load->view('front/includes/ui1-footer');
        
    }  
        

    public function uploadImage() {
		error_reporting(E_ALL);		
		ob_clean();
        if ($_FILES["imageName"]['name'] != "") {
            $file_destination1 ="media/backend/img/cle-images/" . str_replace(" ", "_", microtime()) . "." . strtolower(end(explode(".", $_FILES["imageName"]['name'])));
			$file_destination=$this->common_model->absolutePath().$file_destination1;
			
            move_uploaded_file($_FILES['imageName']['tmp_name'], $file_destination);
			?> 
			<div id="image"><?php echo base_url().$file_destination1;?></div>
			<?php
        } else
            echo "false";
    }
    
       public function editorImageUpload() {
           
        if ($_FILES['upload']['name'] != '') {
            $filename = time() . "." . strtolower(end(explode(".", $_FILES['upload']["name"])));
            move_uploaded_file($_FILES['upload']["tmp_name"], "media/front/img/userfiles/" . $filename);
            ?><script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(1, "/p903/phase-II/media/front/img/userfiles/<?php echo $filename; ?>", '');</script><?php
        }
    }
}

?>