<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_ktp extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_m');
        $this->load->model('global_m');
        $this->load->model('transaksi/trans_bantuan_m');
        $this->load->library('pdf1');
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
        $menuId = $this->home_m->get_menu_id('laporan/lap_ktp/home');
        $data['menu_id'] = $menuId[0]->menu_id;
        $data['menu_parent'] = $menuId[0]->parent;
        $data['menu_nama'] = $menuId[0]->menu_nama;
        $data['menu_header'] = $menuId[0]->menu_header;
        $this->auth->restrict($data['menu_id']);
        $this->auth->cek_menu($data['menu_id']);

        $data['ktp'] = $this->global_m->getSelectOption('master_ktp','is_delete','0','','','id_ktp');

        // $data['suplier'] = $this->kedatangan_m->getSuplier();
        if (isset($_POST["btnSimpan"])) {
            $this->simpan();
        } else {
            $data['multilevel'] = $this->user_m->get_data(0, $this->session->userdata('usergroup'));
            $data['menu_all'] = $this->user_m->get_menu_all(0);

            $this->template->set('title', $data['menu_nama']);
            $this->template->load('template/template_dataTable', 'laporan/lap_ktp_v', $data);
        }
    }

    function cetak($id_ktp) {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $data['data_ktp'] = $this->global_m->get_data("select * from vw_t_kk where id_ktp=".$id_ktp)[0];
            $data['komunitas'] = $this->global_m->get_data("select * from vw_komunitas where id_ktp=".$id_ktp);
            $data['bantuan'] = $this->global_m->get_data("select * from vw_t_bantuan where id_ktp=".$id_ktp);

            $this->load->view('laporan/cetak_ktp_pdf_v.php',$data);
        }
    }

    function cetakall() {
        if ($this->auth->is_logged_in() == false) {
            redirect('main/index');
        } else {
            $data['data_kk'] = $this->global_m->get_data("select * from vw_t_kk");
            $this->load->view('laporan/cetak_ktp_pdf_all_v.php',$data);
        }
    }
    
    public function download_excel() {
        $this->load->helper('download');
        $this->load->library('excel/phpexcel');
        //membuat objek
        $objPHPExcel = new PHPExcel();
        //activate worksheet number 1
        $objPHPExcel->setActiveSheetIndex(0);
        //name the worksheet
        $objPHPExcel->getActiveSheet()->setTitle('data penduduk');
        // $users = (array)$users[0];
        //set cell A1 content with some text
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NO KK');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'NIK');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'NAMA');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'TEMPAT LAHIR');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'TGL LAHIR');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'JENIS KELAMIN');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'AGAMA');
        $objPHPExcel->getActiveSheet()->setCellValue('H1', 'GOLONGAN DARAH');
        $objPHPExcel->getActiveSheet()->setCellValue('I1', 'PENDIDIKAN');
        $objPHPExcel->getActiveSheet()->setCellValue('J1', 'ALAMAT');
        $objPHPExcel->getActiveSheet()->setCellValue('K1', 'RT');
        $objPHPExcel->getActiveSheet()->setCellValue('L1', 'RW');
        $objPHPExcel->getActiveSheet()->setCellValue('M1', 'KELURAHAN');
        $objPHPExcel->getActiveSheet()->setCellValue('N1', 'KECAMATAN');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'PEKERJAAN');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'DIFABEL');
        //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('M1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('N1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('O1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('P1')->getFont()->setBold(true);

        $data = $this->global_m->get_data("select * from vw_t_kk");
        $counter = 2;
        foreach ($data as $key) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $counter, $key->id_master_kk);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $counter, $key->id_ktp);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $counter, $key->nama_ktp);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $counter, $key->tempat_lahir);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $counter, $key->tanggal_lahir);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $counter, $key->nama_jekel);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $counter, $key->nama_agama);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $counter, $key->gol_darah);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $counter, $key->pendidikan);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $counter, $key->alamat);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $counter, $key->rt);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $counter, $key->rw);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $counter, $key->nama_kel);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $counter, $key->nama_kec);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $counter, $key->nama_pekerjaan);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $counter, $key->nama_difabel);

            $counter++;
        }
        ob_end_clean();
        //Header
        $filename = "DataPenduduk.xlsx";
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Pragma: no-cache");
        header("Expires: 0");
        //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //Download
        $objWriter->save("php://output");
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
                // 'select' => "<button id='".trim($row->id_ktp)."' name='".trim($row->nama_ktp)."' onclick='select(this)' class='btn primary btn-sm'><i class='fa fa-print'></i> Cetak</button>",
                'select' => "<button onclick='cetak(".trim($row->id_ktp).")' class='btn primary btn-sm'><i class='fa fa-print'></i> Cetak</button>",
                'id_ktp' => trim($row->id_ktp),
                'nama_ktp' => trim($row->nama_ktp),
                'jekel' => $ijekel,
                'tanggal_lahir' => trim($row->tanggal_lahir),
            );

            array_push($data['data'], $array);
        }
        $this->output->set_output(json_encode($data));
    }




}

/* End of file sec_user.php */
/* Location: ./application/controllers/sec_user.php */