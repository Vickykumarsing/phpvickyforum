<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss- Coding Forums</title>
    <style>
    #ques {
        min-height: 450px;

    }
    #i{
        margin-top:100px;
        margin-bottom:100px;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php     include 'partails/_database.php'; ?>

    <?php include 'partails/header.php'; ?>
    <!-- use the for loop to itearat the category -->
    <?php
    //fetch the data form thread table
    include 'partails/_database.php';
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id= $id";
    $result = mysqli_query($conn, $sql);
    while($rows = mysqli_fetch_assoc($result)){
        $title = $rows['thread_title'];
        $desc = $rows['thread_desc'];
        $thread_user_id = $rows['thread_user_id'];
        $sql1 = "SELECT username FROM  `users` WHERE sno= '$thread_user_id'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $posted_by = $row1['username'];

    } 

       ?>

       <?php
       //insert into to comment
       $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       if($method == 'POST'){
        $comment = $_POST['comment'];

        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);

        $sno =$_POST['sno'];
        $sql = "INSERT INTO `comment` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp())";
       $result = mysqli_query($conn, $sql);
       $showAlert = true ;
       if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success !</strong> Your comment has been Added! 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

       }

    }

       ?>

    <div class="container bg-dark-emphasis my-3">
        <div class="jumbotron bg">
            <h1>Welcome to <?php echo $title; ?> forums</h1>
            <p><?php echo $desc; ?> </p>

            <hr class="my-4">
            <p> This is a perr to perr forum. No Spam / Advertising / self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post "offensive" posts links or images. Do not post cross
                questions. Remain respectful of the other member at all times.</p>
            <p>[Posted by the  <b> <?php echo $posted_by;?></b></p>
        </div>

    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

    
    echo'<div class="container">
        <h1 class="py-2 px-3">Post your comment</h1>

        <form action="'. $_SERVER["REQUEST_URI"].'" method="post">

            <div class="mb-3">
                <label for="desc" class="form-label">Type your comment</label>
                <input type="text" id="comment" name="comment" class="form-control" placeholder="Description">
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>';
    }   
     else{
        echo '    <div class="container">
        <p class="lead">You are not loggedin. Please login then post</p>
    </div>
';
    }



?>

    <div class="container " id="ques">
        <h1 class="py-2 px-3">Discussion</h1>
        <?php
        $noResult = true;
        $id= $_GET['threadid'];
        $sql ="SELECT * FROM `comment` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql );
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_by = $row['comment_by'];

            $sql1= "SELECT username FROM  `users` WHERE sno= '$comment_by'";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);


        
            echo'   <div class="media">
            <div class="media-body my-3">
                <img src="img/user.jpg" class="mr-3" width="80px" alt="">
                <p class="fw-bold">'.$row1['username'].' & '.$comment_time.'</p>

                
                '.$content.'
            </div>
        </div>';
            
        }
        if($noResult){
            echo'<div class="container bg-dark-emphasis my-3">
            <div class="jumbotron bg-dark-emphasis" id="i">
                <h1>No Comment Found</h1>
                <p> Be the first person to ask this questions </p>
                
            </div>';
        }
        ?>

    </div>



    <?php include 'partails/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>