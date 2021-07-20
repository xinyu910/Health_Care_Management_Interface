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

.box input[type = "number"], .box input[type = "datetime-local"]{
  background: none;
  text-align: center;
  border: 2px solid #c5e9e7;
  padding: 14px 10px;
  width: 200px;
  outline: none;
  color: black;
  border-radius: 24px;
}
</style>
<meta name="description" content="Update Doctor Page">
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
            <li class="nav-item active">
                <a class="nav-link px-4" href="Doctor.php">Doctors</a>
            </li>
            <li class="nav-item">
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
 <!---   <ol class="carousel-indicators">
        <li data-target="#Images" data-slide-to="0" class="active"></li>
    </ol> 
    -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="doctor.jpeg" style="width:100%; opacity:0.3;" >
            <div class="carousel-caption">
                <hr class="solid">
                <h1 class="display-3">Update Doctor Infomation</h1>
                <hr class="solid">
            </div>
        </div>
</div>
<br>
<br>


<?php
include 'connect.php';
$id = $_POST['id'];
$conn = OpenCon();
$ID = $_POST['ID'];
$Name = $_POST['Name'];
$Age = $_POST['Age'];
$Gender = $_POST['Gender'];
$Specialization = $_POST['Specialization'];
$sqlID = "update Doctor set DoctorID = '$ID' where DoctorID = '$id'";
$sqlName = "update Doctor set Name = '$Name' where DoctorID = '$id'";
$sqlAge = "update Doctor set Age = '$Age' where DoctorID = '$id'";
$sqlGender = "update Doctor set Gender = '$Gender' where DoctorID = '$id'";
$sqlSpecialization = "update Doctor set Specialization = '$Specialization' where DoctorID = '$id'";

if ($conn->query($sqlID) === TRUE && $conn->query($sqlName) === TRUE && $conn->query($sqlAge) === TRUE && 
    $conn->query($sqlGender) === TRUE && $conn->query($sqlSpecialization) === TRUE) { 
    echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>Record updated successfully</p>";
} else {
    $sentence ="Error updating the record: " . $conn->error;
    echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>$sentence</p>";
}
?>
<br>
<br>
</body>
<html>