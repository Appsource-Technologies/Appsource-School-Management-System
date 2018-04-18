<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Fees Structure'; ?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- Data Tables -->
        <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
        <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

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
                    <div class="col-sm-9">
                        <h2><i class="fa fa-bar-chart-o"></i> <strong> <?php echo @$_GET['source_type']; ?> Statements <font color="green"> </font></strong></h2>
                    </div>
                    <div class="col-sm-3">
                        <br/>
                        <a href="index.php?page=cash_book">  <button class="btn btn-default">   <i class="fa fa-book"></i> Cash Book  </button> </a>
                        &nbsp;&nbsp;
                        <a target="_blank" href="index.php?page=print_cash_book_pdf">  <button class="btn btn-info">   <i class="fa fa-print"></i> Print Cash Book  </button> </a>
                    </div>
                </div>

                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <div class="row">


                        <!-- Teachers query and table starts here ...... -----> 

                        <div class="ibox float-e-margins">
                            <div class="ibox-content table table-responsive">
                                <?php
                                //Script to delete class teacher from class teachers
                                if (isset($_GET['class_teacher_id']) && $_GET['class_teacher_id'] != "" && $_GET['class_id'] != "" && $_GET['stream_id'] != "" && $_GET['action'] == "delete_class_teacher") {
                                    $teacher = $_GET['class_teacher_id'];
                                    $class = $_GET['class_id'];
                                    $stream = $_GET['stream_id'];
                                    if (DB::getInstance()->checkRows("SELECT * FROM class_teacher where teacher_id=" . $teacher . " and class_id=" . $class . " and stream_id=" . $stream . "")) {
                                        $queryDeleteTeachert = DB::getInstance()->query("delete from class_teacher where teacher_id=" . $teacher . " and class_id=" . $class . " and stream_id=" . $stream . "");
                                        if ($queryDeleteTeachert) {
                                            redirect('Class Teacher removed successfully from the class teacher list', 'index.php?page=view_class_teachers');
                                        } else {
                                            redirect('An error occured while removing Class Teacher', 'index.php?page=view_class_teachers');
                                        }
                                    }
                                }
                                //Query to select all class teachers
                                $status = 1;
                                ?>
                                <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >
                                    <caption> <?php echo @$_GET['source_type']; ?> Statement Details Table. </caption>
                                    <thead>
                                        <tr>

                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Source</th>
                                            <th>Amount</th>
                                            <th>Descriptions</th>
                                            <th> 
                                                <?php if ($_GET['source_type'] == 'Income') { ?> 
                                                    Receive from
                                                <?php } else { ?>
                                                    Delivered To
                                                <?php } ?>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_GET['source_type'] == 'Income') {
                                            if (@$_GET['source_id']) {
                                                $source_id = $_GET['source_id'];
                                                $queryDup = "SELECT * FROM income i,income_source s WHERE i.income_source_id = s.income_source_id and i.income_source_id = '" . $source_id . "'  GROUP BY income_date ORDER BY income_date DESC ";
                                            } else {
                                                $queryDup = "SELECT * FROM income i,income_source s WHERE i.income_source_id = s.income_source_id GROUP BY income_date ORDER BY income_date DESC ";
                                            }

                                            if (DB::getInstance()->checkRows($queryDup)) {

                                                $users_list = DB::getInstance()->query($queryDup);
                                                $no = 1;
                                                foreach ($users_list->results() as $users_list) :
                                                    $income_date = $users_list->income_date;
                                                    if (@$_GET['source_id']) {
                                                        $source_id = $_GET['source_id'];
                                                        $queryDup2 = "SELECT * FROM income i,income_source s WHERE i.income_source_id = s.income_source_id AND income_date = '" . $income_date . "' and i.income_source_id = '" . $source_id . "' ";
                                                    } else {
                                                        $queryDup2 = "SELECT * FROM income i,income_source s WHERE i.income_source_id = s.income_source_id AND income_date = '" . $income_date . "' ";
                                                    }
                                                    $counts = 0;
                                                    if (DB::getInstance()->checkRows($queryDup2)) {
                                                        $results_list = DB::getInstance()->query($queryDup2);
                                                        foreach ($results_list->results() as $results_list) :
                                                            $counts ++;
                                                        endforeach;
                                                    }
                                                    ?>

                                                    <tr>
                                                        <td rowspan="<?php echo $counts; ?>"><?php echo $income_date; ?></td>

                                                        <?php
                                                        if (@$_GET['source_id']) {
                                                            $source_id = $_GET['source_id'];
                                                            $queryDup2 = "SELECT * FROM income i,income_source s WHERE i.income_source_id = s.income_source_id AND income_date = '" . $income_date . "'  and i.income_source_id = '" . $source_id . "' ";
                                                        } else {
                                                            $queryDup2 = "SELECT * FROM income i,income_source s WHERE i.income_source_id = s.income_source_id AND income_date = '" . $income_date . "' ";
                                                        }

                                                        if (DB::getInstance()->checkRows($queryDup2)) {
                                                            $results_list = DB::getInstance()->query($queryDup2);
                                                            foreach ($results_list->results() as $results_list) :
                                                                ?>



                                                                <td> <?php echo $results_list->income_time; ?></td>
                                                                <td  style="text-transform: capitalize"><?php echo $results_list->income_name; ?></td>
                                                                <td> <?php echo number_format($results_list->income_amount); ?></td>
                                                                <td><?php echo $results_list->income_description; ?></td>
                                                                <td><?php echo $results_list->other_details; ?></td>


                                                            </tr>  
                                                            <?php
                                                            $no++;
                                                        endforeach;
                                                    }
                                                    ?>


                                                    <?php
                                                endforeach;
                                            } else {
                                                echo '<b style="color:red">No registered Record Yet!</b>';
                                            }
                                        } else {



                                            /** Expenses Record Starts here   ********************* */
                                            if (@$_GET['source_id']) {
                                                $source_id = $_GET['source_id'];
                                                $queryDup = "SELECT * FROM expenditure e,expenditure_source s WHERE e.expenditure_source_id = s.expenditure_source_id and e.expenditure_source_id = '" . $source_id . "' GROUP BY exp_date ORDER BY exp_date DESC ";
                                            } else {
                                                $queryDup = "SELECT * FROM expenditure e,expenditure_source s WHERE e.expenditure_source_id = s.expenditure_source_id GROUP BY exp_date ORDER BY exp_date DESC ";
                                            }

                                            if (DB::getInstance()->checkRows($queryDup)) {

                                                $users_list = DB::getInstance()->query($queryDup);
                                                $no = 1;
                                                foreach ($users_list->results() as $users_list) :
                                                    $exp_date = $users_list->exp_date;
                                                    if (@$_GET['source_id']) {
                                                        $source_id = $_GET['source_id'];
                                                        $queryDup2 = "SELECT * FROM expenditure e,expenditure_source s WHERE e.expenditure_source_id = s.expenditure_source_id AND exp_date = '" . $exp_date . "' and e.expenditure_source_id = '" . $source_id . "'  ";
                                                    } else {
                                                        $queryDup2 = "SELECT * FROM expenditure e,expenditure_source s WHERE e.expenditure_source_id = s.expenditure_source_id AND exp_date = '" . $exp_date . "' ";
                                                    }
                                                    $counts = 0;
                                                    if (DB::getInstance()->checkRows($queryDup2)) {
                                                        $results_list = DB::getInstance()->query($queryDup2);
                                                        foreach ($results_list->results() as $results_list) :
                                                            $counts ++;
                                                        endforeach;
                                                    }
                                                    ?>

                                                    <tr>
                                                        <td rowspan="<?php echo $counts; ?>"><?php echo $exp_date; ?></td>

                                                        <?php
                                                        if (@$_GET['source_id']) {
                                                            $source_id = $_GET['source_id'];
                                                            $queryDup2 = "SELECT * FROM expenditure e,expenditure_source s WHERE e.expenditure_source_id = s.expenditure_source_id AND exp_date = '" . $exp_date . "'  and e.expenditure_source_id = '" . $source_id . "' ";
                                                        } else {
                                                            $queryDup2 = "SELECT * FROM expenditure e,expenditure_source s WHERE e.expenditure_source_id = s.expenditure_source_id AND exp_date = '" . $exp_date . "' ";
                                                        }
                                                        if (DB::getInstance()->checkRows($queryDup2)) {
                                                            $results_list = DB::getInstance()->query($queryDup2);
                                                            foreach ($results_list->results() as $results_list) :
                                                                ?>



                                                                <td> <?php echo $results_list->exp_time; ?></td>
                                                                <td  style="text-transform: capitalize"><?php echo $results_list->expenditure_name; ?></td>
                                                                <td> <?php echo number_format($results_list->exp_amount); ?></td>
                                                                <td><?php echo $results_list->exp_description; ?></td>
                                                                <td><?php echo $results_list->other_details; ?></td>


                                                            </tr>  
                                                            <?php
                                                            $no++;
                                                        endforeach;
                                                    }
                                                    ?>


                                                    <?php
                                                endforeach;
                                            } else {
                                                echo '<b style="color:red">No registered Record Yet!</b>';
                                            }
                                        }
                                        ?>





                                    </tbody>
                                </table>




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
        <!-- Data Tables -->
        <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
        <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>


        <script>
            $(document).ready(function () {
                /* Init DataTables */
                var oTable = $('#editable').dataTable();
            });
        </script>
    </body>

    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
</html>
