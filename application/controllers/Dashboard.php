<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data = array(
            'title'         => NAMETITLE . ' - Dashboard',
            'content'       => 'admin/dashboard/index',
            'extra'         => 'admin/dashboard/js/_js_index',
            'dash_active'    => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

}
