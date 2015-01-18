<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/upload-banner-userB.js"></script>

<div class="st-container edit-prof">
    <div class="chat-window-container"></div>
    <div class="st-pusher" id="content">
        <div class="st-content">
            
            <div class="st-content-inner">
                <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
                    <div class="container-fluid">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="fa fa-ellipsis-h"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="subnav">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo base_url(); ?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                                <li><a href="<?php echo base_url(); ?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right hidden-xs">
                                <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a>
                                </li>
                            </ul>
                        </div>

                        <!-- /.navbar-collapse -->
                    </div>
                </nav>
                <div class="container-fluid">
                    <!--[message box]-->
                    <?php
                    $msg = $this->session->userdata('msg');
                    ?>
                    <!--[message box]-->
                    <?php if ($msg != '') { ?>
                        <div class="msg_box alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                            <?php
                            echo $msg;
                            $this->session->unset_userdata('msg');
                            ?> 
                        </div>
                    <?php }
                    ?>
                    <h1>Add Banner</h1>
                    <div class="row">
                        <div class="col-md-10 col-xs-12">
                            <div class="panel panel-default">
                                <!--<div class="panel-heading panel-heading-gray">Elements</div>-->
                                <div class="panel-body">

                                    <form class="form-horizontal" name="upload_banner_userB" id="upload_banner_userB" action="<?php echo base_url(); ?>institute/banner" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Banner title:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="banner_title" class="form-control" id="banner_title" type="text" size="17"  >
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Banner text:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="banner_text" class="form-control" id="banner_text" type="text" size="17"  >
                                            </div>
                                        </div>


                                        <div class="form-group contol-lbl-padding0">
                                            <label  class="col-sm-3 control-label">Banner image:</label>
                                            <div class="col-sm-9 prof-pic-holder">
                                                <input type="file" id="banner_image" name="banner_image"  onchange="showimagepreviews(this);
                                                        readURL(this);"  >
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Banner Url:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="banner_url " name="banner_url" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Banner status :<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="banner_status" name="banner_status" >
                                                    <option value=''> Select status </option>
                                                    <option value="1"> Active </option>
                                                    <option value="0"> InActive </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input type="submit" class="btn btn-primary" name="upload_banner" value="Add banner" id="upload_banner">
                                                <input type="button" class="btn btn-danger" onclick="history.go(-1);" name="back" value="back" id="back">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>

<div class="modal fade" id="TermsConditionsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog show-terms">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
            <div id="show_terms">
                <p><?php echo stripslashes($arr_terms_condtion['page_content']); ?></p>
            </div>
        </div>

    </div>
</div>

<script>
    function showimagepreviews(input) {
        var file_name = input.files[0]['name'];
        var size = input.files[0]['size'];
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
                $('#upload_cover_photo').replaceWith($('#upload_cover_photo').val('').clone(true));
                alert('Please upload a file only of type jpg,jpeg,gif,png.');
                return true;
        }
        if (size <= 1000000)
        {
            $('#danger').html("Please select maximum 500kb file to upload.");
            alert('Please select maximum 1Mb and 851X180 dimensional file to upload.');
        }
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>