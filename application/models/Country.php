<?php

class Country extends CI_Model {
    /*
     * NO CREO QUE NECESITEMOS INSERTS PQ LA PAG NI LO REQUIERE  
     */

    public $description;

    /*
     * Permite buscar datos de Country en la BD
     */

    public function selectCountry($description) {
        $query = $this->db->query("SELECT idCountry, description "
            . "FROM country WHERE description='" . $description . "'");
        return ($query);
    }

    public function selectDescriptionsCountry() {
        $query = $this->db->query("SELECT idCountry, description FROM country ORDER BY description");

        return $query->result();
    }

    public function selectCountryId($description) {
        $query = $this->db->query("SELECT idCountry "
            . "FROM country WHERE description='" . $description . "'");
        //$query = $query->result
        $query = $query->row();
        return ($query->idCountry);
    }

}
