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

$query = $db->prepare("SELECT user_id FROM tickets WHERE id = :id");
$query->execute([":id" => $id ]);
$userId = $query->fetch(PDO::FETCH_ASSOC);

$query = $db->prepare("SELECT * FROM users WHERE id = :id");
$query->execute([":id" => $_SESSION["user"]]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($userId["user_id"] !== $_SESSION["user"] && (int)$user["user_group_id"] !== $config["adminUser"]) {
    echo "Error handling request";
    die();
}

$query = $db->prepare("DELETE FROM tickets WHERE id = :id");
$query->execute([":id" => $id ]);

header("Location: /pages/my-tickets.php");