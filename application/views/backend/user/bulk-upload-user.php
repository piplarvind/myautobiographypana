<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo stripslashes((isset($title)) ? $title : $global['site_title']); ?></title>
        <?php $this->load->view('backend/sections/header'); ?>
        <style>
            .error {
                color: #BD4247;
                margin-left: 120px;
                width: 250px;
            }
            .FETextInput{
                margin-left: 120px;
                margin-top: -28px;
                width: 250px;
            }
        </style>
        
        <script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>
    
    </head>
    <body>
        <?php $this->load->view('backend/sections/top-nav.php'); ?>
        <?php $this->load->view('backend/sections/leftmenu.php'); ?>
        <div id="content" class="span10">
            <!--[breadcrumb]-->
            <div>
                <ul class="breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
                    <li> <a href="<?php echo base_url(); ?>backend/user-a/list">Manage User A</a> <span class="divider">/</span></li>
                    <li> Add User A </li>
                </ul>
            </div>
            
            <!--[message box]-->
            <?php $msg = $this->session->userdata('msg'); ?>
            <!--[message box]-->
            <?php if($msg != ''){ ?>
                <div class="msg_box alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                    <?php echo $msg; $this->session->unset_userdata('msg'); ?> 
                </div>
            <?php } ?> 
            
            
            <div class="row-fluid sortable"> 
                <!--[sortable header start]-->
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class=""></i>Add User A</h2>
                        <div class="box-icon">
                            <a title="Manage User A" class="btn btn-plus btn-round" href="<?php echo base_url(); ?>backend/user-a/list"><i class="icon-arrow-left"></i></a>
                        </div>
                    </div>
                    <br >
                    <!--[sortable body]-->
                    <div class="box-content">
                        <form enctype="multipart/form-data" name="upload_user" id="upload_user" action="<?php echo base_url();?>backend/User/bulk-upload-User-action" method="POST">
                            <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                            
                            <div class="control-group">
                                <label for="typeahead" class="control-label">Select File:<sup class="mandatory">*</sup> </label>
                                <div class="controls">
                                    <input type="file" id="file_source" name="file_source" class="FETextInput"/>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <input type="submit" onclick="javascript:chkFile(); return false;" name="upload_cat" id="upload_cat" class="btn btn-primary" value="Upload">
                            </div>                
                        </form>
                    </div>
                </div>
                <!--[sortable body]--> 
            </div>
        </div>
        <!--[sortable table end]--> 
        <!--[include footer]-->
    </div><!--/#content.span10-->
    <?php $this->load->view('backend/sections/footer.php'); ?>
</body>
</html>
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
            if(ext[1] == 'xls' || ext[1] == 'XLS' || ext[1] == 'XLSx' || ext[1] == 'xlsx' || ext[1] == 'csv' || ext[1] == 'CSV')
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