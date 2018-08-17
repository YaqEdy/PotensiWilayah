<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_stok extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('laporan/rekap_stok_m');
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
    function PdfCreate($data, $viewName, $createName) {

        $html = $this->load->view('cetak/' . $viewName, $data, true);

        $this->pdf1->pdf_create($html, $createName, true);
    }
    function cetak($id_produk) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            //$data['isidatamaster'] = $this->rekap_stok_m->cetakPOMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['stok_produk'] = $this->rekap_stok_m->get_dataProduk();
            //print_r($data['stok_produk']);
            $data['tgl_skrg'] = $this->session->userdata('tgl_d');;
            $data['header'] = 'Laporan Rekapitulasi Stok';
            //$this->load->view('cetak/RekapStok_v', $data);
            $this->PdfCreate($data, 'RekapStok_v', 'RekapStok_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('laporan/rekap_stok/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        
        $data['produk'] = $this->rekap_stok_m->getProduk();
        $data['storage'] = $this->rekap_stok_m->getStorage();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/rekap_stok_v', $data);
        }
    }

    
    function getDescStorage() {
        $this->CI = & get_instance();
        $idStorage = $this->input->post('idStorage', TRUE);
        $rows = $this->rekap_stok_m->getDescStorage($idStorage);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_jns_storage' => $row->nama_jns_storage
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */