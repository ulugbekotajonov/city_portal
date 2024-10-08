<?php
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ . "/../layouts/head.php" ?>
    <title>Регистрация</title>
</head>
<body>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<section class="main">
    <div class="container">
        <div class="card">
            <div class="card-header">
                Регистрация
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION["fields"])) {
                    ?>
                    <br>
                    <div class="alert alert-danger" role="alert">
                        Проверьте правильность введённых данных
                    </div>
                    <?php
                }
                if (isset($_SESSION["fields"]["duplicate"]["error"])) {
                ?>
                <br>
                <div class="alert alert-danger" role="alert">
                    Такое имя пользователья уже существует
                </div>
                <?php
                $fields = $_SESSION["fields"] ?? null;
                unset($_SESSION["fields"]); }
                ?>
                <form method="post" action="../app/actions/user/register.php">
                    <div class="mb-3">
                        <label for="emailRegisterField" class="form-label">E-mail</label>
                        <input type="email" value="<?= $fields["email"]["value"] ?? "" ?>" name="email"
                               class="form-control <?= $fields["email"]["error"] ? "is-invalid" : "" ?>"
                               id="emailRegisterField" aria-describedby="emailHelp" required>
                        <div id="emailRegisterHelp" class="form-text">Мы никогда никому не передадим вашу электронную
                            почту.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="fullNameField" class="form-label">ФИО</label>
                        <input type="text" value="<?= $fields["name"]["value"] ?? "" ?>" name="name"
                               class="form-control <?= $fields["name"]["error"] ? "is-invalid" : "" ?>"
                               id="fullNameField" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="dobField" class="form-label">Дата рождения</label>
                        <input type="date" value="<?= $fields["date"]["value"] ?? "" ?>" name="date"
                               class="form-control <?= $fields["date"]["error"] ? "is-invalid" : "" ?>" id="dobField"
                               aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordRegisterField" class="form-label">Пароль</label>
                        <input type="password" name="password"
                               class="form-control <?= $fields["date"]["error"] ? "is-invalid" : "" ?>"
                               id="passwordRegisterField" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmField" class="form-label">Подтверждение пароля</label>
                        <input type="password" name="passwordConfirmation"
                               class="form-control <?= $fields["date"]["error"] ? "is-invalid" : "" ?>"
                               id="passwordConfirmField" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Создать аккаунт</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../layouts/script.php" ?>
</body>
</html>