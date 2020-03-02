--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(200) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
(1, '001', 'Barang 1', 90000, 100000, 95, NULL, '2020-03-01 20:23:21'),
(2, '002', 'Barang 2', 100000, 120000, 110, NULL, '2020-03-01 21:47:12'),
(3, '003', 'Barang 3', 170000, 200000, 99, '2019-10-30 03:16:00', '2020-03-01 21:45:30'),
(4, '004', 'Barang 4', 150000, 190000, 93, '2019-11-06 19:30:05', '2020-03-01 21:47:12'),
(5, '005', 'Barang 5', 300000, 340000, 96, '2019-11-06 21:33:54', '2020-03-01 21:48:11'),
(6, '006', 'Barang 6', 290000, 300000, 97, '2019-11-26 21:19:21', '2020-03-01 21:44:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail_pembelian` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_pembelian` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `diskon` double DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail_pembelian`, `id_barang`, `id_pembelian`, `jumlah_barang`, `harga_beli`, `diskon`, `created_at`, `updated_at`) VALUES
(8, 1, 8, 10, 90000, 10, '2020-03-01 20:20:04', '2020-03-01 20:20:04'),
(9, 2, 8, 5, 100000, 0, '2020-03-01 20:20:04', '2020-03-01 20:20:04'),
(10, 4, 8, 10, 150000, 0, '2020-03-01 20:20:04', '2020-03-01 20:20:04'),
(11, 2, 9, 5, 100000, 0, '2020-03-01 21:47:12', '2020-03-01 21:47:12'),
(12, 4, 9, 8, 150000, 0, '2020-03-01 21:47:12', '2020-03-01 21:47:12'),
(13, 5, 10, 10, 300000, 0, '2020-03-01 21:48:11', '2020-03-01 21:48:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail_penjualan` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `diskon` double DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail_penjualan`, `id_barang`, `id_penjualan`, `jumlah_barang`, `harga_jual`, `diskon`, `created_at`, `updated_at`) VALUES
(13, 1, 10, 15, 100000, 0, '2020-03-01 20:23:21', '2020-03-01 20:23:21'),
(14, 4, 10, 5, 190000, 0, '2020-03-01 20:23:21', '2020-03-01 20:23:21'),
(15, 5, 10, 10, 340000, 0, '2020-03-01 20:23:21', '2020-03-01 20:23:21'),
(16, 4, 11, 20, 190000, 5, '2020-03-01 21:44:43', '2020-03-01 21:44:43'),
(17, 6, 11, 3, 300000, 0, '2020-03-01 21:44:43', '2020-03-01 21:44:43'),
(18, 5, 11, 4, 340000, 8, '2020-03-01 21:44:43', '2020-03-01 21:44:43'),
(19, 3, 12, 1, 200000, 0, '2020-03-01 21:45:30', '2020-03-01 21:45:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rizalchan2.2@gmail.com', '$2y$10$xeAhgjJebNKgkGnjBf2veOv21R8V4VFLyQDulakKL/wKmsSvukQra', '2019-11-13 03:27:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nama_penjual` varchar(200) DEFAULT NULL,
  `total_beli` double DEFAULT NULL,
  `urutan_tgl` char(13) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal`, `nama_penjual`, `total_beli`, `urutan_tgl`, `created_at`, `updated_at`) VALUES
(8, '2020-02-01 00:00:00', 'Heri', 2810000, '2020020100001', '2020-03-01 20:20:04', '2020-03-01 20:20:04'),
(9, '2020-02-12 00:00:00', 'Budi', 1700000, '2020021200002', '2020-03-01 21:47:12', '2020-03-01 21:47:12'),
(10, '2020-02-02 00:00:00', 'Kevin', 3000000, '2020020200001', '2020-03-01 21:48:11', '2020-03-01 21:48:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `nama_pembeli` varchar(200) DEFAULT NULL,
  `total_jual` double DEFAULT NULL,
  `urutan_tgl` char(13) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggal`, `nama_pembeli`, `total_jual`, `urutan_tgl`, `created_at`, `updated_at`) VALUES
(10, '2020-02-01 00:00:00', 'Hasyim', 5850000, '2020020100002', '2020-03-01 20:23:21', '2020-03-01 20:23:21'),
(11, '2020-02-05 00:00:00', 'Arya', 5761200, '2020020500001', '2020-03-01 21:44:43', '2020-03-01 21:44:43'),
(12, '2020-02-12 00:00:00', 'Fatimah', 200000, '2020021200001', '2020-03-01 21:45:30', '2020-03-01 21:45:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Akun Sample', 'sample@gmail.com', NULL, '$2y$10$wYqoMeRw5aOFpZK0OgTYJe6nfedlFieSwWY1XW8iQ2qNu1dcPUiLW', NULL, '2019-10-29 01:09:38', '2020-03-01 21:17:48'),
(2, 'rizal', 'rizalchan2.2@gmail.com', NULL, '$2y$10$3GpPi/aiIJhFhq2iKv2iguil6Lu5jxtQmZa4QmeX3rrMcNnogmpsW', 'VvhQGEDkMYSn6W53Lb6MDzqoXuhhbiVmPTCc0d9vwyXHMJYNr6V8Y0Cr7Zgm', NULL, '2019-11-11 20:46:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pembelian`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail_penjualan`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_penjualan` (`id_penjualan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
