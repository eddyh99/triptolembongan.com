<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Daftar Ticket',
            'content'           => 'admin/daftar_ticket/index',
            'extra'             => 'admin/daftar_ticket/js/_js_index',
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_ticket()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Tambah Ticket',
            'content'           => 'admin/daftar_ticket/tambah_ticket',
            'extra'             => 'admin/daftar_ticket/js/_js_index',
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

}
