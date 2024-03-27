<?php

session_start();

include_once 'docregister.php';

$users = [];

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT fullname FROM doctorregistration;";

    $sql = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($sql)){
        $users[] = $row['fullname'];
    }
    if(in_array($username, $users)){

        $query = "SELECT password FROM doctorregistration where fullname = '$username';";
        $sql = mysqli_query($conn,$query);

        if($row = mysqli_fetch_array($sql)){
            $user_password = $row['password'];
        }
        if($password === $user_password){

            $_SESSION['username'] = $username;
            header('Location: doctorpage.php');
            exit();
        }else{
            header('Location: doctor.php');
            exit();
        }
    }else{
        header('Location: Doctor_reg.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="doctor.css">
    <title>Doctor Portal</title>

</head>
<body>
    <h3 class="container">
        <a href="index.php">Home</a>
    </h3>
    <div class="container1">
        <h2>Doctor Portal</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required name>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Sign In</button>
        </form>
        <p>Not Registered?<a href="Doctor_reg.php">Create an account</a></p>
    </div>
</body>
<footer>
    <p>&copy; 2024 Patient Portal. All rights reserved.</p>
</footer>
</html>