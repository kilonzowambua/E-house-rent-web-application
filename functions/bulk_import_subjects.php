<?php
/*
 * Created on Tue Aug 31 2021
 *
 * 
 * The MIT License (MIT)
 * Copyright (c) 2021 Devlan Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


use DevLanDataAPI\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["upload"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    /* Where Magic Happens */
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {
        $targetPath = '../public/Data/system_data/xls_uploads/' . 'UBC_XLS_IMPORT_' . time() . '_' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i <= $sheetCount; $i++) {

            $unit_id = "";
            if (isset($spreadSheetAry[$i][0])) {
                /* Load Mumble Jumble Here */
                $unit_id = sha1(md5(rand(mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]), date('Y'))));
            }

            $unit_code = "";
            if (isset($spreadSheetAry[$i][1])) {
                $unit_code = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            $unit_name = "";
            if (isset($spreadSheetAry[$i][2])) {
                $unit_name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
            }


            if (!empty($unit_code) || !empty($unit_name)) {
                $query = "INSERT INTO Ubc_Units (unit_id, unit_code, unit_name) VALUES(?,?,?)";
                $paramType = "sss";
                $paramArray = array(
                    $unit_id,
                    $unit_code,
                    $unit_name
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                if (!empty($insertId)) {
                    $err = "Error Occured While Importing Data";
                } else {
                    $success = "Units / Subjects Imported";
                }
            }
        }
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}
