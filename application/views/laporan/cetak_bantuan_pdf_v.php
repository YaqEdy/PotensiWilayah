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
<!-- <style>
@media print {
    .popup {page-break-after: always;}
}
</style> -->

    <body>
    <center><h2>Report Bantuan</h2></center>

    <div class="popup">
    <br>
                <table width="100%" border=0>
                    <tr>
                        <td colspan=3 class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Jenis Bantuan
                                        </th>
                                        <th>
                                            Nama Instansi
                                        </th>
                                        <th>
                                            Nama Bantuan
                                        </th>
                                        <th>
                                            tgl Bantuan
                                        </th>
                                        <th>
                                            NIK
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Keterangan
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                            foreach ($data_bantuan as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->jns_bantuan; ?></td>
                                            <td><?php echo $row->nama_instansi; ?></td>
                                            <td><?php echo $row->nama_bantuan; ?></td>
                                            <td><?php echo $row->tgl_bantuan; ?></td>
                                            <td><?php echo $row->id_ktp; ?></td>
                                            <td><?php echo $row->nama_ktp; ?></td>
                                            <td><?php echo $row->ket; ?></td>
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