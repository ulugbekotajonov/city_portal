<?php
require_once __DIR__ . "/../../../vendor/autoload.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    unset($_SESSION["user"]);
    session_destroy();
    header("Location: /pages/login.php");
} else {
    echo "Error handling request";
    die();
}


