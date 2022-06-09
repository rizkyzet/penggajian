<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('Guru_model');
        if (!isAdmin()) {
            redirect('dashboard');
        }
    }


    public function index()
    {


        $data['title'] = 'Admin Dashboard';

        $data['guru'] = $this->Guru_model->getGuru();

        $this->load->view('penggajian/_partials/header');
        $this->load->view('penggajian/_partials/sidebar_admin');
        $this->load->view('penggajian/admin/guru/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Admin Dashboard';
        $data['jabatan'] = $this->db->get('jabatan')->result_array();

        $this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[guru.nip]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            $this->load->view('penggajian/_partials/sidebar_admin');
            $this->load->view('penggajian/admin/guru/tambah', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $dataInsert = [
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'id_jabatan' => $this->input->post('jabatan'),
                'jk' => $this->input->post('jk'),
                'no_hp' => $this->input->post('no_hp'),
            ];

            $this->db->insert('guru', $dataInsert);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data user berhasil ditambah!
          </div>');

            redirect('admin/guru');
        }
    }


    public function edit($nip)
    {
        $data['title'] = 'Admin Dashboard';
        $data['jabatan'] = $this->db->get('jabatan')->result_array();
        $data['guru'] = $this->db->get_where('guru', ['nip' => $nip])->row_array();

        if ($this->input->post('nip') == $nip) {
            $this->form_validation->set_rules('nip', 'NIP', 'required');
        } else {
            $this->form_validation->set_rules('nip', 'NIP', 'required|[guru.nip]');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            $this->load->view('penggajian/_partials/sidebar_admin');
            $this->load->view('penggajian/admin/guru/edit', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $dataUpdate = [
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'id_jabatan' => $this->input->post('jabatan'),
                'jk' => $this->input->post('jk'),
                'no_hp' => $this->input->post('no_hp'),
            ];

            $this->db->update('guru', $dataUpdate, ['nip' => $nip]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data user berhasil diubah!
          </div>');

            redirect('admin/guru');
        }
    }


    public function delete($nip)
    {
        $this->db->delete('guru', ['nip' => $nip]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">
        Data Guru berhasil dihapus.
      </div>');
        redirect('admin/guru');
    }
}
