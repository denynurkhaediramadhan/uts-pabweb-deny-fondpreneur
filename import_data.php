<?php

//require 'index.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load("import_data.xlsx");
$sheetData = $spreadsheet->getActiveSheet()->toArray();

if (!empty($sheetData)) {
        for ($i=1; $i<count($sheetData); $i++) {
            $id = $sheetData[$i][0];
            $nama_buku = $sheetData[$i][1];
            $deskripsi = $sheetData[$i][2];
            $harga = $sheetData[$i][3];
            $link_produk = $sheetData[$i][4];
            $gambar = $sheetData[$i][5];
            $sql = "INSERT INTO fondpreneur VALUES('', '$nama_buku', '$deskripsi', '$harga', '$link_produk', '$gambar')";

            if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>";
            }
    }
}

?>