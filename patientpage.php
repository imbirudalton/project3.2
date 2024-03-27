<?php
session_start();

include_once 'register.php';

$username = $_SESSION['username'];
$bloodtype = $allergies = $diseases = $height = $weight = '';
$query = "SELECT patientID,fullname, ((YEAR(CURRENT_TIMESTAMP)) - (YEAR(dob))) AS Age,gender FROM registration where fullname = '$username';";
$sql = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($sql)){
    $username = $row['fullname'];
    $age = $row['Age'];
    $gender = $row['gender'];
    $patientid = $row['patientID'];
}

$query = "SELECT BloodType, Allergies,Diseases,Height,Weight FROM treatedpatients WHERE patientID = '$patientid';";
$sql = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($sql)){
    $bloodtype = $row['BloodType'];
    $allergies = $row['Allergies'];
    $diseases = $row['Diseases'];
    $height = $row['Height'];
    $weight = $row['Weight'];
}

if(isset($_POST['book-now'])){
    $medLicense = $_POST['medLicense'];

    $query = "INSERT INTO appointments(patientID,patientName,medLicense) VALUES ('$patientid','$username','$medLicense')";

    $sql = mysqli_query($conn,$query);

    if($sql){
        echo "<script>alert('Appointment booked successfully!!');</script>";
    }else{
        echo "<script>alert('Error booking an appointment contact admins for assistance.');</script>";
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
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Roboto", sans-serif;
}

body {
    line-height: 1.6;
}

header {
    background-color: #007bff;
    color: #fff;
    padding: 20px;
    text-align: center;
}

nav ul {
    list-style-type: none;
    padding: 10px;
    text-align: center;
    position: relative;
    width: 100%;
}

nav ul li {
    display: inline;
    margin-right: 100px;
    color: black;
}

nav ul li a {
    font-size: 15px;
    text-decoration: none;
    color: #333;
}

nav ul li a:hover {
    color: #007bff;
}
.image {
          
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #00bfff;
            margin: 0 auto 20px; 
        }
        .icon{
            width: 100%;
        }
        .top {
            text-align: center;
            margin-top: 20px;
        }
        .top-bar {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }


footer {
    background-color: #007bff;
    padding: 10px;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}

    </style>

</head>
<body>
    <header>
        <h1>Welcome to the Patient Portal</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="#">Medical Records</a></li>
            <li><a href="#">Prescriptions</a></li>
        </ul>
    </nav>
    <section>
        <div>
            <div class="image">
                <input type="file" id="photoUpload" accept="image/*" style="display: none;">
                <label for="photoUpload">
                    <img class="icon" src="images/profile.png" alt="Upload Photo" style="cursor: pointer;">
                </label>
            </div>
        </div>
        <script>
    
            const input = document.getElementById('photoUpload');
            const label = document.getElementById('uploadLabel');
        
          
            label.addEventListener('click', () => {
                input.click(); 
            });
        </script>
        </section>
        <section class="top">
        <div class="top-bar">
            <h4>Name: <?php echo $username; ?></h4>

            <h4>Patient ID</h4>
            <h4>Last Visit</h4>
         </div>
         </section>
         <section class="top">
        <div>
            <h2>Personal Information</h2>
            <h4>Age:  <?php echo $age; ?></h4>
            <h4>Gender:   <?php echo $gender; ?></h4>
            <h4>Blood Type: <?php echo $bloodtype; ?></h4>
            <h4>Allergies: <?php echo $allergies; ?></h4>
            <h4>Diseases: <?php echo $diseases; ?></h4>
            <h4>Height: <?php echo $height; ?></h4>
            <h4>Weight: <?php echo $weight; ?></h4>
        </div>
        </section>
        
    
    <section>
        <form action="" method="post">
        <h1>Appointments</h1>
        <select name="medLicense" id="physician">
            <?php
            $query = "SELECT fullname,medLicense FROM doctorregistration;";
            $sql = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($sql)){
            ?>
            <option value="<?php echo $row['medLicense'];?>"><?php echo $row['fullname'];?></option>
            <?php
            }
            ?>
        </select>
        <button type="submit" name="book-now">Book Now</button>
        </form>
    </section>

    <section>
        <h1>Medical Records</h1>
    </section>
    
    <section>
        <h1>Prescriptions</h1>

    </section>
    <footer>
        <p>&copy; 2024 Patient Portal. All rights reserved.</p>
    </footer>
</body>
</html>
