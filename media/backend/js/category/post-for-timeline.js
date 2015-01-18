var j = jQuery.noConflict();
// JavaScript Document
j(document).ready(function (e) {
    j("#frm_timeline").validate({
        errorElement: "div",
        errorClass: 'validationError',
        rules: {
            post_title: {
                required: true
            },
            "post_image[]": {
                accept: 'gif|jpg|png|jpeg'
            },
            "post_files[]": {
                accept: 'doc|docx|txt|pdf'
            },
            post_video: {
                accept: 'avi|flv|wmv|mpeg|mp3|mp4|mov|ogg'
            }

        },
        messages: {
            post_title: {
                required: "Please enter post title."
            },
            "post_image[]": {
                accept: "Only gif|jpg|png|jpeg formats are allowed."
            },
            "post_files[]": {
                accept: 'Only doc|docx|txt|pdf formats are allowed.'
            },
            post_video: {
                accept: "Only gif|avi|flv|wmv|mpeg|mp3|mp4|mov|ogg formats are allowed."
            }
        }
    });
});
