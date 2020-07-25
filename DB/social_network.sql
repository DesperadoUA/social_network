-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 25 2020 г., 13:36
-- Версия сервера: 5.6.41
-- Версия PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `social_network`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `data_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `data_published`, `status`) VALUES
(1, 'lazarev-konstant@mail.ru', '8681ddd8ac7460f09a69e691ec98250e', '2020-07-19 19:18:16', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `static_page`
--

CREATE TABLE `static_page` (
  `id` int(11) NOT NULL,
  `post_type` varchar(55) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `data_publick` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `static_page`
--

INSERT INTO `static_page` (`id`, `post_type`, `permalink`, `title`, `description`, `keywords`, `content`, `data_publick`, `data_change`) VALUES
(1, 'home', '/', 'Тайтл главной страницы', 'Дескриптион главной страницы', 'keywords', '{\r\n  \"text\": \"Lorem Ipsum - это текст-\'рыба\', часто используемый в печати и вэб-дизайне. <p>Lorem Ipsum является стандартной \'рыбой\' для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p><p>Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>\"\r\n}', '2020-07-23 18:54:26', '2020-07-23 18:54:26'),
(2, 'contacts', 'contacts', 'Тайтл страницы контакты', 'Дескриптион страницы контакты', 'keywords', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. <p>Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p> \r\n<p>\r\nЕго популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>', '2020-07-23 18:54:26', '2020-07-23 18:54:26'),
(3, 'about', 'about', 'Тайтл страницы о нас', 'Тайтл страницы о нас', 'keywords', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. <p>Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн.</p> \r\n<p>\r\nЕго популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p>', '2020-07-23 18:54:26', '2020-07-23 18:54:26');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `data_published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `data_published`) VALUES
(1, 'lazarev', 'ecce4e1a7fc1fc293971c1a8eb58f99c', 'lazarev-konstant@mail.ru', '2020-07-18 18:25:27'),
(2, 'gazetax', 'ecce4e1a7fc1fc293971c1a8eb58f99c', 'gazetax@mail.ru', '2020-07-18 18:27:17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `static_page`
--
ALTER TABLE `static_page`
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
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `static_page`
--
ALTER TABLE `static_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
