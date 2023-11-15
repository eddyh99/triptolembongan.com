<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_model extends CI_Model{

    public function get_paket()
    {		
		$sql = "SELECT * FROM tbl_paket WHERE is_deleted='no'";
		$query = $this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function insert_paket($datas)
    {
        $result = $this->db->insert("tbl_paket", $datas);
        // print_r($result);
        // die;
        if ($result == 1){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    public function get_edit_paket($id)
    {
        $sql = "SELECT * FROM tbl_paket WHERE id=? AND is_deleted='no'";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function edit_paket($id, $datas)
    {
        $this->db->where("id",$id);

		if ($this->db->update("tbl_paket", $datas)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    public function hapus_paket($id,$data)
    {
            $this->db->where("id",$id);
            if ($this->db->update("tbl_paket", $data)){
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