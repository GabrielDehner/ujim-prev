<?php

class Devocional extends CI_Model {

    public function getDevocionales() {
        $query = $this->db->query("SELECT * FROM devocional WHERE 1 ORDER BY diaPublicacion DESC");
        return $query->result();
    }
    public function getDevocionalesHastaHoy() {
        date_default_timezone_set('America/Buenos_Aires');
        $hoy = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM devocional WHERE diaPublicacion <='".$hoy."' ORDER BY diaPublicacion DESC");
        return $query->result();
    }
    public function getDevocionalByDate($fecha) {
        $query = $this->db->query("SELECT * FROM devocional WHERE diaPublicacion ='".$fecha."' ORDER BY diaPublicacion DESC");
        $resultado = $query->result();
        if($resultado){
            return $resultado[0];
        }else{
            return null;
        }
    }

    public function getDevocionalesCount() {
        return $this->db->query("SELECT count(*) count FROM devocional")->row_array()['count'];
    }
    
}