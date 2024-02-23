-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2023 pada 21.52
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_cars`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(12) NOT NULL,
  `id_user` int(12) DEFAULT NULL,
  `feed` text DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_user`, `feed`, `created_at`) VALUES
(1, 1, 'This application is very usefull for someone like me. The design is very beautiful, make my eyes feel like booms. All function working well. I like it. Thank you :)', '2023-11-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rates`
--

CREATE TABLE `rates` (
  `id_rates` int(12) NOT NULL,
  `id_rents` int(12) DEFAULT NULL,
  `star_value` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rates`
--

INSERT INTO `rates` (`id_rates`, `id_rents`, `star_value`) VALUES
(1, 4, 5),
(2, 5, 4),
(3, 6, 4),
(4, 7, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rents`
--

CREATE TABLE `rents` (
  `id_rents` int(12) NOT NULL,
  `id_user` int(12) DEFAULT NULL,
  `id_vehicle` int(12) DEFAULT NULL,
  `rent_date` date NOT NULL,
  `return_date` date NOT NULL,
  `total_date` int(3) DEFAULT NULL,
  `amount` int(12) DEFAULT NULL,
  `status` enum('Paid','Unpaid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rents`
--

INSERT INTO `rents` (`id_rents`, `id_user`, `id_vehicle`, `rent_date`, `return_date`, `total_date`, `amount`, `status`) VALUES
(4, 1, 1, '2023-11-26', '2023-11-29', 3, 1500, 'Paid'),
(5, 1, 2, '2023-11-26', '2023-11-30', 4, 800, 'Paid'),
(6, 1, 1, '2023-11-30', '2023-12-01', 1, 500, 'Paid'),
(7, 1, 1, '2023-12-02', '2023-12-03', 1, 500, 'Paid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id_transactions` int(12) NOT NULL,
  `id_rents` int(12) DEFAULT NULL,
  `payment_method` enum('Cash','Transfer') DEFAULT NULL,
  `payment_proof` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id_transactions`, `id_rents`, `payment_method`, `payment_proof`) VALUES
(2, 4, 'Transfer', '6563524dc3c82_Capture.PNG'),
(3, 5, 'Cash', NULL),
(4, 6, 'Cash', NULL),
(5, 7, 'Cash', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(12) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Raffi Ahmad', 'raffi@gmail.com', '088811112222', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id_vehicle` int(12) NOT NULL,
  `vehicle_name` varchar(100) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `type` enum('electric') DEFAULT NULL,
  `price` int(12) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id_vehicle`, `vehicle_name`, `brand`, `type`, `price`, `image`) VALUES
(1, 'Tesla Model 3', 'Tesla', 'electric', 500, 'tesla.jpg'),
(2, 'Mercedes EQE', 'Mercedes Benz', 'electric', 200, 'mercedes.jpg'),
(3, 'Porsche Tycan ', 'Porsche', 'electric', 100, 'porsche.jpg'),
(4, 'BMW IX', 'BMW', 'electric', 450, 'bmw.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id_rates`),
  ADD KEY `id_rents` (`id_rents`);

--
-- Indeks untuk tabel `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id_rents`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_vehicle` (`id_vehicle`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id_transactions`),
  ADD KEY `id_rents` (`id_rents`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id_vehicle`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rates`
--
ALTER TABLE `rates`
  MODIFY `id_rates` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rents`
--
ALTER TABLE `rents`
  MODIFY `id_rents` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id_transactions` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicle` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`id_rents`) REFERENCES `rents` (`id_rents`);

--
-- Ketidakleluasaan untuk tabel `rents`
--
ALTER TABLE `rents`
  ADD CONSTRAINT `rents_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `rents_ibfk_2` FOREIGN KEY (`id_vehicle`) REFERENCES `vehicles` (`id_vehicle`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_rents`) REFERENCES `rents` (`id_rents`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
