<style type="text/css">
    .error {
        color: #bd4247;

    }
     .validationError{
        color: #bd4247;
    }   
</style>
<link href="<?php echo base_url(); ?>media/backend/css/jquery.cleditor.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>media/backend/js/ckeditor/ckeditor.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/edit-category.js"></script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit <?php echo stripslashes($arr_Category[0]['parent_category']); ?></h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_category_details" id="frm_edit_category_details" action="<?php echo base_url(); ?>backend/categories/edit-category" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <input type="hidden" id="main_cat_name" name="main_cat_name" value="<?php echo (strtolower($arr_Category[0]['parent_category'])); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ><?php echo stripslashes($arr_Category[0]['parent_category']); ?> Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_Category[0]['category_name']); ?>" id="category_name" name="category_name" class="form-control" >
                                        <input type="hidden"  name="old_category_name" id="old_category_name" class="FETextInput" value="<?php echo $arr_Category[0]['category_name']; ?>">
                                    </div>
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Parent Category :</label>
                                                                    <div class="col-sm-9">
                                                                        <select id="parent_category" name="parent_category"  class="form-control">
                                                                            <option value="0">No Parent</option>
                                <?php
                                foreach ($arr_all_categories as $category) {
                                    if ($category['parent_id'] == 0) {
                                        ?>
                                                                                            <option value="<?php echo $category['category_id']; ?>" <?php if ($arr_Category[0]['parent_id'] == $category['category_id']) { ?> selected="selected" <?php } ?>><?php echo $category['category_name']; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                                                                        </select>                    
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ><?php echo stripslashes($arr_Category[0]['parent_category']); ?> Image :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="category_image" id="category_image" >
                                        <input type="hidden"  name="old_filename" id="old_filename" value="<?php echo stripslashes($arr_Category[0]['category_image']); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-9" >
                                        <image src="<?php echo base_url(); ?>media/front/img/category-images/thumbs-for-backend/<?php echo $arr_Category[0]['category_image']; ?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo stripslashes($arr_Category[0]['parent_category']); ?> Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_Category[0]['page_title']); ?>" id="category_title" name="category_title" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo stripslashes($arr_Category[0]['parent_category']); ?> Meta Keywords :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea  id="meta_keyword" style="resize: none"   name="meta_keyword" class="form-control" ><?php echo stripslashes($arr_Category[0]['page_keywords']); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo stripslashes($arr_Category[0]['parent_category']); ?> Meta Description :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea  id="productdescription"  id="text-content" name="text_content"  class="form-control ckeditor" ><?php echo stripslashes($arr_Category[0]['page_description']); ?></textarea>
                                        <div class="error hidden" id="labelProductError">Please enter template content</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ><?php echo stripslashes($arr_Category[0]['parent_category']); ?> URL :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_Category[0]['page_url']); ?>" id="category_url" name="category_url" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="parent_cat" id="parent_cat" value="<?php echo $parent_category; ?>"/>
                                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $arr_Category[0]['category_id']; ?>"/>
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $arr_Category[0]['parent_id']; ?>"/>
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/category/list/<?php echo $arr_Category[0]['parent_id']; ?>';" >Back</button>
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
