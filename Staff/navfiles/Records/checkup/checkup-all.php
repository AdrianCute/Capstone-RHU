<?php

include "../../Account Managment/update_data/config.php";

if (!isset($_SESSION['Usertype']) || $_SESSION['Usertype'] !== 'Staff') {
    header("Location: ../../../../index.php"); // Redirect to the login page if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- Include DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Include DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">    
	<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>    
	<link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../../../images/LOGO.png">

	

	<title>RHU</title>
</head>
<body>
 
<div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="profiling-container">
		    		    <div class="profiling-closes" data-dismiss="modal"><i class='bx bx-x icon'></i></div>

                    <header>Check up</header>
                   <form action="../update_data/update_checkup.php" method="POST">
                       <div class="profiling-form first">
                           <div class="profiling-details personal">
                               <span class="profiling-title">Personal Details</span>
                               <div class="profiling-fields">
                                   <div class="profiling-input-field">
                                       <label> Family Serial Number</label>
                                       <input type="text" id="serial" name="srnums" placeholder="Enter Family Serial Number" disabled>
                                   </div>
								   <input type="hidden" name="update_id" id="view_id" disabled>
                                   <div class="profiling-input-field">
     <label>Lastname</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="lnames" name="lname" placeholder="Enter Lastname" disabled>
    </div>                             <div class="profiling-input-field">
     <label>Firstname</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="fnames" name="fname" placeholder="Enter Firstname" disabled>
    </div>

    <div class="profiling-input-field">
     <label>Middlename</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="mnames" name="mname" placeholder="Enter Middlename" disabled>
    </div>
           
           
                                   <div class="profiling-input-field">
                                       <label>Birthdate</label>
                                       <input type="date" id="bdays" name="birthday" placeholder="Enter Birthdate" disabled>
                                   </div>
                                   <div class="profiling-input-field">
                                       <label>Sex</label>
                                       <select name="sexs" id="sex" disabled>
                                           <option disabled selected>Select Sex</option>
                                           <option>M</option>
                                           <option>F</option>
                                       </select>
                                   </div>
                                   <div class="profiling-input-field">
        <label>Barangay</label>
        <select name="address" id="addresss" disabled>
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
                                   <div class="profiling-input-field">
                                       <label>Medical History</label>
                                       <input type="text" oninput="capitalizeFirstLetter(this)" id="historys" name="history" placeholder="Enter Medical History" disabled>
									</div>                            
                                   <div class="profiling-input-field">
                                       <label>HH_Head</label>
                                       <input type="text" oninput="capitalizeFirstLetter(this)" id="heads" name="hhhead" placeholder="Enter HH_Head" disabled>
                                   </div>
									<div class="profiling-input-field">
                                       <label>Classification</label>
                                       <select name="classification" id="classifications" disabled>
                                           <option disabled selected>Select Classification</option>
                                           <option>NHTS</option>
                                           <option>None NHTS</option>
										   <option>NHTS Poor</option>
                                       </select>
                                   </div>
                                       <div class="profiling-input-field">
                                           <label>Philhealth Number</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="philhealths" name="philhealth" placeholder="Enter Philhealth Number" disabled>
                                       </div>
                                      
                                       <div class="profiling-input-field">
                                           <label>Contact Number</label>
                                           <input type="text" id="numbers" name="number" placeholder="Enter Contact Number" disabled>
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>PWD (Specific)</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="pwds" name="pwd" placeholder="Enter PWD (Specificify) " disabled>
                                       </div>
                                      
                                       <div class="profiling-input-field">
                                           <label>Date</label>
                                           <input type="date" id="dates" name="date" placeholder="Enter Date" disabled>
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>VS Chief Complaint</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="complaints" name="complaint" placeholder="Enter Complaint" disabled>
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>Diagnosis</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="diagnosiss" name="diagnosis" placeholder="Enter Diagnosis" disabled>
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>Treatment</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="treatments" name="treatment" placeholder="Enter Treatment" disabled>
                                       </div>             
                               </div>
                           </div>
					
                       </div>
                   </form>
			</div>
		
</div>   

<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="profiling-container">
                    <header>Check up</header>
                   <form action="../update_data/update_checkup.php" method="POST">
                       <div class="profiling-form first">
                           <div class="profiling-details personal">
                               <span class="profiling-title">Personal Details</span>
                               <div class="profiling-fields">
                                   <div class="profiling-input-field">
                                       <label> Family Serial Number</label>
                                       <input type="text" id="serial" name="srnum" placeholder="Enter Family Serial Number" >
                                   </div>
								   <input type="hidden" name="update_id" id="update_id">
                                   <div class="profiling-input-field">
     <label>Lastname</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="lname" name="lname" placeholder="Enter Lastname">
    </div>                             <div class="profiling-input-field">
     <label>Firstname</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="fname" name="fname" placeholder="Enter Firstname">
    </div>

    <div class="profiling-input-field">
     <label>Middlename</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="mname" name="mname" placeholder="Enter Middlename">
    </div>
           
           
                                   <div class="profiling-input-field">
                                       <label>Birthdate</label>
                                       <input type="date" id="bday" name="birthday" placeholder="Enter Birthdate" >
                                   </div>
                                   <div class="profiling-input-field">
                                       <label>Sex</label>
                                       <select name="sex" id="sex">
                                           <option disabled selected>Select Sex</option>
                                           <option>M</option>
                                           <option>F</option>
                                       </select>
                                   </div>
                                   <div class="profiling-input-field">
        <label>Barangay</label>
        <select name="address" id="address">
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
                                   <div class="profiling-input-field">
                                       <label>Medical History</label>
                                       <input type="text" oninput="capitalizeFirstLetter(this)" id="history" name="history" placeholder="Enter Medical History" >
									</div>                            
                                   <div class="profiling-input-field">
                                       <label>HH_Head</label>
                                       <input type="text" oninput="capitalizeFirstLetter(this)" id="head" name="hhhead" placeholder="Enter HH_Head" >
                                   </div>
									<div class="profiling-input-field">
                                       <label>Classification</label>
                                       <select name="classification" id="classification"">
                                           <option disabled selected>Select Classification</option>
                                           <option>NHTS</option>
                                           <option>None NHTS</option>
										   <option>NHTS Poor</option>
                                       </select>
                                   </div>
                                       <div class="profiling-input-field">
                                           <label>Philhealth Number</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="philhealth" name="philhealth" placeholder="Enter Philhealth Number" >
                                       </div>
                                      
                                       <div class="profiling-input-field">
                                           <label>Contact Number</label>
                                           <input type="text" id="number" name="number" placeholder="Enter Contact Number">
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>PWD (Specific)</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="pwd" name="pwd" placeholder="Enter PWD (Specificify) " >
                                       </div>
                                      
                                       <div class="profiling-input-field">
                                           <label>Date</label>
                                           <input type="date" id="date" name="date" placeholder="Enter Date" >
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>VS Chief Complaint</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="complaint" name="complaint" placeholder="Enter Complaint" >
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>Diagnosis</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="diagnosis" name="diagnosis" placeholder="Enter Diagnosis" >
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>Treatment</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" id="treatment" name="treatment" placeholder="Enter Treatment" >
                                       </div>             
                               </div>
                           </div>
						   <div class="profiling-button-action">
                        <button type="button" class="cancel" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="profiling-nextBtn">Update Data</button>
                    </div>
                       </div>
                   </form>
			</div>
		
</div>
<div class="modal fade" id="exportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="feedback-image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg></div>
                <form action="../export/export_checkup.php" method="POST">

                    <div class="feedback-content">
						<span class="feedback-title">Export Data</span>
                		<p class="feedback-message">Select Date of the data you want to export</p>
						<label for="from">From:</label>
						<input type="date" name="from" class="setdate">
						<label for="from">To:</label>
						<input type="date" name="to"  class="setdate">
                    </div>
                    <div class="profiling-action">
                        <button type="submit" name="exportdata" class="exported">Export</button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>
                    </div>
                </form>

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
             <a href="../update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
            <a href=""> <button class="logout-cancel" type="button" data-dismiss="modal">Cancel</button></a>
          </div>
        </div>
        </div>
        </div>
    </div>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="feedback-image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg></div>
                <form action="../update_data/checkup-delete.php" method="POST">

                    <div class="feedback-content">

                        <input type="hidden" name="delete_id" id="delete_id">
						<span class="feedback-title">Delete Record</span>
                		<p class="feedback-message">Are you sure you want to Delete the Tecord? All of the data will be permanently removed. This action cannot be undone.</p>
                    </div>
                    <div class="feedback-action">
                        <button type="submit" name="deletedata" class="delete">Delete</button>
						<button type="button" class="cancel" data-dismiss="modal"> Cancel</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
	<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  action="../Add record/import_checkup.php" method="POST" enctype="multipart/form-data">
				<div class="gender-details">
    <div class="container-imgs">
        <div class="img-area" data-img="">
            <i class='bx bxs-cloud-upload icon'></i>
            <h3>Upload excel</h3>
        </div>
        <label for="elder" class="custom-file-input add">Upload Excel file</label>
        <input class="add" id="elder" type="file" required value="" accept=".xlsx, .xls" name="excel" hidden>
    </div>
    <script>
        // Get the file input element and the container img element
        const fileInput = document.getElementById("elder"); // Changed ID to "elder"
        const imgArea = document.querySelector(".img-area");

        // Add an event listener to the file input
        fileInput.addEventListener("change", function(event) {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                // When the reader has loaded the image, display it in the imgArea
                reader.onload = function() {
                    imgArea.innerHTML = `
                        <i class='bx bxs-cloud-upload icon'></i>
                        <h3>Upload excel</h3>
                        <p>File: ${selectedFile.name}</p>
                    `;
                };
                reader.readAsDataURL(selectedFile);
            }
        });
    </script>
