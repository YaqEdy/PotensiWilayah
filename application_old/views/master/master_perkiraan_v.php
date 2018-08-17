
<!-- BEGIN PAGE BREADCRUMB -->
<!--

-->
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Data Master Perkiraan </span>
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm" onclick="cetak();">
                        <i class="fa fa-print"></i> Cetak </a>
                    <a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;" data-original-title="" title="">
                    </a>
                </div>

                <!-- <div class="actions">
                        <a href="javascript:;" class="btn blue btn-sm">
                                                <i class="fa fa-print"></i> Cetak  </a>
                </div> -->
                <!-- <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="fullscreen">
                    </a>
                </div> -->
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">

                    </span>
                </div>
                <form role="form" method="post" 
                      action="<?php echo base_url('master/master_perkiraan/home'); ?>" id="id_formPerkiraan">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sub perkiraan </label>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <i class="fa fa-list fa-fw"></i>
                                            <input id="id_kodePerkRoot" required="required" class="form-control"
                                                   type="text" name="kodePerkRoot" readonly/>
                                        </div>
                                        <span class="input-group-btn">
                                            <a href="#" class="btn btn-success" data-target="#idDivTabelPerk"
                                               id="id_btnModal" data-toggle="modal">
                                                <i class="fa fa-search fa-fw"/></i>

                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kode Perk Alternatif</label>
                                    <input id="id_kodeAltRoot" required="required" class="form-control"
                                           type="text" name="kodeAltRoot" readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Nama Perk</label>
                                    <input id="id_namaPerkRoot" required="required" class="form-control"
                                           type="text" name="namaPerkRoot" readonly/>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Level Perk</label>
                                            <input id="id_lvlPerkRoot" required="required" class="form-control"
                                                   type="text" name="lvlPerkRoot" readonly/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Type Perk </label>
                                            <input id="id_typePerkRoot" required="required" class="form-control"
                                                   type="text" name="typePerkRoot" readonly/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>DK Perk </label>
                                            <input id="id_dkPerkRoot" required="required" class="form-control"
                                                   type="text" name="typePerkRoot" readonly/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end <div class="col-md-6"> 1 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode perk</label>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <i class="fa fa-list fa-fw"></i>
                                            <input id="id_kodePerk" required="required" class="form-control"
                                                   type="text" name="kodePerk"/>
                                        </div>
                                        <span class="input-group-btn">
                                            <a href="#" class="btn btn-success" data-target="#idDivTabelPerk"
                                               id="id_btnModal2" data-toggle="modal">
                                                <i class="fa fa-search fa-fw"/></i>

                                            </a>
                                        </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Kode Perk Alternatif</label>
                                    <input id="id_kodeAlt" required="required" class="form-control"
                                           type="text" name="kodeAlt" placeholder=""/>
                                </div>
                                <div class="form-group">
                                    <label>Nama Perk</label>
                                    <input id="id_namaPerk" required="required" class="form-control"
                                           type="text" name="namaPerk" placeholder=""/>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Level Perk</label>
                                            <input id="id_lvlPerk" required="required" class="form-control"
                                                   type="text" name="lvlPerk" readonly/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Type Perk</label>
                                            <input id="id_typePerk" required="required" class="form-control"
                                                   type="text" name="typePerk" value="D" readonly/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>DK Perk</label>
                                            <input id="id_dkPerk" required="required" class="form-control"
                                                   type="text" name="dkPerk" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <!-- HIDDEN INPUT -->
                        <input type="text" id="idTmpAksiBtn" class="hidden">
                        <input type="text" id="idTmpModalBtn" class="hidden">
                        <!-- END HIDDEN INPUT -->

                    </div>
                    <!--END ROW 1 -->
                    <!-- ROW 2 -->

                    <!--END ROW 2 -->
                    <!-- ROW 3 -->

                    <!--END ROW 3 -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">
                                <button name="btnSimpan" class="btn blue" id="id_btnSimpan">
                                    <!--<i class="fa fa-check"></i>--> Simpan
                                </button>
                                <button name="btnUbah" onclick="" class="btn yellow" id="id_btnUbah">
                                    <!--<i class="fa fa-edit"></i>--> Ubah
                                </button>
                                <button name="btnHapus" class="btn red" id="id_btnHapus">
                                    <!--<i class="fa fa-trash"></i>-->
                                    Hapus
                                </button>
                                <button id="id_btnBatal" type="button" class="btn default">Batal</button>
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
                            <button id="id_Reload" style="display: none;"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <table class="table table-striped table-bordered table-hover text_kanan" id="idTabelPerk">
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
                <button type="button" class="btn default" data-dismiss="modal" id="btnCloseModal">Close</button>
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
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url('metronic/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
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
                        jQuery(document).ready(function () {
                            //Metronic.init(); // init metronic core components
                            //Layout.init(); // init current layout
                            //Demo.init(); // init demo features
                            //UITree.init();
                            TableManaged.init();
                            //UIToastr.init();
                        });
                        //$(function () {
                        
                        var TableManaged = function () {

                            var initTable1 = function () {
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
                                    var fbtnModal = $('#idTmpModalBtn').val();
                                    if (fbtnModal == 1) {
                                        var kodePerkRoot = $(this).find("td").eq(0).html();
                                        $('#id_kodePerkRoot').val(kodePerkRoot);
                                        var kodeAltRoot = $(this).find("td").eq(1).html();
                                        $('#id_kodeAltRoot').val(kodeAltRoot);
                                        var namaPerk = $(this).find("td").eq(2).html();
                                        $('#id_namaPerkRoot').val(namaPerk);
                                        var lvlPerkRoot = $(this).find("td").eq(3).html();
                                        $('#id_lvlPerkRoot').val(lvlPerkRoot);
                                        var typePerk = $(this).find("td").eq(4).html();
                                        $('#id_typePerkRoot').val(typePerk);
                                        var dkPerk = $(this).find("td").eq(5).html();
                                        $('#id_dkPerkRoot').val(dkPerk);
                                        $('#id_dkPerk').val(dkPerk);

                                        var lvlPerk = parseInt(lvlPerkRoot) + 1;
                                        $('#id_lvlPerk').val(lvlPerk);

                                        getLastKdPerk(kodePerkRoot, lvlPerkRoot);

                                        $("#btnCloseModal").trigger("click");
                                        $("#id_kodePerk").focus();
                                        $("#id_btnModal2").attr("disabled", true);
                                    } else {
                                        var kodePerk = $(this).find("td").eq(0).html();
                                        $('#id_kodePerk').val(kodePerk);
                                        var kodeAlt = $(this).find("td").eq(1).html();
                                        $('#id_kodeAlt').val(kodeAlt);
                                        var namaPerk = $(this).find("td").eq(2).html();
                                        $('#id_namaPerk').val(namaPerk);
                                        var lvlPerk = $(this).find("td").eq(3).html();
                                        $('#id_lvlPerk').val(lvlPerk);
                                        var typePerk = $(this).find("td").eq(4).html();
                                        $('#id_typePerk').val(typePerk);
                                        var dkPerk = $(this).find("td").eq(5).html();
                                        $('#id_dkPerk').val(dkPerk);

                                        $("#id_btnModal").attr("disabled", true);
                                        $('#id_kodePerk').attr("readonly", true);

                                        $('#id_btnSimpan').attr("disabled", true);
                                        $('#id_btnUbah').attr("disabled", false);
                                        $('#id_btnHapus').attr("disabled", false);

                                        $("#btnCloseModal").trigger("click");
                                    }
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

                        //Ready Doc
                        btnStart();
                        readyToStart();
                        //
                        /* $("#id_namaKyw").focus(); */

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
                            $('#id_typePerk').val('D');
                            $("#id_kodePerk").attr("readonly", false);
                            $("#id_btnModal").attr("disabled", false);
                            $("#id_btnModal2").attr("disabled", false);
                        });
                        $("#id_kodePerkRoot").focusout(function () {
                            var kodePerkRoot = $(this).val();
                            var lvlPerkRoot = $('#id_lvlPerkRoot').val();
                            getLastKdPerk(kodePerkRoot, lvlPerkRoot);
                        });
                        $('#id_btnModal').click(function () {
                            $('#idTmpModalBtn').val('1');
                        });
                        $('#id_btnModal2').click(function () {
                            $('#idTmpModalBtn').val('2');
                        });
                        function getLastKdPerk(kodePerkRoot, lvlPerkRoot) {
                            ajaxModal();
                            if (kodePerkRoot != '') {
                                $.post("<?php echo site_url('/master/master_perkiraan/getLastKdPerk'); ?>",
                                        {
                                            'kodePerkRoot': kodePerkRoot,
                                            'lvlPerkRoot': lvlPerkRoot
                                        }, function (data) {
                                    $('#id_kodePerk').val(data.kdPerk);
                                }, "json");
                            }//if kd<>''
                        }
                        function ajaxSubmit() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>master/master_perkiraan/simpan",
                                data: dataString,
                                success: function (data) {
                                    $('#id_Reload').trigger('click');
                                    $('#id_btnBatal').trigger('click');
                                    readyToStart();
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });

                        }
                        function ajaxUbah() {
                            ajaxModal();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>master/master_perkiraan/ubah",
                                data: dataString,
                                success: function (data) {
                                    $('#id_Reload').trigger('click');
                                    $('#id_btnBatal').trigger('click');
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });
                            
                        }
                        function ajaxHapus() {
                            ajaxModal();
                            var idPerk = $('#id_kodePerk').val();
                            idPerk = idPerk.trim();
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "<?php echo base_url(); ?>master/master_perkiraan/hapus",
                                data: {idPerk: idPerk},
                                success: function (data) {
                                    $('#id_Reload').trigger('click');
                                    $('#id_btnBatal').trigger('click');
                                    UIToastr.init(data.tipePesan, data.pesan);
                                }

                            });
                            
                        }
                        $('#id_formPerkiraan').submit(function (event) {
                            dataString = $("#id_formPerkiraan").serialize();
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
                        function cetak() {
                            window.open("<?php echo base_url('master/master_perkiraan/cetak'); ?>", '_blank');
                        }

</script>


<!-- END JAVASCRIPTS -->