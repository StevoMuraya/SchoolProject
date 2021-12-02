<?php
include 'config.php';
date_default_timezone_set("Africa/Nairobi");
if (
    isset($_POST['unit_id']) &&
    isset($_POST['lec_id']) &&
    isset($_POST['class_sem']) &&
    isset($_POST['class_start']) &&
    isset($_POST['class_stop'])
) {
    $unit_id            = filter_var($_POST['unit_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $lec_id             = filter_var($_POST['lec_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $class_sem          = filter_var($_POST['class_sem'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $class_start        = filter_var($_POST['class_start'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $class_stop         = filter_var($_POST['class_stop'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

    $class_dates_values = explode(" ", $class_start);
    $class_date = $class_dates_values[0];

    $year = DateTime::createFromFormat("Y-m-d", $class_date);

    $class_year = $year->format("Y");

    $class_code         = uniqid('', true);
    $class_code_hash     = password_hash($class_code, PASSWORD_BCRYPT);


    check_existing_class($lec_id, $unit_id, $class_sem, $class_year, $class_start, $class_stop, $class_code_hash, $db_handle);
}

function check_existing_class($lec_id, $unit_id, $class_sem, $class_year, $class_start, $class_stop, $class_code_hash, $db_handle)
{

    $sql_check = "SELECT * 
                FROM classes 
                WHERE lec_id = '$lec_id'
                AND unit_id = '$unit_id'
                AND class_year = '$class_year'
                AND class_sem = '$class_sem'
    ";
    $response = mysqli_query($db_handle, $sql_check);
    $result = array();
    $result['check'] = array();

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['class_id'] = $row['class_id'];
        $index['unit_id'] = $row['unit_id'];
        $index['lec_id'] = $row['lec_id'];
        $index['class_sem'] = $row['class_sem'];
        $index['class_start'] = $row['class_start'];
        $index['class_stop'] = $row['class_stop'];
        $index['status'] = $row['status'];
        $index['class_code'] = $row['class_code'];
        $index['date_updated'] = $row['date_updated'];
        $index['date_reg'] = $row['date_reg'];

        array_push($result['check'], $index);
        $result['success'] = "1";
        $result['message'] = "Class exists";

        update_class_codes($lec_id, $unit_id, $class_sem, $class_year, $row['class_id'], $class_start, $class_stop, $class_code_hash, $db_handle);
    } else {
        $result['success'] = "2";
        $result['message'] = "Class doesn't exists";
        create_new_class($lec_id, $unit_id, $class_sem, $class_year, $class_start, $class_stop, $class_code_hash, $db_handle);
    }
    echo json_encode($result);
}

function create_new_class($lec_id, $unit_id, $class_sem, $class_year, $class_start, $class_stop, $class_code_hash, $db_handle)
{
    $date_reg = date("Y-m-d h:i:sa");
    $sql = "INSERT INTO classes(unit_id,
                                lec_id,
                                class_sem,
                                class_year,
                                class_start,
                                class_stop,
                                status,
                                class_code,
                                date_updated,
                                date_reg,
                                created_at,
                                updated_at) 
                        VALUES ('$unit_id',
                                '$lec_id',
                                '$class_sem',
                                '$class_year',
                                '$class_start',
                                '$class_stop',
                                '0',
                                '$class_code_hash',
                                '$date_reg',
                                '$date_reg',
                                '$date_reg',
                                '$date_reg')";

    if (mysqli_query($db_handle, $sql)) {
        // echo "Class Registered Successfully";
        fetch_class_records($lec_id, $unit_id, $class_sem, $class_year, $db_handle);
    } else {
        // echo "Failed To Register Class";
    }
}

function update_class_codes($lec_id, $unit_id, $class_sem, $class_year, $class_id, $class_start, $class_stop, $class_code_hash, $db_handle)
{
    $date_updateds = new DateTime();
    $date_updated = $date_updateds->getTimestamp();

    $sql = "UPDATE classes SET
            class_start = '$class_start',
            class_stop = '$class_stop',
            class_code = '$class_code_hash',
            date_updated = now(),
            updated_at = now()
            WHERE class_id = '$class_id'";

    if (mysqli_query($db_handle, $sql)) {
        // echo "Class Updated Successfully";
        fetch_class_records($lec_id, $unit_id, $class_sem, $class_year, $db_handle);
    } else {
        // echo "Failed To Update Class";
    }
}


function fetch_class_records($lec_id, $unit_id, $class_sem, $class_year, $db_handle)
{

    $sql_check = "SELECT * 
                FROM classes 
                WHERE lec_id = '$lec_id'
                AND unit_id = '$unit_id'
                AND class_year = '$class_year'
                AND class_sem = '$class_sem'
    ";
    $response = mysqli_query($db_handle, $sql_check);
    $result = array();
    $result['check'] = array();

    if (mysqli_num_rows($response) > 0) {
        $row = mysqli_fetch_assoc($response);
        $index['class_id'] = $row['class_id'];
        $index['unit_id'] = $row['unit_id'];
        $index['lec_id'] = $row['lec_id'];
        $index['class_sem'] = $row['class_sem'];
        $index['class_start'] = $row['class_start'];
        $index['class_stop'] = $row['class_stop'];
        $index['status'] = $row['status'];
        $index['class_code'] = $row['class_code'];
        $index['date_updated'] = $row['date_updated'];
        $index['date_reg'] = $row['date_reg'];

        create_log_record($row['class_id'], $row['class_code'], $row['class_start'], $row['class_stop'], $db_handle);
    }
}

function create_log_record($class_id, $class_code, $class_start, $class_stop, $db_handle)
{

    $date_reg = date("Y-m-d h:i:sa");
    $sql = "INSERT INTO classes_held(class_id,
                                    class_code,
                                    class_start,
                                    class_stop,
                                    date_reg,
                                    created_at,
                                    updated_at) 
                        VALUES ('$class_id',
                                '$class_code',
                                '$class_start',
                                '$class_stop',
                                '$date_reg',
                                '$date_reg',
                                '$date_reg')";

    if (mysqli_query($db_handle, $sql)) {
        // echo "Record Created Successfully";
    } else {
        // echo "Failed To Create Record";
    }
}
