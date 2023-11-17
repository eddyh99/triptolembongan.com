<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{
    public function insert_booking_ticket($datas, $temp_detail)
    {
        $this->db->trans_start();

        foreach($temp_detail as $td){
            echo $td['namatamu'];
            echo $td['nasionality'];
            echo '<br>';

        }

        die;
    }
}
?>