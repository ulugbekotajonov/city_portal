<?php
session_start();
require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../database/city.php";
$config = require __DIR__ . "/../../config/defaults.php";

if (!isset($_SESSION["user"])) {
    echo "Error handling request";
    die();
}

$id = $_POST["id"];
$status = $_POST["type"];

$q = $db->prepare("SELECT * FROM ticket_status WHERE id = :id");
$q->execute([
    ":id" => $status
]);
$statusExist = $q->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT * FROM users WHERE id = :id");
$query->execute([":id" => $_SESSION["user"]]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ((int)$user["user_group_id"] === $config["adminUser"]) {
    $query = $db->prepare("UPDATE tickets SET status_id = :type WHERE id = :id");
    $query->execute([
        ":type" => $status,
        ":id" => $id
    ]);
}

header("Location: /pages/tickets-control.php");