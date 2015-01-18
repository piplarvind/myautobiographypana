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
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Global Settings Management</h1>

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>

                <!-- Data table -->
                <table id="data-table" class="table" cellspacing="0" width="100%">
                    <thead>
                    <th width="10%" class="workcap">	
                        No
                    </th>
                    <th width="20%" class="workcap">Parameter Name</th>
                    <th width="30%" class="workcap" align="center">Parameter Value</th>
                    <th width="15%" class="workcap" align="center">Action</th>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width="10%" class="workcap">	
                                No
                            </th>
                            <th width="20%" class="workcap">Parameter Name</th>
                            <th width="30%" class="workcap" align="center">Parameter Value</th>
                            <th width="15%" class="workcap" align="center">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($arr_global_settings as $key => $global_setting) {
                            ?>
                            <tr>
                                <td class="worktd" align="left">
                                    <?php echo $key + 1; ?>
                                </td>
                                <td class="worktd"  align="left"><?php echo ucwords(str_replace("_", " ", stripslashes($global_setting['name']))); ?></td>
                                <td class="worktd"  align="left">
                                    <?php
                                    if ($global_setting['name'] == "date_format") {
                                        echo date(stripslashes($global_setting['value']));
                                    } else if ($global_setting['name'] == "site_logo") {
                                        $file = $absolute_path . "media/backend/img/" . $global_setting['value'];
                                        if (file_exists($file)) {
                                            ?>
                                            <img src="<?php echo base_url(); ?>media/backend/img/<?php echo $global_setting['value']; ?>" width="100px" height="30px" />
                                            <?php
                                        } else {
                                            echo "Not available";
                                        }
                                        ?>
                                    <?php
                                    } else {
                                        echo stripslashes($global_setting['value']);
                                    }
                                    ?>

                                </td>

                                <td class="worktd">
                                    <a class="btn btn-info" href="<?php echo base_url(); ?>backend/global-settings/edit/<?php echo base64_encode($global_setting['global_name_id']); ?>/<?php echo base64_encode($lang_id); ?>/<?php echo base64_encode($global_setting['store_id']); ?>" title="Edit Global Settings Parameter">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                <!--                   <a class="btn btn-primary" href="<?php echo base_url(); ?>backend/global-settings/edit-parameter-language/<?php echo base64_encode($global_setting['global_name_id']); ?>/<?php echo base64_encode($global_setting['store_id']); ?>" title="Edit Global Settings Parameter for other Langauages">
                                        <i class="icon-file icon-white"></i>Multilangual</a> -->
                                </td>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>

                <!-- // Data table -->
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




