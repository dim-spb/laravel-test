-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 01 2025 г., 21:54
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `y` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `cover`, `y`, `created_at`, `updated_at`) VALUES
(1, 'Книга1', 'Иванов И.И.', '00d70dddbf5b1654654db6f6643e1ed3.jpg', 1967, NULL, NULL),
(2, 'Книга2', 'Петров П.П.', '1cb57c8552dfaccdfce676c65c4719fb.jpg', 1951, NULL, NULL),
(3, 'Книга3', 'Петров П.П.', '5b300af7cb89e14b3b3804b63d38f6d5.jpg', 1997, NULL, NULL),
(4, 'Книга4', 'Иванов И.И.', 'd37166e40b7c6968e88487ce25300a59.jpg', 2020, NULL, NULL),
(5, 'Книга5', 'Петров П.П.', '86b3092097d21db0bd224278cf2b7e28.jpg', 1977, NULL, NULL),
(6, 'Книга6', 'Алексеев А.П.', 'a468d1ffde63011671f2efbcda09064e.jpg', 1952, NULL, NULL),
(7, 'Книга7', 'Иванов П.П.', '', 2011, NULL, NULL),
(8, 'Книга8', 'Иванов П.П.', '', 2010, NULL, NULL),
(9, 'Книга9', 'Иванов П.П.', '', 1992, NULL, NULL),
(10, 'Книга10', 'Андреев А.А.', '', 1997, NULL, NULL),
(11, 'Книга11', 'Дмитриев П.П.', '', 1917, NULL, NULL),
(12, 'Книга12', 'Алексеев А.А.', '', 1937, NULL, NULL),
(13, 'Книга13', 'Иванов В.В.', '', 1987, NULL, NULL),
(14, 'Книга14', 'Сидоров В.В.', '', 1997, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_02_01_174500_create_books', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
