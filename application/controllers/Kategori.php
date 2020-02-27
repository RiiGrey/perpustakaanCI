<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
    
    public function __construct(){
        

        parent :: __construct();
        if($this->session->userdata('username') == ''){
            redirect(base_url() . 'login');
		}
        
		$this->load->model("kategorimodel");
    }

    public function index(){
        
        //fetch data
        // $data['datas'] = $this->bukumodel->fetchData();
        $data['content'] = 'contents/kategori/index';
		$data['scripts'] = 'contents/kategori/scripts';


		$this->load->view('app_template', $data);
    }

    public function fetchKategori(){
        $list = $this->kategorimodel->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = '
			<div class="dropdown d-inline-block">
				<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-alternate">Aksi</button>
				<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(-7px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
					<a tabindex="0" class="dropdown-item open-modal text-primary lead" href="#" data-toggle="modal" data-target=".bd-example-modal-lg" data-nokategori="'. $field->NoKategori .'"><i class="fas fa-edit"></i> Edit Kategori</a>
				</div>
			</div>
			';
			$row[] = $field->Deskripsi;
			$row[] = $field->Keterangan;

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kategorimodel->count_all(),
			"recordsFiltered" => $this->kategorimodel->count_filtered(),
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
    }
}