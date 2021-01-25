<?php

class MinistryUsr extends CI_Model {
    /*
     * Datos del registro del form, tabla de los ministerios del usuario
     */

    public $idUsr;
    public $idMinistry;
    public $description;

    /*
     * Permite insertar Ministerios del usuario, junto con una descripcion si fuera necesario en la BD
     */
    public function insertMinistryUsr($idUsr, $idMinistry, $description) {
        $data = array(
            'idUsr' => $idUsr,
            'idMinistry' => $idMinistry,
            'description' => $description
        );

        $this->db->insert('ministryusr', $data);
    }
}
