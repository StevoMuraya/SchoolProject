<?php
require('config.php');

if (isset($_POST['student_id'])) {
    $student_id         = filter_var($_POST['student_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    if ($stmt = $db_handle->prepare("SELECT us.id,us.student_id,us.class_id,us.date_reg,
                                            l.lec_firstname,l.lec_lastname,
                                            u.unit_code,u.unit_id,u.unit_name
                                    FROM unit_students AS us,
                                        classes AS cl,
                                        lecturers AS l,
                                        units AS u
                                    WHERE us.student_id = '$student_id'
                                    AND us.class_id = cl.class_id
                                    AND cl.lec_id = l.lec_id
                                    AND cl.unit_id = u.unit_id")) {

        $stmt->execute();
        $db_handle->error;
        $stmt->bind_result(
            $id,
            $student_id,
            $class_id,
            $date_reg,
            $lec_firstname,
            $lec_lastname,
            $unit_code,
            $unit_id,
            $unit_name
        );
        $products = array();
        $items_array = array();
    } else {
        printf('errno: %d, error: %s', $db_handle->errno, $db_handle->error);
        die;
    }

    while ($stmt->fetch()) {
        $items_array['id'] =  $id;
        $items_array['student_id'] = $student_id;
        $items_array['class_id'] = $class_id;
        $items_array['unit_id'] = $unit_id;
        $dates_regs = explode(" ", $date_reg);
        $dates_regss = $dates_regs[0];

        $items_array['date_reg'] = $dates_regss;
        $items_array['lec_name'] = $lec_firstname . " " . $lec_lastname;
        $items_array['unit_code'] = $unit_code;
        $items_array['unit_name'] = $unit_name;
        array_push($products, $items_array);
    }
    echo json_encode($products);
    mysqli_close($db_handle);
}
