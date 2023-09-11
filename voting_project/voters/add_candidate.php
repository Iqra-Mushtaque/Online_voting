<link rel="stylesheet" href="style.css">
<?php
if(isset($_GET['added'])){

?>
    <div class="alert alert-success" role="alert">
    Candidate has been added successfully!
    </div>
<?php
}else if(isset($_GET['largefile'])){
?>
<div class="alert alert-danger my-3" role="alert">
    Candidate image is too large, please upload small file (you can't upload any image upto 2mbs.) 
</div>
<?php
}else if(isset($_GET['invalidfile'])){
    ?>
    <div class="alert alert-danger my-3" role="alert">
   Invalid image type(Only .jpg, png files are allowed)
</div>
    <?php
}else if(isset($_GET['failed'])){
    ?>
    <div class="alert alert-danger my-3" role="alert">
   Image uploading failed, please try again.
</div>
    <?php
}
?>
<div class="row">
    <div class="col-4 my-3">
        <h3>Add New Candidates</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group my-3">
                <select class="form-control" name="election_id" required>
                    <option value="">Select Election</option>
                    <?php
                $fetching_election= mysqli_query($conn,"SELECT * FROM elections")or die(mysqli_error($conn));
                $ifelectionadded = mysqli_num_rows($fetching_election);
                if($ifelectionadded > 0){
                    while($row = mysqli_fetch_assoc($fetching_election)){
                        $election_id = $row['id'];
                        $election_name = $row['election_topic'];
                        $allowedcandidates = $row['no_of_candidates'];
                        $fetchingcandidate = mysqli_query($conn, "SELECT * FROM candidate_details WHERE election_id = '$election_id'");
                        $added_candidates = mysqli_num_rows($fetchingcandidate);


                        if($added_candidates> $allowedcandidates){
                    ?>
                    <option value="<?php echo $election_id;?>"><?php echo $election_name;?></option>
                    <?php
                        }
                        }
                        ?>
                        <option value="<?php echo $election_id;?>"><?php echo $election_name; ?></option>
                        <?php
                          }
                        else{
                            ?>
                                <option value="">Please add election first</option>
                            <?php
                        }
                        ?>
                </select>
            </div>
            <div class="form-group my-3">
                <input type="text" name="candidate_name" placeholder="Candidate Name" class="form-control" required/>
            </div>
            <div class="form-group my-3">
                <input type="file" name="candidate_photo" class="form-control" required/>
            </div>
            <div class="form-group my-3">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control" required/>
            </div>
            <input type="submit" value="Add Candidate" name="addcandidatebtn" class="btn btn-success">
        </form>
    </div>
   <div class="col-8 my-3">
    <h3>Candidate Details</h3>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">Photo</th>
      <th scope="col">Name</th>
      <th scope="col">Details</th>
      <th scope="col">Election</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $fetching_data = mysqli_query($conn, "SELECT * FROM candidate_details") or die(mysqli_error($conn));
    $ifcandidateadded = mysqli_num_rows($fetching_data);

        if($ifcandidateadded > 0){
                $sno=1;
            while($row= mysqli_fetch_assoc($fetching_data)){
                $election_id= $row['election_id'];
                $fetchingelectionname = mysqli_query($conn, "SELECT * FROM elections WHERE id = '$election_id'");
                $execufetchingname = mysqli_fetch_assoc($fetchingelectionname);
                $election_name = $execufetchingname['election_topic'];

                $candidate_photo= $row['candidate_photo']; 
                ?>
            <tr>
                <td><?php echo $sno++; ?></td>
                <td><img src="<?php echo $candidate_photo; ?>" class="candidate_photo"></td>
                <td><?php echo $row['candidate_name']; ?></td>
                <td><?php echo $row['candidate_details']; ?></td>
                <td><?php echo $election_name; ?></td>
               <td>
                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                <a href="#" class="btn btn-sm btn-danger">Delete</a>
               </td>
            </tr>

<?php
}

    }else{
?>
        <tr>
            <td colspan= "7"> No any candidate is added yet.</td>
        </tr>

<?php

    }

?>
  </tbody>
</table>

   </div>
</div>


<?php
if(isset($_POST['addcandidatebtn'])){
    $election_id = mysqli_real_escape_string($conn, $_POST['election_id']);
    $candidate_name = mysqli_real_escape_string($conn, $_POST['candidate_name']); 
    $candidate_details = mysqli_real_escape_string($conn, $_POST['candidate_details']);
    $inserted_by = $_SESSION['username'];
    $inserted_on = date("Y-m-d");

//Picture added here
$targetted_folder = "Images/candidate_photo/";
$candidate_photo = $targetted_folder.$_FILES['candidate_photo']['name'];
$candidate_photo_tmp_name = $_FILES['candidate_photo']['tmp_name'];
$candidate_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
$allowed_types = array("jpg", "png", "jpng");
$image_size = $_FILES['candidate_photo']['size'];

    if($image_size < 2000000){
    
        if(in_array($candidate_photo_type, $allowed_types)){

            if(move_uploaded_file($candidate_photo_tmp_name, $candidate_photo)){
                
                mysqli_query($conn,"INSERT INTO `candidate_details` (`election_id`, `candidate_name`, `candidate_details`, `candidate_photo`, `inserted_by`, `inserted_on`) VALUES ('$election_id', '$candidate_name', '$candidate_details','$candidate_photo', '$inserted_by', '$inserted_on')");

                echo "<script> location.assign('index.php?addcandidatepage=1&added=1');</script>";

            }else
            {
                echo "<script> location.assign('index.php?addcandidatepage=1&failed=1');</script>";
            }
        }else
        {
            echo "<script> location.assign('index.php?addcandidatepage=1&invalidfile=1');</script>";
        }
    }else{
        echo "<script> location.assign('index.php?addcandidatepage=1&largefile=1');</script>";
    }

        die;

    ?>
    <script>location.assign("index.php?addelectionpage=1&added=1");</script>

    <?php
    }

?>