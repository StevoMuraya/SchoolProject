<?php
require('config.php');

if (isset($_POST['lec_id'])) {
    $lec_id         = filter_var($_POST['lec_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $classlistarray = array();
    $class_years = array();
    $class_items = array();

    $fetch_categories = mysqli_query(
        $db_handle,
        "SELECT DISTINCT class_sem,class_year,lec_id  
        FROM classes WHERE lec_id = '$lec_id'  
        ORDER BY class_year,class_sem  DESC"
    ) or die(mysqli_error($db_handle));

    while ($row_categories = mysqli_fetch_assoc($fetch_categories)) {
        $sem = $row_categories['class_sem'] . "st sem";
        if ($sem == "2") {
            $sem = $row_categories['class_sem'] . "nd sem";
        } else if ($sem == "3") {
            $sem = $row_categories['class_sem'] . "rd sem";
        }


        $class_years['class_year'] = $row_categories['class_year'] . "  " . $sem;
        $lec_id = $row_categories['lec_id'];
        $class_years['classes'] = array();

        $fetch_classes = mysqli_query(
            $db_handle,
            "SELECT *
            FROM classes AS cl, units AS u 
            WHERE cl.class_year = '" . $row_categories['class_year'] . "'
            AND lec_id = '$lec_id'
            AND class_sem = '" . $row_categories['class_sem'] . "'
            AND cl.unit_id = u.unit_id
            ORDER BY date_updated DESC"

        ) or die(mysqli_error($db_handle));

        while ($row_items = mysqli_fetch_assoc($fetch_classes)) {
            $class_items['class_id'] = $row_items['class_id'];
            $class_items['unit_id'] = $row_items['unit_id'];
            $class_items['unit_name'] = $row_items['unit_name'];
            $class_items['unit_code'] = $row_items['unit_code'];
            $class_items['lec_id'] = $row_items['lec_id'];
            $class_items['class_sem'] = $row_items['class_sem'];
            $class_items['class_year'] = $row_items['class_year'];
            $class_items['class_start'] = $row_items['class_start'];
            $class_items['class_stop'] = $row_items['class_stop'];
            $class_items['status'] = $row_items['status'];
            $class_items['class_code'] = $row_items['class_code'];
            $class_items['date_updated'] = $row_items['date_updated'];
            $class_items['date_reg'] = $row_items['date_reg'];
            array_push($class_years['classes'], $class_items);
        }

        array_push($classlistarray, $class_years);
    }

    $jsonData = json_encode($classlistarray, JSON_PRETTY_PRINT);


    echo $jsonData;
}
