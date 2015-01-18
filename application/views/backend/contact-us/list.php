


<div class="st-content" id="content">
    <?php
    $msg = $this->session->userdata('msg');
    ?>
    <!--[message box]-->
    <?php if ($msg != '') { ?>
        <div class="msg_box alert alert-success">
            <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
            <?php
            echo $msg;
            $this->session->unset_userdata('msg');
            ?> 
        </div>
        <?php
    }
    ?> 
    <script src="<?php echo base_url(); ?>media/backend/js/select-all-delete.js"></script> 
    
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1> Manage Contact Us </h1>
            <div class="widget-head">
<!--                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-institute-type" class="btn btn-plus btn-round" title="Add Institute Type">
                    <button class="btn btn-primary">Add Institute Type</button>
                </a>-->
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                
                  <form  class="form-horizontal"name="frm_contact_us" id="frm_contact_us" action="<?php echo base_url(); ?>backend/contact-us" method="post">  
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_contact_us) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>

                        <th width="8%" class="workcap">Sender Name</th>
                        <th width="12%" class="workcap">Sender Email</th>
                        <th width="12%" class="workcap">Date</th>
                        <th width="8%" class="workcap">Status</th>
                        <th width="10%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="8%" class="workcap">Sender Name</th>
                                <th width="12%" class="workcap">Sender Email</th>
                                <th width="12%" class="workcap">Date</th>
                                <th width="8%" class="workcap">Status</th>
                                <th width="10%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_contact_us) > 0) {
                                foreach ($arr_contact_us as $contact) {
                                    $cnt++;
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $contact['contact_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo ucfirst($contact['contact_name']) . ' ' . ucfirst($contact['contact_last_name']); ?></td>                                    
                                <td class="worktd"  align="left"><?php echo $contact['contact_email']; ?></td>                                    
                                <td class="worktd"  align="left"><?php echo date($global['date_format'], strtotime($contact['contact_created_date'])); ?></td>                                    
                                <td class="worktd"  align="left"><?php if($contact['contact_reply_status']=='0') { echo 'Not replied'; } else { echo 'Replied'; } ?></td>                                    

                                <td class="worktd">
                                    <a class="btn btn-info" title="View" href="<?php echo base_url(); ?>backend/contact-us/view/<?php echo base64_encode($contact['contact_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                </td>
                    
                                <?php
                            }
                        }
                        ?>
                    
                        </tbody>
                        <tfoot>
                             <?php if($cnt> 0) { ?>
                                <th colspan="7"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteConfirm();" class="btn btn-danger" value="Delete Selected"></th>
                                    <?php } ?>
                        
                        </tfoot>
                    </table>
                    <!-- // Data table -->
                </form>
            </div>
            <!-- Footer -->
            <div class="footer">
               <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
</div>














