<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Laporan Kedatangan</title>
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
                        <td width="30%" align="left"><img src="<?php echo base_url(); ?>images/ski_header_report.jpg" width="64" height="50" alt=""/></td>
                        <td width="70%" align="" class="judul"><?php echo $header; ?></td>

                    </tr>
                    <tr>
                        <td width="30%" align="left">&nbsp;</td>
                        <td width="70%" align="" >Tanggal : <?php echo $tglAwal; ?> sampai <?php echo $tglAkhir; ?></td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
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
                        <td colspan ="2"><hr /></td>
                    </tr>
                </tbody>
            </table>

            <p>&nbsp;</p>
            <table width="100%" border="1" cellspacing="0" cellpadding="4">
                <tbody>
                    <tr class="cls_tr_header">
                        <th width="3%" >No</th>
                        <th width="10%" >Tanggal</th>
                        <th width="10%" >Suplier</th>
                        <th width="10%" >No PO</th>
                        <th width="10%" >No Cukai</th>
                        <th width="10%" >Qty</th>
                    </tr>
                    
                    <?php
                    $i = 1;
                    $total = 0;
                    
                    foreach ($po as $dat) {
                        $tgl = date("d-m-Y", strtotime($dat->tgl_trans));
                        ?>
                        <tr class="cls_tr_isi">
                            <td  align="center"><?php echo $i; ?></td>
                            <td  align="left"><?php echo $tgl; ?></td>
                            <td  align="left"><?php echo $dat->nama_spl; ?></td>
                            <td  align="right"><?php echo $dat->no_po; ?></td>
                            <td  align="right"><?php echo $dat->no_cukai; ?></td>
                            <td  align="right"><?php echo number_format($dat->total_qty); ?></td>
                        </tr>
                        <?php
                        $i++;
                        $total = $total + $dat->total_qty;
                    }
                    //$tot_saldo_awal = $tot_saldo_awal + $dat->saldo_awal;
                    ?>
                    <tr class="cls_tr_footer">
                        <td colspan="5" align="center"><strong>Total</strong></td>
                        
                        <td align="right"><?php echo number_format($total, 2); ?></td>
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