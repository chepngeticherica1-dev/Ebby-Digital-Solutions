<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users
    (fullname,email,password)
    VALUES
    ('$fullname','$email','$password')";

    if(mysqli_query($conn,$sql)){

        echo "Registration Successful";

    }else{

        echo "Error: " . mysqli_error($conn);

    }

}

?>
