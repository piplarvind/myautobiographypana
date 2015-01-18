<style type="text/css">
    .error {
        color: #bd4247;
        
    }
</style>
        <script src="<?php echo base_url(); ?>media/backend/js/interest/edit-interest.js"></script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Update Interest</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                        <form class="form-horizontal" name="frm_edit_interest" id="frm_edit_interest" action="<?php echo base_url(); ?>backend/edit-interest/<?php echo $arr_interest["interest_id"]; ?>" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest Name  :</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_interest["interest_name"]); ?>" id="interest_name" name="interest_name" class="form-control" >
                                        <input type="hidden" name="old_interest_name" id="old_interest_name" value="<?php echo stripslashes($arr_interest["interest_name"]); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Interest Status :</label>
                                    <div class="col-sm-9">
                                        <select id="interest_status" name="interest_status"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" <?php if ($arr_interest["interest_status"] == "1") { ?> selected="selected" <?php } ?>>Active</option>
                                            <option value="0" <?php if ($arr_interest["interest_status"] == "0") { ?> selected="selected" <?php } ?> >Inactive</option>
                                        </select>                                   
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/manage-interest';" >Back</button>
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
