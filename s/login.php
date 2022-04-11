<?php
require("db.php");

if (!empty($_POST)) {

    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = $db->query("SELECT id, name, role FROM users WHERE email='$email' and password='$password'");

        if ($query) {
            $user = $query->fetchAll(2);

            if (count($user)) {
                $_SESSION["user"] = $user[0];
                echo "<script>
                location.href = 'index.php'
                </script>";
            } else {
                echo "Неверный логин";
            }
        } else {
            print_r($db->errorInfo());
        }
    }

    if (isset($_POST["register"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($db->query("INSERT INTO users SET name='$name', email='$email', password='$password'")) {
            echo "<script>('Регистрация успешна')
            location.href = 'index.php'
            </script>";
        } else {
            print_r($db->errorInfo());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/1.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="css/login.css">
    <title>Авторизация</title>
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
            </div>
        </div>
    </header>
    <main class="df ai jcc">
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">
                    Авторизация
                </div>
                <div class="title signup">
                    Регистрация
                </div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login">Авторизация</label>
                    <label for="signup" class="slide signup">Регистрация</label>
                    <div class="slider-tab"></div>
                </div>
                <div class="form-inner">
                    <form action="#" class="login" method="POST">
                        <input type="hidden" name="login">
                        <div class="field">
                            <input type="email" name="email" placeholder="Адрес эл.почты" minlength="4" maxlength="50" required>
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Пароль" minlength="4" maxlength="50" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Войти">
                        </div>
                        <div class="signup-link">
                            Забыли пароль? <a href="">Восстановить</a>
                        </div>
                    </form>
                    <form action="#" class="signup" method="POST">
                        <input type="hidden" name="register">
                        <div class="field">
                            <input type="text" name="name" placeholder="Имя пользователя" minlength="4" maxlength="50" required>
                        </div>
                        <div class="field">
                            <input type="email" name="email" placeholder="Адрес эл.почты" minlength="4" maxlength="50" required>
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="Пароль" minlength="4" maxlength="50" required>
                        </div>
                        <!-- <div class="field">
                            <input type="password" placeholder="Подтвердите пароль" minlength="4" maxlength="50" required>
                        </div> -->
                        <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Отправить">
                        </div>
                    </form>
                </div>
            </div>
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
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>
</body>

</html>