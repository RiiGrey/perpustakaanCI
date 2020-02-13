<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjam extends CI_Controller {

    public function __construct(){
        

        parent :: __construct();
        if($this->session->userdata('username') == ''){
            redirect(base_url() . 'login');
		}
        
		$this->load->model("pinjammodel");
    }

    public function index(){
        
        //fetch data
        // $data['datas'] = $this->pinjammodel->fetchData();
        $data['content'] = 'contents/pinjam/index';
        $data['scripts'] = 'contents/pinjam/scripts';
        $data['buku'] = $this->pinjammodel->fetchBuku()->result();
        $data['anggota'] = $this->pinjammodel->fetchAnggota()->result();


		$this->load->view('app_template', $data);
    }

    public function store(){
		//validasi form
		$this->form_validation->set_rules('buku', 'Buku', 'required',
			array('required' => 'Kolom %s Perlu disini.')
        );
		$this->form_validation->set_rules('anggota', 'Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
        );

		if($this->form_validation->run()){
            //mencari buku dan anggota
            $buku = $this->pinjammodel->fetchViewBuku($this->input->post('buku'))->result()[0];
            $anggota = $this->pinjammodel->fetchViewAnggota($this->input->post('anggota'))->result()[0];
            $haruskembali = explode('-',date("d-m-Y", strtotime("+8 day")));

            $data = array(
                "NoAnggota"=> $anggota->NoAnggota,
                "Kelompok"=> $anggota->Kelompok,
                "Nama"=> $anggota->Nama,
                "KodeBuku"=> $buku->NoBuku,
                "Judul"=> $buku->Judul,
                "Pengarang"=> $buku->Pengarang,
                "DDC"=> $buku->DDCNo,
                "Kategori"=> $buku->Kategori,
                "Pinjam"=> date("d") . ' ' . $this->getBulan(date("m")) . ' ' . date("Y"),
                "dateHarusKembali"=>date("Y-m-d", strtotime("+8 day")),
                "TglPinjam"=> date("d"),
                "BlnPinjam"=> $this->getBulan(date("m")) ,
                "ThnPinjam"=> date("Y"),
                "Kembali"=> $haruskembali[0] . ' ' . $this->getBulan($haruskembali[1]) . ' ' . $haruskembali[2],
                "TglKembali"=> $haruskembali[0],
                "BlnKembali"=> $this->getBulan($haruskembali[1]) ,
                "ThnKembali"=> $haruskembali[2],
                "Status"=> "Dipinjam",
            );

            $this->pinjammodel->store($data);
				
            redirect(base_url() . "pinjam/stored");

        }else{
            // echo validation_errors();
			$this->create();
        }

        //menyimpan data ke dalam variabel

        //menyimpan ke dalam database


    }

    public function stored(){
        $this->index();
    }

    
    public function fetchPinjam(){
        $list = $this->pinjammodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
            $row[] = $field->NoAnggota;
			$row[] = $field->Nama;
			$row[] = $field->KodeBuku;
			$row[] = $field->Judul;
            $row[] = $field->Pinjam;
            $row[] = $field->Kembali;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pinjammodel->count_all(),
			"recordsFiltered" => $this->pinjammodel->count_filtered(),
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