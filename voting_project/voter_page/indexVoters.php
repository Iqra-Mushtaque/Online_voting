<?php

include('header.php');
include('nav.php');
?>
<div class="row my-3">
    <div class="col-12">
        <h3>Voters Panel</h3>
            <?php
            $fetchingactiveelection= mysqli_query($conn, "SELECT * FROM elections WHERE status= 'Active'");
            $totalactiveelection = mysqli_num_rows($fetchingactiveelection);
            if($totalactiveelection > 0)
            {
                while($data = mysqli_fetch_assoc($fetchingactiveelection))
                {
                    $election_id = $data['id'];
                    $election_topic = $data['election_topic'];
                     ?>
                    <table class="table">
                    <thead>
                          <tr class= "bg-light">
                            <th colspan= "4" class="bg-light text-white"><h5>ELECTION TOPIC :<?php echo strtoupper($election_topic); ?></h5></th>
                           <tr>
                            </tr>
                                <th>Photo</th>
                                <th>Candidate Details</th>
                                <th># of votes</th>
                                <th>Action</th>
                            </tr>             
                    </thead>
                 <tbody>
                <?php
                   
                $fetchingcandidate = mysqli_query($conn, "SELECT * FROM candidate_details WHERE election_id = '$election_id'");

                while($candidatedata= mysqli_fetch_assoc($fetchingcandidate)){
                    $candidate_id = $candidatedata['id'];
                    $candidate_photo = $candidatedata['candidate_photo'];

                    $fetchingvotes = mysqli_query($conn, "SELECT * FROM voting WHERE candidate_id = '$candidate_id'") or die(mysqli_error($conn));
                    $totalvotes = mysqli_num_rows($fetchingvotes);
                    // "../".$candidatedata['candidate_photo']
                ?>
                    <tr>
                        <td><img src="<?php echo  "../".$candidate_photo;?>" class="candidate_photo"></td>
                        <td><?php echo"<b>" . $candidatedata['candidate_name'] . "</b><br>". $candidatedata['candidate_details'];  ?></td>
                        <td> <?php echo $totalvotes; ?></td>
                        <td>
                        <?php

                        $checkvotecasted = mysqli_query($conn, "SELECT * FROM voting WHERE voters_id = " . $_SESSION['user_id'] . " AND election_id = $election_id") or die(mysqli_error($conn));



                        $isvotecasted = mysqli_num_rows($checkvotecasted);
                       
                        if($isvotecasted > 0){
                            $votecastedData = mysqli_fetch_assoc($checkvotecasted);
                            $votecastedtoCandidate = $votecastedData['candidate_id'];

                            if($votecastedtoCandidate == $candidate_id){
                                ?>

                                <img src="vote.png" width="100px">
                            <?php
                            }
                            
                        }else{

                            ?>
                            <button class="btn-md btn-success" onclick = "castevote(<?php echo $election_id; ?>, <?php echo $candidate_id; ?>,<?php echo $_SESSION['user_id']; ?>)">Vote</button>


                        <?php
                        }

                        ?>
                        </td>
                    </tr>

                    <?php
                   }  
                    ?>              
                 </tbody>
               </table>
   
               <?php
                }
           
            }else{
                echo "No any active election";
            }

            ?>         
    </div>
</div>

<script>
    const castevote = (election_id, candidate_id, voters_id) => {
       $.ajax({
        type : "POST",
        url: "ajaxcalls.php",
        data: "e_id=" +election_id + "&c_id=" +candidate_id + "&v_id=" + voters_id,
        success: function(response){
           
            if(response== "success"){
                location.assign("indexVoters.php?voteCasted=1");
            }else{
                location.assign("indexVoters.php?votenotCasted=1");
            }
        }
       });
    }
</script>

<?php
include('footer.php');

?>
<script src="jquery.js"></script>