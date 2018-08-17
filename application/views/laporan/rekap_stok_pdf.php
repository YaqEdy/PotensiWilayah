<?php

class PDF extends FPDF {

    function Content($datasatu, $tgldari, $tglsampai, $nama_lokasi) {

        $this->Ln(0);
        $this->SetFont('Times', 'B', 13);
        $this->Cell(34, 0.7, 'Monitoring Laporan Pembayaran ', 0, 0, 'C');

        $this->Ln();
        $this->Cell(34, 0.6, 'Periode ' . TanggalIndo($tgldari) . ' s/d ' . TanggalIndo($tglsampai) . '', 0, 0, 'C');
        $this->Ln();
        $this->Cell(34, 0.6, 'Lokasi ' . $nama_lokasi . '', 0, 0, 'C');
        /* Fungsi Line untuk membuat garis */
        $this->Line(1, 3.5, 34.5, 3.5);
        $this->Line(1, 3.55, 34.5, 3.55);
        $this->Line(1, 3.55, 34.5, 3.55);

        $this->Ln(1);
        $this->Ln(1);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(3, 1, 'NDR', 1, 'LR', 'C');
        $this->Cell(3.5, 1, 'Nama Penghuni', 1, 'LR', 'C');
        $this->Cell(3, 1, 'Tanggal  ', 1, 'LR', 'C');
        $this->Cell(2.5, 1, 'Jaminan ', 1, 'LR', 'C');
        $this->Cell(2.5, 1, 'Sewa ', 1, 'LR', 'C');
        $this->Cell(2.5, 1, 'Listrik ', 1, 'LR', 'C');
        $this->Cell(2.5, 1, 'Air ', 1, 'LR', 'C');
        $this->Cell(2.5, 1, 'Gas ', 1, 'LR', 'C');
        $this->Cell(3, 1, 'Denda Sewa ', 1, 'LR', 'C');
        $this->Cell(3, 1, 'Denda Listrik ', 1, 'LR', 'C');
        $this->Cell(3, 1, 'Denda Air', 1, 'LR', 'C');
        $this->Cell(3, 1, 'Denda Gas', 1, 'LR', 'C');
        //	print_r($data['child']);
        /* setting posisi footer 3 cm dari bawah */


        $i = 0;
        $totaljaminan = 0;
        $totalsewa = 0;
        $totallistrik = 0;
        $totalair = 0;
        $totalgas = 0;
        $totaldendasewa = 0;
        $totaldendalistrik = 0;
        $totaldendaair = 0;
        $totaldendagas = 0;

        foreach ($datasatu as $data) {
       
            $sewa = $data->uangsewa;
            $trans_jaminan = $data->trans_jaminan;
            $trans_listrik = $data->trans_listrik;
            $trans_air = $data->trans_air;
            $trans_gas = $data->trans_gas;
            $denda = $data->denda;
            $denda_listrik = $data->denda_listrik;
            $denda_air = $data->denda_air;
            $denda_gas = $data->denda_gas;
            $nama_cust = $data->nama_cust;
            $ndr = $data->ndr;
            $tgl_trans = $data->tgl_trans;
            $pembayaran = $data->uangsewa;


            $totaljaminan = $totaljaminan + $trans_jaminan;
            $totalsewa = $totalsewa + $sewa;
            $totallistrik = $totallistrik + $trans_listrik;
            $totalair = $totalair + $trans_air;
            $totalgas = $totalgas + $trans_gas;
            $totaldendasewa = $totaldendasewa + $denda;
            $totaldendalistrik = $totaldendalistrik + $denda_listrik;
            $totaldendaair = $totaldendaair + $denda_air;
            $totaldendagas = $totaldendagas + $denda_gas;


            
            $this->Ln();
            $this->SetFont('Times', "", 10);
            $this->Cell(3, 0.7, $ndr, 1, 'LR', 'L');
            $this->Cell(3.5, 0.7, $nama_cust, 1, 'L', 'L');
            $this->Cell(3, 0.7, TanggalIndo($tgl_trans), 1, 'L', 'L');
            $this->Cell(2.5, 0.7, rupiah($trans_jaminan), 1, 'L', 'R');
            $this->Cell(2.5, 0.7, rupiah($sewa), 1, 'L', 'R');
            $this->Cell(2.5, 0.7, rupiah($trans_listrik), 1, 'L', 'R');
            $this->Cell(2.5, 0.7, rupiah($trans_air), 1, 'L', 'R');
            $this->Cell(2.5, 0.7, rupiah($trans_gas), 1, 'L', 'R');
            $this->Cell(3, 0.7, rupiah($denda), 1, 'L', 'R');
            $this->Cell(3, 0.7, rupiah($denda_listrik), 1, 'L', 'R');
            $this->Cell(3, 0.7, rupiah($denda_air), 1, 'L', 'R');
            $this->Cell(3, 0.7, rupiah($denda_gas), 1, 'L', 'R');
        }
        $this->SetFont('Times', "B", 10);
        $this->Ln();
        $this->Cell(9.5, 0.7, 'Total', 1, 0, 'C');
        $this->Cell(2.5, 0.7, rupiah($totaljaminan), 1, 0, 'R');
        $this->Cell(2.5, 0.7, rupiah($totalsewa), 1, 0, 'R');
        $this->Cell(2.5, 0.7, rupiah($totallistrik), 1, 0, 'R');
        $this->Cell(2.5, 0.7, rupiah($totalair), 1, 0, 'R');
        $this->Cell(2.5, 0.7, rupiah($totalgas), 1, 0, 'R');
        $this->Cell(3, 0.7, rupiah($totaldendasewa), 1, 0, 'R');
        $this->Cell(3, 0.7, rupiah($totaldendalistrik), 1, 0, 'R');
        $this->Cell(3, 0.7, rupiah($totaldendaair), 1, 0, 'R');
        $this->Cell(3, 0.7, rupiah($totaldendagas), 1, 0, 'R');
    }

    function Footer() {
        //atur posisi 1.5 cm dari bawah
        $this->SetY(-15);
        //nomor halaman
        $this->SetFont('Times', "", 8);
        $this->Cell(18, 27, 'Halaman ' . $this->PageNo() . ' dari {nb}', 0, 0, 'C');
        //	$this->Cell(0,27,''.date('Y-m-d'),0,0,'R');
        $this->Cell(0, 27, 'Tanggal ' . tgl_indo(date('Y-m-d')), 0, 0, 'R');
    }

}

$pdf = new PDF("L", "cm", "Legal");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(0.8, 3, 1);
//$pdf->Header($namatower);
$pdf->Content($datasatu, $tgldari, $tglsampai, $nama_lokasi);
$pdf->Output();
