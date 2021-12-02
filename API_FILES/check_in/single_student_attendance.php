<?php
require('config.php');

if (isset($_GET['student_id'])) {
    $student_id         = filter_var($_GET['student_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $result = array();
    $result['classes'] = array();

    fetch_students_units($student_id, $db_handle, $result);
}

function fetch_students_units($student_id, $db_handle, $result)
{
    $sql_stud_check = mysqli_query(
        $db_handle,
        "SELECT *
        FROM unit_students AS us,
            classes AS cl,
            units AS u
        WHERE us.student_id = '$student_id'
        AND us.class_id = cl.class_id
        AND cl.unit_id = u.unit_id"

    ) or die(mysqli_error($db_handle));

    while ($row = mysqli_fetch_assoc($sql_stud_check)) {
        $index['class_id'] = $row['class_id'];
        $index['unit_id'] = $row['unit_id'];
        $index['unit_code'] = $row['unit_code'];
        $index['unit_name'] = $row['unit_name'];
        $result['student_id'] = $row['student_id'];

        $class_id = $row['class_id'];

        $index['total_classes'] = fetch_total_classes($class_id, $db_handle);
        $index['attended_classes'] = fetch_classes_attended($class_id, $student_id, $db_handle);

        $percent_attendance =   ($index['attended_classes'] / $index['total_classes']) * 100;

        $index['percent_attendance'] = round($percent_attendance, 2) . "%";
        array_push($result['classes'], $index);
    }

    echo  json_encode($result);
    return $result;
}

function fetch_total_classes($class_id, $db_handle)
{
    $sql_stud_check2 =
        "SELECT count(id) AS  total_classes
        FROM classes_held 
        WHERE class_id = '$class_id'";

    $response = mysqli_query($db_handle, $sql_stud_check2);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['total_classes'] = $row['total_classes'];
    }
    return $index['total_classes'] = $row['total_classes'];
}


function fetch_classes_attended($class_id, $student_id, $db_handle)
{
    $sql_stud_check2 =
        "SELECT count(attendance_id) AS  attended_classes
        FROM attendance_list 
        WHERE class_id = '$class_id'
        AND student_id =  '$student_id'";

    $response = mysqli_query($db_handle, $sql_stud_check2);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['attended_classes'] = $row['attended_classes'];
    }
    return $index['attended_classes'] = $row['attended_classes'];
}
