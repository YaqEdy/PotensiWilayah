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
                      action="<?php echo base_url('transaksi/packaging/home'); ?>" id="id_formAdvance">


                    <div class="row">
                        <div class="col-md-3 hidden">
                            <div class="form-group ">
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
                                <input id="id_statusPack"
                                       class="form-control input-sm hidden" type="text"
                                       name="statusPack"/>
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
                                <label>Tgl Jatuh Tempo : </label>
                                <span class="help-block"><strong><?php echo date('d-m-Y', strtotime($info_so[0]->eta)); ?> </strong></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis doc : </label>
                                <span class="help-block"><strong><?php echo $info_so[0]->nama_jnsdoc; ?> </strong></span>
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
                                <table class="table table-striped table-hover table-bordered" id="id_tabelRincianSO">
                                    <thead>
                                        <tr>
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
                                            <th width="2%">
                                                Act
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="id_body_data">

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="display:none;"></td>
                                            <td colspan="2" ><strong>Total</strong></td>
                                            <td ><input type="text" readonly="true" class="form-control input-sm nomor" id="id_totalKg" name="totalKg"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- HIDDEN INPUT -->
                    <input type="text" id="idTmpAksiBtn" class="hidden">
                    <!-- END HIDDEN INPUT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mt-checkbox-list">
                                <label class="mt-checkbox mt-checkbox-outline"> Packaging Mobil
                                    <input  name="packMobil" type="checkbox" id="id_packMobil">
                                    <span></span>
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Packaging</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($produk as $row) :
                                    $data[$row['id_produk']] = $row['nama_produk'];
                                endforeach;
                                echo form_dropdown('produk', $data, '', 'required id="id_produk" class="form-control select2me  disablePack"');
                                ?>
                                <input id="id_produkSbl" class="form-control input-sm hidden"
                                       type="text" name="produkSbl" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Storage</label>
                                <?php
                                $data = array();
                                $data[''] = '';
                                foreach ($storage as $row) :
                                    $data[$row['id_storage']] = $row['nama_storage'];
                                endforeach;
                                echo form_dropdown('storage', $data, '', 'required id="id_storage" class="form-control select2me disablePack" disabled');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jumlah (Packsize 1)</label>
                                        <input id="id_produkKg" class="form-control input-sm nomor  cls_hitungTotalHarga disablePack"
                                               type="text" name="produkKg" placeholder="" required/>
                                        <input id="id_produkKgSbl" class="form-control input-sm nomor hidden "
                                               type="text" name="produkKgSbl" placeholder=""/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm  disablePack"></textarea>
                                    </div>
                                </div>
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
                                <a href="<?php echo base_url('transaksi/packaging/home'); ?>" id="id_btnBatal" type="button" class="btn default">Batal</a>
                            </div>
                        </div>
                    </div>


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
<div class="modal fade draggable-modal" id="idDivInputProduk" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data produk yang keluar</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:250px; ">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Produk</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($produk_kirim as $row) :
                                                $data[$row['id_produk']] = $row['nama_produk'];
                                            endforeach;
                                            echo form_dropdown('produk_kirim', $data, '', 'id="id_produk_kirim" class="form-control select2me kosongDetail"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Storage</label>
                                            <?php
                                            $data = array();
                                            $data[''] = '';
                                            foreach ($storage as $row) :
                                                $data[$row['id_storage']] = $row['nama_storage'];
                                            endforeach;
                                            echo form_dropdown('storage_kirim', $data, '', 'id="id_storage_kirim" class="form-control select2me kosongDetail" disabled');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Jumlah produk (Packsize 1)</label>
                                                    <input id="id_produk_kirimKg" class="form-control input-sm nomor kosongNomorDetail cls_hitungTotalHarga"
                                                           type="text" name="produk_kirimKg" placeholder=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea rows="2" cols="" name="keteranganCPA"  id="id_keteranganCPA" class="form-control input-sm kosongDetail"></textarea>
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
                            $('#id_packMobil').change(function () {
                                packMobil();
                            });
                            $("input[readonly='true']").focus(function () {
                                $(this).next();
                            });
                            $("#id_statusPack").val("<?php echo $status; ?>");
                            var status = $("#id_statusPack").val();
                            var noSO = "<?php echo $noSO; ?>";
                            //$('#id_storageProduk').select2('val', "<?php //echo $rincian_so[0]->id_storage;      ?>");
                            getProdukKirim(noSO);
                            if (status == 1) {
                                getDataPack(noSO);
                                $('#id_btnSimpan').attr('disabled', true);
                                $('#id_btnUbah').attr("disabled", false);
                            } else {
                                $('#id_btnSimpan').attr('disabled', false);
                                $('#id_btnUbah').attr("disabled", true);
                            }
                        });
                        $(document).keyup(function (e) {
                            if (e.which === 36) {
                                $('#id_btnModalTambah').trigger('click');
                            } else if (e.which == 35) {
                                $('#id_btnAddCpa').trigger('click');
                            }
                        });
                        function packMobil(){
                            $('#id_packMobil').each(function () {
                                    var checked = $(this).is(":checked");
                                    if (checked) {
                                        $('#id_packMobil').val('1');
                                        $('.disablePack').attr('disabled', true);
                                        $('#id_produk').select2('val', '');//val('1');
                                        $('#id_storage').select2('val', '');
                                        $('#id_produkKg').val('0.00');
                                    } else {
                                        $('.disablePack').attr('disabled', false);
                                        $('#id_packMobil').val('0');
                                    }
                                });
                        }

                        //Ready Doc
                        btnStart();
                        readyToStart();
                        tglTransStart();
                        $("#id_tgltrans").focus();

                        $("#id_btnSimpan").click(function () {
                            $('#idTmpAksiBtn').val('1');
                        });

                        $("#id_btnModalTambah").click(function () {
                            $("#id_produk_kirim").select2('val', '');
                            $("#id_storage_kirim").select2('val', '');
                        });


                        function getDataPack(noSO) {
                            ajaxModal();
                            if (noSO != '') {
                                $.post("<?php echo site_url('/transaksi/packaging/getDataPack'); ?>",
                                        {
                                            'noSO': noSO
                                        }, function (data) {
                                    if (data.baris > 0) {
                                        $('#id_produk').select2("val", data.id_produk);
                                        $('#id_produkSbl').val(data.id_produk);
                                        $('#id_storage').select2("val", data.id_storage);
                                        $('#id_produkKg').val(number_format(data.qty, 2));
                                        $('#id_produkKgSbl').val(number_format(data.qty, 2));
                                        $('#id_keteranganCPA').val(data.keterangan);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        //$("#id_packMobil").trigger('click');
                                         $("#id_packMobil").prop("checked", true);
                                        $('#id_packMobil').val('1');
                                        packMobil();
                                        //alert('Data tidak ditemukan!');
                                        //$('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function getRincianSO(noSO) {
                            ajaxModal();
                            if (noSO != '') {
                                $.post("<?php echo site_url('/transaksi/packaging/getRincianSO'); ?>",
                                        {
                                            'noSO': noSO
                                        }, function (data) {
                                    if (data.baris > 0) {
                                        $('#id_produk').select2("val", data.id_produk);
                                        $('#id_produkSbl').val(data.id_produk);
                                        $('#id_storage').select2("val", data.id_storage);
                                        $('#id_produkKg').val(number_format(data.qty, 2));
                                        $('#id_produkKgSbl').val(number_format(data.qty, 2));
                                        $('#id_keteranganCPA').val(data.keterangan);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                        //$('#id_btnBatal').trigger('click');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        function kosongDetail() {
                            $('.kosongTextDetail').text('');
                            $('.kosongDetail').select2("val", "");
                            $('.kosongNomorDetail').val('0.00');
                            $('.kosongNomor1Detail').val('0');
                        }
                        function getProdukKirim(idMaster) {
                            ajaxModal();
                            if (idMaster != '') {
                                $.post("<?php echo site_url('transaksi/packaging/getProdukKirim'); ?>",
                                        {
                                            'idMaster': idMaster
                                        }, function (data) {
                                    if (data.data_cpa.length > 0) {
                                        $('#idTxtTempLoop').val(data.data_cpa.length);
                                        for (i = 0; i < data.data_cpa.length; i++) {
                                            var x = i + 1;

                                            var kdProduk = data.data_cpa[i].id_produk;
                                            var txtProduk = data.data_cpa[i].nama_produk;
                                            var kdStorage = data.data_cpa[i].id_storage;
                                            var txtStorage = data.data_cpa[i].nama_storage;
                                            var kg = data.data_cpa[i].qty_rencana;
                                            var ket = data.data_cpa[i].keterangan;
                                            tr = '<tr class="listdata" id="tr' + x + '">';
                                            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + x + '" name="tempKdProduk' + x + '" readonly="true" value="' + kdProduk + '"></td>';
                                            tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdStorage' + x + '" name="tempKdStorage' + x + '" readonly="true" value="' + kdStorage + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + x + '" name="tempTxtProduk' + x + '" readonly="true" value="' + txtProduk + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtStorage' + x + '" name="tempTxtStorage' + x + '" readonly="true" value="' + txtStorage + '" ></td>';
                                            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + x + '" name="tempKg' + x + '" readonly="true" value="' + kg + '" ></td>';
                                            tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + x + '" name="tempKet' + x + '" readonly="true" value="' + ket + '"></td>';
                                            tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + x + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
                                            tr += '</tr>';

                                            jmlKg = parseFloat(CleanNumber(kg));
                                            var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));
                                            var total_kg = jmlKg + totalKg;
                                            $('#id_totalKg').val(number_format(total_kg, 2));
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
                        $('#id_btnAddCpa').click(function () {
                            var i = $('#idTxtTempLoop').val();
                            if ($('#id_produk_kirim').val() == '' || $('#id_storage_kirim').val() == '') {
                                alert("Produk atau storage tidak boleh kosong.");
                            } else {
                                var i = parseInt($('#idTxtTempLoop').val());
                                i = i + 1;
                                var kdProduk = $('#id_produk_kirim').val();
                                var txtProduk = $('#id_produk_kirim option:selected').text();
                                var kdStorage = $('#id_storage_kirim').val();
                                var txtStorage = $('#id_storage_kirim option:selected').text();
                                var kg = $('#id_produk_kirimKg').val();
                                var ket = $('#id_keteranganCPA').val().trim();
                                tr = '<tr class="listdata" id="tr' + i + '">';
                                tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdProduk' + i + '" name="tempKdProduk' + i + '" readonly="true" value="' + kdProduk + '"></td>';
                                tr += '<td style="display:none;"><input type="text" class="form-control input-sm" id="id_tempKdStorage' + i + '" name="tempKdStorage' + i + '" readonly="true" value="' + kdStorage + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtProduk' + i + '" name="tempTxtProduk' + i + '" readonly="true" value="' + txtProduk + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempTxtStorage' + i + '" name="tempTxtStorage' + i + '" readonly="true" value="' + txtStorage + '" ></td>';
                                tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKg' + i + '" name="tempKg' + i + '" readonly="true" value="' + kg + '" ></td>';
                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
                                tr += '<td><a href="#" class="btn red btn-sm" onclick="hapusBaris(\'tr' + i + '\')"><i class="fa fa-minus fa-fw"/></i></a></td>';
                                tr += '</tr>';

                                jmlKg = parseFloat(CleanNumber(kg));

                                var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));

                                var total_kg = jmlKg + totalKg;

                                $('#id_totalKg').val(number_format(total_kg, 2));

                                $('#id_body_data').append(tr);
                                $('#idTxtTempLoop').val(i);
                                kosongDetail();
                            }
                        });
                        function hapusBaris(noRow) {
                            if (document.getElementById(noRow) != null) {

                                var totalKg = parseFloat(CleanNumber($('#id_totalKg').val()));

                                var jmlKgOld = $('#' + noRow).find("td input").eq(4).val();
                                jmlKgOld = parseFloat(CleanNumber(jmlKgOld));

                                totalKg = totalKg - jmlKgOld;

                                $('#id_totalKg').val(number_format(totalKg, 2));

                                $('#' + noRow).remove();
                            }
                        }
                        function getDescStorage(idStorage) {
                            ajaxModal();
                            if (idStorage != '') {
                                $.post("<?php echo site_url('transaksi/packaging/getDescStorage'); ?>",
                                        {
                                            'idStorage': idStorage
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_jnsStorage').val(data.nama_jns_storage);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }

                        function ajaxSubmitAdvance() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>transaksi/packaging/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr('disabled', true);
                                    $('#id_btnUbah').attr("disabled", false);

                                    var prod = $('#id_produk').select2("val");
                                    $('#id_produkSbl').val(prod);
                                    var prodKg = $('#id_produkKg').val();
                                    $('#id_produkKgSbl').val(prodKg);
                                    $("#id_statusPack").val('1');
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
                                url: "<?php echo base_url(); ?>transaksi/packaging/ubah",
                                data: dataString,
                                success: function (data) {
                                    $('#id_btnSimpan').attr('disabled', true);
                                    $('#id_btnUbah').attr("disabled", false);
                                    var prod = $('#id_produk').select2("val");
                                    $('#id_produkSbl').val(prod);
                                    var prodKg = $('#id_produkKg').val();
                                    $('#id_produkKgSbl').val(prodKg);
                                    //readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });

                        }
                        $('#id_formAdvance').submit(function (event) {
                            dataString = $("#id_formAdvance").serialize();
                            var aksiBtn = $('#idTmpAksiBtn').val();
                            $('#id_storage').attr('disabled', false);
                            if (aksiBtn == '1') {
                                bootbox.confirm("Apakah anda yakin menyimpan data ini?", function (o) {
                                    if (o == true) {
                                        ajaxSubmitAdvance();
                                    }
                                });
                            } else if (aksiBtn == '2') {
                                bootbox.confirm("Apakah anda yakin ubah data ini?", function (o) {
                                    if (o == true) {
                                        ajaxUbah();
                                    }
                                });
                            }
                            event.preventDefault();
                            $('#id_storage').attr('disabled', true);

                        });
                        $("#id_produk_kirim").change(function () {
                            var idProduk = $(this).val();
                            if(idProduk == ''){
                                $('#id_storage_kirim').select2("val", "");
                            }else{
                                getDescProduk(idProduk);
                            }
                            
                        });
                        function getDescProduk(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/trans_po/getDescProduk'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage_kirim').select2("val",data.id_storage);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }
                        $("#id_produk").change(function () {
                            var idProduk = $(this).val();
                            if(idProduk == ''){
                                $('#id_storage').select2("val", "");
                            }else{
                                getDescProdukPack(idProduk);
                            }
                            
                        });
                        function getDescProdukPack(idProduk) {
                            ajaxModal();
                            if (idProduk != '') {
                                $.post("<?php echo site_url('transaksi/trans_po/getDescProduk'); ?>",
                                        {
                                            'idProduk': idProduk
                                        }, function (data) {
                                    if (data.baris == 1) {
                                        $('#id_storage').select2("val",data.id_storage);
                                        /*
                                         $('#').val(data.); */
                                    } else {
                                        alert('Data tidak ditemukan!');
                                    }
                                }, "json");
                            }//if kd<>''
                        }


</script>


<!-- END JAVASCRIPTS -->