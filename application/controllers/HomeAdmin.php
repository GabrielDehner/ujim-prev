<?php

class HomeAdmin extends CI_Controller {

    public function index() {
        /*$this->load->model('Usr', '', true);
        $data['usrs'] = $this->Usr->searchUsrsEditDelete();*/
        $data['controller'] = 'homeAdmin';
        $this->load->library('session');
        $isLog = $this->session->has_userdata('idUser');
        if ($isLog == true) {
            $this->load->view('public/headerAdmin.php', $data);
            $this->load->view('homeAdmin/homeAdmin.php', $data);
            $this->load->view('public/footer.php', $data);
        }else{
            redirect('login');
        }

    }





	public function ajax_edit($id){
        $this->load->model('Usr', '', true);
        $data = $this->Usr->selectData($id);
		echo json_encode($data);
	}

}