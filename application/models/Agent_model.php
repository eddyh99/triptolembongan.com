<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model{

    public function get_agent()
    {		
		$sql = "SELECT id, nama, alamat, kota, kontak FROM ". AGENT_TBL ." WHERE is_deleted='no'";
		$query = $this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function insert_agent($datas)
    {
        $result = $this->db->insert(AGENT_TBL, $datas);
        // print_r($this->db->insert(AGENT_TBL, $datas));
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
        $sql = "SELECT id, nama, alamat, kota, kontak FROM " . AGENT_TBL . " WHERE id=? AND is_deleted='no'";
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

		if ($this->db->update(AGENT_TBL, $datas)){
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
		if ($this->db->update(AGENT_TBL, $data)){
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