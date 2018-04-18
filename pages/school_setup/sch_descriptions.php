<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title .'School Settings';?></title>

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
                    <h2><strong>School Settings</strong></h2>
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
                                    $school_name= Input::get("school_name");
                                    $school_motto= Input::get("school_motto");
                                    $school_post_address= Input::get("school_post_address");
                                    $school_location= Input::get("school_location");
                                    $school_tel= Input::get("school_tel");
                                    $school_email= Input::get("school_email");
                                    //Image capture
                                    $file_name =$_FILES['school_logo']['name'];
                                    $file_location = $_FILES['school_logo']['tmp_name'];
                                    $file_size = $_FILES['school_logo']['size'];
                                    $file_type = $_FILES['school_logo']['type'];
                                    $destination="images/"."badge".'.jpg';
                                    if(move_uploaded_file($file_location,$destination)){
                                      //echo $file_name." Upload successful";
                                     }
                                    else{
                                       echo "Upload failed";
                                    }
                                    $queryDup = 'select * from m_setting where master_id=1';
                                    if (DB::getInstance()->checkRows($queryDup)){
                                        //Update
                                        $DescriptionUpdate=  DB::getInstance()->update('m_setting',1,array(
                                            'schoo_name'=>$school_name,
                                            'mottto'=> $school_motto,
                                            'logo_path'=>$destination,
                                            'address'=> $school_post_address,
                                            'location'=>$school_location,
                                            'tel'=> $school_tel,
                                            'email'=>$school_email
                                        ),'master_id');
                                        if($DescriptionUpdate){
                                            echo "<h5 align='center' ><strong><font color='green'>Settings Updated Registered.</font></strong></h5>";
                                        }
                                    }
                                    else{
                                        $DescriptionInsert=  DB::getInstance()->insert('m_setting',array(
                                            'schoo_name'=>$school_name,
                                            'mottto'=> $school_motto,
                                            'logo_path'=>$destination,
                                            'address'=> $school_post_address,
                                            'location'=>$school_location,
                                            'tel'=> $school_tel,
                                            'email'=>$school_email
                                        ));
                                        if ($DescriptionInsert) {
                                            echo "<h5 align='center' ><strong><font color='green' size='2px'>Settings Uploaded Successfully</font></strong></h5>";
                                        }
                                    }
                                }
                                ?>
                                <?php 
                                $queryDup = 'select * from m_setting where master_id=1';
                                if (DB::getInstance()->checkRows($queryDup)){
                                    $check_data=TRUE;
                                }
                                else{
                                    $check_data=FALSE;
                                }
                                    ?>
                                <form action="" method="POST" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>School Name <sup style="color: red">*</sup></label>
                                        <input name="school_name" type="text" value="<?php if($check_data){echo DB::getInstance()->getName("m_setting", 1, "schoo_name", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>School Motto <sup style="color: red">*</sup></label>
                                        <input name="school_motto" type="text" value="<?php if($check_data){ echo DB::getInstance()->getName("m_setting", 1, "mottto", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>School Logo <sup style="color: red">*</sup></label>
                                        <input name="school_logo" type="file" accept="image/*" value="<?php if($check_data){ echo DB::getInstance()->getName("m_setting", 1, "mottto", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>School Post Address <sup style="color: red">*</sup></label>
                                        <input name="school_post_address" type="text" value="<?php if($check_data){ echo DB::getInstance()->getName("m_setting", 1, "address", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>School Location Address <sup style="color: red">*</sup></label>
                                        <input name="school_location" type="text" value="<?php if($check_data){ echo DB::getInstance()->getName("m_setting", 1, "location", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>School Tel <sup style="color: red">*</sup></label>
                                        <input name="school_tel" type="text" value="<?php if($check_data){ echo DB::getInstance()->getName("m_setting", 1, "tel", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>School Email <sup style="color: red">*</sup></label>
                                        <input name="school_email" type="email" value="<?php if($check_data){ echo DB::getInstance()->getName("m_setting", 1, "email", "master_id");}?>" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><?php if($check_data){ echo 'Update';}else{    echo 'Upload';}?></button>
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
