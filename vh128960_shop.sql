-- phpMyAdmin SQL Dump
-- version 4.4.15.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 31 2016 г., 21:43
-- Версия сервера: 5.5.34-32.0-log
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `id1053190_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `user` text NOT NULL,
  `summ` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `adress` text NOT NULL,
  `phone` text NOT NULL,
  `ids` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`user`, `summ`, `id`, `count`, `adress`, `phone`, `ids`) VALUES
('Admin', 1500, 81, 1, 'Достоевского 103', '+7 (999) 130-02-39', '1:2,'),
('Admin', 1500, 80, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:2,'),
('Admin', 1610, 79, 3, 'sadasd', '123123123', '1:1,2:1,4:1,'),
('Admin', 750, 78, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,'),
('Admin', 750, 77, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,'),
('Admin', 750, 76, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,'),
('Admin', 750, 75, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,'),
('Admin', 750, 74, 1, 'Достоевского 103', '+7 (999) 130-02-39', '1:1,'),
('Admin', 2380, 73, 3, 'Достоевского 103', '+7 (999) 130-02-39', '1:1,4:1,34:1,'),
('Admin', 3170, 72, 3, 'rbhjhjkdskf', '+7 (123) 123-12-31', '4:1,5:1,36:25,'),
('Admin', 750, 71, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,'),
('Admin', 3080, 70, 5, 'Достоевского 103', '+7 (999) 13', '1:1,2:1,6:1,36:1,35:1,'),
('Admin', 1730, 69, 2, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,6:1,'),
('Admin', 1730, 68, 2, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,6:1,'),
('Admin', 1610, 67, 3, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,2:1,5:1,'),
('Admin', 1400, 66, 2, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,2:1,'),
('Admin', 1610, 65, 3, 'Достоевского 103', '+7 (111) 111-11-11', '1:1,2:1,4:1,'),
('Admin', 750, 64, 1, 'Достоевского 103', '+7 (999) 999-99-99', '1:1,'),
('Admin', 4430, 63, 4, 'Достоевского 103', '+7 (999) 130-02-39', '1:2,2:2,5:1,34:1,'),
('Admin', 2800, 62, 2, 'Достоевского 103', '+7 (999) 130-02-39', '1:2,2:2,'),
('Admin', 1500, 82, 1, 'Достоевского 103', '+7 (111) 111-11-11', '1:2,'),
('Admin', 5100, 83, 5, 'Достоевского 103 ', '+7 (999) 130-02-39', '4:4,1:1,51:1,39:4,53:1,'),
('Admin', 1, 84, 1, 'Кирова 47', '+7 (917) 478-45-84', '75:1,'),
('MadKort', 6480, 85, 2, 'Кирова 65', '+7 (999) 130-02-39', '51:3,5:1,'),
('Admin', 750, 86, 1, 'йцуйцу123123', '+7 (999) 999-99-99', '1:1,');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Сеты'),
(2, 'Роллы'),
(15, 'Пицца'),
(20, 'Роллы питас');

-- --------------------------------------------------------

--
-- Структура таблицы `gb`
--

CREATE TABLE IF NOT EXISTS `gb` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `msg` text
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gb`
--

INSERT INTO `gb` (`id`, `username`, `dt`, `msg`) VALUES
(34, 'Salvarus', '2016-05-29 17:04:34', 'Суши доставили вовремя и горячими. Везли всего 10 минут! Будем заказывать еще :)<br><b>Ответ администратора:</b><br>Спасибо за отзыв. Ждём вас снова! '),
(44, 'MadKort', '2016-05-30 06:07:26', 'Спасиб!<br><b>Ответ администратора:</b><br>Не за что! Ждём вас снова :)');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `msg` text,
  `title` text NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `username`, `date`, `msg`, `title`, `img`) VALUES
