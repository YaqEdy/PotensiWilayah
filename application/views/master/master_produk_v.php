<style type="text/css">
    table#idTabelProduk td:nth-child(3) {
        text-align: right;
    }
    table#idTabelProduk td:nth-child(4) {
        text-align: right;
    }
    table#idTabelProduk td:nth-child(5) {
        text-align: right;
    }
    table#idTabelProduk td:nth-child(6) {
        text-align: right;
    }
    table#idTabelProduk td:nth-child(7) {
        text-align: right;
    }
    table#idTabelProduk td:nth-child(8) {
        text-align: right;
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
                                                    Id Produk
                                                </th>
                                                <th>
                                                    Nama Produk
                                                </th>
                                                <th>
                                                    Cuci Setrika Biasa 
                                                </th>
                                                <th>
                                                    Cuci Setrika Express 
                                                </th>
                                                <th>
                                                    Setrika Biasa 
                                                </th>
                                                <th>
                                                    Setrika Express
                                                </th>
                                                <th>
                                                    Cuci Aja Biasa 
                                                </th>
                                                <th>
                                                    Cuci Aja Express
                                                </th>
                                                <th>
                                                    Dry Clean
                                                </th>
                                                <th>
                                                    Keterangan
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
                              action="<?php echo base_url('master/master_produk/home'); ?>" id="id_formProduk">
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group hidden">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Id Produk </label>
                                                    <div class="input-group">
                                                        <input id="id_produkId" required="required" class="form-control input-sm"
                                                               type="text" name="produkId" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama produk</label>
                                            <input id="id_namaProduk" required="required" class="form-control input-sm"
                                                   type="text" name="namaProduk"/>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Harga Cuci Setrika Biasa</label>
                                                    <input id="id_harga1" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga1"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Harga Cuci Setrika Express</label>
                                                    <input id="id_harga2" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga2"/>
                                                </div>
                                            </div>    

                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Harga Setrika Biasa</label>
                                                    <input id="id_harga3" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga3"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Harga Setrika Express</label>
                                                    <input id="id_harga4" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga4"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Harga Cuci Aja Biasa</label>
                                                    <input id="id_harga5" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga5"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Harga Cuci Aja Express</label>
                                                    <input id="id_harga6" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga6"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Harga Dry Clean</label>
                                                    <input id="id_harga7" required="required" class="form-control input-sm kanan nomor1"
                                                           type="text" name="harga7"/>
                                                </div>
                                                <div class="col-md-6">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control input-sm" rows="2" name="keterangan" id="id_keterangan"></textarea>
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
                                        <?php include "button.inc.php"; ?>
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
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    jQuery(document).ready(function () {
        TableManaged.init();
    });
    var TableManaged = function () {

        var initTable1 = function () {
            var table = $('#idTabelProduk');
            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/master/master_produk/getProdukAll"); ?>",
                "columns": [
                    {"data": "idProduk"},
                    {"data": "namaProduk"},
                    {"data": "harga1"},
                    {"data": "harga2"},
                    {"data": "harga3"},
                    {"data": "harga4"},
                    {"data": "harga5"},
                    {"data": "harga6"},
                    {"data": "harga7"},
                    {"data": "keterangan"}
                ],
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

                $('#id_produkId').val(idProduk);
                getDescProduk(idProduk);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
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
        resetForm();
        readyToStart();
    });
    $("#id_produkId").focusout(function () {
        var idProduk = $(this).val();
        getDescProduk(idProduk);
    });
    function getDescProduk(idProduk) {
        ajaxModal();
        if (idProduk != '') {
            $.post("<?php echo site_url('/master/master_produk/getDescProduk'); ?>",
                    {
                        'idProduk': idProduk
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_namaProduk').val(data.nama_produk);
                    $('#id_harga1').val(data.harga1);
                    $('#id_harga2').val(data.harga2);
                    $('#id_harga3').val(data.harga3);
                    $('#id_harga4').val(data.harga4);
                    $('#id_harga5').val(data.harga5);
                    $('#id_harga6').val(data.harga6);
                    $('#id_harga7').val(data.harga7);
                    $('#id_keterangan').val(data.keterangan);
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
            url: "<?php echo base_url(); ?>master/master_produk/simpan",
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
            url: "<?php echo base_url(); ?>master/master_produk/ubah",
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
        var idProduk = $('#id_produkId').val();

        idProduk = idProduk.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_produk/nonaktif",
            data: {idProduk: idProduk},
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