<script>
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();

    });

    btnStart();
    readyToStart();
    
    function cetak() {
        window.open("<?php echo base_url('laporan/lap_bantuan/cetak/'); ?>/" + $("#id_tgl_mulai").val()+"/"+ $("#id_tgl_selesai").val() , '_blank');//+ idAdvance + masterId        
    }



</script>
