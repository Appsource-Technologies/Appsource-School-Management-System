<?php

//Include database configuration file
include('dbConfig.php');

if (isset($_POST["student"]) && !empty($_POST["student"])) {

    $queryDup = "select * from student_info where  where class_id = '" . $class . "' ";
    if (DB::getInstance()->checkRows($queryDup)) {
        echo '<option value="">Select state</option>';
        $res_lists = DB::getInstance()->query($queryDup);
        foreach ($res_lists->results() as $res_lists):
            $name3 = $res_lists->fname;
            echo '<option value="' . $res_lists->student_id . '">' . $res_lists->fname . '</option>';
        endforeach;
    }else {
        echo '<option value="">No Student Found !</option>';
    }
}
?>