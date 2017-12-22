/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.19-MariaDB : Database - aksapos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL AUTO_INCREMENT,
  `id_toko` int(12) DEFAULT NULL,
  `nama_admin` tinytext,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `foto` varchar(32) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `level` enum('Owner','Staff','Kasir') DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `id_toko` (`id_toko`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `tentang_toko` (`id_toko`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`id_toko`,`nama_admin`,`username`,`password`,`foto`,`no_hp`,`level`,`token`,`last_login`) values (1,NULL,'Ridlo Fadlli','admin','ef690437b31298621e42641bbe87862e','720160922142900.png',NULL,'Owner','c4ca4238a0b923820dcc509a6f75849b','2017-05-11 09:01:27');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(12) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(12) DEFAULT NULL,
  `kd_barang` varchar(15) DEFAULT NULL,
  `nama_barang` tinytext,
  `harga_beli` float DEFAULT NULL,
  `harga_jual` float DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `barang_kategori` (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`id_kategori`,`kd_barang`,`nama_barang`,`harga_beli`,`harga_jual`,`stok`) values (1,1,'SF-001','Softcase Samsung J1',25000,40000,14),(2,1,'SF-002','Softcase Samsung J2',35000,50000,16),(3,1,'SF-003','Softcase Samsung Galaxy Grand',37500,60000,9),(4,1,'SF-004','Softcase Samsung Galaxy S1',10000,60000,6),(5,1,'SF-005','Softcase Samsung Galaxy S7',69000,100000,2);

/*Table structure for table `barang_kategori` */

DROP TABLE IF EXISTS `barang_kategori`;

CREATE TABLE `barang_kategori` (
  `id_kategori` int(12) NOT NULL AUTO_INCREMENT,
  `nama_kategori` tinytext,
  `status_kategori` enum('A','T','D') DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `barang_kategori` */

insert  into `barang_kategori`(`id_kategori`,`nama_kategori`,`status_kategori`) values (1,'Softcase','A'),(2,'Headset','A');

/*Table structure for table `kas` */

DROP TABLE IF EXISTS `kas`;

CREATE TABLE `kas` (
  `id_trans_kas` int(12) NOT NULL AUTO_INCREMENT,
  `tipe` enum('Pengeluaran','Pemasukan') DEFAULT NULL,
  `keterangan` text,
  `jumlah` float DEFAULT NULL,
  `id_admin` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_trans_kas`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `kas_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kas` */

/*Table structure for table `tentang_toko` */

DROP TABLE IF EXISTS `tentang_toko`;

CREATE TABLE `tentang_toko` (
  `id_toko` int(12) NOT NULL AUTO_INCREMENT,
  `nama_toko` tinytext,
  `alamat` text,
  `logo` varchar(15) DEFAULT NULL,
  `nama_pemilik` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tentang_toko` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(12) NOT NULL AUTO_INCREMENT,
  `wkt_transaksi` datetime DEFAULT NULL,
  `id_pelanggan` int(12) DEFAULT NULL,
  `harga_total` float DEFAULT NULL,
  `jum_uang` float DEFAULT NULL,
  `kembalian` float DEFAULT NULL,
  `status` enum('1','0','9') DEFAULT NULL COMMENT '1= Lunas, 0=Belum Lunas, 9=Hapus',
  `id_admin` int(12) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_admin` (`id_admin`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `id_detail_transaksi` int(12) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(12) DEFAULT NULL,
  `id_barang` int(12) DEFAULT NULL,
  `qty` float DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `sub_total` float DEFAULT NULL,
  PRIMARY KEY (`id_detail_transaksi`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `transaksi_detail_ibfk_2` (`id_barang`),
  CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
