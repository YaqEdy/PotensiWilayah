<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelAdv td:nth-child(3) {
        text-align: right;
    }
</style>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pencil-square-o font-blue-chambray"></i>
                    <span class="caption-subject font-blue-chambray bold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="cetak();">
                        <i class="fa fa-print"></i> Cetak </a>
                    <a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;"
                       data-original-title="" title="">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                
                <form class="" role="form" method="post"
                      action="<?php echo base_url('transaksi/distribusi/home'); ?>" id="id_formAdvance">
                            <div class="row">
                                <div class="col-md-3 hidden">
                                    <div class="form-group">
                                        <label>Tanggal</label> 
                                        <input id="id_tgltrans" required="required"
                                               class="form-control input-sm date-picker" type="text"
                                               name="tglTrans" data-date-format="dd-mm-yyyy" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No SO : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->id_master_out; ?> </strong></span>
                                        <input id="id_idMaster"
                                               class="form-control input-sm hidden" type="text"
                                               name="idMaster" value="<?php echo $info_so[0]->id_master_out; ?>" />
                                    </div>
                                </div>
                                <!--end <div class="col-md-6"> 1 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Customer : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->nama_cust; ?> </strong></span>
                                    </div>     
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>No PO Customer : </label>
                                        <span class="help-block"><strong><?php echo $info_so[0]->no_po_cust; ?> </strong></span>
                                    </div>     
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Order : </label>
                                        <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->tgl_trans)); ?> </strong></span>
                                    </div>     
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tanggal Kirim : </label>
                                        <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->etd)); ?> </strong></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tgl Kedatangan : </label>
                                        <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->eta)); ?> </strong></span>
                                    </div>
                                </div>

                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelRincianSO">
                                            <thead>
                                                <tr>
                                                    <th width="7%" style="display:none;">
                                                        Kd Trans
                                                    </th>
                                                    <th width="7%" style="display:none;">
                                                        Kd Produk
                                                    </th>
                                                    <th width="7%"  style="display:none;">
                                                        Kd Storage
                                                    </th>
                                                    <th width="10%">
                                                        Produk
                                                    </th>
                                                    <th width="10%">
                                                        Storage
                                                    </th>
                                                    <th width="10%">
                                                        Jumlah
                                                    </th>
                                                    <th width="14%">
                                                        Keterangan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $totqty = 0;
                                                foreach ($rincian_so as $tr) {
                                                    ?> 
                                                    <tr class="listdata">
                                                        <td width="7%" style="display:none;">
                                                            <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_trans_out; ?>">
                                                        </td>
                                                        <td width="7%" style="display:none;">
                                                            <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_produk; ?>">
                                                        </td>
                                                        <td width="7%"  style="display:none;">
                                                            <input type="text" class="form-control input-sm"  readonly="true" value="<?php echo $tr->id_storage; ?>">
                                                        </td>
                                                        <td width="10%">
                                                            <?php echo $tr->nama_produk; ?>
                                                        </td>
                                                        <td width="10%">
                                                            <?php echo $tr->nama_storage; ?>
                                                        </td>
                                                        <td width="10%" align="right">
                                                            <?php echo number_format($tr->qty_rencana, 2); ?>
                                                        </td>
                                                        <td width="14%">
                                                            <?php echo $tr->keterangan; ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    $totqty = $totqty + $tr->qty_rencana;
                                                }
                                                ?>    
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" style="display:none;"></td>
                                                    <td colspan="2" ><strong>Total</strong></td>
                                                    <td align="right"><?php echo number_format($totqty, 2); ?></td>
                                                    <td colspan="1"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <input type="text" id="idTxtTempLoop" name="txtTempLoop" class="form-control nomor1 hidden">
                                        <a href="#" class="btn green-haze btn-sm" data-target="#idDivInputProduk"
                                           id="id_btnModalTambah" data-toggle="modal">
                                            <i class="fa fa-plus fa-fw"/></i>&nbsp;Tambah
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class="table table-striped table-hover table-bordered" id="id_tabelRincianPack">
                                            <thead>
                                                <tr>
                                                    <th width="10%">
                                                        Driver
                                                    </th>
                                                    <th width="10%">
                                                        Mobil
                                                    </th>
                                                    <th width="5%" style="display:none;">
                                                        Kd Jenis Mobil
                                                    </th>
                                                    <th width="10%">
                                                        Jenis Mobil
                                                    </th>
                                                    <th width="5%" style="display:none;">
                                                        Kode Jenis Segel
                                                    </th>
                                                    <th width="10%">
                                                        Jenis Segel
                                                    </th>
                                                    <th width="5%" style="display:none;">
                                                        Kd Jenis Sewa
                                                    </th>
                                                    <th width="10%">
                                                        Kepemilikan
                                                    </th>
                                                    <th width="5%">
                                                        Keterangan
                                                    </th>
                                                    <th width="5%">
                                                        Act
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data">

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions ">
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button name="btnUbah" class="btn yellow" id="id_btnUbah">
                                            <!--<i class="fa fa-check"></i>--> Ubah
                                        </button>
                                        <a href="<?php echo base_url('transaksi/distribusi/home'); ?>" id="id_btnBatal"  class="btn default">Batal</a>
                                    </div>
                                </div>
                            </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->
                        
                        
                        

                </form>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
    <!-- end <div class="col-md-6"> -->
    <!--
    <div class="col-md-6">
    </div>
    -->
    <!-- end <div class="col-md-6"> -->
