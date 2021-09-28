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

$staff_id = $_SESSION['staff_id'];
/* Load Current Academic Calendar */
$ret = 'SELECT * FROM  Ubc_Academic_Calendar WHERE academic_calendar_status = "Current" ';
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($calendar = $res->fetch_object()) {

    $current_academic_calendar = $calendar->academic_calendar_id;
    $current_academic_year = $calendar->academic_calendar_year . ' - ' . $calendar->academic_calendar_term;
    /* Class 1 Studets */
    $query = "SELECT COUNT(*)  FROM Ubc_Teaching_Allocations WHERE teaching_allocation_academic_calendar_id = '$current_academic_calendar'
     AND teaching_allocation_staff_id  = '$staff_id' ";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($allocated_units);
    $stmt->fetch();
    $stmt->close();
}

/* Sum All Subjects */
$query = "SELECT COUNT(*)  FROM Ubc_Units ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($all_subjects);
$stmt->fetch();
$stmt->close();
