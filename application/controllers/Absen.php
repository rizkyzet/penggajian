<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        if(isKepsek()){
            redirect('dashboard');
        }
        $this->load->model('User_model');
        $this->load->model('Gaji_model');
        $this->load->model('Validation_model');
        $this->load->model('Guru_model');
        $this->load->model('Absen_model');
    }

    public function index()
    {
        $data['title'] = 'Absen';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['absen'] = $this->Absen_model->getAbsenJoinGuru();

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        } elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }
        $this->load->view('penggajian/absen/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    public function buat()
    {

        $data['title'] = 'Absen';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['guru'] = $this->Guru_model->getGuru();

        $this->form_validation->set_rules('id_guru', 'Guru', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', ['required', ['cek', function ($str) {
            $id_guru = $this->input->post('id_guru');
            $explodeData = explode('-', $str);
            $tahun = (int)$explodeData[0];
            $bulan = (int)$explodeData[1];

            $cek = $this->db->get_where('absen', ['tahun' => $tahun, 'bulan' => $bulan, 'id_guru' => $id_guru])->row_array();
            if ($id_guru) {

                if ($cek) {
                    $this->form_validation->set_message('cek', 'Absen sudah dibuat!');
                    return false;
                    die;
                } else {
                    return true;
                }
            } else {
                $this->form_validation->set_message('cek', 'Kolom Guru harus diisi dahulu!');
                return false;
            }
        }]]);

        $this->form_validation->set_rules('hadir', 'Hadir', 'required');
        $this->form_validation->set_rules('sakit', 'Sakit', 'required');
        $this->form_validation->set_rules('izin', 'Izin', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            if ($data['roleName'] == 'admin') {
                $this->load->view('penggajian/_partials/sidebar_admin');
            } elseif ($data['roleName'] == 'kepsek') {
                $this->load->view('penggajian/_partials/sidebar_kepsek');
            } elseif ($data['roleName'] == 'bendahara') {
                $this->load->view('penggajian/_partials/sidebar_bendahara');
            }
            $this->load->view('penggajian/absen/buat', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {
            $id_guru = $this->input->post('id_guru');
            $explodeData = explode('-', $this->input->post('bulan'));
            $tahun = (int)$explodeData[0];
            $bulan = (int)$explodeData[1];
            $hadir = $this->input->post('hadir');
            $sakit = $this->input->post('sakit');
            $izin = $this->input->post('izin');


            $dataInsert = [
                'id_guru' => $id_guru,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'hadir' => $hadir,
                'sakit' => $sakit,
                'izin' => $izin,
            ];

            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Absen Berhasil dibuat.
           </div>');
            $this->db->insert('absen', $dataInsert);
            redirect('absen');
        }
    }

    public function edit($id_absen)
    {

        $data['title'] = 'Absen';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['guru'] = $this->Guru_model->getGuru();
        $data['absen'] = $this->Absen_model->getAbsenJoinGuruWhere(['absen.id' => $id_absen]);

        $this->form_validation->set_rules('id_guru', 'Guru', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', ['required', ['cek', function ($str) use ($id_absen) {
            $id_guru = $this->input->post('id_guru');
            $explodeData = explode('-', $str);
            $tahun = (int)$explodeData[0];
            $bulan = (int)$explodeData[1];

            $dataAbsen =  $this->Absen_model->getAbsenJoinGuruWhere(['absen.id' => $id_absen]);

            $cek = $this->Absen_model->getAbsenJoinGuruWhere(['absen.bulan' => $bulan, 'absen.tahun' => $tahun, 'id_guru' => $id_guru]);
            if ($cek) {
                if ($cek['idnya_absen'] == $dataAbsen['idnya_absen'] && $cek['bulan'] == $bulan && $cek['tahun'] == $tahun && $cek['id'] == $dataAbsen['id']) {
                    return true;
                } else {
                    if ($cek) {
                        $this->form_validation->set_message('cek', 'Absen sudah dibuat!');
                        return false;
                    } else {
                        return true;
                    }
                }
            } else {
                return true;
            }
        }]]);

        $this->form_validation->set_rules('hadir', 'Hadir', 'required');
        $this->form_validation->set_rules('sakit', 'Sakit', 'required');
        $this->form_validation->set_rules('izin', 'Izin', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            if ($data['roleName'] == 'admin') {
                $this->load->view('penggajian/_partials/sidebar_admin');
            } elseif ($data['roleName'] == 'kepsek') {
                $this->load->view('penggajian/_partials/sidebar_kepsek');
            } elseif ($data['roleName'] == 'bendahara') {
                $this->load->view('penggajian/_partials/sidebar_bendahara');
            }
            $this->load->view('penggajian/absen/edit', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {
      

            $id_guru = $this->input->post('id_guru');
            $explodeData = explode('-', $this->input->post('bulan'));
            $tahun = (int)$explodeData[0];
            $bulan = (int)$explodeData[1];
            $hadir = $this->input->post('hadir');
            $sakit = $this->input->post('sakit');
            $izin = $this->input->post('izin');


            $dataUpdate = [
                'id_guru' => $id_guru,
                'tahun' => $tahun,
                'bulan' => $bulan,
                'hadir' => $hadir,
                'sakit' => $sakit,
                'izin' => $izin,
            ];

            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Absen Berhasil diubah.
           </div>');
            $this->db->update('absen', $dataUpdate,['id'=>$id_absen]);
            redirect('absen');
        }
    }

    public function delete($id_absen)
    {
        $this->db->delete('absen', ['id' => $id_absen]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">
        Data Absen berhasil dihapus.
      </div>');
        redirect('absen');
    }

}
