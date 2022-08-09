<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }
    // } else {
    //     $role_id = $ci->session->userdata('role_id');
    //     $menu = $ci->uri->segment(2);

    //     $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    //     $menu_id = $queryMenu['id'];

    //     $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    //     if ($userAccess->num_rows() < 1) {
    //         redirect('auth/blocked');
    //     }
    // }
}

function getKodePenjualan()
{
    $ci = &get_instance();
    date_default_timezone_set('Asia/Jakarta');
    $ambilTanggalSekarang = date('dmy');
    $cekKodePenjualan = $ci->db->get('penjualan')->num_rows();
    if ($cekKodePenjualan > 0) {
        $kodePenjualan = $ci->db->query('SELECT MAX(kode_penjualan) AS KP FROM penjualan WHERE date(tanggal) = CURDATE()')->row();
        $noUrut = substr($kodePenjualan->KP, 9, 4) + 1;
        $kodePenjualanBaru = sprintf('%04s', $noUrut);
    } else {
        $kodePenjualanBaru = '0001';
    }
    return 'KDP' . $ambilTanggalSekarang . $kodePenjualanBaru;
}

function cari_tanggal($tanggal)
{
    $bulan = '';
    switch (date('n',strtotime($tanggal))) {
        case 1: $bulan = 'Januari'; break;
        case 2: $bulan = 'Februari'; break;
        case 3: $bulan = 'Maret'; break;
        case 4: $bulan = 'April'; break;
        case 5: $bulan = 'Mei'; break;
        case 6: $bulan = 'Juni'; break;
        case 7: $bulan = 'Juli'; break;
        case 8: $bulan = 'Agustus'; break;
        case 9: $bulan = 'September'; break;
        case 10: $bulan = 'Okteber'; break;
        case 11: $bulan = 'November'; break;
        case 12: $bulan = 'Desember'; break;
    }

    return date('j',strtotime($tanggal))." $bulan ".date('Y',strtotime($tanggal));
}