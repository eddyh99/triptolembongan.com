<?php
class Message{

    public function success_msg(){
        return "<font>Data telah tersimpan</font>";
    }

    public function error_msg($errmsg){
        return $errmsg;
    }

    public function delete_msg(){
        return "<font>Data berhasil terhapus</font>";
    }

    public function error_delete_msg(){
        return "<font>Data gagal/sudah terhapus</font>";
    }

    public function active_msg(){
        return "<font>Data telah aktif</font>";
    }

    public function error_active_msg(){
        return "<font>Data gagal/sudah aktif</font>";
    }
}
?>