</div>
<div class="profiling-action">
                        <button type="submit" name="import" class="exported">Upload Excel</button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
	<!-- SIDEBAR -->
	<section id="sidebar">
	<a href="#" class="brand"><img src="../../../../images/LOGO.png" class='bx icon' alt=""> RHU</a>
		<ul class="side-menu">
			<li><a href="../../../index.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#" class="active"><i class='bx bxs-receipt icon' ></i> Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown show">
					<li ><a href="../Profiling/profiling-all.php" >Profiling</a></li>
					<li ><a href="checkup-all.php" class="active-now">Checkup</a></li>
					<li><a href="../OTP/OTP-all.php">OPT</a></li>
					<li><a href="../Immunization/Immunization-all.php">Immunization</a></li>
					<li><a href="../Vaccination/vaccination-all.php">Vaccination</a></li>
					<li><a href="../Senior/senior-all.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#" ><i class='bx bxs-receipt icon' ></i> Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li ><a href="../profiling-choices.php" >Profiling</a></li>
					<li ><a href="../checkup-choices.php">Checkup</a></li>
					<li><a href="../OTP-choices.php">OPT</a></li>
					<li><a href="../Immunization-choices.php">Immunization</a></li>
					<li><a href="../vaccination-choices.php">Vaccination</a></li>
					<li><a href="../senior-choices.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
		
			<li>
				<a href="#"><i class='bx bxs-user icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="../../Account Managment/Profile.php" >Personal Information</a></li>
					<li><a href="../../Account Managment/Account Settings.php">Account Settings</a></li>
				</ul>
			</li>
			<li><a href="../search.php"><i class='bx bx-search-alt-2 icon'></i>Search Information</a></li>
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
				echo '<img src="../../Account Managment/images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="../../Account Managment/uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
				}
				?>					<ul class="profile-link">
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Records</h1>
			<div class="info-data">
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">					
						<h3>Checkup Records</h3>
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
                        <button id="downloadButton" class="add">Download Template</button>
							<button class="gen export" type="submit" > Generate Report</button>
							<button type="submit" class="add import"> import</button>	
							<button class="add" id="profiling-add"> Add Record</button></span>
                            <script>
  // Function to trigger the file download
  function downloadExcelTemplate() {
    // Replace 'template.xlsx' with the path to your Excel template file
    var templatePath = 'template.xlsx';

    // Create an anchor element
    var link = document.createElement('a');
    link.href = templatePath;

    // Set the download attribute and file name
    link.download = 'checkup_form_template.xlsx';

    // Programmatically click the link to trigger the download
    link.click();
  }

  // Add a click event listener to the button
  document.getElementById('downloadButton').addEventListener('click', downloadExcelTemplate);
