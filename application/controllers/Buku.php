<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct(){
        

        parent :: __construct();
        if($this->session->userdata('username') == ''){
            redirect(base_url() . 'login');
		}
        
		$this->load->model("bukumodel");
    }

	public function index()
	{
		
        //fetch data
        // $data['datas'] = $this->bukumodel->fetchData();
        $data['content'] = 'contents/buku/index';
        $data['scripts'] = 'contents/buku/scripts';

		$this->load->view('app_template', $data);
	}
	
	//membuat tampilan form tambah buku
	public function create(){
		$data['content'] = 'contents/buku/create';
		$data['card_title'] = 'Form Tambah Buku';
		$data['nobuku'] = $this->bukumodel->fetchMaxNoBuku()->result()[0]->maxnobuku;
		$data['kategori'] = $this->bukumodel->fetchKategori();
		$this->load->view('app_template', $data);
	}

	//menyimpan data form tambah buku
	public function store(){

		//validasi form
		$this->form_validation->set_rules('nobuku', 'No Buku', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('judul', 'Judul', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('pengarang', 'Pengarang', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('ddcno', 'DDCNo', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('isbn', 'ISBN', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tahunterbit', 'Tahun Terbit', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('jumlahhalaman', 'Jumlah Halaman', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('jumlahbuku', 'Jumlah Buku', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('asal', 'Asal', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('sinopsis', 'Sinopsis', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		

		if($this->form_validation->run()){
			
			//konfigurasi library upload file sampul
			$config['file_name'] = $this->input->post("nobuku");
			$config['upload_path'] = './uploads/buku_sampul/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 10000;

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			// echo $this->input->post('sampul');
			if($this->upload->do_upload('sampul')){

				//menyimpan ke dalam variabel data
				$data = array(
					"NoBuku"=>$this->input->post("nobuku"),
					"Judul"=>$this->input->post("judul"),
					"Pengarang"=>$this->input->post("pengarang"),
					"Ukuran"=>$this->input->post("ukuran"),
					"DDCNo"=>$this->input->post("ddcno"),
					"Kategori"=>$this->input->post("kategori"),
					"Penerbit"=>$this->input->post("penerbit"),
					"ISBN"=>$this->input->post("isbn"),
					"tahunterbit"=>$this->input->post("tahunterbit"),
					"jumlahhalaman"=>$this->input->post("jumlahhalaman"),
					"JumlahBuku"=>$this->input->post("jumlahbuku"),
					"Tanggal" =>date("d"),
					"Bulan"=>$this->getBulan(date("m")),
					"Tahun"=>date("Y"),
					"Kondisi"=>"Bagus",
					"Asal"=>$this->input->post("asal"),
					"Sinopsis"=>$this->input->post("sinopsis"),
					"Sampul"=>$this->upload->data('file_name')
				);
				// print_r($data);

				//menyimpan variabel data ke database
				$this->bukumodel->store($data);
				
				redirect(base_url() . "buku/stored");
			}else{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				$this->create();
			}
		}else{
			$this->create();
		}
	}

	public function stored(){
		$this->index();
	}
    
    public function fetchBuku(){
        $list = $this->bukumodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '
			<div class="dropdown d-inline-block">
				<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-alternate">Aksi</button>
				<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-7px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
					<a tabindex="0" class="dropdown-item open-modal text-primary lead" href="#" data-toggle="modal" data-target=".bd-example-modal-lg" data-nobuku="'. $field->NoBuku .'"><i class="fas fa-eye"></i> Lihat Buku</a>
					<a tabindex="0" class="dropdown-item text-primary lead" href="'.base_url().'buku/edit/'. $field->NoBuku .'"><i class="fas fa-edit"></i> Edit Buku</a>
				</div>
			</div>
			';
			// <a tabindex="0" class="dropdown-item text-danger lead" href="'. base_url() .'buku/destroy/'. $field->NoBuku .'" ><i class="fas fa-trash"></i> Hapus Buku</a>
            $row[] = $field->NoBuku;
			$row[] = $field->Judul;
			$row[] = $field->Pengarang;
            $row[] = $field->Penerbit;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->bukumodel->count_all(),
			"recordsFiltered" => $this->bukumodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);

	}

	public function edit(){
		$data['nobuku'] = $this->uri->segment(3);
		$data['content'] = 'contents/buku/edit';
		$data['card_title'] = 'Form Edit Buku';

		//mengambil data buku
		$data['data']= $this->bukumodel->fetchViewBuku($this->uri->segment(3))->result()[0];
		// print_r($data['data']);
		$data['kategori'] = $this->bukumodel->fetchKategori();
		$this->load->view('app_template', $data);
	}

	public function update(){

		//validasi form
		$this->form_validation->set_rules('nobuku', 'No Buku', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('judul', 'Judul', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('pengarang', 'Pengarang', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('ddcno', 'DDCNo', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('kategori', 'Kategori', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('isbn', 'ISBN', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('tahunterbit', 'Tahun Terbit', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('jumlahhalaman', 'Jumlah Halaman', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('jumlahbuku', 'Jumlah Buku', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('asal', 'Asal', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		$this->form_validation->set_rules('sinopsis', 'Sinopsis', 'required',
			array('required' => 'Kolom %s Perlu disini.')
		);
		
		if($this->form_validation->run()){
			
			//konfigurasi library upload file sampul
			$config['file_name'] = $this->input->post("nobuku");
			$config['upload_path'] = './uploads/buku_sampul/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 10000;

			$this->load->library('upload', $config);
			$this->upload->overwrite = true;

			if($this->upload->do_upload('sampul')){ //jika user ingin mengubah sampul
				
				//menyimpan ke dalam variabel data
				$data = array(
					"NoBuku"=>$this->input->post("nobuku"),
					"Judul"=>$this->input->post("judul"),
					"Pengarang"=>$this->input->post("pengarang"),
					"Ukuran"=>$this->input->post("ukuran"),
					"DDCNo"=>$this->input->post("ddcno"),
					"Kategori"=>$this->input->post("kategori"),
					"Penerbit"=>$this->input->post("penerbit"),
					"ISBN"=>$this->input->post("isbn"),
					"tahunterbit"=>$this->input->post("tahunterbit"),
					"jumlahhalaman"=>$this->input->post("jumlahhalaman"),
					"JumlahBuku"=>$this->input->post("jumlahbuku"),
					"Asal"=>$this->input->post("asal"),
					"Sinopsis"=>$this->input->post("sinopsis"),
					"Sampul"=>$this->upload->data('file_name')
				);
				
				//menyimpan ke dalam database
				$this->bukumodel->update($data);

				redirect(base_url() . "buku/updated");
			}else{ //sampul dalam keadaan kosong

				//menyimpan ke dalam variabel data
				$data = array(
					"NoBuku"=>$this->input->post("nobuku"),
					"Judul"=>$this->input->post("judul"),
					"Pengarang"=>$this->input->post("pengarang"),
					"Ukuran"=>$this->input->post("ukuran"),
					"DDCNo"=>$this->input->post("ddcno"),
					"Kategori"=>$this->input->post("kategori"),
					"Penerbit"=>$this->input->post("penerbit"),
					"ISBN"=>$this->input->post("isbn"),
					"tahunterbit"=>$this->input->post("tahunterbit"),
					"jumlahhalaman"=>$this->input->post("jumlahhalaman"),
					"JumlahBuku"=>$this->input->post("jumlahbuku"),
					"Asal"=>$this->input->post("asal"),
					"Sinopsis"=>$this->input->post("sinopsis")
				);

				//menyimpan ke dalam database
				$this->bukumodel->update($data);

				redirect(base_url() . "buku/updated");
			}
		}else{
			$this->edit();
		}
	}

	public function updated(){
		$this->index();
	}

	// public function destroy(){
	// 	echo 'deleted';
	// }

	// public function deleted(){

	// }

	public function fetchViewBuku(){
		$nobuku = $this->uri->segment(3);
		$data = $this->bukumodel->fetchViewBuku($nobuku)->result();

		echo json_encode($data);
	}

	//membuat 
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