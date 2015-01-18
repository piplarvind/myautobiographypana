<?php
/**making sure that array having only one record.***/
$arr_email_template_details=end($arr_email_template_details);
?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo isset($title)?$title:'';?>-Admin Panel</title>
<?php $this->load->view('backend/sections/header.php'); ?>
<style>
div.error {
    color: #bd4247;
    margin-left: 169px;
    width: 226px;
}
</style>
<script src="<?php echo base_url();?>media/backend/js/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	jQuery("#frm_email_template").validate({
		 errorElement:'div',
		 rules: {
			input_macro_title:{
				required: true
			},
			input_macro_comment:{
				required: true
			}
		},
		messages: {
			input_macro_title:{
				required: "Please enter the macro title."
			},
			input_macro_comment:{
				required: "Please enter the comment for macro."
			}
		},
		// set this class to error-labels to indicate valid fields
		success: function(label) {
		// set &nbsp; as text for IE
			label.hide();
		}
	});

});

</script>
</head>
<body>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
      <div id="content" class="span10">
      <!--[breadcrumb]-->
      <div>
        <ul class="breadcrumb">
          <li> <a href="javascript:void(0)">Dashboard</a> <span class="divider">/</span> </li>
          <li> <a href="<?php echo base_url();?>backend/email-template/list">Manage Email Template</a> <span class="divider">/</span> </li>
		  <li> <a href="<?php echo base_url();?>backend/email-template-macros">Manage Email Template Macro</a> <span class="divider">/</span> </li>
		  <li> <?php if($email_template_macro_id!=''){ echo "Update";}else{echo "Add";}?> Email Template Macro </li>
        </ul>
      </div>
      
           <div class="row-fluid sortable"> 
        <!--[sortable header start]-->
        <div class="box span12">
          <div class="box-header well">
            <h2><i class=""></i><?php if($email_template_macro_id!=''){ echo "Update";}else{echo "Add";}?> Email Template</h2>
              <div class="box-icon">
              <a title="Manage Email Template Macro" class="btn btn-plus btn-round" href="<?php echo base_url();?>backend/email-template-macros"><i class="icon-arrow-left"></i></a>
            </div>
          </div>
          <br >
          <!--[sortable body]-->
          <div class="box-content">
            <form name="frm_email_template" id="frm_email_template" action="<?php echo base_url();?>backend/add-email-template-macro/<?php echo(isset($email_template_macro_id))?$email_template_macro_id:'';?>" method="POST" >
                <input type="hidden" name="email_template_macro_id" id="email_template_macro_id" value="<?php echo (isset($email_template_macro_id))?$email_template_macro_id:'';?>">
                <div class="control-group">
                    <label class="control-label" for="title">Macro Title :<sup style="color: red;">*</sup></label>
                  <div class="controls">
                      <input type="text" dir="ltr" style="margin-left:170px; margin-top:-28px" class="FETextInput" name="input_macro_title" id="input_macro_title" value="<?php echo $arr_email_template_macro_details[0]['macro_title'];?>" id="inputTitle" size="100" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="subject">Email Template Subject :<sup style="color: red;">*</sup></label>
                  <div class="controls">
                     <textarea dir="ltr"  style="margin-left:170px; width:500px; margin-top:-28px" name="input_macro_comment" id="input_macro_comment" ><?php echo stripcslashes($arr_email_template_macro_details[0]['macro_comment']); ?></textarea>
                          
                  </div>
                </div>
                
                    
              
                <div class="form-actions">
                  <button type="submit" name="btnSubmit" class="btn btn-primary" value="Save changes">Save changes</button>
                </div>
              </form>
          </div>
          <!--[sortable body]--> 
        </div>
      </div>
      
      <!--[sortable table end]--> 
      
      <!--[include footer]-->
      </div><!--/#content.span10-->

</div><!--/fluid-row-->
      <?php $this->load->view('backend/sections/footer.php'); ?>
</div>
</body>
</html>
<style>
    .error{
    color: #BD4247;
    margin-left: 202px;
    width: 400px;
}
    </style>