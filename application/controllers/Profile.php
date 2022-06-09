<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('User_model');
        $this->load->model('Validation_model');
    }

    public function index()
    {

        $data['title'] = 'Profile';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        } elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }
        $this->load->view('penggajian/profile/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['allRole'] = $this->db->get('role')->result_array();


        // $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        // $this->form_validation->set_rules('role_id', 'Role', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            if ($data['roleName'] == 'admin') {
                $this->load->view('penggajian/_partials/sidebar_admin');
            } elseif ($data['roleName'] == 'kepsek') {
                $this->load->view('penggajian/_partials/sidebar_kepsek');
            } elseif ($data['roleName'] == 'bendahara') {
                $this->load->view('penggajian/_partials/sidebar_bendahara');
            }
            $this->load->view('penggajian/profile/edit_profile', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            $jk = $this->input->post('jk');
            $upload = $_FILES['image']['name'];

            $dataUpdate = [
                'nama' => $nama,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
                'jk' => $jk
            ];

            if ($upload) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '20048';
                $config['upload_path'] = './assets/upload/profile_picture';
                $config['file_name'] = rand();
                $this->load->library('upload', $config);


                if ($this->upload->do_upload('image')) {
                    if ($data['user']['photo'] != 'avatar-1.png') {
                        unlink(FCPATH . 'assets/upload/profile_picture/' . $data['user']['foto']);
                    }
                    $new_image = ['foto' => $this->upload->data('file_name')];
                    $dataUpdate = array_merge($dataUpdate, $new_image);
                } else {
                    $this->session->set_flashdata('pesan_upload', '<div class="alert alert-danger" role="alert"><h4 class="alert-heading">Upload failed!</h4><p>' . $this->upload->display_errors() . '</p></div>');
                }
            }

            $this->db->update('user', $dataUpdate, ['id' => $data['user']['id']]);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
         Profile Berhasil diubah.
        </div>');
            redirect('profile');
        }
    }

    public function change_password()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] =  $this->User_model->getUserByLogin();
        $data['roleName'] = getRoleName($data['user']['role_id']);



        $this->form_validation->set_rules('my_password', 'Password saat ini', [['my_password_check', [$this->Validation_model, 'my_password_check']]]);
        $this->form_validation->set_rules('password', 'Password baru', 'required', ['required' => 'Password harus diisi!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi password', 'required|matches[password]', ['required' => 'Password harus diisi!', 'matches' => 'Konfirmasi password tidak cocok!']);



        if ($this->form_validation->run() == false) {
            $this->load->view('penggajian/_partials/header');
            if ($data['roleName'] == 'admin') {
                $this->load->view('penggajian/_partials/sidebar_admin');
            } elseif ($data['roleName'] == 'guru') {
                $this->load->view('penggajian/_partials/sidebar_guru');
            }
            $this->load->view('penggajian/profile/change_password', $data);
            $this->load->view('penggajian/_partials/footer');
        } else {

            $my_password = $this->input->post('my_password');
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $set = ['password' => $hash];
            $where = ['username' => $this->session->userdata('username')];

            $this->db->update('user', $set, $where);


            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
         Password Berhasil diubah, silahkan login ulang.
        </div>');
            redirect('profile');
        }
    }
}
