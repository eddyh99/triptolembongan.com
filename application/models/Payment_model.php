<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model{

    public function get_payment()
    {		
		$sql = "SELECT id, payment FROM tbl_payment WHERE is_deleted='no'";
		$query = $this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function insert_payment($datas)
    {
        $result = $this->db->insert("tbl_payment", $datas);
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

    public function get_edit_payment($id)
    {
        $sql = "SELECT id, payment FROM tbl_payment WHERE id=? AND is_deleted='no'";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function edit_payment($id, $datas)
    {
        $this->db->where("id",$id);

		if ($this->db->update("tbl_payment", $datas)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    public function hapus_payment($id, $data)
    {
        $this->db->where("id",$id);
		if ($this->db->update("tbl_payment", $data)){
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