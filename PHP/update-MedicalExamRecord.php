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
<meta name="description" content="Update MedicalExamRecord Page">
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
 <!---   <ol class="carousel-indicators">
        <li data-target="#Images" data-slide-to="0" class="active"></li>
    </ol> 
    -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="medical-exam.jpeg" style="width:100%; opacity:0.5;" >
            <div class="carousel-caption">
                <hr class="solid">
                <h1 class="display-3">Update A Medical Exam Record</h1>
                <hr class="solid">
            </div>
        </div>
</div>

<form class="box" action="process-update-MedicalExamRecord.php" method="post">
<br>
<br>
<br>
<?php
include 'connect.php';
$conn = OpenCon();
$id = $_POST['TestID'];
$result = $conn->query("SELECT * FROM MedicalExamsIncludedIn WHERE TestID = '$id'");
echo "<label>You are updating the Record for Medical Exam with id = $id</label>";
$defaultTestID;
$defaultAppointmentID;
$defaultResults;
$defaultType;
while ($row = $result->fetch_assoc())
{
    $defaultTestID = $row["TestID"];
    $defaultAppointmentID = $row["AppointmentID"];
    $defaultResults = $row["Results"];
    $defaultType = $row["Type"];
}

?>
<input type="hidden" value = "<?php echo $id;?>" name="id"/>  

<br>
<br>
<hr style="border-top: 1px solid rgb(0, 0, 0); width: 400px;">
<br>
<br>
<br>
<label>New Exam ID</label>
<br>
<input name="ExamID" type="number" placeholder="Enter Exam ID" value="<?php echo $defaultTestID;?>" required>
<br>
<br>
<br>


<label>New Result</label>
<br>
<input name="Result" type="text" placeholder="Enter the Result" value="<?php echo $defaultResults;?>" required>
<br>
<br>
<br>


<label>New Appointment ID</label>
<br>

<?php

$result = $conn->query("select AppointmentID from Appointments");
?>
<select style="border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
  width: 200px; text-align: center;" name='appointmentid'>
<?php
while ($row = $result->fetch_assoc())
{
unset($AppointmentID);


$AppointmentID = $row['AppointmentID'];
if ($AppointmentID = $defaultAppointmentID) {
    echo '<option
value="'.$AppointmentID.'" selected>'.$AppointmentID.'</option>';
} else {
echo '<option
value="'.$AppointmentID.'">'.$AppointmentID.'</option>';
}
}
?>

</select>
<br>
<br>
<br>
<label>New Exam Type</label>
<br>
<?php
$result = $conn->query("select Type from MedicalExamFee");
?>
<select style="border: 2px solid #c5e9e7; border-radius: 24px; padding: 14px 10px;
width: 200px; text-align: center;" name='Type'>
<?php
while ($row = $result->fetch_assoc())
{
unset($Type);

$Type = $row['Type'];

if ($Type = $defaultType) {
    echo '<option
value="'.$Type.'" selected>'.$Type.'</option>';
} else {
echo '<option
value="'.$Type.'">'.$Type.'</option>';
}
}
echo "</select>";
?>
<br>
<br>
<br>

<input style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 200px; color: black;" type="submit" value="Update Medical Exam Record">
  <br>
  <br>
  <br>
</form>
</body>
<html>