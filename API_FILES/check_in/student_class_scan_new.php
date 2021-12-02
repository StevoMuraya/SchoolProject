<?php
require('config.php');
date_default_timezone_set("Africa/Nairobi");

if (
    isset($_GET['student_id']) &&
    isset($_GET['qr_code'])
) {
    $student_id   = filter_var($_GET['student_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $qr_code      = filter_var($_GET['qr_code'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


    $result = array();
    $result['scans'] = array();

    if (check_qr_validity($qr_code, $db_handle, $result) == 1) {
        $result['success'] = "1";
        $result['qr_code_info'] = "QR Code Found";

        if (check_qr_status($qr_code, $db_handle, $result) == 1) {
            $result['success'] = "1";
            $result['qr_code_info'] = "QR Code Found";
            $result['qr_code_status'] = "QR Code Active";
            fetch_class_details($student_id, $qr_code, $db_handle, $result);
        } else {
            $result['success'] = "404";
            $result['qr_code_status'] = "QR Code Inctive";
            echo json_encode($result);
        }
    } else {
        $result['success'] = "404";
        $result['qr_code_info'] = "QR Code Not From System";
        echo json_encode($result);
    }
    mysqli_close($db_handle);
}

function check_qr_validity($qr_code, $db_handle, $result)
{
    $sql_check = "SELECT * 
                FROM classes 
                WHERE class_code = '$qr_code'";
    $response = mysqli_query($db_handle, $sql_check);


    if (mysqli_num_rows($response) > 0) {
        $result['success'] = "1";
        $result['message'] = "Class exists";
        return  1;
    } else {
        $result['success'] = "404";
        $result['message'] = "Class doesn't exists";
        return  0;
    }
}

function check_qr_status($qr_code, $db_handle, $result)
{
    $sql_check = "SELECT * 
                FROM classes 
                WHERE class_code = '$qr_code'
                AND status = 0";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        $result['success'] = "1";
        $result['qr_code_status'] = "QR Code Active";
        return  1;
    } else {
        $result['success'] = "404";
        $result['qr_code_status'] = "QR Code Inctive";
        return  0;
    }
}

function fetch_class_details($student_id, $qr_code, $db_handle, $result)
{
    $sql = "SELECT cl.class_id,cl.unit_id,cl.lec_id,cl.class_year,cl.class_sem,
                    cl.class_start,cl.class_stop,cl.status,cl.class_code,cl.date_updated,
                    u.unit_name,u.unit_code,
                    l.lec_firstname,l.lec_lastname
            FROM classes AS cl,units AS u,lecturers AS l
            WHERE cl.class_code = '" . $qr_code . "'
            AND cl.unit_id=u.unit_id
            AND cl.lec_id=l.lec_id";
    $response = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['class_id'] = $row['class_id'];
        $index['unit_id'] = $row['unit_id'];
        $index['lec_id'] = $row['lec_id'];
        $index['class_sem'] = $row['class_sem'];
        $index['class_year'] = $row['class_year'];

        $index['class_start'] = $row['class_start'];
        $dates_start = explode(" ", $row['class_start']);
        $date_start = $dates_start[0];
        $time_start = $dates_start[1];

        $index['date_start'] = $date_start;
        $index['time_start'] = date('h:i A', strtotime($time_start));

        $index['class_stop'] = $row['class_stop'];
        $dates_stop = explode(" ", $row['class_stop']);
        $date_stop = $dates_stop[0];
        $time_stop = $dates_stop[1];
        $index['date_stop'] = $date_stop;
        $index['time_stop'] = date('h:i A', strtotime($time_stop));

        $index['status'] = $row['status'];
        $index['class_code'] = $row['class_code'];
        $index['unit_name'] = $row['unit_name'];
        $index['unit_code'] = $row['unit_code'];
        $index['lec_name'] = $row['lec_firstname'] . " " . $row['lec_lastname'];


        if (check_student_class($student_id, $row['class_id'], $db_handle) == 1) {
            $result['success'] = "1";
            $result['message'] = "Student in class";

            if (check_student_scan_dublicate($student_id, $qr_code, $db_handle) == 1) {
                $result['success'] = "3";
                $result['message'] = "Student already signed";
            } else {
                $result['success'] = "1";
                $result['message'] = "Student not signed in";
                if (sign_in_student($student_id, $row['class_id'], $qr_code, $db_handle) == 1) {
                    $result['success'] = "1";
                    $result['message'] = "Student signed in successfully";
                } else {
                    $result['success'] = "4";
                    $result['message'] = "Failed to sign in";
                }
            }
        } else {
            $result['success'] = "2";
            $result['message'] = "Student not in class";
        }
        array_push($result['scans'], $index);
        echo    json_encode($result);

        return $result;
    }
}

function check_student_class($student_id, $class_id, $db_handle)
{
    $sql_check = "SELECT * 
                FROM unit_students 
                WHERE class_id = '$class_id'
                AND student_id = '$student_id'";
    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        return  1;
    } else {
        return  0;
    }
}

function check_student_scan_dublicate($student_id, $class_hash_code, $db_handle)
{
    $sql_check = "SELECT * FROM attendance_list 
            WHERE student_id = '" . $student_id . "'
            AND class_code = '" . $class_hash_code . " '";

    $response = mysqli_query($db_handle, $sql_check);

    if (mysqli_num_rows($response) > 0) {
        return  1;
    } else {
        return  0;
    }
}


function sign_in_student($student_id, $class_id, $class_hash_code, $db_handle)
{
    $date_reg = date("Y-m-d h:i:sa");
    $sql_sign_in = "INSERT INTO attendance_list(class_id,
                                            student_id,
                                            class_code,scan_time,created_at,updated_at) 
                                VALUES ('$class_id',
                                        '$student_id',
                                        '$class_hash_code',
                                        '$date_reg',
                                        '$date_reg',
                                        '$date_reg')";


    if (mysqli_query($db_handle, $sql_sign_in)) {
        return 1;
    } else {
        return 0;
    }
}
