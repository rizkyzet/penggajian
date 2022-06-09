<?php


function tes()
{

    return 'tes';
};


function getRoleName($id)
{
    $ci = get_instance();
    $roleData = $ci->db->get_where('role', ['id' => $id])->row_array();

    return $roleData['nama_role'];
};


function checkLogin()
{
    $ci = get_instance();
    $checkLogin = $ci->session->userdata('username');

    if (!$checkLogin) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger">
        Session habis, silahkan login kembali.
      </div>');
        redirect('auth');
    }
}

function jenisKelamin($jk)
{
    return $jk == 'L' ? 'Laki-laki' : 'Perempuan';
}

function formatRupiah($angka)
{

    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function getUserLogin($column = null)
{
    $ci = get_instance();

    if ($column) {
        $user = $ci->db->get_where('user', ['username' => $ci->session->userdata('username')])->row_array();
        return $user[$column];
    } else {
        return $ci->db->get_where('user', ['username' => $ci->session->userdata('username')])->row_array();
    }
}


function urlToTitle()
{
    $ci = get_instance();


    $title = ucfirst($ci->uri->segment(1));

    if ($ci->uri->segment(2)) :
        $title .= ' &mdash; ' . ucfirst(str_replace('_', ' ', $ci->uri->segment(2)));

        if ($ci->uri->segment(3)) :
            $title .= ' &mdash; ' . ucfirst(str_replace('_', ' ', $ci->uri->segment(3)));
        endif;
    endif;

    return $title;
}


function convertMoneyToInteger($currency)
{
    return str_replace(',', '', $currency);
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}


function getTahunDanBulan($tahun, $bulan)
{

    if ($bulan > 9) {
        return $tahun . '-' . $bulan;
    }

    return $tahun . '-0' . $bulan;
}


function getJamMengajar($deskripsi)
{

    $explode = explode('-', $deskripsi);

    return $explode[1];
}


function getNumberFormGajiDetail($data)
{
    return count($data) - 2;
}

function bulan($bln)
{

    $bulan = $bln;
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
}

function isAdmin()
{
    $ci = get_instance();

    if (getRoleName($ci->session->userdata('role_id')) == 'admin') {
        return true;
    }
}


function isBendahara()
{
    $ci = get_instance();

    if (getRoleName($ci->session->userdata('role_id')) == 'bendahara') {
        return true;
    }
}

function isKepsek()
{
    $ci = get_instance();

    if (getRoleName($ci->session->userdata('role_id')) == 'kepsek') {
        return true;
    }
}