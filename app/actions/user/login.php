<?php
session_start();

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../database/city.php";

$email = $_POST["email"];
$password = $_POST["password"];

$query = $db->prepare("SELECT * FROM users WHERE email = :email");
$query->execute(["email" => $email]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user["password"])) {
    $_SESSION["auth"] = true;
    header("location: /pages/login.php");
}

if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user"] = $user["id"];
    header("Location: /index.php");
}