<?php

class Church extends CI_Model {
public $description;
public $state;
    
    public function insertChurch($description, $idCity, $state){
        $data = array(
            'description' => $description,
            'idCity' => $idCity,
            'state' => $state
        );

        $this->db->insert('church', $data);

        return $this->db->insert_id();
        
    }
    public function selectChurches() {
        $query = $this->db->query("select idChurch, description, state from church order by idChurch");

        return $query->result();
    }
}
