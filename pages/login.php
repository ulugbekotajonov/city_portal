<?php
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ . "/../layouts/head.php" ?>
    <title>Авторизация</title>
</head>
<body>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<section class="main">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Авторизация
            </div>
            <?php
            if (isset($_SESSION["auth"])) {
            ?>
            <br>
            <div class="alert alert-danger" role="alert">
                Проверьте правильность введённых данных
            </div>
            <?php
            }
            unset($_SESSION["auth"]);
            ?>
            <div class="card-body">
                <form action="../app/actions/user/login.php" method="post">
                    <div class="mb-3">
                        <label for="emailField" class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" id="emailField" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="passwordField" class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" id="passwordField">
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../layouts/script.php" ?>
</body>
</html>