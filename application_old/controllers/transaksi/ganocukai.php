<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ganocukai extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/ganocukai_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/ganocukai/home');
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
            $this->template->load('template/template_dataTable', 'transaksi/list_so_v', $data);
        }
    }
    
    public function getRencanaOutAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d",strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d",strtotime($tglAkhir));
        
        $rows = $this->ganocukai_m->getRencanaOutAll($tglAwal,$tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {
            $tglKirim = trim($row->etd);
            $tglKirim = date('d-m-Y', strtotime($tglKirim));
            
            $act = "<a href='#' class='btn yellow btn-sm' onclick='editBaris(".$i.")' ><i class='fa fa-edit fa-fw'/></i></a>";
            
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
                'input_no_aju' => "<input type='text' class ='form-control input-sm' value='".trim($row->no_aju)."' name='tempNoAju".$i."' id='id_tempNoAju".$i."' />",
                'input_no_cukai' => "<input type='text' class ='form-control input-sm' value='".trim($row->no_cukai)."' name='tempNoCukai".$i."' id='id_tempNoCukai".$i."' />",// trim($row->no_cukai)
                'no_aju' =>trim($row->no_aju),
                'no_cukai' =>trim($row->no_cukai),
                'totalQty' => trim(number_format($row->total_qty,2)),
                'keterangan_so'=>trim($row->keterangan_so),
                'act'=>$act
            );

            array_push($data['data'], $array);
            $i++;
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }
    
    
    
    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->ganocukai_m->getDescProduk($idProduk);
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
    function ubah() {
        $this->CI = & get_instance();
        $noSO = trim($this->input->post('noSO', TRUE));
        $noCukai = trim($this->input->post('noCukai', TRUE));
        $noAju = trim($this->input->post('noAju', TRUE));
        $jmlProduk = trim($this->input->post('jmlProduk', TRUE));
        $jmlProduk = str_replace(',', '', $jmlProduk);

        $dataMaster = array(
            'tgl_trans_cukai' => $this->session->userdata('tgl_y'),
            'tgl_input_cukai' => $this->session->userdata('tgl_y'),
            'no_cukai' =>$noCukai,
            'no_aju' =>$noAju,
            'userid_cukai' => $this->session->userdata('id_user')
        );
        $model = $this->ganocukai_m->updateMasterOut($dataMaster,$noSO);
        $noCukaiExist = $this->ganocukai_m->getNoCukaiExist($noSO);
        
        if(trim($noCukaiExist) == ''){//Jika no cukai belum diisi/masih kosong maka update kuota terpakai
            $dataSO = $this->ganocukai_m->getDescSO($noSO);
            $idCust = $dataSO[0]->id_cust;
            $produkKg = $dataSO[0]->total_qty;
            
            $idKuota = $this->global_m->getLastKuotaId($idCust);
            $idKuota = $result[0]->id_kuota; 
            if($idKuota <> ''){// Jika ada kuota maka update kuota, antisipasi jika customer tidak ada kuota
                $model = $this->global_m->updateKuotaTerpakaiCust($idCust,$jmlProduk,$idKuota);
            }
            
        }
        if ($model) {

            $array = array(
                'baris' => 1,
                'no_cukai' => $noCukai,
                'no_aju' => $noAju,
                'tipePesan' => 'success',
                'pesan' => 'Data no cukai ' . $noCukai . ' berhasil diubah.'
            );
        } else {
            $array = array(
                'baris' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data no cukai ' . $noCukai . ' gagal diubah.'
            );
        }

        $this->output->set_output(json_encode($array));
    }
    /*
    function selectedSO($noSO,$noCukai) {
        $menuId = $this->home_m->get_menu_id('transaksi/ganocukai/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['info_so'] = $this->ganocukai_m->getDescSO($noSO);
        $data['jml_rincian_so'] = $this->ganocukai_m->getJmlRincianSO($noSO);
        $data['rincian_so'] = $this->ganocukai_m->getRincianSO($noSO);
        $data['produk'] = $this->ganocukai_m->getProduk();
        $data['storage'] = $this->ganocukai_m->getStorage();
        $data['no_cukai'] = $noCukai;
        
        $idCust =  $data['info_so'][0]->id_cust;
        $tglTrans = $this->session->userdata('tgl_y');
        $tahun = date('Y', strtotime($tglTrans));
        
        $data['kuota'] = $this->global_m->getKuotaCust($idCust,$tahun);
        $data['kuota'] = $data['kuota'][0]->saldo_akhir;
        
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
            $this->template->load('template/template_dataTable', 'transaksi/ganocukai_v', $data);
        }
         
    }
     * */
    /*
    function simpan() {
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        
        $idMaster = trim($this->input->post('idMaster'));
        $noCukai = trim($this->input->post('noCukai'));
        
        $dataMaster = array(
            'tgl_trans_cukai' => $tglTrans,
            'tgl_input_cukai' => $this->session->userdata('tgl_y'),
            'no_cukai' =>$noCukai,
            'userid_cukai' => $this->session->userdata('id_user')
        );
        $model = $this->ganocukai_m->updateMasterOut($dataMaster,$idMaster);
        
        $dataSO = $this->ganocukai_m->getDescSO($idMaster);
        $idCust = $dataSO[0]->id_cust;
        $produkKg = $dataSO[0]->total_qty;
        
        $model = $this->global_m->updateKuotaTerpakaiCust($idCust,$produkKg);

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
        $tglTrans = trim($this->input->post('tglTrans'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        
        $idMaster = trim($this->input->post('idMaster'));
        $noCukai = trim($this->input->post('noCukai'));
        
        $dataMaster = array(
            'tgl_trans_cukai' => $tglTrans,
            'tgl_input_cukai' => $this->session->userdata('tgl_y'),
            'no_cukai' =>$noCukai,
            'userid_cukai' => $this->session->userdata('id_user')
        );
        $model = $this->ganocukai_m->updateMasterOut($dataMaster,$idMaster);
        
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
     */
    


}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */