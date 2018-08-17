<!-- BEGIN PAGE BREADCRUMB -->
<style type="text/css">
    /*    table#idTabelKel th:nth-child(2) {
            display:none;
        }
        table#idTabelKel td:nth-child(2) {
            display:none;
        }*/
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Data Ktp</span>
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
                            Data ktp </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Ktp</a>
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
                                <div class="col-md-8">

                                    <table class="table table-striped table-bordered table-hover text_kanan"
                                           id="idTabelKel">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Id Ktp
                                                </th>
                                                <th>
                                                    Nama
                                                </th>
                                                <th>
                                                    Kecamatan
                                                </th>
                                                <th>
                                                    Kelurahan
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
                              action="<?php echo base_url('master/master_ktp/home'); ?>" id="id_formKel">

                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input id="id_kelId" required="required" class="form-control input-sm"
                                                   type="text" name="kelId" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input id="id_namaKec" class="form-control input-sm"
                                                   type="text" name="namaKec" />
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Tempat lahir</label>
                                                    <input id="id_telp"  class="form-control input-sm"
                                                           type="text" name="telp"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tanggal Lahir</label>
                                                    <input id="id_tglLahir"  placeholder="dd-mm-yyyy"
                                                       class="form-control input-sm date-picker" type="text"
                                                       name="tglLahir" data-date-format="dd-mm-yyyy" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Jenis kelamin</label>
                                                    <select name="jekel" id="id_jekel" class="select2me">
                                                        <option value="0">Pria</option>
                                                        <option value="1">Wanita</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Golongan darah</label>
                                                    <select name="gol_darah" id="id_golDarah" class="select2me">
                                                        <option value="0">O</option>
                                                        <option value="1">A</option>
                                                        <option value="2">B</option>
                                                        <option value="3">AB</option>
                                                        
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="2" cols="" name="alamat" id="id_alamat"
                                                      class="form-control input-sm" placeholder="Alamat"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>RT</label>
                                                    <input id="id_telp"  class="form-control input-sm"
                                                           type="text" name="telp"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>RW</label>
                                                    <input id="id_npwp"  class="form-control input-sm"
                                                           type="text" name="npwp"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Kecamatan</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($kec as $row) :
                                                        $data[$row['id_kec']] = $row['nama_kec'];
                                                    endforeach;
                                                    echo form_dropdown('kecamatan', $data, '', 'required id="id_kec" class="form-control input-sm select2me "');
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Kelurahan</label>
                                                    <?php
                                                    $data = array();
                                                    $data[''] = '';
                                                    foreach ($kel as $row) :
                                                        $data[$row['id_kel']] = $row['nama_kel'];
                                                    endforeach;
                                                    echo form_dropdown('kelurahan', $data, '', 'required id="id_kel" class="form-control input-sm select2me "');
                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Agama</label>
                                                    <select name="agama" id="id_agama" class="select2me">
                                                        <option value="3">Hindu</option>
                                                        <option value="0">Islam</option>
                                                        <option value="1">Khatolik</option>
                                                        <option value="2">Kristen</option>
                                                        
                                                        <option value="4">Budha</option>
                                                        <option value="5">Lain-lain</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Status Kawin</label>
                                                    <select name="agama" id="id_agama" class="select2me">
                                                        <option value="0">Tdk/Blm Kawin</option>
                                                        <option value="1">Kawin</option>
                                                        <option value="2">Duda</option>
                                                        <option value="3">Janda</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Warga Negara</label>
                                                    <select name="agama" id="id_agama" class="select2me">
                                                        <option value="0">WNI</option>
                                                        <option value="1">WNA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Pendidikan</label>
                                                    <select name="pendidikan" id="id_agama" class="select2me">
                                                        <option value="0">SD</option>
                                                        <option value="1">SLTP</option>
                                                        <option value="2">SLTA</option>
                                                        <option value="3">D3</option>
                                                        <option value="4">D4/S1</option>
                                                        <option value="5">S2</option>
                                                        <option value="6">S3</option>
                                                        <option value="7">Profesor</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Pekerjaan</label>
                                                    <input id="id_telp"  class="form-control input-sm"
                                                           type="text" name="telp"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end <div class="col-md-6"> 1 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 225px; height: 170px;">
                                                    <img src="<?= site_url('metronic/img/user.png'); ?>" id="gambarnya" alt="" />    
                                                    
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail hidden" style="max-width: 250px; max-height: 200px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Pilih Foto </span>
                                                        <span class="fileinput-exists"> Ubah Foto </span>
                                                        <input type="file" id="gambar_agunan" name="PATH_FOTO" > </span>
                                                    <input type="hidden" name="unlinkimg" value="">
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Hapus </a>
                                                </div>
                                            </div>

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
<!-- End MODAL Input Data Pengambilan Cucian -->
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        UIBootbox.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
        TableManaged.init();
    });
    var TableManaged = function () {

        var initTable1 = function () {

            var table = $('#idTabelKel');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/master/master_ktp/getKtpAll"); ?>",
                "columns": [
                    {"data": "idKtp"},
                    {"data": "namaKtp"},
                    {"data": "kec"},
                    {"data": "kel"}

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
                var idKel = $(this).find("td").eq(0).html();

                $('#id_kelId').val(idKel);
                getDescKel(idKel);
                $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaKel').focus();

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
    $("#id_namaKel").focus();
    $('#id_btnBatal').click(function () {
        btnStart();
    });
    $("#id_kelId").focusout(function () {
        var idKel = $(this).val();
        getDescKel(idKel);
    });
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#gambarnya').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#gambar_agunan").change(function () {
        readURL(this);
    });

    function getDescKel(idKel) {
        ajaxModal();
        if (idKel != '') {
            $.post("<?php echo site_url('/master/master_ktp/getDescKel'); ?>",
                    {
                        'idKel': idKel
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_namaKel').val(data.nama_kel);
                    $('#id_kecId').val(data.id_kec);
                    $('#id_namaKec').val(data.nama_kec);
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
            url: "<?php echo base_url(); ?>master/master_ktp/simpan",
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
            url: "<?php echo base_url(); ?>master/master_ktp/ubah",
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
        var idKel = $('#id_kelId').val();
        idKel = idKel.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_ktp/hapus",
            data: {idKel: idKel},
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });

    }
    $('#id_formKel').submit(function (event) {
        dataString = $("#id_formKel").serialize();

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