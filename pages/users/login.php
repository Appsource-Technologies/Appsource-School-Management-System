<?php
//Unset all the sessions in the system when the user loads the login page
if(isset($_SESSION['school_user_id'])){
    header("Refresh:0;url=index.php?page=logout",true,303);
}
?>
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title .'Login';?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold"><?php echo $SCHOOL_NAME; ?> : Appsource School Light</h2>
                <p style="text-align:justify">
                    School Solution Software is a dynamic web based application with 3 modules; marks, payments and library modules; built for the smooth running of any secondary school
                </p>

                <p style="text-align:justify">
                   School Solution Software uses the latest technologies to deliver the kind of efficiency needed for every secondary school. For efficiency and effective monitoring: TRY SCHOOL SOLUTION SOFTWARE.
                </p>

                <p style="text-align:justify">
                    School Solution Software comes in two flavors i) Local Area Network (LAN) based flavor ii) Cloud based flavor. We supply any depending on the need of our client. 
                </p>
                <p style="text-align:justify">
                    <small>For any inquiries, needs and queries, please do not hesitate to reach the team on tel: +256(0)757150000 and e-mail: info@appsource.ug</small>
                </p>

            </div>
            <div class="col-md-6">
                
                <div class="ibox-content">
                    <h3 align="center"><img style="align:centre; width: 100px; height: 100px" src="images/badge.jpg"/></h3>
                    
                    <h3 align="center"> Please Login Here</h3>
                    <form class="m-t" role="form" action="" method="POST">
                        
                        <?php
//                        echo print_r(DB::getInstance()->gradingScale(90));
                            if (Input::exists()) {
                                if (Token::check(Input::get("token"))) {
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'username' => array('required' => TRUE),
                                        'password' => array('required' => TRUE)
                                    ));
                                    if ($validation->passed()) {
                                        $username = Input::get("username");
                                        $password = sha1(Input::get('password'));
//                                l
                                        $user = new User();
                                        $login = DB::getInstance()->checkRows("select * from sch_users where user_name='$username' and password='$password' AND active_status=1"); //($username, $password);
                                        if ($login) {
                                            $_SESSION['school_username'] = $username;
                                            $_SESSION['school_user_role'] = DB::getInstance()->getName("sch_users", $username, "user_type", "user_name");
                                            $_SESSION['school_user_id'] = DB::getInstance()->getName("sch_users", $username, "user_id", "user_name");
                                            $_SESSION['school_user_full_name'] = DB::getInstance()->getName("sch_users", $username, "Full_Name", "User_Name");
                                            $profile_picture = DB::getInstance()->getName("sch_users", $username, "Profile_Picture", "User_Name");
                                            $array_access=array('User_Id'=>$_SESSION['user_id']);
                                            DB::getInstance()->insert('tbl_access_log',$array_access);
                                            if (empty($profile_picture)) {
                                                $_SESSION['profile_picture'] = 'default.jpg';
                                            } else {
                                                $_SESSION['profile_picture'] = $profile_picture;
                                            }
//                                    echo $_SESSION['bloodfinder_role'];
                                            if ($_SESSION['school_role'] == 'Data Clerk') {
                                                Redirect::to('index.php?page=add_ticket');
                                            } else {
                                                Redirect::to('index.php?page=dashboard');
                                            }
                                        } else {
                                            echo '<b style="color:red"><h5 align="center">Sorry, Login was not successful</h5></b>';
                                        }
                                    } else {
                                        foreach ($validation->errors()as $error) {
                                            echo "<font color='red'><h5 align='center'>" . $error . '</h5></font>';
                                        }
                                    }
                                }
                            }
                            ?>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required="">
                        </div>
                        <input type="hidden" value="<?php echo Token::generate(); ?>" name="token"/>
                        <button type="submit"  class="btn btn-primary block full-width m-b">Login</button>

<!--                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="#">Create an account</a>-->
                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <font color="black"> <?php echo $SCHOOL_NAME."  | ".$MOTTO  ?></font>
            </div>
            <div class="col-md-6 text-right">
                <font color="black"><small>© 2013-<?php echo date("Y"); ?></small></font>
            </div>
        </div>
    </div>

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.1/login_two_columns.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 31 May 2015 10:01:57 GMT -->
</html>
