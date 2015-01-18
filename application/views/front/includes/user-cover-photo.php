
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>
<script>
    var j = jQuery.noConflict();
    j(document).ready(function() {
        j('#upload_image').change(function() {
            j("#imageform").ajaxForm({
                success: function(msg) {
                    location.reload();
                },
            }).submit();
        });
    });

    function showimagepreviews(input) {
        var file_name = input.files[0]['name'];
        var size = input.files[0]['size'];
        var arr_file = new Array();
        arr_file = file_name.split('.');
        var file_ext = arr_file[1];
        switch (file_ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
            case 'JPG':
            case 'JPEG':
            case 'PNG':
            case 'GIF':
                break;
            default:
                $('#upload_cover_photo').replaceWith($('#upload_cover_photo').val('').clone(true));
                alert('Please upload a file only of type jpg,jpeg,gif,png.');
                return true;
        }
    }

    function openFileOption()
    {
        document.getElementById("upload_image").click();
    }
</script> 

<div class="cover overlay hover cover-image-full cover-height-300-all">
    <?php
    $abs_path = $this->common_model->absolutePath();
    $picture = "";
    $user_photo = ($arr_user_data['profile_cover'] != "" && file_exists($abs_path . 'media/front/UI-2-media/images/cover-photos/' . $arr_user_data['profile_cover'])) ? base_url() . 'media/front/UI-2-media/images/cover-photos/' . $arr_user_data['profile_cover'] : base_url() . 'media/front/UI-2-media/images/cover-photos/user.jpeg';
    ?>
    <img src="<?php echo $user_photo; ?>" alt="cover" />
    <div class="overlay overlay-full overlay-bg-black">
        <!--        <div class="v-top">
                    <a href="#" class="btn btn-cover"><i class="fa fa-pencil"></i></a>
                </div>-->
    </div>
    <form id="imageform" name='imageform' action='<?php echo base_url(); ?>change-institute-cover-pic' method="post" enctype="multipart/form-data">
        <div class="overlay overlay-full overlay-hover overlay-bg-black">
            <div class="v-center">
                <a class="btn btn-circle btn-lg btn-white" href="javascript:void(0);" onclick="openFileOption(); return;"><i class="fa fa-plus"></i></a>
                <br/>
                <a href="javascript:void(0);" onclick="openFileOption(); return;" class="text-h3">Update cover</a>
                <input  type="file" name="upFile" id="upload_image" onchange="showimagepreviews(this)" style="display:none"> 
            </div>
        </div>  
    </form>
</div>
