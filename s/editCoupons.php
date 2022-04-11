<?php
require("db.php");

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

if (!isset($_SESSION["user"])) {
    echo "<script>
        location.href = 'index.php';
        </script>";
};

if (!isset($_GET["id"])) {
    header('Location: index.php');
};

$id = $_GET["id"];

$coupons = $db->query("SELECT * FROM coupons WHERE id=$id")->fetchAll(2)[0];

if (!empty($_POST)) {
    $number = $_POST["number"];
    $name = $_POST["name"];
    $discount = $_POST["discount"];
    $available = $_POST["available"];


    if ($db->query("UPDATE coupons SET id='$number', name='$name', discount='$discount', available='$available' WHERE id='$id'")) {
        echo "<script>
        alert('Успешно добавлено!')
        location.href = 'index.php';
        </script>";
    } else {
        print_r($db->errorInfo());
    };
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/1.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="css/edit.css">
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
                    <form action="#" class="search df">
                        <input type="text" placeholder="Ищу...">
                        <button type="submit">Найти</button>
                    </form>
                </div>
                <?php if (isset($_SESSION["user"])) { ?>
                    <div class="menu df">
                        <?php if ($_SESSION["user"]["role"] == 1) { ?>
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
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </header>
    <main>
        <div class="main__product df">
            <div class="addP df jcc">
                <form action="#" method="POST" class="df ai">
                    <label for="number">Код</label>
                    <input type="number" name="number" id="number" placeholder="Код" value="<?= $coupons["id"] ?>">
                    <label for="name">Описание</label>
                    <input type="text" name="name" id="name" placeholder="Название" value="<?= $coupons["name"] ?>">
                    <label for="discount">Скидка</label>
                    <input type="text" name="discount" id="discount" placeholder="Скидка" value="<?= $coupons["discount"] ?>">
                    <fieldset id="available" class=".fieldset df ai jcc">
                        <legend class="df jcc">Скрыт?</legend>
                        <input type="radio" id="yes" name="available" value="yes" <?php echo ($coupons['available'] == 'yes') ?  "checked" : "";  ?>>
                        <label for="yes">Да</label>
                        <input type="radio" id="no" name="available" value="no" <?php echo ($coupons['available'] == 'no') ?  "checked" : "";  ?>>
                        <label for="no">Нет</label>
                    </fieldset>
                    <div class="btn df">
                        <a href="admin.php" class="df ai jcc">Назад</a>
                        <button class="df ai jcc">Изменить</button>
                    </div>
                </form>
            </div>
        </div>
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