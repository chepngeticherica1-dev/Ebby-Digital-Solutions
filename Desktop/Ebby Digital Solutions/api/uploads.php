<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit("Login required.");
}

$uploadDir = "../uploads/";

$allowedTypes = [
    "image/jpeg",
    "image/png",
    "application/pdf",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
];

$maxSize = 10 * 1024 * 1024; // 10MB

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_FILES['file'])) {
        exit("No file selected.");
    }

    $file = $_FILES['file'];

    if ($file['error'] !== 0) {
        exit("Upload failed.");
    }

    if ($file['size'] > $maxSize) {
        exit("File exceeds 10MB limit.");
    }

    $mimeType = mime_content_type(
        $file['tmp_name']
    );

    if (!in_array($mimeType, $allowedTypes)) {
        exit("File type not allowed.");
    }

    $extension = pathinfo(
        $file['name'],
        PATHINFO_EXTENSION
    );

    $newFileName =
    uniqid("file_", true) .
    "." .
    $extension;

    $destination =
    $uploadDir .
    $newFileName;

    if (
        move_uploaded_file(
            $file['tmp_name'],
            $destination
        )
    ) {

        $userId =
        $_SESSION['user_id'];

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO uploads
            (user_id, file_name, file_path)
            VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "iss",
            $userId,
            $newFileName,
            $destination
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        echo "Upload successful.";

    } else {

        echo "Could not save file.";

    }
}

?>
