<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }       
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/add-timeline-comment.js"></script>
<div class="st-content" id="content">

    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Add Comment</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_add_comment" id="frm_add_comment" action="<?php echo base_url(); ?>backend/categories/add-timeline-comment/<?php echo $timeline_id ; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Comment :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" value="" id="comment" name="comment" class="form-control"  ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Comment Image/Video :</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" id="comment_file" name="comment_file">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="timeline_id" id="timeline_id" value="<?php echo base64_decode($timeline_id ); ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="history.go(-1);" >Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
               <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>
