<?php

class Province extends CI_Model {
    /*
     * NO CREO QUE NECESITEMOS INSERTS PQ LA PAG NI LO REQUIERE  
     */

    public $description;

    /*
     * Permite buscar datos de Province en la BD
     */

    public function selectProvince($description) {///
        $query = $this->db->query("SELECT idProvince, description, idCountry "
                . "FROM province WHERE description='" . $description . "'");
        return($query);
    }

    public function selectProvinceId($description) {///
        $query = $this->db->query("SELECT idProvince "
                . "FROM province WHERE description='" . $description . "'");
        //$query = $query->result
        $query = $query->row();
        return($query->idProvince);
    }

    public function selectDescriptionsProvince() {///
        $query = $this->db->query("SELECT description FROM province ORDER BY description");
        $query = $query->result();
        return($query);
    }

    public function selectProvincesByCountry($idCountry) {///
        $query = $this->db->query("SELECT idProvince, description FROM province WHERE idCountry='$idCountry' ORDER BY description");

        return $query->result();
    }

}
