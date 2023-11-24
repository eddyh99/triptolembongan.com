<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{

    public function list_ticket_agent()
    {
        $sql="SELECT a.id,kode_tiket, a.berangkat, a.kembali, 
            concat(c.tujuan,' - ',c.berangkat) as depart, 
            concat(d.tujuan,' - ',d.berangkat) as return_from, e.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff, a.is_deleted as del FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        INNER JOIN tbl_payment e ON a.payment=e.id";
        $query=$this->db->query($sql);
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function list_ticket_bydate($start,$end)
    {
        $sql="SELECT a.id,a.tgl_pesan,kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart,concat(d.tujuan,' - ',d.berangkat) as return_from, 
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff, a.is_deleted as del FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        WHERE a.tgl_pesan BETWEEN ? AND ?
        ";
        $query=$this->db->query($sql,array($start,$end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function get_ticket_agent($id_nama)
    {
        $sql="SELECT a.id, a.tujuan, a.berangkat, c.id as 'id_nama', c.nama, c.kontak,x.harga FROM 
        tbl_tiket a INNER JOIN ( 
            SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
            INNER JOIN (
                SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
            ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
        ) x ON a.id=x.id_tiket
        INNER JOIN tbl_agen c ON c.id=x.id_agen
        WHERE a.is_deleted='no' AND c.id=?";
        $query=$this->db->query($sql, array($id_nama));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function insert_booking_ticket($datas, $detail_booking)
    {
        $this->db->trans_start();
        $this->db->insert("tbl_booking", $datas);
		$error = $this->db->error();
		$id = $this->db->insert_id();

        $detail = array();
        foreach($detail_booking as $dt){
            $temp['id']             = $id;
            $temp['namatamu']       = $dt['namatamu'];
            $temp['nasionality']    = $dt['nasionality'];
            $temp['jenis']          = $dt['jenis'];
            array_push($detail, $temp);
        }
        // echo "<pre>".print_r($detail,true)."</pre>";
        // die;
        $this->db->insert_batch('tbl_booking_detail', $detail);
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

    }

    public function preview_ticket($tiket)
    {
        $sql="SELECT a.id, a.kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart,concat(d.tujuan,' - ',d.berangkat) as return_from, 
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_detail.id) rn FROM tbl_booking_detail) t WHERE rn=1 AND t.id=a.id) as namatamu, 
            (SELECT nasionality FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_detail.id) rn FROM tbl_booking_detail) t WHERE rn=1 AND t.id=a.id) as nasionality, 
            nama as namaagen, pickup, dropoff, remarks FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        WHERE a.is_deleted='no' AND a.kode_tiket=?";
        $query=$this->db->query($sql, array($tiket));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->row();
        }
    }

    public function hapus_booking_ticket($id, $data)
    {
        $this->db->where("id",$id);
		if ($this->db->update("tbl_booking", $data)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

    // ================= =================== ====================
    // ================= BOOKING PAKET MODEL ====================
    // ================= =================== ====================

    public function list_paket_agent()
    {
        $sql="SELECT a.id, kode_tiket, a.berangkat, a.kembali, c.namapaket, c.keterangan, d.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_paket_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_paket_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_paket_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff, a.is_deleted as del FROM tbl_booking_paket a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_paket c ON a.id_paket=c.id
        INNER JOIN tbl_payment d ON a.payment=d.id";
        $query=$this->db->query($sql);
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function list_paket_bydate($start,$end)
    {
        $sql="SELECT a.id, a.tgl_pesan, a.kode_tiket, a.berangkat, a.kembali, c.namapaket, c.keterangan,
            (SELECT count(1) as dws FROM tbl_booking_paket_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_paket_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_paket_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff FROM tbl_booking_paket a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_paket c ON a.id_paket=c.id
        WHERE a.tgl_pesan BETWEEN ? AND ?
        ";
        $query=$this->db->query($sql,array($start,$end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function get_paket_agent($id_nama)
    {
        $sql="SELECT a.id, a.namapaket, a.keterangan, c.id as 'id_nama', c.nama, c.kontak, x.harga FROM 
        tbl_paket a INNER JOIN ( 
            SELECT a.harga, a.id_agen, a.id_paket FROM tbl_agenpaket a 
            INNER JOIN (
                SELECT MAX(berlaku) as tanggal,id_agen,id_paket FROM tbl_agenpaket GROUP BY id_agen,id_paket
            ) x ON a.id_agen=x.id_agen AND a.id_paket=x.id_paket AND a.berlaku=x.tanggal
        ) x ON a.id=x.id_paket
        INNER JOIN tbl_agen c ON c.id=x.id_agen
        WHERE a.is_deleted='no' AND c.id=?";
        $query=$this->db->query($sql, array($id_nama));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function insert_booking_paket($datas, $detail_booking_paket)
    {
        $this->db->trans_start();
        $this->db->insert("tbl_booking_paket", $datas);
		$error = $this->db->error();
		$id = $this->db->insert_id();

        $detail = array();
        foreach($detail_booking_paket as $dt){
            $temp['id']             = $id;
            $temp['namatamu']       = $dt['namatamu'];
            $temp['nasionality']    = $dt['nasionality'];
            $temp['jenis']          = $dt['jenis'];
            array_push($detail, $temp);
        }
        // echo "<pre>".print_r($detail,true)."</pre>";
        // die;
        $this->db->insert_batch('tbl_booking_paket_detail', $detail);
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

    }

    public function preview_paket($tiket)
    {
        $sql="SELECT a.id, kode_tiket, a.berangkat, a.kembali, c.namapaket,
                    (SELECT count(1) as dws FROM tbl_booking_paket_detail WHERE jenis='dewasa' AND id=a.id) as dws,
                    (SELECT count(1) as anak  FROM tbl_booking_paket_detail WHERE jenis='anak' AND id=a.id) as anak,
                    (SELECT count(1) as foc  FROM tbl_booking_paket_detail WHERE jenis='foc' AND id=a.id) as foc, 
                    (SELECT namatamu FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_paket_detail.id) rn FROM tbl_booking_paket_detail) t WHERE rn=1 AND t.id=a.id) as namatamu, 
                    (SELECT nasionality FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_paket_detail.id) rn FROM tbl_booking_paket_detail) t WHERE rn=1 AND t.id=a.id) as nasionality, 
                    nama as namaagen, pickup, dropoff, remarks FROM tbl_booking_paket a 
            LEFT JOIN tbl_agen b ON a.agentid=b.id 
            INNER JOIN tbl_paket c ON a.id_paket=c.id
            WHERE a.is_deleted='no' AND a.kode_tiket=?";
        $query=$this->db->query($sql, array($tiket));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->row();
        }
    }

    public function hapus_booking_paket($id, $data)
    {
        $this->db->where("id",$id);
		if ($this->db->update("tbl_booking_paket ", $data)){
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
