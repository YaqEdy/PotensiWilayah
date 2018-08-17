<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_biaya_trans extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('laporan/lap_biaya_trans_m');
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
        $menuId = $this->home_m->get_menu_id('laporan/lap_biaya_trans/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['biaya_trans'] = $this->lap_biaya_trans_m->getBiayaTrans();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_biaya_trans_v', $data);
        }
    }

    
    public function getLapBiayaTrans() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d", strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d", strtotime($tglAkhir));
        $idJnsTransaksi = $this->input->post('idJnsTransaksi', TRUE);
        
        $rows = $this->lap_biaya_trans_m->getLapBiayaTrans($tglAwal, $tglAkhir,$idJnsTransaksi);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {

            $tglTrans = trim($row->tgl_trans);
            $tglTrans = date('d-m-Y', strtotime($tglTrans));
           
            $array = array(
                'noSeq' => $noSeq,
                'trans_id' => trim($row->trans_id),
                'tgl_trans' => $tglTrans,
                'deskripsi' => trim($row->deskripsi),
                'saldo_akhir' => trim(number_format($row->debet,0))
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
