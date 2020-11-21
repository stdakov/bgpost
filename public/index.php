<?php
require_once "../vendor/autoload.php";

header('Content-Type: application/json; charset=utf-8');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

function dd($a)
{
    print_r($a);
}
$tableData = [];

if (array_key_exists("code", $_GET)) {
    $bgpost = new \Tracking\BgPostService();

    $tableData = $bgpost->track(trim($_GET['code']));
} else {

    http_response_code(404);
}

echo json_encode($tableData);
