<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit("Login required.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId = $_SESSION['user_id'];

    $service = trim(
        $_POST['service'] ?? ''
    );

    $amount = floatval(
        $_POST['amount'] ?? 0
    );

    $status = "Pending";

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO quotes
        (user_id, service, amount, status)
        VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isds",
        $userId,
        $service,
        $amount,
        $status
    );

    if(mysqli_stmt_execute($stmt)){

        echo "Quote submitted successfully.";

    } else {

        echo "Failed to save quote.";

    }

    mysqli_stmt_close($stmt);
}

?>
