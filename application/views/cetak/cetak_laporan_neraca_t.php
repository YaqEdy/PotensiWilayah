<?php

date_default_timezone_set('Asia/Jakarta');
$this->fpdf->FPDF("L", "cm", "A4");
$this->fpdf->SetTitle('Laporan Neraca');
$this->fpdf->SetMargins(0.5, 0.5, 0.5);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetFont('Times', 'B', 14);
$this->fpdf->Cell(29.5, 0.3, $nama, 0, 0, 'C');
$this->fpdf->SetFont('Times', '', 12);
$this->fpdf->Ln();
$this->fpdf->Cell(29.5, 0.8, $tower, 0, 0, 'C');
$this->fpdf->Ln();
$this->fpdf->Cell(29.5, 0.4, $alamat, 0, 0, 'C');
$this->fpdf->Ln();
$this->fpdf->SetFont('Times', '', 12);
$this->fpdf->Cell(29.5, 1.3, $laporan . tgl_indo($tgl), 0, 0, 'C'); //tgl_indo($tgl)
$this->fpdf->Ln();
/* Fungsi Line untuk membuat garis */
$this->fpdf->Line(0.5, 3.15, 29.5, 3.15);
$this->fpdf->Line(0.5, 3.20, 29.5, 3.20);
/* ————– Header Halaman selesai ———————————————— */
//$this->fpdf->SetFont('Times','B',12);
//$this->fpdf->Cell(19,1,'Header',0,0,'C');
/* setting header table */
$this->fpdf->SetFont('Times', 'B', 10);
//$this->fpdf->Cell(3, 0.5, 'Kode', 1, 'LR', 'C');
//$this->fpdf->Cell(2.5, 0.5, 'Alternatif', 1, 'LR', 'C');
$this->fpdf->Cell(10.5, 0.5, 'Description', 1, 'LR', 'C');
$this->fpdf->Cell(4, 0.5, 'Jumlah', 1, 'LR', 'C');
//$this->fpdf->Cell(3, 0.5, 'Kode', 1, 'LR', 'C');
//$this->fpdf->Cell(2.5, 0.5, 'Alternatif', 1, 'LR', 'C');
$this->fpdf->Cell(10.5, 0.5, 'Description', 1, 'LR', 'C');
$this->fpdf->Cell(4, 0.5, 'Jumlah', 1, 'LR', 'C');
/* generate hasil query disini */
foreach ($neraca as $n) {
    if ($n->level == 1) {
        $a = $n->nama_perk;
    } elseif ($n->level == 2) {
        $a = '  '. $n->nama_perk;
    } elseif ($n->level == 3) {
        $a = '      '. $n->nama_perk;
    } elseif ($n->level == 4) {
        $a = '          '. $n->nama_perk;
    } elseif ($n->level == 5) {
        $a = '              '. $n->nama_perk;
    } elseif ($n->level == 6) {
        $a = '                  '. $n->nama_perk;
    } elseif ($n->level == 7) {
        $a = '                      '. $n->nama_perk;
    } else {
        $a = '                          ' . $n->nama_perk;
    }
    if ($n->level_psv == 1) {
        $b = $n->nama_perk_psv;
    } elseif ($n->level_psv == 2) {
        $b = '  '. $n->nama_perk_psv;
    } elseif ($n->level_psv == 3) {
        $b = '      '. $n->nama_perk_psv;
    } elseif ($n->level_psv == 4) {
        $b = '          '. $n->nama_perk_psv;
    } elseif ($n->level_psv == 5) {
        $b = '              '. $n->nama_perk_psv;
    } elseif ($n->level_psv == 6) {
        $b = '                  '. $n->nama_perk_psv;
    } elseif ($n->level_psv == 7) {
        $b = '                      '. $n->nama_perk_psv;
    } else {
        $b = '                          '. $n->nama_perk_psv;
    }


    $saldo = $n->saldo_akhir;
    if ($saldo < 0) {
        $l = number_format($saldo, 2, '.', ',');
        $l = str_replace('-', '', $l);
        $saldo = '(' . $l . ')';
    } elseif ($saldo == 0) {
        $saldo = '0.00';
    } else {
        $saldo = number_format($saldo, 2, '.', ',');
    }
    $saldob = $n->saldo_akhir_psv;
    if ($saldob < 0) {
        $l = number_format($saldob, 2, '.', ',');
        $l = str_replace('-', '', $l);
        $saldob = '(' . $l . ')';
    } elseif ($saldob == 0) {
        $saldob = '0.00';
    } else {
        $saldob = number_format($saldob, 2, '.', ',');
    }
    $this->fpdf->Ln();
    $this->fpdf->SetFont('Times', '', 8);
    
        if($n->type=='G'){
            $this->fpdf->SetFont('Times', 'B', 8);
            //$this->fpdf->Cell(3, 0.5, $n->kode_perk, 'L', 'LR', 'L');
            $this->fpdf->Cell(10.5, 0.5, $a, 'L', 'LR', 'L');
            $this->fpdf->SetFont('Times', '', 8);
        }else{
            //$this->fpdf->Cell(3, 0.5, $n->kode_perk, 'L', 'LR', 'L');
            $this->fpdf->Cell(10.5, 0.5, $a,'L', 'LR', 'L');
        }
    //$this->fpdf->Cell(9, 0.5, $a, 0, 'LR', 'L');
    if ($n->kode_perk == '' && $n->nama_perk == '') {
        $saldo = '';    }
    $this->fpdf->Cell(4, 0.5, $saldo, 'R', 'LR', 'R');
    if ($n->kode_perk_psv == '') {
        $this->fpdf->SetFont('Times', 'B', 8);
    }
    if ($n->kode_perk_psv == '' && $n->nama_perk_psv == '') {
        $saldob = '';
    }
         if($n->type_psv=='G'){
            $this->fpdf->SetFont('Times', 'B', 8);
             //$this->fpdf->Cell(3, 0.5, $n->kode_perk_psv, 0, 'LR', 'L');
             $this->fpdf->Cell(10.5, 0.5, $b, 0, 'LR', 'L');
             $this->fpdf->SetFont('Times', '', 8);
        }else{
             //$this->fpdf->Cell(3, 0.5, $n->kode_perk_psv, 0, 'LR', 'L');
             $this->fpdf->Cell(10.5, 0.5, $b, 0, 'LR', 'L');
        }
    //$this->fpdf->Cell(3, 0.5, $n->kode_perk_psv.'--', 'L', 'LR', 'L');
    //$this->fpdf->Cell(2.5, 0.5, $n->kode_alt_psv, 0, 'LR', 'L');
    //$this->fpdf->Cell(9, 0.5, $b, 0, 'LR', 'L');
    $this->fpdf->Cell(4, 0.5, $saldob, 'R', 'LR', 'R');
}
$this->fpdf->Ln();
$totalA = $total_aktiva;
if ($totalA < 0) {
    $t = number_format($totalA, 2, '.', ',');
    $t = str_replace('-', '', $t);
    $totalAktiva = '(' . $t . ')';
} else {
    $totalAktiva = number_format($totalA, 2, '.', ',');
}
$this->fpdf->SetFont('Times', 'B', 8);
$this->fpdf->Cell(12, 0.5, 'Total Aktiva', 'LTB', 'LR', 'L');
$this->fpdf->Cell(2.5, 0.5, $totalAktiva, 'RTB', 'LR', 'R');

$total = $total_pasiva + $laba_rugi_berjalan + $total_modal;
if ($total < 0) {
    $t = number_format($total, 2, '.', ',');
    $t = str_replace('-', '', $t);
    $totalAll = '(' . $t . ')';
} else {
    $totalAll = number_format($total, 2, '.', ',');
}
$this->fpdf->Cell(12, 0.5, 'Total Pasiva', 'LTB', 'LR', 'L');
$this->fpdf->Cell(2.5, 0.5, $totalAll, 'RTB', 'LR', 'R');

/* setting posisi footer 3 cm dari bawah */
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($laporan . "_" . date('d-m-Y h:i:sa') . ".pdf", "I");
?>

  // if($n->type=='G'){
     //        $this->fpdf->SetFont('Times', 'B', 8);
     //         $this->fpdf->Cell(3, 0.5, $n->kode_perk, 0, 'LR', 'L');
     //    }else{
     //         $this->fpdf->Cell(3, 0.5, $n->kode_perk, 0, 'LR', 'L');
     //    }
    //$this->fpdf->Cell(2.5, 0.5, $n->kode_alt, 0, 'LR', 'L');