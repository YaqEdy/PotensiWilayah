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

    <body>
    <center><h2>Form Data Personal</h2></center>

    <div class="popup">
    <br>
                <table width="100%" border=0>

                    <tr>
                        <td colspan=3 class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No KK</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Tempat Lahir</th>
                                        <th>Tgl Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Gol Darah</th>
                                        <th>Pendidikan</th>
                                        <th>Alamat</th>
                                        <th>Rt</th>
                                        <th>Rw</th>
                                        <th>Kelurahan</th>
                                        <th>Kecamatan</th>
                                        <th>Pekerjaan</th>
                                        <th>Difabel</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($data_kk as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->id_master_kk; ?></td>
                                            <td><?php echo $row->id_ktp; ?></td>
                                            <td><?php echo $row->nama_ktp; ?></td>
                                            <td><?php echo $row->tempat_lahir; ?></td>
                                            <td><?php echo $row->tanggal_lahir; ?></td>
                                            <td><?php echo $row->nama_jekel; ?></td>
                                            <td><?php echo $row->nama_agama; ?></td>
                                            <td><?php echo $row->gol_darah; ?></td>
                                            <td><?php echo $row->nama_pend; ?></td>
                                            <td><?php echo $row->alamat; ?></td>
                                            <td><?php echo $row->rt; ?></td>
                                            <td><?php echo $row->rw; ?></td>
                                            <td><?php echo $row->nama_kel; ?></td>
                                            <td><?php echo $row->nama_kec; ?></td>
                                            <td><?php echo $row->nama_pekerjaan; ?></td>
                                            <td><?php echo $row->nama_difabel; ?></td>
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

    </div>

    </body>
</html>
<!-- <script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script> -->
<script>
    window.print();
</script>