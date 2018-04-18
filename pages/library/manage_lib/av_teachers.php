<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Lend Book'; ?></title>

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
                    <div class="col-sm-4">
                        <h2><strong>Lend Out Books</strong></h2>
                    </div>
                </div>

                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="ibox float-e-margins">
                                <div class="ibox-content">

                                    <form action="" method="POST" role="form">

                                        <div class="form-group">
                                            <label>Select Either Teacher or Student <sup style="color: red">*</sup></label>
                                            <select name="page" onchange="window.location = this.value" class="form-control" required>
                                                <option value="#"> --- Selected Teacher --- </option>
                                                <option value="index.php?page=lib_students"> Student</option>
                                                
                                            </select>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Teachers query and table starts here ...... -----> 

                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
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
                                $queryDup = "select  teacher_id,fname,sname,contact,email,sex from teachers order by teacher_id";
                                if (DB::getInstance()->checkRows($queryDup)) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover " id="editable" >
                                        <caption>Teacher's Record</caption>
                                        <thead>
                                            <tr>
                                                <th>ID.</th>
                                                <th>First Names</th>
                                                <th>Second Names</th>
                                                <th>Mobile Contact</th>
                                                <th>Email Address</th>
                                                <th>Gender</th>
                                                <th>Give Book</th>
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
                                                    <td  style="text-transform: capitalize"><?php echo $users_list->fname; ?></td>
                                                    <td><?php echo $users_list->sname; ?></td>
                                                    <td><?php echo $users_list->contact; ?></td>
                                                    <td><?php echo $users_list->email; ?></td>
                                                    <td><?php echo $users_list->sex; ?></td>
                                                    <td>
                                                        <a href="index.php?page=give_teacherbook&action=give_out_book&class_teacher_id=<?php echo $users_list->teacher_id . '&token=' . Token::generate(); ?>"  class="btn btn-warning btn-xs"><i class="fa fa-shopping-cart"></i> Give out </a>
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
