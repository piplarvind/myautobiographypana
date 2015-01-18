<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo isset($title)?$title:'';?>-Admin Panel</title>
<?php $this->load->view('backend/sections/header.php'); ?>
<script src="<?php echo base_url();?>media/backend/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>media/backend/js/bootstrap-tab.js"></script>
<!-- library for advanced tooltip -->
<script src="<?php echo base_url();?>media/backend/js/bootstrap-tooltip.js"></script>
<script src="<?php echo base_url();?>media/backend/js/charisma.js"></script> 
<script src="<?php echo base_url(); ?>media/backend/js/select-all-delete.js"></script>
</head>
<body>
<?php $this->load->view('backend/sections/top-nav.php'); ?>
<?php $this->load->view('backend/sections/leftmenu.php'); ?>
      <div id="content" class="span10">
      <!--[breadcrumb]-->
      <div>
        <ul class="breadcrumb">
          <li> <a href="<?php echo base_url(); ?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
		  <li> <a href="<?php echo base_url();?>backend/email-template/list">Manage Email Template</a> <span class="divider">/</span> </li>
          <li> Manage Email Template Macros</li>
        </ul>
      </div>
      
      <!--[message box]-->
      <?php if($this->session->userdata('msg') != '')
	  {
	  ?>
      <div class="msg_box alert alert-success">
        <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
        <?php echo $this->session->userdata('msg'); ?> </div>
      <?php $this->session->unset_userdata('msg');
	  }
	 ?>
	 
      <div class="row-fluid sortable"> 
        <!--[sortable header start]-->
        <div class="box span12">
          <div class="box-header well">
            <h2><i class=""></i>Email Template Macro Management <span style="color:#FF0000">Developers Use Only, do not add/edit/delete without permission of developer.</span></h2>
			
			<div class="box-icon">
				<a href="<?php echo base_url();?>backend/add-email-template-macro" class="btn btn-plus btn-round" title="Add Email Template Macro(Developer User Only)"><i class="icon-plus"></i></a>
			</div>
			
          </div>
          <br >
          <!--[sortable body]-->
          <div class="box-content">
		  <form name="frm_users" id="frm_users" action="<?php echo base_url(); ?>backend/email-template-macros" method="post">
            <table  class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
			  	<th width="7%" class="workcap">
					<?php
					if (count($arr_user_list) > 1) {
						?>
					<center>Select <br><input type="checkbox" name="check_all" id="check_all"  class="select_all_button_class" value="select all" /></center>
					<?php
				}
				?>               
				</th>
                <th width="25%" class="workcap">Macro Title</th>
                <th width="25%" class="workcap">Macro Comment</th>
                <th width="16%" class="workcap" align="center">Action</th>
                  </thead>
              <tbody>
                <?php
				$cnt=0;
				foreach($arr_email_template_macros as $email_template_macro)
				{
				  $cnt++;							
				?>
					<tr>
					 <td class="worktd" align="left">
						<center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $email_template_macro['macro_id']; ?>" /></center>

						</td>
						<td class="worktd"  align="left"><?php echo $email_template_macro['macro_title']; ?></td>
					   <td class="worktd"  align="left"><?php echo $email_template_macro['macro_comment']; ?></td>
					   <td class="worktd">
						 <a class="btn btn-info" href="<?php echo base_url();?>backend/add-email-template-macro/<?php echo $email_template_macro['macro_id']; ?>" title="Edit Email Template Macro"><i class="icon-edit icon-white"></i>Edit</a>
						</td>
				<?php
				}
				?>
				
              </tbody>
			   <?php
				if (count($email_template_macro) > 0) {
					?>
					<tfoot>
					<th colspan="9"><input type="submit" id="btn_delete_all" name="btn_delete_all" class="btn btn-danger" onClick="return deleteConfirm();"  value="Delete Selected"></th>
					</tfoot>
					<?php
				}
				?> 
            </table>
			
			</form>
          </div>
          <!--[sortable body]--> 
        </div>
      </div>
      
      <!--[sortable table end]--> 
      
      <!--[include footer]-->
      </div>

</div>

<!--including footer here-->
      <?php $this->load->view('backend/sections/footer.php'); ?>
</div>


</body>
</html>