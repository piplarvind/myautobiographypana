

<style type="text/css">
    .error{color:bd4247;}
     .validationError{
                color: #bd4247;
            }  
</style>
<script type="text/javascript">
var J = jQuery.noConflict();
        J(document).ready(function(e) { 
            
    J.validator.addMethod("emailspecialchars", function (value, element) {
        return value.match(new RegExp(/^[0-9a-z_A-Z.@s]+$/));
    }, "Please enter only letters, numbers, @ , _ and (.) dot.");
    
        J("#frm_edit_global_setting_parameter").validate({
        errorElement: "div",
          errorClass: 'validationError',
                rules: {
        lang_id:{
        required:true
        },
                value:{
               
<?php if ($arr_global_settings['name'] != "site_logo") { ?>
            required:true
<?php }
?>

<?php
if ($arr_global_settings['name'] == "site_email") {
    echo ",email:true";
    echo ",emailspecialchars:true";
}
if ($arr_global_settings['name'] == "contact_email") {
    echo ",email:true";
    echo ",emailspecialchars:true";
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
if ($arr_global_settings['name'] == "developers_email") {
    echo ",required:true";
    echo ",email:true";
    echo ",emailspecialchars:true";
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
    echo 'required:"Please enter an email address."';
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
} else if ($arr_global_settings['name'] == "developers_email") {
    echo 'required:"Please enter email address."';
    echo ',email:"Please enter valid email address."';
}else if ($arr_global_settings['name'] == "fb_app_id") {
    echo 'required:"Please enter FB App Id."';
} else if ($arr_global_settings['name'] == "fb_secret_key") {
    echo 'required:"Please enter FB Secret Key."';
} else if ($arr_global_settings['name'] == "address_1") {
    echo 'required:"Please enter Address 1 ."';
} else if ($arr_global_settings['name'] == "address_2") {
    echo 'required:"Please enter Address 2 ."';
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
    echo 'accept:"Only jpg|jpeg|png|gif formats are allowed."';
}
?>
        }
        }
        });
                jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[A-Z]+$/i.test(value);
        }, "");
        });</script>


<div class="st-content" id="content">

                <!-- extra div for emulating position:fixed of the menu -->
                <div class="st-content-inner">
                    <div class="container-fluid">
                        <h1>Update Global Setting Parameter</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading panel-heading-gray">&nbsp;</div>
                                    <div class="panel-body">
                                        <form name="frm_edit_global_setting_parameter" class="form-horizontal" id="frm_edit_global_setting_parameter" action="<?php echo base_url(); ?>backend/global-settings/edit/<?php echo $edit_id; ?>/<?php echo $lang_id; ?>/<?php echo store_id; ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="global_name_id" id="global_name_id" value="<?php echo $edit_id; ?>" />
                        <input type="hidden" name="lang_id" id="lang_id" value="<?php echo $lang_id; ?>" />
                        
                         <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Parameter Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" readonly="readonly" id="name" value="<?php echo ucwords(str_replace("_", " ", $arr_global_settings['name'])); ?>"  id="inputEmail3" placeholder="Type here..">
                                                </div>
                                            </div>
                        
                  
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputQuestion">Parameter Value :<?php
                                 if ($arr_global_settings['name'] != "site_logo") {
                                     ?><em>*</em><?php  }?></label>
                            <div class="col-sm-9">
                                <?php
                                if ($arr_global_settings['name'] == "date_format") {
                                    #here are set some formate it can be changed according to need
                                    ?>
                                    <select name="value" id="value" style="margin-left:140px; margin-top:-28px">
                                        <option <?php if ($arr_global_settings['value'] == "Y-m-d") { ?> selected="selected"<?php } ?> value="Y-m-d"><?php echo date("Y-m-d"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y/m/d") { ?> selected="selected"<?php } ?> value="Y/m/d"><?php echo date("Y/m/d"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y-m-d H:i:s") { ?> selected="selected"<?php } ?> value="Y-m-d H:i:s"><?php echo date("Y-m-d H:i:s"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "Y/m/d H:i:s") { ?> selected="selected"<?php } ?> value="Y/m/d H:i:s"><?php echo date("Y/m/d H:i:s"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "F j, Y, g:i a") { ?> selected="selected"<?php } ?> value="F j, Y, g:i a"><?php echo date("F j, Y, g:i a"); ?></option>
                                        <option <?php if ($arr_global_settings['value'] == "m.d.y") { ?> selected="selected"<?php } ?> value="m.d.y"><?php echo date("m.d.y"); ?></option>
                                    </select>	
                                    <?php } elseif ($arr_global_settings['name'] == "site_logo") {?>
                                    <input type="hidden"  name="name" id="name" value="site_logo">
                                    <input  dir="ltr" style="" class="form-control" id="value" name="value" type="file" accept="image/*" onchange="readURL(this);">
                                    <input type="hidden" name="value" value="<?php echo stripslashes($arr_global_settings['value']); ?>">
                                    <br><br><br><br>
                                    <img width="100" height="100" src="<?php echo base_url(); ?>media/backend/img/<?php echo stripslashes($arr_global_settings['value']); ?>" id="front_image_tag_id" title="image" style="margin-left: 142px; margin-top: -20px;"> 
                                    <?php } else { ?>
                                    <input type="text" dir="ltr" style="" class="form-control" name="value" id="value" value="<?php echo htmlentities(stripslashes($arr_global_settings['value'])); ?>" />
                                    <?php }?>	
                            </div>
                        </div>
                         <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-primary" value="Save changes">Save changes</button>
                                                     <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                            <input type="hidden" name="store_id" value="<?php echo intval(base64_decode($store_id)); ?>">
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


