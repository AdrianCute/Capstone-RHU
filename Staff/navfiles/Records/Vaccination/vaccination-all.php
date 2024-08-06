<?php

include "../update_data/config.php";

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

        <header>Vaccination</header>

        <form action="../update_data/update_vaccination.php" method="POST">
            <div class="profiling-form first">
                <div class="profiling-details personal">

                    <span class="profiling-title">Personal Details</span>
                        <div class="profiling-fields">
						<input type="hidden" name="update_id" id="update_id">

                             <div class="profiling-input-field">
                                <label>Category</label>
                                <select name="category" id="categorys" disabled>
                                    <option disabled selected>Select Category</option>
                                    <option>A1</option>
                                    <option>A2</option>
                                    <option>A3</option>
									<option>A4</option>
                                    <option>A5</option>
                                    <option>ROAP</option>
									<option>ROPP 5-11 YEARS OLD</option>
                                    <option>ROPP 12-17 YEARS OLD</option>
                                </select>
                        </div>
                        <div class="profiling-input-field">
                            <label> Comorbidity</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="comorbiditys" name="comorbidity" placeholder="Enter Comorbidity" disabled>
                        </div>

                        <div class="profiling-input-field">
                            <label>Unique  Person  ID</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="ids" name="id" placeholder="Enter Person ID" disabled>
                        </div>

                        <div class="profiling-input-field">
                            <label>Person With Disability(Specify)</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="pwds" name="pwd" placeholder="Enter Disability" disabled>
                        </div>

                        <div class="profiling-input-field">
                            <label>IP Group(Specify)</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="ips" name="ip" placeholder="Enter IP Group" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Last Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="lnames" name="lname" placeholder="Enter Last Name" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>First Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="fnames" name="fname" placeholder="Enter First Name" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Middle Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="mnames" name="mname" placeholder="Enter Middle Name" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Suffix</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="suffixs" name="suffix" placeholder="Enter Suffix"  disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Contact Number</label>
                            <input type="text" id="numbers" name="number" placeholder="Enter Contact Number" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Guardian</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="guardians" name="guardian" placeholder="Enter Fullname" disabled>
                        </div>
                            <div class="profiling-input-field">
                                <label>Region</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" id="regions" name="region" placeholder="Enter Region" disabled>
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Province</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" id="provinces" name="province" placeholder="Enter Province" disabled>
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Municipality</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" id="municipalitys" name="municipality" placeholder="Enter Municipality" disabled>
                            </div>
                            <div class="profiling-input-field">
                                <label>Barangay</label>
                                <select type="text" id="barangays" name="barangay" placeholder="Enter Barangay" disabled>
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
                            <label>Sex</label>
                            <select name="sex" id="sexs" disabled>
                                <option disabled selected>Select gender</option>
                                <option>M</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Birthday</label>
                            <input type="date" id="bdays" name="bday" placeholder="Enter Deferral" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Deferral</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="deferrals" name="deferral" placeholder="Enter Deferral" disabled>
                        </div>
						<div class="profiling-input-field">
                            <label>Reason for Deferral</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="reasons" name="reason" placeholder="Enter Reason for Deferral" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Date of Vaccination</label>
                            <input type="date" id="dates" name="vaccine_date" placeholder="Enter date of vaccination" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Vaccine Manufacturer</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="vaccine-manus"  name="vaccine_manufacturer" placeholder="Enter date of vaccination" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Batch Number</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="batchs" name="batch" placeholder="Enter Batch number" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Lot No.</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="lots" name="lot" placeholder="Enter Lot number" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Bakuna</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="bakunas" name="bakuna" placeholder="Enter Name of Bakuna" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Vaccinator Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="vaccinators" name="vaccinator" placeholder="Enter Vaccinator Name" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>First Dose</label>
                            <select name="first" id="firstss" disabled>
                                <option disabled selected>Select Dose</option>
                                <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Second Dose</label>
                            <select name="second" id="secondss" disabled>
                                <option disabled selected>Select Vaccine</option>
                                < <option>Not yet</option>
  
  <option>Pfizer</option>
  <option>Astrazenica</option>
  <option>Sinovac</option>
  <option>Moderna</option>
  <option>Johnson and Janseen</option>
  <option>Sputnik V</option>
                            </select>
                        </div>
                        
                        <div class="profiling-input-field">
                            <label>First Booster Dose</label>
                            <select name="first_booster" id="firstboosters" disabled>
                                <option disabled selected>Select Vaccine</option>
                                <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Second Booster Dose</label>
                            <select name="second_booster" id="secboosters" disabled>
                                <option disabled selected>Select Vaccine</option>
                                <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Adverse</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="adverse" id="adverses" placeholder="Enter ward number" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Adverse Event Condition</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="event" id="events" placeholder="Enter ward number" disabled>
                        </div>
                        <div class="profiling-input-field">
                            <label>Row Hash</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="row" id="rows" placeholder="Enter Deferral" disabled>
                        </div>
                    </div>
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
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="profiling-container">
        <header>Vaccination</header>

        <form action="../update_data/update_vaccination.php" method="POST">
            <div class="profiling-form first">
                <div class="profiling-details personal">
                    <span class="profiling-title">Personal Details</span>
                        <div class="profiling-fields">
						<input type="hidden" name="update_id" id="update_id">

                             <div class="profiling-input-field">
                                <label>Category</label>
                                <select name="category" id="category" >
                                    <option disabled selected>Select Category</option>
                                    <option>A1</option>
                                    <option>A2</option>
                                    <option>A3</option>
									<option>A4</option>
                                    <option>A5</option>
                                    <option>ROAP</option>
									<option>ROPP 5-11 YEARS OLD</option>
                                    <option>ROPP 12-17 YEARS OLD</option>
                                </select>
                        </div>
                        <div class="profiling-input-field">
                            <label> Comorbidity</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="comorbidity" name="comorbidity" placeholder="Enter Comorbidity" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Unique  Person  ID</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="id" name="id" placeholder="Enter Person ID" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Person With Disability(Specify)</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="pwd" name="pwd" placeholder="Enter Disability" >
                        </div>

                        <div class="profiling-input-field">
                            <label>IP Group(Specify)</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="ip" name="ip" placeholder="Enter IP Group" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Last Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="lname" name="lname" placeholder="Enter Last Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>First Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="fname" name="fname" placeholder="Enter First Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Middle Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="mname" name="mname" placeholder="Enter Middle Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Suffix</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="suffix" name="suffix" placeholder="Enter Suffix" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Contact Number</label>
                            <input type="text" id="number" name="number" placeholder="Enter Contact Number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Guardian</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="guardian" name="guardian" placeholder="Enter Fullname" >
                        </div>
                            <div class="profiling-input-field">
                                <label>Region</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" id="region" name="region" placeholder="Enter Region">
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Province</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" id="province" name="province" placeholder="Enter Province">
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Municipality</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" id="municipality" name="municipality" placeholder="Enter Municipality" >
                            </div>
                            <div class="profiling-input-field">
                                <label>Barangay</label>
                                <select type="text" oninput="capitalizeFirstLetter(this)" id="barangay" name="barangay" placeholder="Enter Barangay" >
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
                            <label>Sex</label>
                            <select name="sex" id="sex">
                                <option disabled selected>Select gender</option>
                                <option>M</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Birthday</label>
                            <input type="date" id="bday" name="bday" placeholder="Enter Deferral" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Deferral</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="deferral" name="deferral" placeholder="Enter Deferral" >
                        </div>
						<div class="profiling-input-field">
                            <label>Reason for Deferral</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="reason" name="reason" placeholder="Enter Reason for Deferral" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Date of Vaccination</label>
                            <input type="date" id="date" name="vaccine_date" placeholder="Enter date of vaccination" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Vaccine Manufacturer</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="vaccine-manu"  name="vaccine_manufacturer" placeholder="Enter date of vaccination" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Batch Number</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="batch" name="batch" placeholder="Enter Batch number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Lot No.</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="lot" name="lot" placeholder="Enter Lot number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Bakuna</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="bakuna" name="bakuna" placeholder="Enter Name of Bakuna" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Vaccinator Name</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" id="vaccinator" name="vaccinator" placeholder="Enter Vaccinator Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>First Dose</label>
                            <select name="first" id="firsts">
                                <option disabled selected>Select Dose</option>
                                <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Second Dose</label>
                            <select name="second" id="seconds">
                                <option disabled selected>Select Vaccine</option>
                                < <option>Not yet</option>
  
  <option>Pfizer</option>
  <option>Astrazenica</option>
  <option>Sinovac</option>
  <option>Moderna</option>
  <option>Johnson and Janseen</option>
  <option>Sputnik V</option>
                            </select>
                        </div>
                        
                        <div class="profiling-input-field">
                            <label>First Booster Dose</label>
                            <select name="first_booster" id="firstbooster">
                                <option disabled selected>Select Vaccine</option>
                                <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Second Booster Dose</label>
                            <select name="second_booster" id="secbooster">
                                <option disabled selected>Select Vaccine</option>
                                <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Adverse</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="adverse" id="adverse" placeholder="Enter ward number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Adverse Event Condition</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="event" id="event" placeholder="Enter ward number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Row Hash</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="row" id="row" placeholder="Enter Deferral" >
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
                <form action="../export/export_vaccination.php" method="POST">

                    <div class="feedback-content">
						<span class="feedback-title">Export Data</span>
                		<p class="feedback-message">Select Date of the data you want to export</p>
						<label for="from">From:</label>
						<input type="date" name="from"  class="setdate">
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
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="feedback-image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg></div>
                <form action="../update_data/vaccination-delete.php" method="POST">

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
                <form  action="../Add record/import_vaccination.php" method="POST" enctype="multipart/form-data">
				<div class="gender-details">
    <div class="container-imgs">
        <div class="img-area" data-img="">
            <i class='bx bxs-cloud-upload icon'></i>
            <h3>Upload excel</h3>
        </div>
        <label for="elder" class="custom-file-input add">Upload Excel file</label>
        <input class="add" id="elder" type="file"  value="" accept=".xlsx, .xls" name="excel" hidden>
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
				<a href="#" class="active" ><i class='bx bxs-receipt icon' ></i> Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown show">
					<li ><a href="../Profiling/profiling-all.php" >Profiling</a></li>
					<li ><a href="../checkup/checkup-all.php">Checkup</a></li>
					<li><a href="../OTP/OTP-all.php">OPT</a></li>
					<li><a href="../Immunization/Immunization-all.php">Immunization</a></li>
					<li><a href="vaccination-all.php" class="active-now">Vaccination</a></li>
					<li><a href="../Senior/Senior-all.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#" ><i class='bx bxs-receipt icon' ></i> Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li ><a href="../profiling-choices.php" >Profiling</a></li>
					<li ><a href="../checkup-choices.php" >Checkup</a></li>
					<li><a href="../OTP-choices.php">OPT</a></li>
					<li><a href="../Immunization-choices.php">Immunization</a></li>
					<li><a href="../vaccination-choices.php" >Vaccination</a></li>
					<li><a href="">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			
			<li>
				<a href="#"><i class='bx bxs-user icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="../../Account Managment/Profile.php" >Personal Information</a></li>
					<li><a href="../../Account Managment/Account Settings.php">Account Settings</a></li>
				</ul>
			</li>
			<li><a href="../Account Managment/Profile.html"><i class='bx bxs-chart icon' ></i> Profile</a></li>
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
			<div class="data">
				<div class="content-data">
					<div class="head">
					
						<h3> Vaccination Data</h3>
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
                        <button id="downloadButton" class="add">Download Form Template</button>
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
    link.download = 'Vaccination_form_template.xlsx';

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

        <header>Vaccination</header>

        <form action="../Add record/vaccination.php" method="POST">
            <div class="profiling-form first">
                <div class="profiling-details personal">
                    <span class="profiling-title">Personal Details</span>
                        <div class="profiling-fields">
                             <div class="profiling-input-field">
                                <label>Category<span class="red">*</span></label>
                                <select name="category" >
                                    <option disabled selected>Select Category</option>
                                    <option>A1</option>
                                    <option>A2</option>
                                    <option>A3</option>
									<option>A4</option>
                                    <option>A5</option>
                                    <option>ROAP</option>
									<option>ROPP 5-11 YEARS OLD</option>
                                    <option>ROPP 12-17 YEARS OLD</option>
                                </select>
                        </div>
                        <div class="profiling-input-field">
                            <label> Comorbidity</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="comorbidity" placeholder="Enter Comorbidity" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Unique  Person  ID</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="id" placeholder="Enter Person ID" >
                        </div>

                        <div class="profiling-input-field">
                            <label>Person With Disability(Specify)</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="pwd" placeholder="Enter Disability" >
                        </div>

                        <div class="profiling-input-field">
                            <label>IP Group(Specify)</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="ip" placeholder="Enter IP Group" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Last Name<span class="red">*</span></label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="lname" placeholder="Enter Last Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>First Name<span class="red">*</span></label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="fname" placeholder="Enter First Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Middle Name<span class="red">*</span></label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="mname" placeholder="Enter Middle Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Suffix</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="suffix" placeholder="Enter Suffix" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Contact Number<span class="red">*</span></label>
                            <input type="text" name="number" placeholder="Enter Contact Number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Guardian<span class="red">*</span></label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="guardian" placeholder="Enter Fullname" >
                        </div>
                            <div class="profiling-input-field">
                                <label>Region</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="region" placeholder="Enter Region">
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Province</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="province" placeholder="Enter Province">
                            </div>
    
                            <div class="profiling-input-field">
                                <label>Municipality</label>
                                <input type="text" oninput="capitalizeFirstLetter(this)" name="municipality" placeholder="Enter Municipality" >
                            </div>
                            <div class="profiling-input-field">
                                <label>Barangay<span class="red">*</span></label>
                                <select type="text" oninput="capitalizeFirstLetter(this)" name="barangay" placeholder="Enter Barangay" >
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
                            <label>Sex</label>
                            <select name="sex">
                                <option disabled selected>Select gender</option>
                                <option>M</option>
                                <option>F</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Birthday<span class="red">*</span></label>
                            <input type="date" name="bday" placeholder="Enter Deferral" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Deferral</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="deferral" placeholder="Enter Deferral" >
                        </div>
						<div class="profiling-input-field">
                            <label>Reason for Deferral</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="reason" placeholder="Enter Reason for Deferral" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Date of Vaccination<span class="red">*</span></label>
                            <input type="date" name="vaccine_date" placeholder="Enter date of vaccination" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Vaccine Manufacturer</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)"  name="vaccine_manufacturer" placeholder="Enter date of vaccination" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Batch Number</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="batch" placeholder="Enter Batch number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Lot No.</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="lot" placeholder="Enter Lot number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Bakuna</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="bakuna" placeholder="Enter Name of Bakuna" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Vaccinator Name<span class="red">*</span></label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="vaccinator" placeholder="Enter Vaccinator Name" >
                        </div>
                        <div class="profiling-input-field">
                            <label>First Dose</label>
                            <select name="first">
                            <option disabled selected>Select Vaccine</option>
                                   <option>Not yet</option>
  
                                   <option>Pfizer</option>
                                   <option>Astrazenica</option>
                                   <option>Sinovac</option>
                                   <option>Moderna</option>
                                   <option>Johnson and Janseen</option>
                                   <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Second Dose</label>
                            <select name="second">
                            <option disabled selected>Select Vaccine</option>
     <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        
                        <div class="profiling-input-field">
                            <label>First Booster Dose</label>
                            <select name="first_booster">
                            <option disabled selected>Select Vaccine</option>
     <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Second Booster Dose</label>
                            <select name="second_booster">
                            <option disabled selected>Select Vaccine</option>
     <option>Not yet</option>
  
     <option>Pfizer</option>
     <option>Astrazenica</option>
     <option>Sinovac</option>
     <option>Moderna</option>
     <option>Johnson and Janseen</option>
     <option>Sputnik V</option>
                            </select>
                        </div>
                        <div class="profiling-input-field">
                            <label>Adverse</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="adverse" placeholder="Enter ward number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Adverse Event Condition</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="event" placeholder="Enter ward number" >
                        </div>
                        <div class="profiling-input-field">
                            <label>Row Hash</label>
                            <input type="text" oninput="capitalizeFirstLetter(this)" name="row" placeholder="Enter Deferral" >
                        </div>
                    </div>
                </div>
                    <div class="profiling-buttons">       
                        <button class="sumbit" type="submit">
                            <span class="profiling-btnText">Submit</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                	</div> 
            </div>
        </form>
    </div>
