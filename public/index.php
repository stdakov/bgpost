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
if (!array_key_exists("code", $_POST) || trim($_POST['code']) == "") {
    die();
}
$bgpost = new \Tracking\BgPostService();

$tableData = $bgpost->track(trim($_POST['code']));
if (count($tableData) == 1 && $tableData[0]["status"] == \Tracking\BgPostService::EVENT_STATUS_WRONG_CODE) {
    http_response_code(404);
}

echo json_encode($tableData);
