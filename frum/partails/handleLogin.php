<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_database.php';
    $user = $_POST['email'];
    $password = $_POST['password'];

    $sql = " SELECT * FROM  `users` where username = '$user'";
    $re = mysqli_query($conn, $sql);
    $noRow = mysqli_num_rows($re);
    if($noRow==1){
    

        $row = mysqli_fetch_assoc($re);
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['loggedin']= true;
            $_SESSION['sno']= $row['sno'];
            $_SESSION['useremail']= $user; 
            echo 'loggedin'.$user;

        }
        header ("Location: /phpvicky/frum/forum.php");
    }


    


}
?>
