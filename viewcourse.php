<?php
session_start();
include 'db.php';

$result = $conn->query("select * from courses");
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Courses</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body
        {
            background:#f5f5f5;
        }

        table
        {
            background: linear-gradient(45deg,#74ebd5,#ACB6E5);
            animation: colorchange 5s infinite alternate;
        }
        @keyframes colorchange
        {
            0%
            {
                background: linear-gradient(45deg,#74ebd5,#ACB6E5);
            }

            50%
            {
                background: linear-gradient(45deg,#ff9a9e,#fad0c4);
            }
            100%
            {
                background: linear-gradient(45deg,#a18cd1,#fbc2eb);
            }
        }

        th
        {
            background:#343a40;
            color:white;
        }

        tr:hover
        {
            background:#d1ecf1;
            transition:0.3s;
        }

        </style>
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

        <h2 class="mb-4">Courses</h2>

        <table class="table table-bordered table-hover">

            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php while($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td><?php echo $row['c_id']; ?></td>

                    <td><?php echo $row['c_name']; ?></td>

                    <td><?php echo $row['description']; ?></td>

                    <td><?php echo $row['duration']; ?></td>

                    <td>
                        <img src="uploads/<?php echo $row['image']; ?>" width="80">
                    </td>

                    <td>
                        <a href="editcourse.php?c_id=<?php echo $row['c_id']; ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="deletecourse.php?c_id=<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm">
                            Delete
                        </a>
                    </td>

                </tr>

            <?php } ?>

        </table>

    </div>

</body>

</html>