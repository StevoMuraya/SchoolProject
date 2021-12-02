<?php
require('config.php');

if (isset($_POST['class_id'])) {
    $class_id      = filter_var($_POST['class_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $result = array();
    $result['scans'] = array();
    $result =   fetch_classes_held($class_id, $db_handle, $result);
    $result =   fetch_students_count($class_id, $db_handle, $result);
    echo json_encode($result);
}

function fetch_students_count($class_id, $db_handle, $result)
{
    $sql_check = "SELECT count(*) AS 'total_students'
                FROM unit_students AS us
                WHERE class_id = '$class_id'";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
    }
    $result['total_students'] = $row['total_students'];

    return $result;
}


function fetch_classes_held($class_id, $db_handle, $result)
{
    $sql_stud_check = mysqli_query(
        $db_handle,
        "SELECT * FROM classes_held 
        WHERE class_id = '" . $class_id . "'
        ORDER BY id DESC"
    ) or die(mysqli_error($db_handle));

    while ($row = mysqli_fetch_assoc($sql_stud_check)) {
        $index['id'] = $row['id'];
        $index['class_id'] = $row['class_id'];
        $index['class_start'] = $row['class_start'];
        $index['class_stop'] = $row['class_stop'];
        $index['class_stop'] = $row['class_stop'];
        $index['class_code'] = $row['class_code'];
        $index['date_reg'] = $row['date_reg'];



        $sql_check = "SELECT count(*) AS 'students_attended'
                        FROM attendance_list
                        WHERE class_code = '" . $row['class_code'] . "'";

        $response = mysqli_query($db_handle, $sql_check);

        if (mysqli_num_rows($response) > 0) {
            $row = mysqli_fetch_assoc($response);
        }
        $index['students_attended'] = $row['students_attended'];

        array_push($result['scans'], $index);
    }

    $sql_check = "SELECT count(*) AS 'total_classes'
                FROM classes_held AS ch
                WHERE class_id = '$class_id'";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
    }
    $result['total_classes'] = $row['total_classes'];

    return $result;
}
