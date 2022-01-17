<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css">
    <script src="https://kit.fontawesome.com/66ad72334a.js" crossorigin="anonymous"></script>

    <!-- animation code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.js"></script>

    <style>
        body {
            top: 0;
            left: 0;
        }

        .jumbo {
            /* background-color: #4d4dff; */
            /* background-color:  #fff !important; */
            /* box-shadow: 0 0 20px rgba(0,0,0,0.2); */
            /* box-shadow: 0.5rem 0.5rem black, -0.5rem -0.5rem #ccc; */
            box-shadow: rgba(0, 0, 0, 0.35) 0px -50px 36px -28px inset;
            /* border: 2px solid black; */
            background: linear-gradient(rgba(4, 9, 3, 0.7), rgba(4, 9, 3, 0.7)), url('images/campus01.jpg')no-repeat center center/cover;

            background-size: cover;
            opacity: 0.9;

        }

        .jumbotron h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: crimson;
            text-shadow: 1px 1px #f2f2f2;
            /* border-bottom: 1px solid white; */
        }

        .jumbotron p {
            font-size: 30px;
            color: #f2f2f2 !important;
            text-shadow: 2px red !important;
        }

        @media(max-width: 990px) {
            .jumbotron h1 {
                font-size: 38px;
            }
        }

        @media(max-width: 770) {
            .jumbotron h1 {
                font-size: 30px;
            }
        }

        @media(max-width: 600px) {
            .jumbotron h1 {
                font-size: 28px;
            }
        }

        .form {
            padding: 30px;
        }

        .questions {
            border: 1px solid grey;
            border-radius: 10px;
            background-color: #e6e6ff;
            /* box-shadow: 0 0 20px rgba(0,0,0,0.2); */
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;


        }

        .que-button {
            /* color: black; */
            background-color: black;
            box-shadow: 3px 3px #000033;
        }

        .que-button:hover {
            /* color: black; */
            background-color: #000033;
            cursor: pointer;
        }

        .que-anchor {
            color: white;
        }

        .que-anchor:hover {
            color: white;
        }

        .que-icon {
            float: right;
            margin: 5px;
        }

        /* button animation */
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
                width: 220px;
            }

            to {
                width: 230px;
            }
        }

        .hr {
            background-color: #e6e6ff;
            border: none;
            height: 1px;
            margin-left: 15%;
            margin-right: 15%;
            margin-bottom: 5%;
        }

        .form {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php
    include 'header.php';
    // if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
    //         echo "<script>window.location.href='categories.php'</script>";
    // }
    include 'partials/dbconnect.php';
    ?>


    <!-- Form php for putting quetions -->
    <?php
    $showAlert = false;
    $showError = false;
    $id = $_GET["catid"];
    // $sql = "SELECT * FROM `questions` WHERE `que_cat_id` = $id";
    // $result = mysqli_query($conn, $sql);
    $method = $_SERVER["REQUEST_METHOD"];
    // echo $method;
    //     if ($method == "POST") {
    //         if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    //         $que_title = $_POST['question'];
    //         $Rsql = "INSERT INTO `questions` (`que_title`, `que_cat_id`, `que_user_id`, `date` , ) VALUES ('$que_title', '$id', 'null', current_timestamp() , '$username')";
    //         $result = mysqli_query($conn, $Rsql);
    //         if ($result) {
    //             $showAlert = true;
    //         } else {
    //             $showError = true;
    //         }
    //     }
    // }
    if ($method == "POST") {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            $que_title = $_POST['question'];
            $username = $_SESSION['name'];
            $Rsql = "INSERT INTO `questions` (`que_title`, `que_cat_id`, `que_user_id`, `date` , `username`) VALUES ('$que_title', '$id', 'null', current_timestamp() , '$username')";
            $result = mysqli_query($conn, $Rsql);
        } else {
            echo "<script>window.location.href='login.php'</script>";
        }
    }
    ?>



    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question was added successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        // $category_id = $row['category_id'];
        $category_name = $row['category_name'];
    }

    ?>
    <div class="gca-jumbo">
        <div class="jumbotron text-center jumbo">
            <h1 class="display-4 category-name heading">Welcome to <?php echo $category_name;  ?></h1>
            <hr class="hr">
            <p class="text-warning"><strong>This website is made for benefit of students</strong></p>
            <hr class="my-2">
            <p class="text-primary"><strong>Feel free to ask any queries related to <?php echo $category_name;  ?>.</strong></p>
            <p class="lead">
                <button class="btn mb-4 que-button que-anchor button"><a class="que-anchor" data-toggle="modal" data-target="#questionModal">Ask a Question</a></button>
            </p>
        </div>


        <!-- Modal for add a question -->
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#questionModal">
            Launch demo modal
        </button> -->

        <!-- Modal -->
        <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="questionModalLabel">Add a Question</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Form -->
                        <div class="container border border-dark form">
                            <form action=" <?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                                <div class="form-group">
                                    <label for="question">
                                        <h5>Ask Question</h5>
                                    </label>
                                    <input type="text" class="form-control" id="question" name="question" placeholder="Type Your Question Here">
                                </div>
                                <button type="submit" class="btn que-button que-anchor" id="mybutton">Submit</button>
                            </form>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>


        <?php
        $id = $_GET["catid"];
        $sql = "SELECT * FROM `questions` WHERE `que_cat_id` = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $que_id = $row['que_id'];
            $que_title = $row['que_title'];
            $name = $row['username'];
            echo '</div>
            <div class="container my-2 questions">
                <div class="media my-4">
                    <img class="mr-3 img-fluid" src="images/user.png" alt="Generic placeholder image" style="width: 50px; height:50px;">
                    <div class="media-body">
                    <a class="que-icon" title="delete" href="delete.php?queid=' . $row['que_id'] . '"><i class="fas fa-trash"></i>
                    <a class="que-icon" title="edit" href="kishya_edit.php?queid=' . $row['que_id'] . '"><i class="fas fa-edit"></i>
                    </a>
                    
                    </a>
                        <h5 class="mt-0">' . $name . '</h5>

                        ' . $que_title . '
                    </div>
                </div>
                <button class="btn mb-4 que-button button"><a class="que-anchor" href="final_Ans.php?queid=' . $row['que_id'] . '">Answer a Question</a></button>

            </div>';
        }
        ?>
        <hr>

        <?php
        // session_start();
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<div class="container border border-dark form my-4 mb-4">
            <form action=" ' .  $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="form-group">
                                    <label for="username">
                                        <h5>Ask Question</h5>
                                    </label>
                                    <input type="text" class="form-control" id="username" name="username" value=' . $_SESSION['name'] . '>
                                </div>
                <div class="form-group">
                    <label for="question">
                        <h3>Ask Question</h3>
                    </label>
                    <input type="text" class="form-control" id="question" name="question" placeholder="Type Your Question Here">
                </div>
                <button type="submit" class="btn que-button que-anchor button">Submit</button>
            </form>
        </div>';
        } else {
            // header("location: login.php");
            echo "You have to login first";
        }

        ?>


        <?php
        include 'footer.php';
        ?>


        <script>
            document.getElementById('mybutton').onclick = function() {
                location.href = "login.php";
            };
        </script>
</body>

</html>