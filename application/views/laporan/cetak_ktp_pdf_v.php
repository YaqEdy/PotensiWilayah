<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="<?php echo base_url('metronic/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
        <title>Report</title>
    </head>
    <body class="tabel">
                <table width="100%" border=0>
                    <tr>
                        <td width="20%">
                        <label>NIK</label>
                        </td>
                        <td width="50%">
                        <p><?php echo $data_ktp->id_ktp; ?></p>
                        </td>
                        <td rowspan="17" valign="top" style="text-align:center">
                            <img src="<?= site_url().$data_ktp->link_gambar; ?>" id="gambar_foto_ktp" alt="" />    
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Nama</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_ktp; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Tempat lahir</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->tempat_lahir; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Tanggal lahir</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->tanggal_lahir; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Alamat</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->alamat; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Rt</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->rt; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Rw</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->rw; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Kelurahan</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_kel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Kecamatan</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_kec; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Jenis kelamin</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_jekel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Gol darah</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->gol_darah; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Agama</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_agama; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Status kawin</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_nikah; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Pekerjaan</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_pekerjaan; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Difabel</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_difabel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Pendidikan</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_pend; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Hubungan keluarga</label>
                        </td>
                        <td>
                        <p><?php echo $data_ktp->nama_hub_kel; ?></p>
                        </td>
                    </tr>

                    <tr>
                        <td colspan=3>&nbsp;</td>
                    </tr>
                    <tr style="text-align:center">
                        <td colspan=3><h3><b>Komunitas</b></h3></td>
                    </tr>
                    <tr>
                        <td colspan=3 class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Jenis Komunitas
                                        </th>
                                        <th>
                                            Nama Komunitas
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($komunitas as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->nama_jeniskomunitas; ?></td>
                                            <td><?php echo $row->nama_komunitas; ?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>                        
                        </td>
                    </tr>

                    <tr>
                        <td colspan=3>&nbsp;</td>
                    </tr>
                    <tr style="text-align:center">
                        <td colspan=3><h3><b>Bantuan</b></h3></td>
                    </tr>
                    <tr>
                        <td colspan=3 class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Tanggal
                                        </th>
                                        <th>
                                            Nama instansi
                                        </th>
                                        <th>
                                            Nama Bantuan
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($bantuan as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->tgl_bantuan; ?></td>
                                            <td><?php echo $row->nama_instansi; ?></td>
                                            <td><?php echo $row->nama_bantuan; ?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>                        
                        </td>
                    </tr>


                </table>

    </body>
</html>
<!-- <script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script> -->
<script>
    window.print();
</script>