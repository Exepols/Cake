<?php
require("db.php");

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/1.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/splide.min.css">
    <title>Mint-Cake интернет-магазин по продаже тортов. Торты по выгодным ценам</title>
</head>

<body>
    <header id="UP">
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
        <div class="list__products df ai jcc">
            <div class="container df">
                <div class="df">
                    <div class="new df">
                        <a href="#new" onclick="novelty();" class="df ai">
                            <img src="image/new.svg" alt="NEW" width="32" height="32">
                            <span class="category">Новинки</span>
                        </a>
                    </div>
                    <div class="sale df">
                        <a href="#discount" onclick="discount();" class="df ai">
                            <img src="image/sale.svg" alt="%" width="32" height="32">
                            <span class="category">Скидки</span>
                        </a>
                    </div>
                    <div class="assortment df ai">
                        <a class="category" href="#pies" onclick="categories();">Пироги</a>
                        <a class="category" href="#cakes" onclick="categories();">Торты</a>
                        <a class="category" href="#croissants" onclick="categories();">Круассаны</a>
                        <a class="category" href="#donuts" onclick="categories();">Пончики</a>
                        <a class="category" href="#pirozhki" onclick="categories();">Пирожки</a>
                        <a class="category" href="#cheesecakes" onclick="categories();">Чизкейки</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script type="module" src="js/splide.min.js">
    </script>
    <script src="js/script.js"></script>
</body>

</html>