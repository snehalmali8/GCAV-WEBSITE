<?php
$passwordAlert = false;
$emptyData = false;
$ue=0;
$_SESSION['signedup']=false;

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    include "partials/dbconnect.php";
    $username = $_POST["name"];
    $email = $_POST["email"];
    $roll = $_POST["roll"];
    $pass = $_POST["password"];
    $cpass = $_POST["cpassword"];
    $branch = $_POST["branch"];
    if (!empty($username) && !empty($pass) && !empty($email) && !empty($roll) && !empty($cpass) && !empty($branch)){
        
        $existsql="Select * from `signup` where name='$username' or ema
        il='$email';";
        $result=mysqli_query($conn, $existsql);
        $num=mysqli_num_rows($result);
        if($num>0){
            ++$ue;
        }
        
        if(($pass==$cpass) && $ue==0){
            $hashedpwd=password_hash($pass, PASSWORD_DEFAULT);
           // $sql="INSERT INTO `users1` (`username`, `email`, `password`, `dt`) VALUES ('$username', '$email','$hashedpwd', CURRENT_TIMESTAMP);";
             $sql = "INSERT INTO `signup` (`name`, `email`, `roll` , `password` , `branch` , `date`) VALUES ('$username', '$email' , '$roll' , '$hashedpwd', '$branch' , current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                session_start();
                // $_SESSION['signedup']=true;
                header("location: login.php?signedup=true");
            }
        }
        else{
            $passwordAlert=true;
        }
    }
    else{
        $emptyData=true;
    }

}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/66ad72334a.js" crossorigin="anonymous"></script>

    <title>SignUp to iDiscuss</title>
    <style>
    * {
        margin: 0;
        padding: 0%;
        color: white;
    }

    body {
        background: url("images/gca3-bg.jpg") no-repeat center center fixed;
        background-size: cover;
    }

    .signup-container {
        width: 60%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media(max-width: 780px) {
        .signup-container {
            width: 100%;
        }
    }

    .heading {
        font-size: 2.2rem;
        text-shadow: 2px 2px grey;
    }

    @media(max-width: 768px) {
        .heading {
            font-size: 2rem;
        }
    }

    @media(max-width: 500px) {
        .heading {
            font-size: 1.5rem;
        }
    }

    @media(max-width: 380px) {
        .heading {
            font-size: 1rem;
        }
    }

    @media(max-width: 300px) {
        .heading {
            font-size: 0.8rem;
        }
    }

    .container input {
        background: none;
        border: none;
        outline: none;
        color: white;
        background: transparent;
        font-size: 25px;
        padding: 6px;
        font-family: cursive;
    }

    .content {
        width: 100%;
        border-bottom: 4px solid rgb(0, 191, 255);
        margin: 18px 0;

    }

    /* .icon{
            width: 30px;
            text-align: center;
        } */
    </style>
</head>

<body>

    <?php include 'header.php' ?>
    <?php
    if($emptyData){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Please enter valid information!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>;</span>
        </button>
    </div>";
    }else{
        
        if($ue==1){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Username or password do not match!!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>;</span>
        </button>
        </div>";
        }
        // if ($showAlert) {
        //     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        // Success!Your account is now created and you can login.Login by using this link: <a href='/GCA_QUORA/login.php'>Login here.</a>
        // <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        //     <span aria-hidden='true'>;</span>
        // </button>
        // </div>";
        // }
        if ($passwordAlert) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong>Password do not match.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>;</span>
            </button>
        </div>";
        }
    }
    
    ?>

    <div class="container my-4">
        <h2 class="heading text-center my-4">SignUp to GCA-QUORA</h2>
        <div class="signup-container my-4">
            <form action="dummy.php" method="post">
                <div class="mb-3 my-3 content row">
                    <!-- <label for="name" class="form-label">Email</label> -->
                    <!-- <i class="far fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i> -->
                    <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="username" name="username"
                        aria-describedby="emailHelp" placeholder="Enter Your Username">
                </div>
                <div class="mb-3 my-3 content row">
                    <!-- <label for="email" class="form-label">Email</label> -->
                    <!-- <i class="far fa-envelope"></i> -->
                    <i class="fas fa-envelope col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="email" class="form-control col-lg-11 col-md-11 col-sm-1" id="email" name="email"
                        aria-describedby="emailHelp" placeholder="Enter Your Email">
                </div>
                <div class="mb-3 content row">
                    <!-- <label for="branch" class="form-label"> Confirm Password</label> -->
                    <i class="fas fa-user-graduate col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="text" class="form-control col-lg-11 col-md-11 col-sm-1" id="branch" name="branch"
                        placeholder="Enter Your Branch">
                </div>
                <div class="mb-3 my-3 content row">
                    <!-- <label for="roll" class="form-label">Roll No.</label> -->
                    <i class="fas fa-sort-numeric-up col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="number" class="form-control col-lg-11 col-md-11 col-sm-1" id="roll" name="roll"
                        aria-describedby="emailHelp" placeholder="Enter Your Roll Number">
                </div>
                <div class="mb-3 content row">
                    <!-- <label for="password" class="form-label">Password</label> -->
                    <i class="fas fa-key col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="password" class="form-control col-lg-11 col-md-11 col-sm-1" id="password"
                        name="password" placeholder="Enter Your Password">
                </div>
                <div class="mb-3 content row">
                    <!-- <label for="cpassword" class="form-label"> Confirm Password</label> -->
                    <i class="fas fa-key col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="password" class="form-control col-lg-11 col-md-11 col-sm-1" id="cpassword"
                        name="cpassword" placeholder="Confirm Your Password">
                </div>
                <!-- <div id="passwordHelp" class="form-text">Make sure to type the same password.</div> -->
                <button type="submit" class="btn btn-primary">SignUp</button>
            </form>
        </div>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>