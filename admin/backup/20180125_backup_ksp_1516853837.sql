DROP TABLE anggota;DROP TABLE angsuran;DROP TABLE angsuran_det;DROP TABLE bunga_pinjam;DROP TABLE kategori_simpanan;DROP TABLE pegawai;DROP TABLE pinjaman;DROP TABLE simpanan;

CREATE TABLE `anggota` (
  `kd_anggota` varchar(5) NOT NULL,
  `nm_anggota` varchar(100) NOT NULL,
  `tgl_registrasi` date NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `jk` enum('P','L') NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `status` enum('Aktif','Non AKtif') NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(65) NOT NULL,
  PRIMARY KEY (`kd_anggota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO anggota VALUES("A0001","Anggi","2018-01-10","Jl. Maju No 65","087867564321","P","Batang","2000-01-08","Aktif","anggi","");
INSERT INTO anggota VALUES("A0002","Rhizky Ardiyanti","2018-01-15","Jl. Jalan","088387665657","P","Semarang","1995-06-06","Aktif","rhizky","$2y$10$QqqTZr1WZd0tl0qNxF5c7eher6kT71W9TD46lAsg16QOjuZzf3vDy");
INSERT INTO anggota VALUES("A0003","Bharlian Nandha","2018-01-16","Jl. Hm","087665656565","L","Semarang","2000-01-01","Aktif","bharlian","");
INSERT INTO anggota VALUES("A0004","Netty Supardiyanti","2018-01-16","Jl. Cicurug","085640775789","P","Sukabumi","1972-02-02","Aktif","netty","");
INSERT INTO anggota VALUES("A0005","Monica","2018-01-16","Jl. Sidodadi","087656566451","P","Padang","1998-01-02","Aktif","monica","");
INSERT INTO anggota VALUES("A0006","Spongebob Squarepants","2018-01-15","Bikini Bottom dekat Rock Bottom","088387665657","L","Semarang","1980-01-02","Aktif","spongebob","$2y$10$zqFKwVZLAo8HL7D2fwa4eeHL9DxBcvnFONmstKoUy2z2jcF0faR4u");
INSERT INTO anggota VALUES("A0007","Nama","2018-01-16","Jl. mmm","088387665657","P","Tangerang","1998-01-01","Aktif","nama","$2y$10$rJmwKdxzQh4Kg.lDVleq/Oqh6l/ObHwGif49QiP9.OxszqqSzw/si");





CREATE TABLE `angsuran` (
  `kd_angsuran` varchar(6) NOT NULL,
  `kd_pinjaman` varchar(6) NOT NULL,
  `lama` int(2) NOT NULL,
  `besar_angsur` int(9) NOT NULL,
  `status` enum('L','BL') NOT NULL,
  PRIMARY KEY (`kd_angsuran`),
  KEY `kd_pinjaman` (`kd_pinjaman`),
  CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`kd_pinjaman`) REFERENCES `pinjaman` (`kd_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO angsuran VALUES("AN0001","PJ0001","2","101250","BL");
INSERT INTO angsuran VALUES("AN0002","PJ0002","10","101250","BL");





CREATE TABLE `angsuran_det` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_angsuran` varchar(6) NOT NULL,
  `tgl` datetime NOT NULL,
  `angsuran_ke` int(3) NOT NULL,
  `besar_angsur` int(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kd_angsuran` (`kd_angsuran`),
  CONSTRAINT `angsuran_det_ibfk_1` FOREIGN KEY (`kd_angsuran`) REFERENCES `angsuran` (`kd_angsuran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

INSERT INTO angsuran_det VALUES("6","AN0001","2018-01-15 00:00:00","1","101250");
INSERT INTO angsuran_det VALUES("7","AN0001","2018-01-15 10:58:00","2","101250");
INSERT INTO angsuran_det VALUES("38","AN0002","2018-01-16 09:08:21","1","101250");





CREATE TABLE `bunga_pinjam` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_angsur` varchar(6) NOT NULL,
  `nominal` int(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kd_pinjam` (`kd_angsur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO bunga_pinjam VALUES("1","AN0001","1250");
INSERT INTO bunga_pinjam VALUES("2","AN0001","1250");
INSERT INTO bunga_pinjam VALUES("10","AN0001","1250");
INSERT INTO bunga_pinjam VALUES("11","AN0001","1250");
INSERT INTO bunga_pinjam VALUES("12","AN0002","1250");





CREATE TABLE `kategori_simpanan` (
  `kd_kategori_simpanan` varchar(2) NOT NULL,
  `nm_kategori` varchar(10) NOT NULL,
  `nominal` int(9) NOT NULL,
  PRIMARY KEY (`kd_kategori_simpanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO kategori_simpanan VALUES("K1","pokok","50000");
INSERT INTO kategori_simpanan VALUES("K2","wajib","20000");
INSERT INTO kategori_simpanan VALUES("K3","sukarela","0");





CREATE TABLE `pegawai` (
  `kd_pegawai` varchar(5) NOT NULL,
  `nm_pegawai` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `jk` enum('P','L') NOT NULL,
  `jabatan` enum('admin','teller') NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(65) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO pegawai VALUES("P0001","Mutiara Mahe","Jl. Peterongan Kobong No. 40","089678964739","P","admin","admin","$2y$10$eaacuEmsVjUDPnuafCrVHOFtCzvWZLTddpPiRirEH8FalN19vGYM6","../uploads/1.jpeg");
INSERT INTO pegawai VALUES("P0002","Teli","Jl. Jalan No. 34","085637787389","P","teller","teller","$2y$10$eaacuEmsVjUDPnuafCrVHOFtCzvWZLTddpPiRirEH8FalN19vGYM6","");
INSERT INTO pegawai VALUES("P0003","Mia ","Jl. Jalan No. 39","087748778373","P","teller","mia","$2y$10$eaacuEmsVjUDPnuafCrVHOFtCzvWZLTddpPiRirEH8FalN19vGYM6","");
INSERT INTO pegawai VALUES("P0004","Coba","Jl. jl","089777666565","P","admin","cobaa","$2y$10$6AAoO/d5/W3RLdbZjWoGoeAfQ1Tr2y1lGTqXVG9DyMvvgeWaOEGoq","../uploads/102656-miku-hatsune-miku-chibi.jpeg");





CREATE TABLE `pinjaman` (
  `kd_pinjaman` varchar(6) NOT NULL,
  `tgl` datetime NOT NULL,
  `kd_anggota` varchar(5) NOT NULL,
  `kd_pegawai` varchar(5) NOT NULL,
  `besar_pinjam` int(9) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pelunasan` date NOT NULL,
  `lama` int(2) NOT NULL,
  `bunga` float NOT NULL,
  `biaya_total_bayar` int(9) NOT NULL,
  `denda` int(9) NOT NULL,
  `status` enum('BL','L') NOT NULL,
  PRIMARY KEY (`kd_pinjaman`),
  KEY `kd_anggota` (`kd_anggota`),
  KEY `kd_pegawai` (`kd_pegawai`),
  CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pinjaman_ibfk_2` FOREIGN KEY (`kd_pegawai`) REFERENCES `pegawai` (`kd_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO pinjaman VALUES("PJ0001","2018-01-15 05:59:34","A0002","P0001","200000","2018-01-15","2018-03-15","2","1.25","202500","0","BL");
INSERT INTO pinjaman VALUES("PJ0002","2018-01-16 09:07:17","A0003","P0001","1000000","2018-01-16","2018-11-16","10","1.25","1012500","0","BL");





CREATE TABLE `simpanan` (
  `kd_simpanan` varchar(6) NOT NULL,
  `kd_kategori_simpanan` varchar(2) NOT NULL,
  `kd_anggota` varchar(5) NOT NULL,
  `tgl` datetime NOT NULL,
  `nominal` int(9) NOT NULL,
  `kd_pegawai` varchar(5) NOT NULL,
  `bulan` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`kd_simpanan`),
  KEY `kd_kategori_simpanan` (`kd_kategori_simpanan`),
  KEY `kd_anggota` (`kd_anggota`),
  KEY `kd_pegawai` (`kd_pegawai`),
  CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`kd_kategori_simpanan`) REFERENCES `kategori_simpanan` (`kd_kategori_simpanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `simpanan_ibfk_2` FOREIGN KEY (`kd_anggota`) REFERENCES `anggota` (`kd_anggota`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO simpanan VALUES("SP0001","K1","A0001","2018-01-15 02:17:44","50000","P0001","");
INSERT INTO simpanan VALUES("SP0002","K1","A0002","2018-01-15 03:55:12","50000","P0001","null");
INSERT INTO simpanan VALUES("SP0003","K1","A0003","2018-01-15 04:15:16","50000","P0001","null");
INSERT INTO simpanan VALUES("SP0004","K1","A0004","2018-01-15 04:16:40","50000","P0001","null");
INSERT INTO simpanan VALUES("SP0005","K1","A0005","2018-01-15 04:22:35","50000","P0001","null");
INSERT INTO simpanan VALUES("SS0001","K3","A0001","2018-01-15 03:18:21","100000","P0001","");
INSERT INTO simpanan VALUES("SS0002","K3","A0003","2018-01-15 04:18:56","70000","P0001","");
INSERT INTO simpanan VALUES("SS0003","K3","A0004","2018-01-15 04:22:56","65000","P0001","");
INSERT INTO simpanan VALUES("SS0004","K3","A0005","2018-01-15 04:48:04","50000","P0001","");
INSERT INTO simpanan VALUES("SS0005","K3","A0002","2018-01-15 04:50:49","1200000","P0001","");
INSERT INTO simpanan VALUES("SW0001","K2","A0001","2018-01-15 02:42:14","20000","P0001","January 2018");
INSERT INTO simpanan VALUES("SW0002","K2","A0002","2018-01-15 03:57:35","20000","P0001","January 2018");
INSERT INTO simpanan VALUES("SW0003","K2","A0003","2018-01-15 04:16:07","20000","P0001","January 2018");
INSERT INTO simpanan VALUES("SW0004","K2","A0004","2018-01-15 04:23:54","20000","P0001","January 2018");



