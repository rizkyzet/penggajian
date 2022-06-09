<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        if (!isAdmin()) {
            redirect('dashboard');
        }
    }

    public function index()
    {

        $data['title'] = 'Admin Dashboard';
        $data['jabatan'] = $this->db->get('jabatan')->result_array();
        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        $this->load->view('penggajian/_partials/sidebar_admin');
        $this->load->view('penggajian/admin/jabatan/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    public function tambah()
    {

        $data['title'] = 'Admin Dashboard';


        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');



        if ($this->form_validation->run() == false) {
        
            $this->load->view('penggajian/_partials/header');
            $this->load->view('penggajian/_partials/sidebar_admin');
            $this->load->view('penggajian/admin/jabatan/tambah', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $dataJabatan = [
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'gaji_pokok' => str_replace(',', '', $this->input->post('gaji_pokok')),
            ];

            $this->db->insert('jabatan', $dataJabatan);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data jabatan berhasil ditambah.
          </div>');
            redirect('admin/jabatan');
        }
    }

    public function edit($id)
    {

        $data['title'] = 'Admin Dashboard';
        $data['jabatan'] = $this->db->get_where('jabatan', ['id' => $id])->row_array();

        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            $this->load->view('penggajian/_partials/sidebar_admin');
            $this->load->view('penggajian/admin/jabatan/edit', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $dataJabatan = [
                'nama_jabatan' => $this->input->post('nama_jabatan'),
                'gaji_pokok' => str_replace(',', '', $this->input->post('gaji_pokok')),
            ];

            $this->db->update('jabatan', $dataJabatan, ['id' => $data['jabatan']['id']]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data jabatan berhasil diubah.
          </div>');
            redirect('admin/jabatan');
        }
    }


    public function delete($id)
    {
        $this->db->delete('jabatan', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">
        Data jabatan berhasil dihapus.
      </div>');
        redirect('admin/jabatan');
    }
}
