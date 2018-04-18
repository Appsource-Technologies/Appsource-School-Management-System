<?php
if (isset($_GET['d_num']) && $_GET['d_num'] != "") {
    $str = $_GET['d_num'];
    if (stripos($str, 'X') !== false) {
        $reg_id = explode(',', $str);
        $id = $reg_id[1];
        $query_update = DB::getInstance()->update('student_info', $id, array(
            'status' => 2
                ), 'student_id');
        if ($query_update) {
            echo "Student has heen Marked as Left";
        }
    } else
    if (stripos($str, 'Y') !== false) {
        $reg_id = explode(',', $str);
        $id = $reg_id[1];
        $query_update = DB::getInstance()->update('student_info', $id, array(
            'status' => 1
                ), 'student_id');
        if ($query_update) {
            echo "Student has heen Marked Continuing";
        }
    }
}



//Getting the subjects in the level selected
if (isset($_GET['level_selected']) && $_GET['level_selected'] != "") {
    ?>
    <label>Subject</label>
    <select class="form-control" name="subject" required>
        <?php
        if ($_GET['level_selected'] == "A-Level") {
            $querySearchSubjects = "select * from  asubject";
            if (DB::getInstance()->checkRows($querySearchSubjects)) {
                echo'<option value="">-SELECT-</option>';
                $subject_list = DB::getInstance()->query($querySearchSubjects);
                foreach ($subject_list->results() as $subjects) :
                    echo '<option value="' . $subjects->sub_code . '">' . $subjects->sub_name . ': Paper ' . $subjects->paper . '</option>';
                endforeach;
            }
        }else
        if ($_GET['level_selected'] == "O-Level") {
            echo DB::getInstance()->dropDowns('osubjects', 'osub_code', 'sub_name');
        }
        ?></select><?php
}




//Exam settup actions
if (isset($_GET['exam_set_id']) && $_GET['exam_set_id'] != "") {
    $exam_set_id = $_GET['exam_set_id'];
    if (stripos($exam_set_id, 'X') !== false) {
        $exam = explode(',', $exam_set_id);
        $status_value = $exam[1];
        $exam_id = $exam[2];
        $query_update = DB::getInstance()->update('exam_sets', $exam_id, array(
            'status' => $status_value
                ), 'set_id');
        if ($query_update) {
            echo "Exam set has been enabled";
        }
    } else {
        $exam = explode(',', $exam_set_id);
        $status_value = $exam[1];
        $exam_id = $exam[2];
        $query_update = DB::getInstance()->update('exam_sets', $exam_id, array(
            'status' => $status_value
                ), 'set_id');
        if ($query_update) {
            echo "Exam set has been disabled";
        }
    }
}
?>