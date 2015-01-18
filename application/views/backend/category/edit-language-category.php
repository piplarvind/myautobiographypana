<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title) ? $title : ''; ?>- Admin Panel</title>
        <?php $this->load->view('backend/sections/header.php'); ?>
        <script src="<?php echo base_url(); ?>media/backend/js/jquery.validate.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate_img.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/edit-category-lang.js"></script>
        <script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script> 
        <style>
            .error {
                color: #BD4247;
                margin-left: 170px;
                width: 210px;
            }
            .FETextInput{
                margin-left: 170px;
                margin-top: -28px;
            }
        </style>
        <script type="text/javascript" language="javascript">
            jQuery(document).ready(function() {

                jQuery("#lang_id").bind("change", getLanguageVals);
                jQuery("#lang_id").change();

                function getLanguageVals()
                {
                    if (jQuery(this).val() != "")
                    {
                        jQuery.post("<?php echo base_url(); ?>backend/categories/get-language-for-categories", {lang: jQuery(this).val(), category_id:<?php echo $edit_id; ?>}, function(msg) {
                            jQuery("#inputName").val(msg.category_name);
                            jQuery("#inputPageTitle").val(msg.page_title);
                            jQuery("#inputPageKeywords").val(msg.page_keywords);
                            jQuery("#inputPageDescription").val(msg.page_keyword_content);
                            jQuery("#is_inserted").val(msg.is_inserted);
                        }, "json");
                    }

                }
            });

        </script>
    </head>
    <body>
        <?php $this->load->view('backend/sections/top-nav.php'); ?>
        <?php $this->load->view('backend/sections/leftmenu.php'); ?>
        <div id="content" class="span10">
            <!--[breadcrumb]-->
            <div>
                <ul class="breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>backend/home">Dashboard</a> <span class="divider">/</span> </li>
                    <li> <a href="<?php echo base_url(); ?>backend/category/list/<?php echo $store_id; ?>">Manage Category</a> <span class="divider">/</span> </li>
                    <li> Add Language Category</li>
                </ul>
            </div>

            <!--[message box]-->
            <?php if ($this->session->userdata('msg') != '') { ?>
                <div class="msg_box alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                    <?php echo $this->session->userdata('msg'); ?> </div>
                <?php $this->session->unset_userdata('msg');
            }
            ?>

            <div class="row-fluid sortable"> 
                <!--[sortable header start]-->
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2>Manage Category Language</h2>
                        <div class="box-icon"> 
                            <a href="<?php echo base_url(); ?>backend/category/list/<?php echo $store_id; ?>" class="btn btn-round" title="Manage Category">
                                <i class="icon-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    <br >
                    <!--[sortable body]-->
                    <div class="box-content">
                        <div class="box-content">
                            <div>
                                <FORM name="frmCatLang" id="frmCatLang" action="<?php echo base_url(); ?>backend/categories/edit-category-language/<?php echo $arr_Category['category_id']; ?>/<?php echo $store_id; ?>" method="POST" enctype="multipart/form-data">
                                    <div class="control-group">
                                        <label class="control-label" for="inputName">Select Language<sup class="mandatory">*</sup></label>
                                        <div class="controls">
                                            <select id="lang_id" name="lang_id" style="margin-top:-30px;" class="FETextInput">
                                                <option value="">Select Language</option>
                                                <?php
                                                foreach ($arr_languages as $language) {
                                                    ?>
                                                    <option value="<?php echo $language['lang_id']; ?>"><?php echo $language['lang_name']; ?></option><?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="news_title">Category Name<sup class="mandatory">*</sup></label>
                                        <div class="controls">
                                            <input type="text" dir="ltr"  class="FETextInput" name="inputName" id="inputName" value="" size="80"   />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="news_title">Category Title<sup class="mandatory">*</sup></label>
                                        <div class="controls">
                                            <input type="text" dir="ltr"  class="FETextInput" name="inputPageTitle" id="inputPageTitle" value="" size="80"   />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="news_text">Category Mete Keyword<sup class="mandatory">*</sup></label>
                                        <div class="controls">
                                            <textarea  name="inputPageKeywords" id="inputPageKeywords" class="FETextInput"></textarea>

                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="news_text">Category Mete Description<sup class="mandatory">*</sup></label>
                                        <div class="controls">
                                            <textarea  name="inputPageDescription" id="inputPageDescription" class="FETextInput"></textarea>

                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" name="btnSubmit" class="btn btn-primary" value="Save changes">Save changes</button>
                                        <input type="hidden" name="category_id" value="<?php echo $arr_Category['category_id']; ?>">
                                        <input type="hidden" name="is_inserted" id="is_inserted" value="">
                                    </div>
                                </FORM>
                            </div>
                        </div>
                    </div>
                    <!--[sortable body]--> 
                </div>
            </div>
            <!--[sortable table end]--> 
            <!--[include footer]-->
        </div>
        <!--including footer here-->
<?php $this->load->view('backend/sections/footer.php'); ?>
    </body>
</html>
