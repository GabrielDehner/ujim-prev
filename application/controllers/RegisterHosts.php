<?php

class RegisterHosts extends CI_Controller {

    public function index() {
        $this->load->library('session');
        $isLog = $this->session->has_userdata('idUser');
        if ($isLog == true) {
            $this->load->model('Host', '', true);
            $data['hosts'] = $this->Host->searchHostAndDisponibility();
            $data['controller'] = 'registerHosts';
            $this->load->view('public/headerAdmin.php', $data);
            $this->load->view('registerHosts/registerHosts.php', $data);
            $this->load->view('public/footer.php', $data);

            //$this->load->helper('url');
            //$this->load->view('registerHost/person_view.php');
        }else{
            redirect('login');
        }
        
    }


	public function ajax_list()
	{
		$list = $this->person->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->firstName;
			$row[] = $person->lastName;
			$row[] = $person->gender;
			$row[] = $person->address;
			$row[] = $person->dob;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all(),
						"recordsFiltered" => $this->person->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id){
        $this->load->model('Host', '', true);
        $data = $this->Host->selectData($id);
		echo json_encode($data);
	}

	public function ajax_add(){
        $this->load->model('Host', '', true);
        $this->load->model('Disponibility', '', true);

		$data = array(
				'name' => $this->input->post('name'),
				'surname' => $this->input->post('surname'),
				'telephone' => $this->input->post('telephone'),
			);
		$insert = $this->Host->save($data);

        $data = array(  'idHost' => $insert,
                        'sex' => 'F',
                        'year'=> date('Y'),
                        'quantity' => $this->input->post('cantMujeres'),
            );
        $this->Disponibility->insertDisponibility($data);

        $data = array(  'idHost' => $insert,
                        'sex' => 'M',
                        'year'=> date('Y'),
                        'quantity' => $this->input->post('cantHombres'),
            );
        $this->Disponibility->insertDisponibility($data);

        $data = array(  'idHost' => $insert,
                        'sex' => 'A',
                        'year'=> date('Y'),
                        'quantity' => $this->input->post('cantAmbos'),
            );
        $this->Disponibility->insertDisponibility($data);

        //se buscan los datos del pibe/piba recien registrado
        $result = $this->Host->selectData($insert);



		echo json_encode($result);
	}

	public function ajax_update(){
        $this->load->model('Host', '', true);
        $this->load->model('Disponibility', '', true);
        $insert = $this->input->post('idHost');
        $data = array(
            'idHost'=> $insert,
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'telephone' => $this->input->post('telephone'),
        );
        $this->Host->update($data);


        $data = array(  'idHost' => $insert,
            'sex' => 'F',
            'year'=> date('Y'),
            'quantity' => $this->input->post('cantMujeres'),
        );
        $this->Disponibility->quantityDisponibility($data);

        $data = array(  'idHost' => $insert,
            'sex' => 'M',
            'year'=> date('Y'),
            'quantity' => $this->input->post('cantHombres'),
        );
        $this->Disponibility->quantityDisponibility($data);

        $data = array(  'idHost' => $insert,
            'sex' => 'A',
            'year'=> date('Y'),
            'quantity' => $this->input->post('cantAmbos'),
        );
        $this->Disponibility->quantityDisponibility($data);

        //se buscan los datos del pibe/piba recien actualizado
        //$result = $this->Host->selectData($insert);
        $data = $this->reloadTable();



		echo json_encode($data);
	}
	public function reloadTable(){
        return ($this->Host->searchHostAndDisponibility());
    }

	public function ajax_delete($idHost){
        $this->load->model('Host', '', true);
        $this->load->model('Disponibility', '', true);



        $this->Disponibility->delete_by_id($idHost);
		$this->Host->delete_by_id($idHost);

        $data = $this->reloadTable();

		echo json_encode($data);
	}

}
