<?php

class Competition extends CI_Controller {

    public function index() {
        // Esta variable funciona para que en las plantillas de header y footer pueda
        // cargar el js o css correspondiente al controlador seleccionado.
        $data['controller'] = 'competition';

        $this->load->view('public/header', $data);
        $this->load->view('competition/competition');
        $this->load->view('public/footer', $data);
    }
}
