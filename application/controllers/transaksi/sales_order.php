<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_order extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/sales_order_m');
        $this->load->model('global_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/sales_order/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->sales_order_m->getProduk();
        $data['jnsdoc'] = $this->sales_order_m->getJnsDoc();
        $data['storage'] = $this->sales_order_m->getStorage();
        $data['cust'] = $this->sales_order_m->getCust();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/sales_order_v', $data);
        }
    }
    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d",strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d",strtotime($tglAkhir));
        
        $rows = $this->sales_order_m->getRencanaOutAll($tglAwal,$tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));
            //$act = "<a href='#' class='btn yellow btn-sm' onclick='editBaris(tr".$i.")' ><i class='fa fa-edit fa-fw'/></i></a>";
        
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_out),
                'no_sj' => trim($row->no_sj),
                'nama_produk' => trim($row->nama_produk),
                'namaCust' => trim($row->nama_cust),
                'no_jnsdoc' => trim($row->no_jnsdoc),
                'nama_jnsdoc'  => trim($row->nama_jnsdoc),
                'no_batch' => trim($row->no_batch),
                'tglKirim' => $tglKirim,
                'no_aju' => trim($row->no_aju),
                'no_cukai' => trim($row->no_cukai),
                'totalQty' => trim(number_format($row->total_qty,2)),
                'keterangan_so'=>trim($row->keterangan_so),
                //'act'=>$act
            );

            array_push($data['data'], $array);
            $i++;
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }
    function getDescSo() {
        $this->CI = & get_instance();
        $idSo = $this->input->post('idSo', TRUE);
        $rows = $this->sales_order_m->getDescSo($idSo);
        if ($rows) {
            foreach ($rows as $row)
                $tglTrans = trim($row->tgl_trans);
                $tglTrans = date('d-m-Y', strtotime($tglTrans));
                $tglEtd = trim($row->etd);
                $tglEtd = date('d-m-Y', strtotime($tglEtd));
                $tglEta = trim($row->eta);
                $tglEta = date('d-m-Y', strtotime($tglEta));
                $array = array(
                    'baris' => 1,
                    'id_cust' => $row->id_cust,
                    'tgl_trans' => $tglTrans,
                    'id_jnsdoc' => $row->id_jnsdoc,
                    'no_po_cust' => $row->no_po_cust,
                    'no_cukai' => $row->no_cukai,
                    'no_batch' => $row->no_batch,
                    'etd' => $tglEtd,
                    'eta' => $tglEta,
                    'id_produk' => $row->id_produk,
                    'qty_rencana' => $row->total_qty,
                    'id_storage' => $row->id_storage,
                    'keterangan_so' => $row->keterangan_so,
                    //'' => $row->,
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }
    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->sales_order_m->getDescProduk($idProduk);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage,
                    'packsize2' => $row->packsize2,
                    'packsize3' => $row->packsize3,
                    'packsize4' => $row->packsize4,
                    'packsize5' => $row->packsize5
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function getDescCust() {
        $this->CI = & get_instance();
        $idCust = $this->input->post('idCust', TRUE);
        $rows = $this->sales_order_m->getDescCustomer($idCust);
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
    
    function getDescStorage() {
        $this->CI = & get_instance();
        $idStorage = $this->input->post('idStorage', TRUE);
        $rows = $this->sales_order_m->getDescStorage($idStorage);
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
    

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));


        $idCust = trim($this->input->post('customer'));
        $poCust = trim($this->input->post('poCust'));
        $jnsdoc = trim($this->input->post('jnsdoc'));
        $noSkep = trim($this->input->post('noSkep'));

        $produkKg = str_replace(',', '', trim($this->input->post('produkKg')));
        $ket = trim($this->input->post('keterangan'));

        $tglEtd = trim($this->input->post('etd'));
        $tglEtd = date('Y-m-d', strtotime($tglEtd));

        $tglEta = trim($this->input->post('eta'));
        $tglEta = date('Y-m-d', strtotime($tglEta));
        

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");
        $produk = trim($this->input->post('produk'));
        $idMasterOut = $this->sales_order_m->getIdMasterOut($bulan, $tahun);

        $data = array(
            'id_master_out' => $idMasterOut,
            'id_cust' => $idCust,
            'no_po_cust' => $poCust,
            'no_skep'=>$noSkep,
            'id_jnsdoc' =>$jnsdoc,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'etd' => $tglEtd,
            'eta' => $tglEta,
            'id_produk'=>$produk,
            'total_qty' => $produkKg,
            'keterangan_so' => $ket,
            'userid' => $this->session->userdata('id_user'),
        );
        $model = $this->sales_order_m->insertMaster($data);
        
        $idTransOut = $idMasterOut . "-" . 1;
        
        
        $storage = trim($this->input->post('storage'));
        $ket = trim($this->input->post('keteranganCPA'));
        
        $dataTrans = array(
            'id_trans_out' => $idTransOut,
            'id_master' => $idMasterOut,
            'id_produk' => $produk,
            'kode_trans' => 200,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_rencana' => $produkKg,
            'id_storage' => $storage,
            'keterangan' => $ket,
            'userid' => $this->session->userdata('id_user')
        );

        $query = $this->sales_order_m->insertTransOut($dataTrans);
        $queryUpdateMProduk = $this->global_m->updateMProdukKeluarReq($produkKg, $produk);

        /*
          $totJurnal = trim($this->input->post('txtTempLoop'));
          if ($totJurnal > 0) {
          for ($i = 1; $i <= $totJurnal; $i++) {
          $tKdProduk = 'tempKdProduk' . $i;
          $tmpKdProduk = trim($this->input->post($tKdProduk));

          if ($tmpKdProduk <> '') {
          $tKdStorage = 'tempKdStorage' . $i;
          $tKg = 'tempKg' . $i;
          $tHargaSatuan = 'tempHargaSatuan' . $i;
          $tKet = 'tempKet' . $i;

          $tmpKdStorage = trim($this->input->post($tKdStorage));
          $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
          $tmpHargaSatuan = str_replace(',', '', trim($this->input->post($tHargaSatuan)));
          $tmpKet = trim($this->input->post($tKet));

          $idTransOut  =   $idMasterOut."-".$i;

          $data = array(
          'id_trans_out' => $idTransOut,
          'id_master' => $idMasterOut,
          'id_produk' => $tmpKdProduk,
          'kode_trans' => 200,
          'tgl_trans' => $tglTrans,
          'tgl_input' => $this->session->userdata('tgl_y'),
          'qty_rencana' => $tmpKg,
          'id_storage' => $tmpKdStorage,
          'keterangan' => $tmpKet,
          'userid' => $this->session->userdata('id_user')
          );

          $query = $this->sales_order_m->insertTransOut($data);
          //$queryUpdateMProduk = $this->sales_order_m->updateMProduk($tmpKg, $tmpKdProduk);
          }
          }
          }
         * 
         */

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
    function ubah() {
        $idMasterOut = trim($this->input->post('SoId'));
        
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $idCust = trim($this->input->post('customer'));
        $poCust = trim($this->input->post('poCust'));
        $jnsdoc = trim($this->input->post('jnsdoc'));
        $noSkep = trim($this->input->post('noSkep'));

        $produkKg = str_replace(',', '', trim($this->input->post('produkKg')));
        //jumlah produk sebelum
        $produkKgSbl = str_replace(',', '', trim($this->input->post('produkKgSbl')));
        //end jumlah produk sebelum
        $ket = trim($this->input->post('keterangan'));

        $tglEtd = trim($this->input->post('etd'));
        $tglEtd = date('Y-m-d', strtotime($tglEtd));

        $tglEta = trim($this->input->post('eta'));
        $tglEta = date('Y-m-d', strtotime($tglEta));
        

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $data = array(
            'id_cust' => $idCust,
            'no_po_cust' => $poCust,
            'id_jnsdoc' =>$jnsdoc,
            'no_skep'=>$noSkep,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'etd' => $tglEtd,
            'eta' => $tglEta,
            'total_qty' => $produkKg,
            'keterangan_so' => $ket,
            'userid' => $this->session->userdata('id_user'),
        );
        $model = $this->sales_order_m->ubahMaster($data,$idMasterOut);
        
        //$idTransOut = $idMasterOut . "-" . 1;
        
        $produk = trim($this->input->post('produk'));
        $produkSbl = trim($this->input->post('produkSbl'));
        $storage = trim($this->input->post('storage'));
        $ket = trim($this->input->post('keteranganCPA'));
        
        $dataTrans = array(
            'id_produk' => $produk,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_rencana' => $produkKg,
            'id_storage' => $storage,
            'keterangan' => $ket,
            'userid' => $this->session->userdata('id_user')
        );
        
        $query = $this->sales_order_m->ubahTransOut($dataTrans,$idMasterOut);
        //Model untuk mengembalikan posisi stok sebelum diubah
        $queryUpdateMProdukSbl= $this->global_m->updateMProdukKelReqEdit($produkKgSbl, $produkSbl);//
        //Model untuk mengembalikan posisi stok setelah diubah
        $queryUpdateMProdukStl = $this->global_m->updateMProdukKeluarReq($produkKg, $produk);

        
        if ($query && $queryUpdateMProdukSbl && $queryUpdateMProdukStl) {
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
    function hapus() {
        $this->CI = & get_instance();
        $idSo = trim($this->input->post('idSo'));
        $model = $this->sales_order_m->hapus($idSo);
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

        //$cekMasterAdv	= $this->master_proyek_m->cekMasterAdvance($kywId);
//    	$cekMasterReqpay	= $this->master_proyek_m->cekMasterReqpay($kywId);
//    	$cekMasterReimpay	= $this->master_proyek_m->cekMasterReimpay($kywId);
        /**
         * if($cekMasterAdv == true && $cekMasterReqpay ==true && $cekMasterReimpay ==true){
         *     		$model = $this->master_proyek_m->deleteProyek( $kywId);
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