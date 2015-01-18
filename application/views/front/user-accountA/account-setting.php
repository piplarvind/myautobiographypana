
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/account-setting.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/timeline.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/my-news.js"></script>

<div class="st-pusher" id="content"> 
    
    <!-- sidebar effects INSIDE of st-pusher: --> 
    
    <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 --> 
    <!-- this is the wrapper for the content -->
    <div class="st-content"> 
      
      <!-- extra div for emulating position:fixed of the menu -->
      <div class="st-content-inner">
        <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
          <div class="container-fluid"> 
            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav"> <span class="sr-only">Toggle navigation</span> <span class="fa fa-ellipsis-h"></span> </button>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="subnav">
              <ul class="nav navbar-nav">
                    <li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                    <li <?php if($this->uri->segment(1) == 'student-my-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                    <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student/user-manage-friends"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                </ul>
            </div>
            
            <!-- /.navbar-collapse --> 
          </div>
           
        </nav>
          
        <div class="container-fluid setting-page">
        
         <!--[message box]-->
        <?php $msg = $this->session->userdata('msg'); ?>
        <!--[message box]-->
        <?php if ($msg != '') { ?>
            <div class="msg_box alert alert-success">
                <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                <?php
                echo $msg;
                $this->session->unset_userdata('msg');
                ?> 
            </div>
        <?php } ?>
        
          <div class="row">
            <div class="col-md-7 col-xs-12"> 
              
              <!--Friends -->
              <div class="panel panel-default">
                    <div class="panel-heading panel-heading-gray">
                        <i class="fa fa-info-circle"></i> Account setting
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="frm_edit_account_setting" name="frm_edit_account_setting" method="post" action="<?php echo base_url(); ?>student/user-account-setting">
                            <ul class="list-unstyled profile-about">
                                <li>
                                    <div class="row">
                                        <div class="col-sm-4"><label class="control-label">Current Password:<span class="compulsory_fld">*</span></label></div>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="password" readonly id='user_password' name='user_password' value='<?php echo $arr_user_data['user_password'] ?>'/>
                                        </div>
                                    </div>
                                </li>
                                <li>

                                    <div class="row">
                                        <div class="col-sm-4"><label class="control-label">New Password:<span class="compulsory_fld">*</span></label></div>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="password" id='new_user_password' name='new_user_password'/>
                                        </div>
                                    </div>

                                </li>
                                <li>

                                    <div class="row">
                                        <div class="col-sm-4"><label class="control-label">Confirm New Password:<span class="compulsory_fld">*</span></label></div>
                                        <div class="col-sm-8">
                                            <input class="form-control" type="password" id='cnf_new_user_password' name='cnf_new_user_password'/>
                                        </div>
                                    </div>

                                </li>

                                <li>
                                    <div class="btn-block text-right offset-top-20">
                                        <input type="submit" value="Change Password" class="btn btn-primary" id='btn_change_passwd' name='btn_change_passwd'>
                                    </div>
                                </li>

                            </ul>

                        </form>
                    </div>
                </div>
            </div>
<!--            <div class="col-md-5 col-xs-12">
                Friends 
                <div class="panel panel-default">

                    <div class="panel-heading panel-heading-gray">
                        <a class="btn btn-primary btn-xs pull-right" id="select_all" name="select_all" href="javascript:void(0)">Select all</a>
                        <i class="icon-user-1"></i> Timeline setting
                    </div>
                    <form name="timeline_setting" id="timeline_setting" method="post" action="<?php echo base_url(); ?>timeline-setting">
                        <div class="panel-body">
                            <div class="media">
                                <span class="pull-right">
                                    <input type="checkbox"  class="select-photo" id="automatic_approve_comment" name="automatic_approve_comment" <?php if ($arr_user_data['Automatically_approve_comments'] == "1") { ?> checked="checked" <?php } ?> value="1">
                                </span>
                                <div class="media-body">
                                    <label>Automatically approve all comments</label>
                                </div>
                            </div>

                            <div class="btn-block text-right offset-top-30">
                                <div id="post_error"></div>
                                <input type="submit" id="btn_timeline_setting" name="btn_timeline_setting" value="Save changes" class="btn btn-primary">
                            </div>
                        </div>
                    </form>    
                </div>
            </div>-->
          </div>
<!--          <div class="row">
            ------my news-------
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-gray">
                        <?php if(!empty($arr_news_details)) {?><a class="btn btn-primary btn-xs pull-right" id="select_all_news" name="select_all_news" href="javascript:void(0)">Select all</a><?php } ?>
                        <i class="icon-user-1"></i> My news
                    </div>
                    <form name="my_news_frm" id="my_news_frm" method="post" action="<?php echo base_url(); ?>my-news">
                        <div class="panel-body">
                            <?php $rss_newsletter_id = explode(',', $arr_user_data['rss_newsletter']) ?>   
                            <div class="post-visibility">
                                <label>Post visibility to:</label>
                                
                                    <?php foreach ($arr_news_details as $news_details) { ?>
                                <div class="media">
                                        <span class="pull-right">
                                            <input type="checkbox" class="select-news" id="post_visibility_news" name="post_visibility_news[]" <?php if (in_array($news_details["news_id"], $rss_newsletter_id)) { ?>checked="checked"<?php } ?>  value="<?php echo $news_details['news_id'] ?>"> 
                                        </span>
                                        <div class="media-body">
                                            <?php echo $news_details['news_title'] ?>
                                        </div> 
                                            </div>
                                            <?php } ?>
                                <div class="erroe-div text-right"> <div style="display:none;" class="error" for="post_visibility_news[]" generated="true">Please check news.</div></div>
                                
                                <?php if(!empty($arr_news_details)) {?>
                                <div class="btn-block text-right offset-top-30">
                                    <input type="submit" id="btn_my_news" name="btn_my_news" value="Save changes" class="btn btn-primary">
                                </div>
                                  <?php } ?>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>-->
        </div>
      </div>
      
      <!-- /st-content-inner --> 
    </div>
    
    <!-- /st-content --> 
  </div>


