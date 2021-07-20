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
<meta name="description" content="View Patients Page">
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
            <li class="nav-item active">
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
            <img class="d-block w-100" src="patient.jpeg" style="width:100%; opacity:0.3;" >
            <div class="carousel-caption">
                <hr class="solid">
                <h1 class="display-3">View Patients</h1>
                <hr class="solid">
            </div>
        </div>
</div>

<br>
<br>
<br>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<h1 style="text-align: center; font-size: 2.0em; color: rgb(0, 0, 0) !important; font-weight: 350;
font-family: Garamond;" class="display-3">Students</h1>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">

<?php
include 'connect.php';
$conn = OpenCon();
$sql = "SELECT * FROM Patients P, Students S WHERE P.PHN = S.StudentPHN";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
?>
<br>
<br>
<br>
<table class="table text-center">
  <thead>
    <tr>
     <th scope="col">#</th>
      <th scope="col">PHN</th>
      <th scope="col">Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Address</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Age</th>
      <th scope="col">Student Number</th>
	  <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $rowNumber = 0;
    while($row = $result->fetch_assoc()) { 
        $rowNumber = $rowNumber + 1;
      echo "<tr><th style='text-align: center;' scope='row'>$rowNumber</th>
      <td>".$row["PHN"]."</td>
      <td>".$row["Name"]."</td>
      <td>".$row["Gender"]."</td>
      <td>".$row["Address"]."</td>
      <td>".$row["PhoneNumber"]."</td>
      <td>".$row["Age"]."</td>
      <td>".$row["StudentNumber"]."</td>
      <form class='box1' action='update-Student.php' method='post'>
      <td>
      <input type='hidden' value=".$row['PHN']." name='PHN'> 
      <button type='submit' style='margin: 0rem 0rem 1rem 0rem; background-color: #c5e9e7; border: 1px solid #c5e9e7;' class='btn btn-primary'><i class='far fa-edit'></i></button> 
      </td>
      </form>
      <form class='box2' action='process-delete-Student.php' method='post'>
      <input type='hidden' value=".$row['PHN']." name='PHN'> 
      <td>
       <button type='submit' style='margin: 0rem 0rem 1rem 0rem; background-color: rgb(235, 102, 68); border: 1px solid rgb(235, 102, 68);' class='btn btn-primary'><i class='far fa-trash-alt'></i></button> 
       </td>
       </form>
      </tr>";
    }
} else {
	echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>0 results</p>";
}

      ?>
  </tbody>
</table>
<br>
<div class="text-center">
<form class='insertBox' action='insert-Student.php' method='post'>
<button style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 220px; color: black;" type="submit" type='button' class="btn btn-secondary">Insert A Student</button>
</form>
</div>
<br>
<br>
<br>

<br>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<h1 style="text-align: center; font-size: 2.0em; color: rgb(0, 0, 0) !important; font-weight: 350;
font-family: Garamond;" class="display-3">Faculty Members</h1>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">

<?php
$sql2 = "SELECT * FROM Patients P, FacultyStaff F WHERE P.PHN = F.FacultyPHN";
$result2 = $conn->query($sql2);


