

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
    <script type="text/javascript">



        function changeStateStatus(city_id, city_status)
        {
            /* changing the user status*/
            var obj_params = new Object();
            obj_params.city_id = city_id;
            obj_params.city_status = city_status;
            jQuery.post("<?php echo base_url(); ?>backend/cities/change-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the Active and Inactive div of user*/
                    if (city_status == '0')
                    {
                        $("#inactive_div" + city_id).css('display', 'inline-block');
                        $("#active_div" + city_id).css('display', 'none');
                    }
                    else
                    {
                        $("#active_div" + city_id).css('display', 'inline-block');
                        $("#inactive_div" + city_id).css('display', 'none');
                    }
                }
            }, "json");
        }


        function deleteAll()
        {
            var delete_all = 0;
            jQuery('.case').each(function () {
                if (this.checked) {
                    delete_all = 1;
                }
            });

            if (!delete_all) {
                alert("Please select atleast one record to delete.");
                return false;
            }
            else {
                var status = confirm("Do you really want to delete this record?");
                if (status)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    </script>
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Manage Cities</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-cities" class="btn btn-plus btn-round" title="Add Cities">
                    <button class="btn btn-primary">Add Cities</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">

                </div>
                <form  class="form-horizontal" name="frm_cities" id="frm_cities" action="<?php echo base_url(); ?>backend/manage-cities" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_cities) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>

                        <th width="7%" class="workcap">Country</th>
                        <th width="15%" class="workcap">State</th>
                        <th width="15%" class="workcap">City</th>
                        <th width="15%" class="workcap">Status</th>
                        <th width="15%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="15%" class="workcap">Country</th>
                                <th width="15%" class="workcap">State</th>
                                <th width="15%" class="workcap">City</th>
                                <th width="15%" class="workcap">Status</th>
                                <th width="15%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_cities) > 0) {
                                foreach ($arr_cities as $cities) {
                                    ?>
                                    <tr>
                                <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $cities['geoname_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo $cities['country_name']; ?></td>                                    
                                <td class="worktd"  align="left"><?php echo $cities['state_name']; ?></td>                                    
                                <td class="worktd"  align="left"><?php echo $cities['city_name']; ?></td>                                    
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $cities['geoname_id']; ?>"  <?php if ($cities['status'] == "1") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" onClick="changeStateStatus('<?php echo $cities['geoname_id']; ?>', 0);" href="javascript:void(0);" id="status_<?php echo $cities['geoname_id']; ?>">Active</a>
                                    </div>
                                    <div id="inactive_div<?php echo $cities['geoname_id']; ?>" <?php if ($cities['status'] == "0") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status" onClick="changeStateStatus('<?php echo $cities['geoname_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $cities['geoname_id']; ?>">Inactive</a>
                                    </div>
                                </td>
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit City" href="<?php echo base_url(); ?>backend/edit-cities/<?php echo base64_encode($cities['geoname_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <th colspan="6"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="footer">
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>







