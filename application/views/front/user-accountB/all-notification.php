<?php // echo '<pre>';print_r($arr_user_notification[0]['notifications_id']);die;?>

    <!-- Wrapper required for sidebar transitions -->
    <div id="content" class="st-pusher">
<div class="st-content">
    <div class="st-content-inner">
                    <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
                <div class="container-fluid">
                    
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-ellipsis-h"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="subnav">
                         <ul class="nav navbar-nav">
                             <li><a href="<?php echo base_url();?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                            <li><a href="<?php echo base_url();?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                        </ul>
                        
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
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
                 </nav>
                    
                    <div class="container-fluid">
                        <h1>Notifications</h1>                        
                        
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

    <!-- /st-container -->