(43, 'Admin', '2016-05-02 13:59:32', '<b>У вас скоро День рождения? Давайте отмечать вместе!</b><br>\r\n <br>\r\nВ течение 3 дней до вашего праздника и 3 дней после него —  дарим вкусный сюрприз! <br>\r\nПри заказе от 300 рублей в подарок вы получите один из роллов: <br>\r\n- Лайк; <br>\r\n- Фьюжн; <br>\r\n- Ханами; <br>\r\n- Калифорния в кунжуте; <br>\r\n- Аяши. <br>\r\n  <br>\r\nАкция действительна для владельцев карты друга Суши Экспресс, поэтому, оформляя карту, не забудьте указать дату своего рождения! <br>', 'Подарки именинникам от Суши Экспресс Уфа', 'img/denrojdenia.jpg'),
(36, 'Admin', '2016-05-01 13:46:28', 'Мы приготовили для вас горячую весеннюю новинку - темпура меню! <br>\r\nПопробуйте роллы в поджаристой хрустящей корочке  с четырьмя любимыми вкусами!<br>\r\n- Ролл темпура с крабом<br>\r\n- Ролл темпура с лососем<br>\r\n- Ролл темпура с креветкой<br>\r\n- Ролл темпура с лососем и угрем', 'Новинка! Роллы Темпура', 'img/tempura.jpg'),
(61, 'Admin', '2016-05-30 09:06:06', 'А вы уже пробовали аппетитные роллы Питас? Экологически чистая еда быстрого приготовления стала реальностью! Питас – это вкусно, полезно, быстро и очень сытно.\r\nПопробуйте любимое блюдо с шестью новыми вкусами: с золотистой поджаренной курочкой, с легендарным итальянским сыром Пармезан, с нежными тигровыми креветками, с нежным лососем, с копчёным лососем и лососем в японском соусе терияки.\r\nРолл Питас – создан специально для активной и дружной компании. Вы можете встречаться с друзьями, обсуждать последние новости и делиться впечатлениями, не отрываясь от наивкуснейшего ролла. Его удобно брать с собой в дорогу, путешествие и на прогулку!\r\nРолл Питас уже собрал миллионы поклонников! Попробуй и ты!', ' Встречайте аппетитную новинку: Ролл Питас!', 'img/fotof392.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `intro` text CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category` int(11) NOT NULL,
  `hit` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `img`, `intro`, `price`, `category`, `hit`) VALUES
