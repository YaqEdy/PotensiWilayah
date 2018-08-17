<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Laporan MutasiProduk</title>
        <style type="text/css">
            .textborder {
                border: thin solid #000000;
            }
            @page { margin:20px 80px 25px 80px; font-family: "Courier New", Times, serif; font-size: 12px;}
            #header { position: fixed; left: 0px; top: -20px; right: 0px; height: 20px;  text-align: center; background-color:#fff; }
            #footer {  position: fixed; left: 0px; bottom: 0px; right: 0px; height: 35px;  text-align: left; background-color:#fff; }
            /*.cls_tr_header {  font-size: 11px; }*/
            .cls_tr_isi {  font-size: 10px; }
            .judul{ font-size: 25px;}
        </style>

        <?php
        ?>

    </head>
    <body>
        <div id="header">

        </div>
        <div id="content"  >
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="25%" align="left"><img src="<?php echo base_url(); ?>images/ski_header_report.jpg" width="74" height="60" alt=""/></td>
                        <td width="50%" align="center" class="judul"><?php echo $header." ".$namaProduk; ?></td>
                        <td width="25%" align="left">&nbsp;</td>    
                    </tr>
                    <tr>
                        <td width="25%" align="left">&nbsp;</td>
                        <td width="50%" align="center" >Tanggal : <?php echo $tglAwal; ?> sampai <?php echo $tglAkhir; ?></td>
                        <td width="25%" align="left">&nbsp;</td>    
                    </tr>
<!--                    <tr>
                        <td>&nbsp;</td>
                    </tr>-->
                    <tr>
                        <td><table width="200" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td colspan="3">PT Sumber Kita Indah</td>
                                    </tr>

                                    <tr>
                                        <td colspan=3><u><strong></strong></u></td>
                                    </tr>
                                </tbody>
                            </table></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan ="3"><hr /></td>
                    </tr>
                </tbody>
            </table>

            <p>&nbsp;</p>
            <table width="100%" border="1" cellspacing="0" cellpadding="4">
                <tbody>
                    <tr class="cls_tr_header">
                        <th width="3%" >No</th>
                        <th width="10%" >Tanggal</th>
                        <th width="10%" >Storage</th>
                        <th width="10%" >Masuk</th>
                        <th width="10%" >Masuk Camp</th>
                        <th width="10%" >Masuk Mutasi</th>
                        <th width="10%" >Keluar</th>
                        <th width="10%" >Keluar Camp</th>
                        <th width="10%" >Keluar Mutasi</th>
                        <th width="10%" >Keluar Lain-lain</th>
                        <th width="10%" >Saldo</th>
                    </tr>
                    <tr class="cls_tr_header">
                        <td colspan="10" align="center"><strong>Saldo awal</strong></td>
                        <td align="right"><?php echo number_format($saldo_awal, 2); ?></td>
                    </tr>
                    <?php
                    /*
                     * 100 = masuk
                     * 110 = masuk camp
                     * 120 = masuk mutasi tangki
                     * 200 = keluar
                     * 210 = keluar camp
                     * 220 = keluar mutasi tangki    
                     */
                    $i = 1;
                    $tot_saldo_awal = $saldo_awal;
                    $tot100 = 0;
                    $tot110 = 0;
                    $tot120 = 0;
                    $tot200 = 0;
                    $tot210 = 0;
                    $tot220 = 0;
                    $tot230 = 0;
                    foreach ($stok_produk as $dat) {
                        $tgl = date("d-m-Y", strtotime($dat->tgl_trans));
                        ?>
                        <tr class="cls_tr_isi">
                            <td  align="center"><?php echo $i; ?></td>
                            <td  align="left"><?php echo $tgl; ?></td>
                            <td  align="left"><?php echo $dat->nama_storage; ?></td>
                            <?php
                            if ($dat->kode_trans == 100) {
                                $tot_saldo_awal = $tot_saldo_awal + $dat->qty_realisasi;
                                $tot100 = $tot100 + $dat->qty_realisasi;
                                ?>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <?php
                            } else if ($dat->kode_trans == 110) {
                                $tot_saldo_awal = $tot_saldo_awal + $dat->qty_realisasi;
                                $tot110 = $tot110 + $dat->qty_realisasi;
                                ?>
                                <td  align="right">0</td>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <?php
                            }  else if ($dat->kode_trans == 120) {
                                $tot_saldo_awal = $tot_saldo_awal + $dat->qty_realisasi;
                                $tot120 = $tot120 + $dat->qty_realisasi;
                                ?>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <?php
                            } else if ($dat->kode_trans == 200) {
                                $tot_saldo_awal = $tot_saldo_awal - $dat->qty_realisasi;
                                $tot200 = $tot200 + $dat->qty_realisasi;
                                ?>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <?php
                            } else if ($dat->kode_trans == 210) {
                                $tot_saldo_awal = $tot_saldo_awal - $dat->qty_realisasi;
                                $tot210 = $tot210 + $dat->qty_realisasi;
                                ?>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <?php
                            }
                            else if ($dat->kode_trans == 220) {
                                $tot_saldo_awal = $tot_saldo_awal - $dat->qty_realisasi;
                                $tot220 = $tot220 + $dat->qty_realisasi;
                                ?>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>
                                <td  align="right">0</td>

                                <?php
                            }else if ($dat->kode_trans == 230) {
                                $tot_saldo_awal = $tot_saldo_awal - $dat->qty_realisasi;
                                $tot230 = $tot230 + $dat->qty_realisasi;
                                ?>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right">0</td>
                                <td  align="right"><?php echo number_format($dat->qty_realisasi); ?></td>

                                <?php
                            }
                            ?>
                            <td  align="right"><?php echo number_format($tot_saldo_awal); ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    //$tot_saldo_awal = $tot_saldo_awal + $dat->saldo_awal;
                    ?>
                    <tr class="cls_tr_footer">
                        <td colspan="3" align="center"><strong>Saldo akhir</strong></td>
                        <td align="right"><?php echo number_format($tot100, 2); ?></td>
                        <td align="right"><?php echo number_format($tot110, 2); ?></td>
                        <td align="right"><?php echo number_format($tot120, 2); ?></td>
                        <td align="right"><?php echo number_format($tot200, 2); ?></td>
                        <td align="right"><?php echo number_format($tot210, 2); ?></td>
                        <td align="right"><?php echo number_format($tot220, 2); ?></td>
                        <td align="right"><?php echo number_format($tot230, 2); ?></td>
                        <td align="right"><?php echo number_format($tot_saldo_awal, 2); ?></td>
                    </tr>


                </tbody>
            </table>


            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
                <tbody>
                    <tr>
                        <td width="10%" align="center"><hr>Administrasi</td>
                        <td width="10%" align="center"><hr>Warehouse Manager</td>
                        <td width="10%" align="center"><hr>Supplier</td>
                        <td width="10%" align="center"><hr>Ekspedisi</td>
                    </tr>


                </tbody>
            </table>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
<!--        <div id="footer">
            <i>-->
                <?php //echo date('d-m-Y H:i:s'); ?>
<!--            </i>

        </div>-->
    </body>
</html>
