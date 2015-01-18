
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
                    <h1>Edit institutional brownies</h1>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="panel panel-default">
                                <!--<div class="panel-heading panel-heading-gray">Elements</div>-->
                                <div class="panel-body">

                                    <form class="form-horizontal" name="edit_institutional_brownies_form" id="edit_institutional_brownies_form" action="<?php echo base_url(); ?>edit-institutional-brownies/<?php echo $category_id?>" method="post" enctype="multipart/form-data">   
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Category Name:</label>
                                            <div class="col-sm-9">
                                                <input name="category_name" class="form-control" id="category_name" type="text" size="17" maxlength="30" value="<?php echo stripslashes($arr_institutional_brownies_details[0]['category_name']); ?>">
                                                <input name="old_category_name" class="form-control" id="old_category_name" type="hidden" size="17" maxlength="30" value="<?php echo stripslashes($arr_institutional_brownies_details[0]['category_name']); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Category image:</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="category_image" id="category_image" >
                                                <!--<input type="file" id="category_image" name="category_image" value="<?php echo base_url() ?>media/front/img/category-images/<?php // echo $arr_institutional_brownies_details[0]['category_image'] ?>">-->
                                                <input type="hidden" id="old_filename" name="old_filename" value="<?php echo $arr_institutional_brownies_details[0]['category_image'] ?>">
                                            </div>
                                        </div>  
                                        
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                            <div class="col-sm-9" >
                                                <image src="<?php echo base_url(); ?>media/front/img/category-images/thumbs-for-backend/<?php echo $arr_institutional_brownies_details[0]['category_image']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Page title:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="category_title" name="category_title" value="<?php echo stripslashes($arr_institutional_brownies_details[0]['page_title']); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Page keywords:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="<?php echo stripslashes($arr_institutional_brownies_details[0]['page_keywords']); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Page description:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?php echo stripslashes($arr_institutional_brownies_details[0]['page_description']); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>">
                                                <input type="submit"  class="btn btn-primary" name="regi_step1_btn"  value="edit brownies" id="regi_step1_btn">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Footer -->
                    <?php $this->load->view('front/includes/ui2-footer'); ?>

                    <!-- // Footer -->
                </div>
            </div>
        </div>
    </div>    
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
