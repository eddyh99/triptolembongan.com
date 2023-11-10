<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title'         => NAMETITLE . ' - List Agent',
            'content'       => 'admin/daftar_agent/index',
            'extra'         => 'admin/daftar_agent/js/_js_index',
            'agent_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }

    public function daftar_agent()
    {
        $data = array(
            'title'         => NAMETITLE . ' - Daftar Agent',
            'content'       => 'admin/daftar_agent/tambah_agent',
            'extra'         => 'admin/daftar_agent/js/_js_index',
            'agent_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

}
