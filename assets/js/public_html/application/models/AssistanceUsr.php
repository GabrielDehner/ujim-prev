<?php

class AssistanceUsr extends CI_Model {
    /*
     * NO CREO QUE NECESITEMOS INSERTS PQ LA PAG NI LO REQUIERE 
     */

    public $year;
    public $idUsr;

    /*
     * Permite buscar datos de AssistanceUsr en la BD
     */

    public function selectAssistanceUsr($year) {
        $query = $this->db->query("SELECT idUsr, year "
            . "FROM assistenceusr WHERE year='" . $year . "'");
        //$query = $query->row();
        //$query->idUsr
        return ($query);
    }

    public function insertAssistanceUsr($idUsr, $year) {
        $data = array(
            'idUsr' => $idUsr,
            'year' => $year
        );

        $this->db->insert('assistanceusr', $data);
    }

}
