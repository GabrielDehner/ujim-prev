<?php

class Ministry extends CI_Model {

    public function selectMinistries() {
        $query = $this->db->query("select idMinistry, description from ministry order by description");

        return $query->result();
    }
}
