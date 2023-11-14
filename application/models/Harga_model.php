<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_model extends CI_Model{

    public function paketharga(){
        $sql="SELECT a.namapaket, a.keterangan,c.nama, c.kontak,x.harga FROM 
                tbl_paket a INNER JOIN ( 
                    SELECT a.harga, a.id_agen, a.id_paket FROM tbl_agenpaket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal,id_agen,id_paket FROM tbl_agenpaket GROUP BY id_agen,id_paket
                    ) x ON a.id_agen=x.id_agen AND a.id_paket=x.id_paket AND a.berlaku=x.tanggal
                ) x ON a.id=x.id_paket
                INNER JOIN tbl_agen c ON c.id=x.id_agen
                WHERE a.is_deleted='no'";
    }

}
?>