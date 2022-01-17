<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a question</title>
</head>

<body>
    <?php
    include 'header.php';
    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
        header("Location: login.php");
    }
    include 'partials/dbconnect.php';
    ?>


    <?php
    $showAlert = false;
    $id = $_GET['queid'];
    $sql = "SELECT * FROM `questions` WHERE 'que_id' = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['queid'];
    }
    if ($result) {
        $method = $_SERVER["REQUEST_METHOD"];
        // echo $method;
        if ($method == "POST") {
            $username = $_SESSION['name'];
            // $email=$_SESSION['email'];
            // $username= mysqli_real_escape_string($conn, $username);
            $updated_que = $_POST['edit_question'];
            // $sql = "INSERT INTO `answers` (`username`, `ans`, `que_id`, `email`, `date`) VALUES ('$username', '$ans', '$id', '$email', current_timestamp());";
            $sql = "UPDATE `questions` SET `que_title`='$updated_que' WHERE `que_id`='$id'";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        }
    }

    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your question was updated succssfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
    <div class="container border border-dark form my-4">

        <?php
        // $id = $_GET['queid'];
        $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
        $result = mysqli_query($conn, $sql);
        // echo $id;
        // echo "hii";
        while ($row = mysqli_fetch_assoc($result)) {
            $que_title = $row['que_title'];
            // echo $que_title;
            echo '<div class="mb-3 my-3 content ">
                            <h4>Question:</h4>
                            <h3 class="inner_question" name="inner_question">' . $que_title . '</h3>';
        }
        ?>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <div class="mb-3 my-3 content ">
                <label for="username" class="form-label">Username:</label>
                <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="username" name="username" aria-describedby="emailHelp" disabled="disabled" value="<?php echo $_SESSION['name']; ?>">
            </div>
            <div class="mb-3 my-3 content ">
                <label for="q_answer" class="form-label">Edit here:</label>
                <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                <?php
                $id = $_GET['queid'];
                $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $question = $row['que_title'];
                    echo '<textarea type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="edit_question" name="edit_question"
                        aria-describedby="">' . $question . '</textarea>';
                }
                ?>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php
    // $id = $_GET['queid'];
    // $sql = "SELECT* FROM `answers` WHERE `que_id` = '$id'";
    // $result = mysqli_query($conn, $sql);
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $ans_title = $row['ans'];
    //     echo '</div>
    //         <div class="container my-2 questions">
    //             <div class="media my-4">
    //                 <img class="mr-3 img-fluid" src="images/user.jpg" alt="Generic placeholder image" style="width: 50px; height:50px;">
    //                 <div class="media-body">
    //                     <h5 class="mt-0">Username</h5>

    //                     ' . $ans_title . '
    //                 </div>
    //             </div>
    //         </div>';
    // }
    ?>


</body>

</html>