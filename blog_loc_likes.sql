-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 08 2021 г., 14:40
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog.loc_likes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anonymous_likes`
--

CREATE TABLE `anonymous_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `asdasdasd_likes`
--

CREATE TABLE `asdasdasd_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `asfasfqs_likes`
--

CREATE TABLE `asfasfqs_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `dimonchik_likes`
--

CREATE TABLE `dimonchik_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `jhon_fisherman_likes`
--

CREATE TABLE `jhon_fisherman_likes` (
  `id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `user_likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `msnewauthor_likes`
--

CREATE TABLE `msnewauthor_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `superadmin_likes`
--

CREATE TABLE `superadmin_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `superadmin_likes`
--

INSERT INTO `superadmin_likes` (`id`, `news_id`, `user_likes`) VALUES
(1, 19, 1),
(5, 18, 1),
(6, 28, 0),
(7, 20, 0),
(8, 22, 1),
(9, 24, 1),
(10, 25, 0),
(11, 30, 1),
(12, 36, 0),
(13, 49, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `testuser_likes`
--

CREATE TABLE `testuser_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vladislavrevenko_likes`
--

CREATE TABLE `vladislavrevenko_likes` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_likes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `zilian_likes`
--

CREATE TABLE `zilian_likes` (
  `id` int(11) DEFAULT NULL,
  `news_id` int(11) DEFAULT NULL,
  `user_likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anonymous_likes`
--
ALTER TABLE `anonymous_likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `asdasdasd_likes`
--
ALTER TABLE `asdasdasd_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_id` (`news_id`);

--
-- Индексы таблицы `asfasfqs_likes`
--
ALTER TABLE `asfasfqs_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_id` (`news_id`);

--
-- Индексы таблицы `dimonchik_likes`
--
ALTER TABLE `dimonchik_likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `msnewauthor_likes`
--
ALTER TABLE `msnewauthor_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_id` (`news_id`);

--
-- Индексы таблицы `superadmin_likes`
--
ALTER TABLE `superadmin_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `superadmin_likes_news_id_uindex` (`news_id`);

--
-- Индексы таблицы `testuser_likes`
--
ALTER TABLE `testuser_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_id` (`news_id`);

--
-- Индексы таблицы `vladislavrevenko_likes`
--
ALTER TABLE `vladislavrevenko_likes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `anonymous_likes`
--
ALTER TABLE `anonymous_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `asdasdasd_likes`
--
ALTER TABLE `asdasdasd_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `asfasfqs_likes`
--
ALTER TABLE `asfasfqs_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dimonchik_likes`
--
ALTER TABLE `dimonchik_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `msnewauthor_likes`
--
ALTER TABLE `msnewauthor_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `superadmin_likes`
--
ALTER TABLE `superadmin_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `testuser_likes`
--
ALTER TABLE `testuser_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `vladislavrevenko_likes`
--
ALTER TABLE `vladislavrevenko_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
