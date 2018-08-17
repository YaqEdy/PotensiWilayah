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
                    <i class="fa fa-pencil-square-o font-blue-chambray"></i>
                    <span class="caption-subject font-blue-chambray bold uppercase"><?php echo $menu_header; ?></span>
                </div>
                <div class="actions">
                    <a class="btn btn-icon-only btn-default btn-sm fullscreen" href="javascript:;" data-original-title="" title="">
                    </a>
                </div>                
            </div>
            <div class="portlet-body">
                <div>
                    <span id="event_result">
                    </span>
                </div>
                <form role="form" method="post" id="id_laporanNeraca">
                    <div class="row">
                        <div class="form-body">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input id="id_tanggal" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" class="form-control date-picker input-sm cls_tglhariini" type="text" name="tanggalAwal" />                                                   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bentuk Neraca</label>
                                    <select id="id_bentuk" class="form-control input-sm select2me" name="bentuk">
                                        <option value=""></option>
                                        <option value="T">Bentuk T</option>
                                        <option value="G">Garis Lurus</option>
                                    </select>
                                </div>
                            </div>   
                            <!--end <div class="col-md-6"> 1 -->
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" value="1" name="nol" id="id_nol">
                                        Tampilkan Hasil Nol<span></span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mt-checkbox-list">
                                    <label class="mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" value="1" name="tipe" id="id_tipe">
                                        Hanya akun General<span></span></label>
                                </div>
                            </div>
                            
                        </div>

                    </div>    
                      

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-actions">
                                <a href="javascript:;" class="btn blue btn-medium" onclick="cetak();">
                                    <i class="fa fa-print"></i> Cetak </a>
                                <a href="javascript:;" class="btn green btn-medium" onclick="excel();">
                                    <i class="fa fa-print"></i> Excel </a>
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
<?php $this->load->view('app.min.inc.php'); ?>
<script>
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        $("input[readonly='true']").focus(function () {
            $(this).next();
        });
    });

    tglTransStart();
    //Ready Doc
    btnStart();
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });

    $('#id_btnBatal').click(function () {
        btnStart();
        resetForm();
    });

    function cetak() {
        var tglAwal = $('#id_tanggal').val();
        var bentuk = $('#id_bentuk').val();
        var nol = $("#id_nol").is(":checked") ? 1 : 0;
        var tipe = $("#id_tipe").is(":checked") ? 1 : 0;
        if (tglAwal == '') {
            alert('Silahkan pilih tanggal');
            return false;
        }
        if (bentuk == '') {
            alert('Silahkan pilih bentuk neraca');
            return false;
        }
        if (bentuk == 'T') {
            window.open("<?php echo base_url('laporan/laporan_neraca_c/cetak_t/'); ?>/" + tglAwal + "/" + nol + "/" + tipe, '_blank');
        } else {
            window.open("<?php echo base_url('laporan/laporan_neraca_c/cetak/'); ?>/" + tglAwal + "/" + nol + "/" + tipe, '_blank');
        }
    }
    $("#id_nol").change(function(){
        //alert("1");
        //var nol = $("#id_nol").is(":checked");
        
        //alert(nol);
    });
    function excel() {
        var tglAwal = $('#id_tanggal').val();
        var bentuk = $('#id_bentuk').val();
        var nol = $("#id_nol").is(":checked") ? 1 : 0;
        var tipe = $("#id_tipe").is(":checked") ? 1 : 0;
        if (tglAwal == '') {
            alert('Silahkan pilih tanggal');
            return false;
        }
        if (bentuk == '') {
            alert('Silahkan pilih bentuk neraca');
            return false;
        }
        if (bentuk == 'T') {
            window.open("<?php echo base_url('laporan/laporan_neraca_c/cetak_t_excel/'); ?>/" + tglAwal + "/" + nol + "/" + tipe, '_blank');
        } else {
            window.open("<?php echo base_url('laporan/laporan_neraca_c/cetak_excel/'); ?>/" + tglAwal + "/" + nol + "/" + tipe, '_blank');
        }
    }

    /*function save(){
     var tglAwal = $('#id_tanggalAwal').val();
     var tglAkhir = $('#id_tanggalAkhir').val();
     if(tglAwal == ''){
     alert('Silahkan pilih tanggal awal');
     return false;
     }
     if(tglAkhir == ''){
     alert('Silahkan pilih tanggal akhir');
     return false;
     }else{
     window.open("<?php echo base_url('laporan_rekap_adv/cetak_excel/'); ?>/"+tglAwal+"/"+tglAkhir, '');	
     }
     }*/

</script>


<!-- END JAVASCRIPTS -->