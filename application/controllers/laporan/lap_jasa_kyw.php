<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_jasa_kyw extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('laporan/lap_jasa_kyw_m');
        $this->load->model('transaksi/trans_po_m');
        $this->load->model('sec_user_m');
        $this->load->model('akuntansi/akuntansi_m');
        $this->load->library('pdf');
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
        $menuId = $this->home_m->get_menu_id('laporan/lap_jasa_kyw/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['karyawan'] = $this->sec_user_m->getAllKaryawan();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_jasa_kyw_v', $data);
        }
    }

    
    public function getCucianAmbil() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d", strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d", strtotime($tglAkhir));
        $idKaryawan = $this->input->post('idKaryawan', TRUE);
        
        $rows = $this->lap_jasa_kyw_m->getCucianAmbil($tglAwal, $tglAkhir,$idKaryawan);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {

            $tglTrans = trim($row->tgl_trans);
            $tglTrans = date('d-m-Y', strtotime($tglTrans));
            
            $tglOutKel = trim($row->tgl_outsource_keluar);
            $tglOutKel = date('d-m-Y', strtotime($tglOutKel));
            $tglOutMsk = trim($row->tgl_outsource_masuk);
            $tglOutMsk = date('d-m-Y', strtotime($tglOutMsk));
            

            $status_outsource = trim($row->status_outsource);
            if ($status_outsource == 0) {
                $statusOutsource = "<span class='label label-info'> Tidak </span>";
            } else if ($status_outsource == 1) {
                $statusOutsource = "<span class='label label-warning'> Onproses </span>";
            } else {
                $statusOutsource = "<span class='label label-success'> Selesai </span>";
            }
            $status_selesai = trim($row->status_selesai);
            if ($status_selesai == 0) {
                $statusSelesai = "<span class='label label-danger'> Blm Selesai </span>";
            } else {
                $statusSelesai = "<span class='label label-success'> Selesai </span>";
            }
            $status_bayar = trim($row->status_bayar);
            if ($status_bayar == 0) {
                $statusBayar = "<span class='label label-danger'> Belum </span>";
            } else {
                $statusBayar = "<span class='label label-success'> Sudah </span>";
            }

            $etglEst = trim($row->e_tgl_selesai);
            if ($etglEst == '0000-00-00') {
                $etglEst = "-";
            } else {
                $etglEst = date('d-m-Y', strtotime($etglEst));
            }
            $tglSelesai = trim($row->tgl_selesai);
            if ($tglSelesai == '0000-00-00') {
                $tglSelesai = "-";
            } else {
                $tglSelesai = date('d-m-Y', strtotime($tglSelesai));
            }
            $tglAmbil = trim($row->tgl_ambil);
            if ($tglAmbil == '0000-00-00') {
                $tglAmbil = "-";
            } else {
                $tglAmbil = date('d-m-Y', strtotime($tglAmbil));
            }
            
            $prioritas = trim($row->prioritas);
            if ($prioritas == 1) {
                $prioritas = "<span class='label label-danger'> Express </span>";
            } else {
                $prioritas = "<span class='label label-success'> Biasa </span>";
            }
            
            $ttl_cc = ($row->setrika_kg+$row->setrika_satuan)*1000;
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_cm),
                'noBon' => trim($row->no_bon_manual),
                'id_cust' => trim($row->id_cust),
                'nama_cust' => trim($row->nama_cust),
                'tgl_trans' => $tglTrans,
                'layanan' => $prioritas,
                'e_tgl_selesai' => $etglEst,
                'tgl_selesai' => $tglSelesai,
                'tgl_ambil' => $tglAmbil,
                'waktu_masuk' => trim($row->waktu_masuk),
                'waktu_ambil' => trim($row->waktu_ambil),
                'tgl_outsource_keluar' => $tglOutKel,
                'tgl_outsource_masuk' => $tglOutMsk,
                'total_qty_kg' => trim(number_format($row->total_qty_kg, 2)),
                'total_qty_satuan' => trim($row->total_qty_satuan),
                'setrika_kg' => trim(number_format($row->setrika_kg, 2)),
                'setrika_satuan' => trim($row->setrika_satuan),
                'total_harga' => trim(number_format($row->total_harga, 0)),
                'diskon' => trim(number_format($row->diskon, 0)),
                'jml_bayar' => trim(number_format($row->jml_bayar, 0)),
                'berat_ambil' => trim(number_format($row->berat_ambil, 2)),
                'status_outsource' => $statusOutsource,
                'status_selesai' => $statusSelesai,
                'status_bayar' => $statusBayar,
                    'ttl_harga_kyw' => number_format($ttl_cc,2)
                    //'actUbah' => $actUbah,
                    //'act' => $act
            );

            array_push($data['data'], $array);
            $i++;
            $noSeq++;
            
        }
        $this->output->set_output(json_encode($data));
    }

    

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */