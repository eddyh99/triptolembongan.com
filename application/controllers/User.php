<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}

        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data = array(
            'title'         => NAMETITLE . ' - List User',
            'content'       => 'admin/user/index',
            'extra'         => 'admin/user/js/_js_index',
            'user_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }

    public function list_user()
    {
        $result = $this->user->get_user();
        echo json_encode($result);
        
    }

    public function tambah_user()
    {
        $data = array(
            'title'         => NAMETITLE . ' - Tambah User',
            'content'       => 'admin/user/tambah_user',
            'extra'         => 'admin/user/js/_js_index',
            'user_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_process()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('passwd', 'Password', 'trim|required');
		// $this->form_validation->set_rules('role', 'Role', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("user/tambah_user");
			return;
		}

        
        // $role       = $this->security->xss_clean($input->post('role'));
        $input      = $this->input;
        $username   = $this->security->xss_clean($input->post('username'));
        $passwd     = $this->security->xss_clean($input->post('passwd'));

        // Initial List of Side Menu
        $stu        = $this->security->xss_clean($input->post('stu')); 
        $stpy       = $this->security->xss_clean($input->post('stpy')); 
        $sttkt      = $this->security->xss_clean($input->post('sttkt')); 
        $stpkt      = $this->security->xss_clean($input->post('stpkt')); 
        $tpa        = $this->security->xss_clean($input->post('tpa')); 
        $ppa        = $this->security->xss_clean($input->post('ppa')); 
        $bootkt     = $this->security->xss_clean($input->post('bootkt')); 
        $boopkt     = $this->security->xss_clean($input->post('boopkt')); 
        $depto      = $this->security->xss_clean($input->post('depto')); 
        $pentkt     = $this->security->xss_clean($input->post('pentkt')); 
        $ttpa       = $this->security->xss_clean($input->post('ttpa')); 
        $tppa       = $this->security->xss_clean($input->post('tppa')); 
        $rkt        = $this->security->xss_clean($input->post('rkt')); 
        $rkp        = $this->security->xss_clean($input->post('rkp')); 
        $rabul      = $this->security->xss_clean($input->post('rabul')); 

        $role_detail = array();
        // $temp['role']   = $dash;
        // array_push($role_detail, $temp);

        // List Of Side Menu

        // Setup User
        if (!empty($stu)){
            $temp['role']   = $stu;
            $temp['keterangan']   = 'Setup User';
            array_push($role_detail, $temp);    
        }
        // Setup Agent
        if (!empty($stag)){
            $temp['role']   = $stag;
            $temp['keterangan']   = 'Setup Agent';
            array_push($role_detail, $temp);
        }
        // Setup Payment
        if (!empty($stpy)){
            $temp['role']   = $stpy;
            $temp['keterangan']   = 'Setup Payment';
            array_push($role_detail, $temp);
        }
        // Setup Ticket
        if (!empty($sttkt)){
            $temp['role']   = $sttkt;
            $temp['keterangan']   = 'Setup Ticket';
            array_push($role_detail, $temp);
        }
        // Setup Paket
        if (!empty($stpkt)){
            $temp['role']   = $stpkt;
            $temp['keterangan']   = 'Setup Paket';
            array_push($role_detail, $temp);
        }
        // Ticket per Agent
        if (!empty($tpa)){
            $temp['role']   = $tpa;
            $temp['keterangan']   = 'Ticket per Agent';
            array_push($role_detail, $temp);
        }
        // Paket per Agent
        if (!empty($ppa)){
            $temp['role']   = $ppa;
            $temp['keterangan']   = 'Paket per Agent';
            array_push($role_detail, $temp);
        }
        // Booking Ticket
        if (!empty($bootkt)){
            $temp['role']   = $bootkt;
            $temp['keterangan']   = 'Booking Ticket';
            array_push($role_detail, $temp);
        }
        // Booking Paket
        if (!empty($boopkt)){
            $temp['role']   = $boopkt;
            $temp['keterangan']   = 'Booking Paket';
            array_push($role_detail, $temp);
        }
        // Departure Today
        if (!empty($depto)){
            $temp['role']   = $depto;
            $temp['keterangan']   = 'Departure Today';
            array_push($role_detail, $temp);
        }
        // Pendapatan Ticket
        if (!empty($pentkt)){
            $temp['role']   = $pentkt;
            $temp['keterangan']   = 'Pendapatan Ticket';
            array_push($role_detail, $temp);
        }
        // Pendapatan Paket
        if (!empty($penpkt)){
            $temp['role']   = $penpkt;
            $temp['keterangan']   = 'Pendapatan Paket';
            array_push($role_detail, $temp);
        }
        // Transaksi Ticket per Agent
        if (!empty($ttpa)){
            $temp['role']   = $ttpa;
            $temp['keterangan']   = 'Transaksi Ticket per Agent';
            array_push($role_detail, $temp);
        }
        // Transaksi Paket per Agent
        if (!empty($tppa)){
            $temp['role']   = $tppa;
            $temp['keterangan']   = 'Transaksi Paket per Agent';
            array_push($role_detail, $temp);
        }
        // Rekap Komisi Ticket
        if (!empty($rkt)){
            $temp['role']   = $rkt;
            $temp['keterangan']   = 'Rekap Komisi Ticket';
            array_push($role_detail, $temp);
        }
        // Rekap Komisi Paket
        if (!empty($rkp)){
            $temp['role']   = $rkp;
            $temp['keterangan']   = 'Rekap Komisi Paket';
            array_push($role_detail, $temp);
        }
        // Rangkuman Bulanan
        if (!empty($rabul)){
            $temp['role']   = $rabul;
            $temp['keterangan']   = 'Rangkuman Bulanan';
            array_push($role_detail, $temp);
        }
        



        // echo "<pre>".print_r($role_detail,true)."</pre>";
        // die;

        $datas = array(
            "username"  => $username, 
            "passwd"    => sha1($passwd),
            // "role"      => $role,
            "created_at"=> date("Y-m-d H:i:s"),
            "update_at"=> date("Y-m-d H:i:s")
        );

        $result = $this->user->insert_user($datas, $role_detail);


        if($result['code'] == 200) {
            $this->session->set_flashdata('success', $this->message->success_msg());
			redirect('user');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('user/tambah_user');
			return;
        }
        // redirect('user/tambah_user');
        // echo "<pre>".print_r($datas,true)."</pre>";
        // die;

    }

    public function edit_user($id)
    {
        $id	= base64_decode($this->security->xss_clean($id));
        $result = $this->user->get_edit_user($id);

        echo "<pre>".print_r($result,true)."</pre>";
        die;

        $data = array(
            'title'             => NAMETITLE . ' - Edit user',
            'content'           => 'admin/user/edit_user',
            'extra'             => 'admin/user/js/_js_index',
            'user_active'       => 'active',
            'user'              => $result,
        );

        $this->load->view('layout/wrapper-dashboard', $data);
    }
    
    public function edit_process()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('passwd', 'Password', 'trim');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
            redirect('user/edit_user/'.base64_encode($username));
			return;
		}


        $input      = $this->input;
        $username   = $this->security->xss_clean($input->post('username'));
        $passwd     = $this->security->xss_clean($input->post('passwd'));
        $role       = $this->security->xss_clean($input->post('role'));
        
        if (!empty($passwd)){
            $datas = array(
                "passwd"    => sha1($passwd),
                "role"      => $role,
                "update_at"=> date("Y-m-d H:i:s")
            );    
        }else{
            $datas = array(
                "role"      => $role,
                "update_at"=> date("Y-m-d H:i:s")
            ); 
        }

        $result = $this->user->edit_user($username,$datas);

        if($result['code'] == 200){
            $this->session->set_flashdata('success', $this->message->success_edit_msg());
			redirect('user');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->success_edit_msg());
            redirect('user/edit_user/'.base64_encode($id_edit));
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
            $this->session->set_flashdata('success', "Username admin tidak dapat di hapus");
            redirect("user");
            return;
        }
        $result = $this->user->hapus_user($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('user');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('user');
            return;
        }


    }

}
