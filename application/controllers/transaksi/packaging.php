<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packaging extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/packaging_m');
        $this->load->model('transaksi/sales_order_m');
        $this->load->library('pdf');
        //
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

        $this->pdf->pdf_create($html, $createName, true);
    }

    function cetakSuratJalan($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->trans_app_kirim_m->cetakSuratJalanMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->trans_app_kirim_m->cetakSuratJalanPack($id_master);
            if(sizeof($data['isidatatrans']) <1 ){
                $data['packaging'][0]="Mobil";
            }else{
                $data['packaging'][0]=$data['isidatatrans'][0]->nama_produk;
            } 
            //print_r($data);
            $data['header'] = 'Surat Jalan';
            $this->PdfCreate($data, 'SuratJalan_v', 'SuratJalan_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('transaksi/packaging/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/list_packaging_v', $data);
        }
    }

    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d", strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d", strtotime($tglAkhir));

        $rows = $this->packaging_m->getRencanaOutAll($tglAwal, $tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));

            if ($row->status_pack == 0) {
                $button = "<button class='btn red btn-xs'>not ok</button>";
            } else {
                $button = "<button class='btn green btn-xs'>ok</button>";
            }
            //$id_produk = $this->packaging_m->getIdProdukKirim($row->id_master_out);
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_out),
                'no_sj' => trim($row->no_sj),
                'nama_produk' => trim($row->nama_produk),
                'namaCust' => trim($row->nama_cust),
                'no_jnsdoc' => trim($row->no_jnsdoc),
                'nama_jnsdoc' => trim($row->nama_jnsdoc),
                'no_batch' => trim($row->no_batch),
                'tglKirim' => $tglKirim,
                'no_aju' => trim($row->no_aju),
                'no_cukai' => trim($row->no_cukai),
                'totalQty' => trim(number_format($row->total_qty, 2)),
                'keterangan_so' => trim($row->keterangan_so),
                'label' => $button,
                'status' => $row->status_pack
                    //'act'=>$act
            );

            array_push($data['data'], $array);
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }

    function selectedSO($noSO, $status) {
        $menuId = $this->home_m->get_menu_id('transaksi/packaging/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_so'] = $this->packaging_m->getDescSO($noSO);
        $data['jml_rincian_so'] = $this->packaging_m->getJmlRincianSO($noSO);
        $data['rincian_so'] = $this->packaging_m->getRincianSO($noSO);
        $data['produk'] = $this->packaging_m->getProduk();
        $data['produk_kirim'] = $this->sales_order_m->getProduk();
        $data['storage'] = $this->packaging_m->getStorage();

        $data['status'] = $this->packaging_m->getStatusPack($noSO);
        $data['noSO'] = $noSO;

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
            $this->template->load('template/template_dataTable', 'transaksi/packaging_v', $data);
        }
    }

    function getDataPack() {
        $this->CI = & get_instance();
        $noSO = $this->input->post('noSO', TRUE);
        $rows = $this->packaging_m->getDataPack($noSO);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage,
                    'id_produk' => $row->id_produk,
                    'qty' => $row->qty,
                    'keterangan' => $row->keterangan
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function getRincianSO() {
        $this->CI = & get_instance();
        $noSO = $this->input->post('noSO', TRUE);
        $rows = $this->packaging_m->getRincianSO($noSO);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_storage' => $row->id_storage,
                    'id_produk' => $row->id_produk,
                    'qty' => $row->qty,
                    'keterangan' => $row->keterangan
                        //'' => $row->
                );
        } else {
            $array = array('baris' => 0);
        }
        $this->output->set_output(json_encode($array));
    }

    function getProdukKirim() {
        $this->CI = & get_instance();
        $idMaster = $this->input->post('idMaster', TRUE);
        $crows = $this->packaging_m->getJmlRincianSO($idMaster);
        if ($crows <= 0) {
            $array = array('baris' => 0);
            $rows['data_cpa'] = $array;
            $this->output->set_output(json_encode($rows));
        } else {
            $rows = $this->packaging_m->getRincianSO($idMaster);
            $this->output->set_output(json_encode($rows));
        }
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->packaging_m->getDescProduk($idProduk);
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

    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $idMaster = trim($this->input->post('idMaster'));
        $packMobil = trim($this->input->post('packMobil'));

        if ($packMobil <> 1) {
            $packMobil = 0;
        }

        //$ket = trim($this->input->post('keterangan'));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $produk = trim($this->input->post('produk'));
        $storage = trim($this->input->post('storage')); // storage packaging
        $produkKg = str_replace(',', '', trim($this->input->post('produkKg')));
        $ket = trim($this->input->post('keteranganCPA'));
        /* HANDLING DATA PACK */
        $dataMaster = array(
            'tgl_pack' => $tglTrans,
            'tgl_input_pack' => $this->session->userdata('tgl_y'),
            'userid_pack' => $this->session->userdata('id_user'),
            'status_pack' => 1,
        );
        $model = $this->packaging_m->updateMasterOut($dataMaster, $idMaster);

        //** Handling data packaging
        if ($packMobil == 0) {
            $i = 1;
            $idTransOutPack = $idMaster . "-" . $i;
            $dataTrans = array(
                'id_trans_out_pack' => $idTransOutPack,
                'id_master_out' => $idMaster,
                'id_produk' => $produk,
                'tgl_trans' => $tglTrans,
                'tgl_input' => $this->session->userdata('tgl_y'),
                'qty' => $produkKg,
                'id_storage' => $storage,
                'keterangan' => $ket,
                'userid' => $this->session->userdata('id_user')
            );

            $query = $this->packaging_m->insertTransOutPack($dataTrans);
            $queryUpdateMProduk = $this->global_m->updateMProdukKeluarPack($produkKg, $produk);
        }
        /* END HANDLING DATA PACK */
        /* HANDLING DATA PRODUK KIRIM */
        // get produk in sales order set
        $dataProdukSOSet = $this->packaging_m->getAllTransOut($idMaster);
        foreach ($dataProdukSOSet as $row) {
            $queryUpdateMProdukSbl = $this->global_m->updateMProdukKelReqEdit($row->qty_rencana, $row->id_produk); //
        }
        $deleteTransOut = $this->packaging_m->hapusRincianPengiriman($idMaster);


        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpKet = trim($this->input->post($tKet));

                    $idTransOut = $idMaster . "-" . $i;

                    $data = array(
                        'id_trans_out' => $idTransOut,
                        'id_master' => $idMaster,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 200,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_rencana' => $tmpKg,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet, //"rufjfi",//
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->sales_order_m->insertTransOut($data);
                    $queryUpdateMProduk = $this->global_m->updateMProdukKeluarReq($tmpKg, $tmpKdProduk);
                }
            }
        }


        /* UPDATE STORAGE PRODUK OLEH BAGIAN GUDANG 

          $storageProduk = trim($this->input->post('storageProduk'));
          $dataTransOut = array(
          'id_storage' => $storageProduk
          );
          $queryUpdateTransOut = $this->packaging_m->updateTransOut($dataTransOut, $idMaster);
          END OF HANDLING DATA PRODUK */
        if ($query) {
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
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $idMaster = trim($this->input->post('idMaster'));
        $packMobil = trim($this->input->post('packMobil'));
        //$ket = trim($this->input->post('keterangan'));
        if ($packMobil <> 1) {
            $packMobil = 0;
        }

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $produk = trim($this->input->post('produk'));
        $produkSbl = trim($this->input->post('produkSbl'));
        $storage = trim($this->input->post('storage'));
        $produkKg = str_replace(',', '', trim($this->input->post('produkKg')));
        $produkKgSbl = str_replace(',', '', trim($this->input->post('produkKgSbl')));
        $ket = trim($this->input->post('keteranganCPA'));

        $dataMaster = array(
            'tgl_pack' => $tglTrans,
            'tgl_input_pack' => $this->session->userdata('tgl_y'),
//            'nama_pengirim' => $nmPengirim,
//            'no_mobil' => $noMobil,
            'userid_pack' => $this->session->userdata('id_user'),
            'status_pack' => 1,
        );
        $model = $this->packaging_m->updateMasterOut($dataMaster, $idMaster);
        if ($packMobil == 0) {
            if ($produkSbl == 0 || $produkSbl == '') {
                $i = 1;
                $idTransOutPack = $idMaster . "-" . $i;
                $dataTrans = array(
                    'id_trans_out_pack' => $idTransOutPack,
                    'id_master_out' => $idMaster,
                    'id_produk' => $produk,
                    'tgl_trans' => $tglTrans,
                    'tgl_input' => $this->session->userdata('tgl_y'),
                    'qty' => $produkKg,
                    'id_storage' => $storage,
                    'keterangan' => $ket,
                    'userid' => $this->session->userdata('id_user')
                );

                $query = $this->packaging_m->insertTransOutPack($dataTrans);
                $queryUpdateMProduk = $this->global_m->updateMProdukKeluarPack($produkKg, $produk);
            } else {
                $dataTrans = array(
                    'id_produk' => $produk,
                    'tgl_trans' => $tglTrans,
                    'tgl_input' => $this->session->userdata('tgl_y'),
                    'qty' => $produkKg,
                    'id_storage' => $storage,
                    'keterangan' => $ket,
                    'userid' => $this->session->userdata('id_user')
                );

                //$queryUpdateMProduk = $this->global_m->updateMProdukKeluarPack($produkKg, $produk);

                $query = $this->packaging_m->ubahTransOutPack($dataTrans, $idMaster);
                //Model untuk mengembalikan posisi stok sebelum diubah
                $queryUpdateMProdukSbl = $this->global_m->updateMProdukKeluarPackEdit($produkKgSbl, $produkSbl); //
                //Model untuk mengembalikan posisi stok setelah diubah
                $queryUpdateMProdukStl = $this->global_m->updateMProdukKeluarPack($produkKg, $produk);
            }
        } else {
            if ($produkSbl == 0 || $produkSbl == '') {
                // jika pack sebelum nya kosong (packaging mobil) maka tidak ada yg perlu diupdate
            } else {
                //kembalikan data di master produk
                $dataPackSet = $this->packaging_m->getAllTransOutPack($idMaster);
                foreach ($dataPackSet as $row) {
                    $queryUpdateMProdukSbl = $this->global_m->updateMProdukKeluarPackEdit($row->qty, $row->id_produk); //
                }
                //hapus di tras_outpack-> data rincian pack
                $deleteTransOut = $this->packaging_m->hapusRincianPack($idMaster);
            }
        }


        /* HANDLING DATA PRODUK KIRIM */
        // get produk in sales order set
        $dataProdukSOSet = $this->packaging_m->getAllTransOut($idMaster);
        foreach ($dataProdukSOSet as $row) {
            $queryUpdateMProdukSbl = $this->global_m->updateMProdukKelReqEdit($row->qty_rencana, $row->id_produk); //
        }
        $deleteTransOut = $this->packaging_m->hapusRincianPengiriman($idMaster);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdStorage = 'tempKdStorage' . $i;
                    $tKg = 'tempKg' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdStorage = trim($this->input->post($tKdStorage));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpKet = trim($this->input->post($tKet));

                    $idTransOut = $idMaster . "-" . $i;

                    $data = array(
                        'id_trans_out' => $idTransOut,
                        'id_master' => $idMaster,
                        'id_produk' => $tmpKdProduk,
                        'kode_trans' => 200,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty_rencana' => $tmpKg,
                        'id_storage' => $tmpKdStorage,
                        'keterangan' => $tmpKet, //"rufjfi",//
                        'userid' => $this->session->userdata('id_user')
                    );

                    $query = $this->sales_order_m->insertTransOut($data);
                    $queryUpdateMProduk = $this->global_m->updateMProdukKeluarReq($tmpKg, $tmpKdProduk);
                }
            }
        }
        /* UPDATE STORAGE PRODUK OLEH BAGIAN GUDANG 
          $storageProduk = trim($this->input->post('storageProduk'));
          $dataTransOut = array(
          'id_storage' => $storageProduk
          );
          $queryUpdateTransOut = $this->packaging_m->updateTransOut($dataTransOut, $idMaster);
         */
        if ($query) {
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

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */