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
        $result = $this->booking->list_ticket_agent();
        echo json_encode($result);
    }


    public function get_ticket_agent($id_nama)
    {
        $result = $this->booking->get_ticket_agent($id_nama);
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

        $payment            = $this->security->xss_clean($input->post('payment'));
  
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
            'payment'       => $payment,
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
			redirect('booking/preview_ticket/'.$kode_ticket);
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
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        echo json_encode($result);
    }


    public function booking_paket()
    {
        $get_ticket = $this->ticket->get_ticket();
        $get_agent  = $this->agent->get_agent();
        $get_payment= $this->payment->get_payment();

        // echo "<pre>".print_r($get_ticket,true)."</pre>";
        // die;
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
        //  echo "<pre>".print_r($result,true)."</pre>";
        // die;
        echo json_encode($result);
    }
    
    public function booking_paket_proses()
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

        $id_paket           = $this->security->xss_clean($input->post('paket'));

        $tglberangkat       = $this->security->xss_clean($input->post('tglberangkat'));
        $newTglBerangkat    = date("Y-m-d", strtotime($tglberangkat));  
        $tglkembali         = $this->security->xss_clean($input->post('tglkembali'));
        $newTglKembali      = date("Y-m-d", strtotime($tglkembali)); 
        
        $pickup             = $this->security->xss_clean($input->post('pickup'));
        $dropoff            = $this->security->xss_clean($input->post('dropoff'));
        $remarks            = $this->security->xss_clean($input->post('catatan'));
        
        $payment            = $this->security->xss_clean($input->post('payment'));
        
        
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

        $detail_booking_paket = array_merge($temp_dewasa, $temp_anak, $temp_foc);
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
            'userid'        => $_SESSION["logged_status"]["username"],
            'created_at'    => date("Y:m:d H:i:s"),
            'update_at'    => date("Y:m:d H:i:s"),
        );
        
        // echo "<pre>".print_r(array_merge($temp_dewasa, $temp_anak),true)."</pre>";
        $result = $this->booking->insert_booking_paket($datas, $detail_booking_paket);
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;

        if($result['code'] == 200) {
            $this->session->set_flashdata('success', 'Berhasil Booking');
			redirect('booking/preview_paket/'.$kode_ticket);
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
