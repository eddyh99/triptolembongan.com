<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{
    public function get_ticket_agent($id_nama)
    {
        $sql="SELECT a.id, a.tujuan, a.berangkat, c.id as 'id_nama', c.nama, c.kontak,x.harga FROM 
        tbl_tiket a INNER JOIN ( 
            SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
            INNER JOIN (
                SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
            ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
        ) x ON a.id=x.id_tiket
        INNER JOIN tbl_agen c ON c.id=x.id_agen
        WHERE a.is_deleted='no' AND c.id=?";
        $query=$this->db->query($sql, array($id_nama));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function insert_booking_ticket($datas, $detail_booking)
    {
        $this->db->trans_start();
        $this->db->insert("tbl_booking", $datas);
		$error = $this->db->error();
		$id = $this->db->insert_id();

        $detail = array();
        foreach($detail_booking as $dt){
            $temp['id']             = $id;
            $temp['namatamu']       = $dt['namatamu'];
            $temp['nasionality']    = $dt['nasionality'];
            $temp['jenis']          = $dt['jenis'];
            array_push($detail, $temp);
        }
        // echo "<pre>".print_r($detail,true)."</pre>";
        // die;
        $this->db->insert_batch('tbl_booking_detail', $detail);
        $this->db->trans_complete();

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
            echo $error["message"];
			return array(
                "code" => 511, 
                "message" => $error["message"]
            );
		} else {
			$this->db->trans_commit();
            echo "SUKSES";
			return array(
                "code" => 200, 
                "message" => ""
            );
		}

    }

    // public function summary_booking_ticket()
    // {
    //     $sql = "SELECT a.id as hallo, a.kode_tiket, a.depart, COUNT(*) AS id_detail
    //     FROM tbl_booking a 
    //     LEFT JOIN tbl_booking_detail x ON a.id=x.id
    //     WHERE a.id=51
    //     GROUP BY a.id, a.kode_tiket, a.depart";
    //     $query = $this->db->query($sql);
	// 	if ($query){
	// 		return $query->row();
	// 	}else{
	// 		return $this->db->error();
	// 	}
    // }
}
?>
