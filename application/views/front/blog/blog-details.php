
<div class="cms-sec offset-top-40">
    <div class="container">
        <h1 class="page-title">Blog details</h1>
    </div>

    <div class="container">

        <div class="row">
            <div class="col-md-9">
                <article class="post">
                    <header class="post-header">
                        <div class="fotorama" data-allowfullscreen="true">
                            <img title="196_365" alt="Image Alternative text" src="<?php echo frontend_image_path ?>blog_prof_image.jpg"><i class="fa fa-link box-icon-# hover-icon round"></i>
                        </div>
                    </header>
                    <div class="post-inner">
                        <h4 class="post-title text-darken"><?php echo $blog_posts[0]['post_title'] ?></h4>
                        <ul class="post-meta">
                            <li><i class="fa fa-calendar"></i><a href="javascript:void(0);"><?php echo date('d-M-y',strtotime($blog_posts[0]['posted_on'])); ?></a>
                            </li>
                            <li><i class="fa fa-user"></i><a href="javascript:void(0);"><?php echo $blog_posts[0]['user_details'][0]['first_name'] ?></a>
                            </li>
                            <li><i class="fa fa-comments"></i><a href="javascript:void(0);"><?php echo count($blog_posts[0]['comments']); ?> Comments</a>
                            </li>
                        </ul>
                        <p>
                         <?php echo $blog_posts[0]['post_content']; ?>   
                        </p>
                    </div>
                </article>
                <h2>Posted Comments</h2>
                
                <!-- START COMMENTS -->
                <ul class="comments-list">
                    
                    <?php if(count($blog_posts[0]['comments'])=='0') {  ?>
                    <li>
                     No comments found..   
                        
                    </li>
                    <?php } else { 
                          foreach($blog_posts[0]['comments'] as $comment) {
                    ?>
                    
                    <li>
                        <div class="article comment" inline_comment="comment">
                            <div class="comment-author">
                                <img src="<?php echo frontend_image_path; ?>50x50.png" alt="Image Alternative text" title="Gamer Chick" />
                            </div>
                            <div class="comment-inner"><span class="comment-author-name"><?php echo $comment['commented_user']; ?></span>
                                <p class="comment-content"><?php echo stripslashes($comment['comment']); ?></p>
                                <span class="comment-time"><?php echo date('d-M-y',strtotime($comment['comment_on'])); ?></span>
                                
                                <!-- <a class="comment-reply" href="#"><i class="fa fa-reply"></i> Reply</a>
                                <a class="comment-like" href="#"><i class="fa fa-heart"></i> 44</a> -->
                            </div>
                        </div>
                    </li>
                    <?php } } ?>    
                </ul>
                <!-- END COMMENTS -->
                <h3>Leave a Comment</h3>
                <form id="post-comment-frm" name="post-comment-frm" method="post" action="<?php echo base_url();?>post-comment/<?php echo $blog_posts[0]['post_id']; ?>" >
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" id="full_name" name="full_name" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" id="email" name="email"  autocomplete="off"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Website</label>
                                <input class="form-control" type="text" id="url" name="url" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="btn-grp offset-top-30">
                        <input class="btn btn-primary" id="btn_submit" name="btn_submit" type="submit" value="Leave a Comment" />
                    </div>
                </form>
            </div>
            
           <!-- <div class="col-md-3">
                <aside class="sidebar-right">
                    <div class="sidebar-widget">
                        <div class="Form">
                            <input type="text" placeholder="Search..." class="form-control">
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h4>Categories</h4>
                        <ul class="icon-list list-category">
                            <li><a href="#"><i class="fa fa-angle-right"></i>Photos <small>(97)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Vacation <small>(53)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Flights <small>(93)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Travel Advices <small>(87)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Trending Now <small>(84)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Hotels <small>(83)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Places to Go <small>(74)</small></a>
                            </li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Travel Stories <small>(81)</small></a>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-widget">
                        <h4>Popular Posts</h4>
                        <ul class="thumb-list">
                            <li>
                                <a href="#">
                                    <img title="Viva Las Vegas" alt="Image Alternative text" src="img/70x70.png">
                                </a>
                                <div class="thumb-list-item-caption">
                                    <p class="thumb-list-item-meta">Jul 18, 2014</p>
                                    <h5 class="thumb-list-item-title"><a href="#">Adipiscing massa</a></h5>
                                    <p class="thumb-list-item-desciption">Metus dignissim mauris massa phasellus</p>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <img title="4 Strokes of Fun" alt="Image Alternative text" src="img/70x70.png">
                                </a>
                                <div class="thumb-list-item-caption">
                                    <p class="thumb-list-item-meta">Jul 18, 2014</p>
                                    <h5 class="thumb-list-item-title"><a href="#">Vestibulum sapien</a></h5>
                                    <p class="thumb-list-item-desciption">Fames luctus dui velit consectetur</p>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <img title="Cup on red" alt="Image Alternative text" src="img/70x70.png">
                                </a>
                                <div class="thumb-list-item-caption">
                                    <p class="thumb-list-item-meta">Jul 18, 2014</p>
                                    <h5 class="thumb-list-item-title"><a href="#">Ridiculus torquent</a></h5>
                                    <p class="thumb-list-item-desciption">Netus parturient tortor lorem sapien</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar-widget">
                        <h4>Recent Comments</h4>
                        <ul class="thumb-list thumb-list-right">
                            <li>
                                <a href="#">
                                    <img title="AMaze" alt="Image Alternative text" src="img/70x70.png" class="rounded">
                                </a>
                                <div class="thumb-list-item-caption">
                                    <p class="thumb-list-item-meta">8 minutes ago</p>
                                    <h4 class="thumb-list-item-title"><a href="#">Frank Mills</a></h4>
                                    <p class="thumb-list-item-desciption">Ac non dictumst vel convallis neque rutrum...</p>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <img title="Gamer Chick" alt="Image Alternative text" src="img/70x70.png" class="rounded">
                                </a>
                                <div class="thumb-list-item-caption">
                                    <p class="thumb-list-item-meta">5 minutes ago</p>
                                    <h4 class="thumb-list-item-title"><a href="#">John Mathis</a></h4>
                                    <p class="thumb-list-item-desciption">Scelerisque laoreet sodales fames sollicitudin tortor elementum...</p>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <img title="Afro" alt="Image Alternative text" src="img/70x70.png" class="rounded">
                                </a>
                                <div class="thumb-list-item-caption">
                                    <p class="thumb-list-item-meta">9 minutes ago</p>
                                    <h4 class="thumb-list-item-title"><a href="#">Leah Kerr</a></h4>
                                    <p class="thumb-list-item-desciption">Vestibulum cras tempor mi ut bibendum auctor...</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div> -->
        </div>
    </div>
</div> 

 <style>
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    </style>


    <script>
    $(document).ready(function() {
      $("#partner-slider").owlCarousel({

      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem : true
      });
    });
    </script>