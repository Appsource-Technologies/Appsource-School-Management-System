<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Payment'; ?></title>

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
                    <div class="col-sm-10">
                        <h2> <i class="fa fa-book"></i> <strong> Cash Book </strong></h2>
                    </div>
                    <div class="col-sm-2">
                        <br/>
                        <a target="_blank" href="index.php?page=print_cash_book_pdf">  <button class="btn btn-info">   <i class="fa fa-print"></i> Print Cash Book  </button> </a>
                    </div>
                </div>

                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    [<font color="green"> <strong> Please select the date Interval and press Enter Key To view The Details </strong> </font> ]
                                    <form action="" method="POST" role="form">

                                        <div class="col-sm-4">
                                            <label> From <sup style="color: red">*</sup></label>
                                            <input type="date" name="date_from" class="form-control"/>
                                        </div>

                                        <div class="col-sm-4">
                                            <label> To <sup style="color: red">*</sup></label>
                                            <input type="date" name="date_to" class="form-control"/>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="submit" style="position: absolute; left: -9999px"/>
                                        </div>




                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- Students query and table starts here ...... -----> 
                        <div class="ibox float-e-margins">
                            <div class="ibox-content table-responsive">

                                <?php
                                $flag = 0;
                                if (Input::exists() && Input::get('date_from') == '' && Input::get('date_to') == '') {
                                    echo "<font color='blue'> None of the  Dates was Selecteed! </font>";
                                } elseif (Input::exists() && Input::get('date_from') == '' && Input::get('date_to') != '') {
                                    echo "<font color='blue'> Only The First Date was Selecteed! </font>";
                                } elseif (Input::exists() && Input::get('date_from') != '' && Input::get('date_to') == '') {
                                    echo "<font color='blue'> Only The Second Date was Selecteed! </font>";
                                } else if (Input::exists() && Input::get('date_from') != '' && Input::get('date_to') != '') {
                                    $date_from = Input::get('date_from');
                                    $date_to = Input::get('date_to');
                                    ?>
                                    <table class="table table-striped table-bordered table-hover " id="editable" >


                                        <tr>
                                            <th>Date.</th>
                                            <th>Particular.</th>
                                            <th>Income.</th>
                                            <th>Expenses.</th>
                                            <th>Balance.</th>

                                        </tr>


                                        <?php
                                        
                                        $balance = 0;
                                        $queryDup = "select * from cash_flow where  cash_date between  '" . $date_from . "' and '" . $date_to . "' group by cash_date ";
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            ?>


                                            <?php
                                            $flag ++;
                                            $users_list = DB::getInstance()->query($queryDup);
                                            $no = 1;
                                            foreach ($users_list->results() as $users_list) :

                                                $amt_set = 0;
                                                $date = $users_list->cash_date;
                                                $queryDup = "select * from cash_flow where cash_date =  '" . $date . "' order by cash_flow_id asc limit 1 ";
                                                if (DB::getInstance()->checkRows($queryDup)) {
                                                    $res_lists = DB::getInstance()->query($queryDup);
                                                    foreach ($res_lists->results() as $res_lists) {
                                                        $opening = $res_lists->opening;
                                                        $clossing = $res_lists->clossing;
                                                    }
                                                }
                                                $counts = 1;
                                                $queryDup = "select * from income where income_date =  '" . $date . "' ";
                                                if (DB::getInstance()->checkRows($queryDup)) {
                                                    $res_lists = DB::getInstance()->query($queryDup);
                                                    foreach ($res_lists->results() as $res_lists) {
                                                        $counts ++;
                                                    }
                                                }
                                                
                                                $queryDup = "select * from payments where payment_date =  '" . $date . "' ";
                                                if (DB::getInstance()->checkRows($queryDup)) {
                                                    $res_lists = DB::getInstance()->query($queryDup);
                                                    foreach ($res_lists->results() as $res_lists) {
                                                        $counts ++;
                                                    }
                                                }

                                                $queryDup = "select * from expenditure where exp_date =  '" . $date . "' ";
                                                if (DB::getInstance()->checkRows($queryDup)) {
                                                    $res_lists = DB::getInstance()->query($queryDup);
                                                    foreach ($res_lists->results() as $res_lists) {
                                                        $counts ++;
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td rowspan="<?php echo $counts; ?>"><?php echo $date; ?></td>
                                                    <td  ><strong> <font color="blue">balance brought forward (b/f) </font> </strong> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong> <font color="blue"> <?php echo number_format($opening). ' ugx'; ?> </font> </strong></td>
                                                </tr>
                                                <tr>

                                                    <?php
                                                    
                                                    $queryDup = "select * from income  where income_date =  '" . $date . "'  ";
                                                    if (DB::getInstance()->checkRows($queryDup)) {
                                                        $res_lists = DB::getInstance()->query($queryDup);
                                                        foreach ($res_lists->results() as $users_list) :

                                                            $balance += $users_list->income_amount;
                                                            ?>
                                                            <td><?php echo $users_list->income_description; ?></td>

                                                            <td><?php echo number_format($users_list->income_amount) .' ugx'; ?></td>
                                                            <td></td>
                                                            <td><?php echo number_format($balance) .' ugx'; ?></td>

                                                        </tr>
                                                        <tr>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    
                                                    
                                                    $queryDup = "select * from payments P,student_info s  where s.student_id = p.student_id and payment_date =  '" . $date . "'  ";
                                                    if (DB::getInstance()->checkRows($queryDup)) {
                                                        
                                                        ?>
                                                            <?php
                                                        $res_lists = DB::getInstance()->query($queryDup);
                                                        foreach ($res_lists->results() as $users_list) :

                                                            $balance += $users_list->amount_paid;
                                                            ?>
                                                            <td> Fees payment for <?php echo $users_list->fname.' '.$users_list->sname; ?> receipt no: <?php echo $users_list->receipt_no  ?></td>

                                                            <td><?php echo number_format($users_list->amount_paid) .' ugx'; ?></td>
                                                            <td></td>
                                                            <td><?php echo number_format($balance) .' ugx'; ?></td>

                                                        </tr>
                                                        <tr>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    
                                                    $queryDup = "select * from expenditure where exp_date =  '" . $date . "' ";
                                                    if (DB::getInstance()->checkRows($queryDup)) {
                                                        $res_lists = DB::getInstance()->query($queryDup);
                                                        foreach ($res_lists->results() as $users_list) :
                                                            $balance -= $users_list->exp_amount;
                                                            ?>
                                                            <td><?php echo $users_list->exp_description; ?></td>

                                                            <td></td>
                                                            <td><?php echo number_format($users_list->exp_amount).' ugx'; ?></td>
                                                            <td><?php echo number_format($balance).' ugx'; ?></td>

                                                        </tr>

                                                        <?php
                                                    endforeach;
                                                }
                                                ?>  


                                                <?php
                                                $no++;
                                            endforeach;
                                            ?>

                                            <caption>  <?php echo "FROM:" . $date_from . " TO: " . $date_to . " "; ?> </caption>


                                            <?php
                                        } else {
                                            echo '<b style="color:red">No Payments was found for this Class!</b>';
                                        }
                                        ?>

                                    </table>


                                    <?php
                                }
                                ?>

                                <?php
                                if ($flag > 0) {
                                    ?>

                                    <div class = "form-control">
                                        <label> Export As: </label> &nbsp;
                                        &nbsp;
                                        <a href = "index.php?page=cash_book_dates_excel&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>" class = "label label-default"> <i class = "fa fa-external-link-square"></i> Excel </a>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <a target="_blank" href = "index.php?page=cash_book_dates_pdf&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>" class = "label label-default"> <i class = "fa fa-bookmark-o"></i> Pdf </a>

                                    </div>

                                    <?php
                                }
                                ?>

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
