<?php
session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <?php require_once __DIR__ . "/layouts/head.php" ?>
    <title>Главная страница</title>
</head>
<?php require_once __DIR__ . "/app/database/city.php" ?>
<body>
<?php require_once __DIR__ . "/layouts/header.php" ?>
<section class="main">
    <div class="container">
        <div class="row">
            <h2 class="display-6 mb-3">Заявки</h2>
        </div>
        <div class="row">
            <?php
            if (isset($_GET["q"])) {
                $q = $db->prepare("SELECT * FROM tickets WHERE title LIKE :q ORDER BY id DESC");
                $q->execute([
                        ":q" => "%{$_GET["q"]}%"
                ]);
                $tickets = $q->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $tickets = $db->query("SELECT * FROM tickets ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
            }

            if (empty($tickets)) {
                ?>
                <div class="alert alert-info" role="alert">
                    Заявок не найдено.
                </div>
                <?php
            }

            $allStatus = $db->query("SELECT * FROM ticket_status")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($tickets as $ticket) {
                $statusId = $ticket["status_id"];
                $status = array_filter($allStatus, function ($status) use ($statusId) {
                    return (int)$status["id"] === (int)$statusId;
                });
                $status = array_pop($status);
                ?>
            <div class="card mb-3">
                <img src="<?= "/" . $ticket["image"] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $ticket["title"] ?><span
                                class="badge bg-warning text-dark"><?= $status["label"] ?></span></h5>
                    <p class="card-text"><?= $ticket["description"] ?></p>
                    <p class="card-text"><small class="text-muted"><?= $ticket["created_at"] ?></small></p>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </div>
</section>
<?php require_once __DIR__ . "/layouts/script.php" ?>
</body>
</html>