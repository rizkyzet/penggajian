<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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

        $this->db->select('*');
        $this->db->where('username !=', $this->session->userdata('username'));
        $data['users'] = $this->db->get('user')->result_array();

        $this->load->view('penggajian/_partials/header');
        $this->load->view('penggajian/_partials/sidebar_admin');
        $this->load->view('penggajian/admin/users/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    public function tambah()
    {

        $data['title'] = 'Admin Dashboard';
        $data['allRole'] = $this->db->get('role')->result_array();

        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('password', 'Password baru', 'required', ['required' => 'Password harus diisi!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|matches[password]', ['required' => 'Password harus diisi!', 'matches' => 'Konfirmasi password tidak cocok!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            $this->load->view('penggajian/_partials/sidebar_admin');
            $this->load->view('penggajian/admin/users/tambah', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $dataUpdate = [
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'no_hp' => $this->input->post('no_hp'),
                'role_id' => $this->input->post('role_id'),
                'jk' => $this->input->post('jk'),
                'foto' => 'avatar-1.png'
            ];

            $this->db->insert('user', $dataUpdate);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data user berhasil ditambah!
          </div>');

            redirect('admin/users');
        }
    }

    public function edit($username)
    {
        $data['title'] = 'Admin Dashboard';
        $data['allRole'] = $this->db->get('role')->result_array();
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($this->input->post('username') == $username) {
            $this->form_validation->set_rules('username', 'Username', 'required');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');

        if ($this->input->post('password') != '') {
            $this->form_validation->set_rules('password', 'Password baru', 'required', ['required' => 'Password harus diisi!']);
            $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|matches[password]', ['required' => 'Password harus diisi!', 'matches' => 'Konfirmasi password tidak cocok!']);
        }

        if ($this->form_validation->run() == false) {

            $this->load->view('penggajian/_partials/header');
            $this->load->view('penggajian/_partials/sidebar_admin');
            $this->load->view('penggajian/admin/users/edit', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $dataUpdate = [
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('no_hp'),
                'role_id' => $this->input->post('role_id'),
                'jk' => $this->input->post('jk'),
                'foto' => 'avatar-1.png'
            ];

            if ($this->input->post('password') != '') {
                $dataUpdate['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $where = ['id' => $data['user']['id']];

            $this->db->update('user', $dataUpdate, $where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data user berhasil diupdate!
          </div>');

            redirect('admin/users');
        }
    }

    public function delete($id)
    {
        $this->db->delete('user', ['id' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">
        Data user berhasil dihapus.
      </div>');
        redirect('admin/users');
    }
}
