<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load("import_data.xlsx");
$sheetData = $spreadsheet->getActiveSheet()->toArray();

if (!empty($sheetData)) {
        for ($i=1; $i<count($sheetData); $i++) {
            $name = $sheetData[$i][0];
            $email = $sheetData[$i][1];
            $subject = $sheetData[$i][2];
            $message = $sheetData[$i][3];
            $sql = "INSERT INTO cerita(name, email, subject, message) VALUES('$name', '$email', '$subject', '$message')";

            if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>";
            }
    }
}

?>