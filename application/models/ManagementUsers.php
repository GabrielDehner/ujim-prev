<?php

class ManagementUsers extends CI_Model {

    public function verifyUser($username, $contrasenia) {
        $query = $this->db->query("SELECT id FROM managementusers WHERE username='" . $username . "' AND"
                . " password='" . $contrasenia . "'");
        $query = $query->row();
        $retorno = null;
        if (isset($query)) {
            $retorno = $query->id;
        } else {
            $retorno = '';
        }
        return $retorno;
    }
}