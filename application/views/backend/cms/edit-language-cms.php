<!DOCTYPE html>
<html lang="en">   
    <head>
        <title><?php echo stripslashes((isset($title)) ? $title : $global['site_title']); ?></title>
        <?php $this->load->view('backend/sections/header'); ?>        
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.min.js"></script>
        
        <script src="<?php echo base_url();?>media/backend/js/ckeditor/ckeditor.js"></script>  
        
        <script type="text/javascript" language="javascript">
    /* add admin Js */
    jQuery(document).ready(function() {


        /*Binding change event to lang_id selectbox */
        jQuery("#lang_id").bind("change", getLanguageVals);
        /*Gettig langauage values for the cms*/
        function getLanguageVals()
        {
            if (jQuery(this).val() != "")
            {
                jQuery.post("<?php echo base_url(); ?>backend/cms/get-cms-language", {lang_id: jQuery(this).val(), edit_id:<?php echo ($edit_id); ?>}, function(msg) {
                   
					
                    jQuery("#cms_page_title").val(msg.page_title);
					
                    jQuery("#cms_page_seo_title").val(msg.page_seo_title);
					
                    jQuery("#cms_page_meta_keywords").val(msg.page_meta_keyword);
					
                    jQuery("#cms_page_meta_description").val(msg.page_meta_description);
																		CKEDITOR.instances.productdescription.setData(msg.page_content)
					
                }, "json");
            } else {
           
            }
        }

        jQuery("#frm_edit_cms_form").validate({
            errorElement: 'div',
            rules: {
                lang_id: {
                    required: true
                },
                cms_page_title: {
                    required: true
                },
                status: {
                    required: true
                },
				cms_page_seo_title:{
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
                lang_id: {
                    required: "Please select language."
                },
                cms_page_title: {
                    required: "Please enter cms page title."
                },
                status: {
                    required: "Please select cms page status."
                },
                cms_page_meta_keywords: {
                    required: "Please mention page meta keywords."
                },
				cms_page_seo_title:{
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
			submitHandler:function(form){
			
				if((jQuery.trim(jQuery("#cke_productdescription iframe").contents().find("body").html())).length<12)
				{
					jQuery("#labelProductError").removeClass("hidden");
					jQuery("#labelProductError").show();
				}
				else{
					jQuery("#labelProductError").addClass("hidden");
				form.submit();	
				}
			}
        });
        
       
    });
</script> 
        <style>
            .error {
                color: #BD4247;
                width: 210px;
            }
            .FETextInput{
                margin-left: 120px;
                margin-top: -28px;
            }
			
			.form-horizontal .control-label {
				float: left;
				padding-top: 5px;
				text-align: right;
				width: 140px;
			}
        </style>

    </head>
    <body>
        <?php $this->load->view('backend/sections/top-nav.php'); ?>
        <?php $this->load->view('backend/sections/leftmenu.php'); ?>

        <div id="content" class="span10">
            <!--[breadcrumb]-->
            <div>
                <ul class="breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
                    <li> <a href="<?php echo base_url(); ?>backend/cms">Manage CMS</a> <span class="divider">/</span></li>
                    <li> Update CMS</li>
                </ul>
            </div>

            <div class="row-fluid sortable"> 
                <!--[sortable header start]-->
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class=""></i>Update CMS</h2>
                        <div class="box-icon">
                            <a title="Manage CMS" class="btn btn-plus btn-round" href="<?php echo base_url(); ?>backend/cms"><i class="icon-arrow-left"></i></a>
                        </div>
                    </div>
                    <br >
                    <!--[sortable body]-->
                    <div class="box-content">
                        <form name="frm_edit_cms_parameter" id="frm_edit_cms_form" class="form-horizontal" action="<?php echo base_url(); ?>backend/cms/edit-cms-language/<?php echo $edit_id; ?>" method="POST">

                            <input type="hidden" name="cms_id" id="cms_id" value="<?php echo $edit_id; ?>" />

                            <div class="control-group">
                                <label class="control-label" for="input_language">Select Language :<sup class="mandatory">*</sup></label>
                                <div class="controls">
                                    <select id="lang_id" name="lang_id">
                                        <option value="">Select Language</option>
                                        <?php
                                        foreach ($arr_languages as $language) {
                                            ?>
                                            <option value="<?php echo $language['lang_id']; ?>"><?php echo $language['lang_name']; ?></option><?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">CMS Page Title :<sup class="mandatory">*</sup></label>
                                <div class="controls">
                                    <input type="text" name="cms_page_title" id="cms_page_title" >
                                </div>
                            </div>   

                            <div class="control-group">
                                <label class="control-label" for="textarea2">Cms Page Content :</label>    
                                <div class="controls">
                                    <textarea class="ckeditor" id="productdescription" name="content" ></textarea>
                                       <div class="error hidden" id="labelProductError">Please enter cms content</div>
                                </div>
                            </div>  

                            <legend> Meta Details</legend>

                            <div class="control-group">
                                <label class="control-label">Page SEO Title :<sup class="mandatory">*</sup></label>
                                <div class="controls">
                                    <textarea name="cms_page_seo_title" id="cms_page_seo_title" rows="5" cols="20" style=" width: 350px;"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Meta Keywords :<sup class="mandatory">*</sup></label>
                                <div class="controls">
                                    <textarea name="cms_page_meta_keywords" id="cms_page_meta_keywords" rows="5" cols="20"  style=" width: 350px;"></textarea> 
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Meta Description :<sup class="mandatory">*</sup></label>
                                <div class="controls">
                                    <textarea name="cms_page_meta_description" id="cms_page_meta_description" rows="5" cols="20"  style=" width: 350px;"></textarea>                        			 
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" name="btn_submit" class="btn btn-primary" value="Save changes">
                                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                            </div>
                        </form>
                    </div>
                    <!--[sortable body]--> 
                </div>
            </div>

            <!--[sortable table end]--> 

            <!--[include footer]-->
        </div><!--/#content.span10-->

    </div><!--/fluid-row-->
    <?php $this->load->view('backend/sections/footer.php'); ?>       
</div>

</body>
</html>


