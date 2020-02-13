<?php
class LoginModel extends CI_Model{
    
    function fetch_user($data){
        $query = $this->db->query("SELECT * FROM `tbpetugas` WHERE Nama = 'admin' AND password = '21232f297a57a5a743894a0e4a801fc3';");

        return $query;
    }
}