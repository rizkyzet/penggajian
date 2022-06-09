<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('User_model');
        $this->load->model('Gaji_model');
        $this->load->model('Validation_model');
        $this->load->model('Guru_model');
    }
    public function index()
    {

        $data['title'] = 'Admin Dashboard';
        // $this->load->view('dist/_partials/header');

        $data = [
            'totalAdmin' => count($this->db->get_where('user', ['role_id' => 1])->result_array()),
            'totalBendahara' => count($this->db->get_where('user', ['role_id' => 3])->result_array()),
            'totalGuru' => count($this->db->get('guru')->result_array()),
            'totalKepsek' => count($this->db->get_where('user', ['role_id' => 4])->result_array())
        ];
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        
        $this->load->view('penggajian/_partials/header');

        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        }elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }

        $this->load->view('penggajian/admin/dashboard/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function getChart()
    {
        $tahunIni = date('Y');
        $tahunSebelum = date('Y') - 1;

        $dataChart = ['tahunIni' => [], 'tahunSebelum' => []];


        for ($i = 1; $i <= 12; $i++) {
            $dataGaji = $this->db->get_where('gaji', ['bulan' => $i, 'tahun' => $tahunIni])->row_array();

            if ($dataGaji) {
                $dataChart['tahunIni'][] = (int) $dataGaji['total_gaji'];
            } else {
                $dataChart['tahunIni'][] = 0;
            }
        }

        for ($i = 1; $i <= 12; $i++) {
            $dataGajiSebelum = $this->db->get_where('gaji', ['bulan' => $i, 'tahun' =>  $tahunSebelum])->row_array();

            if ($dataGajiSebelum) {
                $dataChart['tahunSebelum'][] = (int) $dataGajiSebelum['total_gaji'];
            } else {
                $dataChart['tahunSebelum'][] = 0;
            }
        }


        echo json_encode($dataChart);
    }
}
