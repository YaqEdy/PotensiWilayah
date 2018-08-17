<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan Posisi Keuangan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table border='1'>
    <tr><td colspan='4' style="text-align: center;"><b><?php echo $laporan . tgl_indo($tgl); ?></b></td></tr>
    <tr>
        <!-- <td><b>Kode</b></td> -->
        <!-- <td><b>Alternatif</b></td> -->
        <td><b> Description</b></td>
        <td><b>Jumlah</b></td>
        <!-- <td></td> -->
        <!-- <td><b>Kode</b></td> -->
        <!-- <td><b>Alternatif</b></td> -->
        <td><b> Description</b></td>
        <td><b>Jumlah</b></td>
    </tr>
    <tr>
        <td colspan='2' style="text-align: center;"><b>AKTIVA</b></td>
        <!-- <td></td> -->
        <td colspan='2' style="text-align: center;"><b>PASIVA</b></td>
    </tr>
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
        if ($n->level_psv == 1) {
            $b = $n->nama_perk_psv;
        } elseif ($n->level_psv == 2) {
            $b = '&emsp;'.$n->nama_perk_psv;
        } elseif ($n->level_psv == 3) {
            $b = '&emsp;&emsp;'.$n->nama_perk_psv;
        } elseif ($n->level_psv == 4) {
            $b = '&emsp;&emsp;&emsp;'.$n->nama_perk_psv;
        } elseif ($n->level_psv == 5) {
            $b = '&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk_psv;
        } elseif ($n->level_psv == 6) {
            $b = '&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk_psv;
        } elseif ($n->level_psv == 7) {
            $b = '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk_psv;
        } else {
            $b = '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'.$n->nama_perk_psv;
        }
        $saldo = $n->saldo_akhir;
        if ($saldo < 0) {
            $l = number_format($saldo, 2, '.', ',');
//            $l = str_replace('-', '', $l);
            $saldo = '(' . $l . ')';
        } elseif ($saldo === 0) {
            $saldo = '0.00';
        } else {
            $saldo = number_format($saldo, 2, '.', ',');
        }
        $saldob = $n->saldo_akhir_psv;
        if ($saldob < 0) {
            $l = number_format($saldob, 2, '.', ',');
//            $l = str_replace('-', '', $l);
            $saldob = '(' . $l . ')';
        } elseif ($saldob === 0) {
            $saldob = '0.00';
        } else {
            $saldob = number_format($saldob, 2, '.', ',');
        }
        ?>
        <tr>
            <!-- <td><?php echo $n->kode_perk; ?></td> -->
            <!-- <td><?php echo $n->kode_alt; ?></td> -->
                <?php
                    if($n->type_psv=='G'){
                        echo"<td><b><font face='times new romans'>".$a."</font></b></td>
                             <td><b><font face='times new romans'>";
                        if ($n->kode_perk == '' && $n->nama_perk == '') {
                            $saldo = '';
                        }
                        echo $saldo."</font></b></td>";
                    } else {
                        echo"<td><font face='times new romans'>".$a."</font></td>
                             <td><font face='times new romans'>";
                        if ($n->kode_perk == '' && $n->nama_perk == '') {
                            $saldo = '';
                        }
                        echo $saldo."</font></td>";
                    }
                ?>
            <!-- <td><?php echo $a; ?></td> -->
<!--             <td><?php
                if ($n->kode_perk == '' && $n->nama_perk == '') {
                    $saldo = '';
                }
                echo $saldo;
                ?></td> -->
            <!-- <td></td> -->
            <!-- <td><?php echo $n->kode_perk_psv; ?></td> -->
            <?php
                    if($n->type_psv=='G'){
                        echo"<td><b><font face='times new romans'>".$b."</font></b></td>
                             <td><b><font face='times new romans'>";
                        if ($n->kode_perk_psv == '' && $n->nama_perk_psv == '') {
                            $saldo = '';
                        }
                        echo $saldo."</b></font></td>";
                    } else {
                        echo"<td><font face='times new romans'>".$b."</font></td>
                             <td><font face='times new romans'>";
                        if ($n->kode_perk_psv == '' && $n->nama_perk_psv == '') {
                            $saldo = '';
                        }
                        echo $saldo."</font></td>";
                    }
            ?>

            <!-- <td><?php echo $n->kode_alt_psv; ?></td> -->
<!--             <td><?php
                if ($n->kode_perk_psv == '' && $n->nama_perk_psv == '') {
                    $saldob = '';
                }
                echo $saldob;
                ?></td> -->
        </tr>
        <?php
    }
    $totalA = $total_aktiva;
    if ($totalA < 0) {
        $t = number_format($totalA, 2, '.', ',');
        $t = str_replace('-', '', $t);
        $totalAktiva = '(' . $t . ')';
    } else {
        $totalAktiva = number_format($totalA, 2, '.', ',');
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
        <td align="left" style="font-weight: bold;"><b>Total Aktiva</b></td>
        <td align="right" style="font-weight: bold;"><b><?php echo $totalAktiva; ?></b></td>
        <!-- <td></td> -->
        <td align="left" style="font-weight: bold;"><b>Total Pasiva</b></td>
        <td align="right" style="font-weight: bold;"><b><?php echo $totalAll; ?></b></td>
    </tr>
</table>