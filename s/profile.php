<?php
require("db.php");

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

if (!isset($_SESSION["user"])) {
    echo "<script>
        location.href = 'index.php';
        </script>";
}

$id = $_SESSION["user"]["id"];
$user = $db->query("SELECT * FROM users WHERE id=$id")->fetchAll(2)[0];


if (!empty($_POST)) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $oldP = $_POST["oldP"];
    $newP = $_POST["newP"];
    $newP_confirm = $_POST["newP_confirm"];

    $psw = $db->query("SELECT * FROM users WHERE id=$id")->fetchAll(2)[0];

    if (($psw == $oldP) & ($newP == $newP_confirm)) {
        if ($db->query("UPDATE users (name, telephone, email, password, street) VALUES
        ('$name', '$telephone', '$email', '$newP_confirm', '$street') WHERE id=$id")) {
            echo "<script>
            alert('Успешно добавлено!')
            location.href = 'index.php';
            </script>";
        } else {
            print_r($db->errorInfo());
        };
    } else {
        echo "<script>
        alert('Старый или новый пароль не совпадает')
        </script>";
    }
};

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/1.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="css/profile.css">
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
        <h2 class="profile__top__text df ai jcc">
            <span class="df">
                <svg width="32" height="32" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 0.00100708C3.58218 0.00100708 0 3.58249 0 8.00066C0 12.4188 3.58183 16.0003 8 16.0003C12.4185 16.0003 16 12.4188 16 8.00066C16 3.58249 12.4185 0.00100708 8 0.00100708ZM8 2.393C9.46183 2.393 10.6464 3.57792 10.6464 5.03905C10.6464 6.50052 9.46183 7.6851 8 7.6851C6.53887 7.6851 5.3543 6.50052 5.3543 5.03905C5.3543 3.57792 6.53887 2.393 8 2.393ZM7.99824 13.9088C6.54028 13.9088 5.20495 13.3778 4.175 12.4989C3.9241 12.2849 3.77932 11.9711 3.77932 11.6419C3.77932 10.16 4.97865 8.97404 6.46086 8.97404H9.53984C11.0224 8.97404 12.2172 10.16 12.2172 11.6419C12.2172 11.9715 12.0731 12.2846 11.8218 12.4986C10.7922 13.3778 9.45656 13.9088 7.99824 13.9088Z" fill="black" />
                </svg>
            </span>
            Профиль
        </h2>

        <div class="profile df">
            <div class="profile__img-text">
                <span class="df">
                    <img src="image/<?= $user["image"] ?>" alt="Изображение профиля">
                    <?= $user["name"] ?>
                </span>
            </div>
            <div class="profile__info df">
                <div class="profile__inner__info df">
                    <span onclick="info();">Личная информация</span>
                    <span onclick="history();">История заказов</span>
                </div>
                <div class="profile__all df dl">
                    <form action="#" class="profile__form df">
                        <label for="telephone"> Номер телефона:
                            <input type="telephone" id="telephone" value="<?= $user["telephone"] ?>" readonly>
                        </label>
                        <label for="email"> Эл. почта:
                            <input type="email" id="email" value="<?= $user["email"] ?>" readonly>
                        </label>
                        <label for="password"> Пароль:
                            <input type="password" id="password" value="<?= $user["password"] ?>" readonly>
                        </label>
                        <label for="address"> Адрес:
                            <input type="text" id="address" value="<?= $user["street"] ?>" readonly>
                        </label>
                    </form>
                    <div class="edit">
                        <span onclick="editProfile()" class="editB df ai">
                            <img src="image/settings.svg" alt="Изменить">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div>

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
    <script src="js/script.js"></script>
    <script type="text/javascript">
        function info() {

            let code = `
        <div class="profile__all df dl">
            <form action="#" class="profile__form df">
                <label for="telephone"> Номер телефона:
                    <input type="telephone" id="telephone" value="<?= $user["telephone"] ?>" readonly>
                </label>
                <label for="email"> Эл. почта:
                    <input type="email" id="email" value="<?= $user["email"] ?>" readonly>
                </label>
                <label for="password"> Пароль:
                    <input type="password" id="password" value="<?= $user["password"] ?>" readonly>
                </label>
                <label for="address"> Адрес:
                    <input type="text" id="address" value="<?= $user["street"] ?>" readonly>
                </label>
            </form>
            <div class="edit">
                <span onclick="editProfile()" class="df ai">
                    <img src="image/settings.svg" alt="Изменение">
                </span>
            </div>
        </div>
        `;

            $('.dl').remove();
            $('.profile__inner__info').insertAdjacentHTML('afterend', code);
        }

        function editProfile() {
            $('.dl').remove();
            $('.profile__inner__info').insertAdjacentHTML('afterend', `
        <div class="profile__all df dl">
                        <form action="#" class="profile__form df">
                            <label for="name"> Имя:
                                <input type="text" name="name" id="name" value="<?= $user["name"] ?>">
                            </label>
                            <label for="telephone"> Номер телефона:
                                <input type="telephone" name="telephone" id="telephone" value="<?= $user["telephone"] ?>">
                            </label>
                            <label for="email"> Эл. почта:
                                <input type="email" name="email" id="email" value="<?= $user["email"] ?>">
                            </label>
                            <label for="password"> Старый пароль:
                                <input type="password" name="oldP" id="password">
                            </label>
                            <label for="password"> Новый пароль:
                                <input type="password" name="newP" id="password">
                            </label>
                            <label for="password"> Подтвердите новый пароль:
                                <input type="password" name="newP_confirm" id="password">
                            </label>
                            <label for="address"> Адрес:
                                <input type="text" name="street" id="address" value="<?= $user["street"] ?>">
                            </label>
                            <button>Изменить</button
                        </form>
                        <div class="edit">
                            <span onclick="info()" class="editB df ai">
                                <img src="image/cancel.svg" alt="Отмена">
                            </span>
                        </div>
                    </div>
        `);
        };
    </script>
</body>

</html>