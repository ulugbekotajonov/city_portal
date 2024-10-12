<?php
session_start();
require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../database/city.php";

$config = require_once __DIR__ . "/../../config/defaults.php";

if (!isset($_SESSION["user"])) {
    echo "Error handling request";
    die();
}

$title = $_POST["title"];
$description = $_POST["description"];
$image = $_FILES["image"];

$path = __DIR__ . "/../../../uploads/images";
$fileName = uniqid() . "-" . $image["name"];

if (!is_dir($path)) {
    mkdir($path);
}

move_uploaded_file($image["tmp_name"], $path . "/" . $fileName);

$query = $db->prepare("INSERT INTO `tickets` (title, description, image, user_id, status_id) VALUES (:title, :description, :image, :user_id, :status_id)");
try {
    $query->execute([
        "title" => $title,
        "description" => $description,
        "image" => "uploads/images/$fileName",
        "user_id" => $_SESSION["user"],
        "status_id" => $config["defaultStatus"]
    ]);
    header("Location: /pages/my-tickets.php");
} catch (\PDOException $exception) {
    echo $exception->getMessage();
}
