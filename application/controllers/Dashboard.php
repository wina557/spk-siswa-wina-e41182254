<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller {

    public function index()
    {
        $data['judul'] = 'beranda';
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }



}