<?php include '_database.php';?>
<?php
session_start();
echo '<nav class="navbar navbar-expand-lg  text-light bg-dark">
<div class="container-fluid">
  <a class="navbar-brand text-light" href="forum.php">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav   me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active text-light " aria-current="page" href="forum.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Top Categories  
        </a><ul class="dropdown-menu">';
        $sql = "SELECT category_name, category_id FROM `category` LIMIT  3 ";
        $result = mysqli_query($conn, $sql);
        while($row =mysqli_fetch_assoc($result)){
          $id = $row['category_id'];
        echo'
          <li><a class="dropdown-item" href="threadlist.php?catid='.$id.'">'.$row['category_name'].'</a></li>
          
          
        ';
        }
        

     echo' </ul></li>
      <li class="nav-item">
        <a class="nav-link  text-light" href="contact.php">Contact Us</a>
      </li>
    </ul>
    '
    ;
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true ){
      echo '       <form class="d-flex" role="search" action="search.php" method="get">
      <input class="form-control me-2" type="search"  name="search"placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary " type="submit">Search</button>
    </form>
  
    <div class=" row row-col mx-2">
      <p class=" col-9 text-light my-2 mx-2"> Welcome '.$_SESSION['useremail'].'</p>
      <a href="/phpvicky/frum/partails/loggout.php" class=" col-3 btn btn-outline-primary ml-2"> Logout </a> 
      </div>
      ';
    }
    else{
    echo '<form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-primary " type="submit">Search</button>
  </form>

  <div class=" mx-2">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal"> Login</button>
    <button class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal"> Signup </button> 

    </div>';
    }
    echo'
     </div>
    </div>
    </nav>';
include 'loginModal.php';
include 'signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You can loging now 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}
?>