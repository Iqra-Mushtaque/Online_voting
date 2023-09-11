<?php

include('header.php');
include('nav.php');

if(isset($_GET['homepage'])){
    include('voters/homepage.php');
}

if(isset($_GET['addelectionpage'])){
    include('voters/add_election.php');
}
else if(isset($_GET['addcandidatepage'])){
    include('voters/add_candidate.php');
}
else if(isset($_GET['viewresults'])){
    include('voters/viewresults.php');
}
?>

<?php

include('footer.php');

?>