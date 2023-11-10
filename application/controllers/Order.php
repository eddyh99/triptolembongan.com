<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Order Ticket',
            'content'           => 'admin/order_ticket/index',
            'extra'             => 'admin/order_ticket/js/_js_index',
            'order_active'      => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);

    }


}
