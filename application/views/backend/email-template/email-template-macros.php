<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo isset($title) ? $title : ''; ?>- Admin Panel</title>
        <?php $this->load->view('backend/sections/header.php'); ?>
        <script src="<?php echo base_url(); ?>media/backend/js/jquery.dataTables.min.js"></script> 
        <script src="<?php echo base_url(); ?>media/backend/js/bootstrap-tab.js"></script>
        <!-- library for advanced tooltip -->
        <script src="<?php echo base_url(); ?>media/backend/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url(); ?>media/backend/js/charisma.js"></script> 
        <style>
            .btn{
                margin-top:5px;
                margin-bottom:5px;
            }
        </style>
    </head>
    <body>
        <?php $this->load->view('backend/sections/top-nav.php'); ?>
        <?php $this->load->view('backend/sections/leftmenu.php'); ?>
        <div id="content" class="span10">
            <!--[breadcrumb]-->
            <div>
                <ul class="breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>backend/dashboard">Dashboard</a> <span class="divider">/</span> </li>
                    <li> <a href="<?php echo base_url(); ?>backend/email-template/list">Manage Email Template</a> <span class="divider">/</span> </li>
                    <li> Assign Email Template Macro </li>
                </ul>
            </div>

            <div class="row-fluid sortable"> 
                <!--[sortable header start]-->
                <div class="box span12">
                    <div class="box-header well">
                        <h2><i class=""></i>Assign Email Template Macro Which are used in the var_array of mail functionality.</h2>

                    </div>
                    <br >
                    <!--[sortable body]-->
                    <div class="box-content">
                        <form name="frm_email_template_macros" id="frm_email_template_macros" action="<?php echo base_url(); ?>backend/assign-email-template-macro/<?php echo $email_template_id; ?>" method="post" >
                            <table  class="table table-striped table-bordered">
                                <tbody>
                                    <?php
                                    $arr_macros = array_chunk($arr_macros, 3);
                                    foreach ($arr_macros as $key2 => $macros2) {
                                        // echo "<pre>";print_r($macros2);
                                        ?>
                                        <tr><?php
                                    foreach ($macros2 as $key => $macros) {
                                            ?> 
                                                <td class="center" >
                                                    <input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $macros['macro_id']; ?>" <?php if (in_array($macros['macro_id'], $assigned_macro_id)) { ?> checked="checked" <?php } ?> />
                                                </td>
                                                <td >
                                                <?php echo stripslashes($macros['macro_title']); ?>
                                                </td>                                            
                                                <?php } if (count($macros2) != 3) {
                                                    for ($i = 1; $i <= (3 - count($macros2)); $i++) {
                                                        ?>
                                                    <td></td>
                                                    <td ></td>   
                                                <?php }
                                            } ?></tr>
                                    <?php } ?>                                            
                                </tbody>
                            </table>  
                            <input type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="Submit" />
                            <input type="hidden" name="email_template_id" value="<?php echo $email_template_id; ?>" />     
                        </form>		
                    </div>
                    <!--[sortable body]--> 
                </div>
            </div>

            <!--[sortable table end]--> 

            <!--[include footer]-->
        </div><!--/#content.span10-->

        <?php $this->load->view('backend/sections/footer.php'); ?>

    </body>
</html>