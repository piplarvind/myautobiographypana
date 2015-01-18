
<style type="text/css">
    .error {
        color: #bd4247;
        
    }
</style>
<link href="<?php echo base_url(); ?>media/backend/css/jquery.cleditor.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script> 
        <script type="text/javascript">
             var j = jQuery.noConflict();
             
            j(document).ready(function(e) {
                j('#btn_cancel').click(function() {
                    window.location = "<?php echo base_url(); ?>backend/newsletter/list";
                });
                j("#frm_add_newsletter").validate({
                    errorElement: 'div',
                    errorClass: 'validationError',
                    rules: {
                        input_subject:
                                {
                                    required: true,
                                    minlength: 3
                                }
                    },
                    messages: {
                        input_subject: {
                            required: "Please enter newsletter subject.",
                            minlength: "Please enter at least 3 characters."
                        }
                    },
                    submitHandler: function(form) {
                        var html = j("#cke_productdescription iframe").contents().find("body").html();
                        var div = document.createElement("div");
                        div.innerHTML = html;
                        var text = div.textContent || div.innerText || "";

                        if (text.length < 12)
                        {
                            j("#labelProductError").removeClass("hidden");
                            j("#labelProductError").show();
                        }
                        else {
                            j("#labelProductError").addClass("hidden");
                            form.submit();
                        }
                    }
                });
                CKEDITOR.replace('productdescription',
                        {
                            filebrowserUploadUrl: '<?php echo base_url(); ?>media/backend/editor-image'
                        });
            });
</script>
        <style type="text/css">
            .validationError{
                color: #bd4247;
            }            
        </style>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Newsletter</h1>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                    <form class="form-horizontal" name="frm_add_newsletter" id="frm_add_newsletter" action="<?php echo base_url(); ?>backend/newsletter/edit/<?php echo $arr_newsletter_data['newsletter_id']; ?>" method="post" >
                        <input type="hidden" name="newsletter_id" id="newsletter_id" value="<?php echo $arr_newsletter_data['newsletter_id']; ?>">
                        <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Subject :<em>*</em> </label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_newsletter_data['newsletter_subject']); ?>" id="input_subject" name="input_subject" class="form-control" >
                                        <?php echo form_error('input_subject'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Content :<em>*</em> </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control ckeditor" id="productdescription" name="input_content" dir="ltr"   ><?php echo set_value('input_content'); ?><?php echo stripslashes($arr_newsletter_data['newsletter_content']); ?></textarea>                                        <?php echo form_error('input_subject'); ?>
                                        <div class="error hidden" id="labelProductError">Enter Message length should be greater than 12 .</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_update_newsletter" name= "btn_update_newsletter" value="Submit">Update</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/newsletter/list';" >Back</button>
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







