<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_biaya extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/trans_biaya_m');
        $this->load->model('akuntansi/akuntansi_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/trans_biaya/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/trans_biaya_v', $data);
        }
    }

    public function getAllJurnal() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_biaya_m->getAllJurnal();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'id_jns_transaksi' => trim($row->id_jns_transaksi),
                'nama_jns_transaksi' => trim($row->nama_jns_transaksi),
                'kode_perk' => trim($row->kode_perk),
                'nama_perk' => trim($row->nama_perk),
                'keterangan' => trim($row->keterangan)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        $namaJurnal = trim($this->input->post('namaJurnal'));
        $GL = trim($this->input->post('GL'));
        $jmlTrans = str_replace(',', '', trim($this->input->post('jml_trans')));
        $ket = trim($this->input->post('keterangan'));
        
        $bulan = date('m', strtotime($tglTrans));
        $tahun = date('Y', strtotime($tglTrans));
        $tanggal = date('d', strtotime($tglTrans));
        
        $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
        $modul = '2';
        //DEBET
        $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
        $KodePerk = $GL;
        $debet = $jmlTrans;
        $kredit = 0;
        $total_trans = $jmlTrans;
        $deskripsi = $ket;
        $keterangan = $ket;
        $noreferensi ='';
        $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        //$model = $this->akuntansi_m->insert_jurnalD($modelidAPtrans, $tglTrans, $modelidAP, $getIntAgen, $deskripsiJurnal, $hutangJasaAgen, $hutangJasaAgen);
        //KREDIT
        $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
        $KodePerk = $this->akuntansi_m->getkodeperk('kas_operasional');
        $debet = 0;
        $kredit = $jmlTrans;
        $total_trans = $jmlTrans;
        $deskripsi = $ket;
        $keterangan = $ket;
        $noreferensi ='';
        $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        
        //$modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
        //$model = $this->akuntansi_m->insert_jurnalK($modelidAPtrans, $tglTrans, $modelidAP, $kd_perk_agen, $deskripsiJurnal, $hutangJasaAgen, $hutangJasaAgen);
        
        
        if ($model1 && $model2) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function ubah() {
        $idJurnal = trim($this->input->post('jurnalId'));
        $namaJurnal = trim($this->input->post('namaJurnal'));
        $GL = trim($this->input->post('GL'));
        $keterangan = trim($this->input->post('keterangan'));

        $data = array(
            'nama_jns_transaksi' => $namaJurnal,
            'kode_perk' => $GL,
            'keterangan' => $keterangan
        );

        $model = $this->trans_biaya_m->ubah($data, $idJurnal);
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

    function hapus() {
        $this->CI = & get_instance();
        $idJurnal = trim($this->input->post('idJurnal'));
        $model = $this->trans_biaya_m->hapus($idJurnal);
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.'
            );
        }

        //$cekMasterAdv	= $this->master_rumah_m->cekMasterAdvance($kywId);
//    	$cekMasterReqpay	= $this->master_rumah_m->cekMasterReqpay($kywId);
//    	$cekMasterReimpay	= $this->master_rumah_m->cekMasterReimpay($kywId);
        /**
         * if($cekMasterAdv == true && $cekMasterReqpay ==true && $cekMasterReimpay ==true){
         *     		$model = $this->master_rumah_m->deleteProyek( $kywId);
         *     		if($model){
         *     			$array = array(
         *     					'act'	=>1,
         *     					'tipePesan'=>'success',
         *     					'pesan' =>'Data berhasil dihapus.'
         *     			);
         *     		}else{
         *     			$array = array(
         *     					'act'	=>0,
         *     					'tipePesan'=>'error',
         *     					'pesan' =>'Data gagal dihapus.'
         *     			);
         *     		}
         *     	}else{
         *     		$array = array(
         *     				'act'	=>0,
         *     				'tipePesan'=>'error',
         *     				'pesan' =>'Data digunakan pada data master yang lain.</br>Data gagal dihapus.'
         *     		);
         *     	}
         */
        $this->output->set_output(json_encode($array));
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */