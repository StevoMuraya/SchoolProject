<?php
require('config.php');

if (isset($_POST['class_code'])) {
    $class_code      = filter_var($_POST['class_code'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $result = array();
    $result['scans'] = array();
    $result = fetch_students_present($class_code, $db_handle, $result);

    echo json_encode($result);
}

function fetch_students_present($class_code, $db_handle, $result)
{
    $sql_stud_check = mysqli_query(
        $db_handle,
        "SELECT *
        FROM attendance_list AS al,students AS s
        WHERE al.class_code = '$class_code'
        AND al.student_id = s.student_id
        ORDER BY attendance_id DESC"
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

        array_push($result['scans'], $index);
    }

    return $result;
}
