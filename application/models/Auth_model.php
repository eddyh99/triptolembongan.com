<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{
    // private $table_pengguna = 'pengguna';

	public function VerifyLogin($mdata){
		$sql="SELECT * FROM " . USER_TBL . " WHERE username=? AND passwd=sha1(?)";
		$query = $this->db->query($sql, $mdata);
		// echo "<pre>".print_r($this->db->query($sql, $mdata),	true)."</pre>";
        // die;
        
		if ($query->num_rows()>0){
			return $query->row();
		}else{
			return false;
		}
	}	
}
?>