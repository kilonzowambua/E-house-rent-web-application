<?php
/*
 * Created on Wed Aug 25 2021
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


/* Class 1 Studets */
$query = "SELECT COUNT(*)  FROM `Ubc_Student` WHERE student_academic_level = 'Class 1' AND student_account_status !='Delete'   ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($class_1);
$stmt->fetch();
$stmt->close();

/* Class 2 Students */
$query = "SELECT COUNT(*)  FROM `Ubc_Student` WHERE student_academic_level = 'Class 2' AND student_account_status !='Delete' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($class_2);
$stmt->fetch();
$stmt->close();

/* Class 3 Students */
$query = "SELECT COUNT(*)  FROM `Ubc_Student` WHERE student_academic_level = 'Class 3' AND student_account_status !='Delete' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($class_3);
$stmt->fetch();
$stmt->close();

/* Total Students */
$query = "SELECT COUNT(*)  FROM `Ubc_Student` WHERE student_account_status !='Delete' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($total_students);
$stmt->fetch();
$stmt->close();

/* Male Students */
$query = "SELECT COUNT(*)  FROM `Ubc_Student` WHERE student_gender = 'Male' AND student_account_status !='Delete' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($male_students);
$stmt->fetch();
$stmt->close();

/* Female Students */
$query = "SELECT COUNT(*)  FROM `Ubc_Student` WHERE student_gender = 'Female' AND student_account_status !='Delete' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($female_students);
$stmt->fetch();
$stmt->close();

/* Total Staffs */
$query = "SELECT COUNT(*)  FROM `Ubc_Staff` WHERE staff_status !='Delete' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($total_staffs);
$stmt->fetch();
$stmt->close();
