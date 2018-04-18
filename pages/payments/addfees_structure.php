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
                        <?php
                        if (@$_GET['action']) {
                            ?> 
                            <h2> <i class="fa fa-edit"></i>  <strong> Update Fees Structure </strong></h2>
                        <?php } else {
                            ?>
                            <h2> <i class="fa fa-plus-circle"></i> <strong> Add Fees Structure </strong></h2>
                        <?php } ?>
                    </div>
                    <div class="col-sm-2">
                        <br/>
                        <?php
                        if (@$_GET['list']) {
                            ?>
                            <a href="index.php?page=payment_list">  <button class="btn btn-info">  [ <i class="fa fa-area-chart"></i> Payment Lists ] </button> </a>
                        <?php } else {
                            ?>
                            
                             <a href="index.php?page=view_fees_structures">  <button class="btn btn-info">  [ <i class="fa fa-bank"></i> View Fees Structure ] </button> </a>
                        <?php } ?>
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
//                                     $full_names= Input::get("full_names");
                                        $class = Input::get("class");
                                        $back_page = Input::get("back_page");
                                        $term = Input::get("term");
                                        $status = 1;
                                        $year = Input::get("year");
                                        $category = Input::get("category");
                                        $amount = Input::get("amount");
                                        $queryDup = "select * from fees_structure "
                                                . "where terms_id='" . $term . "' and a_yr_id = '" . $year . "' and class_id = '" . $class . "' and category = '" . $category . "'  ";
                                        if (DB::getInstance()->checkRows($queryDup)) {


                                            $queryUPDATE = "UPDATE fees_structure SET amount = '" . $amount . "'  "
                                                    . "where terms_id='" . $term . "' and a_yr_id = '" . $year . "' and class_id = '" . $class . "' and category = '" . $category . "' ";
                                            $queryUpdated = DB::getInstance()->query($queryUPDATE);
                                            if ($queryUpdated) {
                                                echo "<h5 align='center' ><strong><font color='green'> Fees Structure Updated  Successfully!.</font></strong></h5>";

                                                header("refresh:2;url=index.php?page=".$back_page);
                                            } else {
                                                echo "<h5 align='center' ><strong><font color='red'> Error Occured while updating Fees Structure !.</font></strong></h5>";
                                            }
                                            //header("refresh:1;url=index.php?page=add_users");
                                            //exit();
                                        } else {
                                            $queryInsert = DB::getInstance()->insert('fees_structure', array(
                                                'terms_id' => $term,
                                                'a_yr_id' => $year,
                                                'class_id' => $class,
                                                'category' => $category,
                                                'amount' => $amount
                                            ));
                                            if ($queryInsert) {
                                                echo "<h5 align='center' ><strong><font color='green' size='2px'> Fees Structure added  Successfully! </font></strong></h5>";
                                            }
                                        }
                                    }
                                    ?>
                                    <form action="" onsubmit="return confirm('Are you sure  you want to submit this Details? ');" method="POST" role="form">
                                        <div class="form-group">
                                            <label>Class Name <sup style="color: red">*</sup></label>
                                             <input type="hidden" name="back_page" value="<?php echo @$_GET['back_page']; ?>"/>
                                            <select name="term" class="form-control" required>
                                              
                                                <?php
                                                if (@$_GET['action']) {
                                                    ?> 
                                                    <option value="<?php echo $_GET['class_id']; ?>"><?php echo $_GET['class_name']; ?></option>

                                                <?php } ?>
                                                <?php echo DB::getInstance()->dropDowns('class', 'class_id', 'class_name'); ?>
  
                                            </select>
                                               
                                           
                                        </div>
                                        <div class="form-group">
                                            <label> Term <sup style="color: red">*</sup></label>
                                            <select name="term" class="form-control" required>
                                                <?php
                                                if (@$_GET['action']) {
                                                    ?> 
                                                    <option value="<?php echo $_GET['terms_id']; ?>"><?php echo $_GET['term_name']; ?></option>

                                                <?php } ?>
                                                <?php echo DB::getInstance()->dropDowns('terms', 'terms_id', 'term_name'); ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Academic Year <sup style="color: red">*</sup></label>
                                            <select name="year" class="form-control" required>
                                                <?php
                                                if (@$_GET['action']) {
                                                    ?> 
                                                    <option value="<?php echo $_GET['a_yr_id']; ?>"><?php echo $_GET['a_yr']; ?></option>

                                                <?php } ?>
                                                <?php echo DB::getInstance()->dropDowns('academic_yr', 'a_yr_id', 'a_yr'); ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Category <sup style="color: red">*</sup></label>
                                            <select name="category" class="form-control" required>
                                                <?php
                                                if (@$_GET['action']) {
                                                    ?> 
                                                    <option value="<?php echo $_GET['category']; ?>"><?php echo $_GET['category']; ?></option>

                                                <?php } else { ?>
                                                    <option value="">---SELECT---- </option>
                                                <?php } ?>
                                                <option value="Boarder"> Boarding Students</option>
                                                <option value="Day"> Day Students</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label> Fees Amount <sup style="color: red">*</sup></label>
                                            <input name="amount" type="number" value="<?php echo $_GET['amount']; ?>" placeholder="e.g 450000" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <hr/>

                                            <?php
                                            if (@$_GET['action']) {
                                                ?> 
                                                <button type="submit" class="btn btn-warning"> <i class="fa fa-edit"></i> Update Fees Structure </button>

                                            <?php } else {
                                                ?>
                                                <button type="submit" class="btn btn-info"> <i class="fa fa-plus-circle"></i> Add Fees Structure </button>
                                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-8">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content dataTable dataTables_scrollBody table table-responsive">

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
                                    $queryDup = "select amount,category,a_yr,term_name,class_name from fees_structure f,class c,terms t,academic_yr y where f.terms_id=t.terms_id and f.a_yr_id=y.a_yr_id and f.class_id=c.class_id";
                                    if (DB::getInstance()->checkRows($queryDup)) {
                                        ?>
                                        <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >
                                            <caption> Fees Structures</caption>
                                            <thead>
                                                <tr>
                                                    <th>ID.</th>
                                                    <th>Class</th>
                                                    <th>Term</th>
                                                    <th>Year</th>
                                                    <th>Category</th>
                                                    <th>Amount</th>

                                                    <!--
                                                     <th>Give Out</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $users_list = DB::getInstance()->query($queryDup);
                                                $no = 1;
                                                foreach ($users_list->results() as $users_list) :
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td  style="text-transform: capitalize"><?php echo $users_list->class_name; ?></td>
                                                        <td> <?php echo $users_list->term_name; ?></td>
                                                        <td><?php echo $users_list->a_yr; ?></td>
                                                        <td><?php echo $users_list->category; ?></td>
                                                        <td><?php echo $users_list->amount; ?></td>

                                                    </tr>  
                                                    <?php
                                                    $no++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>



                                        <?php
                                    }else {
                                        echo '<b style="color:red">No Class Teachers Available</b>';
                                    }
                                    ?>

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
