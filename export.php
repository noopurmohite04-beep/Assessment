<?php
session_start();



include 'db.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=courses.xls");

$result = $conn->query("select * from courses");
?>

<table>

    <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Description</th>
        <th>Duration</th>
        <th>Image</th>
        <th>User ID</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>

        <td><?php echo $row['c_id']; ?></td>

        <td><?php echo $row['c_name']; ?></td>

        <td><?php echo $row['description']; ?></td>

        <td><?php echo $row['duration']; ?></td>

        <td><?php echo $row['image']; ?></td>

        <td><?php echo $row['user_id']; ?></td>

    </tr>

    <?php } ?>

</table>