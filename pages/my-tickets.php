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
    <title>Мои заявки</title>
</head>
<body>
<?php require_once __DIR__ . "/../layouts/header.php" ?>
<section class="main">
    <div class="container">
        <div class="row">
            <h2 class="display-6 mb-3">Мои заявки</h2>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Изображение</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $allStatus = $db->query("SELECT * FROM ticket_status")->fetchAll(PDO::FETCH_ASSOC);

                $query = $db->prepare("SELECT * FROM tickets WHERE user_id = :id");
                $query->execute([":id" => $_SESSION["user"]]);
                $tickets = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tickets as $ticket) {
                    $statusId = $ticket["status_id"];
                    $status = array_filter($allStatus, function ($status) use ($statusId) {
                        return (int)$status["id"] === (int)$statusId;
                    });
                    $status = array_pop($status);
                    ?>
                    <tr>
                        <td>
                            <img src="<?= "/" . $ticket["image"] ?>" width="200" alt="">
                        </td>
                        <td><?= $ticket["title"] ?></td>
                        <td><?= $ticket["description"] ?></td>
                        <td>
                            <span class="badge rounded-pill bg-success"><?= $status["label"] ?></span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    Действия
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <form action="/app/actions/tickets/delete_ticket.php" method="post">
                                            <input type="hidden" name="id" value="<?= $ticket["id"] ?>">
                                            <button class="dropdown-item" type="submit">Удалить</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../layouts/script.php" ?>
</body>
</html>