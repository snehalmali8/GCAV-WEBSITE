<?php
$showError = false;
$passwordAlert = false;
$emptyData = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $name_email = $_POST['identity'];
    $password = $_POST['password'];
    if (!empty($name_email) && !empty($password)) {
        $sql = "SELECT * FROM signup WHERE `name`='$name_email' or `email`='$name_email'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "in";
            $user_data = mysqli_fetch_assoc($result);
            // echo $user_data['name']."<br>";
            // echo $user_data['password']."<br>";                
            $hashed_pwd = $user_data['password'];
            if (password_verify($password, $hashed_pwd)) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $user_data['name'];
                $_SESSION['email'] = $user_data['email'];
                // if($name=="kishori" && password_verify('kishori12', $user_data['password'])){
                //     session_start();
                //     $_SESSION['adminloggedin']=true;
                // }
                header("location: index.php");
            } else {
                $passwordAlert = true;
            }
        } else {
            $showError = true;
        }
    } else {
        $emptyData = true;
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
        /* color: red; */
    }

    body {
        background: url("images/Gcoeara3.jpeg") no-repeat center center fixed;
        background-size: cover;
    }

    .login-container {
        width: 60% !important;
        height: 50vh !important;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        border: 1px solid black;
        border-radius: 20px;
        /* background-color: #ccebff; */
        background-color: #e6e6ff;
        /* box-shadow: 0 0 20px rgba(0,0,0,0.2); */
        box-shadow: rgba(0, 0, 0, 0.35) 0px -50px 36px -28px inset;




        /* margin-top: 100vh; */
    }

    @media(max-width: 780px) {
        .signup-container {
            width: 100%;
        }
    }

    .heading {
        font-size: 3rem;
        /* text-shadow: 2px 2px grey; */
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

    .content2 {
        border-bottom: 2px solid rgb(102, 16, 16);

    }

    .content {
        /* width: 80%; */
        /* border-bottom: 4px solid rgb(102, 16, 16); */
        display: block;
        margin: auto;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 2.5rem;


        /* margin: 18px 0; */
    }

    .que-button {
        /* color: black; */
        background-color: #0000b3;
        box-shadow: 3px 3px #000033;
    }

    .que-button:hover {
        /* color: black; */
        background-color: black;
        cursor: pointer;
    }

    .que-anchor {
        color: white;
    }

    .que-anchor:hover {
        color: white;
    }

    .heading {
        /* font-size: 3em; */
        font-family: serif;
        color: transparent;
        text-align: center;
        animation: effect 2s linear infinite;


    }

    @keyframes effect {
        0% {
            background: linear-gradient(#000033, #990000);
            -webkit-background-clip: text;
        }

        100% {
            background: linear-gradient(#000033, #000FFF);
            -webkit-background-clip: text;
        }
    }

    /* button animationn */
    .button {
            animation-name: snehal;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-direction: alternate;
            /* animation-play-state: running; */
            /* animation-timing-function: ease-in-out; */
            animation-delay: 1s;

        }

        @keyframes snehal {
            from {
                width: 100px;
            }

            to {
                width: 120px;
            }
        }
</style>

<body>
    <?php
    include 'header.php';
    ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['signedup']) && $_GET['signedup'] == true) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>You have succefully signedup, now you can login</strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    };
    ?>
    <?php
    if ($emptyData) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> Please enter valid information!!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
    } else {
        if ($showError) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> name or Email does not exists!!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        } else {
            if ($passwordAlert) {
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Password not matched!!
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
            }
        }
    }
    ?>

    <div class="container my-4">
        <!-- <img src="images/right-side.jpeg" alt="" class="img-responsive" style="width:100%"> -->

        <h2 class="heading text-center my-4">Login to Continue</h2>
        <div class="login-container my-4">
            <form action="login.php" method="post" class="text-center">
                <div class="content">
                    <div class="mb-3 my-3 content2 row text-center">
                        <!-- <label for="name" class="form-label">Email</label> -->
                        <!-- <i class="far fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i> -->
                        <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 col-1 text-center my-2"></i>
                        <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11 col-11" id="identity" name="identity" aria-describedby="emailHelp" placeholder="Enter Your name or Email ID">
                    </div>
                    <div class="mb-3 content2 row">
                        <!-- <label for="password" class="form-label">Password</label> -->
                        <i class="fas fa-key col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                        <input type="password" class="form-control col-lg-11 col-md-11 col-sm-1" id="password" name="password" placeholder="Enter Your Password">
                    </div>
                </div>
                <button type="submit" class="btn que-button que-anchor button">LogIn</button>
            </form>
        </div>

    </div>

    <?php
    include 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>