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
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/add-category.js"></script>
<div class="st-content" id="content">

    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Add <?php echo $category; ?> </h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_category_details" id="frm_category_details" action="<?php echo base_url(); ?>backend/categories/add-category" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <input type="hidden" id="main_cat_name" name="main_cat_name" value="<?php echo strtolower($category); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo $category; ?> Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="category_name" name="category_name" class="form-control" >
                                    </div>
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label for="inputEmail3" class="col-sm-3 control-label" >Parent Category :</label>
                                                                    <div class="col-sm-9">
                                                                        <select id="parent_category" name="parent_category"   class="form-control">
                                                                            <option value="0">No Parent:</option>
                                <?php
                                // foreach ($arr_all_categories as $category) {
//                                                if ($category['parent_id'] == 0) {
                                ?>
                                                                                    <option value="<?php // echo $category['category_id']; ?>"><?php // echo $category['category_name']; ?></option>
                                <?php // }
//                                                                } 
                                ?>
                                                                        </select>                      
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo $category; ?> Image :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="file" name="category_image" id="category_image"  >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo $category; ?> Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="category_title" name="category_title" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo $category; ?> Meta Keywords :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea  id="meta_keyword" style="resize: none"  name="meta_keyword" class="form-control"  ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo $category; ?> Meta Description :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea   id="productdescription"  id="text-content" name="text_content" class="form-control ckeditor" ></textarea>
                                        <div class="error hidden" id="labelProductError">Please enter template content</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo $category; ?> URL :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="category_url" name="category_url" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="parent_category" id="parent_category" value="<?php echo $category; ?>">
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id; ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/category/list/<?php echo $parent_id; ?>';" >Back</button>
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
