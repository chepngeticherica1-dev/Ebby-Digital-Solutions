<?php

session_start();

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, fullname, email, password
         FROM users
         WHERE email = ?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {

        if (
            password_verify(
                $password,
                $user['password']
            )
        ) {

            $_SESSION['user_id'] =
            $user['id'];

            $_SESSION['fullname'] =
            $user['fullname'];

            $_SESSION['email'] =
            $user['email'];

            header(
                "Location: ../dashboard.html"
            );
            exit;

        } else {

            echo "Invalid password.";

        }

    } else {

        echo "Account not found.";

    }

    mysqli_stmt_close($stmt);
}

?>
