<?php
include "update_data/config.php";

// session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: ../../../index.php"); // Redirect to the login page if not logged in
    exit();
}

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
					<li><a href="#" class="active-now">Personal Information</a></li>
					<li><a href="Account Settings.php">Account Settings</a></li>
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
				<div class="profile-link">
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Profile</h1>
			<div class="data">
				<div class="content-data">
							<div class="title">Personal Information</div>
							<div class="profile-card">
								<div class="content">
									<form action="Update_data/update_profile.php" method="POST" enctype="multipart/form-data" >
										<div class="image">
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
										</div>
										<div class="user-details">
										<div class="input-box">
										  <span class="details">First Name</span>
										  <input name="fullname" type="text" value="<?php echo $_SESSION['FName'] ?>">
										</div>
										<div class="input-box">
										  <span class="details">Middle Name</span>
										  <input name="mname" type="text" value="<?php echo $_SESSION['MName'] ?>">
										</div>
										<div class="input-box">
										  <span class="details">Last Name</span>
										  <input name="lname" type="text" value="<?php echo $_SESSION['LName'] ?>">
										</div>
										<div class="input-box">
										  <span class="details">Username</span>
										  <input name="uname" type="text"  value="<?php echo  $_SESSION['UserName'] ?>">
										</div>
										<div class="input-box">
										  <span class="details">Barangay</span>
										  <input name="address" type="text"  value="<?php echo  $_SESSION['Address'] ?>">
										</div>
										<div class="input-box">
										  <span class="details">Phone Number</span>
										  <input name="number" type="text"  value="<?php echo  $_SESSION['Contact_num'] ?>">
										</div>
									  </div>
									<div class="gender-details">
										<span class="details">Profile Picture</span>
										<div class="container-imges">
										  		<div class="img-area" data-img="">
												<i class='bx bxs-cloud-upload icon'></i>
												<h3>Upload Image</h3>
												<p>Image size must be less than <span>2MB</span></p>
										  	</div>
											  <label for="file" class="custom-file-input add">Choose Image</label>
										  	<input name="image" type="file" id="file" accept="image/*" class="select-image" hidden>
										</div>   
											<script>
												// Get the file input element and the container img element
												const fileInput = document.getElementById("file");
												const imgArea = document.querySelector(".img-area");
												// Add an event listener to the file input
												fileInput.addEventListener("change", function(event) {
													    const selectedFile = event.target.files[0];
													    if (selectedFile) {
													        const reader = new FileReader();
													        // When the reader has loaded the image, display it in the imgArea
													        reader.onload = function() {
													            imgArea.innerHTML = `
													                <img src="${reader.result}" alt="Uploaded Image">
												                <p>${selectedFile.name}</p>
												            `;
											        };
												        reader.readAsDataURL(selectedFile);
											    }
											});

											</script>
									</div>
									  <div class="bt">
										<input type="submit" value="Update">
										
									  </div>
									  
									</form>
							
								  </div>
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