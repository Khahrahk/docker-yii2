-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Мар 13 2023 г., 23:28
-- Версия сервера: 8.0.32
-- Версия PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2-docker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1678470245),
('m230310_091439_create_person_table', 1678470250),
('m230310_173448_create_number_table', 1678470250);

-- --------------------------------------------------------

--
-- Структура таблицы `number`
--

CREATE TABLE `number` (
  `id` int NOT NULL,
  `PersonId` int NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `number`
--

INSERT INTO `number` (`id`, `PersonId`, `number`) VALUES
(1, 1, '+79719939939'),
(2, 3, '+78381838122'),
(3, 1, '+79037373747');

-- --------------------------------------------------------

--
-- Структура таблицы `person`
--

CREATE TABLE `person` (
  `id` int NOT NULL,
  `Full_name` varchar(255) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `Location` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `person`
--

INSERT INTO `person` (`id`, `Full_name`, `DOB`, `Location`) VALUES
(1, 'Прикол Приколович Приколов', '2023-03-01 20:59:41', 'Челябинск'),
(2, 'Аркадий Паравозов Паравозович', '2015-03-04 21:42:58', 'Москва'),
(3, 'Джон Смит Смитович', '2023-03-01 23:16:57', 'Санкт-Петербург'),
(4, 'Максим Максимович', '2023-03-16 23:16:57', 'Сыктывкар'),
(5, 'Данила Данилович', '2023-03-18 23:17:46', 'Пенза');

-- --------------------------------------------------------

--
-- Структура таблицы `prikol`
--

CREATE TABLE `prikol` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `aaaa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `prikol`
--

INSERT INTO `prikol` (`id`, `name`, `number`, `aaaa`) VALUES
(1, 'prikol', '228', 'adaaaaaa'),
(2, 'prikol', '228', 'adaaaaaa'),
(3, 'prikol', '228', 'adaaaaaa'),
(4, 'prikol', '228', 'adaaaaaa'),
(5, 'prikol', '228', 'adaaaaaa'),
(6, 'prikol', '228', 'adaaaaaa'),
(7, 'prikol', '228', 'adaaaaaa');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `number`
--
ALTER TABLE `number`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_person_number` (`PersonId`);

--
-- Индексы таблицы `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prikol`
--
ALTER TABLE `prikol`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `number`
--
ALTER TABLE `number`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `person`
--
ALTER TABLE `person`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `prikol`
--
ALTER TABLE `prikol`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `number`
--
ALTER TABLE `number`
  ADD CONSTRAINT `fk_person_number` FOREIGN KEY (`PersonId`) REFERENCES `person` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
