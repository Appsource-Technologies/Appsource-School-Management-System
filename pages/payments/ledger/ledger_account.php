
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

                        <h2> <i class="fa fa-columns"></i> <strong> Ledger Account </strong></h2>

                    </div>
                    <div class="col-sm-2">
                        <br/>

                        <a href="index.php?page=payment_list">  <button class="btn btn-info btn-sm">  [ <i class="fa fa-list"></i> Payment Lists ] </button> </a>


                    </div>
                </div>



                <div class="wrapper wrapper-content">
                    <!--Page content here..-->
                    <div class="row">


                        <div class="col-lg-5">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content dataTable dataTables_scrollBody table table-responsive">

                                    <div class=" alert alert-info"> Registered Souces of Income</div>
                                    <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >

                                        <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th> Source Name</th>

                                                <!--
                                                 <th>Give Out</th> -->
                                            </tr>
                                        </thead>

                                        <?php
                                        $queryDup = "select * from income_source   ";
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
                                                        <td  style="text-transform: capitalize"> <a href="index.php?page=view_account_details&source_type=Income&source_id=<?php echo $res_lists->income_source_id; ?>"> <?php echo $res_lists->income_name; ?>   </a></td>

                                                    </tr>  
                                                    <?php
                                                    $no++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }else {
                                            echo '<b style="color:red"> No Source of Income Registered yet!</b>';
                                        }
                                        ?>
                                    </table>




                                    <div class="form-group">

                                        <a href="index.php?page=add_source_of&source_type=Income"> <button class="btn btn-info btn-xs"> <!-- <i class="fa fa-plus-circle"></i> -->Add Source  </button> </a>
                                        <a href="index.php?page=add_account_details&source_type=Income"> <button class="btn btn-warning btn-xs"> <!-- <i class="fa fa-archive"></i>--> Add Income </button> </a>
                                        <a href="index.php?page=view_account_details&source_type=Income"> <button class="btn btn-default btn-xs"> <!-- <i class="fa fa-bank"></i>--> View Income </button> </a>

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-5">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content dataTable dataTables_scrollBody table table-responsive">

                                    <div class=" alert alert-info">Registered Expenditure Sources</div>
                                    <table class="table table-striped table-bordered table-hover table-responsive " id="editable" >

                                        <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>Source Name</th>

                                                <!--
                                                 <th>Give Out</th> -->
                                            </tr>
                                        </thead>

                                        <?php
                                        $queryDup = "select * from expenditure_source ";
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
                                                        <td  style="text-transform: capitalize"> <a  href="index.php?page=view_account_details&source_type=Expenditure&source_id=<?php echo $res_lists->expenditure_source_id; ?>">  <?php echo $res_lists->expenditure_name; ?> </a> </td>


                                                    </tr>  
                                                    <?php
                                                    $no++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                            <?php
                                        }else {
                                            echo '<b style="color:red"> No Expense sources registered yet!</b>';
                                        }
                                        ?>
                                    </table>


                                    <div class="form-group">

                                        <a href="index.php?page=add_source_of&source_type=Expenditure">      <button class="btn btn-info btn-xs">  <!--<i class="fa fa-plus-circle"></i>--> Add Source  </button> </a>
                                        <a href="index.php?page=add_account_details&source_type=Expenditure">      <button class="btn btn-warning btn-xs"> <!-- <i class="fa fa-archive"></i>--> Add Expenses  </button> </a>
                                        <a href="index.php?page=view_account_details&source_type=Expenditure">      <button class="btn btn-default btn-xs"> <!-- <i class="fa fa-bank"></i> -->View Expenses  </button> </a>

                                    </div>


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
