<?php
include "update_data/config.php";

if (!isset($_SESSION['Usertype']) || $_SESSION['Usertype'] !== 'Staff') {
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
	<link rel="icon" href="../../../images/LOGO.png">


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
	<a href="#" class="brand"><img src="../../../images/LOGO.png" alt="" class='bx icon'></i> RHU</a>
		<ul class="side-menu">
			<li><a href="../../index.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#" ><i class='bx bxs-receipt icon' ></i> Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown ">
					<li ><a href="Profiling/profiling-all.php" >Profiling</a></li>
					<li ><a href="checkup/checkup-all.php">Checkup</a></li>
					<li><a href="OTP/OTP-all.php">OPT</a></li>
					<li><a href="Immunization/Immunization-all.php">Immunization</a></li>
					<li><a href="vaccination/vaccination-choices.php">Vaccination</a></li>
					<li><a href="Senior/senior-all.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-receipt icon' ></i> Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown show">
					<li ><a href="profiling-choices.php">Profiling</a></li>
					<li><a href="checkup-choices.php">Checkup </a></li>
					<li><a href="OTP-choices.php" class="active-now active">OPT</a></li>
					<li><a href="Immunization-choices.php">Immunization</a></li>
					<li><a href="vaccination-choices.php" >Vaccination</a></li>
					<li><a href="senior-choices.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
	
			<li>
				<a href="#"><i class='bx bxs-user icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="../Account Managment/Profile.php" >Personal Information</a></li>
					<li><a href="../Account Managment/Account Settings.php">Account Settings</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-user icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="../Account Managment/Profile.php" >Personal Information</a></li>
					<li><a href="../Account Managment/Account Settings.php">Account Settings</a></li>
				</ul>
			</li>
			<li><a href="search.php"><i class='bx bx-search-alt-2 icon'></i>Search Information</a></li>
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
				echo '<img src="../Account Managment/images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="../Account Managment/uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
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
			<h1 class="title">Record</h1>
			<div class="info-data">
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Operation Timbang Program</h3>
						<div class="menu">
							<i class='bx bx-dots-horizontal-rounded icon'></i>
							<ul class="menu-link">
								<li><a href="#">Edit</a></li>
								<li><a href="#">Save</a></li>
								<li><a href="#">Remove</a></li>
							</ul>
						</div>
					</div>
					<div class="table-wrapper">
						<table  id="myTable" class="emp-table">
							<thead>
								<tr>
								<th col-index = 1>Barangay</th>
								<th col-index = 2>Action</th>   
								<th col-index = 2>Status</th>   

							</tr>
							</thead>
							<tbody>
							<tr>
									<td>Adiangao</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Adiangao" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Bagacay</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Bagacay" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Bahay</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Bahay" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Boclod</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Boclod" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Calalahan</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Calalahan" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Calawit</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Calawit" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Camagong</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Camagong" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Catalotoan</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Catalotoan" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Danlog</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Danlog" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Del Carmen</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Del Carmen" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Dolo</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Dolo" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Kinalansan</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Kinalansan" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Mampirao</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Mampirao" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Manzana</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Manzana" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Minoro</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Minoro" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Palale</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Palale" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Ponglon</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Ponglon" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Pugay</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Pugay" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Sabang</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Sabang" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Salogon</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Salogon" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>San Antonio</td>
									<td>
										<form action="Profiling/Profiling.php" method="post">
											<button type="submit" name="address" 
										value="San Antonio" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>San Juan</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="San Juan" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>San Vicente</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="San Vicente" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Santa Cruz</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Santa Cruz" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Soledad</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Soledad" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Tagas</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Tagas" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Tambangan</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Tambangan" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Telegrapo</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Telegrapo" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>
								<tr>
									<td>Tominawog</td>
									<td>
									<form action="OTP/OTP.php" method="post">
											<button type="submit" name="address" 
										value="Tominawog" class="btnnn">View</button>
									</form></td>
										<td>Active</td>
								</tr>	
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