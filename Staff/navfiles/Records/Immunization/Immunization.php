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
        <header>Immunization</header>

        <form action="Add record/update-immunization.php" method="POST">
            <div class="profiling-form first">
                <div class="profiling-details personal">
                    <span class="profiling-title">Personal Details</span>
                    <input type="hidden" name="update_id" id="update_id">

                    <div class="profiling-fields">
                        <div class="profiling-input-field">
                            <label>Lastname</label>
                            <input type="Text" id="lnames" name="lname" placeholder="Enter Lastname" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Firstname</label>
                            <input type="Text" id="fnames" name="fname" placeholder="Enter Firstname" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Middlename</label>
                            <input type="Text" id="mnames" name="mname" placeholder="Enter Middlename" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Date of Birth</label>
                            <input type="date" id="bdays" name="birthday" placeholder="Enter Birthday" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Place of Birth</label>
                            <input type="text" id="places" name="place" placeholder="Enter Place of Birth" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Address</label>
                            <select name="address" id="addresss" disabled>
                               <option disabled selected>Select Address</option>
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
                            <label>Mothers Name</label>
                            <input type="Text" id="mothers" name="mother" placeholder="Enter Mothers Name" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Fathers Name</label>
                            <input type="Text" id="fathers" name="father" placeholder="Enter IP Group" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Birth Height</label>
                            <input type="text" id="heights" name="height" placeholder="Enter Birth Height" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Birth Weight</label>
                            <input type="text" id="weights" name="weight" placeholder="Enter Birth Weight" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Sex</label>
                            <select name="sex" id="sexs" disabled>
                                <option disabled selected>Select Sex</option>
                                <option>M</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Health Center</label>
                            <input type="text" id="centers" name="center" placeholder="Enter Health Center" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Barangay</label>
                            <input type="text" id="barangays" name="barangay" placeholder="Enter Barangay" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Family Number</label>
                            <input type="text" id="numbers" name="number" placeholder="Enter Barangay" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>At Birth Dose</label>
                            <select name="atbirth" id="atbirths" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>BCG vaccine</option>
                                <option>Hepatitis B Vaccine</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>6 Weeks</label>
                            <select name="first" id="firsts" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
                                <option>Oral Polio Vaccine (OPV)</option>
                                <option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>10 Weeks</label>
                            <select name="second" id="seconds" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
                                <option>Oral Polio Vaccine (OPV)</option>
                                <option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>14 Weeks</label>
                            <select name="third" id="thirds" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
                                <option>Oral Polio Vaccine (OPV)</option>
                                <option>Inactivated Polio Vaccine (IPV)</option>
                                <option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>9 Months</label>
                            <select name="fourth" id="fourths" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>Measles, Mumps, Rubella <br> Vaccine (MMR)</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>12 Months</label>
                            <select name="fifth" id="fifths" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>Measles, Mumps, Rubella <br> Vaccine (MMR)</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Eye Prophylaxis</label>
                            <input type="text" id="eyes" name="eye" placeholder="Enter Information" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Vitamin K</label>
                            <input type="text" id="vitamins" name="vitamin" placeholder="Enter Health Center" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Exclusive Breest Feeding</label>
                            <input type="text" id="breests" name="breest" placeholder="Enter Health Center" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Newborn Screening</label>
                            <input type="text" id="nbs" name="nb" placeholder="Enter Health Center" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Newborn Hearning Screening</label>
                            <input type="text" id="hearings" name="hearing" placeholder="Enter Health Center" disabled>
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
        <header>Immunization</header>

        <form action="../update_data/update-immunization.php" method="POST">
            <div class="profiling-form first">
                <div class="profiling-details personal">
                    <span class="profiling-title">Personal Details</span>
					<input type="hidden" name="update_id" id="update_id">

                    <div class="profiling-fields">
					<div class="profiling-input-field">
    					 <label>Lastname</label>
    					 <input oninput="capitalizefirst(this)" type="Text" id="lname" name="lname" placeholder="Enter Lastname">
    					</div>                             <div class="profiling-input-field">
    					 <label>Firstname</label>
    					 <input oninput="capitalizeFirstLetter(this)" type="Text" id="fname" name="fname" placeholder="Enter Firstname">
    					</div>
  				
    					<div class="profiling-input-field">
    					 <label>Middlename</label>
    					 <input oninput="capitalizeFirstLetter(this)" type="Text" id="mname" name="mname" placeholder="Enter Middlename">
    					</div>

                        <div class="profiling-input-field">
                            <label>Date of Birth</label>
                            <input type="date" id="bday" name="birthday" placeholder="Enter Birthday" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Place of Birth</label>
                            <input oninput="capitalizeFirstLetter(this)" type="text" id="place" name="place" placeholder="Enter Place of Birth" >
                        </div>
						<div class="profiling-input-field">
                            <label>Address</label>
                            <select name="address" id="address">
                                <option disabled selected>Select Address</option>
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
                            <label>Mothers Name</label>
                            <input oninput="capitalizeFirstLetter(this)" type="Text" id="mother" name="mother" placeholder="Enter Mothers Name" >
                        </div>
						<div class="profiling-input-field">
                            <label>Fathers Name</label>
                            <input oninput="capitalizeFirstLetter(this)" type="Text" id="father" name="father" placeholder="Enter IP Group" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Birth Height</label>
                            <input oninput="capitalizeFirstLetter(this)" type="text" id="height" name="height" placeholder="Enter Birth Height" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Birth Weight</label>
                            <input oninput="capitalizeFirstLetter(this)" type="text" id="weight" name="weight" placeholder="Enter Birth Weight" >
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
                                <label>Health Center</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="center" name="center" placeholder="Enter Health Center">
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Barangay</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="barangay" name="barangay" placeholder="Enter Barangay">
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Family Number</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="number" name="number" placeholder="Enter Barangay" >
                            </div>
                            <div class="profiling-input-field">
                                <label>At Birth Dose</label>
                                <select name="atbirth" id="atbirth">
                                    <option disabled selected>Select Dose</option>
                                    <option>BCG vaccine</option>
                                    <option>Hepatitis B Vaccine</option>
									
                                </select>
                            </div>
                            <div class="profiling-input-field">
                                <label>6 Weeks</label>
                                <select name="first" id="first">
                                    <option disabled selected>Select Dose</option>
									<option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
									<option>Oral Polio Vaccine (OPV)</option>
									<option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>10 Weeks</label>
                                <select name="second" id="second">
								<option disabled selected>Select Dose</option>
									<option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
									<option>Oral Polio Vaccine (OPV)</option>
									<option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>14 Weeks</label>
                                <select name="third" id="third">
								<option disabled selected>Select Dose</option>
									<option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
									<option>Oral Polio Vaccine (OPV)</option>
									<option>Inactivated Polio Vaccine (IPV)</option>
									<option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>9 Months</label>
                                <select name="fourth" id="fourth">
								<option disabled selected>Select Dose</option>
									<option>Measles, Mumps, Rubella <br> Vaccine (MMR)</option>
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>12 Months</label>
                                <select name="fifth" id="fifth">
									<option disabled selected>Select Dose</option>
									<option>Measles, Mumps, Rubella <br> Vaccine (MMR)</option>
                                </select>
                            </div>
                            <div class="profiling-input-field">
                                <label>Eye Prophylaxis</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="eye" name="eye" placeholder="Enter Information">
                            </div>
                            <div class="profiling-input-field">
                                <label>Vitamin K</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="vitamin" name="vitamin" placeholder="Enter Health Center">
                            </div>
                            <div class="profiling-input-field">
                                <label>Exclusive Breest Feeding</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="breest" name="breest" placeholder="Enter Health Center">
                            </div>
                            <div class="profiling-input-field">
                                <label>Newborn Screening</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="nb" name="nb" placeholder="Enter Health Center">
                            </div>
                            <div class="profiling-input-field">
                                <label>Newborn Hearning Screening</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" id="hearing" name="hearing" placeholder="Enter Health Center">
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
<div class="modal fade" id="exportmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="feedback-image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg></div>
                <form action="../export/export_immunization.php" method="POST">

                    <div class="feedback-content">
						<span class="feedback-title">Export Data</span>
                		<p class="feedback-message">Select Date of the data you want to export</p>
						<label for="from">From:</label>
						<input type="date" name="from"class="setdate">
						<label for="from">To:</label>
						<input type="date" name="to" class="setdate">
                    </div>
                    <div class="profiling-action">
                        <button type="submit" name="exportdata" class="export">Export</button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>
                    </div>
                </form>

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
                <form action="../update_data/immunization-delete.php" method="POST">

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
                <form  action="../Add record/import_immunization.php" method="POST" enctype="multipart/form-data">
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
					<li ><a href="../profiling/profiling-all.php" >Profiling</a></li>
					<li ><a href="../checkup/checkup-all.php" >Checkup</a></li>
					<li><a href="../OTP/OTP-all.php">OPT</a></li>
					<li><a href="../Immunization/Immunization-all.php" class="active-now active">Immunization</a></li>
					<li><a href="../Vaccination/vaccination-all.php">Vaccination</a></li>
					<li><a href="../Senior/senior-all.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#" ><i class='bx bxs-receipt icon' ></i> Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown ">
					<li ><a href="../profiling-choices.php" >Checkup</a></li>
					<li ><a href="../checkup-choices.php" >Profiling</a></li>
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
		
						<h3> Immunization Data</h3>
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
    link.download = 'Immunization_form_template.xlsx';

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

        <header>Immunization</header>

        <form action="../Add record/immunization.php" method="POST">
            <div class="profiling-form first">
                <div class="profiling-details personal">
                    <span class="profiling-title">Personal Details</span>
                    <div class="profiling-fields">

					<div class="profiling-input-field">
     <label>Lastname<span class="red">*</span></label>
     <input oninput="capitalizeFirstLetter(this)" type="Text" id="" name="lname" placeholder="Enter Lastname">
    </div>                             <div class="profiling-input-field">
     <label>Firstname<span class="red">*</span></label>
     <input oninput="capitalizeFirstLetter(this)" type="Text" id="" name="fname" placeholder="Enter Firstname">
    </div>

    <div class="profiling-input-field">
     <label>Middlename<span class="red">*</span></label>
     <input oninput="capitalizeFirstLetter(this)" type="Text" id="" name="mname" placeholder="Enter Middlename">
    </div>

                        <div class="profiling-input-field">
                            <label>Date of Birth<span class="red">*</span></label>
                            <input type="date" name="birthday" placeholder="Enter Birthday" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Place of Birth<span class="red">*</span></label>
                            <input oninput="capitalizeFirstLetter(this)" type="text" name="place" placeholder="Enter Place of Birth" >
                        </div>
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
                            <label>Mothers Name<span class="red">*</span></label>
                            <input oninput="capitalizeFirstLetter(this)"  type="Text" name="mother" placeholder="Enter Mothers Name" >
                        </div>
						<div class="profiling-input-field">
                            <label>Fathers Name<span class="red">*</span></label>
                            <input oninput="capitalizeFirstLetter(this)" type="Text" name="father" placeholder="Enter IP Group" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Birth Height<span class="red">*</span></label>
                            <input oninput="capitalizeFirstLetter(this)" type="text" name="height" placeholder="Enter Birth Height" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Birth Weight<span class="red">*</span></label>
                            <input oninput="capitalizeFirstLetter(this)" type="text" name="weight" placeholder="Enter Birth Weight" >
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
                                <label>Health Center</label>
                                <input oninput="capitalizeFirstLetter(this)" type="text" name="center" placeholder="Enter Health Center">
                            </div>

                            <div class="profiling-input-field">
    <label>Family Number<span class="red">*</span></label>
    <input type="text" oninput="capitalizeFirstLetter(this)" oninput="capitalizeFirstLetter(this)" name="number" id="familyNumber" placeholder="Enter Barangay" >
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
                                <label>At Birth Dose</label>
                                <select name="atbirth">
                                    <option disabled selected>Select Dose</option>
									<option>Not Yet</option>
                                    <option>BCG vaccine</option>
                                    <option>Hepatitis B Vaccine</option>
                                </select>
                            </div>
                            <div class="profiling-input-field">
                                <label>6 Weels</label>
                                <select name="first">
                                    <option disabled selected>Select Dose</option>
									<option>Not Yet</option>
                                    <option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
									<option>Oral Polio Vaccine (OPV)</option>
                                    <option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>

							
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>10 Weeks</label>
                                <select name="second">
								<option disabled selected>Select Dose</option>
								<option>Not Yet</option>
                                    <option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
									<option>Oral Polio Vaccine (OPV)</option>
                                    <option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>

									
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>14 Weeks</label>
                                <select name="third">
								<option disabled selected>Select Dose</option>
								<option>Not Yet</option>
									<option>Pentavalent Vaccine <br> (DPT-Hep B-HIP)</option>
									<option>Oral Polio Vaccine (OPV)</option>
									<option>Inactivated Polio Vaccine (IPV)</option>
									<option>Pnuemococcal Conjugate Vaccine <br> (PCV) </option>
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label>9 Months</label>
                                <select name="fourth">
								<option disabled selected>Select Dose</option>
								<option>Not Yet</option>
									<option>Measles, Mumps, Rubella <br> Vaccine (MMR)</option>
                                </select>
                            </div>
							<div class="profiling-input-field">
                                <label >12 Months</label>
                                <select name="fifth">
									<option disabled selected>Select Dose</option>
									<option>Not Yet</option>
									<option>Measles, Mumps, Rubella <br> Vaccine (MMR)</option>
                                </select>
                            </div>
                            <div class="profiling-input-field">
                                <label>Eye Prophylaxis</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="eye" placeholder="Enter Information">
                            </div>
                            <div class="profiling-input-field">
                                <label>Vitamin K</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="vitamin" placeholder="Enter Vitamin K">
                            </div>
                            <div class="profiling-input-field">
                                <label>Exclusive Breest Feeding</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="breest" placeholder="Enter Exclusive Breest Feeding">
                            </div>
                            <div class="profiling-input-field">
                                <label>Newborn Screening</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="nb" placeholder="Enter New Born Screening">
                            </div>
                            <div class="profiling-input-field">
                                <label>Newborn Hearning Screening</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="hearing" placeholder="Enter New Born Hearing Screening">
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
</script>
		
    </div>
	</div>
						<div class="table-wrapper">
						<table  id="filteredData" class="display emp-table" style="width: 100%;">
						<thead>
								<tr>
								<th col-index = 2>Full Name of Child</th>
								<th col-index = 3>Date of Birth</th>
								<th col-index = 4>Place of Birth</th>
								<th col-index = 5>Address</th>
								<th col-index = 6>Fathers Name</th>
								<th col-index = 7>Mothers Name</th>
								<th col-index = 8>Birth height</th>
								<th col-index = 9>Birth Weight</th>
								<th col-index = 10>Sex                  
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>								
								<th col-index =11>Health Center</th>
								<th col-index = 12>Barangay</th>
								<th col-index = 13>Family No.</th>
								<th col-index= 14>At Birth
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index=15>6 Weeks
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>

							
                    <th col-index="16">10 Weeks
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="17">14 Weeks
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="18">9 Months
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="19">12 Months Dose
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="20">Eye Prophylaxis
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th> <th col-index="21">Vitamin K
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th> <th col-index="22">Exclusive Breest Feeding
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th> <th col-index="23">Newborn Screening
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    </th> <th col-index="24">Newbord Hearning Screening
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
            <th col-index="25">Action</th>
									
							</tr>
							</thead>
							<tbody>
							<?php
							
							if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['address'])) {
								$address = $_POST["address"];
							$sql ="SELECT p.*, pi.*, mi.*, age.*, ta.*, bi.*
                            FROM immunization p
                            LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
                            LEFT JOIN immunization_information mi ON pi.Record_ID = mi.Record_ID
							LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
                            LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
                            LEFT JOIN baby_information bi ON pi.Record_ID = bi.Record_ID

							WHERE ta.Barangay ='$address'
							GROUP BY p.Record_ID";								    $result = mysqli_query($conn, $sql);
							    if (mysqli_num_rows($result) > 0) { // Check if there are rows returned
								        while ($row = mysqli_fetch_assoc($result)) {
								            ?>
								            <tr>
											<input type="hidden" class="record-id" value="<?php echo $row["Record_ID"]; ?>">

											<td><a class="btnnn viewbtn"><?php echo $row["FName"].' '.$row["MName"].' '.$row["LName"] ?></a></td>
								            <td><?php echo $row["birthdate"] ?></td>
								            <td><?php echo $row["PlaceOfBirth"] ?></td>
											<td><?php echo $row["Barangay"].' '.$row['Municipality'].' '.$row['Province'] ?></td>
								            <td><?php echo $row["FathersName"] ?></td>
								            <td><?php echo $row["MothersName"] ?></td>
											<td><?php echo $row["birth_height"] ?></td>
								            <td><?php echo $row["birth_weight"] ?></td>
								            <td><?php echo $row["sex"] ?></td>
								            <td><?php echo $row["health_center"] ?></td>
								            <td><?php echo $row["Barangay"] ?></td>
								            <td><?php echo $row["Familynum"] ?></td>
											<td><?php echo $row["atbirth"] ?></td>
								            <td><?php echo $row["firstDose"] ?></td>
								            <td><?php echo $row["secondDose"] ?></td>
								            <td><?php echo $row["thirdDose"] ?></td>
								            <td><?php echo $row["fourthDose"] ?></td>
								            <td><?php echo $row["fifthDose"] ?></td>
                                            <td><?php echo $row["eye_prophy"] ?></td>
								            <td><?php echo $row["vitamin_K"] ?></td>
								            <td><?php echo $row["breest_feed"] ?></td>
								            <td><?php echo $row["nb_screening"] ?></td>
								            <td><?php echo $row["nb_hscreening"] ?></td>

							                <td>
											<button type="button" class="btnn editbtn"> Update </button>
													<button type="button" class="btn btn-danger deletebtn"> Delete </button>
						                </td>
						            </tr>
							            <?php
						        }
						    } 
                        }
							?>

							</tbody>
                            <tfoot>
							<tr>
                            <tr>
								<th col-index = 2>Full Name of Child</th>
								<th col-index = 3>Date of Birth</th>
								<th col-index = 4>Place of Birth</th>
								<th col-index = 5>Address</th>
								<th col-index = 6>Fathers Name</th>
								<th col-index = 7>Mothers Name</th>
								<th col-index = 8>Birth height</th>
								<th col-index = 9>Birth Weight</th>
								<th col-index = 10>Sex                  
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>								
								<th col-index =11>Health Center</th>
								<th col-index = 12>Barangay</th>
								<th col-index = 13>Family No.</th>
								<th col-index= 14>At Birth
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index=15>6 Weeks
								<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>

							
                    <th col-index="16">10 Weeks
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="17">14 Weeks
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="18">9 Months
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="19">12 Months Dose
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    <th col-index="20">Eye Prophylaxis
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th> <th col-index="21">Vitamin K
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th> <th col-index="22">Exclusive Breest Feeding
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th> <th col-index="23">Newborn Screening
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
                    </th> <th col-index="24">Newbord Hearning Screening
					<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
					</th>
            <th col-index="25">Action</th>
									
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
						</div>
                        
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

            var recordId = $(this).closest('tr').find('.record-id').val();
            $('#delete_id').val(recordId);
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.import').on('click', function () {
            $('#import').modal('show');


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
				var nameParts = data[0].trim().split(' ');
                var addressParts = data[3].trim().split(' ');

				$('#update_id').val(recordId);
                $('#bday').val(data[1]);
                $('#place').val(data[2]);
                $('#address').val(addressParts[0]);
				$('#mother').val(data[5]);
				$('#father').val(data[4]);
				$('#height').val(data[6]);
				$('#weight').val(data[7]);
				$('#sex').val(data[8]);
				$('#center').val(data[9]);
				$('#barangay').val(data[10]);
				$('#number').val(data[11]);
				$('#atbirth').val(data[12]);
				$('#first').val(data[13]);
				$('#second').val(data[14]);
				$('#third').val(data[15]);
				$('#fourth').val(data[16]);
				$('#fifth').val(data[17]);
                $('#eye').val(data[18]);
                $('#vitamin').val(data[19]);
                $('#breest').val(data[20]);
                $('#nb').val(data[21]);
                $('#hearing').val(data[22]);
				$('#fname').val(nameParts[0]);
