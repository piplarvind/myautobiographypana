<html lang="en">
    <head>
        <title><?php echo stripslashes((isset($title)) ? $title : $global['site_title']); ?></title>
        <style>
            .error {
                color: #BD4247;
                margin-left: 140px;
                width: 210px;
            }
            div.error {
                color: #BD4247;
                margin-left: 140px;
                width: 500px;
            }
            .FETextInput{
                margin-left: 120px;
                margin-top: -28px;
            }
        </style>
    </head>
    <title><?php echo stripslashes((isset($title)) ? $title : $global['site_title']); ?></title>
    <?php $this->load->view('backend/sections/header'); ?>
    <script src="<?php echo base_url(); ?>media/backend/js/jquery.dataTables.min.js"></script> 
    <script src="<?php echo base_url(); ?>media/backend/js/bootstrap-tab.js"></script>
    <!-- library for advanced tooltip -->
    <script src="<?php echo base_url(); ?>media/backend/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>media/backend/js/charisma.js"></script> 
    <!-- validation js -->
    <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>
    <script type="text/javascript">
         function htmlEntities(str) {
                return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
                        }
        jQuery(document).ready(function(e) {
        /*Binding change event to lang_id selectbox */
        jQuery("#lang_id").bind("change", getLanguageVals);
                /*Gettig langauage values for the global settings parameter*/
                        function getLanguageVals()
                        {

                        if (jQuery(this).val() != "")
                        {
                        jQuery.post("<?php echo base_url(); ?>backend/global-settings/get-global-parameter-language", {lang_id:jQuery(this).val(), edit_id:<?php echo base64_decode($edit_id); ?>}, function(msg){
<?php if ($arr_global_settings['name'] == "site_logo") { ?>
                            jQuery("#param_value").val(msg.value);
                            jQuery("#logo_image").show();
                            jQuery("#logo_image").attr("src", "<?php echo base_url(); ?>media/backend/img/" + msg.value);
<?php } else {  ?>
                            jQuery("#value").val((msg.value));
<?php } ?>

                        }, "json");
                        }
                        }

                jQuery("#frm_edit_global_setting_parameter").validate({
                errorElement: "div",
                        rules: {
                lang_id:{
                required:true
                },
                        value:{
<?php if ($arr_global_settings['name'] != "site_logo") { ?>
                    required:true
<?php } ?>
<?php
if ($arr_global_settings['name'] == "site_email") {
    echo ",email:true";
}
if ($arr_global_settings['name'] == "contact_email") {
    echo ",email:true";
}
if ($arr_global_settings['name'] == "default_currency") {
    echo ",minlength:3";
    echo ",maxlength:3";
    echo ",lettersonly:true";
}
if ($arr_global_settings['name'] == "currency_symbol") {
    echo ",minlength:1";
    echo ",maxlength:1";
}
if ($arr_global_settings['name'] == "per_page_record") {
    echo ",number:true";
}
if ($arr_global_settings['name'] == "site_logo") {
    echo 'accept:"jpg|jpeg|png|gif"';
}
?>


                }
                },
                        messages:{
                lang_id:{
                required:"Please select language."
                },
                        value:{
<?php
if ($arr_global_settings['name'] == "site_email" || $arr_global_settings['name'] == "contact_email") {
    echo 'required:"Please enter email address."';
} else if ($arr_global_settings['name'] == "site_title") {
    echo 'required:"Please enter site title."';
} else if ($arr_global_settings['name'] == "date_format") {
    echo 'required:"Please select date format."';
} else if ($arr_global_settings['name'] == "default_currency") {
    echo 'required:"Please enter default currency."';
} else if ($arr_global_settings['name'] == "currency_symbol") {
    echo 'required:"Please enter currency symbol."';
} else if ($arr_global_settings['name'] == "per_page_record") {
    echo 'required:"Please enter per page record to display."';
} else if ($arr_global_settings['name'] == "default_meta_keyword") {
    echo 'required:"Please enter default meta keyword."';
} else if ($arr_global_settings['name'] == "default_meta_description") {
    echo 'required:"Please enter default meta description."';
}

if ($arr_global_settings['name'] == "site_email" || $arr_global_settings['name'] == "contact_mail") {
    echo ',email:"Please enter a valid email address."';
}

if ($arr_global_settings['name'] == "default_currency") {
    echo ',minlength:"Please enter only atlease three characters."';
    echo ',maxlength:"Please enter only atmost three characters."';
    echo ',lettersonly:"Please enter alphabetical characters."';
}

if ($arr_global_settings['name'] == "currency_symbol") {
    echo ',minlength:"Please enter only one character symbol."';
    echo ',maxlength:"Please enter only one character symbol."';
}
if ($arr_global_settings['name'] == "default_currency" || $arr_global_settings['name'] == "default_currency") {
    echo ',email:"Please enter a valid email address."';
}
if ($arr_global_settings['name'] == "per_page_record") {
    echo ',number:"Please enter valid number."';
}
if ($arr_global_settings['name'] == "site_logo") {
    echo 'accept:"Only jpg|jpeg|png|gif format allow."';
}
?>
                }
                }
                });
                        jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[A-Z]+$/i.test(value);
                }, "");
                });</script>
