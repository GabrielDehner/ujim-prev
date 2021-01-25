<?php

class Home extends CI_Controller {

    public function index() {
        // Esta variable funciona para que en las plantillas de header y footer pueda
        // cargar el js o css correspondiente al controlador seleccionado.
        $data['controller'] = 'home';

        $this->load->view('public/header', $data);
        $this->load->view('home/index');
        $this->load->view('public/footer', $data);
    }
}
