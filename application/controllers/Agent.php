<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Agent_model', 'agent');
    }

    public function index()
    {
        $data = array(
            'title'         => NAMETITLE . ' - List Agent',
            'content'       => 'admin/agent/index',
            'extra'         => 'admin/agent/js/_js_index',
            'agent_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }

    public function list_agent()
    {
        $result = $this->agent->get_agent();
        echo json_encode($result);
        
    }

    public function tambah_agent()
    {
        $data = array(
            'title'         => NAMETITLE . ' - Tambah Agent',
            'content'       => 'admin/agent/tambah_agent',
            'extra'         => 'admin/agent/js/_js_index',
            'agent_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_process()
    {
        $this->form_validation->set_rules('nama_agent', 'Nama Agent', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("agent/tambah_agent");
			return;
		}


        $input      = $this->input;
        $nama_agent = $this->security->xss_clean($input->post('nama_agent'));
        $alamat     = $this->security->xss_clean($input->post('alamat'));
        $kota       = $this->security->xss_clean($input->post('kota'));
        $kontak     = $this->security->xss_clean($input->post('kontak'));

        $datas = array(
            "nama"      => $nama_agent, 
            "alamat"    => $alamat,
            "kota"      => $kota,
            "kontak"    => $kontak,
            "userid"    => $_SESSION["logged_status"]["username"]
        );

        $result = $this->agent->insert_agent($datas);
        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('agent');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('agent/tambah_agent');
			return;
        }
        // redirect('agent/tambah_agent');
        // echo "<pre>".print_r($datas,true)."</pre>";
        // die;

    }

    public function edit_agent($id)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->agent->get_edit_agent($id);

        $data = array(
            'title'             => NAMETITLE . ' - Edit Agent',
            'content'           => 'admin/agent/edit_agent',
            'extra'             => 'admin/agent/js/_js_index',
            'agent_active'      => 'active',
            'agent'             => $result,
        );

        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function edit_process()
    {
        $this->form_validation->set_rules('nama_agent', 'Nama Agent', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
            redirect('agent/edit_agent/'.base64_encode($id_edit));
			return;
		}


        $input      = $this->input;
        $nama_agent = $this->security->xss_clean($input->post('nama_agent'));
        $alamat     = $this->security->xss_clean($input->post('alamat'));
        $kota       = $this->security->xss_clean($input->post('kota'));
        $kontak     = $this->security->xss_clean($input->post('kontak'));

        $id_edit    = $this->security->xss_clean($input->post('id_edit'));

        $datas = array(
            "nama"      => $nama_agent,
            "alamat"    => $alamat,
            "kota"      => $kota,
            "kontak"    => $kontak,
        );

        $result = $this->agent->edit_agent($id_edit, $datas);

        if($result['code'] == 200){
            $this->session->set_flashdata('success', $this->message->success_edit_msg());
			redirect('agent');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->success_edit_msg());
            redirect('agent/edit_agent/'.base64_encode($id_edit));
            return;
        }
    }

    public function hapus($id)
    {
        $data = array(
			"is_deleted"  => 'yes',
		);

        $id_delete = base64_decode($this->security->xss_clean($id));
        $result = $this->agent->hapus_agent($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('agent');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('agent');
            return;
        }


    }

}