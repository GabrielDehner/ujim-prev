<?php

class Lodging extends CI_Model {
    /*
     * NO CREO QUE NECESITEMOS INSERTS PQ LA PAG NI LO REQUIERE 
     */
    //private $CURRENT_YEAR = date('Y');;
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
                            AND year='".date("Y")."'");
        }else{
            $this->db->query("UPDATE lodging 
                            SET bkPlace='" . $value . "'
                            WHERE idUsr='" . $idUsr . "' 
                            AND year='".date("Y")."'");
        }
    }
    public function searchDisponibility($idUsr, $idHost){
        if ($idHost==NULL) {

            $this->db->query("UPDATE lodging
                                SET idHost=NULL    
                                WHERE idUsr='" . $idUsr . "' 
                                AND year='".date("Y")."'");
        }else{
            $this->db->query("UPDATE lodging
                                SET idHost='" . $idHost . "'   
                                WHERE idUsr='" . $idUsr . "'
                                AND year='".date("Y")."'");
        }
    }

    /*Consultas para BD Actualizado
ALTER TABLE lodging ADD COLUMN bkPlace varchar(2)
UPDATE lodging SET bkPlace=place
    */
}
