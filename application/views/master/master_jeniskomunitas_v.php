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
                    <span class="caption-subject font-red-sunglo bold uppercase">Data Jenis Komunitas</span>
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
                            Data Jenis Komunitas </a>
                    </li>
                    <li class="linav" id="linav2">
                        <a href="#tab_2_2" data-toggle="tab" id="navitab_2_2" class="anavitab">
                            Form Jenis Komunitas</a>
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
                                                   id="idTabelJeniskomunitas">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Id Jenis Komunitas
                                                        </th>
                                                        <th>
                                                            Nama Jenis Komunitas
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
                      action="<?php echo base_url('master/master_jeniskomunitas/home'); ?>" id="id_formJeniskomunitas">
                    
                            <div class="row">
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="form-group hidden">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Id Jenis Komunitas </label>
                                                    <div class="input-group">
                                                        <input id="id_jeniskomunitasId" required="required" class="form-control input-sm"
                                                               type="text" name="jeniskomunitasId" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Jenis Komunitas</label>
                                            <input id="id_namaJeniskomunitas" required="required" class="form-control input-sm"
                                                   type="text" name="namaJeniskomunitas"/>
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

            var table = $('#idTabelJeniskomunitas');

            // begin first table
            table.dataTable({
                "ajax": "<?php echo base_url("/master/master_jeniskomunitas/getJeniskomunitasAll"); ?>",
                "columns": [
                    {"data": "idJeniskomunitas"},
                    {"data": "namaJeniskomunitas"}
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
                var idJeniskomunitas = $(this).find("td").eq(0).html();

                $('#id_jeniskomunitasId').val(idJeniskomunitas);
                getDescJeniskomunitas(idJeniskomunitas);
                 $("#navitab_2_2").trigger('click');
                //$('#').val();
                $('#btnCloseModalDataUser').trigger('click');
                $('#id_btnSimpan').attr('disabled', true);
                $('#id_btnUbah').attr("disabled", false);
                $('#id_btnHapus').attr("disabled", false);
                $('#id_namaJeniskomunitas').focus();

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
    $("#id_namaJeniskomunitas").focus();
    $('#id_btnBatal').click(function () {
        btnStart();
    });
    $("#id_jeniskomunitasId").focusout(function () {
        var idJeniskomunitas = $(this).val();
        getDescJeniskomunitas(idJeniskomunitas);
    });
    function getDescJeniskomunitas(idJeniskomunitas) {
        ajaxModal();
        if (idJeniskomunitas != '') {
            $.post("<?php echo site_url('/master/master_jeniskomunitas/getDescJeniskomunitas'); ?>",
                    {
                        'idJeniskomunitas': idJeniskomunitas
                    }, function (data) {
                if (data.baris == 1) {
                    $('#id_namaJeniskomunitas').val(data.nama_jeniskomunitas);
                    $('#id_alamat').val(data.alamat);
                    $('#id_telp').val(data.telp);
                    $('#id_npwp').val(data.npwp);
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
            url: "<?php echo base_url(); ?>master/master_jeniskomunitas/simpan",
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
            url: "<?php echo base_url(); ?>master/master_jeniskomunitas/ubah",
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
        var idJeniskomunitas = $('#id_jeniskomunitasId').val();
        idJeniskomunitas = idJeniskomunitas.trim();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "<?php echo base_url(); ?>master/master_jeniskomunitas/hapus",
            data: {idJeniskomunitas: idJeniskomunitas},
            success: function (data) {
                $('#id_Reload').trigger('click');
                $('#id_btnBatal').trigger('click');
                UIToastr.init(data.tipePesan, data.pesan);
            }

        });
        
    }
    $('#id_formJeniskomunitas').submit(function (event) {
        dataString = $("#id_formJeniskomunitas").serialize();
        
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