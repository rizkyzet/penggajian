<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Guru Dashboard';
        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        $this->load->view('penggajian/_partials/sidebar_guru');
        $this->load->view('penggajian/admin/dashboard/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }
}
