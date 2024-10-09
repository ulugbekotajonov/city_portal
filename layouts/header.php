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
                    <li class="nav-item">
                        <a href="/pages/tickets-control.php" class="nav-link">Управление заявками </a>
                    </li>
                </ul>
                <div class="right-side d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <?php
                            $query = $db->prepare("SELECT * FROM users WHERE id = :id");
                            $query->execute([":id" => $_SESSION["user"]]);
                            $user = $query->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Аккаунт
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                                <li><a class="dropdown-item" href="/pages/login.php">Вход</a></li>
                                <li><a class="dropdown-item" href="/pages/register.php">Регистрация</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Поиск заявок"
                               aria-label="Поиск заявок">
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>