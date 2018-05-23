DROP TABLE beli;

CREATE TABLE `beli` (
  `id_beli` int(5) NOT NULL AUTO_INCREMENT,
  `kd_barang` int(5) DEFAULT NULL,
  `nm` varchar(9) DEFAULT NULL,
  `jml` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_beli`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `beli_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `stok` (`kd_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO beli VALUES("1","56","mijon","60");
INSERT INTO beli VALUES("2","56","mijon","30");



DROP TABLE cb;

CREATE TABLE `cb` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(21) NOT NULL,
  `harga` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

INSERT INTO cb VALUES("1","bubu","3000");
INSERT INTO cb VALUES("2","bul","4000");
INSERT INTO cb VALUES("24","bubu","3000");
INSERT INTO cb VALUES("25","bul","4000");
INSERT INTO cb VALUES("26","bubu,3000","0");
INSERT INTO cb VALUES("27","bul,4000","0");
INSERT INTO cb VALUES("28","bubu","3000");
INSERT INTO cb VALUES("29","bul","4000");
INSERT INTO cb VALUES("30","bb","9");
INSERT INTO cb VALUES("31","j","90");
INSERT INTO cb VALUES("32","bb;9","0");
INSERT INTO cb VALUES("33","j;90","0");
INSERT INTO cb VALUES("34","bb;9","0");
INSERT INTO cb VALUES("35","j;123000000000","0");
INSERT INTO cb VALUES("36","j","90");
INSERT INTO cb VALUES("37","j","90");
INSERT INTO cb VALUES("38","j","90");
INSERT INTO cb VALUES("39","j","90");
INSERT INTO cb VALUES("40","j","90");
INSERT INTO cb VALUES("41","j","90");
INSERT INTO cb VALUES("42","j","90");
INSERT INTO cb VALUES("43","j","90");
INSERT INTO cb VALUES("44","j","90");
INSERT INTO cb VALUES("45","j","90");
INSERT INTO cb VALUES("46","j","90");
INSERT INTO cb VALUES("47","bb","9");
INSERT INTO cb VALUES("48","j","90");
INSERT INTO cb VALUES("49","coba","5000");
INSERT INTO cb VALUES("50","bu","9000");
INSERT INTO cb VALUES("51","cobaaa","5000");
INSERT INTO cb VALUES("52","bu","9000");
INSERT INTO cb VALUES("53","coba;5000","0");
INSERT INTO cb VALUES("54","bu;9000","0");
INSERT INTO cb VALUES("55","coba","5000");
INSERT INTO cb VALUES("56","bu","9000");
INSERT INTO cb VALUES("57","","0");
INSERT INTO cb VALUES("58","bb","9");
INSERT INTO cb VALUES("59","cobaxx","5000");
INSERT INTO cb VALUES("60","bu","9000");



DROP TABLE kurang;

CREATE TABLE `kurang` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kd_barang` int(5) NOT NULL,
  `nm` varchar(10) NOT NULL,
  `jml` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kd_barang` (`kd_barang`),
  CONSTRAINT `kurang_ibfk_1` FOREIGN KEY (`kd_barang`) REFERENCES `stok` (`kd_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO kurang VALUES("1","56","mijon","5");



DROP TABLE stok;

CREATE TABLE `stok` (
  `kd_barang` int(5) NOT NULL,
  `jml` int(9) NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO stok VALUES("56","85");
INSERT INTO stok VALUES("76","0");



DROP TABLE tb_guru;

CREATE TABLE `tb_guru` (
  `nip` varchar(12) NOT NULL,
  `nm_guru` varchar(20) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_guru VALUES("2147483647","Yanti");
INSERT INTO tb_guru VALUES("7723777772","Lian");
INSERT INTO tb_guru VALUES("7878676677","Fia");



DROP TABLE tb_keluarga;

CREATE TABLE `tb_keluarga` (
  `kd_keluarga` varchar(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jml_anak` int(2) NOT NULL,
  PRIMARY KEY (`kd_keluarga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_keluarga VALUES("AA01","Rudi","2");
INSERT INTO tb_keluarga VALUES("AA02","Arni","1");
INSERT INTO tb_keluarga VALUES("AA03","Taufan","2");
INSERT INTO tb_keluarga VALUES("AA04","Fizhy","3");
INSERT INTO tb_keluarga VALUES("AA05","Rikha","3");



DROP TABLE tb_mapel;

CREATE TABLE `tb_mapel` (
  `kd_mapel` int(2) NOT NULL,
  `nm_mapel` varchar(10) NOT NULL,
  `nip` varchar(12) NOT NULL,
  PRIMARY KEY (`kd_mapel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_mapel VALUES("1","IPA","2147483647");
INSERT INTO tb_mapel VALUES("2","Matematika","7723777772");
INSERT INTO tb_mapel VALUES("3","Agama","7878676677");



DROP TABLE tb_siswa;

CREATE TABLE `tb_siswa` (
  `nis` int(4) NOT NULL,
  `nm_siswa` varchar(30) NOT NULL,
  `jk` enum('P','L') NOT NULL,
  `umur` int(2) DEFAULT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tb_siswa VALUES("7475","Bharlian Nandha","L","15");
INSERT INTO tb_siswa VALUES("7476","Rhizky Ardiyanti","P","16");
INSERT INTO tb_siswa VALUES("7477","Harahap","L","15");
INSERT INTO tb_siswa VALUES("7478","Jazel Azzamy","L","16");
INSERT INTO tb_siswa VALUES("7480","Liana","P","17");



