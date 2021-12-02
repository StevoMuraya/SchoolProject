<?php

require('config.php');

if (
    isset($_POST['student_id']) &&
    isset($_POST['class_id'])
) {
    $student_id        = filter_var($_POST['student_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $class_id         = filter_var($_POST['class_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $result = array();

    $class_total = total_classes($class_id, $db_handle, $result);
    $student_total = student_classes($class_id, $student_id, $db_handle, $result);
    $percent = ($student_total / $class_total) * 100;
    $percent = number_format((float)$percent, 2, '.', '');

    $result['percent'] = $percent;
    echo json_encode($result);
}



function total_classes($class_id, $db_handle, $result)
{
    $sql_check = "SELECT count(ch.class_id) AS 'total_Count'
                FROM classes_held AS ch
                WHERE class_id = '$class_id'";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $total_count = $row['total_Count'];
        return  $total_count;
    }
}


function student_classes($class_id, $student_id, $db_handle, $result)
{
    $sql_check = "SELECT count(al.attendance_id) AS 'student_Count'
                FROM attendance_list AS al
                WHERE class_id = '$class_id'
                AND student_id = '$student_id'
                ";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $student_Count = $row['student_Count'];

        return  $student_Count;
    }
}
