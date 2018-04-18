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
                    <div class="col-sm-10">
                        <h2><i class="fa fa-bank"></i> <strong> Fees Structures <font color="green"> </font></strong></h2>
                    </div>
                    <div class="col-sm-2">
                        <br/>
                        <a href="index.php?page=addfees_structure">  <button class="btn btn-info">  [ <i class="fa fa-plus-circle"></i> Add Fees Structure ] </button> </a>
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
                                $queryDup = "select * from fees_structure f,class c,terms t,academic_yr y where f.terms_id=t.terms_id and f.a_yr_id=y.a_yr_id and f.class_id=c.class_id";
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
                                                <th>Update</th>

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
                                                    <td> <label class="label label-info"> <?php echo number_format($users_list->amount); ?> </label></td>
                                                    
                                                    <td>
                                                        <a href="index.php?page=addfees_structure&action=update_fees&term_name=<?php echo $users_list->term_name; ?>&a_yr=<?php echo $users_list->a_yr; ?>&category=<?php echo $users_list->category; ?>&amount=<?php echo $users_list->amount; ?>&class_name=<?php echo $users_list->class_name; ?>&terms_id=<?php echo $users_list->terms_id; ?>&a_yr_id=<?php echo $users_list->a_yr_id; ?>&class_id=<?php echo $users_list->class_id; ?>&back_page=view_fees_structures" class="label label-warning-light"   title="Click to edit!"><i class="fa fa-edit"></i> Edit </a>
                                                    
                                                    </td>

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
