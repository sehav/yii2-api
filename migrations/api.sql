-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 21 2016 г., 13:24
-- Версия сервера: 5.5.48
-- Версия PHP: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `coverUrl` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `coverUrl`) VALUES
(6, 'Гарри Поттер и философский камень2', '111'),
(7, 'Гарри Поттер и Тайная комната', '2'),
(8, 'Гарри Поттер и узник Азкабана', '3'),
(9, 'Гарри Поттер и Кубок огня', '4'),
(10, 'Гарри Поттер и Орден Феникса', '5'),
(11, 'Гарри Поттер и Принц-полукровка', '6'),
(12, 'Гарри Поттер и Дары Смерти', '7');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
