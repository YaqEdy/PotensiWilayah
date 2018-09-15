<script>
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();

    });
//Ready Doc
    btnStart();
    readyToStart();
    tglTransStart();
    $("#id_tgltrans").focus();
    $("#id_btnSimpan").click(function () {
        $('#idTmpAksiBtn').val('1');
    });
    $('#id_btnBatal').click(function () {
        resetForm();
        readyToStart();
        tglTransStart();
    });
    function cetak() {
        var ktp = $('#id_ktp').val();//select2('val');
        if (ktp==''){ktp='-';}
            window.open("<?php echo base_url('laporan/lap_ktp/cetak/'); ?>/" + ktp , '_blank');//+ idAdvance + masterId        
    }
</script>
