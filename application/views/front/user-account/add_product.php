<script src="<?php echo base_url(); ?>media/front/js/jquery.validate_img.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>media/front/js/comman.js"></script>

<section>
  <div class="page_holder">
    <div class="page_inner ">
      <div class="heading mrgn_top">Add Product</div>
      <div class="verification addproduct cms">
        <FORM name="frmProducts" id="frmProducts" action="<?php echo base_url();?>backend/product/add-product" method="POST" >
          <div  class="verify_row">
            <label class="control-label" for="inputName">Product Name</label>
            <div class="verfy_inpt_otr">
              <input class="form-control" type="text" dir="ltr" class="FETextInput" name="inputName" value="<?php echo $arr_product['product_name']; ?>" size="80"   />
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputProductSKU">Product SKU</label>
            <div class="verfy_inpt_otr">
              <input class="form-control" type="text" dir="ltr"  class="FETextInput" name="inputProductSKU" value="<?php echo ($arr_product['product_sku']); ?>" size="80" />
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputProductDescription">Product Description</label>
            <div class="verfy_inpt_otr">
              <textarea class="sptarea" name="inputProductDescription"><?php echo htmlspecialchars(stripslashes($arr_product['product_description'])); ?></textarea>
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputCategory">Categories</label>
            <div class="verfy_inpt_otr">
              <select name="inputCategory[]" id="inputCategory" multiple="multiple" size="10">
                <?php echo $categories; ?>
              </select>
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputCategory">Brand</label>
            <div class="verfy_inpt_otr">
              <select name="inputBrand[]" id="inputBrands" multiple="multiple" size="10">
                <?php echo $brands; ?>
              </select>
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputProductPrice">Product Base Price</label>
            <div class="verfy_inpt_otr">
              <div class="input-prepend input-append"> <span class="add-on">$</span>
                <input  class="form-control" type="text" size="16" id="appendedPrependedInput" name="inputProductPrice" value="<?php echo floatval($arr_product['base_price']); ?>">
              </div>
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputPageTitle">Page Title</label>
            <div class="verfy_inpt_otr">
              <input  class="form-control" type="text" dir="ltr" class="FETextInput" name="inputPageTitle" value="<? echo $arr_product['product_page_title']; ?>" size="80"   />
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputPageKeywords">Page Meta Keywords</label>
            <div class="verfy_inpt_otr">
              <textarea class="sptarea" dir="ltr" class="FETextInput" name="inputPageKeywords">
              <?php echo $arr_product['product_meta_keyword']; ?>
              </textarea>
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputPageDescription">Page Meta Description</label>
            <div class="verfy_inpt_otr">
              <textarea class="sptarea" dir="ltr" class="FETextInput"name="inputPageDescription">
              <?php echo $arr_product['product_meta_description'];?>
              </textarea>
            </div>
          </div>
          <div  class="verify_row">
            <label class="control-label" for="inputPageUrl">Page URL</label>
            <div class="verfy_inpt_otr">
              <input class="form-control" type="text" dir="ltr" class="FETextInput" name="inputPageUrl" value="<?php echo $arr_product['page_url'];?>">
            </div>
          </div>
          <div  class="verify_row  verify_row010 ">
            <label>Product Attributes</label>
            <?php
                // loop for product attributes
									$cntAttr=0;
									if($arr_product_attributes)
									{
									foreach($arr_product_attributes as $attribute)
									{
									?>
            <div  class="verify_row">
              <label><?php echo $attribute['attribute_name'];?></label>
              <div class="verfy_inpt_otr">
                <?php foreach($arr_product_attributes_all_values as $attribute_value){?>
                <?php
					
                    if($attribute_value['attribute_id']==$attribute['attribute_id']){
                  
									?>
                <div class="verfy_inpt_otr">
                  <input type="checkbox" autocomplete="off" <?php 	$product_value="";
				
                    if(in_array($attribute_value['attribute_rec_id'],array_keys($attributes_to_select)))
																	{
																		echo 'checked="checked"';
																		$product_value=$attributes_to_select[$attribute_value['attribute_rec_id']];
																	}
									?> name="attribute[<?php echo $cntAttr;?>][name]" value="<?php echo $attribute_value['attribute_rec_id'];?>">
                  <label for="attribute_value_<?php  echo $attribute_value['attribute_rec_id'];?>" class="control-label"><?php echo $attribute_value['attribute_value_name'];?></label>
                </div>
                <?php
									$cntAttr++;
								}
								}?>
              </div>
            </div>
            <?php
								}
								}
							?>
          </div>
          <div  class="verify_row">
            <label> &nbsp; </label>
            <div class="verfy_inpt_otr">
              <button type="submit" name="btnSubmit" class="button" value="Save changes">Save changes</button>
              <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
            </div>
          </div>
        </FORM>
        <div class="myalbum_left mblet">
          <form method="POST" id="uploadForm" name="uploadForm" enctype="multipart/form-data" action="<?php echo base_url() ?>ajax-upload-photos">
            <div  class="verify_row">
              <label>&nbsp;</label>
              <div class="verfy_inpt_otr">
                <input type="file" multiple="" id="upFile" name="upFile[]" accept='image/*' >
                <input type="hidden" name="album_id" id="album_id" value="<?php echo $edit_id; ?>">
                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
              </div>
            </div>
          </form>
        </div>
        <div  class="verify_row">
          <label>Product Images</label>
          <!-- <div class="span12">
                <input type="file" name="file" id="file_upload">
                </div> -->
          <div  class="verify_row" id="productImages">
            <?php
                if($arr_product_images)
                {
                foreach($arr_product_images as $p_image)
						  									{ 						?>
            <div class="verfy_inpt_otr"> <img src="<?php echo base_url();?>media/product-images/thumbs/<?php echo $p_image;?>" class="span11 img-responsive"> <img data-confirm="1" data-href="<?php echo $p_image;?>" class="btnRemovePicture" alt="X" title="Click to remove" src="<?php echo HTTP_ADMIN;?>admin-media/img/uploadify-cancel.png" style=""> </div>
            <?php				}				}
																if($this->session->userdata('productUploadedImages'))
																 {
																 	 $images =$this->session->userdata('productUploadedImages');
																 	  foreach($images as $img)
																 	  {
																 	  	  ?>
            <div class="span4 img-thumb"> <img src="<?php echo base_url();?>media/product-images/thumbs/<?php echo $img;?>" class="span11 img-responsive"> <img data-confirm="1" data-href="<?php echo $img;?>" class="btnRemovePicture" alt="X" title="Click to remove" src="<?php echo base_url();?>media/backend/img/uploadify-cancel.png" style=""> </div>
            <?php
																 	  	}
																 	}														
																		?>
          </div>
        </div>
        <div class="album-photos"></div>
      </div>
    </div>
    <!--[sortable body]--> 
  </div>

</section>
