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

/* Load Student Details */
$student_id = $_SESSION['student_id'];
$ret = "SELECT * FROM  Ubc_Student WHERE student_id = '$student_id' ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($student = $res->fetch_object()) {

    $student_class = $student->student_academic_level;

    /* Attempted Subjects */
    $query = "SELECT COUNT(*)  FROM `Ubc_Teaching_Allocations` WHERE teaching_allocation_class_name = '$student_class'  ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($attempted_units);
    $stmt->fetch();
    $stmt->close();

    /* Total Billed */
    $query = "SELECT SUM(billing_amount) FROM Ubc_Billings WHERE billing_student_id ='$student_id' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_billed);
    $stmt->fetch();
    $stmt->close();

    /* Total Paid */
    $query = "SELECT SUM(fee_payment_amount) FROM Ubc_Fee_Payment WHERE fee_payment_student_id ='$student_id' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($total_paid);
    $stmt->fetch();
    $stmt->close();

    $fee_balance = $total_billed - $total_paid;
}
