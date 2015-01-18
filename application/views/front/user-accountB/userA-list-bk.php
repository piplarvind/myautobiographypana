
<!-- Wrapper required for sidebar transitions -->
<div class="user-list">

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
                            <li><a href="<?php echo base_url();?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i> My Timeline</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo base_url();?>logout"> Logout<i class="fa fa-fw fa-sign-out"></i></a>
                            </li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
                 </nav>

            <!-- extra div for emulating position:fixed of the menu -->
            <!--[message box]-->
            <?php $msg = $this->session->userdata('msg'); ?>
            <?php if ($msg != '') { ?>
                <div class="msg_box alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                    <?php echo $msg; $this->session->unset_userdata('msg'); ?> 
                </div>
            <?php } ?>
            <!--[message box]-->
                <div class="container-fluid">

                    <h1>Student List</h1>
                    
                  
                    
                    <div class="add-user-holder relative-position">
                     
                        
                        <div class="add-user-inn">
                          <a class="btn btn-primary upload-demo" href="<?php echo base_url()?>media/front/upload_user_format.xls">Upload Users Demo Format</a>

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
                    <div class="panel panel-default">


                        <!-- Data table -->
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
                                        <td><a href="<?php echo base_url(); ?>profile/<?php echo $userA_details_approved['user_name'] ?>"><?php echo $userA_details_approved['first_name'] ?></a></td>
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

                        <!-- // Data table -->
                    </div>
                </div>
            </div>

            <!-- /st-content-inner -->
        </div>

        <!-- /st-content -->
    </div>

    <!-- /st-pusher -->
</div>

<!-- /st-container -->

<script type="text/javascript">
    function chkFile()
    {
        if (document.getElementById('file_source').value == "")
        {
            alert('Please select the File');
            return false;
        }
        else
        {
            var file_xl = document.getElementById('file_source').value;
            var ext = file_xl.split('.');
            if (ext[1] == 'xls' || ext[1] == 'XLS' || ext[1] == 'XLSx' || ext[1] == 'xlsx' || ext[1] == 'csv' || ext[1] == 'CSV')
            {
                document.upload_product.submit();
            }
            else
            {
                alert('Please select xls File only');
                return false;
            }
        }
    }
</script>