<?php
include('connect/connect.php');
session_start();
if (isset($_SESSION['email'])) {
    header("location:dashboard/index.php");
}
if(isset($_POST['submit'])&& $_POST['email']!=null&&$_POST['password']!=null)
{
    echo "hello";
    $email = $_POST['email'];
    $password = $_POST['password'];
//	$pp=sha1($password);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND status='1'";
    $result = mysqli_query($conn, $sql);
    $b=mysqli_fetch_array($result);
    if (mysqli_num_rows($result) == 1) {
        $roles=$b['UserRoles'];
        $_SESSION['email'] = $email;
        $_SESSION['UserRoles']=$roles;
        header("location:dashboard/index.php");
    }
    else {

        echo"
        <script>
            alert('Incoorect Username or Password');
            </script>";

    }
}
?>


<!DOCTYPE html>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jugnu</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
          rel = "stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
</head>


<body class="bg-gradient-primary">
<br>
<br>
<br>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row" id="divmain">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="POST" action="">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id="email" name="email" aria-describedby="emailHelp"
                                               placeholder="Enter Email Address..."required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="password" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Login" class="btn btn-info btn-user  btn-block">
                                    </div>

                                </form>
                                <hr>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>



</body>
</html>
<script>
    function login() {

        var email=$("#email").val();
        var password=$("#password").val();
        console.log(password);
        $.ajax({
            url:'login/login_process.php',
            data:{email:email,password:password},
            method:'post',
            success: function(response) {
                if(response==1)
                {
                    window.location.href="dashboard/index.php";

                }
                else
                {
                    Swal.fire("Our First Alert");
                }
            }
            }

        )
    }
</script>
<?php

include ('include/scripts.php');
?>