</div>
<div class="modal fade" id="idDivInputProduk"  role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data distribusi yang digunakan</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:250px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama driver mobil</label> 
                                            <input id="id_namaPengirim" required="required" class="form-control input-sm kosongTextDetail"
                                                   type="text" name="namaPengirim"  />    
                                        </div>
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Mobil</label>
                                            <input id="id_noMobil" required="required" class="form-control input-sm kosongTextDetail"
                                                   type="text" name="noMobil" />
                                        </div>     
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Mobil</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($jnsmobil as $row) :
                                                $data[$row['id_jnsmobil']] = $row['nama_jnsmobil'];
                                            endforeach;
                                            echo form_dropdown('jnsmobil', $data, '', 'id="id_jnsMobil" class="form-control select2me kosongDetail"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Segel</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($jnssegel as $row) :
                                                $data[$row['id_jnssegel']] = $row['nama_jnssegel'];
                                            endforeach;
                                            echo form_dropdown('jnssegel', $data, '', 'id="id_jnsSegel" class="form-control select2me kosongDetail"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sewa/tidak</label>
                                                    <select name="jnsmobilsw" class="form-control kosongTextDetail" id="id_jnsMobilSw">
                                                        <option value=""></option>
                                                        <option value="0">Milik sendiri</option>
                                                        <option value="1">Sewa</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm kosongTextDetail"></textarea>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn blue" data-dismiss="modal" id="id_btnAddCpa"><i class="fa fa-plus"></i>&nbsp; Tambah</button>
                <button type="button" class="btn default" data-dismiss="modal" id="id_btnBatalCpa"><i class="fa fa-times"></i>&nbsp;Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- END PAGE CONTENT-->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script> 
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/datatable.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/datatables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootbox/bootbox.min.js'); ?>" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<?php include "app.min.inc.php"; ?>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/layout.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/layouts/layout4/scripts/demo.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script>

                        App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
                            UIBootbox.init();
                            ComponentsDateTimePickers.init();
                            ComponentsSelect2.init();
                            $("input[readonly='true']").focus(function () {
                                $(this).next();
                            });
                            //status terdistribusi atau belum
                            var status = "<?php echo $status; ?>";
                            var noSO = "<?php echo $noSO; ?>";
                            if (status == 1) {
                                getDataDistribusi(noSO);
                                $('#id_btnSimpan').attr('disabled', true);
                                $('#id_btnUbah').attr("disabled", false);
                            } else {
                                $('#id_btnSimpan').attr('disabled', false);
                                $('#id_btnUbah').attr("disabled", true);
                            }
                            //
                        });
                        $(document).keyup(function (e) {
                            if (e.which === 36) {
                                $('#id_btnModalTambah').trigger('click');
                            } else if (e.which == 35) {
                                $('#id_btnAddCpa').trigger('click');
                            }
                        });


                        //Ready Doc
                        btnStart();
                        readyToStart();
                        tglTransStart();
                        $("#id_tgltrans").focus();

                        $('#id_btnBatal').click(function () {
                            btnStart();
                            resetForm();
                            readyToStart();
                            tglTransStart();
                            $('#id_body_data').empty();
                        });

                        function kosongDetail() {
                            $('.kosongTextDetail').val('');
                            $('.kosongDetail').select2("val", "");
                            $('#id_jnsSegel').select2("val", "");
                            //$('.kosongNomorDetail').val('0.00');
                            //$('.kosongNomor1Detail').val('0');
                        }
                        //style="display:none;"
                        $('#id_btnAddCpa').click(function () {
                            var i = $('#idTxtTempLoop').val();
                            if ($('#id_namaPengirim').val() == '' || $('#id_noMobil').val() == '') {
                                alert("Driver atau nomor mobil tidak boleh kosong.");
                            } else {
                                var i = parseInt($('#idTxtTempLoop').val());
                                i = i + 1;
                                var driver = $('#id_namaPengirim').val().trim();
                                var noMobil = $('#id_noMobil').val().trim();
                                var jnsMobil = $('#id_jnsMobil').val();
                                var txtJnsMobil = $('#id_jnsMobil option:selected').text();
                                var jnsSegel = $('#id_jnsSegel').val();
                                var txtJnsSegel = $('#id_jnsSegel option:selected').text();
                                var jnsMobilSw = $('#id_jnsMobilSw').val();
                                var txtJnsMobilSw = $('#id_jnsMobilSw option:selected').text();
                                var ket = $('#id_keteranganCPA').val().trim();

                                tr = '<tr class="listdata" id="tr' + i + '">';
                                tr += '<td ><input type="text" class="form-control input-sm" id="id_tempDriver' + i + '" name="tempDriver' + i + '" readonly="true" value="' + driver + '"></td>';
                                tr += '<td ><input type="text" class="form-control input-sm" id="id_tempNoMobil' + i + '" name="tempNoMobil' + i + '" readonly="true" value="' + noMobil + '" ></td>';
                                tr += '<td style="display:none;"><input  type="text" class="form-control input-sm" id="id_tempJnsMobil' + i + '" name="tempJnsMobil' + i + '" readonly="true" value="' + jnsMobil + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsMobil' + i + '" name="tempTxtJnsMobil' + i + '" readonly="true" value="' + txtJnsMobil + '" ></td>';
                                tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempJnsSegel' + i + '" name="tempJnsSegel' + i + '" readonly="true" value="' + jnsSegel + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsSegel' + i + '" name="tempTxtJnsSegel' + i + '" readonly="true" value="' + txtJnsSegel + '" ></td>';
                                tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempJnsMobilSw' + i + '" name="tempJnsMobilSw' + i + '" readonly="true" value="' + jnsMobilSw + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsMobilSw' + i + '" name="tempTxtJnsMobilSw' + i + '" readonly="true" value="' + txtJnsMobilSw + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
                                tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
                                tr += '</tr>';

                                $('#id_body_data').append(tr);
                                $('#idTxtTempLoop').val(i);
                                kosongDetail();
                            }
                        });
                        function hapusBaris(noRow) {
                            if (document.getElementById(noRow) != null) {
                                $('#' + noRow).remove();
                            }
                        }

                        $('#id_btnBatalCpa').click(function () {
                            kosongDetail();
                        });
                        function getDataDistribusi(noSO) {
                            ajaxModal();
                            if (noSO != '') {
                                $.post("<?php echo site_url('/transaksi/distribusi/getDataDistribusi'); ?>",
                                        {
                                            'noSO': noSO
                                        }, function (data) {
                                    if (data.data_cpa.length > 0) {
                                        $('#idTxtTempLoop').val(data.data_cpa.length);
                                        for (i = 0; i < data.data_cpa.length; i++) {
                                            var x = i + 1;
                                            //var idCpa           = data.data_cpa[i].id_cpa;
                                            var driver = data.data_cpa[i].nama_pengirim;
                                            var noMobil = data.data_cpa[i].no_mobil;
                                            var jnsMobil = data.data_cpa[i].id_jnsmobil;
                                            var txtJnsMobil = data.data_cpa[i].nama_jnsmobil;
                                            var jnsSegel = data.data_cpa[i].id_jnssegel;
                                            var txtJnsSegel = data.data_cpa[i].nama_jnssegel;
                                            var jnsMobilSw = data.data_cpa[i].id_jnsmobilsewa;
                                            //var txtJnsMobilSw = "";//data.data_cpa[i].nama_jnsmobilsw;
                                            if (jnsMobilSw == '0') {
                                                var txtJnsMobilSw = "Milik Sendiri";
                                            } else {
                                                var txtJnsMobilSw = "Sewa";
                                            }
                                            var ket = data.data_cpa[i].keterangan;

                                            tr = '<tr class="listdata" id="tr' + i + '">';
                                            tr += '<td ><input type="text" class="form-control input-sm" id="id_tempDriver' + i + '" name="tempDriver' + i + '" readonly="true" value="' + driver + '"></td>';
                                            tr += '<td ><input type="text" class="form-control input-sm" id="id_tempNoMobil' + i + '" name="tempNoMobil' + i + '" readonly="true" value="' + noMobil + '" ></td>';
                                            tr += '<td style="display:none;"><input  type="text" class="form-control input-sm" id="id_tempJnsMobil' + i + '" name="tempJnsMobil' + i + '" readonly="true" value="' + jnsMobil + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsMobil' + i + '" name="tempTxtJnsMobil' + i + '" readonly="true" value="' + txtJnsMobil + '" ></td>';
                                            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempJnsSegel' + i + '" name="tempJnsSegel' + i + '" readonly="true" value="' + jnsSegel + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsSegel' + i + '" name="tempTxtJnsSegel' + i + '" readonly="true" value="' + txtJnsSegel + '" ></td>';
                                            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempJnsMobilSw' + i + '" name="tempJnsMobilSw' + i + '" readonly="true" value="' + jnsMobilSw + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtJnsMobilSw' + i + '" name="tempTxtJnsMobilSw' + i + '" readonly="true" value="' + txtJnsMobilSw + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
                                            tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
                                            tr += '</tr>';

                                            $('#id_body_data').append(tr);
                                        }
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        //alert('Data tidak ditemukan!');
                                        //$('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function ajaxSubmitAdvance() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/distribusi/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr('disabled', true);
                                    $('#id_btnUbah').attr("disabled", false);
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);

                                }

                            });

                        }
                        function ajaxUbah() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/distribusi/ubah",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr('disabled', true);
                                    $('#id_btnUbah').attr("disabled", false);
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });

                        }

                        $('#id_formAdvance').submit(function (event) {
                            dataString = $("#id_formAdvance").serialize();
                            var jmlCpa = $('#idTxtTempLoop').val();
                            if (jmlCpa == 0) {
                                //alert("Masukkan DATA MObil!");
                                bootbox.alert("Masukkan Data Mobil dan Sopir");
                                return false;
                            }
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            if (aksiBtn == '1') {
                                bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                                    if (o == true) {
                                        ajaxSubmitAdvance();
                                    }
                                });
                                /*
                                var r = confirm('Anda yakin menyimpan data ini?');
                                if (r == true) {
                                    ajaxSubmitAdvance();
                                } else {//if(r)
                                    return false;
                                }
                                */
                            } else if (aksiBtn == '2') {
                                bootbox.confirm("Apakah anda yakin ubah data ini?", function (o) {
                                    if (o == true) {
                                        ajaxUbah();
                                    }
                                });
                            }
                            event.preventDefault();

                        });
                        /*
                         * $("#id_btnSimpan").click(function () {
                         $('#idTmpAksiBtn').val('1');
                         });
                         
                         */


</script>


<!-- END JAVASCRIPTS -->