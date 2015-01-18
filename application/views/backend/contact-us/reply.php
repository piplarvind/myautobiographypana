

<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>


<script type="text/javascript" language="javascript">
    var j = jQuery.noConflict();
    j(document).ready(function () {
        j("#form_reply").validate({
            errorElement: 'div',
            errorClass: 'validationError',
            rules: {
                to: {required: true, email: true},
                from_name: {required: true},
                from_email: {required: true, email: true},
                subject: {required: true},
                message: {required: true}
            },
            messages: {
                to: {required: 'Please enter the message to email id.'},
                from_name: {required: 'Please enter message from name.'},
                from_email: {required: 'Please enter from email.'},
                subject: {required: 'Please enter message subject.'},
                message: {required: 'Please enter message.'}
            },
            submitHandler: function (form) {


                var html = j("#cke_productdescription iframe").contents().find("body").html();
                var div = document.createElement("div");
                div.innerHTML = html;
                var text = div.textContent || div.innerText || "";

                /* console.log(text);
                 console.log(text.length);
                 
                 
                 
                 var valLen = (jQuery.trim(jQuery("#cke_productdescription iframe").contents().find("body").html())).length;
                 
                 console.log(valLen);
                 return false; */

                //if((jQuery.trim(jQuery("#cke_productdescription iframe").contents().find("body").html())).length < 12)
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
                    filebrowserUploadUrl: '<?php echo base_url(); ?>media/backend/editor-image-upload'
                });

    });
</script>  
<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }   
</style>
<body>


    <div class="st-content" id="content">
        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">
            <div class="container-fluid">
                <h1>Reply Message
                    <a title="Manage Conatct Us" class="btn btn-plus btn-round" href="<?php echo base_url(); ?>backend/contact-us"><i class="icon-arrow-left"></i></a>
                </h1>

                <div class="row">
                    <div class="col-md-9">

                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-gray">&nbsp;</div>

                            <div class="panel-body">

                                <form class="form-horizontal" name="form_reply" id="form_reply" action="<?php echo base_url() . 'backend/contact-us/reply/' . base64_encode($arr_contact[0]['contact_id']); ?>" method="post">
                                    <input type="hidden" name="contact_id" value="<?php echo $arr_contact[0]['contact_id']; ?>">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >To: </label>
                                        <div class="col-sm-9">
                                            <input readonly="readonly" type="text" size="80" value="<?php echo stripslashes($arr_contact[0]['contact_email']); ?>" name="to" id="to" class="form-control"  dir="ltr">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >From Name :<em>*<em></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" size="80" value="<?php echo stripslashes($global['site_title']); ?>" name="from_name" id="from_name"  class="form-control" dir="ltr">
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label" >From Email :<em>*<em></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" size="80" value="<?php echo stripslashes($global['contact_email']); ?>" name="from_email" id="from_email" class="form-control"  dir="ltr">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label" >Subject :<em>*<em></label>
                                                        <div class="col-sm-9">
                                                            <input type="text" size="80" value="<?php echo 'Reply:' . stripslashes($arr_contact[0]['contact_subject']); ?>" name="subject"  class="form-control" dir="ltr">                                
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label" >Message :<em>*<em></label>
                                                        <div class="col-sm-9">
                                                            <textarea class="ckeditor" id="productdescription" name="message" ><?php echo stripslashes($arr_cms_details[0]['page_content']); ?></textarea>
                                                            <div class="error hidden" id="labelProductError">Please enter message</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-primary" name="btnSubmit" value="Save changes">Send</button> 
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

