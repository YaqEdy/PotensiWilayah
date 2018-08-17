<style type="text/css">
    table#idTabelProduk th{
        font-size: 13px;
    }
    table#idTabelProduk td{
        font-size: 12px;
    }

    table#idTabelProduk th:nth-child(1),td:nth-child(1),th:nth-child(2),td:nth-child(2){
        display: none;

    }
    table#idTabelProduk td:nth-child(5){
        text-align: right;

    }
    /*
    .styleDataTabel th:nth-child(2),td:nth-child(2){
        display: none;
    }
    */

    table#idTabelPO tfoot {
        display:table-header-group;
    }
</style>
<!-- BEGIN PAGE BREADCRUMB -->

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
                <ul class="nav nav-pills">
                    <li class="linav active" id="linav1">
                        <a href="#tab_2_1" data-toggle="tab" id="navitab_2_1" class="anavitab">
                            Data Produk </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Produk</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab_2_1">
                        <div class="scroller" style="height:400px; ">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="id_Reload" style="display: none;"></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered table-hover text_kanan"
                                           id="idTabelProduk">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Id Master
                                                </th>
                                                <th>
                                                    Id Produk Jadi
                                                </th>
                                                <th>
                                                    Produk Jadi
                                                </th>
                                                <th>
                                                    Nama Formula Produk 
                                                </th>
                                                <th>
                                                    Jumlah
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                                <!-- end col-12 -->
                            </div>
                            <!-- END ROW-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_2_2">
                        <form role="form" method="post" class=""
                              action="<?php echo base_url('master/master_produk_camp/home'); ?>" id="id_formProduk">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Id Produk </label>
                                                    <div class="input-group">
                                                        <input id="id_produkCampId" required="required" class="form-control input-sm"
                                                               type="text" name="produkCampId" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Produk Jadi</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($produkjadi as $row) :
                                                        $data[$row['id_produk']] = $row['nama_produk'];
                                                    endforeach;
                                                    echo form_dropdown('produk_jadi', $data, '', 'id="id_produk_jadi" class="cls_namaProdukJadi form-control select2me kosongDetail"');
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Jumlah produk jadi</label>
                                                    <input id="id_jmlProdJadi" required="required" class="form-control input-sm nomor cls_namaProdukJadi"
                                                           type="text" name="jmlProdJadi" readonly />
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Formula Campuran</label>
                                            <input id="id_namaProdukCamp" required="required" class="form-control input-sm"
                                                   type="text" name="namaProdukCamp"/>

                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Produk murni</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($produkmurni as $row) :
                                                        $data[$row['id_produk']] = $row['nama_produk'];
                                                    endforeach;
                                                    echo form_dropdown('produk_murni', $data, '', 'id="id_produk_murni" class="form-control  kosongDetail"');
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Jumlah produk murni</label>
                                                    <input id="id_jmlProdMurni"  class="form-control input-sm nomor cls_hitungJmlProdukJadi "
                                                           type="text" name="jmlProdMurni"/>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Produk pencampur</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($produkpencampur as $row) :
                                                        $data[$row['id_produk']] = $row['nama_produk'];
                                                    endforeach;
                                                    echo form_dropdown('produk_pencampur', $data, '', 'id="id_produk_pencampur" class="form-control  kosongDetail cls_hitungJmlProdukJadi"');
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Jumlah pencampur</label>
                                                    <input id="id_jmlProdPencamp"  class="form-control input-sm nomor cls_hitungJmlProdukJadi "
                                                           type="text" name="jmlProdPencamp"/>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6">


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
                                        <button id="id_btnBatal" type="reset" class="btn default">Batal</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>    
                </div>    

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
    function hitungJmlProdukJadi() {
        var id_produk_pencampur = $("#id_produk_pencampur").val();
        //alert(id_produk_pencampur);
        if (id_produk_pencampur == '000041' || id_produk_pencampur == '000042' ) {// jika bitrex
            var jmlProdMurni = $("#id_jmlProdMurni").val();

            jmlProdMurni = parseFloat(CleanNumber(jmlProdMurni));
            var jmlProdJadi = jmlProdMurni;

            $("#id_jmlProdJadi").val(number_format(jmlProdJadi, 2));

        } else {//selain bitrex
            var jmlProdMurni = $("#id_jmlProdMurni").val();
            var jmlProdPencamp = $("#id_jmlProdPencamp").val();
            //alert(jmlProdMurni);
            //alert(jmlProdPencamp);

            jmlProdMurni = parseFloat(CleanNumber(jmlProdMurni));
            jmlProdPencamp = parseFloat(CleanNumber(jmlProdPencamp));
            var jmlProdJadi = jmlProdMurni + jmlProdPencamp;

            $("#id_jmlProdJadi").val(number_format(jmlProdJadi, 2));
        }

        setNamaProdukJadi();
    }
    function setNamaProdukJadi() {
        var produkjadi = $("#id_produk_jadi option:selected").text();
        var volume = $("#id_jmlProdJadi").val();
        volume = parseInt(CleanNumber(volume));
        var namaProdukCamp = produkjadi + '-' + volume;
        $("#id_namaProdukCamp").val(namaProdukCamp);
    }
    jQuery(document).ready(function () {
        TableManaged.init();
        ComponentsSelect2.init();
    });
    $(".cls_namaProdukJadi").focusout(function () {
        setNamaProdukJadi();
    });
    $(".cls_namaProdukJadi").change(function () {
        setNamaProdukJadi();
    });
    $(".cls_hitungJmlProdukJadi").focusout(function () {
        hitungJmlProdukJadi();
    });
