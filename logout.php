<?php
 session_start();

 //remove the user session

 unset($_SESSION["user"]);

 header("Location: index.php");
 exit;