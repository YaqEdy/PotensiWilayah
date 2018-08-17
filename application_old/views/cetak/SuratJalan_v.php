<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>SUrat Jalan</title>
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
                        <td width="20%" align="left"><img src="<?php echo base_url(); ?>images/ski_header_report.jpg" width="94" height="75" alt=""/></td>
                        <td width="55%">
                            <div><h3>PT SUMBER KITA INDAH</h3></div>
                            <div>MM 2100 Industrial Town Blok LL 2,5 - Cibitung</div>
                            <div>Bekasi 17520 - INDONESIA</div>
                            <div>Phone : +62-21 8998 2903 Fax : +62-21 8898 2910</div>
                        </td>
                        <td width="25%"></td>

                    </tr>


                </tbody>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%">
                        <table  border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>No skep</td>
                                    <td width=7%> : </td>
                                    <td width=70%><?= $isidatamaster[0]->no_skep ?></td>
                                </tr>
                                <tr>
                                    <td>No pesanan</td>
                                    <td width=7%> : </td>
                                    <td width=70%><?= $isidatamaster[0]->no_po_cust ?></td>
                                </tr>
                                <tr>
                                    <td>No pengajuan</td>
                                    <td> : </td>
                                    <td><?= tgl_indo($isidatamaster[0]->no_aju) ?></td>
                                </tr>
                                <tr>
                                    <td>No pendaftaran</td>
                                    <td> : </td>
                                    <td><?= $isidatamaster[0]->no_cukai ?></td>
                                </tr>
                                <tr>
                                    <td>No surat jalan</td>
                                    <td> : </td>
                                    <td><?= $isidatamaster[0]->no_suratjalan ?></td>
                                </tr>
                                <tr>
                                    <td>No kendaraan</td>
                                    <td> : </td>
                                    <td><?= $isidatamaster[0]->no_mobil ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td>Tanggal</td>
                                    <td width=7%>:</td>
                                    <td width=60%><?= tgl_indo($isidatamaster[0]->tgl_trans) ?></td>
                                </tr>
                                <tr>
                                    <td>Kepada</td>
                                    <td >:</td>
                                    <td ><?= $isidatamaster[0]->nama_cust ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><u><?= $isidatamaster[0]->alamat ?></u></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan ="2"><hr /></td>
                </tr>
                
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td width="10%" align="left">Dengan ini kirim untuk beban dan resiko pemesan, barang-barang pesanan tersebut dibawah ini.</td>
                    </tr>
                    

                </tbody>
            </table>
            <p>&nbsp;</p>
            <table width="100%" border="1" cellspacing="0" cellpadding="4">
                <tbody>
                    <tr>
                        <th width="3%" >No</th>
                        <th width="50%" >Produk</th>
                        <th width="30%" >Packaging</th>
                        <th width="17%" >Jumlah</th>
                    </tr>
                    
                    <tr>
                        <td >1</td>
                        <td  align=""><?= $isidatamaster[0]->nama_produk ?></td>
                        <td  align="center"><?= $packaging[0] ?></td>
                        <td  align="right"><?= number_format($isidatamaster[0]->total_qty,2) ?></td>    
                    </tr>


                </tbody>
            </table>


            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <table width="100%" border="0" cellspacing="0" cellpadding="7">
                <tbody>
                    <tr>
                        <td width="10%" align="center"><hr>Penerima</td>
                        <td width="10%" align="center"><hr>Pengemudi</td>
                        
                        <td width="10%" align="center"><hr>Bag. Gudang</td>
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
