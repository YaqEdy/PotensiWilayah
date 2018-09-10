<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_ktp extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('laporan/kedatangan_m');
        $this->load->library('pdf1');
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
        $menuId = $this->home_m->get_menu_id('laporan/lap_ktp/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        $data['ktp'] = $this->global_m->getSelectOption('master_ktp','is_delete','0','','','id_ktp');

        // $data['suplier'] = $this->kedatangan_m->getSuplier();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_ktp_v', $data);
        }
    }

    function PdfCreate($data, $viewName, $createName) {
        $html = $this->load->view('cetak/' . $viewName, $data, true);
        $this->pdf1->pdf_create($html, $createName, true);
    }

    // function cetak($id_ktp) {
    //     if ($this->auth->is_logged_in() == false) {
    //         redirect('main/index');
    //     } else {
    //         // $data['tglAwal'] = $tglAwal;
    //         // $data['tglAkhir'] = $tglAkhir;
    //         // $tglAwal = date("Y-m-d", strtotime($tglAwal));
    //         // $tglAkhir = date("Y-m-d", strtotime($tglAkhir));
    //         $data['po'] = $this->kedatangan_m->get_Po($tglAwal, $tglAkhir, $id_spl);
    //         //print_r($data['stok_produk']);
    //         $data['tgl_skrg'] = $this->session->userdata('tgl_d');
    //         $data['header'] = 'Laporan';
    //         //print_r($data['po']);
    //         //$this->load->view('cetak/RekapStok_v', $data);
    //         $this->PdfCreate($data, 'Lap_kedatangan_v', 'Lap_kedatangan_v');
    //     }
    // }

    function cetak($id_ktp) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            // $data['data_ktp'] = '';
            $data['data_ktp'] = $this->global_m->get_data("select * from vw_t_kk where id_ktp=".$id_ktp)[0];
            $data['komunitas'] = $this->global_m->get_data("select * from vw_komunitas where id_ktp=".$id_ktp);
            $data['bantuan'] = $this->global_m->get_data("select * from vw_t_bantuan where id_ktp=".$id_ktp);
            // print_r($data['data_ktp']->id_ktp);die();

            $this->load->view('laporan/cetak_ktp_pdf_v.php',$data);
            // $this->template->load('laporan/lap_ktp_v', $data);            
        }
    }





}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */