<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}
        $this->load->model('Booking_model', 'booking');

    }


    public function tiketlist(){
        $tanggal    =$this->security->xss_clean($this->input->post('tanggal'));
        if (empty($tanggal)){
            $awal   = date("Y-m-d");
            $akhir  = date("Y-m-d");
        }else{
            $tanggal	= explode("-",$tanggal);
            $awal       = date_format(date_create($tanggal[0]),"Y-m-d");
            $akhir      = date_format(date_create($tanggal[1]),"Y-m-d");
        }
        $result     = $this->booking->list_ticket_bydate($awal,$akhir);
        $data = array(
            'title'             => NAMETITLE . ' - Laporan',
            'content'           => 'admin/laporan/tiket/index',
            'extra'             => 'admin/laporan/tiket/js/_js_index',
            'laporan'           => $result,
            'laptiket_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }


    public function paketindex()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Laporan',
            'content'           => 'admin/laporan/paket/index',
            'extra'             => 'admin/laporan/paket/js/_js_index',
            'lappaket_active'   => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }

    public function get_listpaket(){
        $tanggal	= explode("-",$this->security->xss_clean($this->input->post('tanggal')));
        $awal       = date_format(date_create($tanggal[0]),"Y-m-d");
        $akhir      = date_format(date_create($tanggal[1]),"Y-m-d");
        $result     = $this->booking->list_ticket_bydate($awal,$akhir);
        echo json_encode($result);

    }



}
