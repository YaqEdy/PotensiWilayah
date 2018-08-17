<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Closing_perk extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('budgeti_perk_m');
        $this->load->model('setting_laporan_m');
        $this->load->model('closing_perk_m');
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
        $menuId = $this->home_m->get_menu_id('closing_perk/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['allBudgetPerk'] = $this->budgeti_perk_m->getBudgetPerk();

        if (isset($_POST["btnSimpan"])) {
            $this->entry();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template3', 'admin/closing_perk_v', $data);
            //$this->template->load ( 'template/template3', 'budget/budgetpi_perk_v',$data );
        }
    }

    function HitungClosingPerkiraan() {
        $this->db->trans_begin();
        $bln = trim($this->input->post('bulan'));
        $tahun = trim($this->input->post('tahun'));
        $bulan = substr($bln,0,2);
        $nmbulan = substr($bln,2);
        $cekTableSaldoBefore = $this->closing_perk_m->cekSaldoBefore($bulan, $tahun);
        $cekTableSaldo = $this->closing_perk_m->cekSaldo($bulan, $tahun);
        if ($cekTableSaldoBefore === 0 && $cekTableSaldo === 0) {
            //get from perkiraan
            $dataSaldo = $this->closing_perk_m->getSaldoCOA();
            foreach ($dataSaldo as $row) {
                $dataH = array(
                    'kode_perk' => trim($row->kode_perk),
                    'saldo_awal' => trim($row->saldo_awal),
                    'bulan' => $bulan,
                    'tahun' => $tahun
                );
                $model = $this->closing_perk_m->inisiasiSaldoCOA($dataH);
                
            }
            $dataTrans = $this->closing_perk_m->getSaldoTrans($bulan, $tahun);
            foreach ($dataTrans as $row2) {
               
                $getSaldoClosing = $this->closing_perk_m->getSaldoTransClosing($row2->kode_perk, $bulan, $tahun);
                 
                if ($row2->dk === 'D') {
                    $saldoakhir = ($row2->debet + $getSaldoClosing) - $row2->kredit;
                } else if ($row2->dk === 'K') {
                    $saldoakhir = ($row2->kredit + $getSaldoClosing) - $row2->debet;
                }
                $model = $this->closing_perk_m->updateClosing($row2->kode_perk,$saldoakhir,$bulan,$tahun);
            
            }

            $get_kode_induk = $this->closing_perk_m->get_kode_induk();
            foreach ($get_kode_induk->result() as $row1) {
                $jsu = 0;
                $get_saldo_induk = $this->closing_perk_m->get_saldo_induk($row1->kode_perk,$bulan,$tahun);
                foreach ($get_saldo_induk->result() as $row2) {
                    $jsu = $jsu + $row2->saldo_awal;
                    $this->closing_perk_m->update_saldo_induk($row1->kode_perk, $jsu,$bulan,$tahun);
                }
            }
        }else if ($cekTableSaldoBefore > 0 && $cekTableSaldo === 0){
             $dataSaldo = $this->closing_perk_m->getSaldoCOA2($bulan, $tahun);
            foreach ($dataSaldo as $row) {
                $dataH = array(
                    'kode_perk' => trim($row->kode_perk),
                    'saldo_awal' => trim($row->saldo_awal),
                    'bulan' => $bulan,
                    'tahun' => $tahun
                );
                $model = $this->closing_perk_m->inisiasiSaldoCOA($dataH);
                
            }
            $dataTrans = $this->closing_perk_m->getSaldoTrans($bulan, $tahun);
            foreach ($dataTrans as $row2) {
               
                $getSaldoClosing = $this->closing_perk_m->getSaldoTransClosing($row2->kode_perk, $bulan, $tahun);
                 
                if ($row2->dk === 'D') {
                    $saldoakhir = ($row2->debet + $getSaldoClosing) - $row2->kredit;
                } else if ($row2->dk === 'K') {
                    $saldoakhir = ($row2->kredit + $getSaldoClosing) - $row2->debet;
                }
                $model = $this->closing_perk_m->updateClosing($row2->kode_perk,$saldoakhir,$bulan,$tahun);
            
            }

            $get_kode_induk = $this->closing_perk_m->get_kode_induk();
            foreach ($get_kode_induk->result() as $row1) {
                $jsu = 0;
                $get_saldo_induk = $this->closing_perk_m->get_saldo_induk($row1->kode_perk,$bulan,$tahun);
                foreach ($get_saldo_induk->result() as $row2) {
                    $jsu = $jsu + $row2->saldo_awal;
                    $this->closing_perk_m->update_saldo_induk($row1->kode_perk, $jsu,$bulan,$tahun);
                }
            }
        }else if ((($cekTableSaldoBefore === 0) || ($cekTableSaldoBefore > 0)) && ($cekTableSaldo > 0)){
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data Bulan "'.$nmbulan.'" dan Tahun "'.$tahun.'"  Sudah Pernah di Closing'
            );
        }
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'masuk'
            );
        }
        $this->output->set_output(json_encode($array));
    }

}
