<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Host extends CI_Model {
	//private $CURRENT_YEAR = '2019';
	var $table = 'host';
	var $column_order = array('name','surname','telephone',null); //set column field database for datatable orderable
	var $column_search = array('name','surname'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('surname' => 'desc'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function searchHostAndDisponibility(){
        $query = $this->db->query("SELECT DISTINCT h.idHost, h.name, h.surname, h.telephone, ifnull(cons1.cantMujeres,0) cantMujeres, ifnull(cons2.cantHombres,0) cantHombres, ifnull(cons3.cantAmbos,0) cantAmbos
                                    FROM host h
                                    LEFT JOIN (
                                                SELECT d.quantity cantMujeres, h.idHost
                                                FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
                                                WHERE d.sex='F') cons1 ON cons1.idHost=h.idHost
                                    LEFT JOIN (
                                                SELECT d.quantity cantHombres, h.idHost
                                                FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
                                                WHERE d.sex='M') cons2 ON cons2.idHost=h.idHost
                                    LEFT JOIN (
                                                SELECT d.quantity cantAmbos, h.idHost
                                                FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
												WHERE d.sex='A') cons3 ON cons3.idHost=h.idHost
									LEFT JOIN disponibility d ON d.idHost=h.idHost 
									WHERE d.year='".date("Y")."'");
        return($query->result());

    }

    public function selectData($idHost){
        $query = $this->db->query("SELECT h.idHost, h.name, h.surname, h.telephone, ifnull(cons1.cantMujeres,0) cantMujeres, ifnull(cons2.cantHombres,0) cantHombres, ifnull(cons3.cantAmbos,0) cantAmbos
                                    FROM host h
                                    LEFT JOIN (
                                                SELECT d.quantity cantMujeres, h.idHost
                                                FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
                                                WHERE d.sex='F') cons1 ON cons1.idHost=h.idHost
                                    LEFT JOIN (
                                                SELECT d.quantity cantHombres, h.idHost
                                                FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
                                                WHERE d.sex='M') cons2 ON cons2.idHost=h.idHost
                                    LEFT JOIN (
                                                SELECT d.quantity cantAmbos, h.idHost
                                                FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
                                                WHERE d.sex='A') cons3 ON cons3.idHost=h.idHost
                                                WHERE h.idHost='".$idHost."'");
        return($query->row());
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

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($data)
	{
        $query = $this->db->query("UPDATE host
                                   SET name='".$data['name']."', surname='".$data['surname']."', telephone='".$data['telephone']."'   
                                   WHERE idHost='".$data['idHost']."'");
        //echo json_encode($data);


	}

    public function delete_by_id($idHost)
    {
        $this->db->query("DELETE FROM host WHERE idHost='".$idHost."'");

    }


}