</head>
<body>
    <?php $this->load->view('backend/sections/top-nav.php'); ?>
    <?php $this->load->view('backend/sections/leftmenu.php'); ?>

    <div id="content" class="span10">
        <!--[breadcrumb]-->
        <div>
            <ul class="breadcrumb">
                <li> <a href="<?php echo base_url(); ?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
                <li> <a href="<?php echo base_url(); ?>backend/global-settings/list">Manage Global Settings</a> <span class="divider">/</span></li>
                <li> Edit Global Setting</li>
            </ul>
        </div>

        <div class="row-fluid sortable"> 
            <!--[sortable header start]-->
            <div class="box span12">
                <div class="box-header well">
                    <h2><i class=""></i>Update Global Setting</h2>
                    <div class="box-icon">
                        <a title="Manage Global Settings" class="btn btn-plus btn-round" href="<?php echo base_url(); ?>backend/global-settings/list"><i class="icon-arrow-left"></i></a>
                    </div>
                </div>
                <br >
                <!--[sortable body]-->
                <div class="box-content">
                    <form name="frm_edit_global_setting_parameter" id="frm_edit_global_setting_parameter" action="<?php echo base_url(); ?>backend/global-settings/edit-parameter-language/<?php echo $edit_id; ?>" method="POST"  enctype="multipart/form-data">

                        <input type="hidden" name="global_name_id" id="global_name_id" value="<?php echo $edit_id; ?>" />

                        <div class="control-group">
                            <label class="control-label" for="input_parameter_name">Parameter Name</label>
                            <div class="controls">
                                <input type="text" dir="ltr" readonly="readonly" style="margin-left:140px; margin-top:-28px" class="FETextInput" name="name" id="name" value="<?php echo ucwords(str_replace("_", " ", $arr_global_settings['name'])); ?>" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="input_language">Select Language<sup class="mandatory">*</sup></label>
                            <div class="controls">
                                <select id="lang_id" name="lang_id" style="margin-left:140px; margin-top:-28px">
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
                            <label class="control-label" for="input_parameter_value">Parameter Value<?php
                                 if ($arr_global_settings['name'] != "site_logo") {
                                ?><sup class="mandatory">*</sup><?php  }?></label>
                            <div class="controls">
                                <?php
#here are set some formate it can be changed according to need
                                if ($arr_global_settings['name'] == "date_format") {
                                    ?>
                                    <select name="value" id="value" style="margin-left:140px; margin-top:-28px">                                        
                                        <option <?php if ($arr_global_settings['value'] == "Y-m-d") { ?> selected="selected"<?php } ?> value="Y-m-d"><?php echo date("Y-m-d"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y/m/d") { ?> selected="selected"<?php } ?> value="Y/m/d"><?php echo date("Y/m/d"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y-m-d H:i:s") { ?> selected="selected"<?php } ?> value="Y-m-d H:i:s"><?php echo date("Y-m-d H:i:s"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y/m/d H:i:s") { ?> selected="selected"<?php } ?> value="Y/m/d H:i:s"><?php echo date("Y-m-d H:i:s"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "F j, Y, g:i a") { ?> selected="selected"<?php } ?> value="F j, Y, g:i a"><?php echo date("F j, Y, g:i a"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "m.d.y") { ?> selected="selected"<?php } ?> value="m.d.y"><?php echo date("m.d.y"); ?></option>
                                        <option value="" selected="selected">Select Date Format</option>
                                    </select>	
                                    <?php
                                } elseif ($arr_global_settings['name'] == "site_logo") {
                                    ?>
                                    <input type="hidden"  name="name" id="name" value="site_logo">
                                    <input  dir="ltr" style="margin-left:140px; margin-top:-20px" class="FETextInput" id="value" name="value" type="file" onchange="readURL(this);">
                                    <input type="hidden" name="value" id="param_value" value="<?php echo htmlentities(stripslashes($arr_global_settings['value'])); ?>">
                                    <br><br><br><br>
                                    <img width="100" height="100" src="<?php echo base_url(); ?>media/backend/img/<?php echo stripslashes($arr_global_settings['value']); ?>" id="logo_image" title="image" style="margin-left: 142px; margin-top: -20px;display: none;"> 

                                    <?php
                                } else {
                                    ?>
                                    <input type="text" dir="ltr" style="margin-left:140px; margin-top:-28px" class="FETextInput" name="value" id="value" value="" />
                                    <?php
                                }
                                ?>	
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" name="btn_submit" class="btn btn-primary" value="Save changes">Save changes</button>
                            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                            <input type="hidden" name="store_id" value="<?php echo intval(base64_decode($store_id)); ?>">
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

