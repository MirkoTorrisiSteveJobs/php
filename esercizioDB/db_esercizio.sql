-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 20, 2020 alle 17:51
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_esercizio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accesses`
--

CREATE TABLE `accesses` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `accesses`
--

INSERT INTO `accesses` (`id`, `user_id`, `date`) VALUES
(6, 0, '2020-11-14 11:00:14'),
(7, 11, '2020-11-14 11:00:19'),
(8, 11, '2020-11-14 11:05:24'),
(9, 11, '2020-11-14 11:05:57'),
(10, 0, '2020-11-14 11:06:56'),
(11, 12, '2020-11-14 11:07:08'),
(12, 12, '2020-11-14 11:07:21'),
(13, 11, '2020-11-14 11:12:18'),
(14, 11, '2020-11-14 11:47:55'),
(15, 11, '2020-11-14 11:48:41'),
(16, 11, '2020-11-14 11:52:00'),
(17, 0, '2020-11-14 11:56:16'),
(18, 11, '2020-11-14 19:06:34'),
(19, 11, '2020-11-14 19:06:47'),
(20, 11, '2020-11-14 19:07:24'),
(21, 11, '2020-11-14 20:17:39'),
(22, 11, '2020-11-14 20:19:17'),
(23, 11, '2020-11-14 20:22:00'),
(24, 11, '2020-11-14 20:25:11'),
(25, 0, '2020-11-14 20:29:24'),
(26, 15, '2020-11-14 20:32:27'),
(27, 11, '2020-11-14 20:33:03'),
(28, 15, '2020-11-14 20:33:18'),
(29, 11, '2020-11-14 22:42:20'),
(30, 11, '2020-11-14 22:44:00'),
(31, 11, '2020-11-14 22:44:38'),
(32, 16, '2020-11-15 10:47:52'),
(33, 11, '2020-11-17 00:30:22'),
(34, 11, '2020-11-17 11:07:27'),
(35, 11, '2020-11-17 11:11:13'),
(36, 11, '2020-11-17 12:07:32'),
(37, 11, '2020-11-17 12:10:57'),
(38, 11, '2020-11-17 12:14:06'),
(39, 11, '2020-11-20 09:59:49'),
(40, 11, '2020-11-20 10:31:26');

-- --------------------------------------------------------

--
-- Struttura della tabella `favourites`
--

CREATE TABLE `favourites` (
  `id` int(10) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `product_id`) VALUES
(46, '15', 1),
(47, '15', 5),
(48, '15', 8),
(49, '15', 2),
(50, '15', 3),
(51, '', 2),
(52, '', 1),
(53, '', 3),
(54, '', 4),
(55, '', 4),
(56, '', 3),
(57, '', 1),
(58, '', 2),
(62, '16', 4),
(66, '16', 8),
(67, '16', 8),
(68, '16', 8),
(69, '16', 8),
(70, '16', 8),
(71, '16', 5),
(77, '11', 5),
(78, '11', 7),
(80, '11', 3),
(82, '11', 2),
(84, '11', 1),
(85, '11', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `img_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `img_url`) VALUES
(1, 'Pentola a pressione', 10000, 'https://images-na.ssl-images-amazon.com/images/I/81aj4X6GgTL._AC_SX425_.jpg'),
(2, 'Vite', 154, 'https://admin.abc.sm/upload/1115/catalogodinamico/prodotti/img_739986_115712Panelvit_chromiting.1.jpg'),
(3, 'Calzino', 600, 'https://www.albosunderwear.com/wp-content/uploads/2018/04/Calzino-Corto-Donna-Gallo-Fantasia-Pesci-Rosso-AP50512613725.jpg'),
(4, 'Matita', 899, 'https://www.momarte.com/598-large_default/matita-grafite-triplus-jumbo.jpg'),
(5, 'Verruca', 500, 'https://it-m.iliveok.com/sites/default/files/styles/term_image_mobile/public/gallery/krasnaya-borodavka.jpg?itok=Sb_z9-OM'),
(6, 'Pesce', 1500, 'https://c8.alamy.com/compit/bb5ebc/un-pesce-morto-lavato-fino-sulla-sabbia-bb5ebc.jpg'),
(7, '10 euro', 11, 'https://image.shutterstock.com/image-photo/ten-euro-bank-note-finance-260nw-1561601836.jpg'),
(8, 'Patata da bollire', 9999999, 'https://thumbs.dreamstime.com/b/patata-pulita-sbucciata-7372734.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cf` varchar(50) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `nome`, `cognome`, `dob`, `email`, `cf`, `citta`, `indirizzo`, `password`) VALUES
(11, 'mirko', 'Torrisi', '2020-11-15', 'mirko.torrisi92@gmail.com', 'amdmng30495', 'San Giovanni La zappa', 'via fessacchiotti 5', 'da9f6713671da24a575ffbe6f0749ecb613efe7f3887b5c9f3e6cc8a94982ae9'),
(13, 'Santo', 'Santoro', '2020-11-18', 'santo@santoro.it', 'dd', 'dd', 'dd', 'da9f6713671da24a575ffbe6f0749ecb613efe7f3887b5c9f3e6cc8a94982ae9'),
(15, 'Melo', 'La Porca', '', 'melo@santoro.it', 'MMLLNNOOLLK', 'San Giovanni La punta', 'via lipari 5', 'da9f6713671da24a575ffbe6f0749ecb613efe7f3887b5c9f3e6cc8a94982ae9'),
(16, 'Saverio', 'Pediatra', '2012-12-12', 'saverio@pediatra.com', 'svrpdtr', 'catani', 'via smeraldina', 'da9f6713671da24a575ffbe6f0749ecb613efe7f3887b5c9f3e6cc8a94982ae9');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT per la tabella `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT per la tabella `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
