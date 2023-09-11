<?php

$election_id =$_GET['viewresults'];

?>
<div class="row my-3">
    <div class="col-12">
        <h3>Election Results</h3>
            <?php
            $fetchingactiveelection= mysqli_query($conn, "SELECT * FROM elections WHERE id = '$election_id'");
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
                                <!-- <th>Action</th> -->
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
            <hr>
            <h3>Voting Details</h3>
                <?php
                $fetchingvotingdetails = mysqli_query($conn, "SELECT * FROM voting WHERE election_id ='$election_id'");
                $num_of_votes = mysqli_num_rows($fetchingvotingdetails);

                if($num_of_votes > 0){
                    
                    $sno =1;
                    ?>
                     <table class="table">
                <tr>
                    <th>S.No</th>
                    <th>Voter Name</th>
                    <th>Contact No</th>
                    <th>Voted to</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>




                    <?php
                    while($data = mysqli_fetch_assoc($fetchingvotingdetails)){

                        $voters_id = $data['voters_id'];
                        $candidate_id = $data['candidate_id'];
                        $fetchingusername = mysqli_query($conn, "SELECT * FROM users WHERE id= $voters_id")or die(mysqli_error($conn));
                        $isdataavailable = mysqli_num_rows($fetchingusername);
                        $userdata = mysqli_fetch_assoc($fetchingusername);
                        if($isdataavailable >0){
                           
                            $username = $userdata['username'];
                            $contact_no = $userdata['contact'];
                        }else{

                            $username = "No_Data";
                            $contact_no = $userdata['contact'];

                        }

                        $fetchingcandidatename = mysqli_query($conn, "SELECT * FROM candidate_details WHERE id= $candidate_id")or die(mysqli_error($conn));
                        $isdataavailable = mysqli_num_rows($fetchingcandidatename);
                        $candidatedata = mysqli_fetch_assoc($fetchingcandidatename);
                        if($isdataavailable >0){
                            $candidate_name = $candidatedata['candidate_name'];
                            $contact_no = $userdata['contact'];
                        }else{

                            $candidate_name = "No_Data";
                            

                        }

                        

                        ?>
                        
                        <tr>
                            <td> <?php echo $sno++;  ?></td>
                            <td><?php echo $username;  ?></td>
                            <td><?php echo $contact_no; ?></td>
                            <td><?php echo $candidate_name;  ?></td>
                            <td><?php echo $data['vote_date'] ?></td>
                            <td><?php echo $data['vote_timing'] ?></td>
                        </tr>
<?php

                    }
                    echo "</table>";
                }else{
                    echo "no any vote detail is available";
                }



?>
            </table>
    </div>
</div>
