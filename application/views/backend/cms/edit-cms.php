
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
        j("#edit_cms_form").validate({
            errorElement: 'div',
            errorClass: 'validationError',
            rules: {
                cms_page_title: {
                    required: true
                },
                status: {
                    required: true
                },
                cms_page_seo_title: {
                    required: true
                },
                cms_page_meta_keywords: {
                    required: true
                },
                cms_page_meta_description: {
                    required: true
                },
                cms_page_meta_content: {
                    required: true
                }
            },
            messages: {
                cms_page_title: {
                    required: "Please enter cms page title."
                },
                status: {
                    required: "Please select cms page status."
                },
                cms_page_meta_keywords: {
                    required: "Please enter page meta keywords."
                },
                cms_page_seo_title: {
                    required: "Please enter seo page title."
                },
                cms_page_meta_description: {
                    required: "Please enter page meta description."
                },
                cms_page_meta_content: {
                    required: "Please enter page meta content."
                }
            }
            ,
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
</script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1> Edit Cms Page</h1>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="edit_cms_form" id="edit_cms_form" action="<?php echo base_url(); ?>backend/cms/edit-cms/<?php echo $arr_cms_details[0]['cms_id']; ?>" method="post">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">


                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">CMS Page Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?php echo $arr_cms_details[0]['page_title']; ?>" id="cms_page_title" name="cms_page_title" placeholder="Type here..">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Cms Page Content :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor form-control" id="productdescription" name="content" dir="ltr"  style="width:100%" ><?php echo $arr_cms_details[0]['page_content']; ?></textarea> 
                                        <div class="error hidden" id="labelProductError">Please enter cms content</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Status :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="status" name="status"  class="form-control">
                                            <option value=""> -- Select Status -- </option>
                                            <option value="Published"   <?php if ($arr_cms_details[0]['status'] == "Published") { ?> selected="selected" <?php } ?> > Published</option>
                                            <option value="Unpublished" <?php if ($arr_cms_details[0]['status'] == "Unpublished") { ?> selected="selected" <?php } ?> >Unpublished</option>
                                        </select>                                   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"> Page SEO Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" class="form-control" id="cms_page_seo_title" name="cms_page_seo_title" rows="5" cols="20" dir="ltr"   ><?php echo $arr_cms_details[0]['page_seo_title']; ?></textarea> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Meta Keywords :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" class="form-control" id="cms_page_meta_keywords" name="cms_page_meta_keywords" rows="5" cols="20" dir="ltr"  ><?php echo $arr_cms_details[0]['page_seo_title']; ?></textarea> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Meta Description :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" class="form-control" id="cms_page_meta_description" name="cms_page_meta_description" rows="5" cols="20" dir="ltr"  ><?php echo $arr_cms_details[0]['page_seo_title']; ?></textarea> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_update_newsletter" name= "btn_update_newsletter" value="Submit">Update</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/cms';" >Back</button>
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







