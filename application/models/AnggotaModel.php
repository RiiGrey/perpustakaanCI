<?php
class AnggotaModel extends CI_Model{

    var $table = 'tbanggota'; //nama tabel dari database
	var $column_order = array(null, 'NoAnggota', 'Nama','NoInduk','Klas', 'Kelompok'); //field yang ada di table user
	var $column_search = array('NoAnggota', 'Nama','NoInduk','Klas', 'Kelompok'); //field yang diizin untuk pencarian 
	var $order = array('Kelompok'=> 'asc', 'NoAnggota' => 'asc'); // default order 

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

	public function fetchViewAnggota($noanggota){
		$query = $this->db->query('SELECT * FROM tbanggota WHERE NoAnggota = '. $noanggota);

		return $query;
	}

	
	public function fetchMaxNoAnggota(){
		$query = $this->db->query('SELECT MAX(NoAnggota)+1 as maxnoanggota FROM `tbanggota`');

		return $query;
	}
	
	public function store($data){
        $this->db->insert("tbanggota", $data);

	}
	
    function update($data){
        $this->db->where("NoAnggota", $data['NoAnggota']);
        $this->db->update("tbanggota", $data);
    }
}