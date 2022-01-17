<?php
include 'header.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
}
?>
<?php
include 'partials/dbconnect.php';
$method = $_SERVER["REQUEST_METHOD"];
$id = $_GET["queid"];
$sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
$result = mysqli_query($conn, $sql);
if($result){
    if (isset($_SERVER['REQUEST_METHOD']) && $method == "POST") {
        $a_username = $_SESSION["name"];
        // $email = $_SESSION['email'];
        $question = $id;
        $answer = $_POST["q_answer"];
        // $sql="select * from ``";
        if ($answer) {
            $sql = "INSERT INTO `answer`(`ans`, `que_id`, `username`, `date`) VALUES ('$answer', '$question','$a_username' ,current_timestamp())";
            $result = mysqli_query($conn, $sql);
        } else {
        }
    }
}
// if(isset($_GET['queid'])){
//     $id=$_GET["queid"];
// }

?>

<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a question</title>
</head>

<body>

    <div class="container border border-dark form my-4">
        <?php
        if (isset($_GET['queid']) && isset($_SERVER['REQUEST_METHOD']) && ($_SERVER["REQUEST_METHOD"] == "GET")) {
            $id = $_GET['queid'];
            $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
            $result = mysqli_query($conn, $sql);
            echo $id;
            // echo "hii";
            while ($row = mysqli_fetch_assoc($result)) {
                $que_title = $row['que_title'];
                // echo $que_title;
                echo '<div class="mb-3 my-3 content ">
                            <h4>Question:</h4>
                            <h3 class="inner_question" name="inner_question">' . $que_title . '</h3>';
            }
        }
        ?>
        <form action="answers.php" method="post">
            <div class="form-group">
                <h3 class="text-center ">Answer a Question</h3>


                <div class="mb-3 my-3 content ">
                    <label for="username" class="form-label">Username:</label>
                    <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <input type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="username" name="username" aria-describedby="emailHelp" disabled="disabled" value="<?php echo $_SESSION['name']; ?>">
                </div>

                <!-- <div class="mb-3 my-3 content ">
                        <label for="email" class="form-label">Email:</label>
                        <i class="fas fa-envelope col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                        <input type="email" class="form-control col-lg-11 col-md-11 col-sm-1" id="email" name="email"
                            aria-describedby="emailHelp" disabled="disabled" value="<?php echo $_SESSION['email']; ?>">
                    </div> -->

                <div class="mb-3 my-3 content ">
                    <label for="q_answer" class="form-label">Your Answer:</label>
                    <i class="fas fa-user col-lg-1 col-md-1 col-sm-1 text-center my-2"></i>
                    <textarea type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="q_answer" name="q_answer" aria-describedby="emailHelp" placeholder="Enter Your Answer"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Submit</button>
        </form>
    </div>
</body>