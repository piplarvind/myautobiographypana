<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }   
</style>
<script src="<?php echo base_url(); ?>media/backend/js/institute-type/edit-institute-type.js"></script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Update Institute Type</h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_institute_type" id="frm_edit_institute_type" action="<?php echo base_url(); ?>backend/edit-institute-type/<?php echo $arr_institute_type["institute_type_id"]; ?>" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Institute_Type Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_institute_type["institute_type"]); ?>" id="institute_type" name="institute_type" class="form-control" >
                                        <input type="hidden" name="old_institute_type" id="old_institute_type" value="<?php echo stripslashes($arr_institute_type["institute_type"]); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Institute_Type Status :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="institute_type_status" name="institute_type_status"   class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" <?php if ($arr_institute_type["institute_type_status"] == "1") { ?> selected="selected" <?php } ?>>Active</option>
                                            <option value="0" <?php if ($arr_institute_type["institute_type_status"] == "0") { ?> selected="selected" <?php } ?> >Inactive</option>
                                        </select>                                   
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/manage-institute-type';" >Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
</div>
