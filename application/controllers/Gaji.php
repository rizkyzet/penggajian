<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gaji extends CI_Controller
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
    }

    public function index()
    {
        $data['title'] = 'Profile';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['gajiGuru'] = $this->Gaji_model->getGajiJoinGuru();

        // $this->load->view('dist/_partials/header');
        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        }elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }

        $this->load->view('penggajian/gaji/index', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    public function get_gaji()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        // if ($bulan = '' && $tahun == '') {
        //     var_dump('eu');
        //     $data['gaji'] = $this->Gaji_model->getGajiJoinGuru();
        // } elseif ($bulan == '') {
        //     $data['gaji'] = $this->Gaji_model->getGajiJoinGuruWhere(['tahun' => $tahun]);
        // } elseif ($tahun == '') {
        //     $data['gaji'] = $this->Gaji_model->getGajiJoinGuruWhere(['bulan' => $bulan]);
        // } else {
        //     $data['gaji'] = $this->Gaji_model->getGajiJoinGuruWhere(['bulan' => $bulan, 'tahun' => $tahun]);
        // }


        if ($bulan != '' && $tahun == '') {
            $data['gaji'] = $this->Gaji_model->getGajiJoinGuruWhere(['bulan' => $bulan]);
        } elseif ($tahun != '' && $bulan == '') {
            $data['gaji'] = $this->Gaji_model->getGajiJoinGuruWhere(['tahun' => $tahun]);
        } elseif ($bulan == '' && $tahun == '') {
            $data['gaji'] = $this->Gaji_model->getGajiJoinGuru();
        } else {
            $data['gaji'] = $this->Gaji_model->getGajiJoinGuruWhere(['bulan' => $bulan, 'tahun' => $tahun]);
        }


        $this->load->view('penggajian/gaji/ajax-getuser', $data);
    }



    public function buat()
    {
        $data['title'] = 'Profile';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['guru'] = $this->Guru_model->getGuru();

        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        }elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }
        $this->load->view('penggajian/gaji/buat', $data);
        $this->load->view('penggajian/_partials/footer');
    }


    public function get_gaji_pokok()
    {
        $idGuru = $this->input->post('id_guru');

        $guru = $this->Guru_model->getOneGuruWhere(['guru.id' => $idGuru]);

        echo json_encode($guru);
    }


    public function validation_form_gaji()
    {
        $id_guru = $this->input->post('id_guru');
        $explodeDate = explode('-', $this->input->post('bulan'));
        $tahun = (int)$explodeDate[0];
        $bulan = (int)$explodeDate[1];
        $gaji_pokok = convertMoneyToInteger($this->input->post('gaji_pokok'));
        $deskripsi_jam_tambahan = $this->input->post('deskripsi_jam_tambahan');
        $nominal_jam_tambahan = convertMoneyToInteger($this->input->post('nominal_jam_tambahan'));
        $jam = $this->input->post('jam');
        $deskripsiGajiLain = $this->input->post('deskripsi');
        $nominalGajiLain = $this->input->post('nominal');


        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('id_guru', 'Guru', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', ['required', ['cek', function ($str) use ($id_guru) {
            $explodeData = explode('-', $str);
            $tahun = (int)$explodeData[0];
            $bulan = (int)$explodeData[1];

            $cek = $this->db->get_where('gaji', ['tahun' => $tahun, 'bulan' => $bulan, 'id_guru' => $id_guru])->row_array();

            if ($cek) {
                $this->form_validation->set_message('cek', 'Gaji sudah dibuat!');
                return false;
                die;
            } else {
                return true;
            }
        }]]);
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
        $this->form_validation->set_rules('deskripsi_jam_tambahan', 'Deskripsi jam tambahan', 'required');
        $this->form_validation->set_rules('nominal_jam_tambahan', 'Nominal jam tambahan', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->input->post('deskripsi')) {
            $this->form_validation->set_rules('deskripsi[]', 'Deskripsi', 'required');
        }
        if ($this->input->post('nominal')) {
            $this->form_validation->set_rules('nominal[]', 'Nominal', 'required');
        }

        if ($this->form_validation->run() == false) {

            $response = [
                'type' => 'error',
                'error' => $this->form_validation->error_array()
            ];

            echo json_encode($response);
        } else {





            $this->db->trans_start();
            $total_gaji = $gaji_pokok + $nominal_jam_tambahan;

            if ($nominalGajiLain) {
                foreach ($nominalGajiLain as $nGajiLain) {
                    $total_gaji += convertMoneyToInteger($nGajiLain);
                }
            }


            $dataHeader = [
                'id_guru' => $id_guru,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total_gaji' => $total_gaji
            ];

            $this->db->insert('gaji', $dataHeader);

            $insert_id = $this->db->insert_id();

            $dataDetail = [
                [
                    'id_gaji' => $insert_id,
                    'deskripsi' => 'Gaji Pokok',
                    'nominal' => convertMoneyToInteger($gaji_pokok)
                ],
                [
                    'id_gaji' => $insert_id,
                    'deskripsi' => $deskripsi_jam_tambahan . '-' . $jam,
                    'nominal' => convertMoneyToInteger($nominal_jam_tambahan)

                ]
            ];

            if ($deskripsiGajiLain) {
                foreach ($deskripsiGajiLain as $index => $dGajiLain) {
                    $dataDetail[] = [
                        'id_gaji' => $insert_id,
                        'deskripsi' => $dGajiLain,
                        'nominal' => convertMoneyToInteger($nominalGajiLain[$index])
                    ];
                }
            }


            $this->db->insert_batch('detail_gaji', $dataDetail);
            $this->db->trans_complete();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data jabatan berhasil ditambah.
          </div>');
            echo json_encode(['type' => 'success']);
        }
    }


    public function edit($id)
    {
        $data['title'] = 'Profile';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['guru'] = $this->Guru_model->getGuru();
        $data['gajiHeader'] = $this->Gaji_model->getGajiHeader($id);
        $data['gajiDetail'] = $this->Gaji_model->getAllGajiDetail($id);


        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        }elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }
        $this->load->view('penggajian/gaji/edit', $data);
        $this->load->view('penggajian/_partials/footer');
    }

    public function validation_form_gaji_update()
    {
        $id_guru = $this->input->post('id_guru');
        $explodeDate = explode('-', $this->input->post('bulan'));
        $tahun = (int)$explodeDate[0];
        $bulan = (int)$explodeDate[1];
        $gaji_pokok = convertMoneyToInteger($this->input->post('gaji_pokok'));
        $deskripsi_jam_tambahan = $this->input->post('deskripsi_jam_tambahan');
        $nominal_jam_tambahan = convertMoneyToInteger($this->input->post('nominal_jam_tambahan'));
        $jam = $this->input->post('jam');
        $deskripsiGajiLain = $this->input->post('deskripsi');
        $nominalGajiLain = $this->input->post('nominal');
        $id_gaji = $this->input->post('id_gaji');

        $dataGaji = $this->db->get_where('gaji', ['id' => $id_gaji, 'id_guru' => $id_guru])->row_array();


        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('id_guru', 'Guru', 'required');
        $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
        $this->form_validation->set_rules('deskripsi_jam_tambahan', 'Deskripsi jam tambahan', 'required');
        $this->form_validation->set_rules('nominal_jam_tambahan', 'Nominal jam tambahan', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($dataGaji) {
            $tahunBulanDatabase = getTahunDanBulan($dataGaji['tahun'], $dataGaji['bulan']);
            $tahunBulanInput = getTahunDanBulan($tahun, $bulan);
            if ($tahunBulanDatabase != $tahunBulanInput) {
                $this->form_validation->set_rules('bulan', 'Bulan', ['required', ['cek', function ($str) use ($id_guru) {
                    $explodeData = explode('-', $str);
                    $tahun = (int)$explodeData[0];
                    $bulan = (int)$explodeData[1];

                    $cek = $this->db->get_where('gaji', ['tahun' => $tahun, 'bulan' => $bulan, 'id_guru' => $id_guru])->row_array();

                    if ($cek) {
                        $this->form_validation->set_message('cek', 'Gaji sudah dibuat!');
                        return false;
                        die;
                    } else {
                        return true;
                    }
                }]]);
            }
        } else {
            $this->form_validation->set_rules('bulan', 'Bulan', ['required', ['cek', function ($str) use ($id_guru) {
                $explodeData = explode('-', $str);
                $tahun = (int)$explodeData[0];
                $bulan = (int)$explodeData[1];

                $cek = $this->db->get_where('gaji', ['tahun' => $tahun, 'bulan' => $bulan, 'id_guru' => $id_guru])->row_array();

                if ($cek) {
                    $this->form_validation->set_message('cek', 'Gaji sudah dibuat!');
                    return false;
                    die;
                } else {
                    return true;
                }
            }]]);
        }



        if ($this->input->post('deskripsi')) {
            $this->form_validation->set_rules('deskripsi[]', 'Deskripsi', 'required');
        }
        if ($this->input->post('nominal')) {
            $this->form_validation->set_rules('nominal[]', 'Nominal', 'required');
        }

        if ($this->form_validation->run() == false) {

            $response = [
                'type' => 'error',
                'error' => $this->form_validation->error_array()
            ];

            echo json_encode($response);
        } else {


            $this->db->trans_start();
            $total_gaji = $gaji_pokok + $nominal_jam_tambahan;

            if ($nominalGajiLain) {
                foreach ($nominalGajiLain as $nGajiLain) {
                    $total_gaji += convertMoneyToInteger($nGajiLain);
                }
            }


            $dataHeader = [
                'id_guru' => $id_guru,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total_gaji' => $total_gaji
            ];

            $this->db->update('gaji', $dataHeader, ['id' => $id_gaji]);


            $dataDetail = [
                [
                    'id_gaji' => $id_gaji,
                    'deskripsi' => 'Gaji Pokok',
                    'nominal' => convertMoneyToInteger($gaji_pokok)
                ],
                [
                    'id_gaji' => $id_gaji,
                    'deskripsi' => $deskripsi_jam_tambahan . '-' . $jam,
                    'nominal' => convertMoneyToInteger($nominal_jam_tambahan)

                ]
            ];

            if ($deskripsiGajiLain) {
                foreach ($deskripsiGajiLain as $index => $dGajiLain) {
                    $dataDetail[] = [
                        'id_gaji' => $id_gaji,
                        'deskripsi' => $dGajiLain,
                        'nominal' => convertMoneyToInteger($nominalGajiLain[$index])
                    ];
                }
            }

            $this->db->delete('detail_gaji', ['id_gaji' => $id_gaji]);
            $this->db->insert_batch('detail_gaji', $dataDetail);
            $this->db->trans_complete();

            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            Data Gaji berhasil diubah.
          </div>');
            echo json_encode(['type' => 'success']);
        }
    }

    public function delete($id_gaji)
    {
        $this->db->delete('gaji', ['id' => $id_gaji]);
        $this->db->delete('detail_gaji', ['id_gaji' => $id_gaji]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">
        Data Gaji berhasil dihapus.
      </div>');
        redirect('gaji');
    }

    public function detail($id_gaji)
    {
        $data['title'] = 'Profile';
        $data['user'] =  $this->User_model->getUserByUsername($this->session->userdata('username'));
        $data['roleName'] = getRoleName($data['user']['role_id']);
        $data['gajiHeader'] = $this->Gaji_model->getGajiHeader($id_gaji);
        $data['gajiDetail'] = $this->Gaji_model->getAllGajiDetail($id_gaji);
        $data['guru'] = $this->Guru_model->getOneGuruWhere(['guru.id' => $data['gajiHeader']['id_guru']]);


        $this->load->view('penggajian/_partials/header');
        if ($data['roleName'] == 'admin') {
            $this->load->view('penggajian/_partials/sidebar_admin');
        } elseif ($data['roleName'] == 'kepsek') {
            $this->load->view('penggajian/_partials/sidebar_kepsek');
        }elseif ($data['roleName'] == 'bendahara') {
            $this->load->view('penggajian/_partials/sidebar_bendahara');
        }
        $this->load->view('penggajian/gaji/detail', $data);
        $this->load->view('penggajian/_partials/footer');
    }
}
