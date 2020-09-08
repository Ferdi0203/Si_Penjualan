<?php

function role($status)

{


    if ($status == "1") {

        echo "fas fa-cog";
    } else if ($status == "2") {
        echo "fas fa-user-tie";
    } else if ($status == "3") {
        echo "fas fa-wrench";
    }
}

function stock($status)

{
    if ($status == "1") {

        echo "fas fa-cog";
    } else if ($status == "2") {
        echo "fas fa-user-tie";
    } else if ($status == "3") {
        echo "fas fa-wrench";
    }
}

function format_hari_tanggal($waktu)

{

    // Senin, Selasa dst.

    $hari_array = array(

        'Minggu',

        'Senin',

        'Selasa',

        'Rabu',

        'Kamis',

        'Jumat',

        'Sabtu'

    );

    $hr = date('w', strtotime($waktu));

    $hari = $hari_array[$hr];
    // Tanggal: 1-31 dst, tanpa leading zero.

    $tanggal = date('j', strtotime($waktu));



    // Bulan: Januari, Maret dst.

    $bulan_array = array(

        1 => 'Januari',

        2 => 'Februari',

        3 => 'Maret',

        4 => 'April',

        5 => 'Mei',

        6 => 'Juni',

        7 => 'Juli',

        8 => 'Agustus',

        9 => 'September',

        10 => 'Oktober',

        11 => 'November',

        12 => 'Desember',

    );

    $bl = date('n', strtotime($waktu));

    $bulan = $bulan_array[$bl];


    // Tahun, 4 digit.

    $tahun = date('Y', strtotime($waktu));

    //$jam = time('Y', strtotime($waktu));


    // Hasil akhir: Senin, 1 Oktober 2014

    return "$hari, $tanggal $bulan $tahun";
}