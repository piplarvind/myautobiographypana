

<div class="cms-sec offset-top-40">
        <div class="container">
           <h1 class="page-title">Blogs</h1>
        </div>

        <div class="container">
        <div class="row">
            <?php if(count($arr_blog_data)!='') {  //print_r($arr_blog_data); ?>
                <div class="col-md-9">
                    <!-- START BLOG POST -->
                   <?php foreach($arr_blog_data as $blog) { ?> 
                    <div class="article post">
                        <header class="post-header">
                            <a href="<?php echo base_url(); ?>blog-details/<?php echo $blog['post_id']; ?>" class="hover-img">
                                <img title="196_365" alt="Image Alternative text" src="<?php echo frontend_image_path; ?>blog_prof_image.jpg"><i class="fa fa-link box-icon-# hover-icon round"></i>
                            </a>
                        </header>
                        <div class="post-inner">
                            <h4 class="post-title"><a href="blog-details.html" class="text-darken"><?php echo $blog['post_title']; ?></a></h4>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i><a href="#"><?php echo date('d-M-y', strtotime($blog['posted_on'])) ?></a>
                                </li>
                                 <!-- <li><i class="fa fa-user"></i><a href="#"><?php echo $blog['user_details'][0]['first_name'].' '.$blog['user_details'][0]['last_name']; ?></a>
                                </li> --> 
                                <li><i class="fa fa-comments"></i><a href="#"><?php echo count($blog['comment']); ?> Comments</a>
                                </li>
                            </ul>
                            <p class="post-desciption">
                                <?php echo character_limiter($blog['testimonial'],150); ?> 
                            </p>
                            <div class="btn-grp">
                            <a href="<?php echo base_url(); ?>blog-details/<?php echo $blog['post_id']; ?>" class="btn btn-small btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                    <!-- Paginatin Start Here --> 
                    <ul class="pagination">
                       <?php echo $pg_link ; ?> 
                    </ul>
                  <!-- Paginatin End Here -->  
                </div>
            <?php } else { ?>
             No data found..
            <?php } ?>
            </div>
        </div>
      <div class="gap"></div>
    </div> 


