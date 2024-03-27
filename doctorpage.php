<?php
session_start();

include_once 'docregister.php';

$username = $_SESSION['username'];

$query = "SELECT fullname, ((YEAR(CURRENT_TIMESTAMP)) - (YEAR(dob))) AS Age,gender,medLicense,speciality FROM doctorregistration where fullname = '$username';";
$sql = mysqli_query($conn,$query);

$medLicense = '';

while($row = mysqli_fetch_assoc($sql)){
    $username = $row['fullname'];
    $age = $row['Age'];
    $gender = $row['gender'];
    $medLicense = $row['medLicense'];
    $speciality = $row['speciality'];
}
//move the patient from appointments to the next doctor.
if(isset($_POST['accept'])){
    $patientID = $_POST['patientid'];
    $query = "INSERT INTO confirmedpatients(patientID,medLicense) values ('$patientID','$medLicense');";


    $sql = mysqli_query($conn, $query);

    if($sql){
        $query = "DELETE FROM appointments WHERE patientID = '$patientID';";
        $sql = mysqli_query($conn, $query);
        if($sql){
            echo "<script>alert('Patient confirmed successfully!');</script>";
        }else{
            echo "<script>alert('Error Confirming the patient!');</script>";
        }
    }
}
if(isset($_POST['reject'])){
    $patientID = $_POST['patientid'];
    $issue = '';
    

}



