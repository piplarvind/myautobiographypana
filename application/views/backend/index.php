
<div class="st-content" id="content">

    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <div class="row gridalicious" data-toggle="gridalicious">
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        <div data-percent="85" data-size="95" class="easy-pie inline-block primary" data-scale-color="false" data-track-color="#efefef" data-line-width="6">
                            <div class="value text-center">
                                <span class="strong"><i class="icon-graph-up-1 fa-3x text-default"></i></span>
                            </div>
                        </div>
                        <h3 class="text-center margin-none">Sales Target: <span class="text-primary">85%</span>
                        </h3>
                    </div>
                </div>

                <!-- Leaderboard -->
                <div class="panel panel-default">
                    <div class="panel-heading boxed">Top 5</div>
                    <table class="table table-leaderboard margin-none">
                        <tbody>
                            <tr>
                                <td width="20">1</td>
                                <td><a href="#"><i class="fa fa-flag text-muted"></i> Jonathan Smith</a>
                                </td>
                                <td class="text-right">14,200</td>
                            </tr>
                            <tr>
                                <td width="20">2</td>
                                <td><a href="#">Michelle S.</a>
                                </td>
                                <td class="text-right">11,591</td>
                            </tr>
                            <tr>
                                <td width="20">3</td>
                                <td><a href="#">Anthony Smith</a>
                                </td>
                                <td class="text-right">10,232</td>
                            </tr>
                            <tr>
                                <td width="20">4</td>
                                <td><a href="#">First Smith</a>
                                </td>
                                <td class="text-right">9,002</td>
                            </tr>
                            <tr>
                                <td width="20">5</td>
                                <td><a href="#">Second Smith</a>
                                </td>
                                <td class="text-right">8,694</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="panel-footer padding-none">
                        <div class="row row-stroke">
                            <div class="col-sm-6">
                                <div class="score-block">
                                    <div class="title">Min</div>
                                    <div class="score">126</div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="score-block">
                                    <div class="title">Max</div>
                                    <div class="score">11,421</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- // Leaderboard -->
                <div class="panel panel-default  text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title">Overall Performance</h4>
                        <p class="text-h2 text-primary margin-none">
                            <strong>+309</strong>
                        </p>
                    </div>
                    <div class="panel-body">
                        <div class="sparkline-bar" sparkHeight="66">
                            <span class="hide">0:10,7:3,5:5,6:4,3:7,7:3,5:5,6:4,2:8,3:7,7:3,5:5,0:10</span>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row text-center border-bottom">
                            <div class="col-md-6">
                                <h4 class="panel-title">Gross Revenue</h4>
                                <p class="text-h2 text-warning">10,201.00</p>
                            </div>
                            <div class="col-md-6">
                                <h4 class="panel-title"> Net Revenue</h4>
                                <p class="text-h2 text-success">10,201.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div id="line-holder" class="flotchart-holder" style="height:200px"></div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <a href="<?php echo base_url(); ?>backend/admin/manage-notification" title="Manage Notifications" class="btn btn-default-light btn-xs"><i class="fa fa-cog"></i></a>
                        </div>
                        Notifications
                    </div>
                    <ul class="activity-list">
                        <?php foreach ($arr_notification as $notification) { ?>
                            <li>
                                <span class="date"><?php echo date('d M', strtotime($notification['message_date'])); ?></span>
                                <span class="circle orange"></span>
                                <?php if ($notification["user_role"] == "0") { ?>
                                    <span class="content"><?php if ($notification['user_name'] != '') { ?><a href="<?php echo base_url(); ?>backend/user-a/view/<?php echo base64_encode($notification["user_id"]) ?>"><?php echo stripslashes($notification['user_name']); ?></a><?php } ?> <?php echo stripslashes($notification['subject']); ?></span>
                                <?php } else if ($notification["user_role"] == "1") { ?>
                                    <span class="content"><?php if ($notification['user_name'] != '') { ?><a href="<?php echo base_url(); ?>backend/user-b/view/<?php echo base64_encode($notification["user_id"]) ?>"><?php echo stripslashes($notification['user_name']); ?></a><?php } ?> <?php echo stripslashes($notification['subject']); ?></span>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- // Notifications -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="chart_horizontal_bars" class="flotchart-holder" style="height:200px"></div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <table class="table table-striped margin-none">
                        <thead>
                            <tr>
                                <th>Box office</th>
                                <th class="text-center">Cash</th>
                                <th class="text-right" style="width: 100px;">Trend</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong class="text-muted">1.</strong> <a href="#" class="text-primary">Frozen</a> </td>
                                <td class="text-right">&euro;8,718,939</td>
                                <td class="text-right">
                                    <div class="sparkline-line" style="width: 100px;" sparkHeight="20" sparkWidth="100%" data-data="[ 484,457,397,591,496,508,366,196 ]">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">2.</strong> <a href="#" class="text-primary">The Hobbit 2</a> </td>
                                <td class="text-right">&euro;7,800,000</td>
                                <td class="text-right">
                                    <div class="sparkline-line" style="width: 100px;" sparkHeight="20" sparkWidth="100%" data-data="[ 363,371,221,258,318,582,536,312 ]">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">3.</strong> <a href="#" class="text-primary">The Wolf of Wall Street</a> </td>
                                <td class="text-right">&euro;5,671,036</td>
                                <td class="text-right">
                                    <div class="sparkline-line" style="width: 100px;" sparkHeight="20" sparkWidth="100%" data-data="[ 315,568,323,517,520,368,311,284 ]">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">4.</strong> <a href="#" class="text-primary">Iron Man 3</a> </td>
                                <td class="text-right">&euro;409,013,994</td>
                                <td class="text-right">
                                    <div class="sparkline-line" style="width: 100px;" sparkHeight="20" sparkWidth="100%" data-data="[ 188,522,457,246,323,456,429,478 ]">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">5.</strong> <a href="#" class="text-primary">Catching Fire</a> </td>
                                <td class="text-right">&euro;398,327,026</td>
                                <td class="text-right">
                                    <div class="sparkline-line" style="width: 100px;" sparkHeight="20" sparkWidth="100%" data-data="[ 366,589,556,312,361,523,281,558 ]">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong class="text-muted">6.</strong> <a href="#" class="text-primary">Despicable Me 2</a> </td>
                                <td class="text-right">&euro;367,835,345</td>
                                <td class="text-right">
                                    <div class="sparkline-line" style="width: 100px;" sparkHeight="20" sparkWidth="100%" data-data="[ 318,586,529,298,109,436,512,184 ]">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel panel-default">
                    <div class="media sparkline-stats">
                        <div class="pull-left">
                            <div class="panel-body">
                                <div class="sparkline-bar" data-colors="true">
                                    <span>6,5,8,6,1</span>
                                </div>
                            </div>
                        </div>
                        <div class="media-body">
                            <ul class="list-group">
                                <li class="list-group-item"><i class="fa fa-fw fa-square text-primary"></i>
                                    <strong>5,931</strong> Visits</li>
                                <li class="list-group-item"><i class="fa fa-fw fa-square text-success"></i>
                                    <strong>402</strong> Conversions</li>
                                <li class="list-group-item"><i class="fa fa-fw fa-square text-danger"></i>
                                    <strong>402</strong> Conversions</li>
                                <li class="list-group-item"><i class="fa fa-fw fa-square text-muted"></i>
                                    <strong>15,120</strong> Pageviews</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent tickets -->
                <div class="panel panel-default">
                    <div class="panel-heading">Recent Tickets</div>
                    <ul class="list-group border-inline margin-0">
                        <li class="list-group-item ">
                            <div class="media">
                                <span class="label label-default pull-left">#8010</span>
                                <span class="text-muted pull-right text-small">2 hrs ago</span>
                                <div class="media-body"><a href="#">How can I use UI Kit?</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <span class="label label-default pull-left">#8010</span>
                                <span class="text-muted pull-right text-small">2 hrs ago</span>
                                <div class="media-body"><a href="#">How can I use UI Kit?</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <span class="label label-default pull-left">#8010</span>
                                <span class="text-muted pull-right text-small">2 hrs ago</span>
                                <div class="media-body"><a href="#">How can I use UI Kit?</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="media">
                                <span class="label label-default pull-left">#8010</span>
                                <span class="text-muted pull-right text-small">2 hrs ago</span>
                                <div class="media-body"><a href="#">How can I use UI Kit?</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item text-right">
                            <a class="btn btn-danger" href="#">Go to support <i class="fa fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- // Recent tickets -->
            </div>
            <!-- Footer -->
            <div class="footer">
                <?php echo $global['site_title']; ?>  &copy; Copyright 
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
