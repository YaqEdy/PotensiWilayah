<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelPO td:nth-child(4) {
        text-align: right;
    }
    table#idTabelPO td:nth-child(5) {
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

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelPO">
                            <thead>
                                <tr>
                                    <th>
                                        No Kedatangan
                                    </th>
                                    <th>
                                        Supplier
                                    </th> 
                                    <th>
                                        Tanggal PO
                                    </th>
                                    <th>
                                        Jumlah Order
                                    </th>
                                    <th>
                                        Total Harga
                                    </th>   
                                    <th>
                                        Act
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
<script src="<?php echo base_url('metronic/layouts/global/scripts/quick-sidebar.min.js'); ?>" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script>

                        var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
                        $('#id_judul_menu').text(judul_menu);
                        // MENU OPEN
                        $(".menu_root").removeClass('start active open');
                        $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
                        // END MENU OPEN

                        //Ready Doc
                        btnStart();
                        readyToStart();
                        tglTransStart();
                        jQuery(document).ready(function () {
                            TableManaged.init();
                        });
                        
                        //window.open( baseurl+"master_rusun/selectedRusun/"+idroom, "_self");

                        var TableManaged = function () {

                            var initTable1 = function () {

                                var table = $('#idTabelPO');

                                // begin first table
                                table.dataTable({
                                    "ajax": "<?php echo base_url("/cukai/trans_masuk/getPOAll"); ?>",
                                    "columns": [
                                        {"data": "idMaster"},
                                        {"data": "namaSpl"},
                                        {"data": "tglPO"},
                                        {"data": "jml"},
                                        {"data": "totalHarga"},
                                        {"data": "button"}
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

                                table.on('change', 'tbody tr .checkboxes', function () {
                                    $(this).parents('tr').toggleClass("active");
                                });
                                table.on('click', 'tbody tr', function () {
                                    var baseurl = "<?php echo base_url(); ?>"; 
                                    var noPO = $(this).find("td").eq(0).html();
                                    window.open( baseurl+"cukai/trans_masuk/selectedPO/"+noPO, "_self");

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
                        }();


</script>


<!-- END JAVASCRIPTS -->