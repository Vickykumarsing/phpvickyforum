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
    </style>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
<?php     include 'partails/_database.php'; ?>
    <?php include 'partails/header.php'; ?>
    
    <!-- use the for loop to itearat the category -->
    <?php
    include 'partails/_database.php';
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE category_id= $id";
    $result = mysqli_query($conn, $sql);
    while($rows = mysqli_fetch_assoc($result)){
        $catname = $rows['category_name'];
        $catdis = $rows['category_discription'];
    } 

       ?>
    <?php 
    //insert the data into thread table
      $showAlert = false;
       $method = $_SERVER['REQUEST_METHOD'];
       
       if($method == 'POST'){
        $thread_title = $_POST['title'];
        $thread_desc = $_POST['desc'];

        $thread_title = str_replace("<","&lt;",$thread_title);
        $thread_title = str_replace(">","&gt;", $thread_title);
       
        $thrad_desc = str_replace("<","&lt;", $thread_desc);
        $thread_desc = str_replace(">","&gt;",$thread_desc);
        $sno=$_POST['sno'];
        $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ( '$thread_title', '$thread_desc', '$id', '$sno', current_timestamp());";
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

    <div class="container bg-dark-emphasis my-3">
        <div class="jumbotron bg">
            <h1>Welcome to <?php echo $catname; ?> forums</h1>
            <p><?php echo $catdis; ?> </p>

            <hr class="my-4">
            <p> This is a perr to perr forum. No Spam / Advertising / self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post "offensive" posts links or images. Do not post cross
                questions. Remain respectful of the other member at all times.</p>
            <p>Posted by : <b>Vicky</b></p>
        </div>

    </div>

    <?php
     
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']){
    echo'<div class="container">
        <h1 class="py-2 px-3">Start you Discussion</h1>

        <form action=" '. $_SERVER["REQUEST_URI"] .'" method="post">

            <div class="mb-3">
                <label for="title" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title" name="title">
                <div id="title" class="form-text">Keep your title as sort and crisp as Possible.</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate your problem</label>
                <input type="text" id="desc" name="desc" class="form-control" placeholder="Description">
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>';
    
    }
    else{
        echo '    <div class="container">
        <p class="lead">You are not loggedin. Please login to start discussion</p>
    </div>
';
    }
    ?>
    <div class="container " id="ques">
        <h1 class="py-2 px-3">Browse Questions</h1>
        <?php
        $id= $_GET['catid'];
        $sql ="SELECT * FROM `thread` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql );
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $sql1= "SELECT username FROM  `users` WHERE sno= '$thread_user_id'";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);



            echo'   
            <div class="media" id="myTable">
            <div class="media-body my-3">
                <img src="img/user.jpg" class="mr-3" width="80px" alt="">
              <p class="fw-bold">Asked by'.$row1['username'].'at '.$thread_time.'</p>  <h5 class="mt-0 text-derk"> 
                <a href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                '.$desc.'
            </div>
        </div>';
            
        }
        if($noResult)
        {
            echo'    <div class="container bg-dark-emphasis my-3">
            <div class="jumbotron bg">
                <h1>No Threads Found</h1>
                <p> Be the first person to ask this questions </p>
                
            </div>
    
        </div>'; 
        }
        ?>

    </div>



    <?php include 'partails/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js">
    
    </script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>