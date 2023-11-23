<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model{

    public function get_ticket()
    {		
		$sql = "SELECT id, tujuan, berangkat FROM tbl_tiket WHERE is_deleted='no'";
		$result = $this->db->query($sql);
		if ($result){
			return $result->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function insert_ticket($datas)
    {

        // $result = $this->db->insert("tbl_tiket", $datas);
        // if ($result == 1){
        //     return array(
        //         "code"      => 200, 
        //         "message"   => ""
        //     );
		// }else{
        //     $error = $this->db->error();
        //     print_r($error);
        //     die;
		// }

        $sql = $this->db->insert_string("tbl_tiket", $datas)." ON DUPLICATE KEY UPDATE is_deleted='no', tujuan=?, berangkat=?";
        $query = $this->db->query($sql, array($datas['tujuan'], $datas['berangkat']));
        
        if ($query == 1){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
        }else{
            return $this->db->error();
        }

    }

    public function get_edit_ticket($id)
    {
        $sql = "SELECT id, tujuan, berangkat FROM tbl_tiket WHERE id=? AND is_deleted='no'";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function edit_ticket($id, $datas)
    {
        $this->db->where("id",$id);

		if ($this->db->update("tbl_tiket", $datas)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }


    public function hapus_ticket($id, $data)
    {
        $this->db->where("id",$id);
		if ($this->db->update("tbl_tiket", $data)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }
}

?>