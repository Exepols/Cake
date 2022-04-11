<?php
require("db.php");

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

if (!isset($_GET["id"])) {
    header('Location: index.php');
}

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

$id = $_GET["id"];
$product = $db->query("SELECT * FROM products WHERE id=$id")->fetchAll(2)[0];

// $data=[];
// if (isset($_GET["id"])) {
//     require("db.php");

//     $id = $_GET["id"];
//     $product = $db->query("SELECT * FROM products WHERE id=$id")->fetchAll(2)[0];

//     if(count($product) == 1) {
//         $data = $product[0];
//     } else {
//         echo "<script>
//         alert('Неверный id!');
//         window.location = 'index.php';
//         </script>";
//         exit();
//     }
// } else {
//     echo "<script>
//         alert('Вы не передали id!');
//         window.location = 'index.php';
//         </script>";
// };


$comments = [];
if (isset($_GET["id"])) {
    $comments = $db->query("SELECT * FROM reviews WHERE product_id=$id")->fetchAll(2);
    $hidden = array_filter($comments, function ($el) {
        return $el["hidden"] == "no";
    });
}

if (!empty($_POST)) {
    $uid = $_SESSION["user"]["id"];
    $name = $_SESSION["user"]["name"];
    $text = $_POST["reviews"];
    $rating = $_POST["rating"];
    $datetime = date("d-m-y H:i:s");

    if ($db->query("INSERT INTO reviews SET user_id='$uid', product_id='$id' ,name='$name', text='$text', rating='$rating' , datetime='$datetime'")) {
        echo "<script>
        alert('Отзыв добавлен!');
        location.href = 'product.php?id=$id';
      </script>";
    } else {
        print_r($db->errorInfo());
    }
}

$sth = $db->prepare("SELECT * FROM `reviews` WHERE `product_id` = $id AND `rating` > 0");
$sth->execute(array($product_id));
$data = $sth->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/1.jpg" type="image/jpg" sizes="16x16">
    <link rel="stylesheet" href="css/product.css">
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
        <div class="main__product df">
            <div class="product__breadcrumb df ai">
                <span>Главная</span>
                <hr>
                <span><?= $product["category"] ?></span>
                <hr>
                <span><?= $product["name"] ?></span>
            </div>
            <div class="product__info df">
                <div class="prd__info df">
                    <div class="info__img">
                        <img src="image/<?= $product["image"] ?>.jpg" alt="<?= $product["name"] ?>">
                    </div>
                    <div class="info__text df">
                        <span class="info__name"><?= $product["name"] ?></span>
                        
                        <?php 
                        if (!empty($data)) {
                            $rating = 0;
                            $count = count($data);
                            foreach ($data as $row) {
                                $rating += $row['rating'];
                            }
                            $rating = $rating / $count;
                            ?>
                            <div class="df rait">
                            <p>Рейтинг <?php echo round($rating, 1); ?></p>
                            <div class="rating-result">
                                <span class="<?php if (ceil($rating) >= 1) echo 'active'; ?>"></span>	
                                <span class="<?php if (ceil($rating) >= 2) echo 'active'; ?>"></span>    
                                <span class="<?php if (ceil($rating) >= 3) echo 'active'; ?>"></span>  
                                <span class="<?php if (ceil($rating) >= 4) echo 'active'; ?>"></span>    
                                <span class="<?php if (ceil($rating) >= 5) echo 'active'; ?>"></span>
                            </div>
                            <p>На основе <?php echo $count; ?> оценок</p>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="info__p-a df ai">
                            <div class="price df ai">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="new"><?= $product["price"] ?> ₽</span>
                                <?php } ?>
                            </div>
                            <?php if ($product["available"] == "yes") { ?>
                                <span>В наличии: Да</span>
                        </div>
                        <form action="#" class="product__form df">
                            <div class="cart__amount df ai">
                                <span class="minus">-</span>
                                <input type="number" min="1" value="1">
                                <span class="plus">+</span>
                            </div>
                            <button>Добавить в корзину</button>
                        </form>
                    <?php } else { ?>
                        <span style="font-size: 18px; color: gray;">Нет в наличии</span>
                    </div>
                <?php } ?>


                <div class="product__wp-d df">
                    <div class="wp df">
                        <div class="weight df">
                            <span>Вес</span>
                            <span><?= $product["weight"] ?> г.</span>
                        </div>
                        <div class="portions df">
                            <span>Порций</span>
                            <span><?= $product["portions"] ?></span>
                        </div>
                    </div>
                    <div>
                        <p><?= $product["description"] ?></p>
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                        <?php if ($_SESSION["user"]["role"] == 1) { ?>
                            <div class="edit df">
                                <a href="edit.php?id=<?= $product['id'] ?>" class="editB df ai">
                                    <img src="image/settings.svg" alt="Изменить">
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                </div>
            </div>
            <div class="product__description df">
                <div class="dsc df">
                    <p>
                        <b>Срок годности:</b> <?= $product["usb"] ?>
                    </p>
                    <p>
                        <b>Способ разморозки:</b> <?= $product["def_mtd"] ?>
                    </p>
                    <div class="ingredients">
                        <p><b>Состав: </b> <?= $product["ingredients"] ?></p>
                    </div>
                    <div class="product__calories">
                        <span>
                            Пищевая и энергетическая ценность на 100 г:
                        </span>
                        <div>
                            <span>КБЖУ</span>
                            <span><?= $product["cpfc"] ?></span>
                        </div>
                    </div>
                </div>
                <div class="reviews">
                    <span>Отзывы:</span>
                    <div class="reviews__info df">
                        <div class="fd df">
                        <?php foreach ($hidden as $comment) : ?>
                            <div class="reviews__info-c df">
                                <img src="image/1.gif" alt="Изображение профиля">
                                <div>
                                    <div class="df fdd">
                                        <span><?= $comment["name"] ?> – <?= $comment["datetime"] ?>:</span>
                                        <div class="rating-mini">
                                            <span class="<?php if ($comment['rating'] >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($comment['rating'] >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($comment['rating'] >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($comment['rating'] >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($comment['rating'] >= 5) echo 'active'; ?>"></span>
                                        </div>
                                    </div>
                                    <p class="reviews__tex"><?= $comment["text"] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <?php if (isset($_SESSION["user"])) { ?>
                            <div class="prd_comments">
                                <a onclick="addComments()" class="btn__reviews">Написать отзыв</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__similar"></div>
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
        <script src="js/script.js"></script>
</body>

</html>