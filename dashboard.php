<?php
session_start();
include 'db.php';

$result = $conn->query("select * from courses");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">
        <a class="navbar-brand" href="dashboard.php">
            Student Course
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addcourse.php">Add Course</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewcourse.php">View Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="export.php">Export Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="slider" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/1.jpg" class="d-block w-100" height="350">
        </div>

        <div class="carousel-item">
            <img src="images/2.jpg" class="d-block w-100" height="350">
        </div>

        <div class="carousel-item">
            <img src="images/3.jpg" class="d-block w-100" height="350">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>
<div class="container mt-5">

    <h2 class="text-center mb-4">Available Courses</h2>
    <div class="row">

        <?php while($row = $result->fetch_assoc()) { ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">

                <img src="uploads/<?php echo $row['image']; ?>" class="card-img-top" height="220">
                <div class="card-body">

                    <h5 class="card-title">
                        <?php echo $row['c_name']; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>

                    <a href="editcourse.php?c_id=<?php echo $row['c_id']; ?>" class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <a href="deletecourse.php?c_id=<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm">
                        Delete
                    </a>
                </div>
            </div>

        </div>
        <?php } ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>