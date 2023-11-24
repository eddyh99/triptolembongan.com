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
        $this->load->model('Agent_model', 'agent');
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
            // 'laporan_active'    => 'active',
            'dropdown_tiket'   => 'text-primary'
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function paketlist(){
        $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
        // print_r($tanggal);
        // die;
        if (empty($tanggal)){
            $awal   = date("Y-m-d");
            $akhir  = date("Y-m-d");
        }else{
            $tanggal	= explode("-",$tanggal);
            $awal       = date_format(date_create($tanggal[0]),"Y-m-d");
            $akhir      = date_format(date_create($tanggal[1]),"Y-m-d");
        }
        $result     = $this->booking->list_paket_bydate($awal,$akhir);
        $data = array(
            'title'             => NAMETITLE . ' - Laporan',
            'content'           => 'admin/laporan/paket/index',
            'extra'             => 'admin/laporan/paket/js/_js_index',
            'laporan'           => $result,
            // 'laporan_active'    => 'active',
            'dropdown_paket'   => 'text-primary'
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function peragentiket(){
        $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
        $idagen = $this->security->xss_clean($this->input->post('agen'));

        // print_r($tanggal);
        // die;
        if (empty($tanggal)){
            $awal   = date("Y-m-d");
            $akhir  = date("Y-m-d");
            $idagen = 1;
        }else{
            $newtanggal	= explode("-",$tanggal);
            $awal       = date_format(date_create($newtanggal[0]),"Y-m-d");
            $akhir      = date_format(date_create($newtanggal[1]),"Y-m-d");
        }

        $result     = $this->booking->list_ticket_byagendate($awal,$akhir,$idagen);
        $data = array(
            'title'             => NAMETITLE . ' - Laporan',
            'content'           => 'admin/laporan/tiket/agentiket',
            'extra'             => 'admin/laporan/tiket/js/_js_agentiket',
            'laporan'           => $result,
            'agent'             => $this->agent->get_agent(),
            'idagent'           => (!empty($tanggal))?$idagen:"",
            // 'laporan_active'    => 'active',
            'dropdown_agentiket'   => 'text-primary'
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function peragenpaket(){
        $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
        $idagen = $this->security->xss_clean($this->input->post('agen'));
        // print_r($tanggal);
        // die;
        if (empty($tanggal)){
            $awal   = date("Y-m-d");
            $akhir  = date("Y-m-d");
            $idagen = 1;
        }else{
            $newtanggal	= explode("-",$tanggal);
            $awal       = date_format(date_create($newtanggal[0]),"Y-m-d");
            $akhir      = date_format(date_create($newtanggal[1]),"Y-m-d");
        }
        $result     = $this->booking->list_paket_byagendate($awal,$akhir,$idagen);
        $data = array(
            'title'             => NAMETITLE . ' - Laporan',
            'content'           => 'admin/laporan/paket/agenpaket',
            'extra'             => 'admin/laporan/paket/js/_js_agenpaket',
            'laporan'           => $result,
            'agent'             => $this->agent->get_agent(),
            'idagent'           => (!empty($tanggal))?$idagen:"",
            'tanggal'           => $tanggal,
            // 'laporan_active'    => 'active',
            'dropdown_agenpaket'   => 'text-primary'
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }




}
