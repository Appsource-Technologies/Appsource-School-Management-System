<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Clear Student'; ?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>
        <?php
        // if (isset($_GET['student_id'])) {
        $student = $_GET['student_id'];
        $queryDup = "select  student_id,fname,sname,sex,class_name,stream_name,comb_name,a_yr from student_info s,class c,streams sm,combinations cb,academic_yr y where  student_id = '" . $student . "' and s.class_id=c.class_id and s.stream_id=sm.stream_id and s.a_yr_id=y.a_yr_id and s.comb_id=cb.comb_id";
        if (DB::getInstance()->checkRows($queryDup)) {
            $users_list = DB::getInstance()->query($queryDup);
            foreach ($users_list->results() as $users_list) {


                $student_id = $users_list->student_id;
                $fname = $users_list->fname;
                $sname = $users_list->sname;
                $class = $users_list->class_name;
                $stream = $users_list->stream_name;
                $year = $users_list->a_yr;
                $combination = $users_list->comb_name;
                $gender = $users_list->sex;
                
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
                        <h2><strong> Clear Books From:<font color="green"> <?php echo $fname . " " . $sname; ?> </font> <font color="blue">[ Student ] </font></strong></h2>
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
                            $queryUPDATE = "UPDATE book_student SET status = '".$status."'  WHERE (student_id='" . $student . "' AND book_no='" . $book_no . "' AND status = '".$status1."' )";
                            $queryUpdated = DB::getInstance()->query($queryUPDATE);
                            if ($queryUpdated) {
                                
                                echo "<h5 align='center' ><font color='green'> The Book has been Cleared Successfully !.</font></h5>";
                            
                                header("refresh:2;url=index.php?page=clear_student&student_id=".$student);

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
                                    <h4><?php echo $fname; ?>'s Information</h4>
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label>Class <sup style="color: blue">*</sup></label>
                                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>"/>
                                            <p>
                                                <label class="label label-info"> <?php echo $class; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Stream <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $stream; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Combination <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $combination; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Academic Year <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $year; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Gender <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $gender; ?> </label>
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
                                    <h4> Borrowed  Book Information </h4>
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label>Borrowing Date <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php
                                                    if (@$_GET['book_no']) {
                                                        echo @$_GET['b_date'];
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Return Date <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php
                                                    if (@$_GET['book_no']) {
                                                        echo @$_GET['r_date'];
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Author <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php
                                                    if (@$_GET['book_no']) {
                                                        echo @$_GET['author'];
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                    ?> </label>
                                            </p>
                                        </div>
                                        <input type="hidden" name="book_no" value="<?php echo @$_GET['book_no']; ?>"/>
                                        <div class="form-group">
                                            <label>Book Title <sup style="color: red">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php
                                                    if (@$_GET['book_no']) {
                                                        echo @$_GET['title'];
                                                    } else {
                                                        echo 'Not Selected!';
                                                    }
                                                    ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Number <sup style="color: red">*</sup></label>
                                            <select name="page" onchange="window.location = this.value" class="form-control" >


                                                <?php if (@$_GET['book_no']) { ?>
                                                    <option value="#"> <?php echo $_GET['book_no']; ?>  </option>
                                                <?php } else {
                                                    ?>
                                                    <option value="#"> ---- Select Book no -----  </option>
                                                    <?php
                                                }
                                                //if (isset($_GET['reload'])) {

                                                $status = 1;
                                                $queryDup = "select  b.student_id as student_id,c.book_no as book_no ,borrowed_date,return_date,title,author from book_student b,book_typecopy c,book_type t where student_id = '" . $student_id . "' and b.status = '" . $status . "' and c.book_id = t.book_id and b.book_no = c.book_no order by borrowed_date";
                                                if (DB::getInstance()->checkRows($queryDup)) {
                                                    $users_list = DB::getInstance()->query($queryDup);
                                                    foreach ($users_list->results() as $users_list) {


                                                        $student_id = $users_list->student_id;
                                                        $book_no = $users_list->book_no;
                                                        $borrowed_date = $users_list->borrowed_date;
                                                        $return_date = $users_list->return_date;
                                                        $title = $users_list->title;
                                                        $author = $users_list->author;
                                                        ?>

                                                        <option value="index.php?page=clear_student&reload=reload&student_id=<?php echo $student_id; ?>&book_no=<?php echo $book_no; ?>&b_date=<?php echo $borrowed_date; ?>&r_date=<?php echo $return_date; ?>&author=<?php echo $author; ?>&title=<?php echo $title; ?>"> <?php echo $book_no; ?> </option> 

        <?php
    }
}
//}
?>

                                            </select>
                                        </div>

                                        <div class="form-group">

                                            <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
                                            <button type="submit" <?php if (!$_GET['reload']) { ?> disabled <?php } ?> class="btn btn-info"> <i class="fa fa-save"></i> Clear Book </button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                    </form>

                    <!-- Pending Book not returned! --->
                    <div class="col-lg-4 col-md-4 ">
                        <div class="ibox float-e-margins table table-responsive ">
                            <h4> Pending Books Not returned By : <?php echo $fname; ?></h4>
                            <div class="ibox-content table table-responsive">

<?php
//Query to select all class teachers
$status = 1;
$queryDup = "select  c.book_no as book_no ,borrowed_date,return_date,title from book_student b,book_typecopy c,book_type t where student_id = '" . $student_id . "' and b.status = '" . $status . "' and c.book_id = t.book_id and b.book_no = c.book_no order by borrowed_date";
if (DB::getInstance()->checkRows($queryDup)) {
    ?>
                                    <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >

                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Borrower Date</th>
                                                <th>Return Date</th>
                                                <th>Book Title</th>
                                                <th>Book No.</th>

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
                                                    <td><?php echo $users_list->title; ?></td>
                                                    <td><?php echo $users_list->book_no; ?></td>

                                                </tr>  
                                        <?php
                                        $no++;
                                    endforeach;
                                    ?>
                                        </tbody>
                                    </table>



    <?php
}else {
    echo '<b style="color:red">No Pending Book for ' . $fname . '</b>';
}
?>

                                <div class="form-group">
                                    <a href="index.php?page=av_stud_return" class="btn btn-default">    <i class="fa fa-angle-double-left"></i> Go Back </a>
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