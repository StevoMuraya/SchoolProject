<?php
require('config.php');

if (
    isset($_POST['student_id']) &&
    isset($_POST['class_id'])
) {
    $student_id         = filter_var($_POST['student_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $class_id         = filter_var($_POST['class_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    if ($stmt = $db_handle->prepare("SELECT al.attendance_id,al.student_id,al.class_id,al.scan_time,
                                            l.lec_firstname,l.lec_lastname,
                                            u.unit_code,u.unit_name
                                    FROM units AS u, 
                                        lecturers AS l, 
                                        attendance_list AS al,
                                        classes AS cl
                                    WHERE al.student_id = '$student_id' 
                                    AND cl.class_id='$class_id'
                                    AND al.class_id=cl.class_id
                                    AND cl.unit_id=u.unit_id
                                    AND cl.lec_id=l.lec_id")) {

        $stmt->execute();
        $db_handle->error;
        $stmt->bind_result(
            $attendance_id,
            $student_id,
            $class_id,
            $scan_time,
            $lec_firstname,
            $lec_lastname,
            $unit_code,
            $unit_name,
        );

        $products = array();
        $items_array = array();
    } else {
        printf('errno: %d, error: %s', $db_handle->errno, $db_handle->error);
        die;
    }

    while ($stmt->fetch()) {
        $items_array['attendance_id'] =  $attendance_id;
        $items_array['student_id'] = $student_id;
        $items_array['class_id'] = $class_id;
        $scan_times = explode(" ", $scan_time);
        $date_regss = $scan_times[0];
        $time_regss = $scan_times[1];

        $items_array['class_date'] = $date_regss;
        $items_array['class_time'] =  date('h:i A', strtotime($time_regss));
        $items_array['lec_name'] = $lec_firstname . " " . $lec_lastname;
        $items_array['unit_code'] = $unit_code;
        $items_array['unit_name'] = $unit_name;
        array_push($products, $items_array);
    }
    echo json_encode($products);
    mysqli_close($db_handle);
}
