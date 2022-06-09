<?php

use Mpdf\Mpdf;

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('User_model');
        $this->load->model('Gaji_model');
        $this->load->model('Validation_model');
        $this->load->model('Guru_model');
        $this->load->model('Absen_model');
    }

    public function cetak_slip($id)
    {
        $data['gajiHeader'] = $this->Gaji_model->getGajiHeader($id);

        $data['gajiDetail'] = $this->Gaji_model->getAllGajiDetail($id);
        $data['guru'] = $this->Guru_model->getOneGuruWhere(['guru.id' => $data['gajiHeader']['id_guru']]);
        $data['tipeCetak'] = 'satu';

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $view = $this->load->view('penggajian/laporan/slip-gaji', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function cetak_semua_gaji()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');


        if ($bulan != '' && $tahun == '') {
            $data['gajiHeader'] = $this->Gaji_model->getGajiHeaderWhere(['bulan' => $bulan]);
        } elseif ($tahun != '' && $bulan == '') {
            $data['gajiHeader'] = $this->Gaji_model->getGajiHeaderWhere(['tahun' => $tahun]);
        } elseif ($bulan == '' && $tahun == '') {
            $data['gajiHeader'] = $this->db->get('gaji')->result_array();
        } else {
            $data['gajiHeader'] = $this->Gaji_model->getGajiHeaderWhere(['bulan' => $bulan, 'tahun' => $tahun]);
        }


        // $data['gajiDetail'] = $this->Gaji_model->getAllGajiDetail($id);
        // $data['guru'] = $this->Guru_model->getOneGuruWhere(['guru.id' => $data['gajiHeader']['id_guru']]);
        $data['tipeCetak'] = 'banyak';

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $view = $this->load->view('penggajian/laporan/slip-gaji', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function users()
    {

        if(isBendahara()){
            redirect('dashboard');
        }
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['gajiGuru'] = $this->Gaji_model->getGajiJoinGuru();
        $data['role'] = $this->db->get('role')->result_array();

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        } elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }
        $this->load->view('penggajian/laporan/users', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function cetak_users()
    {
        $role_id = $this->input->post('role');
        $jk = $this->input->post('jk');

        if ($role_id != '' && $jk == '') {
            $data['users'] = $this->db->get_where('user', ['role_id' => $role_id])->result_array();
        } elseif ($jk != '' && $role_id == '') {
            $data['users'] = $this->db->get_where('user', ['jk' => $jk])->result_array();
        } elseif ($role_id == '' && $jk == '') {
            $data['users'] = $this->db->get('user')->result_array();
        } else {
            $data['users'] = $this->db->get_where('user', ['role_id' => $role_id, 'jk' => $jk])->result_array();
        }

        if (count($data['users']) == 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            Data Kosong
          </div>');
            redirect('laporan/users');
        }

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $view = $this->load->view('penggajian/laporan/cetak-users', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function guru()
    {
        if(isBendahara()){
            redirect('dashboard');
        }
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['gajiGuru'] = $this->Gaji_model->getGajiJoinGuru();
        $data['role'] = $this->db->get('role')->result_array();
        $data['jabatan'] = $this->db->get('jabatan')->result_array();

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        } elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }

        $this->load->view('penggajian/laporan/guru', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function cetak_guru()
    {
        $id_jabatan = $this->input->post('jabatan');
        $jk = $this->input->post('jk');

        if ($id_jabatan != '' && $jk == '') {
            $data['guru'] = $this->Guru_model->getGuruWhere(['guru.id_jabatan' => $id_jabatan]);
        } elseif ($jk != '' && $jk == '') {
            $data['guru'] = $this->Guru_model->getGuruWhere(['guru.jk' => $jk]);
        } elseif ($id_jabatan == '' && $jk == '') {
            $data['guru'] = $this->Guru_model->getGuru();
        } else {
            $data['guru'] = $this->Guru_model->getGuruWhere(['guru.id_jabatan' => $id_jabatan, 'guru.jk' => $jk]);
        }

        if (count($data['guru']) == 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            Data Kosong
          </div>');
            redirect('laporan/guru');
        }

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $view = $this->load->view('penggajian/laporan/cetak-guru', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function gaji()
    {

        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['jabatan'] = $this->db->get('jabatan')->result_array();

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        } elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }

        $this->load->view('penggajian/laporan/gaji', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function cetak_gaji()
    {
        $id_jabatan = $this->input->post('jabatan');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $where = [];

        if ($id_jabatan != '') {
            $where['guru.id_jabatan'] = $id_jabatan;
        }
        if ($bulan != '') {
            $where['gaji.bulan'] = (int) $bulan;
        }

        if ($tahun != '') {
            $where['gaji.tahun'] = (int) $tahun;
        }

        if (count($where) > 0) {
            $data['gaji'] = $this->Gaji_model->getGajiJoinGurujoinJabatanWhere($where);
        } else {
            $data['gaji'] = $this->Gaji_model->getGajiJoinGurujoinJabatan();
        }



        if (count($data['gaji']) == 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            Data Kosong
          </div>');
            redirect('laporan/gaji');
        }

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $view = $this->load->view('penggajian/laporan/cetak-gaji', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function absen()
    {

        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['jabatan'] = $this->db->get('jabatan')->result_array();

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        } elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }

        $this->load->view('penggajian/laporan/absen', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function cetak_absen()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $where = [];

        if ($bulan != '') {
            $where['absen.bulan'] = (int) $bulan;
        }

        if ($tahun != '') {
            $where['absen.tahun'] = (int) $tahun;
        }

        if (count($where) > 0) {
            $data['absen'] = $this->Absen_model->getAllAbsenJoinGuruWhere($where);
        } else {
            $data['absen'] = $this->Gaji_model->getAbsenJoinGuru();
        }

        if (count($data['absen']) == 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            Data Kosong
          </div>');
            redirect('laporan/absen');
        }

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);
        $view = $this->load->view('penggajian/laporan/cetak-absen', $data, TRUE);
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}
