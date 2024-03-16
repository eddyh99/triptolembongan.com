<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{

    public function list_ticket_agent($start, $end, $tipe)
    {    
        if ($start==$end){
            $end = date('Y-m-d', strtotime($end . ' +1 day'));
        }
        if ($tipe=="all"){
            $sql="SELECT a.id, kode_tiket, a.berangkat, IF(is_open='yes','Open',a.kembali) as kembali, a.is_open, a.remarks, a.pickup, a.dropoff,
            concat(c.tujuan,' - ',c.berangkat) as depart, c.tujuan as p_depart, c.berangkat as p_time,
            concat(d.tujuan,' - ',d.berangkat) as return_from, d.tujuan as r_depart, d.berangkat as r_time, e.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as namatamu,  
            (SELECT nasionality FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as nasionality, 
            nama as namaagen, pickup, dropoff, tgl_pesan, r_pickup, r_dropoff, charge, checkin_by, a.userid as reserved, a.is_deleted as del FROM tbl_booking a 
            LEFT JOIN tbl_agen b ON a.agentid=b.id 
            INNER JOIN tbl_tiket c ON a.depart=c.id 
            LEFT JOIN tbl_tiket d ON a.return_from=d.id
            INNER JOIN tbl_payment e ON a.payment=e.id
            WHERE a.tgl_pesan BETWEEN ? AND ?
            ";
        }elseif ($tipe=="return"){
            $sql="SELECT a.id, kode_tiket, a.berangkat, a.kembali, a.is_open, a.remarks,a.pickup, a.dropoff,
            concat(c.tujuan,' - ',c.berangkat) as depart, c.tujuan as p_depart, c.berangkat as p_time,
            concat(d.tujuan,' - ',d.berangkat) as return_from, d.tujuan as r_depart, d.berangkat as r_time, e.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as namatamu,  
            (SELECT nasionality FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as nasionality, 
            nama as namaagen, pickup, dropoff, r_pickup, r_dropoff, charge, checkin_by, a.userid as reserved, a.is_deleted as del FROM tbl_booking a 
            LEFT JOIN tbl_agen b ON a.agentid=b.id 
            INNER JOIN tbl_tiket c ON a.depart=c.id 
            LEFT JOIN tbl_tiket d ON a.return_from=d.id
            INNER JOIN tbl_payment e ON a.payment=e.id
            WHERE a.tgl_pesan BETWEEN ? AND ? AND a.kembali IS NOT NULL AND is_open='no'
            ";
        }elseif ($tipe=="oneway"){
            $sql="SELECT a.id, kode_tiket, a.berangkat, a.kembali, a.is_open, a.remarks,a.pickup, a.dropoff,
            concat(c.tujuan,' - ',c.berangkat) as depart, c.tujuan as p_depart, c.berangkat as p_time,
            concat(d.tujuan,' - ',d.berangkat) as return_from, d.tujuan as r_depart, d.berangkat as r_time, e.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as namatamu,  
            (SELECT nasionality FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as nasionality, 
            nama as namaagen, pickup, dropoff, r_pickup, r_dropoff, charge, checkin_by, a.userid as reserved, a.is_deleted as del FROM tbl_booking a 
            LEFT JOIN tbl_agen b ON a.agentid=b.id 
            INNER JOIN tbl_tiket c ON a.depart=c.id 
            LEFT JOIN tbl_tiket d ON a.return_from=d.id
            INNER JOIN tbl_payment e ON a.payment=e.id
            WHERE a.tgl_pesan BETWEEN ? AND ? AND a.kembali IS NULL  AND is_open='no'
            ";
        }elseif ($tipe=="open"){
            $sql="SELECT a.id, kode_tiket, a.berangkat, IF(is_open='yes','Open',a.kembali) as kembali, a.is_open, a.remarks,a.pickup, a.dropoff,
            concat(c.tujuan,' - ',c.berangkat) as depart, c.tujuan as p_depart, c.berangkat as p_time,
            concat(d.tujuan,' - ',d.berangkat) as return_from, d.tujuan as r_depart, d.berangkat as r_time, e.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as namatamu,  
            (SELECT nasionality FROM tbl_booking_detail bd INNER JOIN (SELECT MIN(unik) as unik FROM tbl_booking_detail WHERE jenis='dewasa' GROUP BY id) bdu ON bd.unik=bdu.unik AND bd.id=a.id) as nasionality, 
            nama as namaagen, pickup, dropoff, r_pickup, r_dropoff, charge, checkin_by, a.userid as reserved, a.is_deleted as del FROM tbl_booking a 
            LEFT JOIN tbl_agen b ON a.agentid=b.id 
            INNER JOIN tbl_tiket c ON a.depart=c.id 
            LEFT JOIN tbl_tiket d ON a.return_from=d.id
            INNER JOIN tbl_payment e ON a.payment=e.id
            WHERE a.tgl_pesan BETWEEN ? AND ? AND a.is_open='yes'
            ";
        }
        $query=$this->db->query($sql, array($start, $end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function totalbooking($now,$lokasi){
        if ($lokasi=="sanur"){
            $sql="SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE tgl_pesan=? AND b.tujuan like 'Sanur%'";
        }else{
            $sql="SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE tgl_pesan=? AND b.tujuan like 'Lembongan%'";
        }
        $query=$this->db->query($sql,$now);
        return $query->row()->total;

    }
    public function list_ticket_bydate($start,$end)
    {
        $sql="SELECT a.id,a.tgl_pesan,kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart,concat(d.tujuan,' - ',d.berangkat) as return_from, 
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff, charge,  y.harga as brkt, z.harga as kmbl, a.is_deleted as del FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        INNER JOIN (
            SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                    ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                ) y
        ON b.id=y.id_agen AND a.depart=y.id_tiket
        LEFT JOIN (
            SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                    ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                ) z
        ON b.id=z.id_agen AND a.return_from=z.id_tiket
        WHERE a.tgl_pesan BETWEEN ? AND ?
        ";
        $query=$this->db->query($sql,array($start,$end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function list_ticket_byagendate($start, $end, $idagen)
    {
        $sql="SELECT a.id,a.tgl_pesan, kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart,concat(d.tujuan,' - ',d.berangkat) as return_from, 
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff, y.harga as brkt, z.harga as kmbl, a.is_deleted as del,a.charge FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        INNER JOIN (
            SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                    ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                ) y
        ON b.id=y.id_agen AND a.depart=y.id_tiket
        LEFT JOIN (
            SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                    ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                ) z
        ON b.id=z.id_agen AND a.return_from=z.id_tiket
        WHERE a.tgl_pesan BETWEEN ? AND ? AND a.agentid=?
        ";
        $query=$this->db->query($sql,array($start,$end,$idagen));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function rangkuman_bulanan($month,$year,$tipe)
    {
        $sql="SELECT sum((SELECT count(1) as tamu FROM tbl_booking_detail WHERE id=a.id)) as tamu,nama as namaagen, sum(IFNULL(y.harga,0)+IFNULL(z.harga,0)) as rate, sum(a.charge) as charge 
            FROM tbl_booking a 
            LEFT JOIN tbl_agen b ON a.agentid=b.id 
            INNER JOIN tbl_tiket c ON a.depart=c.id 
            LEFT JOIN tbl_tiket d ON a.return_from=d.id
            INNER JOIN (
                SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                        INNER JOIN (
                            SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                        ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                    ) y
            ON b.id=y.id_agen AND a.depart=y.id_tiket
            LEFT JOIN (
                SELECT a.harga, a.id_agen, a.id_tiket FROM tbl_agentiket a 
                        INNER JOIN (
                            SELECT MAX(berlaku) as tanggal,id_agen,id_tiket FROM tbl_agentiket GROUP BY id_agen,id_tiket
                        ) x ON a.id_agen=x.id_agen AND a.id_tiket=x.id_tiket AND a.berlaku=x.tanggal
                    ) z
            ON b.id=z.id_agen AND a.return_from=z.id_tiket
            WHERE MONTH(a.tgl_pesan)=? AND YEAR(a.tgl_pesan)=? AND b.tipe=?
            GROUP BY b.id;
        ";
        $query=$this->db->query($sql,array($month,$year,$tipe));
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
        // echo "<pre>".print_r($id,true)."</pre>";
        // die;

        $detail = array();
        foreach($detail_booking as $dt){
            $temp['id']             = $id;
            $temp['namatamu']       = $dt['namatamu'];
            $temp['nasionality']    = $dt['nasionality'];
            $temp['nope']           = $dt['nope'];
            $temp['email']          = $dt['email'];
            $temp['jenis']          = $dt['jenis'];
            $temp['jnskel']          = $dt['jnskel'];            
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

    public function update_open($id, $datas)
    {
        $this->db->where("id",$id);

		if ($this->db->update("tbl_booking", $datas)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
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

    public function get_edit_ticket($id)
    {
        $sql = "SELECT * FROM tbl_booking WHERE id=? AND checkin_by IS NULL AND is_deleted='no'";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function get_edit_ticket_detail($id)
    {
        $sql = "SELECT a.id as 'id_detail', a.namatamu, a.nasionality, a.nope, a.email, a.jenis,jnskel FROM tbl_booking_detail a
        INNER JOIN tbl_booking b ON a.id=b.id
        WHERE a.id=?";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
    }


    public function update_booking_ticket($id, $datas, $detail_booking)
    {
        $this->db->trans_start();
        $sqlDelete = "DELETE FROM tbl_booking
        WHERE tbl_booking.id=?";
		$this->db->query($sqlDelete, array($id));
		$error[] = $this->db->error();

        $this->db->insert("tbl_booking", $datas);
		$error[] = $this->db->error();
		$id = $this->db->insert_id();

        $detail = array();
        foreach($detail_booking as $dt){
            $temp['id']             = $id;
            $temp['namatamu']       = $dt['namatamu'];
            $temp['nasionality']    = $dt['nasionality'];
            $temp['nope']           = $dt['nope'];
            $temp['email']          = $dt['email'];
            $temp['jenis']          = $dt['jenis'];
            $temp['jnskel']         = $dt['jnskel'];
            array_push($detail, $temp);
        }
        // echo "<pre>".print_r($detail,true)."</pre>";
        // die;
        $this->db->insert_batch('tbl_booking_detail', $detail);
        $error[]=$this->db->error();
        $this->db->trans_complete();

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
			return array(
                "code" => 511, 
                "message" => $error
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

    

    // ================= =================== ====================
    // ================= BOOKING PAKET MODEL ====================
    // ================= =================== ====================

    public function list_paket_agent($start, $end)
    {
        if ($start==$end){
            $end = date('Y-m-d', strtotime($end . ' +1 day'));
        }
        $sql="SELECT a.id, kode_tiket, a.berangkat, a.kembali, c.namapaket, c.keterangan, d.payment as payment,
            (SELECT count(1) as dws FROM tbl_booking_paket_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_paket_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_paket_detail WHERE jenis='foc' AND id=a.id) as foc, 
            (SELECT namatamu FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_paket_detail.id) rn FROM tbl_booking_paket_detail) t WHERE rn=1 AND t.id=a.id) as namatamu, 
            (SELECT nasionality FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_paket_detail.id) rn FROM tbl_booking_paket_detail) t WHERE rn=1 AND t.id=a.id) as nasionality,  
            nama as namaagen, pickup, dropoff, charge, checkin_by, a.userid,  a.is_deleted as del FROM tbl_booking_paket a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_paket c ON a.id_paket=c.id
        INNER JOIN tbl_payment d ON a.payment=d.id
        WHERE a.tgl_pesan BETWEEN ? AND ?";
        $query=$this->db->query($sql, array($start, $end));
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
            nama as namaagen, pickup, dropoff, charge, y.harga FROM tbl_booking_paket a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_paket c ON a.id_paket=c.id
        INNER JOIN (
            SELECT a.harga, a.id_agen, a.id_paket FROM tbl_agenpaket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal, id_agen, id_paket FROM tbl_agenpaket GROUP BY id_agen,id_paket
                    ) x ON a.id_agen=x.id_agen AND a.id_paket=x.id_paket AND a.berlaku=x.tanggal
            ) y
        ON b.id=y.id_agen
        WHERE a.tgl_pesan BETWEEN ? AND ?
        ";
        $query=$this->db->query($sql,array($start,$end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function list_paket_byagendate($start,$end,$idagen)
    {
        $sql="SELECT a.id, a.tgl_pesan, a.kode_tiket, a.berangkat, a.kembali, c.namapaket, c.keterangan,
            (SELECT count(1) as dws FROM tbl_booking_paket_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_paket_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_paket_detail WHERE jenis='foc' AND id=a.id) as foc, 
            nama as namaagen, pickup, dropoff, charge, y.harga, a.charge FROM tbl_booking_paket a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_paket c ON a.id_paket=c.id
        INNER JOIN (
            SELECT a.harga, a.id_agen, a.id_paket FROM tbl_agenpaket a 
                    INNER JOIN (
                        SELECT MAX(berlaku) as tanggal, id_agen, id_paket FROM tbl_agenpaket GROUP BY id_agen,id_paket
                    ) x ON a.id_agen=x.id_agen AND a.id_paket=x.id_paket AND a.berlaku=x.tanggal
            ) y
        ON b.id=y.id_agen
        WHERE a.tgl_pesan BETWEEN ? AND ? AND a.agentid=?
        ";
        $query=$this->db->query($sql,array($start,$end,$idagen));
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
            $temp['nope']           = $dt['nope'];
            $temp['email']          = $dt['email'];
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

    public function get_edit_paket($id)
    {
        $sql = "SELECT * FROM tbl_booking_paket WHERE id=? AND checkin_by IS NULL AND is_deleted='no'";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->row();
		}else{
			return $this->db->error();
		}
    }

    public function get_editpaket_detail($id)
    {
        $sql = "SELECT a.id as 'id_detail', a.namatamu, a.nasionality, a.nope, a.email, a.jenis FROM tbl_booking_paket_detail a
        INNER JOIN tbl_booking_paket b ON a.id=b.id
        WHERE a.id=?";
        $query = $this->db->query($sql, $id);
		if ($query){
			return $query->result_array();
		}else{
			return $this->db->error();
		}
    }

    public function update_booking_paket($id, $datas, $detail_booking_paket)
    {
        $this->db->trans_start();
        $sqlDelete = "DELETE tbl_booking_paket, tbl_booking_paket_detail FROM tbl_booking_paket 
        INNER JOIN tbl_booking_paket_detail ON tbl_booking_paket.id=tbl_booking_paket_detail.id
        WHERE tbl_booking_paket.id=?";
		$this->db->query($sqlDelete,array($id));

        $this->db->insert("tbl_booking_paket", $datas);
		$error = $this->db->error();
		$id = $this->db->insert_id();
        // echo "<pre>".print_r($ins,true)."</pre>";
        // die;

        $detail = array();
        foreach($detail_booking_paket as $dt){
            $temp['id']             = $id;
            $temp['namatamu']       = $dt['namatamu'];
            $temp['nasionality']    = $dt['nasionality'];
            $temp['nope']           = $dt['nope'];
            $temp['email']          = $dt['email'];
            $temp['jenis']          = $dt['jenis'];
            array_push($detail, $temp);
        }
        // echo "<pre>".print_r($detail,true)."</pre>";
        // die;
        $this->db->insert_batch('tbl_booking_paket_detail', $detail);
        $this->db->trans_complete();

		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();
            trigger_error("Commit failed"); // throw my own error, sadly never thrown :(
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

}
?>
