<?php // echo '<pre>';print_r($arr_user_notification[0]['notifications_id']);die;?>
<div class="st-container">
    <div class="chat-window-container"></div>
    <div class="st-pusher" id="content">
        <div class="st-content">
        
            <!--[message box]-->
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
                <?php }
            ?>
            <div class="st-content-inner">

                <div class="container-fluid">
                    <h1>Notification</h1>
                    <div class="row">
                        <div class="col-xs-12 all-noti-listing">
                            <div class="panel panel-default">
                            <div class="panel-body">
                                
                                <div class="notification_ttl">
                                <strong>Today</strong>
                                </div>
                               <ul class="nav notification-listing">
                                   <?php for($i=0; $i<count($arr_user_notification);$i++){ ?>
                                       <li>
                                           <p><?php echo stripslashes($arr_user_notification[$i]['subject'])?><span class="noti-time"><i class="fa fa-clock-o"></i> <?php echo $posted_date[$i]?></span> 
                                               <span><a href="<?php base_url()?>delete-notification/<?php echo $arr_user_notification[$i]['notifications_id']?>">delete</a></span></p>
                                           
                                        </li>
                                  <?php  }?>
                                        
                                        
                                </ul>
                                      
                                    
                              
                                 
                                
<!--                                 <div class="notification_ttl">
                                <strong>December 30</strong>
                              </div>
                               <ul class="nav notification-listing">
                                    <li>
                                        <p>Your account was logged into from a new browser or device. Please review this login now <span class="noti-time"><i class="fa fa-clock-o"></i> 4.44 PM</span></p>
                                    </li>
                                    <li>
                                        <p>Your account was logged into from a new browser or device. Please review this login now <span class="noti-time"><i class="fa fa-clock-o"></i> 4.44 PM</span></p>
                                    </li>
                                    <li>
                                        <p>Your account was logged into from a new browser or device. Please review this login now <span class="noti-time"><i class="fa fa-clock-o"></i> 4.44 PM</span></p>
                                    </li>
                                    <li>
                                        <p>Your account was logged into from a new browser or device. Please review this login now <span class="noti-time"><i class="fa fa-clock-o"></i> 4.44 PM</span></p>
                                    </li>
                                    <li>
                                        <p>Your account was logged into from a new browser or device. Please review this login now <span class="noti-time"><i class="fa fa-clock-o"></i> 4.44 PM</span></p>
                                    </li>
                                    <li>
                                        <p>Your account was logged into from a new browser or device. Please review this login now <span class="noti-time"><i class="fa fa-clock-o"></i> 4.44 PM</span></p>
                                    </li>
                                </ul>
                                -->
                                
                              </div>
                            </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>    
</div>
