<?php
session_start();
require_once __DIR__ . "/../../../vendor/autoload.php";

if (!isset($_SESSION["user"])) {
    echo "Error handling request";
    die();
}

$title = $_POST["title"];
$description = $_POST["description"];
$image = $_FILES["image"];

// TODO: validation

$path = __DIR__ . "/../../../uploads/images";

if (!is_dir($path)) {
    mkdir($path);
}