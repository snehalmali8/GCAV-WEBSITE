<!doctype html>



<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss</title>
    <style>
        .media {
            display: flex;
            font-size: 16px;
            /* justify-content: center; */
            /* margin-left: 0px; */
        }

        .media img {
            width: 64px;
            height: 64px;
        }

        .media h5 {
            font-size: 1rem;
        }

        .jumbotron {
            background: rgb(183, 240, 221);
            padding: 10px;
            border-radius: 6px;
            width: 60%;
            margin-left: 250px;
            height: 150px;
        }

        .jumbotron h3 {
            font-size: 50px;
            margin-top: 30px;

        }
        .searches {
            border: 1px solid grey;
            border-radius: 10px;
            background-color: #e6e6ff;
            /* box-shadow: 0 0 20px rgba(0,0,0,0.2); */
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;


        }

        .search-button {
            /* color: black; */
            background-color: black;
            box-shadow: 3px 3px #000033;
        }

        .search-button:hover {
            /* color: black; */
            background-color: #000033;
            cursor: pointer;
        }

        .search-anchor {
            color: white;
        }

        .search-anchor:hover {
            color: white;
        }

        .que-icon {
            float: right;
            margin: 5px;
        }
    </style>
</head>

<body>
    <?php 
    include 'header.php'; ?>




    <div class="container text-center">
        <h2 class="py-2 my-4">Searching Results for: <em>"<?php echo $_GET["search"]; ?>"</em></h2>
        <?php
        include 'partials/dbconnect.php';
        $showResult = false;
        $query = $_GET["search"];
        $sql = "SELECT * FROM `questions` WHERE (`que_title` LIKE '%" . $query . "%')";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $que_title = $row['que_title'];
            $que_id = $row['que_id'];
            $name = $row['username'];
            $url = "/GCA_QUORA/que_list.php?queid=" . $que_id;
            $showResult = true;
            echo '</div>
            <div class="container my-2 searches">
                <div class="media my-4">
                    <img class="mr-3 img-fluid" src="images/user.png" alt="Generic placeholder image" style="width: 50px; height:50px;">
                    <div class="media-body">
                    <a class="que-icon" title="delete" href="delete.php?queid=' . $row['que_id'] . '"><i class="fas fa-trash"></i>
                    <a class="que-icon" title="edit" href="kishya_edit.php?queid=' . $row['que_id'] . '"><i class="fas fa-edit"></i>
                    </a>
                    
                    </a>
                        <h5 class="mt-0">'.$name.'</h5>

                        ' . $que_title . '
                    </div>
                </div>
                <button class="btn mb-4 search-button button"><a class="search-anchor" href="dummy-Ans.php?queid=' . $row['que_id'] . '">Answer a Question</a></button>

            </div>';
        }
        if (!$showResult) {
            echo '<div class="jumbotron text-center">
                        <h3 class="display-3">No Results Found... :(</h3>
                    </div>';
        }

        ?>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>