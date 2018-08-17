<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelPO th{
        font-size: 13px;
    }
    table#idTabelPO td{
        font-size: 12px;
    }
    table#idTabelPO td:nth-child(7) {
        text-align: right;
    }

    table#idTabelPO th:nth-child(14), td:nth-child(14) {
        display: none;
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
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2" for="id_tglAwalDataDaftar">Data tanggal</label>
                                <div class="col-md-2">
                                    <input id="id_tglAwalDataDaftar" required="required" placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_3harilalu" type="text"
                                           name="tglAwalDataDaftar" data-date-format="dd-mm-yyyy" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1" for="id_tglAkhirDataDaftar">sampai</label>
                                <div class="col-md-2">
                                    <input id="id_tglAkhirDataDaftar" required="required" placeholder="dd-mm-yyyy"
                                           class="form-control input-sm date-picker cls_3harikemudian" type="text"
                                           name="tglAkhirDataDaftar" data-date-format="dd-mm-yyyy"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="id_noSO" id="id_noSO" class="hidden">
                                <input type="text" name="rowTabel" id="id_rowTabel" class="hidden">
                                <!--                                                <label class="control-label col-md-1" for="id_Reload">&nbsp;  </label>-->
                                <div class="col-md-2">
                                    <a href="#" class='cls_Reload btn btn-sm btn-default' id='id_Reload'><i class='fa fa-refresh'></i> Reload</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelPO">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        No SO
                                    </th>
                                    <th>
                                        Tgl Kirim
                                    </th>
                                    <th>
                                        Customer
                                    </th>
                                    <th>
                                        No SJ
                                    </th>    
                                    <th>
                                        Produk
                                    </th>
                                    <th>
                                        Dok
                                    </th>
                                    <th>
                                        Jumlah
                                    </th>
                                    <th>
                                        No Batch
                                    </th>
<!--                                <th>
                                        Kendaraan
                                    </th>
                                    <th>
                                        Supir
                                    </th>-->
                                    <th>
                                        No aju
                                    </th>
                                    <th>
                                        No Daftar
                                    </th>
<!--                                <th>
                                        BA Penyegelan
                                    </th>
                                    <th>
                                        BA Buka Segel
                                    </th>-->
                                    <th>
                                        Keterangan
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                            <tfoot>


                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end <div class="portlet green-meadow box"> -->
    </div>
</div>

<!-- END PAGE CONTENT-->

<!--  MODAL Data Karyawan -->

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
<script src="<?php echo base_url('metronic/global/plugins/bootbox/bootbox.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/datatable.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/datatables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js'); ?>"></script>

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
                        //Ready Doc
                        btnStart();
                        readyToStart();
                        tglTransStart();
                        jQuery(document).ready(function () {
                            TableManaged.init();
                            UIBootbox.init();
                            ComponentsDateTimePickers.init();
                        });

                        //window.open( baseurl+"master_rusun/selectedRusun/"+idroom, "_self");

                        var TableManaged = function () {

                            var initTable1 = function () {
                                var table = $('#idTabelPO');
                                var tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
                                var tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
                                // begin first table
                                table.dataTable({
                                    "ajax": {
                                        'type': 'POST',
                                        'url': '<?php echo base_url("/transaksi/packaging/getRencanaOutAll"); ?>',
                                        'data': function (d) {
                                            d.tglAwalDaftar = $('#id_tglAwalDataDaftar').val();
                                            d.tglAkhirDaftar = $('#id_tglAkhirDataDaftar').val();
                                        }
                                    },
                                    "columns": [
                                        {"data": "noSeq"},
                                        {"data": "idMaster"},
                                        {"data": "tglKirim"},
                                        {"data": "namaCust"},
                                        {"data": "no_sj"},
                                        {"data": "nama_produk"},
                                        {"data": "no_jnsdoc"},
                                        {"data": "totalQty"},
                                        {"data": "no_batch"},
                                        {"data": "no_aju"},
                                        {"data": "no_cukai"},
                                        {"data": "keterangan_so"},
                                        {"data": "label"},
                                        {"data": "status"}
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
                                table.on('click', 'tbody tr', function () {
                                    var baseurl = "<?php echo base_url(); ?>";
                                    var noSO = $(this).find("td").eq(1).html();
                                    var status = $(this).find("td").eq(13).html();
                                    window.open(baseurl + "transaksi/packaging/selectedSO/" + noSO + "/" + status, "_self");

                                });
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
                        }();


</script>


<!-- END JAVASCRIPTS -->