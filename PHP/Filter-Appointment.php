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

.box input[type = "datetime-local"]{
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
<meta name="description" content="Select Appointments Page">
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
                <h1 class="display-3">Filter Appointments</h1>
                <hr class="solid">
            </div>
        </div>
</div>

<form class="box" action="process-filter-Appointment.php" method="post"> 
</br>
</br>
<?php
include 'connect.php';
$conn = OpenCon(); 

?>
<br>
<br>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<label>Filter by Date Range</label>
<br>
<label>Leave the Date Field Empty to Select All Dates</label>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<br>
<br>
<label>Start date</label>
<br>
<input name="startDate" type="datetime-local" placeholder="Choose a date time">
<br>
<br>

<label>End date</label>
<br>
<input name="endDate" type="datetime-local" placeholder="Choose a date time">
<br>
<br>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<label>Leave the Checkboxs Empty to Select All Options</label>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<br>
<label>Room Number</label>
<br>
<?php 
$result = $conn->query("select DISTINCT RoomNumber from Room");
while ($row = $result->fetch_assoc())
{
unset($RoomNumber);
$RoomNumber = $row['RoomNumber'];
echo'<input style="outline: 2px solid #c5e9e7; border:transparent;" type="checkbox" value="'.$RoomNumber.'" name="checkbox[]"/>
     <label>'.$RoomNumber.'</label><br>';
}
?>
<br>
<label>Patient PHN</label>
<br>
<?php 
$result = $conn->query("select DISTINCT PHN, Name from Patients");
while ($row = $result->fetch_assoc())
{
unset($PHN, $Name);

$PHN = $row['PHN'];
$Name = $row['Name'];
$c = $PHN." ".$Name;
    
echo'<input style="outline: 2px solid #c5e9e7;" type="checkbox" value="'.$c.'" name="checkbox1[]"/>
     <label>'.$c.'</label><br>';
}
?>
<br>
<label>Doctor ID</label>
<br>
<?php 
$result = $conn->query("select DISTINCT DoctorID, Name from Doctor");
while ($row = $result->fetch_assoc())
{
    unset($DoctorID, $Name);
    $DoctorID = $row['DoctorID'];
    $Name = $row['Name'];
    $c = $DoctorID." ".$Name;
    
echo'<input style="outline: 2px solid #c5e9e7;" type="checkbox" value="'.$c.'" name="checkbox2[]"/>
     <label>'.$c.'</label><br>';
}
?>
<br>
<input style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 200px; color: black;" type="submit" value="Select Appointments">
  <br>
  <br>
</form>
</body>
</html>