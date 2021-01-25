<?php

class Devocionales extends CI_Controller
{

    public function index()
    {
        $this->load->model('Devocional', '', true);
        $data['devocional'] = $this->Devocional->getDevocionalesHastaHoy();
        $data['controller'] = 'devocionales';
        $this->load->view('public/header', $data);
        $this->load->view('devocionales/devocionalHome.php', $data);
        $this->load->view('public/footer', $data);
    }
    public function dia($fecha) {
        $this->load->model('Devocional', '', true);

        $data['fecha'] = $fecha;
        $data['dev'] = $this->Devocional->getDevocionalByDate($fecha);
        $data['count'] = $this->Devocional->getDevocionalesCount();
        $data['controller'] = 'devocionales';

        if ($data['dev'] != null) {
            $this->load->view('public/header', $data);
            $this->load->view('devocionales/devocionalDia.php', $data);
        }
    }
   
}
