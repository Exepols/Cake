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

$sales = $db->query("SELECT * FROM sales")->fetchAll(2);
$coupons = $db->query("SELECT * FROM coupons")->fetchAll(2);
$products = $db->query("SELECT * FROM products")->fetchAll(2);

if (!empty($_POST)) {

    if (isset($_POST["create_product"])) {
        $name = $_POST["name"];
        $image = $_POST["image"];
        $price = $_POST["price"];
        $portions = $_POST["portions"];
        $weight = $_POST["weight"];
        $category = $_POST["select"];
        $desc = $_POST["desc"];
        $usb = $_POST["usb"];
        $def_mtd = $_POST["def_mtd"];
        $ingredients = $_POST["ingredients"];
        $cpfc = $_POST["cpfc"];


        if ($db->query("INSERT INTO products (name, image, price, portions, weight, category, description, usb, def_mtd, ingredients, cpfc) VALUES
        ('$name', '$image', '$price', '$portions', '$weight', '$category', '$desc', '$usb', '$def_mtd', '$ingredients', '$cpfc')")) {
            echo "<script>
            alert('Успешно добавлено!')
            location.href = 'index.php';
            </script>";
        } else {
            print_r($db->errorInfo());
        };
    }

    if (isset($_POST["create_sale"])) {
        $name = $_POST["name"];
        $image = $_POST["image"];
        $text = $_POST["text"];


        if ($db->query("INSERT INTO sales SET name='$name', image='$image', text='$text'")) {
            echo "<script>
            alert('Успешно добавлено!')
            location.href = 'index.php';
            </script>";
        } else {
            print_r($db->errorInfo());
        };
    }

    if (isset($_POST["create_coupon"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $discount = $_POST["discount"];


        if ($db->query("INSERT INTO coupons SET id='$id', name='$name', discount='$discount'")) {
            echo "<script>
            alert('Успешно добавлено!')
            location.href = 'index.php';
            </script>";
        } else {
            print_r($db->errorInfo());
        };
    }

    if (isset($_POST["history"])) {
        echo "тут регистрация :)";
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
    <link rel="stylesheet" href="css/admin.css">
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
                    <form action="search.php" method="POST" class="df search">
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
                <img src="image/admin.svg" alt="Меню администратора">
                Меню администратора
            </span>
        </h2>
        <div class="main__menu df">
            <div class="main__menu__categories ctg df jcc">
                <span onclick="add()">
                    <img src="image/add.svg" alt="+">
                    Добавление</span>
                <span onclick="edit()">
                    <img src="image/settings.svg" alt="Изменение">
                    Изменение
                </span>
                <span onclick="aHistory()">
                    <img src="image/history.svg" alt="История">
                    Заказы
                </span>
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
    <script src="js/script.js"></script>
    <script type="text/javascript">
        function updateSelect() {
				let select = document.getElementById('selectProduct');
				let option = select.options[select.selectedIndex];

				document.getElementById('editHref').href = "edit.php?id=" + option.value;
			};

        function editProduct() {
            let code = `
    <div class="editP df jcc">
        <form action="#" method="POST" class="df">
            <p class="df ai">Выберите продукт
            <select name="select" id="selectProduct" onchange="updateSelect()" required>
            <option value="" selected="selected">Выберите продукт</option>
            <?php foreach ($products as $product) : ?>
                <option value="<?= $product["id"] ?>"><?= $product["name"] ?>. <?= $product["price"] ?> ₽.</option>
                <?php endforeach; ?> 
            </select></p>
            <a id="editHref" href="edit.php?id=" class="df jcc">Редактировать</a>
        </form>
    </div>
    `;
            if ($('.editS')) {
                $('.editS').remove();
                $('.edit').insertAdjacentHTML('beforeend', code);
            } else if ($('.editC')) {
                $('.editC').remove();
                $('.edit').insertAdjacentHTML('beforeend', code);
            } else if ($('.editP')) {
                $('.editP').remove();
            } else {
                $('.edit').insertAdjacentHTML('beforeend', code);
            };
        };

        function editSale() {
            let code = `
        <div class="editS df ai">
            <?php
            foreach ($sales as $sale) : ?>
                    <div class="sales__info">
                        <span class="df ai">
                            <img class="sales__img" src="image/<?= $sale["image"] ?>" alt="Изображение баннера с акцией">
                        </span>
                        <div class="edit df jcc">
                        <a href="editSales.php?id=<?= $sale["id"] ?>" class="editB df ai">
                            <img src="image/settings.svg" alt="Изменить">
                        </a>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
        `;
            if ($('.editP')) {
                $('.editP').remove();
                $('.edit').insertAdjacentHTML('beforeend', code);
            } else if ($('.editC')) {
                $('.editC').remove();
                $('.edit').insertAdjacentHTML('beforeend', code);
            } else if ($('.editS')) {
                $('.editS').remove();
            } else {
                $('.edit').insertAdjacentHTML('beforeend', code);
            };
        };

        function editCoupon() {
            let code = `
        <div class="editC df jcc ai">
            <?php foreach ($coupons as $coupon) : ?>
                <div class="coupons df ai jcc">
                    <div class="coupons__info df">
                        <span><?= $coupon["name"] ?></span>
                        <span>Скрыто: 
                        <?php if ($coupon["available"] == "yes") { ?>
                            <span>да</span>
                        <?php } else { ?>
                            <span>нет</span>
                        <?php } ?>
                        </span>
                    </div>
                    <div class="edit">
                        <a href="editCoupons.php?id=<?= $coupon["id"] ?>" class="editB df ai">
                            <img src="image/settings.svg" alt="Изменить">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        `;
            if ($('.editP')) {
                $('.editP').remove();
                $('.edit').insertAdjacentHTML('beforeend', code);
            } else if ($('.editS')) {
                $('.editS').remove();
                $('.edit').insertAdjacentHTML('beforeend', code);
            } else if ($('.editC')) {
                $('.editC').remove();
            } else {
                $('.edit').insertAdjacentHTML('beforeend', code);
            };
        };

        function aHistory() {
            let code = `
        <div class="profile__history df jcc">
            <div class="profile__container df jcc">
                <div class="container__history__products df">
                    <span class="profile__history__top__info">Заказ №1 26.12.2021 17:52</span>
                    <div class="profile__history__products__info df">
                        <div class="product__info df">
                            <img src="image/1.jpg" alt="Изображение">
                            <div class="history__info df">
                                <span class="history__name">Чизкейк “Шоколадный”</span>
                                <span class="history__amount">Количество: 1х</span>
                                <span class="history__price">1270 ₽</span>
                            </div>
                        </div>
                        <div class="product__info df">
                            <img src="image/1.jpg" alt="Изображение">
                            <div class="history__info df">
                                <span class="history__name">Чизкейк “Шоколадный”</span>
                                <span class="history__amount">Количество: 1х</span>
                                <span class="history__price">1270 ₽</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container__history__products df">
                    <span class="profile__history__top__info">Заказ №1 26.12.2021 17:52</span>
                    <div class="profile__history__products__info df">
                        <div class="product__info df">
                            <img src="image/1.jpg" alt="Изображение">
                            <div class="history__info df">
                                <span class="history__name">Чизкейк “Шоколадный”</span>
                                <span class="history__amount">Количество: 1х</span>
                                <span class="history__price">1270 ₽</span>
                            </div>
                        </div>
                        <div class="product__info df">
                            <img src="image/1.jpg" alt="Изображение">
                            <div class="history__info df">
                                <span class="history__name">Чизкейк “Шоколадный”</span>
                                <span class="history__amount">Количество: 1х</span>
                                <span class="history__price">1270 ₽</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container__history__products df">
                    <span class="profile__history__top__info">Заказ №1 26.12.2021 17:52</span>
                    <div class="profile__history__products__info df">
                        <div class="product__info df">
                            <img src="image/1.jpg" alt="Изображение">
                            <div class="history__info df">
                                <span class="history__name">Чизкейк “Шоколадный”</span>
                                <span class="history__amount">Количество: 1х</span>
                                <span class="history__price">1270 ₽</span>
                            </div>
                        </div>
                        <div class="product__info df">
                            <img src="image/1.jpg" alt="Изображение">
                            <div class="history__info df">
                                <span class="history__name">Чизкейк “Шоколадный”</span>
                                <span class="history__amount">Количество: 1х</span>
                                <span class="history__price">1270 ₽</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        `;
            if ($('.add')) {
                $('.add').remove()
                $('.ctg').insertAdjacentHTML('afterend', code);
            } else if ($('.edit')) {
                $('.edit').remove()
                $('.ctg').insertAdjacentHTML('afterend', code);
            } else if ($('.profile__history')) {
                $('.profile__history').remove()
            } else {
                $('.ctg').insertAdjacentHTML('afterend', code);
            }
        };
    </script>
</body>

</html>