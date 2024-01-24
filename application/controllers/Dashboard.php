<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}

        $this->load->model("booking_model","booking");
        $this->load->model("departure_model","departure");
    }

    public function index()
    {
        // echo "<pre>".print_r($_SESSION['logged_status']['role'],true)."</pre>";
        // die;
        $now=date("Y-m-d");
        if ($_SESSION["logged_status"]["lokasi"]=="Sanur"){
            $totalbooking   = $this->booking->totalbooking($now,"sanur");
            $depart         = $this->departure->totaltoday($now,"sanur");
            $checkin        = $this->departure->totalcheckin($now,"sanur");
        }else{
            $totalbooking   = $this->booking->totalbooking($now,"lembongan");
            $depart         = $this->departure->totaltoday($now,"lembongan");
            $checkin        = $this->departure->totalcheckin($now,"lembongan");
        }

        $data = array(
            'title'         => NAMETITLE . ' - Dashboard',
            'content'       => 'admin/dashboard/index',
            'extra'         => 'admin/dashboard/js/_js_index',
            "booking"       => empty($totalbooking) ? 0 : $totalbooking,
            "depart"        => empty($depart) ? 0 : $depart,
            "checkin"       => empty($checkin) ? 0 : $checkin,
            'dash_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

}
