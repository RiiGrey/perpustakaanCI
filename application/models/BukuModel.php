<?php
class BukuModel extends CI_Model{

    var $table = 'tbbuku'; //nama tabel dari database
	var $column_order = array(null, 'NoBuku', 'Judul','Pengarang','Penerbit', 'ISBN'); //field yang ada di table user
	var $column_search = array('NoBuku', 'Judul','Pengarang','Penerbit', 'ISBN'); //field yang diizin untuk pencarian 
	var $order = array('Judul' => 'asc'); // default order 

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

	public function fetchViewBuku($nobuku){
		$query = $this->db->query('SELECT * FROM tbbuku WHERE NoBuku = '. $nobuku);

		return $query;
	}

	public function fetchMaxNoBuku(){
		$query = $this->db->query('SELECT MAX(NoBuku)+1 as maxnobuku FROM `tbbuku`');

		return $query;
	}

	public function fetchKategori(){
		$query = $this->db->query('SELECT * FROM tbkategori ORDER BY Deskripsi');

		return $query;
	}

	public function store($data){
        $this->db->insert("tbbuku", $data);

	}
	
    function update($data){
        $this->db->where("NoBuku", $data['NoBuku']);
        $this->db->update("tbbuku", $data);
    }

}