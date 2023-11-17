<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Ticket_model', 'ticket');
        $this->load->model('Harga_model', 'harga');
        $this->load->model('Agent_model', 'agent');
    }

    public function index()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Daftar Ticket',
            'content'           => 'admin/ticket/index',
            'extra'             => 'admin/ticket/js/_js_index',
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function list_ticket()
    {
        $get_ticket = $this->ticket->get_ticket();
        echo json_encode($get_ticket);
    }

    public function tambah_ticket()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Tambah Ticket',
            'content'           => 'admin/ticket/tambah_ticket',
            'extra'             => 'admin/ticket/js/_js_index',
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_process()
    {
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
		$this->form_validation->set_rules('jam_keberangkatan', 'Jam Keberangkatan', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("ticket/tambah_ticket");
			return;
		}

        $input              = $this->input;
        $tujuan             = $this->security->xss_clean($input->post('tujuan'));
        $jam_keberangkatan  = $this->security->xss_clean($input->post('jam_keberangkatan'));

        $datas = array(
            "tujuan"        => $tujuan, 
            "berangkat"     => $jam_keberangkatan,
            "userid"        => $_SESSION["logged_status"]["username"],
            "created_at"    => date("Y-m-d H:i:s"),
        );

        $result = $this->ticket->insert_ticket($datas);
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('ticket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('ticket/tambah_ticket');
			return;
        }

    }

    public function edit_ticket($id)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->ticket->get_edit_ticket($id);

        $data = array(
            'title'             => NAMETITLE . ' - Edit Ticket',
            'content'           => 'admin/ticket/edit_ticket',
            'extra'             => 'admin/ticket/js/_js_index',
            'ticket'            => $result,
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function edit_process()
    {
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
		$this->form_validation->set_rules('jam_keberangkatan', 'Jam Keberangkatan', 'trim|required');
        $input = $this->input;
        $id_edit = $this->security->xss_clean($input->post('id_edit'));

        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
            redirect('ticket/edit_ticket/'.base64_encode($id_edit));
			return;
		}
        
        $tujuan             = $this->security->xss_clean($input->post('tujuan'));
        $jam_keberangkatan  = $this->security->xss_clean($input->post('jam_keberangkatan'));
        
        $datas = array(
            "tujuan"        => $tujuan, 
            "berangkat"     => $jam_keberangkatan,
            "userid"        => $_SESSION["logged_status"]["username"],
            "update_at"    => date("Y-m-d H:i:s"),
        );

        $result = $this->ticket->edit_ticket($id_edit,$datas);
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('ticket');
			return;
        }else{
            if($result['code'] == 1062){
                $this->session->set_flashdata('error', 'Data Sudah Tersedia !');
                redirect('ticket/edit_ticket/'.base64_encode($id_edit));
                return;
            }

            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
            redirect('ticket/edit_ticket/'.base64_encode($id_edit));
			return;
        }
    }

    public function hapus($id)
    {
        $data = array(
			"is_deleted"  => 'yes',
            "update_at"   => date("Y-m-d H:i:s")
		);

        $id_delete = base64_decode($this->security->xss_clean($id));
        $result = $this->ticket->hapus_ticket($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('ticket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('ticket');
            return;
        }
    }

    public function ticket_agent()
    {
        
        $data = array(
            'title'             => NAMETITLE . ' - Ticket per Agent',
            'content'           => 'admin/ticket_per_agent/index',
            'extra'             => 'admin/ticket_per_agent/js/_js_index',
            'tpa_active'        => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function list_ticket_agent()
    {
        $result = $this->harga->tiketharga();
        echo json_encode($result);
    }

    public function tambah_ticket_agent()
    {
        $agents = $this->agent->get_agent();
        $tickets = $this->ticket->get_ticket();
        
        $data = array(
            'title'         => NAMETITLE . ' - Tambah Ticket per Agent',
            'content'       => 'admin/ticket_per_agent/tambah_ticket_agent',
            'extra'         => 'admin/ticket_per_agent/js/_js_index',
            'agents'         => $agents,
            'tickets'        => $tickets,
            'tpa_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_ticket_agent_process()
    {
        $this->form_validation->set_rules('id_agent', 'Nama Agent', 'trim|required');
		$this->form_validation->set_rules('id_ticket', 'Ticket', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
            redirect('ticket/tambah_ticket_agent_process');
			return;
		}

        $harga = $this->input->post("harga");
        $new_harga = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $harga);
        $_POST["harga"]=$new_harga;
        
        $input = $this->input;
        $id_agent = $this->security->xss_clean($input->post('id_agent'));
        $id_ticket = $this->security->xss_clean($input->post('id_ticket'));
        $harga = $this->security->xss_clean($input->post('harga'));



        $datas = array(
            'id_agen'   => $id_agent,
            'id_tiket'  => $id_ticket,
            'berlaku'   => date("Y:m:d H:i:s"),
            'harga'     => $harga,
            "userid"    => $_SESSION["logged_status"]["username"],
            "created_at"=> date("Y-m-d H:i:s"),
        );

        $result = $this->harga->set_hargatiket($datas);
        
        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('ticket/ticket_agent');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('ticket/tambah_ticket_agent');
            return;
        }
    }
    
    public function edit_ticket_agent($id, $id_nama)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $id_nama	= base64_decode($this->security->xss_clean($id_nama));
        $result = $this->harga->get_edit_hargatiket($id, $id_nama);

        $data = array(
            'title'         => NAMETITLE . ' - Edit Ticket per Agent',
            'content'       => 'admin/ticket_per_agent/edit_ticket_agent',
            'extra'         => 'admin/ticket_per_agent/js/_js_index',
            'tiket_agent'   => $result,
            'tpa_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function edit_detail()
    {
        $result = $this->harga->get_edit_hargatiket(11, 38);
        echo json_encode($result);
    }

}
