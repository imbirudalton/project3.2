<?php
session_start();
include_once 'register.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){

       $fullname = $_POST['fullname'];
       $gender = $_POST['gender'];
       $dob = $_POST['dob'];
       $nationality = $_POST['nationality'];
       $address = $_POST['address'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $insurance = $_POST['insurance'];							
       $physician = $_POST['physician'];
       $password = $_POST['password'];
       $confirm_password = $_POST['confirm_password'];

  $query = "insert into registration (fullname,gender,dob,nationality,address,email,phone,insurance,physician,password,confirm_password)
  values('$fullname','$gender','$dob','$nationality','$address','$email','$phone','$insurance','$physician','$password','$confirm_password')";
  if(!$conn){
    die('connection failed');
  }
$sql = mysqli_query($conn,$query);
if($sql){
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit();

}
    else{
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
    <title>Patient Register</title>
    <style>
      body {
    font-family: "Roboto", sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
.container{
    text-decoration: none;
    background-color: #007bff;
    margin-top:0 ;
    height: 8vh;
    justify-content: space-between;
    font-size: 15px;
    padding-left: 5%;
}
.container a{
     justify-content: space-between;
    text-decoration: none;
    position: relative;
    top: 28%;
    }

h2 {
    text-align: center;
    margin-top: 50px;
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #007bff;
}

p {
    text-align: center;
    margin-top: 20px;
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
    <h3 class="container">
        <a href="index.php">Home</a>
    </h3>
    <h2>New Patient Registration</h2>
    <form action="Patient_reg.php" method="POST">
        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" required name="fullname"><br><br>

        <label for="gender">Gender:</label><br>
        <input type="radio" id="male" required name="gender" value="male">Male<br><br>
        <input type="radio" id="female" required name="gender" value="female">Female<br><br>
        <input type="radio" id="other" required name="gender" value="other">Other<br><br>


        <label for="dob">Date of Birth:</label><br>
        <input type="date" id="dob" name="dob" required name="dob"><br><br>

        <label for="nationality">Nationality:</label><br>
        <input type="text" id="nationality" name="nationality" required name="nationality"><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" rows="4" cols="50" required name="address"></textarea><br><br>

        <label for="email">Email Address:</label><br>
        <input type="email" id="email" name="email" required name="email"><br><br>

        <label for="phone">Phone Number:</label><br>
        <input type="tel" id="phone" name="phone" required name="phone"><br><br>

        <label for="insurance">Insurance Information:</label><br>
        <input type="text" id="insurance" name="insurance" name="insurance"><br><br>

        <label for="physician">Primary Care Physician:</label><br>
        <input type="text" id="physician" name="physician" name="physician"><br><br>

        <label for="password">Create Password:</label><br>
        <input type="password" id="password" name="password" required name="password"><br><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required name="confirm_password"><br><br>

        <input type="submit" value="Register">
    </form>
    <p>Already have an account?<a href="Patient.html">Sign In</a></p>
    <footer>
        <p>&copy; 2024 Patient Portal. All rights reserved.</p>
    </footer>
</body>
</html>