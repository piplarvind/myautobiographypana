<?php
class Language extends CI_Controller
{   
    public function __construct(){
        parent::__construct();
    }
	/*function to get modify the language keyword values*/
    public function index() {
	
		$this->load->model('common_model');
	
		#checking admin is logged in or not
		if(!$this->common_model->isLoggedIn())
		{
			redirect(base_url()."backend/login");
		}
		
		#Getting Common data
		$data=$this->common_model->commonFunction();
		/*
		#checking user has privilige for the Manage Role
		if($data['user_account']['role_id']!=1)
		{
			
		}
		*/
		if(count($_POST)>0)	
		{
			$keywords=$this->input->post('keyword');
			$arr_to_update=array();		
			
			foreach($keywords as $key=>$keyword)
			{
				$arr_to_update[$key]['keyword_name']=$keyword['keyword_name'];
				$arr_to_update[$key]['keyword_value']=$keyword['keyword_value'];
			}
			
			$file_path=$data['absolute_path']."application/language/language-".trim($this->input->post('language_id'));
			if(file_exists($file_path))
			{
				$arr_language=$this->common_model->read_file($file_path);
				$arr_language['page'][$this->input->post('page_id')]=$arr_to_update;
			}
			else
			{
				
				$arr_language['page'][$this->input->post('page_id')]=$arr_to_update;
			}
			$this->common_model->write_file($file_path,$arr_language);
			$this->session->set_userdata("msg","<span class='success'>Keyword(s) value has been updated successfully.</span>");	
			redirect(base_url()."backend/language-keyword/list");
		}
		
		$arr_privileges=array();
		#getting all privileges 
		$data['arr_privileges']=$this->common_model->getRecords('mst_privileges');
		$data['title']="Edit Lanaguage Keyword Values";
		#getting all the active languages the database
		$data['lanaguage']=$this->common_model->getRecords('mst_languages','lang_id,lang_name',array('status'=>'A'));
		$data['all_pages']=$this->common_model->getRecords('mst_language_page','page_id,page_name');
		$this->load->view('backend/language/edit-keyword-values', $data);
	}
	
	public function getKeywords()
	{
		ob_clean();
		$this->load->model('common_model');
		$data=$this->common_model->commonFunction();
		$return_array=array();
		
		$page_keyword=$this->common_model->getRecords('trans_keyword','*',array('page_id'=>$this->input->post('page_id')));
		$page_keyword_ids=array();
		$page_keyword_names=array();
		foreach($page_keyword as $pg_keyword)
		{
			array_push($page_keyword_ids,$pg_keyword['keyword_id']);
			$page_keyword_names[$pg_keyword['keyword_id']]=$pg_keyword['keyword_name'];
		}
		
		//print_r($page_keyword_ids);
		
		if(count($page_keyword)>0)
		{
			$return_array['keyword_found']=1;
			$file_path=$data['absolute_path']."application/language/language-".trim($this->input->post('language_id'));			
			/*Reading the file using language_id*/
			if(file_exists($file_path))
			{
				$arr_page_keyword=$this->common_model->read_file($file_path);
				
				//print_r($arr_page_keyword);
				
				
				
				if(isset($arr_page_keyword['page'][trim($this->input->post('page_id'))]))
				{
					$page_keyword=$arr_page_keyword['page'][trim($this->input->post('page_id'))];
				}
				else
				{
					$page_keyword=array();
				}
				
				
				if(count($page_keyword)>0)
				{
					$added_keyword_ids=array();
					
					foreach($page_keyword as $keyword_id=>$pg_keyword)
					{
						if(in_array($keyword_id,$page_keyword_ids))
						{
							array_push($added_keyword_ids,$keyword_id);
							$arr_keyword[$keyword_id]['keyword_name']=$pg_keyword['keyword_name'];
							$arr_keyword[$keyword_id]['keyword_value']=$pg_keyword['keyword_value'];
						}
						
					}
					
					
					$keyword_not_added = array_diff($page_keyword_ids,$added_keyword_ids);
					foreach($keyword_not_added as $keyword_id)
					{
						$arr_keyword[$keyword_id]['keyword_name']=$page_keyword_names[$keyword_id];
						$arr_keyword[$keyword_id]['keyword_value']="";
					}
				}
				else
				{
					$page_keyword=$this->common_model->getRecords('trans_keyword','*',array('page_id'=>$this->input->post('page_id')));
					$arr_keyword=array();
					foreach($page_keyword as $keyword)
					{
						$arr_keyword[$keyword['keyword_id']]['keyword_name']=$keyword['keyword_name'];
						$arr_keyword[$keyword['keyword_id']]['keyword_value']="";
					}	
				}	
			}
			else
			{
				$arr_keyword=array();
				foreach($page_keyword as $keyword)
				{
					$arr_keyword[$keyword['keyword_id']]['keyword_name']=$keyword['keyword_name'];
					$arr_keyword[$keyword['keyword_id']]['keyword_value']="";
				}
			}
			
			$return_array['keywords']=$arr_keyword;
		}
		else
		{
			$return_array['keyword']['keyword_found']=0;
		}
		echo json_encode($return_array);				
	}
	
	public function addKeyword()
	{
		$this->load->model('common_model');
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
		
        /* getting common data */
        $data = $this->common_model->commonFunction();
		
        /* checking user has privilige for the Manage Admin */
        if ($data['user_account']['role_id'] != 1){
            /* an admin which is not super admin not privileges to access Manage Admin */
            /* setting session for displaying notiication message. */
            $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage admin.</span>");
            redirect(base_url() . "backend/home");
        }

        if (count($_POST) > 0) {
            if ($this->input->post('btn_submit') != "") {
				$insert_data=array("page_id"=>$this->input->post('page_id'),"keyword_name"=>$this->input->post('keyword_name'));
				$this->common_model->insertRow($insert_data,"trans_keyword");
				$this->session->set_userdata("msg","<span class='success'>Keyword has been added successfully,Please add it's value for all language for front end use.</span>");	
				redirect(base_url()."backend/language-keyword/list");
				
			}
        }
		
        $arr_privileges = array();
        /* getting all privileges */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        $data['title'] = "Add Keyword";
		$data['all_pages']=$this->common_model->getRecords('mst_language_page','page_id,page_name');
        $this->load->view('backend/language/add-keywords', $data);
	}
	
	public function checkKeywordExists()
	{
		ob_clean();
		$this->load->model('common_model');
		$keyword_detail=$this->common_model->getRecords("trans_keyword","*",array("keyword_name"=>trim($this->input->post("keyword_name"))));
		if(count($keyword_detail)>0)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	
	function switchLanguage($language_id = "") {
		//echo $this->session->userdata('lang_id')." ".$this->session->userdata('site_lang');
		$this->load->model('common_model');
		/* Setting the language into session */
		$this->session->set_userdata('lang_id', $this->input->post('lang_id'));
		/*Getting the lnaguage name setting it into session*/
		$language=$this->common_model->getRecords("mst_languages",'lang_name', array("lang_id"=>$this->input->post('lang_id')), $order_by='',$limit='',$debug = 0);
		$this->session->set_userdata('site_lang', trim(strtolower($language[0]['lang_name'])));
	}
	
}
