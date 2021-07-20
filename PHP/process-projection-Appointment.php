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


.box{
  opacity: 0.8;
  text-align: center;
}

.box input[type = "checkbox"]{
    outline: 2px solid #c5e9e7;
}
</style>
<meta name="description" content="Select Appointment Table Columns Page">
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
                <h1 class="display-3">Filter Appointment Columns</h1>
                <hr class="solid">
            </div>
        </div>
</div>
<br>
<br>
<form class='Filter' action='Appointment.php' method='post'>
<button style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 100px; color: black;" type="submit" type='button' class="btn btn-secondary">Show All</button>
</form>
<br>
<br>
<?php
include 'connect.php';
if (isset($_POST['appointment'])) {
$appointment = $_POST['appointment'];  

$string = "";
foreach ($appointment as $ap){ 
    $string = $string."A.".$ap.",";
}
$string = substr($string, 0, -1);
$conn = OpenCon();
$sql = "SELECT $string, P.Name AS PatientName, D.Name AS DoctorName
FROM Appointments A, Patients P, Doctor D
WHERE A.PHN = P.PHN AND A.DoctorID = D.DoctorID";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
?>

<table class="table text-center" >
  <thead>
    <tr>
     <th scope="col">#</th>
     <?php
     foreach ($appointment as $ap){ 
      if ($ap == "PHN") {
        echo "<th scope='col'>Patient</th>";
      } else if ($ap == "DoctorID") {
        echo "<th scope='col'>Doctor</th>";
      } else {
        echo "<th scope='col'>$ap</th>";
      }
     }     
      ?>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $rowNumber = 0;
    while($row = $result->fetch_assoc()) { 
        $rowNumber = $rowNumber + 1;
      echo "<tr><th style='text-align: center;' scope='row'>$rowNumber</th>";
      foreach ($appointment as $ap){ 
        if ($ap == "PHN") {
            $patient = $row["PHN"]." ".$row["PatientName"];
            echo "<td>".$patient."</td>";
          } else if ($ap == "DoctorID") {
            $doctor = $row["DoctorID"]." ".$row["DoctorName"];
            echo "<td>".$doctor."</td>";
          } else {
              echo "<td>".$row["$ap"]."</td>";
            }
      }
      echo "
      </tr>";
    }
} 
} else {
  echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>Please at Least Select One Column</p>";
}
?>
<br>
<br>
