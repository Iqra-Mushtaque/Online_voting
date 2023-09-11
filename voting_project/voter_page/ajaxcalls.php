<?php

include('../partials/connection.php');

if(isset($_POST['e_id']) AND isset($_POST['c_id']) AND isset($_POST['v_id'])){

    $vote_date= date("Y-m-d");
    $vote_time= date("h:i:s a");


    $e_id = $_POST['e_id'];
    $v_id = $_POST['v_id'];
    $c_id = $_POST['c_id'];

    $query = "INSERT INTO `voting` (`election_id`, `voters_id`, `candidate_id`, `vote_date`, `vote_timing`) VALUES('$e_id', '$v_id', '$c_id', '$vote_date', '$vote_time')";

mysqli_query($conn, $query) or die(mysqli_error($conn));

echo "success";
}

?>








