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
<meta name="description" content="Insert Appointment Page">
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
 <!---   <ol class="carousel-indicators">
        <li data-target="#Images" data-slide-to="0" class="active"></li>
    </ol> 
    -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="appointment.jpeg" style="width:100%; opacity:0.3;" >
            <div class="carousel-caption">
                <hr class="solid">
                <h1 class="display-3">Update An Appointment</h1>
                <hr class="solid">
            </div>
        </div>
</div>
<br>
<br>

<?php
include 'connect.php';
$id = $_POST['id'];
$default = $_POST['default'];
$AppointmentStartDate = $_POST['AppointmentStartDate'];
$FormattedStartDate = date('Y-m-d\TH:i:s', strtotime($AppointmentStartDate));
$AppointmentEndDate = $_POST['AppointmentEndDate'];
$FormattedEndDate = date('Y-m-d\TH:i:s', strtotime($AppointmentEndDate));
$RoomNumber = $_POST['roomNumber'];
$PHN = $_POST['patientPHN'];
$DoctorID = $_POST['doctorID'];

$nurseID = $_POST['nurseID'];
$Symptoms = $_POST['Symptoms'];
$NurseID = explode(" ", $nurseID);
$NurseID = $NurseID[0];

$conn = OpenCon();
$sqlStart = "update Appointments set StartDateTime = '$AppointmentStartDate' where AppointmentID = '$id'";
$sqlEnd = "update Appointments set EndDateTime = '$AppointmentEndDate' where AppointmentID = '$id'";
$sqlRoom = "update Appointments set RoomNumber = '$RoomNumber' where AppointmentID = '$id'";
$sqlPHN = "update Appointments set PHN = '$PHN' where AppointmentID = '$id'";
$sqlDoctor = "update Appointments set DoctorID = '$DoctorID' where AppointmentID = '$id'";
$sqlNurse = "update ConfirmationOfSymptomsInvolvedInAppointment set NurseID = '$NurseID' where AppointmentID = '$id' AND PHN = '$PHN'";

$sqlSymptom;
$sqlSymptom2;
$sqlSymptom3;
$sqlSymptom4;
$Symptoms = explode(",", $Symptoms);
$default = explode(",", $default);
if (sizeof($Symptoms) == sizeof($default)) {
    for ($i = 0; $i < sizeof($default); $i++) {
        $s = $Symptoms[$i];
        $d = $default[$i];
        $checksql = "SELECT * FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$s'";
        $checkresult = $conn->query($checksql);
        if ($checkresult->num_rows == 0) {
        $sqlSymptom = "update SymptomsIdentify set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d'";
        if ($conn->query($sqlSymptom) === TRUE){
            $sqlSymptom2 = "update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        }
        } else {
            $sqlSymptom2 = "update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        }
    }
} elseif (sizeof($Symptoms) > sizeof($default)) {
    for ($i = 0; $i < sizeof($default); $i++) {
        $s = $Symptoms[$i];
        $d = $default[$i];
        $checksql = "SELECT * FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$s'";
        $checkresult = $conn->query($checksql);
        if ($checkresult->num_rows == 0) {
        $sqlSymptom = "update SymptomsIdentify set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d'";
        if ($conn->query($sqlSymptom) === TRUE){
            $sqlSymptom2 = "update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        }
        } else {
            $sqlSymptom2 = "update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        }
    }
    for ($i = sizeof($default); $i <= (sizeof($Symptoms) - sizeof($default)); $i++) {
        $s = $Symptoms[$i];
        $checksql = "SELECT * FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$s'";
        $checkresult = $conn->query($checksql);
        if ($checkresult->num_rows == 0) {
        $sqlSymptom3 = "INSERT INTO SymptomsIdentify (SymptomName, PHN)
            VALUES ('$s', '$PHN')";
        $sqlSymptom4 = "INSERT INTO ConfirmationOfSymptomsInvolvedInAppointment (AppointmentID, SymptomName, PHN, NurseID)
            VALUES ('$id', '$s', '$PHN', '$NurseID')";
        if ($conn->query($sqlSymptom3) === False || $conn->query($sqlSymptom4) === False) {
            $sentence ="Error updating the Symptom record: " . $conn->error;
            echo "<p style='text-align: center; font-weight: 350;
            font-family: Garamond; font-size: 20px'>$sentence</p>";
        }
        } else {
            $sqlSymptom4 = "INSERT INTO ConfirmationOfSymptomsInvolvedInAppointment (AppointmentID, SymptomName, PHN, NurseID)
            VALUES ('$id', '$s', '$PHN', '$NurseID')";
            if ($conn->query($sqlSymptom4) === False) {
                $sentence ="Error updating the Symptom record: " . $conn->error;
                echo "<p style='text-align: center; font-weight: 350;
                font-family: Garamond; font-size: 20px'>$sentence</p>";
            }
        }
    }
} else {
    for ($i = 0; $i < sizeof($Symptoms); $i++) {
        $s = $Symptoms[$i];
        $d = $default[$i];
        $checksql = "SELECT * FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$s'";
        $checkresult = $conn->query($checksql);
        if ($checkresult->num_rows == 0) {
        $sqlSymptom = "update SymptomsIdentify set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d'";
        if ($conn->query($sqlSymptom) === TRUE){
            $sqlSymptom2 = "update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        }
        } else {
            $sqlSymptom2 = "update ConfirmationOfSymptomsInvolvedInAppointment set SymptomName = '$s' where PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        }
    }
    for ($i = sizeof($Symptoms); $i <= (sizeof($default) - sizeof($Symptoms)); $i++) {
        $d = $default[$i];
        $sqlSymptom3 = "DELETE FROM SymptomsIdentify WHERE PHN = '$PHN' AND SymptomName = '$d'";
        //$sqlSymptom4 = "DELETE FROM ConfirmationOfSymptomsInvolvedInAppointment WHERE PHN = '$PHN' AND SymptomName = '$d' AND AppointmentID = '$id'";
        if ($conn->query($sqlSymptom3) === False) {
            $sentence ="Error updating the Symptom record: " . $conn->error;
            echo "<p style='text-align: center; font-weight: 350;
            font-family: Garamond; font-size: 20px'>$sentence</p>";
        }
    }
}

if ($conn->query($sqlStart) === TRUE && $conn->query($sqlEnd) === TRUE && $conn->query($sqlRoom) === TRUE && 
    $conn->query($sqlPHN) === TRUE && $conn->query($sqlDoctor) === TRUE && $conn->query($sqlNurse) === TRUE &&
    $conn->query($sqlSymptom2) === TRUE) 
{ echo "<p style='text-align: center; font-weight: 350;
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