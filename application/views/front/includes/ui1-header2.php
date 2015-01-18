
<div id="body" class="unselectable">
    <!--<div class="preloader"><img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/loader.gif"></img></div>-->

<div class="top-part metro">
  <div id="navbar" class="header bg-dark navbar-fixed-top">
    <div class="navigation-bar dark">
      <div class="navigation-bar-content container main-top-nav"> 
        <div class="top-nav place-left">
          <ul class="element-menu">
            <li><a class="active" href="<?php echo base_url();?>home"> Dashboard</a></li>
            <li><a href="<?php echo base_url();?>tiles"> Tiles</a></li>
            <li><a href="<?php echo base_url();?>digital-record"> Digital records</a></li>
            <li class="search-sec">
              <form id="googleForm">
                <input id="googleSearchText" type="text" class="form-control" name="q" placeholder="Coming soon...">
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
              </form>
            </li>
          </ul>
        </div>
          <?php 
          $user_account = $this->session->userdata('user_account');
          
          $user_role = ($this->session->userdata('user_account')); ?>
        <div class="top-rt-nav pull-right navbar-collapse" id="navbar"> <a href="#" class="element1 pull-menu menu-btn" id="main-menu-btn"></a>
          <ul class="pull-right element-menu menu-dropdown" id="menu-drpdwn">
             <?php if(!(empty($user_account))){?>
            <li><a href="#">Messages</a></li>
            <?php }?>
            <?php  if($user_role['user_role']==0){?>
            <li><a href="<?php echo base_url()?>usera-private-timeline">Timeline</a></li>
            <?php }elseif($user_role['user_role']==1){?>
            <li><a href="<?php echo base_url()?>institute-private-timeline">Timeline</a></li>
            <?php }else{?>
            <li><a href="#">Timeline</a></li>
            <?php }?>
            
            <?php if(!(empty($user_account))){?>
            <li><a href="#">Notifications <span class="count"><?php echo $user_notification_count;?></span></a></li>
            <?php }?>
            <li><a href="<?php echo base_url();?>reset"> Reset</a></li>
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Theme <i class="fa fa-angle-down"></i></a>
              <ul class="dropdown-menu">
                <li><a href="#" onclick="ui.switchTheme('theme-green')">Green</a></li>
                <li><a href="#" onclick="ui.switchTheme('theme-white')">White</a></li>
                <li><a href="#" onclick="ui.switchTheme('theme-Bloom')">Bloom</a></li>
              </ul>
            </li>
            <?php if(empty($user_account)){?>
            <li class="login-link"><a  href="<?php echo base_url()?>signin"><i class="icon-white icon-user"></i>Login</a></li>
            <?php }else{?>
            <li  class="login-link"><a href="<?php echo base_url();?>logout"><i class="icon-user"></i>Logout</a></li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
    
<script type="text/javascript">
			$(function() {
                       
				var $c = $('#carousel'),
					$w = $(window);

				$c.carouFredSel({
					align: false,
					items: 10,
					scroll: {
						items: 1,
						duration: 2000,
						timeoutDuration: 0,
						easing: 'linear',
						//pauseOnHover: 'immediate'
						pauseOnHover: false
					}
				});

				
				$w.bind('resize.example', function() {
					var nw = $w.width();
					if (nw < 990) {
						nw = 990;
					}

					$c.width(nw * 3);
					$c.parent().width(nw);

				}).trigger('resize.example');

			});
</script>
