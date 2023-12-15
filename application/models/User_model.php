<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

    public function get_user()
    {		
		$sql = "SELECT * FROM tbl_user WHERE is_deleted='no'";
		$query = $this->db->query($sql);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
	}

    public function insert_user($datas, $role_detail)
    {
        $this->db->trans_start();
        $this->db->insert("tbl_user", $datas);
        $error = $this->db->error();
        $username = $datas['username'];


        $detail = array();
        foreach($role_detail as $dt){
            $temp['username']       = $username;
            $temp['role']           = $dt['role'];
            array_push($detail, $temp);
        }

        $this->db->insert_batch('tbl_role', $detail);
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








        // $result = $this->db->insert("tbl_user", $datas);
        // if ($result == 1){
        //     return array(
        //         "code"      => 200, 
        //         "message"   => ""
        //     );
		// }else{
        //     return $this->db->error();
		// }
    }

    public function get_edit_user($username)
    {
        $sql = "SELECT * FROM tbl_user WHERE username=? AND is_deleted='no'";
        $query = $this->db->query($sql, $username);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function edit_user($username, $datas)
    {
        $this->db->where("username",$username);

		if ($this->db->update("tbl_user", $datas)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    public function hapus_user($username,$data)
    {
        if ($username!="admin"){
            $this->db->where("username",$username);
            if ($this->db->update("tbl_user", $data)){
                return array(
                    "code"      => 200, 
                    "message"   => ""
                );
            }else{
                return $this->db->error();
            }
        }else{
            return array(
                "code"      => 5051,
                "message"   => "Username admin tidak boleh di hapus"
            );
        }
    }
}
?>