if ($result2->num_rows > 0) {
?>
<br>
<br>
<table class="table text-center">
  <thead>
    <tr>
     <th scope="col">#</th>
      <th scope="col">PHN</th>
      <th scope="col">Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Address</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Age</th>
      <th scope="col">Faculty Number</th>
	  <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $rowNumber = 0;
    while($row = $result2->fetch_assoc()) { 
        $rowNumber = $rowNumber + 1;
      echo "<tr><th style='text-align: center;' scope='row'>$rowNumber</th>
      <td>".$row["PHN"]."</td>
      <td>".$row["Name"]."</td>
      <td>".$row["Gender"]."</td>
      <td>".$row["Address"]."</td>
      <td>".$row["PhoneNumber"]."</td>
      <td>".$row["Age"]."</td>
      <td>".$row["FacultyNumber"]."</td>
      <form class='box1' action='update-Faculty.php' method='post'>
      <td>
      <input type='hidden' value=".$row['PHN']." name='PHN'> 
      <button type='submit' style='margin: 0rem 0rem 1rem 0rem; background-color: #c5e9e7; border: 1px solid #c5e9e7;' class='btn btn-primary'><i class='far fa-edit'></i></button> 
      </td>
      </form>
      <form class='box2' action='process-delete-Faculty.php' method='post'>
      <input type='hidden' value=".$row['PHN']." name='PHN'> 
      <td>
       <button type='submit' style='margin: 0rem 0rem 1rem 0rem; background-color: rgb(235, 102, 68); border: 1px solid rgb(235, 102, 68);' class='btn btn-primary'><i class='far fa-trash-alt'></i></button> 
       </td>
       </form>
      </tr>";
    }
} else {
	echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>0 results</p>";
}

      ?>
  </tbody>
</table>
<br>
<div class="text-center">
<form class='insertBox' action='insert-Faculty.php' method='post'>
<button style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 220px; color: black;" type="submit" type='button' class="btn btn-secondary">Insert A Faculty Member</button>
</form>
</div>

<br>
<br>
<br>

<br>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">
<h1 style="text-align: center; font-size: 2.0em; color: rgb(0, 0, 0) !important; font-weight: 350;
font-family: Garamond;" class="display-3">General Public Patients</h1>
<hr class="solid" style="width: 300px; border-top: 1px solid rgb(0, 0, 0);">

<?php
$sql3 = "SELECT * FROM Patients P, GeneralPublic G WHERE P.PHN = G.PublicPHN";
$result3 = $conn->query($sql3);


if ($result3->num_rows > 0) {
?>
<br>
<br>
<table class="table text-center">
  <thead>
    <tr>
     <th scope="col">#</th>
      <th scope="col">PHN</th>
      <th scope="col">Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Address</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Age</th>
      <th scope="col">Social Insurance Number</th>
	  <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  
    <?php
    $rowNumber = 0;
    while($row = $result3->fetch_assoc()) { 
        $rowNumber = $rowNumber + 1;
      echo "<tr><th style='text-align: center;' scope='row'>$rowNumber</th>
      <td>".$row["PHN"]."</td>
      <td>".$row["Name"]."</td>
      <td>".$row["Gender"]."</td>
      <td>".$row["Address"]."</td>
      <td>".$row["PhoneNumber"]."</td>
      <td>".$row["Age"]."</td>
      <td>".$row["SSN"]."</td>
      <form class='box1' action='update-Public.php' method='post'>
      <td>
      <input type='hidden' value=".$row['PHN']." name='PHN'> 
      <button type='submit' style='margin: 0rem 0rem 1rem 0rem; background-color: #c5e9e7; border: 1px solid #c5e9e7;' class='btn btn-primary'><i class='far fa-edit'></i></button> 
      </td>
      </form>
      <form class='box2' action='process-delete-Public.php' method='post'>
      <input type='hidden' value=".$row['PHN']." name='PHN'> 
      <td>
       <button type='submit' style='margin: 0rem 0rem 1rem 0rem; background-color: rgb(235, 102, 68); border: 1px solid rgb(235, 102, 68);' class='btn btn-primary'><i class='far fa-trash-alt'></i></button> 
       </td>
       </form>
      </tr>";
    }
} else {
	echo "<p style='text-align: center; font-weight: 350;
    font-family: Garamond; font-size: 20px'>0 results</p>";
}

      ?>
  </tbody>
</table>
<br>
<div class="text-center">
<form class='insertBox' action='insert-Public.php' method='post'>
<button style="background: #c5e9e7; margin-left: 20px;
  border: 1px solid #c5e9e7; padding: 7px 5px;
  width: 220px; color: black;" type="submit" type='button' class="btn btn-secondary">Insert A General Patient</button>
</form>
</div>

<br>
<br>
<br>



</body>
</html>

