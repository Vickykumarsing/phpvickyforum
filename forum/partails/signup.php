<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_database.php';
    $user_email = $_POST['signupEmail'];
    $password  = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // check whether exist user

    $existSql = "SELECT * FROM `users` WHERE username='$user_email' ";
    $result = mysqli_query($conn, $existSql);
    $noRow = mysqli_fetch_assoc($result);
    if($noRow > 0){
        
        $showError= "Email already used";
    }
    else{
        if($password == $cpassword)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `password`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            echo "error in insert";
            if($result){
                $showAlert = true;

                header ("location: /phpvicky/forum/forum.php?signupsuccess=true");
                exit();
                
            }
            
        }
        else{
            
            $showError = "passwords is not match";
        }
    }
    header("Location: /phpvicky/forum/forum.php?signupasuccess=false&error=$showError");
     
}
  
?>