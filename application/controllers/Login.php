<?php

class Login extends CI_Controller {

    public function index() {
        /*$this->load->model('Usr', '', true);
        $data['usrs'] = $this->Usr->searchUsrsEditDelete();*/
        
        $this->load->library('session');
        $isLog = $this->session->has_userdata('idUser');
        if ($isLog == true) {
            //redirect('homeAdmin');
            redirect('updateUsers');
        }else{
            $data['controller'] = 'login';
        $this->load->view('public/header.php', $data);
        $this->load->view('login/login.php', $data);
        $this->load->view('public/footer.php', $data);
        }

    }

    public function verifyUser() {     
        //echo 'llegoooosasdasd';
        $username = $this->input->post('username');
        $contrasenia = $this->input->post('contrasenia');
        $this->load->model('ManagementUsers', '', TRUE); 
        $idUser = $this->ManagementUsers->verifyUser($username, $contrasenia);
        if ($idUser != '') {
            $this->iniciarSesion($idUser);
        }else{
            //redirect('ujim/login');
            redirect('login');
        }
        
    }

    private function iniciarSesion($idUser) {
        $this->load->library('session'); //uso de sesion de codeIgniter, manejo de sesion en el servidor
        $this->session->set_userdata('idUser', $idUser);
        $this->load->helper('url');
        //redirect('homeAdmin');
        redirect('updateUsers');
    }

    public function log_out() {
        $this->load->library('session');
        $this->session->unset_userdata('idUser');
        redirect('login');
    }


	public function ajax_edit($id){
        $this->load->model('Usr', '', true);
        $data = $this->Usr->selectData($id);
		echo json_encode($data);
	}

}