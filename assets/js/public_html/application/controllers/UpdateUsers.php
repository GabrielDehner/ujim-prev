<?php

class UpdateUsers extends CI_Controller {

    public function index() {
        $this->load->model('Usr', '', true);
        $data['usrs'] = $this->Usr->searchUsrsEditDelete();
        $data['controller'] = 'updateUsers';
        $this->load->view('public/header.php', $data);
        $this->load->view('updateUsers/updateUsers.php', $data);
        $this->load->view('public/footer.php', $data);

    }




	public function ajax_edit($id){
        $this->load->model('Usr', '', true);
        $data = $this->Usr->selectData($id);
		echo json_encode($data);
	}

	public function ajax_update(){
        $this->load->model('Usr', '', true);

        $insert = $this->input->post('idUsr');
        $data = array(
            'idUsr'=> $insert,
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'telephone' => $this->input->post('telephone'),
            'sex' => $this->input->post('sex'),
            'birthday' => $this->input->post('birthday'),
            'email' => $this->input->post('email'),
        );
        $this->Usr->update($data);


        //se buscan los datos del pibe/piba recien actualizado

        $data = $this->reloadTable();



		echo json_encode($data);
	}
	public function reloadTable(){
        return ($this->Usr->searchUsrsEditDelete());
    }

	public function ajax_delete($idUsr){
        $this->load->model('Usr', '', true);
        $this->Usr->delete_by_id($idUsr);

        $data = $this->reloadTable();

		echo json_encode($data);
	}

}
