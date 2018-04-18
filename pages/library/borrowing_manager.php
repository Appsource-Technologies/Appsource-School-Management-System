<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Book Details'; ?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>
        <?php
        // if (isset($_GET['student_id'])) {
        $book_id = $_GET['book_id'];
        $queryDup = "select b.book_id as book_id,book_no,title,author,edition,quantity,subject,level,ISBN from book_type b,book_typecopy c where c.book_id=b.book_id and b.book_id = '" . $book_id . "'";

        //$queryDup = "select  student_id,fname,sname,sex,class_name,stream_name,comb_name,a_yr from student_info s,class c,streams sm,combinations cb,academic_yr y where  student_id = '" . $student . "' and s.class_id=c.class_id and s.stream_id=sm.stream_id and s.a_yr_id=y.a_yr_id and s.comb_id=cb.comb_id";
        if (DB::getInstance()->checkRows($queryDup)) {
            $users_list = DB::getInstance()->query($queryDup);
            foreach ($users_list->results() as $users_list) {


                $book_id = $users_list->book_id;
                $book_no = $users_list->book_no;
                $title = $users_list->title;
                $isbn = $users_list->ISBN;
                $author = $users_list->author;
                $edition = $users_list->edition;
                $quantity = $users_list->quantity;
                $subject = $users_list->subject;
                $level = $users_list->level;
            }
        }
        // }
        ?>

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
                        <h2><strong> <font color="green">  </font> <font color="blue">[ <?php echo $title; ?> ] </font></strong></h2>
                    </div>
                </div>


                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <?php
                    if (Input::exists()) {

                        if (Token::check(Input::get('token'))) {
                            //Student information .................
                            $student = Input::get('student_id');
                            $book_no = Input::get('book_no');

                            $status = 2;
                            $status1 = 1;
                            $queryUPDATE = "UPDATE book_student SET status = '" . $status . "'  WHERE (student_id='" . $student . "' AND book_no='" . $book_no . "' AND status = '" . $status1 . "' )";
                            $queryUpdated = DB::getInstance()->query($queryUPDATE);
                            if ($queryUpdated) {

                                echo "<h5 align='center' ><font color='green'> The Book has been Cleared Successfully !.</font></h5>";

                                header("refresh:2;url=index.php?page=clear_student&student_id=" . $student);
                            } else {
                                echo "<h5 align='center' ><strong><font color='red' size='2px'> An Error Occured while Clearing the Book Details!</font></strong></h5>";
                            }
                        }
                    }
                    ?>
                    <form action="" onsubmit="return confirm('Are you sure to clear the Book Borrowerd by: <?php echo $fname . ' ' . $sname; ?> ?');" method="POST" role="form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="ibox float-e-margins">
                                    <h4> Book Details </h4>
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label>ISBN <sup style="color: blue">*</sup></label>
                                            <input type="hidden" name="student_id" value="<?php echo $book_id; ?>"/>
                                            <p>
                                                <label class="label label-info"> <?php echo $isbn; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Book no <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $book_no; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Edition <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $edition; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Author <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $author; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Subject <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $subject; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Level <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $level; ?> </label>
                                            </p>
                                        </div>
                                        <br/>
                                        <hr/>
                                        <div class="form-group">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="ibox float-e-margins">
                                    <h4> More Details </h4>
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label>Quantities Brought In <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $quantity; ?> </label>
                                            </p>
                                        </div>
                                        <?php
                                        $status = 1;
                                        $b_quant1 = 0;
                                        $b_quant2 = 0;
                                        $queryDup = "select book_no from book_student where status = '" . $status . "' and book_no = '" . $book_no . "'";
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            $users_list = DB::getInstance()->query($queryDup);
                                            foreach ($users_list->results() as $users_list) {
                                                $b_quant1 ++;
                                            }
                                        }

                                        $total_std = 0;
                                        $queryDup = "select book_no from book_student where book_no = '" . $book_no . "'";
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            $users_list = DB::getInstance()->query($queryDup);
                                            foreach ($users_list->results() as $users_list) {
                                                $total_std ++;
                                            }
                                        }

                                        $queryDup2 = "select book_no from book_staff where status = '" . $status . "' and book_no = '" . $book_no . "'";
                                        if (DB::getInstance()->checkRows($queryDup2)) {
                                            $users_list = DB::getInstance()->query($queryDup2);
                                            foreach ($users_list->results() as $users_list) {
                                                $b_quant2 ++;
                                            }
                                        }
                                        $total_stf = 0;
                                        $queryDup2 = "select book_no from book_staff where book_no = '" . $book_no . "'";
                                        if (DB::getInstance()->checkRows($queryDup2)) {
                                            $users_list = DB::getInstance()->query($queryDup2);
                                            foreach ($users_list->results() as $users_list) {
                                                $total_stf ++;
                                            }
                                        }
                                        $date1 = "0000-00-00";
                                        $date2 = "0000-00-00";
                                        $queryDup3 = "select book_no,borrowed_date,return_date from book_staff where status = '" . $status . "' and book_no = '" . $book_no . "' order by borrowed_date desc limit 1";
                                        if (DB::getInstance()->checkRows($queryDup3)) {
                                            $users_list = DB::getInstance()->query($queryDup3);
                                            foreach ($users_list->results() as $users_list) {
                                                $date1 = $users_list->borrowed_date;
                                            }
                                        }

                                        $queryDup3 = "select book_no,borrowed_date,return_date from book_student where status = '" . $status . "' and book_no = '" . $book_no . "' order by borrowed_date desc limit 1";
                                        if (DB::getInstance()->checkRows($queryDup3)) {
                                            $users_list = DB::getInstance()->query($queryDup3);
                                            foreach ($users_list->results() as $users_list) {
                                                $date2 = $users_list->borrowed_date;
                                            }
                                        }

                                        $total_qty = $b_quant2 + $b_quant1;
                                        $qty_left = $quantity - $total_qty;
                                        $real_date = "";
                                        if ($date1 > $date2) {
                                            $real_date = $date1;
                                        } else {
                                            $real_date = $date2;
                                        }
                                        $total_std_books = 0;
                                        $total_stf_books = 0;
                                        $queryDup3 = "select book_no,borrowed_date,return_date from book_student";

                                        if (DB::getInstance()->checkRows($queryDup3)) {
                                            $users_list = DB::getInstance()->query($queryDup3);
                                            foreach ($users_list->results() as $users_list) {
                                                $total_std_books ++;
                                            }
                                        }

                                        $queryDup3 = "select book_no,borrowed_date,return_date from book_staff";

                                        if (DB::getInstance()->checkRows($queryDup3)) {
                                            $users_list = DB::getInstance()->query($queryDup3);
                                            foreach ($users_list->results() as $users_list) {
                                                $total_stf_books ++;
                                            }
                                        }

                                        $percent_stf = 0;
                                        $percent_std = 0;
                                        if ($total_stf_books > 0) {
                                            $percent_stf = ($total_stf / $total_stf_books) * 100;
                                        }
                                        if ($total_std_books > 0) {
                                            $percent_std = ($total_std / $total_std_books) * 100;
                                        }
                                        $avg = ($percent_stf + $percent_std) / 2;
                                        ?>
                                        <div class="form-group">
                                            <label>Quantities Borrowed <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $total_qty; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Quantities Left <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="btn btn-info"> <?php echo $qty_left; ?> </label>
                                            </p>
                                        </div>
                                        <input type="hidden" name="book_no" value="<?php echo @$_GET['book_no']; ?>"/>
                                        <div class="form-group">
                                            <label> Latest Borrowed Date <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $real_date; ?> </label>
                                            </p>
                                        </div>
                                        <br/>

                                        <div class="form-group">
                                            <label> Percentage Usage <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="btn btn-warning"> <?php echo $avg . '%'; ?> </label>
                                            </p>
                                        </div>

                                        <br/>
                                        <hr/>
                                        <div class="form-group">
                                        </div>

                                    </div>
                                </div>
                            </div>

                    </form>

                    <!-- Pending Book not returned! --->
                    <div class="col-lg-4 col-md-4 ">
                        <div class="ibox float-e-margins table table-responsive ">
                            <h4> Pending Books Titled : <?php echo $title; ?></h4>
                            <div class="ibox-content table table-responsive">

                                <?php
