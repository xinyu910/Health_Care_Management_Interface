<!DOCTYPE html>
<html lang="en">
<head>
<style>
.carousel-caption {
position: absolute;
top:65px
}

.carousel-caption h1 {
font-size:      3.5em;
color:          rgb(0, 0, 0) !important;
font-weight: 350;
font-family: Garamond;
}

.carousel-caption hr.solid {
border-top: 1px solid rgb(0, 0, 0);
}


</style>
<meta name="description" content="View Appointments Page">
    <meta name="author" content="Justin Jao, Angela Li, Xinyu Liu">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
<div class="container-fluid">
<a class="navbar-brand" href="index.php">
        <img src="logoTrans.PNG"
             height="80"
             alt=""
             loading="lazy"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
                <a class="nav-link px-4" href="index.php">Home Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-4" href="Doctor.php">Doctors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-4" href="MedicalExams.php">Medical Exams</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-4" href="Patients.php">Patients</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link px-4" href="Appointment.php">Appointments</a>
            </li>
        </ul>
    </div>
</div>
</nav>


<div id="Images" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="appointment.jpeg" style="width:100%; opacity:0.3;" >
            <div class="carousel-caption">
                <hr class="solid">
                <h1 class="display-3">View Appointments</h1>
                <hr class="solid">
            </div>
        </div>
</div>


<?php
include 'connect.php';
$conn = OpenCon();
$sql = "SELECT A.AppointmentID, A.StartDateTime, A.EndDateTime, A.RoomNumber, A.PHN, A.DoctorID, C.SymptomName AS Symptom, 
N.NurseName, N.NurseID
FROM Appointments A, ConfirmationOfSymptomsInvolvedInAppointment C, Nurses N
WHERE A.PHN = C.PHN AND A.AppointmentID = C.AppointmentID AND C.NurseID = N.NurseID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
<br>
<br>
<div class="btn-group" role="group" aria-label="Button_Groups">
<form class='switch' action='Appointment-Join-Name.php' method='post'>
<button style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 320px; color: black;" type="submit" type='button' class="btn btn-secondary">Hide Symptom and Nurse</button>
</form>
<form class='switch' action='Appointment-Join-Symptom-Nurse.php' method='post'>
<button style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 320px; color: black;" type="submit" type='button' class="btn btn-secondary">Show Names</button>
</form>
</div>
<br>
<br>
<table class="table text-center" >
  <thead>
    <tr>
     <th scope="col">#</th>
      <th scope="col">AppointmentID</th>
      <th scope="col">StartDateTime</th>
      <th scope="col">EndDateTime</th>
      <th scope="col">RoomNumber</th>
      <th scope="col">Patient PHN</th>
      <th scope="col">DoctorID</th>
      <th scope="col">Symptom</th>
      <th scope="col">Nurse ID</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $rowNumber = 0;
    while($row = $result->fetch_assoc()) { 
        $rowNumber = $rowNumber + 1;
        //$patient = $row["PHN"]." ".$row["PatientName"];
        //$doctor = $row["DoctorID"]." ".$row["DoctorName"]; 
        //$Nurse = $row["NurseID"]." ".$row["NurseName"];     
      echo "<tr><th style='text-align: center;' scope='row'>$rowNumber</th>
      <td>".$row["AppointmentID"]."</td>
      <td>".$row["StartDateTime"]."</td>
      <td>".$row["EndDateTime"]."</td>
      <td>".$row["RoomNumber"]."</td>
      <td>".$row["PHN"]."</td>
      <td>".$row["DoctorID"]."</td>
      <td>".$row["Symptom"]."</td>
      <td>".$row["NurseID"]."</td>
      </tr>";
    }
} else {
	echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>0 results</p>";
}

CloseCon($conn);
      ?>
  </form>
  </tbody>
</table>
<br>
<br>
<br>
</body>
</html>

