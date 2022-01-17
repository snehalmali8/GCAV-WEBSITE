<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCA-QUORA | About Us</title>
    <style>
        body {
            top: 0;
            left: 0;
            box-sizing: border-box;
        }

        .s {
            background-color: rgb(204, 204, 204);

        }

        .about {
            margin-top: 15vh;
        }

        .row p {
            font-size: 20px;
        }

        .clg-info h3 {
            font-size: 44px;
        }

        @media(max-width: 990px) {
            .clg-info h3 {
                font-size: 35px;
            }

            .row p {
                font-size: 18px;
            }
        }

        @media(max-width: 770px) {
            .clg-info h3 {
                font-size: 25px;
            }

            .row p {
                font-size: 16px;
            }
        }

        @media(max-width: 500px) {
            .clg-info h3 {
                font-size: 20px;
            }

            .row p {
                font-size: 14px;
            }
        }
    </style>
</head>

<body class="s">
    <?php
    include 'header.php';
    ?>
    <div class="container">
        <div class="clg-info">
            <div class="logo text-center my-4">
                <img src="images/govt-college-logo.png" alt="">
            </div>
            <div class="clg-name my-4 text-center">
                <h3>Government College Of Engineering And<br>
                    Research, Awasari-Khurd.</h3>
            </div>
            <div class="about">
                <div class="row my-4">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <p><strong>Taluka : </strong>Ambegaon<br>
                            <strong>District : </strong>Pune
                        </p>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <p><strong>Tel : </strong>02133-230582<br>
                            <strong>Fax : </strong>02133-230583
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <p><strong>Email: </strong>office.gcoeavasari@gov.in<br>
                            <strong>Website : </strong>gcoeara.ac.in
                        </p>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <p><strong>Developed and Managed by College Students :</strong></p>
                        Kishori Jathar<br>
                        Snehal Mali<br>
                        Pratika Jadhav<br>
                        Kalyani Kadam
                    </div>
                    
                </div>
            </div>

        </div>
    </div>

    <?php
include 'footer.php';
    ?>
</body>

</html>