

<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/edit-userB.js"></script>



<div class="st-container">
    <div class="chat-window-container"></div>
    <div class="st-pusher" id="content">
        <div class="st-content">
            <!--[message box]-->
            <?php
            $msg = $this->session->userdata('msg');
            ?>
            <!--[message box]-->
            <?php if ($msg != '') { ?>
                <div class="msg_box alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                    <?php
                    echo $msg;
                    $this->session->unset_userdata('msg');
                    ?> 
                </div>
                <?php }
            ?>
            <div class="st-content-inner">

                <div class="container-fluid">
                    <h1>Add Student</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <!--<div class="panel-heading panel-heading-gray">Elements</div>-->
                                <div class="panel-body">

                                     <form enctype="multipart/form-data" name="upload_user" id="upload_user" action="<?php echo base_url();?>bulk-upload-User-action" method="POST">
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
                        </div>

                    </div>

                    
                </div>
            </div>
        </div>
    </div> 
    <!-- Footer -->
                    <?php $this->load->view('front/includes/ui2-footer'); ?>

                    <!-- // Footer -->
</div>


<!-- Vendor Scripts Bundle -->
<script src="<?php echo base_url();?>media/front/UI-2-media/js/vendor.min.js"></script>

    <!-- App Scripts Bundle -->
    <script src="<?php echo base_url();?>media/front/UI-2-media/js/scripts.min.js"></script>
        <script src="<?php echo base_url();?>media/front/UI-2-media/js/jquery.metisMenu.js"></script>
    
<script>
	$(function() {

    $('#side-menu').metisMenu();

});
</script>
    
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
