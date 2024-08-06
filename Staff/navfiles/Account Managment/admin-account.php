<?php

include "update_data/config.php";

// session_start();

if (!isset($_SESSION['Usertype']) || $_SESSION['Usertype'] !== 'Admin') {
    header("Location: ../../../index.php"); // Redirect to the login page if not logged in
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
	<link rel="icon" href="../../../images/LOGO.png">


</head>
<body>
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="full-container-box">
		<div class="container-box">
                      <div class="title" >Registration</div>
                      <div class="content">
                        <form action="update_data/add_user.php" method="POST" enctype="multipart/form-data">
                          <div class="user-detail">
                            <div class="input-boxes">
                              <span class="details">First Name</span>
                              <input type="text"  name="fname" placeholder="Enter your First Name" required>
                            </div>
							<div class="input-boxes">
                              <span class="details">Middle Name</span>
                              <input type="text" name="mname" placeholder="Enter your Middle Name" required>
                            </div>
							<div class="input-boxes">
                              <span class="details">Last Name</span>
                              <input type="text" name="lname" placeholder="Enter your Last Name" required>
                            </div>
							<div class="input-boxes">
                              <span class="details">Birthday</span>
                              <input type="date" name="bday" placeholder="Enter your name" required>
                            </div>
							<div class="input-boxes">
                              <span class="details">User Type</span>
                              <select name="utype" placeholder="Enter User Type" required>
								<option >Select User Type</option>
								<option value="User">User</option>
								<option value="Staff">Staff</option>
								<option value="Barangay">Barangay</option>
								<option value="Dental">Dental</option>

							  </select>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Username</span>
                              <input type="text" name="uname" placeholder="Enter your username" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Barangay</span>
                              <select type="text" name="address" placeholder="Enter your Address"  required>
							  <option disabled selected>Select Barangay</option>
            <option>Adiangao</option>
            <option>Bagacay</option>
            <option>Bahay</option>
            <option>Boclod</option>
            <option>Calalahan</option>
            <option>Calawit</option>
            <option>Camagong</option>
            <option>Catalotoan</option>
            <option>Danlog</option>
            <option>Del Carmen</option>
            <option>Dolo</option>
            <option>Kinalansan</option>
            <option>Mampirao</option>
            <option>Manzana</option>
            <option>Minoro</option>
            <option>Palale</option>
            <option>Ponglon</option>
            <option>Pugay</option>
            <option>Sabang</option>
            <option>Salogon</option>
            <option>San Antonio</option>
            <option>San Juan</option>
            <option>San Vicente</option>
            <option>Santa Cruz</option>
            <option>Soledad</option>
            <option>Tagas</option>
            <option>Tambangan</option>
            <option>Telegrapo</option>
            <option>Tominawog</option>
							  </select>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Phone Number</span>
                              <input type="text" name="number" placeholder="Enter your number" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Password</span>
                              <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Confirm Password</span>
                              <input type="password" name="confirm" placeholder="Confirm your password" required>
                            </div>
                          </div>
						
						  <div class="profiling-action">
                        <button type="submit" name="updatedata" class="export">Add Account </button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>

                    </div>
                        </form>
                      </div>
                    </div>
			</div>
        </div>
		</div>
</div>

<div class="modal fade" id="backupmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="full-container-box">
		<div class="container-box">
                      <div class="title" >Backup database</div>
                      <div class="content">
                        <form action="update_data/database_backup.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="update_user" id="update_request">

						<div class="user-detail">
						<div class="input-boxes">
                              <span class="details">Host</span>
                              <input type="text" placeholder="Enter Server Name EX: Localhost" name="server"
                           id="server" required>
                            </div>
							<div class="input-boxes">
                              <span class="details">User Name</span>
                              <input type="text"  placeholder="Enter Database Username EX: root" name="username"
                              id="username" >
                            </div>
							<div class="input-boxes">
                              <span class="details">Password</span>
                              <input type="password" class="form-control" placeholder="Enter Database Password" name="password"  id="password">
                            </div>
							<div class="input-boxes">
                              <span class="details">Database Name</span>
                              <input type="text" placeholder="Enter Database Name" name="dbname" id="dbname" required>
                            </div>
                        
                          
                          </div>
						  <div class="profiling-action">
                        <button type="submit" name="backupnow" class="export">Back-up now </button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>

                    </div>
                        </form>
                      </div>
                    </div>
			</div>
        </div>
		</div>
</div>
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
	<a href="#" class="brand"><img src="../../../images/LOGO.png" alt="" class='bx icon'> RHU</a>
		<ul class="side-menu">
		<li><a href="../../index.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#" ><i class='bx bxs-receipt icon' ></i> Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li ><a href="../Records/Profiling/profiling-all.php">Profiling</a></li>
					<li ><a href="../Records/checkup/checkup-all.php">Checkup</a></li>
					<li><a href="../Records/OTP/OTP-all.php">OTP</a></li>
					<li><a href="../Records/Immunization/Immunization-all.php">Immunization</a></li>
					<li><a href="../Records/Vaccination/vaccination-all.php">Vaccination</a></li>
					<li><a href="../Records/Senior/senior-all.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-receipt icon' ></i> Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li ><a href="../Records/profiling-choices.php" >Profiling</a></li>
					<li ><a href="../Records/checkup-choices.php" >Checkup</a></li>
					<li><a href="../Records/OTP-choices.php">OTP</a></li>
					<li><a href="../Records/Immunization-choices.php">Immunization</a></li>
					<li><a href="../Records/vaccination-choices.php" >Vaccination</a></li>
					<li><a href="../Records/senior-choices.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-user-account icon'></i>Account Management<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown show">
					<li><a href="users.php" >Patient Accounts</a></li>
					<li><a href="admin-account.php" class="active-now active" >Admin Accounts</a></li>
					<li><a href="Dental-Accounts.php">Dental Accounts</a></li>
					<li><a href="Barangay-accounts.php" >Barangay Accounts</a></li>
					<li><a href="Staff.php">Staff Accounts</a></li>
								<li><a href="logs.php">System Logs</a></li>


				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-user icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="Profile.php" >Personal Information</a></li>
					<li><a href="Account Settings.php">Account Settings</a></li>
				</ul>
			</li>
			<li><a href="../../navfiles/Records/search.php"><i class='bx bx-search-alt-2 icon'></i>Search Information</a></li>
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
			<!-- <a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a> -->
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
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Admin</h1>
			<div class="info-data">
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Admin Account</h3>
						<div class="menu">
						<?php if (isset($_GET['error'])) { ?>
                            <div class="error">
    <div class="error__icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"><path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path></svg>
    </div>
    <div class="error__title"><?php echo $_GET['error']; ?></div>
    <div class="error__close" id="closeErrorBtn"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div>
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
						</div>
					</div>
					<div class="table-container">
					<div class="reg">
					<button  class="add backup" id="backupButton" >Back up database</button>

                        <button  class="add adduser">Add Account</button>

				


					</div>
							<div class="table-wrapper">
						<table  id="myTable" class="emp-table">
							<thead>
								<tr>
								<th col-index = 1>Full Name</th>
								<th col-index = 2>User Name</th>
								<th col-index = 3>Address</th>
								<th col-index = 4>Phone Number</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
								LEFT JOIN user_information ui ON u.User_ID = ui.User_ID 
								LEFT JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
								LEFT JOIN address_information ai ON ui.Record_ID = ai.Record_ID
								WHERE UserType='Admin'";
														
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									?>
								  <tr>
								  <td><?php echo $row["FName"].' '.$row["MName"].' '.$row["LName"] ?></td>
								    <td><?php echo $row["UserName"] ?></td>
								    <td><?php echo $row["Barangay"] ?></td>
								    <td><?php echo $row["contact_num"] ?></td>
								  
								  </tr>
								<?php
								 }
								 ?>
							</tbody>
							<script src="../js/filter.js"></script>
						</table>
						<script>let table = new DataTable('#myTable');
						</script>
						<script>
							window.onload = () => {
								console.log(document.querySelector(".emp-table > tbody > tr:nth-child(1) > td:nth-child(2) ").innerHTML);
							};
					
							getUniqueValuesFromColumn()
							
						</script>
						</div>
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

<script>
        $(document).ready(function () {

            $('.adduser').on('click', function () {

                $('#add_user').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

				$('#approve_id').val(recordId);

				
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.backup').on('click', function () {

                $('#backupmodal').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

				$('#approve_id').val(recordId);
				
            });
        });
    </script>
</body>
</html>