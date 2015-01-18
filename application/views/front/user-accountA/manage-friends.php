<script type="text/javascript">
 function FollowStatus(friend_id){
    $('#visibility_'+friend_id).show();
 } 
  function Follow(friend_id, status, visibility_id)
    {
       if(status == 'No'){
            if(visibility_id == '')
            return false;    
        }
        var obj_params = new Object();
        obj_params.friend_id = friend_id;
        obj_params.status = status;
        obj_params.visibility_id = visibility_id;
        $('#visibility_'+friend_id).hide();
        
        jQuery.post("<?php echo base_url(); ?>follow-buisness-user", obj_params, function (msg) {
            if (msg.error == "1")
            {
                alert(msg.error_message);
            }
            else
            {
                /* togling the Active and Inactive div of user*/
                if (status == 'Yes')
                {
                    $("#follow_"+friend_id).css('display', 'inline-block');
                    $("#unfollow_"+friend_id).css('display', 'none');
                }
                else
                {
                    $("#unfollow_"+friend_id).css('display', 'inline-block');
                    $("#follow_"+friend_id).css('display', 'none');
                }
            }
        }, "json");
    }
</script>

<!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->
<!-- content push wrapper --><div class="st-pusher" id="content">

    <!-- sidebar effects INSIDE of st-pusher: -->

    <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
    <!-- this is the wrapper for the content --><div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">
            <nav class="navbar navbar-subnav navbar-static-top" role="navigation">
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
            <div class="container-fluid friends-page">
                <div id="filter">
                    <form class="form-inline">
                        <label>Filter:</label>
                        <select name="users-filter" id="users-filter-select" class="selectpicker" data-style="btn-primary" data-width="auto">
                            <option value="all">All</option>
                            <option value="innercircle">Inner Circle</option>
                            <option value="outercircle">Outer Circle</option>
                        </select>
                        <div id="users-filter-trigger">
                            <div class="select-friends hidden">
                                <select name="users-filter-friends" class="selectpicker" data-style="btn-primary" data-live-search="true">
                                    <option value="0">Select Friend</option>
                                    <option value="1">Mary D.</option>
                                    <option value="2">Michelle S.</option>
                                    <option value="3">Adrian Demian</option>
                                </select>
                            </div>
                            <div class="search-name hidden">
                                <input type="text" class="form-control" name="user-first" placeholder="First Last Name" id="name" />
                                <a href="#" class="btn btn-default hidden" id="user-search-name"><i class="fa fa-search"></i> Search</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="timeline row" data-toggle="gridalicious">
                    
                  <?php for($i=0;$i<count($arr_friends_list);$i++){ ?>
                    
                    <div class="timeline-block">
                        <div class="panel panel-default user-box">
                            <div class="panel-body">
                                <div class="media">
                                    
                                    <a href="<?php echo base_url(); ?>profile/<?php echo $arr_friends_list[$i]['user_list'][0]['user_name']; ?>">
                                        <img src="<?php echo base_url(); ?>media/front/img/user-images/50/<?php echo $arr_friends_list[$i]['user_list'][0]['profile_picture'] ?>" alt="people" class="media-object img-circle pull-left"/>
                                    </a>
                                    <div class="media-body">
                                        <a href="" class="username"><?php echo ucfirst(stripslashes($arr_friends_list[$i]['user_list'][0]['first_name']))." ".ucfirst(stripslashes(substr($arr_friends_list[$i]['user_list'][0]['last_name'],0,1)));?></a>
                                        <div class="profile-icons">
                                            <span><i class="fa fa-fw fa-users"></i> <?php echo count($arr_friends_list[$i]['friend_count']); ?></span>
                                            <span><i class="fa fa-photo"></i> <?php echo $arr_friends_list[$i]['img_count'][0]['img_count']; ?></span>
                                            <span><i class="fa fa-video-camera"></i> <?php echo $arr_friends_list[$i]['video_count'][0]['video_count']; ?> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="javascript:void(0)" class="btn btn-default btn-sm" id="unfollow_<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>" onclick="Follow('<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>','Yes', '');" <?php if(in_array($arr_friends_list[$i]['user_list'][0]['user_id'], $arr_my_friends_id)){ ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>Unfollow <i class="fa fa-share"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-default btn-sm" id="follow_<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>" onclick="FollowStatus('<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>');" <?php if(!in_array($arr_friends_list[$i]['user_list'][0]['user_id'], $arr_my_friends_id)){ ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>Follow <i class="fa fa-share"></i> </a>
<!--                                <a href="javascript:void(0)" class="btn btn-default btn-sm" id="follow_<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>" onclick="Follow('<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>','No')" <?php if(!in_array($arr_friends_list[$i]['user_list'][0]['user_id'], $arr_my_friends_id)){ ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>Follow <i class="fa fa-share"></i> </a>-->
                           
                            
                            <select name="visibility_<?php echo $arr_friends_list[$i]['user_list'][0]['user_id'];?>" id="visibility_<?php echo $arr_friends_list[$i]['user_list'][0]['user_id'];?>" class="user btn btn-primary" style="display:none" onclick="Follow('<?php echo $arr_friends_list[$i]['user_list'][0]['user_id']; ?>','No',this.value)">
                                 <option value="">-Select-</option>
                                <?php foreach($arr_visibility as $visibility){ ?>
                                <?php if($visibility['visibility_id'] == '3' || $visibility['visibility_id'] == '4'){?>
                                  <option value="<?php echo $visibility['visibility_id'];?>"><?php echo stripslashes($visibility['visibility_name']);?></option>
                                <?php } } ?>
                            </select>
                             </div>
                        </div>
                    </div>
                    
                    <?php }?>
                    
                </div>