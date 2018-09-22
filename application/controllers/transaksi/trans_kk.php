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
        $data['pekerjaan'] = $this->global_m->getSelectOption('tbl_m_pekerjaan','','','','','id_pekerjaan');
        $data['instansi'] = $this->global_m->getSelectOption('tbl_m_instansi','','','','','id_instansi');
        $data['pendidikan'] = $this->global_m->getSelectOption('tbl_r_pendidikan','','','','','id_pend');
        $data['agama'] = $this->global_m->getSelectOption('tbl_m_agama','','','','','id_agama');

        // print_r($this->global_m->getSelectOption('tbl_r_hub_kel','','','','','id_hub_kel'));die();
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
        // print_r($rows);die();
        $data['data'] = array();
        $no = 1;
        foreach ($rows as $row) {
            $array = array(
                'no'=>$no,
                'idsession'=>trim($row->idsession),
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

    public function ajax_delAnggotaKK(){
        $idKTP = $this->input->get('sKTP');
        $data = array(
            'is_delete' => '1'
        );        
        $result = $this->global_m->ubah('master_ktp', $data, 'id_ktp', $idKTP);
        // $iUpdateKK = $this->global_m->get_data("UPDATE master_ktp SET id_delete='0' WHERE id_ktp='$idKTP'");
        if($result){
            $result = array('istatus' => true,'itype'=>'success', 'iremarks' => 'Delete Success.!');
        }else{
            $result = array('istatus' => false,'itype'=>'error', 'iremarks' => 'Gagal.!');            
        }
        echo json_encode($result);
    }

    public function ajax_getAnggotaKK(){
        $idKTP = $this->input->get('sKTP');
        $iDataKK = $this->global_m->get_data("select * FROM vw_t_kk where id_ktp='$idKTP'");
        echo json_encode($iDataKK);
    }
    public function ajax_getDetailKK(){
        $iPid = $this->input->post('sSes');
// print_r($iPid);die();
        $result = $this->global_m->query("CALL zsp_detail_kk('".$iPid."')");
        $idataKK = $this->global_m->get_data("SELECT * FROM vw_kk where idsession='".$iPid."' and hub_keluarga=1 limit 1")[0];
// print_r($idataKK);die();
        echo json_encode($idataKK);
    }


    public function upload($sNama,$sPath,$sidktp){
        $iCekFoto = $this->global_m->get_data("select * FROM vw_t_kk where id_master_kk='".$this->input->post('noKK')."'");
        if(basename( $_FILES[$sNama]['name'])==""){
            $result = array(true,$iCekFoto[0]->rumah_path);            
        }else{
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
                $result = array(true,$sPath.$fileName.$resultUpload['file_ext']);
            }
        }
        return $result;
    }
    public function ajax_simpan_kk() {
        $this->load->helper('form', 'url');
        $istatus=false;

        $id_master_kk = $this->input->post('noKK');
        $path = 'uploads/foto/';

            $iAnggotaKel=$this->input->get('sLength');
            if($iAnggotaKel>0){
                for($i=1;$i<=$iAnggotaKel;$i++){
                    if($this->input->post('nik'.$i)!=""){
                        // print_r(basename( $_FILES['foto_ktp'.$i]['name']));die();
                        $iUploadFoto=$this->upload('foto_ktp'.$i,$path,$this->input->post('nik'.$i));
                        $iCekNIK = $this->global_m->get_data("select * FROM trans_kk where id_ktp='".$this->input->post('nik'.$i)."'");
                        if (sizeof($iCekNIK) <= 0) {
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
                                'pekerjaan' => $this->input->post('pekerjaan_'.$i),
                                'warga_negara' => $this->input->post('warga_negara_'.$i),
                                // 'link_gambar' => $path,
                                'link_gambar' => $iUploadFoto[1],
                                'is_delete' => 0
                            );                                        
                            $data_anggota_kk = array(
                                // 'idtrans_kk' => $fileName,
                                'id_master_kk' => $this->input->post('noKK'),
                                'id_ktp' => $this->input->post('nik'.$i),
                                'pendidikan' => $this->input->post('pendidikan_'.$i),
                                'hub_keluarga' => $this->input->post('hub_kel_'.$i),
                                'rumah_path' => $iUploadFotoRumah[1]
                                // 'id_ktp' => date('Y-m-d', strtotime($_POST['id_tglLahir_'])),
                                // 'create_by' => $this->session->userdata('id_user'),
                                // 'create_date' => date('Y-m-d H:i:s')
                            );
                            // print_r($data_anggota_ktp);die();
                            // $result = $this->global_m->simpan('master_ktp', $data_anggota_kk);
                            $result = $this->global_m->simpan('master_ktp', $data_anggota_ktp);
                            $result = $this->global_m->simpan('trans_kk', $data_anggota_kk);
                            $istatus=true;
                            $itype='success';
                            $iremarks="Insert Anggota KK Success.!";
                        }else
                        {
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
                                'pekerjaan' => $this->input->post('pekerjaan_'.$i),
                                'warga_negara' => $this->input->post('warga_negara_'.$i),
                                'link_gambar' => $iUploadFoto[1],
                                'is_delete' => 0
                            );                                        
                            $data_anggota_kk = array(
                                // 'idtrans_kk' => $fileName,
                                'id_master_kk' => $this->input->post('noKK'),
                                'id_ktp' => $this->input->post('nik'.$i),
                                'pendidikan' => $this->input->post('pendidikan_'.$i),
                                'hub_keluarga' => $this->input->post('hub_kel_'.$i),
                                // 'rumah_path' => $iUploadFotoRumah[1]
                                // 'id_ktp' => date('Y-m-d', strtotime($_POST['id_tglLahir_'])),
                                // 'create_by' => $this->session->userdata('id_user'),
                                // 'create_date' => date('Y-m-d H:i:s')
                            );
                            $result = $this->global_m->ubah('master_ktp', $data_anggota_ktp, 'id_ktp', $this->input->post('nik'.$i));
                            $result = $this->global_m->ubah('trans_kk', $data_anggota_kk, 'idtrans_kk', $iCekNIK[0]->idtrans_kk);

                            $istatus=true;
                            $itype='success';
                            $iremarks="Update Anggota KK Success.!";                                        
                        }
                    }
                }
            }

            if ($result) {
                $result = array('istatus' => $istatus,'itype' => $itype, 'iremarks' => $iremarks); //, 'body'=>'Data Berhasil Disimpan');
            } else {
                $result = array('istatus' => $istatus,'itype' => 'error', 'iremarks' => $iremarks);
            }
        // }
        echo json_encode($result);
    }

    function saveAnggotaKel(){
        $iAnggotaKel=$this->input->get('sLength');
        if($iAnggotaKel>0){
            for($i=1;$i<=$iAnggotaKel;$i++){
                    if($this->input->post('nik'.$i)!=""){
                        $iUploadFoto=$this->upload('foto_ktp'.$i,$path);

                        $iCekNIK = $this->global_m->get_data("select * FROM trans_kk where id_ktp='".$this->input->post('nik'.$i)."'");
                        if (sizeof($iCekNIK) <= 0) {
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
                                'warga_negara' => $this->input->post('warga_negara'.$i),
                                'link_gambar' => $path .$iUploadFoto[1],
                                'is_delete' => 0
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
                            $istatus=true;
                            $iremarks="Insert Anggota KK Success.!";
                        }else{
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
                                'is_delete' => 0
                            );                                        
                            $data_anggota_kk = array(
                                // 'idtrans_kk' => $fileName,
                                'id_master_kk' => $this->input->post('noKK'),
                                'id_ktp' => $this->input->post('nik'.$i),
                                'pendidikan' => $this->input->post('pendidikan_'.$i),
                                'hub_keluarga' => $this->input->post('hub_kel_'.$i),
                                'rumah_path' => $path .$iUploadFotoRumah[1]
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
                            $result = $this->global_m->ubah('master_ktp', $data_anggota_ktp, 'id_ktp', $this->input->post('nik'.$i));
                            $result = $this->global_m->ubah('trans_kk', $data_anggota_kk, 'idtrans_kk', $iCekNIK[0]->idtrans_kk);
                            $result = $this->global_m->ubah('tbl_t_difabel', $data_anggota_difabel, 'id_ktp', $this->input->post('nik'.$i));
                            $result = $this->global_m->ubah('tbl_t_bantuan', $data_anggota_bantuan, 'id_ktp', $this->input->post('nik'.$i));
                            $istatus=true;
                            $iremarks="Update Anggota KK Success.!";                                        
                        }
                    }
                 //         }
                //     }    
                // }
            }
        }else{
            $result =true;
            $istatus=true;
            $iremarks="Tidak ada yang di update.!";                                        
        }
        if ($result) {
            $result = array($istatus, $iremarks); //, 'body'=>'Data Berhasil Disimpan');
        } else {
            $result = array($istatus, $iremarks);
        }
    return $result;
    }


    function ajax_UploadRumah() {
        if(trim($this->input->get('sPID'))==""){
            $iPID=$this->global_m->get_data('select uuid() as pid')[0]->pid;
        }else{
            $iPID=trim($this->input->get('sPID'));
        }
        $inoKK=$this->input->post('sNoKK');
        $path = 'uploads/foto/';
        $config = array(
            'upload_path'   => $path,
            'allowed_types'=>'gif|jpg|png|jpeg',
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);
        $countUPL = count( $_FILES['foto_rmh']['name'] );

        $files = $_FILES;
        for( $i = 0; $i < $countUPL; $i++ )
        {
            $_FILES['foto_rumah'] = [
                'name'     => $files['foto_rmh']['name'][$i],
                'type'     => $files['foto_rmh']['type'][$i],
                'tmp_name' => $files['foto_rmh']['tmp_name'][$i],
                'error'    => $files['foto_rmh']['error'][$i],
                'size'     => $files['foto_rmh']['size'][$i]
            ];
            $fileName=$this->global_m->get_data('select uuid() as pid')[0]->pid;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);           

            if (!$this->upload->do_upload('foto_rumah')) {
                $result = array(false,$this->upload->display_errors());
            }else{
                $resultUpload = $this->upload->data();
                $data=array(
                    'id_master_kk'=>$inoKK,
                    'rumah_path'=>$path.$fileName.$resultUpload['file_ext'],
                    'idsession' => $iPID
                );
    
                $model = $this->global_m->simpan('tbl_m_rumah_temp',$data);            

                $result = array(true,'');
            }
        }

        if ($result[0]) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Upload Success.!',
                'iPid' =>$iPID
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => $result[1],
                'iPid' =>''                
            );
        }
        $this->output->set_output(json_encode($array));

    }

    public function getRumah() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $iPID=$this->input->post('sPID');
        $rows = $this->global_m->get_data("SELECT * FROM tbl_m_rumah_temp where idsession='".$iPID."'");
        // print_r("SELECT * FROM tbl_m_rumah_temp where idsession='".$iPID."'");die();
        $data['data'] = array();
        $no = 1;
        foreach ($rows as $row) {
            $array = array(
                'no'=>$no,
                // 'id_master_kk' => trim($row->id_master_kk),
                'rumah_path' => '<img src="'.base_url().$row->rumah_path.'" style="width: 150px; "/>',
                'act' => '<a href="#" class="btn btn-danger" onclick="onDelRumah('.$row->id_ft_rumah.')">Delete</a>',
                'idsession'=>trim($row->idsession)
            );
            array_push($data['data'], $array);
            $no++;
        }
        $this->output->set_output(json_encode($data));
    }
    function ajax_delRumahTemp() {
        $iId = trim($this->input->post('sId'));
        $iPid=trim($this->input->post('sPID'));

        $model = $this->global_m->query("DELETE FROM `tbl_m_rumah_temp` WHERE id_ft_rumah='".$iId."' and idsession='".$iPid."'");
        if ($model) {
            $array = array(
                'act' => true,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.',
                'iPid' => $iPid
            );
        } else {
            $array = array(
                'act' => false,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.',
                'iPid' => ''
            );
        }
        $this->output->set_output(json_encode($array));
    }


    function ajax_Tambah() {
        if(trim($this->input->get('sPID'))==""){
            $iPid=$this->global_m->get_data('select uuid() as pid')[0]->pid;
        }else{
            $iPid=trim($this->input->get('sPID'));
        }
        $idKtp=$this->input->post('nik');
        $path = 'uploads/foto/';
        $iCek=$this->global_m->get_data("SELECT * FROM master_ktp_kk_temp where idsession='".$iPid."' and id_ktp='".$idKtp."'");
        if(sizeof($iCek)<1){
            $iUploadFoto=$this->upload('foto_ktp',$path,$idKtp);
            if($iUploadFoto[0]){
                $data = array(
                    'idsession' => $iPid,
                    'id_ktp' => $this->input->post('nik'),
                    'nama_ktp' => $this->input->post('nama'),
                    'tempat_lahir' => $this->input->post('tmpt_lahir'),
                    'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tgl_lahir'))),
                    'jekel' => $this->input->post('jekel'),
                    'gol_darah' => $this->input->post('gol_darah'),
                    'alamat' => $this->input->post('alamat_'),
                    'rt' => $this->input->post('rt_'),
                    'rw' => $this->input->post('rw_'),
                    'id_kel' => $this->input->post('kel_'),
                    'id_kec' => $this->input->post('kec_'),
                    'agama' => $this->input->post('agama'),
                    'status_kawin' => $this->input->post('status'),
                    'pekerjaan' => $this->input->post('pekerjaan'),
                    'id_difabel' => $this->input->post('difabel'),
                    'id_pend' => $this->input->post('pendidikan'),
                    'link_gambar' => $iUploadFoto[1],
                    'is_delete' => 0,
                    'id_master_kk' => $this->input->post('noKK'),
                    'hub_keluarga' => $this->input->post('hub_kel')
                    // 'rumah_path' => $iUploadFotoRumah[1]
                );
                $model = $this->global_m->simpan('master_ktp_kk_temp',$data);            
                $itipePesan='success';
                $ipesan='Anggota Keluarga berhasil disimpan.!';
            } else {
                $model=true;
                $itipePesan='error';
                $ipesan='Data dan Foto gagal disimpan.!';
            }
        }else{
            $iUploadFoto=$this->upload('foto_ktp',$path,$idKtp);
            if($iUploadFoto[0]){
                $data = array(
                    'nama_ktp' => $this->input->post('nama'),
                    'tempat_lahir' => $this->input->post('tmpt_lahir'),
                    'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tgl_lahir'))),
                    'jekel' => $this->input->post('jekel'),
                    'gol_darah' => $this->input->post('gol_darah'),
                    'alamat' => $this->input->post('alamat_'),
                    'rt' => $this->input->post('rt_'),
                    'rw' => $this->input->post('rw_'),
                    'id_kel' => $this->input->post('kel_'),
                    'id_kec' => $this->input->post('kec_'),
                    'agama' => $this->input->post('agama'),
                    'status_kawin' => $this->input->post('status'),
                    'pekerjaan' => $this->input->post('pekerjaan'),
                    'id_difabel' => $this->input->post('difabel'),
                    'id_pend' => $this->input->post('pendidikan'),
                    'link_gambar' => $iUploadFoto[1],
                    'is_delete' => 0,
                    'id_master_kk' => $this->input->post('noKK'),
                    'hub_keluarga' => $this->input->post('hub_kel'),
                );
                $model = $this->global_m->ubah('master_ktp_kk_temp', $data, 'id_ktp', $this->input->post('nik'));
                $model=true;
                $itipePesan='success';
                $ipesan='Data berhasil diupdate.!';            
            } else {
                $model=true;
                $itipePesan='error';
                $ipesan='Data dan Foto gagal disimpan.!';
            }
        }
        if ($model) {
            $array = array(
                'act' => 1,
                'tipePesan' => $itipePesan,
                'pesan' => $ipesan,
                'iPid'=>$iPid
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.',
                'iPid'=>''
            );
        }
        $this->output->set_output(json_encode($array));
    }

    public function getAnggotaKel() {
        $iPID = trim($this->input->post('sPID'));
        // print_r($iPID);die();
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows=$this->global_m->get_data("SELECT * FROM vw_anggota_kel_temp where idsession='".$iPID."'");
        $data['data'] = array();
        $no=1;
        foreach ($rows as $row) {
            if($row->jekel=='0'){
                $ijekel="Pria";
            }else{
                $ijekel="Wanita";                
            }
            $array = array(
                'no' => $no++,
                'id_ktp' => trim($row->id_ktp),
                'nama_ktp' => trim($row->nama_ktp),
                'tempat_lahir' => trim($row->tempat_lahir),
                'tanggal_lahir' => trim($row->tanggal_lahir),
                'jekel' => $ijekel,
                'gol_darah' => trim($row->gol_darah),
                'agama' => trim($row->nama_agama),
                'status_kawin' => trim($row->nama_nikah),
                'pekerjaan' => trim($row->nama_pekerjaan),
                'nama_difabel' => trim($row->nama_difabel),
                'nama_pend' => trim($row->nama_pend),
                'hub_keluarga' => trim($row->nama_hub_kel),

                'act' =>"<input type='button' onclick='edit_temp(".trim($row->id_ktp).")' class='btn btn-warning btn-sm' value='Edit'>
                        <input type='button' onclick='del_temp(".trim($row->id).",".trim($row->id_ktp).")' class='btn red btn-sm' value='Delete'>",
                'idsession' => trim($row->idsession)
    
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function ajax_getAngKel() {
        $iPid=trim($this->input->post('sPID'));
        $iKtp=trim($this->input->post('sKtp'));

        $ktp = $this->global_m->get_data("SELECT * FROM `master_ktp_kk_temp` WHERE id_ktp='".$iKtp."' and idsession='".$iPid."'")[0];
        $array = array(
            'ktp' => $ktp
        );
        $this->output->set_output(json_encode($array));
    }

    function ajax_delTemp() {
        $iId = trim($this->input->post('sId'));
        $iPid=trim($this->input->post('sPID'));
        $iKtp=trim($this->input->post('sKtp'));

        $model = $this->global_m->query("DELETE FROM `master_ktp_kk_temp` WHERE id='".$iId."' and idsession='".$iPid."'");
        if ($model) {
            $array = array(
                'act' => true,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dihapus.',
                'iPid' => $iPid
            );
        } else {
            $array = array(
                'act' => false,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dihapus.',
                'iPid' => ''
            );
        }
        $this->output->set_output(json_encode($array));
    }

    public function ajax_Simpan(){
        $iPid = $this->input->post('sPID');

        $result = $this->global_m->query("CALL zsp_simpan_kk('".$iPid."')");

        if($result){
            $result = array('istatus' => true,'itype'=>'success', 'iremarks' => 'Data berhasil disimpan.!');
        }else{
            $result = array('istatus' => false,'itype'=>'error', 'iremarks' => 'Data gagal disimpan.!');            
        }
        echo json_encode($result);
    }



// ======end dipakai

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */
