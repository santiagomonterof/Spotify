<?php
require_once "vendor/autoload.php";
$username="root";
$password="";
$hostname="localhost";
$port=3307;
$dbname="spotify";
header('Content-Type: application/json');
// enable cors
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}