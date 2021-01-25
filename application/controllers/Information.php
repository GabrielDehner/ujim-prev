<?php

class Information extends CI_Controller {

    public function index() {

        $this->load->library('session');
        $isLog = $this->session->has_userdata('idUser');
        if ($isLog == true) {
            $this->load->model('Usr', '', true);
            $this->load->model('City', '', true);

            //$data['cities'] = $this->City->selectCitiesPresents2();
            //$data['users'] = $this->Usr->selectUsrsForChurchs();
            $data['controller'] = 'information';


        
            //$data['usrs'] = $this->Usr->selectUsrs();
            $data['usrcount'] = $this->Usr->selectUsrsCount();
            $data['lodging'] = $this->Usr->selectUsrsLodging();
            //$data['cities'] = $this->City->selectCitiesPresents();
            //$data['users'] = $this->Usr->selectUsrsForChurchs();

            $data['usrsConf'] = $this->Usr->selectUsrsConfes();
            $data['disponibilityF'] = $this->Usr->searchDisponibility('F');
            $data['disponibilityM'] = $this->Usr->searchDisponibility('M');//seguir manejando asi
            $aditional = $this->Usr->searchDisponibilityAditional();

            $i=0;
            $cn= count($data['disponibilityF']);
            foreach ($aditional as $ad){
                $data['disponibilityF'][$i+$cn]=$ad;
                $i++;
            }
            $i=0;
            $cn= count($data['disponibilityM']);
            foreach ($aditional as $ad){
                $data['disponibilityM'][$i+$cn]=$ad;
                $i++;
            }
            $this->load->view('public/headerAdmin.php', $data);
            $this->load->view('information/information.php', $data);
            $this->load->view('public/footer.php', $data);

        }else{
            redirect('login');
        }

    }



    public function searchUsrs() {
        $this->load->model('Usr', '', true);

        $idChurch = $this->input->post('idChurch');
        $resultado = $this->Usr->selectUsrs2($idChurch);

        echo json_encode ($resultado);
    }
    public function changeValuePlace() {
        $this->load->model('Lodging', '', true);
        $value = $this->input->post('place');
        $idUsr = $this->input->post('idUsr');
        $this->Lodging->changeValuePlace($value, $idUsr);
    }
    public function searchDisponibility() {////ver como modificar
        $this->load->model('Usr', '', true);

        $sex = $this->input->post('sex');
        $resultado = $this->Usr->searchDisponibility($sex);
        $aditional = $this->Usr->searchDisponibilityAditional();

        $i=0;
        $cn= count($resultado);
        foreach ($aditional as $ad){
            $resultado[$i+$cn]=$ad;
            $i++;
        }

        echo json_encode ($resultado);
    }
    public function searchDisponibility2() {
        $this->load->model('Usr', '', true);

        $sex = $this->input->post('sex2');
        $resultado = $this->Usr->searchDisponibility($sex);

        echo json_encode ($resultado);
    }

    public function alterLodgingWithHost(){
        $this->load->model('Lodging', '', true);

        $idUsr = $this->input->post('idUsr');
        $idHost = $this->input->post('idHost');
        $this->Lodging->searchDisponibility($idUsr, $idHost);

    }
}