</script>

						</div>
					<div class="full-container">
   		            <div class="profiling-container">
					   <div class="profiling-close"><i class='bx bx-x icon'></i></div>

                    <header>Check up</header>
                   <form action="../Add record/checkup.php" method="POST">
                       <div class="profiling-form first">
                           <div class="profiling-details personal">
                               <span class="profiling-title">Personal Details</span>
                               <div class="profiling-fields">
                               <div class="profiling-input-field">
                                    
                                <label>Address<span class="red">*</span></label>
                                <select name="address" id="add" onchange="updateFamilyNumber()">
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
                                   <div class="profiling-input-field">
                                       <label> Family Serial Number<span class="red">*</span></label>
                                       <input type="text" name="srnum" id="familyNumber" placeholder="Enter Family Serial Number" >
                                   </div>
                                   <script>
function updateFamilyNumber() {
    var addressDropdown = document.getElementById("add");
    var familyNumberInput = document.getElementById("familyNumber");


    var selectedOption = addressDropdown.options[addressDropdown.selectedIndex];

    // Check if a valid option (other than the default one) is selected
    if (selectedOption.value !== "") {
        var selectedBarangay = selectedOption.text;

        // Generate the family number using the first three letters of the barangay
        var barangayCode = selectedBarangay.substring(0, 3).toUpperCase();
        var currentNumber = 0;  // Replace with your actual family number
        var formattedNumber = generateFamilyNumber(barangayCode, currentNumber);

        // Update the Family Number input field
        familyNumberInput.value = formattedNumber;
    } else {
        // Reset the Family Number input field if the default option is selected
        familyNumberInput.value = "";
    }
}

