<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan_laba_rugi extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('laporan/lap_laba_rugi_m');
        $this->load->model('setting_laporan_m');
        $this->load->library('fpdf');
        session_start();
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('laporan/laporan_laba_rugi/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/laporan_labarugi_v', $data);
        }
    }

    function cetak() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $tgl = $this->uri->segment(4);
            $tgls = $this->uri->segment(5);
            $nol = $this->uri->segment(6);
            $tipe = $this->uri->segment(7);
            $timestamp = strtotime($tgl);
            $timestamp2 = strtotime($tgls);
            $tgl_trans = date('Y-m-d', $timestamp);
            $tgl_transsampai = date('Y-m-d', $timestamp2);

            $info = $this->setting_laporan_m->getAllSetting();
            foreach ($info as $i) {
                $nama = $i->pt;
                $kantor = $i->kantor;
                $alamat = $i->alamat;
            }

            /* ============= DEBET + ==================== */
            $delete = $this->lap_laba_rugi_m->deleteTempPerk();
            $temp_laba_rugi_pendapatan = $this->lap_laba_rugi_m->insert_temp_laba_rugi_pendapatan($tgl_trans, $this->session->userdata('id_user'));
            $temp_laba_rugi_biaya = $this->lap_laba_rugi_m->insert_temp_laba_rugi_biaya($tgl_trans, $this->session->userdata('id_user'));
            $saldo_pendapatan = $this->lap_laba_rugi_m->get_saldo_pendapatan($tgl_trans, $tgl_transsampai, $this->session->userdata('id_user'));
            foreach ($saldo_pendapatan->result() as $row) {
                $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_ak, $this->session->userdata('id_user'));
            }
            $saldo_biaya = $this->lap_laba_rugi_m->get_saldo_biaya($tgl_trans, $tgl_transsampai,$this->session->userdata('id_user'));
            foreach ($saldo_biaya->result() as $row) {
                $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_psv, $this->session->userdata('id_user'));
            }
            $get_kode_induk = $this->lap_laba_rugi_m->get_kode_induk($tgl_trans, $this->session->userdata('id_user'));
            foreach ($get_kode_induk->result() as $row1) {
                $jsu = 0;
                $get_saldo_induk = $this->lap_laba_rugi_m->get_saldo_induk($row1->kode_perk, $this->session->userdata('id_user'));
                foreach ($get_saldo_induk->result() as $row2) {
                    $jsu = $jsu + $row2->saldo_akhir;
                    $this->lap_laba_rugi_m->update_saldo_induk($row1->kode_perk, $jsu, $this->session->userdata('id_user'));
                }
            }
