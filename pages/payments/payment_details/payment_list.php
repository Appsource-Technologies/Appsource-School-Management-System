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
                        <h2> <i class="fa fa-area-chart"></i> <strong> Payment Lists </strong></h2>
                    </div>
                    <div class="col-sm-2">
                        <br/>
                        <a href="index.php?page=add_students_payment&list=list">  <button class="btn btn-info">  [ <i class="fa fa-plus-circle"></i> Add Student's Payment ] </button> </a>
                    </div>
                </div>

                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="ibox float-e-margins">
                                <div class="ibox-content">

                                    <form action="" method="POST" role="form">

                                        <div class="col-sm-4">
                                            <label> Class <sup style="color: red">*</sup></label>
                                            <select name="class" class="form-control" required>
                                                <?php echo DB::getInstance()->dropDowns('class', 'class_id', 'class_name'); ?>

                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label> Term <sup style="color: red">*</sup></label>
                                            <select name="term" class="form-control" required>
                                                <?php echo DB::getInstance()->dropDowns('terms', 'terms_id', 'term_name'); ?>

                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label> Academic Year <sup style="color: red">*</sup></label>
                                            <select name="year" onchange="this.form.submit()" class="form-control" required>
                                                <?php echo DB::getInstance()->dropDowns('academic_yr', 'a_yr_id', 'a_yr'); ?>

                                            </select>
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
                                if (Input::exists() && Input::get('class') == '' && Input::get('term') == '') {
                                    echo "<font color='blue'> Please Make sure You first selected Class and Term </font>";
                                } elseif (Input::exists() && Input::get('class') == '' && Input::get('term') != '') {
                                    echo "<font color='blue'> Please You have not selected the Class </font>";
                                } elseif (Input::exists() && Input::get('class') != '' && Input::get('term') == '') {
                                    echo "<font color='blue'> You Have not selected the Term ! </font>";
                                } else if (Input::exists() && Input::get('class') != '' && Input::get('term') != '' && Input::get('year') != '') {
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
                                    ?>
                                    <table class="table table-striped table-bordered table-hover " id="editable" >

                                        <thead>
                                            <tr>
                                                <th>ID.</th>
                                                <th>First Names</th>
                                                <th>Second Names</th>
                                                <th>Gender</th>
                                                <th>Class</th>
                                                <th>Term</th>
                                                <th>Year</th>
                                                <th>Receipt no.</th>
                                                <th>Amount Paid</th>
                                                <th>Balance</th>
                                                <th>Make Payments</th>
                                            </tr>
                                        </thead>

                                        <?php
                                        //Query to select all class teachers
                                        $queryDup = "select * from student_info s,class c,academic_yr y,terms t,payments p where(p.student_id=s.student_id and  p.class_id=c.class_id and p.a_yr_id=y.a_yr_id and p.terms_id=t.terms_id and p.class_id='" . $class . "' and p.terms_id='" . $term . "' and p.a_yr_id='" . $year . "' )";
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            ?>

                                            <tbody>
                                                <?php
                                                $flag ++;
                                                $users_list = DB::getInstance()->query($queryDup);
                                                $no = 1;
                                                foreach ($users_list->results() as $users_list) :

                                                    $amt_set = 0;
                                                    $category = $users_list->category;
                                                    $queryDup = "select amount from fees_structure where  terms_id = '" . $term . "' and class_id = '" . $class . "' and a_yr_id = '" . $year . "' and category = '$category' ";
                                                    if (DB::getInstance()->checkRows($queryDup)) {
                                                        $res_lists = DB::getInstance()->query($queryDup);
                                                        foreach ($res_lists->results() as $res_lists) {
                                                            $amt_set = $res_lists->amount;
                                                        }
                                                    }
                                                    $paid = $users_list->amount_paid;
$bal_flag = 0;

                                                    if ($amt_set > $paid) {
                                                        $t = $amt_set - $paid;
                                                        $bal_flag = 1;
                                                        $bal = number_format($t) . ' /=';
                                                    } else if ($amt_set < $paid && $amt_set != 0) {
                                                        $ext = $paid - $amt_set;
                                                        $bal_flag = 0;
                                                        $bal = number_format($ext) . " /= <font color='blue'>[extra]</font>";
                                                    } else if ($amt_set == 0) {
                                                        $bal = 'Not Set';
                                                        $bal_flag = 0;
                                                    }

                                                    $name1 = $users_list->class_name;
                                                    $name2 = $users_list->term_name;
                                                    $name3 = $users_list->a_yr;
      
                                                    $class_id = $users_list->class_id;
                                                    $term_id = $users_list->terms_id;
                                                    $year_id = $users_list->a_yr_id;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td  style="text-transform: capitalize"><?php echo $users_list->fname; ?></td>
                                                        <td><?php echo $users_list->sname; ?></td>
                                                        <td><?php echo $users_list->sex; ?></td>
                                                        <td><?php echo $users_list->class_name; ?></td>
                                                        <td><?php echo $users_list->term_name; ?></td>
                                                        <td><?php echo $users_list->a_yr; ?></td>
                                                        <td> <label class="label label-info"> <?php echo $users_list->receipt_no; ?> </label></td>
                                                        <td><?php echo number_format($users_list->amount_paid) . ' /='; ?></td>
                                                        <td><?php
                                                            if ($bal != 'Not Set') {
                                                                echo $bal;
                                                            } else {
                                                                ?>
                                                                <a href="index.php?page=addfees_structure&action=update_fees&term_name=<?php echo $users_list->term_name; ?>&a_yr=<?php echo $users_list->a_yr; ?>&category=<?php echo $users_list->category; ?>&amount=<?php echo $users_list->amount; ?>&class_name=<?php echo $users_list->class_name; ?>&terms_id=<?php echo $users_list->terms_id; ?>&a_yr_id=<?php echo $users_list->a_yr_id; ?>&class_id=<?php echo $users_list->class_id; ?>&back_page=payment_list&list=list" class="label label-danger"   title="Click to edit!"><i class="fa fa-edit"></i> Fees Not Set </a>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <a href=""  class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Edit </a>
                                                          
                                                          <?php if($bal_flag == 1){ ?>  
                                                            <a href="" class="btn btn-warning btn-xs"><i class="fa fa-paypal"></i> Pay Balance </a>
                                                          <?php } ?>
                                                        </td>
                                                    </tr>  
                                                    <?php
                                                    $no++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <caption>  <?php echo "Class:" . $name1 . "\tTerm: " . $name2 . "\t Academic: " . $name3 . " "; ?> </caption>


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
                                        <a href = "index.php?page=export_payment_lists_excel&class=<?php echo $class_id; ?>&term=<?php echo $term_id; ?>&year=<?php echo $year_id; ?>" class = "label label-default"> <i class = "fa fa-external-link-square"></i> Excel </a>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <a target="_blank" href = "index.php?page=export_payment_lists_pdf&class=<?php echo $class_id; ?>&term=<?php echo $term_id; ?>&year=<?php echo $year_id; ?>" class = "label label-default"> <i class = "fa fa-bookmark-o"></i> Pdf </a>

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
