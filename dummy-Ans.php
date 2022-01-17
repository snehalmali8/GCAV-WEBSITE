<?php
include 'header.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a question</title>
    <script src="https://kit.fontawesome.com/66ad72334a.js" crossorigin="anonymous"></script>

    <style>
        .ans-container {
            border-radius: 30px;
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .answers {
            border: 1px solid grey;
            border-radius: 10px;
            background-color: #e6e6ff;
            /* box-shadow: 0 0 20px rgba(0,0,0,0.2); */
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }
        .ans-button {
            /* color: black; */
            background-color: black;
            box-shadow: 3px 3px #000033;
        }

        .ans-button:hover {
            /* color: black; */
            background-color: #000033;
            cursor: pointer;
        }

        .ans-anchor {
            color: white;
        }

        .ans-anchor:hover {
            color: white;
        }

        .ans-icon {
            float: right;
            margin: 5px;
        }
    </style>
</head>

<div>

    <?php
    include 'partials/dbconnect.php';
    ?>

    <?php
    $showAlert = false;
    $id = $_GET['queid'];
    $sql = "SELECT * FROM `questions` WHERE 'que_id' = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $method = $_SERVER["REQUEST_METHOD"];
        // echo $method;
        if ($method == "POST") {
            // echo "hiee";
            $name = $_SESSION['name'];
            $ans = $_POST['ans'];
            $sql = "INSERT INTO `answer` (`username`, `ans_title`, `ans_que_id`, `date`) VALUES ('$name', '$ans', '$id', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
        }
    }

    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your answer was updated succssfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
    <div class="container border border-dark form my-4 ans-container mb-4">

        <?php
        $id = $_GET['queid'];
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
            <div class="form-group">
                <label for="name">
                </label>
                <input type="text" class="form-control" id="name" name="name" disabled="disabled" value="<?php echo $_SESSION['name']; ?>">
            </div>
            <div class="form-group">
                <label for="ans">
                </label>
                <input type="text" class="form-control" id="ans" name="ans" placeholder="Type Your Answer Here">
            </div>

            <button type="submit" class="btn ans-button ans-anchor">Submit</button>
        </form>
    </div>

    <?php
    $id = $_GET['queid'];
    $sql = "SELECT* FROM `answer` WHERE `ans_que_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $ans_title = $row['ans_title'];
        $username = $row['username'];
        echo '</div>
            <div class="container my-2 answers">
                <div class="media my-4">
                    <img class="mr-3 img-fluid" src="images/user.png" alt="Generic placeholder image" style="width: 50px; height:50px;">
                    <div class="media-body">
                    <a class="ans-icon" title="delete" href="delete.php"><i class="fas fa-trash"></i>
                    <a class="ans-icon" title="edit" href="kishya_edit.php"><i class="fas fa-edit"></i>
                    </a>
                        <h6 class="mt-0">' . $username . '</h6>

                        ' . $ans_title . '
                    </div>
                </div>
            </div>';
    }
    ?>
</div>
<div class="container text-center">
    <h1>Answers</h1>
</div>
<?php
include 'footer.php';
?>
</body>

</html>