<?php
include('partials/connection.php');
$fetchingelections = mysqli_query($conn,"SELECT * FROM elections") or die(mysqli_error($conn));
while($data = mysqli_fetch_assoc($fetchingelections)){

	$starting_date = $data['starting_date'];
	$ending_date = $data['ending_date'];
	$curr_date = date("Y-m-d");
	$election_id = $data['id'];
	$status = $data['status'];

	if($status =="Active"){

		$date1=date_create($curr_date);
    $date2=date_create($ending_date);
    $diff=date_diff($date1,$date2);

    if((int)$diff->format("%R%a days") < 0){
    //    $status ="Inactive";
	//    echo "Expired";
	mysqli_query($conn, "UPDATE elections SET status = 'Expired' WHERE id = $election_id") or die(mysqli_error($conn));
    }
	// else{
    //     $status ="Active";
    // }    

	}else if($status == "Inactive"){

		$date1=date_create($curr_date);
    $date2=date_create($starting_date);
    $diff=date_diff($date1,$date2);


    if((int)$diff->format("%R%a days") <= 0){
    //    $status ="Inactive";
	//    echo "Active";

	mysqli_query($conn, "UPDATE elections SET status = 'Active' WHERE id = $election_id") or die(mysqli_error($conn));

    }else{
        $status ="Active";
    }    
	}
	
}


?>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="start.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="jquery.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="giphy.gif" class="brand_logo" alt="Logo">
					</div>
				</div>

				<?php
				
					if(isset($_GET['signup'])){
				?>
				
						<div class="d-flex justify-content-center form_container">
							<form method="POST">
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" name="s_username" class="form-control input_user" placeholder="Username" required/>
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-user"></i>
										</span>
									</div>
									<input type="text" name="s_contact" class="form-control input_pass"  placeholder="Contact#" required/>
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" name="s_password" class="form-control input_pass"  placeholder="Password" required/>
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" name="s_retype" class="form-control input_pass"  placeholder="Retype Password" required/>
								</div>
								
									<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" name="signup_btn" class="btn login_btn">Sign Up</button>
						</div>
							</form>
						</div>
				
						<div class="mt-4">
							<div class="d-flex justify-content-center links text-white">
								Already have account? <a href="start.php" class="ml-2">Sign In</a>
							</div>
						</div>
				
				<?php
					}else{
				?>	
		<div class="d-flex justify-content-center form_container">
							<form method="POST">
								<div class="input-group mb-3">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-user"></i></span>
									</div>
									<input type="text" name="contact" class="form-control input_user" placeholder="Contact" required/>
								</div>
								<div class="input-group mb-2">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-key"></i></span>
									</div>
									<input type="password" name="password" class="form-control input_pass" placeholder="Password" required/>
								</div>
								
									<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" name="login_btn" class="btn login_btn">Login</button>
						</div>
							</form>
						</div>
				
						<div class="mt-4">
							<div class="d-flex justify-content-center links text-white">
								Don't have an account? <a href="?signup" class="ml-2">Sign Up</a>
							</div>
							<div class="d-flex justify-content-center links">
								<a href="#">Forgot your password?</a>
							</div>
						</div>

					<?php
					}
					?>		
					
					

						<?php
							if(isset($_GET['registered'])){
						?>
							<span class="bg-white text-success text-center my-3">Your account has been created successfully!</span>

						<?php
							}else if(isset($_GET['invalid'])){
								
							?>
							<span class="bg-white text-danger text-center my-3">Passwords are not matched.Try again!</span>					
							<?php
							}
							else if(isset($_GET['not_registered'])){
								
								?>
								<span class="bg-white text-warning text-center my-3">Sorry, you are not registered</span>					
								<?php
								}
								else if(isset($_GET['invalid_access'])){
								
									?>
									<span class="bg-white text-danger text-center my-3">Invalid username or password</span>					
									<?php
									}
					?>
			</div>
		</div>
	</div>
</body>
</html>

<?php
include ('partials/connection.php');

	if(isset($_POST['signup_btn'])){
		$s_username= mysqli_real_escape_string($conn, $_POST['s_username']);
		$s_contact= mysqli_real_escape_string($conn, $_POST['s_contact']);
		$s_password= mysqli_real_escape_string($conn, sha1($_POST['s_password']));
		$s_retype= mysqli_real_escape_string($conn, sha1($_POST['s_retype']));
		$user_role= "voter";

			if($s_password==$s_retype){
				// mysqli_query($conn,"INSERT INTO users(username, contact, password, user_role) VALUES('".$s_username."','".$s_contact."','".$s_password."','".$s_retype."','".$user_role."')") or (mysqli_error($conn));
				
				mysqli_query($conn,"INSERT INTO `users` (`username`, `contact`, `password`, `user_role`) VALUES ('$s_username', '$s_contact', '$s_password', '$user_role');");
				
				// header("start.php?signup&registered");
			?>
			<script>location.assign("start.php?&registered");</script>
			<?php

			}else{
				// header("start.php?signupinvalid");
				?>
				<script>location.assign("start.php?&invalid");</script>
			<?php
			}
		}else if(isset($_POST['login_btn'])){
			$contact= mysqli_real_escape_string($conn, $_POST['contact']);
			$password= mysqli_real_escape_string($conn, sha1($_POST['password']));
			$myquery = "SELECT * FROM `users` WHERE contact = $contact;";
			// echo $myquery;
			// echo "welcome";
			$fetching_data= mysqli_query($conn,$myquery)or die(mysqli_error($conn));
			// $data= mysqli_fetch_assoc($fetching_data);
			// echo $data['username'];

			if(mysqli_num_rows($fetching_data)>0){

			$data= mysqli_fetch_assoc($fetching_data);
			// echo $data['username'];
//AND $password==$data['password']
				if($contact==$data['contact'])
					{
						session_start();
						$_SESSION['user_role']=$data['user_role'];
						$_SESSION['username']=$data['username'];
						$_SESSION['user_id']=$data['id'];
						$sessionuseerid = $_SESSION['user_id'];

						if($data['user_role']=="Admin")
						{
							$_SESSION['key'] = "Adminkey";

						?>
						<script>location.assign("index.php?homepage=1");</script>

						<?php

						}
						else{
							$_SESSION['key'] = "Voterskey";
						?>
						
						<script>location.assign("voter_page/indexVoters.php");</script>
						
						<?php
						}
					}
					else{
					?>
					<script>location.assign("start.php?&invalid_access");</script>
					
					<?php
					}
				}
				else{
				?>
				<script>location.assign("start.php?&not_registered");</script>

			<?php
		}
	}

	?>