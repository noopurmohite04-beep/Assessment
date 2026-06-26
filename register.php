<?php
include 'db.php';

if($_SERVER ['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $check = $conn->prepare("select id from users where email=?");
    $check->bind_param("s", $email);

    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0)
    {
        echo "<script>alert('email already exists..');</script>";
    }
    else
    {
        $sql = $conn->prepare("insert into users(name,email,password) values(?,?,?)");
        $sql->bind_param("sss", $name, $email, $password);

        if($sql->execute())
        {
            header("Location: login.php");
            exit();
        }
        else
        {
            echo "<script>alert('Registration Failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-4">

                <h2 class="text-center mb-4">Registration</h2>

                <form method="post">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="enter name" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="enter email" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="enter password" required>
                    </div>

                    <button type="submit" class="btn btn-primary ">
                        Register
                    </button>

                </form>

                <p class="text-center mt-3">
                    Already have an account?
                    <a href="login.php">Login</a>
                </p>

            </div>

        </div>

    </div>

</body>
</html>
        
        


        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>      
    </body>
</html>
