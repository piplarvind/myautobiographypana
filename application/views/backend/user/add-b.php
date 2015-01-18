
<style type="text/css">
    .error {
        color: #bd4247;
    }
     .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/user-manage/add-user-b.js"></script>
<script>

    function selectStates(country_id)
    {
        var obj_params = new Object();
        obj_params.country_id = country_id;
        jQuery.post("<?php echo base_url(); ?>backend/cities/select-states", obj_params, function (msg) {
            console.log(msg);
            $("#state_id").html("")
            var div_data = '';
            div_data += "<option value=" + "" + ">" + "Select State" + "</option>";
            $.each(msg, function (i, v) {
                div_data += "<option value=" + v.state_id + ">" + v.state_name + "</option>";

            });
            $(div_data).appendTo('#state_id');
        }, "json");
    }
</script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Add User B</h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_user_details" id="frm_user_details" action="<?php echo base_url(); ?>backend/user-b/add" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Username :</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="user_name" name="user_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Name of institute :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="name_of_institute" id="name_of_institute" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Address 1 :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea id="address_1" name="address_1" class="form-control"  ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Address 2 :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea id="address_2" name="address_2" class="form-control"  ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Country:<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="country_id" name="country_id"  onchange = "selectStates(this.value)"   class="form-control">
                                            <option value=''> Select Country </option>
                                            <?php foreach ($arr_country as $country) { ?>
                                                <option value="<?php echo $country["country_id"]; ?>"><?php echo $country["country_name"] ?></option>
                                            <?php } ?>
                                        </select>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >State :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select name="state_id" id="state_id"   class="form-control"    >
                                            <option value=''> Select State </option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Village/City :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_city" id="user_city" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Pin-Code:<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="pin_code" id="pin_code" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_email" id="user_email" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Confirm Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="cnf_user_email" id="cnf_user_email" class="form-control" >
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Password :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="user_password" name="user_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Confirm Password :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Type of Institution :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select name="institute_type" id = "institute_type"  class="form-control"   >
                                            <option value=''> Select Institute </option>
                                                <?php  foreach($arr_institute_type as $institute_type) { ?>
                                            <option value="<?php echo $institute_type["institute_type_id"] ; ?>"><?php echo $institute_type["institute_type"] ; ?></option>
                                                <?php } ?>
                                        </select>                                      
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Established In :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="established_in" id="established_in" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Name Of Founder :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="name_of_founder" id="name_of_founder" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Country Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_country_code" id="user_country_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Contact No :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_contact_no" id="user_contact_no" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Institute Website :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_institute_website" id="user_institute_website" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/user-b/list';" >Back</button>
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







