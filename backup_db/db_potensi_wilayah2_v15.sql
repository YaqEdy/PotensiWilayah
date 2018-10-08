/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_pw
Target Host: localhost
Target Database: db_pw
Date: 10/8/2018 8:50:30 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for closing_perk
-- ----------------------------
CREATE TABLE `closing_perk` (
  `kode_perk` char(20) NOT NULL,
  `saldo_awal` decimal(17,2) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for dashboard_table
-- ----------------------------
CREATE TABLE `dashboard_table` (
  `id_kec` varchar(20) DEFAULT '',
  `id_kel` varchar(20) DEFAULT '',
  `nama_kec` varchar(45) DEFAULT '',
  `nama_kel` varchar(45) DEFAULT '',
  `jml_su` int(11) DEFAULT '0',
  `jml_komunitas` int(11) DEFAULT '0',
  `jml_pasar` int(11) DEFAULT '0',
  `jml_lkm` int(11) DEFAULT '0',
  `jml_kk` int(11) DEFAULT '0',
  `jml_warga` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for dashboard_total
-- ----------------------------
CREATE TABLE `dashboard_total` (
  `id_jenis_entitas` tinyint(2) NOT NULL COMMENT '0 = sentra usaba, 1 = komunitas, 2= pasar, 3= lk, 4 = kk, 5 = warga ',
  `jumlah` int(11) DEFAULT '0',
  PRIMARY KEY (`id_jenis_entitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for integrasi_jurnal
-- ----------------------------
CREATE TABLE `integrasi_jurnal` (
  `id_integrasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_integrasi` char(50) NOT NULL DEFAULT '',
  `kode_perk` char(25) NOT NULL DEFAULT '',
  `keterangan` char(70) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_integrasi`),
  UNIQUE KEY `nama_integrasi` (`nama_integrasi`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for jenis_transaksi
-- ----------------------------
CREATE TABLE `jenis_transaksi` (
  `id_jns_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jns_transaksi` char(50) NOT NULL DEFAULT '',
  `kode_perk` char(25) NOT NULL DEFAULT '',
  `keterangan` char(70) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_jns_transaksi`),
  UNIQUE KEY `nama_integrasi` (`nama_jns_transaksi`),
  UNIQUE KEY `kode_perk` (`kode_perk`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for master_agen
-- ----------------------------
CREATE TABLE `master_agen` (
  `id_agen` char(6) NOT NULL DEFAULT '',
  `nama_agen` char(30) DEFAULT '',
  `alamat` char(100) DEFAULT '',
  `telp` char(16) DEFAULT '',
  `kode_perk` char(20) DEFAULT '',
  `keterangan` char(20) DEFAULT '',
  `status_aktif` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_agen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for master_customer
-- ----------------------------
CREATE TABLE `master_customer` (
  `id_cust` char(6) NOT NULL DEFAULT '',
  `nama_cust` char(60) NOT NULL DEFAULT '',
  `alamat` char(100) NOT NULL DEFAULT '',
  `telp` char(16) NOT NULL DEFAULT '',
  `kode_perk` char(16) NOT NULL DEFAULT '',
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cust`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for master_dept
-- ----------------------------
CREATE TABLE `master_dept` (
  `id_dept` char(6) NOT NULL,
  `nama_dept` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_jeniskomunitas
-- ----------------------------
CREATE TABLE `master_jeniskomunitas` (
  `id_jeniskomunitas` char(6) NOT NULL,
  `nama_jeniskomunitas` varchar(45) DEFAULT '',
  PRIMARY KEY (`id_jeniskomunitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_jenislk
-- ----------------------------
CREATE TABLE `master_jenislk` (
  `id_jenislk` char(6) NOT NULL,
  `nama_jenislk` varchar(45) DEFAULT '',
  PRIMARY KEY (`id_jenislk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_jenissentra
-- ----------------------------
CREATE TABLE `master_jenissentra` (
  `id_jenissentra` char(6) NOT NULL,
  `nama_jenissentra` varchar(45) DEFAULT '',
  PRIMARY KEY (`id_jenissentra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_jns_produk
-- ----------------------------
CREATE TABLE `master_jns_produk` (
  `id_jns_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jns_produk` char(50) NOT NULL DEFAULT '',
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_jns_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_karyawan
-- ----------------------------
CREATE TABLE `master_karyawan` (
  `id_kyw` char(6) NOT NULL,
  `nama_kyw` char(50) DEFAULT '0',
  `dept_kyw` char(50) DEFAULT '0',
  `nama_akun_bank` char(50) DEFAULT '',
  `no_akun_bank` char(50) DEFAULT '',
  `nama_bank` char(50) DEFAULT '',
  `kode_perk` char(50) DEFAULT '',
  PRIMARY KEY (`id_kyw`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_kecamatan
-- ----------------------------
CREATE TABLE `master_kecamatan` (
  `id_kec` char(10) NOT NULL DEFAULT '',
  `nama_kec` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_kelurahan
-- ----------------------------
CREATE TABLE `master_kelurahan` (
  `id_kel` char(16) NOT NULL DEFAULT '',
  `id_kec` char(12) NOT NULL DEFAULT '',
  `nama_kel` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_kel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_kk
-- ----------------------------
CREATE TABLE `master_kk` (
  `id_kk` char(30) NOT NULL DEFAULT '',
  `id_kepalakeluarga` char(30) NOT NULL DEFAULT '',
  `nama_kepalakeluarga` varchar(45) DEFAULT '',
  `jml_anggota_keluarga` int(2) DEFAULT '0',
  PRIMARY KEY (`id_kk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_komunitas
-- ----------------------------
CREATE TABLE `master_komunitas` (
  `id_komunitas` char(6) NOT NULL,
  `nama_komunitas` varchar(45) DEFAULT '',
  `alamat` varchar(45) DEFAULT '',
  `id_kec` varchar(45) DEFAULT '',
  `id_kel` varchar(45) DEFAULT '',
  `nama_koordinator` varchar(45) DEFAULT '',
  `no_telp` char(20) DEFAULT '',
  `id_jeniskomunitas` char(6) DEFAULT '000001',
  PRIMARY KEY (`id_komunitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_ktp
-- ----------------------------
CREATE TABLE `master_ktp` (
  `id_ktp` char(25) NOT NULL DEFAULT '',
  `nama_ktp` char(50) NOT NULL DEFAULT '',
  `tempat_lahir` char(45) DEFAULT '',
  `tanggal_lahir` date DEFAULT '1970-01-01',
  `jekel` tinyint(1) DEFAULT '0' COMMENT '0 pria 1 wanita',
  `gol_darah` char(1) DEFAULT '-',
  `alamat` varchar(45) DEFAULT '',
  `rt` char(3) DEFAULT '',
  `rw` char(3) DEFAULT '',
  `id_kel` char(10) DEFAULT '',
  `id_kec` char(10) DEFAULT '',
  `agama` tinyint(1) DEFAULT '0' COMMENT '0 islam, 1 khatolik, 2 kristen, 3 hindu, 4 budha, 5 lain',
  `status_kawin` tinyint(1) DEFAULT '0' COMMENT '0 blm 1 sudah',
  `pekerjaan` char(10) DEFAULT NULL,
  `id_difabel` varchar(10) DEFAULT NULL,
  `id_pend` varchar(10) DEFAULT NULL,
  `warga_negara` char(45) DEFAULT '',
  `link_gambar` varchar(100) DEFAULT NULL,
  `is_delete` char(1) DEFAULT '1',
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_ktp_kk_temp
-- ----------------------------
CREATE TABLE `master_ktp_kk_temp` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `idsession` varchar(50) DEFAULT NULL,
  `id_ktp` varchar(50) DEFAULT NULL,
  `nama_ktp` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(50) DEFAULT '1970-01-01',
  `jekel` varchar(50) DEFAULT '0' COMMENT '0 pria 1 wanita',
  `gol_darah` varchar(50) DEFAULT '-',
  `alamat` varchar(50) DEFAULT NULL,
  `rt` varchar(50) DEFAULT NULL,
  `rw` varchar(50) DEFAULT NULL,
  `id_kel` varchar(50) DEFAULT NULL,
  `id_kec` varchar(50) DEFAULT NULL,
  `agama` varchar(50) DEFAULT '0' COMMENT '0 islam, 1 khatolik, 2 kristen, 3 hindu, 4 budha, 5 lain',
  `status_kawin` varchar(50) DEFAULT '0' COMMENT '0 blm 1 sudah',
  `pekerjaan` varchar(50) DEFAULT NULL,
  `id_difabel` varchar(50) DEFAULT NULL,
  `id_pend` varchar(50) DEFAULT NULL,
  `warga_negara` varchar(50) DEFAULT NULL,
  `link_gambar` varchar(100) DEFAULT NULL,
  `is_delete` varchar(50) DEFAULT '1',
  `id_master_kk` varchar(50) DEFAULT NULL,
  `hub_keluarga` varchar(50) DEFAULT NULL,
  `no_paspor` varchar(50) DEFAULT NULL,
  `no_kitap` varchar(50) DEFAULT NULL,
  `ayah` varchar(50) DEFAULT NULL,
  `ibu` varchar(50) DEFAULT NULL,
  `rumah_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_layanan
-- ----------------------------
CREATE TABLE `master_layanan` (
  `id_layanan` int(2) NOT NULL AUTO_INCREMENT,
  `nama_layanan` char(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_lkm
-- ----------------------------
CREATE TABLE `master_lkm` (
  `id_lkm` char(6) NOT NULL,
  `nama_lkm` varchar(45) DEFAULT '',
  `id_kec` varchar(45) DEFAULT '',
  `id_kel` varchar(45) DEFAULT '',
  `jml_aset` decimal(20,2) DEFAULT '0.00',
  PRIMARY KEY (`id_lkm`),
  UNIQUE KEY `jml_aset_UNIQUE` (`jml_aset`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_outsource
-- ----------------------------
CREATE TABLE `master_outsource` (
  `id_outsource` char(6) NOT NULL DEFAULT '',
  `nama_outsource` char(30) DEFAULT '',
  `alamat` char(100) DEFAULT '',
  `telp` char(16) DEFAULT '',
  `kode_perk` char(20) DEFAULT '',
  `keterangan` char(20) DEFAULT '',
  `status_aktif` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_outsource`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for master_pasar
-- ----------------------------
CREATE TABLE `master_pasar` (
  `id_pasar` char(6) NOT NULL,
  `nama_pasar` varchar(45) DEFAULT '',
  `id_kec` varchar(45) DEFAULT '',
  `id_kel` varchar(45) DEFAULT '',
  `jml_pedagang` int(11) DEFAULT '0',
  PRIMARY KEY (`id_pasar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_produk
-- ----------------------------
CREATE TABLE `master_produk` (
  `id_produk` char(10) NOT NULL,
  `nama_produk` varchar(50) NOT NULL DEFAULT '',
  `harga1` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'cuci setrika biasa',
  `harga2` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'cuci setrika express',
  `harga3` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'setrika saja biasa',
  `harga4` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'setrika saja express',
  `harga5` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'cuci aja biasa',
  `harga6` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'cuci aja express',
  `harga7` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'dryclean',
  `keterangan` char(50) NOT NULL DEFAULT '',
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_service
-- ----------------------------
CREATE TABLE `master_service` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `nama_service` char(50) NOT NULL DEFAULT '',
  `status_aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for master_su
-- ----------------------------
CREATE TABLE `master_su` (
  `id_su` char(6) NOT NULL,
  `nama_su` varchar(45) DEFAULT '',
  `alamat` varchar(45) DEFAULT '',
  `id_kec` varchar(45) DEFAULT '',
  `id_kel` varchar(45) DEFAULT '',
  `nama_koordinator` varchar(45) DEFAULT '',
  `no_telp` char(20) DEFAULT '',
  `id_jenissentra` char(6) DEFAULT '',
  PRIMARY KEY (`id_su`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for master_supplier
-- ----------------------------
CREATE TABLE `master_supplier` (
  `id_spl` char(6) NOT NULL DEFAULT '',
  `nama_spl` char(30) DEFAULT NULL,
  `alamat` char(100) DEFAULT NULL,
  `telp` char(16) DEFAULT NULL,
  `npwp` char(20) DEFAULT NULL,
  PRIMARY KEY (`id_spl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for perkiraan
-- ----------------------------
CREATE TABLE `perkiraan` (
  `kode_perk` char(20) NOT NULL DEFAULT '',
  `kode_alt` char(20) DEFAULT NULL,
  `nama_perk` varchar(255) DEFAULT NULL,
  `kode_induk` varchar(50) NOT NULL DEFAULT '',
  `level` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `dk` char(1) NOT NULL DEFAULT '',
  `saldo_awal` decimal(17,2) NOT NULL DEFAULT '0.00',
  `saldo_debet` decimal(15,2) NOT NULL DEFAULT '0.00',
  `saldo_kredit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `saldo_akhir` decimal(17,2) NOT NULL DEFAULT '0.00',
  `flag_pl` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_perk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for perkiraan_old
-- ----------------------------
CREATE TABLE `perkiraan_old` (
  `kode_perk` char(20) NOT NULL DEFAULT '',
  `kode_alt` char(20) DEFAULT NULL,
  `nama_perk` varchar(255) DEFAULT NULL,
  `kode_induk` varchar(50) NOT NULL DEFAULT '',
  `level` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `dk` char(1) NOT NULL DEFAULT '',
  `saldo_awal` decimal(17,2) NOT NULL DEFAULT '0.00',
  `saldo_debet` decimal(15,2) NOT NULL DEFAULT '0.00',
  `saldo_kredit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `saldo_akhir` decimal(17,2) NOT NULL DEFAULT '0.00',
  `flag_pl` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_perk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sec_menu
-- ----------------------------
CREATE TABLE `sec_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(250) NOT NULL DEFAULT '',
  `menu_uri` varchar(250) NOT NULL DEFAULT '',
  `menu_header` varchar(250) NOT NULL DEFAULT '',
  `menu_allowed` varchar(100) NOT NULL DEFAULT '',
  `menu_seq` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) DEFAULT '0',
  `lvl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for sec_menu_old
-- ----------------------------
CREATE TABLE `sec_menu_old` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_nama` varchar(250) NOT NULL DEFAULT '',
  `menu_uri` varchar(250) NOT NULL DEFAULT '',
  `menu_header` varchar(250) NOT NULL DEFAULT '',
  `menu_allowed` varchar(100) NOT NULL DEFAULT '',
  `menu_seq` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) DEFAULT '0',
  `lvl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for sec_passwd
-- ----------------------------
CREATE TABLE `sec_passwd` (
  `userid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '0',
  `id_kyw` char(6) NOT NULL DEFAULT '0',
  `password` char(40) NOT NULL DEFAULT '0',
  `status_password` tinyint(2) DEFAULT '0',
  `tgl_password` date NOT NULL,
  `usergroup` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sec_passwd_new
-- ----------------------------
CREATE TABLE `sec_passwd_new` (
  `userid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '0',
  `id_kyw` char(6) NOT NULL DEFAULT '0',
  `password` char(40) NOT NULL DEFAULT '0',
  `status_password` tinyint(2) DEFAULT '0',
  `tgl_password` date NOT NULL,
  `usergroup` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for sec_usergroup
-- ----------------------------
CREATE TABLE `sec_usergroup` (
  `usergroup_id` int(3) NOT NULL DEFAULT '0',
  `usergroup_desc` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for setting_laporan
-- ----------------------------
CREATE TABLE `setting_laporan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pt` char(50) DEFAULT '"',
  `kantor` varchar(100) DEFAULT '"',
  `alamat` varchar(200) DEFAULT '"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for tbl_m_agama
-- ----------------------------
CREATE TABLE `tbl_m_agama` (
  `id_agama` tinyint(1) NOT NULL,
  `nama_agama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_difabel
-- ----------------------------
CREATE TABLE `tbl_m_difabel` (
  `id_difabel` char(10) NOT NULL,
  `nama_difabel` varchar(45) NOT NULL,
  PRIMARY KEY (`id_difabel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_instansi
-- ----------------------------
CREATE TABLE `tbl_m_instansi` (
  `id_instansi` char(10) NOT NULL,
  `nama_instansi` varchar(45) NOT NULL,
  PRIMARY KEY (`id_instansi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_pekerjaan
-- ----------------------------
CREATE TABLE `tbl_m_pekerjaan` (
  `id_pekerjaan` char(10) NOT NULL,
  `nama_pekerjaan` varchar(45) NOT NULL,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_pend_formal
-- ----------------------------
CREATE TABLE `tbl_m_pend_formal` (
  `id_pen_formal` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_ktp` char(25) DEFAULT NULL,
  `id_pend` int(11) DEFAULT NULL,
  `thn_masuk` char(4) DEFAULT NULL,
  `thn_lulus` char(4) DEFAULT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pen_formal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_pend_formal_temp
-- ----------------------------
CREATE TABLE `tbl_m_pend_formal_temp` (
  `id_pen_formal` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_ktp` varchar(50) DEFAULT NULL,
  `id_pend` varchar(50) DEFAULT NULL,
  `thn_masuk` varchar(50) DEFAULT NULL,
  `thn_lulus` varchar(50) DEFAULT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pen_formal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_pend_non_formal
-- ----------------------------
CREATE TABLE `tbl_m_pend_non_formal` (
  `id_pend_non_formal` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_ktp` char(25) DEFAULT NULL,
  `nama_pend` varchar(100) DEFAULT NULL,
  `jenis_pend` varchar(50) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pend_non_formal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_pend_non_formal_temp
-- ----------------------------
CREATE TABLE `tbl_m_pend_non_formal_temp` (
  `id_pend_non_formal` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_ktp` varchar(50) DEFAULT NULL,
  `nama_pend` varchar(100) DEFAULT NULL,
  `jenis_pend` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pend_non_formal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_rumah
-- ----------------------------
CREATE TABLE `tbl_m_rumah` (
  `id_ft_rumah` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_master_kk` varchar(30) DEFAULT NULL,
  `rumah_path` varchar(100) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ft_rumah`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_m_rumah_temp
-- ----------------------------
CREATE TABLE `tbl_m_rumah_temp` (
  `id_ft_rumah` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_master_kk` varchar(30) DEFAULT NULL,
  `rumah_path` varchar(100) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_ft_rumah`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_r_hub_kel
-- ----------------------------
CREATE TABLE `tbl_r_hub_kel` (
  `id_hub_kel` tinyint(1) NOT NULL,
  `nama_hub_kel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_hub_kel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_r_jns_bantuan
-- ----------------------------
CREATE TABLE `tbl_r_jns_bantuan` (
  `id_jns_bantuan` int(11) NOT NULL,
  `jns_bantuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jns_bantuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_r_pendidikan
-- ----------------------------
CREATE TABLE `tbl_r_pendidikan` (
  `id_pend` tinyint(1) NOT NULL,
  `nama_pend` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pend`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_r_status_nikah
-- ----------------------------
CREATE TABLE `tbl_r_status_nikah` (
  `id_nikah` tinyint(1) NOT NULL,
  `nama_nikah` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_nikah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_t_anggota_komunitas
-- ----------------------------
CREATE TABLE `tbl_t_anggota_komunitas` (
  `id_anggota_komunitas` tinyint(11) NOT NULL AUTO_INCREMENT,
  `id_komunitas` varchar(45) DEFAULT NULL,
  `id_ktp` char(25) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_anggota_komunitas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_t_anggota_komunitas_temp
-- ----------------------------
CREATE TABLE `tbl_t_anggota_komunitas_temp` (
  `id_anggota_komunitas_temp` tinyint(11) NOT NULL AUTO_INCREMENT,
  `id_ktp` char(25) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_anggota_komunitas_temp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_t_bantuan
-- ----------------------------
CREATE TABLE `tbl_t_bantuan` (
  `id_t_bantuan` tinyint(4) NOT NULL AUTO_INCREMENT,
  `idsession` varchar(50) DEFAULT NULL,
  `id_jns_bantuan` char(11) DEFAULT NULL,
  `id_m_instansi` char(10) DEFAULT NULL,
  `id_ktp` char(25) DEFAULT NULL,
  `tgl_bantuan` date DEFAULT NULL,
  `nama_bantuan` varchar(50) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `last_update_by` varchar(50) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_t_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_t_bantuan_temp
-- ----------------------------
CREATE TABLE `tbl_t_bantuan_temp` (
  `id_t_bantuan` tinyint(4) NOT NULL AUTO_INCREMENT,
  `idsession` varchar(50) DEFAULT NULL,
  `id_jns_bantuan` char(11) DEFAULT NULL,
  `id_m_instansi` char(10) DEFAULT NULL,
  `id_ktp` char(25) DEFAULT NULL,
  `tgl_bantuan` date DEFAULT NULL,
  `nama_bantuan` varchar(50) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_t_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_t_difabel
-- ----------------------------
CREATE TABLE `tbl_t_difabel` (
  `id_t_difabel` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_ktp` char(25) DEFAULT NULL,
  `id_m_difabel` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_t_difabel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trans_kk
-- ----------------------------
CREATE TABLE `trans_kk` (
  `idtrans_kk` int(11) NOT NULL AUTO_INCREMENT,
  `id_master_kk` char(30) NOT NULL DEFAULT '',
  `id_ktp` varchar(20) DEFAULT '',
  `pendidikan` tinyint(1) DEFAULT '0' COMMENT '0 blm sekolah, 1 sd, 2 smp, 3 sma, 4 d3, 5 s1, 6 s2, 7 s3, 8 prof',
  `hub_keluarga` tinyint(1) DEFAULT '0' COMMENT '0 kk, 1 isteri, 2 anak',
  `no_paspor` varchar(45) DEFAULT '',
  `no_kitap` varchar(45) DEFAULT '',
  `ayah` varchar(45) DEFAULT '',
  `ibu` varchar(45) DEFAULT '',
  `rumah_path` varchar(100) DEFAULT NULL,
  `idsession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idtrans_kk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for web_log
-- ----------------------------
CREATE TABLE `web_log` (
  `id_log` char(20) NOT NULL,
  `waktu` datetime DEFAULT NULL,
  `user_id` char(10) DEFAULT '0',
  `menu_id` bigint(20) DEFAULT '0',
  `action` char(20) DEFAULT '',
  `keterangan` varchar(200) DEFAULT '',
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for web_sysid
-- ----------------------------
CREATE TABLE `web_sysid` (
  `id_sysid` int(11) NOT NULL AUTO_INCREMENT,
  `keyname` char(80) NOT NULL DEFAULT '',
  `value` char(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_sysid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- View structure for vw_anggota_kel_temp
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_anggota_kel_temp` AS select `a`.`id` AS `id`,`a`.`idsession` AS `idsession`,`a`.`id_ktp` AS `id_ktp`,`a`.`nama_ktp` AS `nama_ktp`,`a`.`tempat_lahir` AS `tempat_lahir`,date_format(`a`.`tanggal_lahir`,'%d-%m-%Y') AS `tanggal_lahir`,`a`.`jekel` AS `jekel`,`a`.`gol_darah` AS `gol_darah`,`b`.`nama_agama` AS `nama_agama`,`c`.`nama_nikah` AS `nama_nikah`,`d`.`nama_pekerjaan` AS `nama_pekerjaan`,`e`.`nama_hub_kel` AS `nama_hub_kel`,`f`.`nama_difabel` AS `nama_difabel`,`g`.`nama_pend` AS `nama_pend` from ((((((`master_ktp_kk_temp` `a` join `tbl_m_agama` `b` on((`a`.`agama` = `b`.`id_agama`))) join `tbl_r_status_nikah` `c` on((`a`.`status_kawin` = `c`.`id_nikah`))) join `tbl_m_pekerjaan` `d` on((`a`.`pekerjaan` = `d`.`id_pekerjaan`))) join `tbl_r_hub_kel` `e` on((`a`.`hub_keluarga` = `e`.`id_hub_kel`))) left join `tbl_m_difabel` `f` on((`a`.`id_difabel` = `f`.`id_difabel`))) left join `tbl_r_pendidikan` `g` on((`a`.`id_pend` = `g`.`id_pend`)));

-- ----------------------------
-- View structure for vw_kk
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_kk` AS select `b`.`id_master_kk` AS `id_master_kk`,`b`.`id_ktp` AS `id_ktp`,`a`.`nama_ktp` AS `nama_ktp`,`c`.`nama_kec` AS `nama_kec`,`d`.`nama_kel` AS `nama_kel`,`a`.`rt` AS `rt`,`a`.`rw` AS `rw`,`a`.`id_kec` AS `id_kec`,`a`.`id_kel` AS `id_kel`,`a`.`alamat` AS `alamat`,`b`.`rumah_path` AS `rumah_path`,`b`.`hub_keluarga` AS `hub_keluarga`,`b`.`idsession` AS `idsession`,(select count(1) from (`trans_kk` `z` join `master_ktp` `x` on((`z`.`id_ktp` = `x`.`id_ktp`))) where ((`z`.`id_master_kk` = `b`.`id_master_kk`) and (`x`.`is_delete` = 0))) AS `jml_anggota_keluarga` from (((`master_ktp` `a` join `trans_kk` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) join `master_kecamatan` `c` on((`a`.`id_kec` = `c`.`id_kec`))) join `master_kelurahan` `d` on((`a`.`id_kel` = `d`.`id_kel`)));

-- ----------------------------
-- View structure for vw_komunitas
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_komunitas` AS select `master_komunitas`.`id_komunitas` AS `id_komunitas`,`master_komunitas`.`nama_komunitas` AS `nama_komunitas`,`master_komunitas`.`alamat` AS `alamat`,`master_komunitas`.`id_kec` AS `id_kec`,`master_komunitas`.`id_kel` AS `id_kel`,`master_komunitas`.`nama_koordinator` AS `nama_koordinator`,`master_komunitas`.`no_telp` AS `no_telp`,`master_komunitas`.`id_jeniskomunitas` AS `id_jeniskomunitas`,`master_jeniskomunitas`.`nama_jeniskomunitas` AS `nama_jeniskomunitas`,`master_ktp`.`id_ktp` AS `id_ktp`,`master_ktp`.`nama_ktp` AS `nama_ktp` from (((`master_komunitas` join `tbl_t_anggota_komunitas` on((`master_komunitas`.`id_komunitas` = `tbl_t_anggota_komunitas`.`id_komunitas`))) join `master_ktp` on((`tbl_t_anggota_komunitas`.`id_ktp` = `master_ktp`.`id_ktp`))) join `master_jeniskomunitas` on((`master_komunitas`.`id_jeniskomunitas` = `master_jeniskomunitas`.`id_jeniskomunitas`)));

-- ----------------------------
-- View structure for vw_t_bantuan
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_bantuan` AS select `a`.`id_t_bantuan` AS `id_t_bantuan`,`a`.`id_jns_bantuan` AS `id_jns_bantuan`,`d`.`jns_bantuan` AS `jns_bantuan`,`a`.`id_m_instansi` AS `id_m_instansi`,`b`.`nama_instansi` AS `nama_instansi`,`a`.`id_ktp` AS `id_ktp`,`a`.`nama_bantuan` AS `nama_bantuan`,`a`.`ket` AS `ket`,date_format(`a`.`tgl_bantuan`,'%d-%m-%Y') AS `tgl_bantuan`,`a`.`idsession` AS `idsession`,`c`.`nama_ktp` AS `nama_ktp`,`c`.`tempat_lahir` AS `tempat_lahir`,`c`.`tanggal_lahir` AS `tanggal_lahir`,`c`.`jekel` AS `jekel`,`c`.`gol_darah` AS `gol_darah`,`c`.`alamat` AS `alamat`,`c`.`rt` AS `rt`,`c`.`rw` AS `rw`,`c`.`id_kel` AS `id_kel`,`c`.`id_kec` AS `id_kec`,`c`.`agama` AS `agama`,`c`.`status_kawin` AS `status_kawin`,`c`.`pekerjaan` AS `pekerjaan`,`c`.`warga_negara` AS `warga_negara`,`c`.`link_gambar` AS `link_gambar`,`c`.`is_delete` AS `is_delete` from (((`tbl_t_bantuan` `a` join `tbl_m_instansi` `b` on((`a`.`id_m_instansi` = `b`.`id_instansi`))) join `master_ktp` `c` on((`a`.`id_ktp` = `c`.`id_ktp`))) left join `tbl_r_jns_bantuan` `d` on((`a`.`id_jns_bantuan` = `d`.`id_jns_bantuan`)));

-- ----------------------------
-- View structure for vw_pend_non_formal
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pend_non_formal` AS select `a`.`id_pend_non_formal` AS `id_pend_non_formal`,`a`.`id_ktp` AS `id_ktp`,`a`.`nama_pend` AS `nama_pend`,`a`.`jenis_pend` AS `jenis_pend`,`a`.`tahun` AS `tahun`,`a`.`ket` AS `ket`,`a`.`instansi` AS `instansi`,`a`.`idsession` AS `idsession`,`b`.`nama_ktp` AS `nama_ktp`,`c`.`nama_instansi` AS `nama_instansi`,`b`.`jekel` AS `jekel`,`b`.`tanggal_lahir` AS `tanggal_lahir`,`d`.`id_jns_bantuan` AS `id_jns_bantuan`,`d`.`jns_bantuan` AS `jns_bantuan` from (((`tbl_m_pend_non_formal` `a` join `master_ktp` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) join `tbl_m_instansi` `c` on((`a`.`instansi` = `c`.`id_instansi`))) left join `vw_t_bantuan` `d` on((`a`.`id_ktp` = `d`.`id_ktp`)));

-- ----------------------------
-- View structure for vw_pend_non_formal_temp
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_pend_non_formal_temp` AS select `a`.`id_pend_non_formal` AS `id_pend_non_formal`,`a`.`id_ktp` AS `id_ktp`,`a`.`nama_pend` AS `nama_pend`,`a`.`jenis_pend` AS `jenis_pend`,`a`.`tahun` AS `tahun`,`a`.`ket` AS `ket`,`a`.`instansi` AS `instansi`,`a`.`idsession` AS `idsession`,`b`.`nama_ktp` AS `nama_ktp`,`c`.`nama_instansi` AS `nama_instansi`,`b`.`jekel` AS `jekel`,`b`.`tanggal_lahir` AS `tanggal_lahir`,`d`.`id_jns_bantuan` AS `id_jns_bantuan`,`d`.`jns_bantuan` AS `jns_bantuan`,`d`.`nama_instansi` AS `nama_instansi_bantuan`,`d`.`nama_bantuan` AS `nama_bantuan`,`d`.`tgl_bantuan` AS `tgl_bantuan`,`e`.`nama_pend` AS `nama_pend2`,`e`.`jenis_pend` AS `jenis_pend2`,`e`.`tahun` AS `tahun2`,`e`.`ket` AS `ket2`,`e`.`instansi` AS `instansi2` from ((((`tbl_m_pend_non_formal_temp` `a` join `master_ktp` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) join `tbl_m_instansi` `c` on((`a`.`instansi` = `c`.`id_instansi`))) left join `vw_t_bantuan` `d` on((`a`.`id_ktp` = `d`.`id_ktp`))) left join `vw_pend_non_formal` `e` on((`a`.`id_ktp` = `e`.`id_ktp`)));

-- ----------------------------
-- View structure for vw_t_anggota_komunitas_temp
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_anggota_komunitas_temp` AS select `a`.`id_anggota_komunitas_temp` AS `id_anggota_komunitas_temp`,`a`.`idsession` AS `idsession`,`a`.`id_ktp` AS `id_ktp`,`b`.`nama_ktp` AS `nama_ktp`,`b`.`tempat_lahir` AS `tempat_lahir`,date_format(`b`.`tanggal_lahir`,'%d-%m-%Y') AS `tanggal_lahir`,`b`.`jekel` AS `jekel`,`b`.`gol_darah` AS `gol_darah`,`b`.`alamat` AS `alamat`,`b`.`rt` AS `rt`,`b`.`rw` AS `rw`,`b`.`id_kel` AS `id_kel`,`b`.`id_kec` AS `id_kec`,`b`.`agama` AS `agama`,`b`.`status_kawin` AS `status_kawin`,`b`.`pekerjaan` AS `pekerjaan`,`b`.`warga_negara` AS `warga_negara`,`b`.`link_gambar` AS `link_gambar`,`b`.`is_delete` AS `is_delete` from (`tbl_t_anggota_komunitas_temp` `a` join `master_ktp` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) where (`b`.`is_delete` = 0);

-- ----------------------------
-- View structure for vw_t_bantuan_temp
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_bantuan_temp` AS select `a`.`id_t_bantuan` AS `id_t_bantuan`,`a`.`id_jns_bantuan` AS `id_jns_bantuan`,`d`.`jns_bantuan` AS `jns_bantuan`,`a`.`id_m_instansi` AS `id_m_instansi`,`b`.`nama_instansi` AS `nama_instansi`,`a`.`id_ktp` AS `id_ktp`,`a`.`nama_bantuan` AS `nama_bantuan`,`a`.`ket` AS `ket`,`a`.`tgl_bantuan` AS `tgl_bantuan`,`a`.`idsession` AS `idsession`,`c`.`nama_ktp` AS `nama_ktp`,`c`.`tempat_lahir` AS `tempat_lahir`,date_format(`c`.`tanggal_lahir`,'%d-%m-%Y') AS `tanggal_lahir`,`c`.`jekel` AS `jekel`,`c`.`gol_darah` AS `gol_darah`,`c`.`alamat` AS `alamat`,`c`.`rt` AS `rt`,`c`.`rw` AS `rw`,`c`.`id_kel` AS `id_kel`,`c`.`id_kec` AS `id_kec`,`c`.`agama` AS `agama`,`c`.`status_kawin` AS `status_kawin`,`c`.`pekerjaan` AS `pekerjaan`,`c`.`warga_negara` AS `warga_negara`,`c`.`link_gambar` AS `link_gambar`,`c`.`is_delete` AS `is_delete` from (((`tbl_t_bantuan_temp` `a` join `tbl_m_instansi` `b` on((`a`.`id_m_instansi` = `b`.`id_instansi`))) join `master_ktp` `c` on((`a`.`id_ktp` = `c`.`id_ktp`))) left join `tbl_r_jns_bantuan` `d` on((`a`.`id_jns_bantuan` = `d`.`id_jns_bantuan`)));

-- ----------------------------
-- View structure for vw_t_kk
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_kk` AS select `a`.`idtrans_kk` AS `idtrans_kk`,`a`.`id_master_kk` AS `id_master_kk`,`a`.`id_ktp` AS `id_ktp`,`a`.`pendidikan` AS `pendidikan`,`b`.`id_pend` AS `id_pend`,`k`.`nama_pend` AS `nama_pend`,`a`.`hub_keluarga` AS `hub_keluarga`,`f`.`nama_hub_kel` AS `nama_hub_kel`,`a`.`no_paspor` AS `no_paspor`,`a`.`no_kitap` AS `no_kitap`,`a`.`ayah` AS `ayah`,`a`.`ibu` AS `ibu`,`a`.`rumah_path` AS `rumah_path`,`b`.`nama_ktp` AS `nama_ktp`,`b`.`tempat_lahir` AS `tempat_lahir`,date_format(`b`.`tanggal_lahir`,'%d-%m-%Y') AS `tanggal_lahir`,`b`.`jekel` AS `jekel`,(case when (`b`.`jekel` = 0) then 'Pria' else 'Wanita' end) AS `nama_jekel`,`b`.`gol_darah` AS `gol_darah`,`b`.`alamat` AS `alamat`,`b`.`rt` AS `rt`,`b`.`rw` AS `rw`,`b`.`id_kel` AS `id_kel`,`g`.`nama_kel` AS `nama_kel`,`b`.`id_kec` AS `id_kec`,`h`.`nama_kec` AS `nama_kec`,`b`.`agama` AS `agama`,`i`.`nama_agama` AS `nama_agama`,`b`.`status_kawin` AS `status_kawin`,`j`.`nama_nikah` AS `nama_nikah`,`b`.`pekerjaan` AS `pekerjaan`,(case when (`b`.`warga_negara` = 0) then 'WNI' else 'WNA' end) AS `warga_negara`,`b`.`warga_negara` AS `warga_negara_`,`b`.`link_gambar` AS `link_gambar`,`b`.`is_delete` AS `is_delete`,(select count(1) from `trans_kk` `z` where (`z`.`id_master_kk` = `a`.`id_master_kk`)) AS `jml_anggota_keluarga`,`l`.`nama_pekerjaan` AS `nama_pekerjaan`,`b`.`id_difabel` AS `id_difabel`,`m`.`nama_difabel` AS `nama_difabel` from (((((((((`trans_kk` `a` join `master_ktp` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) left join `tbl_r_hub_kel` `f` on((`a`.`hub_keluarga` = `f`.`id_hub_kel`))) left join `master_kelurahan` `g` on((`b`.`id_kel` = `g`.`id_kel`))) left join `master_kecamatan` `h` on((`b`.`id_kec` = `h`.`id_kec`))) left join `tbl_m_agama` `i` on((`b`.`agama` = `i`.`id_agama`))) left join `tbl_r_status_nikah` `j` on((`b`.`status_kawin` = `j`.`id_nikah`))) left join `tbl_r_pendidikan` `k` on((`b`.`id_pend` = `k`.`id_pend`))) left join `tbl_m_pekerjaan` `l` on((`b`.`pekerjaan` = `l`.`id_pekerjaan`))) left join `tbl_m_difabel` `m` on((`b`.`id_difabel` = `m`.`id_difabel`)));

-- ----------------------------
-- Procedure structure for zsp_detail_anggota_kom
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_detail_anggota_kom`(
s_ses varchar(50)
)
BEGIN

DELETE FROM tbl_t_anggota_komunitas_temp 
WHERE idsession=s_ses;

INSERT INTO tbl_t_anggota_komunitas_temp 
(id_ktp,idsession) 
SELECT id_ktp,idsession
FROM tbl_t_anggota_komunitas
WHERE idsession=s_ses;


END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_detail_bantuan
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_detail_bantuan`(
s_user varchar(50),
s_session varchar(50)
)
BEGIN
DELETE FROM tbl_t_bantuan_temp 
WHERE idsession=s_session;

INSERT INTO tbl_t_bantuan_temp 
(id_m_instansi,idsession,id_ktp,tgl_bantuan,nama_bantuan,ket,create_by,create_date) 
SELECT id_m_instansi,s_session,id_ktp,tgl_bantuan,nama_bantuan,ket,s_user,now() 
FROM tbl_t_bantuan
WHERE idsession=s_session;

END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_detail_kk
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_detail_kk`(
s_session varchar(50)
)
BEGIN

-- MASTER KTP DELETE AND INSERT
DELETE FROM master_ktp_kk_temp
WHERE idsession=s_session;

INSERT INTO master_ktp_kk_temp
(`id_ktp`,
`nama_ktp`,
`tempat_lahir`,
`tanggal_lahir`,
`jekel`,
`gol_darah`,
`alamat`,
`rt`,
`rw`,
`id_kel`,
`id_kec`,
`agama`,
`status_kawin`,
`pekerjaan`,
`id_difabel`,
`id_pend`,
`link_gambar`,
`is_delete`,

`id_master_kk`,
`hub_keluarga`,
`no_paspor`,
`no_kitap`,
`ayah`,
`ibu`,
`rumah_path`,

`idsession`)
SELECT 
a.`id_ktp`,
a.`nama_ktp`,
a.`tempat_lahir`,
a.`tanggal_lahir`,
a.`jekel`,
a.`gol_darah`,
a.`alamat`,
a.`rt`,
a.`rw`,
a.`id_kel`,
a.`id_kec`,
a.`agama`,
a.`status_kawin`,
a.`pekerjaan`,
a.`id_difabel`,
a.`id_pend`,
a.`link_gambar`,
a.`is_delete`,

b.`id_master_kk`,
b.`hub_keluarga`,
b.`no_paspor`,
b.`no_kitap`,
b.`ayah`,
b.`ibu`,
b.`rumah_path`,

b.`idsession`
FROM `master_ktp` as a inner join
`trans_kk` as b on a.id_ktp=b.id_ktp
WHERE a.idsession=s_session and a.is_delete=0;


 -- tbl_m_rumah_temp DELETE AND INSERT
 DELETE FROM tbl_m_rumah_temp
 WHERE idsession=s_session;

 INSERT INTO `tbl_m_rumah_temp`
 (`id_master_kk`,
 `rumah_path`,
 `idsession`)
SELECT 
`id_master_kk`,
 `rumah_path`,
 `idsession`
FROM tbl_m_rumah
WHERE idsession=s_session;


-- -- tbl_m_pend_formal DELETE AND INSERT
-- DELETE FROM tbl_m_pend_formal_temp
-- WHERE idsession=s_session;

-- INSERT INTO `tbl_m_pend_formal_temp`
-- (`id_ktp`,
-- `id_pend`,
-- `thn_masuk`,
-- `thn_lulus`,
-- `nama_sekolah`,
-- `idsession`)
-- SELECT 
-- `id_ktp`,
-- `id_pend`,
-- `thn_masuk`,
-- `thn_lulus`,
-- `nama_sekolah`,
-- `idsession`
-- FROM tbl_m_pend_formal
-- WHERE idsession=s_session;

-- -- tbl_m_pend_non_formal DELETE AND INSERT
-- DELETE FROM tbl_m_pend_non_formal_temp
-- WHERE idsession=s_session;

-- INSERT INTO `tbl_m_pend_non_formal_temp`
-- (`id_ktp`,
-- `nama_pend`,
-- `jenis_pend`,
-- `tahun`,
-- `ket`,
-- `instansi`,
-- `idsession`)
-- SELECT
-- `id_ktp`,
-- `nama_pend`,
-- `jenis_pend`,
-- `tahun`,
-- `ket`,
-- `instansi`,
-- `idsession`
-- FROM tbl_m_pend_non_formal
-- WHERE idsession=s_session;


END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_detail_pend_non_formal
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_detail_pend_non_formal`(
s_session varchar(50)
)
BEGIN
DELETE FROM tbl_m_pend_non_formal_temp
WHERE idsession=s_session;

INSERT INTO tbl_m_pend_non_formal_temp 
(instansi,idsession,id_ktp,nama_pend,jenis_pend,tahun,ket) 
SELECT instansi,idsession,id_ktp,nama_pend,jenis_pend,tahun,ket
FROM tbl_m_pend_non_formal
WHERE idsession=s_session;

END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_simpan_anggota_kom
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_simpan_anggota_kom`(
s_session varchar(50),
s_id_kom varchar(50)
)
BEGIN

DELETE FROM tbl_t_anggota_komunitas
WHERE idsession=s_session;

INSERT INTO tbl_t_anggota_komunitas 
	  (id_komunitas,id_ktp,idsession) 
SELECT s_id_kom,id_ktp,idsession
FROM tbl_t_anggota_komunitas_temp 
WHERE idsession=s_session;

 DELETE FROM tbl_t_anggota_komunitas_temp
 WHERE idsession=s_session;

 
END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_simpan_bantuan
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_simpan_bantuan`(
s_user varchar(50),
s_session varchar(50),
s_jns_bantuan varchar(50),
s_bantuan varchar(50),
s_instansi varchar(50),
s_tgl varchar(50),
s_ket varchar(50)
)
BEGIN
DELETE FROM tbl_t_bantuan
WHERE idsession=s_session;

UPDATE tbl_t_bantuan_temp 
SET nama_bantuan=s_bantuan,
	id_jns_bantuan=s_jns_bantuan,
	id_m_instansi=s_instansi,
	tgl_bantuan=s_tgl,
	ket=s_ket 
WHERE idsession=s_session ; 

INSERT INTO tbl_t_bantuan 
	  (id_jns_bantuan,id_m_instansi,idsession,id_ktp,tgl_bantuan,nama_bantuan,ket,create_by,create_date) 
SELECT id_jns_bantuan,id_m_instansi,s_session,id_ktp,tgl_bantuan,nama_bantuan,ket,s_user,now() 
FROM tbl_t_bantuan_temp 
WHERE idsession=s_session;

DELETE FROM tbl_t_bantuan_temp 
WHERE idsession=s_session;
 
END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_simpan_kk
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_simpan_kk`(
s_session varchar(50)
)
BEGIN

-- MASTER KTP DELETE AND INSERT
DELETE FROM master_ktp
WHERE idsession=s_session;

INSERT INTO master_ktp
(`id_ktp`,
`nama_ktp`,
`tempat_lahir`,
`tanggal_lahir`,
`jekel`,
`gol_darah`,
`alamat`,
`rt`,
`rw`,
`id_kel`,
`id_kec`,
`agama`,
`status_kawin`,
`pekerjaan`,
`id_difabel`,
`id_pend`,
`link_gambar`,
`is_delete`,
`idsession`)
SELECT 
`id_ktp`,
`nama_ktp`,
`tempat_lahir`,
`tanggal_lahir`,
`jekel`,
`gol_darah`,
`alamat`,
`rt`,
`rw`,
`id_kel`,
`id_kec`,
`agama`,
`status_kawin`,
`pekerjaan`,
`id_difabel`,
`id_pend`,
`link_gambar`,
`is_delete`,
`idsession`
FROM `master_ktp_kk_temp`
WHERE idsession=s_session;

-- TRANS KK DELETE AND INSERT
DELETE FROM trans_kk
WHERE idsession=s_session;

INSERT INTO `trans_kk`
(`id_master_kk`,
`id_ktp`,
`hub_keluarga`,
`no_paspor`,
`no_kitap`,
`ayah`,
`ibu`,
`rumah_path`,
`idsession`)
SELECT
`id_master_kk`,
`id_ktp`,
`hub_keluarga`,
`no_paspor`,
`no_kitap`,
`ayah`,
`ibu`,
`rumah_path`,
`idsession`
FROM `master_ktp_kk_temp`
WHERE idsession=s_session;

DELETE FROM master_ktp_kk_temp
WHERE idsession=s_session;

 -- tbl_m_rumah DELETE AND INSERT
 DELETE FROM tbl_m_rumah
 WHERE idsession=s_session;

 INSERT INTO `tbl_m_rumah`
 (`id_master_kk`,
 `rumah_path`,
 `idsession`)
SELECT 
`id_master_kk`,
 `rumah_path`,
 `idsession`
FROM tbl_m_rumah_temp
WHERE idsession=s_session;


-- -- tbl_m_pend_formal DELETE AND INSERT
-- DELETE FROM tbl_m_pend_formal
-- WHERE idsession=s_session;

-- INSERT INTO `tbl_m_pend_formal`
-- (`id_ktp`,
-- `id_pend`,
-- `thn_masuk`,
-- `thn_lulus`,
-- `nama_sekolah`,
-- `idsession`)
-- SELECT 
-- `id_ktp`,
-- `id_pend`,
-- `thn_masuk`,
-- `thn_lulus`,
-- `nama_sekolah`,
-- `idsession`
-- FROM tbl_m_pend_formal_temp
-- WHERE idsession=s_session;

-- DELETE FROM tbl_m_pend_formal_temp
-- WHERE idsession=s_session;

-- -- tbl_m_pend_non_formal DELETE AND INSERT
-- DELETE FROM tbl_m_pend_non_formal
-- WHERE idsession=s_session;

-- INSERT INTO `tbl_m_pend_non_formal`
-- (`id_ktp`,
-- `nama_pend`,
-- `jenis_pend`,
-- `tahun`,
-- `ket`,
-- `instansi`,
-- `idsession`)
-- SELECT
-- `id_ktp`,
-- `nama_pend`,
-- `jenis_pend`,
-- `tahun`,
-- `ket`,
-- `instansi`,
-- `idsession`
-- FROM tbl_m_pend_non_formal_temp
-- WHERE idsession=s_session;

-- DELETE FROM tbl_m_pend_non_formal_temp
-- WHERE idsession=s_session;

END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_simpan_pend_non_formal
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_simpan_pend_non_formal`(
s_session varchar(50),
s_pend varchar(50),
s_jns_pend varchar(50),
s_tahun varchar(50),
s_instansi varchar(50),
s_ket varchar(50)
)
BEGIN
DELETE FROM tbl_m_pend_non_formal
WHERE idsession=s_session;

UPDATE tbl_m_pend_non_formal_temp 
SET 
	nama_pend=s_pend,
	jenis_pend=s_jns_pend,
	tahun=s_tahun,
	instansi=s_instansi,
	ket=s_ket 
WHERE idsession=s_session ; 

INSERT INTO tbl_m_pend_non_formal
	  (instansi,idsession,id_ktp,nama_pend,jenis_pend,tahun,ket) 
SELECT instansi,idsession,id_ktp,nama_pend,jenis_pend,tahun,ket
FROM tbl_m_pend_non_formal_temp 
WHERE idsession=s_session;

DELETE FROM tbl_m_pend_non_formal_temp 
WHERE idsession=s_session;
 
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_agama
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_agama`(
sjekel varchar(2),
sid_kec varchar(10),
sid_agama varchar(10)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel and id_kec=sid_kec and agama=sid_agama);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_difabel
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_difabel`(
sjekel varchar(2),
sid_kec varchar(10),
sid_difabel varchar(10)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel and id_kec=sid_kec  and id_difabel=sid_difabel);


RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_gol_darah
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_gol_darah`(
sjekel varchar(2),
sid_kec varchar(10),
sgol_darah varchar(10)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel and id_kec=sid_kec and gol_darah=sgol_darah);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_jekel
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_jekel`(
sjekel varchar(2)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_jekel_kec
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_jekel_kec`(
sjekel varchar(2),
sid_kec varchar(10)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel and id_kec=sid_kec);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_kk
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_kk`() RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM trans_kk where hub_keluarga=1);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_pekerjaan
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_pekerjaan`(
sjekel varchar(2),
sid_kec varchar(10),
sid_pekerjaan varchar(10)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel and id_kec=sid_kec and pekerjaan=sid_pekerjaan);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_pend
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_pend`(
sjekel varchar(2),
sid_kec varchar(10),
sid_pend varchar(10)
) RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0 and jekel=sjekel and id_kec=sid_kec and id_pend=sid_pend);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Function structure for xfn_jml_penduduk
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `xfn_jml_penduduk`() RETURNS int(11)
BEGIN

declare iReturn int default(SELECT count(*) FROM master_ktp where is_delete=0);

RETURN iReturn;
END;;
DELIMITER ;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010001', 'Nusapenida', 'SAKTI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010002', 'Nusapenida', 'BUNGA MEKAR', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010003', 'Nusapenida', 'BATUMADEG', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010005', 'Nusapenida', 'BATUKANDIK', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010006', 'Nusapenida', 'SEKARTAJI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010007', 'Nusapenida', 'TANGLAD', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010008', 'Nusapenida', 'PEJUKUTAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010009', 'Nusapenida', 'SUANA', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010010', 'Nusapenida', 'BATUNUNGGUL', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010011', 'Nusapenida', 'KUTAMPI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010012', 'Nusapenida', 'KUTAMPI KALER', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010014', 'Nusapenida', 'KAMPUNG TOYAPAKEH', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010015', 'Nusapenida', 'LEMBONGAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105010', '5105010016', 'Nusapenida', 'JUNGUTBATU', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020001', 'Bajangkaran', 'NEGARI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020002', 'Bajangkaran', 'TAKMUNG', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020003', 'Bajangkaran', 'BANJARANGKAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020004', 'Bajangkaran', 'TUSAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020005', 'Bajangkaran', 'BAKAS', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020006', 'Bajangkaran', 'GETAKAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020007', 'Bajangkaran', 'TIHINGAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020008', 'Bajangkaran', 'AAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020009', 'Bajangkaran', 'NYALIAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020010', 'Bajangkaran', 'BUNGBUNGAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020011', 'Bajangkaran', 'TIMUHUN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020012', 'Bajangkaran', 'NYANGLAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105020', '5105020013', 'Bajangkaran', 'TOHPATI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030001', 'Klungkung', 'SATRA', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030002', 'Klungkung', 'TOJAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030004', 'Klungkung', 'KAMPUNG GELGEL', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030005', 'Klungkung', 'JUMPAI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030006', 'Klungkung', 'TANGKAS', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030007', 'Klungkung', 'KAMASAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030008', 'Klungkung', 'SEMARAPURA KELOD', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030009', 'Klungkung', 'SEMARAPURA KELOD KANGIN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030010', 'Klungkung', 'SEMARAPURA KANGIN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030011', 'Klungkung', 'SEMARAPURA TENGAH', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030012', 'Klungkung', 'SEMARAPURA KAUH', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030013', 'Klungkung', 'SEMARAPURA KAJA', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030014', 'Klungkung', 'AKAH', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030015', 'Klungkung', 'MANDUANG', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030016', 'Klungkung', 'SELAT', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030017', 'Klungkung', 'TEGAK', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105030', '5105030018', 'Klungkung', 'SELISIHAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040001', 'Dawan', 'KUSAMBA', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040002', 'Dawan', 'KAMPUNG KUSAMBA', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040003', 'Dawan', 'PESINGGAHAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040004', 'Dawan', 'DAWAN KLOD', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040005', 'Dawan', 'GUNAKSA', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040006', 'Dawan', 'SAMPALAN KLOD', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040007', 'Dawan', 'SAMPALAN TENGAH', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040008', 'Dawan', 'SULANG', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040009', 'Dawan', 'PAKSEBALI', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040010', 'Dawan', 'DAWAN KALER', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040011', 'Dawan', 'PIKAT', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_table` VALUES ('5105040', '5105040012', 'Dawan', 'BESAN', '0', '0', '0', '0', '0', '0');
INSERT INTO `dashboard_total` VALUES ('0', '1267');
INSERT INTO `dashboard_total` VALUES ('1', '4677');
INSERT INTO `dashboard_total` VALUES ('2', '356');
INSERT INTO `dashboard_total` VALUES ('3', '784');
INSERT INTO `dashboard_total` VALUES ('4', '380947');
INSERT INTO `dashboard_total` VALUES ('5', '917443');
INSERT INTO `integrasi_jurnal` VALUES ('1', 'piutang_cm_kiloan', '10201', '');
INSERT INTO `integrasi_jurnal` VALUES ('2', 'piutang_cm_satuan', '10202', '');
INSERT INTO `integrasi_jurnal` VALUES ('3', 'pendapatan_cm_kiloan', '40101', '');
INSERT INTO `integrasi_jurnal` VALUES ('4', 'pendapatan_cm_satuan', '40102', '');
INSERT INTO `integrasi_jurnal` VALUES ('5', 'kas_operasional', '1010101', '');
INSERT INTO `integrasi_jurnal` VALUES ('6', 'brankas_operasional', '1010102', '');
INSERT INTO `integrasi_jurnal` VALUES ('7', 'diskon_bayar_cucian', '5030108', '');
INSERT INTO `integrasi_jurnal` VALUES ('8', 'biaya_outsource', '5030109', '');
INSERT INTO `integrasi_jurnal` VALUES ('9', 'biaya_agen', '5030110', '');
INSERT INTO `integrasi_jurnal` VALUES ('10', 'biaya_gaji', '5020101', '');
INSERT INTO `jenis_transaksi` VALUES ('1', 'Pembelian Plastik Kiloan', '5030104', '');
INSERT INTO `jenis_transaksi` VALUES ('2', 'Pembelian Plastik Satuan', '5030105', '');
INSERT INTO `jenis_transaksi` VALUES ('3', 'Pembelian Token Listrik', '5030101', '');
INSERT INTO `jenis_transaksi` VALUES ('4', 'Pembelian Gas', '5030111', '');
INSERT INTO `jenis_transaksi` VALUES ('5', 'Pembelian Hanger', '5030112', '');
INSERT INTO `jenis_transaksi` VALUES ('6', 'Pembelian Solatip', '5030113', '');
INSERT INTO `jenis_transaksi` VALUES ('7', 'Pembelian Pulpen', '5030114', '');
INSERT INTO `jenis_transaksi` VALUES ('8', 'Pembelian Spidol', '5030115', '');
INSERT INTO `jenis_transaksi` VALUES ('9', 'Pembelian Sabun', '5030106', '');
INSERT INTO `jenis_transaksi` VALUES ('10', 'Pembelian Parfum', '5030107', '');
INSERT INTO `jenis_transaksi` VALUES ('11', 'Pembelian Bon', '5030116', '');
INSERT INTO `jenis_transaksi` VALUES ('12', 'Pembelian Isi Streples', '5030117', '');
INSERT INTO `jenis_transaksi` VALUES ('13', 'Pembelian Bensin', '', '');
INSERT INTO `master_agen` VALUES ('000001', 'Toko Berkah', 'wisma asri', '081280307086', '201030201', '25% .. Dibayar akhir', '1');
INSERT INTO `master_agen` VALUES ('000002', 'AA23', 'Wisma Asri 2', '081584156368', '201030202', '25% .. Dibayar akhir', '1');
INSERT INTO `master_agen` VALUES ('000003', 'Mama sari', 'Wisma asri', '', '201030203', '', '1');
INSERT INTO `master_agen` VALUES ('000004', 'Masjid', 'Wisma Asri 1', '085691284162', '201030204', '25% .. Dibayar akhir', '1');
INSERT INTO `master_agen` VALUES ('000005', 'Wahana', 'Wisma Asri 2', '085711623447', '201030205', '', '1');
INSERT INTO `master_customer` VALUES ('000001', 'Bu Heru', 'Asri Io', '0812222666545', '', '1');
INSERT INTO `master_customer` VALUES ('000002', 'Bu Sugeng', 'Wisma asri 2 blok DD', '085777738812', '', '1');
INSERT INTO `master_customer` VALUES ('000003', 'Bu Asep', 'WISMA ASRI 2 BELAKANG ATM MANDIRI', '081280336505', '', '1');
INSERT INTO `master_customer` VALUES ('000004', 'Pak Sabar', 'Asri I', '', '', '1');
INSERT INTO `master_customer` VALUES ('000005', 'Ela', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000006', 'Bu Sri', '', '087884336721', '', '1');
INSERT INTO `master_customer` VALUES ('000007', 'Eka', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000008', 'Dini', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000009', 'Bu Rahma', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000010', 'Bu Eko', '', '081210068191', '', '1');
INSERT INTO `master_customer` VALUES ('000011', 'Daru', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000012', 'Bu Lilis', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000013', 'Sifa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000014', 'Giarti', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000015', 'Sulis', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000016', 'Kiki', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000017', 'Bu Neneng', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000018', 'Bu Maria', '', '081574708868', '', '1');
INSERT INTO `master_customer` VALUES ('000019', 'Ara', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000020', 'Pak Budi', '', '08134300507', '', '1');
INSERT INTO `master_customer` VALUES ('000021', 'Eka', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000022', 'Irwan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000023', 'Nita', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000024', 'Pak Wili', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000025', 'Apri tskt', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000026', 'Meta taj', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000027', 'Yeni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000028', 'Bu Yoke', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000029', 'Bu Yeni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000030', 'Bengkel', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000031', 'Bu Ratna', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000032', 'Melia', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000033', 'Debora', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000034', 'Bu Rini', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000035', 'fira', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000036', 'kania', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000037', 'pak.jemi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000038', 'yeni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000039', 'neke', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000040', 'indra', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000041', 'fani', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000042', 'fera', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000043', 'rizki', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000044', 'ela', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000045', 'nanto', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000046', 'susi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000047', 'dede', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000048', 'ibu.eni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000049', 'intan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000050', 'septi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000051', 'deri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000052', 'ana', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000053', 'linda', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000054', 'wiga', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000055', 'ika', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000056', 'pak.sumarmo', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000057', 'pak.yusuf', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000058', 'pak akmal', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000059', 'edi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000060', 'fitri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000061', 'giarti', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000062', 'arga dirgantara', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000063', 'NANDO', '', '082210066700', '', '1');
INSERT INTO `master_customer` VALUES ('000064', 'PAK.JEFRI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000065', 'FITROH', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000066', 'EVA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000067', 'Andi', '', '08561898371', '', '1');
INSERT INTO `master_customer` VALUES ('000068', 'ALDI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000069', 'Hani', '', '087837176698', '', '1');
INSERT INTO `master_customer` VALUES ('000070', 'SARI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000071', 'IRFAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000072', 'RIKO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000073', 'Dea', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000074', 'Biro Jasa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000075', 'Fita', '', '085715996960', '', '1');
INSERT INTO `master_customer` VALUES ('000076', 'Pak Budiman', '', '081317891693', '', '1');
INSERT INTO `master_customer` VALUES ('000077', 'Dwi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000078', 'Bu Diana', '', '081288126727', '', '1');
INSERT INTO `master_customer` VALUES ('000079', 'ARIS', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000080', 'TINA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000081', 'DIAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000082', 'DIAN', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000083', 'ADI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000084', 'CEW  TEMPAT BIRU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000085', 'HESTI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000086', 'REZA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000087', 'IQBAL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000088', 'IQBAL', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000089', 'PAK.CUCUN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000090', 'INUNG', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000091', 'AISA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000092', 'DEWI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000093', 'MARIO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000094', 'SITI.R', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000095', 'BU.ASEP', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000096', 'SINTIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000097', 'BUDIMAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000098', 'rudi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000099', 'sipayung', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000100', 'sugeng', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000101', 'bu.ida', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000102', 'eko', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000103', 'bu.nur', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000104', 'novi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000105', 'tika', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000106', 'nurul', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000107', 'citra', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000108', 'ani', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000109', 'pak.guru', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000110', 'arko', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000111', 'tresna', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000112', 'rina', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000113', 'Pak Wahyu', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000114', 'Pak Jaki', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000115', 'Kaila', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000116', 'Okta', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000117', 'Dani', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000118', 'Kartika', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000119', 'Pak Zainal', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000120', 'Deni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000121', 'Ferdi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000122', 'Bu Heni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000123', 'Fahmi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000124', 'Meli', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000125', 'Ian', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000126', 'Bu Yanti', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000127', 'yuri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000128', 'Pak Lunan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000129', 'Azril', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000130', 'Nandi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000131', 'Ambon', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000132', 'Deden', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000133', 'Bude', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000134', 'Joni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000135', 'Miranti', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000136', 'Jhon Vip', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000137', 'Bu Sukur', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000138', 'Rian', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000139', 'M Alwi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000140', 'Bu Willy', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000141', 'Bu RT', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000142', 'Tukino', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000143', 'Alex', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000144', 'Mita', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000145', 'Pak Rio', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000146', 'Maya', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000147', 'Alifah', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000148', 'Radit', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000149', 'Ibu Eli', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000150', 'Ayu', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000151', 'Bayu', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000152', 'Yudi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000153', 'Arif', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000154', 'Udar', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000155', 'Pak Thomas', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000156', 'Weni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000157', 'Aiia', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000158', 'Alia', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000159', 'Amora', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000160', 'Zikri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000161', 'Fina', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000162', 'Yesi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000163', 'Bu Tigor', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000164', 'Fifi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000165', 'Bintang', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000166', 'Bu jarwo', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000167', 'Anis', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000168', 'Awan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000169', 'Santi VIP', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000170', 'Sandi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000171', 'Sarip', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000172', 'M.Helmi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000173', 'Mutia', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000174', 'Rosa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000175', 'Yoga', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000176', 'Richi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000177', 'Reva', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000178', 'Sinta', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000179', 'Dodit', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000180', 'Pak.Sugeng', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000181', 'Adit', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000182', 'Riska', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000183', 'Bu Hj Ufi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000184', 'FEBRIAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000185', 'Fauzan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000186', 'FARAS', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000187', 'NGESTI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000188', 'OYON', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000189', 'ICA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000190', 'Sudiono', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000191', 'Pa Jepri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000192', 'RIKI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000193', 'IPUNG', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000194', 'Pa Peros', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000195', 'Widi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000196', 'RAMA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000197', 'Kevin', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000198', 'Salsa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000199', 'PA ALI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000200', 'FITA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000201', 'Pa Dedi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000202', 'Agung', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000203', 'LORI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000204', 'DIMAS', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000205', 'Santi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000206', 'Rifa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000207', 'Rahel', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000208', 'Sindi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000209', 'Bu Yoke', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000210', 'Nandri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000211', 'Ajeng', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000212', 'Bu Rosmiati', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000213', 'Bu Misbah', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000214', 'MALA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000215', 'Basuki', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000216', 'Aan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000217', 'Rafi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000218', 'Anisa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000219', 'Gilang', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000220', 'Devi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000221', 'Kristian', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000222', 'Ambar', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000223', 'Tita', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000224', 'Romi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000225', 'Saputra', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000226', 'Raia', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000227', 'Ridho', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000228', 'Bu Ningsih', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000229', 'Farel', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000230', 'Pa Murid', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000231', 'Pa RT 05', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000232', 'Bu Ria', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000233', 'Dela', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000234', 'HJ Wahyu (Berkah)', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000235', 'P. HJ Wahyu', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000236', 'Pa Zaenal', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000237', 'Bimo', '', '082213285183', '', '1');
INSERT INTO `master_customer` VALUES ('000238', 'Kembar', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000239', 'Pa Surya', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000240', 'Gery', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000241', 'Pa Key', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000242', 'Bu Marsudi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000243', 'Sihombing', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000244', 'Dara', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000245', 'BU WANTO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000246', 'YULI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000247', 'ADRIAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000248', 'DION', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000249', 'SULTAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000250', 'BU LIDIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000251', 'RAHMAT', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000252', 'DESI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000253', 'ERNI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000254', 'BU ITA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000255', 'MAMA NATANG', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000256', 'JENIFER', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000257', 'KLARA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000258', 'Pak Bowo', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000259', 'Pak Arman', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000260', 'Alisa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000261', 'Adlan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000262', 'Bu Suasno', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000263', 'tiwi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000264', 'bu norma', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000265', 'Fero', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000266', 'Manggih', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000267', 'Dinda', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000268', 'Saputra', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000269', 'Fahri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000270', 'cerly', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000271', 'ine', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000272', 'b. hakis', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000273', 'ghina', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000274', 'feri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000275', 'guteng', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000276', 'mama kensi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000277', 'irawan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000278', 'zafran', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000279', 'hadi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000280', 'bu. eli vip', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000281', 'ade', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000282', 'mama reyhan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000283', 'inan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000284', 'ali', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000285', 'davit', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000286', 'ripan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000287', 'rehan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000288', 'Bpk. Ngatemin', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000289', 'opi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000290', 'opi', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000291', 'irma', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000292', 'bpk. rifan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000293', 'bu. siti', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000294', 'bu. siti', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000295', 'ahwa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000296', 'ahwa', '', '', '', '0');
INSERT INTO `master_customer` VALUES ('000297', 'adul', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000298', 'jaka', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000299', 'fathan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000300', 'endri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000301', 'suci', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000302', 'biru jasa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000303', 'fadil', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000304', 'sarif', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000305', 'putri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000306', 'Saiful', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000307', 'lisa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000308', 'jihan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000309', 'matandang', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000310', 'bu. tono', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000311', 'ari', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000312', 'fatmi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000313', 'rici', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000314', 'bu. titi', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000315', 'raihan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000316', 'Mama Jaki', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000317', 'Pipit', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000318', 'Andra', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000319', 'ABDUL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000320', 'VINA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000321', 'Mas Koko', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000322', 'Amel', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000323', 'kinanti', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000324', 'Andri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000325', 'Teguh AA 25 no. 47', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000326', 'Ririrn', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000327', 'RIZAL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000328', 'RAY', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000329', 'WISNU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000330', 'IBU TUTI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000331', 'RENGGA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000332', 'Indri', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000333', 'BU ENI (082123324828)', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000334', 'ARA (081314444003)', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000335', 'RIA (081310043386)', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000336', 'IKBAL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000337', 'BU ARNI CC35 NO. 16 (08159052367)', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000338', 'SARI (089607286454)', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000339', 'Bu Yeni', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000340', 'ANDRA', '', '085697245292', '', '1');
INSERT INTO `master_customer` VALUES ('000341', 'HAMZAH', '', '085770391080', '', '1');
INSERT INTO `master_customer` VALUES ('000342', 'EDWARD', '', '081213233268', '', '1');
INSERT INTO `master_customer` VALUES ('000343', 'SITI', '', '087875074523', '', '1');
INSERT INTO `master_customer` VALUES ('000344', 'RESTU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000345', 'SARONO', '', '082124306755', '', '1');
INSERT INTO `master_customer` VALUES ('000346', 'BU. ANI', '', '085691913862', '', '1');
INSERT INTO `master_customer` VALUES ('000347', 'ADZHAR', '', '0816225730', '', '1');
INSERT INTO `master_customer` VALUES ('000348', 'CINDY', '', '082122074525', '', '1');
INSERT INTO `master_customer` VALUES ('000349', 'MERCY', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000350', 'PUTRA', '', '081370875716', '', '1');
INSERT INTO `master_customer` VALUES ('000351', 'EKA', '', '081213257472', '', '1');
INSERT INTO `master_customer` VALUES ('000352', 'ANTIDIANA', '', '0895334034619', '', '1');
INSERT INTO `master_customer` VALUES ('000353', 'BINTANG', '', '082324623858', '', '1');
INSERT INTO `master_customer` VALUES ('000354', 'HATMA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000355', 'DWI', '', '081585358930', '', '1');
INSERT INTO `master_customer` VALUES ('000356', 'YUDA', '', '082111299941', '', '1');
INSERT INTO `master_customer` VALUES ('000357', 'RATNA VIP', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000358', 'HANI', '', '021 88876927', '', '1');
INSERT INTO `master_customer` VALUES ('000359', 'AYUMA', '', '085920056506', '', '1');
INSERT INTO `master_customer` VALUES ('000360', 'IKA', '', '081288836311', '', '1');
INSERT INTO `master_customer` VALUES ('000361', 'WIGA', '', '081285303458', '', '1');
INSERT INTO `master_customer` VALUES ('000362', 'MIRANTI', '', '081319161119', '', '1');
INSERT INTO `master_customer` VALUES ('000363', 'FERO', '', '08568899322', '', '1');
INSERT INTO `master_customer` VALUES ('000364', 'RINTO', '', '08988101885', '', '1');
INSERT INTO `master_customer` VALUES ('000365', 'ERO', '', '089635909838', '', '1');
INSERT INTO `master_customer` VALUES ('000366', 'arma', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000367', 'PA. TRISNO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000368', 'PAULINA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000369', 'FRANS', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000370', 'DONI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000371', 'UNA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000372', 'PA HENDI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000373', 'FATIMAH', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000374', 'HERLINA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000375', 'NANTO', '', '081213398908', '', '1');
INSERT INTO `master_customer` VALUES ('000376', 'IBU SOFI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000377', 'ADEL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000378', 'ADELIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000379', 'KOMAR', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000380', 'SUPRIYONO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000381', 'HENDRI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000382', 'SAMUEL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000383', 'BU. IIS', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000384', 'ULFAH', '', '089686678756', '', '1');
INSERT INTO `master_customer` VALUES ('000385', 'BU. RENI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000386', 'DWI A', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000387', 'APRI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000388', 'CITRA AHMAD', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000389', 'MUJI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000390', 'PA. WIDODO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000391', 'IBU CLARA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000392', 'ALETA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000393', 'MAMA BARA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000394', 'keysa', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000395', 'IBU FARIDA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000396', 'AJI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000397', 'PA.ANTO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000398', 'PAK GARTI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000399', 'BU. IDA AYU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000400', 'INDRA FERA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000401', 'ANRE', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000402', 'DWI. S', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000403', 'INDAH', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000404', 'VITA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000405', 'NURSIN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000406', 'BU. YOSI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000407', 'RASYA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000408', 'IBU. DAYU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000409', 'MAMA AYU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000410', 'Bp. Nurdin', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000411', 'Rina. B', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000412', 'Bp. Hasan', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000413', 'PA. HERI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000414', 'DANIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000415', 'SATRIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000416', 'YADI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000417', 'IBU NARSIH', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000418', 'MAMA FIDI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000419', 'IKHSAN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000420', 'CALISTA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000421', 'MUTIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000422', 'NAURA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000423', 'AKBAR', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000424', 'ASRI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000425', 'DESTI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000426', 'NAYLA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000427', 'MBA.RAHMI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000428', 'RAKA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000429', 'BUNDA FADIL', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000430', 'BU. ALI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000431', 'TIO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000432', 'AZIZAH', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000433', 'AZIS', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000434', 'YAYANG', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000435', 'BAPAKNYA VITA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000436', 'HANI', '', '081327340724', '', '1');
INSERT INTO `master_customer` VALUES ('000437', 'NIZAM', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000438', 'ALIZA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000439', 'KAYLA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000440', 'HABIB', '', '081387575027', '', '1');
INSERT INTO `master_customer` VALUES ('000441', 'AA23', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000442', 'TIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000443', 'TIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000444', 'FADIL', '', '08179084601', '', '1');
INSERT INTO `master_customer` VALUES ('000445', 'IBU MANDA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000446', 'IBU NDO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000447', 'MBA LINA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000448', 'MBA INU', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000449', 'ELA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000450', 'MBA PIPIT', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000451', 'AYUMI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000452', 'DEWI CIPTA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000453', 'IBU NIKO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000454', 'TRIA', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000455', 'MORENO', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000456', 'ROY', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000457', 'ARIFIN', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000458', 'BU YANI', '', '', '', '1');
INSERT INTO `master_customer` VALUES ('000459', 'IBU TIARA', '', '', '', '1');
INSERT INTO `master_dept` VALUES ('000001', 'Gudang');
INSERT INTO `master_dept` VALUES ('000002', 'Distribusi');
INSERT INTO `master_dept` VALUES ('000003', 'Sales');
INSERT INTO `master_dept` VALUES ('000004', 'GA');
INSERT INTO `master_dept` VALUES ('005', 'QC');
INSERT INTO `master_jeniskomunitas` VALUES ('000001', 'Hobi');
INSERT INTO `master_jeniskomunitas` VALUES ('000002', 'Motor');
INSERT INTO `master_jeniskomunitas` VALUES ('000003', 'Mobil');
INSERT INTO `master_jeniskomunitas` VALUES ('000004', 'Sepeda');
INSERT INTO `master_jeniskomunitas` VALUES ('000005', 'Pecinta Alam');
INSERT INTO `master_jenislk` VALUES ('000001', 'BPR');
INSERT INTO `master_jenislk` VALUES ('000002', 'KSP');
INSERT INTO `master_jenislk` VALUES ('000003', 'KSU');
INSERT INTO `master_jenislk` VALUES ('000004', 'Bank');
INSERT INTO `master_jenissentra` VALUES ('000001', 'Kain ikat');
INSERT INTO `master_jenissentra` VALUES ('000002', 'Anyaman & Souvenir');
INSERT INTO `master_jenissentra` VALUES ('000003', 'Perikanan & Tambak');
INSERT INTO `master_jenissentra` VALUES ('000004', 'Perkebunan');
INSERT INTO `master_jns_produk` VALUES ('1', 'Kiloan', '1');
INSERT INTO `master_jns_produk` VALUES ('2', 'Satuan', '1');
INSERT INTO `master_karyawan` VALUES ('000001', 'Anggy Nida S', '', '', '', '', '201030401');
INSERT INTO `master_karyawan` VALUES ('000002', 'M Rizal', '', '', '', '', '201030402');
INSERT INTO `master_karyawan` VALUES ('000003', 'Novi', '', '', '', '', '201030403');
INSERT INTO `master_karyawan` VALUES ('000004', 'Ibu', '', '', '', '', '201030404');
INSERT INTO `master_karyawan` VALUES ('000005', 'Ibu Lina', '', '', '', '', '201030405');
INSERT INTO `master_kecamatan` VALUES ('5105010', 'Nusapenida');
INSERT INTO `master_kecamatan` VALUES ('5105020', 'Bajangkaran');
INSERT INTO `master_kecamatan` VALUES ('5105030', 'Klungkung');
INSERT INTO `master_kecamatan` VALUES ('5105040', 'Dawan');
INSERT INTO `master_kelurahan` VALUES ('5105010001', '5105010', 'SAKTI');
INSERT INTO `master_kelurahan` VALUES ('5105010002', '5105010', 'BUNGA MEKAR');
INSERT INTO `master_kelurahan` VALUES ('5105010003', '5105010', 'BATUMADEG');
INSERT INTO `master_kelurahan` VALUES ('5105010005', '5105010', 'BATUKANDIK');
INSERT INTO `master_kelurahan` VALUES ('5105010006', '5105010', 'SEKARTAJI');
INSERT INTO `master_kelurahan` VALUES ('5105010007', '5105010', 'TANGLAD');
INSERT INTO `master_kelurahan` VALUES ('5105010008', '5105010', 'PEJUKUTAN');
INSERT INTO `master_kelurahan` VALUES ('5105010009', '5105010', 'SUANA');
INSERT INTO `master_kelurahan` VALUES ('5105010010', '5105010', 'BATUNUNGGUL');
INSERT INTO `master_kelurahan` VALUES ('5105010011', '5105010', 'KUTAMPI');
INSERT INTO `master_kelurahan` VALUES ('5105010012', '5105010', 'KUTAMPI KALER');
INSERT INTO `master_kelurahan` VALUES ('5105010014', '5105010', 'KAMPUNG TOYAPAKEH');
INSERT INTO `master_kelurahan` VALUES ('5105010015', '5105010', 'LEMBONGAN');
INSERT INTO `master_kelurahan` VALUES ('5105010016', '5105010', 'JUNGUTBATU');
INSERT INTO `master_kelurahan` VALUES ('5105020001', '5105020', 'NEGARI');
INSERT INTO `master_kelurahan` VALUES ('5105020002', '5105020', 'TAKMUNG');
INSERT INTO `master_kelurahan` VALUES ('5105020003', '5105020', 'BANJARANGKAN');
INSERT INTO `master_kelurahan` VALUES ('5105020004', '5105020', 'TUSAN');
INSERT INTO `master_kelurahan` VALUES ('5105020005', '5105020', 'BAKAS');
INSERT INTO `master_kelurahan` VALUES ('5105020006', '5105020', 'GETAKAN');
INSERT INTO `master_kelurahan` VALUES ('5105020007', '5105020', 'TIHINGAN');
INSERT INTO `master_kelurahan` VALUES ('5105020008', '5105020', 'AAN');
INSERT INTO `master_kelurahan` VALUES ('5105020009', '5105020', 'NYALIAN');
INSERT INTO `master_kelurahan` VALUES ('5105020010', '5105020', 'BUNGBUNGAN');
INSERT INTO `master_kelurahan` VALUES ('5105020011', '5105020', 'TIMUHUN');
INSERT INTO `master_kelurahan` VALUES ('5105020012', '5105020', 'NYANGLAN');
INSERT INTO `master_kelurahan` VALUES ('5105020013', '5105020', 'TOHPATI');
INSERT INTO `master_kelurahan` VALUES ('5105030001', '5105030', 'SATRA');
INSERT INTO `master_kelurahan` VALUES ('5105030002', '5105030', 'TOJAN');
INSERT INTO `master_kelurahan` VALUES ('5105030004', '5105030', 'KAMPUNG GELGEL');
INSERT INTO `master_kelurahan` VALUES ('5105030005', '5105030', 'JUMPAI');
INSERT INTO `master_kelurahan` VALUES ('5105030006', '5105030', 'TANGKAS');
INSERT INTO `master_kelurahan` VALUES ('5105030007', '5105030', 'KAMASAN');
INSERT INTO `master_kelurahan` VALUES ('5105030008', '5105030', 'SEMARAPURA KELOD');
INSERT INTO `master_kelurahan` VALUES ('5105030009', '5105030', 'SEMARAPURA KELOD KANGIN');
INSERT INTO `master_kelurahan` VALUES ('5105030010', '5105030', 'SEMARAPURA KANGIN');
INSERT INTO `master_kelurahan` VALUES ('5105030011', '5105030', 'SEMARAPURA TENGAH');
INSERT INTO `master_kelurahan` VALUES ('5105030012', '5105030', 'SEMARAPURA KAUH');
INSERT INTO `master_kelurahan` VALUES ('5105030013', '5105030', 'SEMARAPURA KAJA');
INSERT INTO `master_kelurahan` VALUES ('5105030014', '5105030', 'AKAH');
INSERT INTO `master_kelurahan` VALUES ('5105030015', '5105030', 'MANDUANG');
INSERT INTO `master_kelurahan` VALUES ('5105030016', '5105030', 'SELAT');
INSERT INTO `master_kelurahan` VALUES ('5105030017', '5105030', 'TEGAK');
INSERT INTO `master_kelurahan` VALUES ('5105030018', '5105030', 'SELISIHAN');
INSERT INTO `master_kelurahan` VALUES ('5105040001', '5105040', 'KUSAMBA');
INSERT INTO `master_kelurahan` VALUES ('5105040002', '5105040', 'KAMPUNG KUSAMBA');
INSERT INTO `master_kelurahan` VALUES ('5105040003', '5105040', 'PESINGGAHAN');
INSERT INTO `master_kelurahan` VALUES ('5105040004', '5105040', 'DAWAN KLOD');
INSERT INTO `master_kelurahan` VALUES ('5105040005', '5105040', 'GUNAKSA');
INSERT INTO `master_kelurahan` VALUES ('5105040006', '5105040', 'SAMPALAN KLOD');
INSERT INTO `master_kelurahan` VALUES ('5105040007', '5105040', 'SAMPALAN TENGAH');
INSERT INTO `master_kelurahan` VALUES ('5105040008', '5105040', 'SULANG');
INSERT INTO `master_kelurahan` VALUES ('5105040009', '5105040', 'PAKSEBALI');
INSERT INTO `master_kelurahan` VALUES ('5105040010', '5105040', 'DAWAN KALER');
INSERT INTO `master_kelurahan` VALUES ('5105040011', '5105040', 'PIKAT');
INSERT INTO `master_kelurahan` VALUES ('5105040012', '5105040', 'BESAN');
INSERT INTO `master_komunitas` VALUES ('000001', 'K Pencinta Anjing Herder', 'Bali', '5105040', '5105040006', 'Ruly Siantana', '0811552289', '000001');
INSERT INTO `master_komunitas` VALUES ('000002', 'K Pecinta Kucing Angora', '', '5105030', '5105030007', 'Riyan D Masiv', '087778989156', '000001');
INSERT INTO `master_komunitas` VALUES ('000003', 'KOmunitas Motor Harley Klungkung 008', 'Klungkung', '5105030', '5105030008', 'Komang Agung', '', '000002');
INSERT INTO `master_komunitas` VALUES ('000004', 'Komunitas Mobil Jadul', 'Nusapenida', '5105010', '5105010007', 'Komang karet', '', '000003');
INSERT INTO `master_ktp` VALUES ('3211', 'I Ketut w', 'Bali', '2018-09-22', '0', 'O', 'Bali', '9', '9', '5105010003', '5105010', '0', '1', '000002', '000003', '5', '', 'uploads/foto/546e4704-be72-11e8-b64e-782bcbdbdcb7.jpg', '0', '9346135d-be6f-11e8-b64e-782bcbdbdcb7');
INSERT INTO `master_ktp` VALUES ('7765', 'ninik', 'bali', '2018-10-08', '1', 'A', 'Bali', '9', '9', '5105010003', '5105010', '0', '1', '000004', '000002', '3', '', 'uploads/foto/2dd53fd8-ca6e-11e8-b64e-782bcbdbdcb7.jpg', '0', '9346135d-be6f-11e8-b64e-782bcbdbdcb7');
INSERT INTO `master_ktp_kk_temp` VALUES ('18', '9346135d-be6f-11e8-b64e-782bcbdbdcb7', '3211', 'I Ketut w', 'Bali', '2018-09-22', '0', 'O', 'Bali', '9', '9', '5105010003', '5105010', '0', '1', '000002', '000003', '5', null, 'uploads/foto/546e4704-be72-11e8-b64e-782bcbdbdcb7.jpg', '0', '123456', '1', null, null, null, null, null);
INSERT INTO `master_ktp_kk_temp` VALUES ('19', '9346135d-be6f-11e8-b64e-782bcbdbdcb7', '7765', 'ninik', 'bali', '2018-10-08', '1', 'A', 'Bali', '9', '9', '5105010003', '5105010', '0', '1', '000004', '000002', '3', null, 'uploads/foto/2dd53fd8-ca6e-11e8-b64e-782bcbdbdcb7.jpg', '0', '123456', '2', null, null, null, null, null);
INSERT INTO `master_layanan` VALUES ('1', 'Cuci Setrika Biasa');
INSERT INTO `master_layanan` VALUES ('2', 'Cuci Setrika Express');
INSERT INTO `master_layanan` VALUES ('3', 'Setrika Aja Biasa');
INSERT INTO `master_layanan` VALUES ('4', 'Setrika Aja Express');
INSERT INTO `master_layanan` VALUES ('5', 'Cuci Aja Biasa');
INSERT INTO `master_layanan` VALUES ('6', 'Cuci Aja Express');
INSERT INTO `master_lkm` VALUES ('000001', 'BPR Jayakerti', '5105020', '5105020006', '13000000000.00');
INSERT INTO `master_outsource` VALUES ('000001', 'KARPET SUDRUN', 'DUTA HARAPAN', '089692828840', '201030301', 'BAYAR AKHIR BULAN', '1');
INSERT INTO `master_outsource` VALUES ('000002', 'KARPET HL', 'UJUNG HARAPAN', '', '', '', '1');
INSERT INTO `master_outsource` VALUES ('000003', 'KARPET PLASTIK', 'KEBALEN', '', '', '', '1');
INSERT INTO `master_pasar` VALUES ('000001', 'Pasar Klungkung', '5105030', '5105030007', '200');
INSERT INTO `master_produk` VALUES ('000001', 'KILOAN', '6000.00', '10000.00', '5000.00', '8000.00', '4000.00', '7000.00', '0.00', 'BIASA : 3 HARI\nEXPRESS : 1 HARI', '1');
INSERT INTO `master_produk` VALUES ('000002', 'SWEATER', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '12000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000003', 'JACKET', '15000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '20000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000004', 'JACKET KULIT', '0.00', '36000.00', '0.00', '0.00', '0.00', '0.00', '18000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000005', 'KEMEJA PENDEK', '7000.00', '14000.00', '0.00', '0.00', '0.00', '0.00', '9000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000006', 'KEMEJA PANJANG', '8000.00', '16000.00', '0.00', '0.00', '0.00', '0.00', '10000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000007', 'KEMEJA BATIK', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '15000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000008', 'CELANA JEANS', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '12000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000009', 'KEBAYA', '13000.00', '26000.00', '0.00', '0.00', '0.00', '0.00', '15000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000010', 'BLOUSE', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '12000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000011', 'LONG DRESS', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '20000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000012', 'ROK', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '12000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000013', 'MANTEL', '14000.00', '28000.00', '0.00', '0.00', '0.00', '0.00', '16000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000014', 'SERAGAM STELAN', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '18000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000015', 'JAS / BLEZER', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '20000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000016', 'JAS STELAN', '20000.00', '40000.00', '0.00', '0.00', '0.00', '0.00', '25000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000017', 'SARUNG SONGKET', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '12000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000018', 'MUKENA', '12000.00', '24000.00', '0.00', '0.00', '0.00', '0.00', '15000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000019', 'SAJADAH', '8000.00', '16000.00', '0.00', '0.00', '0.00', '0.00', '10000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000020', 'BAJU MUSLIM', '12000.00', '24000.00', '0.00', '0.00', '0.00', '0.00', '14000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000021', 'BAJU PENGANTIN', '25000.00', '50000.00', '0.00', '0.00', '0.00', '0.00', '35000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000022', 'SELENDANG / KERUDUNG', '5000.00', '10000.00', '0.00', '0.00', '0.00', '0.00', '7000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000023', 'ROMPI', '5000.00', '10000.00', '0.00', '0.00', '0.00', '0.00', '7000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000024', 'DASI', '4000.00', '8000.00', '0.00', '0.00', '0.00', '0.00', '5000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000025', 'BEDCOVER KECIL', '14000.00', '28000.00', '0.00', '0.00', '0.00', '0.00', '16000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000026', 'BEDCOVER BESAR', '16000.00', '32000.00', '0.00', '0.00', '0.00', '0.00', '18000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000027', 'BEDCOVER JUMBO', '20000.00', '40000.00', '0.00', '0.00', '0.00', '0.00', '22000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000028', 'SELIMUT KECIL', '12000.00', '24000.00', '0.00', '0.00', '0.00', '0.00', '14000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000029', 'SELIMUT BESAR', '14000.00', '28000.00', '0.00', '0.00', '0.00', '0.00', '16000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000030', 'SEPRAI', '8000.00', '16000.00', '0.00', '0.00', '0.00', '0.00', '10000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000031', 'SARUNG BANTAL / GULING', '2000.00', '4000.00', '0.00', '0.00', '0.00', '0.00', '3000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000032', 'HANDUK', '8000.00', '16000.00', '0.00', '0.00', '0.00', '0.00', '10000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000033', 'TAPLAK MEJA', '7000.00', '14000.00', '0.00', '0.00', '0.00', '0.00', '9000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000034', 'BONEKA KECIL', '8000.00', '16000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000035', 'BONEKA BESAR', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000036', 'BONEKA JUMBO', '25000.00', '50000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000037', 'TAS KAIN', '10000.00', '20000.00', '0.00', '0.00', '0.00', '0.00', '12000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000038', 'TAS RANSEL', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '18000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000039', 'KOPER', '30000.00', '60000.00', '0.00', '0.00', '0.00', '0.00', '35000.00', '', '1');
INSERT INTO `master_produk` VALUES ('000040', 'BANTAL / GULING', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000041', 'TIKAR', '20000.00', '40000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000042', 'SEPATU', '15000.00', '30000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000043', 'KARPET TIPIS 1', '25000.00', '50000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000044', 'KARPET TIPIS 2', '30000.00', '60000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000045', 'KARPET TIPIS 3', '35000.00', '70000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000046', 'KARPET TEBAL', '45000.00', '90000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000047', 'KARPET BESAR 1', '50000.00', '100000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000048', 'KARPET BESAR 2', '60000.00', '120000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000049', 'KASUR LANTAI KECIL', '30000.00', '60000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000050', 'KASUR LANTAI BESAR', '40000.00', '80000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_produk` VALUES ('000051', 'KARPET BESAR 3', '75000.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '1');
INSERT INTO `master_service` VALUES ('1', 'Cuci Setrika Biasa', '1');
INSERT INTO `master_service` VALUES ('2', 'Cuci Setrika Express', '1');
INSERT INTO `master_service` VALUES ('3', 'Setrika Saja Biasa', '1');
INSERT INTO `master_service` VALUES ('4', 'Setrika Saja Express', '1');
INSERT INTO `master_su` VALUES ('000001', 'Kain Ikat Klungkung', 'Klungkung Utara', '5105030', '5105030004', 'Made Jaya Kusuma', '06484747777', '000001');
INSERT INTO `master_su` VALUES ('000002', 'Anyaman Bambu Made Made', 'Bajangkaran', '5105020', '5105020003', 'I Made Sanjaya', '0899877788865', '000002');
INSERT INTO `master_su` VALUES ('000003', 'Tambak Bli Kendil', 'Nusapenida', '5105010', '5105010002', 'Komang Rama', '084848484843', '000003');
INSERT INTO `master_su` VALUES ('000004', 'Kebun Bunga Anggrek', 'Dawan', '5105040', '5105040005', 'Gede Agung', '087776667878', '000004');
INSERT INTO `master_su` VALUES ('000005', 'Kebun Kopi Bali Jos', 'Klungkung', '5105030', '5105030005', 'Ni Made Julung', '08747474747', '000004');
INSERT INTO `master_supplier` VALUES ('000001', 'YANTI SABUN', 'WALIKOTA JAKARTA TIMUR', '085774925373', '');
INSERT INTO `master_supplier` VALUES ('000002', 'PLASTIK', 'KEBALEN', '081284178204', '');
INSERT INTO `master_supplier` VALUES ('000003', 'PLASTIK', 'UJUNG HARAPAN', '', '');
INSERT INTO `master_supplier` VALUES ('000004', 'PARFUM SAIN', '', '', '');
INSERT INTO `master_supplier` VALUES ('000005', 'GAS PAK AFDAR', '', '', '');
INSERT INTO `master_supplier` VALUES ('000006', 'GALON ISI ULANG', '', '', '');
INSERT INTO `master_supplier` VALUES ('000007', 'FOTOCOPY', '', '', '');
INSERT INTO `master_supplier` VALUES ('000008', 'NATAN', '', '', '');
INSERT INTO `master_supplier` VALUES ('000009', 'NATAN', '', '', '');
INSERT INTO `perkiraan` VALUES ('1', '', 'Aktiva', '0', '1', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('101', '', 'Kas & Bank', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10101', '', 'Kas', '101', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1010101', '', 'Kas Kecil', '10101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1010102', '', 'Kas Besar', '10101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1010103', '', 'Kas Lain', '10101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10102', '', 'Bank', '101', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1010201', '', 'BCA', '10102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1010202', '', 'BNI', '10102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1010203', '', 'Mandiri', '10102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('102', '', 'Piutang Jasa Laundri', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10201', '', 'Piutang Jasa Kiloan', '102', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10202', '', 'Piutang Jasa Satuan', '102', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10203', '', 'Piutang Jasa Lain', '102', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('103', '', 'Piutang Lain-lain', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10301', '', 'Piutang Karyawan', '103', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('104', '', 'Biaya Dibayar Dimuka', '1', '2', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('105', '', 'Aktiva Tetap', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10501', '', 'Harga Perolehan Aktiva Tetap', '105', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050101', '', 'Tempat Usaha', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050102', '', 'Mesin Cuci', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050103', '', 'Mesin Pengering', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050104', '', 'Peralatan Laundri', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10502', '', 'Akumulasi Depresiasi Fixed Asset', '105', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050201', '', 'Akumulasi Penyusutan Tempat Usaha', '10502', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050202', '', 'Akumulasi Penyusutan Peralatan Laundri', '10502', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1050203', '', 'Akumulasi Penyusutan Lain-lain', '10502', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('106', '', 'Aktiva Lain-Lain', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('10601', '', 'Aktiva Tidak Berwujud', '106', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1060101', '', 'Goodwill', '10601', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('1060102', '', 'Perangkat Lunak', '10601', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('107', '', 'Biaya Dibayar Dimuka', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('108', '', 'Pendapatan Yang Masih Hrs Diterima', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2', '', 'Hutang', '0', '1', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201', '', 'Hutang Lancar', '2', '2', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('20101', '', 'Hutang Customer', '201', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('20102', '', 'Hutang Usaha', '201', '3', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010201', '', 'Hutang Marketing', '20102', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('20103', '', 'Biaya Yang Masih Harus Dibayar', '201', '3', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010301', '', 'BYMHD - Jasa Operasional', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030101', '-', 'Jasa Setrika, Antar', '2010301', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010302', '-', 'BYMHD - Agen', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030201', '-', 'Toko Berkah', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030202', '-', 'AA23', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030203', '-', 'Mama Sari', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030204', '-', 'Masjid', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030205', '-', 'Vega', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010303', '-', 'BYMHD - Outsource', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030301', '-', 'Jasa Cuci Karpet (Sudrun)', '2010303', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010304', '-', 'BYMHD Karyawan', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030401', '-', 'Anggy NS', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030402', '-', 'Mahayati', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030403', '-', 'Novi', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030404', '-', 'Ibu', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('201030405', '-', 'Indah', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('20104', '', 'Hutang Sewa Guna Usaha', '201', '3', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010401', '', 'Hutang Sewa Kantor', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010402', '', 'Hutang Sewa Kendaraan', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010403', '', 'Hutang Sewa Komputer', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('2010404', '', 'Sewa diterima dimuka', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('20105', '', 'Hutang Lain-Lain', '201', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('3', '', 'Modal', '0', '1', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('301', '', 'Modal Disetor', '3', '2', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('30101', '', 'Modal Disetor Anggy', '301', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('302', '', 'RETAINED EARNING', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('303', '', 'Agio Saham', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('304', '', 'Kenaikan (Penurunan) Surat Berharga Yang Belum Direalisasi', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('305', '', 'Selisih Penialian Kembali Aktiva Tetap', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('306', '', 'OPENING BALANCE EQUITY', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('4', '', 'Pendapatan', '0', '1', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('401', '', 'Pendapatan Jasa Laundri', '4', '2', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('40101', '', 'PJL Kiloan', '401', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('40102', '', 'PJL Satuan ', '401', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('402', '', 'Pendapatan Lain-lain', '4', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5', '', 'Beban', '0', '1', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('501', '', 'Beban Pemasaran', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('50101', '', 'Beban Promosi', '501', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010101', '', 'Media Cetak', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010102', '', 'Media Elektronik', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010103', '', 'Sponsor', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010104', '', 'Souvenir', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('50102', '', 'Beban Representasi & Pemasaran', '501', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010201', '', 'Fasilitas dan Hadiah', '50102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010202', '', 'Jamuan Makan dan Minum', '50102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5010203', '', 'Olahraga', '50102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('502', '', 'Beban Tenaga Kerja', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('50201', '', 'Beban Gaji & Tunjangan Karyawan', '502', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020101', '', 'Beban Beban Gaji & Upah Pegawai', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020102', '', 'Beban Lembur Pegawai', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020103', '', 'Beban Honorer', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020104', '', 'Beban Penghargaan/Pesangon', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020105', '', 'Beban Sukacita/Dukacita', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020106', '', 'Beban Tunjangan Hari Raya Pegawai', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020107', '', 'Beban Tunjangan Fungsional', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020108', '', 'Beban Tunjangan Produktivitas', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020109', '', 'Beban Tunjangan Lainnya', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5020110', '', 'Beban Pengobatan', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('503', '', 'Beban Produksi', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('50301', '', 'Beban Rutin', '503', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030101', '', 'Beban Utilitas (Listrik/PAM)', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030102', '', 'Beban Pemeliharaan & Perawatan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030103', '', 'Beban Keamanan & Kebersihan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030104', '', 'Beban Plastik Kiloan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030105', '', 'Beban Plastik Satuan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030106', '', 'Beban Sabun', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030107', '', 'Beban Parfum', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030108', '-', 'BR Diskon', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030109', '-', 'BR Outsource', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030110', '-', 'BR Agen', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030111', '-', 'BR Gas', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030112', '-', 'BR Hanger', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030113', '-', 'BR Solatip', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030114', '-', 'BR Pulpen', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030115', '-', 'BR Spidol', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030116', '-', 'BR Cetak Bon', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030117', '-', 'BR Isi Streples', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030118', '-', 'BR Lain - lain', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('50302', '', 'Biaya Penyusutan & Amortisasi', '503', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030201', '', 'Beban Penyusutan Sewa Tempat', '50302', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030202', '', 'Beban Penyusutan Peralatan', '50302', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('5030203', '', 'Beban Penyusutan lain-lain', '50302', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('504', '', 'Beban Diluar Usaha', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan` VALUES ('50401', '', 'Beban Zakat', '504', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1', '', 'Aktiva', '0', '1', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('101', '', 'Kas & Bank', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10101', '', 'Kas', '101', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1010101', '', 'Kas Kecil', '10101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1010102', '', 'Kas Besar', '10101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1010103', '', 'Kas Lain', '10101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10102', '', 'Bank', '101', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1010201', '', 'BCA', '10102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1010202', '', 'BNI', '10102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1010203', '', 'Mandiri', '10102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('102', '', 'Piutang Jasa Laundri', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10201', '', 'Piutang Jasa Kiloan', '102', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10202', '', 'Piutang Jasa Satuan', '102', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10203', '', 'Piutang Jasa Lain', '102', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('103', '', 'Piutang Lain-lain', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10301', '', 'Piutang Karyawan', '103', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('104', '', 'Biaya Dibayar Dimuka', '1', '2', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('105', '', 'Aktiva Tetap', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10501', '', 'Harga Perolehan Aktiva Tetap', '105', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050101', '', 'Tempat Usaha', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050102', '', 'Mesin Cuci', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050103', '', 'Mesin Pengering', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050104', '', 'Peralatan Laundri', '10501', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10502', '', 'Akumulasi Depresiasi Fixed Asset', '105', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050201', '', 'Akumulasi Penyusutan Tempat Usaha', '10502', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050202', '', 'Akumulasi Penyusutan Peralatan Laundri', '10502', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1050203', '', 'Akumulasi Penyusutan Lain-lain', '10502', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('106', '', 'Aktiva Lain-Lain', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('10601', '', 'Aktiva Tidak Berwujud', '106', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1060101', '', 'Goodwill', '10601', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('1060102', '', 'Perangkat Lunak', '10601', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('107', '', 'Biaya Dibayar Dimuka', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('108', '', 'Pendapatan Yang Masih Hrs Diterima', '1', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2', '', 'Hutang', '0', '1', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201', '', 'Hutang Lancar', '2', '2', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('20101', '', 'Hutang Customer', '201', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('20102', '', 'Hutang Usaha', '201', '3', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010201', '', 'Hutang Marketing', '20102', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('20103', '', 'Biaya Yang Masih Harus Dibayar', '201', '3', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010301', '', 'BYMHD - Jasa Operasional', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030101', '-', 'Jasa Setrika, Antar', '2010301', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010302', '-', 'BYMHD - Agen', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030201', '-', 'Toko Berkah', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030202', '-', 'AA23', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030203', '-', 'Mama Sari', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030204', '-', 'Masjid', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030205', '-', 'Vega', '2010302', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010303', '-', 'BYMHD - Outsource', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030301', '-', 'Jasa Cuci Karpet (Sudrun)', '2010303', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010304', '-', 'BYMHD Karyawan', '20103', '4', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030401', '-', 'Anggy NS', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030402', '-', 'Mahayati', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030403', '-', 'Novi', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030404', '-', 'Ibu', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('201030405', '-', 'Indah', '2010304', '5', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('20104', '', 'Hutang Sewa Guna Usaha', '201', '3', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010401', '', 'Hutang Sewa Kantor', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010402', '', 'Hutang Sewa Kendaraan', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010403', '', 'Hutang Sewa Komputer', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('2010404', '', 'Sewa diterima dimuka', '20104', '4', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('20105', '', 'Hutang Lain-Lain', '201', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('3', '', 'Modal', '0', '1', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('301', '', 'Modal Disetor', '3', '2', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('30101', '', 'Modal Disetor Anggy', '301', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('302', '', 'RETAINED EARNING', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('303', '', 'Agio Saham', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('304', '', 'Kenaikan (Penurunan) Surat Berharga Yang Belum Direalisasi', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('305', '', 'Selisih Penialian Kembali Aktiva Tetap', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('306', '', 'OPENING BALANCE EQUITY', '3', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('4', '', 'Pendapatan', '0', '1', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('401', '', 'Pendapatan Jasa Laundri', '4', '2', 'G', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('40101', '', 'PJL Kiloan', '401', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('40102', '', 'PJL Satuan ', '401', '3', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('402', '', 'Pendapatan Lain-lain', '4', '2', 'D', 'K', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5', '', 'Beban', '0', '1', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('501', '', 'Beban Pemasaran', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('50101', '', 'Beban Promosi', '501', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010101', '', 'Media Cetak', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010102', '', 'Media Elektronik', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010103', '', 'Sponsor', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010104', '', 'Souvenir', '50101', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('50102', '', 'Beban Representasi & Pemasaran', '501', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010201', '', 'Fasilitas dan Hadiah', '50102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010202', '', 'Jamuan Makan dan Minum', '50102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5010203', '', 'Olahraga', '50102', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('502', '', 'Beban Tenaga Kerja', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('50201', '', 'Beban Gaji & Tunjangan Karyawan', '502', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020101', '', 'Beban Beban Gaji & Upah Pegawai', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020102', '', 'Beban Lembur Pegawai', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020103', '', 'Beban Honorer', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020104', '', 'Beban Penghargaan/Pesangon', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020105', '', 'Beban Sukacita/Dukacita', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020106', '', 'Beban Tunjangan Hari Raya Pegawai', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020107', '', 'Beban Tunjangan Fungsional', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020108', '', 'Beban Tunjangan Produktivitas', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020109', '', 'Beban Tunjangan Lainnya', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5020110', '', 'Beban Pengobatan', '50201', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('503', '', 'Beban Produksi', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('50301', '', 'Beban Rutin', '503', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030101', '', 'Beban Utilitas (Listrik/PAM)', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030102', '', 'Beban Pemeliharaan & Perawatan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030103', '', 'Beban Keamanan & Kebersihan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030104', '', 'Beban Plastik Kiloan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030105', '', 'Beban Plastik Satuan', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030106', '', 'Beban Sabun', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030107', '', 'Beban Parfum', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030108', '-', 'BR Diskon', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030109', '-', 'BR Outsource', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030110', '-', 'BR Agen', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030111', '-', 'BR Lain - lain', '50301', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('50302', '', 'Biaya Penyusutan & Amortisasi', '503', '3', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030201', '', 'Beban Penyusutan Sewa Tempat', '50302', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030202', '', 'Beban Penyusutan Peralatan', '50302', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('5030203', '', 'Beban Penyusutan lain-lain', '50302', '4', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('504', '', 'Beban Diluar Usaha', '5', '2', 'G', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `perkiraan_old` VALUES ('50401', '', 'Beban Zakat', '504', '3', 'D', 'D', '0.00', '0.00', '0.00', '0.00', '0');
INSERT INTO `sec_menu` VALUES ('1', 'Konfigurasi', '#', '', '+1+2+3', '5', '0', '0');
INSERT INTO `sec_menu` VALUES ('2', 'Group User', 'admin/sec_group_user/home', 'Konfigurasi Group User', '+1+2+3', '1', '1', '0');
INSERT INTO `sec_menu` VALUES ('3', 'Group Menu', 'admin/konfigurasi_menu_status_user/home', 'Konfigurasi Group Menu', '+1+2+3', '2', '1', '0');
INSERT INTO `sec_menu` VALUES ('4', 'Menu', 'admin/sec_menu_user/home', 'Konfigurasi Menu', '+1+2+3', '3', '1', '0');
INSERT INTO `sec_menu` VALUES ('5', 'User', 'sec_user/home', 'Konfigurasi User', '+1+2+3', '4', '1', '0');
INSERT INTO `sec_menu` VALUES ('63', 'Karyawan', 'master_karyawan/home', 'Master Karyawan', '+1+2+3', '8', '1', '0');
INSERT INTO `sec_menu` VALUES ('64', 'Data', '#', '', '+4+5+1+2+3', '7', '0', '0');
INSERT INTO `sec_menu` VALUES ('85', 'Departement', 'master_dept/home', 'Data Master Departement', '+1+2+3', '16', '1', '0');
INSERT INTO `sec_menu` VALUES ('97', 'Laporan', '#', '', '+4+5+6+1+2+3', '14', '0', '0');
INSERT INTO `sec_menu` VALUES ('126', 'Transaksi', '#', '', '+7+4+5+6+1+2', '8', '0', '0');
INSERT INTO `sec_menu` VALUES ('145', 'Utilitas', '#', '', '+1+2', '16', '0', '0');
INSERT INTO `sec_menu` VALUES ('146', 'Backup DB', 'utility/utility_db/home', 'Proses Backup DB', '+1+2', '1', '145', '0');
INSERT INTO `sec_menu` VALUES ('147', 'Restore DB', 'utility/restore_db/home', 'Proses Restore DB', '+1', '2', '145', '0');
INSERT INTO `sec_menu` VALUES ('168', 'Dashboard', '#', '', '+7+4+5+6+1+2+3', '4', '0', '0');
INSERT INTO `sec_menu` VALUES ('169', 'Stok Akhir', 'main/index', 'Dashboard ketersediaan produk', '+7+4+5+6+1+2', '6', '168', '0');
INSERT INTO `sec_menu` VALUES ('170', 'Layar Penuh', 'main/dashboard', 'Dashboard Potensi Wilayah', '+7+4+5+6+1+2+3', '7', '168', '0');
INSERT INTO `sec_menu` VALUES ('186', 'Stok Cukai', 'main/stokcukai', 'Dashboard Stok Cukai', '+1', '8', '168', '0');
INSERT INTO `sec_menu` VALUES ('199', 'Kecamatan', 'master/master_kecamatan/home', 'Master Kecamatan', '+2+3', '1', '207', '0');
INSERT INTO `sec_menu` VALUES ('200', 'Kelurahan', 'master/master_kelurahan/home', 'Data Kelurahan', '+2+3', '2', '207', '0');
INSERT INTO `sec_menu` VALUES ('201', 'KTP', 'master/master_ktp/home', 'Master Data KTP', '+2+3', '3', '64', '0');
INSERT INTO `sec_menu` VALUES ('202', 'KK', 'transaksi/trans_kk/home', 'Data Master Kartu Keluarga', '+2+3', '3', '64', '0');
INSERT INTO `sec_menu` VALUES ('203', 'Sentra Usaha', 'master/master_su/home', 'Data Sentra Usaha', '+2', '4', '64', '0');
INSERT INTO `sec_menu` VALUES ('204', 'Komunitas', 'master/master_komunitas/home', 'Data Komunitas', '+2+3', '5', '64', '0');
INSERT INTO `sec_menu` VALUES ('205', 'Pasar', 'master/master_pasar/home', 'Data Pasar', '+2', '5', '64', '0');
INSERT INTO `sec_menu` VALUES ('206', 'Lembaga Keuangan', 'master/master_lkm/home', 'Data Lembaga Keuangan', '+2', '6', '64', '0');
INSERT INTO `sec_menu` VALUES ('207', 'Parameter', '#', '', '+2+3', '6', '0', '0');
INSERT INTO `sec_menu` VALUES ('208', 'Jenis Sentra', 'master/master_jenissentra/home', 'Data Jenis Sentra', '+2', '3', '207', '0');
INSERT INTO `sec_menu` VALUES ('209', 'Jenis Komunitas', 'master/master_jeniskomunitas/home', 'Data Jenis Komunitas', '+2+3', '2', '207', '0');
INSERT INTO `sec_menu` VALUES ('210', 'Jenis L Keuangan', 'master/master_jenislk/home', 'Data Jenis Lembaga Keuangan', '+2', '5', '207', '0');
INSERT INTO `sec_menu` VALUES ('211', 'Difabel', 'master/master_difabel/home', 'Difabel', '+2+3', '7', '207', '0');
INSERT INTO `sec_menu` VALUES ('212', 'Pekerjaan', 'master/master_pekerjaan/home', 'Pekerjaan', '+2+3', '8', '207', '0');
INSERT INTO `sec_menu` VALUES ('213', 'Instansi', 'master/master_instansi/home', 'Instansi', '+2+3', '9', '207', '0');
INSERT INTO `sec_menu` VALUES ('214', 'Bantuan', 'transaksi/trans_bantuan/home', 'Bantuan', '+2+3', '10', '64', '0');
INSERT INTO `sec_menu` VALUES ('215', 'Personal Penduduk', 'laporan/lap_ktp/home', 'Laporan Personal Penduduk', '+2+3', '11', '97', '0');
INSERT INTO `sec_menu` VALUES ('216', 'Pendidikan Non Formal', 'master/master_pend_non_formal_2/home', 'Pendidikan Non Formal', '+2+3', '12', '64', '0');
INSERT INTO `sec_menu` VALUES ('217', 'Kematian', 'master/master_kematian/home', 'Data Kematian', '+3', '13', '64', '0');
INSERT INTO `sec_menu` VALUES ('218', 'Laporan KK', 'laporan/lap_kk/home', 'Laporan KK', '+2+3', '12', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('1', 'Konfigurasi', '#', '', '+1+2', '5', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('2', 'Group User', 'admin/sec_group_user/home', 'Konfigurasi Group User', '+1+2', '1', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('3', 'Group Menu', 'admin/konfigurasi_menu_status_user/home', 'Konfigurasi Group Menu', '+1+2', '2', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('4', 'Menu', 'admin/sec_menu_user/home', 'Konfigurasi Menu', '+1+2', '3', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('5', 'User', 'sec_user/home', 'Konfigurasi User', '+1+2', '4', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('63', 'Karyawan', 'master_karyawan/home', 'Master Karyawan', '+1+2', '8', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('64', 'Data master', '#', '', '+4+5+1+2+3', '7', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('85', 'Departement', 'master_dept/home', 'Data Master Departement', '+1+2', '16', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('97', 'Laporan', '#', '', '+4+5+6+1+2', '14', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('126', 'Transaksi', '#', '', '+7+4+5+6+1+2', '8', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('145', 'Utilitas', '#', '', '+1+2', '16', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('146', 'Backup DB', 'utility/utility_db/home', 'Proses Backup DB', '+1+2', '1', '145', '0');
INSERT INTO `sec_menu_old` VALUES ('147', 'Restore DB', 'utility/restore_db/home', 'Proses Restore DB', '+1', '2', '145', '0');
INSERT INTO `sec_menu_old` VALUES ('168', 'Dashboard', '#', '', '+7+4+5+6+1+2+3', '4', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('169', 'Stok Akhir', 'main/index', 'Dashboard ketersediaan produk', '+7+4+5+6+1+2', '6', '168', '0');
INSERT INTO `sec_menu_old` VALUES ('170', 'Layar Penuh', 'main/dashboard', 'Dashboard Potensi Wilayah', '+7+4+5+6+1+2+3', '7', '168', '0');
INSERT INTO `sec_menu_old` VALUES ('186', 'Stok Cukai', 'main/stokcukai', 'Dashboard Stok Cukai', '+1', '8', '168', '0');
INSERT INTO `sec_menu_old` VALUES ('199', 'Kecamatan', 'master/master_kecamatan/home', 'Master Kecamatan', '+2+3', '1', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('200', 'Kelurahan', 'master/master_kelurahan/home', 'Data Kelurahan', '+2+3', '2', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('201', 'KTP', 'master/master_ktp/home', 'Master Data KTP', '+2+3', '3', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('202', 'KK', 'transaksi/trans_kk/home', 'Data Master Kartu Keluarga', '+2+3', '3', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('203', 'Sentra Usaha', 'master/master_su/home', 'Data Sentra Usaha', '+2+3', '4', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('204', 'Komunitas', 'master/master_komunitas/home', 'Data Komunitas', '+2+3', '5', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('205', 'Pasar', 'master/master_pasar/home', 'Data Pasar', '+2+3', '5', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('206', 'Lembaga Keuangan', 'master/master_lkm/home', 'Data Lembaga Keuangan', '+2+3', '6', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('207', 'Parameter', '#', '', '+2+3', '6', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('208', 'Jenis Sentra', 'master/master_jenissentra/home', 'Data Jenis Sentra', '+2+3', '3', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('209', 'Jenis Komunitas', 'master/master_jeniskomunitas/home', 'Data Jenis Komunitas', '+2+3', '2', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('210', 'Jenis L Keuangan', 'master/master_jenislk/home', 'Data Jenis Lembaga Keuangan', '+2+3', '5', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('211', 'Difabel', 'master/master_difabel/home', 'Difabel', '+2+3', '7', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('212', 'Pekerjaan', 'master/master_pekerjaan/home', 'Pekerjaan', '+2+3', '8', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('213', 'Instansi', 'master/master_instansi/home', 'Instansi', '+2+3', '9', '207', '0');
INSERT INTO `sec_menu_old` VALUES ('214', 'Bantuan', 'transaksi/trans_bantuan/home', 'Bantuan', '+2+3', '10', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('215', 'Report', 'laporan/lap_ktp/home', 'Laporan', '+2+3', '11', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('216', 'Pendidikan non formal', 'master/master_pend_non_formal_2/home', 'Pendidikan non formal', '+2+3', '12', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('217', 'Kematian', 'master/master_kematian/home', 'Kematian', '+2+3', '13', '64', '0');
INSERT INTO `sec_passwd` VALUES ('17', 'enji', '000001', 'ZW5qaTg4', '0', '1970-01-01', '2');
INSERT INTO `sec_passwd` VALUES ('40', 'mrizal', '000002', 'bXJpemFs', '0', '1970-01-01', '3');
INSERT INTO `sec_passwd` VALUES ('41', 'indri', '000003', 'ZGFuaXN0aGE=', '0', '1970-01-01', '4');
INSERT INTO `sec_passwd` VALUES ('42', 'adi', '000004', 'YWRpMTIz', '0', '1970-01-01', '5');
INSERT INTO `sec_passwd` VALUES ('43', 'quality', '000007', 'cXVhbGl0eTY=', '0', '1970-01-01', '6');
INSERT INTO `sec_passwd` VALUES ('44', 'aji', '000006', 'YWppMTIz', '0', '1970-01-01', '2');
INSERT INTO `sec_passwd` VALUES ('45', 'yeni', '000008', 'eWVuaTEyMw==', '0', '1970-01-01', '2');
INSERT INTO `sec_passwd` VALUES ('46', 'chandra', '000009', 'Y2hhbmRyYTEyMw==', '0', '1970-01-01', '7');
INSERT INTO `sec_passwd` VALUES ('47', 'indah', '000005', 'aW5kYWgxMQ==', '0', '1970-01-01', '3');
INSERT INTO `sec_passwd_new` VALUES ('17', 'enji', '000001', 'ZW5qaQ==', '0', '1970-01-01', '2');
INSERT INTO `sec_passwd_new` VALUES ('40', 'melisah', '000002', 'MDYxMjA4', '0', '1970-01-01', '3');
INSERT INTO `sec_passwd_new` VALUES ('41', 'indri', '000003', 'ZGFuaXN0aGE=', '0', '1970-01-01', '4');
INSERT INTO `sec_passwd_new` VALUES ('42', 'adi', '000004', 'YWRpMTIz', '0', '1970-01-01', '5');
INSERT INTO `sec_passwd_new` VALUES ('43', 'quality', '000007', 'cXVhbGl0eTY=', '0', '1970-01-01', '6');
INSERT INTO `sec_passwd_new` VALUES ('44', 'aji', '000006', 'YWppMTIz', '0', '1970-01-01', '2');
INSERT INTO `sec_passwd_new` VALUES ('45', 'yeni', '000008', 'eWVuaTEyMw==', '0', '1970-01-01', '2');
INSERT INTO `sec_passwd_new` VALUES ('46', 'chandra', '000009', 'Y2hhbmRyYTEyMw==', '0', '1970-01-01', '7');
INSERT INTO `sec_passwd_new` VALUES ('47', 'indah', '000005', 'aW5kYWgxMQ==', '0', '1970-01-01', '3');
INSERT INTO `sec_usergroup` VALUES ('1', 'Administrator');
INSERT INTO `sec_usergroup` VALUES ('2', 'Adm laundry');
INSERT INTO `sec_usergroup` VALUES ('3', 'Demo');
INSERT INTO `sec_usergroup` VALUES ('4', 'GA');
INSERT INTO `sec_usergroup` VALUES ('5', 'Distribusi');
INSERT INTO `sec_usergroup` VALUES ('6', 'QC');
INSERT INTO `sec_usergroup` VALUES ('7', 'PO Maker');
INSERT INTO `setting_laporan` VALUES ('1', 'MEGA JAYA LAUNDRY', 'Taman Wisma Asri 2', 'Jl. Hidrida Raya Blok DD 25 No. 11 - Bekasi Utara');
INSERT INTO `tbl_m_agama` VALUES ('0', 'Hindu');
INSERT INTO `tbl_m_agama` VALUES ('1', 'Islam');
INSERT INTO `tbl_m_agama` VALUES ('2', 'Khatolik');
INSERT INTO `tbl_m_agama` VALUES ('3', 'Kristen');
INSERT INTO `tbl_m_agama` VALUES ('4', 'Budha');
INSERT INTO `tbl_m_agama` VALUES ('5', 'Lain-lain');
INSERT INTO `tbl_m_difabel` VALUES ('000000', '-');
INSERT INTO `tbl_m_difabel` VALUES ('000001', 'Buta');
INSERT INTO `tbl_m_difabel` VALUES ('000002', 'Bisu');
INSERT INTO `tbl_m_difabel` VALUES ('000003', 'Tuli');
INSERT INTO `tbl_m_difabel` VALUES ('000004', 'Lumpuh');
INSERT INTO `tbl_m_instansi` VALUES ('000001', 'Dinas Sosial');
INSERT INTO `tbl_m_instansi` VALUES ('000002', 'Dinas Tenaga Kerja');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000001', 'Guru');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000002', 'Karyawan');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000003', 'Tani');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000004', 'Pedagang');
INSERT INTO `tbl_m_rumah` VALUES ('6', '123456', 'uploads/foto/f03367f1-be71-11e8-b64e-782bcbdbdcb7.jpg', '9346135d-be6f-11e8-b64e-782bcbdbdcb7');
INSERT INTO `tbl_m_rumah_temp` VALUES ('12', '123456', 'uploads/foto/f03367f1-be71-11e8-b64e-782bcbdbdcb7.jpg', '9346135d-be6f-11e8-b64e-782bcbdbdcb7');
INSERT INTO `tbl_r_hub_kel` VALUES ('1', 'KEPALA KELUARGA');
INSERT INTO `tbl_r_hub_kel` VALUES ('2', 'ISTRI');
INSERT INTO `tbl_r_hub_kel` VALUES ('3', 'ANAK');
INSERT INTO `tbl_r_hub_kel` VALUES ('4', 'Lainnya');
INSERT INTO `tbl_r_jns_bantuan` VALUES ('1', 'Training/Seminar');
INSERT INTO `tbl_r_jns_bantuan` VALUES ('2', 'Non Training');
INSERT INTO `tbl_r_pendidikan` VALUES ('0', 'Tidak Sekolah');
INSERT INTO `tbl_r_pendidikan` VALUES ('1', 'SD');
INSERT INTO `tbl_r_pendidikan` VALUES ('2', 'SLTP');
INSERT INTO `tbl_r_pendidikan` VALUES ('3', 'SLTA');
INSERT INTO `tbl_r_pendidikan` VALUES ('4', 'D3');
INSERT INTO `tbl_r_pendidikan` VALUES ('5', 'D4/S1');
INSERT INTO `tbl_r_pendidikan` VALUES ('6', 'S2');
INSERT INTO `tbl_r_pendidikan` VALUES ('7', 'S3');
INSERT INTO `tbl_r_pendidikan` VALUES ('8', 'Profesor');
INSERT INTO `tbl_r_status_nikah` VALUES ('0', 'Tdk/Blm Kawin');
INSERT INTO `tbl_r_status_nikah` VALUES ('1', 'Kawin');
INSERT INTO `tbl_r_status_nikah` VALUES ('2', 'Duda');
INSERT INTO `tbl_r_status_nikah` VALUES ('3', 'Janda');
INSERT INTO `tbl_t_anggota_komunitas` VALUES ('1', '000001', '7765', '74dad5ba-ca6e-11e8-b64e-782bcbdbdcb7');
INSERT INTO `tbl_t_anggota_komunitas_temp` VALUES ('2', '7765', '74dad5ba-ca6e-11e8-b64e-782bcbdbdcb7');
INSERT INTO `tbl_t_bantuan` VALUES ('6', '8b01a5b7-ca6e-11e8-b64e-782bcbdbdcb7', '1', '000002', '7765', '2018-10-08', 'Training dagang', '-', '40', '2018-10-08 10:16:14', null, null);
INSERT INTO `tbl_t_bantuan` VALUES ('7', '8b01a5b7-ca6e-11e8-b64e-782bcbdbdcb7', '1', '000002', '3211', '2018-10-08', 'Training dagang', '-', '40', '2018-10-08 10:16:14', null, null);
INSERT INTO `tbl_t_bantuan_temp` VALUES ('15', '8b01a5b7-ca6e-11e8-b64e-782bcbdbdcb7', null, '000002', '7765', '2018-10-08', 'Training dagang', '-', '40', '2018-10-08 20:26:47');
INSERT INTO `tbl_t_bantuan_temp` VALUES ('16', '8b01a5b7-ca6e-11e8-b64e-782bcbdbdcb7', null, '000002', '3211', '2018-10-08', 'Training dagang', '-', '40', '2018-10-08 20:26:47');
INSERT INTO `trans_kk` VALUES ('7', '123456', '3211', '0', '1', null, null, null, null, null, '9346135d-be6f-11e8-b64e-782bcbdbdcb7');
INSERT INTO `trans_kk` VALUES ('8', '123456', '7765', '0', '2', null, null, null, null, null, '9346135d-be6f-11e8-b64e-782bcbdbdcb7');
INSERT INTO `web_sysid` VALUES ('1', 'web_copyright_year', '2016');
INSERT INTO `web_sysid` VALUES ('2', 'web_copyright_content', 'MRZ@ Solution');
INSERT INTO `web_sysid` VALUES ('3', 'web_copyright_auth', 'ang');
INSERT INTO `web_sysid` VALUES ('4', 'web_lembaga_nama1', 'PT. Muhammad Rizal');
INSERT INTO `web_sysid` VALUES ('5', 'web_lembaga_nama2', '');
INSERT INTO `web_sysid` VALUES ('6', 'web_lembaga_nama3', '');
INSERT INTO `web_sysid` VALUES ('7', 'web_aplikasi_nama', '');
INSERT INTO `web_sysid` VALUES ('8', 'web_tanggal_hari_ini', '2016-06-02');
INSERT INTO `web_sysid` VALUES ('9', 'web_proses_denda', '2016-05-10');
INSERT INTO `web_sysid` VALUES ('10', 'web_proses_tunggakan', '2016-05-10');
INSERT INTO `web_sysid` VALUES ('11', 'usergroup_proses21', '7');
