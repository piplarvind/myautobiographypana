
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/front/js/user/users.js"></script>
<div class="dashboard offset-top-40">
    <div class="container">
        <h1 class="page-title">User Profile</h1>
    </div>
    <div class="reg-panel-body register_step_1"><li> <a href="<?php echo base_url(); ?>logout">Logout</a></li>
        <div class="container">

            <form id="frm_user_edit_profile" name="frm_user_edit_profile" method="post" action="<?php echo base_url(); ?>edit-user-profile" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="sub-title">Personal information</h4>
                                <div class="row">

                                    <div class="form-group col-xs-12 col-sm-6">
                                        <label>First Name <span class="mandetory"></span>:</label>
                                        <?php echo $arr_user_data['user_name']; ?>
                                    </div> 
                                </div> 
                                <div class="row"> 
                                    <div class="form-group col-xs-12 col-sm-6">
                                        <label>E-mail <span class="mandetory"></span>:</label>
                                        <?php echo $arr_user_data['user_email']; ?>

                                    </div>
                                </div>    
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6">
                                        <label>Contact Number <span class="mandetory"></span>:</label>
                                        <?php echo $arr_user_data['contact_no']; ?>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-sm-6">
                                    <label>Pin code<span class="mandetory"></span>:</label>
                                    <?php echo $arr_user_data['pin_code']; ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>
                    <div class="btn-grp offset-top-20">
                        <input type="submit" class="btn btn-primary" value="" id="btn_edit_user_details" name="btn_edit_user_details">   

                    </div>
                </div>


            </form>
        </div>
    </div>
</div>  
