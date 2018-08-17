<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class lap_keluarmasukbarang extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('lap_keluarmasukbarang_m');
        $this->load->model('master_lantai_m');
		$this->load->model('lap_rusunavl_m');
		$this->load->library('fpdf');
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
        $menuId = $this->home_m->get_menu_id('lap_keluarmasukbarang/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['tower'] = $this->master_lantai_m->getTowerpLokasi($this->session->userdata('id_lokasi'));

        if (isset($_POST["btnShow"])) {
            $this->display();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template3', 'lap_keluarmasukbarang/lap_keluarmasukbarang_v', $data);
        }
    }
	function printData(){
		$data['tglawal'] = (isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '');
		$data['tglakhir'] = (isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '');
		$data['id_lokasi'] = $this->session->userdata('id_lokasi');
		$data['gridbarang'] = $this->lap_keluarmasukbarang_m->get_KeluarMasukBarang($data['id_lokasi']);
		// exit();
		// $data['datarusun'] = $this->lap_keluarmasukbarang_m->get_dataLantaiSewa($tower,date('Y-m'.'-21', strtotime($this->session->userdata('tgl_y'))));
		$this->load->helper('pdf_mc_table');
		$this->load->view('lap_keluarmasukbarang/lap_displaykeluarmasukbarang_v', $data);
	}
	
	function printDataBAP(){
		// $data['tglawal'] = (isset($_GET['tanggalAwal']) ? $_GET['tanggalAwal'] : '');
		// $data['tglakhir'] = (isset($_GET['tanggalAkhir']) ? $_GET['tanggalAkhir'] : '');
		// $data['id_lokasi'] = $this->session->userdata('id_lokasi');
		// $data['gridbarang'] = $this->lap_keluarmasukbarang_m->get_KeluarMasukBarang($data['id_lokasi']);
		// exit();
		// $data['datarusun'] = $this->lap_keluarmasukbarang_m->get_dataLantaiSewa($tower,date('Y-m'.'-21', strtotime($this->session->userdata('tgl_y'))));
		// $this->load->helper('pdf_mc_table');
		// $this->load->view('lap_keluarmasukbarang/lap_displayBAP_v', $data);
		$data['x'] = '';
		mPdfCreate($data, 'lap_displayBAP', 'PermohonanSewa');
	}
    function display() {
        $menuId = $this->home_m->get_menu_id('lap_keluarmasukbarang/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        $tower = $_POST["tower"];

        //$data['info'] = $this->lap_keluarmasukbarang_m->getLap($tower);
        $data['datarusun'] = $this->lap_keluarmasukbarang_m->get_dataLantaiSewa($tower,$this->session->userdata('tgl_y'));

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);
		
		$this->load->helper('PDF_MC_Table');
		$this->load->view('lap_keluarmasukbarang/lap_displaykeluarmasukbarang_v', $data);
        
    }

}

/* End of file main.php */
/* Location: ./application/controllers/kasumum.php */
