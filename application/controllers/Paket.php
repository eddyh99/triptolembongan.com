<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Paket_model', 'paket');
        $this->load->model('Harga_model', 'harga');
        $this->load->model('Agent_model', 'agent');
    }

    public function index()
    {
        $data = array(
            'title'         => NAMETITLE . ' - List paket',
            'content'       => 'admin/paket/index',
            'extra'         => 'admin/paket/js/_js_index',
            'paket_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }

    public function list_paket()
    {
        $result = $this->paket->get_paket();
        echo json_encode($result);
        
    }

    public function tambah_paket()
    {
        $data = array(
            'title'         => NAMETITLE . ' - Tambah paket',
            'content'       => 'admin/paket/tambah_paket',
            'extra'         => 'admin/paket/js/_js_index',
            'paket_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_process()
    {
        $this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("paket/tambah_paket");
			return;
		}


        $input      = $this->input;
        $namapaket  = $this->security->xss_clean($input->post('namapaket'));
        $keterangan = $this->security->xss_clean($input->post('keterangan'));

        $datas = array(
            "namapaket"  => $namapaket, 
            "keterangan" => $keterangan,
            "userid"     => $_SESSION["logged_status"]["username"],
            "created_at"=> date("Y-m-d H:i:s")
        );

        $result = $this->paket->insert_paket($datas);
        // echo "<pre>".print_r($datas,true)."</pre>";
        // die;
        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('paket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('paket/tambah_paket');
			return;
        }
        // redirect('paket/tambah_paket');
        // echo "<pre>".print_r($datas,true)."</pre>";
        // die;

    }

    public function edit_paket($id)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->paket->get_edit_paket($id);

        $data = array(
            'title'             => NAMETITLE . ' - Edit paket',
            'content'           => 'admin/paket/edit_paket',
            'extra'             => 'admin/paket/js/_js_index',
            'paket_active'       => 'active',
            'paket'              => $result,
        );

        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function edit_process()
    {
        $this->form_validation->set_rules('namapaket', 'Nama Paket', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
            redirect('paket/edit_paket/'.base64_encode($id_edit));
			return;
		}


        $input      = $this->input;
        $namapaket  = $this->security->xss_clean($input->post('namapaket'));
        $keterangan = $this->security->xss_clean($input->post('keterangan'));

        $datas = array(
            "namapaket"  => $namapaket, 
            "keterangan" => $keterangan,
            "userid"     => $_SESSION["logged_status"]["username"],
            "update_at"=> date("Y-m-d H:i:s")
        );
        
        $id_edit    = $this->security->xss_clean($input->post('id_edit'));

        $result = $this->paket->edit_paket($id_edit,$datas);

        if($result['code'] == 200){
            $this->session->set_flashdata('success', $this->message->success_edit_msg());
			redirect('paket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->success_edit_msg());
            redirect('paket/edit_paket/'.base64_encode($id_edit));
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
        if ($id_delete=="admin"){
            $this->session->set_flashdata('success', "paketname admin tidak dapat di hapus");
            redirect("paket");
            return;
        }
        $result = $this->paket->hapus_paket($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('paket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('paket');
            return;
        }

    }

    public function paket_agent()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Paket per Agent',
            'content'           => 'admin/paket_per_agent/index',
            'extra'             => 'admin/paket_per_agent/js/_js_index',
            'ppa_active'        => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function list_paket_agent()
    {
        $result = $this->harga->paketharga();
        echo json_encode($result);
    }

    public function tambah_paket_agent()
    {
        $agents = $this->agent->get_agent();
        $pakets = $this->paket->get_paket();
        
        $data = array(
            'title'         => NAMETITLE . ' - Tambah paket per Agent',
            'content'       => 'admin/paket_per_agent/tambah_paket_agent',
            'extra'         => 'admin/paket_per_agent/js/_js_index',
            'agents'         => $agents,
            'pakets'        => $pakets,
            'ppa_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_paket_agent_process()
    {
        $this->form_validation->set_rules('id_agent', 'Nama Agent', 'trim|required');
		$this->form_validation->set_rules('id_paket', 'Paket', 'trim|required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
            redirect('paket/tambah_paket_agent_process');
			return;
		}

        $harga = $this->input->post("harga");
        $new_harga = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $harga);
        $_POST["harga"]=$new_harga;
        
        $input = $this->input;
        $id_agent = $this->security->xss_clean($input->post('id_agent'));
        $id_paket = $this->security->xss_clean($input->post('id_paket'));
        $harga = $this->security->xss_clean($input->post('harga'));



        $datas = array(
            'id_agen'   => $id_agent,
            'id_paket'  => $id_paket,
            'berlaku'   => date("Y:m-d H:i:s"),
            'harga'     => $harga,
            "userid"    => $_SESSION["logged_status"]["username"],
            "created_at"=> date("Y-m-d H:i:s"),
        );

        $result = $this->harga->set_hargapaket($datas);
        
        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('paket/paket_agent');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('paket/tambah_paket_agent');
            return;
        }
    }

    public function edit_paket_agent($id, $id_nama)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $id_nama	= base64_decode($this->security->xss_clean($id_nama));
        $paket_agent = $this->harga->get_edit_hargapaket($id, $id_nama);

        $data = array(
            'title'         => NAMETITLE . ' - Edit paket per Agent',
            'content'       => 'admin/paket_per_agent/edit_paket_agent',
            'extra'         => 'admin/paket_per_agent/js/_js_index',
            'paket_agent'   => $paket_agent,
            'ppa_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }


}
