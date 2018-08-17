<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    table#idTabelBarang th:nth-child(2) {
        display: none;
    }
    table#idTabelBarang td:nth-child(2) {
        display: none;
    }
    table#idTabelBarang th:nth-child(9) {
        display: none;
    }
    table#idTabelBarang td:nth-child(9) {
        display: none;
    }
</style>
<!-- END PAGE BREADCRUMB -->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<!-- KONTEN DI SINI YA -->
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs  font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                <form role="form" method="post" class="cls_from_sec_barang"
                      action="<?php echo base_url('master_barang/home'); ?>" id="id_formBarang">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Id barang </label>

                                            <div class="input-group">
                                                <input id="id_idBarang"
                                                       class="form-control input-sm"
                                                       type="text" name="idBarang" readonly/>
                                                <span class="input-group-btn">
                                                    <a href="#" class="btn btn-success btn-sm" data-target="#idDivTabelBarang"
                                                       id="id_btnModal" data-toggle="modal">
                                                        <i class="fa fa-search fa-fw"/></i>

                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($lokasi as $row) :
                                        $data[$row['id_lokasi']] = $row['nama_lokasi']. ' - ' .$row['nama_cabang'];
                                    endforeach;
                                    if ($this->session->userdata('usergroup') == 1) {
                                        echo "<label>Pilih lokasi :</label>";
                                        echo form_dropdown('lokasi', $data, '', 'id="id_lokasi" class="form-control input-sm select2me" required="required"');
                                    } elseif ($this->session->userdata('usergroup') == 3) {
                                        ?>
                                        <input id="id_lokasiId" class="form-control input-sm" type="hidden" name="idLokasi"readonly/>
                                        <input id="id_namaLokasi" class="form-control input-sm" type="hidden" name="namaLokasi"  readonly/> 
                                        <input id="id_kywId" class="form-control input-sm" type="hidden" name="id_kyw"/>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Kategori barang</label>
                                    <?php
                                    $data = array();
                                    $data[''] = '';
                                    foreach ($kategoribarang as $row) :
                                        $data[$row['id_kategoribarang']] = $row['nama_kategoribarang'];
                                    endforeach;
                                    echo form_dropdown('kategoribarang', $data, '', 'id="id_kategoribarang" class="form-control input-sm select2me" required="required"');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama barang</label>
                                    <input id="id_namaBarang" required="required" class="form-control input-sm" type="text" name="namaBarang"/>
                                </div>
                                <div class="form-group">
                                    <label>Spesifikasi barang</label>
                                    <textarea class="form-control input-sm" rows="2" name="spek_barang" id="id_spekBarang"></textarea><br>
                                </div>
                                <div class="form-group">
                                    <label>Qty awal</label>
                                    <input id="id_qtyawal" required="required" class="form-control input-sm" type="text" name="qty"/>
                                </div>
                                <div class="form-group">
                                    <label>Qty akhir</label>
                                    <input id="id_qtyakhir" required="required" class="form-control input-sm" type="text" name="qty_akhir" value ="0" readonly/>
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
                            <div class="form-actions">
                                <?php include "button.inc.php"; ?>
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
<div class="row">
    <div class="col-md-6">

    </div>
</div>

<!-- END PAGE CONTENT-->
<!--  MODAL Data Karyawan -->
<div class="modal fade draggable-modal" id="idDivTabelBarang" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Data Barang Inventaris</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:400px; ">
                    <div class="row">
                        <div class="col-md-12">
                            <button id="id_Reload" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelBarang">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id barang
                                            </th>
                                            <th>
                                                Id Kategori barang
                                            </th>
                                            <th>
                                                Kategori barang
                                            </th>
                                            <th>
                                                Nama barang
                                            </th>
                                            <th>
                                                Spesifikasi barang
                                            </th>
                                            <th>
                                                Qty awal
                                            </th>
                                            <th>
                                                Qty akhir
                                            </th>
                                            <th>
                                                Lokasi
                                            </th>
                                            <th>
                                                Id Lokasi
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
                        <!-- end col-12 -->
                    </div>
                    <!-- END ROW-->
                </div>
                <!-- END SCROLLER-->
            </div>
            <!-- END MODAL BODY-->
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModalDataBarang">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--  END  MODAL Data Karyawan -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url('metronic/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('metronic/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->
<script src="<?php echo base_url('metronic/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-migrate.min.js'); ?>" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.cokie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/uniform/jquery.uniform.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/bootstrap-toastr/toastr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/select2/select2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="<?php echo base_url('metronic/global/scripts/metronic.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/admin/layout4/scripts/layout.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/admin/layout4/scripts/demo.js'); ?>"></script>
<script src="<?php echo base_url('metronic/additional/start.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('metronic/global/plugins/jquery-validation/js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/helpmedude.js'); ?>"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        //UITree.init();
        TableManaged.init();
		$("#id_formBarang").validate();
    });
    //$(function () {
    var judul_menu = $('#id_a_menu_<?php echo $menu_id; ?>').text();
    $('#id_judul_menu').text(judul_menu);
    // MENU OPEN
    $(".menu_root").removeClass('start active open');
    $("#menu_root_<?php echo $menu_parent; ?>").addClass('start active open');
    // END MENU OPEN
    var TableManaged = function () {
        var initTable1 = function () {
            var table = $('#idTabelBarang');
            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/master_barang/getBarangAll"); ?>",
                "columns": [
                    {"data": "idBarang"},
                    {"data": "idKategoriBarang"},
                    {"data": "KategoriBarang"},
                    {"data": "namaBarang"},
                    {"data": "spek_barang"},
                    {"data": "qty_awal"},
                    {"data": "qty_akhir"},
                    {"data": "nama_lokasi"},
                    {"data": "id_lokasi"}
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
                var idBarang = $(this).find("td").eq(0).html();
                var idkategoriBarang = $(this).find("td").eq(1).html();
//                var namaKategoriBarang = $(this).find("td").eq(2).html()
                var namaBarang = $(this).find("td").eq(3).html();
                var spekBarang = $(this).find("td").eq(4).html();
                var qty_awal = $(this).find("td").eq(5).html();
                var qty_akhir = $(this).find("td").eq(6).html();
                var nama_lokasi = $(this).find("td").eq(7).html();
                var id_lokasi = $(this).find("td").eq(8).html();
                $('#id_idBarang').val(idBarang);
                $('#id_kategoribarang').select2("val", idkategoriBarang);
                $('#id_namaBarang').val(namaBarang);
                $('#id_spekBarang').val(spekBarang);
                $('#id_qtyawal').val(qty_awal);
                $('#id_qtyakhir').val(qty_akhir);
                $('#id_lokasi').select2("val", id_lokasi);
//                $('#id_ket').val(keterangan);

                $('#btnCloseModalDataBarang').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_BarangId').focus();

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
    btnStart();
    readyToStart();
    setValueLokasi();
    function setValueLokasi() {
        $("#id_lokasiId").val("<?php echo $this->session->userdata('id_lokasi'); ?>");
        $("#id_kywId").val("<?php echo $this->session->userdata('id_kyw'); ?>");
        $("#id_namaLokasi").val("<?php echo $this->session->userdata('nama_lokasi'); ?>");
    }
    $("#id_namaBarang").focus();

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
        resetForm();
        readyToStart();
        setValueLokasi();
        $('#id_qtyakhir').val('0');
    });

    $('#id_formBarang').submit(function (event) {
		getSubmit('id_formBarang', 'master_barang', 'id_kategoribarang');
		$('#id_qtyakhir').val('0');
		setValueLokasi();
    });

</script>


<!-- END JAVASCRIPTS -->
<!-- END JAVASCRIPTS -->