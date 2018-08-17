<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_cust extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('master/master_cust_m');
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
        $menuId = $this->home_m->get_menu_id('master/master_cust/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

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
            $this->template->load('template/template_dataTable', 'master/master_cust_v', $data);
        }
    }

    public function getCustAll() {
        $this->CI = & get_instance(); //and a.kcab_id<>'1100'
        $rows = $this->master_cust_m->getCustAll();
        $data['data'] = array();
        foreach ($rows as $row) {
            $array = array(
                'idCust' => trim($row->id_cust),
                'namaCust' => trim($row->nama_cust),
                'alamatCust' => trim($row->alamat),
                'telpCust' => trim($row->telp)
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }

    function getDescCust() {
        $this->CI = & get_instance();
        $idCust = trim($this->input->post('idCust', TRUE)); 
        $rows = $this->master_cust_m->getDescCust($idCust);
        if ($rows) {
            foreach ($rows as $row)
                $array = array(
                    'baris' => 1,
                    'nama_cust' => $row->nama_cust,
                    'alamat' => $row->alamat,
                    'telp' => $row->telp
                );
        } else {
            $array = array('baris' => 0);
        }

        $this->output->set_output(json_encode($array));
    }
    function getSearchCust() {
        $this->CI = & get_instance();
        $namaCust = $_GET['q'];
        $rows = $this->master_cust_m->getSearchCust($namaCust);
        if ($rows) {
            
                $array = array(
                    'total_count' => sizeof($rows),
                    'incomplete_results' => true,
                    'items' => $rows
                );
        } else {
            $array = array(
                    'total_count' => 0,
                    'incomplete_results' => false,
                    'items' => $rows
                );
        }
        
        $this->output->set_output(json_encode($array,JSON_PRETTY_PRINT));
    }

    function getAllKuota() {
        $this->CI = & get_instance();
        $idCust = $this->input->post('idCust', TRUE);
        $crows = $this->master_cust_m->getCAllKuota($idCust);
        if ($crows <= 0) {
            $array = array('baris' => 0);
            $rows['data_cpa'] = $array;
            $this->output->set_output(json_encode($rows));
        } else {
            $rows = $this->master_cust_m->getDescAllKuota($idCust);
            $this->output->set_output(json_encode($rows));
            //$this->cekStok();
        }
    }

    function simpan() {
        $namaCust = trim($this->input->post('namaCust'));
        $alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        $id_produk = trim($this->input->post('produk'));


        
        $modelidCust = $this->master_cust_m->getIdCust();
        $data = array(
            'id_cust' => $modelidCust,
            'nama_cust' => $namaCust,
            'alamat' => $alamat,
            'telp' => $telp
        );
        $modelCust = $this->master_cust_m->insert($data);
        

        if ($modelCust) {
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
        $custId = trim($this->input->post('custId'));
        $namaCust = trim($this->input->post('namaCust'));
        $alamat = trim($this->input->post('alamat'));
        $telp = trim($this->input->post('telp'));
        
        $data = array(
            'nama_cust' => $namaCust,
            'alamat' => $alamat,
            'telp' => $telp
        );

        $modelCust = $this->master_cust_m->update($data, $custId);

        if ($modelCust) {
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
    function nonaktif() {
        $custId = trim($this->input->post('idCust'));
        
        $data = array(
            'status_aktif' => 0
        );

        $modelCust = $this->master_cust_m->update($data, $custId);

        if ($modelCust) {
            $array = array(
                'act' => 1,
                'tipePesan' => 'success',
                'pesan' => 'Data berhasil dinonaktifkan.'
            );
        } else {
            $array = array(
                'act' => 0,
                'tipePesan' => 'error',
                'pesan' => 'Data gagal dinonaktifkan.'
            );
        }
        $this->output->set_output(json_encode($array));
    }

    function hapus() {
        $this->CI = & get_instance();
        $idCust = trim($this->input->post('idCust'));

        $model = $this->master_cust_m->delete($idCust);
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