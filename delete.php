<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php
    include 'header.php';
    include 'partials/dbconnect.php';
    $showAlert = false;
    $showError = false;
    $id = $_GET['queid'];
    $sql = "DELETE FROM `questions` WHERE `que_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $showAlert = true;
        // include "/GCA_QUORA/que_list.php";
        // header("location: que_list.php");

    } else {
        $showError = true;
    }

    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Question has been deleted successfully.Go <a href="/GCA_QUORA/index.php">Back</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
    <?php
    if ($showError) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Failed to delete question.Go <a href="/GCA_QUORA/index.php">Back</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>

</body>

</html>