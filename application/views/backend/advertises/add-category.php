<style type="text/css">
    .error {
        color: #bd4247;

    }
    .validationError{
        color: #bd4247;
    }   
</style>

<?php
$status = '';
if (isset($arr_ads_categories[0]['category_id']) && count($arr_ads_categories[0]['category_id']) > 0) {
    $status = 'Update';
    $edit_id = $arr_ads_categories[0]['category_id'];
} else {
    $status = 'Add';
}
?>


<script type="text/javascript" language="javascript">
    var j = jQuery.noConflict();
    j(document).ready(function () {
        j("#frm_advertise_category").validate({
            errorElement: 'div',
            errorClass: 'validationError',
            rules: {
                input_name: {
                    required: true,
                    minlength: 3,
                    remote: {
                        url: j("#base_url").val() + "backend/advertise-check-duplicate-category-name", method: "post",
                        data: {
                            action: j("#status").val(), edit_id: j("#edit_id").val()
                        },
                        async: false
                    }
                }
            },
            messages: {
                input_name: {
                    required: "Please enter name of category",
                    minlength: "Please enter at least 3 characters",
                    remote: "This category name is already exists!"
                }
            },
            // set this class to error-labels to indicate valid fields
            success: function (label) {
                // set &nbsp; as text for IE
                label.hide();
            }
        });
    });
</script>
JS;

<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <?php if (isset($edit_id) && $edit_id != '') { ?>  <h1>Update Advertise Category</h1> <?php } else { ?><h1>Add Advertise Category </h1> <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_advertise_category" id="frm_advertise_category" action="<?php echo base_url(); ?>backend/add-advertise-category" method="POST" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <input type="hidden" id="status" name="status" value="<?php echo $status; ?>">
                                <input type="hidden" id="edit_id" name="edit_id" value="<?php echo $edit_id; ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Name  :</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo isset($arr_ads_categories[0]['category_name']) ? $arr_ads_categories[0]['category_name'] : ''; ?>" id="input_name" name="input_name" class="form-control" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/advertise-categories';" >Back</button>
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







