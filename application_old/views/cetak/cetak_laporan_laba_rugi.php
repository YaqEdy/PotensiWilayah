<?php

date_default_timezone_set('Asia/Jakarta');
//$this->fpdf->image('image/mpm_logo.png',10,10,-300);
$this->fpdf->SetTitle('Laporan Laba Rugi');
$this->fpdf->FPDF("P", "cm", "A4");
$this->fpdf->SetMargins(0.5, 0.5, 0.5);
$this->fpdf->AliasNbPages();
$this->fpdf->AddPage();
$this->fpdf->SetFont('Times', 'B', 14);
$this->fpdf->Cell(20.5, 0.5, $nama, 0, 0, 'C');
$this->fpdf->SetFont('Times', '', 10);
$this->fpdf->Ln();
$this->fpdf->Cell(20.5, 0.5, $tower, 0, 0, 'C');
$this->fpdf->Ln();
$this->fpdf->Cell(20.5, 0.5, $alamat, 0, 0, 'C');
$this->fpdf->Ln();
$this->fpdf->SetFont('Times', '', 12);
$this->fpdf->Cell(20.5, 1.3, $laporan . tgl_indo($tgl) . " - " . tgl_indo($tgls), 0, 0, 'C');
$this->fpdf->Ln();
/* Fungsi Line untuk membuat garis */
$this->fpdf->Line(0.5, 3.15, 20.5, 3.15);
$this->fpdf->Line(0.5, 3.20, 20.5, 3.20);
/* ————– Header Halaman selesai ———————————————— */
//$this->fpdf->SetFont('Times','B',12);
//$this->fpdf->Cell(19,1,'Header',0,0,'C');
/* setting header table */
$this->fpdf->SetFont('Times', 'B', 10);
//$this->fpdf->Cell(4, 0.5, 'Kode Perkiraan', 1, 'LR', 'C');
// $this->fpdf->Cell(4, 0.5, 'Kode Alt', 1, 'LR', 'C');
$this->fpdf->Cell(14, 0.5, 'Description', 1, 'LR', 'C');
$this->fpdf->Cell(6, 0.5, 'Belance / Saldo', 1, 'LR', 'C');
/* generate hasil query disini */
$no = 1;
$this->fpdf->SetFont('Times', 'B', 8);
$this->fpdf->Ln();
$this->fpdf->Cell(20, 0.5, 'PENDAPATAN', 1, 'LR', 'C');
foreach ($neraca as $n) {
    if ($n->level == 1) {
        $a = $n->nama_perk;
    } elseif ($n->level == 2) {
        $a = '  '. $n->nama_perk;
    } elseif ($n->level == 3) {
        $a = '      ' . $n->nama_perk;
    } elseif ($n->level == 4) {
        $a = '          ' . $n->nama_perk;
    } elseif ($n->level == 5) {
        $a = '              ' . $n->nama_perk;
    } elseif ($n->level == 6) {
        $a = '                  ' . $n->nama_perk;
    } elseif ($n->level == 7) {
        $a = '                      ' . $n->nama_perk;
    } else {
        $a = '                          ' . $n->nama_perk;
    }
    $saldo = $n->saldo_akhir;
    if ($saldo < 0) {
        $l = number_format($saldo, 2, '.', ',');
        $l = str_replace('-', '', $l);
        $saldo = '(' . $l . ')';
    } else {
        $saldo = number_format($saldo, 2, '.', ',');
    }
    if ($n->sisi == 'L') {
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Times', '', 8);

        //$this->fpdf->Cell(4, 0.5, $n->kode_perk, 'L', 'LR', 'L');
        if($n->type=='G'){
            $this->fpdf->SetFont('Times', 'B', 8);
            $this->fpdf->Cell(14, 0.5, $a, 'L', 'LR', 'L');
        } else {
            $this->fpdf->Cell(14, 0.5, $a, 'L', 'LR', 'L');
        }
        // $this->fpdf->Cell(4, 0.5, $n->kode_alt, 0, 'LR', 'L');
        // $this->fpdf->Cell(12, 0.5, $a, 0, 'LR', 'L');
        $this->fpdf->Cell(6, 0.5, $saldo, 'R', 'LR', 'R');
    }
}
$this->fpdf->Ln();
$totalA = $total_pendapatan;
if ($totalA < 0) {
    $t = number_format($totalA, 2, '.', ',');
    $t = str_replace('-', '', $t);
    $total_Pendapatan = '(' . $t . ')';
} else {
    $total_Pendapatan = number_format($totalA, 2, '.', ',');
}
$this->fpdf->SetFont('Times', 'B', 8);
$this->fpdf->Cell(14, 0.5, 'Total Pendapatan', 1, 'LR', 'L');
$this->fpdf->Cell(6, 0.5, $total_Pendapatan, 1, 'LR', 'R');
$this->fpdf->Ln();
$this->fpdf->Ln();
$this->fpdf->SetFont('Times', 'B', 8);
$this->fpdf->Cell(20, 0.5, 'BIAYA', 1, 'LR', 'C');
foreach ($neraca as $n) {
    if ($n->level == 1) {
        $a = $n->nama_perk;
    } elseif ($n->level == 2) {
        $a = '  '. $n->nama_perk;
    } elseif ($n->level == 3) {
        $a = '      ' . $n->nama_perk;
    } elseif ($n->level == 4) {
        $a = '          ' . $n->nama_perk;
    } elseif ($n->level == 5) {
        $a = '              ' . $n->nama_perk;
    } elseif ($n->level == 6) {
        $a = '                  ' . $n->nama_perk;
    } elseif ($n->level == 7) {
        $a = '                      ' . $n->nama_perk;
    } else {
        $a = '                          ' . $n->nama_perk;
    }
    $saldo = $n->saldo_akhir;
    if ($saldo < 0) {
        $l = number_format($saldo, 2, '.', ',');
        $l = str_replace('-', '', $l);
        $saldo = '(' . $l . ')';
    } else {
        $saldo = number_format($saldo, 2, '.', ',');
    }
    if ($n->sisi == 'R') {
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Times', '', 8);
        //$this->fpdf->Cell(4, 0.5, $n->kode_perk, 'L', 'LR', 'L');
        if($n->type=='G'){
            $this->fpdf->SetFont('Times', 'B', 8);
            $this->fpdf->Cell(14, 0.5, $a, 'L', 'LR', 'L');
        }else{
            $this->fpdf->Cell(14, 0.5, $a, 'L', 'LR', 'L');
        }
        // $this->fpdf->Cell(4, 0.5, $n->kode_alt, 0, 'LR', 'L');
        //$this->fpdf->Cell(12, 0.5, $a, 0, 'LR', 'L');
        $this->fpdf->Cell(6, 0.5, $saldo, 'R', 'LR', 'R');
    }
}
$this->fpdf->Ln();
$totalM = $total_biaya;
if ($totalM < 0) {
    $t = number_format($totalM, 2, '.', ',');
    $t = str_replace('-', '', $t);
    $total_Biaya = '(' . $t . ')';
} else {
    $total_Biaya = number_format($totalM, 2, '.', ',');
}
//	$this->fpdf->SetFont('Times','B',8);
//	$this->fpdf->Cell(4 , 0.5, '', 'L', 'LR', 'L');
//	$this->fpdf->Cell(4 , 0.5, '', 0, 'LR', 'L');
//	$this->fpdf->Cell(8 , 0.5, 'Total Biaya', 0, 'LR', 'L');
//	$this->fpdf->Cell(4 , 0.5, $total_Biaya, 'R', 'LR', 'R');
//	$this->fpdf->Ln();
//$lrb = $laba_rugi_berjalan;
//	if($lrb < 0){
//		$t = number_format($lrb,2,'.',',');
//		$t = str_replace('-','',$t);
//		$labarugi = '('.$t.')';
//	}else{
//		$labarugi = number_format($lrb,2,'.',',');
//	}
//	$this->fpdf->Cell(4 , 0.5, '', 'L', 'LR', 'L');
//	$this->fpdf->Cell(4 , 0.5, '', 0, 'LR', 'L');
//	$this->fpdf->Cell(8 , 0.5, 'Laba Tahun Berjalan', 0, 'LR', 'L');
//	$this->fpdf->Cell(4 , 0.5, $labarugi, 'R', 'LR', 'R');
//	$this->fpdf->Ln();
//	$total = $total_pasiva + $laba_rugi_berjalan + $total_modal;
//	if($total < 0){
//		$t = number_format($total,2,'.',',');
//		$t = str_replace('-','',$t);
//		$totalAll = '('.$t.')';
//	}else{
//		$totalAll = number_format($total,2,'.',',');
//	}
$this->fpdf->SetFont('Times', 'B', 8);
$this->fpdf->Cell(14, 0.5, 'Total Biaya', 1, 'LR', 'L');
$this->fpdf->Cell(6, 0.5, $total_Biaya, 1, 'LR', 'R');
$this->fpdf->Ln();
$this->fpdf->SetFont('Times', 'B', 8);
$labarugi = $total_pendapatan - $total_biaya;
if ($labarugi < 0) {
    $t = number_format($labarugi, 2, '.', ',');
    $t = str_replace('-', '', $t);
    $labarugi = '(' . $t . ')';
} else {
    $labarugi = number_format($labarugi, 2, '.', ',');
}
$this->fpdf->Cell(14, 0.5, 'Laba Rugi', 1, 'LR', 'L');
$this->fpdf->Cell(6, 0.5, $labarugi, 1, 'LR', 'R');
$this->fpdf->Ln();
$this->fpdf->SetFont('Times', 'B', 8);
$taksiran = number_format(0, 2, '.', ',');
$this->fpdf->Cell(14, 0.5, 'Taksiran PPH', 1, 'LR', 'L');
$this->fpdf->Cell(6, 0.5, $taksiran, 1, 'LR', 'R');
$this->fpdf->Ln();
$this->fpdf->SetFont('Times', 'B', 8);
$this->fpdf->Cell(14, 0.5, 'Laba Rugi Setelah Pajak', 1, 'LR', 'L');
$this->fpdf->Cell(6, 0.5, $labarugi, 1, 'LR', 'R');

/* setting posisi footer 3 cm dari bawah */
/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
$this->fpdf->Output($laporan . "_" . date('d-m-Y h:i:sa') . ".pdf", "I");
?>