//Query to select all class teachers
                                $status = 1;
                                $queryDup = "select  fname,sname,contact,c.book_no as book_no ,borrowed_date,return_date,title from book_staff b,book_typecopy c,book_type t,teachers tc where tc.teacher_id = b.teacher_id and c.book_no = '" . $book_no . "' and b.status = '" . $status . "' and c.book_id = t.book_id and b.book_no = c.book_no order by borrowed_date";
                                if (DB::getInstance()->checkRows($queryDup)) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >

                                        <caption> From Staff's Record </caption>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Borrower Date</th>
                                                <th>Return Date</th>
                                                <th>Staff</th>
                                                <th>Contact.</th>

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
                                                    <td  style="text-transform: capitalize"><?php echo $users_list->borrowed_date; ?></td>
                                                    <td> <label class="label label-info"><?php echo $users_list->return_date; ?></label></td>
                                                    <td><?php echo $users_list->fname.' '.$users_list->sname; ?></td>
                                                    <td><?php echo $users_list->contact; ?></td>

                                                </tr>  
                                                <?php
                                                $no++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>



                                    <?php
                                }else {
                                    echo '<b style="color:red">No Staff Records</b>';
                                }
                                ?>



                                <?php
                                $status = 1;
                                $queryDup = "select class_name,fname,sname, c.book_no as book_no ,borrowed_date,return_date,title from book_student b,book_typecopy c,book_type t,student_info s,class cl where b.student_id = s.student_id and cl.class_id = s.class_id and c.book_no = '" . $book_no . "' and b.status = '" . $status . "' and c.book_id = t.book_id and b.book_no = c.book_no order by borrowed_date";
                                if (DB::getInstance()->checkRows($queryDup)) {
                                    ?>
                                    <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >

                                        <caption> From Student's Record </caption>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Borrower Date</th>
                                                <th>Return Date</th>
                                                <th>Student</th>
                                                <th>Class.</th>

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
                                                    <td  style="text-transform: capitalize"><?php echo $users_list->borrowed_date; ?></td>
                                                    <td> <label class="label label-info"><?php echo $users_list->return_date; ?></label></td>
                                                    <td><?php echo $users_list->fname.' '.$users_list->sname; ?></td>
                                                    <td><?php echo $users_list->class_name; ?></td>

                                                </tr>  
                                                <?php
                                                $no++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>



                                    <?php
                                }else {
                                    echo '<br/><b style="color:red">No Students record</b>';
                                }
                                ?>


                                <div class="form-group">
                                    <a href="index.php?page=view_available_books" class="btn btn-default">    <i class="fa fa-angle-double-left"></i> Go Back </a>
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
        <script src="js/plugins/slimscroll/demo.js"></script>

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