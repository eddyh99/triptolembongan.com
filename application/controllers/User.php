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
        $dash       = $this->security->xss_clean($input->post('dash')); // Dashboard
        $stu        = $this->security->xss_clean($input->post('stu')); 
        $stpy        = $this->security->xss_clean($input->post('stpy')); 
        $sttkt        = $this->security->xss_clean($input->post('sttkt')); 

        $role_detail = array();
        $temp['role']   = $dash;
        array_push($role_detail, $temp);
        $temp['role']   = $stu;
        array_push($role_detail, $temp);
        $temp['role']   = $stpy;
        array_push($role_detail, $temp);
        $temp['role']   = $sttkt;
        array_push($role_detail, $temp);
        



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
