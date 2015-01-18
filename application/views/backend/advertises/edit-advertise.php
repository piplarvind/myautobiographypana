<style type="text/css">
    .error {
        color: #bd4247;
       
    }
     .validationError{
        color: #bd4247;
    }   
</style>
<script src="<?php echo base_url(); ?>media/backend/js/jquery.timepicker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/advertise/edit-advertise.js"></script>
<script type="text/javascript" language="javascript">
   
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
        });
</script>



<script type = "text/javascript" >
    function selectType() {
        var type = $('#select_ads_type_id').val();
        if (type == 'Image') {
            $("#image_section_id").show();
            $("#script_section_id").hide();
        } else {
            $("#image_section_id").hide();
            $("#script_section_id").show();
        }
    }
</script>

<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Advertise</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_advertise" id="frm_advertise" action="<?php echo base_url(); ?>backend/edit-advertise/<?php echo ($arr_advertise[0]['advertise_id']); ?>" method="POST" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <input type="hidden" name="hidden_image" value="<?php echo $arr_advertise[0]['image_name']; ?>">
                                <input type="hidden" name="hidden_update_id" value="<?php echo base64_encode($arr_advertise[0]['advertise_id']); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <?php
                                        $title = $arr_advertise[0]['title'];
                                        ?>
                                        <input type="text" value="<?php echo stripslashes($title); ?>" id="input_title" name="input_title" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Select category :</label>
                                    <div class="col-sm-9">
                                        <select id="select_category" name="select_category[]" multiple="multiple" title="Hold the CTRL key to select multiple categories" class="form-control">
                                            <option value="">--Select--</option>
                                            <?php
                                            foreach ($arr_advertise_category as $key => $value) {
                                                $selected = in_array($value['category_id'], $arr_relational_cat) ? 'selected="selected"' : '';
                                                echo '<option value="' . $value['category_id'] . '" ' . $selected . '>' . $value['category_name'] . '</option>';
                                            }
                                            ?>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Select advertise type :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="select_ads_type_id" name="select_ads_type_id" onchange="selectType()" class="form-control">
                                            <option value="Image" <?php
                                            if ($arr_advertise[0]['advertise_type'] == 'Image') {
                                                echo 'selected="selected"';
                                            }
                                            ?>>Image</option>
                                            <option value="Script" <?php
                                            if ($arr_advertise[0]['advertise_type'] == 'Script') {
                                                echo 'selected="selected"';
                                            }
                                            ?>>Script</option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Select advertise page :<em>*</em></label>
                                    <div class="col-sm-9">

                                        <?php
                                        $checked = '';
                                        foreach ($arr_advertise_pages as $key => $value) {
                                            $checked = in_array($value['page_id'], $arr_relational_page) ? 'checked="checked"' : '';
                                            echo '<div class="checkbox">
                                              <label><input type="checkbox" class="page_class" name="input_advertise_page[' . $value['page_id'] . ']" value="' . $value['page_id'] . '" ' . $checked . '>' . ucwords($value['page_name']) . '</label>
                                              </div>';
                                        }
                                        ?>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Select page position :<em>*</em></label>
                                    <div class="col-sm-9"  >
                                        <?php
                                        $checked = '';
                                        foreach ($arr_advertise_position as $key => $value) {
                                            $checked = ($arr_position == $value['position_id']) ? 'checked="checked"' : '';
                                            echo '<div class="radio"><label><input type="radio"  name="input_advertise_position" value="' . $value['position_id'] . '"' . $checked . '>' . ucwords($value['position_name']) . '</label></div>';
                                        } ?>   
                                         <div class="validationError" for="input_advertise_position" generated="true"></div>
                                    </div>
                                </div>
                                <div id="script_section_id" <?php
                                if ($arr_advertise[0]['advertise_type'] == 'Image') {
                                    echo 'style="display: none;"';
                                }
                                ?>>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Enter Script :</label>
                                        <div class="col-sm-9">
                                            <textarea id="textarea_script" name="textarea_script" class="form-control"  ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Previous Script :</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control"  >  <?php echo stripslashes($arr_advertise[0]['script']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $arr_sizes = array('medium rectangle *300-250' => 'Medium rectangle (300x250)',
                                    'large rectangle *300-400' => 'Large rectangle (240x400)');
                                ?>
                                <div id="image_section_id"  <?php
                                if ($arr_advertise[0]['advertise_type'] == 'Script') {
                                    echo 'style="display: none;"';
                                }
                                ?>>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Select Size:</label>
                                        <div class="col-sm-9">
                                            <select id="size" name="size" onchange="size_one(this);"   class="form-control">
                                                <option value="">--Select size--</option>
                                                <?php foreach ($arr_sizes as $key => $value) { ?>
                                                    <option value="<?php echo $key; ?>" <?php
                                                    if ($arr_advertise[0]['advertise_size'] == $key) {
                                                        echo 'selected="selected"';
                                                    }
                                                    ?> ><?php echo $value; ?></option>
                                                        <?php } ?>   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Select Image :</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" name="input_image" id="input_image"  onchange="showimagepreview(this);">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        list($w, $h) = getimagesize('media/front/img/advertise/' . $arr_advertise[0]['image_name']);
                                        if ($w > 300)
                                            $w = 200;
                                        if ($h > 300)
                                            $h = 300;
                                        ?>
                                        <label for="inputEmail3" class="col-sm-3 control-label">Advertise Image :</label>
                                        <div class="col-sm-9">
                                            <img src="<?php echo base_url() . 'media/front/img/advertise/' . $arr_advertise[0]['image_name']; ?>" width="<?php echo $w; ?>" height="<?php echo $h; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Redirect URL:</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="<?php echo urldecode($arr_advertise[0]['redirect_url']); ?>" name="input_redirect_url" id="input_redirect_url" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Start Date :</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="readonly" name="input_start_date" id="start_date_id"  value="<?php echo date('Y-m-d H:i', strtotime($arr_advertise[0]['expired_start_date'])); ?>" class="datepicker form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >End Date :</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="readonly" name="input_end_date" id="end_date_id"  value="<?php echo date('Y-m-d H:i', strtotime($arr_advertise[0]['expired_end_date'])); ?>"  class="datepicker form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Status :</label>
                                    <div class="col-sm-9">
                                        <select id="select_status" name="select_status"   class="form-control">
                                            <option value="Active" <?php
                                            if ($arr_advertise[0]['status'] == 'Active') {
                                                echo 'selected="selected"';
                                            }
                                            ?>>Active</option>                                        
                                            <option value="Inactive" <?php
                                            if ($arr_advertise[0]['status'] == 'Inactive') {
                                                echo 'selected="selected"';
                                            }
                                            ?>>Inactive</option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
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

