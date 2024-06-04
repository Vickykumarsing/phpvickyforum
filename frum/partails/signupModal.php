<!--<?php
include 'partails/_database.php';
    
$showError = "false";
$showAlert = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_database.php';
    $user_email =  $_POST['signupEmail'];
    $password  = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // check whether exist user

    $existSql = "SELECT * FROM `users` WHERE username='$user_email' ";
    $result = mysqli_query($conn, $existSql);
    $noRow = mysqli_fetch_assoc($result);
    if($noRow>0){
        
        $showError ="Email already used";
    }
    else{
        if($password == $cpassword)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;

                //header ("Location: forum.php");
                //exit();
            }
            
        }
        else{
            
            $showError = "passwords is not match";
        }
    }
    //header ("Location: forum.php?signupasuccess=false&error= $showError");
    

}
if($showAlert){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You can loging now <a href="loginModal.php">check here</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>-->



<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="singupModalLabel">Signup for an iDiscuss Accounnt</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action=" /phpvicky/frum/partails/signup.php" method="POST">

            <div class="modal-body">
                    <div class="mb-3">
                        <label for="signupEmail1" class="form-label"> Email Address</label>
                        <input type="email" class="form-control" id="signupEmail1"  name="signupEmail">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Conform Password</label>
                        <input type="password" class="form-control" id="cpassword" name="cpassword">
                    </div>

                    <button type="submit" class="btn btn-primary">Signup</button>
                    </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          
        </form>

    </div>
</div>
</div>