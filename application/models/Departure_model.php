<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departure_model extends CI_Model{

    public function departure_today($start, $end)
    {        
        $sql="SELECT a.id, kode_tiket, a.berangkat, 
            concat(c.tujuan,' - ',c.berangkat) as depart, dropoff, 
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_detail.id) rn FROM tbl_booking_detail) t WHERE rn=1 AND t.id=a.id) as namatamu,  
            (SELECT nasionality FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_detail.id) rn FROM tbl_booking_detail) t WHERE rn=1 AND t.id=a.id) as nasionality, 
            nama as namaagen, checkin_by, a.userid as reserved, a.is_deleted as del FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        INNER JOIN tbl_payment e ON a.payment=e.id
        WHERE a.berangkat BETWEEN ? AND ?
        ";
        $query=$this->db->query($sql, array($start, $end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function totaltoday($now,$lokasi){
        if ($lokasi=="sanur"){
            $sql="SELECT sum(total) as total FROM (
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE a.berangkat = ? AND tujuan like 'Sanur%'
                UNION ALL
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.return_from=b.id WHERE kembali = ? AND tujuan like 'Lembongan%'
                ) x
            ";
        }else{
            $sql="SELECT sum(total) as total FROM (
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE a.berangkat = ? AND tujuan like 'Lembongan%'
                UNION ALL
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.return_from=b.id WHERE kembali = ? AND tujuan like 'Sanur%'
                ) x
            ";
        }
        $query=$this->db->query($sql,array($now,$now));
        return $query->row()->total;
    }

    public function reservasilist($now,$lokasi){
        if ($lokasi=="sanur"){
            $sql="SELECT kode_tiket, berangkat, kembali, depart, return_from, dws, anak, foc FROM (
                SELECT kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart, 
                    concat(d.tujuan,' - ',d.berangkat) as return_from,
                    (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
                    (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
                    (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc
                 FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id
                 INNER JOIN tbl_tiket c ON a.depart=c.id 
                 LEFT JOIN tbl_tiket d ON a.return_from=d.id
                 WHERE a.berangkat = ? AND b.tujuan like 'Sanur%'
                UNION ALL
                SELECT kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart, 
                    concat(d.tujuan,' - ',d.berangkat) as return_from,
                    (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
                    (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
                    (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc
                 FROM tbl_booking a INNER JOIN tbl_tiket b ON a.return_from=b.id
                 INNER JOIN tbl_tiket c ON a.depart=c.id 
                 LEFT JOIN tbl_tiket d ON a.return_from=d.id
                 WHERE kembali = ? AND b.tujuan like 'Lembongan%'
                ) x
            ";
        }else{
            $sql="SELECT kode_tiket, berangkat, kembali, depart, return_from, dws, anak, foc FROM (
                SELECT kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart, 
                    concat(d.tujuan,' - ',d.berangkat) as return_from,
                    (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
                    (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
                    (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc
                FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id 
                INNER JOIN tbl_tiket c ON a.depart=c.id 
                LEFT JOIN tbl_tiket d ON a.return_from=d.id
                WHERE a.berangkat = ? AND b.tujuan like 'Lembongan%'
                UNION ALL
                SELECT kode_tiket, a.berangkat, a.kembali, concat(c.tujuan,' - ',c.berangkat) as depart, 
                    concat(d.tujuan,' - ',d.berangkat) as return_from,
                    (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
                    (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
                    (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc 
                FROM tbl_booking a INNER JOIN tbl_tiket b ON a.return_from=b.id 
                INNER JOIN tbl_tiket c ON a.depart=c.id 
                LEFT JOIN tbl_tiket d ON a.return_from=d.id
                WHERE kembali = ? AND b.tujuan like 'Sanur%'
                ) x
            ";
        }
        $query=$this->db->query($sql,array($now,$now));
        return $query->result_array();
    }

    public function totalcheckin($now,$lokasi){
        if ($lokasi=="sanur"){
            $sql="SELECT sum(total) as total FROM (
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE a.berangkat = ? AND tujuan like 'Sanur%' AND checkin_by IS NOT NULL
                UNION ALL
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE kembali = ? AND tujuan like 'Lembongan%' AND checkin_return IS NOT NULL
                ) x";
        }else{
            $sql="SELECT sum(total) as total FROM (
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE a.berangkat = ? AND tujuan like 'Lembongan%' AND checkin_by IS NOT NULL
                UNION ALL
                SELECT count(1) as total FROM tbl_booking a INNER JOIN tbl_tiket b ON a.depart=b.id WHERE kembali = ? AND tujuan like 'Sanur%' AND checkin_return IS NOT NULL
                ) x";
        }
        $query=$this->db->query($sql,array($now,$now));
        return $query->row()->total;
    }

    public function departure_today_checkin($start, $end)
    {        
        $sql="SELECT namatamu, nasionality, kode_tiket, IFNULL(kembali,NULL) as ow, c.payment 
        FROM `tbl_booking` a INNER JOIN tbl_booking_detail b ON a.id=b.id 
        INNER JOIN tbl_payment c ON a.payment=c.id
        WHERE a.berangkat BETWEEN ? AND ?  AND checkin_by IS NOT NULL
        ";
        $query=$this->db->query($sql, array($start, $end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }

    public function departure_return($start, $end)
    {        
        $sql="SELECT a.id, kode_tiket, a.berangkat, 
            concat(c.tujuan,' - ',c.berangkat) as depart, r_dropoff as dropoff
            (SELECT count(1) as dws FROM tbl_booking_detail WHERE jenis='dewasa' AND id=a.id) as dws,
            (SELECT count(1) as anak  FROM tbl_booking_detail WHERE jenis='anak' AND id=a.id) as anak,
            (SELECT count(1) as foc  FROM tbl_booking_detail WHERE jenis='foc' AND id=a.id) as foc,
            (SELECT namatamu FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_detail.id) rn FROM tbl_booking_detail) t WHERE rn=1 AND t.id=a.id) as namatamu,  
            (SELECT nasionality FROM(SELECT *, ROW_NUMBER() OVER(PARTITION BY tbl_booking_detail.id) rn FROM tbl_booking_detail) t WHERE rn=1 AND t.id=a.id) as nasionality, 
            nama as namaagen, checkin_by, a.userid as reserved, a.is_deleted as del FROM tbl_booking a 
        LEFT JOIN tbl_agen b ON a.agentid=b.id 
        INNER JOIN tbl_tiket c ON a.depart=c.id 
        LEFT JOIN tbl_tiket d ON a.return_from=d.id
        INNER JOIN tbl_payment e ON a.payment=e.id
        WHERE a.kembali BETWEEN ? AND ?
        ";
        $query=$this->db->query($sql, array($start, $end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }    

    public function departure_return_checkin($start, $end)
    {        
        $sql="SELECT namatamu, nasionality, kode_tiket, IFNULL(kembali,NULL) as ow, c.payment 
        FROM `tbl_booking` a INNER JOIN tbl_booking_detail b ON a.id=b.id 
        INNER JOIN tbl_payment c ON a.payment=c.id
        WHERE a.kembali BETWEEN ? AND ? AND checkin_return IS NOT NULL 
        ";
        $query=$this->db->query($sql, array($start, $end));
        if (!$query){
            return $this->db->error();
        }else{
            return $query->result_array();
        }
    }    

    public function check_in($id_ticket, $data)
    {
        $this->db->where("id",$id_ticket);

		if ($this->db->update("tbl_booking", $data)){
            return array(
                "code"      => 200, 
                "message"   => ""
            );
		}else{
            return $this->db->error();
		}
    }

}