<script type="text/javascript">
    $(document).ready(function () {
        var size = $('#size').val();
        var split = size.split('-');
        var name = split[0];
        window.height = split[1];
        var split_one = name.split('*');
        window.width = split_one[1];
        ;
    });
    function size_one(dropdown) {
        var location = dropdown.options[dropdown.selectedIndex].value;
        var split = location.split('-');

        var name = split[0];
        window.height = split[1];
        var split_one = name.split('*');
        window.width = split_one[1];
    }

    var _URL = window.URL || window.webkitURL;
    $("#input_image").change(function (e) {
        var file, img;
        var width = window.width;
        var height = window.height;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function () {
                if (this.width != width && this.height <= height) {
                    $('#input_image').replaceWith($('#input_image').val('').clone(true));
                    alert("Please upload image of " + width + "px width and " + height + "px height.");
                }

            };
            img.src = _URL.createObjectURL(file);
        }
    });

    function showimagepreview(input) {
        var file_name = input.files[0]['name'];
        var arr_file = new Array();
        arr_file = file_name.split('.');
        var file_ext = arr_file[1];
        switch (file_ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'JPG':
            case 'JPEG':
            case 'PNG':
            case 'GIF':
                break;
            default:
                $('#input_image').replaceWith($('#input_image').val('').clone(true));
                alert('Please upload a file only of type jpg,jpeg,gif,png.');
                return true;

        }
        var file_size = input.files[0]['size'];
        if (file_size > Math.round(parseInt(5242880))) {
            $('#input_image').replaceWith($('#input_image').val('').clone(true));
            alert('Please upload a file less than 5 MB.');

            return  true;
        }

        if (input.files && input.files[0]) {
            var filerdr = new FileReader();
            filerdr.onload = function (e) {
                $('#imgprvw' + file_number).attr('src', e.target.result);
            }
            filerdr.readAsDataURL(input.files[0]);
        }
    }
</script>    



