<?php
require("db.php");

$products = $db->query("SELECT * FROM products WHERE hidden='no' LIMIT 8")->fetchAll(2);

if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
};

$newProducts = array_filter($products, function ($el) {
    return $el["new"] == "yes";
});

$withDiscount = array_filter($products, function ($el) {
    return $el["discount"] != "0";
});

$sales = $db->query("SELECT * FROM sales WHERE hidden='no'")->fetchAll(2);

$prd = $db->query("SELECT * FROM products WHERE hidden='no'")->fetchAll(2);

$newProducts1 = array_filter($prd, function ($el) {
    return $el["new"] == "yes";
});

$withDiscount1 = array_filter($prd, function ($el) {
    return $el["discount"] != "0";
});

$pies = array_filter($prd, function ($el) {
    return $el["category"] == "Пироги";
});

$cakes = array_filter($prd, function ($el) {
    return $el["category"] == "Торты";
});

$croissants = array_filter($prd, function ($el) {
    return $el["category"] == "Круассаны";
});

$donuts = array_filter($prd, function ($el) {
    return $el["category"] == "Пончики";
});

$pirozhki = array_filter($prd, function ($el) {
    return $el["category"] == "Пирожки";
});

$cheesecakes = array_filter($prd, function ($el) {
    return $el["category"] == "Чизкейки";
});

