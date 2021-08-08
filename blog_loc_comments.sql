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
-- База данных: `blog.loc_comments`
--

-- --------------------------------------------------------

--
-- Структура таблицы `18_comments`
--

CREATE TABLE `18_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `18_comments`
--

INSERT INTO `18_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'SuperAdmin', 'first comment', '2021-04-04 04:47:43', 1),
(2, 'Jhon_Fisherman', 'second comment', '2021-04-04 04:48:51', 1),
(3, 'SuperAdmin', 'hello', '2021-04-08 10:31:21', 1),
(7, 'SuperAdmin', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec venenatis sapien in vehicula placerat. Quisque tincidunt ut arcu in congue. Pellentesque a egestas eros. Se\r\nd tempor mauris mauris, eget volutpat dolor vestibulum vitae. Pellentesque interdum sollicitudin magna, a tristique neque tempus et. Mauris blandit leo justo, eget luctus\r\ntortor accumsan sed. Vestibulum fringilla sem quis pulvinar faucibus. Nunc consequat dolor sit amet dolor eleifend cursus. Donec dictum leo vel ultrices aliquet. Nunc co\r\nngue turpis tellus, vel finibus elit eleifend ut. ', '2021-07-11 01:15:58', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `19_comments`
--

CREATE TABLE `19_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `19_comments`
--

INSERT INTO `19_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'SuperAdmin', 'test', '2021-04-08 10:33:38', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `20_comments`
--

CREATE TABLE `20_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `20_comments`
--

INSERT INTO `20_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'SuperAdmin', 'first comment\r\n', '2021-04-04 04:33:58', 1),
(2, 'Jhon_Fisherman', 'second comment', '2021-04-04 04:34:49', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `21_comments`
--

CREATE TABLE `21_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `22_comments`
--

CREATE TABLE `22_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `22_comments`
--

INSERT INTO `22_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'SuperAdmin', 'test', '2021-04-11 12:36:27', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `23_comments`
--

CREATE TABLE `23_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `24_comments`
--

CREATE TABLE `24_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `25_comments`
--

CREATE TABLE `25_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `26_comments`
--

CREATE TABLE `26_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `28_comments`
--

CREATE TABLE `28_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `28_comments`
--

INSERT INTO `28_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'SuperAdmin', 'test', '2021-04-08 10:37:10', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `29_comments`
--

CREATE TABLE `29_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `30_comments`
--

CREATE TABLE `30_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `31_comments`
--

CREATE TABLE `31_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `33_comments`
--

CREATE TABLE `33_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `34_comments`
--

CREATE TABLE `34_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `35_comments`
--

CREATE TABLE `35_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `36_comments`
--

CREATE TABLE `36_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `37_comments`
--

CREATE TABLE `37_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `38_comments`
--

CREATE TABLE `38_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `39_comments`
--

CREATE TABLE `39_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `40_comments`
--

CREATE TABLE `40_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `41_comments`
--

CREATE TABLE `41_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `42_comments`
--

CREATE TABLE `42_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `43_comments`
--

CREATE TABLE `43_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `44_comments`
--

CREATE TABLE `44_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `44_comments`
--

INSERT INTO `44_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'SuperAdmin', '1', '2021-07-11 01:19:15', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `45_comments`
--

CREATE TABLE `45_comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `publishedDate` datetime NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `45_comments`
--

INSERT INTO `45_comments` (`id`, `author`, `comment`, `publishedDate`, `status`) VALUES
(1, 'testUser', '1', '2021-08-08 01:38:18', 1),
(2, 'testUser', '2', '2021-08-08 01:41:36', 1),
(3, 'testUser', '3', '2021-08-08 01:44:14', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `18_comments`
--
ALTER TABLE `18_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `19_comments`
--
ALTER TABLE `19_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `20_comments`
--
ALTER TABLE `20_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `21_comments`
--
ALTER TABLE `21_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `22_comments`
--
ALTER TABLE `22_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `23_comments`
--
ALTER TABLE `23_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `24_comments`
--
ALTER TABLE `24_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `25_comments`
--
ALTER TABLE `25_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `26_comments`
--
ALTER TABLE `26_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `28_comments`
--
ALTER TABLE `28_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `29_comments`
--
ALTER TABLE `29_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `30_comments`
--
ALTER TABLE `30_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `31_comments`
--
ALTER TABLE `31_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `33_comments`
--
ALTER TABLE `33_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `34_comments`
--
ALTER TABLE `34_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `35_comments`
--
ALTER TABLE `35_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `36_comments`
--
ALTER TABLE `36_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `37_comments`
--
ALTER TABLE `37_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `38_comments`
--
ALTER TABLE `38_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `39_comments`
--
ALTER TABLE `39_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `40_comments`
--
ALTER TABLE `40_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `41_comments`
--
ALTER TABLE `41_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `42_comments`
--
ALTER TABLE `42_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `43_comments`
--
ALTER TABLE `43_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `44_comments`
--
ALTER TABLE `44_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `45_comments`
--
ALTER TABLE `45_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `18_comments`
--
ALTER TABLE `18_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `19_comments`
--
ALTER TABLE `19_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `20_comments`
--
ALTER TABLE `20_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `21_comments`
--
ALTER TABLE `21_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `22_comments`
--
ALTER TABLE `22_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `23_comments`
--
ALTER TABLE `23_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `24_comments`
--
ALTER TABLE `24_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `25_comments`
--
ALTER TABLE `25_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `26_comments`
--
ALTER TABLE `26_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `28_comments`
--
ALTER TABLE `28_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `29_comments`
--
ALTER TABLE `29_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `30_comments`
--
ALTER TABLE `30_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `31_comments`
--
ALTER TABLE `31_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `33_comments`
--
ALTER TABLE `33_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `34_comments`
--
ALTER TABLE `34_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `35_comments`
--
ALTER TABLE `35_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `36_comments`
--
ALTER TABLE `36_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `37_comments`
--
ALTER TABLE `37_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `38_comments`
--
ALTER TABLE `38_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `39_comments`
--
ALTER TABLE `39_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `40_comments`
--
ALTER TABLE `40_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `41_comments`
--
ALTER TABLE `41_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `42_comments`
--
ALTER TABLE `42_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `43_comments`
--
ALTER TABLE `43_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `44_comments`
--
ALTER TABLE `44_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `45_comments`
--
ALTER TABLE `45_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
