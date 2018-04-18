<!DOCTYPE html>
<html>


    <!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title . 'add Book Type'; ?></title>

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
                    <div class="col-sm-4">
                        <h2><strong>Add Book Type</strong></h2>
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
                                        $book_author = Input::get("book_author");
                                        $book_title = Input::get("book_title");
                                        $book_edition = Input::get("book_edition");
                                        $book_quantity = Input::get("book_quantity");
                                        $book_subject = Input::get("book_subject");
                                        $book_level = Input::get("book_level");

                                        $queryDup = 'select * from book_type where title="' . $book_title . '"';
                                        if (DB::getInstance()->checkRows($queryDup)) {
                                            echo "<h5 align='center' ><strong><font color='red'>The Book title Already Registered!</font></strong></h5>";
                                            //header("refresh:1;url=index.php?page=add_users");
                                            //exit();
                                        } else {
                                            $typeInsert = DB::getInstance()->insert('book_type', array(
                                                'author' => $book_author,
                                                'title' => $book_title,
                                                'edition' => $book_edition,
                                                'quantity' => $book_quantity,
                                                'subject' => $book_subject,
                                                'level' => $book_level
                                            ));
                                            if ($typeInsert) {
                                                echo "<h5 align='center' ><strong><font color='green' size='2px'>New Book Type Registered Successfully</font></strong></h5>";
                                            }
                                        }
                                    }
                                    ?>
                                    <form action="" method="POST" role="form">
                                        <div class="form-group">
                                            <label>Book Author <sup style="color: red">*</sup></label>
                                            <input name="book_author" type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Title <sup style="color: red">*</sup></label>
                                            <input name="book_title" type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Edition <sup style="color: red">*</sup></label>
                                            <select name="book_edition" class="form-control" required>
                                                <option value="">----SELECT---- </option>
                                                <option value="FIRST EDITION">FIRST EDITION</option>
                                                <option value="SECOND EDITION">SECOND EDITION</option>
                                                <option value="THIRD EDITION">THIRD EDITION</option>
                                                <option value="FORTH EDITION">FORTH EDITION</option>
                                                <option value="FIFTH EDITION">FIFTH EDITION</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Quantity <sup style="color: red">*</sup></label>
                                            <input name="book_quantity" type="number" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Book Subject <sup style="color: red">*</sup></label>
                                            <select name="book_subject" class="form-control" required>
                                                <?php echo DB::getInstance()->dropDowns('asubject', 'sub_code', 'sub_name'); ?>

                                            </select>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Book Level <sup style="color: red">*</sup></label>

                                            <select name="book_level" class="form-control" required>
                                                <option value="">----SELECT---- </option>
                                                <option value="O">O-Level</option>
                                                <option value="A">A-Level</option>
                                            </select>

                                        </div>

                                        <button type="submit" class="btn btn-success">Register</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <a href="" class="btn btn-warning">Cancel</a>
                                    </form>
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
