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

</style>
<meta name="description" content="View Division Page">
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
            <li class="nav-item active">
                <a class="nav-link px-4" href="MedicalExams.php">Medical Exams</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-4" href="Patients.php">Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-4" href="Appointment.php">Appointments</a>
            </li>
        </ul>
    </div>
</div>
</nav>


<div id="Images" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="medical-exam.jpeg" style="width:100%; opacity:0.3;" >
            <div class="carousel-caption">
                <hr class="solid">
                <h1 class="display-3">Find Medical Exams For Symptoms</h1>
                <hr class="solid">
            </div>
        </div>
</div>

<br>
<br>
<form class="box" action="process-division.php" method="post"> 
<hr class="solid" style="width: 750px; border-top: 1px solid rgb(0, 0, 0);">
<form class='box' action="process-nested-aggregation-appointment.php" method="post"> 
<p Style="font-size: 18px"> Find the Medical Exams Which All Patients with Certain Symptoms Would Take. </p>
<hr class="solid" style="width: 750px; border-top: 1px solid rgb(0, 0, 0);">
</br>
<?php
include 'connect.php';
$conn = OpenCon();  

$result = $conn->query("select DISTINCT SymptomName from SymptomsIdentify");
echo "<select style='border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
width: 200px; text-align: center;' name='symptoms'>";
while ($row = $result->fetch_assoc())
{
unset($SymptomName);


$SymptomName = $row['SymptomName'];
echo '<option
value="'.$SymptomName.'">'.$SymptomName.'</option>';
}
echo "</select>";

?>
<br>
<br>
<br>
<input style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 200px; color: black;" type="submit" value="Find Medical Exams">
  <br>
  <br>
  <br>
</form>