if(count($_POST)>0) {
$search = $_POST['search'];
$result = $db->query("SELECT * FROM products WHERE hidden='no' AND name like '%$search%'");
}

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
    <?php require("header.php") ?>
    <main>
        <h2 class="df ai jcc" style="padding-top: 20px">По запросу <?= $search ?> найдены товары: </h2>
        <div class="products container1">
        <?php foreach ($result as $product) : ?>
            <div class="card" style="margin-top: 20px;">
                            <div class="card__add df ai jcc">
                                <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                            </div>
                            <div class="card__img">
                                <a href="product.php?id=<?= $product["id"] ?>">
                                    <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                                </a>
                                <div class="card__new"></div>
                            </div>
                            <div class="card__text">
                                <a href="product.php?id=<?= $product["id"] ?>"><div class="card__text__name"><?= $product["name"] ?></div></a>
                                <div class="card__text__all df ai">
                                    <div class="card__price df">
                                        <?php if ($product["discount"] != 0) { ?>
                                            <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                            <del class="price"><?= $product["price"] ?>₽</del>
                                        <?php } else { ?>
                                            <span class="price"><?= $product["price"] ?>₽</span>
                                        <?php } ?>
                                    </div>
                                    <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                                </div>
                            </div>
                        </div>                  
        <?php endforeach; ?>
        </div>
    </main>
    <hr>
    <footer>
        <div class="footer_nav df jcc">
            <a href="about.php">О нас</a>
            <a href="sales.php">Акции</a>
            <a href="delivery.php">Доставка</a>
        </div>
        <div class="footer_media df jcc">
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
        <div class="footer_contact df jcc">
            <span class="fc_number">+7 (999) 777-77-77</span>
            <span class="fc_mail">Mint-Cakes@gmail.com</span>
        </div>
    </footer>
    <a class="topSite" href="#UP">
        <img src="image/arrowUp.svg" alt="Up">
    </a>
    <script type="module" src="js/splide.min.js">
    </script>
    <script src="js/script.js"></script>
    <script type="text/javascript">
        function categories() {
            let code = `
            <div class="delete">
            <h2 class="df ai jcc title" id="pies">Пироги</h2>
            <div class="products container1">
            <?php foreach ($pies as $product) : ?>
                <div class="card">
                    <?php if ($product["discount"] != 0) { ?>
                        <div class="badge_sale df ai">
                            <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                            <span><?= $product["discount"] ?>%</span>
                        </div>
                    <?php } ?>
                    <?php if ($product["new"] == "yes") { ?>
                        <div class="badge df ai">
                            <img src="image/new.svg" alt="NEW" width="26" height="26">
                            <span>Новинка</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                                <form method="POST" action="#" class="card__fav df ai jcc">
                                <?php if (($favourites["user_id"] == $suid) && ($product["id"] == $favourites["product_id"]) 
                                        && ($favourites["del"] == "yes")) { ?>
                                        <input type="hidden" name="del_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/full_heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } else { ?>
                                        <input type="hidden" name="add_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } ?>
                                </form>
                            <?php } ?>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <h2 class="df ai jcc title" id="cakes">Торты</h2>
            <div class="products container1">
            <?php foreach ($cakes as $product) : ?>
                <div class="card">
                    <?php if ($product["discount"] != 0) { ?>
                        <div class="badge_sale df ai">
                            <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                            <span><?= $product["discount"] ?>%</span>
                        </div>
                    <?php } ?>
                    <?php if ($product["new"] == "yes") { ?>
                        <div class="badge df ai">
                            <img src="image/new.svg" alt="NEW" width="26" height="26">
                            <span>Новинка</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                                <form method="POST" action="#" class="card__fav df ai jcc">
                                <?php if (($favourites["user_id"] == $suid) && ($product["id"] == $favourites["product_id"]) 
                                        && ($favourites["del"] == "yes")) { ?>
                                        <input type="hidden" name="del_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/full_heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } else { ?>
                                        <input type="hidden" name="add_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } ?>
                                </form>
                            <?php } ?>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <h2 class="df ai jcc title" id="croissants">Круассаны</h2>
            <div class="products container1">
            <?php foreach ($croissants as $product) : ?>
                <div class="card">
                    <?php if ($product["discount"] != 0) { ?>
                        <div class="badge_sale df ai">
                            <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                            <span><?= $product["discount"] ?>%</span>
                        </div>
                    <?php } ?>
                    <?php if ($product["new"] == "yes") { ?>
                        <div class="badge df ai">
                            <img src="image/new.svg" alt="NEW" width="26" height="26">
                            <span>Новинка</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                                <form method="POST" action="#" class="card__fav df ai jcc">
                                <?php if (($favourites["user_id"] == $suid) && ($product["id"] == $favourites["product_id"]) 
                                        && ($favourites["del"] == "yes")) { ?>
                                        <input type="hidden" name="del_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/full_heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } else { ?>
                                        <input type="hidden" name="add_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } ?>
                                </form>
                            <?php } ?>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <h2 class="df ai jcc title" id="donuts">Пончики</h2>
            <div class="products container1">
            <?php foreach ($donuts as $product) : ?>
                <div class="card">
                    <?php if ($product["discount"] != 0) { ?>
                        <div class="badge_sale df ai">
                            <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                            <span><?= $product["discount"] ?>%</span>
                        </div>
                    <?php } ?>
                    <?php if ($product["new"] == "yes") { ?>
                        <div class="badge df ai">
                            <img src="image/new.svg" alt="NEW" width="26" height="26">
                            <span>Новинка</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                                <form method="POST" action="#" class="card__fav df ai jcc">
                                <?php if (($favourites["user_id"] == $suid) && ($product["id"] == $favourites["product_id"]) 
                                        && ($favourites["del"] == "yes")) { ?>
                                        <input type="hidden" name="del_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/full_heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } else { ?>
                                        <input type="hidden" name="add_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } ?>
                                </form>
                            <?php } ?>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <h2 class="df ai jcc title" id="pirozhki">Пирожки</h2>
            <div class="products container1">
            <?php foreach ($pirozhki as $product) : ?>
                <div class="card">
                <?php if ($product["discount"] != 0) { ?>
                    <div class="badge_sale df ai">
                        <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                        <span><?= $product["discount"] ?>%</span>
                    </div>
                <?php } ?>
                <?php if ($product["new"] == "yes") { ?>
                    <div class="badge df ai">
                        <img src="image/new.svg" alt="NEW" width="26" height="26">
                        <span>Новинка</span>
                    </div>
                <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                                <form method="POST" action="#" class="card__fav df ai jcc">
                                <?php if (($favourites["user_id"] == $suid) && ($product["id"] == $favourites["product_id"]) 
                                        && ($favourites["del"] == "yes")) { ?>
                                        <input type="hidden" name="del_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/full_heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } else { ?>
                                        <input type="hidden" name="add_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } ?>
                                </form>
                            <?php } ?>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <h2 class="df ai jcc title" id="cheesecakes">Чизкейки</h2>
            <div class="products container1">
            <?php foreach ($cheesecakes as $product) : ?>
                <div class="card">
                    <?php if ($product["discount"] != 0) { ?>
                        <div class="badge_sale df ai">
                            <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                            <span><?= $product["discount"] ?>%</span>
                        </div>
                    <?php } ?>
                    <?php if ($product["new"] == "yes") { ?>
                        <div class="badge df ai">
                            <img src="image/new.svg" alt="NEW" width="26" height="26">
                            <span>Новинка</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <?php if (isset($_SESSION["user"])) { ?>
                                <form method="POST" action="#" class="card__fav df ai jcc">
                                <?php if (($favourites["user_id"] == $suid) && ($product["id"] == $favourites["product_id"]) 
                                        && ($favourites["del"] == "yes")) { ?>
                                        <input type="hidden" name="del_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/full_heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } else { ?>
                                        <input type="hidden" name="add_favourites">
                                        <input type="hidden" name="pid" value="<?= $product["id"] ?>">
                                        <button type="submit"><img src="image/heart.svg" alt="Избранное" width="24" height="24"></button>
                                <?php } ?>
                                </form>
                            <?php } ?>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
            `;


            if ($('.dl')) {
                $('.dl').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.delete')) {
                $('.delete').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.new_c')) {
                $('.new_c').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.dsc_c')) {
                $('.dsc_c').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else {
                $('main').insertAdjacentHTML('afterbegin', code);
            };
        };

        function novelty() {
            let code = `
            <div class="new_c">
            <h2 class="df ai jcc new1"><img src="image/new.svg" alt="NEW" height="48" width="48">Новинки</h2>
            <div class="products container1">
            <?php foreach ($newProducts1 as $product) : ?>
                <div class="card">
                    <?php if ($product["new"] == "yes") { ?>
                        <div class="badge df ai">
                            <img src="image/new.svg" alt="NEW" width="26" height="26">
                            <span>Новинка</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>"><div class="card__text__name"><?= $product["name"] ?></div></a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
            `;


            if ($('.dl')) {
                $('.dl').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.delete')) {
                $('.delete').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.new_c')) {
                $('.new_c').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.dsc_c')) {
                $('.dsc_c').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else {
                $('main').insertAdjacentHTML('afterbegin', code);
            };
        };

        function discount() {
            let code = `
            <div class="dsc_c">
            <h2 class="df ai jcc discount">
                <img src="image/sale.svg" alt="%" height="48" width="48">
                Скидки
            </h2>
            <div class="products container1">
            <?php foreach ($withDiscount1 as $product) : ?>
                <div class="card">
                    <?php if ($product["discount"] != 0) { ?>
                        <div class="badge_sale df ai">
                            <img src="image/badge_sale.svg" alt="%" width="26" height="26">
                            <span><?= $product["discount"] ?>%</span>
                        </div>
                    <?php } ?>
                    <div class="card__add df ai jcc">
                        <img src="image/basket_p.svg" alt="Корзина" width="24" height="24">
                    </div>
                    <div class="card__img">
                        <a href="product.php?id=<?= $product["id"] ?>">
                            <img src="image/<?= $product["image"] ?>.jpg" alt="Фотография шоколадного чизкейка">
                        </a>
                        <div class="card__new"></div>
                    </div>
                    <div class="card__text">
                        <a href="product.php?id=<?= $product["id"] ?>">
                        <div class="card__text__name"><?= $product["name"] ?></div>
                        <?php
                                        $sth = $db->prepare("
                                            SELECT 
                                                SUM(`rating`) AS `total`, 
                                                COUNT(`product_id`) AS `count` 
                                            FROM 
                                                `reviews` 
                                            WHERE 
                                                `product_id` = ?;
                                                AND `rating` > 0
                                        ");
                                    
                                        $sth->execute(array($product['id']));
                                        $data = $sth->fetch(PDO::FETCH_ASSOC);
                                        $rating = ceil($data['total'] / $data['count']);
                                        ?>

                                        <div class="rating-mini">
                                            <span class="<?php if ($rating >= 1) echo 'active'; ?>"></span>	
                                            <span class="<?php if ($rating >= 2) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 3) echo 'active'; ?>"></span>  
                                            <span class="<?php if ($rating >= 4) echo 'active'; ?>"></span>    
                                            <span class="<?php if ($rating >= 5) echo 'active'; ?>"></span>
                                        </div>
                                        <span>(<?php echo $data['count'];?>)</span>
                        </a>
                        <div class="card__text__all df ai">
                            <div class="card__price df">
                                <?php if ($product["discount"] != 0) { ?>
                                    <span class="price"><?= $product["price"] - ($product["price"] * ($product["discount"] / 100)) ?>₽</span>
                                    <del class="price"><?= $product["price"] ?>₽</del>
                                <?php } else { ?>
                                    <span class="price"><?= $product["price"] ?>₽</span>
                                <?php } ?>
                            </div>
                            <span class="weight"><?= $product["portions"] ?> порций, <?= $product["weight"] ?> г.</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
            `;

            if ($('.dl')) {
                $('.dl').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.delete')) {
                $('.delete').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.new_c')) {
                $('.new_c').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else if ($('.dsc_c')) {
                $('.dsc_c').remove();
                $('main').insertAdjacentHTML('afterbegin', code);
            } else {
                $('main').insertAdjacentHTML('afterbegin', code);
            };
        }

    </script>
</body>

</html>