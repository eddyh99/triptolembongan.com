<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model("Auth_model", 'auth');
	}

	public function index()
	{	

		$data = array(
			'title'     => NAMETITLE . ' - Login',
			'content'   => 'auth/login/index',
			'extra'		=> 'auth/login/js/_js_index',
		);
		$this->load->view('layout/wrapper', $data);
	}


	public function auth_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		// $this->form_validation->set_rules('role_login', 'Role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_validation', $this->message->error_msg(validation_errors()));
			redirect("/");
			return;
		}

		$input = $this->input;
		$username = $this->security->xss_clean($input->post('username'));
		$password = $this->security->xss_clean($input->post('password'));
		// $role_login = $this->security->xss_clean($input->post('role_login'));

		$datas = array(
			'username'	=> $username,
			'password'	=> $password,
			// 'role'		=> $role_login
		);

		$result = $this->auth->VerifyLogin($datas);
		$user_role = $result->role;
	

		$get_role = array();
        // Setup User
        if(stristr($user_role, 'stu') !== FALSE) {
            $get_role['stu']   = 'stu'; 
        }

		// Setup Agent
		if(stristr($user_role, 'stag') !== FALSE) {
			$get_role['stag']   = 'stag';
		}
		
		// Setup Payment
		if(stristr($user_role, 'stpy') !== FALSE) {
			$get_role['stpy']   = 'stpy';
		}

        // Departure Schedule
        if(stristr($user_role, 'sttkt') !== FALSE) {
            $get_role['sttkt']   = 'sttkt';
        }

        // Setup Paket
        if(stristr($user_role, 'stpkt') !== FALSE) {
            $get_role['stpkt']   = 'stpkt';
        }
        
        // Ticket per Agent
        if(stristr($user_role, 'tpa') !== FALSE) {
            $get_role['tpa']   = 'tpa';
        }
        
        // Paket per Agent
        if(stristr($user_role, 'ppa') !== FALSE) {
            $get_role['ppa']   = 'ppa';
        }

        // Booking Ticket
        if(stristr($user_role, 'bootk') !== FALSE) {
            $get_role['bootk']   = 'bootk';
        }
        
        // Booking Paket 
        if(stristr($user_role, 'boopk') !== FALSE) {
            $get_role['boopk']   = 'boopk';
        }
        
        // Departure Today
        if(stristr($user_role, 'depto') !== FALSE) {
            $get_role['depto']   = 'depto';
        }
        
        // Pendapatan Ticket
        if(stristr($user_role, 'pentk') !== FALSE) {
            $get_role['pentk']   = 'pentk';
        }

        // Pendapatan Paket
        if(stristr($user_role, 'penpk') !== FALSE) {
            $get_role['penpk']   = 'penpk';
        }

        // Transaksi Ticket per Agent
        if(stristr($user_role, 'ttpa') !== FALSE) {
            $get_role['ttpa']   = 'ttpa';
        }
        
        // Transaksi Paket per Agent
        if(stristr($user_role, 'tppa') !== FALSE) {
            $get_role['tppa']   = 'tppa';
        }

        // Rekap Komisi Ticket
        if(stristr($user_role, 'rkt') !== FALSE) {
            $get_role['rkt']   = 'rkt';
        }

        // Rekap Komisi Paket
        if(stristr($user_role, 'rkp') !== FALSE) {
            $get_role['rkp']   = 'rkp';
        }

        // Rangkuman Bulanan
        if(stristr($user_role, 'rabul') !== FALSE) {
            $get_role['rabul']   = 'rabul';
        }			
        
		
		if(!empty($result)){
			$temp_session = array(
				'username'  => $result->username,
				'role'      => $get_role,
				'is_login'  => true
			);
		
			$this->session->set_userdata('logged_status', $temp_session);
			$this->session->set_flashdata('success_log', "Selamat datang <b>".$result->username."</b>");
			redirect('dashboard');
		}else{
			$this->session->set_flashdata('error', "Username atau Password anda salah, coba lagi..");
			redirect('/');
		}

		// echo "<pre>".print_r($result,true)."</pre>";
        // die;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
