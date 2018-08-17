<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
</style>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Jurnal</span>
                </div>
                <div class="actions">
                    <!--                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="cetak();">
                                            <i class="fa fa-print"></i> Cetak </a>-->
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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            List Jurnal (Unpost) </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Input Jurnal Umum</a>
                    </li>
                </ul>
                <form role="form" method="post"
                      action="<?php echo base_url('akuntansi/home'); ?>" id="id_formAkuntansi">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab_2_1">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pilih Tanggal</label>
                                                
                                                    <input id="id_TanggalSearch" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control date-picker input-sm cls_tglhariini_static" type="text" name="id_TanggalSearch" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label></label>
                                            <a href="javascript:;" class="btn blue btn-medium" onclick="getDescJUunpost();"> Tampilkan </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label></label>
                                            <a href="javascript:;" class="btn blue btn-medium" onclick="postall();"> Post ALL </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- HIDDEN INPUT -->
                                <input type="text" id="idTmpAksiBtn" class="hidden">
                                <!-- END HIDDEN INPUT -->
                            </div>
                            <!--END ROW 1 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body"  >
                                        <table class=" table table-striped table-bordered table-hover text_kanan cellspacing"  id="idtabeljuunpost">
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        Aksi
                                                    </th>
                                                    <th>
                                                        Id Jurnal
                                                    </th>
                                                    <th>
                                                        No Invoice
                                                    </th>
                                                    <th>
                                                        Tanggal
                                                    </th>
                                                    <th>
                                                        Deskripsi
                                                    </th>
                                                    <th>
                                                        Saldo Akhir
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_dataJUUnpost">

                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2_2">
                            <input type="text" name="no_invoice" id="id_no_invoice" class="hidden">
                            <input type="text" name="id_trans_invoice" id="id_id_trans_invoice" class="hidden">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Referensi</label>
                                        <input id="id_NoReferensi" class="form-control input-sm"type="text" name="NoReferensi"/>
                                        <input id="id_modul" class="form-control input-sm hidden"type="text" name="modul"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pilih Tanggal</label>
                                        <div class="input-group">
                                            <div class="input-icon">
                                                <i class="fa fa-list fa-fw"></i>
                                                <input id="id_TanggalJurnal" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control date-picker input-sm" type="text" name="TanggalJurnal" required="required"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea rows="2" cols="" name="Deskripsi" id="Deskripsi" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!--<label>Kode perk</label>-->
                                                    <div class="input-group">
                                                        <input id="id_kodePerk" readonly
                                                               class="form-control input-sm kosongCPA"
                                                               type="text" name="kodePerk"
                                                               placeholder="Kode Perk"/>
                                                        <span class="input-group-btn">
                                                            <a href="#" class="btn btn-success btn-sm"
                                                               data-target="#idDivTabelPerk"
                                                               id="id_btnModal2" data-toggle="modal">
                                                                <i class="fa fa-search fa-fw"/></i>
                                                            </a>
                                                        </span>
                                                        <input id="trans_id" type="text" name="trans_id" style='display:none;'/>
                                                        <input id="tanggal_trans" type="text" name="tanggal_trans" style='display:none;'/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>&nbsp;</label>
                                                    <!--<input id="id_kodeAlt" readonly class="form-control input-sm kosongCPA"
                                                       type="text" name="kodeAlt" placeholder="Kode Perk Alternatif"/>-->
                                                    <span id="id_kodeAlt" class="tkosongCPA"></span>
                                                    <span id="id_namaPerk" class="tkosongCPA"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END ROW-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Debet</label>
                                                <input id="id_jumlahDb" class="form-control input-sm nomor "
                                                       type="text" name="jumlahDb"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kredit</label>
                                                <input id="id_jumlahKr" class="form-control input-sm nomor "
                                                       type="text" name="jumlahKr"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea rows="2" cols="" name="keteranganCPA" id="id_keteranganCPA"
                                                  class="form-control input-sm kosongCPA"></textarea>

                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="idTxtTempLoop" name="txtTempLoop"
                                               class="form-control nomor1 hidden">
                                        <input type="text" id="idTxtTempJnsKode" name="txtTempJnsKode"
                                               class="form-control nomor1 hidden">
                                        <input type="text" id="idTempUbahCPA" name="txtTempUbahCPA"
                                               class="form-control nomor1 hidden">
                                        <input type="text" id="idTempJumlahDb" name="txtTempJumlahDb"
                                               class="form-control nomor hidden">
                                        <input type="text" id="idTempJumlahKr" name="txtTempJumlahKr"
                                               class="form-control nomor hidden">
                                        <a href="javascript:;" class="btn blue btn-sm" id="id_btnAddCpa">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="javascript:;" class="btn red btn-sm" id="id_btnRemoveCpa">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <a href="javascript:;" class="btn yellow btn-sm"
                                           id="id_btnUpdateCpa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:;" class="btn default btn-sm"
                                           id="id_btnBatalCpa">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-body">
                                        <table class=" table table-striped table-hover table-bordered cls_tabelPerkCflow" 
                                               id="id_tabelPerkCflow">
                                            <thead>
                                                <tr>
                                                    <th width="15%">
                                                        Akun GL
                                                    </th>
                                                    <th width="40%">
                                                        Nama Akun
                                                    </th>
                                                    <th width="">
                                                        Keterangan
                                                    </th>
                                                    <th width="15%">
                                                        Debet
                                                    </th>
                                                    <th width="15%">
                                                        Kredit
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="id_body_data">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" width="70%">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td width="15%">
                                                        <input type="text" name="totalDb"
                                                               class="form-control nomor input-sm" id="id_totalDb"
                                                               readonly>
                                                    </td>
                                                    <td width="15%">
                                                        <input type="text" name="totalKr"
                                                               class="form-control nomor input-sm" id="id_totalKr"
                                                               readonly>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!--END ROW 1 -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-actions">
                                        <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                            <!--<i class="fa fa-check"></i>--> Simpan
                                        </button>
                                        <button id="id_btnBatal" type="button" class="btn default">Batal</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
