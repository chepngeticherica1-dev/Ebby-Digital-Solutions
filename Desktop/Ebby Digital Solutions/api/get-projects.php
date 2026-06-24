<?php

session_start();

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit(json_encode([]));
}

$userId = $_SESSION['user_id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT id,
            project_name,
            service_type,
            description,
            status,
            created_at
     FROM projects
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

$projects = [];

while($row =
mysqli_fetch_assoc($result)){

    $projects[] = $row;

}

header(
"Content-Type: application/json"
);

echo json_encode(
$projects
);

mysqli_stmt_close($stmt);

?>
