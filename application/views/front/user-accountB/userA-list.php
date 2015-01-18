<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/userA-list.js"></script>
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
                        <?php echo $msg;
                        $this->session->unset_userdata('msg'); ?> 
                    </div>
                <?php } ?>
                <!--[message box]-->
                <h1>Student List</h1>
                <div class="add-user-holder relative-position">


                    <div class="add-user-inn">
                        <a class="btn btn-primary upload-demo" href="<?php echo base_url() ?>media/front/upload_user_format.xls">Upload a dummy excel template here for the correct format</a>

                        <div class="panel panel-default">

                            <div class="panel-body">

                                <form enctype="multipart/form-data" class="form-horizontal add-new-user-frm" name="upload_user" id="upload_user" action="<?php echo base_url(); ?>bulk-upload-User-action" method="POST">
                                    <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">

                                    <div class="media">
                                        <span class="pull-right"> <input type="submit" onclick="javascript:chkFile();
                                                    return false;" name="upload_cat" id="upload_cat" class="btn btn-primary" value="Upload"></span>
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="control-group contol-lbl-padding0">

                                                    <label for="typeahead" class="col-sm-4 control-label">Select File:<sup class="mandatory">*</sup> </label>
                                                    <div class="col-xs-12 col-sm-8">
                                                        <input type="file" id="file_source" name="file_source" class="FETextInput"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Email</th>
                                    <th>Status</th
                                    ></tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Email</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
<?php foreach ($arr_userA['userA_approved'] as $userA_details_approved) { ?>
                                    <tr>
                                        <td><a href="<?php echo base_url(); ?><?php echo $userA_details_approved['user_name'] ?>"><?php echo $userA_details_approved['first_name'] ?></a></td>
                                        <td><?php echo $userA_details_approved['last_name'] ?></td>
                                        <td><?php echo $userA_details_approved['user_email'] ?></td>
                                        <td>Approved</td>
                                    </tr>
                                <?php } ?>
<?php foreach ($arr_userA['userA_pending'] as $userA_details) { ?>
                                    <tr>
                                        <td><a href="javascript:void(0);"><?php echo $userA_details['first_name'] ?></a></td>
                                        <td><?php echo $userA_details['last_name'] ?></td>
                                        <td><?php echo $userA_details['user_email'] ?></td>
                                        <td>Pending</td>
                                    </tr>
<?php } ?>


                            </tbody>
                        </table>
                    </div>

                    <!-- // Data table -->
                </div>

            </div>
        </div>
    </div>
</div>

<!-- /st-container -->