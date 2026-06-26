<?php
session_start();
include 'db.php';

if($_SERVER ['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = $conn->prepare("select password from users where email = ?");
    $sql->bind_param("s", $email);
    $sql-> execute();
    $sql->bind_result($pass);
    $sql-> fetch();

    if(password_verify($password,$pass)){
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        exit();
    }else{
        echo "<script>alert('invalid credentials');</script>";
    }
    
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <h2 class="text-center mb-4">Login</h2>

            <form method="post">

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="enter email">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="enter password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>

            </form>

            <p class="text-center mt-3">
                Don't have an account?
                <a href="register.php">Register</a>
            </p>

        </div>

    </div>

</div>

</body>
</html>