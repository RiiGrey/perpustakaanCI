<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kembali extends CI_Controller {
    
  public function __construct(){
      
    parent :: __construct();
    if($this->session->userdata('username') == ''){
      redirect(base_url() . 'login');
    }
        
    $this->load->model("kembalimodel");
  }

  public function index(){
      
    $data['content'] = 'contents/kembali/index';
    $data['scripts'] = 'contents/kembali/scripts';
    $data['pinjam'] = $this->kembalimodel->fetchPinjam()->result();
      
    $this->load->view('app_template', $data);
  }

  public function store(){
    $this->form_validation->set_rules('pinjam', 'Pinjam', 'required',
      array('required' => 'Kolom %s Perlu disini.')
    );
    
    if($this->form_validation->run()){
      $pinjam = $this->kembalimodel->fetchViewPinjam($this->input->post('pinjam'))->result()[0];

      $hariini = explode('-',date("d-m-Y"));

      $now = time(); // or your date as well
      $tglharuskembali = strtotime($pinjam->dateHarusKembali);
      $masa = round(($now - $tglharuskembali)/ (60 * 60 * 24));
      $denda = $masa > 0?$masa*1000:0;

      $data = array(
        "NoAnggota"=>$pinjam->NoAnggota,
        "KodeBuku"=>$pinjam->KodeBuku,
        "Judul"=>$pinjam->Judul,
        "Pengarang"=>$pinjam->Pengarang,
        "DDC"=>$pinjam->DDC,
        "Kategori"=>$pinjam->Kategori,
        "TglPinjam"=>$pinjam->Pinjam,
        "Kembali"=> $hariini[0] . ' ' . $this->getBulan($hariini[1]) . ' ' . $hariini[2],
        "Denda"=> $denda,
        "Nama"=> $pinjam->Nama,
        "TglKembali"=> $hariini[0],
        "Bulan"=> $hariini[1],
        "Tahun"=> $hariini[2],
        "Kelompok"=> $pinjam->Kelompok
      );
      $data2 = array(
        'id_pinjam'=>$pinjam->id_pinjam,
        'Status'=>'Sudah dikembalikan'
      );

      $this->kembalimodel->updatePinjam($data2);

      $this->kembalimodel->store($data);
      
      redirect(base_url() . "kembali/stored");
    }else{
      $this->index();
    }
  }

  public function stored(){
    $this->index();
  }

  public function fetchKembali(){

    $list = $this->kembalimodel->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $field) {
      $no++;
      $row = array();
      $row[] = $field->NoAnggota;
      $row[] = $field->Nama;
      $row[] = $field->KodeBuku;
      $row[] = $field->Judul;
      $row[] = $field->TglPinjam;
      $row[] = $field->Kembali;
      $row[] = $field->Denda;

      $data[] = $row;
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->kembalimodel->count_all(),
      "recordsFiltered" => $this->kembalimodel->count_filtered(),
      "data" => $data,
    );
    //output dalam format JSON
    echo json_encode($output);

  }

    
	//function internal
	private function getBulan($sekarang){
		
    switch($sekarang){
      case 1 :
        $bulan = 'Januari';
        break;
      case 2 :
        $bulan = 'Februari';
        break;
      case 3 :
        $bulan = 'Maret';
        break;
      case 4 :
          $bulan = 'April';
          break;
      case 5 :
        $bulan = 'Mei';
        break;
      case 6 :
        $bulan = 'Juni';
        break;
      case 7 :
        $bulan = 'Juli';
        break;
      case 8 :
        $bulan = 'Agustus';
        break;
      case 9 :
          $bulan = 'September';
          break;
      case 10 :
        $bulan = 'Oktober';
        break;
      case 11 :
        $bulan = 'November';
        break;
      case 12 :
        $bulan = 'Desember';
        break;
    }
    return $bulan;
  }

}