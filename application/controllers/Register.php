<?php

class Register extends CI_Controller {
    /*
     * Muesta la vista del formulario
     */

    public function index() {

        $this->load->model('Church', '', true);
        $this->load->model('Ministry', '', true);

        // Esta variable funciona para que en las plantillas de header y footer pueda
        // cargar el js o css correspondiente al controlador seleccionado.
        $data['controller'] = 'register';

        $data['churches'] = $this->Church->selectChurches();
        $data['ministries'] = $this->Ministry->selectMinistries();

        $this->load->view('public/header', $data);
        $this->load->view('register/form.php', $data);
        $this->load->view('public/footer', $data);
    }

    /*
     * Comprueba que el email esté disponible.
     */

    public function emailDisponible() {
        $this->load->model('Usr', '', true);
        $email = $this->input->post('email');

        // Validación de expresión regular de email en caso de que salteen la validación de HTML.
        if (!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)) {

            // devuelvo un json con OK para saber si hay error o no. ERROR con el mensaje del error.
            echo json_encode(array('ok' => false, 'error' => 'Email inválido.'));
            return;
        }

        if ($this->Usr->verifyEmail($email)) {
            echo json_encode(array('ok' => true, 'message' => 'Con este email te vamos a comunicar el acceso a las reuniones.'));
        } else {
            echo json_encode(array('ok' => false, 'error' => 'Email ya registrado. Prueba con otro.'));
        }
    }

    public function saveData() {
        //$this->load->library('session');
        $this->load->model('Usr', '', true);
        $this->load->model('MinistryUsr', '', true);
        $this->load->model('AssistanceUsr', '', true);
        $this->load->model('Lodging', '', true);
        $this->load->model('Church', '', true);
        $this->load->model('City', '', true);

        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $sex = $this->input->post('sex');
        $birthday = $this->input->post('birthday');
        $telephone = $this->input->post('telephone');
        $email = $this->input->post('email');
        $disease = $this->input->post('disease');
        $province = $this->input->post('province');
        $city = $this->input->post('city');
        if ($city == null) {
            $city = $this->City->selectIdCityByIdProvince($province);
        }
        $church = $this->input->post('church');
        $ministries = $this->input->post('ministry');
        $ministryOtros = $this->input->post('ministryOtros');
        $assistance = $this->input->post('assistance');
        $lodging = $this->input->post('lodging');
        $churchOtrosCheck = $this->input->post('churchOtrosCheck');

        // Si esta checkeado carga una nueva iglesia sino no
        if ($churchOtrosCheck=='true') {
            $provinceChurch = $this->input->post('provinceChurch');
            $cityChurch = $this->input->post('cityChurch');
            if ($cityChurch == null) {
                $cityChurch = $this->City->selectIdCityByIdProvince($provinceChurch);
            }
            $church = $this->Church->insertChurch($church, $cityChurch, 'F');
        }

        if ($this->Usr->verifyEmail($email)) {//Una vez se me bugeo (no logre hacerlo de nuevo) la pag y me creaba un monton de usuario con el mismo id
            $idUsr = $this->Usr->insertUsr($name, $surname, $sex, $birthday, $telephone, $email, $disease, $city, $church);

            // En el caso de que produzca un error, no insertar nada mas.
            if ($idUsr) {
                // $this->Lodging->insertLodging($idUsr, date('Y'), $lodging);

                if ($assistance) {
                    foreach ($assistance as $year) {
                        $this->AssistanceUsr->insertAssistanceUsr($idUsr, $year);
                    }
                }
                $this->AssistanceUsr->insertAssistanceUsr($idUsr, date("Y"));

                if ($ministries) {
                    foreach ($ministries as $ministry) {
                        $this->MinistryUsr->insertMinistryUsr($idUsr, $ministry, null);
                    }
                }

                if ($ministryOtros) {
                    $this->MinistryUsr->insertMinistryUsr($idUsr, "0", $ministryOtros);
                }
            } else {
                // Establezco que el codigo de respuesta sea 500 (Error en el servidor)
                // asi en el ajax entra en la parte de error.
                $this->output->set_status_header(500);
            }
        } else {
            // Establezco que el codigo de respuesta sea 401 (No autorizado)
            // asi en el ajax entra en la parte de error.
            $this->output->set_status_header(401);
        }
    }

    public function loadCountries() {
        $this->load->model('Country', '', true);

        echo json_encode($this->Country->selectDescriptionsCountry());
    }

    public function loadProvinces() {
        $this->load->model('Province', '', true);

        $idCountry = $this->input->post('idCountry');

        echo json_encode($this->Province->selectProvincesByCountry($idCountry));
    }

    public function loadCitiesByProvince() {
        $this->load->model('Province', '', true);
        $this->load->model('City', '', true);

        $valueFilter = $this->input->post('term');
        $idProvince = $this->input->post('idProvince');

        echo json_encode($this->City->selectCitiesByProvince($valueFilter, $idProvince));
    }

}
