<?php
session_start();
include_once 'docregister.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

       
       $fullname = $_POST['fullname'];
       $dob = $_POST['dob'];
       $gender = $_POST['gender'];
       $nationality = $_POST['nationality'];
       $address = $_POST['address'];
       $email = $_POST['email'];		
       $medLicense = $_POST['medLicense'];	
       $speciality = $_POST['speciality'];					
       $medsSchool = $_POST['medsSchool'];
       $residency = 'Nairobi';	
       $password = $_POST['password'];	
       $confirm_password = $_POST['confirm_password'];

  $query = "INSERT INTO doctorregistration(fullname,gender,dob,nationality,address,email,password,confirm_password,speciality,medsSchool,residensy,medLicense)	
  VALUES('$fullname','$gender','$dob','$nationality','$address','$email','$password','$confirm_password','$speciality','$medsSchool','$residency','$medLicense')";

  $sql = mysqli_query($conn,$query);
  if($sql){
      $_SESSION['username'] = $fullname;
      header('Location: doctorpage.php');
      exit();
  }
  else{
    header('Location: Doctor_reg.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor Registration</title>
    <link rel="stylesheet" href="Doctor_reg.css" />
  </head>

  <body>
    <h3 class="container">
      <a href="index.html">Home</a>
    </h3>
    <h2>New Doctor Registration</h2>
    <form action="Doctor_reg.php" method="post">

      <label for="fullname">Full Name:</label><br />
      <input type="text" id="fullname" name="fullname" required /><br /><br />

      <label for="dob">Date of Birth:</label><br />
      <input type="date" id="dob" name="dob" required /><br /><br />

      <label for="gender">Gender:</label><br />
      <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option></select
      ><br /><br />

      <label for="nationality">Nationality:</label><br />
      <input type="text" id="nationality" name="nationality" required /><br /><br />

      <label for="address">Address:</label><br />
      <input type="text" id="address" name="address" required /><br /><br />

      <label for="medsSchool">Med School:</label><br />
      <input type="text" id="medsSchool" name="medsSchool" required /><br /><br />

      <label for="speciality">Speciality:</label><br />
      <input type="text" id="speciality" name="speciality" required /><br /><br />

      <label for="medLicense">Med License:</label><br />
      <input type="text" id="medLicense" name="medLicense" required /><br /><br />

      <label for="email">eMail Number:</label><br />
      <input type="text" id="email" name="email" required /><br /><br />

      <label for="password">Create password:</label><br />
      <input type="password" id="password" name="password" required /><br /><br />
        
      <label for="confirm_password">confirm password:</label><br />
      <input type="password" id="confirm_password" name="confirm_password" required/><br /><br />
        
      <input type="submit" value="Register" />
      
    </form>
    <p>Already have an account?<a href="Doctor.html">Sign In</a></p>
    <footer>
      <p>&copy; 2024 Patient Portal. All rights reserved.</p>
    </footer>
  </body>
</html>
