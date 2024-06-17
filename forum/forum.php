<!doctype html>
<html lang="en">

<head>
    <style>
        #i{
            height: 700px;
            
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iDiscuss- Coding Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include 'partails/header.php'; ?>
    <?php include 'partails/_database.php'; ?>

    <!--Slider started hare-->

    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/face.jpg" class="d-block w-100 img-fluid" id="i" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/face2.jpg" class="d-block w-100 img-fluid"  id="i"alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/face3.jpg" class="d-block w-100 img-fluid" id="i"alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    <!-- use the for loop to itearat the category -->

    <div class="container my-3">
        <h1 class=" text-center">iDiscuss Category </h1>
        <div class="row my-3 mx-3">
        

            <?php
        include 'partails/_database.php';
 $sql = " SELECT * FROM `category` ";
 $result = mysqli_query($conn, $sql);

     while($rows = mysqli_fetch_assoc($result)){

     $id = $rows['category_id'];
    $category_n = $rows['category_name'];
    $category_dis = $rows ['category_discription'];

    echo'<div class="col-md-4">
    <div class="card" style="width: 18rem;">
        <img src="img/card-'.$id.'.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><a href="threadlist.php?catid='. $id.'">'. $category_n .'</a></h5>
            <p class="card-text">'.substr($category_dis, 0, 90).'</p>
            <a href="threadlist.php?catid='. $id .'" class="btn btn-primary">View Threads</a>
        </div>
    </div>
</div>
';
 }
?>




        </div>
    </div>

    <?php include 'partails/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>