<?php
require('config.php');

if (isset($_POST['class_code'])) {
    $class_code      = filter_var($_POST['class_code'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $result = array();
    $result['scans'] = array();

    $result = fetch_students_in_class(fetch_class_id($class_code, $db_handle), $class_code, $db_handle, $result);
    echo json_encode($result);
}

function fetch_students_in_class($class_id, $class_code, $db_handle, $result)
{
    $sql_stud_check = mysqli_query(
        $db_handle,
        "SELECT *
        FROM unit_students AS us,
            classes AS c,
            students AS s,
            attendance_list AS al
        WHERE us.class_id = '$class_id'
        AND us.class_id = c.class_id
        AND s.student_id = al.student_id
        AND al.class_id = '$class_id'
        AND us.student_id = s.student_id"

    ) or die(mysqli_error($db_handle));

    while ($row = mysqli_fetch_assoc($sql_stud_check)) {
        $index['attendance_id'] = $row['attendance_id'];
        $index['class_id'] = $row['class_id'];
        $index['class_code'] = $row['class_code'];
        $index['student_id'] = $row['student_id'];
        $index['scan_time'] = $row['scan_time'];
        $index['student_profile'] = $row['student_profile'];
        $index['student_name'] = $row['student_firstname'] . " " . $row['student_lastname'];
        $index['student_reg'] = $row['student_regNo'];

        if (fetch_absent_students($class_code, $row['student_id'], $db_handle, $result) == 404) {
            array_push($result['scans'], $index);
        }
    }

    return $result;
}

function fetch_absent_students($class_code, $student_id, $db_handle, $result)
{
    $sql_stud_check2 =
        "SELECT *
        FROM attendance_list 
        WHERE class_code = '$class_code'
        AND student_id = '$student_id'";

    $response = mysqli_query($db_handle, $sql_stud_check2);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        return  1;
    } else {
        return 404;
    }
}

function fetch_class_id($class_code, $db_handle)
{
    $sql_check = "SELECT class_id
                FROM classes_held 
                WHERE class_code = '$class_code'";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
    }

    return $row['class_id'];
}
