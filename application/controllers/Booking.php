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
        $this->load->model('Payment_model', 'payment');
    }

    public function index()
    {

        $get_ticket = $this->ticket->get_ticket();
        $get_agent  = $this->agent->get_agent();
        $get_payment= $this->payment->get_payment();
        // echo "<pre>".print_r($get_ticket,true)."</pre>";
        // die;
        $data = array(
            'title'             => NAMETITLE . ' - Booking Ticket',
            'content'           => 'admin/booking_ticket/index',
            'ticket'            => $get_ticket,
            'agent'             => $get_agent,
            'payment'           => $get_payment,
            'extra'             => 'admin/booking_ticket/_js_index',
            'bookticket_active' => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }


    public function list_booking_ticket()
    {

        
        $start      = date("Y-m-d");
        $end        = date("Y-m-d");

        // echo $start;
        // echo $end;
        // die;

        $data = array(
            'title'             => NAMETITLE . ' - Booking Ticket',
            'content'           => 'admin/booking_ticket/list_booking',
            'extra'             => 'admin/booking_ticket/_js_list_booking',
            'bookticket_active' => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function get_list_ticket_agent()
    {
        $tanggal    = $this->security->xss_clean($this->input->post('tanggal'));
        $ticket     = $this->security->xss_clean($this->input->post('tipeticket'));

        if (empty($tanggal)){
            $start      = date("Y-m-d");
            $end        = date("Y-m-d");
        }else{
            $newtanggal	= explode("-",$tanggal);
            $start      = date_format(date_create($newtanggal[0]),"Y-m-d");
            $end        = date_format(date_create($newtanggal[1]),"Y-m-d");
        }

        // echo $start;
        // echo $end;
        // die;


        $result = $this->booking->list_ticket_agent($start, $end,$ticket);
        echo json_encode($result);
    }


    public function get_ticket_agent($id_nama)
    {
        $result = $this->booking->get_ticket_agent($id_nama);
        echo json_encode($result);
    }


    public function booking_tiket_proses()
    {

        $this->form_validation->set_rules('kode_ticket', 'Kode Tiket', 'trim|required');
		$this->form_validation->set_rules('nama_agent', 'Nama Agent', 'trim|required');
		$this->form_validation->set_rules('depart', 'Depart', 'trim|required');
		$this->form_validation->set_rules('return_from', 'Return From', 'trim');

		$this->form_validation->set_rules('nama_tamu_dewasa', 'Tamu Dewasa', 'trim');
		$this->form_validation->set_rules('nasionality_dewasa', 'Nasionality Tamu Dewasa', 'trim');
		$this->form_validation->set_rules('nohp_tamu_dewasa', 'No Hp Tamu Dewasa', 'trim');
		$this->form_validation->set_rules('email_tamu_dewasa', 'Email Tamu Dewasa', 'trim');

		$this->form_validation->set_rules('nama_tamu_anak', 'Tamu anak', 'trim');
		$this->form_validation->set_rules('nasionality_anak', 'Nasionality Tamu anak', 'trim');
		$this->form_validation->set_rules('nohp_tamu_anak', 'No Hp Tamu Anak', 'trim');
		$this->form_validation->set_rules('email_tamu_anak', 'Email Tamu Anak', 'trim');

		$this->form_validation->set_rules('nama_tamu_foc', 'Tamu foc', 'trim');
		$this->form_validation->set_rules('nasionality_foc', 'Nasionality Tamu foc', 'trim');
		$this->form_validation->set_rules('nohp_tamu_foc', 'No Hp Tamu foc', 'trim');
		$this->form_validation->set_rules('email_tamu_foc', 'Email Tamu foc', 'trim');

		$this->form_validation->set_rules('tglberangkat', 'Tanggal Berangkat', 'trim|required');
		$this->form_validation->set_rules('tglkembali', 'Tanggal Kembali', 'trim');
		$this->form_validation->set_rules('pickup', 'Pickup', 'trim');
		$this->form_validation->set_rules('r_pickup', 'Return Pickup', 'trim');
		$this->form_validation->set_rules('dropoff', 'Drop Off', 'trim');
		$this->form_validation->set_rules('r_dropoff', 'Return Drop Off', 'trim');
		$this->form_validation->set_rules('catatan', 'Remarks', 'trim');
		$this->form_validation->set_rules('payment', 'Payment', 'trim|required');
		$this->form_validation->set_rules('total', 'Charge', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
            redirect('booking');
			return;
		}

        $charge = $this->input->post("total");
        $new_charge = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $charge);
        $_POST["total"]=$new_charge;

        $input              = $this->input;
        $kode_ticket        = $this->security->xss_clean($input->post('kode_ticket'));
        $nama_agent          = $this->security->xss_clean($input->post('nama_agent'));

        // Tamu Dewasa
        $nama_tamu_dewasa   = $this->security->xss_clean($input->post('nama_tamu_dewasa'));
        $nasionality_dewasa = $this->security->xss_clean($input->post('nasionality_dewasa'));
        $nohp_dewasa        = $this->security->xss_clean($input->post('nohp_tamu_dewasa'));
        $email_dewasa       = $this->security->xss_clean($input->post('email_tamu_dewasa'));

        // Tamu Anak-anak
        $nama_tamu_anak     = $this->security->xss_clean($input->post('nama_tamu_anak'));
        $nasionality_anak   = $this->security->xss_clean($input->post('nasionality_anak'));
        $nohp_tamu_anak     = $this->security->xss_clean($input->post('nohp_tamu_anak'));
        $email_tamu_anak    = $this->security->xss_clean($input->post('email_tamu_anak'));
  
        // Tamu FOC
        $nama_tamu_foc      = $this->security->xss_clean($input->post('nama_tamu_foc'));
        $nasionality_foc    = $this->security->xss_clean($input->post('nasionality_foc'));
        $nohp_tamu_foc      = $this->security->xss_clean($input->post('nohp_tamu_foc'));
        $email_tamu_foc     = $this->security->xss_clean($input->post('email_tamu_foc'));

        $depart             = $this->security->xss_clean($input->post('depart'));
        $return_from        = $this->security->xss_clean($input->post('return_from'));

        $tglberangkat       = $this->security->xss_clean($input->post('tglberangkat'));
        $newTglBerangkat    = date("Y-m-d", strtotime($tglberangkat));  

        $tglkembali         = $this->security->xss_clean($input->post('tglkembali'));
        $newTglKembali      = date("Y-m-d", strtotime($tglkembali)); 
        
        $pickup             = $this->security->xss_clean($input->post('pickup'));
        $dropoff            = $this->security->xss_clean($input->post('dropoff'));
        $r_pickup           = $this->security->xss_clean($input->post('r_pickup'));
        $r_dropoff          = $this->security->xss_clean($input->post('r_dropoff'));

        $remarks            = $this->security->xss_clean($input->post('catatan'));
        $tipetujuan         = $this->security->xss_clean($input->post('tipetujuan'));
        // $tipeopen           = $this->security->xss_clean($input->post('tipeopen'));

        $payment            = $this->security->xss_clean($input->post('payment'));
        $charge             = $this->security->xss_clean($input->post('total'));
        
        // echo "<pre>".print_r($nama_tamu_dewasa,true)."</pre>";
        // echo "<pre>".print_r($tipetujuan,true)."</pre>";
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
                    foreach($nohp_dewasa as $keynohp=>$valuenohp){
                        $temp['nope']   = $valuenohp;
                        foreach($email_dewasa as $keyemail=>$valueemail){
                            $temp['email']   = $valueemail;
                            $temp['jenis']   = 'dewasa';
                            if(
                                ($keytamu == $keynas) && ($keytamu == $keynohp) && ($keytamu == $keyemail) && 
                                ($keynas == $keynohp) && ($keynas == $keyemail) && ($keynohp == $keyemail)
                               ){
                                array_push($temp_dewasa, $temp);
                            }
                        }
                    }
                    
                }
            }
        }

        // echo "<pre>".print_r($temp_dewasa,true)."</pre>";
        // die;

        // Looping nama tamu Anak
        if(array_filter($nama_tamu_anak)){
            foreach($nama_tamu_anak as $keytamu=>$valuetamu){
                $temp['namatamu']   = $valuetamu;    
                foreach($nasionality_anak as $keynas=>$valuenas){
                    $temp['nasionality']   = $valuenas;
                    foreach($nohp_tamu_anak as $keynohp=>$valuenohp){
                        $temp['nope']   = $valuenohp;
                        foreach($email_tamu_anak as $keyemail=>$valueemail){
                            $temp['email']   = $valueemail;
                            $temp['jenis']   = 'anak';
                            if(
                                ($keytamu == $keynas) && ($keytamu == $keynohp) && ($keytamu == $keyemail) && 
                                ($keynas == $keynohp) && ($keynas == $keyemail) && ($keynohp == $keyemail)
                               ){
                                array_push($temp_anak, $temp);
                            }
                        }
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
                    foreach($nohp_tamu_foc as $keynohp=>$valuenohp){
                        $temp['nope']   = $valuenohp;
                        foreach($email_tamu_foc as $keyemail=>$valueemail){
                            $temp['email']   = $valueemail;
                            $temp['jenis']   = 'foc';
                            if(
                                ($keytamu == $keynas) && ($keytamu == $keynohp) && ($keytamu == $keyemail) && 
                                ($keynas == $keynohp) && ($keynas == $keyemail) && ($keynohp == $keyemail)
                               ){
                                array_push($temp_foc, $temp);
                            }
                        }
                    }    
    
                }
            }
        }

        $detail_booking = array_merge($temp_dewasa, $temp_anak, $temp_foc);
        $datas = array(
            'kode_tiket'    => $kode_ticket,
            'tgl_pesan'     => date("Y:m:d H:i:s"),
            'berangkat'     => $newTglBerangkat,
            'kembali'       => ($tipetujuan=="Open") ? null : (empty($tglkembali) ? null : date("Y-m-d", strtotime($tglkembali))),
            'is_open'       => ($tipetujuan=="Open")?"yes":"no",
            'r_pickup'      => empty($r_pickup) ? null : $r_pickup,
            'r_dropoff'     => empty($r_dropoff) ? null : $r_dropoff,
            'pickup'        => $pickup,
            'dropoff'       => $dropoff,
            'depart'        => $depart,
            'payment'       => $payment,
            'return_from'   => empty($return_from) ? null : $return_from,
            'agentid'       => $nama_agent,
            'remarks'       => $remarks,
            'charge'        => $charge,
            'userid'        => $_SESSION["logged_status"]["username"],
            'created_at'    => date("Y:m:d H:i:s"),
            'update_at'    => date("Y:m:d H:i:s"),
        );

        // echo "<pre>".print_r($datas,true)."</pre>";
        // die;
        
        $result = $this->booking->insert_booking_ticket($datas, $detail_booking);

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

    public function preview_ticket($tiket)
    {

        $result = $this->booking->preview_ticket($tiket);

        if(!empty($result)){

            header( "Content-type: image/png" );

            $img = imagecreatefrompng(base_url()."assets/img/template_ticket.png");
            $img2 = imagecreatefrompng(base_url()."assets/img/check.png");
            // $check = imagecreatefromstring(base_url()."assets/img/check.png");

            $size = 14; 
            $angel = 0; 
            $x = 100; 
            $y = 60; 
            $quality = 100;
            $black = imagecolorallocate($img, 0, 0, 0);
            $white = imagecolorallocate($img, 255, 255, 255);
    
            $font = FCPATH . '/assets/font/arial.ttf';
            $fontBold = FCPATH . '/assets/font/arial_bold.ttf';

            $newberangkat = date("d-m-Y", strtotime($result->berangkat));
            $newkembali = date("d-m-Y", strtotime($result->kembali));
    
            imagettftext($img, 24, 0, 50, 125, $white, $fontBold, $result->kode_tiket);
            imagettftext($img, $size, 0, 363, 62, $black, $font, $result->namaagen);
            imagettftext($img, $size, 0, 363, 195, $black, $font, $result->namatamu);
            imagettftext($img, $size, 0, 435, 227, $black, $font, $result->nasionality);
            imagettftext($img, $size, 0, 280, 328, $black, $font, $newberangkat);
            imagettftext($img, $size, 0, 525, 328, $black, $font, $newkembali);
            imagettftext($img, 12, 0, 270, 362, $black, $font, $result->depart);
            imagettftext($img, 12, 0, 505, 362, $black, $font, $result->return_from);
            
            imagettftext($img, 24, 0, 50, 700, $black, $fontBold, $result->kode_tiket);
            imagettftext($img, 16, 0, 410, 600, $black, $font, $result->dws);
            imagettftext($img, 16, 0, 410, 638, $black, $font, $result->anak);
            imagettftext($img, 16, 0, 385, 674, $black, $font, $result->foc);
            imagettftext($img, 16, 0, 420, 715, $black, $font, $result->pickup);
            imagettftext($img, 16, 0, 448, 753, $black, $font, $result->dropoff);
            imagettftext($img, 16, 0, 440, 790, $black, $font, $result->remarks);
            // imagettftext($img, $size, $angel, $x, $y, $black, $font, "Ari Pramana");

            // $img_width = imagesx($img);
            // $img_height = imagesy($img);

            if(!empty($result->depart) && !empty($result->return_from)){
                imagecopy($img, $img2, 415, 250, 0, 0, (imagesx($img2)), (imagesy($img2)));
            }else {
                imagecopy($img, $img2, 280, 250, 0, 0, (imagesx($img2)), (imagesy($img2)));
            }

            imagepng($img, FCPATH . '/assets/tiket/'. $result->kode_tiket .'_ticket.png');
            // imagepng($img);
            $this->session->set_flashdata('success', 'Berhasil Booking');
			redirect('booking/list_booking_ticket');
        }

    }

    
    public function hapus_booking_ticket($id)
    {
        $data = array(
			"is_deleted"  => 'yes',
            "update_at"   => date("Y-m-d H:i:s"),
		);

        $id_delete = base64_decode($this->security->xss_clean($id));
        $result = $this->booking->hapus_booking_ticket($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('booking/list_booking_ticket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('booking/list_booking_ticket');
            return;
        }
    }
    

    public function download_ticket($kode_ticket)
    {

        $srcref = base_url() . 'assets/tiket/' . $kode_ticket . '_ticket.png';
        $pdf = new FPDF('P','cm',[26, 26]);
        $pdf->AddPage();
        $pdf->Image($srcref,0,0,0,0,'PNG');
        $pdf->Output($kode_ticket . '_ticket.pdf', 'D');
    }




    // ================= ========================= ===================
    // ================= BOOKING PAKET CONTROLLER  ===================
    // ================= ========================= ===================


    public function list_booking_paket()
    {
        $data = array(
            'title'             => NAMETITLE . ' - Booking Ticket',
            'content'           => 'admin/booking_paket/list_booking_paket',
            'extra'             => 'admin/booking_paket/_js_list_booking_paket',
            'bookpaket_active'  => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function get_list_paket_agent()
    {
        $result = $this->booking->list_paket_agent();
        echo json_encode($result);
    }


    public function booking_paket()
    {
        $get_ticket = $this->ticket->get_ticket();
        $get_agent  = $this->agent->get_agent();
        $get_payment= $this->payment->get_payment();

        $data = array(
            'title'             => NAMETITLE . ' - Booking Paket',
            'content'           => 'admin/booking_paket/index',
            'ticket'            => $get_ticket,
            'agent'             => $get_agent,
            'payment'           => $get_payment,
            'extra'             => 'admin/booking_paket/_js_index',
            'bookpaket_active'  => 'active',
        );
        $this->load->view('layout/wrapper-dashboard', $data);
    }

    public function get_paket_agent($id_nama)
    {
        $result = $this->booking->get_paket_agent($id_nama);
        echo json_encode($result);
    }
    
    public function booking_paket_proses()
    {
        $this->form_validation->set_rules('kode_ticket', 'Kode Tiket', 'trim|required');
		$this->form_validation->set_rules('nama_agent', 'Nama Agent', 'trim|required');
		$this->form_validation->set_rules('paket', 'Paket', 'trim|required');

		$this->form_validation->set_rules('nama_tamu_dewasa', 'Tamu Dewasa', 'trim');
		$this->form_validation->set_rules('nasionality_dewasa', 'Nasionality Tamu Dewasa', 'trim');
		$this->form_validation->set_rules('nohp_tamu_dewasa', 'No Hp Dewasa', 'trim');
		$this->form_validation->set_rules('email_tamu_dewasa', 'Email Dewasa', 'trim');

		$this->form_validation->set_rules('nama_tamu_anak', 'Tamu anak', 'trim');
		$this->form_validation->set_rules('nasionality_anak', 'Nasionality Tamu anak', 'trim');
		$this->form_validation->set_rules('nohp_tamu_anak', 'No Hp anak', 'trim');
		$this->form_validation->set_rules('email_tamu_anak', 'Email anak', 'trim');

		$this->form_validation->set_rules('nama_tamu_foc', 'Tamu FOC', 'trim');
		$this->form_validation->set_rules('nasionality_foc', 'Nasionality Tamu foc', 'trim');
		$this->form_validation->set_rules('nohp_tamu_foc', 'No Hp FOC', 'trim');
		$this->form_validation->set_rules('email_tamu_foc', 'Email FOC', 'trim');

		$this->form_validation->set_rules('tglberangkat', 'Tanggal Berangkat', 'trim|required');
		$this->form_validation->set_rules('tglkembali', 'Tanggal Kembali', 'trim|required');
		$this->form_validation->set_rules('pickup', 'Pickup', 'trim|required');
		$this->form_validation->set_rules('dropoff', 'Drop Off', 'trim|required');
		$this->form_validation->set_rules('catatan', 'Remarks', 'trim');
		$this->form_validation->set_rules('payment', 'Payment', 'trim|required');
		$this->form_validation->set_rules('total', 'Charge', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', $this->message->error_msg(validation_errors()));
            redirect('booking/booking_paket');
			return;
		}

        $charge = $this->input->post("total");
        $new_charge = str_replace(array('\'', '"', ',', ';', '<', '>'), '', $charge);
        $_POST["total"]=$new_charge;

        $input              = $this->input;
        $kode_ticket        = $this->security->xss_clean($input->post('kode_ticket'));
        $nama_agent          = $this->security->xss_clean($input->post('nama_agent'));

        // Tamu Dewasa
        $nama_tamu_dewasa   = $this->security->xss_clean($input->post('nama_tamu_dewasa'));
        $nasionality_dewasa = $this->security->xss_clean($input->post('nasionality_dewasa'));
        $nohp_tamu_dewasa   = $this->security->xss_clean($input->post('nohp_tamu_dewasa'));
        $email_tamu_dewasa  = $this->security->xss_clean($input->post('email_tamu_dewasa'));

        // Tamu Anak-anak
        $nama_tamu_anak     = $this->security->xss_clean($input->post('nama_tamu_anak'));
        $nasionality_anak   = $this->security->xss_clean($input->post('nasionality_anak'));
        $nohp_tamu_anak     = $this->security->xss_clean($input->post('nohp_tamu_anak'));
        $email_tamu_anak    = $this->security->xss_clean($input->post('email_tamu_anak'));
  
        // Tamu FOC
        $nama_tamu_foc      = $this->security->xss_clean($input->post('nama_tamu_foc'));
        $nasionality_foc    = $this->security->xss_clean($input->post('nasionality_foc'));
        $nohp_tamu_foc      = $this->security->xss_clean($input->post('nohp_tamu_foc'));
        $email_tamu_foc     = $this->security->xss_clean($input->post('email_tamu_foc'));

        $id_paket           = $this->security->xss_clean($input->post('paket'));

        $tglberangkat       = $this->security->xss_clean($input->post('tglberangkat'));
        $newTglBerangkat    = date("Y-m-d", strtotime($tglberangkat));  
        $tglkembali         = $this->security->xss_clean($input->post('tglkembali'));
        $newTglKembali      = date("Y-m-d", strtotime($tglkembali)); 
        
        $pickup             = $this->security->xss_clean($input->post('pickup'));
        $dropoff            = $this->security->xss_clean($input->post('dropoff'));
        $remarks            = $this->security->xss_clean($input->post('catatan'));
        
        $payment            = $this->security->xss_clean($input->post('payment'));
        $charge             = $this->security->xss_clean($input->post('total'));
        
        
        $temp_dewasa = array();
        $temp_anak = array();
        $temp_foc = array();
        // Looping nama tamu Dewasa
        if(array_filter($nama_tamu_dewasa)){
            foreach($nama_tamu_dewasa as $keytamu=>$valuetamu){
                $temp['namatamu']   = $valuetamu;    
                foreach($nasionality_dewasa as $keynas=>$valuenas){
                    $temp['nasionality']   = $valuenas;
                    foreach($nohp_tamu_dewasa as $keynohp=>$valuenohp){
                        $temp['nope']   = $valuenohp;
                        foreach($email_tamu_dewasa as $keyemail=>$valueemail){
                            $temp['email']   = $valueemail;
                            $temp['jenis']   = 'dewasa';
                            if(
                                ($keytamu == $keynas) && ($keytamu == $keynohp) && ($keytamu == $keyemail) && 
                                ($keynas == $keynohp) && ($keynas == $keyemail) && ($keynohp == $keyemail)
                               ){
                                array_push($temp_dewasa, $temp);
                            }
                        }
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
                    foreach($nohp_tamu_anak as $keynohp=>$valuenohp){
                        $temp['nope']   = $valuenohp;
                        foreach($email_tamu_anak as $keyemail=>$valueemail){
                            $temp['email']   = $valueemail;
                            $temp['jenis']   = 'anak';
                            if(
                                ($keytamu == $keynas) && ($keytamu == $keynohp) && ($keytamu == $keyemail) && 
                                ($keynas == $keynohp) && ($keynas == $keyemail) && ($keynohp == $keyemail)
                               ){
                                array_push($temp_anak, $temp);
                            }
                        }
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
                    foreach($nohp_tamu_foc as $keynohp=>$valuenohp){
                        $temp['nope']   = $valuenohp;
                        foreach($email_tamu_foc as $keyemail=>$valueemail){
                            $temp['email']   = $valueemail;
                            $temp['jenis']   = 'foc';
                            if(
                                ($keytamu == $keynas) && ($keytamu == $keynohp) && ($keytamu == $keyemail) && 
                                ($keynas == $keynohp) && ($keynas == $keyemail) && ($keynohp == $keyemail)
                               ){
                                array_push($temp_foc, $temp);
                            }
                        }
                    }    
    
                }
            }
        }

        $detail_booking_paket = array_merge($temp_dewasa, $temp_anak, $temp_foc);
        // echo "<pre>".print_r($detail_booking_paket,true)."</pre>";
        // die;
        $datas = array(
            'kode_tiket'    => $kode_ticket,
            'tgl_pesan'     => date("Y:m:d H:i:s"),
            'berangkat'     => $newTglBerangkat,
            'kembali'       => $newTglKembali,
            'pickup'        => $pickup,
            'dropoff'       => $dropoff,
            'payment'       => $payment,
            'id_paket'      => $id_paket,
            'agentid'       => $nama_agent,
            'remarks'       => $remarks,
            'charge'        => $charge,
            'userid'        => $_SESSION["logged_status"]["username"],
            'checkin_by'    => $_SESSION["logged_status"]["username"],
            'created_at'    => date("Y:m:d H:i:s"),
            'update_at'    => date("Y:m:d H:i:s"),
        );
        

        $result = $this->booking->insert_booking_paket($datas, $detail_booking_paket);

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', 'Berhasil Booking');
			redirect('booking/list_booking_paket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_msg($result["message"]));
			redirect('booking/booking_paket');
			return;
        }
    }

    public function preview_paket($tiket)
    {

        $result = $this->booking->preview_paket($tiket);
        // print_r(json_encode($result));
        // die;

        if(!empty($result)){

            header( "Content-type: image/png" );

            $img = imagecreatefrompng(base_url()."assets/img/template_paket.png");
            $img2 = imagecreatefrompng(base_url()."assets/img/check.png");
            // $check = imagecreatefromstring(base_url()."assets/img/check.png");

            $size = 14; 
            $angel = 0; 
            $x = 100; 
            $y = 60; 
            $quality = 100;
            $black = imagecolorallocate($img, 0, 0, 0);
            $white = imagecolorallocate($img, 255, 255, 255);
    
            $font = FCPATH . '/assets/font/arial.ttf';
            $fontBold = FCPATH . '/assets/font/arial_bold.ttf';

            $newberangkat = date("d-m-Y", strtotime($result->berangkat));
            $newkembali = date("d-m-Y", strtotime($result->kembali));
    
            imagettftext($img, 24, 0, 50, 125, $white, $fontBold, $result->kode_tiket);
            imagettftext($img, $size, 0, 363, 62, $black, $font, $result->namaagen);
            imagettftext($img, $size, 0, 363, 195, $black, $font, $result->namatamu);
            imagettftext($img, $size, 0, 440, 241, $black, $font, $result->nasionality);
            imagettftext($img, $size, 0, 374, 285, $black, $font, $result->namapaket);
            imagettftext($img, $size, 0, 282, 365, $black, $font, $newberangkat);
            imagettftext($img, $size, 0, 483, 365, $black, $font, $newkembali);
            
            imagettftext($img, 24, 0, 50, 700, $black, $fontBold, $result->kode_tiket);
            imagettftext($img, 16, 0, 410, 600, $black, $font, $result->dws);
            imagettftext($img, 16, 0, 410, 638, $black, $font, $result->anak);
            imagettftext($img, 16, 0, 385, 674, $black, $font, $result->foc);
            imagettftext($img, 16, 0, 420, 715, $black, $font, $result->pickup);
            imagettftext($img, 16, 0, 448, 753, $black, $font, $result->dropoff);
            imagettftext($img, 16, 0, 440, 790, $black, $font, $result->remarks);


            imagepng($img, FCPATH . '/assets/tiket/'. $result->kode_tiket .'_ticket.png');
            // imagepng($img);
            $this->session->set_flashdata('success', 'Berhasil Booking');
			redirect('booking/list_booking_paket');
        }

    }

        
    public function hapus_booking_paket($id)
    {
        $data = array(
			"is_deleted"  => 'yes',
            "update_at"   => date("Y-m-d H:i:s"),
		);

        $id_delete = base64_decode($this->security->xss_clean($id));
        $result = $this->booking->hapus_booking_paket($id_delete, $data);

        if($result['code'] = 200){
            $this->session->set_flashdata('success', $this->message->delete_msg());
			redirect('booking/list_booking_paket');
			return;
        }else{
            $this->session->set_flashdata('error', $this->message->error_delete_msg());
            redirect('booking/list_booking_paket');
            return;
        }
    }
    


}
