<div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                </span>
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['school_username']; ?></strong>
                        </span> <span class="text-muted text-xs block"><?php echo $_SESSION['school_user_role']; ?> </span> </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="index.php?page=update_account">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?page=logout">Logout</a></li>
                </ul>
            </div>
            <div class="logo-element">

            </div>
        </li>
        <li>
            <a href="index.php?page=dashboard"><i  class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
        </li>

        <!--School Settings-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "D.O.S" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-gear"></i> <span class="nav-label">School Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if ($_SESSION['school_user_role'] != "D.O.S") { ?>
                        <li><a href="index.php?page=sch_descriptions"><i class="fa fa-caret-right"></i>School Description</a></li>
                        <li><a href="index.php?page=add_house"><i class="fa fa-caret-right"></i>Add House</a></li>
                        <li><a href="index.php?page=academic_years"><i class="fa fa-caret-right"></i>Add Year</a></li>
                        <li><a href="index.php?page=report_control"><i class="fa fa-caret-right"></i>Report Generation Control</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['school_user_role'] != "Head Master") { ?>
                        <li><a href="index.php?page=add_class"><i class="fa fa-caret-right"></i>Add Classes</a></li>
                        <li><a href="index.php?page=add_stream"><i class="fa fa-caret-right"></i>Add Streams</a></li>
                        <li><a href="index.php?page=add_term"><i class="fa fa-caret-right"></i>Add Terms</a></li>
                        <li><a href="index.php?page=add_o_level_subject"><i class="fa fa-caret-right"></i>Add O-Level Subjects</a></li>
                        <li><a href="index.php?page=add_a_level_subject"><i class="fa fa-caret-right"></i>Add A-Level Subjects</a></li>
                        <li><a href="index.php?page=add_combination"><i class="fa fa-caret-right"></i>Add Combinations</a></li>
                        <li><a href="index.php?page=add_exam_set"><i class="fa fa-caret-right"></i>Add Exam Sets</a></li>
                        <li><a href="index.php?page=add_grading_system"><i class="fa fa-caret-right"></i>Grading System</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!--System Users-->
        <li>
            <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "Super") { ?>
                    <li><a href="index.php?page=add_users"><i class="fa fa-caret-right"></i>Add User</a></li>
                    <li><a href="index.php?page=view_users"><i class="fa fa-caret-right"></i>List Users</a></li>
                <?php } ?>
                <li><a href="index.php?page=update_account"><i class="fa fa-caret-right"></i>Change Password</a></li>
                <!--<li><a href="index.php?page=update_account"><i class="fa fa-caret-right"></i>Password Recovery</a></li>-->
            </ul>
        </li>
        <!--Teachers-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "D.O.S" || $_SESSION['school_user_role'] == "Teachers") { ?>
            <li>
                <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Teachers</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "D.O.S") { ?>
                        <?php if ($_SESSION['school_user_role'] == "Head Master") { ?>
                            <li><a href="index.php?page=view_teachers"><i class="fa fa-caret-right"></i>List All Teachers</a></li>
                        <?php } ?>
                        <li><a href="index.php?page=subject_allocation"><i class="fa fa-caret-right"></i>Subject Allocation</a></li>
                        <li><a href="index.php?page=class_allocation"><i class="fa fa-caret-right"></i>Class Allocation</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['school_user_role'] == "Teachers") { ?>
                        <li><a href="index.php?page=add_teacher"><i class="fa fa-caret-right"></i>Register</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!--Students-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "Teachers" || $_SESSION['school_user_role'] == "Secretary" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-user-md"></i> <span class="nav-label">Students</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if ($_SESSION['school_user_role'] != "Teachers") { ?>
                        <li><a href="index.php?page=add_students"><i class="fa fa-caret-right"></i>Register</a></li>
                        <?php if ($_SESSION['school_user_role'] != "Secretary") { ?>
                            <li><a href="index.php?page=view_enrollment"><i class="fa fa-caret-right"></i>View Enrollment</a></li>
                            <?php
                        }
                    }
                    ?>
                    <?php if ($_SESSION['school_user_role'] == "Teachers") { ?>
                        <li><a href="index.php?page=subject_enrollment&key=1"><i class="fa fa-caret-right"></i>Subject Enrollment</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!--Classes-->
        <?php if ($_SESSION['school_user_role'] == "Teachers" || $_SESSION['school_user_role'] == "D.O.S") { ?>
            <li>
                <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Class</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="index.php?page=class_lists"><i class="fa fa-caret-right"></i>Class Lists</a></li>
                    <li><a href="index.php?page=print_class_lists"><i class="fa fa-caret-right"></i>Print Class Lists</a></li>
                </ul>
            </li>
        <?php } ?>

        <!--Marks-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "D.O.S" || $_SESSION['school_user_role'] == "Teachers" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-bars"></i> <span class="nav-label">Marks</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if ($_SESSION['school_user_role'] == "Teachers") { ?>
                        <li><a href="index.php?page=add_marks"><i class="fa fa-caret-right"></i>Enter Marks</a></li>
                    <?php } ?>
                    <li><a href=""><i class="fa fa-caret-right"></i>View Marks</a></li>
                    <li><a href=""><i class="fa fa-caret-right"></i>Mark Summary</a></li>
                    <li><a href="index.php?page=individual_marksheet"><i class="fa fa-caret-right"></i>Individual Marksheets</a></li>
                    <?php if ($_SESSION['school_user_role'] != "Teachers") { ?>
                        <li><a href="index.php?page=general_marksheet"><i class="fa fa-caret-right"></i>General Marksheets</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!--Cards-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "Secretary" || $_SESSION['school_user_role'] == "Teachers" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Cards</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="index.php?page=report_cards"><i class="fa fa-caret-right"></i>Report Cards</a></li>
                    <li><a href="index.php?page=exam_set_standings"><i class="fa fa-caret-right"></i>Exam Set Standings</a></li>
                </ul>
            </li>
        <?php } ?>

        <!--Subjects-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "D.O.S" || $_SESSION['school_user_role'] == "Teachers" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Subjects</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php if ($_SESSION['school_user_role'] != "Teachers") { ?>
                        <li><a href="index.php?page=registered_subjects"><i class="fa fa-caret-right"></i>Registered Subjects</a></li>
                        <li><a href="index.php?page=view_class_teachers"><i class="fa fa-caret-right"></i>Class Teachers</a></li>
                    <?php } ?>
                    <?php if ($_SESSION['school_user_role'] == "Teachers") { ?>
                        <li><a href="index.php?page=teacher_my_subjects"><i class="fa fa-caret-right"></i>My Subjects</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!--Announcements-->
        <?php if ($_SESSION['school_user_role'] == "Head Master" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Announcements</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="index.php?page=add_announcements"><i class="fa fa-caret-right"></i>Post Announcement</a></li>
                    <li><a href="index.php?page=add_announcements"><i class="fa fa-caret-right"></i>Manage Announcements</a></li>
                </ul>
            </li>
        <?php } ?>

        <!--Library-->
        <?php if ($_SESSION['school_user_role'] == "Librarian" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-book"></i> <span class="nav-label">Library</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <!--Links for the library here-->
                    <li><a href="index.php?page=book_type"><i class="fa fa-caret-right"></i>Register Book Type</a></li>
                    <li><a href="index.php?page=register_book"><i class="fa fa-caret-right"></i>Register Book</a></li>
                    <li>
                        <a href="#"><i class="fa fa-caret-right"></i> <span class="nav-label">Manage Library</span><span class="fa arrow"></span></a>

                        <ul class="nav nav-third-level">
                            <li><a href="index.php?page=lib_students"><i class="fa fa-caret-right"></i>Lend Book</a></li>
                            <li><a href="index.php?page=av_stud_return"><i class="fa fa-caret-right"></i>Return Book</a></li>

                        </ul>
                    </li>
                    <li><a href="index.php?page=view_available_books"><i class="fa fa-book"></i>Available Books </a></li>

                </ul>
            </li>
        <?php } ?>

        <!--Payments-->
        <?php if ($_SESSION['school_user_role'] == "Bursar" || $_SESSION['school_user_role'] == "Super") { ?>
            <li>
                <a href="#"><i class="fa fa-paypal"></i> <span class="nav-label">Payments</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <!--Links for payments-->
                    <li><a href="index.php?page=view_fees_structures"><i class="fa fa-caret-right"></i>Fees Structures</a></li>
                    <li><a href="index.php?page=payment_list"><i class="fa fa-caret-right"></i>Student's Payments</a></li>
                    <li><a href="index.php?page=ledger_account"><i class="fa fa-caret-right"></i>Ledger Book</a></li>

                </ul>
            </li>
        <?php } ?>
        <li >
            <a href="index.php?page=logout"><i class="fa fa-power-off"></i><span class="nav-label">Logout</span></a>
        </li>
    </ul>
</div>