<?php
session_start();
include 'db.php';

$c_id = $_GET['c_id'];

$get = $conn->prepare("select * from courses where c_id=?");
$get->bind_param("i", $c_id);
$get->execute();

$result = $get->get_result();
$row = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $c_name = $_POST['c_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];

    $sql = $conn->prepare("update courses set c_name=?, description=?, duration=? where c_id=?");
    $sql->bind_param("sssi", $c_name, $description, $duration, $c_id);

    if($sql->execute())
    {
        header("Location: viewcourse.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Course</title>

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

        <h2 class="mb-4">Edit Course</h2>

        <form method="post">

            <div class="mb-3">
                <label>Course Name</label>
                <input type="text" name="c_name" class="form-control"
                    value="<?php echo $row['c_name']; ?>" >
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo $row['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label>Duration</label>
                <input type="text" name="duration" class="form-control"
                    value="<?php echo $row['duration']; ?>">
            </div>

            <button type="submit" class="btn btn-success">
                Update
            </button>

        </form>

    </div>

</body>

</html>