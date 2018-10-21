<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_bantuan extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/trans_kk_m');
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
        $menuId = $this->home_m->get_menu_id('laporan/lap_kk/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        // $data['ktp'] = $this->global_m->getSelectOption('master_ktp','is_delete','0','','','id_ktp');

        // $data['suplier'] = $this->kedatangan_m->getSuplier();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_bantuan_v', $data);
        }
    }

    function cetak($mulai,$selesai) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $mulai=date('Y-m-d', strtotime($mulai));
            $selesai=date('Y-m-d', strtotime($selesai));
            $data['data_bantuan'] = $this->global_m->get_data("SELECT * FROM db_pw.vw_t_bantuan WHERE tgl_bantuan_ between '".$mulai."' and '".$selesai."'");
            $this->load->view('laporan/cetak_bantuan_pdf_v.php',$data);
        }
    }




}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */