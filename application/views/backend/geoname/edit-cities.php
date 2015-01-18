<style type="text/css">
    .error 
    {
        color: #bd4247;
    }

    .validationError
    {
        color: #bd4247;
    }   
</style>
<script src="<?php echo base_url(); ?>media/backend/js/geoname/edit-cities.js"></script>
<script type="text/javascript">
    function selectStates(country_id)
    {
        var obj_params = new Object();
        obj_params.country_id = country_id;
        jQuery.post("<?php echo base_url(); ?>backend/cities/select-states", obj_params, function (msg) {
            $("#state_id").html("")
            console.log(msg);
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
            <h1>Update City</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_cities" id="frm_edit_cities" action="<?php echo base_url(); ?>backend/edit-cities/<?php echo base64_encode($arr_cities['geoname_id']); ?>" method="POST" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Country Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="country_id" name="country_id"   onchange = "selectStates(this.value)"  class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach ($arr_country as $country) { ?>
                                                <option value="<?php echo $country['country_id']; ?>"<?php if ($arr_cities["country_name"] == $country["country_name"]) { ?> selected="selected" <?php } ?>  > <?php echo $country['country_name']; ?> </option>
                                            <?php } ?>
                                        </select>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >State Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="state_id" name="state_id"   class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach ($arr_states as $states) { ?>
                                                <option value="<?php echo $states['state_id']; ?>"  <?php if ($arr_cities["state_id"] == $states["state_id"]) { ?> selected="selected" <?php } ?>   > <?php echo $states['state_name']; ?> </option>
                                            <?php } ?>
                                        </select>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >City Name :<em>*</em> </label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_cities["city_name"]; ?>" id="city_name" name="city_name" class="form-control" >
                                        <input type="hidden"  name="old_city_name" value="<?php echo $arr_cities["city_name"]; ?>" id="old_city_name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >City Status :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="city_status" name="city_status"   class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" <?php if ($arr_cities["status"] == "1") { ?> selected="selected" <?php } ?>  >Active</option>
                                            <option value="0" <?php if ($arr_cities["status"] == "0") { ?> selected="selected" <?php } ?> >Inactive</option>
                                        </select>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/manage-cities';" >Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
             <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>






