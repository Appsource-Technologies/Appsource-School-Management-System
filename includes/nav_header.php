<?php
//ob_start();
if (empty($_SESSION['school_user_role'])||empty($_SESSION['school_user_id'])){
    Redirect::to('index.php?page=login');
}
?>
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        <form role="search" class="navbar-form-custom" action="#">
            <div class="form-group">
                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
            </div>
        </form>
    </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to <span style="text-transform: uppercase">Appsource School Light</span><b> <?php echo "Licensed to: " . $SCHOOL_NAME ?> </b></span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-warning">
                            <?php $announcement_query="select DISTINCT(announcement),p_date from announcement WHERE ex_date>=NOW() order by p_date desc"; echo DB::getInstance()->countElements($announcement_query);  ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <?php if (DB::getInstance()->checkRows($announcement_query)){
                            echo '<h3 style="color:blue">Announcements</h3>';
                            $ann_list = DB::getInstance()->query($announcement_query);
                            foreach ($ann_list->results() as $list) :?>
                        <li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <small class="pull-right"><?php echo english_date($list->p_date);?></small>
                                    <?php echo $list->announcement;?>
                                    <!--<small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>-->
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <?php endforeach;}?>
                    </ul>
                </li>
<!--                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->


                <li>
                    <a href="index.php?page=logout">
                        <i class="fa fa-power-off"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>