<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l2" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php if(count($header)!=0 ) { ?>
        <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($header['title']) ? stripslashes($global['site_title']) : stripslashes($header['title']); ?></title>
    <?php } else { ?>
        <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($title_for_layout) ? stripslashes($global['site_title']) : stripslashes($title_for_layout); ?></title>
    <?php } ?>

    <!-- Compressed App Style Bundle
    Includes core vendor styling such as the customized Bootstrap and other 3rd party libraries used for the current theme/module
    Note: The bundle was tweaked for the current theme/module and does NOT include ALL of the standalone modules below
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation. -->
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/default.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/custom.css" rel="stylesheet">
    

    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules were not used with the current theme/module but ALL are 100% compatible -->
    <!--
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-essentials.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-layout.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-sidebar.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-navbar.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-media.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-timeline.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-cover.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-chat.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-charts.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-maps.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-colors-alerts.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-colors-background.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-colors-buttons.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-colors-calendar.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-colors-progress-bars.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>media/front/UI-2-media/css/module-colors-text.min.css" rel="stylesheet" />
    -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
    WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
    <!-----Gallery css start------>
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>media/front/UI-2-media/css/gallery/component.css" />
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/gallery/modernizr.custom.js"></script>
    
    <!-----Gallery css end------>
    