$('#mname').val(nameParts[1]);
$('#lname').val(nameParts[2]);



				
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
        $(document).ready(function () {

    $('filteredData').DataTable();


            $(document).on('click','.viewbtn', function () {
          
                $('#viewmodal').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
				var nameParts = data[0].trim().split(' ');
                var addressParts = data[3].trim().split(' ');

				$('#view_id').val(recordId);
                $('#bdays').val(data[1]);
                $('#places').val(data[2]);
                $('#addresss').val(addressParts[0]);
				$('#mothers').val(data[5]);
				$('#fathers').val(data[4]);
				$('#heights').val(data[6]);
				$('#weights').val(data[7]);
				$('#sexs').val(data[8]);
				$('#centers').val(data[9]);
				$('#barangays').val(data[10]);
				$('#numbers').val(data[11]);
				$('#atbirths').val(data[12]);
				$('#firsts').val(data[13]);
				$('#seconds').val(data[14]);
				$('#thirds').val(data[15]);
				$('#fourths').val(data[16]);
				$('#fifths').val(data[17]);
                $('#eyes').val(data[18]);
                $('#vitamins').val(data[19]);
                $('#breests').val(data[20]);
                $('#nbs').val(data[21]);
                $('#hearings').val(data[22]);
				$('#fnames').val(nameParts[0]);
$('#mnames').val(nameParts[1]);
$('#lnames').val(nameParts[2]);



				
            });
        });
    </script>
</body>
</html>