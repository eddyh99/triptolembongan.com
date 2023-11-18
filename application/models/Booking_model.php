<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{
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
}
?>
