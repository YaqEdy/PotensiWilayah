<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>PO</title>
        <style type="text/css">

            .textborder {
                border: thin solid #000000;
            }
            @page { margin:20px 80px 25px 80px; font-family: "Courier New", Times, serif;}
            #header { position: fixed; left: 0px; top: -20px; right: 0px; height: 20px;  text-align: center; background-color:#fff; }
            #footer {  position: fixed; left: 0px; bottom: 0px; right: 0px; height: 35px;  text-align: left; background-color:#fff; }
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
                        <td width="70%">Purchase Order</td>

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
                                        <td width=70%><?= tgl_indo($isidatamaster[0]->tgl_trans) ?></td>
                                    </tr>
                                    <tr>
                                        <td>No doc</td>
                                        <td width=7%>:</td>
                                        <td width=70%><?= $isidatamaster[0]->id_master_in ?></td>
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td width="10%" align="left">Supplier</td>
                        <td width="5%">:</td>
                        <td width="30%" align="left"><?= $isidatamaster[0]->nama_spl ?></td>
                        <td width="">&nbsp;</td>
                        <td width="10%" align="left">No Batch</td>
                        <td width="5%">:</td>
                        <td width="20%" align="left"><?= $isidatamaster[0]->no_batch ?></td>
                    </tr>
                    <tr>
                        <td width="10%" align="left">Mobil</td>
                        <td width="5%">:</td>
                        <td width="30%" align="left"><?= $isidatamaster[0]->no_mobil . " - " . $isidatamaster[0]->nama_pengirim ?></td>
                        <td width="">&nbsp;</td>
                        <td width="10%" align="left">No Cukai</td>
                        <td width="5%">:</td>
                        <td width="20%" align="left"><?= $isidatamaster[0]->no_cukai ?></td>

                    </tr>

                </tbody>
            </table>
            <p>&nbsp;</p>
            <table width="100%" border="1" cellspacing="0" cellpadding="4">
                <tbody>
                    <tr>
                        <th width="3%" >No</th>
                        <th width="10%" >Produk</th>
                        <th width="10%" >Jumlah</th>
                        <th width="10%" >Keterangan</th>
                    </tr>
                    <?php
                    $i = 1;
                    $tot = 0;
                    foreach ($isidatatrans as $dat) {
                        ?>
                        <tr>
                            <td  align="center"><?php echo $i; ?></td>
                            <td  align="left"><?php echo $dat->nama_produk; ?></td>
                            <td  align="right"><?php echo number_format($dat->qty_rencana); ?></td>
                            <td  align="left"><?php echo $dat->keterangan_datang; ?></td>
                        </tr>
    <?php
    $i++;
    $tot = $tot + $dat->qty_rencana;
}
?>
                    <tr>
                        <td colspan="2" align="center">Total</td>

                        <td  align="right"><?php echo number_format($tot); ?></td>
                        <td></td>
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
                <?php  echo date('d-m-Y H:i:s');  ?>
            </i>

        </div>
    </body>
</html>
