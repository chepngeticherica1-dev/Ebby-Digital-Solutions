<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit("Login required.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId =
    $_SESSION['user_id'];

    $amount =
    floatval($_POST['amount']);

    $invoiceNumber =
    "INV-" .
    date("Ymd") .
    "-" .
    rand(1000,9999);

    $status = "Pending";

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO invoices
        (user_id,
         invoice_number,
         amount,
         status)
         VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isds",
        $userId,
        $invoiceNumber,
        $amount,
        $status
    );

    if(mysqli_stmt_execute($stmt)){

        echo $invoiceNumber;

    }else{

        echo "Invoice creation failed.";

    }

    mysqli_stmt_close($stmt);
}

?>
