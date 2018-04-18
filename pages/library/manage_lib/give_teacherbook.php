<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'Give Book'; ?></title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>
        <?php
        //if (isset($_GET['class_teacher_id'])) {
        $teacher = $_GET['class_teacher_id'];
        $queryDup = "select  teacher_id,fname,sname,contact,email,sex from teachers where  teacher_id = '" . $teacher . "'  order by teacher_id";
        if (DB::getInstance()->checkRows($queryDup)) {
            $users_list = DB::getInstance()->query($queryDup);
            foreach ($users_list->results() as $users_list) {

                $teacher_id = $users_list->teacher_id;
                $fname = $users_list->fname;
                $sname = $users_list->sname;
                $contact = $users_list->contact;
                $email = $users_list->email;
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
                        <h2><strong> Give Out Book To:<font color="green"> <?php echo $fname . " " . $sname; ?> </font> </strong></h2>
                    </div>
                </div>


                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <?php
                    if (Input::exists()) {


                        if (Token::check(Input::get('token'))) {
                            //Student information .................
                            $teacher = Input::get('teacher_id');
                            $borrow_date = Input::get('borrow_date');
                            $return_date = Input::get('return_date');
                            $book_type = Input::get('book_type');
                            $status = 1;
                            $book_number = Input::get('book_number');

                            $borrowInsert = DB::getInstance()->insert('book_staff', array(
                                'borrowed_date' => $borrow_date,
                                'return_date' => $return_date,
                                'status' => $status,
                                'book_no' => $book_number,
                                'teacher_id' => $teacher
                            ));
                            if ($borrowInsert) {
                                echo "<h5 align='center' ><strong><font color='green' size='2px'>Book has been given out Successfully</font></strong></h5>";
                            } else {
                                echo "<h5 align='center' ><strong><font color='red' size='2px'> An Error Occured while inserting the lending details!</font></strong></h5>";
                            }
                        }
                    }
                    ?>
                    <form action="" onsubmit="return confirm('Are you sure you want to Lend Out the Book to <?php echo $fname; ?> ?');" method="POST" role="form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="ibox float-e-margins">
                                    <h4><?php echo $fname; ?>'s Information</h4>
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label>First Name <sup style="color: blue">*</sup></label>
                                            <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>"/>
                                            <p>
                                                <label class="label label-info"> <?php echo $fname; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Second Name <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $sname; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Contact <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $contact; ?> </label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Email <sup style="color: blue">*</sup></label>
                                            <p>
                                                <label class="label label-info"> <?php echo $email; ?> </label>
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
                                    <h4> Book Lending Form</h4>
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label>Borrowing Date <sup style="color: red">*</sup></label>
                                            <input name="borrow_date" type="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Return Date <sup style="color: red">*</sup></label>
                                            <input name="return_date" type="date" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Type <sup style="color: red">*</sup></label>
                                            <select name="book_type" class="form-control" required>
                                                <?php echo DB::getInstance()->dropDowns('book_type', 'book_id', 'title'); ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Number <sup style="color: red">*</sup></label>
                                            <select name="book_number" class="form-control" required>
                                                <?php echo DB::getInstance()->dropDowns('book_typecopy', 'book_no', 'book_no'); ?>

                                            </select>
                                        </div>

                                        <div class="form-group">

                                            <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
                                            <button type="submit" class="btn btn-info">Give Out</button>
                                            <button class="btn btn-warning" type="reset">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Pending Book not returned! --->
                            <div class="col-lg-4 col-md-4 ">
                                <div class="ibox float-e-margins table table-responsive ">
                                    <h4> Pending Books Not returned By : <?php echo $fname; ?></h4>
                                    <div class="ibox-content table-responsive">

                                        <?php
                                        //Query to select all class teachers
                                        $status = 1;
                                        $queryDup = "select  c.book_no as book_no ,borrowed_date,return_date,title from book_staff b,book_typecopy c,book_type t where teacher_id = '" . $teacher_id . "' and b.status = '" . $status . "' and c.book_id = t.book_id and b.book_no = c.book_no order by borrowed_date";
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
                                            <a href="index.php?page=av_teachers" class="btn btn-default">    <i class="fa fa-angle-double-left"></i> Go Back </a>
                                        </div>

                                    </div>
                                </div>
                            </div>



                    </form>
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