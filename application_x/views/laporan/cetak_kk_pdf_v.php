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
    <center><h2>Report Data Keluarga</h2></center>

    <div class="popup">
    <br>
                <table width="100%" border=0>
                    
                    <tr>
                        <td width="20%">
                        <label>No KK</label>
                        </td>
                        <td>
                        <p><?php echo $data_kk->id_master_kk; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <label>Alamat</label>
                        </td>
                        <td>
                        <p><?php echo $data_kk->alamat; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <label>Rt</label>
                        </td>
                        <td>
                        <p><?php echo $data_kk->rt; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <label>Rw</label>
                        </td>
                        <td>
                        <p><?php echo $data_kk->rw; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <label>Kelurahan</label>
                        </td>
                        <td>
                        <p><?php echo $data_kk->nama_kel; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">
                        <label>Kecamatan</label>
                        </td>
                        <td>
                        <p><?php echo $data_kk->nama_kec; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=3>&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan=3 class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Nik
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Tempat Lahir
                                        </th>
                                        <th>
                                            Tgl Lahir
                                        </th>
                                        <th>
                                            Jenis Kelamin
                                        </th>
                                        <th>
                                            Agama
                                        </th>
                                        <th>
                                            Hubungan Keluarga
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        // $query = $this->db->query("SELECT * from trans_kk where id_master_kk='".$data_kk->id_master_kk."'");
                                        // $ktp= $query->result();
                                        // foreach ($ktp as $row1) {
                                        //     $query2 = $this->db->query("SELECT * from vw_komunitas where id_ktp='".$row1->id_ktp."'");
                                        //     $komunitas= $query2->result();
                                            foreach ($data_kk2 as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->id_ktp; ?></td>
                                            <td><?php echo $row->nama_ktp; ?></td>
                                            <td><?php echo $row->tempat_lahir; ?></td>
                                            <td><?php echo $row->tanggal_lahir; ?></td>
                                            <td><?php echo $row->nama_jekel; ?></td>
                                            <td><?php echo $row->nama_agama; ?></td>
                                            <td><?php echo $row->nama_hub_kel; ?></td>
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
                                        <th>
                                            NIK
                                        </th>
                                        <th>
                                            Nama
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = $this->db->query("SELECT * from trans_kk where id_master_kk='".$data_kk->id_master_kk."'");
                                        $ktp= $query->result();
                                        foreach ($ktp as $row1) {
                                            $query2 = $this->db->query("SELECT * from vw_komunitas where id_ktp='".$row1->id_ktp."'");
                                            $komunitas= $query2->result();
                                            foreach ($komunitas as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->nama_jeniskomunitas; ?></td>
                                            <td><?php echo $row->nama_komunitas; ?></td>
                                            <td><?php echo $row->id_ktp; ?></td>
                                            <td><?php echo $row->nama_ktp; ?></td>
                                        </tr>
                                    <?php
                                        }
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
                                        <th>
                                            NIK
                                        </th>
                                        <th>
                                            Nama
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = $this->db->query("SELECT * from trans_kk where id_master_kk='".$data_kk->id_master_kk."'");
                                        $ktp= $query->result();
                                        foreach ($ktp as $row1) {
                                            $query = $this->db->query("SELECT * from vw_t_bantuan where id_ktp='".$row1->id_ktp."'");
                                            $bantuan= $query->result();
                                            foreach ($bantuan as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row->tgl_bantuan; ?></td>
                                            <td><?php echo $row->nama_instansi; ?></td>
                                            <td><?php echo $row->nama_bantuan; ?></td>
                                            <td><?php echo $row->id_ktp; ?></td>
                                            <td><?php echo $row->nama_ktp; ?></td>
                                        </tr>
                                    <?php
                                        }
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