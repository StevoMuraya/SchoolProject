<?php
include 'config.php';
date_default_timezone_set("Africa/Nairobi");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname            = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $lastname            = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $email                = filter_var($_POST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $phone                = filter_var($_POST['phone'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $regNo                = filter_var($_POST['regNo'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $password            = filter_var($_POST['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $encrypted_pass     = password_hash($password, PASSWORD_BCRYPT);
    $profile_pic        = "default.jpg";

    $sql = "SELECT * FROM students WHERE student_email = '$email'";
    $response = mysqli_query($db_handle, $sql) or
        trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($db_handle), E_USER_ERROR);
    $result = array();

    if (mysqli_num_rows($response) == 1) {
        $result['success'] = "0";
        $result['message'] = "Email Exists";
        echo json_encode($result);
        mysqli_close($db_handle);
    } else {
        $sql2 = "SELECT * FROM students WHERE student_phone = '$phone'";
        $response = mysqli_query($db_handle, $sql2);
        $result2 = array();

        if (mysqli_num_rows($response) == 1) {
            $result2['success'] = "0";
            $result2['message'] = "Phone Exists";
            echo json_encode($result2);

            mysqli_close($db_handle);
        } else {
            $sql3 = "SELECT * FROM students WHERE student_regNo = '$regNo'";
            $response = mysqli_query($db_handle, $sql3);
            $result3 = array();

            if (mysqli_num_rows($response) == 1) {
                $result3['success'] = "0";
                $result3['message'] = "Registration number Exists";
                echo json_encode($result3);

                mysqli_close($db_handle);
            } else {

                $date_reg = date("Y-m-d h:i:sa");
                $sql4 = "INSERT INTO students(student_firstname,
                                            student_lastname,
                                            student_email,
                                            student_phone,
                                            student_regNo,
                                            student_password,
                                            student_profile,
                                            created_at,
                                            updated_at) 
                                VALUES ('$firstname',
                                        '$lastname',
                                        '$email',
                                        '$phone',
                                        '$regNo',
                                        '$encrypted_pass',
                                        '$profile_pic',
                                        '$date_reg',
                                        '$date_reg')";

                if (mysqli_query($db_handle, $sql4)) {
                    // $auth_number = mt_rand(100000, 999999);
                    // sendEmail($email, $firstname . " " . $lastname, $auth_number);

                    $sql5 = "SELECT * FROM students WHERE student_email = '$email'";
                    $response5 = mysqli_query($db_handle, $sql5);
                    $result5 = array();
                    $result5['login'] = array();


                    if (mysqli_num_rows($response5) > 0) {
                        $row = mysqli_fetch_assoc($response5);
                        $index['student_id'] = $row['student_id'];
                        $index['firstname'] = $row['student_firstname'];
                        $index['lastname'] = $row['student_lastname'];
                        $index['email'] = $row['student_email'];
                        $index['phone'] = $row['student_phone'];
                        $index['regNo'] = $row['student_regNo'];
                        $index['student_profile'] = $row['student_profile'];

                        array_push($result5['login'], $index);
                        $result5['success'] = "1";
                        $result5['message'] = "Logged in successfully";
                        echo json_encode($result5);
                    } else {
                        $result5['success'] = "0";
                        $result5['message'] = "Failed to login";
                        echo json_encode($result5);
                    }
                } else {
                    echo "Failed to Register";
                }
                mysqli_close($db_handle);
            }
        }
    }
} else {
    echo 'Error in capturing data';
}

function sendEmail($email, $name, $auth_number)
{
    //PHPMailer Object
    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

    //From email address and name
    $mail->From = "validator@checkin-system.co.ke";
    $mail->FromName = "Checkin System Validator";

    //To address and name
    $mail->addAddress($email, $name);
    // $mail->addAddress("recepient1@example.com"); //Recipient name is optional

    //Address to which recipient will reply
    $mail->addReplyTo("no-reply@checkin-system.co.ke", "No-Reply");

    //CC and BCC
    // $mail->addCC("cc@example.com");
    // $mail->addBCC("bcc@example.com");

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "New Account Created";
    $mail->Body = "<i>Mail body in HTML</i>";
    $mail->AltBody = "This email has been sent by check-in systems to authenticate ownership of this email\n You are receiving this email because it was used to open a new account on our application. The following is your authentication code. Enter it in the Mobile App to verify: \n" . $auth_number;

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
