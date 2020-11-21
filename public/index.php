<?php
require_once "../vendor/autoload.php";

header('Content-Type: application/json; charset=utf-8');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

function dd($a)
{
    echo "<pre>";
    print_r($a);
}
$tableData = [];
if (!array_key_exists("code", $_GET) || trim($_GET['code']) == "") {
    http_response_code(404);
} else {
    $bgpost = new \Tracking\BgPostService();

    $tableData = $bgpost->track(trim($_GET['code']));
    if (count($tableData) == 1 && $tableData[0]["status"] == \Tracking\BgPostService::EVENT_STATUS_WRONG_CODE) {
        http_response_code(404);
    }
}

echo json_encode($tableData);