</div>
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->

<!-- END PAGE CONTENT-->
<!--  MODAL Data Reimpay -->
<!--  MODAL Data Perkiraan -->
<div class="modal fade draggable-modal" id="idDivTabelPerk" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Perkiraan</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_ReloadPerk" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan"
                                       id="idTabelPerk">
                                    <thead>
                                        <tr>
                                            <th width='10%' align='left'>Kd Perk</th>
                                            <th width='10%' align='left'>Kd Alt</th>
                                            <th width='50%' align='left'>Nama Perk</th>
                                            <th width='10%' align='center'>Level</th>
                                            <th width='10%' align='center'>Type</th>
                                            <th width='10%' align='center'>DK</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalPerk">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END  MODAL Data Perkiraan -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<?php $this->load->view('app.min.inc.php'); ?>

<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();
    });

    var TableManaged = function () {
        var initTablePerk = function () {
            //var table = $('#id_TabelPerk');
            // begin first table
            var table = $('#idTabelPerk').dataTable({
                "ajax": "<?php echo base_url("/master/master_perkiraan/getAllPerkiraan"); ?>",
                "columns": [
                    {"data": "kode_perk"},
                    {"data": "kode_alt"},
                    {"data": "nama_perk"},
                    {"data": "level"},
                    {"data": "type"},
                    {"data": "dk"}
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Cari: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                // "aaSorting": [[4,'desc'], [5,'desc']],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        'type': 'string',
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            });

           
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });
            table.on('click', 'tbody tr', function () {
                var typePerk = $(this).find("td").eq(4).html();
                if (typePerk == 'D') {
                    var kodePerk = $(this).find("td").eq(0).html();
                    $('#id_kodePerk').val(kodePerk);
                    var kodeAlt = $(this).find("td").eq(1).html();
                    $('#id_kodeAlt').text(kodeAlt);
                    var namaPerk = $(this).find("td").eq(2).html();
                    $('#id_namaPerk').text(namaPerk);

                    $("#btnCloseModalPerk").trigger("click");
                } else {
                    alert("Tidak diijinkan pilih kode induk.");
                }
            });
        }
        var initTableJUunpost = function () {
            var table = $('#idtabeljuunpost').dataTable({
                "ajax": "<?php echo base_url("/akuntansi/akuntansi/getJurnalUnpostAll"); ?>",
                "columns": [
                    {"data": "aksi"},
                    {"data": "trans_id"},
                    {"data": "no_invoice"},
                    {"data": "tgl_trans"},
//                                        {"data": "kode_jurnal"},
                    {"data": "deskripsi"},
                    {"data": "saldo_akhir"}
                ],
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "pagingType": "bootstrap_full_number",
                "language": {
                    "search": "Cari: ",
                    "lengthMenu": "  _MENU_ records",
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "last": "Last",
                        "first": "First"
                    }
                },
                // "aaSorting": [[4,'desc'], [5,'desc']],
                "columnDefs": [{// set default column settings
                        'orderable': true,
                        'type': 'string',
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                "order": [
                    [0, "asc"]
                ],
                "columnDefs": [
                    {"width": "12%", "targets": 0},
                    {"width": "13%", "targets": 1},
                    {"width": "10%", "targets": 2},
                    {"width": "10%", "targets": 3},
                    {"width": "20%", "targets": 4},
                    {"width": "12%", "targets": 5}
                ]
                        // set first column as a default sort by asc
            });

            var tableWrapper = jQuery('#id_TabelPerk_wrapper');

            table.find('.group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });
            $('#id_Reload').click(function () {
                table.api().ajax.reload();
            });

            tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        }
        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().dataTable) {
                    return;
                }

                //initTableJu();
                initTablePerk();
                initTableJUunpost();
                //initTableCf();
            }
        };
    }();

    //Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();
    btnCpaStart();
    $(document).keyup(function (e) {
        if (e.which == 120) {
            $('#id_tgltrans').attr("readonly", false);
        }
    });
    $('.request_in').hide();

    $("#id_kodeJurnal").focus();

    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });
    $('#id_btnUbah').click(function () {
        $('#idTmpAksiBtn').val('2');
    });
    $('#id_btnHapus').click(function () {
        $('#idTmpAksiBtn').val('3');
    });

    $('#id_btnBatal').click(function () {
        btnStart();
        startCheckBox();
        resetForm();
        readyToStart();
        tglTransStart();
        btnCpaStart();
        $('#id_body_data').empty();
    });

    function btnCpaStart() {
        $('#id_btnAddCpa').attr("disabled", false);
        $('#id_btnUpdateCpa').attr("disabled", true);
        $('#id_btnRemoveCpa').attr("disabled", true);
    }

    function getDescJU(idPerk) {
        $('#id_btnBatal').click();
        ajaxModal();
        $.post("<?php echo site_url('/akuntansi/akuntansi/getDescJU'); ?>",
                {
                    'idPerk': idPerk
                }, function (data)
        {
            if (data.data_ju.length > 0) {
                $('#idTxtTempLoop').val(data.data_ju.length);
                for (i = 0; i < data.data_ju.length; i++) {
                    var x = i + 1;
                    var kodePerk = data.data_ju[i].kode_perk;
                    var ket = data.data_ju[i].keterangan;
                    var db = data.data_ju[i].debet;
                    var kr = data.data_ju[i].kredit;
                    var namaPerk = data.data_ju[i].nama_perk;
                    var saldoakhir = data.data_ju[i].saldo_akhir;
                    $('#id_NoReferensi').val(data.data_ju[i].NoReferensi);
                    $('#id_modul').val(data.data_ju[i].modul);
                    $('#trans_id').val(data.data_ju[i].trans_id);
                    $('#id_no_invoice').val(data.data_ju[i].no_invoice);
                    $('#id_id_trans_invoice').val(data.data_ju[i].id_trans_invoice);
                    var tahun = data.data_ju[i].tgl_trans.trim().substring(0, 4);
                    var bulan = data.data_ju[i].tgl_trans.trim().substring(5, 7);
                    var hari = data.data_ju[i].tgl_trans.trim().substring(8, 10);
                    var tanggal = hari+"-"+bulan+"-"+tahun;
                    $('#id_TanggalJurnal').val(tanggal);
                    $('#Deskripsi').val(data.data_ju[i].deskripsi);
                    tr = '<tr class="listdata" id="tr' + x + '">';
                    tr += '<td><input type="text" class="form-control input-sm" id="id_tempKodePerk' + x + '" name="tempKodePerk' + x + '" readonly="true" value="' + kodePerk + '"></td>';
                    tr += '<td><input type="text" class="form-control input-sm" id="id_tempNamaPerk' + x + '" name="tempNamaPerk' + x + '" readonly="true" value="' + namaPerk + '"></td>';
                    tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + x + '" name="tempKet' + x + '" readonly="true" value="' + ket + '"></td>';
                    tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempDb' + x + '" name="tempDb' + x + '" readonly="true" value="' + number_format(db, 2) + '"></td>';
                    tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKr' + x + '" name="tempKr' + x + '" readonly="true" value="' + number_format(kr, 2) + '"></td>';
                    tr += '</tr>';
                    
                    jumlahDb = parseFloat(CleanNumber(saldoakhir));
                    //var totalDb = parseFloat(CleanNumber($('#id_totalDb').val()));
                    //var totalDb = jumlahDb;
                    //  alert(jumlahDb);
                    jumlahKr = parseFloat(CleanNumber(saldoakhir));
                    //var totalKr = parseFloat(CleanNumber($('#id_totalKr').val()));
                    //var totalKr = jumlahKr;

                    $('#id_totalDb').val(number_format(jumlahDb, 2));
                    $('#id_totalKr').val(number_format(jumlahKr, 2));
                    $('#id_body_data').append(tr);
                }
            }
        }, "JSON");
        //getDescription(idPerk);
        $('#navitab_2_2').click();
    }

    function getDescription(idPerk) {
        ajaxModal();
        $.post("<?php echo site_url('/akuntansi/akuntansi/getDescription'); ?>",
                {
                    'idPerk': idPerk
                }, function (data)
        {
            if (data.baris == 1) {
                var x = i + 1;
                $('#id_NoReferensi').val(data.noreferensi);
                $('#Deskripsi').val(data.desc);
            }
        }, "JSON");
    }

    $('#id_btnAddCpa').click(function () {
        var i = $('#idTxtTempLoop').val();
        if ($('#id_kodePerk').val() == '' && $('#id_kodeCflow').text() == '') {
            alert("Akun GL tidak boleh kosong.");
        } else {
            var i = parseInt($('#idTxtTempLoop').val());
            i = i + 1;
            var kodePerk = $('#id_kodePerk').val();
            var namaPerk = document.getElementById('id_namaPerk').innerHTML;
            var ket = $('#id_keteranganCPA').val().trim();
            var db = $('#id_jumlahDb').val();
            var kr = $('#id_jumlahKr').val();
            db = parseFloat(CleanNumber(db));
            kr = parseFloat(CleanNumber(kr));

            tr = '<tr class="listdata" id="tr' + i + '">';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempKodePerk' + i + '" name="tempKodePerk' + i + '" readonly="true" value="' + kodePerk + '"></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempNamaPerk' + i + '" name="tempNamaPerk' + i + '" readonly="true" value="' + namaPerk + '"></td>';
            tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + i + '" name="tempKet' + i + '" readonly="true" value="' + ket + '"></td>';
//                                tr += '<td><input type="text" class="form-control input-sm" id="id_tempKodeCflow' + i + '" name="tempKodeCflow' + i + '" readonly="true" value="' + kodeCflow + '" ></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempDb' + i + '" name="tempDb' + i + '" readonly="true" value="' + number_format(db, 2) + '"></td>';
            tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKr' + i + '" name="tempKr' + i + '" readonly="true" value="' + number_format(kr, 2) + '"></td>';
//                                tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempTotal' + i + '" name="tempTotal' + i + '" readonly="true" value="' + number_format(totaldb, 2) + '"></td>';
            tr += '</tr>';

            var totalDb = parseFloat(CleanNumber($('#id_totalDb').val()));
            var totalDb = totalDb + db;
            $('#id_totalDb').val(number_format(totalDb, 2));

            var totalKr = parseFloat(CleanNumber($('#id_totalKr').val()));
            var totalKr = totalKr + kr;
            $('#id_totalKr').val(number_format(totalKr, 2));

            $('#id_body_data').append(tr);
            $('#idTxtTempLoop').val(i);
            kosongCPA();
        }
        $('#Deskripsi').focusout();
    });

    $("#id_tabelPerkCflow").on('click', 'tbody tr', function () {
        var kodePerk = $(this).find("td input").eq(0).val();
        var namaPerk = $(this).find("td input").eq(1).val();
        var ket = $(this).find("td input").eq(2).val();
//                            var kodeCflow = $(this).find("td input").eq(2).val();
        var db = $(this).find("td input").eq(3).val();
        var kr = $(this).find("td input").eq(4).val();
        db = parseFloat(CleanNumber(db));
        kr = parseFloat(CleanNumber(kr));

        $('#id_kodePerk').val(kodePerk);
        $('#id_namaPerk').text(namaPerk);
        $('#id_keteranganCPA').val(ket);
        $('#id_jumlahDb').val(number_format(db, 2));
        $('#id_jumlahKr').val(number_format(kr, 2));

        var idTr = $(this).attr('id');
        var noRow = idTr.replace('tr', '');
        $('#idTempUbahCPA').val(noRow);
        $('#idTempJumlahDb').val(number_format(db, 2));
        $('#idTempJumlahKr').val(number_format(kr, 2));
        $('#id_btnAddCpa').attr("disabled", true);
        $('#id_btnUpdateCpa').attr("disabled", false);
        $('#id_btnRemoveCpa').attr("disabled", false);

    });
    function kosongCPA() {
        $('.kosongCPA').val('');
        $('.tkosongCPA').text('');
        $('#id_jumlahDb').val('0.00');
        $('#id_jumlahKr').val('0.00');
    }
    $('#id_btnUpdateCpa').click(function () {
        var noRow = $('#idTempUbahCPA').val();
        var kodePerk = $('#id_kodePerk').val();
        var namaPerk = document.getElementById('id_namaPerk').innerHTML;
        var ket = $('#id_keteranganCPA').val();
        var db = $('#id_jumlahDb').val();
        var kr = $('#id_jumlahKr').val();
        db = parseFloat(CleanNumber(db));
        kr = parseFloat(CleanNumber(kr));

        var totalDb = parseFloat(CleanNumber($('#id_totalDb').val()));
        var totalKr = parseFloat(CleanNumber($('#id_totalKr').val()));

        var jumlahDbOld = parseFloat(CleanNumber($('#idTempJumlahDb').val()));
        totalDb = totalDb - jumlahDbOld + db;

        var jumlahKrOld = parseFloat(CleanNumber($('#idTempJumlahKr').val()));
        totalKr = totalKr - jumlahKrOld + kr;

        $('#id_tempKodePerk' + noRow).val(kodePerk);
        $('#id_tempNamaPerk' + noRow).val(namaPerk);
        $('#id_tempKet' + noRow).val(ket);
        $('#id_tempDb' + noRow).val(number_format(db, 2));
        $('#id_tempKr' + noRow).val(number_format(kr, 2));

        $('#id_totalDb').val(number_format(totalDb, 2));
        $('#id_totalKr').val(number_format(totalKr, 2));
        kosongCPA();
        btnCpaStart();
    });
    $('#id_btnRemoveCpa').click(function () {
        var noRow = $('#idTempUbahCPA').val();
        $('#tr' + noRow).remove();
        var i = $('#idTxtTempLoop').val();
        i = parseInt(i);
        i = i - 1;
        $('#idTxtTempLoop').val(i);

        var totalDb = parseFloat(CleanNumber($('#id_totalDb').val()));
        var jumlahDbOld = parseFloat(CleanNumber($('#idTempJumlahDb').val()));
        totalDb = totalDb - jumlahDbOld;
        $('#id_totalDb').val(number_format(totalDb, 2));

        var totalKr = parseFloat(CleanNumber($('#id_totalKr').val()));
        var jumlahKrOld = parseFloat(CleanNumber($('#idTempJumlahKr').val()));
        totalKr = totalKr - jumlahKrOld;
        $('#id_totalKr').val(number_format(totalKr, 2));

        kosongCPA();
        btnCpaStart();
    });
    $('#id_btnBatalCpa').click(function () {
        kosongCPA();
        btnCpaStart();
    });

    function getDescCpaJurnal(idMaster) {
        ajaxModal();
        if (idMaster != '') {
            $.post("<?php echo site_url('/akuntansi/akuntansi/getDescCpaJurnal'); ?>",
                    {
                        'idJurnal': idMaster
                    }, function (data) {
                if (data.data_cpa.length > 0) {
                    $('#idTxtTempLoop').val(data.data_cpa.length);
                    for (i = 0; i < data.data_cpa.length; i++) {
                        var x = i + 1;
                        //var idCpa           = data.data_cpa[i].id_cpa;
                        var kodePerk = data.data_cpa[i].kode_perk;
                        //var namaPerk        = data.data_cpa[i].nama_perk;//+ namaPerkUM +'\n'+ data.keterangan +
                        if (data.data_cpa[i].kode_cflow == null) {
                            var kodeCflow = '';
                        } else {
                            var kodeCflow = data.data_cpa[i].kode_cflow;
                        }
                        //var kodeCflow       = data.data_cpa[i].kode_cflow;
                        var ket = data.data_cpa[i].keterangan;
                        var db = data.data_cpa[i].debet;
                        var kr = data.data_cpa[i].kredit;
                        tr = '<tr class="listdata" id="tr' + x + '">';
                        tr += '<td><input type="text" class="form-control input-sm" id="id_tempKodePerk' + x + '" name="tempKodePerk' + x + '" readonly="true" value="' + kodePerk + '"></td>';
                        tr += '<td><input type="text" class="form-control input-sm" id="id_tempKet' + x + '" name="tempKet' + x + '" readonly="true" value="' + ket + '"></td>';
                        tr += '<td><input type="text" class="form-control input-sm" id="id_tempKodeCflow' + x + '" name="tempKodeCflow' + x + '" readonly="true" value="' + kodeCflow + '" ></td>';
                        tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempDb' + x + '" name="tempDb' + x + '" readonly="true" value="' + number_format(db, 2) + '"></td>';
                        tr += '<td><input type="text" class="form-control nomor input-sm" id="id_tempKr' + x + '" name="tempKr' + x + '" readonly="true" value="' + number_format(kr, 2) + '"></td>';
                        tr += '</tr>';

                        jumlahDb = parseFloat(CleanNumber(db));
                        var totalDb = parseFloat(CleanNumber($('#id_totalDb').val()));
                        var totalDb = totalDb + jumlahDb;

                        jumlahKr = parseFloat(CleanNumber(kr));
                        var totalKr = parseFloat(CleanNumber($('#id_totalKr').val()));
                        var totalKr = totalKr + jumlahKr;

                        $('#id_totalDb').val(number_format(totalDb, 2));
                        $('#id_totalKr').val(number_format(totalKr, 2));
                        $('#id_body_data').append(tr);
                    }
                } else {
                    //alert('Data tidak ditemukan!');
                    //$('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    function postall() {
        tanggal = $('#id_TanggalSearch').val();
        if (tanggal !== '') {
            ajaxModal();
            $.post("<?php echo site_url('/akuntansi/akuntansi/postall'); ?>",
                    {
                        'tanggal': tanggal
                    },
                    function (data)
                    {
                        UIToastr.init(data.tipePesan, data.pesan);
                        getDescJUunpost();
                    }, "JSON");
            
            //location.reload();
        } else {
            UIToastr.init('error', 'Silahkan pilih tanggal');
        }
    }
    function ajaxSubmit() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>akuntansi/akuntansi/simpan",
            data: dataString,
            success: function (data) {
                if (data.kodeJurnal == 'ST') {
                    $('#id_ReloadSettle').trigger('click');
                } else if (data.kodeJurnal == 'RP') {
                    $('#id_ReloadReqpay').trigger('click');
                } else if (data.kodeJurnal == 'RM') {
                    $('#id_ReloadReimpay').trigger('click');
                }
                $('#id_idJurnal').val(data.idAP);
                $('#idPerk').val(data.idPerk);
                UIToastr.init(data.tipePesan, data.pesan);
                if (data.hasil == 'DKTS') {
                    $('#id_btnSimpan').attr('disabled', false);
                } else {
                    $('#id_btnBatal').click();
                    $('#id_btnSimpan').attr('disabled', true);
                }
            }
        });
        
        location.reload();
    }
    $('#Deskripsi').focusout(function () {
        $('#id_keteranganCPA').val(this.value);
    });
    $('#id_formAkuntansi').submit(function (event) {
        dataString = $("#id_formAkuntansi").serialize();
        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmit();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '2') {
            var r = confirm('Anda yakin merubah data ini?');
            if (r == true) {
                ajaxUbah();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '3') {
            var r = confirm('Anda yakin menghapus data ini?');
            if (r == true) {
                ajaxHapus();
                event.preventDefault();
            } else {//if(r)
                return false;
            }
        }
    });

    function cetak(idPerk) {
        var idJurnal = $('#id_idJurnal').val();
        var kdJurnal = $('#id_kodeJurnal').val();
        if (idJurnal == '') {
            alert('Silahkan pilih ID Jurnal');
        } else {
            window.open("<?php echo base_url('akuntansi/akuntansi/cetak/'); ?>/" + idPerk, '_blank');
        }
    }

    function getDescJUunpost() {
        var tanggal = $('#id_TanggalSearch').val();
        if (tanggal != '') {
            tabelok(tanggal);
            function tabelok(tanggal) {
                dataForm = {tanggal: tanggal};
                $('#idtabeljuunpost').dataTable().fnClearTable();
                $('#idtabeljuunpost').dataTable().fnDestroy();
                var table = $('#idtabeljuunpost').dataTable({
                    "ajax":
                            {
                                "url": "<?php echo base_url("/akuntansi/akuntansi/getJurnalUnpostAll"); ?>",
                                "type": "POST",
                                "data": dataForm
                            },
                    "columns": [
                        {"data": "aksi"},
                        {"data": "trans_id"},
                        {"data": "no_invoice"},
                        {"data": "tgl_trans"},
//                                                                {"data": "kode_jurnal"},
                        {"data": "deskripsi"},
                        {"data": "saldo_akhir"}
                    ],
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "No data available in table",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "infoEmpty": "No entries found",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "Show _MENU_ entries",
                        "search": "Search:",
                        "zeroRecords": "No matching records found"
                    },
                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    "language": {
                        "search": "Cari: ",
                        "lengthMenu": "  _MENU_ records",
                        "paginate": {
                            "previous": "Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },
                    "aaSorting": [[0, 'asc']/*, [5,'desc']*/],
                    "columnDefs": [{// set default column settings
                            'orderable': true,
                            "searchable": true,
                            'targets': [0]
                        }],
                    "order": [
                        [0, "asc"]
                    ] // set first column as a default sort by asc
                });
                $('#id_Reload').click(function () {
                    table.api().ajax.reload();
                });

                var tableWrapper = jQuery('#example_wrapper');
                jQuery('#idTabelTransInvoice .group-checkable').change(function () {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function () {
                        if (checked) {
                            $(this).attr("checked", true);
                        } else {
                            $(this).attr("checked", false);
                        }
                        $(this).parents('tr').toggleClass("active");
                    });
                    jQuery.uniform.update(set);
                });
                table.on('change', 'tbody tr .checkboxes', function () {
                    $(this).parents('tr').toggleClass("active");
                });
                table.on('click', 'tbody tr', function () {
                    var deskripsi = $(this).find("td").eq(3).html();
                    $('#Deskripsi').val(deskripsi);
                });

                tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
            }

            return {
                //main function to initiate the module
                init: function () {
                    if (!jQuery().dataTable) {
                        return;
                    }
                    initTable1();
                }
            };
        }
    }

</script>


<!-- END JAVASCRIPTS -->