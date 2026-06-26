<?php
session_start();
include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $c_name = $_POST['c_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$image);

    $email = $_SESSION['email'];

    $user = $conn->prepare("select id from users where email=?");
    $user->bind_param("s",$email);
    $user->execute();
    $result = $user->get_result();
    $row = $result->fetch_assoc();

    $userid = $row['id'];

    $sql = $conn->prepare("insert into courses(c_name,description,duration,image,user_id) values(?,?,?,?,?)");
    $sql->bind_param("ssssi",$c_name,$description,$duration,$image,$userid);

    if($sql->execute())
    {
        header("Location:viewcourse.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Course</title>
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
    <div class="container mt-5">

        <h2>Add Course</h2>

        <form method="post" enctype="multipart/form-data">

            <input type="text" name="c_name" class="form-control mb-3" placeholder="course name" >

            <textarea name="description" class="form-control mb-3" placeholder="description"></textarea>

            <input type="number" name="duration" class="form-control mb-3" placeholder="duration">

            <input type="file" name="image" class="form-control mb-3" >

            <button class="btn btn-primary">Add Course</button>

        </form>

    </div>

</body>
</html>