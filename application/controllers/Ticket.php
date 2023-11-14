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
            'content'           => 'admin/ticket/index',
            'extra'             => 'admin/ticket/js/_js_index',
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function tambah_ticket()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Tambah Ticket',
            'content'           => 'admin/ticket/tambah_ticket',
            'extra'             => 'admin/ticket/js/_js_index',
            'ticket_active'     => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

}
