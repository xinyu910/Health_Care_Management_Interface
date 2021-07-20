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

.box input[type = "number"], .box input[type = "datetime-local"], .box input[type = "text"]{
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
                <h1 class="display-3">Add An Appointment</h1>
                <hr class="solid">
            </div>
        </div>
</div>

<form class="box" action="process-insert-Appointment.php" method="post"> 
<br>
<br>
<label>Appointment ID</label>
<br>
<input name="appointmentID" type="number" placeholder="Enter Appointment ID" required>
<br>
<br>
<br>


<label>Appointment Start Time</label>
<br>
<input name="startDateTime" type="datetime-local" placeholder="Choose a Start Time" required>
<br>
<br>
<br>


<label>Appoinment End Time</label>
<br>
<input name="endDateTime" type="datetime-local" placeholder="Choose a End Time" required>
<br>
<br>
<br>


<label>Room Number</label>
<br>

<?php
include 'connect.php';
$conn = OpenCon();

$result = $conn->query("select DISTINCT RoomNumber from Room");
?>
<select style="border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
  width: 200px; text-align: center;" name='roomNumber'>
<?php
while ($row = $result->fetch_assoc())
{
unset($RoomNumber);


$RoomNumber = $row['RoomNumber'];
echo '<option
value="'.$RoomNumber.'">'.$RoomNumber.'</option>';
}
?>

</select>
<br>
<br>
<br>
<label>Patient PHN</label>
<br>
<?php
$result = $conn->query("select DISTINCT PHN, Name from Patients");
?>
<select style="border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
width: 200px; text-align: center;" name='patientPHN'>
<?php
while ($row = $result->fetch_assoc())
{
unset($PHN, $Name);

$PHN = $row['PHN'];
$Name = $row['Name'];
$c = $PHN." ".$Name;

echo "<br>";
echo "<br>";
echo '<option
value="'.$c.'">'.$c.'</option>';
}
echo "</select>";
?>
<br>
<br>
<br>
<label>Doctor ID</label>
<br>

<select style="border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
width: 200px; text-align: center;" name='doctorID'>
<?php
$result = $conn->query("select DISTINCT DoctorID, Name from Doctor");
while ($row = $result->fetch_assoc())
{
unset($DoctorID, $Name);
$DoctorID = $row['DoctorID'];
$Name = $row['Name'];
$c = $DoctorID." ".$Name;
echo "<br>";
echo "<br>";
echo '<option
value="'.$c.'">'.$c.'</option>';
}
echo "</select>";


?>
<br>
<br>
<br>
<label>Symptoms Identified by Patients</label>
<br>
<label>Use Comma to Seperate Multiple Symptoms</label>
<br>
<input name="Symptoms" type="text" placeholder="Enter the Symptoms" required>
<br>
<br>
<br>

<label>Comfirmation Nurse ID</label>
<br>

<select style="border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
width: 200px; text-align: center;" name='nurseID'>
<?php
$result = $conn->query("select NurseID, NurseName from Nurses");
while ($row = $result->fetch_assoc())
{
unset($NurseID, $NurseName);
$NurseID = $row['NurseID'];
$Name = $row['NurseName'];
$c = $NurseID." ".$Name;
echo "<br>";
echo "<br>";
echo '<option
value="'.$c.'">'.$c.'</option>';
}
echo "</select>";
?>
<br>
<br>
<br>
<input style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 200px; color: black;" type="submit" value="Add the Appointment">
  <br>
  <br>
  <br>
</form>
</body>
</html>