<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }   
</style>
<link href="<?php echo base_url(); ?>media/backend/css/jquery.cleditor.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
    var j = jQuery.noConflict();

    j(document).ready(function () {
        j("#frm_email_template").validate({
            errorElement: 'label',
            errorClass: 'validationError',
            rules: {
                input_subject: {
                    required: true
                },
                text_content: {
                    required: true
                }
            },
            messages: {
                input_subject: {
                    required: "Please enter the email template subject."
                },
                text_content: {
                    required: "Please enter the email template content."
                }
            },
            submitHandler: function (form) {

                if ((j.trim(j("#cke_productdescription iframe").contents().find("body").html())).length < 12)
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

    // here inserting text to ckeditor after double click.
    function insertText(obj) {
        var text_to_add = obj.value;
        CKEDITOR.instances.productdescription.insertText(text_to_add)
        //var editor = $('.ckeditor').cleditor()[0];
        CKEDITOR.focus();
        setTimeout(function () {
            //editor.execCommand('inserthtml', text_to_add, false);
        }, 0);
    }

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
            <h1>Edit Email Template</h1>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_email_template" id="frm_email_template" action="<?php echo base_url(); ?>backend/edit-email-template/<?php echo(isset($email_template_id)) ? $email_template_id : ''; ?>" method="POST" >
                                <input type="hidden" name="email_template_hidden_id" id="email_template_hidden_id" value="<?php echo(isset($email_template_id)) ? $email_template_id : ''; ?>">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Template Title : </label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="" value="<?php echo ucwords(str_replace("-", " ", $arr_email_template_details['email_template_title'])); ?>" id="inputTitle" name="inputTitle" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Template Subject :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo str_replace("\n", "", $arr_email_template_details['email_template_subject']); ?>" id="input_subject" name="input_subject" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Template Content  :<em>*</em> </label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor"  id="productdescription"  id="text_content" name="text_content" dir="ltr"   ><?php echo stripcslashes($arr_email_template_details['email_template_content']); ?></textarea>   
                                        <div class="error hidden" id="labelProductError">Please enter template content</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Template Content Macros (Double Click on the macro to insert it into the email template):</label>
                                    <div class="col-sm-9"> 
                                        <select  class="form-control" multiple ondblclick="insertText(this)">
                                              <?php foreach ($macros_array_detail as $macros_info) { ?> 
                                            <option value="<?php echo $macros_info['macros']; ?>"> <?php echo $macros_info['macros'] . ":-"; ?> <?php echo ucwords(str_replace("_", " ", strtolower(trim($macros_info['macros'], '||')))); ?></option> 
                                             <?php } ?> 
                                        </select>
                                    </div> 
                                 </div> 
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-9"> 
                                        <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                        <div class="col-sm-offset-3 col-sm-9" style="margin-left: 160px; width: 300px;">
                                            <button type="submit" class="btn btn-primary" id= "btnSubmit" name= "btnSubmit" value="Submit">Update</button>
                                            <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/email-template/list';" >Back</button>
                                        </div>
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







