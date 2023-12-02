<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model{

    public function get_agent()
    {		
		$sql = "SELECT id, nama, alamat, kota, kontak, tipe FROM tbl_agen WHERE is_deleted='no'";
		$query = $this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function insert_agent($datas)
    {
        $result = $this->db->insert("tbl_agen", $datas);
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

    public function get_edit_agent($id)
    {
        $sql = "SELECT id, nama, alamat, kota, kontak, tipe FROM tbl_agen WHERE id=? AND is_deleted='no'";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function edit_agent($id, $datas)
    {
        $this->db->where("id",$id);

		if ($this->db->update("tbl_agen", $datas)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    public function hapus_agent($id, $data)
    {
        $this->db->where("id",$id);
		if ($this->db->update("tbl_agen", $data)){
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