<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        
        parent :: __construct();
        
        $this->load->model("loginmodel");
    }
    
    public function index(){
        $this->load->view('login/index');
    }

    public function validasi(){
        $data = array(
            'username'=>$this->input->post('username'),
            'password'=>md5($this->input->post('password')),
        );
        $user = $this->loginmodel->fetch_user($data)->row();
        if(!empty($user)){
            $session_data = array(
                'nopetugas' => $user->NoPetugas,
                'username' => $user->Nama,
                'NIP' => $user->NIP,
                'level' => $user->Level
            );
            $this->session->set_userdata($session_data);
            redirect(base_url());
        }else{
            redirect(base_url() . 'login');
        }
    }

    function logout(){
        $this->session->unset_userdata('nopetugas');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('NIP');
        $this->session->unset_userdata('level');
        redirect(base_url() . 'login');
    }
}