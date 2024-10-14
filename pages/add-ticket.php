<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: /index.php");
}
?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ . "/../layouts/head.php" ?>
    <title>Добавить заявку</title>
</head>
<body>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<section class="main">
    <div class="container">
        <div class="row">
            <h2 class="display-6 mb-3">Добавить заявку</h2>
        </div>
        <div class="row">
            <form action="/app/actions/tickets/add_ticket.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullNameField" class="form-label">Тема заявки</label>
                    <input name="title" type="text" class="form-control" id="fullNameField"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="fullNameField" class="form-label">Изображение</label>
                    <input name="image" type="file" class="form-control" id="fullNameField"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="dobField" class="form-label">Описание</label>
                    <textarea name="description" class="form-control" id="dobField"
                              aria-describedby="emailHelp"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Добавить заявку</button>
            </form>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../layouts/script.php" ?>
</body>
</html>