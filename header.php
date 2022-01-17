<?php
include  'partials/dbconnect.php';
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedin=true;
}
else{
    $loggedin=false;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>GCA-Quora | Online Forum</title>

    <style>
        .logo {
            font-weight: 600;
            text-shadow: 3px 3px grey;
            color: yellow;
            font-family: cursive;

        }
    </style>
</head>

<body>

    <!-- Adding Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand logo text-warning" href="index.php">GCA-QUORA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Departments
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $sql = "SELECT * FROM `categories`";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a class="dropdown-item" href="que_list.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" style="background-color: #e6e6ff;">
                <button class="btn btn-outline-success my-1 my-sm-0" type="submit">Search</button>
                <?php
                if (!$loggedin) {
                    echo '<button class="btn btn-danger my-2 mx-2 my-sm-0" type="submit"><a href="dummy.php" style="text-decoration: none; color:white;">SignUp</a></button>
                    <button class="btn btn-primary my-1 my-sm-0" type="submit"><a href="login.php" style="text-decoration: none; color:white;">LogIn</a></button>';
                }
                if ($loggedin) {
                    echo '<button class="btn btn-primary my-1 my-sm-0 mx-2" type="submit"><a href="logout.php" style="text-decoration: none; color:white;">LogOut</a></button>';
                }
                ?>
            </form>
        </div>
    </nav>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>