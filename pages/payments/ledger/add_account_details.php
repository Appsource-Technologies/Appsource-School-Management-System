<?php echo error_reporting(E_ALL); ?>

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
                        <h2><strong><i class="fa fa-coffee"></i> Add <?php echo @$_GET['source_type']; ?></strong></h2>
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
                                        /**  Set the Default Date to East African time  ********************** */
                                        date_default_timezone_set('Africa/Nairobi');
                                        $date = date("Y-m-d");
                                        $time = date("H:m:s");

                                        $source_id = Input::get("source_id");
                                        $source_type = Input::get("source_type");

                                        $description = Input::get("descriptions");
                                        $other_details = Input::get("other_details");
                                        $amount = Input::get("amount");

                                        $status = 1;

                                        if ($source_type == 'Income') {

                                            /** Source is income * */
                                            // $queryDup = 'select * from income_source where income_name="' . $source_name . '"';

                                            $bookInsert = DB::getInstance()->insert('income', array(
                                                'income_source_id' => $source_id,
                                                'income_amount' => $amount,
                                                'income_description' => $description,
                                                'other_details' => $other_details,
                                                'income_date' => $date,
                                                'income_time' => $time,
                                                'user_id' => $_SESSION['school_user_id']
                                            ));


                                            $openning = 0;
                                            $clossing = 0;
                                            $cash_in = 0;
                                            $cash_out = 0;

                                            $queryDup = "select * from cash_flow order by cash_flow_id desc limit 1 ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                $res_lists = DB::getInstance()->query($queryDup);
                                                foreach ($res_lists->results() as $res_lists):

                                                    $cash_flow_id = $res_lists->cash_flow_id;
                                                    $cash_date = $res_lists->cash_date;

                                                    if ($cash_date == $date) {
                                                        $openning = $res_lists->opening;
                                                        $revenue = $res_lists->revenue + $amount;
                                                        $expenditure = $res_lists->expenditure;
                                                        $clossing = $openning + $revenue - $expenditure;
                                                        /** Update Cash book **** */
                                                        $queryUPDATE = "UPDATE cash_flow SET revenue = '" . $revenue . "',clossing = '" . $clossing . "', cash_time = '" . $time . "'  WHERE (cash_flow_id='" . $cash_flow_id . " ' )";
                                                        DB::getInstance()->query($queryUPDATE);
                                                    } else {
                                                        /** Update new row into the Cash book **** */
                                                        $openning = $res_lists->clossing;
                                                        $revenue = $amount;
                                                        $expenditure = 0;
                                                        $clossing = $openning + $revenue;

                                                        DB::getInstance()->insert('cash_flow', array(
                                                            'cash_date' => $date,
                                                            'cash_time' => $time,
                                                            'opening' => $openning,
                                                            'clossing' => $clossing,
                                                            'revenue' => $revenue,
                                                            'expenditure' => $expenditure
                                                        ));
                                                    }


                                                endforeach;
                                            } else {

                                                /** Inserting record in the Cash book for the first time *** */
                                                $openning = 0;
                                                $revenue = $amount;
                                                $expenditure = 0;
                                                $clossing = $revenue;
                                                DB::getInstance()->insert('cash_flow', array(
                                                    'cash_date' => $date,
                                                    'cash_time' => $time,
                                                    'opening' => $openning,
                                                    'clossing' => $clossing,
                                                    'revenue' => $revenue,
                                                    'expenditure' => $expenditure
                                                ));
                                            }



                                            if ($bookInsert) {
                                                $msg = "<h5 align='center' ><strong><font color='green' size='2px'> Thank.. Income Details saved !</font></strong></h5>";
                                                header("location:index.php?page=add_account_details&source_type=Income&msg=" . $msg);
                                            } else {
                                                echo "<h5 align='center' ><strong><font color='red'> Error Occured while saving the income details!.</font></strong></h5>";
                                            }
                                        } else {
                                            /** Source is Expenditure * */
                                            $openning = 0;
                                            $clossing = 0;
                                            $cash_in = 0;
                                            $cash_out = 0;

                                            $exp_flag = 0;

                                            $queryDup = "select * from cash_flow order by cash_flow_id desc limit 1 ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                $res_lists = DB::getInstance()->query($queryDup);
                                                foreach ($res_lists->results() as $res_lists):

                                                    $cash_flow_id = $res_lists->cash_flow_id;
                                                    $cash_date = $res_lists->cash_date;

                                                    $amount_left = $res_lists->clossing;

                                                    if ($amount_left > $amount) {

                                                        if ($cash_date == $date) {
                                                            $openning = $res_lists->opening;
                                                            $revenue = $res_lists->revenue;
                                                            $expenditure = $res_lists->expenditure + $amount;
                                                            $clossing = $openning + $revenue - $expenditure;
                                                            /** Update Cash book **** */
                                                            $queryUPDATE = "UPDATE cash_flow SET expenditure = '" . $expenditure . "',clossing = '" . $clossing . "', cash_time = '" . $time . "'  WHERE (cash_flow_id='" . $cash_flow_id . " ' )";
                                                            DB::getInstance()->query($queryUPDATE);
                                                        } else {
                                                            /** Update new row into the Cash book **** */
                                                            $openning = $res_lists->clossing;
                                                            $revenue = 0;
                                                            $expenditure = $amount;
                                                            $clossing = $openning - $amount;

                                                            DB::getInstance()->insert('cash_flow', array(
                                                                'cash_date' => $date,
                                                                'cash_time' => $time,
                                                                'opening' => $openning,
                                                                'clossing' => $clossing,
                                                                'revenue' => $revenue,
                                                                'expenditure' => $amount
                                                            ));
                                                        }
                                                    } else {
                                                        $exp_flag = 1;
                                                        echo "<h5 align='center' ><strong><font color='red'> We are Sorry.. We Have less amount in our Account!.</font></strong></h5>";
                                                    }




                                                endforeach;
                                            }

                                            if ($exp_flag == 0) {
                                                $bookInsert = DB::getInstance()->insert('expenditure', array(
                                                    'expenditure_source_id' => $source_id,
                                                    'exp_amount' => $amount,
                                                    'exp_description' => $description,
                                                    'other_details' => $other_details,
                                                    'exp_date' => $date,
                                                    'exp_time' => $time,
                                                    'user_id' => $_SESSION['school_user_id']
                                                ));
                                                if ($bookInsert) {
                                                    $msg = "<h5 align='center' ><strong><font color='green' size='2px'> Thanks.. The Expense Details Saved !</font></strong></h5>";
                                                    header("location:index.php?page=add_account_details&source_type=Expenditure&msg=" . $msg);
                                                } else {
                                                    echo "<h5 align='center' ><strong><font color='red'> Error Occured while saving the Expense details!.</font></strong></h5>";
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
                                            <select name="source_id" class="form-control" required >
                                                <option value="">----SELECT---- </option>
<?php
if (@$_GET['source_type'] == 'Income') {
    $queryDup = 'select * from income_source where income_name != "Fees Payment" ';
    if (DB::getInstance()->checkRows($queryDup)) {
        $users_list = DB::getInstance()->query($queryDup);
        foreach ($users_list->results() as $users_list) {
            ?> 
                                                            <option value="<?php echo $users_list->income_source_id; ?> "> <?php echo $users_list->income_name; ?> </option>
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    echo DB::getInstance()->dropDowns('expenditure_source', 'expenditure_source_id', 'expenditure_name');
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>  <?php echo @$_GET['source_type']; ?> Amount <sup style="color: red">*</sup></label>
                                            <input name="amount" type="number" class="form-control" required>
                                        </div>

                                        <div class="form-group">
<?php if (@$_GET['source_type'] == 'Income') { ?>
                                                <label> Received From <sup style="color: red">*</sup></label>
                                            <?php } else { ?>

                                                <label> Delivered To <sup style="color: red">*</sup></label>
                                            <?php } ?>
                                            <textarea name="other_details" class="form-control" rows="2" placeholder=" Enter the source details here.."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label> <?php echo @$_GET['source_type']; ?> Descriptions/ Details <sup style="color: red">*</sup></label>
                                            <textarea name="descriptions" class="form-control" rows="4" required placeholder="Enter the details about the  <?php echo @$_GET['source_type']; ?>"></textarea>
                                        </div>



                                        <div >

                                            <hr/>
                                            <button type="submit" class="btn btn-info"> <i class="fa fa-coffee"></i> Submit <?php echo @$_GET['source_type']; ?></button>

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
