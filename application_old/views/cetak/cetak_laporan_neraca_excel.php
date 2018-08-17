<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan Posisi Keuangan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1' width="70%">
    <tr><td colspan='2' style="text-align: center;"><b><?php echo $laporan . tgl_indo($tgl); ?></b></td></tr>
    <tr>
        <!-- <td><b>Kode Perkiraan</b></td> -->
        <!-- <td><b>Kode Alt</b></td> -->
        <td><b>Description</b></td>
        <td><b>Rupiah</b></td>
    </tr>
    <tr><td colspan='2' style="text-align: center;"><b>AKTIVA</b></td></tr>
    <?php
    foreach ($neraca as $n) {
        if ($n->level == 1) {
            $a = $n->nama_perk;
        } elseif ($n->level == 2) {
            $a = '&emsp;'.$n->nama_perk;
        } elseif ($n->level == 3) {
            $a = '&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 4) {
            $a = '&emsp;&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 5) {
            $a = '&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 6) {
            $a = '&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 7) {
            $a = '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        } else {
            $a = '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        }
        $saldo = $n->saldo_akhir;
        if ($saldo < 0) {
            $l = number_format($saldo, 2, '.', ',');
//            $l = str_replace('-', '', $l);
            $saldo = '(' . $l . ')';
        } else {
            $saldo = number_format($saldo, 2, '.', ',');
        }
        if ($n->sisi == 'L') {
            ?>
            <tr>
                <!-- <td><?php echo $n->kode_perk; ?></td> -->
                <?php
                    if($n->type=='G'){
                        echo"<td><b><font face='times new romans'>".$a."</font></b></td>";
                        echo"<td style='text-align: right;'><b><font face='times new romans'>".$saldo."</font></b></td>";
                    } else {
                        echo"<td><font face='times new romans'>".$a."</font></td>";
                        echo"<td style='text-align: right;'><font face='times new romans'>".$saldo."</font></td>";
                    }
                ?>
            </tr>
            <?php
        }
    }
    $totalA = $total_aktiva;
    if ($totalA < 0) {
        $t = number_format($totalA, 2, '.', ',');
        $t = str_replace('-', '', $t);
        $totalAktiva = '(' . $t . ')';
    } else {
        $totalAktiva = number_format($totalA, 2, '.', ',');
    }
    ?>
    <tr>
        <td align="left" style="font-weight: bold;"><b>Total Aktiva</b></td>
        <td align="right" style="font-weight: bold;"><b><?php echo $totalAktiva; ?></b></td>
    </tr>
    <tr>&nbsp;</tr>
    <tr><td colspan='2' style="text-align: center;"><b>PASIVA</b></td></tr>
    <?php
    foreach ($neraca as $n) {
        if ($n->level == 1) {
            $a = $n->nama_perk;
        } elseif ($n->level == 2) {
            $a = '&emsp;'. $n->nama_perk;
        } elseif ($n->level == 3) {
            $a = '&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 4) {
            $a = '&emsp;&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 5) {
            $a = '&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 6) {
            $a = '&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        } elseif ($n->level == 7) {
            $a = '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
        } else {
            $a = '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk;
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
            ?>
            <tr>
                <!-- <td><?php echo $n->kode_perk; ?></td> -->
                <!-- <td><?php echo $n->kode_alt; ?></td> -->
                <?php
                    if($n->type=='G'){
                        echo"<td><b><font face='times new romans'>".$a."</font></b></td>";
                        echo"<td style='text-align: right;'><b><font face='times new romans'>".$saldo."</font></b></td>";
                    } else {
                        echo"<td><font face='times new romans'>".$a."</font></td>";
                        echo"<td style='text-align: right;'><font face='times new romans'>".$saldo."</font></td>";
                    }
                ?>
<!--                 <td><?php echo $a; ?></td>
                <td><?php echo $saldo; ?></td> -->
            </tr>
            <?php
        }
    }
    $totalM = $total_modal;
    if ($totalM < 0) {
        $t = number_format($totalM, 2, '.', ',');
        $t = str_replace('-', '', $t);
        $totalModal = '(' . $t . ')';
    } else {
        $totalModal = number_format($totalM, 2, '.', ',');
    }
    $lrb = $laba_rugi_berjalan;
    if ($lrb < 0) {
        $t = number_format($lrb, 2, '.', ',');
        $t = str_replace('-', '', $t);
        $labarugi = '(' . $t . ')';
    } else {
        $labarugi = number_format($lrb, 2, '.', ',');
    }
    $total = $total_pasiva + $laba_rugi_berjalan + $total_modal;
    if ($total < 0) {
        $t = number_format($total, 2, '.', ',');
        $t = str_replace('-', '', $t);
        $totalAll = '(' . $t . ')';
    } else {
        $totalAll = number_format($total, 2, '.', ',');
    }
    ?>
    <tr>
        <td align="left" style="font-weight: bold;"><b>Total Modal</b></td>
        <td align="right" style="font-weight: bold;"><b><?php echo $totalModal; ?></b></td>
    </tr>
    <tr>
        <td align="left" style="font-weight: bold;"><b>Laba Tahun Berjalan</b></td>
        <td align="right" style="font-weight: bold;"><b><?php echo $labarugi; ?></b></td>
    </tr>
    <tr>
        <td align="left" style="font-weight: bold;"><b>Total Pasiva</b></td>
        <td align="right" style="font-weight: bold;"><b><?php echo $totalAll; ?></b></td>
    </tr>
</table>