<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
       
        $data['title'] = 'Admin Dashboard';
        // $this->load->view('dist/_partials/header');

        $data = [
            'totalAdmin'=> count($this->db->get_where('user',['role_id'=>1])->result_array()),
            'totalBendahara'=>count($this->db->get_where('user',['role_id'=>2])->result_array()),
            'totalGuru'=>count($this->db->get('guru')->result_array())
        ];

        $this->load->view('penggajian/_partials/header');
        $this->load->view('penggajian/_partials/sidebar_admin');
        $this->load->view('penggajian/admin/dashboard/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    
}
