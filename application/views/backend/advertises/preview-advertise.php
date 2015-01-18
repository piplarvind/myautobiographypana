
<style type="text/css">
    .error {
        color: #bd4247;
    }
</style>
<script src="<?php echo base_url(); ?>media/backend/js/jquery.timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>

<script type="text/javascript" language="javascript">
    var j = jQuery.noConflict();
    j(document).ready(function () {
        /*datepicker start here*/
        d = new Date();
        j('#start_date_id').datetimepicker({
            minDate: new Date(d.getFullYear(), d.getMonth(), d.getDate(), d.getHours(), d.getMinutes()),
            dateFormat: 'yy-mm-dd',
            timeFormat: 'hh:mm TT',
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                selectedDate = selectedDate.replace('-', '/');
                selectedDate = selectedDate.replace('-', '/');
                var d = new Date(selectedDate);

                j("#end_date_id").datetimepicker({
                    minDate: new Date(d.getFullYear(), d.getMonth(), d.getDate() + 1, d.getHours(), d.getMinutes()),
                    //minDate: new Date(selectedDate),
                    dateFormat: 'yy-mm-dd',
                    timeFormat: 'hh:mm TT',
                    changeMonth: true,
                    changeYear: true
                });


            }
        });


        /*datepicker start end*/
        j("#frm_advertise").validate({
            errorElement: 'label',
            rules: {
                input_title: {
                    required: true,
                    minlength: 3
                },
                select_category: {required: true},
                input_image: {required: true, accept: "jpg|jpeg|png|ico|bmp|gif"},
                textarea_script: {required: true},
                input_redirect_url: {required: true, url: true},
                input_start_date: {required: true},
                input_end_date: {required: true},
                size: {required: true},
                input_advertise_position: {required: true},
            },
            messages: {
                input_title: {
                    required: "Please enter title of advertise",
                    minlength: "Please enter at least 3 characters"
                },
                select_category: {required: "Please select category"},
                input_image: {required: "Please select advertise image"},
                textarea_script: {required: "Please enter script."},
                input_redirect_url: {required: "Please enter redirect URL."},
                input_start_date: {required: "Please select start date"},
                input_end_date: {required: "Please select end date"},
                size: {required: "Please select size"},
                input_advertise_position: {required: "Please select position"},
                input_image:{
                    required: "Please select image",
                    accept: "Please select image with extention 'jpg|jpeg|png|ico|bmp|gif'"
                }
            },
            // set this class to error-labels to indicate valid fields
            success: function (label) {
                // set &nbsp; as text for IE
                label.hide();
            },
            submitHandler: function (form) {
                var var_bool = false;

                j(".page_class").each(function (index, element) {
                    if (j(element).is(":checked"))
                        var_bool = true;
                });


                if (var_bool == true) {
                    j('form').find(":submit").attr("disabled", true).attr("value", "Submitting...");
                    form.submit();
                } else {
                    alert("Please select at least one page.");
                }
            }
        });

        j("#select_ads_type_id").change(function () {
            if (j(this).val() == 'Image') {
                j("#image_section_id").show();
                j("#script_section_id").hide();
            } else {
                j("#image_section_id").hide();
                j("#script_section_id").show();
            }
        });

    });

</script>

<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Preview Advertise</h1>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_advertise" id="frm_advertise" action="<?php echo base_url(); ?>backend/add-advertise" method="POST" enctype="multipart/form-data" >
                                <div class="form-group" style="min-width: 50%; float: left;min-height: 300px;">
                                    <label for="inputEmail3" class="col-sm-3 control-label"> <h2>Upper Side :</h2> </label>
                                    <?php if (isset($arr_relational_page[0]['position_id']) && intval($arr_relational_page[0]['position_id']) == 1) { ?>
                                        <div class="col-sm-9">
                                            <?php
                                            if ($arr_advertise[0]['image_name'] != '') {
                                                list($w, $h) = getimagesize('media/front/img/advertise/' . $arr_advertise[0]['image_name']);
                                                if ($w > 300)
                                                    $w = 200;
                                                if ($h > 300)
                                                    $h = 300;
                                                ?>
                                                <img src="<?php echo base_url() . 'media/front/img/advertise/' . $arr_advertise[0]['image_name']; ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>" <?php
                                                if ($arr_advertise[0]['advertise_alt_text'] != '') {
                                                    echo 'alt="' . $arr_advertise[0]['advertise_alt_text'] . '"';
                                                } if ($arr_advertise[0]['title'] != '') {
                                                    echo 'title="' . $arr_advertise[0]['title'] . '"';
                                                }
                                                ?>>                                
                                                     <?php
                                                 } else {
                                                     echo stripslashes(stripslashes($arr_advertise[0]['script']));
                                                 }
                                                 ?>                                    
                                        </div>
                                    <?php } ?>
                                    </div>
                                   <div class="form-group" style="min-width: 50%; float: right;min-height: 300px;" >
                                    <label for="inputEmail3" class="col-sm-3 control-label"> <h2>Lower Side :</h2> </label>
                            <?php if (isset($arr_relational_page[0]['position_id']) && intval($arr_relational_page[0]['position_id']) == 2) { ?>
                                        <div class="col-sm-9">
                                          <?php
                                        if ($arr_advertise[0]['image_name'] != '') {
                                            list($w, $h) = getimagesize('media/front/img/advertise/' . $arr_advertise[0]['image_name']);
                                            if ($w > 300)
                                                $w = 200;
                                            if ($h > 300)
                                                $h = 300;
                                            ?>
                                            <img src="<?php echo base_url() . 'media/front/img/advertise/' . $arr_advertise[0]['image_name']; ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>" <?php
                                            if ($arr_advertise[0]['advertise_alt_text'] != '') {
                                                echo 'alt="' . $arr_advertise[0]['advertise_alt_text'] . '"';
                                            } if ($arr_advertise[0]['title'] != '') {
                                                echo 'title="' . $arr_advertise[0]['title'] . '"';
                                            }
                                            ?>>                                
                                                 <?php
                                             } else {
                                                 echo stripslashes(stripslashes($arr_advertise[0]['script']));
                                             }
                                             ?>                            
                                        </div>
                                    <?php } ?>
                                    </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/advertises';" >Back</button>
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







