<?php
require("db.php");

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

$sales = $db->query("SELECT * FROM sales WHERE hidden='no'")->fetchAll(2);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/1.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="css/sales.css">
    <title>Mint-Cake интернет-магазин по продаже тортов. Торты по выгодным ценам</title>
</head>

<body>
    <header>
        <div class="head">
            <div class="container__head df ai">
                <div class="df ai">
                    <a href="index.php">
                        <img src="image/logo.svg" alt="Логотип">
                    </a>
                    <form action="search.php" method="POST" class="df">
                        <input type="search" name="search" placeholder="Поиск" required>
                        <button type="submit">Найти</button>
                    </form>
                </div>
                <?php if (isset($_SESSION["user"])) { ?>
                    <div class="menu df">
                        <a href="about.php">
                            <img src="image/about.svg" alt="О нас" width="32" height="16">
                            <span>О нас</span>
                        </a>
                        <a href="sales.php">
                            <img src="image/sale.svg" alt="Акции" width="20" height="20">
                            <span>Акции</span>
                        </a>
                        <a href="delivery.php">
                            <img src="image/delivery.svg" alt="Доставка" width="14" height="19">
                            <span>Доставка</span>
                        </a>
                        <a href="favorites.php">
                            <img src="image/favorites.svg" alt="Избранное" width="16" height="16">
                            <span>Избранное</span>
                        </a>
                        <?php if ($_SESSION["user"]["role"] == 1) { ?>
                            <a href="admin.php">
                                <img src="image/admin.svg" alt="Меню" width="16" height="16">
                                <span>Меню</span>
                            </a>
                            <a href="profile.php">
                                <img src="image/profile.svg" alt="Меню" width="16" height="16">
                                <span>Профиль</span>
                            </a>
                            <a href="?logout=1">
                                <img src="image/login.svg" alt="Войти" width="16" height="16">
                                <span>Выйти</span>
                            </a>
                        <?php } else { ?>
                            <a href="profile.php">
                                <img src="image/profile.svg" alt="Меню" width="16" height="16">
                                <span>Профиль</span>
                            </a>
                            <a href="?logout=1">
                                <img src="image/login.svg" alt="Войти" width="16" height="16">
                                <span>Выйти</span>
                            </a>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="menu df">
                        <a href="about.php">
                            <img src="image/about.svg" alt="О нас" width="32" height="16">
                            <span>О нас</span>
                        </a>
                        <a href="sales.php">
                            <img src="image/sale.svg" alt="Акции" width="20" height="20">
                            <span>Акции</span>
                        </a>
                        <a href="delivery.php">
                            <img src="image/delivery.svg" alt="Доставка" width="14" height="19">
                            <span>Доставка</span>
                        </a>
                        <a href="favorites.php">
                            <img src="image/favorites.svg" alt="Избранное" width="16" height="16">
                            <span>Избранное</span>
                        </a>
                        <a href="login.php">
                            <img src="image/login.svg" alt="Войти" width="16" height="16">
                            <span>Войти</span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </header>
    <main>
        <h2 class="main__top__text df jcc">
            <span class="df ai">
                <img src="image/sale.svg" alt="%">
                Акции
            </span>
        </h2>
        <div class="main__sales df ai">
            <?php foreach ($sales as $sale) : ?>
                <div class="sales__info">
                    <span class="df ai">
                        <img src="image/<?= $sale["image"] ?>" alt="Изображение баннера с акцией">
                        <?= $sale["name"] ?>
                    </span>
                    <ul class="df ai">
                        <?php $sale = explode(".", $sale["text"]); ?>
                        <li><?= $sale[0] ?></li>
                        <li><?= $sale[1] ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <hr>
    <footer>
        <div class="footer__nav df jcc">
            <a href="about.php">О нас</a>
            <a href="sales.php">Акции</a>
            <a href="delivery.php">Доставка</a>
        </div>
        <div class="footer__media df jcc">
            <a href="https://youtube.com">
                <img src="image/youtube.svg" alt="Youtube" width="56" height="56">
            </a>
            <a href="https://vk.com">
                <img src="image/vk.svg" alt="Vkontakte" width="56" height="56">
            </a>
            <a href="https://facebook.com">
                <img src="image/facebook.svg" alt="Facebook" width="56" height="56">
            </a>
            <a href="https://twitter.com">
                <img src="image/twitter.svg" alt="Twitter" width="56" height="56">
            </a>
            <a href="https://web.telegram.org">
                <img src="image/telegram.svg" alt="Telegram" width="56" height="56">
            </a>
            <a href="https://instagram.com">
                <img src="image/instagram.svg" alt="Instagram" width="56" height="56">
            </a>
            <a href="https://discord.com">
                <img src="image/discord.svg" alt="Discord" width="56" height="56">
            </a>
            <a href="https://livejournal.com">
                <img src="image/livejournal.svg" alt="Livejournal" width="56" height="56">
            </a>
        </div>
        <div class="footer__contact df jcc">
            <span class="fc__number">+7 (999) 777-77-77</span>
            <span class="fc__mail">Mint-Cakes@gmail.com</span>
        </div>
    </footer>
</body>

</html>