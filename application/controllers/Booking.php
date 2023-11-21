<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['logged_status'])) {
			redirect('/');
		}

        $this->load->model('Booking_model', 'booking');
        $this->load->model('Ticket_model', 'ticket');
        $this->load->model('Agent_model', 'agent');
        $this->load->model('Harga_model', 'harga');
    }

    public function index()
    {

        $get_ticket = $this->ticket->get_ticket();
        $get_agent  = $this->agent->get_agent();
        // echo "<pre>".print_r($get_ticket,true)."</pre>";
        // die;
        $data = array(
            'title'             => NAMETITLE . ' - Booking Ticket',
            'content'           => 'admin/booking_ticket/index',
            'ticket'            => $get_ticket,
            'agent'             => $get_agent,
            'extra'             => 'admin/booking_ticket/_js_index',
            'bookticket_active' => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function list_booking_ticket()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Booking Ticket',
            'content'           => 'admin/booking_ticket/list_booking',
            'extra'             => 'admin/booking_ticket/_js_index',
            'bookticket_active' => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function get_ticket_agent($id_nama)
    {
        $result = $this->booking->get_ticket_agent($id_nama);
        //  echo "<pre>".print_r($result,true)."</pre>";
        // die;
        echo json_encode($result);
    }


    public function booking_tiket_proses()
    {
        $input              = $this->input;
        $kode_ticket        = $this->security->xss_clean($input->post('kode_ticket'));
        $nama_agent          = $this->security->xss_clean($input->post('nama_agent'));

        // Tamu Dewasa
        $nama_tamu_dewasa   = $this->security->xss_clean($input->post('nama_tamu_dewasa'));
        $nasionality_dewasa = $this->security->xss_clean($input->post('nasionality_dewasa'));

        // Tamu Anak-anak
        $nama_tamu_anak     = $this->security->xss_clean($input->post('nama_tamu_anak'));
        $nasionality_anak   = $this->security->xss_clean($input->post('nasionality_anak'));
  
        // Tamu FOC
        $nama_tamu_foc      = $this->security->xss_clean($input->post('nama_tamu_foc'));
        $nasionality_foc    = $this->security->xss_clean($input->post('nasionality_foc'));

        $depart             = $this->security->xss_clean($input->post('depart'));
        $return_from        = $this->security->xss_clean($input->post('return_from'));

        $tglberangkat       = $this->security->xss_clean($input->post('tglberangkat'));
        $newTglBerangkat    = date("Y-m-d", strtotime($tglberangkat));  
        $tglkembali         = $this->security->xss_clean($input->post('tglkembali'));
        $newTglKembali      = date("Y-m-d", strtotime($tglkembali)); 
        
        $pickup             = $this->security->xss_clean($input->post('pickup'));
        $dropoff            = $this->security->xss_clean($input->post('dropoff'));
        $remarks            = $this->security->xss_clean($input->post('catatan'));
  
        // echo "<pre>".print_r($nama_tamu_dewasa,true)."</pre>";
        // echo "<pre>".print_r($depart,true)."</pre>";
        // die;
        
        
        $temp_dewasa = array();
        $temp_anak = array();
        $temp_foc = array();
        // Looping nama tamu Dewasa
        if(array_filter($nama_tamu_dewasa)){
            foreach($nama_tamu_dewasa as $keytamu=>$valuetamu){
                $temp['namatamu']   = $valuetamu;    
                foreach($nasionality_dewasa as $keynas=>$valuenas){
                    $temp['nasionality']   = $valuenas;
                    $temp['jenis']   = 'dewasa';
                    if($keytamu == $keynas){
                        array_push($temp_dewasa, $temp);
                    }
    
                }
            }
        }

        // Looping nama tamu Anak
        if(array_filter($nama_tamu_anak)){
            foreach($nama_tamu_anak as $keytamu=>$valuetamu){
                $temp['namatamu']   = $valuetamu;    
                foreach($nasionality_anak as $keynas=>$valuenas){
                    $temp['nasionality']   = $valuenas;
                    $temp['jenis']   = 'anak';
                    if($keytamu == $keynas){
                        array_push($temp_anak, $temp);
                    }
    
                }
            }
        }

        // Looping nama tamu FOC
        if(array_filter($nama_tamu_foc)){
            foreach($nama_tamu_foc as $keytamu=>$valuetamu){
                $temp['namatamu']   = $valuetamu;    
                foreach($nasionality_foc as $keynas=>$valuenas){
                    $temp['nasionality']   = $valuenas;
                    $temp['jenis']   = 'foc';
                    if($keytamu == $keynas){
                        array_push($temp_foc, $temp);
                    }
    
                }
            }
        }

        $detail_booking = array_merge($temp_dewasa, $temp_anak, $temp_foc);
        $datas = array(
            'kode_tiket'    => $kode_ticket,
            'tgl_pesan'     => date("Y:m:d H:i:s"),
            'berangkat'     => $newTglBerangkat,
            'kembali'       => $newTglKembali,
            'pickup'        => $pickup,
            'dropoff'       => $dropoff,
            'depart'        => $depart,
            'return_from'   => empty($return_from) ? null : $return_from,
            'agentid'       => $nama_agent,
            'remarks'       => $remarks,
            'userid'        => $_SESSION["logged_status"]["username"],
            'created_at'    => date("Y:m:d H:i:s"),
            'update_at'    => date("Y:m:d H:i:s"),
        );
        
        // echo "<pre>".print_r(array_merge($temp_dewasa, $temp_anak),true)."</pre>";
        $result = $this->booking->insert_booking_ticket($datas, $detail_booking);
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', 'Berhasil Booking');
			redirect('booking/list_booking_ticket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('booking');
			return;
        }
    }


    public function booking_paket()
    {
        $get_ticket = $this->ticket->get_ticket();
        $get_agent  = $this->agent->get_agent();
        // echo "<pre>".print_r($get_ticket,true)."</pre>";
        // die;
        $data = array(
            'title'             => NAMETITLE . ' - Booking Paket',
            'content'           => 'admin/booking_paket/index',
            'ticket'            => $get_ticket,
            'agent'             => $get_agent,
            'extra'             => 'admin/booking_paket/_js_index',
            'bookpaket_active'  => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }


}
