<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model', 'booking');
    }

    public function index()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Booking Ticket',
            'content'           => 'admin/booking_ticket/index',
            'extra'             => 'admin/booking_ticket/_js_index',
            'bookticket_active' => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function booking_tiket_proses()
    {
        $input          = $this->input;
        $kode_ticket    = $this->security->xss_clean($input->post('kode_ticket'));
        $nama_agen      = $this->security->xss_clean($input->post('nama_agen'));
        $nama_tamu      = $this->security->xss_clean($input->post('nama_tamu'));
        $nasionality    = $this->security->xss_clean($input->post('nasionality'));
        $jenis_penumpang = $this->security->xss_clean($input->post('jenis_penumpang'));

        $temp_detail = array();
        foreach($nama_tamu as $keytamu=>$valuetamu){
            $temp['namatamu']   = $valuetamu;    
            foreach($nasionality as $keynas=>$valuenas){
                $temp['nasionality']   = $valuenas;
                $temp['jenis']   = $jenis_penumpang;
                if($keytamu == $keynas){
                    array_push($temp_detail, $temp);
                }

            }
        }

        
        $datas = array(
            'kode_tiket'    => $kode_ticket,
            'nama_agen'     => $nama_agen,
        );
        
        echo "<pre>".print_r($temp_detail,true)."</pre>";
        die;
        $this->booking->insert_booking_ticket($datas, $temp_detail);


    }


}
