<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_agent extends CI_Model{
	public function Listagent(){		
		$sql="SELECT id, nama,alamat,kota,kontak FROM tbl_agen WHERE is_deleted='no'";
		$query=$this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

	public function getagent($id){
	    $sql="SELECT id, nama,alamat,kota,kontak FROM tbl_agen WHERE id=? AND is_deleted='no'";
	    $query=$this->db->query($sql,$username);
		if ($query){
			return (array)$query->row();
		}else{
            return $this->db->error();
		}
	}
	
	public function insertData($data){
        if ($this->db->insert("tbl_agen", $data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function updateData($data,$id){
		$this->db->where("id",$id);
		if ($this->db->update("tbl_agen",$data)){
            return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

	public function hapusData($data,$id){
		$this->db->where("id",$id);
        if ($this->db->update("tbl_agen",$data)){
		    return array("code"=>0, "message"=>"");
		}else{
            return $this->db->error();
		}
	}

}
?>