</div>
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

							<div class="table-wrapper">
						<table  id="filteredData" class="display emp-table" style="width: 100%;">
							<thead>
								<tr>
								<th col-index = 2>Category                 
										<select class="table-filter" onchange="filter_rows()">
											<option value="all"></option>
										</select>
								</th>
								<th col-index = 3 hidden>Comorbidity</th>
								<th col-index = 4 hidden>Unique Person ID</th>
								<th col-index = 5 hidden>PWD               
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 6 hidden>Belongs to IP Group Yes/No                   
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 7>Full Name</th>
								<th col-index = 8>Contact Number</th>
								<th col-index = 9>Guardian</th>
								<th col-index = 10>Region</th>
								<th col-index = 11>Provice</th>
								<th col-index = 12>Municipality</th>
								<th col-index = 13>Barangay</th>
								<th col-index = 14>Sex</th>
								<th col-index = 15>Birthday</th>
								<th col-index = 16h hidden>Deferral </th>
								<th col-index = 17 hidden>Reason for Deferral</th>
                                <th col-index = 18>Vaccination Date</th>
								<th col-index = 19>Vaccine Manufacturer                  
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 20>Batch Number</th>
								<th col-index = 21>Lot No.</th>
								<th col-index = 22>Bakuna</th>
								<th col-index = 23>Vaccinator Name</th>
								<th col-index = 24>First Dose
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 25>Second Dose
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 26>First Booster          
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 27>Second Booster            
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>            
								<th col-index = 28 hidden>Adverse Event                          
									
								</th>      
								<th col-index = 29 hidden> Adverse Event Condition                                      
								</th> 
								<th col-index = 30 hidden> Row Hash                                    
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 31>Action</th>

							</tr>
							</thead>
							<tbody>
							<?php
							
                            $sql ="SELECT p.*, pi.*, mi.*, vi.*, age.*, ta.*
                            FROM vaccination p
                            LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
                            LEFT JOIN vaccine mi ON pi.Record_ID = mi.Record_ID
                            LEFT JOIN vaccine_other_information vi ON pi.Record_ID = vi.Record_ID
                            LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
                            LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
                            GROUP BY p.Record_ID
                            ";	
                            							    $result = mysqli_query($conn, $sql);
							    if (mysqli_num_rows($result) > 0) { // Check if there are rows returned
								        while ($row = mysqli_fetch_assoc($result)) {
								            ?>
								            <tr>
											<input type="hidden" class="record-id" value="<?php echo $row["Record_ID"]; ?>">

								                <td><?php echo $row["Category"] ?></td>
								                <td hidden><?php echo $row["Comorbidity"] ?></td>
								                <td hidden><?php echo $row["Unique_Person_ID"] ?></td>
								                <td hidden><?php echo $row["PWD"] ?></td>
								                <td hidden><?php echo $row["IP"] ?></td>
								                <td><a class="btnnn viewbtn"><?php echo $row["LName"].' '.$row["FName"].' '.$row["MName"].' '.$row["suffix"] ?></a></td>
								                <td><?php echo $row["contact_num"] ?></td>
								                <td><?php echo $row["Guardian"] ?></td>
								                <td><?php echo $row["Region"] ?></td>
								                <td><?php echo $row["Province"] ?></td>
												<td><?php echo $row["Municipality"] ?></td>
								                <td><?php echo $row["Barangay"] ?></td>
								                <td><?php echo $row["sex"] ?></td>
								                <td><?php echo $row["birthdate"] ?></td>
                                                <td hidden><?php echo $row["Deferral"] ?></td>
                                                <td hidden><?php echo $row["Reason_for_Deferral"] ?></td>
                                                <td><?php echo $row["Vaccination_Date"] ?></td>
								                <td><?php echo $row["Vaccine_Manufacturer"] ?></td>
												<td><?php echo $row["Batch_Number"] ?></td>
								                <td><?php echo $row["Lot_num"] ?></td>
												<td><?php echo $row["Bakuna"] ?></td>
								                <td><?php echo $row["Vaccinator"] ?></td>
								                <td><?php echo $row["First_Dose"] ?></td>
								                <td><?php echo $row["Second_Dose"] ?></td>
								                <td><?php echo $row["First_Booster"] ?></td>
								                <td><?php echo $row["Second_Booster"] ?></td>
								                <td hidden><?php echo $row["Adverse_Event"] ?></td>
								                <td hidden><?php echo $row["Adverse_Condition"] ?></td>
                                                <td hidden><?php echo $row["Row_hash"] ?></td>



							                <td>
											<button type="button" class="btnn editbtn"> Update </button>
													<button type="button" class="btn btn-danger deletebtn"> Delete </button>
						                </td>
						            </tr>
							            <?php
						        }
						    } else {
								        echo "<tr><td colspan='17'>No data found</td></tr>";
							    }
							?>

							</tbody>
                            <tfoot>
                            <tr>
								<th col-index = 2>Category                 
										<select class="table-filter" onchange="filter_rows()">
											<option value="all"></option>
										</select>
								</th>
								<th col-index = 3 hidden>Comorbidity</th>
								<th col-index = 4 hidden>Unique Person ID</th>
								<th col-index = 5 hidden>PWD               
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 6 hidden>Belongs to IP Group Yes/No                   
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 7>Full Name</th>
								<th col-index = 8>Contact Number</th>
								<th col-index = 9>Guardian</th>
								<th col-index = 10>Region</th>
								<th col-index = 11>Provice</th>
								<th col-index = 12>Municipality</th>
								<th col-index = 13>Barangay</th>
								<th col-index = 14>Sex</th>
								<th col-index = 15>Birthday</th>
								<th col-index = 16 hidden>Deferral </th>
								<th col-index = 17 hidden>Reason for Deferral</th>
                                <th col-index = 18>Vaccination Date</th>
								<th col-index = 19>Vaccine Manufacturer                  
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 20>Batch Number</th>
								<th col-index = 21>Lot No.</th>
								<th col-index = 22>Bakuna</th>
								<th col-index = 23>Vaccinator Name</th>
								<th col-index = 24>First Dose
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 25>Second Dose
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 26>First Booster          
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 27>Second Booster            
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>            
								<th col-index = 28 hidden>Adverse Event                          
									
								</th>      
								<th col-index = 29 hidden> Adverse Event Condition                                      
								</th> 
								<th col-index = 30 hidden> Row Hash                                    
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 31>Action</th>

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


            $(document).on('click','.viewbtn', function () {
          

                $('#viewmodal').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();
                var nameParts = data[5].trim().split(' ');


				$('#view_id').val(recordId);
				$('#categorys').val(data[0]);
				$('#comorbiditys').val(data[1]);
				$('#ids').val(data[2]);
				$('#pwds').val(data[3]);
				$('#ips').val(data[4]);
				$('#numbers').val(data[6]);
				$('#guardians').val(data[7]);
				$('#regions').val(data[8]);
				$('#provinces').val(data[9]);
				$('#municipalitys').val(data[10]);
				$('#barangays').val(data[11]);
				$('#sexs').val(data[12]);
				$('#bdays').val(data[13]);
				$('#deferrals').val(data[14]);
				$('#reasons').val(data[15]);
				$('#dates').val(data[16]);
                $('#vaccine-manus').val(data[17]);
				$('#batchs').val(data[18]);
				$('#lots').val(data[19]);
				$('#bakunas').val(data[20]);
				$('#vaccinators').val(data[21]);
				$('#firstss').val(data[22]);
				$('#secondss').val(data[23]);
				$('#firstboosters').val(data[24]);
				$('#secboosters').val(data[25]);
				$('#adverses').val(data[26]);
				$('#events').val(data[27]);
				$('#rows').val(data[28]);
                $('#lnames').val(nameParts[0]);
$('#fnames').val(nameParts[1]);
$('#mnames').val(nameParts[2]);




				
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
                var nameParts = data[5].trim().split(' ');


				$('#update_id').val(recordId);
				$('#category').val(data[0]);
				$('#comorbidity').val(data[1]);
				$('#id').val(data[2]);
				$('#pwd').val(data[3]);
				$('#ip').val(data[4]);
				$('#number').val(data[6]);
				$('#guardian').val(data[7]);
				$('#region').val(data[8]);
				$('#province').val(data[9]);
				$('#municipality').val(data[10]);
				$('#barangay').val(data[11]);
				$('#sex').val(data[12]);
				$('#bday').val(data[13]);
				$('#deferral').val(data[14]);
				$('#reason').val(data[15]);
				$('#date').val(data[16]);
                $('#vaccine-manu').val(data[17]);
				$('#batch').val(data[18]);
				$('#lot').val(data[19]);
				$('#bakuna').val(data[20]);
				$('#vaccinator').val(data[21]);
				$('#firsts').val(data[22]);
				$('#seconds').val(data[23]);
				$('#firstbooster').val(data[24]);
				$('#secbooster').val(data[25]);
				$('#adverse').val(data[26]);
				$('#event').val(data[27]);
				$('#row').val(data[28]);
                $('#lname').val(nameParts[0]);
$('#fname').val(nameParts[1]);
$('#mname').val(nameParts[2]);




				
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