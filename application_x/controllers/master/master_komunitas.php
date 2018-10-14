<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_komunitas extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_komunitas_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_komunitas/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        $data['kec'] = $this->global_m->getSelectOption('master_kecamatan','','','','','id_kec');
        $data['kel'] = $this->global_m->getSelectOption('master_kelurahan','','','','','id_kel');
        $data['jeniskomunitas'] = $this->global_m->getSelectOption('master_jeniskomunitas','','','','','id_jeniskomunitas');

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
            $this->template->load('template/template_dataTable', 'master/master_komunitas_v', $data);
        }
    }

    public function getKomunitasAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_komunitas_m->getKomunitasAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idKomunitas' => trim($row->id_komunitas),
                'namaKomunitas' => trim($row->nama_komunitas),
                'kec' => trim($row->nama_kec),
                'kel' => trim($row->nama_kel),
                'jeniskomunitas'=>$row->nama_jeniskomunitas
            );
            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }
    

    function getDetail() {
        $this->CI = & get_instance();
        $id = $this->input->post('sid', TRUE);
        $rows = $this->global_m->get_data('select * from master_komunitas where id_komunitas='.$id);
        $iPid = $this->global_m->get_data('SELECT idsession FROM `tbl_t_anggota_komunitas` where id_komunitas='.$id.' LIMIT 1');
        if(sizeof($iPid)<1){
            $iPid="";
        }else{
            $iPid=$iPid[0]->idsession;
        }
        if (sizeof($rows)>0) {
            // foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'id_komunitas'=>$rows[0]->id_komunitas,
                    'nama_komunitas' => $rows[0]->nama_komunitas,
                    'alamat' => $rows[0]->alamat,
                    'id_kec' => $rows[0]->id_kec,
                    'id_kel' => $rows[0]->id_kel,
                    'nama_koordinator' => $rows[0]->nama_koordinator,
                    'no_telp' => $rows[0]->no_telp,
                    'id_jeniskomunitas'=>$rows[0]->id_jeniskomunitas,
                    'iPid'=>$iPid
                );
            $model = $this->global_m->query("CALL zsp_detail_anggota_kom('".$iPid."')");
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $iPid = $this->input->get('sPID');
        $namaKomunitas = trim($this->input->post('namaKomunitas'));
        $kec = trim($this->input->post('kec'));
        $kel = trim($this->input->post('kel'));
        $alamat = trim($this->input->post('alamat'));
        $nama_koordinator = trim($this->input->post('namaKoordinator'));
        $no_telp = trim($this->input->post('noTelp'));
        $jeniskomunitas = trim($this->input->post('jeniskomunitas'));
        $modelidKomunitas = $this->master_komunitas_m->getIdKomunitas();
        $data = array(
            'id_komunitas' => $modelidKomunitas,
            'nama_komunitas' => $namaKomunitas,
            'id_kec' => $kec,
            'id_kel' => $kel,
            'alamat' => $alamat,
            'nama_koordinator' => $nama_koordinator,
            'no_telp'=>$no_telp,
            'id_jeniskomunitas'=>$jeniskomunitas
        );
        $model = $this->master_komunitas_m->insert($data);
        $model = $this->global_m->query("CALL zsp_simpan_anggota_kom('".$iPid."','".$modelidKomunitas."')");
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
        $iPid = $this->input->get('sPID');
        $komunitasId = trim($this->input->post('komunitasId'));
        $namaKomunitas = trim($this->input->post('namaKomunitas'));
        $kec = trim($this->input->post('kec'));
        $kel = trim($this->input->post('kel'));
        $alamat = trim($this->input->post('alamat'));
        $nama_koordinator = trim($this->input->post('namaKoordinator'));
        $no_telp = trim($this->input->post('noTelp'));
        $jeniskomunitas = trim($this->input->post('jeniskomunitas'));
        $data = array(
            'nama_komunitas' => $namaKomunitas,
            'id_kec' => $kec,
            'id_kel' => $kel,
            'alamat' => $alamat,
            'nama_koordinator' => $nama_koordinator,
            'no_telp'=>$no_telp,
            'id_jeniskomunitas'=>$jeniskomunitas
        );
        $model = $this->master_komunitas_m->update($data,$komunitasId);
        $model = $this->global_m->query("CALL zsp_simpan_anggota_kom('".$iPid."','".$komunitasId."')");
// print_r($iPid);die();
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
        $id = trim($this->input->post('sid'));

        $iPid = $this->global_m->get_data('SELECT idsession FROM `tbl_t_anggota_komunitas` where id_komunitas='.$id.' LIMIT 1');
        if(sizeof($iPid)<1){
            $iPid="";
        }else{
            $iPid=$iPid[0]->idsession;
        }

        $model = $this->global_m->query("DELETE FROM `tbl_t_anggota_komunitas` WHERE `idsession`='".$iPid."'");        
        $model = $this->master_komunitas_m->delete($id);
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


    public function getPenerima() {
        $iPID = trim($this->input->post('sPID'));
        // print_r($iPID);die();
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows=$this->global_m->get_data("SELECT * FROM vw_t_anggota_komunitas_temp where idsession='".$iPID."'");
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
                'jekel' => $ijekel,
                'tanggal_lahir' => trim($row->tanggal_lahir),
                'act' => "<button id='btnDel' onclick='del_temp(".trim($row->id_anggota_komunitas_temp).")' class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-remove'></i> Delete</button>",
    
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function ajax_delTemp() {
        $iId = trim($this->input->post('sId'));
        $iPid=trim($this->input->post('sPID'));
        $model = $this->global_m->query("DELETE FROM `tbl_t_anggota_komunitas_temp` WHERE id_anggota_komunitas_temp='".$iId."' and idsession='".$iPid."'");
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

    function ajax_saveSelect() {
        $idKtp = trim($this->input->post('sKtp'));
        if(trim($this->input->post('sPID'))==""){
            $iPid=$this->global_m->get_data('select uuid() as pid')[0]->pid;
        }else{
            $iPid=trim($this->input->post('sPID'));
        }
        $iCek=$this->global_m->get_data("SELECT * FROM vw_t_anggota_komunitas_temp where idsession='".$iPid."' and id_ktp='".$idKtp."'");
        if(sizeof($iCek)<1){
            $data = array(
                'idsession' => $iPid,
                'id_ktp' => $idKtp
                // 'create_by' => $this->session->userdata('id_user'),
                // 'create_date' => date('Y-m-d H:i:s')
            );    
            $model = $this->global_m->simpan('tbl_t_anggota_komunitas_temp',$data);            
            $itipePesan='success';
            $ipesan='Peserta berhasil dipilih.';
        }else{
            $model=true;
            $itipePesan='error';
            $ipesan='Peserta sudah dipilih.';            
        }
        if ($model) {
            $array = array(
                'act' => true,
                'tipePesan' => $itipePesan,
                'pesan' => $ipesan,
                'iPid' => $iPid
            );
        } else {
            $array = array(
                'act' => false,
                'tipePesan' => 'error',
                'pesan' => 'Peserta gagal dipilih.',
                'iPid' => ''
            );
        }
        $this->output->set_output(json_encode($array));
    }




}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */