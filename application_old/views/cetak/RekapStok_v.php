<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Laporan Rekapitulasi Stok</title>
        <style type="text/css">

            .textborder {
                border: thin solid #000000;
            }
            @page { margin:20px 80px 25px 80px; font-family: "Courier New", Times, serif; font-size: 12px;}
            #header { position: fixed; left: 0px; top: -20px; right: 0px; height: 20px;  text-align: center; background-color:#fff; }
            #footer {  position: fixed; left: 0px; bottom: 0px; right: 0px; height: 35px;  text-align: left; background-color:#fff; }
            .cls_tr_header {  font-size: 11px; }
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
                        <td width="30%" align="left"><img src="<?php echo base_url(); ?>images/ski_header_report.jpg" width="64" height="50" alt=""/></td>
                        <td width="70%" align="" class="judul">Laporan Rekapitulasi Stok</td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><table width="200" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td width=7%>:</td>
                                        <td width=70%><?php echo $tgl_skrg; ?></td>
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
                        <td colspan ="2"><hr /></td>
                    </tr>
                </tbody>
            </table>
            
            <p>&nbsp;</p>
            <table width="100%" border="1" cellspacing="0" cellpadding="4">
                <tbody>
                    <tr class="cls_tr_header">
                        <th width="3%" >No</th>
                        <th width="10%" >Produk</th>
                        <th width="10%" >Saldo Awal</th>
                        <th width="10%" >Masuk</th>
                        <th width="10%" >Masuk Camp</th>
                        <th width="10%" >Keluar</th>
                        <th width="10%" >Keluar Camp</th>
                        <th width="10%" >Stok Available</th>
                        <th width="10%" >Stok on hand</th>
                    </tr>
                    <?php
                    $i = 1;
                    $tot_saldo_awal=0;
                    $tot_masuk =0;
                    $tot_masuk_campur=0;
                    $tot_keluar =0;
                    $tot_keluar_campur =0;
                    $tot_stok_avl =0;
                    $tot_stok_akhir = 0;
                    foreach ($stok_produk as $dat) {
                        ?>
                    <tr class="cls_tr_isi">
                            <td  align="center"><?php echo $i; ?></td>
                            <td  align="left"><?php echo $dat->nama_produk; ?></td>
                            <td  align="right"><?php echo number_format($dat->saldo_awal,2); ?></td>
                            <td  align="right"><?php echo number_format($dat->masuk,2); ?></td>
                            <td  align="right"><?php echo number_format($dat->masuk_campur,2); ?></td>
                            <td  align="right"><?php echo number_format($dat->keluar,2); ?></td>
                            <td  align="right"><?php echo number_format($dat->keluar_campur,2); ?></td>
                            <td  align="right"><?php echo number_format($dat->stok_avl,2); ?></td>
                            <td  align="right"><?php echo number_format($dat->stok_akhir,2); ?></td>
                        </tr>
                        <?php
                        $i++;
                        $tot_saldo_awal = $tot_saldo_awal + $dat->saldo_awal;
                        $tot_masuk = $tot_masuk + $dat->masuk;
                        $tot_masuk_campur = $tot_masuk_campur + $dat->masuk_campur;
                        $tot_keluar = $tot_keluar + $dat->keluar;
                        $tot_keluar_campur = $tot_keluar_campur + $dat->keluar_campur;
                        $tot_stok_avl = $tot_stok_avl + $dat->stok_avl;
                        $tot_stok_akhir = $tot_stok_akhir + $dat->stok_akhir;
                    }
                    ?>
                    <tr>
                        <td colspan="2" align="center">Total</td>
                        <td  align="right"><?php echo number_format($tot_saldo_awal,2); ?></td>
                        <td  align="right"><?php echo number_format($tot_masuk,2); ?></td>
                        <td  align="right"><?php echo number_format($tot_masuk_campur,2); ?></td>
                        <td  align="right"><?php echo number_format($tot_keluar,2); ?></td>
                        <td  align="right"><?php echo number_format($tot_keluar_campur,2); ?></td>
                        <td  align="right"><?php echo number_format($tot_stok_avl,2); ?></td>
                        <td  align="right"><?php echo number_format($tot_stok_akhir,2); ?></td>
                        
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
        <div id="footer">
            <i>
                <?php echo date('d-m-Y H:i:s'); ?>
            </i>

        </div>
    </body>
</html>
