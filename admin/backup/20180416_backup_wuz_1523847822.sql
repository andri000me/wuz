DROP TABLE customer;
DROP TABLE place;
DROP TABLE reservation;
DROP TABLE reservation_item;
DROP TABLE rute;
DROP TABLE seat;
DROP TABLE transportation;
DROP TABLE transportation_type;
DROP TABLE user;


CREATE TABLE `customer` (
  `kd_customer` varchar(6) NOT NULL,
  `nm_customer` varchar(40) NOT NULL DEFAULT 'Name',
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `alamat` text,
  `telp` varchar(13) DEFAULT NULL,
  `jk` enum('P','L') NOT NULL,
  PRIMARY KEY (`kd_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO customer VALUES("C00001","Jeon Jungkook","kookie","$2y$10$lw1fr5Vs0wBTEYRNNAMUwejQzPRiYbE/TNtxyF1UfcqlgT.1gvgKq","jeonbangtan97@gmail.com","Jl. Sompok Lama","089678964732","L");
INSERT INTO customer VALUES("C00002","Mutiara Hardiani Mahe","mutiara","$2y$10$jSgBw2I6NnrpcnbXZ1H/aujZrh45GjvzFfMfP6Y.whNCrwxo0j4Za","mutiaramahee17@gmail.com","Jl. Peterongan Kobong No. 40","089678964739","P");





CREATE TABLE `place` (
  `kd_place` varchar(3) NOT NULL,
  `nm_place` varchar(30) NOT NULL,
  `jenis` enum('Stasiun','Bandara') NOT NULL,
  `kota` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`kd_place`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO place VALUES("AS","Adisutjipto","Bandara","Yogyakarta","Jl. Raya Solo KM. 9, Maguwoharjo");
INSERT INTO place VALUES("AY","Ahmad Yani","Bandara","Semarang","Jl. Ahmad Yani");
INSERT INTO place VALUES("BS","Bandung Station","Stasiun","Bandung","Jl. Stasiun Barat");
INSERT INTO place VALUES("GB","Gambir","Stasiun","Jakarta","Jl. Medan Merdeka Timur No. 1");
INSERT INTO place VALUES("HS","Husein Sastranegara","Bandara","Bandung","Jl. Pajajaran No. 156, Husen Sastranegara, Cicendo");
INSERT INTO place VALUES("JU","Juanda","Bandara","Surabaya","Jl. Ir. Juanda No.1 Sedati Sidoarjo");
INSERT INTO place VALUES("KC","Kiaracondong","Stasiun","Bandung","Jl. Jembatan Opat");
INSERT INTO place VALUES("KL","Kota Lama","Stasiun","Malang","Ciptomulyo, Sukun");
INSERT INTO place VALUES("PNC","Poncol","Stasiun","Semarang","");
INSERT INTO place VALUES("SH","Soekarno-Hatta","Bandara","Jakarta","Jl. Pajang, Tangerang");
INSERT INTO place VALUES("SN","Syamsudin Noor","Bandara","Banjarmasin","Jl. Angkasa, Landasan Ulin, Liang Anggang");
INSERT INTO place VALUES("ST","Sentani","Bandara","Jayapura","Sentani, Jayapura, Papua 99359");
INSERT INTO place VALUES("TW","Tawang","Stasiun","Semarang","Jl. Taman Tawang No. 1");





CREATE TABLE `reservation` (
  `kd_reservation` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `kd_customer` varchar(6) NOT NULL,
  `kd_rute` varchar(6) NOT NULL,
  `jml_ticket` int(2) NOT NULL,
  `total_price` int(7) NOT NULL,
  `kd_user` varchar(6) NOT NULL,
  `pembayaran` enum('BCA','BRI','Mandiri','Indomaret','Alfamart') NOT NULL,
  `kd_pembayaran` varchar(6) NOT NULL,
  `status_pembayaran` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`kd_reservation`),
  KEY `kd_customer` (`kd_customer`),
  KEY `kd_rute` (`kd_rute`),
  KEY `kd_user` (`kd_user`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `user` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`kd_customer`) REFERENCES `customer` (`kd_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`kd_rute`) REFERENCES `rute` (`kd_rute`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO reservation VALUES("RS0001","2018-04-27","C00001","RT0002","1","85000","U00001","Alfamart","2FG56","N");





CREATE TABLE `reservation_item` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_reservation` varchar(6) NOT NULL,
  `nm_penumpang` varchar(100) NOT NULL,
  `jenis_id` enum('KTP','Paspor','Lainnya') NOT NULL,
  `no_id` int(20) NOT NULL,
  `id_seat` int(3) NOT NULL,
  `jml` int(2) NOT NULL,
  `price` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seat` (`id_seat`),
  KEY `kd_reservation` (`kd_reservation`),
  CONSTRAINT `reservation_item_ibfk_1` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_item_ibfk_2` FOREIGN KEY (`kd_reservation`) REFERENCES `reservation` (`kd_reservation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO reservation_item VALUES("1","RS0001","Jungkook","KTP","0","5","1","85000");





CREATE TABLE `rute` (
  `kd_rute` varchar(6) NOT NULL,
  `depart_at` time NOT NULL,
  `rute_from` varchar(6) NOT NULL,
  `rute_to` varchar(6) NOT NULL,
  `price` int(7) NOT NULL,
  `kd_transportation` varchar(6) NOT NULL,
  PRIMARY KEY (`kd_rute`),
  KEY `rute_from` (`rute_from`),
  KEY `rute_to` (`rute_to`),
  KEY `kd_transportation` (`kd_transportation`),
  CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`rute_from`) REFERENCES `place` (`kd_place`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rute_ibfk_2` FOREIGN KEY (`rute_to`) REFERENCES `place` (`kd_place`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rute_ibfk_3` FOREIGN KEY (`kd_transportation`) REFERENCES `transportation` (`kd_transportation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO rute VALUES("RT0001","10:00:00","GB","TW","84000","ETSJ01");
INSERT INTO rute VALUES("RT0002","12:30:00","PNC","GB","85000","ETSJ01");
INSERT INTO rute VALUES("RT0003","20:00:00","PNC","GB","84000","ETAR02");





CREATE TABLE `seat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_seat` varchar(5) NOT NULL,
  `kd_transportation` varchar(6) NOT NULL,
  `status` enum('B','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`),
  KEY `kd_transportation` (`kd_transportation`),
  CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`kd_transportation`) REFERENCES `transportation` (`kd_transportation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

INSERT INTO seat VALUES("1","A01G1","ETSJ01","F");
INSERT INTO seat VALUES("2","A02G1","ETSJ01","F");
INSERT INTO seat VALUES("3","A03G1","ETSJ01","F");
INSERT INTO seat VALUES("4","A04G1","ETSJ01","F");
INSERT INTO seat VALUES("5","A05G1","ETSJ01","F");
INSERT INTO seat VALUES("8","A06G1","ETSJ01","F");
INSERT INTO seat VALUES("10","A07G1","ETSJ01","F");
INSERT INTO seat VALUES("11","A08G1","ETSJ01","F");
INSERT INTO seat VALUES("12","A09G1","ETSJ01","F");
INSERT INTO seat VALUES("13","A10G1","ETSJ01","F");
INSERT INTO seat VALUES("14","A11G1","ETSJ01","F");
INSERT INTO seat VALUES("15","A12G1","ETSJ01","F");
INSERT INTO seat VALUES("16","A13G1","ETSJ01","F");
INSERT INTO seat VALUES("17","A14G1","ETSJ01","F");
INSERT INTO seat VALUES("18","A15G1","ETSJ01","F");
INSERT INTO seat VALUES("19","B01G1","ETSJ01","F");
INSERT INTO seat VALUES("20","B02G1","ETSJ01","F");
INSERT INTO seat VALUES("21","B03G1","ETSJ01","F");
INSERT INTO seat VALUES("22","B04G1","ETSJ01","F");
INSERT INTO seat VALUES("23","B05G1","ETSJ01","F");
INSERT INTO seat VALUES("24","B06G1","ETSJ01","F");
INSERT INTO seat VALUES("25","B07G1","ETSJ01","F");
INSERT INTO seat VALUES("26","B08G1","ETSJ01","F");
INSERT INTO seat VALUES("27","B09G1","ETSJ01","F");
INSERT INTO seat VALUES("28","B10G1","ETSJ01","F");
INSERT INTO seat VALUES("29","B11G1","ETSJ01","F");
INSERT INTO seat VALUES("30","B12G1","ETSJ01","F");
INSERT INTO seat VALUES("31","B13G1","ETSJ01","F");
INSERT INTO seat VALUES("32","B14G1","ETSJ01","F");
INSERT INTO seat VALUES("33","B15G1","ETSJ01","F");
INSERT INTO seat VALUES("34","C01G1","ETSJ01","F");
INSERT INTO seat VALUES("35","C02G1","ETSJ01","F");
INSERT INTO seat VALUES("36","C03G1","ETSJ01","F");
INSERT INTO seat VALUES("37","C04G1","ETSJ01","F");
INSERT INTO seat VALUES("38","C05G1","ETSJ01","F");
INSERT INTO seat VALUES("39","C06G1","ETSJ01","F");
INSERT INTO seat VALUES("40","C07G1","ETSJ01","F");
INSERT INTO seat VALUES("41","C08G1","ETSJ01","F");
INSERT INTO seat VALUES("42","C09G1","ETSJ01","F");
INSERT INTO seat VALUES("43","C10G1","ETSJ01","F");
INSERT INTO seat VALUES("44","C11G1","ETSJ01","F");
INSERT INTO seat VALUES("45","C12G1","ETSJ01","F");
INSERT INTO seat VALUES("46","C13G1","ETSJ01","F");
INSERT INTO seat VALUES("47","C14G1","ETSJ01","F");
INSERT INTO seat VALUES("48","C15G1","ETSJ01","F");
INSERT INTO seat VALUES("49","D01G1","ETSJ01","F");
INSERT INTO seat VALUES("50","D02G1","ETSJ01","F");
INSERT INTO seat VALUES("51","D03G1","ETSJ01","F");
INSERT INTO seat VALUES("52","D04G1","ETSJ01","F");
INSERT INTO seat VALUES("53","D05G1","ETSJ01","F");
INSERT INTO seat VALUES("54","D06G1","ETSJ01","F");
INSERT INTO seat VALUES("55","D07G1","ETSJ01","F");
INSERT INTO seat VALUES("56","D08G1","ETSJ01","F");
INSERT INTO seat VALUES("57","D09G1","ETSJ01","F");
INSERT INTO seat VALUES("58","D10G1","ETSJ01","F");
INSERT INTO seat VALUES("59","D11G1","ETSJ01","F");
INSERT INTO seat VALUES("60","D12G1","ETSJ01","F");
INSERT INTO seat VALUES("61","D13G1","ETSJ01","F");
INSERT INTO seat VALUES("62","D14G1","ETSJ01","F");
INSERT INTO seat VALUES("63","D15G1","ETSJ01","F");
INSERT INTO seat VALUES("64","A01G1","ETAR02","F");





CREATE TABLE `transportation` (
  `kd_transportation` varchar(6) NOT NULL,
  `nm_trans` varchar(30) NOT NULL,
  `seat_qty` int(3) NOT NULL,
  `kd_tt` varchar(6) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kd_transportation`),
  KEY `kd_tt` (`kd_tt`),
  CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`kd_tt`) REFERENCES `transportation_type` (`kd_tt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO transportation VALUES("BPGA01","Garuda","60","BP","Pesawat kelas bisnis");
INSERT INTO transportation VALUES("BPGA02","Garuda","60","BP","Pesawat ternyaman");
INSERT INTO transportation VALUES("BPLA01","Lion Air","60","BP","Pesawat kelas bisnis yang nyaman");
INSERT INTO transportation VALUES("BTAB01","Argo Bromo Anggrek","60","BT","Kereta nyaman");
INSERT INTO transportation VALUES("BTAM01","Argo Muria","60","BT","Kereta nyaman");
INSERT INTO transportation VALUES("BTSM01","Sembrani","60","BT","Kereta paling menyenangkan");
INSERT INTO transportation VALUES("ENNA01","Nam Air","60","EP","Pesawat kelas ekonomi yang terjangkau");
INSERT INTO transportation VALUES("EPLA01","Lion Air","60","EP","Pesawat kelas ekonomi yang terjangkau dengan pelayanan yang tak diragukan");
INSERT INTO transportation VALUES("ETAR02","Argo Bromo","60","ET","Kereta kelas ekonomi");
INSERT INTO transportation VALUES("ETAS01","Argo Sindoro","60","ET","Kereta ekonomi");
INSERT INTO transportation VALUES("ETSJ01","Subur Jaya","60","ET","Kereta kelas ekonomi");





CREATE TABLE `transportation_type` (
  `kd_tt` varchar(6) NOT NULL,
  `description` varchar(40) NOT NULL,
  PRIMARY KEY (`kd_tt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO transportation_type VALUES("BP","Business Plane");
INSERT INTO transportation_type VALUES("BT","Business Train");
INSERT INTO transportation_type VALUES("EP","Economic Plane");
INSERT INTO transportation_type VALUES("ET","Economic Train");





CREATE TABLE `user` (
  `kd_user` varchar(6) NOT NULL,
  `nm_user` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('SA','AV') NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("U00001","Admin Tae","admin","$2y$10$eaacuEmsVjUDPnuafCrVHOFtCzvWZLTddpPiRirEH8FalN19vGYM6","SA");
INSERT INTO user VALUES("U00002","Lisa B","lisa","$2y$10$fA1wklKBe7yxfIyaIb1XYeycDEM.66ZWRWYp3C4CWloQFc6Yn1/BC","AV");



