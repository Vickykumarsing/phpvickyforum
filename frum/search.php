<!doctype html>
<html lang="en">

<head>
    <style>
    .container {
        height: 100vh;

    }
    #i{
        margin-top:100px;
        margin-bottom:100px;
    }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss- Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php include 'partails/_database.php'; ?>

    <?php include 'partails/header.php'; ?>

    <!--search result-->
    <div class="container">
        <h1>Search result <?php echo $_GET['search'];?></h1>
        <?php
        $noResult = true;
         $query = $_GET['search'];
         $sql = " select * from thread where match (thread_title, thread_desc) against ('$query')";
         $result = mysqli_query($conn, $sql);

         while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=".$thread_id;
            echo '        <div class="result">

            <h3> <a href="'.$url.'" class="text-dark">'.$title.'</a> </h3>
            <p>  '.$desc.'</p>
        </div>';
         }
         if($noResult){
            echo'<div class="container bg-dark-emphasis my-3" >
            <div class="jumbotron bg-dark-emphasis" id="i" >
                <h1  >No Result Found</h1>
                <p> Suggestions:<br>
                Make sure that all word are spelled correctly.<br>
                Try different keywords. <br>
                Try more general keywords.  </p>
                
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