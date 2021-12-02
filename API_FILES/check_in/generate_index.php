<?php
// include('phpqrcode/qrlib.php');

// // $tempDir = "./";

// // $codeContents = '123456DEMO';

// // echo phpinfo();
// QRcode::png('PHP QR Code :)');

// $x = "foo";

function foo(&$arg)
{
    $z = $arg;
    $arg += 1;
    echo  $arg;
}

$x = 3;
$y = foo($x);
