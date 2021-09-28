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


/*  Billed Fees */
$query = "SELECT SUM(billing_amount)  FROM Ubc_Billings ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($billed_amount);
$stmt->fetch();
$stmt->close();

/* Paid Fees */
$query = "SELECT SUM(fee_payment_amount)  FROM Ubc_Fee_Payment ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($paid_fees);
$stmt->fetch();
$stmt->close();

/* Balances */
$balances =   $billed_amount - $paid_fees;

if ($balances >= 0) {
    $balances;
} else {
    $balances = 'Overpay By' . $balances;
}
