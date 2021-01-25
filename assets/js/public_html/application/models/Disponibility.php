<?php

class Disponibility extends CI_Model {
public $description;
public $state;


    public function insertDisponibility($data){
        $this->db->insert('disponibility', $data);
        return $this->db->insert_id();
    }

    public function quantityDisponibility($data)
    {
        $query = $this->db->query("UPDATE disponibility 
                                   SET quantity='".$data['quantity']."'   
                                   WHERE idHost='".$data['idHost']."' AND sex='".$data['sex']."' AND year='".$data['year']."'");

        //echo json_encode($data);
    }
    public function delete_by_id($idHost)
    {
        $this->db->query("DELETE FROM disponibility WHERE idHost='".$idHost."'");

    }


}
