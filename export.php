<?php
require '../vendor/autoload.php'; // Pastikan ini sesuai dengan path autoload.php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Menghubungkan ke database
include('../config/db.php');

$sql = "SELECT * FROM tb_arsip_surat";
$result = mysqli_query($conn, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nomor Surat');
$sheet->setCellValue('C1', 'Hari/Tanggal');
$sheet->setCellValue('D1', 'Perihal');
$sheet->setCellValue('E1', 'Alamat Surat');
$sheet->setCellValue('F1', 'Keterangan');

$row = 2; // Mulai dari baris kedua
$no = 1;

while ($data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $row, $no);
    $sheet->setCellValue('B' . $row, $data['nomor_surat']);
    $sheet->setCellValue('C' . $row, $data['hari_tanggal']);
    $sheet->setCellValue('D' . $row, $data['perihal']);
    $sheet->setCellValue('E' . $row, $data['alamat_surat']);
    $sheet->setCellValue('F' . $row, $data['keterangan']);
    $row++;
    $no++;
}

// Set header untuk file yang akan diunduh
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="arsip_surat.xlsx"');
header('Cache-Control: max-age=0');

// Tulis file ke output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
