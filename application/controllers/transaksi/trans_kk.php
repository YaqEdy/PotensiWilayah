<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta');

class Trans_kk extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/trans_kk_m');
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

    function PdfCreate($data, $viewName, $createName) {

        $html = $this->load->view('cetak/' . $viewName, $data, true);

        $this->pdf->pdf_create($html, $createName, true);
    }

    function cetakPO($id_master) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            //$id_master = (isset($_GET['id']) == true ? $_GET['id'] : 0);
            $data['isidatamaster'] = $this->trans_kk_m->cetakPOMaster($id_master);
            //print_r($data['isidatamaster']);
            $data['isidatatrans'] = $this->trans_kk_m->cetakPOTrans($id_master);
            //print_r($data['isidatatrans']);
            $data['header'] = 'PO';
            $this->PdfCreate($data, 'PO_v', 'PO_v');
        }
    }

    function home() {
        $menuId = $this->home_m->get_menu_id('transaksi/trans_kk/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['produk'] = $this->trans_kk_m->getProduk();
        $data['cust'] = $this->trans_kk_m->getCustomer();
        $data['agen'] = $this->trans_kk_m->getAgen();
        $data['karyawan'] = $this->sec_user_m->getAllKaryawan();
        $data['osource'] = $this->trans_kk_m->getAllOutsource();
        
        $data['kec'] = $this->global_m->getSelectOption('master_kecamatan','','','','','id_kec');
        $data['kel'] = $this->global_m->getSelectOption('master_kelurahan','','','','','id_kel');
        $data['difabel'] = $this->global_m->getSelectOption('tbl_m_difabel','','','','','id_difabel');
        $data['hub_kel'] = $this->global_m->getSelectOption('tbl_r_hub_kel','','','','','id_hub_kel');

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/trans_kk_v', $data);
        }
    }
    public function getKKAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_kk_m->getKKAll();
        $data['data'] = array();
        $no = 1;
        foreach ($rows as $row) {
            $array = array(
                'no'=>$no,
                'idKK' => trim($row->id_master_kk),
                'idKtp' => trim($row->id_ktp),
                'namaKtp' => trim($row->nama_ktp),
                'kec' => trim($row->nama_kec),
                'kel' => trim($row->nama_kel),
                'rw' => trim($row->rw),
                'rt' => trim($row->rt),
                'jmlAgt' => trim($row->jml_anggota_keluarga)
            );
            array_push($data['data'], $array);
            $no++;
        }
        $this->output->set_output(json_encode($data));
    }

    public function upload($sNama,$sPath){
        // $fileName = date('YmdHisu');
        $fileName = $this->global_m->get_data("select uuid() as uuid")[0]->uuid;

        $config = array(
            'upload_path' => './' . $sPath,
            'file_name' => $fileName,
            'overwrite' => true,
            // 'allowed_types' => '*',
            'allowed_types'=>'gif|jpg|png|jpeg',
            'max_size' => 0,
            'max_width' => 0,
            'max_height' => 0
        );

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($sNama)) {
            $result = array(false,$this->upload->display_errors());
        }else{
            $resultUpload = $this->upload->data();
            $result = array(true,$fileName.$resultUpload['file_ext']);
        }
        return $result;
    }
    public function ajax_simpan_kk() {
        $this->load->helper('form', 'url');
        $istatus=false;

        $idtrans_kk = $this->input->post('idtrans_kk');

        $path = 'uploads/foto/';
        $iUploadFoto=$this->upload('foto_ktp',$path);
        if(!$iUploadFoto[0]){
            $result = array('istatus' => false, 'iremarks' => $iUploadFoto[1]);
        } else {
            $iUploadFotoRumah=$this->upload('foto_rumah',$path);

            $iCek = $this->global_m->get_data("select * FROM trans_kk where id_master_kk='$idtrans_kk' or id_ktp='".$this->input->post('nik_')."'");
            if (sizeof($iCek) <= 0) {
                $data_ktp = array(
                    'id_ktp' => $this->input->post('nik_'),
                    'nama_ktp' => $this->input->post('nama_'),
                    'tempat_lahir' => $this->input->post('tmpt_lahir_'),
                    'tanggal_lahir' => date('Y-m-d', strtotime($_POST['tglLahir_'])),
                    'jekel' => $this->input->post('jekel_'),
                    'gol_darah' => $this->input->post('gol_darah_'),
                    'alamat' => $this->input->post('alamat_'),
                    'rt' => $this->input->post('rt_'),
                    'rw' => $this->input->post('rw_'),
                    'id_kel' => $this->input->post('kel_'),
                    'id_kec' => $this->input->post('kec_'),
                    'agama' => $this->input->post('agama_'),
                    'status_kawin' => $this->input->post('status_'),
                    'pekerjaan' => $this->input->post('pekerjaan_'),
                    'warga_negara' => $this->input->post('warga_negara_'),
                    'link_gambar' => $path .$iUploadFoto[1],
                    'status_hidup' => 1
                );
                $data_kk = array(
                    // 'idtrans_kk' => $fileName,
                    'id_master_kk' => $this->input->post('noKK'),
                    'id_ktp' => $this->input->post('nik_'),
                    'pendidikan' => $this->input->post('pendidikan_'),
                    'hub_keluarga' => 1,
                    'rumah_path' => $path .$iUploadFotoRumah[1]
                    // 'id_ktp' => date('Y-m-d', strtotime($_POST['id_tglLahir_'])),
                    // 'create_by' => $this->session->userdata('id_user'),
                    // 'create_date' => date('Y-m-d H:i:s')
                );
                $data_difabel = array(
                    'id_ktp' => $this->input->post('nik_'),
                    'id_m_difabel' => $this->input->post('difabel_')
                );
                $data_bantuan = array(
                    'id_ktp' => $this->input->post('nik_'),
                    'bantuan_desc' => $this->input->post('bantuan_')
                );
                // print_r($data_ktp);die();
                $result = $this->global_m->simpan('master_ktp', $data_ktp);
                $result = $this->global_m->simpan('trans_kk', $data_kk);
                $result = $this->global_m->simpan('tbl_t_difabel', $data_difabel);
                $result = $this->global_m->simpan('tbl_t_bantuan', $data_bantuan);
                $istatus=true;
                $iremarks="Insert Success.!";
            } else {
                $data_ktp = array(
                    // 'id_ktp' => $this->input->post('nik_'),
                    'nama_ktp' => $this->input->post('nama_'),
                    'tempat_lahir' => $this->input->post('tmpt_lahir_'),
                    'tanggal_lahir' => date('Y-m-d', strtotime($_POST['tglLahir_'])),
                    'jekel' => $this->input->post('jekel_'),
                    'gol_darah' => $this->input->post('gol_darah_'),
                    'alamat' => $this->input->post('alamat_'),
                    'rt' => $this->input->post('rt_'),
                    'rw' => $this->input->post('rw_'),
                    'id_kel' => $this->input->post('kel_'),
                    'id_kec' => $this->input->post('kec_'),
                    'agama' => $this->input->post('agama_'),
                    'status_kawin' => $this->input->post('status_'),
                    'pekerjaan' => $this->input->post('pekerjaan_'),
                    'warga_negara' => $this->input->post('warga_negara_'),
                    'link_gambar' => $path .$iUploadFoto[1]
                    // 'status_hidup' => $this->input->post('status_')
                );
                $data_kk = array(
                    // 'idtrans_kk' => $fileName,
                    'id_master_kk' => $this->input->post('noKK'),
                    'id_ktp' => $this->input->post('nik_'),
                    'pendidikan' => $this->input->post('pendidikan_'),
                    'hub_keluarga' => 1,
                    'rumah_path' => $path .$iUploadFotoRumah[1]
                    // 'id_ktp' => date('Y-m-d', strtotime($_POST['id_tglLahir_'])),
                    // 'create_by' => $this->session->userdata('id_user'),
                    // 'create_date' => date('Y-m-d H:i:s')
                );
                $data_difabel = array(
                    'id_ktp' => $this->input->post('nik_'),
                    'id_m_difabel' => $this->input->post('difabel_')
                );
                $data_bantuan = array(
                    'id_ktp' => $this->input->post('nik_'),
                    'bantuan_desc' => $this->input->post('bantuan_')
                );

                $result = $this->global_m->ubah('master_ktp', $data_ktp, 'id_ktp', $this->input->post('nik_'));
                $result = $this->global_m->ubah('trans_kk', $data_kk, 'idtrans_kk', $iCek[0]->idtrans_kk);
                $result = $this->global_m->ubah('tbl_t_difabel', $data_difabel, 'id_ktp', $this->input->post('nik_'));
                $result = $this->global_m->ubah('tbl_t_bantuan', $data_bantuan, 'id_ktp', $this->input->post('nik_'));

            $istatus=true;
            $iremarks="Update Success.!";
        }

            if ($result) {
                $anggotaKel=$this->saveAnggotaKel();
                if($anggotaKel[0]){
                    $result = array('istatus' => $istatus, 'iremarks' => $iremarks); //, 'body'=>'Data Berhasil Disimpan');
                }else{
                    $result = array('istatus' => $anggotaKel[0], 'iremarks' => $anggotaKel[1]); //, 'body'=>'Data Berhasil Disimpan');
                }
            } else {
                $result = array('istatus' => $istatus, 'iremarks' => $iremarks);
            }
        }
        echo json_encode($result);
    }

    function saveAnggotaKel(){
        $iDel_data=explode(",", $this->input->get('sDel'));
        $iAnggotaKel=$this->input->get('sLength');
        if($iAnggotaKel>0){
            for($i=1;$i<=$iAnggotaKel;$i++){
                // if(count($iDel_data)>0){
                //     for($a=0;$a<count($iDel_data);$a++){
                //         if($i!=$iDel_data[$a]){
                            $data_anggota_ktp = array(
                                'id_ktp' => $this->input->post('nik'.$i),
                                'nama_ktp' => $this->input->post('nama'.$i),
                                'tempat_lahir' => $this->input->post('tmpt_lahir'.$i),
                                'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tgl_lahir'.$i))),
                                'jekel' => $this->input->post('jekel_'.$i),
                                'gol_darah' => $this->input->post('gol_darah'.$i),
                                'alamat' => $this->input->post('alamat_'),
                                'rt' => $this->input->post('rt_'),
                                'rw' => $this->input->post('rw_'),
                                'id_kel' => $this->input->post('kel_'),
                                'id_kec' => $this->input->post('kec_'),
                                'agama' => $this->input->post('agama_'.$i),
                                'status_kawin' => $this->input->post('status_'.$i),
                                'pekerjaan' => $this->input->post('pekerjaan'.$i),
                                // 'warga_negara' => $this->input->post('warga_negara'.$i),
                                // 'link_gambar' => $path .$iUploadFoto[1],
                                'status_hidup' => 1
                            );                                        
                            $data_anggota_kk = array(
                                // 'idtrans_kk' => $fileName,
                                'id_master_kk' => $this->input->post('noKK'),
                                'id_ktp' => $this->input->post('nik'.$i),
                                'pendidikan' => $this->input->post('pendidikan_'.$i),
                                'hub_keluarga' => $this->input->post('hub_kel_'.$i)
                                // 'rumah_path' => $path .$iUploadFotoRumah[1]
                                // 'id_ktp' => date('Y-m-d', strtotime($_POST['id_tglLahir_'])),
                                // 'create_by' => $this->session->userdata('id_user'),
                                // 'create_date' => date('Y-m-d H:i:s')
                            );
                            $data_anggota_difabel = array(
                                'id_ktp' => $this->input->post('nik'.$i),
                                'id_m_difabel' => $this->input->post('difabel_'.$i)
                            );
                            $data_anggota_bantuan = array(
                                'id_ktp' => $this->input->post('nik'.$i),
                                'bantuan_desc' => $this->input->post('bantuan_'.$i)
                            );
                            // print_r($data_anggota_bantuan);die();
                            // $result = $this->global_m->simpan('master_ktp', $data_anggota_kk);
                            $result = $this->global_m->simpan('master_ktp', $data_anggota_ktp);
                            $result = $this->global_m->simpan('trans_kk', $data_anggota_kk);
                            $result = $this->global_m->simpan('tbl_t_difabel', $data_anggota_difabel);
                            $result = $this->global_m->simpan('tbl_t_bantuan', $data_anggota_bantuan);
                            if ($result) {
                                $result = array(true, 'Insert Anggota Keluarga Success.!'); //, 'body'=>'Data Berhasil Disimpan');
                            } else {
                                $result = array(false, 'Insert Anggota Keluarga Gagal.!');
                            }
                 //         }
                //     }    
                // }
            }
        }
        return $result;
    }

    function getDescProduk() {
        $this->CI = & get_instance();
        $idProduk = $this->input->post('idProduk', TRUE);
        $rows = $this->trans_kk_m->getDescProduk($idProduk);
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

        $etglSelesai = trim($this->input->post('etglSelesai'));
        $etglSelesai = date('Y-m-d', strtotime($etglSelesai));
        $status_bayar = trim($this->input->post('status_bayar'));
        $diskon_lgsbayar = str_replace(',', '', trim($this->input->post('diskon_lgsbayar')));

        $idCustomer = trim($this->input->post('customer'));
        $namaCust = trim($this->input->post('nama_cust'));
        $bonManual = trim($this->input->post('bonManual'));
        $prioritas = trim($this->input->post('prioritas'));
        $idAgen = trim($this->input->post('agen'));
        $totalKg = str_replace(',', '', trim($this->input->post('totalKg')));
        $totalHargaAll = str_replace(',', '', trim($this->input->post('totalHargaAll')));
        $ket_cm = trim($this->input->post('keterangan_cm'));

        $bulan = date('m', strtotime($tglTrans)); //$tglTrans->format("m");
        $tahun = date('Y', strtotime($tglTrans)); //$tglTrans->format("Y");

        $idMasterCm = $this->trans_kk_m->getIdMasterIn($bulan, $tahun);
        //$noPO = $this->trans_kk_m->getNoPO($bulan, $tahun);

        $dataMaster = array(
            'id_master_cm' => $idMasterCm,
            'no_bon_manual' => $bonManual,
            'id_cust' => $idCustomer,
            'id_agen' => $idAgen,
            'tgl_trans' => $tglTrans,
            'tgl_input' => $this->session->userdata('tgl_y'),
            'prioritas' => $prioritas,
            'e_tgl_selesai' => $etglSelesai,
            'waktu_masuk' => date("H:i:s"),
            'waktu_ambil' => date("H:i:s"),
            'total_qty_kg' => $totalKg,
            'total_qty_satuan' => $totalKg,
            'total_harga' => $totalHargaAll,
            'berat_ambil' => $totalKg,
            'status_bayar' => $status_bayar,
            'ket_cm' => $ket_cm,
            'userid' => $this->session->userdata('id_user')
        );
        $model = $this->trans_kk_m->insertMaster($dataMaster);

        $totJurnal = trim($this->input->post('txtTempLoop'));
        $kiloan = 0;
        $satuan = 0;
        $totalhargakiloan = 0;
        $totalhargasatuan = 0;
        if ($totJurnal > 0) {
            for ($i = 1; $i <= $totJurnal; $i++) {
                $tKdProduk = 'tempKdProduk' . $i;
                $tmpKdProduk = trim($this->input->post($tKdProduk));

                if ($tmpKdProduk <> '') {
                    $tKdLayanan = 'tempKdLayanan' . $i;
                    $tKg = 'tempKg' . $i;
                    $tHargaSatuan = 'tempHargaSatuan' . $i;
                    $tTotalHarga = 'tempTotalHarga' . $i;
                    $tKet = 'tempKet' . $i;

                    $tmpKdLayanan = trim($this->input->post($tKdLayanan));
                    $tmpKg = str_replace(',', '', trim($this->input->post($tKg)));
                    $tmpHargaSatuan = str_replace(',', '', trim($this->input->post($tHargaSatuan)));
                    $tmpTotalHarga = str_replace(',', '', trim($this->input->post($tTotalHarga)));
                    $tmpKet = trim($this->input->post($tKet));

                    // CEK ==== AMBIL AJA HARGA TOTALPER ROW, JANGAN DIKALI LAGI HASILNYA ASTI BEDA
                    $hargaper_row = $tmpTotalHarga; //$tmpKg * $tmpHargaSatuan;
                    $idTransCm = $idMasterCm . "-" . $i;

                    $data = array(
                        'id_trans' => $idTransCm,
                        'id_master' => $idMasterCm,
                        'id_produk' => $tmpKdProduk,
                        'id_layanan' => $tmpKdLayanan,
                        'kode_trans' => 100,
                        'tgl_trans' => $tglTrans,
                        'tgl_input' => $this->session->userdata('tgl_y'),
                        'qty' => $tmpKg,
                        'harga_satuan' => $tmpHargaSatuan
                    );

                    $query = $this->trans_kk_m->insertTransInOut($data);
                    if ($tmpKdProduk == '000001') {
                        $kiloan = $kiloan + $tmpKg;
                        $totalhargakiloan = $totalhargakiloan + $hargaper_row;
                    } else {
                        $satuan = $satuan + $tmpKg;
                        $totalhargasatuan = $totalhargasatuan + $hargaper_row;
                    }
                    //$queryUpdateMProduk = $this->trans_kk_m->updateMProduk($tmpKg, $tmpKdProduk);
                }
            }
        }
        $dataMaster = array(
            'total_qty_kg' => $kiloan,
            'total_qty_satuan' => $satuan,
            'total_harga_kg' => $totalhargakiloan,
            'total_harga_satuan' => $totalhargasatuan
        );

        $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMasterCm);
        $deskripsiJurnal = 'Cucian masuk ' . $namaCust;
        //$modelJurnal = $this->jurnal_cucian_masuk($tglTrans, $deskripsiJurnal, $totalhargakiloan, $totalhargasatuan, $totalHargaAll);
        $modelJurnal = $this->jurnal_cucian_masuk_fix($tglTrans, $deskripsiJurnal, $totalhargakiloan, $totalhargasatuan, $totalHargaAll, $idMasterCm);
        if ($idAgen <> '') {
            $bulan = date('m', strtotime($tglTrans));
            $tahun = date('Y', strtotime($tglTrans));
            $tanggal = date('d', strtotime($tglTrans));

            $getInfoAgen = $this->trans_kk_m->getInfoAgen($idAgen);
            $getIntAgen = $this->akuntansi_m->getkodeperk('biaya_agen');

            $hutangJasaAgen = 25 / 100 * $totalHargaAll;

            $namaAgen = $getInfoAgen[0]->nama_agen;
            $kd_perk_agen = $getInfoAgen[0]->kode_perk;

            $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
            $deskripsiJurnal = 'Hutang jasa agen ' . $namaAgen;
            $modul = '1';

            //DEBET
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $getIntAgen;
            $debet = $hutangJasaAgen;
            $kredit = 0;
            $total_trans = $hutangJasaAgen;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            //KREDIT
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $kd_perk_agen;
            $debet = 0;
            $kredit = $hutangJasaAgen;
            $total_trans = $hutangJasaAgen;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            /*
              $modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
              $model = $this->akuntansi_m->insert_jurnalD($modelidAPtrans, $tglTrans, $modelidAP, $getIntAgen, $deskripsiJurnal, $hutangJasaAgen, $hutangJasaAgen);
              $modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
              $model = $this->akuntansi_m->insert_jurnalK($modelidAPtrans, $tglTrans, $modelidAP, $kd_perk_agen, $deskripsiJurnal, $hutangJasaAgen, $hutangJasaAgen);
             * */
        }
        if ($status_bayar == 1) {
            $dataMaster_sdhbayar = array(
                'status_bayar' => $status_bayar,
                'diskon' => $diskon_lgsbayar,
                'jml_bayar' => $totalHargaAll
            );
            $model = $this->trans_kk_m->ubahMaster($dataMaster_sdhbayar, $idMasterCm);
            //$modelJurnal = $this->jurnal_cucian_bayar($tglTrans, $namaCust, $totalhargakiloan, $totalhargasatuan, ($totalHargaAll - $diskon_lgsbayar), $diskon_lgsbayar);
            $modelJurnal = $this->jurnal_cucian_bayar_fix($tglTrans, $idMasterCm, $namaCust, $totalhargakiloan, $totalhargasatuan, ($totalHargaAll - $diskon_lgsbayar), $diskon_lgsbayar);
        }

        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.',
                'idMaster' => $idMasterCm
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

    public function jurnal_cucian_masuk_fix($tglTrans, $deskripsiJurnal, $totalhargakiloan, $totalhargasatuan, $totalHargaAll, $idMasterCm) {
        $bulan = date('m', strtotime($tglTrans));
        $tahun = date('Y', strtotime($tglTrans));
        $tanggal = date('d', strtotime($tglTrans));

        $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
        $modul = '1';
        if ($totalhargakiloan > 0) {
            //DEBET
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('piutang_cm_kiloan');
            $debet = $totalhargakiloan;
            $kredit = 0;
            $total_trans = $totalHargaAll;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            //KREDIT
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('pendapatan_cm_kiloan');
            $debet = 0;
            $kredit = $totalhargakiloan;
            $total_trans = $totalHargaAll;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        }
        if ($totalhargasatuan > 0) {
            //DEBET
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('piutang_cm_satuan');
            $debet = $totalhargasatuan;
            $kredit = 0;
            $total_trans = $totalHargaAll;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            //KREDIT
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('pendapatan_cm_satuan');
            $debet = 0;
            $kredit = $totalhargasatuan;
            $total_trans = $totalHargaAll;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        }
    }

    public function getCucianMasuk() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $tglAwal = $this->input->post('tglAwalDaftar', TRUE);
        $tglAwal = date("Y-m-d", strtotime($tglAwal));
        $tglAkhir = $this->input->post('tglAkhirDaftar', TRUE);
        $tglAkhir = date("Y-m-d", strtotime($tglAkhir));

        $rows = $this->trans_kk_m->getCucianMasuk($tglAwal, $tglAkhir);
        $data['data'] = array();
        $i = 0;
        $noSeq = 1;
        foreach ($rows as $row) {

            $tglTrans = trim($row->tgl_trans);
            $tglTrans = date('d-m-Y', strtotime($tglTrans));
            $tglSelesai = trim($row->tgl_selesai);
            $tglSelesai = date('d-m-Y', strtotime($tglSelesai));
            $tglAmbil = trim($row->tgl_ambil);
            $tglAmbil = date('d-m-Y', strtotime($tglAmbil));
            $tglOutKel = trim($row->tgl_outsource_keluar);
            $tglOutKel = date('d-m-Y', strtotime($tglOutKel));
            $tglOutMsk = trim($row->tgl_outsource_masuk);
            $tglOutMsk = date('d-m-Y', strtotime($tglOutMsk));
            $actUbah = "<a href='#' class='btn yellow btn-sm' onclick='editBaris(tr" . $i . ")' ><i class='fa fa-edit fa-fw'/></i></a>";
            $actDetail = "<a href='#' class='btn blue btn-sm' onclick='detailBaris(tr" . $i . ")' ><i class='fa fa-list fa-fw'/></i></a>";


            $status_outsource = trim($row->status_outsource);
            if ($status_outsource == 0) {
                $statusOutsource = "<span class='label label-info'> Tidak </span>";
            } else if ($status_outsource == 1) {
                $statusOutsource = "<span class='label label-warning'> Onproses </span>";
            } else {
                $statusOutsource = "<span class='label label-success'> Selesai </span>";
            }
            $status_selesai = trim($row->status_selesai);
            if ($status_selesai == 0) {
                $statusSelesai = "<span class='label label-danger'> Blm Selesai </span>";
            } else {
                $statusSelesai = "<span class='label label-success'> Selesai </span>";
            }
            $status_bayar = trim($row->status_bayar);
            if ($status_bayar == 0) {
                $statusBayar = "<span class='label label-danger'> Belum </span>";
            } else {
                $statusBayar = "<span class='label label-success'> Sudah </span>";
            }

            $etglEst = trim($row->e_tgl_selesai);
            if ($etglEst == '0000-00-00') {
                $etglEst = "-";
            } else {
                $etglEst = date('d-m-Y', strtotime($etglEst));
            }
            $prioritas = trim($row->prioritas);
            if ($prioritas == 1) {
                $prioritas = "<span class='label label-danger'> Express </span>";
            } else {
                $prioritas = "<span class='label label-success'> Biasa </span>";
            }


            $array = array(
                'noSeq' => $noSeq,
                'idMaster' => trim($row->id_master_cm),
                'noBon' => trim($row->no_bon_manual),
                'id_cust' => trim($row->id_cust),
                'nama_cust' => trim($row->nama_cust),
                'tgl_trans' => $tglTrans,
                'layanan' => $prioritas,
                'e_tgl_selesai' => $etglEst,
                'tgl_selesai' => $tglSelesai,
                'tgl_ambil' => $tglAmbil,
                'waktu_masuk' => trim($row->waktu_masuk),
                'waktu_ambil' => trim($row->waktu_ambil),
                'tgl_outsource_keluar' => $tglOutKel,
                'tgl_outsource_masuk' => $tglOutMsk,
                'total_qty_kg' => trim(number_format($row->total_qty_kg, 2)),
                'total_qty_satuan' => trim($row->total_qty_satuan),
                'total_harga' => trim(number_format($row->total_harga, 0)),
                'berat_ambil' => trim(number_format($row->berat_ambil, 2)),
                'status_outsource' => $statusOutsource,
                'status_selesai' => $statusSelesai,
                'status_bayar' => $statusBayar
                    //'actDetail' => $actDetail,
                    //'actUbah' => $actUbah,
                    //'act' => $act
            );

            array_push($data['data'], $array);
            $i++;
            $noSeq++;
        }
        $this->output->set_output(json_encode($data));
    }

    function getCMDetail() {
        $this->CI = & get_instance();
        $idMaster = $this->input->post('idMaster', TRUE);
        $crows = $this->trans_kk_m->getJmlRincianCM($idMaster);
        if ($crows <= 0) {
            $array = array('baris' => 0);
            $rows['data_cpa'] = $array;
            $this->output->set_output(json_encode($rows));
        } else {
            $rows = $this->trans_kk_m->getRincianCM($idMaster);
            $this->output->set_output(json_encode($rows));
        }
    }

    function simpanAmbil() {
        $this->CI = & get_instance();
        $tglTrans = trim($this->input->post('tglAmbil'));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        $idMaster = trim($this->input->post('idMaster', TRUE));
        $namaCust = trim($this->input->post('namaCust', TRUE));
        $stsBayar = trim($this->input->post('stsBayar', TRUE));
        $stsBon = trim($this->input->post('stsBon', TRUE));
        $diskon = str_replace(',', '', trim($this->input->post('diskon', TRUE)));
        $ketAmbil = trim($this->input->post('ketAmbil', TRUE));
        if ($stsBayar == 0) {
            $jmlBayar = 0;
        } else {
            $jmlBayar = str_replace(',', '', trim($this->input->post('jmlBayar', TRUE)));
        }

        $statusSelesai = $this->trans_kk_m->getStatusSelesai($idMaster);
        $statusOutsource = $this->trans_kk_m->getStatusOutsource($idMaster);

        if ($statusSelesai == 0 || $statusOutsource == 1) {
            $array = array(
                'baris' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Cucian no ' . $idMaster . ' belum selesai.'
            );
        } else {
            $getStatusBayar = $this->trans_kk_m->getStatusBayar($idMaster);

            if ($getStatusBayar == 1) {
                $dataMaster = array(
                    'tgl_ambil' => $tglTrans,
                    'waktu_ambil' => date("H:i:s"),
                    'status_ambil' => 1,
                    'status_bon' => $stsBon,
                    'ket_ambil' => $ketAmbil
                );
                $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMaster);
            } else {
                $dataMaster = array(
                    'tgl_ambil' => $tglTrans,
                    'waktu_ambil' => date("H:i:s"),
                    'status_ambil' => 1,
                    'status_bayar' => $stsBayar,
                    'status_bon' => $stsBon,
                    'diskon' => $diskon,
                    'jml_bayar' => $jmlBayar,
                    'ket_ambil' => $ketAmbil
                );

                $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMaster);

                /* Insert Jurnal == Jika bayar */
                if ($stsBayar == 1 && $jmlBayar > 0) {
                    $piutang = $this->trans_kk_m->getPiutang($idMaster);
                    $totalPiutangKiloan = $piutang[0]->total_harga_kg;
                    $totalPiutangSatuan = $piutang[0]->total_harga_satuan;
                    $modelJurnal = $this->jurnal_cucian_bayar_fix($tglTrans, $idMaster, $namaCust, $totalPiutangKiloan, $totalPiutangSatuan, $jmlBayar, $diskon);
                }
                /* End Insert Jurnal */
            }

            if ($model) {
                $array = array(
                    'baris' => 1,
                    'tipePesan' => 'success',
                    'pesan' => 'Cucian no  ' . $idMaster . ' telah diambil.'
                );
            } else {
                $array = array(
                    'baris' => 0,
                    'tipePesan' => 'error',
                    'pesan' => 'Cucian no ' . $idMaster . ' gagal diambil.'
                );
            }
        }

        $this->output->set_output(json_encode($array));
    }

    public function jurnal_cucian_bayar_fix($tglTrans, $idMasterCm, $namaCust, $totalPiutangKiloan, $totalPiutangSatuan, $jmlBayar, $diskon) {
        $bulan = date('m', strtotime($tglTrans));
        $tahun = date('Y', strtotime($tglTrans));
        $tanggal = date('d', strtotime($tglTrans));
        $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
        $deskripsiJurnal = 'Pembayaran Cucian' . $namaCust;
        $modul = '1';

        if ($totalPiutangKiloan > 0) {

            //DEBET
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('kas_operasional');
            $debet = $totalPiutangKiloan;
            $kredit = 0;
            $total_trans = $jmlBayar + $diskon;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            //KREDIT
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('piutang_cm_kiloan');
            $debet = 0;
            $kredit = $totalPiutangKiloan;
            $total_trans = $jmlBayar + $diskon;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        }
        if ($totalPiutangSatuan > 0) {
            //DEBET
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('kas_operasional');
            $debet = $totalPiutangSatuan;
            $kredit = 0;
            $total_trans = $jmlBayar + $diskon;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            //KREDIT
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('piutang_cm_satuan');
            $debet = 0;
            $kredit = $totalPiutangSatuan;
            $total_trans = $jmlBayar + $diskon;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        }
        if ($diskon > 0) {
            $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
            $deskripsiJurnal = 'Diskon ambil cucian ' . $namaCust;
            //DEBET
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('diskon_bayar_cucian');
            $debet = $diskon;
            $kredit = 0;
            $total_trans = $diskon;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
            //KREDIT
            $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
            $KodePerk = $this->akuntansi_m->getkodeperk('kas_operasional');
            $debet = 0;
            $kredit = $diskon;
            $total_trans = $diskon;
            $deskripsi = $deskripsiJurnal;
            $keterangan = $deskripsiJurnal;
            $noreferensi = $idMasterCm;
            $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        }
    }

    function simpanFinish() {
        $this->CI = & get_instance();
        $idMaster = trim($this->input->post('idMaster', TRUE));
        $idKaryawan = trim($this->input->post('idKaryawan', TRUE));
        $jmlSetrikaSatuan = str_replace(',', '', trim($this->input->post('jmlSetrikaSatuan', TRUE)));
        $jmlSetrikaKiloan = str_replace(',', '', trim($this->input->post('jmlSetrikaKiloan', TRUE)));
        $tglTrans = trim($this->input->post('tglFinishing', TRUE));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        $statusOutsource = $this->trans_kk_m->getStatusOutsource($idMaster);
        if ($statusOutsource == 1) {
            $array = array(
                'baris' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Cucian no ' . $idMaster . ' masih outsource.'
            );
        } else {
            $dataMaster = array(
                'tgl_selesai' => $tglTrans,
                'waktu_selesai' => date("H:i:s"),
                'status_selesai' => 1,
                'id_kyw' => $idKaryawan,
                'setrika_kg' => $jmlSetrikaKiloan,
                'setrika_satuan' => $jmlSetrikaSatuan
            );
            if ($idKaryawan <> '') {
                //$tglTrans = $this->session->userdata('tgl_y');
                $bulan = date('m', strtotime($tglTrans));
                $tahun = date('Y', strtotime($tglTrans));
                $tanggal = date('d', strtotime($tglTrans));

                $getInfoKyw = $this->trans_kk_m->getInfoKyw($idKaryawan);
                $getIntKyw = $this->akuntansi_m->getkodeperk('biaya_gaji');

                $hutangJasaKyw = 1000 * ($jmlSetrikaSatuan + $jmlSetrikaKiloan);

                $namaKyw = $getInfoKyw[0]->nama_kyw;
                $kd_perk_kyw = $getInfoKyw[0]->kode_perk;

                $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
                $deskripsiJurnal = 'Hutang jasa karyawan ' . $namaKyw;
                $modul = '1';

                //DEBET
                $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
                $KodePerk = $getIntKyw;
                $debet = $hutangJasaKyw;
                $kredit = 0;
                $total_trans = $hutangJasaKyw;
                $deskripsi = $deskripsiJurnal;
                $keterangan = $deskripsiJurnal;
                $noreferensi = $idMaster;
                $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
                //KREDIT
                $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
                $KodePerk = $kd_perk_kyw;
                $debet = 0;
                $kredit = $hutangJasaKyw;
                $total_trans = $hutangJasaKyw;
                $deskripsi = $deskripsiJurnal;
                $keterangan = $deskripsiJurnal;
                $noreferensi = $idMaster;
                $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);

                /*
                  $modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
                  $model = $this->akuntansi_m->insert_jurnalD($modelidAPtrans, $tglTrans, $modelidAP, $getIntKyw, $deskripsiJurnal, $hutangJasaKyw, $hutangJasaKyw);
                  $modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
                  $model = $this->akuntansi_m->insert_jurnalK($modelidAPtrans, $tglTrans, $modelidAP, $kd_perk_kyw, $deskripsiJurnal, $hutangJasaKyw, $hutangJasaKyw);
                 * 
                 */
            }

            $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMaster);

            if ($model) {

                $array = array(
                    'baris' => 1,
                    'tipePesan' => 'success',
                    'pesan' => 'Cucian no  ' . $idMaster . ' telah selesai.'
                );
            } else {
                $array = array(
                    'baris' => 0,
                    'tipePesan' => 'error',
                    'pesan' => 'Cucian no ' . $idMaster . ' gagal selesai.'
                );
            }
        }

        $this->output->set_output(json_encode($array));
    }

    function simpanOutsource() {
        $this->CI = & get_instance();
        $idMaster = trim($this->input->post('idMaster', TRUE));
        $idOutsource = trim($this->input->post('idOutsource', TRUE));
        $idTransOS = trim($this->input->post('inputIdTransOutsource', TRUE));
        $data_idTransOS = array();
        $data_idTransOS = explode(',', $idTransOS);

        $tglTrans = trim($this->input->post('tglKelOutsource', TRUE));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));
        $bulan = date('m', strtotime($tglTrans));
        $tahun = date('Y', strtotime($tglTrans));
        $tanggal = date('d', strtotime($tglTrans));

        $getInfoOutsource = $this->trans_kk_m->getInfoOutsource($idOutsource);
        $getIntOutsource = $this->akuntansi_m->getkodeperk('biaya_outsource');

        $hargaCucian = 0;
        foreach ($data_idTransOS as $row_idtransos) {
            if (trim($row_idtransos) != '') {
                $rows = $this->trans_kk_m->getInfoTransCM(trim($row_idtransos));
                $hargaCucian = $hargaCucian + $rows[0]->harga_cucian;
                $dataTrans = array(
                    'status_outsource' => 1
                );
                $rows = $this->trans_kk_m->ubahTrans($dataTrans, trim($row_idtransos));
            }
        }
        //$rows = $this->trans_kk_m->getRincianCM($idMaster);
        //$hargaCucian = $rows['data_cpa'][0]->total_harga;

        $hutangJasaOS = 75 / 100 * $hargaCucian;

        $kode_perk = $getInfoOutsource[0]->kode_perk;
        $namaOutsource = $getInfoOutsource[0]->nama_outsource;
        $id_jurnal = $this->akuntansi_m->getIdAP($bulan, $tahun);
        $deskripsiJurnal = 'Hutang jasa outsource ' . $namaOutsource;
        $modul = '1';

        //DEBET
        $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
        $KodePerk = $getIntOutsource;
        $debet = $hutangJasaOS;
        $kredit = 0;
        $total_trans = $hutangJasaOS;
        $deskripsi = $deskripsiJurnal;
        $keterangan = $deskripsiJurnal;
        $noreferensi = $idMaster;
        $model1 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);
        //KREDIT
        $id_jurnal_detail = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
        $KodePerk = $kode_perk;
        $debet = 0;
        $kredit = $hutangJasaOS;
        $total_trans = $hutangJasaOS;
        $deskripsi = $deskripsiJurnal;
        $keterangan = $deskripsiJurnal;
        $noreferensi = $idMaster;
        $model2 = $this->akuntansi_m->insert_jurnal($id_jurnal_detail, $tglTrans, $id_jurnal, $modul, $KodePerk, $debet, $kredit, $total_trans, $deskripsi, $keterangan, $noreferensi);

        /*
          $modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
          $model = $this->akuntansi_m->insert_jurnalD($modelidAPtrans, $tglTrans, $modelidAP, $getIntOutsource, $deskripsiJurnal, $hutangJasaOS, $hutangJasaOS);
          $modelidAPtrans = $this->akuntansi_m->getIdAPtrans($tglTrans, $bulan, $tahun, $tanggal);
          $model = $this->akuntansi_m->insert_jurnalK($modelidAPtrans, $tglTrans, $modelidAP, $kode_perk, $deskripsiJurnal, $hutangJasaOS, $hutangJasaOS);

         * 
         */
        $dataMaster = array(
            'tgl_outsource_keluar' => $tglTrans,
            'id_outsource' => $idOutsource,
            'status_outsource' => 1
        );
        $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMaster);



        if ($model) {
            $array = array(
                'baris' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Cucian no  ' . $idMaster . ' berhasil outsource.'
            );
        } else {
            $array = array(
                'baris' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Cucian no ' . $idMaster . ' gagal outsource.'
            );
        }

        $this->output->set_output(json_encode($array));
    }

    function simpanOutsourceMsk() {//kembali ke laundry
        $this->CI = & get_instance();
        $idMaster = trim($this->input->post('idMaster', TRUE));
        $tglTrans = trim($this->input->post('tglMskDrOutsource', TRUE));
        $tglTrans = date('Y-m-d', strtotime($tglTrans));

        //Out source akan otomatis merubah status menjadi selesai jika jml row detail status out source
        //cek jml row detailstatusoutsource

        $jml_detail_cucian = $this->trans_kk_m->getJmlRincianCM($idMaster);
        $jml_detail_cucian_os = $this->trans_kk_m->getJmlRincianOS($idMaster);

        if ($jml_detail_cucian_os == $jml_detail_cucian) {
            $dataMaster = array(
                'tgl_selesai' => $tglTrans,
                'waktu_selesai' => date("H:i:s"),
                'status_selesai' => 1,
                'tgl_outsource_masuk' => $tglTrans,
                'status_outsource' => 2
            );
        } else {
            $dataMaster = array(
                'tgl_outsource_masuk' => $tglTrans,
                'status_outsource' => 2
            );
        }


        $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMaster);

        if ($model) {
            $array = array(
                'baris' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Cucian no  ' . $idMaster . ' berhasil kembali ke laundry.'
            );
        } else {
            $array = array(
                'baris' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Cucian no ' . $idMaster . ' gagal kembali ke laundry.'
            );
        }

        $this->output->set_output(json_encode($array));
    }

    function cetakStruk() {
        //$this->CI = & get_instance();
        $idMaster = trim($this->input->post('idMaster', TRUE));
        $tglTrans_d = trim($this->input->post('tglTrans', TRUE));
        $tglTrans_y = date('Y-m-d', strtotime($tglTrans_d));
        $tglSelesai_d = trim($this->input->post('tglSelesai', TRUE));
        $tglSelesai_y = date('Y-m-d', strtotime($tglSelesai_d));
        $namaCustomer = trim($this->input->post('namaCustomer', TRUE));
        $totalHarga = trim($this->input->post('totalHarga', TRUE));
        $statusBayar = trim($this->input->post('statusBayar', TRUE));
        if($statusBayar == 0 ){
            $status_bayar = "Belum";
        }else{
            $status_bayar = "Lunas";
        }
        
        $data_cust = array();
        $data_cust = explode('-', $namaCustomer);
        $data_cust[0] = str_replace(" ","",$data_cust[0]);
        $noTelp = $data_cust[1];
        
        
        //exec("java -jar C:\\xampp\htdocs\appinw\java\PrinterMatric.jar 2 ", $output);
        exec("java -jar C:\\xampp\htdocs\laundry\java\CetakStruk.jar ".$idMaster." ".$totalHarga." ".$tglTrans_d." ".$tglSelesai_d." ".trim($data_cust[0])." ".$noTelp." ".$status_bayar, $output);
        /*
         * ." ".$tglTrans_d." ".$tglSelesai_d." ".$namaCustomer
          $tglTrans = trim($this->input->post('tglKelOutsource', TRUE));
          $tglTrans = date('Y-m-d', strtotime($tglTrans));
          $bulan = date('m', strtotime($tglTrans));
          $tahun = date('Y', strtotime($tglTrans));
          $tanggal = date('d', strtotime($tglTrans));

          $getInfoOutsource = $this->trans_kk_m->getInfoOutsource($idOutsource);
          $getIntOutsource = $this->akuntansi_m->getkodeperk('biaya_outsource');

          $hargaCucian = 0;

          $dataMaster = array(
          'tgl_outsource_keluar' => $tglTrans,
          'id_outsource' => $idOutsource,
          'status_outsource' => 1
          );
          $model = $this->trans_kk_m->ubahMaster($dataMaster, $idMaster);
         */
        print_r($output);
        echo $noTelp;
       
    }

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */
