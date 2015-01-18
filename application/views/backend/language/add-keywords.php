<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo stripslashes((isset($title))?$title:$global['site_title']); ?></title>
<?php $this->load->view('backend/sections/header');?>
<style>
.error {
    color: #BD4247;
    margin-left: 120px;
    width: 210px;
}
.FETextInput{
    margin-left: 120px;
    margin-top: -28px;
}
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>media/backend/js/jquery.validate.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>media/backend/js/language/add-keywords.js"></script>
</head>
<body>
<?php $this->load->view('backend/sections/top-nav.php');?>
<?php $this->load->view('backend/sections/leftmenu.php');?>
      <div id="content" class="span10">
      <!--[breadcrumb]-->
      <div>
        <ul class="breadcrumb">
          <li> <a href="<?php echo base_url();?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
          <li> Manage Keyword</li>
        </ul>
      </div>
      <div class="row-fluid sortable"> 
        <!--[sortable header start]-->
        <div class="box span12">
          <div class="box-header well">
            <h2><i class=""></i>Add New Keyword (Add the valid keywords as it is not editable since it is used in views as static)-<span style="color:#FF0000">Developers Use Only</span></h2>
          </div>
          <br >
          <!--[sortable body]-->
          <div class="box-content">
            <form name="frm_add_keywords" id="frm_add_keywords" action="<?php echo base_url();?>backend/add-keyword" method="POST">
					<div class="control-group">
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

			
                    <div class="control-group" id="div_keyword">
                        <label for="typeahead" class="control-label">Keyword :<sup class="mandatory">*</sup> </label>
                        <div class="controls">
                            <input type="text" value="" name="keyword_name" id="keyword_name" class="FETextInput">
                        </div>
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