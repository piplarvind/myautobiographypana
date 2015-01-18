

<!-- Wrapper required for sidebar transitions -->
<div id="content" class="st-pusher">
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

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
            </nav>

            <div class="container-fluid edit-prof">

                <!--[message box]-->
                <?php $msg = $this->session->userdata('msg'); ?>
                <?php if ($msg != '') { ?>
                    <div class="msg_box alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                        <?php
                        echo $msg;
                        $this->session->unset_userdata('msg');
                        ?> 
                    </div>  
                <?php } ?>
                <!--[message box]-->
                <h1>Banner Management</h1>
                <div class="add-user-holder relative-position">


                    <div class="add-user-inn">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form enctype="multipart/form-data" class="form-horizontal add-new-user-frm" name="banner_management" id="banner_management" action="<?php echo base_url(); ?>institute/banner-management" method="POST">
                                    <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                    <div class="media">
                                        <span class="pull-right"> <input type="button" onclick="window.location.href = '<?php echo base_url(); ?>institute/banner';" name="upload_cat" id="upload_cat" class="btn btn-primary" value="Add Banner"></span>
                                        <!--                                        <div class="media-body">
                                                                                    <div class="row">
                                                                                        <div class="control-group contol-lbl-padding0">
                                                                                            <label for="typeahead" class="col-sm-4 control-label">Select File:<sup class="mandatory">*</sup> </label>
                                                                                            <div class="col-xs-12 col-sm-8">
                                                                                                <input type="file" id="file_source" name="file_source" class="FETextInput"/>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default user-list-table">
                    <!-- Data table -->
                    <div class="table-responsive">
                        <table id="data-table" class="table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Banner Title</th>
                                    <th>Banner Url</th>
                                    <th>Banner Image</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Banner Title</th>
                                    <th>Banner Url</th>
                                    <th>Banner Image</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($arr_banner as $banner) { ?>
                                    <tr>
                                        <td><?php if(strlen($banner["banner_title"])>20) { echo stripslashes(substr($banner["banner_title"],0,20))  ; }else{ echo stripslashes($banner["banner_title"]) ;} ?></td>
                                        <td><?php echo stripslashes($banner["banner_url"]); ?></td>
                                        <td><img src="<?php echo base_url(); ?>media/front/img/banner-images/thumbs/<?php echo ($banner["banner_image"]); ?>" alt="<?php echo ($banner["banner_image"]); ?>" width="283" height="60"/>  </td>
                                        <td> <div id="active_div<?php echo $banner['banner_id']; ?>"<?php if ($banner['banner_status'] == '1') { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                                <a class="label label-success" title="Click to Change Status" onClick="changeBannerStatus('<?php echo $banner['banner_id']; ?>', '0');" href="javascript:void(0);" id="status_<?php echo $banner['banner_id']; ?>">Active</a>
                                            </div>
                                            <div id="inactive_div<?php echo $banner['banner_id']; ?>" <?php if ($banner['banner_status'] == '0') { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                                <a class="label label-danger" title="Click to Change Status" onClick="changeBannerStatus('<?php echo $banner['banner_id']; ?>', '1');" href="javascript:void(0);" id="status_<?php echo $banner['banner_id']; ?>">Inactive</a>
                                            </div></td>
                                                     <!--<td><?php echo ($banner["banner_status"]); ?></td>-->
                                        <td><?php echo date($global["date_format"], strtotime($banner["created_on"])); ?></td>
                                        <td><a  title="Edit Banner" class="btn btn-info" href="<?php echo base_url(); ?>institute/edit-banner/<?php echo base64_encode($banner['banner_id']); ?>">
                                                <i class="icon-edit icon-white"></i>Edit</a>
                                        <a  title="Edit Banner" class="btn btn-danger" href="<?php echo base_url(); ?>institute/delete-banner/<?php echo base64_encode($banner['banner_id']); ?>">
                                                <i class="icon-edit icon-white"></i>Delete</a> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- // Data table -->
                </div>
                <script type="text/javascript">

                    function changeBannerStatus(banner_id, banner_status)
                    {
                        /* changing the user status*/
                        var obj_params = new Object();
                        obj_params.banner_id = banner_id;
                        obj_params.banner_status = banner_status;
                        jQuery.post("<?php echo base_url(); ?>institute/banner/change-status", obj_params, function (msg) {
                            if (msg.error == "1")
                            {
                                alert(msg.error_message);
                            }
                            else
                            {
                                /* togling the Active and Inactive div of user*/
                                if (banner_status == '0')
                                {
                                    $("#inactive_div" + banner_id).css('display', 'inline-block');
                                    $("#active_div" + banner_id).css('display', 'none');
                                }
                                else
                                {
                                    $("#active_div" + banner_id).css('display', 'inline-block');
                                    $("#inactive_div" + banner_id).css('display', 'none');
                                }
                            }
                        }, "json");
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<!-- /st-container -->