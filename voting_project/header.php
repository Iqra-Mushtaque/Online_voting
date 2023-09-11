<?php
session_start();
include ('partials/connection.php');
if($_SESSION['key'] != "Adminkey" && $_SESSION['key'] != "Voterskey")
{
    echo "<script>location.assign('start.php'); </script>";
    die;
}
// elseif($_SESSION['key'] == "Voterskey")
// {
//     echo "<script>location.assign('logout.php'); </script>";
//     die;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Panel</title>
    <!-- <link rel="stylesheet" href="start.css"> -->
    <link rel="stylesheet" href="style.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row bg-black text-white">
       <div class="col-1">
       <img src="giphy.gif" width="80px"/>
       </div>
        <div class="col-11 my-auto">
                <h2>ONLINE VOTING SYSTEM - <small>Welcome <?php echo $_SESSION['username'] ; ?></small></h2>
            </div>
        
    </div>
   