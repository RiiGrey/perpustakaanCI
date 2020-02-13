<?php
class KembaliModel extends CI_Model{
    var $table = 'tbkembali'; //nama tabel dari database
	var $column_order = array(null, 'NoAnggota', 'Nama','KodeBuku','Judul', 'TglPinjam', 'Kembali', 'Denda'); //field yang ada di table user
	var $column_search = array('NoAnggota', 'Nama','KodeBuku','Judul', 'TglPinjam', 'Kembali', 'Denda'); //field yang diizin untuk pencarian 
	var $order = array('id_kembali' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function fetchPinjam(){
		$query = $this->db->query('SELECT * FROM tbpinjam WHERE Status = "Dipinjam"');

		return $query;
	}

	public function fetchViewPinjam($id){
		$query = $this->db->query('SELECT * FROM tbpinjam WHERE id_pinjam = ' . $id);

		return $query;
	}

	
	public function store($data){
        $this->db->insert("tbkembali", $data);
	}

    function updatePinjam($data){
        $this->db->where("id_pinjam", $data['id_pinjam']);
        $this->db->update("tbpinjam", $data);
    }

}