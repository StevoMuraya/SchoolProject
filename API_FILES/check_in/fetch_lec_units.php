<?php
require('config.php');

if (isset($_POST['lec_id'])) {
    $lec_id      = filter_var($_POST['lec_id'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


    $result = array();
    $result['scans'] = array();
    $result = fetch_lec_units($lec_id, $db_handle, $result);
    echo  json_encode($result);
}


function fetch_lec_units($lec_id, $db_handle, $result)
{
    $sql_stud_check = mysqli_query(
        $db_handle,
        "SELECT *
        FROM unit_lecs AS ul,
            units AS u
        WHERE lec_id = '$lec_id'
        AND ul.unit_id = u.unit_id
        ORDER BY ul.id DESC"
    ) or die(mysqli_error($db_handle));

    while ($row = mysqli_fetch_assoc($sql_stud_check)) {
        $index['unit_id'] = $row['unit_id'];
        $index['unit_name'] = $row['unit_name'];
        $index['unit_code'] = $row['unit_code'];

        array_push($result['scans'], $index);
    }

    return $result;
}
