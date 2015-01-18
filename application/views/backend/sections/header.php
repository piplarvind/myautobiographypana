<!DOCTYPE html>
<html class="st-layout ls-top-navbar show-sidebar sidebar-l2" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    
     <?php if(count($header)!=0 ) { ?>
        <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($header['title']) ? stripslashes($global['site_title']) : stripslashes($header['title']); ?></title>
     <?php } else { ?>
        <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($title_for_layout) ? stripslashes($global['site_title']) : stripslashes($header['title']); ?></title>
     <?php } ?>
           

    <!-- App Styling Bundle -->
    <link href="<?php echo base_url();?>media/backend/css/default.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>

<script src="<?php echo base_url(); ?>media/backend/js/jquery.dataTables.min.js"></script> 
      <script src="<?php echo base_url(); ?>media/backend/js/bootstrap-tab.js"></script>
        <!-- library for advanced tooltip -->
      <script src="<?php echo base_url(); ?>media/backend/js/bootstrap-tooltip.js"></script>
      <script src="<?php echo base_url(); ?>media/backend/js/charisma.js"></script> 
      <script src="<?php echo base_url(); ?>media/backend/js/select-all-delete.js"></script> 
      
      <script type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.cleditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.cleditor.extimage.js"></script>

<script src="<?php echo base_url();?>media/backend/js/ckeditor/ckeditor.js"></script> 

<style>
.error {
    color: #BD4247;
    margin-left: 120px;
    width: 210px;
}
.FETextInput{
    margin-left: 120px;
    margin-top: -28px;
}
</style>

<link href="<?php echo base_url(); ?>media/backend/css/jquery.cleditor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		jQuery.cleditor.buttons.image.uploadUrl = '<?php echo base_url(); ?>upload-image';
		jQuery(".cleditor").cleditor();
	});
</script>


<style>
            .error {
                color: #BD4247;
                margin-left: 103px;
                width: 210px;
            }
            .FETextInput{
                margin-left: 120px;
                margin-top: -28px;
            }
            #labelProductError{
                   margin-left: 2px !important;
            }
        </style>

</head>
<body>