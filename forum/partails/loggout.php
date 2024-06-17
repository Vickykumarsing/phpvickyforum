<?php
 echo "please wait for loggout";
 session_start();
 session_destroy();
 header("Location: /phpvicky/forum/forum.php");
?>