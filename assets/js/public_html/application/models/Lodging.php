<?php

class Lodging extends CI_Model {
    /*
     * NO CREO QUE NECESITEMOS INSERTS PQ LA PAG NI LO REQUIERE 
     */

    public $idUsr;
    public $year;
    public $place;
    public $bkPlace;

    /*
     * Permite insertar datos de Hospedaje en la BD
     */

    public function insertLodging($idUsr, $year, $place) {
        $data = array(
            'idUsr' => $idUsr,
            'year' => $year,
            'place' => $place,
            'bkPlace' => $place
        );

        $this->db->insert('lodging', $data);
    }
    public function changeValuePlace($value, $idUsr){
        if($value=='NO') {
            $this->db->query("UPDATE lodging 
                            SET bkPlace='" . $value . "', idHost=NULL  
                            WHERE idUsr='" . $idUsr . "' 
                            AND year='2018'");
        }else{
            $this->db->query("UPDATE lodging 
                            SET bkPlace='" . $value . "'
                            WHERE idUsr='" . $idUsr . "' 
                            AND year='2018'");
        }
    }
    public function searchDisponibility($idUsr, $idHost){
        if ($idHost==NULL) {

            $this->db->query("UPDATE lodging
                                SET idHost=NULL    
                                WHERE idUsr='" . $idUsr . "' 
                                AND year='2018'");
        }else{
            $this->db->query("UPDATE lodging
                                SET idHost='" . $idHost . "'   
                                WHERE idUsr='" . $idUsr . "'
                                AND year='2018'");
        }
    }

    /*Consultas para BD Actualizado
ALTER TABLE lodging ADD COLUMN bkPlace varchar(2)
UPDATE lodging SET bkPlace=place
    */
}
