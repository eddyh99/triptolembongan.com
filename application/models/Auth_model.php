<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{
    // private $table_pengguna = 'pengguna';

	public function VerifyLogin($mdata){
		$sql = "SELECT a.username, a.passwd, a.lokasi, a.is_deleted, GROUP_CONCAT(b.role) as role FROM tbl_user a 
				INNER JOIN tbl_role b ON a.username=b.username
				WHERE a.username=? AND a.passwd=sha1(?)
				GROUP BY a.username";
		$query = $this->db->query($sql, $mdata);
        
		if ($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}	
}
?>