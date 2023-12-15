<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departure extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}

        $this->load->model('Departure_model', 'departure');
    }


    public function today()
    {

                
        $start      = date("Y-m-d");
        $end        = date("Y-m-d");

        $result = $this->departure->departure_today($start, $end);

        $data = array(
            'title'             => NAMETITLE . ' - Departure Today',
            'content'           => 'admin/departure_today/index',
            'extra'             => 'admin/departure_today/js/_js_index',
            'result'            => $result,
            'departure_today_active' => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function checkin($id)
    {

        $data = array(
			"checkin_by"  => $_SESSION["logged_status"]["username"],
            "update_at"   => date("Y-m-d H:i:s"),
		);
        
        $id_ticket = base64_decode($this->security->xss_clean($id));
        $result = $this->departure->check_in($id_ticket, $data);
        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->success_checkin());
			redirect('departure/today');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_checkin());
            redirect('departure/today');
            return;
        }

    }


}