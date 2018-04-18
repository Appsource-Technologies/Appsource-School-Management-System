<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title .'New Term';?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <?php include_once 'includes/nav_side_bar.php';?>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <?php include_once 'includes/nav_header.php';?>
        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><strong>New Term Entry Form</strong></h2>
                </div>
            </div>

            <div class="wrapper wrapper-content">
                <!--Page content here..-->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <?php 
                                if(Input::exists()){
                                    $term_name= strtoupper(Input::get("term_name"));
                                    $queryDup = 'select * from terms where term_name="'.$term_name.'"';
                                    if (DB::getInstance()->checkRows($queryDup)){
                                        echo "<h5 align='center' ><strong><font color='red'>Term Already Registered.</font></strong></h5>";
                                    }
                                    else{
                                        $termInsert=  DB::getInstance()->insert('terms',array(
                                            'term_name'=>$term_name
                                        ));
                                        if ($termInsert) {
                                            echo "<h5 align='center' ><strong><font color='green' size='2px'>Term Registered Successfully</font></strong></h5>";
                                        }
                                    }
                                }
                                ?>
                                <form action="" method="POST" role="form">
                                    <div class="form-group">
                                        <label>Term/ Semester <sup style="color: red">*</sup></label>
                                        <select name="term_name" class="form-control" required>
                                            <option value="">Select Term</option>
                                            <option value="FIRST TERM">FIRST TERM</option>
                                            <option value="SECOND TERM">SECOND TERM</option>
                                            <option value="THIRD TERM">THIRD TERM</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Term</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                    <a href="" class="btn btn-warning">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <?php include_once 'includes/nav_footer.php';?>

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
        $(document).ready(function() {
            /* Init DataTables */
            var oTable = $('#editable').dataTable();
        });
    </script>
</body>

<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
</html>
