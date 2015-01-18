
<style type="text/css">
    .error {
        color: #bd4247;
        margin-left: 160px !important;
        width: 250px;
    }
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/user-manage/add-user.js"></script>
<script>
    ("#btn_submit").click(function () {
        if ($('input[type=checkbox]:checked').length == 1)
        {
            alert('Please select atleast two checkbox');
        }
    });
</script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>User B Profile</h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form id="frm_admin_dtl" class="form-horizontal" name="frm_admin_dtl">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">User Name :</label>
                                    
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['user_name']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name of institute :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['name_of_institute']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Address 1 :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['address_1']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Address 2 :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['address_2']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Country :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['country_name']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">State :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['state_name']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Village/City :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['user_city']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pin Code:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['pin_code']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email Id :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['user_email']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">User-Status:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php
                                            if ($arr_user_detail["user_status"] == "1") {
                                                echo "Active";
                                            } else {
                                                echo "Inactive";
                                            }
                                            ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Institute Type:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['institute_type_name']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Established In :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['established_in']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name Of Founder:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['name_of_founder']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Country Code:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['country_code']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Contact No:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['contact_no']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Institute Website:</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo $arr_user_detail['institute_website']; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Register Date :</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-static"><?php echo date($global['date_format'], strtotime($arr_user_detail['register_date'])); ?></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href='<?php echo base_url(); ?>backend/user-b/list';" >Back</button>
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
    <!-- /st-content-inner -->
</div>






