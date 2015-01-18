// JavaScript Document
var j = jQuery.noConflict();
j(document).ready(function (e) {

    j.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z@!#\$\^%&*()+=\-\[\]\\\';,\.\/\{\}\|\":<>\? \s]+$/i.test(value);
    }, "Please enter alphabetical characters only");

    j("#frm_edit_category_details").validate({
        errorElement: "div",
        errorClass: 'validationError',
        rules: {
            category_name: {
                required: true,
                lettersonly: true,
                remote: {
                    url: j("#base_url").val() + "backend/category/check-cat-name",
                    type: "post",
                    data: {
                        type: "edit",
                        old_category_name: j('#old_category_name').val()
                    }
                }

            },
            category_image: {
                //required:true,
                accept: 'jpg|jpeg|gif|png'
            },
            parent_category: {
                required: true
            },
            category_title: {
                required: true,
                lettersonly: true
            },
            meta_keyword: {
                required: true
            },
            meta_description: {
                required: true
            },
            category_url: {
                required: true
                        //     url:true
            }
        },
        messages: {
            category_name: {
                required: "Please enter " + j("#main_cat_name").val() + " name.",
                remote: "" + j("#main_cat_name").val() + " name already exists."
            },
            category_image: {
                //required:"Please select a file.",
                accept: "Only jpg|jpeg|gif|png formats are allowed."
            },
            category_title: {
                required: "Please enter " + j("#main_cat_name").val() + " title."
            },
            parent_category: {
                required: "Please select parent " + j("#main_cat_name").val() + "."
            },
            meta_keyword: {
                required: "Please enter " + j("#main_cat_name").val() + " meta keyword."
            },
            meta_description: {
                required: "Please enter " + j("#main_cat_name").val() + " meta description."
            },
            category_url: {
                required: "Please enter url."
                        //   url:"Please enter a valid URL."
            }
        },
        submitHandler: function (form) {

            if ((j.trim(j("#cke_productdescription iframe").contents().find("body").html())).length < 12)
            {
                j("#labelProductError").removeClass("hidden");
                j("#labelProductError").show();
            }
            else {
                j("#labelProductError").addClass("hidden");
                form.submit();
            }
        }
    });
    CKEDITOR.replace('productdescription',
            {
                filebrowserUploadUrl: j("#base_url").val() + 'media/backend/editor-image'
            });

});
function insertText(obj) {
    var text_to_add = obj.value;
    CKEDITOR.instances.productdescription.insertText(text_to_add)
    //var editor = $('.ckeditor').cleditor()[0];
    CKEDITOR.focus();
    setTimeout(function () {
        //editor.execCommand('inserthtml', text_to_add, false);
    }, 0);
}