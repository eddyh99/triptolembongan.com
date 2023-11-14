<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('paket_model', 'paket');
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

}