//            die();
            /* ============= END DEBET + ==================== */
            $data ['total_pendapatan'] = $this->lap_laba_rugi_m->get_total_pendapatan($tgl_trans);
            $data ['total_biaya'] = $this->lap_laba_rugi_m->get_total_biaya($tgl_trans);
            $data ['total_modal'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
            $data ['NoReferensi'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
            //$data ['laba_rugi_berjalan'] = $this->lap_laba_rugi_m->get_labarugi_berjalan();
            if ($nol == '1') {
                if ($tipe == '1') {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca($tgl_trans, $this->session->userdata('id_user'));
                } else {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neracadetail($tgl_trans, $this->session->userdata('id_user'));
                }
            } else {
                if ($tipe == '1') {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_nol($tgl_trans, $this->session->userdata('id_user'));
                } else {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_noldetail($tgl_trans, $this->session->userdata('id_user'));
                }
            }
            ////define('FPDF_FONTPATH', $this->config->item('fonts_path'));
            $data['image1'] = base_url('metronic/img/tatamasa_logo.jpg');
            $data['nama'] = trim($nama);
            $data['tower'] = trim($kantor);
            $data['alamat'] = trim($alamat);
            $data['laporan'] = 'Laporan Laba Rugi Periode ';
            $data['user'] = $this->session->userdata('username');
            $data['tgl'] = $tgl_trans;
            $data['tgls'] = $tgl_transsampai;
            $this->load->view('cetak/cetak_laporan_laba_rugi', $data);
        }
    }

    function cetakexcel() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $tgl = $this->uri->segment(4);
            $tgls = $this->uri->segment(5);
            $nol = $this->uri->segment(6);
            $tipe = $this->uri->segment(7);
            $timestamp = strtotime($tgl);
            $timestamp2 = strtotime($tgls);
            $tgl_trans = date('Y-m-d', $timestamp);
            $tgl_transsampai = date('Y-m-d', $timestamp2);

            $info = $this->setting_laporan_m->getAllSetting();
            foreach ($info as $i) {
                $nama = $i->pt;
                $kantor = $i->kantor;
                $alamat = $i->alamat;
            }

            /* ============= DEBET + ==================== */
            $delete = $this->lap_laba_rugi_m->deleteTempPerk();
            $temp_laba_rugi_pendapatan = $this->lap_laba_rugi_m->insert_temp_laba_rugi_pendapatan($tgl_trans, $this->session->userdata('id_user'));
            $temp_laba_rugi_biaya = $this->lap_laba_rugi_m->insert_temp_laba_rugi_biaya($tgl_trans, $this->session->userdata('id_user'));
            $saldo_pendapatan = $this->lap_laba_rugi_m->get_saldo_pendapatan($tgl_trans, $tgl_transsampai, $this->session->userdata('id_user'));
            foreach ($saldo_pendapatan->result() as $row) {
                $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_ak, $this->session->userdata('id_user'));
            }
            $saldo_biaya = $this->lap_laba_rugi_m->get_saldo_biaya($tgl_trans, $tgl_transsampai, $this->session->userdata('id_user'));
            foreach ($saldo_biaya->result() as $row) {
                $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_psv, $this->session->userdata('id_user'));
            }
            $get_kode_induk = $this->lap_laba_rugi_m->get_kode_induk($tgl_trans, $this->session->userdata('id_user'));
            foreach ($get_kode_induk->result() as $row1) {
                $jsu = 0;
                $get_saldo_induk = $this->lap_laba_rugi_m->get_saldo_induk($row1->kode_perk, $this->session->userdata('id_user'));
                foreach ($get_saldo_induk->result() as $row2) {
                    $jsu = $jsu + $row2->saldo_akhir;
                    $this->lap_laba_rugi_m->update_saldo_induk($row1->kode_perk, $jsu, $this->session->userdata('id_user'));
                }
            }
            /* ============= END DEBET + ==================== */
            $data ['total_pendapatan'] = $this->lap_laba_rugi_m->get_total_pendapatan($tgl_trans);
            $data ['total_biaya'] = $this->lap_laba_rugi_m->get_total_biaya($tgl_trans);
            $data ['total_modal'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
            $data ['NoReferensi'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
            //$data ['laba_rugi_berjalan'] = $this->lap_laba_rugi_m->get_labarugi_berjalan();
            if ($nol == '1') {
                if ($tipe == '1') {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca($tgl_trans, $this->session->userdata('id_user'));
                } else {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neracadetail($tgl_trans, $this->session->userdata('id_user'));
                }
            } else {
                if ($tipe == '1') {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_nol($tgl_trans, $this->session->userdata('id_user'));
                } else {
                    $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_noldetail($tgl_trans, $this->session->userdata('id_user'));
                }
            }
            ////define('FPDF_FONTPATH', $this->config->item('fonts_path'));
            $data['image1'] = base_url('metronic/img/tatamasa_logo.jpg');
            $data['nama'] = trim($nama);
            $data['tower'] = trim($kantor);
            $data['alamat'] = trim($alamat);
            $data['laporan'] = 'Laporan Laba Rugi per ';
            $data['user'] = $this->session->userdata('username');
            $data['tgl'] = $tgl_trans;
            $this->load->view('cetak/cetak_laporan_laba_rugi_excel', $data);
        }
    }

    function homeII() {
        $menuId = $this->home_m->get_menu_id('laporan_laba_rugi/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template3', 'laporan/laporan_labarugiII_v', $data);
        }
    }

    function cetakII() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $tgl = $this->uri->segment(3);
            $nol = $this->uri->segment(4);
            $tipe = $this->uri->segment(5);
            $timestamp = strtotime($tgl);
            $tgl_trans = date('Y-m-d', $timestamp);
            $thn = date('Y', $timestamp);
            $bln = date('m', $timestamp);
            $countclosing = $this->lap_laba_rugi_m->getClosingan($bln, $thn);
            if ($countclosing == 0) {

                echo "<script>alert('data closing kosong')</script>";
            } else {


                $info = $this->setting_laporan_m->getAllSetting();
                foreach ($info as $i) {
                    $nama = $i->pt;
                    $kantor = $i->kantor;
                    $alamat = $i->alamat;
                }

                /* ============= DEBET + ==================== */
                $delete = $this->lap_laba_rugi_m->deleteTempPerk($tgl_trans, $this->session->userdata('id_user'));
                $temp_laba_rugi_pendapatan = $this->lap_laba_rugi_m->insert_temp_laba_rugi_pendapatanII($bln, $thn, $tgl_trans, $this->session->userdata('id_user'));
                $temp_laba_rugi_biaya = $this->lap_laba_rugi_m->insert_temp_laba_rugi_biayaII($bln, $thn, $tgl_trans, $this->session->userdata('id_user'));
                //wakwaw ...
                // $saldo_pendapatan = $this->lap_laba_rugi_m->get_saldo_pendapatan($tgl_trans, $this->session->userdata('id_user'));
                // foreach ($saldo_pendapatan->result() as $row) {
                //     $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_ak, $this->session->userdata('id_user'));
                // }
                // $saldo_biaya = $this->lap_laba_rugi_m->get_saldo_biaya($tgl_trans, $this->session->userdata('id_user'));
                // foreach ($saldo_biaya->result() as $row) {
                //     $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_psv, $this->session->userdata('id_user'));
                // }
                // $get_kode_induk = $this->lap_laba_rugi_m->get_kode_induk($tgl_trans, $this->session->userdata('id_user'));
                // foreach ($get_kode_induk->result() as $row1) {
                //     $jsu = 0;
                //     $get_saldo_induk = $this->lap_laba_rugi_m->get_saldo_induk($row1->kode_perk, $this->session->userdata('id_user'));
                //     foreach ($get_saldo_induk->result() as $row2) {
                //         $jsu = $jsu + $row2->saldo_akhir;
                //         $this->lap_laba_rugi_m->update_saldo_induk($row1->kode_perk, $jsu, $this->session->userdata('id_user'));
                //     }
                // }
                /* ============= END DEBET + ==================== */
                $data ['total_pendapatan'] = $this->lap_laba_rugi_m->get_total_pendapatan($tgl_trans);
                $data ['total_biaya'] = $this->lap_laba_rugi_m->get_total_biaya($tgl_trans);
                $data ['total_modal'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
                $data ['NoReferensi'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
                //$data ['laba_rugi_berjalan'] = $this->lap_laba_rugi_m->get_labarugi_berjalan();
                if ($nol == '1') {
                    if ($tipe == '1') {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca($tgl_trans, $this->session->userdata('id_user'));
                    } else {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neracadetail($tgl_trans, $this->session->userdata('id_user'));
                    }
                } else {
                    if ($tipe == '1') {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_nol($tgl_trans, $this->session->userdata('id_user'));
                    } else {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_noldetail($tgl_trans, $this->session->userdata('id_user'));
                    }
                }
                //define('FPDF_FONTPATH', $this->config->item('fonts_path'));
                $data['image1'] = base_url('metronic/img/tatamasa_logo.jpg');
                $data['nama'] = trim($nama);
                $data['tower'] = trim($kantor);
                $data['alamat'] = trim($alamat);
                $data['laporan'] = 'Laporan Laba Rugi per ';
                $data['user'] = $this->session->userdata('username');
                $data['tgl'] = $tgl_trans;
                $this->load->view('cetak/cetak_laporan_laba_rugiII', $data);
            }
        }
    }

    function cetakexcelII() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $tgl = $this->uri->segment(3);
            $nol = $this->uri->segment(4);
            $tipe = $this->uri->segment(5);
            $timestamp = strtotime($tgl);
            $tgl_trans = date('Y-m-d', $timestamp);
            $thn = date('Y', $timestamp);
            $bln = date('m', $timestamp);
            $countclosing = $this->lap_laba_rugi_m->getClosingan($bln, $thn);
            if ($countclosing == 0) {

                echo "<script>alert('data closing kosong')</script>";
            } else {


                $info = $this->setting_laporan_m->getAllSetting();
                foreach ($info as $i) {
                    $nama = $i->pt;
                    $kantor = $i->kantor;
                    $alamat = $i->alamat;
                }

                /* ============= DEBET + ==================== */
                $delete = $this->lap_laba_rugi_m->deleteTempPerk($tgl_trans, $this->session->userdata('id_user'));
                $temp_laba_rugi_pendapatan = $this->lap_laba_rugi_m->insert_temp_laba_rugi_pendapatanII($bln, $thn, $tgl_trans, $this->session->userdata('id_user'));
                $temp_laba_rugi_biaya = $this->lap_laba_rugi_m->insert_temp_laba_rugi_biayaII($bln, $thn, $tgl_trans, $this->session->userdata('id_user'));
                //wakwaw ...
                // $saldo_pendapatan = $this->lap_laba_rugi_m->get_saldo_pendapatan($tgl_trans, $this->session->userdata('id_user'));
                // foreach ($saldo_pendapatan->result() as $row) {
                //     $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_ak, $this->session->userdata('id_user'));
                // }
                // $saldo_biaya = $this->lap_laba_rugi_m->get_saldo_biaya($tgl_trans, $this->session->userdata('id_user'));
                // foreach ($saldo_biaya->result() as $row) {
                //     $this->lap_laba_rugi_m->update_saldo_temp_pendapatan($row->kode_perk, $row->jumlah_psv, $this->session->userdata('id_user'));
                // }
                // $get_kode_induk = $this->lap_laba_rugi_m->get_kode_induk($tgl_trans, $this->session->userdata('id_user'));
                // foreach ($get_kode_induk->result() as $row1) {
                //     $jsu = 0;
                //     $get_saldo_induk = $this->lap_laba_rugi_m->get_saldo_induk($row1->kode_perk, $this->session->userdata('id_user'));
                //     foreach ($get_saldo_induk->result() as $row2) {
                //         $jsu = $jsu + $row2->saldo_akhir;
                //         $this->lap_laba_rugi_m->update_saldo_induk($row1->kode_perk, $jsu, $this->session->userdata('id_user'));
                //     }
                // }
                /* ============= END DEBET + ==================== */
                $data ['total_pendapatan'] = $this->lap_laba_rugi_m->get_total_pendapatan($tgl_trans);
                $data ['total_biaya'] = $this->lap_laba_rugi_m->get_total_biaya($tgl_trans);
                $data ['total_modal'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
                $data ['NoReferensi'] = $this->lap_laba_rugi_m->get_total_modal($tgl_trans);
                //$data ['laba_rugi_berjalan'] = $this->lap_laba_rugi_m->get_labarugi_berjalan();
                if ($nol == '1') {
                    if ($tipe == '1') {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca($tgl_trans, $this->session->userdata('id_user'));
                    } else {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neracadetail($tgl_trans, $this->session->userdata('id_user'));
                    }
                } else {
                    if ($tipe == '1') {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_nol($tgl_trans, $this->session->userdata('id_user'));
                    } else {
                        $data ['neraca'] = $this->lap_laba_rugi_m->get_data_neraca_bukan_noldetail($tgl_trans, $this->session->userdata('id_user'));
                    }
                }
                //define('FPDF_FONTPATH', $this->config->item('fonts_path'));
                $data['image1'] = base_url('metronic/img/tatamasa_logo.jpg');
                $data['nama'] = trim($nama);
                $data['tower'] = trim($kantor);
                $data['alamat'] = trim($alamat);
                $data['laporan'] = 'Laporan Laba Rugi per ';
                $data['user'] = $this->session->userdata('username');
                $data['tgl'] = $tgl_trans;
                $this->load->view('cetak/cetak_laporan_laba_rugi_excelII', $data);
            }
        }
    }


}

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