(1, 'Суперсет', 'http://ufa.farfor.ru/media/cache/85/45/8545a37738b4917e61bfd69b1d69f4ce.jpg', '<b>1290гр.</b> / 157 ккал на 100гр.', '750', 1, 0),
(2, 'Сет Ходовой', 'http://ufa.farfor.ru/media/cache/78/63/78636f4504af61062e9e58e0f29ba8cc.jpg', '<b>790гр.</b> / 156 ккал  на 100гр.', '650', 1, 1),
(4, 'Роллы Бонито', 'http://ufa.farfor.ru/media/cache/a3/78/a378b62727d41b608a157845ebbe19cf.jpg', '<b>190гр.</b> / 161 ккал на 100гр.', '210', 2, 0),
(5, 'Роллы Маме-Сяке', 'http://ufa.farfor.ru/media/cache/1b/37/1b37b6f72a7ce358e0cf3f52df2669ce.jpg', '<b>170гр.</b> / 146 ккал на 100гр.', '210', 2, 0),
(6, 'Самый лучший сет', 'http://ufa.farfor.ru/media/cache/70/80/70809df97dfbff52bc84acdc2c7440b0.jpg', '<b>1245гр.</b> / 185 ккал на 100гр.', '980', 1, 1),
(26, 'Сет гурман', 'http://ufa.farfor.ru/media/cache/6e/7c/6e7c3fdffb6776fbff25d8ebd3edbc3e.jpg', '<b>950гр.</b> / 181 ккал  на 100гр.', '820', 1, 0),
(34, 'Сет мафия', 'http://ufa.farfor.ru/media/cache/48/85/4885e37cb999f2963dfd49afdd5c3337.jpg', '<b>1740гр.</b> / 175 ккал на 100гр.', '1420', 1, 0),
(35, 'Сет мини', 'http://ufa.farfor.ru/media/cache/e5/ca/e5ca4757d39775c71c0014cfc07504a6.jpg', '<b>645гр.</b> / 116 ккал  на 100гр.', '590', 1, 0),
(36, 'Роллы с Лососем', 'http://ufa.farfor.ru/media/cache/4f/ac/4fac7068533befbc0b3105c0cc6f686f.jpg', '<b>105гр.</b> / 161 ккал на 100гр.', '110', 2, 0),
(37, 'Роллы Вендетта', 'http://ufa.farfor.ru/media/cache/fc/11/fc110ad216d9a79ee46e19310d1fd7fc.jpg', '<b>180гр.</b> / 165 ккал на 100гр.', '250', 2, 0),
(38, 'Сет Японика', 'http://ufa.farfor.ru/media/cache/c3/65/c365dcf64b0c60cad148aa82f1549826.jpg', '<b>925гр.</b> / 138 ккал на 100гр.', '750', 1, 0),
(39, 'Роллы Калифорния', 'http://ufa.farfor.ru/media/cache/6b/b9/6bb9af5ee223cf4c0e2f70e0d34c63a0.jpg', '<b>190гр.</b> / 147 ккал на 100гр.', '220', 2, 1),
(50, 'Грибоедов', 'https://pp.vk.me/c633321/v633321628/29023/jzfk3PmoPVM.jpg', '<b>980гр.</b> / 40 см.', '490', 15, 1),
(51, 'Сет большая мафия', 'http://ufa.farfor.ru/media/cache/fe/f9/fef92c385c8ef647dbea9efb7e27c0ad.png', '<b>2275гр.</b> / 171 ккал на 100 гр.', '2090', 1, 0),
(52, 'Четыре сезона', 'https://pp.vk.me/c633321/v633321628/29031/XJw1TImctWg.jpg', '<b>970 гр.</b> / 40 см.', '430', 15, 0),
(53, 'Деревенская', 'https://pp.vk.me/c633321/v633321628/2902a/C7aqZNwuDEc.jpg', '<b>1110 гр.</b> / 40 см.', '540', 1, 0),
(54, 'Чикен чиз', 'https://pp.vk.me/c633321/v633321628/29015/vXE5oj-nkPY.jpg', '<b>1010 гр.</b> / 40 см.', '490', 15, 0),
(55, 'Четыре сыра', 'https://pp.vk.me/c633321/v633321628/2901c/U-Zg9sGvBpg.jpg', '<b>630 гр.</b> / 40 см.', '430', 15, 1),
(81, 'Ролл Питас', 'img/РоллПитас.jpg', '<b>220гр. </b>', '149', 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `adm` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `adm`) VALUES
(47, 'TestReg2', 'asdasd@ad.ru', '23e893072ef8de3a4c19963975d58f59', 0),
(46, 'TestReg', '123123123', 'f5bb0c8de146c67b44babbf4e6584cc0', 0),
(30, 'Admin', 'madkort@gmail.com', '23e893072ef8de3a4c19963975d58f59', 1),
(31, 'SushiLover', 'madkort@mail.ru', '4297f44b13955235245b2497399d7a93', 0),
(45, '22', 'певуноворвл', 'b6d767d2f8ed5d21a44b0e5886680cb9', 0),
(44, '123123d', 'sdfsdf', 'efe6398127928f1b2e9ef3207fb82663', 0),
(43, 'Admin2', 'madkort2@gmail.com', '4297f44b13955235245b2497399d7a93', 0),
(42, 'MadKort', 'uriy.kort@mail.ru', '23e893072ef8de3a4c19963975d58f59', 0),
(48, 'Nastiaglubinaa_', 'nastiaglubinaa@shkola89.ru', '36965db8ec636034f71c7ddac707b26f', 0),
(49, 'TestUser', 'mail@madkor.ru', '4297f44b13955235245b2497399d7a93', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gb`
--
ALTER TABLE `gb`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `gb`
--
ALTER TABLE `gb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
