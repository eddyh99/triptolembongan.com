<?php
if (isset($this->session->userdata['logged_status'])) {
    //Menggabungkan semua bagian halaman
    require_once('header.php');

    require_once('sidebar.php');

    if (isset($content)) {
        $this->load->view($content);
    }

    require_once('footer.php');

} else {
    require_once('header-login.php');
    if (isset($content)) {
        $this->load->view($content);
    }
    require_once('footer-login.php');
}
