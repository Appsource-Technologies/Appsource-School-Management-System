<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title .' Announcements';?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php include_once 'includes/nav_side_bar.php';?>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <?php include_once 'includes/nav_header.php';?>
        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><strong>Announcements Entry Form</strong></h2>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <!--Page content here..-->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <?php 
                                if(Input::exists()){
                                    $announcement_title= Input::get('announcement_title');
                                    $announcement_body= Input::get("announcement_body");
                                    $expiry_date= Input::get('expiry_date');
                                    $queryDup = 'select * from announcement where announcement="'.$announcement_body.'"';
                                    if (DB::getInstance()->checkRows($queryDup)){
                                        echo "<h5 align='center' ><strong><font color='red'>Announcement already posted.</font></strong></h5>";
                                    }
                                    else{
                                        $announcementInsert=  DB::getInstance()->insert('announcement',array(
                                            'announcement_title'=>$announcement_title,
                                            'announcement'=>$announcement_body,
                                            'p_date'=> date('Y-m-d'),
                                            'ex_date'=>$expiry_date,
                                            'user_id'=>$_SESSION['school_user_id']
                                        ));
                                        if ($announcementInsert) {
                                            redirect("Announcement posted Successfully", "index.php?page=add_announcements");
                                        }
                                    }
                                }
                                ?>
                                <form action="" method="POST" role="form">
                                    <div class="form-group">
                                        <label>Expiry Date <sup style="color: red">*</sup></label>
                                        <input type="date" name="expiry_date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Announcement Title <sup style="color: red">*</sup></label>
                                        <input type="text" name="announcement_title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Announcement Body <sup style="color: red">*</sup></label>
                                        <textarea name="announcement_body" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Announcement</button>
                                    <button type="reset" class="btn btn-warning">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <?php include_once 'includes/nav_footer.php';?>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


    <script>
        $(document).ready(function() {
            /* Init DataTables */
            var oTable = $('#editable').dataTable();
        });
    </script>
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
</html>
