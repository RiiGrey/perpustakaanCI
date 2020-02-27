<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {
    
    public function __construct(){
        

        parent :: __construct();
        if($this->session->userdata('username') == ''){
            redirect(base_url() . 'login');
		}
        
		$this->load->model("anggotamodel");
    }

    public function index(){
        
        //fetch data
        // $data['datas'] = $this->bukumodel->fetchData();
        $data['content'] = 'contents/anggota/index';
		$data['scripts'] = 'contents/anggota/scripts';


		$this->load->view('app_template', $data);
    }

    
    public function fetchAnggota(){
        $list = $this->anggotamodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '
			<div class="dropdown d-inline-block">
				<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-alternate">Aksi</button>
				<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-7px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
					<a tabindex="0" class="dropdown-item open-modal text-primary lead" href="#" data-toggle="modal" data-target=".bd-example-modal-lg" data-noanggota="'. $field->NoAnggota .'"><i class="fas fa-eye"></i> Lihat Anggota</a>
					<a tabindex="0" class="dropdown-item text-primary lead" href="'.base_url().'anggota/edit/'. $field->NoAnggota .'"><i class="fas fa-edit"></i> Edit Anggota</a>
				</div>
			</div>
			';
            $row[] = $field->NoAnggota;
			$row[] = $field->Nama;
			$row[] = $field->NoInduk;
            $row[] = $field->Klas;
            $row[] = $field->Kelompok;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->anggotamodel->count_all(),
			"recordsFiltered" => $this->anggotamodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);

    }
    
	//membuat tampilan form tambah anggota
	public function create(){
		$data['content'] = 'contents/anggota/create';
		$data['card_title'] = 'Form Tambah Anggota';
		
		$data['tgllahir'] = $this->dateLahir();
		$data['noanggota'] = $this->anggotamodel->fetchMaxNoAnggota()->result()[0]->maxnoanggota;
		// echo $data['noanggota'];

		// print_r($data['tgllahir']);
		// $data['noanggota'] = $this->bukumodel->fetchMaxNoBuku()->result()[0]->maxnobuku;
		// $data['kategori'] = $this->bukumodel->fetchKategori();
		$this->load->view('app_template', $data);
	}

	public function store(){
		//validasi form
		$this->form_validation->set_rules('noanggota', 'No Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('nama', 'Nama Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('noinduk', 'No Induk Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('klas', 'Kelas Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tempat', 'Kelompok Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tempat', 'Tempat Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('bulan', 'Bulan Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tahun', 'Tahun Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('alamat', 'Alamat Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		
		if($this->form_validation->run()){

			//konfigurasi library upload file sampul
			$config['file_name'] = $this->input->post("noanggota");
			$config['upload_path'] = './uploads/Foto/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 10000;

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			if($this->upload->do_upload('foto')){
				//menyimpan ke dalam variabel data
				$data = array(
					'NoAnggota'=>$this->input->post("noanggota"),
					'Nama'=>$this->input->post("nama"),
					"NoInduk"=>$this->input->post("noinduk"),
					"Klas"=>$this->input->post("klas"),
					"Kelompok"=>$this->input->post("kelompok"),
					"TempatLahir"=>$this->input->post("tempat"),
					"Tanggal"=>$this->input->post("tanggal") . " " . $this->input->post("bulan") . " " . $this->input->post("tahun"),
					"Kelamin"=>$this->input->post("kelamin"),
					"Alamat"=>$this->input->post("alamat"),
					"Masuk"=>date("Y"),
					"Keterangan"=>$this->input->post("keterangan"),
					"NamaFoto"=>$this->upload->data('file_name')
				);

				// print_r($data);

				//menyimpan data ke dalam database
				$this->anggotamodel->store($data);
				
				redirect(base_url() . "anggota/stored");

			}else{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				$this->create();
			}
		}else{
			// echo validation_errors();
			$this->create();
		}
	}

	public function stored(){
		$this->index();
	}
	
	//membuat tampilan form tambah anggota
	public function edit(){
		$data['content'] = 'contents/anggota/edit';
		$data['card_title'] = 'Form Edit Anggota';
		
		$data['tgllahir'] = $this->dateLahir();
		// $data['noanggota'] = $this->anggotamodel->fetchMaxNoAnggota()->result()[0]->maxnoanggota;
		$data['data']= $this->anggotamodel->fetchViewAnggota($this->uri->segment(3))->result()[0];
		// print_r($data['data']);
		$data['viewtgllahir'] = explode(" ", $data['data']->Tanggal);
		$data['noanggota'] = $this->uri->segment(3);
		// print_r($data['viewtgllahir']);

		$this->load->view('app_template', $data);
	}

	public function update(){
		//validasi form
		$this->form_validation->set_rules('noanggota', 'No Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('nama', 'Nama Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('noinduk', 'No Induk Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('klas', 'Kelas Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tempat', 'Kelompok Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tempat', 'Tempat Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('bulan', 'Bulan Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tahun', 'Tahun Lahir Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('alamat', 'Alamat Anggota', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		if($this->form_validation->run()){
			
			//konfigurasi library upload file sampul
			$config['file_name'] = $this->input->post("noanggota");
			$config['upload_path'] = './uploads/Foto/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 10000;

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			if($this->upload->do_upload('foto')){
				$data = array(
					'NoAnggota'=>$this->input->post('noanggota'),
					'Nama'=>$this->input->post('nama'),
					'NoInduk'=>$this->input->post('noinduk'),
					'klas'=>$this->input->post('klas'),
					'Kelompok'=>$this->input->post('kelompok'),
					'TempatLahir'=>$this->input->post('tempat'),
					'Tanggal'=>$this->input->post('tanggal') . ' ' . $this->input->post('bulan') . ' ' . $this->input->post('tahun'),
					'Kelamin'=>$this->input->post('kelamin'),
					'Alamat'=>$this->input->post('alamat'),
					'Masuk'=> date("Y"),
					'Keterangan'=>$this->input->post('keterangan'),
					'NamaFoto'=>$this->upload->data('file_name')
				);


				//menyimpan ke dalam database
				$this->anggotamodel->update($data);

				redirect(base_url() . "anggota/updated");
				
			}else{
				$data = array(
					'NoAnggota'=>$this->input->post('noanggota'),
					'Nama'=>$this->input->post('nama'),
					'NoInduk'=>$this->input->post('noinduk'),
					'klas'=>$this->input->post('klas'),
					'Kelompok'=>$this->input->post('kelompok'),
					'TempatLahir'=>$this->input->post('tempat'),
					'Tanggal'=>$this->input->post('tanggal') . ' ' . $this->input->post('bulan') . ' ' . $this->input->post('tahun'),
					'Kelamin'=>$this->input->post('kelamin'),
					'Alamat'=>$this->input->post('alamat'),
					'Masuk'=> date("Y"),
					'Keterangan'=>$this->input->post('keterangan')
				);
				print_r($data);

				//menyimpan ke dalam database
				$this->anggotamodel->update($data);

				redirect(base_url() . "anggota/updated");

			}
		}else{
			$this->edit();
		}
	}

	public function updated(){
		$this->index();
	}
	
	public function fetchViewAnggota(){
		$noanggota = $this->uri->segment(3);
		$data = $this->anggotamodel->fetchViewAnggota($noanggota)->result();

		echo json_encode($data);
	}

	//external function
	public function dateLahir(){
		$tanggal = array(
			1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31
		);
		$bulan = array(
			'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		);

		$tahun = array();

		for($i = 1960; $i <= date("Y");$i++){
			$tahun[] = $i;
		}

		$data = array(
			"tanggal"=>$tanggal,
			"bulan"=>$bulan,
			"tahun"=>$tahun
		);

		return $data;
	}

}