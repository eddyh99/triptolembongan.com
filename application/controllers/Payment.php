<?php
defined('BASEPATH') or exit('No direct script access allowed');

class payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}

        $this->load->model('payment_model', 'payment');
    }

    public function index()
    {
        $data = array(
            'title'         => NAMETITLE . ' - List Payment',
            'content'       => 'admin/payment/index',
            'extra'         => 'admin/payment/js/_js_index',
            'payment_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }

    public function list_payment()
    {
        $result = $this->payment->get_payment();
        echo json_encode($result);
        
    }

    public function tambah_payment()
    {
        $data = array(
            'title'         => NAMETITLE . ' - Tambah Payment',
            'content'       => 'admin/payment/tambah_payment',
            'extra'         => 'admin/payment/js/_js_index',
            'payment_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_process()
    {
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
			redirect("payment/tambah_payment");
			return;
		}


        $input      = $this->input;
        $payment = $this->security->xss_clean($input->post('payment'));

        $datas = array(
            "payment"       => $payment, 
            "userid"        => $_SESSION["logged_status"]["username"],
            "created_at"    => date("Y-m-d H:i:s"),
        );

        $result = $this->payment->insert_payment($datas);
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('payment');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('payment/tambah_payment');
			return;
        }
        // redirect('payment/tambah_payment');
      

    }

    public function edit_payment($id)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->payment->get_edit_payment($id);

        $data = array(
            'title'             => NAMETITLE . ' - Edit Payment',
            'content'           => 'admin/payment/edit_payment',
            'extra'             => 'admin/payment/js/_js_index',
            'payment_active'      => 'active',
            'payment'             => $result,
        );

        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function edit_process()
    {
        $input      = $this->input;
        $this->form_validation->set_rules('payment', 'Payment', 'trim|required');

        $id_edit    = $this->security->xss_clean($input->post('id_edit'));

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
            redirect('payment/edit_payment/'.base64_encode($id_edit));
			return;
		}

        $payment    = $this->security->xss_clean($input->post('payment'));


        $datas = array(
            "payment"      => $payment,
            "update_at"     => date("Y-m-d H:i:s"),
        );

        $result = $this->payment->edit_payment($id_edit, $datas);

        if($result['code'] == 200){
            $this->session->set_flashdata('success', $this->message->success_edit_msg());
			redirect('payment');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->success_edit_msg());
            redirect('payment/edit_payment/'.base64_encode($id_edit));
            return;
        }
    }

    public function hapus($id)
    {
        $data = array(
			"is_deleted"  => 'yes',
            "update_at"   => date("Y-m-d H:i:s"),
		);

        $id_delete = base64_decode($this->security->xss_clean($id));
        $result = $this->payment->hapus_payment($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('payment');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('payment');
            return;
        }
    }

}
