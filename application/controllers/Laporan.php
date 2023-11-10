<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Laporan',
            'content'           => 'admin/laporan/index',
            'extra'             => 'admin/laporan/js/_js_index',
            'laporan_active'      => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }


}
