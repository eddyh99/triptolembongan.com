<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_model extends CI_Model{

    public function paketharga(){
        $sql="SELECT a.id, a.namapaket, a.keterangan,c.nama, c.kontak,x.harga FROM 
                tbl_paket a INNER JOIN ( 
                    SELECT a.harga, a.id_agen, a.id_paket FROM tbl_agenpaket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal, id_agen, id_paket FROM tbl_agenpaket GROUP BY id_agen,id_paket
                    ) x ON a.id_agen=x.id_agen AND a.id_paket=x.id_paket AND a.berlaku=x.tanggal
                ) x ON a.id=x.id_paket
                INNER JOIN tbl_agen c ON c.id=x.id_agen
                WHERE a.is_deleted='no'";
        $query=$this->db->query($sql);
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function set_hargapaket($mdata)
    {
        if (!$this->db->insert('tbl_agenpaket', $mdata)){
            return $this->db->error();
        }else{
            return array("code"=>0,"message"=>"");
        }
    }

    public function get_edit_hargapaket($id_agent, $id_paket)
    {
        $sql="SELECT a.id, a.namapaket, a.keterangan,c.nama, c.kontak,x.harga FROM 
        tbl_paket a INNER JOIN ( 
            SELECT a.harga, a.id_agen, a.id_paket FROM tbl_agenpaket a 
            INNER JOIN (
                SELECT MAX(berlaku) as tanggal, id_agen, id_paket FROM tbl_agenpaket GROUP BY id_agen,id_paket
            ) x ON a.id_agen=x.id_agen AND a.id_paket=x.id_paket AND a.berlaku=x.tanggal
        ) x ON a.id=x.id_paket
        INNER JOIN tbl_agen c ON c.id=x.id_agen
        WHERE a.is_deleted='no' AND a.id_agen=? AND a.id_paket=?";
        $query=$this->db->query($sql, array($id_agent, $id_paket));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function edit_hargapaket($datas)
    {
        $sql = $this->db->insert_string("tbl_agenpaket", $datas)." ON DUPLICATE KEY UPDATE id_agen=?, id_paket=?, berlaku=?, harga=? userid=? update_a";
        $query = $this->db->query($sql, array($datas['tujuan'], $datas['berangkat']));
    }

    public function tiketharga(){
        $sql="SELECT a.id, a.tujuan, a.berangkat,c.nama, c.kontak,x.harga FROM 
                tbl_tiket a INNER JOIN ( 
                    SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                    ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                ) x ON a.id=x.id_tiket
                INNER JOIN tbl_agen c ON c.id=x.id_agen
                WHERE a.is_deleted='no'";
        $query=$this->db->query($sql);
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function set_hargatiket($mdata){
        if (!$this->db->insert('tbl_agentiket', $mdata)){
            return $this->db->error();
        }else{
            return array(
                "code"=>200,
                "message"=>""
            );
        }
    }


}
?>