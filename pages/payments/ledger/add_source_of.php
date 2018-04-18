<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Ledger Source'; ?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <?php include_once 'includes/nav_side_bar.php'; ?>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                        <?php include_once 'includes/nav_header.php'; ?>
                    </nav>
                </div>
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-sm-12">
                        <h2><strong><i class="fa fa-coffee"></i> Register New Source of <?php echo @$_GET['source_type']; ?></strong></h2>
                    </div>
                </div>

                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <?php
                                    if (Input::exists()) {
//                                    $full_names= Input::get("full_names");
                                        $source_name = Input::get("source_name");
                                        $source_type = Input::get("source_type");
                                        $status = 1;

                                        if ($source_type == 'Income') {

                                            /** Source is income * */
                                            $queryDup = 'select * from income_source where income_name="' . $source_name . '"';
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                echo "<h5 align='center' ><strong><font color='red'> Sorry.. Income Source You Entered Already Registered!.</font></strong></h5>";
                                                //header("refresh:1;url=index.php?page=add_users");
                                                //exit();
                                            } else {
                                                $bookInsert = DB::getInstance()->insert('income_source', array(
                                                    'income_name' => $source_name
                                                ));
                                                if ($bookInsert) {
                                                    $msg = "<h5 align='center' ><strong><font color='green' size='2px'> Thanks.. " . $source_name . " Has been added as Source of Income !</font></strong></h5>";
                                                    header("location:index.php?page=add_source_of&source_type=Income&msg=" . $msg);
                                                } else {
                                                    echo "<h5 align='center' ><strong><font color='red'> Error Occured while inserting the source!.</font></strong></h5>";
                                                }
                                            }
                                        } else {
                                            /** Source is Expenditure * */
                                            $queryDup = 'select * from expenditure_source where expenditure_name="' . $source_name . '"';
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                echo "<h5 align='center' ><strong><font color='red'> Sorry.. Expense Source You Entered Already Registered!.</font></strong></h5>";
                                                //header("refresh:1;url=index.php?page=add_users");
                                                //exit();
                                            } else {
                                                $bookInsert = DB::getInstance()->insert('expenditure_source', array(
                                                    'expenditure_name' => $source_name
                                                ));
                                                if ($bookInsert) {
                                                    $msg = "<h5 align='center' ><strong><font color='green' size='2px'> Thanks.. " . $source_name . " Has been added as Source of Expenditure !</font></strong></h5>";
                                                    header("location:index.php?page=add_source_of&source_type=Expenditure&msg=" . $msg);
                                                } else {
                                                    echo "<h5 align='center' ><strong><font color='red'> Error Occured while inserting the source!.</font></strong></h5>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <form action="" onsubmit="return confirm('Are you sure You want to Submit this Details ?');" method="POST" role="form">
                                        <?php if (@$_GET['msg']) { ?> <div class="alert alert-info"> <?php echo @$_GET['msg']; ?> </div> <?php } ?>
                                        <div class="form-group">
                                            <label>Source Name <sup style="color: red">*</sup></label>
                                            <input type="hidden" name="source_type" value="<?php echo @$_GET['source_type']; ?>"/>
                                            <input name="source_name" type="text" class="form-control" required>
                                        </div>
                                        <div >

                                            <hr/>
                                            <button type="submit" class="btn btn-info"> <i class="fa fa-coffee"></i> Register <?php echo @$_GET['source_type']; ?></button>
                                            
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">

                                    <div class="form-group">
                                        <a href="index.php?page=ledger_account"> <button class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</button>  </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <?php include_once 'includes/nav_footer.php'; ?>

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
                                        $(document).ready(function () {
                                            /* Init DataTables */
                                            var oTable = $('#editable').dataTable();
                                        });
        </script>
    </body>

    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
</html>