function generateFamilyNumber(barangayCode, currentNumber) {
    // Format the family number with the specified layout
    return "SJ-" + barangayCode + "-" + currentNumber.toString().padStart(4, '0');
}
</script>
      
    <div class="profiling-input-field">
     <label>Lastname<span class="red">*</span></label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="" name="lname" placeholder="Enter Lastname">
    </div>                             <div class="profiling-input-field">
     <label>Firstname<span class="red">*</span></label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="" name="fname" placeholder="Enter Firstname">
    </div>

    <div class="profiling-input-field">
     <label>Middlename</label>
     <input type="text" oninput="capitalizeFirstLetter(this)" id="" name="mname" placeholder="Enter Middlename">
    </div>
           
                                   <div class="profiling-input-field">
                                       <label>Birthdate<span class="red">*</span></label>
                                       <input type="date" name="birthday" placeholder="Enter Birthdate" >
                                   </div>
                                   <div class="profiling-input-field">
                                       <label>Sex</label>
                                       <select name="sex">
                                           <option disabled selected>Select Sex</option>
                                           <option>M</option>
                                           <option>F</option>
                                       </select>
                                   </div>
                                   <div class="profiling-input-field">
                                       <label>Medical History</label>
                                       <input type="text" oninput="capitalizeFirstLetter(this)" name="history" placeholder="Enter Medical History" >
									</div>
                                   <div class="profiling-input-field">
                                       <label>HH_Head</label>
                                       <input type="text" oninput="capitalizeFirstLetter(this)" name="hhhead" placeholder="Enter HH_Head" >
                                   </div>
								   <div class="profiling-input-field">
                                       <label>Classification</label>
                                       <select name="classification">
                                           <option disabled selected>Select Classification</option>
                                           <option>NHTS</option>
                                           <option>Non-NHTS</option>
                                       </select>
                                   </div>
                                       <div class="profiling-input-field">
                                           <label>Philhealth Number</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" name="philhealth" placeholder="Enter Philhealth Number" >
                                       </div>
                                      
                                       <div class="profiling-input-field">
                                           <label>Contact Number</label>
                                           <input type="text" name="number" placeholder="Enter Contact Number">
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>PWD (Specific)</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" name="pwd" placeholder="Enter PWD (Specificify) " >
                                       </div>
                                      
                                       <div class="profiling-input-field">
                                           <label>Date</label>
                                           <input type="date" name="date" placeholder="Enter Date" >
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>VS Chief Complaint</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" name="complaint" placeholder="Enter Complaint" >
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>Diagnosis</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" name="diagnosis" placeholder="Enter Diagnosis" >
                                       </div>
                                       <div class="profiling-input-field">
                                           <label>Treatment</label>
                                           <input type="text" oninput="capitalizeFirstLetter(this)" name="treatment" placeholder="Enter Treatment" >
                                       </div>             
                               </div>
                           </div>
                           <div class="profiling-details ID">           
                               <button class="profiling-nextBtn" type="submit">
                                   <span class="profiling-btnText">Submit</span>
                                   <i class="uil uil-navigator"></i>
                               </button>
                           </div> 
                       </div>
                   </form>
		           <script>
                              document.getElementById('profiling-add').addEventListener
                  ("click", function(){
                      document.querySelector('.full-container').style.display = "block";
                  });
                  
                  document.querySelector('.profiling-close').addEventListener(
                      "click", function(){
                          document.querySelector('.full-container').style.display="none";
                      }
                  );
                </script>
    				</div>
			</div>
						<div class="table-wrapper">
						<table  id="filteredData" class="display emp-table" style="width: 100%;">
							<thead>
								<tr>
								<th col-index = 0>Family Serial Number</th>
								<th col-index = 1>Name</th>
								<th col-index = 2>Birthday</th>
								<th col-index = 3>Age</th>
								<th col-index = 4>Gender</th>
								<th col-index = 5>Adress</th>
								<th col-index = 6>Medical History</th>
								<th col-index = 7>Attending Physician</th>
								<th col-index = 8>Household head</th>
								<th col-index = 11>Classification           
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 11>Philhealth Number</th>
								<th col-index = 12>Cellphone number</th>
								<th col-index = 13>PWD
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 15>Date of Visit
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 16>VS/Chief Complaint
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 17>Diagnosis
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>  
								<th col-index = 18>Treatment	
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select></th>                          
								<th col-index = 19>Action</th>

							</tr>
							</thead>
							<tbody>
							<?php
							
                            $sql ="SELECT p.*, pi.*, mi.*, oi.*, age.*, ta.*
                            FROM checkup p
                            LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
                            LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
                            LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
                            LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
                            LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
                            GROUP BY p.Record_ID";							    
							    
                            $result = mysqli_query($conn, $sql);
							    if (mysqli_num_rows($result) > 0) { // Check if there are rows returned
								        while ($row = mysqli_fetch_assoc($result)) {
								            ?>
								            <tr>
                                            <input type="hidden" class="record-id" value="<?php echo $row["Record_ID"]?>">

								                <td><?php echo $row["Family_Serial_num"] ?></td>
								                <td><a class="btnnn viewbtn"><?php echo $row["FName"].', '.$row["MName"].', '.$row["LName"] ?></a></td>
								                <td><?php echo $row["birthdate"] ?></td>
												<td><?php echo $row["Age"] ?></td>
								                <td><?php echo $row["sex"] ?></td>
								                <td><?php echo $row["Barangay"].' '.$row['Municipality'].' '.$row['Province'] ?></td>
								                <td><?php echo $row["history"] ?></td>
												<td><?php echo $row["physician"] ?></td>											
								                <td><?php echo $row["Head"] ?></td>
								                <td><?php echo $row["classification"] ?></td>
								                <td><?php echo $row["philhealthnum"] ?></td>
												<td><?php echo $row["contact_num"] ?></td>
								                <td><?php echo $row["PWD"] ?></td>
								                <td><?php echo $row["Date"] ?></td>
								                <td><?php echo $row["VSChief_Complaint"] ?></td>
												<td><?php echo $row["Diagnosis"] ?></td>
								                <td><?php echo $row["treatment"] ?></td>
							                <td>
											<button type="button" class="btnn editbtn"> Update </button>
													<button type="button" class="btn btn-danger deletebtn"> Delete </button>
						                </td>
						            </tr>
							            <?php
						        }
						    } else {
							    }
							?>

							</tbody>
                            <tfoot>
                            <tr>
								<th col-index = 0>Family Serial Number</th>
								<th col-index = 1>Name</th>
								<th col-index = 2>Birthday</th>
								<th col-index = 3>Age</th>
								<th col-index = 4>Gender</th>
								<th col-index = 5>Adress</th>
								<th col-index = 6>Medical History</th>
								<th col-index = 7>Attending Physician</th>
								<th col-index = 8>Household head</th>
								<th col-index = 11>Classification           
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 11>Philhealth Number</th>
								<th col-index = 12>Cellphone number</th>
								<th col-index = 13>PWD
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 15>Date of Visit
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 16>VS/Chief Complaint
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 17>Diagnosis
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>  
								<th col-index = 18>Treatment	
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select></th>                          
								<th col-index = 19>Action</th>

							</tr>
                            </tfoot>
							<script src="../../js/filter.js"></script>
						</table>
                        <script>

