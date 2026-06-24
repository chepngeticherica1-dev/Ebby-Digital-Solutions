<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit(json_encode([]));
}

$userId =
$_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT *
     FROM quotes
     WHERE user_id = ?
     ORDER BY id DESC"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $userId
);

mysqli_stmt_execute($stmt);

$result =
mysqli_stmt_get_result($stmt);

$data = [];

while(
$row =
mysqli_fetch_assoc($result)
){
$data[] = $row;
}

header(
"Content-Type: application/json"
);

echo json_encode(
$data
);

mysqli_stmt_close($stmt);

?>