/*
    $("#id_produk_pencampur").focusout(function () {
        alert("");
        hitungJmlProdukJadi();
    });
*/
    btnStart();
    readyToStart();
    tglTransStart();
    $("#id_namaProduk").focus();

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
        readyToStart();
        tglTransStart();
        /*
        $('#id_produk_jadi').select2('val', '');
        $('#id_produk_murni').select2('val', '');
        $('#id_produk_pencampur').select2('val', '');
        */
       $('#id_produk_jadi').select2('val', '');
        $('#id_produk_murni').val('');//select2('val', '');
        $('#id_produk_pencampur').val('');//select2('val', '');
    });

    // END MENU OPEN
    var TableManaged = function () {
        var initTable1 = function () {
            var table = $('#idTabelProduk');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/master/master_produk_camp/getProdukAll"); ?>",
                "columns": [
                    {"data": "idProdukCamp"},
                    {"data": "idProdukJadi"},
                    {"data": "namaProduk"},
                    {"data": "nama_produk_jadi"},
                    {"data": "total_isi"}
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
                var idProduk = $(this).find("td").eq(0).html();

                $('#id_produkCampId').val(idProduk);
                getDescMaster(idProduk);
                getDescTrans(idProduk, 0);
                getDescTrans(idProduk, 1)

                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaProduk').focus();

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

    $("#id_produkId").focusout(function () {
        var idProduk = $(this).val();
        getDescProduk(idProduk);
    });
    $("#id_produkId").focusout(function () {
        var idProduk = $(this).val();
        getDescProduk(idProduk);
    });
    //id_produk_pencampur
    function getDescMaster(idProduk) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('/master/master_produk_camp/getDescMaster'); ?>",
                    {
                        'idProduk': idProduk
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_produk_jadi').select2('val', data.id_produk_jadi);//val(data.id_produk_jadi);
                    $('#id_namaProdukCamp').val(data.nama_produk_jadi);
                    $('#id_jmlProdJadi').val(number_format(data.total_isi, 2));
                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                    $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    function getDescTrans(idProduk, flag) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('/master/master_produk_camp/getDescTrans'); ?>",
                    {
                        'idProduk': idProduk,
                        'flag': flag
                    }, function (data) {
                if (data.baris == 1) {
                    if (data.flag == 0) {
                        $('#id_produk_murni').val(data.id_produk_isi);//select2('val', data.id_produk_isi);//val(data.id_produk_isi);
                        $('#id_jmlProdMurni').val(number_format(data.packsize1, 2));
                    } else {
                        $('#id_produk_pencampur').val(data.id_produk_isi);//select2('val', data.id_produk_isi);//val(data.id_produk_isi);
                        $('#id_jmlProdPencamp').val(number_format(data.packsize1, 2));
                    }

                    /*
                     $('#').val(data.); */
                } else {
                    alert('Data tidak ditemukan!');
                    $('#id_btnBatal').trigger('click');
                }
            }, "json");
        }//if kd<>''
    }
    function ajaxSubmit() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_produk_camp/simpan",
            data: dataString,
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
    }
    function ajaxUbah() {
        ajaxModal();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_produk_camp/ubah",
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
        var idProduk = $('#id_produkCampId').val();
        idProduk = idProduk.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_produk_camp/hapus",
            data: {produkCampId: idProduk},
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });

    }
    $('#id_formProduk').submit(function (event) {
        dataString = $("#id_formProduk").serialize();

        var aksiBtn = $('#idTmpAksiBtn').val();
        if (aksiBtn == '1') {
            var r = confirm('Anda yakin menyimpan data ini?');
            if (r == true) {
                ajaxSubmit();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '2') {
            var r = confirm('Anda yakin merubah data ini?');
            if (r == true) {
                ajaxUbah();
            } else {//if(r)
                return false;
            }
        } else if (aksiBtn == '3') {
            var r = confirm('Anda yakin menghapus data ini?');
            if (r == true) {
                ajaxHapus();
            } else {//if(r)
                return false;
            }
        }
        event.preventDefault();
    });

</script>


<!-- END JAVASCRIPTS -->