var dataTable = $('#filteredData').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'excel',
        'colvis'
    ],
});

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
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="../../js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script src="../../js/script.js"></script>
	
	<script>
    $(document).ready(function () {
           $('filteredData').DataTable();

        $(document).on('click','.deletebtn', function () {
            $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');

            var recordId = $(this).closest('tr').find('.record-id').val();
            $('#delete_id').val(recordId);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.import').on('click', function () {
            $('#import').modal('show');

            var recordId = $(this).closest('tr').find('.record-id').val();
            $('#delete_id').val(recordId);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.export').on('click', function () {
            $('#exportmodal').modal('show');
        });
    });
</script>
<script>
        $(document).ready(function () {

           $('filteredData').DataTable();


            $(document).on('click','.editbtn', function () {
          

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                var nameParts = data[1].trim().split(', ');
  var addressParts = data[5].trim().split(' ');

				$('#update_id').val(recordId);
                $('#serial').val(data[0]);
                $('#name').val(data[1]);
                $('#bday').val(data[2]);
				$('#sex').val(data[4]);
				$('#address').val(addressParts[0]);;
				$('#history').val(data[6]);
				$('#head').val(data[8]);
				$('#classification').val(data[9]);
				$('#philhealth').val(data[10]);
				$('#number').val(data[11]);
				$('#pwd').val(data[12]);
				$('#date').val(data[13]);
				$('#complaint').val(data[14]);
				$('#diagnosis').val(data[15]);
				$('#treatment').val(data[16]);

				$('#fname').val(nameParts[0]);
$('#mname').val(nameParts[1]);
$('#lname').val(nameParts[2]);

            });
        });
    </script>
    <script>
        $(document).ready(function () {

           $('filteredData').DataTable();


            $(document).on('click','.viewbtn', function () {
          

                $('#viewmodal').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                var nameParts = data[1].trim().split(' ');
  var addressParts = data[5].trim().split(' ');

				$('#view_id').val(recordId);
                $('#serials').val(data[0]);
                $('#names').val(data[1]);
                $('#bdays').val(data[2]);
				$('#sexs').val(data[4]);
				$('#addresss').val(addressParts[0]);;
				$('#historys').val(data[6]);
				$('#heads').val(data[8]);
				$('#classifications').val(data[9]);
				$('#philhealths').val(data[10]);
				$('#numbers').val(data[11]);
				$('#pwds').val(data[12]);
				$('#dates').val(data[13]);
				$('#complaints').val(data[14]);
				$('#diagnosiss').val(data[15]);
				$('#treatments').val(data[16]);

				$('#fnames').val(nameParts[0]);
$('#mnames').val(nameParts[1]);
$('#lnames').val(nameParts[2]);

            });
        });
    </script>
    <script>
    $(document).ready(function () {
        $('.logout').on('click', function () {
            $('#logoutmodal').modal('show');
        });
    });
</script>
<script>
$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('success')) {

    $('#successModal').modal('show');

    setTimeout(function () {
      $('#successModal').modal('hide');
    }, 2000);
  }
});
</script>
<script>
$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('error')) {

    $('#errorModal').modal('show');

    setTimeout(function () {
      $('#errorModal').modal('hide');
    }, 2000);
  }
});
</script>
<script>
    function capitalizeFirstLetter(input) {
        // Get the current input value
        let inputValue = input.value;

        // Split the input value by spaces
        let words = inputValue.split(' ');

        // Capitalize the first letter of each word
        for (let i = 0; i < words.length; i++) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
        }

        // Join the words back together with spaces
        input.value = words.join(' ');
    }
</script>

</body>
</html>