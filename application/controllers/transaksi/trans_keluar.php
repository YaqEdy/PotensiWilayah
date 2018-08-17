<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_keluar extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/trans_keluar_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/trans_keluar/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->trans_keluar_m->getProduk();
        $data['storage'] = $this->trans_keluar_m->getStorage();
        $data['cust'] = $this->trans_keluar_m->getCust();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/trans_keluar_v', $data);
        }
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->trans_keluar_m->getDescProduk($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage,
                    'satuan_lt' => $row->satuan_lt,
                    'satuan_ml' => $row->satuan_ml,
                    'satuan_gr' => $row->satuan_gr,
                    'satuan_drum' => $row->satuan_drum
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }
    function getDescStorage() {
        $this->CI = & get_instance();
        $idStorage = $this->input->post('idStorage', TRUE);
        $rows = $this->trans_keluar_m->getDescStorage($idStorage);
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
    function getDescCustomer() {
        $this->CI = & get_instance();
        $idCustomer = $this->input->post('idCustomer', TRUE);
        $rows = $this->trans_keluar_m->getDescCustomer($idCustomer);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_produk' => $row->id_produk
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }
    function getDescProdukStorage() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->trans_keluar_m->getDescProdukStorage($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $idCust = trim($this->input->post('customer'));
        $totalKg = str_replace(',', '', trim($this->input->post('totalKg')));
        $totalDrum = str_replace(',', '', trim($this->input->post('totalDrum')));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterOut = $this->trans_keluar_m->getIdMasterOut($bulan, $tahun);

        $data = array(
            'id_master_out' => $idMasterOut,
            'id_cust' => $idCust,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'total_kg' => $totalKg,
            'total_drum' => $totalDrum,
            //'keterangan' => $ket,
            'userid' => $this->session->userdata('id_user')
        );
        $model = $this->trans_keluar_m->insertMaster($data);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;
                    $tDrum = 'tempDrum' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpDrum = str_replace(',', '', trim($this->input->post($tDrum)));
                    $tmpKet = trim($this->input->post($tKet));

                    $data = array(
                        'id_master' => $idMasterOut,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 200,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_kg' => $tmpKg,
                        'qty_drum' => $tmpDrum,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet,
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->trans_keluar_m->insertTransInOut($data);
                    $queryUpdateMProduk = $this->trans_keluar_m->updateMProduk($tmpKg, $tmpKdProduk);
                }
            }
        }

        if ($model) {
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

//    public function getKywAll()
//    {
//        $this->CI =& get_instance();//and a.kcab_id<>'1100'
//        $rows = $this->trans_keluar_m->getKywAll();
//        $data['data'] = array();
//        foreach ($rows as $row) {
//            $array = array(
//                'idKyw' => trim($row->id_kyw),
//                'namaKyw' => trim($row->nama_kyw),
//                'deptKyw' => trim($row->nama_dept),
//                'nama_akun_bank' => trim($row->nama_akun_bank),
//                'no_akun_bank' => trim($row->no_akun_bank),
//                'nama_bank' => trim($row->nama_bank)
//            );
//
//            array_push($data['data'], $array);
//        }
//        $this->output->set_output(json_encode($data));
//    }
//	
//	public function getKywAll2()
//    {
//        $this->CI =& get_instance();//and a.kcab_id<>'1100'
//        $rows = $this->trans_keluar_m->getKywAll();
//        $data['data'] = array();
//        foreach ($rows as $row) {
//            $array = array(
//                'idKyw' => trim($row->id_kyw),
//                'namaKyw' => trim($row->nama_kyw),
//                'deptKyw' => trim($row->nama_dept)
//            );
//
//            array_push($data['data'], $array);
//        }
//        $this->output->set_output(json_encode($data));
//    }
//	
//    public function getAdvAll()
//    {
//        $this->CI =& get_instance();//and a.kcab_id<>'1100'
//        $rows = $this->trans_keluar_m->getAdvAll();
//        $data['data'] = array();
//        foreach ($rows as $row) {
//            $jmlUang = number_format($row->jml_uang, 2);
//            $array = array(
//                'idAdv' => trim($row->id_advance),
//                'namaReq' => trim($row->nama_kyw),
//                'jmlUang' => $jmlUang
//            );
//
//            array_push($data['data'], $array);
//        }
//        $this->output->set_output(json_encode($data));
//    }
//    public function getAdvReq()
//    {
//        $this->CI =& get_instance();//and a.kcab_id<>'1100'
//        $requester = $this->session->userdata('id_kyw');
//        $rows = $this->trans_keluar_m->getAdvReq($requester);
//        $data['data'] = array();
//        foreach ($rows as $row) {
//            $jmlUang = number_format($row->jml_uang, 2);
//            $array = array(
//                'idAdv' => trim($row->id_advance),
//                'namaReq' => trim($row->nama_kyw),
//                'jmlUang' => $jmlUang
//            );
//
//            array_push($data['data'], $array);
//        }
//        $this->output->set_output(json_encode($data));
//    }
//
//    function getDescKurs()
//    {
//        $this->CI =& get_instance();
//        $idKurs = $this->input->post('idKurs', TRUE);
//        $rows = $this->trans_keluar_m->getDescKurs($idKurs);
//        if ($rows) {
//            foreach ($rows as $row)
//                $nilai_kurs = number_format($row->nilai_kurs, 2);
//            $array = array(
//                'baris' => 1,
//                'nilai_kurs' => $nilai_kurs
//            );
//        } else {
//            $array = array('baris' => 0);
//        }
//
//        $this->output->set_output(json_encode($array));
//    }
//
//
//    function getDescCpa()
//    {
//        $this->CI =& get_instance();
//        $idAdv = $this->input->post('idAdv', TRUE);
//        $crows = $this->trans_keluar_m->getCDescCpa($idAdv);
//        if ($crows <= 0) {
//            $array = array('baris' => 0);
//            $rows['data_cpa'] = $array;
//            $this->output->set_output(json_encode($rows));
//        } else {
//            $rows = $this->trans_keluar_m->getDescCpa($idAdv);
//            $this->output->set_output(json_encode($rows));
//        }
//    }
//
//
//    function ubah()
//    {
//        $idAdv 		= trim($this->input->post('idAdvance'));
//        $idKyw 		= trim($this->input->post('kywId'));
//        $uangMuka 	= str_replace(',', '', trim($this->input->post('uangMuka')));
//        $idProyek 	= trim($this->input->post('proyek'));
//        $idKurs 	= trim($this->input->post('kurs'));
//        $nilaiKurs 	= str_replace(',', '', trim($this->input->post('nilaiKurs')));
//        $tglTrans 	= trim($this->input->post('tglTrans'));
//        $tglTrans 	= date('Y-m-d', strtotime($tglTrans));
//        $tglJT 		= trim($this->input->post('tglJT'));
//        $tglJT 		= date('Y-m-d', strtotime($tglJT));
//        $payTo 		= trim($this->input->post('payTo'));
//        $namaPemilikAkunBank = trim($this->input->post('namaPemilikAkunBank'));
//        $noAkunBank = trim($this->input->post('noAkunBank'));
//        $namaBank 	= trim($this->input->post('namaBank'));
//        $ket 		= trim($this->input->post('keterangan'));
//        $dokPO 		= trim($this->input->post('dokPO_in'));
//        $dokSP 		= trim($this->input->post('dokSP_in'));
//        $dokSSP 	= trim($this->input->post('dokSSP_in'));
//        $dokSSPK 	= trim($this->input->post('dokSSPK_in'));
//        $dokSBJ 	= trim($this->input->post('dokSBJ_in'));
//		$dokLain	= trim($this->input->post('dokLain_in'));
//		$appHDId 	= trim($this->input->post('appHDId'));
//		$appGMId	= trim($this->input->post('appGMId'));
//		$appKeuId 	= trim($this->input->post('appKeuanganId'));
//		
//        $bulan = date('m', strtotime($tglTrans));//$tglTrans->format("m");
//        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");
//
//        //$ket			= trim($this->input->post(''));
//        $data = array(
//            'id_kyw' => $idKyw,
//            'jml_uang' => $uangMuka,
//            'id_proyek' => $idProyek,
//            'id_kurs' => $idKurs,
//            'nilai_kurs' => $nilaiKurs,
//            'tgl_jt' => $tglJT,
//            'pay_to' => $payTo,
//            'nama_akun_bank' => $namaPemilikAkunBank,
//            'no_akun_bank' => $noAkunBank,
//            'nama_bank' => $namaBank,
//            'keterangan' => $ket,
//            'dok_po' => $dokPO,
//            'dok_sp' => $dokSP,
//            'dok_ssp' => $dokSSP,
//            'dok_sspk' => $dokSSPK,
//            'dok_sbj' => $dokSBJ,
//			'dok_lain' => $dokLain,
//			'app_keuangan_id' => $appKeuId,
//			'app_hd_id' => $appHDId,
//			'app_gm_id' => $appGMId
//            //        		''		        	=>$,
//        );
//        $model = $this->trans_keluar_m->updateAdv($data, $idAdv);
//		$model = $this->trans_keluar_m->deleteCpa($idAdv);
//        $totJurnal = trim($this->input->post('txtTempLoop'));
//        if($totJurnal > 0){
//            $query=$this->trans_keluar_m->deleteCpa($idAdv);
//
//            for($i=1;$i<=$totJurnal;$i++){
//                $tKodePerk          = 'tempKodePerk'.$i;
//                $tKodeCflow         = 'tempKodeCflow'.$i;
//                $tJumlah            = 'tempJumlah'.$i;
//                $tKet               = 'tempKet'.$i;
//
//                $tmpKodePerk        = trim($this->input->post($tKodePerk ));
//                $tmpKodeCflow       = trim($this->input->post($tKodeCflow ));
//                $tmpJumlah          = str_replace(',', '', trim($this->input->post($tJumlah )));
//                $tmpKet             = trim($this->input->post($tKet ));
//
//                $data = array(
//                    'id_cpa'         => 0,
//                    'id_master'      => $idAdv,
//                    'kode_perk'      => $tmpKodePerk,
//                    'kode_cflow'     => $tmpKodeCflow,
//                    'keterangan'     => $tmpKet,
//                    'jumlah'        => $tmpJumlah
//                );
//				$budget = $this->trans_keluar_m->get_saldo_cflow($tmpKodeCflow);
//				if ($budget < $tmpJumlah){
//					$dataBudget = array(
//						'inout_budget'         => 1
//					);
//					$queryUpdate = $this->trans_keluar_m->updateAdv($dataBudget,$idAdv);	
//				}
//                $query=$this->trans_keluar_m->insertCpa($data);
//            }
//        }else{
//            $query=$this->trans_keluar_m->deleteCpa($idAdv);
//        }
//
//        if ($model) {
//            $array = array(
//                'act' => 1,
//                'tipePesan' => 'success',
//                'pesan' => 'Data berhasil diubah.'
//            );
//        } else {
//            $array = array(
//                'act' => 0,
//                'tipePesan' => 'error',
//                'pesan' => 'Data gagal diubah.'
//            );
//        }
//        $this->output->set_output(json_encode($array));
//    }
//
//    function hapus()
//    {
//        $this->CI =& get_instance();
//        $idAdvance = trim($this->input->post('idAdvance'));
//        $totJurnal = trim($this->input->post('tempLoop'));
//        $model = $this->trans_keluar_m->deleteAdv($idAdvance);
//
//
//        if ($totJurnal > 0) {
//            $query = $this->trans_keluar_m->deleteCpa($idAdvance);
//        }
//
//        if ($model) {
//            $array = array(
//                'act' => 1,
//                'tipePesan' => 'success',
//                'pesan' => 'Data berhasil dihapus.'
//            );
//        } else {
//            $array = array(
//                'act' => 0,
//                'tipePesan' => 'error',
//                'pesan' => 'Data gagal dihapus.'
//            );
//        }
//        $this->output->set_output(json_encode($array));
//    }
//    function sign(){
//        $this->CI =& get_instance();
//        $idAdvance	= trim($this->input->post('idAdvance'));
//        $flag  		= $this->session->userdata('id_kyw');
//        $data = array(
//            'app_user_id' => $flag
//        );
//        $model 		= $this->trans_keluar_m->updateAdv($data,$idAdvance);
//
//        if($model){
//            $array = array(
//                'act'	=>1,
//                'tipePesan'=>'success',
//                'pesan' =>'Data berhasil di Sign.'
//            );
//        }else{
//            $array = array(
//                'act'	=>0,
//                'tipePesan'=>'error',
//                'pesan' =>'Data gagal di Sign.'
//            );
//        }
//        $this->output->set_output(json_encode($array));
//    }
//    function cetak($idAdv)
//    {
//        if ($this->auth->is_logged_in() == false) {
//            redirect('main/index');
//        } else {
//            $data['info'] = $this->setting_laporan_m->getAllSetting();
//            $data['advance'] = $this->trans_keluar_m->getDescAdv($idAdv);
//            $this->load->view('cetak/cetak_advance', $data);
//        }
//    }
//
//    function cetak_cpa($idAdv)
//    {
//        if($this->auth->is_logged_in() == false){
//            redirect('main/index');
//        }else{
//            $data['info'] = $this->setting_laporan_m->getAllSetting();
//            $data['advance'] = $this->trans_keluar_m->cetak_cpa($idAdv);
//            $data['detail'] = $this->trans_keluar_m->cetak_cpa_detail($idAdv);
//            $this->load->view('cetak/cetak_cpa', $data);
//        }
//    }

    /* function cetak_pp($idAdv)
      {
      if ($this->auth->is_logged_in() == false) {
      redirect('main/index');
      } else {
      $data['advance'] = $this->trans_keluar_m->cetak_cpa($idAdv);
      $data['detail'] = $this->trans_keluar_m->cetak_cpa_detail($idAdv);
      $this->load->view('cetak/cetak_cpa', $data);
      }
      } */
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */