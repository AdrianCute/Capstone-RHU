<?php
include "update_data/config.php";

// session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: ../index.php"); // Redirect to the login page if not logged in
    exit();
}

// echo "Full Name: " . $_SESSION['FullName'] . "<br>";
// echo "Username: " . $_SESSION['UserName'] . "<br>";
// echo "Address: " . $_SESSION['Address'] . "<br>";

// Here you can fetch and display additional user-related data as needed

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>     
    <script  href="https://code.jquery.com/jquery-3.7.0.js"> </script>
    <script type="text/Javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"> </script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">    
	<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../../images/LOGO.png">


	<title>RHU</title>
</head>
<body>
<div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
        <div class="logout-full-card">
        <div class="logout-card">
        <div class="logout-header">
          <div class="logout-image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                      <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg></div>
          <div class="logout-content">
             <span class="logout-title">Logout account</span>
             <p class="logout-message">Are you sure you want to Logout? </p>
          </div>
           <div class="logout-actions">
             <a href="update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
            <a href=""> <button class="logout-cancel" type="button" data-dismiss="modal">Cancel</button></a>
          </div>
        </div>
        </div>
        </div>
    </div>
	<!-- SIDEBAR -->
	<section id="sidebar">
	<a href="#" class="brand"><img src="../../images/LOGO.png" alt="" class='bx icon'> RHU</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="../index.php" ><i class='bx bxs-calendar-plus icon' ></i> Appointments </a>
			</li>
			<li>
				<a href="../files/Pending Appointments.php" ><i class='bx bxs-receipt icon' ></i> Pending Appointments </a>
			</li>

			<li><a href="../files/Records.php"><i class='bx bxs-receipt icon' ></i> Records</a></li>
			<li><a href="../files/Rejected.php" ><i class='bx bxs-receipt icon' ></i> Rejected Appointments</a></li>

			<li>
				<a href="../files/profiling-all.php" ><i class='bx bxs-receipt icon' ></i> Profiling Records</a>
			</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-user-account icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown show">
					<li><a href="Profile.php" >Personal Information</a></li>
					<li><a href="#" class="active-now">Account Settings</a></li>
				</ul>
			</li>
			<li><a href="users.php"><i class='bx bxs-user icon' ></i> Users</a></li>
			<li class="divider" data-text="Action"></li>
			<li><a href="#" class="logout"><i class='bx bxs-log-out icon' ></i> Logout</a></li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- NAVBAR -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="#">
				<div class="form-group">
					
				</div>
			</form>
			
			<span class="divider"></span>
			<div class="profile">
			<?php
			 $select = mysqli_query($conn, "SELECT * FROM `users` WHERE Profile='".$_SESSION['Profile']."'");
			 if(mysqli_num_rows($select) > 0){
				   $fetch = mysqli_fetch_assoc($select);
				}
				?>
			<?php
				if($_SESSION['Profile'] == ''){
				echo '<img src="images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
				}
				?>							
				<ul class="profile-link">
					<li><a href="Profile.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="Account Settings.php"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Profile</h1>
				<div class="profile-cards">
				<div class="content">
					<form action="update_data/update_pass.php" method="POST">
			
					 
					<div class="user-details">
										<div class="input-box">
										  <span class="details">Current Password</span>
										  <input type="password" name="current" placeholder="Current Password" required>
										</div>
										<div class="input-box">
										  <span class="details">New Password</span>
										  <input type="password" name="newpass" placeholder="Enter New Password" required>
										</div>
										<div class="input-box">
										  <span class="details">Confirm Password</span>
										  <input type="password" name="confirm" placeholder="Confirm your password" required>
										</div>
									  </div>   
					  <div class="bt">
						<input type="submit" value="Change Password">
				
					  </div>
					  
					</form>
					</div>
				</div>				
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="../js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script>
    $(document).ready(function () {
        $('.logout').on('click', function () {
            $('#logoutmodal').modal('show');
        });
    });
</script>
</body>
</html>