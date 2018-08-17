<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lap_laba_rugi_m extends CI_Model {

//mamat query
    function getClosingan($bln,$thn) {
        $sql = "select * from closing_perk where bulan='$bln' and tahun='$thn'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function insert_temp_laba_rugi_pendapatanII($bln,$thn,$tgl_trans, $user_id) {
        $sql = "INSERT INTO web_temp_laba_rugi (user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,saldo_akhir,sisi) 
                SELECT '" . $user_id . "' as user_id,'" . $tgl_trans . "' as tanggal,a.kode_perk,b.kode_alt,b.nama_perk,b.type,b.level,b.kode_induk,a.saldo_awal,'L' as sisi 
                FROM closing_perk a left join perkiraan b on a.kode_perk =b.kode_perk where           
                LEFT(b.kode_perk,1)=4 and a.bulan = '" . $bln . "' and a.tahun = '" . $thn . "'";
        $query = $this->db->query($sql);
    }
    function insert_temp_laba_rugi_biayaII($bln,$thn,$tgl_trans, $user_id) {
        $sql = "INSERT INTO web_temp_laba_rugi(user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,saldo_akhir,sisi) 
         SELECT '" . $user_id . "' as user_id,'" . $tgl_trans . "' as tanggal,a.kode_perk,b.kode_alt,b.nama_perk,b.type,b.level,b.kode_induk,a.saldo_awal,'R' as sisi 
                FROM closing_perk a left join perkiraan b on a.kode_perk =b.kode_perk where             
        LEFT(b.kode_perk,1)=6 OR LEFT(b.kode_perk,1)=5 
        and a.bulan = '" . $bln . "' and a.tahun = '" . $thn . "'";
        $query = $this->db->query($sql);
    }

//mamat query

    function insert_temp_laba_rugi_pendapatan($tgl_trans, $user_id) {
        $sql = "INSERT INTO web_temp_laba_rugi(user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,saldo_akhir,sisi) 
                        SELECT '" . $user_id . "' as user_id,'" . $tgl_trans . "' as tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,'0','L' as sisi 
                        FROM perkiraan WHERE LEFT(perkiraan.kode_perk,1)=4 ";
        $query = $this->db->query($sql);
    }

    function insert_temp_laba_rugi_biaya($tgl_trans, $user_id) {
        $sql = "INSERT INTO web_temp_laba_rugi(user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,saldo_akhir,sisi) 
		SELECT '" . $user_id . "' as user_id,'" . $tgl_trans . "' as tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,'0','R' as sisi
		FROM perkiraan WHERE LEFT(perkiraan.kode_perk,1)=5";
        $query = $this->db->query($sql);
    }

    function get_saldo_pendapatan($tgl_trans, $tgl_transsampai, $user_id) {
        $query_ak = "select b.nama_perk,b.type,a.tgl_trans,a.kode_perk,
                    sum(a.kredit)-sum(a.debet) jumlah_ak
                    from trans_detail_perk a left join perkiraan b
                    on a.kode_perk = b.kode_perk 
                    where LEFT(a.kode_perk,1)=4  
                    and a.tgl_trans between '" . $tgl_trans . "' and '" . $tgl_transsampai . "' 
                    and a.post = 1 
                    group by a.kode_perk";
        $query = $this->db->query($query_ak);
        return $query;
    }

    function get_saldo_biaya($tgl_trans, $tgl_transsampai, $user_id) {
        $query_ak = "select b.nama_perk,b.type,a.tgl_trans,a.kode_perk,
                    sum(a.debet)-sum(a.kredit) jumlah_psv
                    from trans_detail_perk a left join perkiraan b
                    on a.kode_perk = b.kode_perk 
                    where LEFT(a.kode_perk,1)=5 
                    and a.tgl_trans between '" . $tgl_trans . "' and '" . $tgl_transsampai . "' 
                    and a.post = 1 
                    group by a.kode_perk";
        $query = $this->db->query($query_ak);
        return $query;
    }

    function update_saldo_temp_pendapatan($kode_perk, $saldo, $user_id) {
        $sql = "UPDATE web_temp_laba_rugi SET saldo_akhir = saldo_akhir +'" . $saldo . "' WHERE kode_perk='" . $kode_perk . "' and user_id='" . $user_id . "'";
        $query = $this->db->query($sql);
    }

    function insert_temp_laba_rugi($tgl_trans, $user_id) {
        $sql = "INSERT INTO web_temp_laba_rugi(user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,saldo_akhir,sisi,flag_pl)
                        SELECT '" . $user_id . "' as user_id,'" . $tgl_trans . "' as tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,saldo_awal,
                        'R' as sisi,flag_pl
                        FROM perkiraan WHERE LEFT(perkiraan.kode_perk,1)=4 OR LEFT(perkiraan.kode_perk,1)=5 OR LEFT(perkiraan.kode_perk,1)=6 
                        OR LEFT(perkiraan.kode_perk,1)=7 OR LEFT(perkiraan.kode_perk,1)=8 OR LEFT(perkiraan.kode_perk,1)=9";
        $query = $this->db->query($sql);
    }

    function get_saldo_bulan($month, $tahun) {
        $query_ak = "SELECT perkiraan.nama_perk,perkiraan.type,trans_detail_perk.tgl_trans,trans_detail_perk.kode_perk,
                    SUM(trans_detail_perk.kredit)- SUM(trans_detail_perk.debet) AS jumlah_ak
                    FROM trans_detail_perk,perkiraan
                    WHERE trans_detail_perk.kode_perk=perkiraan.kode_perk
                    AND MONTH(trans_detail_perk.tgl_trans) = '" . $month . "' AND YEAR(trans_detail_perk.tgl_trans) = '" . $tahun . "' 
                    GROUP BY kode_perk ASC";
        $query = $this->db->query($query_ak);
        return $query;
    }

    function update_saldo_bulan($kode_perk, $saldo, $user_id, $month) {
        $sql = "UPDATE web_temp_laba_rugi SET " . $month . " = " . $month . " +'" . $saldo . "' WHERE kode_perk='" . $kode_perk . "' and user_id='" . $user_id . "'";
        $query = $this->db->query($sql);
    }

    function get_kode_induk($tgl_trans, $user_id) {
        $sql = "select * from web_temp_laba_rugi where type='G' AND user_id='" . $user_id . "' AND tanggal ='" . $tgl_trans . "' order by level desc";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_saldo_induk($kode_perk, $user_id) {
        $sql = "SELECT saldo_akhir from web_temp_laba_rugi where kode_induk='" . $kode_perk . "' AND user_id='" . $user_id . "'";
        $query = $this->db->query($sql);
        return $query;
    }

    function update_saldo_induk($kode_perk, $saldo, $user_id) {
        $sql = "UPDATE web_temp_laba_rugi SET saldo_akhir ='" . $saldo . "' WHERE kode_perk='" . $kode_perk . "' AND user_id='" . $user_id . "'";
        $query = $this->db->query($sql);
    }

    function get_total_pendapatan($tgl_trans) {
        $sql = "SELECT sum(saldo_akhir) as total_pendapatan FROM web_temp_laba_rugi WHERE kode_perk=4 AND tanggal='" . $tgl_trans . "'";
        $query = $this->db->query($sql)->row()->total_pendapatan;
        return $query;
    }

    function get_total_biaya($tgl_trans) {
        $sql = "SELECT sum(saldo_akhir) as total_biaya FROM web_temp_laba_rugi WHERE kode_perk=5 AND tanggal='" . $tgl_trans . "'";
        $query = $this->db->query($sql)->row()->total_biaya;
        return $query;
    }

    function get_total_modal($tgl_trans) {
        $sql = "SELECT saldo_akhir as total_modal FROM web_temp_laba_rugi WHERE (kode_perk=6 or kode_perk=5) AND tanggal='" . $tgl_trans . "'";
        $query = $this->db->query($sql)->row()->total_modal;
        return $query;
    }

    function get_data_neraca($tgl_trans, $user_id) {
        $sql = "SELECT * from web_temp_laba_rugi where user_id = '" . $user_id . "' and tanggal <= '" . $tgl_trans . "' 
		AND (left(kode_perk,1)='4' OR left(kode_perk,1)='6' OR left(kode_perk,1)='5') and level <= 3 order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_neraca_bukan_nol($tgl_trans, $user_id) {
        $sql = "SELECT * from web_temp_laba_rugi where user_id = '" . $user_id . "' and tanggal <= '" . $tgl_trans . "' and 
		saldo_akhir != 0 AND (left(kode_perk,1)='4' OR left(kode_perk,1)='6') and level <= 3 order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function get_data_neracadetail($tgl_trans, $user_id) {
        $sql = "SELECT * from web_temp_laba_rugi where user_id = '" . $user_id . "' and tanggal <= '" . $tgl_trans . "' 
		AND (left(kode_perk,1)='4' OR left(kode_perk,1)='6' OR left(kode_perk,1)='5') order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_data_neraca_bukan_noldetail($tgl_trans, $user_id) {
        $sql = "SELECT * from web_temp_laba_rugi where user_id = '" . $user_id . "' and tanggal <= '" . $tgl_trans . "' and 
		saldo_akhir != 0 AND (left(kode_perk,1)='4' OR left(kode_perk,1)='6') order by kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_saldo_8($user_id) {
        $sql = "select user_id,
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as jan,
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as feb, 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as mar,
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as apr,
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as mei,
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as jun,
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as jul,
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as agu,
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as sep,
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as okt,
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as nov,
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 801) - 
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 802) as des
				from web_temp_laba_rugi2 group by user_id";
        $query = $this->db->query($sql);
        return $query;
    }

//	function update_saldo_induk($kode_perk,$saldo,$jan,$feb,$mar,$apr,$mei,$jun,$jul,$agu,$sep,$okt,$nov,$des,$user_id){	
//		$sql = "UPDATE web_temp_laba_rugi2 SET saldo_akhir ='".$saldo."',jan='".$jan."',feb = '".$feb."',
//		mar = '".$mar."',apr = '".$apr."',mei = '".$mei."',jun = '".$jun."',jul = '".$jul."',agu = '".$agu."',
//		sep = '".$sep."',okt = '".$okt."',nov = '".$nov."',des = '".$des."' WHERE kode_perk='".$kode_perk."' AND user_id='".$user_id."'";
//		$query = $this->db->query($sql);
//	}
    function deleteTempPerk() {
        $this->db->trans_begin();
        $query3 = $this->db->empty_table('web_temp_laba_rugi');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    function get_all_data_45() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where LEFT(w.kode_perk,1)=4 OR LEFT(w.kode_perk,1)=5
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_67() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where LEFT(w.kode_perk,1)=6 OR LEFT(w.kode_perk,1)=7
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_8() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where LEFT(w.kode_perk,1)=8
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_9() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where LEFT(w.kode_perk,1)=8
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_45_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where w.flag_pl ='1' AND (LEFT(w.kode_perk,1)=4 OR LEFT(w.kode_perk,1)=5)
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_67_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where w.flag_pl ='1' AND (LEFT(w.kode_perk,1)=6 OR LEFT(w.kode_perk,1)=7)
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_8_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where w.flag_pl ='1' AND LEFT(w.kode_perk,1)=8
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_9_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total
				from web_temp_laba_rugi2 w where w.flag_pl ='1' AND LEFT(w.kode_perk,1)=8
				order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_45() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where (LEFT(w.kode_perk,1)=4 OR LEFT(w.kode_perk,1)=5) AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_67() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where (LEFT(w.kode_perk,1)=6 OR LEFT(w.kode_perk,1)=7) AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_8() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where LEFT(w.kode_perk,1)=8 AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_9() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where LEFT(w.kode_perk,1)=9 AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_45_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.flag_pl ='1' and (LEFT(w.kode_perk,1)=4 OR LEFT(w.kode_perk,1)=5) AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_67_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.flag_pl ='1' and (LEFT(w.kode_perk,1)=6 OR LEFT(w.kode_perk,1)=7) AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_8_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.flag_pl ='1' and LEFT(w.kode_perk,1)=8 AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_all_data_bukan_nol_9_statis() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.flag_pl ='1' and LEFT(w.kode_perk,1)=9 AND (w.jan != '0' or w.feb != '0' or w.mar != '0' or w.apr != '0' or w.mei != '0' or w.jun != '0' or w.jul != '0'
				or w.agu != '0' or w.sep != '0' or w.okt != '0' or w.nov != '0' or w.des != '0') order by w.kode_perk asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laba_rugi_kotor() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.kode_perk = '101111'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laba_rugi_operasional() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.kode_perk = '101112'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laba_rugi_sebelum_pajak() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.kode_perk = '101113'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laba_rugi_bersih() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.kode_perk = '101114'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_laba_ebitda() {
        $sql = "select w.*,(w.jan + w.feb + w.mar + w.apr + w.mei + w.jun + w.jul + w.agu + w.sep + w.okt + w.nov + w.des) as total 
				from web_temp_laba_rugi2 w 
				where w.kode_perk = '101115'";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function insert_laba_rugi_kotor() {
        $sql = "INSERT INTO web_temp_laba_rugi2 (user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,
				saldo_akhir,jan,feb,mar,apr,mei,jun,jul,agu,sep,okt,nov,des,sisi)
				select user_id,'2016-02-24' as tanggal,'101111','101111','LABA RUGI KOTOR','G',1,'0',0,
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as jan,
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as feb, 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as mar,
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as apr,
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as mei,
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as jun,
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as jul,
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as agu,
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as sep,
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as okt,
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as nov,
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 4) - 
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 5) as des,'R'
				from web_temp_laba_rugi2 group by user_id
				";
        $query = $this->db->query($sql);
    }

    function insert_laba_rugi_operasional() {
        $sql = "INSERT INTO web_temp_laba_rugi2 (user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,
					saldo_akhir,jan,feb,mar,apr,mei,jun,jul,agu,sep,okt,nov,des,sisi)
					select user_id,'2016-02-24' as tanggal,'101112','101112','LABA RUGI OPERASIONAL','G',1,'0',0,
					(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) - 
					(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) -
					(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as jan,
					(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) - 
					(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as feb, 
					(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) - 
					(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as mar,
					(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) - 
					(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) -
					(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as apr,
					(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as mei,
					(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as jun,
					(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as jul,
					(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as agu,
					(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as sep,
					(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as okt,
					(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as nov,
					(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 101111) -
					(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 6) - 
					(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 7) as des,'R'
					from web_temp_laba_rugi2 group by user_id";
        $query = $this->db->query($sql);
    }

    function insert_laba_rugi_sebelum_pajak() {
        $sql = "INSERT INTO web_temp_laba_rugi2 (user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,
				saldo_akhir,jan,feb,mar,apr,mei,jun,jul,agu,sep,okt,nov,des,sisi)
				select user_id,'2016-02-24' as tanggal,'101113','101113','LABA RUGI SEBELUM PAJAK','G',1,'0',0,
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as jan,
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as feb, 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as mar,
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as apr,
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as mei,
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as jun,
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as jul,
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as agu,
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as sep,
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as okt,
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as nov,
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 101112) + 
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 8) as des,'R'
				from web_temp_laba_rugi2 group by user_id
				";
        $query = $this->db->query($sql);
    }

    function insert_laba_rugi_bersih() {
        $sql = "INSERT INTO web_temp_laba_rugi2 (user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,
				saldo_akhir,jan,feb,mar,apr,mei,jun,jul,agu,sep,okt,nov,des,sisi)
				select user_id,'2016-02-24' as tanggal,'101114','101114','LABA RUGI BERSIH','G',1,'0',0,
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as jan,
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as feb, 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as mar,
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as apr,
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as mei,
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as jun,
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as jul,
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as agu,
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as sep,
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as okt,
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as nov,
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 101113) - 
				(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as des,'R'
				from web_temp_laba_rugi2 group by user_id";
        $query = $this->db->query($sql);
    }

    function insert_ebitda() {
        $sql = "INSERT INTO web_temp_laba_rugi2 (user_id,tanggal,kode_perk,kode_alt,nama_perk,type,level,kode_induk,
			saldo_akhir,jan,feb,mar,apr,mei,jun,jul,agu,sep,okt,nov,des,sisi)
			select user_id,'2016-02-24' as tanggal,'101115','101115','LABA EBITDA','G',1,'0',0,
			(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) +
			(select jan as saldo_jan from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as jan,
			(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select feb as saldo_feb from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as feb, 
			(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select mar as saldo_mar from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as mar,
			(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select apr as saldo_apr from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as apr,
			(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select mei as saldo_mei from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as mei,
			(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select jun as saldo_jun from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as jun,
			(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select jul as saldo_jul from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as jul,
			(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select agu as saldo_agu from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as agu,
			(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select sep as saldo_sep from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as sep,
			(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select okt as saldo_okt from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as okt,
			(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) + 
			(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) +
			(select nov as saldo_nov from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as nov,
			(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 101114) +
			(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 80202) +
			(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 718) +
			(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 602) +
			(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 50317) + 
			(select des as saldo_des from web_temp_laba_rugi2 w2 where w2.kode_perk = 9) as des,'R'
			from web_temp_laba_rugi2 group by user_id";
        $query = $this->db->query($sql);
    }

}

/* End of file kasmodel.php */
/* Location: ./application/models/kasmodel.php */