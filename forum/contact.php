<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss- Coding Forums</title>
    <style>
    .container {
        height: 92vh;

    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php ?>
    <?php include 'partails/header.php'; ?>
    <?php
    include 'partails/_database.php';
    $showAlert= false;
       $method = $_SERVER['REQUEST_METHOD'];
       if($method=='POST'){
        $name = $_POST['fullname'];
       $mobile = $_POST['mobile'];
       $email = $_POST['email'];
       $mail = $_POST['mail'];
       $problem = $_POST['problem'];
       $sql = "INSERT INTO `contact` (`name`, `mobile`, `email`, `mail_address`, `problem`, `datetime`) VALUES ('$name', '$mobile', '$email', '$mail', '$problem', current_timestamp());";
       $result = mysqli_query($conn, $sql);
       $showAlert = true;
       if($showAlert){
           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Success !</strong> Your thread has been Added! Please wait for community respond
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
       }

       }
       

    
    
    ?>
    <div class="container">
        <form action="forum.php" method="post">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name </label>
                    <input type="text" class="form-control" id="fullname" name="fullname">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="number" class="form-control" id="mobile" name="mobile">
                </div>
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Mailing Address </label>
                <input type="text" class="form-control" id="mail" name="mail">
            </div>
            <div class="mb-3">
                    <label for="problem" class="form-label">problem </label>
                    <input type="text" class="form-control" id="problem" name="problem">
                </div>

            
            <button  type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
        <div class="mb-3  text-dark">
            <b>Connect us 7840817797</b>
        </div>
        <div class="mb-3">
            <b>Email VICKY04155@GMAIL.COM</b>
        </div>
   

    <?php include 'partails/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>