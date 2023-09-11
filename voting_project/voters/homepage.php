<div class="row">   
    </div>
   <div class="col-12 my-3">
    <h3>Elections</h3>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">Election Name</th>
      <th scope="col"># Candidates</th>
      <th scope="col">Starting Date</th>
      <th scope="col">Ending Date</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $fetching_data = mysqli_query($conn, "SELECT * FROM elections") or die(mysqli_error($conn));
    $ifelectionadded = mysqli_num_rows($fetching_data);

    if($ifelectionadded > 0){
        $sno=1;
while($row= mysqli_fetch_assoc($fetching_data)){

  $election_id = $row['id'];


    ?>
            <tr>
                <td><?php echo $sno++; ?></td>
                <td><?php echo $row['election_topic']; ?></td>
                <td><?php echo $row['no_of_candidates']; ?></td>
                <td><?php echo $row['starting_date']; ?></td>
                <td><?php echo $row['ending_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
               <td>
                <a href="index.php?viewresults=<?php echo $election_id; ?>" class="btn btn-sm btn-success">View Results</a>
              
               </td>
            </tr>

<?php
}

    }else{
?>
        <tr>
            <td colspan= "7"> No any elaction is added yet.</td>
        </tr>

<?php

    }

?>
  </tbody>
</table>

   </div>
</div>


<?php
