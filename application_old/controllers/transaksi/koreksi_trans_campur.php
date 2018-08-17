<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Koreksi_trans_campur extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('transaksi/koreksi_trans_campur_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/koreksi_trans_campur/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/koreksi_trans_campur_v', $data);
        }
    }
    public function getTransCampur() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d",strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d",strtotime($tglAkhir));
        
        $rows = $this->koreksi_trans_campur_m->getTransCampur($tglAwal,$tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            
            $tglCamp = trim($row->tgl_trans);
            $tglCamp = date('d-m-Y', strtotime($tglCamp));
            $act = "<a href='#' class='btn red btn-xs' onclick='hapusBaris(".$i.")' ><i class='fa fa-minus fa-fw'/></i></a>";
        
            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_in_camp),
                'tglCampur' => $tglCamp,
                'namaProduk' => trim($row->nama_produk_jadi),
                'jumlah' => trim(number_format($row->total_kg,2)),
                'idProdukJadi'=>trim($row->id_produk_jadi),
                'idFormula'=>trim($row->idFormula),
                'act'=>$act
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
        $rows = $this->koreksi_trans_campur_m->getDescSo($idSo);
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

        $idMasterOut = $this->koreksi_trans_campur_m->getIdMasterOut($bulan, $tahun);

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
            'total_qty' => $produkKg,
            'keterangan_so' => $ket,
            'userid' => $this->session->userdata('id_user'),
        );
        $model = $this->koreksi_trans_campur_m->insertMaster($data);
        
        $idTransOut = $idMasterOut . "-" . 1;
        
        $produk = trim($this->input->post('produk'));
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

        $query = $this->koreksi_trans_campur_m->insertTransOut($dataTrans);
        $queryUpdateMProduk = $this->global_m->updateMProdukKeluarReq($produkKg, $produk);

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
        $model = $this->koreksi_trans_campur_m->ubahMaster($data,$idMasterOut);
        
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
        
        $query = $this->koreksi_trans_campur_m->ubahTransOut($dataTrans,$idMasterOut);
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
        $idMaster = trim($this->input->post('idMaster'));
        $idProdukJadi = trim($this->input->post('idProdukJadi'));
        $idFormula = trim($this->input->post('idFormula'));
        $jumlahProdJadi = str_replace(',', '', trim($this->input->post('jumlahProdJadi')));
        
        //getFormulaProdukCampuran
        $model = $this->koreksi_trans_campur_m->getFormula($idFormula);
        foreach ($model as $row){
            $this->global_m->updateMProdukOutCampKoreksi($row->packsize1,$row->id_produk_isi);
        }
        
        $model = $this->koreksi_trans_campur_m->deleteMasterNTransCamp($idMaster);
        $model = $this->global_m->updateMProdukInCampKoreksi($jumlahProdJadi,$idProdukJadi);
        
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

        $this->output->set_output(json_encode($array));
    }
}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */