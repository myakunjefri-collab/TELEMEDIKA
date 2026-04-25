<?php
// 1. Matikan peringatan error bawaan XAMPP agar tidak merusak format JSON
error_reporting(0); 

// set format json
header('Content-Type: application/json');

// url api bps
$url = "https://webapi.bps.go.id/v1/api/interoperabilitas/datasource/simdasi/id/25/tahun/2020/id_tabel/TEptbDV0QlRORVl6cjl0THhMbk02Zz09/wilayah/0000000/key/e13e05d46fa995358a35eb472033accb";

// 2. Tambahkan simbol @ di depan file_get_contents untuk memaksa XAMPP diam jika diblokir
$response = @file_get_contents($url);

// cek error
if ($response === FALSE) {
    echo json_encode(["error" => "Koneksi diblokir oleh XAMPP lokal"]);
    exit;
}

// kirim ke js
echo $response;
?>