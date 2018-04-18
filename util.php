<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 05-Apr-18
 * Time: 7:07 PM
 *
 * This file is STRICTLY NOT for any DB related use
 * Use the known DB::getInstance()... format if you want to do sth that requies a DB, but not
 * from here
 */


/**
 * Returns the Grade e.g A, B, C etc with the corresponding letter value e.g 6, 5 ,...
 * Received normal grades like d1, d2 etc and calculates A level
 * grade like A, B, etc
 * @param $arrayOfGradeWeights array 1, 2, etc standing for D1, D2, etc
 *
 * //todo work on thius method
 * @param $type_id : 1=Principal subject, 2=Susidiary
 * @return array
 */
function getAlevelGrade(array $arrayOfGradeWeights, $type_id)
{
    $sum = array_sum($arrayOfGradeWeights);
    //foreach ($arrayOfGradeWeights as $gradeWeight) :
    if ($type_id == 2) {// subsidiary subject
        if ($sum >= 1 && $sum <= 6) {
            return array("SP", 1);
        } else if ($sum >= 7 && $sum <= 9) {
            return array("SF", 0);
        } else {
            showError("Can't get grade values for sub: " . $sum);
            return array("*X", 0);
        }
    }else if ($type_id == 1) {// Principal subject
        if (count($arrayOfGradeWeights) == 2) {
            if ($sum >= 0 && $sum <= 4) {
                return array("A", 6);
            } else if ($sum >= 5 && $sum <= 10) {
                return array("B", 6);
            } else if ($sum >= 15 && $sum <= 20) {
                return array("C", 6);
            } else {
                return array("X", 0);
            }
        } else if (count($arrayOfGradeWeights) == 3) {//3 papers
            if ($sum >= 0 && $sum <= 4) {
                return array("A", 6);
            } else if ($sum >= 5 && $sum <= 10) {
                return array("B", 5);
            } else if ($sum >= 15 && $sum <= 20) {
                return array("C", 4);
            } else if ($sum >= 21 && $sum <= 27) {
                return array("O", 1);
            } else {
                return array("X", 0);
            }
        } else {
            return array("Y", 0);
        }
    }else{
        showError("Unknown subject type ID: " . $type_id);
    }

    //endforeach;
}

function showError($error)
{
    $error .= "\\n\\nPlease Contact Appsource Technologies, Jinja.\\n0757150000\\ninfo@appsource.ug";
    echo("<script> alert('".$error."'); </script>");
}