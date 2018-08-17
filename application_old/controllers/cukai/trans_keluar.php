<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_keluar extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('cukai/trans_keluar_m');
        $this->load->model('global_cukai_m');
        session_start();
    }

    public function index() {
        if ($this->auth->is_logged_in() == false) {
            $this->login();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));

            $this->template->set('title', 'Home');
            $this->template->load('template/template1', 'global_cukai/index', $data);
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('cukai/trans_keluar/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->trans_keluar_m->getProduk();
        $data['jnsdoc'] = $this->trans_keluar_m->getJnsDoc();
        $data['storage'] = $this->trans_keluar_m->getStorage();
        $data['cust'] = $this->trans_keluar_m->getCust();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'cukai/trans_keluar_v', $data);
        }
    }
    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_keluar_m->getRencanaOutAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $tglTrans = trim($row->tgl_trans);
            $tglTrans = date('d-m-Y', strtotime($tglTrans));
            
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));
            
            $tglJT = trim($row->eta);
            $tglJT = date('d-m-Y', strtotime($tglJT));
        
            $array = array(
                'idMaster' => trim($row->id_master_out),
                'poCust' => trim($row->no_po_cust),
                'namaCust' => trim($row->nama_cust),
                'noCukai' => trim($row->no_cukai),
                'tglOrder'  => $tglTrans,
                'tglKirim' => $tglKirim,
                'tglKirim' => $tglKirim,
                'tglJT' => $tglJT,
                'totalQty' => trim(number_format($row->total_qty,2)),
                //'button' => "<button class='btn green btn-xs'>labnobatch</button>",
//                '' => trim($row->),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }
    function getDescSo() {
        $this->CI = & get_instance();
        $idSo = $this->input->post('idSo', TRUE);
        $rows = $this->trans_keluar_m->getDescSo($idSo);
        if ($rows) {
            foreach ($rows as $row)
                $tglEtd = trim($row->etd);
                $tglEtd = date('d-m-Y', strtotime($tglEtd));
                $tglEta = trim($row->eta);
                $tglEta = date('d-m-Y', strtotime($tglEta));
                $array = array(
                    'baris' => 1,
                    'id_cust' => $row->id_cust,
                    'tgl_trans' => $row->tgl_trans,
                    'id_jnsdoc' => $row->id_jnsdoc,
                    'no_po_cust' => $row->no_po_cust,
                    'no_cukai' => $row->no_cukai,
                    'no_batch' => $row->no_batch,
                    'etd' => $tglEtd,
                    'eta' => $tglEta,
                    'id_produk' => $row->id_produk,
                    'qty_rencana' => $row->qty_rencana,
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
        $rows = $this->trans_keluar_m->getDescProduk($idProduk);
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
        $rows = $this->trans_keluar_m->getDescCustomer($idCust);
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
    

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        /*
        $idCust = trim($this->input->post('customer'));
        $poCust = trim($this->input->post('poCust'));
        $jnsdoc = trim($this->input->post('jnsdoc'));
        */
        $produkKg = str_replace(',', '', trim($this->input->post('produkKg')));
        /*
        $ket = trim($this->input->post('keterangan'));

        $tglEtd = trim($this->input->post('etd'));
        $tglEtd = date('Y-m-d', strtotime($tglEtd));

        $tglEta = trim($this->input->post('eta'));
        $tglEta = date('Y-m-d', strtotime($tglEta));
        */

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterOut = trim($this->input->post('SoId'));

        $data = array(
            'status_cukai' => 1,
            
        );
        $model = $this->trans_keluar_m->ubahMaster($data,$idMasterOut);
        
        $produk = trim($this->input->post('produk'));
        $storage = trim($this->input->post('storage'));
        $ket = trim($this->input->post('keteranganCPA'));
        
        $idTransOut = $idMasterOut."-1";
        
        $dataTrans = array(
            'id_trans_out' => $idTransOut,
            'id_master' => $idMasterOut,
            'id_produk' => $produk,
            'kode_trans' => 200,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'qty_rencana' => $produkKg,
            'qty_realisasi' => $produkKg,
            'id_storage' => $storage,
            'keterangan' => $ket,
            'userid' => $this->session->userdata('id_user')
        );

        $query = $this->trans_keluar_m->insertTransOutCukai($dataTrans);
        $queryUpdateMProduk = $this->global_cukai_m->updateMProdukKeluarReq($produkKg, $produk);
        $queryUpdateMProduk = $this->global_cukai_m->updateMProdukKeluar($produkKg, $produk);

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

          $query = $this->trans_keluar_m->insertTransOut($data);
          //$queryUpdateMProduk = $this->trans_keluar_m->updateMProduk($tmpKg, $tmpKdProduk);
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
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'etd' => $tglEtd,
            'eta' => $tglEta,
            'total_qty' => $produkKg,
            'keterangan_so' => $ket,
            'userid' => $this->session->userdata('id_user'),
        );
        $model = $this->trans_keluar_m->ubahMaster($data,$idMasterOut);
        
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
        
        $query = $this->trans_keluar_m->ubahTransOut($dataTrans,$idMasterOut);
        //Model untuk mengembalikan posisi stok sebelum diubah
        $queryUpdateMProdukSbl= $this->global_cukai_m->updateMProdukKelReqEdit($produkKgSbl, $produkSbl);//
        //Model untuk mengembalikan posisi stok setelah diubah
        $queryUpdateMProdukStl = $this->global_cukai_m->updateMProdukKeluarReq($produkKg, $produk);

        
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
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */