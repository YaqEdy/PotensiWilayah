<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Input_kuota extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('kuota/input_kuota_m');
        //$this->load->model('setting_laporan_m');
        //$this->load->library('fpdf');
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
        $menuId = $this->home_m->get_menu_id('kuota/input_kuota/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['tahun'] = $this->input_kuota_m->getTahun();

        if (isset($_POST["btnSimpan"])) {
            $this->entry();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'kuota/pilih_input_kuota_v', $data);
        }
    }

    function entry($tahun) {
        $menuId = $this->home_m->get_menu_id('kuota/input_kuota/home');
        
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['tahun'] = $tahun;

        //$tahun = trim($this->input->post('tahun'));
        //$data['tahun'] = $tahun;
        $data['allBudgetPerk'] = $this->input_kuota_m->getKuota($tahun);

        $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
        $data['menu_all'] = $this->user_m->get_menu_all(0);

        $this->template->set('title', $data['menu_nama']);
        $this->template->load('template/template_dataTable', 'kuota/input_kuota_v', $data);
    }

    function ubah() {
        $id_cust = trim($this->input->post('id_cust'));
        $tahun = trim($this->input->post('tahun'));
        $no_skep = trim($this->input->post('no_skep'));
        $kuota = str_replace(',', '', trim($this->input->post('kuota')));
        //$total = $jan + $feb + $mar + $apr + $mei + $jun + $jul + $agu + $sep + $okt + $nov + $des;
        //$ket				= trim($this->input->post(''));
        $data = array(
            'kuota' => $kuota,
            'no_skep'=>$no_skep
                //        		''		        	=>$,
        );
        $model = $this->input_kuota_m->update($data, $id_cust, $tahun);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil diubah.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal diubah.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function cetak($tahun, $idProyek) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $info = $this->setting_laporan_m->getAllSetting();
            foreach ($info as $i) {
                $nama = $i->pt;
                $kantor = $i->kantor;
                $alamat = $i->alamat;
            }

            define('FPDF_FONTPATH', $this->config->item('fonts_path'));
            $data['image1'] = base_url('metronic/img/tatamasa_logo.jpg');
            $data['nama'] = trim($nama);
            $data['tower'] = trim($kantor);
            $data['alamat'] = trim($alamat);
            $proyek = $this->input_kuota_m->getNamaProyek2($idProyek);
            $data['laporan'] = 'Laporan Budget Perkiraan - ' . $proyek . ' - ' . $tahun;
            $data['user'] = $this->session->userdata('username');
            $data['all'] = $this->input_kuota_m->getBudgetPerk($tahun, $idProyek);
            $data['total'] = $this->input_kuota_m->getTotalPerk($tahun, $idProyek);
            $this->load->view('cetak/cetak_budget_perkiraan', $data);
        }
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */