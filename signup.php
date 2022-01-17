<?php
include 'partials/dbconnect.php';
$method = $_SERVER["REQUEST_METHOD"];
echo $method;
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $name = $_POST["name"];
    $email = $_POST["email"];
    $roll = $_POST["roll"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $branch = $_POST["branch"];

    // $exists = false;
    // cheak whether this username exist
    $existsSql = "SELECT * FROM `signup` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $existsSql);
    $numExistsRows = mysqli_num_rows($result);
    if ($numExistsRows > 0) {
        // $exists = true;
        $showError = "email already exists.";
    } 
    else {
        // $exists = false;
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `signup` (`name`, `email`, `roll`, `password`, `branch`, `date`) VALUES ($name, $email, $roll, $hash, $branch, current_timestamp())
            ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        } 
        else {
            $showError = "password do not match";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCA_QUORA | SignUp</title>
</head>
<style>
    .s {
        background: rgb(204, 204, 204);
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
</style>

<body class="s">
    <?php
    require 'header.php';
    ?>

    <?php
    if ($showAlert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong>Your account is now created and you can login.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>;</span>
    </button>
    </div>";
    }
    if ($showError) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!</strong>Password do not match.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>;</span>
        </button>
    </div>";
    }
    ?>
    <div class="container">

        <div class="signup-form">
            <h2 class="heading text-center my-4">SignUp to GCA-QUORA</h2>
            <form action="<?php echo $_SERVER['REQUEST_METHOD']; ?>" method="POST">
                <div class="form-group row my-4">
                    <label for="name" class="col-sm-2 col-form-label">Username :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email Id :</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roll" class="col-sm-2 col-form-label">Roll No :</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="roll" name="roll" placeholder="Enter Your Roll No.">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password :</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password :</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confrim Your Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="branch" class="col-sm-2 col-form-label">Branch :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="branch" name="branch" placeholder="Enter Your Branch">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <button type="submit" class="btn btn-primary mx-1">Sign in</button>
                        <button type="reset" class="btn btn-primary mx-1">Reset</button>

                    </div>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div> -->
                </div>
            </form>
        </div>
    </div>

</body>

</html>