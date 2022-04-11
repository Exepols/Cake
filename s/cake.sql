-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 07 2022 г., 23:25
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cake`
--

-- --------------------------------------------------------

--
-- Структура таблицы `coupons`
--

CREATE TABLE `coupons` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `discount` int NOT NULL,
  `available` varchar(10) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `discount`, `available`) VALUES
(101, 'Скидка на 25%', 25, 'yes'),
(102, 'Скидка на 21%', 21, 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `favourites`
--

CREATE TABLE `favourites` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `ordering`
--

CREATE TABLE `ordering` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` int NOT NULL,
  `price` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `delivered` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `rating` int NOT NULL DEFAULT '0',
  `price` int NOT NULL,
  `portions` int NOT NULL,
  `weight` int NOT NULL,
  `new` varchar(10) NOT NULL DEFAULT 'yes',
  `discount` int NOT NULL DEFAULT '0',
  `available` varchar(10) NOT NULL DEFAULT 'yes',
  `hidden` varchar(10) NOT NULL DEFAULT 'no',
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `usb` varchar(255) NOT NULL,
  `def_mtd` varchar(255) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `cpfc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `rating`, `price`, `portions`, `weight`, `new`, `discount`, `available`, `hidden`, `category`, `description`, `usb`, `def_mtd`, `ingredients`, `cpfc`) VALUES
(1, 'Чизкейк “Шоколадный”', '1', 0, 1500, 16, 2100, 'yes', 0, 'no', 'no', 'Пироги', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(2, 'Чизкейк “Шоколадный”', '1', 0, 1000, 12, 1500, 'no', 50, 'yes', 'no', 'Круассаны', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(3, 'Чизкейк “Шоколадный”', '1', 0, 1500, 1, 2100, 'yes', 0, 'yes', 'no', 'Пончики', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(4, 'Чизкейк “Шоколадный”', '1', 0, 1000, 2, 1500, 'yes', 0, 'yes', 'no', 'Чизкейки', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(5, 'Чизкейк “Шоколадный”', '1', 0, 1500, 3, 2100, 'no', 54, 'yes', 'no', 'Пироги', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(6, 'Чизкейк “Шоколадный”', '1', 0, 1000, 4, 1500, 'yes', 0, 'yes', 'no', 'Пироги', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(7, 'Чизкейк “Шоколадный”', '1', 0, 1500, 5, 2100, 'no', 22, 'yes', 'no', 'Пирожки', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(8, 'Чизкейк “Шоколадный”', '1', 0, 1000, 6, 1500, 'no', 23, 'yes', 'no', 'Пироги', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.'),
(9, 'Чизкейк “Шоколадный”', '1', 0, 12, 12, 12, 'yes', 12, 'yes', 'no', 'Торты', 'Нежный чизкейк с шоколадом', 'в морозилке 6 месяцев, после разморозки 4 дня', '1 час при комнатной температуре', 'вода; мука; шоколад; сыр \"Маскарпоне\"', '320; 24,1; 23,1; 4,1.');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(55) NOT NULL,
  `text` varchar(120) NOT NULL,
  `rating` int NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL,
  `hidden` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `name`, `text`, `rating`, `datetime`, `hidden`) VALUES
(1, 3, 1, 'admin', 'вкусно и шоколадно, очень сытно, за 1 присест больше 1 куска не осилить.', 0, '2022-02-03 22:34:51', 'no'),
(2, 3, 1, 'admin', 'Хотя нет, очень приторный вкус', 0, '2022-02-04 01:44:51', 'no'),
(3, 3, 3, 'Кузя Хлебов', 'Вкусно и аппетитно, наелся до отвала.', 0, '2022-02-01 12:59:51', 'no'),
(4, 3, 2, 'user', 'Поел и выплюнул, отвратительно', 0, '2022-01-31 10:10:51', 'no'),
(5, 1, 1, 'admin', 'Вкусно поел', 0, '2004-02-22 21:53:03', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `text` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hidden` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `sales`
--

INSERT INTO `sales` (`id`, `name`, `image`, `text`, `hidden`) VALUES
(1, 'Скидка 20%', 'sale_1.png', 'При заказе от 4999 рублей (Не включает стоимость курьера). Будет представлена скидка в 20%.', 'no'),
(2, '1', 'sale_2.png', '1', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `telephone` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `street` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'profile_img.jpg',
  `role` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `telephone`, `email`, `password`, `street`, `image`, `role`) VALUES
(1, 'admin', '', 'admin@mail.ru', 'admin', '', '1.gif', 1),
(2, 'user', '', 'user@mail.ru', 'user', '', 'profile_img.jpg', 0),
(3, 'Кузя Хлебов', '', 'dddd@mail.ru', 'dddd', '', 'profile_img.jpg', 0),
(4, 'ssss', '', 'ssss@mail.ru', 'ssss', '', 'profile_img.jpg', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_login` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ordering`
--
ALTER TABLE `ordering`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
