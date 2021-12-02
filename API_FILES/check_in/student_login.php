<?php
$global_pass = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email          = filter_var($_POST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $global_pass    = filter_var($_POST['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    require_once('config.php');

    $sql = "SELECT * FROM lecturers WHERE  lec_email = '$email'";
    $response = mysqli_query($db_handle, $sql);
    $result = array();
    $result['login'] = array();

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        if (password_verify($global_pass, $row['lec_password'])) {
            $index['lec_id'] = $row['lec_id'];
            $index['firstname'] = $row['lec_firstname'];
            $index['lastname'] = $row['lec_lastname'];
            $index['email'] = $row['lec_email'];
            $index['phone'] = $row['lec_phone'];
            $index['code'] = $row['lec_code'];
            $index['lec_image'] = $row['lec_image'];

            array_push($result['login'], $index);
            $result['success'] = "1";
            $result['message'] = "success lecturer";
            echo json_encode($result);
        } else {
            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);
        }
    } else {
        $sql2 = "SELECT * FROM students WHERE   student_email = '$email'";
        $response = mysqli_query($db_handle, $sql2);
        $result = array();
        $result['login'] = array();

        if (mysqli_num_rows($response) > 0) {
            $row = mysqli_fetch_assoc($response);
            if (password_verify($global_pass, $row['student_password'])) {
                $index['student_id'] = $row['student_id'];
                $index['firstname'] = $row['student_firstname'];
                $index['lastname'] = $row['student_lastname'];
                $index['email'] = $row['student_email'];
                $index['phone'] = $row['student_phone'];
                $index['regNo'] = $row['student_regNo'];
                $index['student_profile'] = $row['student_profile'];

                array_push($result['login'], $index);
                $result['success'] = "2";
                $result['message'] = "success student";
                echo json_encode($result);
            } else {
                $result['success'] = "0";
                $result['message'] = "error";
                echo json_encode($result);
            }
        } else {
            $result['success'] = "0";
            $result['message'] = "error";
            echo json_encode($result);
        }
        mysqli_close($db_handle);
    }
}
