<?php
session_start();

require_once __DIR__ . "/../../../vendor/autoload.php";
require_once __DIR__ . "/../../database/city.php";

$error = false;
$defaultUser = require_once __DIR__ . "/../../config/defaults.php";

$email = $_POST["email"];
$name = $_POST["name"];
$date = $_POST["date"];
$password = $_POST["password"];
$passwordConfirmation = $_POST["passwordConfirmation"];

$fields = [
    "email" => [
        "value" => $email,
        "error" => false
    ],
    "name" => [
        "value" => $name,
        "error" => false
    ],
    "date" => [
        "value" => $date,
        "error" => false
    ],
    "password" => [
        "error" => false
    ],
    "duplicate" => [
        "error" => false
    ]
];

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fields["email"]["error"] = true;
    $error = true;
}

if (empty($name)) {
    $fields["name"]["error"] = true;
    $error = true;
}

if (empty($date)) {
    $fields["date"]["error"] = true;
    $error = true;
}

if ($password !== $passwordConfirmation) {
    $fields["password"]["error"] = true;
    $error = true;
}

$query = $db->prepare("INSERT INTO `users` (`email`, `name`, `date`, `password`, `user_group_id`) VALUES (:email, :name, :date, :password, :defaultUser) ");
try {
    $query->execute([
        ":email" => $email,
        ":name" => $name,
        ":date" => $date,
        ":password" => password_hash($password, PASSWORD_DEFAULT),
        ":defaultUser" => $defaultUser["defaultUser"]
    ]);
    header("Location: /index.php");
} catch (\PDOException $exception) {
    $fields["duplicate"]["error"] = true;
    $error = true;
}

if ($error) {
    $_SESSION["fields"] = $fields;
    header("Location: /pages/register.php");
}