if(isset($_POST['treated'])){

    $patientID = $_POST['patientid'];
    $bloodtype = '';
    $allergies = '';
    $diagnosis = '';
    $diseases = '';
    $doctorRemaks = '';
    $nextAppointment = '';
    $height = '';
    $weight = '';

    $query = "INSERT INTO treatedpatients(patientID, BloodType,Allergies,Diseases, Height, Weight, Diagnosis, DoctorRemarks, NextAppointment,medLicense ) VALUES ('$patientID','$bloodtype','$allergies','$diseases','$height','$weight','$diagnosis','$doctorRemaks','$nextAppointment','$medLicense');";

    $sql = mysqli_query($conn, $query);

    if($sql){
        $query = "DELETE FROM confirmedpatients WHERE patientID = '$patientID';";
        $sql = mysqli_query($conn, $query);
        if($sql){
            echo "<script>alert('Patient details updated successfully!');</script>";
        }else{
            echo "<script>alert('Error updating the patient details!');</script>";
        }
    }
}
if(isset($_POST['done'])){
    $pno = $_POST['pno'];
    $patientID = $_POST['patientid'];
    $bloodtype = $_POST['bloodtype'];
    $allergies = $_POST['allergies'];
    $diagnosis = $_POST['diagnosis'];
    $diseases = $_POST['diseases'];
    $doctorRemaks = $_POST['remarks'];
    $nextAppointment = $_POST['nextappointment'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    $query = "UPDATE `treatedpatients` SET `patientID`='$patientID',`medLicense`='$medLicense',`BloodType`='$bloodtype',`Allergies`='$allergies',`Diseases`='$diseases',`Height`='$height',`Weight`='$weight',`Diagnosis`='$diagnosis',`DoctorRemarks`='$doctorRemaks',`NextAppointment`='$nextAppointment' WHERE pNO = '$pno';";

    $sql = mysqli_query($conn, $query);

    if($sql){
        echo "<script>alert('Patient details saved successfully!');</script>";
    }else{
        echo "<script>alert('Error saving the patient details!');</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Doctor Portal</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f8f9fa;
    color: #333;
    padding-bottom: 60px; 
}

header {
    background-color:#007bff;
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
    margin-right:200px;
}

nav ul li a {
    font-size: 15px;
    text-decoration: none;
    color: black;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: #0056b3;
}

.top {
    text-align: center;
    margin-top: 20px;
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

.top-bar {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    margin: 0 auto;
}
.table_1 {
empty-cells: show;
}

.table_2 {
empty-cells: hide;
}

td,
th {
border: 1px solid gray;
padding: 0.5rem;
}
.upcoming{
    margin-right:200px ;
}


footer {
    background-color: #007bff;
    padding:10px;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
    color: #fff;
}
.appointments {
    text-align: center;
    margin-top: 60px;
    
}
.appointments h1{
    text-decoration: none;
    font-size:30px;

}
#page{
    display: flex;
   margin-left: 150px;

}
.Patients {
text-align: center;
margin-top: 50px;
margin-left: 0px;

}
.Patients h1{
font-size: 30px;
}

#patienttable{
    margin-left:70px;
    
}
table{
    width: 100%;
    max-width: 100%;
}
td input{
    width: 100%;
    border: none;
    outline: none;
}
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Doctor Portal</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Appointments</a></li>
            <li><a href="#">Patients</a></li>
            <li><a href="#">Patients</a></li>
        
        </ul>
    </nav>
    <section class="top">
    <div class="image">
        <input type="file" id="photoUpload" accept="image/*" style="display: none;">
        <label for="photoUpload">
            <img class="icon" src="images/profile.png" alt="Upload Photo" style="cursor: pointer;">
        </label>
    </div>
    <div class="top-bar">
        <h4>Name: <?php echo $username; ?> </h4>
        <h4>Age: <?php echo $age; ?></h4>
        <h4>Medical License Number: <?php echo $medLicense; ?></h4>
        <h4>Department: <?php echo $speciality; ?></h4>
        
    </div>
</section>
<script>
    
    const input = document.getElementById('photoUpload');
    const label = document.getElementById('uploadLabel');

  
    label.addEventListener('click', () => {
        input.click(); 
    });
</script>

    </section>
    <section class="appointments">
        <h1>Appointments</h1>
        <div id="page">
            <div class="upcoming">
               <h3>Upcoming Appointments</h3>
                    <table>
                       
                        <tr>
                            <th scope="col">PATIENT ID</th>
                            <th scope="col">PATIENT NAME</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        <?php
                        $query = "SELECT patientID, patientName FROM appointments where medLicense = '$medLicense';";
                        $sql = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_assoc($sql)){
                            $patientID = $row['patientID'];
                        ?>
                        <tr>
                            <form action="" method="post">
                                <th scope="row"><?php echo 'Afya 0'.$row['patientID'];?></th>
                                <input type="hidden" name="patientid" value="<?php echo $row['patientID'];?>">
                                <td><?php echo $row['patientName'];?></td>
                                <td><button name="accept" type="submit">Accept</button>&nbsp;&nbsp;&nbsp;&nbsp;<button name="reject" type="submit">Reject</button></td>
                            </form>
                        </tr>
                        <?php
                        }

                        ?>
                    </table>
            </div>
 
            <div class="confirmed">
                <h3>Confirmed Appointments</h3>
              <table>
                
                <tr>
                    <th scope="col">PATIENT ID</th>
                    <th scope="col">PATIENT NAME</th>
                    <th scope="col">ACTION</th>
                </tr>
                <?php
                        $query = "SELECT confirmedpatients.patientID AS patientID, registration.fullname AS fullname FROM confirmedpatients,registration WHERE confirmedpatients.patientID = registration.PatientID AND confirmedpatients.medLicense  = '$medLicense';";
                        $sql = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_assoc($sql)){
                        ?>
                <tr>
                <form action="" method="post">
                    <th scope="row"><?php echo $row['patientID'];?></th>
                    <input type="hidden" name="patientid" value="<?php echo $row['patientID'];?>">
                    <td><?php echo $row['fullname'];?></td>
                    <td><button name="treated" type="submit">Treated</button></td>
                    </form>
                </tr>
                <?php
                        }

                        ?>
                </table>
            </div>
            

            </div>
        </div>
        
    </section>
    <section class="Patients">
        <h1>Patients</h1>
        <table id="patienttable">
                
            <tr>
                <th scope="col">PATIENT ID</th>
                <th scope="col">Diagnosis</th>
                <th scope="col">Blood Type</th>
                <th scope="col">Allergies</th>
                <th scope="col">Diseases</th>
                <th scope="col">Height</th>
                <th scope="col">Weight</th>
                <th scope="col">Doctor Remarks</th>
                <th scope="col">Last Visit</th>
                <th scope="col">Next Appointment</th>
                <th scope="col">ACTION</th>
            </tr>
            <?php
                
                $query = "SELECT pNO,patientID, medLicense, `BloodType`, `Allergies`, `Diseases`, `Height`, `Weight`, `Diagnosis`, `DoctorRemarks`, `TodaysDate`, `NextAppointment` FROM `treatedpatients` WHERE medLicense = '$medLicense';";

                $sql = mysqli_query($conn,$query);

                while($row = mysqli_fetch_assoc($sql) ){

            ?>

            <tr>
                <form action="doctorpage.php" method="post">
                <input type="hidden" name="pno" value="<?php echo $row['pNO'];?>">
                <input type="hidden" name="patientid" value="<?php echo $row['patientID'];?>">
                <td><input type="text" value="<?php echo 'Afya-0'.$row['patientID'];?>" readonly></td>
                <td><input type="text" name="diagnosis" id="diagnosis" value="<?php echo $row['Diagnosis'];?>"></td>
                <td><input type="text" name="bloodtype" id="bloodtype" value="<?php echo $row['BloodType'];?>"></td>
                <td><input type="text" name="allergies" id="allergies" value="<?php echo $row['Allergies'];?>"></td>

                <td><input type="text" name="diseases" id="diseases" value="<?php echo $row['Diseases'];?>"></td>

                <td><input type="text" name="height" id="height" value="<?php echo $row['Height'];?>"></td>

                <td><input type="text" name="weight" id="weight" value="<?php echo $row['Weight'];?>"></td>

                <td><input type="text" name="remarks" id="remarks" value="<?php echo $row['DoctorRemarks'];?>"></td>

                <td><input type="date" name="todaysdate" id="todaysdate" value="<?php echo $row['TodaysDate'];?>"></td>

                <td><input type="date" name="nextappointment" id="nextappointment" value="<?php echo $row['NextAppointment'];?>"></td>

                <td><button type="submit" name="done">Done</button></td>
                </form>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    
    <footer>
        <p>&copy; 2024 Doctor Portal. All rights reserved.</p>
    </footer>
</body>
</html>
