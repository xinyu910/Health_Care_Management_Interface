<!DOCTYPE html>
<html lang="en">
<head>
<style>
.carousel-caption {
position: absolute;
top:205px
}

.carousel-caption h1 {
font-size:      3.5em;
color:          rgb(0, 0, 0) !important;
font-weight: 350;
font-family: Garamond;
}
/* Description text */
.carousel-caption p {
font-size:      2em;
color:          rgb(0, 0, 0) !important;
}
/* Button text */
.carousel-caption .btn {
font-size:      1em;
color:          rgb(0, 0, 0);
}
</style>
    <meta name="description" content="Simple Health Care Appointment Booking System">
    <meta name="keywords" content="Health Care, PHP, HTML, mySQL, Booking System">
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
    <a class="navbar-brand" href="#">
        <img src="logoTrans.PNG"
             height="80"
             alt=""
             loading="lazy"/></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link px-4" href="Appointment.php">Appointments</a>
            </li>
        </ul>
    </div>
</div>
</nav>
<!-- Image Slider -->
<div id="Images" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#Images" data-slide-to="0" class="active"></li>
        <li data-target="#Images" data-slide-to="1"></li>
        <li data-target="#Images" data-slide-to="2"></li>
        <li data-target="#Images" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="Medical.jpg">
            <div class="carousel-caption">
                <h1 class="display-2">Bonus Health Management System </h1>
                <br>
                <form action="insert-Appointment.php" method="post">
                <button type="submit" class="btn btn-outline-dark btn-dark">Create An Appointment</button>
                </form>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Medical7.jpeg">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Medical3.jpeg">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="Medical4.jpeg">
        </div>
    </div>
    <a class="carousel-control-prev" href="#Images" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Images" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</body>

</html>