<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit("Login required.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $userId =
    $_SESSION['user_id'];

    $projectName =
    $_POST['project_name'];

    $serviceType =
    $_POST['service_type'];

    $description =
    $_POST['description'];

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO projects
        (user_id, project_name,
        service_type, description)
        VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isss",
        $userId,
        $projectName,
        $serviceType,
        $description
    );

    mysqli_stmt_execute($stmt);

    echo "Project submitted successfully.";

    mysqli_stmt_close($stmt);
}

?>
