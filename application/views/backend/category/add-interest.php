<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError {
        color: #bd4247;
    }  
</style>
<link href="<?php echo base_url(); ?>media/backend/css/jquery.cleditor.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/add-interest.js"></script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Add Interest </h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_category_details" id="frm_category_details" action="<?php echo base_url(); ?>backend/categories/add-interest/<?php echo $parent_id."/".$arr_other_interest[0]["temp_interest_id"];  ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div id="other_interest" <?php if(!empty($arr_other_interest)){ ?> style="display: block" <?php }else {?> style="display: none" <?php } ?>>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >User Name :</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="readonly" value="<?php echo $arr_other_interest[0]["first_name"]." ".$arr_other_interest[0]["last_name"] ; ?>"  id="user_name" name="user_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Other Interest Name :</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly="readonly" value="<?php echo stripslashes( $arr_other_interest[0]["comment"]) ; ?>" id="other_interest_name" name="other_interest_name" class="form-control" >
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="category_name" name="category_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest Image :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="category_image" id="category_image"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="category_title" name="category_title" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest Meta Keywords :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea  id="meta_keyword" style="resize: none"  name="meta_keyword" class="form-control"  ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest Meta Description :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea   id="productdescription"  id="text-content" name="text_content" class="form-control ckeditor" ></textarea>
                                        <div class="error hidden" id="labelProductError">Please enter template content</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Interest URL :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="category_url" name="category_url" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo base64_decode($parent_id); ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url() ; ?>backend/categories/list-interest/<?php echo base64_encode("18") ; ?>';" >Back</button>
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
