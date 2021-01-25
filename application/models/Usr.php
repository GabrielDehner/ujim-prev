<?php

class Usr extends CI_Model {
    /*
     * Datos del registro del form.
     */
    //public $idUsr;
    //private $CURRENT_YEAR = date('Y');;
    public $name;
    public $surname;
    public $sex;
    public $birthday;
    public $telephone;
    public $email;
    public $disease;
    public $idChurch;
    public $idCity;

    /*
     * Permite insertar Usuarios en la BD.
     * @return Id del usuario.
     */
    public function insertUsr($name, $surname, $sex, $birthday, $telephone, $email, $disease, $city, $church) {
        $data = array(
            'name' => $name,
            'surname' => $surname,
            'sex' => $sex,
            'birthday' => $birthday,
            'telephone' => $telephone,
            'email' => $email,
            'disease' => $disease,
            'idCity' => $city,
            'idChurch' => $church
        );

        $res = $this->existeUsuario($email);
        $id = $res->idUsr;

        if ($res !== false) {
            $this->db->where('idUsr', $res->idUsr);
            $this->db->update("usr", $data);
        } else {
            $this->db->insert('usr', $data);
            $id = $this->db->insert_id(); 
        }

        return $id;
    }

    public function existeUsuario($email) {
        $query = $this->db->query("SELECT u.idUsr from usr u 
                                   join assistanceusr au on au.idUsr = u.idUsr
                                   where email ='" . $email . "' and year < ". date("Y"));
        
        return ($query->num_rows() > 0) ? $query->row(0) : false;
    }

    /*
     * Permite buscar datos de los Usuarios en la BD
     */

    public function selectUsr($name, $surname) {
        $query = $this->db->query("SELECT idUsr, name, surname, birthday, telephone, email, idChurch, idCity "
                . "FROM usr WHERE name='" . $name . "' AND "
                . "surname='" . $surname . "'");
        //$query = $query->row();
        //$query->idUsr
        return($query);
    }
    public function selectUsrs($idChurch) {
        $query = $this->db->query("SELECT name, surname, telephone, l.bkPlace place, email, sex, ch.description descchurch, ci.description desccity, log 
                                    FROM usr us
                                        INNER JOIN church ch ON us.idChurch=ch.idChurch 
                                        INNER JOIN city ci ON us.idCity=ci.idCity
                                        INNER JOIN lodging l ON us.idUsr=l.idUsr 
                                        WHERE l.year='2018'
                                        AND ch.idChurch ='".$idChurch."'
                                        ORDER BY ch.description, surname, name");
        return($query->result());
    }
    public function selectUsrs2($idChurch) {
        $query = $this->db->query("SELECT us.idUsr, name, surname, telephone, l.bkPlace place, email, sex, ch.description descchurch, ci.description desccity, log 
                                    FROM usr us
                                        INNER JOIN church ch ON us.idChurch=ch.idChurch 
                                        INNER JOIN city ci ON us.idCity=ci.idCity
                                        INNER JOIN lodging l ON us.idUsr=l.idUsr 
                                        WHERE l.year='2018'
                                        AND ch.idChurch ='".$idChurch."'
                                        ORDER BY ch.description, surname, name");
        return($query->result());
    }
    public function selectUsrsForChurchs() {
        $query = $this->db->query("SELECT us.idUsr, name, surname, telephone, l.place, email, sex, ch.description descchurch, ch.idChurch, ci.description desccity, log 
                                    FROM usr us
                                        INNER JOIN church ch ON us.idChurch=ch.idChurch 
                                        INNER JOIN city ci ON us.idCity=ci.idCity
                                        INNER JOIN lodging l ON us.idUsr=l.idUsr 
                                        WHERE l.year='2018'
                                        ORDER BY ch.description, surname, name");
        return($query->result());
    }
    public function selectUsrsConfes(){
         $query = $this->db->query("SELECT us.idUsr, us.name, us.surname, us.sex, ci.description desccity, ch.description descchurch, l.bkPlace, ifnull(l.idHost, 'Ninguno') siHost, h.name nameh, h.surname surnameh
                                    FROM usr us
                                    INNER JOIN city ci ON ci.idCity=us.idCity
                                    INNER JOIN church ch ON ch.idChurch=us.idChurch
                                    INNER JOIN lodging l ON l.idUsr=us.idUsr
                                    LEFT JOIN host h ON h.idHost=l.idHost
                                    WHERE l.year='".date("Y")."'

                                    ORDER BY us.surname, us.name");
         return($query->result());
    }

    public function selectUsrsLodging() {
        $query = $this->db->query("SELECT ifnull(ci.description, 'ZFaltaID') desccity, ch.description descchurch, cons1.mujeres, cons2.hombres
                                    FROM church ch LEFT JOIN 
                                    (
                                        SELECT ifnull(COUNT(cons11.idUsr),0) mujeres, ch.idChurch, ch.idCity, cons11.idUsr
                                        FROM church ch LEFT JOIN 
                                        (
                                            SELECT us.idUsr, us.idChurch
                                            FROM usr us 
                                                INNER JOIN lodging l ON l.idUsr=us.idUsr
                                                WHERE l.bkPlace='NO'
                                                AND l.year='".date("Y")."'
                                                AND us.sex='F') cons11 ON cons11.idChurch=ch.idChurch
                                            GROUP BY ch.description) cons1 ON cons1.idChurch=ch.idChurch
                                        LEFT JOIN 
                                    (
                                        SELECT ifnull(COUNT(cons21.idUsr),0) hombres, ch.idChurch, ch.idCity, cons21.idUsr
                                        FROM church ch LEFT JOIN 
                                        (
                                            SELECT us.idUsr, us.idChurch
                                            FROM usr us 
                                                INNER JOIN lodging l ON l.idUsr=us.idUsr
                                                WHERE l.bkPlace='NO'
                                                AND l.year='".date("Y")."'
                                                AND us.sex='M') cons21 ON cons21.idChurch=ch.idChurch
                                            GROUP BY ch.description) cons2 ON cons2.idChurch=ch.idChurch 
                                    LEFT JOIN city ci ON cons1.idCity=ci.idCity
                                    LEFT JOIN usr us ON cons2.idUsr=us.idUsr
                                    GROUP BY ch.description
                                    ORDER BY ci.description, ch.description");
        /*
        SELECT ci.description desccity, ch.description descchurch, cons1.mujeres, cons2.hombres
                                    FROM (
                                        SELECT ifnull(COUNT(us.idUsr),0) mujeres, ch.idChurch, ch.idCity
                                        FROM church ch LEFT JOIN usr us ON us.idChurch=ch.idChurch 
                                        AND us.sex='F' GROUP BY ch.description) cons1,
                                        (
                                        SELECT ifnull(COUNT(us.idUsr),0) hombres, ch.idChurch, ch.idCity
                                        FROM church ch LEFT JOIN usr us ON us.idChurch=ch.idChurch 
                                        AND us.sex='M' GROUP BY ch.description) cons2,
                                                                          
                                        
                                        city ci, church ch, lodging l, usr us
                                        WHERE cons1.idChurch=ch.idChurch
                                        AND cons2.idChurch=ch.idChurch
                                        AND cons1.idCity=ci.idCity
                                        AND cons2.idCity=ci.idCity
                                        AND l.idUsr=us.idUsr
                                        AND l.year='2018'
                                        GROUP BY ch.description*/
        return($query->result());
    }

     public function selectUsrsCount() {
        $query = $this->db->query("SELECT COUNT(*) cont ". 
                                    "FROM usr us ". 
                                    "INNER JOIN assistanceusr ass ON us.idUsr=ass.idUsr ".
                                    "WHERE ass.year='".date("Y")."'");
        return($query->row());
    }


    public function verifyEmail($email) {
        $retorno = true;

        $query = $this->db->query("SELECT email FROM usr u 
                                join assistanceusr au on au.idUsr = u.idUsr
                                WHERE email ='" . $email . "' and year = ". date("Y"));
        if ($query->num_rows() > 0) {
            $retorno = false;
        }

        return $retorno;
    }

    public function searchDisponibility($sex) {

        $query = $this->db->query("SELECT (d.quantity-cons2.cont) loqqueda, h.idHost, d.sex, h.name, h.surname, h.telephone, d.quantity, cons2.cont
                                    FROM (
                                        SELECT COUNT(cons1.sex) cont, d.idHost, d.sex
                                        FROM disponibility d
                                        LEFT JOIN 
                                        (SELECT us.sex, l.idHost
                                        FROM lodging l 
                                        INNER JOIN usr us ON l.idUsr=us.idUsr) cons1 ON cons1.idHost=d.idHost AND cons1.sex=d.sex
                                        AND cons1.idHost IS NOT NULL
                                        GROUP BY idHost, d.sex) cons2
                                    INNER JOIN host h ON cons2.idHost=h.idHost
                                    INNER JOIN disponibility d ON d.idHost=h.idHost AND d.sex=cons2.sex AND d.year='".date("Y")."' AND d.sex='".$sex."' 
                                    HAVING loqqueda>0");
        return($query->result());
        //en renglon 177 esta el tema, pq no se machea con los de A
    }

    public function searchDisponibilityAditional() {

        $query = $this->db->query("SELECT DISTINCT (d.quantity-cons2.cont) loqqueda, h.idHost, d.sex, h.name, h.surname, h.telephone, d.quantity, cons2.cont
                                    FROM (
                                        SELECT COUNT(cons1.sex) cont, d.idHost, d.sex
                                        FROM disponibility d
                                        LEFT JOIN
                                        (SELECT us.sex, l.idHost
                                        FROM lodging l
                                        INNER JOIN usr us ON l.idUsr=us.idUsr) cons1 ON cons1.idHost=d.idHost
                                        AND cons1.idHost IS NOT NULL
                                        GROUP BY idHost, d.sex) cons2
                                    INNER JOIN host h ON cons2.idHost=h.idHost
                                    INNER JOIN disponibility d ON d.idHost=h.idHost AND d.year='".date("Y")."' AND d.sex='A'
                                    HAVING loqqueda>0");
        return($query->result());
        //en renglon 177 esta el tema, pq no se machea con los de A
    }


public function searchDisponibility2() {

    $query = $this->db->query("SELECT (d.quantity-cons2.cont) loqqueda, h.idHost, d.sex, h.name, h.surname, h.telephone, d.quantity, cons2.cont cont
                                       FROM (
                                           SELECT COUNT(cons1.sex) cont, d.idHost, d.sex
                                           FROM disponibility d
                                           LEFT JOIN
                                           (SELECT us.sex, l.idHost
                                           FROM lodging l
                                           INNER JOIN usr us ON l.idUsr=us.idUsr) cons1 ON cons1.idHost=d.idHost AND cons1.sex=d.sex
                                           AND cons1.idHost IS NOT NULL
                                           GROUP BY idHost, d.sex) cons2
                                       INNER JOIN host h ON cons2.idHost=h.idHost
                                       INNER JOIN disponibility d ON d.idHost=h.idHost AND d.sex=cons2.sex AND d.year='2018'
                                       ORDER BY h.surname, h.name, h.idHost");
    return($query->result());

}
public function selectCitysOfUsers() {

    $query = $this->db->query("SELECT DISTINCT ci.idCity, ci.description
                                FROM usr us INNER JOIN city ci ON ci.idCity=us.idCity
                                ORDER BY ci.description");
    return($query->result());

}
public function reportForCity($idCity){
    $query = $this->db->query("SELECT us.surname, us.name, us.sex, us.birthday, us.telephone, us.email 
    FROM usr us JOIN assistanceusr au ON au.idUsr=us.idUsr
    WHERE us.idCity='".$idCity."'AND au.year='".date('Y')."' ORDER BY us.surname, us.name");
    //var_dump($idCity);
   // echo $idCity;
    return($query->result());
}
public function reportForCityCount($idCity){
    $query = $this->db->query("SELECT COUNT(*) cant 
                                FROM usr us JOIN assistanceusr au ON au.idUsr=us.idUsr  
                                WHERE idCity='".$idCity."' AND au.year='".date('Y')."'");
    //var_dump($idCity);
    // echo $idCity;
    return($query->result());

}
public function reportForLodging(){
    $query = $this->db->query("SELECT us.surname, us.name, us.sex, us.birthday, us.telephone, h.surname surnameh, h.name nameh
                                FROM usr us INNER JOIN lodging l ON l.idUsr=us.idUsr
                                INNER JOIN host h ON h.idHost=l.idHost
                                INNER JOIN assistanceusr au ON us.idUsr=au.idUsr
                                WHERE au.year='".date('Y')."' 
                                ORDER BY us.surname, us.name");
    return($query->result());

}
public function reportForHost(){
    $query = $this->db->query("SELECT h.surname surnameh, h.name nameh, us.surname, us.name, us.sex, us.birthday, us.telephone
                                FROM usr us INNER JOIN lodging l ON l.idUsr=us.idUsr
                                INNER JOIN host h ON h.idHost=l.idHost
                                INNER JOIN assistanceusr au ON us.idUsr=au.idUsr
                                WHERE au.year='".date('Y')."'
                                ORDER BY h.surname, h.name");
    return($query->result());

}




/*
 *
 * SELECT DISTINCT (d.quantity-cons2.cont) loqqueda, h.idHost, d.sex, h.name, h.surname, h.telephone, d.quantity, cons2.cont
                                    FROM (
                                        SELECT COUNT(cons1.sex) cont, d.idHost, d.sex
                                        FROM disponibility d
                                        LEFT JOIN
                                        (SELECT us.sex, l.idHost
                                        FROM lodging l
                                        INNER JOIN usr us ON l.idUsr=us.idUsr) cons1 ON cons1.idHost=d.idHost
                                        AND cons1.idHost IS NOT NULL
                                        GROUP BY idHost, d.sex) cons2
                                    INNER JOIN host h ON cons2.idHost=h.idHost
                                    INNER JOIN disponibility d ON d.idHost=h.idHost AND d.year='2018' AND d.sex='A'
                                    HAVING loqqueda>0*/







    /*
     * Al principio no va a hacer falta modificar o borrar
     */
    public function searchUsrsEditDelete(){
        $query = $this->db->query("SELECT us.idUsr, name, surname, telephone, sex, birthday, email
                                    FROM usr us INNER JOIN assistanceusr ass ON us.idUsr=ass.idUsr
                                    WHERE ass.year='".date("Y")."'");
        return($query->result());
    }

    ////
    public function selectData($idUsr){
        $query = $this->db->query("SELECT idUsr, name, surname, telephone, sex, birthday, email
                                    FROM usr WHERE idUsr='".$idUsr."'");
        return($query->row());
    }


    public function update($data)
    {
        $query = $this->db->query("UPDATE usr
                                   SET name='".$data['name']."', surname='".$data['surname']."', telephone='".$data['telephone']."', sex='".$data['sex']."', birthday='".$data['birthday']."', email='".$data['email']."'   
                                   WHERE idUsr='".$data['idUsr']."'");

        //var_dump($query);


    }

    public function delete_by_id($idUsr)
    {
        $this->db->query("DELETE FROM ministryusr WHERE idUsr='".$idUsr."'");
        $this->db->query("DELETE FROM lodging WHERE idUsr='".$idUsr."'");
        $this->db->query("DELETE FROM usr WHERE idUsr='".$idUsr."'");//aca tmb en usuario hay q borrar lodging y ministryyusr


    }
}
