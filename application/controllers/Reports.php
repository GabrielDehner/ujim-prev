<?php

class Reports extends CI_Controller {

    public function index() {
        $this->load->library('session');
        $isLog = $this->session->has_userdata('idUser');
        if ($isLog == true) {
            $this->load->model('Usr', '', true);
            $data['controller'] = 'reports';

            $data['citys'] = $this->Usr->selectCitysOfUsers();


            $this->load->view('public/headerAdmin.php', $data);
            $this->load->view('reports/reports.php', $data);
            $this->load->view('public/footer.php', $data);
        }else{
            redirect('login');
        }
        
    }
    public function reportForCity(){
        $this->load->model('Usr', '', true);
        $idCity = $this->input->post('idCity');

        $result = $this->Usr->reportForCity($idCity);
        echo json_encode($result);
    }
    public function reportForCityCount(){
        $this->load->model('Usr', '', true);
        $idCity = $this->input->post('idCity');

        $result = $this->Usr->reportForCityCount($idCity);
        echo json_encode($result);
    }
    public function reportForLodging(){
        $this->load->model('Usr', '', true);

        $result = $this->Usr->reportForLodging();
        echo json_encode($result);
    }
    public function reportForHost(){
        $this->load->model('Usr', '', true);

        $result = $this->Usr->reportForHost();
        echo json_encode($result);
    }

}
