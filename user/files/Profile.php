<?php
include "../update_data/config.php";

if (!isset($_SESSION['UserName'])) {
    header("Location: ../../index.php"); // Redirect to the login page if not logged in
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
		<i class=" bx bx-x icons" id="closeToggle"></i>
		<a href="#" class="brand"><img src="../../images/LOGO.png" alt="" class='bx icon'>RHU
		</a>
		<ul class="side-menu">
			<li><a href="../index.php" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li><a href="Appointment.php"><i class='bx bxs-calendar icon' ></i> Set Appointment</a></li>
			<li><a href="personal_record.php"><i class='bx bxs-receipt icon' ></i> Personal Record</a></li>
			<li><a href="Profile.php" class="active"><i class='bx bxs-user icon' ></i> Profile</a></li>
			<li><a href="Account_settings.php"><i class='bx bx-cog icon' ></i> Account Settings</a></li>
			<li><a href="#" class="logout"><i class='bx bx-log-out icon' ></i> Logout</a></li>


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
						echo '<img src="uploaded_img/'.$fetch['Profile'].'" class="profile-img" >';
				}
				?>					
				<ul class="profile-link">
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Account Profile</h1>
			<div class="data">
							<div class="profile-card">
							<?php if (isset($_GET['error'])) { ?>
                            <div class="container-error">
                            <div class="error">
    <div class="error__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"><path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path></svg>
    </div>
    <div class="error__title"><?php echo $_GET['error']; ?></div>
    <div class="error__close" id="closeErrorBtn"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div>
</div>
</div>

<script>
    // JavaScript to close the error message when the close button is clicked
    const closeErrorBtn = document.getElementById('closeErrorBtn');
    const errorContainer = document.querySelector('.error');

    closeErrorBtn.addEventListener('click', () => {
        errorContainer.style.display = 'none'; // Hide the error message
        // Remove the "error" query parameter from the URL
        const url = new URL(window.location.href);
        url.searchParams.delete('error');
        history.replaceState({}, document.title, url);
    });
</script>

     	           <?php } ?>
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="container-error">

                        <div class="info">
    <div class="info__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
            <path fill="#393a37" d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z"></path>
        </svg>
    </div>
    <div class="info__title"><?php echo $_GET['success']; ?></div>
    <div class="info__close" id="closeSuccessBtn">
        <svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg">
            <path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path>
        </svg>
    </div>
</div>
</div>


<script>
    // JavaScript to close the success message when the close button is clicked
    const closeSuccessBtn = document.getElementById('closeSuccessBtn');
    const infoContainer = document.querySelector('.info');

    closeSuccessBtn.addEventListener('click', () => {
        infoContainer.style.display = 'none'; // Hide the success message
        // Remove the "success" query parameter from the URL
        const url = new URL(window.location.href);
        url.searchParams.delete('success');
        history.replaceState({}, document.title, url);

        // Reload the page
        window.location.reload();
    });
</script>
     	           <?php } ?>
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
												echo '<img src="uploaded_img/'.$fetch['Profile'].'" class="profile-img" >';
											}
											?>	
										</div>
										
										<div class="user-details">
										<div class="input-boxes">
										  <span class="details">First Name</span>
										  <input name="fullname" type="text" value="<?php echo $_SESSION['FName'] ?>">
										</div>
										<div class="input-boxes">
										  <span class="details">Middle Name</span>
										  <input name="mname" type="text" value="<?php echo $_SESSION['MName'] ?>">
										</div>
										<div class="input-boxes">
										  <span class="details">Last Name</span>
										  <input name="lname" type="text" value="<?php echo $_SESSION['LName'] ?>">
										</div>
										<div class="input-boxes">
										  <span class="details">Username</span>
										  <input name="uname" type="text"  value="<?php echo  $_SESSION['UserName'] ?>">
										</div>
										<div class="input-boxes">
										  <span class="details">Barangay</span>
										  <input name="address" type="text"  value="<?php echo  $_SESSION['Address'] ?>">
										</div>
										<div class="input-boxes">
										  <span class="details">Phone Number</span>
										  <input name="number" type="text"  value="<?php echo  $_SESSION['Contact_num'] ?>">
										</div>
									  </div>
									<div class="gender-details">
										<span class="details">Profile Picture</span>
										<div class="container-img">
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