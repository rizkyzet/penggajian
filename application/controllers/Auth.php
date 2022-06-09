<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Login';
        $this->form_validation->set_rules('id', 'ID', 'required', ['required' => 'id harus diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password harus diisi!']);
        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/auth/login', $data);
        } else {
            $id = $this->input->post('id');
            $password = $this->input->post('password');
            $user = $this->db->get_where('user', ['username' => $id]);

            if (count($user->result_array()) > 0) {
                $userData = $user->row_array();
                if (password_verify($password, $userData['password'])) {
                    $userRole = $this->db->get_where('role', ['id' => $userData['role_id']])->row_array();
                    if ($userRole['nama_role'] == 'admin') {
                        $data_session = [
                            'username' => $userData['username'],
                            'role_id' => $userRole['id']
                        ];

                        $this->session->set_userdata($data_session);
                        redirect('admin/dashboard');
                    } elseif ($userRole['nama_role'] == 'bendahara') {
                        $data_session = [
                            'username' => $userData['username'],
                            'role_id' => $userRole['id']
                        ];

                        $this->session->set_userdata($data_session);
                        redirect('dashboard');
                    } elseif ($userRole['nama_role'] == 'kepsek') {
                        $data_session = [
                            'username' => $userData['username'],
                            'role_id' => $userRole['id']
                        ];

                        $this->session->set_userdata($data_session);
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                    Password salah.
                  </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                Account tidak ditemukan.
              </div>');
                redirect('auth');
            }
        }
    }

    // public function ajaks()
    // {
    //     $kabupaten = $this->input->post('kabupaten')['kota_kabupaten'];

    //    $this->db->insert
    // }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
