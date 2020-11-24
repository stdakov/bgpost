<?php
require_once "../vendor/autoload.php";



//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

function dd($a)
{
    echo "<pre>";
    print_r($a);
    die();
}

if (strpos($_SERVER["REQUEST_URI"], '/api/v1/tracking') === 0 && array_key_exists("code", $_GET)) {
    $bgpost = new \Tracking\BgPostService();

    $tableData = $bgpost->track(trim($_GET['code']));;

    if (array_key_exists("filter", $_GET) && $_GET['filter'] == 'last' && count($tableData) > 0) {
        $tableData = end($tableData);
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($tableData);
} else {
    require "home.php";
}
