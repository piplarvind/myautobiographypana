




<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Message Detail</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form name="frm_user_details" id="frm_user_details" class='form-horizontal'
                                  action="<?php echo base_url(); ?>backend/user-a/add" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">From :</label>
                                    <div class="col-sm-9">
                                        <!--<input type="text" value="" id="user_name" name="user_name" class="form-control">-->
                                        <?php echo stripslashes($arr_contact[0]['contact_email']); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Date :</label>
                                    <div class="col-sm-9">
                                        <!--<input type="text" value="" name="first_name" id="first_name" class="form-control">-->
                                        <?php echo date($global['date_format'], strtotime($arr_contact[0]['contact_created_date'])); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Message :</label>
                                    <div class="col-sm-9">
                                        <!--<input type="text" value="" name="last_name" id="last_name" class="form-control">-->
                                        <?php echo stripslashes($message);?>
                                    </div>
                                </div>
                                
                                
                               
                                
                                
                                
                                
                                
                                <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <a href="<?php echo base_url() . 'backend/contact-us/reply/'.base64_encode($arr_contact[0]['contact_id']); ?>">
                                <button type="button" name="btnSubmit" class="btn btn-primary" value="Save changes">Reply</button>                                                        
                            </a>
<!--                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/user-a/list';" >Back</button>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">-->
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                         </div>
                    </div>
                
                </div>
            <!-- Footer -->
            <div class="footer">
               <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
            <!-- // Footer -->
            </div>

        </div>
    </div>






<!--
      <div id="content" class="span10">
      [breadcrumb]
      <div>
        <ul class="breadcrumb">
          <li> <a href="<?php echo base_url();?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
          <li> <a href="<?php echo base_url();?>backend/contact-us">Manage Contact Us</a> <span class="divider">/</span></li>
          <li> Message Detail </li>
        </ul>
      </div>
      <div class="row-fluid sortable"> 
        [sortable header start]
        <div class="box span12">
          <div class="box-header well">
            <h2><i class=""></i>Message Detail</h2>
              <div class="box-icon">
	              <a title="Manage Conatct Us" class="btn btn-plus btn-round" href="<?php echo base_url();?>backend/contact-us"><i class="icon-arrow-left"></i></a>
            </div>
          </div>
          <br >
          [sortable body]
          <div class="box-content">                        
                        <div class="control-group">
                            <label class="control-label" for="From">From :</label>
                            <div class="controls">
                                <div style="margin-left:100px; margin-top:-25px">
                                    <?php echo stripslashes($arr_contact[0]['contact_email']); ?>
                                </div>
                            </div>
                        </div>
						
						 <div class="control-group">
                            <label class="control-label" for="From">Subject :</label>
                            <div class="controls">
                                <div style="margin-left:100px; margin-top:-25px">
                                    <?php //echo stripslashes($arr_contact[0]['contact_subject']); ?>
                                </div>
                            </div>
                        </div> 
						
                        <div class="control-group">
                            <label class="control-label">Date :</label>
                            <div class="controls"> 
                                <div style="margin-left:100px; margin-top:-25px">
                                    <?php echo date($global['date_format'], strtotime($arr_contact[0]['contact_created_date'])); ?>
                                </div>
                            </div>
                        </div>                        
                        <div class="control-group">
                            <label class="control-label">Message :</label>
                            <div class="controls">                                
                                <div style="margin-left:100px;padding:5px; margin-top:-25px; border:solid #000000 1px; "  >
                                    <?php echo stripslashes($message);?>
                                </div>                                
                            </div>
                        </div> 
                        <div class="form-actions">
                            <a href="<?php echo base_url() . 'backend/contact-us/reply/'.base64_encode($arr_contact[0]['contact_id']); ?>">
                                <button type="button" name="btnSubmit" class="btn btn-primary" value="Save changes">Reply</button>                                                        
                            </a>
                        </div>                        
                    </div>
          [sortable body] 
        </div>
      </div>
      [sortable table end] 
      [include footer]
      </div>/#content.span10
</div>/fluid-row
<?php // $this->load->view('backend/sections/footer.php');?>
</div>
</body>
</html>-->