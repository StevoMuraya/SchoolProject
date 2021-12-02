<?php
require('config.php');

date_default_timezone_set("Africa/Nairobi");
if (
    isset($_POST['student_reg']) &&
    isset($_POST['class_id'])
) {
    $student_reg   = filter_var($_POST['student_reg'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $class_id      = filter_var($_POST['class_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $student_reg = str_replace(' ', '', $student_reg);
    $student_reg = preg_replace('/\s+/', '', $student_reg);
    $student_reg = strtoupper($student_reg);

    $result = array();
    $result['scans'] = array();

    if (check_student_db($student_reg, $db_handle, $result) == 1) {
        if (check_student_class(
            fetch_student_details(
                $student_reg,
                $db_handle,
                $result
            ),
            $class_id,
            $db_handle
        ) == 1) {
            //Student is in class
            if (check_student_scan_dublicate(fetch_student_details($student_reg, $db_handle, $result), fetch_class_details($class_id, $db_handle), $db_handle) == 1) {
                //Student Already Signed in
                $result = fetch_student_details2($student_reg, $db_handle, $result);
                $result['success'] = "3";
                $result['message'] = "Student already signed in";
            } else {
                //Student Not Signed in
                if (sign_in_student(fetch_student_details($student_reg, $db_handle, $result), $class_id, fetch_class_details($class_id, $db_handle), $db_handle) == 1) {
                    //Student Successfully Signed in
                    $result = fetch_student_details2($student_reg, $db_handle, $result);
                    $result['success'] = "1";
                    $result['message'] = "Student signed in successfully";
                } else {
                    //Student Failed to Sign in
                    $result = fetch_student_details2($student_reg, $db_handle, $result);
                    $result['success'] = "4";
                    $result['message'] = "Failed to sign in";
                }
            }
            echo json_encode($result);
        } else {
            //Student Not in class
            if (add_student_to_class(fetch_student_details($student_reg, $db_handle, $result), $class_id, $db_handle) == 1) {
                //Student Added To Class
                if (check_student_scan_dublicate(fetch_student_details($student_reg, $db_handle, $result), fetch_class_details($class_id, $db_handle), $db_handle) == 1) {
                    //Student Already Signed in
                    $result = fetch_student_details2($student_reg, $db_handle, $result);
                    $result['success'] = "3";
                    $result['message'] = "Student already signed";
                } else {
                    //Student Not Signed in
                    if (sign_in_student(fetch_student_details($student_reg, $db_handle, $result), $class_id, fetch_class_details($class_id, $db_handle), $db_handle) == 1) {
                        //Student Successfully Signed in
                        $result = fetch_student_details2($student_reg, $db_handle, $result);
                        $result['success'] = "1";
                        $result['message'] = "Student signed in successfully";
                    } else {
                        //Student Failed to Sign in
                        $result = fetch_student_details2($student_reg, $db_handle, $result);
                        $result['success'] = "4";
                        $result['message'] = "Failed to sign in";
                    }
                }
            } else {
                //Failed to Add Student To Class
                $result = fetch_student_details2($student_reg, $db_handle, $result);
                $result['success'] = "2";
                $result['message'] = "Failed to register student to class";
            }
            echo json_encode($result);
        }
    } else {
        $result['success'] = "404";
        $result['message'] = "Student Not Found";
        echo json_encode($result);
    }
}

function check_student_db($student_reg, $db_handle)
{
    $sql_stud_check = "SELECT * FROM students 
            WHERE student_regNo = '" . $student_reg . "'";

    $response = mysqli_query($db_handle, $sql_stud_check);

    if (mysqli_num_rows($response) > 0) {
        return  1;
    } else {
        return  404;
    }
}


function fetch_student_details($student_reg, $db_handle, $result)
{

    $result = array();
    $result['scans'] = array();

    $sql_stud_check = "SELECT * FROM students 
    WHERE student_regNo = '" . $student_reg . "'";

    $response = mysqli_query($db_handle, $sql_stud_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['student_id'] = $row['student_id'];
        array_push($result['scans'], $index);
        // echo  json_encode($result);
        return  $row['student_id'];
    }
}

function fetch_student_details2($student_reg, $db_handle, $result)
{

    $result = array();
    $result['scans'] = array();

    $sql_stud_check = "SELECT * FROM students 
    WHERE student_regNo = '" . $student_reg . "'";

    $response = mysqli_query($db_handle, $sql_stud_check);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['student_id'] = $row['student_id'];
        $index['student_firstname'] = $row['student_firstname'];
        $index['student_lastname'] = $row['student_lastname'];
        $index['student_email'] = $row['student_email'];
        $index['student_phone'] = $row['student_phone'];
        $index['student_regNo'] = $row['student_regNo'];
        $index['student_profile'] = $row['student_profile'];
        array_push($result['scans'], $index);
        // echo  json_encode($result);
        return  $result;
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

function add_student_to_class($student_id, $class_id, $db_handle)
{
    $date_reg = date("Y-m-d h:i:sa");
    $sql_add_student = "INSERT INTO unit_students(class_id,
                                    student_id,date_reg,created_at,updated_at) 
                                VALUES ('$class_id',
                                        '$student_id',
                                        '$date_reg',
                                        '$date_reg',
                                        '$date_reg')";


    if (mysqli_query($db_handle, $sql_add_student)) {
        return 1;
    } else {
        return 0;
    }
}


function fetch_class_details($class_id, $db_handle)
{
    $sql = "SELECT *
            FROM classes
            WHERE class_id = '" . $class_id . "'";
    $response = mysqli_query($db_handle, $sql);

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        // $index['class_code'] = $row['class_code'];

        return $row['class_code'];
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


function  handle_dublicate_check()
{
}
