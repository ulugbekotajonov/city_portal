<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">WayUp City</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Заявки</a>
                    </li>
                    <?php
                    $id = require __DIR__ . "/../app/config/defaults.php";
                    if (isset($_SESSION["user"])) {
                        ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Мои заявки
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/pages/add-ticket.php">Добавить</a></li>
                            <li><a class="dropdown-item" href="/pages/my-tickets.php">Мои заявки <span
                                            class="badge bg-secondary">4</span></a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    if ($user && (int)$user["user_group_id"] === $id["adminUser"]) {
                        ?>
                    <li class="nav-item">
                        <a href="/pages/tickets-control.php" class="nav-link">Управление заявками </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                <div class="right-side d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <?= !$user ? "Аккаунт" : $user["name"] ?>
                            </a>
                            <?php
                            if (!$user) {
                                ?>
                                <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <li><a class="dropdown-item" href="/pages/login.php">Вход</a></li>
                                    <li><a class="dropdown-item" href="/pages/register.php">Регистрация</a></li>
                                </ul>
                                <?php
                            } else {
                                ?>
                                <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                    <form action="/app/actions/user/logout.php" method="post">
                                        <button class="dropdown-item" type="submit">Выйти</button>
                                    </form>
                                </ul>
                                <?php
                            }
                            ?>

                        </li>
                    </ul>
                    <form action="/" method="get" class="d-flex">
                        <input name="q" class="form-control me-2" type="search" placeholder="Поиск заявок"
                               aria-label="Поиск заявок" value="<?= $_GET["q"] ?? "" ?>">
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>