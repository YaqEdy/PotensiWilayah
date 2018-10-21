<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_kategoribarang extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->load->model('home_m');
    $this->load->model('master_kategoribarang_m');
    session_start ();
  }
  public function index(){
    if($this->auth->is_logged_in () == false){
      $this->login();
    }else{
      $data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
      $data['menu_all'] = $this->user_m->get_menu_all(0);
      
      $this->template->set ( 'title', 'Home' );
      $this->template->load ( 'template/template3', 'master/index',$data );
    }
    
  }
  
  function home(){
    $menuId = $this->home_m->get_menu_id('master_kategoribarang/home');
    $data['menu_id'] = $menuId[0]->menu_id;
    $data['menu_parent'] = $menuId[0]->parent;
    $data['menu_nama'] = $menuId[0]->menu_nama;
    $data['menu_header'] = $menuId[0]->menu_header;
    $this->auth->restrict ($data['menu_id']);
    $this->auth->cek_menu ( $data['menu_id'] );
        
       
    if(isset($_POST["btnSimpan"])){
      $this->simpan();
    }elseif(isset($_POST["btnUbah"])){
      $this->ubah();
    }elseif(isset($_POST["btnHapus"])){
      $this->hapus();
    }else{
      $data['multilevel'] = $this->user_m->get_data(0,$this->session->userdata('usergroup'));
      $data['menu_all'] = $this->user_m->get_menu_all(0);
      
      $this->template->set ( 'title', $data['menu_nama'] );
      $this->template->load ( 'template/template3', 'master/master_kategoribarang_v',$data );
    }
  }
  public function getKategoribarangAll(){
    $this->CI =& get_instance();//and a.kcab_id<>'1100'
    $rows = $this->master_kategoribarang_m->getKategoribarangAll();
    $data['data'] = array();
    foreach( $rows as $row ) {
      $array = array(
          'idKategoribarang' => trim($row->id_kategoribarang),
          'namaKategoribarang' => trim($row->nama_kategoribarang)
      );
  
      array_push($data['data'],$array);
    }
    $this->output->set_output(json_encode($data));
  }
    function simpan(){
    $namaKategoribarang     = trim($this->input->post('namaKategoribarang'));
    //$idTower      = trim($this->input->post('tower'));
    /*$qtyRumah     = str_replace(',', '', trim($this->input->post('jmlRumah')));*/

        $modelidKategoribarang = $this->master_kategoribarang_m->getIdKategoribarang();
        $data = array(
            'id_kategoribarang'       =>$modelidKategoribarang,
            'nama_kategoribarang'   =>$namaKategoribarang

        );
        $model = $this->master_kategoribarang_m->simpan($data);
        if($model){
        $array = array(
          'act' =>1,
          'tipePesan'=>'success',
          'pesan' =>'Data berhasil disimpan.'
        );
      }else{
        $array = array(
          'act' =>0,
          'tipePesan'=>'error',
          'pesan' =>'Data gagal disimpan.'
        );
      }
        $this->output->set_output(json_encode($array));
    }
    function ubah(){
    $idKategoribarang     = trim($this->input->post('idKategoribarang'));
    $namaKategoribarang     = trim($this->input->post('namaKategoribarang'));

      $data = array(
      'nama_kategoribarang'   =>$namaKategoribarang
        );
      
      $model = $this->master_kategoribarang_m->ubah($data,$idKategoribarang);
      if($model){
        $array = array(
          'act' =>1,
          'tipePesan'=>'success',
          'pesan' =>'Data berhasil diubah.'
        );
      }else{
        $array = array(
          'act' =>0,
          'tipePesan'=>'error',
          'pesan' =>'Data gagal diubah.'
        );
      }
      $this->output->set_output(json_encode($array));
    }
    function hapus(){
      $this->CI =& get_instance();
      $kategoribarangId     = trim($this->input->post('idKategoribarang'));
        $model = $this->master_kategoribarang_m->hapus( $kategoribarangId);
        if($model){
            $array = array(
                'act' =>1,
                'tipePesan'=>'success',
                'pesan' =>'Data berhasil dihapus.'
            );
          }else{
            $array = array(
                'act' =>0,
                'tipePesan'=>'error',
                'pesan' =>'Data gagal dihapus.'
            );
          }
     
      $this->output->set_output(json_encode($array));
    }
  

}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */