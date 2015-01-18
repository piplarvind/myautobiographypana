<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo stripslashes((isset($title))?$title:$global['site_title']); ?></title>
<?php $this->load->view('backend/sections/header');?>
<style>
div.error {
    color: #BD4247;
    margin-left: 120px;
    width: 210px;
	float:left;
}
td div.error {
 margin-left: 0px;
}
.FETextInput{
    margin-left: 120px;
    margin-top: -28px;
}
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>media/backend/js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>media/backend/js/language/edit-keywords.js"></script>
</head>
<body>
<?php $this->load->view('backend/sections/top-nav.php');?>
<?php $this->load->view('backend/sections/leftmenu.php');?>
      <div id="content" class="span10">
      <!--[breadcrumb]-->
      <div>
        <ul class="breadcrumb">
          <li> <a href="<?php echo base_url();?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
          <li> Edit Language Keyword Values</li>
        </ul>
      </div>
	  
	  <!--[message box]-->
 		<?php
      $msg=$this->session->userdata('msg');
	  ?>
      <!--[message box]-->
      <?php if($msg != ''){?>
      <div class="msg_box alert alert-success">
        <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">x</button>
        <?php echo $msg; 
			$this->session->unset_userdata('msg');
		?> 
	  </div>
      <?php
 		}
	 ?> 
	  
      <div class="row-fluid sortable"> 
        <!--[sortable header start]-->
        <div class="box span12">
          <div class="box-header well">
            <h2><i class=""></i>Edit Language Keyword Values</h2>
			
			<!-- comment this link when going to update for QA or Client since it is only use for developers internal use to manage language keywords -->
              <div class="box-icon">
	              <a title="Add Keywords(Only for Developers Use)" class="btn btn-plus btn-round" href="<?php echo base_url();?>backend/add-keyword"><i class="icon-plus"></i></a>
              </div>
			<!-- *******************   -->  
			
          </div>
		  
          <br >
		  
          <!--[sortable body]-->
          <div class="box-content">
            <form name="frm_lanaguage_keyword" id="frm_lanaguage_keyword" action="<?php echo base_url();?>backend/language-keyword/list" method="POST" >
				   <div class="control-group" style="clear:both">
				   	<div style="width:40%;float:left"> 
						<label for="typeahead" class="control-label">Select Language :<sup class="mandatory">*</sup> </label>
						<div class="controls">
							<select name="language_id" id="language_id"  class="FETextInput" onChange="fnShowHidePageKeyword();">
								<option value="" selected="selected">Select Language</option>
								<?php
								if(count($lanaguage)>0)
								{
									foreach($lanaguage as $lang)
									{
										?>
											<option value="<?php echo $lang['lang_id'];?>"><?php echo $lang['lang_name'];?></option>
										<?php
									}
								}
								?>
							</select>
                        </div>		
				  </div>
						<div>		
								<label for="typeahead" class="control-label">Select Page :<sup class="mandatory">*</sup> </label>
								<div class="controls">
									<select name="page_id" id="page_id"  class="FETextInput" onChange="fnShowHidePageKeyword();">
											<option value="" selected="selected">Select Page</option>
											<?php 
												if(count($all_pages)>0)
												{
													foreach($all_pages as $pages)
													{
														?>
														<option value="<?php echo $pages['page_id'];?>"><?php echo $pages['page_name'];?></option>
														<?php
													}
												}
											?>
									</select>
								</div>
						</div>
                    </div>
					
			<div class="box-content" id="div_lang_keyword" style="display:none;">
				<table  class="table table-striped table-bordered bootstrap-datatable datatable" id="keyword_table">
				 	  <th width="30%" class="workcap">Keyword</th>
					  <th width="70%" class="workcap" align="center">Language Value</th>
				  <tbody id="keyword_table_body">			

				  </tbody>
				  
				</table>
          	</div>	
			
			<div class="form-actions">
				<button type="submit" name="btn_submit" class="btn btn-primary" value="Save changes">Save changes</button>
			</div>
                
              </FORM>
          </div>
          <!--[sortable body]--> 
        </div>
      </div>
      <!--[sortable table end]--> 
      <!--[include footer]-->
      </div><!--/#content.span10-->
</div><!--/fluid-row-->
<?php $this->load->view('backend/sections/footer.php');?>
</div>
</body>
</html>