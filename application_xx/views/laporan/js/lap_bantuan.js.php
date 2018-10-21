<script>
    jQuery(document).ready(function () {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();

    });

    btnStart();
    readyToStart();
    
    function cetak() {
        var imulai=$("#id_tgl_mulai").val();
        var iselesai=$("#id_tgl_selesai").val();
        if(imulai!="" || iselesai!=""){
            window.open("<?php echo base_url('laporan/lap_bantuan/cetak/'); ?>/" + imulai+"/"+ iselesai , '_blank');//+ idAdvance + masterId        
        }else{
            alert("Tanggal mulai dan selesai tidak boleh kosong.!");
        }
    }



</script>
