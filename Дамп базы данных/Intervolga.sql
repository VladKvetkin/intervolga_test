-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 03 2017 г., 09:31
-- Версия сервера: 5.7.16
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Intervolga`
--
CREATE DATABASE IF NOT EXISTS `Intervolga` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Intervolga`;

-- --------------------------------------------------------

--
-- Структура таблицы `City`
--

CREATE TABLE `City` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mayor` varchar(255) NOT NULL,
  `population` int(11) NOT NULL,
  `density` float NOT NULL,
  `countryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `City`
--

INSERT INTO `City` (`id`, `name`, `mayor`, `population`, `density`, `countryId`) VALUES
(1, 'Волгоград', 'Бочаров Андрей Иванович', 1019000, 1182.44, 1),
(2, 'Москва', 'Сергей Семёнович Собянин', 11920000, 4929.18, 1),
(3, 'Нью-Йорк', 'Билл Де Блазио', 8406000, 10654, 2),
(4, 'Шанхай', 'Хань Чжэн', 24150000, 3809, 3),
(5, 'Париж', 'Анн Идальго', 2244000, 21283, 4),
(6, 'Ванкувер', 'Грегор Робертсон', 631486, 5492.6, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `Country`
--

CREATE TABLE `Country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `president` varchar(255) NOT NULL,
  `population` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `language` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Country`
--

INSERT INTO `Country` (`id`, `name`, `president`, `population`, `area`, `language`) VALUES
(1, 'Россия', 'Навальный Алексей Анатольевич', 143500000, 17100000, 'Русский'),
(2, 'США', 'Дональд Джон Трамп', 318900000, 9834000, 'Английский'),
(3, 'Китай', 'Си Цзиньпин', 1339450000, 9597000, 'Китайский'),
(4, 'Франция', 'Франсуа Олланд', 64200000, 643801, 'Французский'),
(5, 'Канада', 'Трюдо Джастин', 35160000, 9985000, 'Английский');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `City`
--
ALTER TABLE `City`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countryId` (`countryId`);

--
-- Индексы таблицы `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `City`
--
ALTER TABLE `City`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `Country`
--
ALTER TABLE `Country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `City`
--
ALTER TABLE `City`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`countryId`) REFERENCES `Country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
