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
<style>
@media print {
    .popup {page-break-after: always;}
}
</style>

    <body>
    <center><h2>Form Data Personal</h2></center>
    <?php 
        foreach ($data_kk as $kk) {
    ?>

    <div class="popup">
    <br>
                <table width="100%" border=0>
                    
                    <tr>
                        <td width="20%">
                        <label>NIK</label>
                        </td>
                        <td width="50%">
                        <p><?php echo $kk->id_ktp; ?></p>
                        </td>
                        <!-- <td rowspan="17" valign="top" style="text-align:center">
                            <img src="<?= site_url().$kk->link_gambar; ?>" id="gambar_foto_ktp" alt="" style="border: 1px #000  solid; padding: 15px;"/>    
                        </td> -->
                    </tr>
                    <tr>
                        <td>
                        <label>Nama</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_ktp; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Tempat lahir</label>
                        </td>
                        <td>
                        <p><?php echo $kk->tempat_lahir; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Tanggal lahir</label>
                        </td>
                        <td>
                        <p><?php echo $kk->tanggal_lahir; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Alamat</label>
                        </td>
                        <td>
                        <p><?php echo $kk->alamat; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Rt</label>
                        </td>
                        <td>
                        <p><?php echo $kk->rt; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Rw</label>
                        </td>
                        <td>
                        <p><?php echo $kk->rw; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Kelurahan</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_kel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Kecamatan</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_kec; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Jenis kelamin</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_jekel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Gol darah</label>
                        </td>
                        <td>
                        <p><?php echo $kk->gol_darah; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Agama</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_agama; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Status kawin</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_nikah; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Pekerjaan</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_pekerjaan; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Difabel</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_difabel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Pendidikan</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_pend; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <label>Hubungan keluarga</label>
                        </td>
                        <td>
                        <p><?php echo $kk->nama_hub_kel; ?></p>
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
                                        $query = $this->db->query("SELECT * from vw_komunitas where id_ktp='".$kk->id_ktp."'");
                                        $komunitas= $query->result();
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
                                        $query = $this->db->query("SELECT * from vw_t_bantuan where id_ktp='".$kk->id_ktp."'");
                                        $bantuan= $query->result();
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

    </div>
    <?php
        }
    ?>

    </body>
</html>
<!-- <script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script> -->
<script>
    window.print();
</script>