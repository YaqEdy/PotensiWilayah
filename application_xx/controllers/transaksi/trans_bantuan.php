<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_bantuan extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/trans_bantuan_m');
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
        $menuId = $this->home_m->get_menu_id('transaksi/trans_bantuan/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);
        //$data['dept'] = $this->trans_bantuan_m->get_dept();

        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } elseif (isset($_POST["btnUbah"])) {
            $this->ubah();
        } elseif (isset($_POST["btnHapus"])) {
            $this->hapus();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);
            $data['instansi'] = $this->global_m->getSelectOption('tbl_m_instansi','','','','','id_instansi');
            $data['jns_bantuan'] = $this->global_m->getSelectOption('tbl_r_jns_bantuan','','','','','id_jns_bantuan');

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'transaksi/trans_bantuan_v', $data);
        }
    }

    public function getBantuanAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_bantuan_m->getBantuanAll();
        $data['data'] = array();
        $no=1;
        foreach ($rows as $row) {
            $array = array(
                'no' => $no++,
                'id_t_bantuan' => trim($row->id_t_bantuan),
                'id_m_instansi' => trim($row->id_m_instansi),
                'id_ktp' => trim($row->id_ktp),
                'id_jns_bantuan' => trim($row->id_jns_bantuan),
                'jns_bantuan' => trim($row->jns_bantuan),
                'nama_bantuan' => trim($row->nama_bantuan),
                'nama_ktp' => trim($row->nama_ktp),
                'idsession' => trim($row->idsession),
                'tgl_bantuan' => trim($row->tgl_bantuan),
                'nama_instansi' => trim($row->nama_instansi),
                'ket' => trim($row->ket)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    public function getPenerima() {
        $iPID = trim($this->input->post('sPID'));
        // print_r($iPID);die();
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows=$this->global_m->get_data("SELECT * FROM vw_t_bantuan_temp where idsession='".$iPID."'");
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
                'act' => "<button id='btnDel' onclick='del_temp(".trim($row->id_t_bantuan).")' class='btn btn-danger btn-sm'><i class='glyphicon glyphicon-remove'></i> Delete</button>",
                /*,
                'alamatBantuan' => trim($row->alamat),
                'telpBantuan' => trim($row->telp)*/
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function ajax_delTemp() {
        $iId = trim($this->input->post('sId'));
        $iPid=trim($this->input->post('sPID'));
        $model = $this->trans_bantuan_m->delete("DELETE FROM `tbl_t_bantuan_temp` WHERE id_t_bantuan='".$iId."' and idsession='".$iPid."'");
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

    public function getKTP() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->trans_bantuan_m->getKtpAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            if($row->jekel=='0'){
                $ijekel="Pria";
            }else{
                $ijekel="Wanita";                
            }
            $array = array(
                'select' => "<button id='btnSelect' onclick='select(".trim($row->id_ktp).")' class='btn btn-warning btn-sm'><i class='glyphicon glyphicon-ok'></i> Select</button>",
                'id_ktp' => trim($row->id_ktp),
                'nama_ktp' => trim($row->nama_ktp),
                'jekel' => $ijekel,
                'tanggal_lahir' => trim($row->tanggal_lahir),
                /*,
                'alamatBantuan' => trim($row->alamat),
                'telpBantuan' => trim($row->telp)*/
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function ajax_saveSelect() {
        $ijns_bantuan = trim($this->input->post('sjns_bantuan'));
        $idKtp = trim($this->input->post('sKtp'));
        $iBantuan = trim($this->input->post('sBantuan'));
        $idInstansi = trim($this->input->post('sInstansi'));
        $sTgl = trim($this->input->post('sTgl'));
        $iKet = trim($this->input->post('sKet'));
        if(trim($this->input->post('sPID'))==""){
            $iPid=$this->global_m->get_data('select uuid() as pid')[0]->pid;
        }else{
            $iPid=trim($this->input->post('sPID'));
        }
        $iCek=$this->global_m->get_data("SELECT * FROM vw_t_bantuan_temp where idsession='".$iPid."' and id_ktp='".$idKtp."'");
        if(sizeof($iCek)<1){
            $data = array(
                'idsession' => $iPid,
                'id_jns_bantuan' => $ijns_bantuan,
                'id_m_instansi' => $idInstansi,
                'id_ktp' => $idKtp,
                'tgl_bantuan' => date('Y-m-d', strtotime($sTgl)),
                'nama_bantuan' => $iBantuan,
                'ket' => $iKet,
                'create_by' => $this->session->userdata('id_user'),
                'create_date' => date('Y-m-d H:i:s')
            );   
            $model = $this->global_m->simpan('tbl_t_bantuan_temp',$data);            
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

    function ajax_simpanBantuan() {
        $iPid=trim($this->input->post('sPID'));
        $ijns_bantuan = trim($this->input->post('sjns_bantuan'));
        $iBantuan=$this->input->post('sBantuan');
        $iInstansi=$this->input->post('sInstansi');
        $iTgl=date('Y-m-d', strtotime($this->input->post('sTgl')));
        $iKet=$this->input->post('sKet');
        $iUser=$this->session->userdata('id_user');
        $idate=date('Y-m-d H:i:s');

        // print_r($iBantuan);die();
        $model = $this->trans_bantuan_m->query("CALL zsp_simpan_bantuan('".$iUser."','".$iPid."','".$ijns_bantuan."','".$iBantuan."','".$iInstansi."','".$iTgl."','".$iKet."')");
        if ($model) {
            $array = array(
                'act' => true,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.',
                'iPid' => $iPid
            );
        } else {
            $array = array(
                'act' => false,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.',
                'iPid' => ''
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function ajax_detail() {
        $iSes=trim($this->input->post('sSes'));
        $iUser=$this->session->userdata('id_user');
        $model = $this->trans_bantuan_m->query("CALL zsp_detail_bantuan('".$iUser."','".$iSes."')");
        if ($model) {
            $array = array(
                'act' => true,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil disimpan.',
                'iPid'=>$iSes
            );
        } else {
            $array = array(
                'act' => false,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal disimpan.',
                'iPid'=>''
            );
        }
        $this->output->set_output(json_encode($array));
    }




// END dipalai


    function getDescBantuan() {
        $this->CI = & get_instance();
        $idBantuan = $this->input->post('idBantuan', TRUE);
        $rows = $this->trans_bantuan_m->getDescBantuan($idBantuan);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_bantuan' => $row->nama_bantuan
                    /*,
                    'alamat' => $row->alamat,
                    'telp' => $row->telp,
                    'npwp' => $row->npwp*/
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }

    function simpan() {
        $namaBantuan = trim($this->input->post('namaBantuan'));
        /*$alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));*/
        $modelidBantuan = $this->trans_bantuan_m->getidBantuan();
        $data = array(
            'id_bantuan' => $modelidBantuan,
            'nama_bantuan' => $namaBantuan
                /*,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp*/
        );
        $model = $this->trans_bantuan_m->insert($data);
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
        $BantuanId = trim($this->input->post('BantuanId'));
        $namaBantuan = trim($this->input->post('namaBantuan'));
        /*$alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $npwp = trim($this->input->post('npwp'));*/

        $data = array(
            'nama_bantuan' => $namaBantuan
                /*,
            'alamat' => $alamat,
            'telp' => $telp,
            'npwp' => $npwp*/
        );

        $model = $this->trans_bantuan_m->update($data, $BantuanId);
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
        $idBantuan = trim($this->input->post('idBantuan'));

        $model = $this->trans_bantuan_m->delete($idBantuan);
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