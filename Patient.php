<?php

session_start();
include_once 'register.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT fullname FROM registration;";
    $sql = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($sql)){
        $users[] = $row['fullname'];
    }
    if(in_array($username, $users)){
        $query = "SELECT password FROM registration where fullname = '$username';";
        $sql = mysqli_query($conn,$query);

        if($row = mysqli_fetch_array($sql)){
            $user_password = $row['password'];
        }
        if($password === $user_password){

            $_SESSION['username'] = $username;
            header('Location: patientpage.php');
            exit();
        }else{
            header('Location: Patient.php');
            exit();
        }
    }else{
        header('Location: Patient_reg.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Patient Portal</title>
    <style>
        body {
  font-family: "Roboto", sans-serif;
  background-color: #fff;
  margin: 0;
  padding: 0;
}
.top-patient {
  text-decoration: none;
  background-color: #007bff;
  margin-top: 0;
  height: 8vh;
  justify-content: space-between;
  font-size: 15px;
  padding-left: 5%;
}
.top-bar {
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-width: 800px;
  margin: 0 auto;
}
.container {
  max-width: 400px;
  margin: 100px auto;
  background-color: #fff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

form input[type="text"],
form input[type="password"],
form button[type="submit"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

form button[type="submit"] {
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

form button[type="submit"]:hover {
  background-color: #007bff;
}

p {
  text-align: center;
}

p a {
  color: #007bff;
  text-decoration: none;
}

p a:hover {
  text-decoration: underline;
}
    </style>
</head>
<body>
    <h3 class="top-patient">
        <a href="index.html">Home</a>
       
    </h3>
    <div class="container">
        <h2>Patient Portal</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Sign in</button>
        </form>
        <p>Not Registered?<a href="Patient_reg.php">Create an account</a></p>
    </div>
    
    
</body>
</html>