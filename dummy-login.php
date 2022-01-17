<?php
$login = false;
$showError = false;
$method = $_SERVER["REQUEST_METHOD"];
echo $method;
if ($method == "POST") {
    include 'partials/dbconnect.php';
    $name = $_POST["name"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM `signup` WHERE `name` = '$name'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                echo "login true";
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $name;
                header("location: /GCA_QUORA/index.php");
            } else {
                $showError = true;
            }
        }

        //     while($row = mysqli_fetch_assoc($result)){
        //         if(password_verify($password , $row['password'])){
        //             $login = true;
        //             echo "login true";
        //             session_start();
        //             $_SESSION['loggedin'] = true;
        //             $_SESSION['name'] = $name;
        //             header("location: /GCA_QUORA/index.php");
        //         }
        //         else{
        //             $showError = true;
        //         }
        //     }
        //     // header("location: /GCA_QUORA/index.php");

        // }
        // else{
        //     $showError = true;
        // }
    } else {
        $showError = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/66ad72334a.js" crossorigin="anonymous"></script>

    <title>GCA_QUORA | Login</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0%;
        color: white;
    }

    body {
        background: url("images/t1.jpg") no-repeat center center fixed;
        background-size: cover;
    }

    .signup-container {
        width: 50%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        /* margin-top: 100vh; */
    }

    @media(max-width: 780px) {
        .signup-container {
            width: 100%;
        }
    }

    .heading {
        font-size: 2.2rem;
        text-shadow: 2px 2px grey;
        /* margin-bottom: 20px; */
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
        border-bottom: 4px solid rgb(102, 16, 16);
        margin: 18px 0;

    }
</style>

<body>
    <?php
    include 'header.php';
    ?>
    <?php
    if ($login) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> You loggedi in.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        <";
    }
    if ($showError) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Error!</strong> Password do not match .
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
    </div>";
    }
    ?>

    <div class="container my-4">
        <h2 class="heading text-center my-4">LogIn to GCA-QUORA</h2>
        <div class="signup-container my-4">
            <form action="/GCA_QUORA/login.php" method="post">
                <div class="mb-3 my-3 content row">
                    <!-- <label for="name" class="form-label">Email</label> -->
                    <!-- <i class="far fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i> -->
                    <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 col-1 text-center my-2"></i>
                    <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11 col-11" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter Your Username">
                </div>
                <div class="mb-3 content row">
                    <!-- <label for="password" class="form-label">Password</label> -->
                    <i class="fas fa-key col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="password" class="form-control col-lg-11 col-md-11 col-sm-1" id="password" name="password" placeholder="Enter Your Password">
                </div>
                <button type="submit" class="btn btn-primary">LogIn</button>
            </form>
        </div>

    </div>

</body>

</html>