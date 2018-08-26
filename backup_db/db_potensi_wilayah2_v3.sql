/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_potensi_wilayah2
Target Host: localhost
Target Database: db_potensi_wilayah2
Date: 8/27/2018 1:04:54 AM
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
-- Table structure for master_cm
-- ----------------------------
CREATE TABLE `master_cm` (
  `id_master_cm` char(50) NOT NULL,
  `no_bon_manual` char(10) NOT NULL DEFAULT '' COMMENT 'bon manual',
  `id_cust` char(10) NOT NULL DEFAULT '',
  `id_agen` char(10) NOT NULL DEFAULT '' COMMENT 'jika kosong = tanpa agen, dikerjakan sendiri',
  `id_kyw` char(6) NOT NULL DEFAULT '' COMMENT 'tukangsetrika',
  `id_outsource` char(10) NOT NULL DEFAULT '' COMMENT 'kosong = tanpa outsource, dikerjakan sendiri',
  `tgl_trans` date NOT NULL DEFAULT '0000-00-00' COMMENT 'tanggal po - input',
  `tgl_input` date NOT NULL DEFAULT '0000-00-00' COMMENT 'tanggal po/ kedatangan barang - sistem',
  `prioritas` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0  biasa, 1 express',
  `e_tgl_selesai` date NOT NULL DEFAULT '0000-00-00' COMMENT 'estimasi tanggal selesai',
  `tgl_selesai` date NOT NULL DEFAULT '0000-00-00' COMMENT 'tanggal selesai',
  `tgl_ambil` date NOT NULL DEFAULT '0000-00-00' COMMENT 'tanggal pengambilan',
  `waktu_masuk` char(10) NOT NULL DEFAULT '',
  `waktu_selesai` char(10) NOT NULL DEFAULT '',
  `waktu_ambil` char(10) NOT NULL DEFAULT '',
  `tgl_outsource_keluar` date NOT NULL DEFAULT '0000-00-00' COMMENT 'tgl jika dioutsource, diseahkan oleh pihakoutsource',
  `tgl_outsource_masuk` date NOT NULL DEFAULT '0000-00-00' COMMENT 'tgl jika pekerjaan outsourc selesai',
  `total_qty_kg` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_qty_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_harga_kg` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_harga_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `setrika_kg` decimal(15,2) NOT NULL DEFAULT '0.00',
  `setrika_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `diskon` decimal(15,2) NOT NULL DEFAULT '0.00',
  `jml_bayar` decimal(15,2) NOT NULL DEFAULT '0.00',
  `berat_ambil` decimal(15,2) NOT NULL DEFAULT '0.00',
  `berat_setrika` decimal(15,2) NOT NULL DEFAULT '0.00',
  `satuan_setrika` int(3) NOT NULL DEFAULT '0',
  `ket_cm` varchar(100) NOT NULL DEFAULT '' COMMENT 'keterangan cucian masuk',
  `ket_ambil` varchar(100) NOT NULL DEFAULT '' COMMENT 'keterangan ambil cucian',
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT 'user input',
  `status_selesai` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 blmselesai, 1 sudah selesai',
  `status_ambil` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 masuk, 1 ambil',
  `status_outsource` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 tidak outsource, 1 keluar dr londri, 2 masuk ke londri',
  `status_bayar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 belum bayar, 1 sudah',
  `status_bon` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 tidak bawa, 1 bawa bon ',
  PRIMARY KEY (`id_master_cm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Cucian Masuk';

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
  `warga_negara` char(45) DEFAULT '',
  `link_gambar` varchar(100) DEFAULT NULL,
  `is_delete` char(1) DEFAULT '1',
  PRIMARY KEY (`id_ktp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
-- Table structure for tbl_m_bantuan
-- ----------------------------
CREATE TABLE `tbl_m_bantuan` (
  `id_bantuan` char(10) NOT NULL,
  `nama_bantuan` varchar(45) NOT NULL,
  PRIMARY KEY (`id_bantuan`)
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
-- Table structure for tbl_m_pekerjaan
-- ----------------------------
CREATE TABLE `tbl_m_pekerjaan` (
  `id_pekerjaan` char(10) NOT NULL,
  `nama_pekerjaan` varchar(45) NOT NULL,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_r_hub_kel
-- ----------------------------
CREATE TABLE `tbl_r_hub_kel` (
  `id_hub_kel` tinyint(1) NOT NULL,
  `nama_hub_kel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_hub_kel`)
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
-- Table structure for tbl_t_bantuan
-- ----------------------------
CREATE TABLE `tbl_t_bantuan` (
  `id_t_bantuan` tinyint(4) NOT NULL AUTO_INCREMENT,
  `idsession` varchar(50) DEFAULT NULL,
  `id_m_bantuan` char(10) DEFAULT NULL,
  `id_ktp` char(25) DEFAULT NULL,
  `tgl_bantuan` date DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `last_update_by` varchar(50) DEFAULT NULL,
  `last_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_t_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_t_bantuan_temp
-- ----------------------------
CREATE TABLE `tbl_t_bantuan_temp` (
  `id_t_bantuan` tinyint(4) NOT NULL AUTO_INCREMENT,
  `idsession` varchar(50) DEFAULT NULL,
  `id_m_bantuan` char(10) DEFAULT NULL,
  `id_ktp` char(25) DEFAULT NULL,
  `tgl_bantuan` date DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_t_bantuan`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

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
-- Table structure for trans_cm
-- ----------------------------
CREATE TABLE `trans_cm` (
  `id_trans` char(50) NOT NULL DEFAULT '',
  `id_master` char(50) NOT NULL DEFAULT '',
  `id_produk` char(10) NOT NULL DEFAULT '',
  `id_layanan` tinyint(2) NOT NULL DEFAULT '1',
  `kode_trans` char(10) NOT NULL DEFAULT '100' COMMENT '100= in ; 200 ; out',
  `tgl_trans` date NOT NULL DEFAULT '0000-00-00',
  `tgl_input` date NOT NULL DEFAULT '0000-00-00',
  `qty` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'qty kedatangan',
  `harga_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status_outsource` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 tidak, 1 ya'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for trans_detail_perk
-- ----------------------------
CREATE TABLE `trans_detail_perk` (
  `id_trans` varchar(30) NOT NULL,
  `tgl_trans` date NOT NULL DEFAULT '0000-00-00',
  `tgl_input` date NOT NULL DEFAULT '0000-00-00',
  `no_invoice` varchar(50) NOT NULL DEFAULT '',
  `id_trans_invoice` varchar(50) NOT NULL DEFAULT '',
  `modul` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 =  Jurnal Request, 2 = Jurnal AR',
  `trans_id` char(20) NOT NULL DEFAULT '',
  `kode_jurnal` tinyint(1) NOT NULL DEFAULT '1',
  `kode_perk` char(20) NOT NULL DEFAULT '',
  `keterangan` varchar(255) NOT NULL DEFAULT '',
  `deskripsi` varchar(255) NOT NULL DEFAULT '',
  `NoReferensi` varchar(100) NOT NULL DEFAULT '',
  `debet` decimal(15,2) NOT NULL DEFAULT '0.00',
  `kredit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `saldo_akhir` decimal(15,2) NOT NULL DEFAULT '0.00',
  `post` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_trans`)
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
  PRIMARY KEY (`idtrans_kk`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for utility_db
-- ----------------------------
CREATE TABLE `utility_db` (
  `id_utility` int(11) NOT NULL AUTO_INCREMENT,
  `nama_file` char(50) NOT NULL DEFAULT '',
  `direktori` text NOT NULL,
  `tgl_backup` date NOT NULL DEFAULT '0000-00-00',
  `time_backup` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`id_utility`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

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
-- Table structure for web_temp
-- ----------------------------
CREATE TABLE `web_temp` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) DEFAULT '0',
  `tanggal` date DEFAULT '0000-00-00',
  `kode_perk` char(20) DEFAULT '',
  `kode_alt` char(20) DEFAULT '',
  `nama_perk` char(55) DEFAULT '',
  `type` char(1) DEFAULT '',
  `level` tinyint(1) DEFAULT '0',
  `kode_induk` char(20) DEFAULT '',
  `saldo_akhir` decimal(15,2) DEFAULT '0.00',
  `kode_perk_psv` char(20) DEFAULT '',
  `kode_alt_psv` char(20) DEFAULT '',
  `nama_perk_psv` char(55) DEFAULT '',
  `type_psv` char(1) DEFAULT '',
  `level_psv` tinyint(1) DEFAULT '0',
  `kode_induk_psv` char(20) DEFAULT '',
  `saldo_akhir_psv` decimal(15,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for web_temp_laba_rugi
-- ----------------------------
CREATE TABLE `web_temp_laba_rugi` (
  `user_id` int(3) DEFAULT '0',
  `tanggal` date DEFAULT '0000-00-00',
  `kode_perk` char(20) DEFAULT '',
  `kode_alt` char(20) DEFAULT '',
  `nama_perk` char(55) DEFAULT '',
  `type` char(1) DEFAULT '',
  `level` tinyint(1) DEFAULT '0',
  `kode_induk` char(20) DEFAULT '',
  `saldo_akhir` decimal(15,2) DEFAULT '0.00',
  `realisasi_a` decimal(15,2) DEFAULT '0.00',
  `realisasi_b` decimal(15,2) DEFAULT '0.00',
  `budget_a` decimal(15,2) DEFAULT '0.00',
  `budget_b` decimal(15,2) DEFAULT '0.00',
  `sisi` char(50) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for web_temp_perkiraan
-- ----------------------------
CREATE TABLE `web_temp_perkiraan` (
  `user_id` int(3) DEFAULT '0',
  `tanggal` date DEFAULT '0000-00-00',
  `kode_perk` char(20) DEFAULT '',
  `kode_alt` char(20) DEFAULT '',
  `nama_perk` char(55) DEFAULT '',
  `type` char(1) DEFAULT '',
  `level` tinyint(1) DEFAULT '0',
  `kode_induk` char(20) DEFAULT '',
  `saldo_akhir` decimal(15,2) DEFAULT '0.00',
  `sisi` char(50) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- View structure for vw_t_bantuan
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_bantuan` AS select `a`.`id_t_bantuan` AS `id_t_bantuan`,`a`.`id_m_bantuan` AS `id_m_bantuan`,`b`.`nama_bantuan` AS `nama_bantuan`,`a`.`id_ktp` AS `id_ktp`,date_format(`a`.`tgl_bantuan`,'%d-%m-%Y') AS `tgl_bantuan`,`a`.`idsession` AS `idsession`,`c`.`nama_ktp` AS `nama_ktp`,`c`.`tempat_lahir` AS `tempat_lahir`,`c`.`tanggal_lahir` AS `tanggal_lahir`,`c`.`jekel` AS `jekel`,`c`.`gol_darah` AS `gol_darah`,`c`.`alamat` AS `alamat`,`c`.`rt` AS `rt`,`c`.`rw` AS `rw`,`c`.`id_kel` AS `id_kel`,`c`.`id_kec` AS `id_kec`,`c`.`agama` AS `agama`,`c`.`status_kawin` AS `status_kawin`,`c`.`pekerjaan` AS `pekerjaan`,`c`.`warga_negara` AS `warga_negara`,`c`.`link_gambar` AS `link_gambar`,`c`.`is_delete` AS `is_delete` from ((`tbl_t_bantuan` `a` join `tbl_m_bantuan` `b` on((`a`.`id_m_bantuan` = `b`.`id_bantuan`))) join `master_ktp` `c` on((`a`.`id_ktp` = `c`.`id_ktp`)));

-- ----------------------------
-- View structure for vw_t_bantuan_temp
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_bantuan_temp` AS select `a`.`id_t_bantuan` AS `id_t_bantuan`,`a`.`id_m_bantuan` AS `id_m_bantuan`,`b`.`nama_bantuan` AS `nama_bantuan`,`a`.`id_ktp` AS `id_ktp`,`a`.`tgl_bantuan` AS `tgl_bantuan`,`a`.`idsession` AS `idsession`,`c`.`nama_ktp` AS `nama_ktp`,`c`.`tempat_lahir` AS `tempat_lahir`,`c`.`tanggal_lahir` AS `tanggal_lahir`,`c`.`jekel` AS `jekel`,`c`.`gol_darah` AS `gol_darah`,`c`.`alamat` AS `alamat`,`c`.`rt` AS `rt`,`c`.`rw` AS `rw`,`c`.`id_kel` AS `id_kel`,`c`.`id_kec` AS `id_kec`,`c`.`agama` AS `agama`,`c`.`status_kawin` AS `status_kawin`,`c`.`pekerjaan` AS `pekerjaan`,`c`.`warga_negara` AS `warga_negara`,`c`.`link_gambar` AS `link_gambar`,`c`.`is_delete` AS `is_delete` from ((`tbl_t_bantuan_temp` `a` join `tbl_m_bantuan` `b` on((`a`.`id_m_bantuan` = `b`.`id_bantuan`))) join `master_ktp` `c` on((`a`.`id_ktp` = `c`.`id_ktp`)));

-- ----------------------------
-- View structure for vw_t_kk
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_kk` AS select `a`.`idtrans_kk` AS `idtrans_kk`,`a`.`id_master_kk` AS `id_master_kk`,`a`.`id_ktp` AS `id_ktp`,`a`.`pendidikan` AS `pendidikan`,`k`.`nama_pend` AS `nama_pend`,`a`.`hub_keluarga` AS `hub_keluarga`,`f`.`nama_hub_kel` AS `nama_hub_kel`,`a`.`no_paspor` AS `no_paspor`,`a`.`no_kitap` AS `no_kitap`,`a`.`ayah` AS `ayah`,`a`.`ibu` AS `ibu`,`a`.`rumah_path` AS `rumah_path`,`b`.`nama_ktp` AS `nama_ktp`,`b`.`tempat_lahir` AS `tempat_lahir`,`b`.`tanggal_lahir` AS `tanggal_lahir`,`b`.`jekel` AS `jekel`,`b`.`gol_darah` AS `gol_darah`,`b`.`alamat` AS `alamat`,`b`.`rt` AS `rt`,`b`.`rw` AS `rw`,`b`.`id_kel` AS `id_kel`,`g`.`nama_kel` AS `nama_kel`,`b`.`id_kec` AS `id_kec`,`h`.`nama_kec` AS `nama_kec`,`b`.`agama` AS `agama`,`i`.`nama_agama` AS `nama_agama`,`b`.`status_kawin` AS `status_kawin`,`j`.`nama_nikah` AS `nama_nikah`,`b`.`pekerjaan` AS `pekerjaan`,(case when (`b`.`warga_negara` = 0) then 'WNI' else 'WNA' end) AS `warga_negara`,`b`.`warga_negara` AS `warga_negara_`,`b`.`link_gambar` AS `link_gambar`,`b`.`is_delete` AS `is_delete`,(select count(1) from `trans_kk` `z` where (`z`.`id_master_kk` = `a`.`id_master_kk`)) AS `jml_anggota_keluarga`,`l`.`nama_pekerjaan` AS `nama_pekerjaan` from ((((((((`trans_kk` `a` join `master_ktp` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) left join `tbl_r_hub_kel` `f` on((`a`.`hub_keluarga` = `f`.`id_hub_kel`))) left join `master_kelurahan` `g` on((`b`.`id_kel` = `g`.`id_kel`))) left join `master_kecamatan` `h` on((`b`.`id_kec` = `h`.`id_kec`))) left join `tbl_m_agama` `i` on((`b`.`agama` = `i`.`id_agama`))) left join `tbl_r_status_nikah` `j` on((`b`.`status_kawin` = `j`.`id_nikah`))) left join `tbl_r_pendidikan` `k` on((`a`.`pendidikan` = `k`.`id_pend`))) left join `tbl_m_pekerjaan` `l` on((`b`.`pekerjaan` = `l`.`id_pekerjaan`)));

-- ----------------------------
-- View structure for vw_t_kk_old
-- ----------------------------
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_t_kk_old` AS select `a`.`idtrans_kk` AS `idtrans_kk`,`a`.`id_master_kk` AS `id_master_kk`,`a`.`id_ktp` AS `id_ktp`,`a`.`pendidikan` AS `pendidikan`,`k`.`nama_pend` AS `nama_pend`,`a`.`hub_keluarga` AS `hub_keluarga`,`f`.`nama_hub_kel` AS `nama_hub_kel`,`a`.`no_paspor` AS `no_paspor`,`a`.`no_kitap` AS `no_kitap`,`a`.`ayah` AS `ayah`,`a`.`ibu` AS `ibu`,`a`.`rumah_path` AS `rumah_path`,`b`.`nama_ktp` AS `nama_ktp`,`b`.`tempat_lahir` AS `tempat_lahir`,`b`.`tanggal_lahir` AS `tanggal_lahir`,`b`.`jekel` AS `jekel`,`b`.`gol_darah` AS `gol_darah`,`b`.`alamat` AS `alamat`,`b`.`rt` AS `rt`,`b`.`rw` AS `rw`,`b`.`id_kel` AS `id_kel`,`g`.`nama_kel` AS `nama_kel`,`b`.`id_kec` AS `id_kec`,`h`.`nama_kec` AS `nama_kec`,`b`.`agama` AS `agama`,`i`.`nama_agama` AS `nama_agama`,`b`.`status_kawin` AS `status_kawin`,`j`.`nama_nikah` AS `nama_nikah`,`b`.`pekerjaan` AS `pekerjaan`,`b`.`warga_negara` AS `warga_negara`,`b`.`link_gambar` AS `link_gambar`,`b`.`status_hidup` AS `status_hidup`,`c`.`id_t_difabel` AS `id_t_difabel`,`c`.`id_m_difabel` AS `id_m_difabel`,`d`.`nama_difabel` AS `nama_difabel`,`e`.`bantuan_desc` AS `bantuan_desc`,(select count(1) from `trans_kk` `z` where (`z`.`id_master_kk` = `a`.`id_master_kk`)) AS `jml_anggota_keluarga` from ((((((((((`trans_kk` `a` join `master_ktp` `b` on((`a`.`id_ktp` = `b`.`id_ktp`))) left join `tbl_t_difabel` `c` on((`a`.`id_ktp` = `c`.`id_ktp`))) left join `tbl_m_difabel` `d` on((`c`.`id_m_difabel` = `d`.`id_difabel`))) left join `tbl_t_bantuan` `e` on((`a`.`id_ktp` = `e`.`id_ktp`))) left join `tbl_r_hub_kel` `f` on((`a`.`hub_keluarga` = `f`.`id_hub_kel`))) left join `master_kelurahan` `g` on((`b`.`id_kel` = `g`.`id_kel`))) left join `master_kecamatan` `h` on((`b`.`id_kec` = `h`.`id_kec`))) left join `tbl_m_agama` `i` on((`b`.`agama` = `i`.`id_agama`))) left join `tbl_r_status_nikah` `j` on((`b`.`status_kawin` = `j`.`id_nikah`))) left join `tbl_r_pendidikan` `k` on((`a`.`pendidikan` = `k`.`id_pend`)));

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
(id_m_bantuan,idsession,id_ktp,tgl_bantuan,create_by,create_date) 
SELECT id_m_bantuan,s_session,id_ktp,tgl_bantuan,s_user,now() 
FROM tbl_t_bantuan
WHERE idsession=s_session;

END;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for zsp_simpan_bantuan
-- ----------------------------
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `zsp_simpan_bantuan`(
s_user varchar(50),
s_session varchar(50)
)
BEGIN
DELETE FROM tbl_t_bantuan
WHERE idsession=s_session;

INSERT INTO tbl_t_bantuan 
(id_m_bantuan,idsession,id_ktp,tgl_bantuan,create_by,create_date) 
SELECT id_m_bantuan,s_session,id_ktp,tgl_bantuan,s_user,now() 
FROM tbl_t_bantuan_temp 
WHERE idsession=s_session;

DELETE FROM tbl_t_bantuan_temp 
WHERE idsession=s_session;
 
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
INSERT INTO `master_cm` VALUES ('CM-0000001-0170', '', '', '', '', '', '1970-01-01', '2018-08-17', '0', '1970-01-01', '0000-00-00', '0000-00-00', '00:50:16', '', '00:50:16', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000002-0170', '', '', '', '', '', '1970-01-01', '2018-08-17', '0', '1970-01-01', '0000-00-00', '0000-00-00', '00:50:42', '', '00:50:42', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000003-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '00:54:24', '', '00:54:24', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000004-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '02:47:36', '', '02:47:36', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000005-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '02:49:56', '', '02:49:56', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000006-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '02:51:06', '', '02:51:06', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000007-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '02:58:50', '', '02:58:50', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000008-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '03:00:40', '', '03:00:40', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000009-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '03:01:19', '', '03:01:19', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000010-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '03:01:39', '', '03:01:39', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000011-0170', '', '', '', '', '', '1970-01-01', '2018-08-18', '0', '1970-01-01', '0000-00-00', '0000-00-00', '03:02:20', '', '03:02:20', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '17', '0', '0', '0', '0', '0');
INSERT INTO `master_cm` VALUES ('CM-0000012-0170', '', '', '', '', '', '1970-01-01', '2018-08-26', '0', '1970-01-01', '0000-00-00', '0000-00-00', '16:18:48', '', '16:18:48', '0000-00-00', '0000-00-00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0', '', '', '40', '0', '0', '0', '0', '0');
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
INSERT INTO `master_kk` VALUES ('3276000980007', '3456555556666666', 'Angga Saputra', '5');
INSERT INTO `master_komunitas` VALUES ('000001', 'K Pencinta Anjing Herder', '', '5105040', '5105040006', 'Ruly Siantana', '0811552289', '000001');
INSERT INTO `master_komunitas` VALUES ('000002', 'K Pecinta Kucing Angora', '', '5105030', '5105030007', 'Riyan D Masiv', '087778989156', '000001');
INSERT INTO `master_komunitas` VALUES ('000003', 'KOmunitas Motor Harley Klungkung 008', 'Klungkung', '5105030', '5105030008', 'Komang Agung', '', '000002');
INSERT INTO `master_komunitas` VALUES ('000004', 'Komunitas Mobil Jadul', 'Nusapenida', '5105010', '5105010007', 'Komang karet', '', '000003');
INSERT INTO `master_ktp` VALUES ('444', 'ekop', 'sjdfjk', '2018-08-25', '0', 'O', 'bekasi', '9', '10', '5105010001', '5105010', '0', '0', '000001', '0', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg', '0');
INSERT INTO `master_ktp` VALUES ('778', 'yooo', 'bekasi', '2018-08-25', '1', 'B', 'Bekasi 2', '8', '90', '5105020004', '5105020', '0', '1', '000003', '1', 'uploads/foto/6e1e0129-a82e-11e8-b821-782bcbdbdcb7.jpg', '0');
INSERT INTO `master_ktp` VALUES ('889889', 'kjsdbhj', 'ksdbj', '2018-08-25', '0', 'O', 'bekasi', '9', '10', '5105010001', '5105010', '0', '0', '000001', '0', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg', '1');
INSERT INTO `master_ktp` VALUES ('90', 'iio', 'sjbd', '2018-08-25', '0', 'O', 'bekasi', '9', '10', '5105010001', '5105010', '0', '0', '000001', '0', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg', '0');
INSERT INTO `master_ktp` VALUES ('999', 'SJDBK', 'LSDFJ', '2018-08-22', '0', 'O', 'bekasi', '9', '10', '5105010001', '5105010', '0', '0', '000001', '1', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg', '0');
INSERT INTO `master_ktp` VALUES ('999999', 'sdfkj', 'fsbk', '2018-08-25', '0', 'O', 'bekasi', '9', '10', '5105010001', '5105010', '0', '1', '000001', '0', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg', '1');
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
INSERT INTO `sec_menu` VALUES ('1', 'Konfigurasi', '#', '', '+1+2', '5', '0', '0');
INSERT INTO `sec_menu` VALUES ('2', 'Group User', 'admin/sec_group_user/home', 'Konfigurasi Group User', '+1+2', '1', '1', '0');
INSERT INTO `sec_menu` VALUES ('3', 'Group Menu', 'admin/konfigurasi_menu_status_user/home', 'Konfigurasi Group Menu', '+1+2', '2', '1', '0');
INSERT INTO `sec_menu` VALUES ('4', 'Menu', 'admin/sec_menu_user/home', 'Konfigurasi Menu', '+1+2', '3', '1', '0');
INSERT INTO `sec_menu` VALUES ('5', 'User', 'sec_user/home', 'Konfigurasi User', '+1+2', '4', '1', '0');
INSERT INTO `sec_menu` VALUES ('63', 'Karyawan', 'master_karyawan/home', 'Master Karyawan', '+1+2', '8', '1', '0');
INSERT INTO `sec_menu` VALUES ('64', 'Data master', '#', '', '+4+5+1+2+3', '7', '0', '0');
INSERT INTO `sec_menu` VALUES ('85', 'Departement', 'master_dept/home', 'Data Master Departement', '+1+2', '16', '1', '0');
INSERT INTO `sec_menu` VALUES ('97', 'Laporan', '#', '', '+4+5+6+1+2', '14', '0', '0');
INSERT INTO `sec_menu` VALUES ('126', 'Transaksi', '#', '', '+7+4+5+6+1+2', '8', '0', '0');
INSERT INTO `sec_menu` VALUES ('142', 'Agen', 'master/master_agen/home', 'Data Master Agen', '+1+2', '7', '64', '0');
INSERT INTO `sec_menu` VALUES ('144', 'Laba Rugi', 'laporan/laporan_laba_rugi/home', 'Laporan Laba Rugi', '0+4+5+6+1+2', '5', '97', '0');
INSERT INTO `sec_menu` VALUES ('145', 'Utilitas', '#', '', '+1+2', '16', '0', '0');
INSERT INTO `sec_menu` VALUES ('146', 'Backup DB', 'utility/utility_db/home', 'Proses Backup DB', '+1+2', '1', '145', '0');
INSERT INTO `sec_menu` VALUES ('147', 'Restore DB', 'utility/restore_db/home', 'Proses Restore DB', '+1', '2', '145', '0');
INSERT INTO `sec_menu` VALUES ('153', 'Supplier', 'master/master_supplier/home', 'Data Master Supplier', '+1', '6', '64', '0');
INSERT INTO `sec_menu` VALUES ('155', 'Pengeluaran produk', 'transaksi/trans_keluar/home', 'Data pengeluaran produk ke customer', '', '19', '126', '0');
INSERT INTO `sec_menu` VALUES ('156', 'Pencampuran produk', 'transaksi/trans_campur/home', 'Data pencampuran produk', '+1', '20', '126', '0');
INSERT INTO `sec_menu` VALUES ('157', 'Posisi Keuangan', 'laporan/laporan_neraca_c/home', 'Laporan Posisi Keuangan', '+1+2', '4', '97', '0');
INSERT INTO `sec_menu` VALUES ('158', 'Cucian Masuk', 'transaksi/trans_po/home', 'Transaksi Penerimaan Cucian', '+7+1+2', '4', '126', '0');
INSERT INTO `sec_menu` VALUES ('159', 'Biaya Operasional', 'transaksi/trans_biaya/home', 'Form Input Biaya Transaksi Operasional', '+1+2', '6', '126', '0');
INSERT INTO `sec_menu` VALUES ('160', 'Hapus Transaksi', 'transaksi/hapus_trans/home', 'Form Hapus Transaksi', '+1+2', '7', '126', '0');
INSERT INTO `sec_menu` VALUES ('161', 'Cucian -', 'transaksi/sales_order/home', 'Transaksi Penerimaan Cucian', '+1', '8', '126', '0');
INSERT INTO `sec_menu` VALUES ('162', 'Packaging Pengiriman', 'transaksi/packaging/home', 'Packaging Pengiriman', '+1', '17', '126', '0');
INSERT INTO `sec_menu` VALUES ('163', 'Approval Pengiriman', 'transaksi/trans_app_kirim/home', 'Approval Pengiriman', '+1', '18', '126', '0');
INSERT INTO `sec_menu` VALUES ('165', 'Customer', 'master/master_cust/home', 'Data Master Customer', '+4+1+2', '7', '64', '0');
INSERT INTO `sec_menu` VALUES ('166', 'Produk', 'master/master_produk/home', 'Data Master Jasa Satuan', '+4+5+1+2', '8', '64', '0');
INSERT INTO `sec_menu` VALUES ('167', 'Perkiraan', 'master/master_perkiraan/home', 'Data Master Perkiraan', '+1+2', '9', '64', '0');
INSERT INTO `sec_menu` VALUES ('168', 'Dashboard', '#', '', '+7+4+5+6+1+2+3', '4', '0', '0');
INSERT INTO `sec_menu` VALUES ('169', 'Stok Akhir', 'main/index', 'Dashboard ketersediaan produk', '+7+4+5+6+1+2', '6', '168', '0');
INSERT INTO `sec_menu` VALUES ('170', 'Layar Penuh', 'main/dashboard', 'Dashboard Potensi Wilayah', '+7+4+5+6+1+2+3', '7', '168', '0');
INSERT INTO `sec_menu` VALUES ('171', 'GA Cukai', 'transaksi/ganocukai/home', 'Form Input No Cukai', '+4+1', '9', '126', '0');
INSERT INTO `sec_menu` VALUES ('172', 'Batch Input', 'transaksi/labnobatch/home', 'Form Input No Batch', '+6+1', '10', '126', '0');
INSERT INTO `sec_menu` VALUES ('173', 'Distribusi', 'transaksi/distribusi/home', 'Distribusi', '+5+1', '12', '126', '0');
INSERT INTO `sec_menu` VALUES ('181', 'Outsource', 'master/master_outsource/home', 'Data Master Eksternal', '+1+2', '13', '64', '0');
INSERT INTO `sec_menu` VALUES ('182', 'Integrasi Jurnal', 'admin/integrasi_jurnal/home', 'Konfigurasi Integrasi Jurnal', '+1+2', '18', '1', '0');
INSERT INTO `sec_menu` VALUES ('183', 'Form Cukai', '#', '', '', '13', '0', '0');
INSERT INTO `sec_menu` VALUES ('184', 'Kedatangan', 'cukai/trans_masuk/home', 'Form Kedatangan Barang (Cukai)', '', '5', '183', '0');
INSERT INTO `sec_menu` VALUES ('185', 'Pengeluaran produk', 'cukai/trans_keluar/home', 'Form Pengeluaran Produk (Cukai)', '', '6', '183', '0');
INSERT INTO `sec_menu` VALUES ('186', 'Stok Cukai', 'main/stokcukai', 'Dashboard Stok Cukai', '+1', '8', '168', '0');
INSERT INTO `sec_menu` VALUES ('187', 'Keuangan', '#', '', '+1+2', '12', '0', '0');
INSERT INTO `sec_menu` VALUES ('188', 'Koreksi Jurnal', 'akuntansi/koreksi_jurnal/home', 'Koreksi Jurnal', '+1+2', '6', '187', '0');
INSERT INTO `sec_menu` VALUES ('189', 'Agen', 'laporan/lap_piutang_agen/home', 'Laporan Piutang Agen', '+4+5+6+1+2', '8', '97', '0');
INSERT INTO `sec_menu` VALUES ('190', 'Outsource', 'laporan/lap_hutang_outsource/home', 'Laporan Hutang Outsource', '+4+5+6+1+2', '8', '97', '0');
INSERT INTO `sec_menu` VALUES ('191', 'Jasa Karyawan', 'laporan/lap_jasa_kyw/home', 'Laporan Jasa Karyawan', '+4+5+1+2', '9', '97', '0');
INSERT INTO `sec_menu` VALUES ('192', 'Biaya Transaksi', 'laporan/lap_biaya_trans/home', 'Laporan Biaya Transaksi', '+1+2', '10', '97', '0');
INSERT INTO `sec_menu` VALUES ('193', 'Semua Cucian', 'laporan/lap_allcucian/home', 'Laporan Semua Cucian', '+1+2', '11', '97', '0');
INSERT INTO `sec_menu` VALUES ('194', 'Pengambilan', 'laporan/lap_trans_ambil/home', 'Laporan Transaksi Pengambilan', '+1+2', '6', '97', '0');
INSERT INTO `sec_menu` VALUES ('195', 'Mutasi Gudang', 'transaksi/mutgudang/home', 'Form Mutasi Gudang', '+1', '21', '126', '0');
INSERT INTO `sec_menu` VALUES ('196', 'Adjustment Produk', 'transaksi/adjustment/home', 'Adjustment Pengeluaran Barang', '+1', '22', '126', '0');
INSERT INTO `sec_menu` VALUES ('197', 'Jurnal', 'akuntansi/akuntansi/home', 'Penjurnalan', '+1+2', '5', '187', '0');
INSERT INTO `sec_menu` VALUES ('198', 'Jenis Transaksi', 'admin/jns_trans/home', 'Form Input Jenis Transaksi', '+2', '19', '1', '0');
INSERT INTO `sec_menu` VALUES ('199', 'Kecamatan', 'master/master_kecamatan/home', 'Master Kecamatan', '+2+3', '1', '64', '0');
INSERT INTO `sec_menu` VALUES ('200', 'Kelurahan', 'master/master_kelurahan/home', 'Data Kelurahan', '+2+3', '2', '64', '0');
INSERT INTO `sec_menu` VALUES ('201', 'KTP', 'master/master_ktp/home', 'Master Data KTP', '+2+3', '3', '64', '0');
INSERT INTO `sec_menu` VALUES ('202', 'KK', 'transaksi/trans_kk/home', 'Data Master Kartu Keluarga', '+2+3', '3', '64', '0');
INSERT INTO `sec_menu` VALUES ('203', 'Sentra Usaha', 'master/master_su/home', 'Data Sentra Usaha', '+2+3', '4', '64', '0');
INSERT INTO `sec_menu` VALUES ('204', 'Komunitas', 'master/master_komunitas/home', 'Data Komunitas', '+2+3', '5', '64', '0');
INSERT INTO `sec_menu` VALUES ('205', 'Pasar', 'master/master_pasar/home', 'Data Pasar', '+2+3', '5', '64', '0');
INSERT INTO `sec_menu` VALUES ('206', 'Lembaga Keuangan', 'master/master_lkm/home', 'Data Lembaga Keuangan', '+2+3', '6', '64', '0');
INSERT INTO `sec_menu` VALUES ('207', 'Parameter', '#', '', '+2+3', '6', '0', '0');
INSERT INTO `sec_menu` VALUES ('208', 'Jenis Sentra', 'master/master_jenissentra/home', 'Data Jenis Sentra', '+2+3', '3', '207', '0');
INSERT INTO `sec_menu` VALUES ('209', 'Jenis Komunitas', 'master/master_jeniskomunitas/home', 'Data Jenis Komunitas', '+2+3', '2', '207', '0');
INSERT INTO `sec_menu` VALUES ('210', 'Jenis L Keuangan', 'master/master_jenislk/home', 'Data Jenis Lembaga Keuangan', '+2+3', '5', '207', '0');
INSERT INTO `sec_menu` VALUES ('211', 'Difabel', 'master/master_difabel/home', 'Difabel', '+2+3', '7', '64', '0');
INSERT INTO `sec_menu` VALUES ('212', 'Pekerjaan', 'master/master_pekerjaan/home', 'Pekerjaan', '+2+3', '8', '64', '0');
INSERT INTO `sec_menu` VALUES ('213', 'Bantuan', 'master/master_bantuan/home', 'Bantuan', '+2+3', '9', '64', '0');
INSERT INTO `sec_menu` VALUES ('214', 'Trans Bantuan', 'transaksi/trans_bantuan/home', 'Trans Bantuan', '+2+3', '10', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('1', 'Konfigurasi', '#', '', '+1+2', '6', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('2', 'Group User', 'admin/sec_group_user/home', 'Konfigurasi Group User', '+1+2', '1', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('3', 'Group Menu', 'admin/konfigurasi_menu_status_user/home', 'Konfigurasi Group Menu', '+1+2', '2', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('4', 'Menu', 'admin/sec_menu_user/home', 'Konfigurasi Menu', '+1+2', '3', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('5', 'User', 'sec_user/home', 'Konfigurasi User', '+1+2', '4', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('63', 'Karyawan', 'master_karyawan/home', 'Master Karyawan', '+1+2', '8', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('64', 'Data master', '#', '', '+4+5+1+2+3', '7', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('85', 'Departement', 'master_dept/home', 'Data Master Departement', '+1+2', '16', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('97', 'Laporan', '#', '', '+4+5+6+1+2+3', '14', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('126', 'Transaksi', '#', '', '+7+4+5+6+1+2+3', '8', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('142', 'Agen', 'master/master_agen/home', 'Data Master Agen', '+1+2+3', '7', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('144', 'Laba Rugi', 'laporan/laporan_laba_rugi/home', 'Laporan Laba Rugi', '0+4+5+6+1+2', '5', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('145', 'Utilitas', '#', '', '+1+2', '16', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('146', 'Backup DB', 'utility/utility_db/home', 'Proses Backup DB', '+1+2', '1', '145', '0');
INSERT INTO `sec_menu_old` VALUES ('147', 'Restore DB', 'utility/restore_db/home', 'Proses Restore DB', '+1', '2', '145', '0');
INSERT INTO `sec_menu_old` VALUES ('153', 'Supplier', 'master/master_supplier/home', 'Data Master Supplier', '+1+2+3', '6', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('155', 'Pengeluaran produk', 'transaksi/trans_keluar/home', 'Data pengeluaran produk ke customer', '', '19', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('156', 'Pencampuran produk', 'transaksi/trans_campur/home', 'Data pencampuran produk', '+1', '20', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('157', 'Posisi Keuangan', 'laporan/laporan_neraca_c/home', 'Laporan Posisi Keuangan', '+1+2', '4', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('158', 'Cucian Masuk', 'transaksi/trans_po/home', 'Transaksi Penerimaan Cucian', '+7+1+2+3', '4', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('159', 'Biaya Operasional', 'transaksi/trans_biaya/home', 'Form Input Biaya Transaksi Operasional', '+1+2+3', '6', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('160', 'Kedatangan tanpa PO', 'transaksi/trans_masuk_unpo/home', 'Kedatangan barang tanpa PO', '+1', '7', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('161', 'Cucian -', 'transaksi/sales_order/home', 'Transaksi Penerimaan Cucian', '+1', '8', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('162', 'Packaging Pengiriman', 'transaksi/packaging/home', 'Packaging Pengiriman', '+1', '17', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('163', 'Approval Pengiriman', 'transaksi/trans_app_kirim/home', 'Approval Pengiriman', '+1', '18', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('165', 'Customer', 'master/master_cust/home', 'Data Master Customer', '+4+1+2+3', '7', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('166', 'Produk', 'master/master_produk/home', 'Data Master Jasa Satuan', '+4+5+1+2+3', '8', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('167', 'Perkiraan', 'master/master_perkiraan/home', 'Data Master Perkiraan', '+1+2', '9', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('168', 'Dashboard', '#', '', '+7+4+5+6+1+2', '5', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('169', 'Stok Akhir', 'main/index', 'Dashboard ketersediaan produk', '+7+4+5+6+1+2', '6', '168', '0');
INSERT INTO `sec_menu_old` VALUES ('170', 'Stok Available', 'main/avl', 'Dashboard ketersediaan pengiriman', '+7+4+5+6+1+2', '7', '168', '0');
INSERT INTO `sec_menu_old` VALUES ('171', 'GA Cukai', 'transaksi/ganocukai/home', 'Form Input No Cukai', '+4+1', '9', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('172', 'Batch Input', 'transaksi/labnobatch/home', 'Form Input No Batch', '+6+1', '10', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('173', 'Distribusi', 'transaksi/distribusi/home', 'Distribusi', '+5+1', '12', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('181', 'Outsource', 'master/master_outsource/home', 'Data Master Eksternal', '+1+2+3', '13', '64', '0');
INSERT INTO `sec_menu_old` VALUES ('182', 'Integrasi Jurnal', 'admin/integrasi_jurnal/home', 'Konfigurasi Integrasi Jurnal', '+1+2', '18', '1', '0');
INSERT INTO `sec_menu_old` VALUES ('183', 'Form Cukai', '#', '', '', '13', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('184', 'Kedatangan', 'cukai/trans_masuk/home', 'Form Kedatangan Barang (Cukai)', '', '5', '183', '0');
INSERT INTO `sec_menu_old` VALUES ('185', 'Pengeluaran produk', 'cukai/trans_keluar/home', 'Form Pengeluaran Produk (Cukai)', '', '6', '183', '0');
INSERT INTO `sec_menu_old` VALUES ('186', 'Stok Cukai', 'main/stokcukai', 'Dashboard Stok Cukai', '+1', '8', '168', '0');
INSERT INTO `sec_menu_old` VALUES ('187', 'Keuangan', '#', '', '+1+2', '12', '0', '0');
INSERT INTO `sec_menu_old` VALUES ('188', 'Koreksi Jurnal', 'akuntansi/koreksi_jurnal/home', 'Koreksi Jurnal', '+1+2', '6', '187', '0');
INSERT INTO `sec_menu_old` VALUES ('189', 'Agen', 'laporan/lap_piutang_agen/home', 'Laporan Piutang Agen', '+4+5+6+1+2+3', '8', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('190', 'Outsource', 'laporan/lap_hutang_outsource/home', 'Laporan Hutang Outsource', '+4+5+6+1+2+3', '8', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('191', 'Jasa Karyawan', 'laporan/lap_jasa_kyw/home', 'Laporan Jasa Karyawan', '+4+5+1+2+3', '9', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('192', 'PO', 'laporan/po/home', 'Laporan PO', '+1', '10', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('193', 'Kedatangan', 'laporan/kedatangan/home', 'Laporan Kedatangan Barang', '+1', '11', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('194', 'Pengambilan', 'laporan/lap_trans_ambil/home', 'Laporan Transaksi Pengambilan', '+1+2+3', '6', '97', '0');
INSERT INTO `sec_menu_old` VALUES ('195', 'Mutasi Gudang', 'transaksi/mutgudang/home', 'Form Mutasi Gudang', '+1', '21', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('196', 'Adjustment Produk', 'transaksi/adjustment/home', 'Adjustment Pengeluaran Barang', '+1', '22', '126', '0');
INSERT INTO `sec_menu_old` VALUES ('197', 'Jurnal', 'akuntansi/akuntansi/home', 'Penjurnalan', '+1+2', '5', '187', '0');
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
INSERT INTO `tbl_m_agama` VALUES ('0', 'Islam');
INSERT INTO `tbl_m_agama` VALUES ('1', 'Khatolik');
INSERT INTO `tbl_m_agama` VALUES ('2', 'Kristen');
INSERT INTO `tbl_m_agama` VALUES ('3', 'Hindu');
INSERT INTO `tbl_m_agama` VALUES ('4', 'Budha');
INSERT INTO `tbl_m_agama` VALUES ('5', 'Lain-lain');
INSERT INTO `tbl_m_bantuan` VALUES ('000001', 'Seminar');
INSERT INTO `tbl_m_bantuan` VALUES ('000002', 'Pelatihan Menjahit');
INSERT INTO `tbl_m_bantuan` VALUES ('000003', 'Pelatihan Merajut');
INSERT INTO `tbl_m_bantuan` VALUES ('000004', 'Seminar Dagang');
INSERT INTO `tbl_m_difabel` VALUES ('000000', '-');
INSERT INTO `tbl_m_difabel` VALUES ('000001', 'Buta');
INSERT INTO `tbl_m_difabel` VALUES ('000002', 'Bisu');
INSERT INTO `tbl_m_difabel` VALUES ('000003', 'Tuli');
INSERT INTO `tbl_m_difabel` VALUES ('000004', 'Lumpuh');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000001', 'Guru');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000002', 'Karyawan');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000003', 'Tani');
INSERT INTO `tbl_m_pekerjaan` VALUES ('000004', 'Pedagang');
INSERT INTO `tbl_r_hub_kel` VALUES ('1', 'KEPALA KELUARGA');
INSERT INTO `tbl_r_hub_kel` VALUES ('2', 'ISTRI');
INSERT INTO `tbl_r_hub_kel` VALUES ('3', 'ANAK');
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
INSERT INTO `tbl_t_bantuan` VALUES ('28', '5d25cafc-a95a-11e8-9980-782bcbdbdcb7', '000004', '889889', '2018-08-27', '40', '2018-08-27 01:04:01', null, null);
INSERT INTO `tbl_t_bantuan` VALUES ('29', '5d25cafc-a95a-11e8-9980-782bcbdbdcb7', '000004', '778', '2018-08-27', '40', '2018-08-27 01:04:01', null, null);
INSERT INTO `trans_kk` VALUES ('19', '123', '999', '4', '1', '', '', '', '', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg');
INSERT INTO `trans_kk` VALUES ('20', '1234', '778', '2', '1', '', '', '', '', 'uploads/foto/6e1e0129-a82e-11e8-b821-782bcbdbdcb7.jpg');
INSERT INTO `trans_kk` VALUES ('21', '123', '444', '1', '3', '', '', '', '', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg');
INSERT INTO `trans_kk` VALUES ('22', '123', '90', '6', '2', '', '', '', '', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg');
INSERT INTO `trans_kk` VALUES ('23', '123', '889889', '1', '2', '', '', '', '', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg');
INSERT INTO `trans_kk` VALUES ('24', '123', '999999', '1', '2', '', '', '', '', 'uploads/foto/6491af74-a831-11e8-b821-782bcbdbdcb7.jpg');
INSERT INTO `utility_db` VALUES ('1', 'backup-on-2016-06-25-07-03.sql', 'backup_db/backup-on-2016-06-25-07-03.sql', '2016-06-25', '07:03:30');
INSERT INTO `utility_db` VALUES ('2', 'backup-on-2016-08-10-05-48.sql', 'backup_db/backup-on-2016-08-10-05-48.sql', '2016-08-10', '05:48:10');
INSERT INTO `utility_db` VALUES ('3', 'backup-on-2016-08-15-11-25.sql', 'backup_db/backup-on-2016-08-15-11-25.sql', '2016-08-15', '11:25:41');
INSERT INTO `utility_db` VALUES ('4', 'backup-on-2016-08-15-23-16.sql', 'backup_db/backup-on-2016-08-15-23-16.sql', '2016-08-15', '23:16:13');
INSERT INTO `utility_db` VALUES ('5', 'backup-on-2016-08-21-05-46.sql', 'backup_db/backup-on-2016-08-21-05-46.sql', '2016-08-21', '05:46:22');
INSERT INTO `utility_db` VALUES ('6', 'backup-on-2016-08-27-16-30.sql', 'backup_db/backup-on-2016-08-27-16-30.sql', '2016-08-27', '16:30:16');
INSERT INTO `utility_db` VALUES ('7', 'backup-on-2016-09-04-18-58.sql', 'backup_db/backup-on-2016-09-04-18-58.sql', '2016-09-04', '18:58:26');
INSERT INTO `utility_db` VALUES ('8', 'backup-on-2016-09-05-17-46.sql', 'backup_db/backup-on-2016-09-05-17-46.sql', '2016-09-05', '17:46:27');
INSERT INTO `utility_db` VALUES ('9', 'backup-on-2016-09-06-09-18.sql', 'backup_db/backup-on-2016-09-06-09-18.sql', '2016-09-06', '09:18:42');
INSERT INTO `utility_db` VALUES ('10', 'backup-on-2016-09-12-08-56.sql', 'backup_db/backup-on-2016-09-12-08-56.sql', '2016-09-12', '08:56:39');
INSERT INTO `utility_db` VALUES ('11', 'backup-on-2016-09-13-23-23.sql', 'backup_db/backup-on-2016-09-13-23-23.sql', '2016-09-13', '23:23:07');
INSERT INTO `utility_db` VALUES ('12', 'backup-on-2016-09-21-11-10.sql', 'backup_db/backup-on-2016-09-21-11-10.sql', '2016-09-21', '11:10:26');
INSERT INTO `utility_db` VALUES ('13', 'backup-on-2016-09-23-08-37.sql', 'backup_db/backup-on-2016-09-23-08-37.sql', '2016-09-23', '08:37:10');
INSERT INTO `utility_db` VALUES ('14', 'backup-on-2016-09-23-11-55.sql', 'backup_db/backup-on-2016-09-23-11-55.sql', '2016-09-23', '16:55:36');
INSERT INTO `utility_db` VALUES ('15', 'backup-on-2016-09-23-11-58.sql', 'backup_db/backup-on-2016-09-23-11-58.sql', '2016-09-23', '16:58:52');
INSERT INTO `utility_db` VALUES ('16', 'backup-on-2016-09-26-05-31.sql', 'backup_db/backup-on-2016-09-26-05-31.sql', '2016-09-26', '10:31:14');
INSERT INTO `utility_db` VALUES ('17', 'backup-on-2017-03-23-17-46.sql', 'backup_db/backup-on-2017-03-23-17-46.sql', '2017-03-23', '23:46:32');
INSERT INTO `utility_db` VALUES ('18', 'backup-on-2017-03-24-04-11.sql', 'backup_db/backup-on-2017-03-24-04-11.sql', '2017-03-24', '10:11:13');
INSERT INTO `utility_db` VALUES ('19', 'backup-on-2017-04-12-11-39.sql', 'backup_db/backup-on-2017-04-12-11-39.sql', '2017-04-12', '16:39:45');
INSERT INTO `utility_db` VALUES ('20', 'backup-on-2017-05-15-11-30.sql', 'backup_db/backup-on-2017-05-15-11-30.sql', '2017-04-26', '16:30:57');
INSERT INTO `utility_db` VALUES ('21', 'backup-on-2017-05-16-21-14.sql', 'backup_db/backup-on-2017-05-16-21-14.sql', '2017-05-16', '21:14:33');
INSERT INTO `utility_db` VALUES ('22', 'backup-on-2017-06-29-11-17.sql', 'backup_db/backup-on-2017-06-29-11-17.sql', '2017-06-29', '11:17:21');
INSERT INTO `utility_db` VALUES ('23', 'backup-on-2017-06-29-21-22.sql', 'backup_db/backup-on-2017-06-29-21-22.sql', '2017-06-29', '21:22:14');
INSERT INTO `utility_db` VALUES ('24', 'backup-on-2017-06-30-08-53.sql', 'backup_db/backup-on-2017-06-30-08-53.sql', '2017-06-30', '08:53:15');
INSERT INTO `utility_db` VALUES ('25', 'backup-on-2017-07-10-05-22.sql', 'backup_db/backup-on-2017-07-10-05-22.sql', '2017-07-10', '10:22:52');
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
INSERT INTO `web_temp` VALUES ('1', '17', '2017-08-31', '1', '', 'Aktiva', 'G', '1', '0', '29022950.80', '2', '', 'Hutang', 'G', '1', '0', '3887120.50');
INSERT INTO `web_temp` VALUES ('2', '17', '2017-08-31', '101', '', 'Kas & Bank', 'G', '2', '1', '20125240.80', '201', '', 'Hutang Lancar', 'G', '2', '2', '3887120.50');
INSERT INTO `web_temp` VALUES ('3', '17', '2017-08-31', '10101', '', 'Kas', 'G', '3', '101', '20125240.80', '20103', '', 'Biaya Yang Masih Harus Dibayar', 'G', '3', '201', '3887120.50');
INSERT INTO `web_temp` VALUES ('4', '17', '2017-08-31', '1010101', '', 'Kas Kecil', 'D', '4', '10101', '20125240.80', '2010302', '-', 'BYMHD - Agen', 'G', '4', '20103', '59180.50');
INSERT INTO `web_temp` VALUES ('5', '17', '2017-08-31', '102', '', 'Piutang Jasa Laundri', 'G', '2', '1', '8897710.00', '201030201', '-', 'Toko Berkah', 'D', '5', '2010302', '32500.00');
INSERT INTO `web_temp` VALUES ('6', '17', '2017-08-31', '10201', '', 'Piutang Jasa Kiloan', 'D', '3', '102', '5953710.00', '201030204', '-', 'Masjid', 'D', '5', '2010302', '26680.50');
INSERT INTO `web_temp` VALUES ('7', '17', '2017-08-31', '10202', '', 'Piutang Jasa Satuan', 'D', '3', '102', '2944000.00', '2010303', '-', 'BYMHD - Outsource', 'G', '4', '20103', '225000.00');
INSERT INTO `web_temp` VALUES ('8', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '201030301', '-', 'Jasa Cuci Karpet (Sudrun)', 'D', '5', '2010303', '225000.00');
INSERT INTO `web_temp` VALUES ('9', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '2010304', '-', 'BYMHD Karyawan', 'G', '4', '20103', '3602940.00');
INSERT INTO `web_temp` VALUES ('10', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '201030401', '-', 'Anggy NS', 'D', '5', '2010304', '2000.00');
INSERT INTO `web_temp` VALUES ('11', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '201030402', '-', 'Mahayati', 'D', '5', '2010304', '30300.00');
INSERT INTO `web_temp` VALUES ('12', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '201030403', '-', 'Novi', 'D', '5', '2010304', '2682250.00');
INSERT INTO `web_temp` VALUES ('13', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '201030404', '-', 'Ibu', 'D', '5', '2010304', '487140.00');
INSERT INTO `web_temp` VALUES ('14', '17', '2017-08-31', '', '', '', '', '0', '', '0.00', '201030405', '-', 'Indah', 'D', '5', '2010304', '401250.00');
INSERT INTO `web_temp` VALUES ('16', '0', '0000-00-00', '', '', '', '', '0', '', '0.00', '', '', 'Total Modal', '', '0', '', null);
INSERT INTO `web_temp` VALUES ('17', '0', '0000-00-00', '', '', '', '', '0', '', '0.00', '', '', 'Laba Rugi Berjalan', '', '0', '', '25135830.30');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '4', '', 'Pendapatan', 'G', '1', '0', '687390.00', '0.00', '0.00', '0.00', '0.00', 'L');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '401', '', 'Pendapatan Jasa Laundri', 'G', '2', '4', '687390.00', '0.00', '0.00', '0.00', '0.00', 'L');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '40101', '', 'PJL Kiloan', 'D', '3', '401', '532170.00', '0.00', '0.00', '0.00', '0.00', 'L');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '40102', '', 'PJL Satuan', 'D', '3', '401', '155220.00', '0.00', '0.00', '0.00', '0.00', 'L');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '402', '', 'Pendapatan Lain-lain', 'D', '2', '4', '0.00', '0.00', '0.00', '0.00', '0.00', 'L');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5', '', 'Beban', 'G', '1', '0', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '501', '', 'Beban Pemasaran', 'G', '2', '5', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '50101', '', 'Beban Promosi', 'G', '3', '501', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010101', '', 'Media Cetak', 'D', '4', '50101', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010102', '', 'Media Elektronik', 'D', '4', '50101', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010103', '', 'Sponsor', 'D', '4', '50101', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010104', '', 'Souvenir', 'D', '4', '50101', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '50102', '', 'Beban Representasi & Pemasaran', 'G', '3', '501', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010201', '', 'Fasilitas dan Hadiah', 'D', '4', '50102', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010202', '', 'Jamuan Makan dan Minum', 'D', '4', '50102', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5010203', '', 'Olahraga', 'D', '4', '50102', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '502', '', 'Beban Tenaga Kerja', 'G', '2', '5', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '50201', '', 'Beban Gaji & Tunjangan Karyawan', 'G', '3', '502', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020101', '', 'Beban Beban Gaji & Upah Pegawai', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020102', '', 'Beban Lembur Pegawai', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020103', '', 'Beban Honorer', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020104', '', 'Beban Penghargaan/Pesangon', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020105', '', 'Beban Sukacita/Dukacita', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020106', '', 'Beban Tunjangan Hari Raya Pegawai', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020107', '', 'Beban Tunjangan Fungsional', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020108', '', 'Beban Tunjangan Produktivitas', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020109', '', 'Beban Tunjangan Lainnya', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5020110', '', 'Beban Pengobatan', 'D', '4', '50201', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '503', '', 'Beban Produksi', 'G', '2', '5', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '50301', '', 'Beban Rutin', 'G', '3', '503', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030101', '', 'Beban Utilitas (Listrik/PAM)', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030102', '', 'Beban Pemeliharaan & Perawatan', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030103', '', 'Beban Keamanan & Kebersihan', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030104', '', 'Beban Plastik Kiloan', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030105', '', 'Beban Plastik Satuan', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030106', '', 'Beban Sabun', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030107', '', 'Beban Parfum', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030108', '-', 'BR Diskon', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030109', '-', 'BR Outsource', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030110', '-', 'BR Agen', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030111', '-', 'BR Gas', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030112', '-', 'BR Hanger', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030113', '-', 'BR Solatip', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030114', '-', 'BR Pulpen', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030115', '-', 'BR Spidol', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030116', '-', 'BR Cetak Bon', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030117', '-', 'BR Isi Streples', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030118', '-', 'BR Lain - lain', 'D', '4', '50301', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '50302', '', 'Biaya Penyusutan & Amortisasi', 'G', '3', '503', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030201', '', 'Beban Penyusutan Sewa Tempat', 'D', '4', '50302', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030202', '', 'Beban Penyusutan Peralatan', 'D', '4', '50302', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '5030203', '', 'Beban Penyusutan lain-lain', 'D', '4', '50302', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '504', '', 'Beban Diluar Usaha', 'G', '2', '5', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_laba_rugi` VALUES ('17', '2017-06-01', '50401', '', 'Beban Zakat', 'D', '3', '504', '0.00', '0.00', '0.00', '0.00', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1', '', 'Aktiva', 'G', '1', '0', '29022950.80', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '101', '', 'Kas & Bank', 'G', '2', '1', '20125240.80', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10101', '', 'Kas', 'G', '3', '101', '20125240.80', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1010101', '', 'Kas Kecil', 'D', '4', '10101', '20125240.80', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1010102', '', 'Kas Besar', 'D', '4', '10101', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1010103', '', 'Kas Lain', 'D', '4', '10101', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10102', '', 'Bank', 'G', '3', '101', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1010201', '', 'BCA', 'D', '4', '10102', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1010202', '', 'BNI', 'D', '4', '10102', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1010203', '', 'Mandiri', 'D', '4', '10102', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '102', '', 'Piutang Jasa Laundri', 'G', '2', '1', '8897710.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10201', '', 'Piutang Jasa Kiloan', 'D', '3', '102', '5953710.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10202', '', 'Piutang Jasa Satuan', 'D', '3', '102', '2944000.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10203', '', 'Piutang Jasa Lain', 'D', '3', '102', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '103', '', 'Piutang Lain-lain', 'G', '2', '1', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10301', '', 'Piutang Karyawan', 'D', '3', '103', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '104', '', 'Biaya Dibayar Dimuka', 'D', '2', '1', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '105', '', 'Aktiva Tetap', 'G', '2', '1', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10501', '', 'Harga Perolehan Aktiva Tetap', 'G', '3', '105', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050101', '', 'Tempat Usaha', 'D', '4', '10501', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050102', '', 'Mesin Cuci', 'D', '4', '10501', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050103', '', 'Mesin Pengering', 'D', '4', '10501', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050104', '', 'Peralatan Laundri', 'D', '4', '10501', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10502', '', 'Akumulasi Depresiasi Fixed Asset', 'G', '3', '105', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050201', '', 'Akumulasi Penyusutan Tempat Usaha', 'D', '4', '10502', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050202', '', 'Akumulasi Penyusutan Peralatan Laundri', 'D', '4', '10502', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1050203', '', 'Akumulasi Penyusutan Lain-lain', 'D', '4', '10502', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '106', '', 'Aktiva Lain-Lain', 'G', '2', '1', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '10601', '', 'Aktiva Tidak Berwujud', 'G', '3', '106', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1060101', '', 'Goodwill', 'D', '4', '10601', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '1060102', '', 'Perangkat Lunak', 'D', '4', '10601', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '107', '', 'Biaya Dibayar Dimuka', 'G', '2', '1', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '108', '', 'Pendapatan Yang Masih Hrs Diterima', 'G', '2', '1', '0.00', 'L');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2', '', 'Hutang', 'G', '1', '0', '3887120.50', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201', '', 'Hutang Lancar', 'G', '2', '2', '3887120.50', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '20101', '', 'Hutang Customer', 'D', '3', '201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '20102', '', 'Hutang Usaha', 'G', '3', '201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010201', '', 'Hutang Marketing', 'D', '4', '20102', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '20103', '', 'Biaya Yang Masih Harus Dibayar', 'G', '3', '201', '3887120.50', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010301', '', 'BYMHD - Jasa Operasional', 'G', '4', '20103', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030101', '-', 'Jasa Setrika, Antar', 'D', '5', '2010301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010302', '-', 'BYMHD - Agen', 'G', '4', '20103', '59180.50', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030201', '-', 'Toko Berkah', 'D', '5', '2010302', '32500.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030202', '-', 'AA23', 'D', '5', '2010302', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030203', '-', 'Mama Sari', 'D', '5', '2010302', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030204', '-', 'Masjid', 'D', '5', '2010302', '26680.50', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030205', '-', 'Vega', 'D', '5', '2010302', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010303', '-', 'BYMHD - Outsource', 'G', '4', '20103', '225000.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030301', '-', 'Jasa Cuci Karpet (Sudrun)', 'D', '5', '2010303', '225000.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010304', '-', 'BYMHD Karyawan', 'G', '4', '20103', '3602940.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030401', '-', 'Anggy NS', 'D', '5', '2010304', '2000.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030402', '-', 'Mahayati', 'D', '5', '2010304', '30300.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030403', '-', 'Novi', 'D', '5', '2010304', '2682250.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030404', '-', 'Ibu', 'D', '5', '2010304', '487140.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '201030405', '-', 'Indah', 'D', '5', '2010304', '401250.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '20104', '', 'Hutang Sewa Guna Usaha', 'G', '3', '201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010401', '', 'Hutang Sewa Kantor', 'D', '4', '20104', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010402', '', 'Hutang Sewa Kendaraan', 'D', '4', '20104', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010403', '', 'Hutang Sewa Komputer', 'D', '4', '20104', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '2010404', '', 'Sewa diterima dimuka', 'D', '4', '20104', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '20105', '', 'Hutang Lain-Lain', 'D', '3', '201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '3', '', 'Modal', 'G', '1', '0', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '301', '', 'Modal Disetor', 'G', '2', '3', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '30101', '', 'Modal Disetor Anggy', 'D', '3', '301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '302', '', 'RETAINED EARNING', 'D', '2', '3', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '303', '', 'Agio Saham', 'D', '2', '3', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '304', '', 'Kenaikan (Penurunan) Surat Berharga Yang Belum Direalis', 'D', '2', '3', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '305', '', 'Selisih Penialian Kembali Aktiva Tetap', 'D', '2', '3', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '306', '', 'OPENING BALANCE EQUITY', 'D', '2', '3', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '4', '', 'Pendapatan', 'G', '1', '0', '29109010.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '401', '', 'Pendapatan Jasa Laundri', 'G', '2', '4', '29109010.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '40101', '', 'PJL Kiloan', 'D', '3', '401', '21968790.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '40102', '', 'PJL Satuan', 'D', '3', '401', '7140220.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '402', '', 'Pendapatan Lain-lain', 'D', '2', '4', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5', '', 'Beban', 'G', '1', '0', '3973179.70', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '501', '', 'Beban Pemasaran', 'G', '2', '5', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '50101', '', 'Beban Promosi', 'G', '3', '501', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010101', '', 'Media Cetak', 'D', '4', '50101', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010102', '', 'Media Elektronik', 'D', '4', '50101', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010103', '', 'Sponsor', 'D', '4', '50101', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010104', '', 'Souvenir', 'D', '4', '50101', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '50102', '', 'Beban Representasi & Pemasaran', 'G', '3', '501', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010201', '', 'Fasilitas dan Hadiah', 'D', '4', '50102', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010202', '', 'Jamuan Makan dan Minum', 'D', '4', '50102', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5010203', '', 'Olahraga', 'D', '4', '50102', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '502', '', 'Beban Tenaga Kerja', 'G', '2', '5', '3602940.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '50201', '', 'Beban Gaji & Tunjangan Karyawan', 'G', '3', '502', '3602940.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020101', '', 'Beban Beban Gaji & Upah Pegawai', 'D', '4', '50201', '3602940.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020102', '', 'Beban Lembur Pegawai', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020103', '', 'Beban Honorer', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020104', '', 'Beban Penghargaan/Pesangon', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020105', '', 'Beban Sukacita/Dukacita', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020106', '', 'Beban Tunjangan Hari Raya Pegawai', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020107', '', 'Beban Tunjangan Fungsional', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020108', '', 'Beban Tunjangan Produktivitas', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020109', '', 'Beban Tunjangan Lainnya', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5020110', '', 'Beban Pengobatan', 'D', '4', '50201', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '503', '', 'Beban Produksi', 'G', '2', '5', '370239.70', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '50301', '', 'Beban Rutin', 'G', '3', '503', '370239.70', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030101', '', 'Beban Utilitas (Listrik/PAM)', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030102', '', 'Beban Pemeliharaan & Perawatan', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030103', '', 'Beban Keamanan & Kebersihan', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030104', '', 'Beban Plastik Kiloan', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030105', '', 'Beban Plastik Satuan', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030106', '', 'Beban Sabun', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030107', '', 'Beban Parfum', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030108', '-', 'BR Diskon', 'D', '4', '50301', '26056.20', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030109', '-', 'BR Outsource', 'D', '4', '50301', '225000.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030110', '-', 'BR Agen', 'D', '4', '50301', '59180.50', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030111', '-', 'BR Gas', 'D', '4', '50301', '60003.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030112', '-', 'BR Hanger', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030113', '-', 'BR Solatip', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030114', '-', 'BR Pulpen', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030115', '-', 'BR Spidol', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030116', '-', 'BR Cetak Bon', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030117', '-', 'BR Isi Streples', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030118', '-', 'BR Lain - lain', 'D', '4', '50301', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '50302', '', 'Biaya Penyusutan & Amortisasi', 'G', '3', '503', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030201', '', 'Beban Penyusutan Sewa Tempat', 'D', '4', '50302', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030202', '', 'Beban Penyusutan Peralatan', 'D', '4', '50302', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '5030203', '', 'Beban Penyusutan lain-lain', 'D', '4', '50302', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '504', '', 'Beban Diluar Usaha', 'G', '2', '5', '0.00', 'R');
INSERT INTO `web_temp_perkiraan` VALUES ('17', '2017-08-31', '50401', '', 'Beban Zakat', 'D', '3', '504', '0.00', 'R');
