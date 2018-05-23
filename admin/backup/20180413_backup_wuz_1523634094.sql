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

INSERT INTO place VALUES("GB","Gambir","Stasiun","Jakarta","Jl. Medan Merdeka Timur No. 1");
INSERT INTO place VALUES("PNC","Poncol","Stasiun","Semarang","");
INSERT INTO place VALUES("TW","Tawang","Stasiun","Semarang","Jl. Taman Tawang No. 1");





CREATE TABLE `reservation` (
  `kd_reservation` varchar(6) NOT NULL,
  `tgl` datetime NOT NULL,
  `kd_customer` varchar(6) NOT NULL,
  `kd_rute` varchar(6) NOT NULL,
  `jml_ticket` int(2) NOT NULL,
  `total_price` int(7) NOT NULL,
  `jenis_identitas` enum('KTP','Paspor') NOT NULL,
  `no_identitas` int(20) NOT NULL,
  `kd_user` varchar(6) NOT NULL,
  `pembayaran` enum('BCA','BRI','Mandiri','Indomaret','Alfamart') NOT NULL,
  `kd_pembayaran` varchar(6) NOT NULL,
  `status_pembayaran` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`kd_reservation`),
  KEY `kd_customer` (`kd_customer`),
  KEY `kd_rute` (`kd_rute`),
  KEY `kd_user` (`kd_user`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`kd_user`) REFERENCES `user` (`kd_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`kd_customer`) REFERENCES `customer` (`kd_customer`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `reservation_item` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_reservation` varchar(6) NOT NULL,
  `id_seat` int(3) NOT NULL,
  `jml` int(2) NOT NULL,
  `price` int(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seat` (`id_seat`),
  KEY `kd_reservation` (`kd_reservation`),
  CONSTRAINT `reservation_item_ibfk_1` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservation_item_ibfk_2` FOREIGN KEY (`kd_reservation`) REFERENCES `reservation` (`kd_reservation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






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






CREATE TABLE `seat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_seat` varchar(5) NOT NULL,
  `kd_transportation` varchar(6) NOT NULL,
  `status` enum('B','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`),
  KEY `kd_transportation` (`kd_transportation`),
  CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`kd_transportation`) REFERENCES `transportation` (`kd_transportation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO seat VALUES("1","A01G1","ETSJ01","F");
INSERT INTO seat VALUES("2","A02G1","ETSJ01","F");
INSERT INTO seat VALUES("3","A03G1","ETSJ01","F");
INSERT INTO seat VALUES("4","A04G1","ETSJ01","F");
INSERT INTO seat VALUES("5","A05G1","ETSJ01","F");
INSERT INTO seat VALUES("8","A06G1","ETSJ01","F");





CREATE TABLE `transportation` (
  `kd_transportation` varchar(6) NOT NULL,
  `nm_trans` varchar(30) NOT NULL,
  `seat_qty` int(3) NOT NULL,
  `kd_tt` varchar(6) NOT NULL,
  `description` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`kd_transportation`),
  KEY `kd_tt` (`kd_tt`),
  CONSTRAINT `transportation_ibfk_1` FOREIGN KEY (`kd_tt`) REFERENCES `transportation_type` (`kd_tt`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO transportation VALUES("BPGA01","Garuda","300","BP","Pesawat kelas bisnis");
INSERT INTO transportation VALUES("ETSJ01","Subur Jaya","300","ET","Kereta kelas ekonomi");





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



