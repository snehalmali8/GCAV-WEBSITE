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
    <title>Edit</title>
</head>

<body>
    <?php
    include 'partials/dbconnect.php';
    // include 'header.php'
    ?>
    <?php
    $id = $_GET['queid'];
    $sql = "SELECT * FROM `questions` WHERE `que_cat_id` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && $_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_SESSION['name'];
        $que_title = $_POST['que_title'];
        $sql = "INSERT INTO `questions` WHERE `que_title` = '$que_title'";
        $result = mysqli_query($conn , $sql);
    }
    ?>
    <div class="container my-4">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" disabled="disabled" value=<?php echo $_SESSION['name']; ?>>
            </div>
            <?php
            $id = $_GET['queid'];
            $sql = "SELECT * FROM `questions` WHERE `que_id` = $id";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                $que_title = $row['que_title'];
            }
            ?>
            <textarea type="text" class="form-control col-lg-11 col-md-11 col-sm-11" id="que_title" name="que_title" aria-describedby="" value=""><?php echo $row['que_title']; ?></textarea>

            <button type="submit" class="btn btn-primary mb-4 my-4">Submit</button>

        </form>
    </div>
</body>

</html>