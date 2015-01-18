<style type="text/css">
    .error {
        color: #bd4247;
    }
     .validationError{
        color: #bd4247;
    }   
</style>
<script src="<?php echo base_url(); ?>media/backend/js/geoname/edit-states.js"></script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Update State</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                        <form class="form-horizontal" name="frm_edit_states" id="frm_edit_states" action="<?php echo base_url(); ?>backend/edit-states/<?php echo base64_encode($arr_states["geoname_id"]); ?>" method="POST" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Country Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="country_id" name="country_id" class="form-control">
                                            <option value="">Select</option>
                                           <?php foreach($arr_country as $country  ) { ?>
                                           <option value="<?php echo $country['country_id'] ; ?>"  <?php if ($arr_states["country_name"] == $country["country_name"]) { ?> selected="selected" <?php } ?> > <?php echo $country['country_name']; ?> </option>
                                               <?php } ?>
                                        </select>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">State Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_states['geoname'] ?>" id="state_name" name="state_name" class="form-control" >
                                        <input type="hidden"  name="old_state_name" value="<?php echo $arr_states['geoname'] ?>" id="old_state_name" size="1000"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">States Status :<em>*</em></label>
                                  <div class="col-sm-9">
                                        <select id="state_status" name="state_status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" <?php if ($arr_states["status"] == "1") { ?> selected="selected" <?php } ?> >Active</option>
                                            <option value="0" <?php if ($arr_states["status"] == "0") { ?> selected="selected" <?php } ?> >Inactive</option>
                                        </select>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/manage-states';" >Back</button>
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