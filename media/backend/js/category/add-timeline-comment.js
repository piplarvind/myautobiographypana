var j = jQuery.noConflict();
// JavaScript Document
j(document).ready(function (e) {
    j("#frm_add_comment").validate({
        errorElement: "div",
        errorClass: 'validationError',
        rules: {
            comment: {
                required: true
            },
            comment_file: {
                accept: 'gif|jpg|png|jpeg|avi|flv|wmv|mpeg|mp3|mp4|mov|ogg'
            }
        },
        messages: {
            comment: {
                required: "Please enter timeline comment."
            },
            comment_file: {
                accept: "Only gif|jpg|png|jpeg|avi|flv|wmv|mpeg|mp3|mp4|mov|ogg  formats are allowed."
            }
        }
    });
});
