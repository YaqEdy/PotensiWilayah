<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_trans_ambil extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('laporan/lap_trans_ambil_m');
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

    function PdfCreate($data, $viewName, $createName) {

        $html = $this->load->view('cetak/' . $viewName, $data, true);

        $this->pdf->pdf_create($html, $createName, true);
    }

    function cetakPO($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->lap_trans_ambil_m->cetakPOMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->lap_trans_ambil_m->cetakPOTrans($id_master);
            //print_r($data['isidatatrans']);
            $data['header'] = 'PO';
            $this->PdfCreate($data, 'PO_v', 'PO_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('laporan/lap_trans_ambil/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_trans_ambil_v', $data);
        }
    }

    
    public function getCucianAmbil() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d", strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d", strtotime($tglAkhir));
        $status_Bayar = $this->input->post('statusBayar', TRUE);
        
        $rows = $this->lap_trans_ambil_m->getCucianAmbil($tglAwal, $tglAkhir,$status_Bayar);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        $ttl_harga = 0;
        foreach ($rows as $row) {

            $tglTrans = trim($row->tgl_trans);
            $tglTrans = date('d-m-Y', strtotime($tglTrans));
            $tglAmbil = trim($row->tgl_ambil);
            $tglAmbil = date('d-m-Y', strtotime($tglAmbil));
            $tglOutKel = trim($row->tgl_outsource_keluar);
            $tglOutKel = date('d-m-Y', strtotime($tglOutKel));
            $tglOutMsk = trim($row->tgl_outsource_masuk);
            $tglOutMsk = date('d-m-Y', strtotime($tglOutMsk));
            $actUbah = "<a href='#' class='btn yellow btn-sm' onclick='editBaris(tr" . $i . ")' ><i class='fa fa-edit fa-fw'/></i></a>";
            $actDetail = "<a href='#' class='btn blue btn-sm' onclick='detailBaris(tr" . $i . ")' ><i class='fa fa-list fa-fw'/></i></a>";


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
            $prioritas = trim($row->prioritas);
            if ($prioritas == 1) {
                $prioritas = "<span class='label label-danger'> Express </span>";
            } else {
                $prioritas = "<span class='label label-success'> Biasa </span>";
            }
            
            $ttl_harga = $ttl_harga+$row->total_harga;
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
                'total_harga' => trim(number_format($row->total_harga, 0)),
                'diskon' => trim(number_format($row->diskon, 0)),
                'jml_bayar' => trim(number_format($row->jml_bayar, 0)),
                'berat_ambil' => trim(number_format($row->berat_ambil, 2)),
                'status_outsource' => $statusOutsource,
                'status_selesai' => $statusSelesai,
                'status_bayar' => $statusBayar,
                    'ttl_harga' => $ttl_harga
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
