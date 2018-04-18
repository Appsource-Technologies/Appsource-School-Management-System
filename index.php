
<?php

ob_start();
//error_reporting(E_ALL);
$date_today=  date("Y-m-d");
//echo 'Display';
//$url = 'http://macoagencies.com/';
error_reporting(1);
session_start();
include 'core/init.php';
include 'util.php';
$title = "School System | ";


$crypt = new Encryption();
$encoded_page = isset($_GET['page']) ? $_GET['page'] : ('login');
//$page = $crypt->decode($encoded_page);add_a_level_subject
$page = $encoded_page;

switch ($page) {
    default:
        $page = "login";
        include 'pages/users/login.php';
        break;

    case 'dashboard':
        //check_login_status();
        if (file_exists('pages/' . $page . '.php'))
            include 'pages/' . $page . '.php';
        break;

    /* School setup***************************** */
    case 'academic_years':
        //check_login_status();
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_house':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'report_control':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'sch_descriptions':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_class':
        //check_login_status();
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_stream':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_term':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_grading_system':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_o_level_subject':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_a_level_subject':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_combination':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    //The file script to enable or disable the status using ajax
    case 'update_status':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    case 'add_exam_set':
        if (file_exists('pages/school_setup/' . $page . '.php'))
            include 'pages/school_setup/' . $page . '.php';
        break;

    /* Users***************************** */
    case 'add_users':
        //check_login_status();
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'view_users':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    case 'update_account':
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;

    /* Payments**************************************** */
    case 'add_payment':
        if (file_exists('pages/payments/' . $page . '.php'))
            include 'pages/payments/' . $page . '.php';
        break;

    case 'view_payments':
        if (file_exists('pages/payments/' . $page . '.php'))
            include 'pages/payments/' . $page . '.php';
        break;

    /* Teachers**************************************************** */
    case 'add_teacher':
        if (file_exists('pages/teachers/' . $page . '.php'))
            include 'pages/teachers/' . $page . '.php';
        break;

    case 'view_teachers':
        if (file_exists('pages/teachers/' . $page . '.php'))
            include 'pages/teachers/' . $page . '.php';
        break;

    case 'class_allocation':
        if (file_exists('pages/teachers/' . $page . '.php'))
            include 'pages/teachers/' . $page . '.php';
        break;

    case 'subject_allocation':
        if (file_exists('pages/teachers/' . $page . '.php'))
            include 'pages/teachers/' . $page . '.php';
        break;

    case 'view_class_teachers':
        if (file_exists('pages/teachers/' . $page . '.php'))
            include 'pages/teachers/' . $page . '.php';
        break;

    /* Students**************************************************** */
    case 'add_students':
        if (file_exists('pages/students/' . $page . '.php'))
            include 'pages/students/' . $page . '.php';
        break;

    case 'view_enrollment':
        if (file_exists('pages/students/' . $page . '.php'))
            include 'pages/students/' . $page . '.php';
        break;

    case 'subject_enrollment':
        if (file_exists('pages/students/' . $page . '.php'))
            include 'pages/students/' . $page . '.php';
        break;

    /* Announcements************************************************* */
    case 'add_announcements':
        if (file_exists('pages/announcements/' . $page . '.php'))
            include 'pages/announcements/' . $page . '.php';
        break;

    /* Classes************************************************* */
    case 'class_lists':
        if (file_exists('pages/classes/' . $page . '.php'))
            include 'pages/classes/' . $page . '.php';
        break;

    case 'print_class_lists':
        if (file_exists('pages/classes/' . $page . '.php'))
            include 'pages/classes/' . $page . '.php';
        break;

    /* Announcements************************************************* */
    case 'registered_subjects':
        if (file_exists('pages/subjects/' . $page . '.php'))
            include 'pages/subjects/' . $page . '.php';
        break;

    case 'teacher_my_subjects':
        if (file_exists('pages/subjects/' . $page . '.php'))
            include 'pages/subjects/' . $page . '.php';
        break;

    /* Cards************************************************* */
    case 'exam_set_standings':
        if (file_exists('pages/cards/' . $page . '.php'))
            include 'pages/cards/' . $page . '.php';
        break;

    case 'report_cards':
        if (file_exists('pages/cards/' . $page . '.php'))
            include 'pages/cards/' . $page . '.php';
        break;

    /* Marks************************************************* */
    case 'add_marks':
        if (file_exists('pages/marks/' . $page . '.php'))
            include 'pages/marks/' . $page . '.php';
        break;

    case 'update_marks':
        if (file_exists('pages/marks/' . $page . '.php'))
            include 'pages/marks/' . $page . '.php';
        break;

    case 'individual_marksheet':
        if (file_exists('pages/marks/' . $page . '.php'))
            include 'pages/marks/' . $page . '.php';
        break;

    case 'general_marksheet':
        if (file_exists('pages/marks/' . $page . '.php'))
            include 'pages/marks/' . $page . '.php';
        break;

    /* FPDF Files access for generating reports************************************************* */
    case 'report_cards_pdf':
        if (file_exists('fpdf_reports_files/' . $page . '.php'))
            include 'fpdf_reports_files/' . $page . '.php';
        break;

    case 'marksheet_pdf':
        if (file_exists('fpdf_reports_files/' . $page . '.php'))
            include 'fpdf_reports_files/' . $page . '.php';
        break;

    case 'class_list_pdf':
        if (file_exists('fpdf_reports_files/' . $page . '.php'))
            include 'fpdf_reports_files/' . $page . '.php';
        break;

    /* Library************************************************* */
    case 'book_type':
        if (file_exists('pages/library/' . $page . '.php'))
            include 'pages/library/' . $page . '.php';
        break;
    case 'lib_manager':
        if (file_exists('pages/library/' . $page . '.php'))
            include 'pages/library/' . $page . '.php';
        break;
    case 'register_book':
        if (file_exists('pages/library/' . $page . '.php'))
            include 'pages/library/' . $page . '.php';
        break;
    case 'view_available_books':
        if (file_exists('pages/library/' . $page . '.php'))
            include 'pages/library/' . $page . '.php';
        break;
    case 'borrowing_manager':
        if (file_exists('pages/library/' . $page . '.php'))
            include 'pages/library/' . $page . '.php';
        break;


    /**  Library ******* Manage lib **************************** */
    case 'lend_book':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'return_book':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;


    case 'lib_students':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'av_teachers':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'give_teacherbook':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'give_studentbook':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;

    case 'av_teacher_return':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'av_stud_return':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;

    case 'clear_teacher':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'clear_student':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;
    case 'view_available_books':
        if (file_exists('pages/library/manage_lib/' . $page . '.php'))
            include 'pages/library/manage_lib/' . $page . '.php';
        break;

    /**  Payments *********************************** */
    case 'addfees_structure':
        if (file_exists('pages/payments/' . $page . '.php'))
            include 'pages/payments/' . $page . '.php';
        break;
    case 'view_fees_structures':
        if (file_exists('pages/payments/' . $page . '.php'))
            include 'pages/payments/' . $page . '.php';
        break;

    case 'add_students_payment':
        if (file_exists('pages/payments/' . $page . '.php'))
            include 'pages/payments/' . $page . '.php';
        break;

    /**  Payments ********** Reports ******************* */
    case 'fees_report':
        if (file_exists('pages/payments/reports/' . $page . '.php'))
            include 'pages/payments/reports/' . $page . '.php';
        break;

    /**  Payments ********** Details ******************* */
    case 'payment_list':
        if (file_exists('pages/payments/payment_details/' . $page . '.php'))
            include 'pages/payments/payment_details/' . $page . '.php';
        break;

    case 'export_payment_lists_excel':
        if (file_exists('pages/payments/payment_details/' . $page . '.php'))
            include 'pages/payments/payment_details/' . $page . '.php';
        break;
    case 'export_payment_lists_pdf':
        if (file_exists('pages/payments/payment_details/' . $page . '.php'))
            include 'pages/payments/payment_details/' . $page . '.php';
        break;

    case 'ledger_account':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;

    case 'add_source_of':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;
    case 'add_account_details':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;

    case 'view_account_details':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;

    case 'cash_book':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;
    case 'accounts_reports':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;

    case 'cash_book_dates_excel':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;
    case 'cash_book_dates_pdf':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;

    case 'print_cash_book_pdf':
        if (file_exists('pages/payments/ledger/' . $page . '.php'))
            include 'pages/payments/ledger/' . $page . '.php';
        break;

    case 'logout':
        //check_login_status();
        if (file_exists('pages/users/' . $page . '.php'))
            include 'pages/users/' . $page . '.php';
        break;
}
ob_flush();
?>
