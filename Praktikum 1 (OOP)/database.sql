CREATE DATABASE IF NOT EXISTS `politeknik`;
USE `politeknik`;

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` int(12) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Optional sample data sesuai screenshot halaman 16
INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `telepon`) VALUES
(13812, 'Nimas Sarinila', 'Bandar Kidul - Kediri', '0816382908'),
(13813, 'Kunti Eliyen', 'Bandar Lor - Kediri', '0824735639'),
(13814, 'M. Ali Ridho', 'Pocanan - Kediri', '0876529486'),
(13816, 'Hassya Talita', 'Sawojajar - Malang', '082948205')
ON DUPLICATE KEY UPDATE `nama`=VALUES(`nama`);
