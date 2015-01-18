<?php if (count($arr_get_time_line) > 0) { ?>
                        <li class="media single-post">
                            <?php foreach ($arr_get_time_line as $time_line) { ?>
                                <div class="pull-left timeline-user-pic">
                                    <img src="<?php echo base_url(); ?>media/front/img/user-images/<?php echo $time_line['profile_picture']; ?>" alt="people" class="img-circle" width="80" />
                                    <div class="date"><div class="post-date-time-cont">
                                            <span class="life-event">Life event #50</span>
                                            <div class="date-time"><p><?php echo $time_line['timeline_posted_date']; ?></p>
           <!--                                <p>Time: 04:00 PM</p></div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media-body timeline-user-post">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="boxed">
                                                <a href="#" class="h4 margin-none">Vegetarian Pizza</a>
                                                <div class="rating text-left">
                                                    <span class="star"></span>
                                                    <span class="star filled"></span>
                                                    <span class="star filled"></span>
                                                    <span class="star filled"></span>
                                                    <span class="star filled"></span>
                                                </div>
                                                <div class="media">
                                                    <a href="#" class="media-object pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/img/post-images/thumbs/<?php echo $time_line['timeline_media_path']; ?>" alt="" width="80" />
                                                    </a>
                                                    <div class="media-body">
                                                        <p><?php echo $time_line['timeline_post_data']; ?></p>
                                                    </div>
                                                </div>
                                                <ul class="icon-list">
                                                    <li><i class="fa fa-star fa-fw"></i> 4.8</li>
                                                    <li><i class="fa fa-clock-o fa-fw"></i> 20 min</li>
                                                    <li><i class="fa fa-graduation-cap fa-fw"></i> Beginner</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="view-all-comments"><a href="#"><i class="fa fa-comments-o"></i> View all</a> 10 comments</div>
                                        <ul class="comments">
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/guy-5.jpg" class="media-object">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Bill D.</a>
                                                        <span>Hi Mary, Nice Party</span>
                                                        <div class="comment-date">21st September</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/woman-5.jpg" class="media-object">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Mary</a>
                                                        <span>Thanks Bill</span>
                                                        <div class="comment-date">2 days</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people50/guy-5.jpg" class="media-object">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Bill D.</a>
                                                        <span>What time did it finish?</span>
                                                        <div class="comment-date">14 min</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <a href=""><i class="fa fa-photo"></i></a>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?> 