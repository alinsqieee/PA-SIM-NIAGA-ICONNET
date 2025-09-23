<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sim-niaga-iconnet";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_errno()) {
    echo "Gagal Terhubung " . mysqli_connect_error();
}
date_default_timezone_set('Asia/Jayapura');
$url_web = "http://localhost/SIM-NIAGA-ICONNET/";
$aplikasi = "SIM NIAGA ICONNET";

// Fungsi tgl_indo
if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

// Fungsi judul_seo
if (!function_exists('judul_seo')) {
    function judul_seo($s)
    {
        $c = array(' ');
        $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');
        $s = str_replace($d, '', $s);
        $s = strtolower(str_replace($c, '-', $s));
        return $s;
    }
}

// Fungsi buatSlug
if (!function_exists('buatSlug')) {
    function buatSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s_]+/', '-', $text);
        $text = trim($text, '-');
        return $text;
    }
}

// Array hari
$days = array(
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
);
