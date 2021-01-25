<?php

class City extends CI_Model {
    /*
     * NO CREO QUE NECESITEMOS INSERTS PQ LA PAG NI LO REQUIERE  
     */

    public $description;
    public $idProvince;

    /*
     * Permite buscar datos de City en la BD
     */

    public function selectCity($description) {///
        $query = $this->db->query("SELECT idCity, description, idProvince "
                . "FROM city WHERE description='" . $description . "'");
        return($query);
    }

    public function selectDescriptionsCity($idProvince) {///
        $query = $this->db->query("SELECT description FROM city WHERE idProvince='" .
                $idProvince . "' ORDER BY description");
        $query = $query->result();
        return($query);
    }

    public function selectCitiesByProvince($filter, $idProvince) {
        $query = $this->db->query("SELECT idCity, description FROM city 
                                        WHERE idProvince='$idProvince' AND description LIKE '%$filter%'");

        return $query->result();
    }

    public function selectIdCityByIdProvince($idProvince) {
        $query = $this->db->query("SELECT idCity FROM city WHERE idProvince='$idProvince'");

        $result = $query->result();
        return $result[0]->idCity;
    }

    public function selectCitiesPresents() {///
        $query = $this->db->query("SELECT ch.idChurch, ci.description desccity, ch.description descchurch 
                                    FROM church ch LEFT JOIN city ci ON ch.idCity=ci.idCity 
                                    WHERE ci.description IS NOT NULL
                                    ORDER BY ci.description");
        $query = $query->result();
        return($query);
    }

    public function selectCitiesPresents2() {
        $query = $this->db->query("SELECT ch.idChurch, ci.description city, ch.description church, ci.idCity 
                                    FROM church ch LEFT JOIN city ci ON ch.idCity=ci.idCity 
                                    WHERE ci.description IS NOT NULL
                                    ORDER BY ci.description");
        $query = $query->result();
        return($query);
    }

}
