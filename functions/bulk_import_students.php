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
        $ret = 'SELECT * FROM  Ubc_Academic_Calendar WHERE academic_calendar_status = "Current"';
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($academic_year_details = $res->fetch_object()) {
            for ($i = 1; $i <= $sheetCount; $i++) {


                /* Student Admission Number Generator */
                // Load This After Importing Old Studentsinclude('../config/staff_number_gen.php');

                $student_id = "";
                if (isset($spreadSheetAry[$i][0])) {
                    /* Load Mumble Jumble Here */
                    $student_id = sha1(md5(rand(mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]), date('Y'))));
                }

                $student_admission_no = "";
                if (isset($spreadSheetAry[$i][1])) {
                    $student_admission_no = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
                }

                $student_name = "";
                if (isset($spreadSheetAry[$i][2])) {
                    $student_name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][2]);
                }

                $student_email  = "";
                if (isset($spreadSheetAry[$i][3])) {
                    $student_email  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][3]);
                }

                $student_phone_no = "";
                if (isset($spreadSheetAry[$i][4])) {
                    $student_phone_no = mysqli_real_escape_string($conn, $spreadSheetAry[$i][4]);
                }


                $student_gender = "";
                if (isset($spreadSheetAry[$i][5])) {
                    $student_gender = mysqli_real_escape_string($conn, $spreadSheetAry[$i][5]);
                }

                $student_dob = "";
                if (isset($spreadSheetAry[$i][6])) {
                    $student_dob = mysqli_real_escape_string($conn, $spreadSheetAry[$i][6]);
                }

                $student_area = "";
                if (isset($spreadSheetAry[$i][7])) {
                    $student_area = mysqli_real_escape_string($conn, $spreadSheetAry[$i][7]);
                }

                $student_region = "";
                if (isset($spreadSheetAry[$i][8])) {
                    $student_region = mysqli_real_escape_string($conn, $spreadSheetAry[$i][8]);
                }

                $student_dcc = "";
                if (isset($spreadSheetAry[$i][9])) {
                    $student_dcc = mysqli_real_escape_string($conn, $spreadSheetAry[$i][9]);
                }

                $student_local_church  = "";
                if (isset($spreadSheetAry[$i][10])) {
                    $student_local_church  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][10]);
                }

                $student_residential_type  = "";
                if (isset($spreadSheetAry[$i][11])) {
                    $student_residential_type  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][11]);
                }

                $student_address  = "";
                if (isset($spreadSheetAry[$i][12])) {
                    $student_address  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][12]);
                }

                $student_national_id  = "";
                if (isset($spreadSheetAry[$i][13])) {
                    $student_national_id  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][13]);
                }

                $student_father_name  = "";
                if (isset($spreadSheetAry[$i][14])) {
                    $student_father_name  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][14]);
                }

                $student_father_national_id  = "";
                if (isset($spreadSheetAry[$i][15])) {
                    $student_father_national_id  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][15]);
                }

                $student_father_phone  = "";
                if (isset($spreadSheetAry[$i][16])) {
                    $student_father_phone  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][16]);
                }

                $student_mother_name  = "";
                if (isset($spreadSheetAry[$i][17])) {
                    $student_mother_name  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][17]);
                }

                $student_mother_phone  = "";
                if (isset($spreadSheetAry[$i][18])) {
                    $student_mother_phone  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][18]);
                }

                $student_mother_idno  = "";
                if (isset($spreadSheetAry[$i][19])) {
                    $student_mother_idno  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][19]);
                }

                $student_academic_level  = "";
                if (isset($spreadSheetAry[$i][20])) {
                    $student_academic_level  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][20]);
                }

                $student_date_admitted  = "";
                if (isset($spreadSheetAry[$i][21])) {
                    $student_date_admitted  = mysqli_real_escape_string($conn, $spreadSheetAry[$i][21]);
                }

                $student_academic_caledar_id   = $academic_year_details->academic_calendar_id;


                /* Constant Values */
                $mailed_password = $student_national_id;
                $student_password = sha1(md5($mailed_password));
                $student_account_status = 'Active';

                /* Load New User Mailer */
                include('../mailers/New_student.php');


                if (!empty($student_admission_no) || !empty($student_name) || !empty($student_phone_no)) {
                    $query =
                        "INSERT INTO Ubc_Student (student_id, student_admission_no, student_name, student_email, student_password, student_phone_no, student_gender, student_dob, student_area, student_region, student_dcc, student_local_church, student_residential_type, student_address, student_national_id, student_father_name, student_father_national_id, student_father_phone, student_mother_name,  student_mother_phone, student_mother_idno, student_academic_level, student_account_status, student_date_admitted, student_academic_caledar_id          )
                     VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $paramType = "sssssssssssssssssssssssss";
                    $paramArray = array(
                        $student_id,
                        $student_admission_no,
                        $student_name,
                        $student_email,
                        $student_password,
                        $student_phone_no,
                        $student_gender,
                        $student_dob,
                        $student_area,
                        $student_region,
                        $student_dcc,
                        $student_local_church,
                        $student_residential_type,
                        $student_address,
                        $student_national_id,
                        $student_father_name,
                        $student_father_national_id,
                        $student_father_phone,
                        $student_mother_name,
                        $student_mother_phone,
                        $student_mother_idno,
                        $student_academic_level,
                        $student_account_status,
                        $student_date_admitted,
                        $student_academic_caledar_id

                    );
                    $insertId = $db->insert($query, $paramType, $paramArray);
                    if (!empty($insertId)) {
                        $err = "Error Occured While Importing Data";
                    } elseif ($mail->send()) {
                        $success = "Data Imported";
                    } else {
                        $err = "$mail->ErrorInfo";
                    }
                }
            }
        }
    } else {
        $info = "Invalid File Type. Upload Excel File.";
    }
}
