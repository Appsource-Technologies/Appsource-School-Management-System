
<?php echo error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Fees structure'; ?></title>

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
                    <div class="col-sm-10">

                        <h2> <i class="fa fa-plus-circle"></i> <strong> Add Students Fees Payments </strong></h2>

                    </div>
                    <div class="col-sm-2">
                        <br/>

                        <a href="index.php?page=payment_list">  <button class="btn btn-info">  [ <i class="fa fa-area-chart"></i> Payment Lists ] </button> </a>

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

//                                   
                                        //if (Input::exists() && Input::get('class') == '' && Input::get('term') == '') {
                                        echo "<font color='blue'> Please Make sure You first selected Class and Term </font>";
                                        // } elseif (Input::exists() && Input::get('class') == '' && Input::get('term') != '') {
                                        echo "<font color='blue'> Please You had not selected the Class </font>";
                                        //} else
                                        if (Input::exists() && Input::get('class') != '' && Input::get('term') == '' && Input::get('year') != '' && Input::get('amount') == '' && Input::get('receipt_no') == '' && Input::get('student') == '') {
                                            echo "<font color='blue'> You had not selected the Term ! </font>";

                                            $class = Input::get('class');
                                            //$term = Input::get('term');
                                            $year = Input::get('year');

                                            $name1 = "";
                                            $name2 = "";
                                            $name3 = "";


                                            $queryDup = "select class_name from class where  class_id = '" . $class . "' ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                $res_lists = DB::getInstance()->query($queryDup);
                                                foreach ($res_lists->results() as $res_lists) :
                                                    $name1 = $res_lists->class_name;
                                                endforeach;
                                            }
                                        }

                                        $queryDup = "select term_name from terms where  terms_id = '" . $term . "' ";
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            $res_lists = DB::getInstance()->query($queryDup);
                                            foreach ($res_lists->results() as $res_lists):
                                                $name2 = $res_lists->term_name;
                                            endforeach;
                                        }


                                        $queryDup = "select a_yr from academic_yr where  a_yr_id = '" . $year . "' ";
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            $res_lists = DB::getInstance()->query($queryDup);
                                            foreach ($res_lists->results() as $res_lists):
                                                $name3 = $res_lists->a_yr;
                                            endforeach;
                                        }


                                        header("location:index.php?page=add_students_payment&class_id=" . $class . "&a_yr_id=" . $year . "&class_name=" . $name1 . "&a_yr=" . $name3 . "&action=update");



                                        if (Input::exists() && Input::get('class') != '' && Input::get('term') != '' && Input::get('year') != '' && Input::get('amount') == '' && Input::get('receipt_no') == '' && Input::get('student') == '') {

                                            $class = Input::get('class');
                                            $term = Input::get('term');
                                            $year = Input::get('year');

                                            $name1 = "";
                                            $name2 = "";
                                            $name3 = "";


                                            $queryDup = "select class_name from class where  class_id = '" . $class . "' ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                $res_lists = DB::getInstance()->query($queryDup);
                                                foreach ($res_lists->results() as $res_lists) :
                                                    $name1 = $res_lists->class_name;
                                                endforeach;
                                            }


                                            $queryDup = "select term_name from terms where  terms_id = '" . $term . "' ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                $res_lists = DB::getInstance()->query($queryDup);
                                                foreach ($res_lists->results() as $res_lists):
                                                    $name2 = $res_lists->term_name;
                                                endforeach;
                                            }


                                            $queryDup = "select a_yr from academic_yr where  a_yr_id = '" . $year . "' ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                $res_lists = DB::getInstance()->query($queryDup);
                                                foreach ($res_lists->results() as $res_lists):
                                                    $name3 = $res_lists->a_yr;
                                                endforeach;
                                            }
                                            header("location:index.php?page=add_students_payment&class_id=" . $class . "&term_id=" . $term . "&a_yr_id=" . $year . "&class_name=" . $name1 . "&term_name=" . $name2 . "&a_yr=" . $name3 . "&action=update");
                                        }

                                        if (Input::exists() && Input::get('class') != '' && Input::get('term') != '' && Input::get('year') != '' && Input::get('amount') != '' && Input::get('receipt_no') != '' && Input::get('student') != '') {

                                            /** Set default timezone (will throw a notice otherwise) */
                                            date_default_timezone_set('Africa/Nairobi');
                                            $date = date("Y-m-d");
                                            $time = date("H:m:s");
                                            
                                            $class = Input::get('class');
                                            $term = Input::get('term');
                                            $year = Input::get('year');
                                            $student = Input::get('student');
                                            $receipt_no = Input::get('receipt_no');
                                            $slip_no = Input::get('slip_no');
                                            $amount = Input::get('amount');
                                            
                                            
                                            /// Updates the cash book here....
                                            
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
                                            
                                            
                                            
                                            
                                            
                                            $queryInsert = DB::getInstance()->insert('payments', array(
                                                'payment_date' => $date,
                                                'receipt_no' => $receipt_no,
                                                'slip_no' => $slip_no,
                                                'a_yr_id' => $year,
                                                'class_id' => $class,
                                                'terms_id' => $term,
                                                'amount_paid' => $amount,
                                                'student_id' => $student
                                            ));
                                            $f = 0;
                                            if ($queryInsert) {
                                                $msg = "<h5 align='center' ><strong><font color='green' size='2px'>Thanks.. Payment of '" . number_format($amount) . "' Ugx for Student id '" . $student . " with receipt no: '" . $receipt_no . "' has been Submitted Successfully! ' </font></strong></h5>";
                                            } else {
                                                $f = 1;
                                                $msg = "<h5 align='center' ><strong><font color='red' size='2px'> Sorry, An Error Occured while submitting the Payment Details! </font></strong></h5>";
                                            }

                                            header("location:index.php?page=add_students_payment&msg=" . $msg . "&f=" . $f);
                                        }
                                        /** if (Input::exists() && Input::get('class') != '' && Input::get('term') != '' && Input::get('year') != '' && Input::get('student') != '' && Input::get('receipt_no') != '' && Input::get('amount') != '') {
                                          }
                                          }

                                          echo "<font color='blue'> Payments Added ! </font>";
                                          header("location:index.php?page=add_students_payment");
                                          } * */
                                    }
                                    ?>
                                    <form action="" onsubmit="return confirm('Are you sure  you want to submit this Payments  Details? ');" method="POST" role="form">
                                        <div class="form-group">
                                            <?php
                                            if (@$_GET['msg'] && @$_GET['f'] == '0') {
                                                ?>
                                                <div class="alert alert-info"> <?php echo $_GET['msg']; ?> </div>
                                            <?php } else { ?>
                                                <?php echo @$_GET['msg']; ?>
                                            <?php } ?>
                                            <label>Class Name <sup style="color: red">*</sup></label>
                                            <input type="hidden" name="back_page" value="<?php echo @$_GET['back_page']; ?>"/>
                                            <select name="class"  class="form-control" required>


                                                <?php
                                                if (@$_GET['class_name'] != '') {
                                                    ?> 
                                                    <option value="<?php echo $_GET['class_id']; ?>"><?php echo $_GET['class_name']; ?></option>

                                                <?php } ?>
                                                <?php echo DB::getInstance()->dropDowns('class', 'class_id', 'class_name'); ?>

                                            </select>


                                        </div>
                                        <div  class="form-group">
                                            <label> Term <sup style="color: red">*</sup></label>
                                            <select name="term" class="form-control" required>
                                                <?php
                                                if (@$_GET['term_id']) {
                                                    ?> 
                                                    <option value="<?php echo $_GET['term_id']; ?>"><?php echo $_GET['term_name']; ?></option>

                                                <?php } ?>
                                                <?php echo DB::getInstance()->dropDowns('terms', 'terms_id', 'term_name'); ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Academic Year <sup style="color: red">*</sup></label>
                                            <select name="year" onchange="this.form.submit()" class="form-control" required>
                                                <?php
                                                if (@$_GET['a_yr'] != '') {
                                                    ?> 
                                                    <option value="<?php echo $_GET['a_yr_id']; ?>"><?php echo $_GET['a_yr']; ?></option>

                                                <?php } ?>
                                                <?php echo DB::getInstance()->dropDowns('academic_yr', 'a_yr_id', 'a_yr'); ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Student Name <sup style="color: red">*</sup></label>
                                            <select name="student"  id="country"  class="form-control" required>
                                                <?php
                                                $flag = 0;
                                                if (@$_GET['class_id']) {
                                                    $class_id = $_GET['class_id'];
                                                    $a_yr_id = $_GET['a_yr_id'];

                                                    $queryDup = "select * from student_info where  class_id = '" . $class_id . "' and a_yr_id = '" . $a_yr_id . "' ";
                                                    if (DB::getInstance()->checkRows($queryDup)) {
                                                        $res_lists = DB::getInstance()->query($queryDup);
                                                        foreach ($res_lists->results() as $res_lists) :
                                                            $flag = 1;
                                                            ?>
                                                            <option value="<?php echo $res_lists->student_id; ?>"><?php echo $res_lists->fname . " " . $res_lists->sname; ?></option>

                                                            <?php
                                                        endforeach;
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Receipt no <sup style="color: red">*</sup></label>

                                            <?php if ($flag == 0) { ?>
                                                <input type="hidden" name="receipt_no" value=""/> 
                                                <input type="hidden" name="amount" value=""/>
                                                <input type="hidden" name="student" value=""/>
                                                 <input type="hidden" name="slip_no" value=""/>
                                            <?php } ?>
                                            <input name="receipt_no" <?php if ($flag != 1) { ?> disabled <?php } ?> type="text" value="<?php echo @$_GET['receipt_no']; ?>" placeholder="e.g RC12351" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Slip Number <sup style="color: red">*</sup></label>
                                            <input name="slip_no" <?php if ($flag != 1) { ?> disabled <?php } ?>  type="text" value="<?php echo @$_GET['slip_no']; ?>" placeholder="e.g S12345" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Fees Amount <sup style="color: red">*</sup></label>
                                            <input name="amount" <?php if ($flag != 1) { ?> disabled <?php } ?>  type="number" value="<?php echo @$_GET['amount']; ?>" placeholder="e.g 450000" class="form-control" required>
                                        </div>



                                        <div class="form-group">
                                            
                                            <button  type="submit" <?php if ($flag != 1) { ?> disabled <?php } ?> class="btn btn-info"> <i class="fa fa-plus-circle"></i> Submit Fees Payments </button>
                                            <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-8">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content dataTable dataTables_scrollBody table table-responsive">

                                    <?php ?>
                                    <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >
                                        <caption> Student's Record </caption>
                                        <thead>
                                            <tr>
                                                <th>ID.</th>
                                                <th>Fname</th>
                                                <th>SName</th>
                                                <th>Gender</th>
                                                <th>Class</th>
                                                <th>Year</th>
                                                <th>Students Category</th>

                                                <!--
                                                 <th>Give Out</th> -->
                                            </tr>
                                        </thead>

                                        <?php
                                        if (@$_GET['action']) {
                                            $class_id = $_GET['class_id'];
                                            $a_yr_id = $_GET['a_yr_id'];

                                            $queryDup = "select * from student_info s,class c,academic_yr a where  s.class_id = '" . $class_id . "' and s.a_yr_id = '" . $a_yr_id . "' and s.a_yr_id = a.a_yr_id and s.class_id = c.class_id ";
                                            if (DB::getInstance()->checkRows($queryDup)) {
                                                ?>
                                                <tbody>
                                                    <?php
                                                    $res_lists = DB::getInstance()->query($queryDup);
                                                    $no = 1;
                                                    foreach ($res_lists->results() as $res_lists) :
                                                        ?>

                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td  style="text-transform: capitalize"><?php echo $res_lists->fname; ?></td>
                                                            <td> <?php echo $res_lists->sname; ?></td>
                                                            <td><?php echo $res_lists->sex; ?></td>
                                                            <td><?php echo $res_lists->class_name; ?></td>
                                                            <td><?php echo $res_lists->a_yr; ?></td>
                                                            <td><?php echo $res_lists->category; ?></td>

                                                        </tr>  
                                                        <?php
                                                        $no++;
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                                <?php
                                            }else {
                                                echo '<b style="color:red"> No Students Enrolled for Selected Class</b>';
                                            }
                                        }
                                        ?>
                                    </table>





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
