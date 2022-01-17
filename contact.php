<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        .contact {
            background: transparent;
            width: 50%;
            display: flex;
            justify-content: center;

        }
       

        .contact-form {
            /* width: 50%; */
            /* text-align: center; */
            background-color: rgb(248, 248, 248);
            width: 50%;
            /* margin-top: 7%; */
            padding: 1%;
            border: 1px solid rgb(15, 160, 218);

        }
        @media(max-width: 600px){
            .contact-form{
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    include "header.php";
    include "partials/dbconnect.php";
    $showAlert = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == "POST") {
        // echo "hii";
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $msj = $_POST['message'];
        $sql = "INSERT INTO `contact` (`email`, `name`, `mobile`, `message`) VALUES ('$email', '$name', '$phone', '$msj')";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your query has been updated succssfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    }
    ?>
            <h4 class="text-center my-4">Fill the Details to Contact Us</h4>

    <div class="container my-2 contact">
        <form class="contact-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

            <div class="mb-3">
                <label for="email" class="form-label">Email Id:</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email id.">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Enter your full name.">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone No:</label>
                <input name="phone" type="number" class="form-control" id="phone" placeholder="Enter your phone no.">
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" type="text" class="form-control" id="message" row="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>


<!-- Government College of Engineering & Research
Avasari - Khurd,
Taluka - Ambegaon,
District - Pune, 412405
Tel : 02133- 230582
Fax : 02133-230583
Email: office.gcoeavasari@dtemaharashtra.gov.in
Website: gcoeara.ac.in 
Developed & Managed by   Government College of Engineering & Research Avasari ,Pune.
 Web-Information-Manager (Website Content Managed by Computer Engineering Department)
 Copyright © GCOEAR, Avasari Khurd

-->