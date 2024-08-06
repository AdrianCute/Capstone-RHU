<?php
include "../Account/update_data/config.php";

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
		   <a href="../Account/update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
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
				<a href="Pending Appointments.php" ><i class='bx bxs-receipt icon' ></i> Pending Appointments </a>
			</li>
			<li><a href="Records.php" ><i class='bx bxs-receipt icon' ></i> Records</a></li>
			<li><a href="Rejected.php" ><i class='bx bxs-receipt icon' ></i> Rejected Appointments</a></li>

            <li><a href="profiling-all.php" class="active" ><i class='bx bxs-receipt icon' ></i> Profiling Records</a></li>
			<li>
				<a href="#"><i class='bx bxs-user-account icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="../Account/Profile.php" >Personal Information</a></li>
					<li><a href="../Account/Account Settings.php">Account Settings</a></li>
				</ul>
			</li>				
			<li><a href="../Account/users.php"><i class='bx bxs-user icon' ></i> Users</a></li>
			<li class="divider" data-text="Action"></li>
			<li><a href="#" class="logout"><i class='bx bxs-log-out icon' ></i> Logout</a></li>
		</ul>
	</section>

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
				echo '<img src="../Account/images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="../Account/uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
				}
				?>						<ul class="profile-link">
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
						<h3>Profiling Records</h3>
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
					
						<table  id="filteredData" class="display emp-table" style="width:100%">
							<thead>
								<tr>
								<th col-index = 2>Date of Visit</th>
								<th col-index = 3>Household Number</th>
								<th col-index = 4>Barangay</th>
								<th col-index = 5>Number of Families</th>
								<th col-index = 6>Fullname</th>
								<th col-index = 7>Relationship to Head</th>
								<th col-index = 8>Date of Birth</th>
								<th col-index = 9>Age</th>
								<th col-index = 10>Sex</th>
								<th col-index = 11>Civil Status        
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 12>Educational Attainment</th>
								<th col-index = 13>Religion
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 14>Ethnicity
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 15>4Ps Member    
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 16>4Ps number
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>            
								<th col-index = 17>Philhealth Category  
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>      
								<th col-index = 18>Philhealth number                      
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>    
								<th col-index = 19>Medical history                  
									
								</th>    
								<th col-index = 20>Classification                     
									
								</th>    
								<th col-index = 21>Menstrual                   
									
									</th>  
								<th col-index = 22>Using Fp method                     
									
								</th>    
								<th col-index = 23>Method use                 
									
								</th>    
								<th col-index = 24>Fp Status                 
									
								</th>    
								<th col-index = 25>Water        
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>    
								<th col-index = 26>Toilet                   
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>    
							
							</tr>
							</thead>
							<tbody>
							<?php
                                  $sql ="SELECT p.*, pi.*, mi.*, oi.*, age.*, ta.* FROM profiling p
								  LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
								  LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
								LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
								LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
								LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
	

                            
                            GROUP BY p.Record_ID";							    
                                                            ;							    
							  $result = mysqli_query($conn, $sql);
							    if (mysqli_num_rows($result) > 0) { // Check if there are rows returned
								        while ($row = mysqli_fetch_assoc($result)) {
								            ?>
								            <tr>
											<input type="hidden" class="record-id" value="<?php echo $row["Record_ID"]; ?>">

								                <td><?php echo $row["Visit"] ?></td>
								                <td><?php echo $row["household_num"] ?></td>
								                <td><?php echo $row["Barangay"] ?></td>
								                <td><?php echo $row["number_family"] ?></td>
								                <td><?php echo $row["LName"].', '.$row["FName"].', '.$row["MName"] ?></td>
												<td><?php echo $row["relationship"] ?></td>
												<td><?php echo $row["birthdate"] ?></td>
								                <td><?php echo $row["Age_in_years_months"] ?></td>
                                                <td><?php echo $row["sex"] ?></td>
								                <td><?php echo $row["civil_status"] ?></td>
								                <td><?php echo $row["education"] ?></td>
								                <td><?php echo $row["religion"] ?></td>
                                                <td><?php echo $row["Ethinicity"] ?></td>
								                <td><?php echo $row["fourps"] ?></td>
												<td><?php echo $row["fourps_number"] ?></td>
								                <td><?php echo $row["phil_category"] ?></td>
								                <td><?php echo $row["phil_number"] ?></td>
								                <td><?php echo $row["history"] ?></td>
								                <td><?php echo $row["classification"] ?></td>
												<td><?php echo $row["mentraul"] ?></td>
								                <td><?php echo $row["UsingFp"] ?></td>
								                <td><?php echo $row["method_use"] ?></td>
								                <td><?php echo $row["fp_status"] ?></td>
								                <td><?php echo $row["water"] ?></td>
								                <td><?php echo $row["toilet"] ?></td>
							                
						            </tr>
							            <?php
						        }
						    } else {
							    }
							?>

							</tbody>
                            <tfoot>
                            <tr>
								<th col-index = 2>Date of Visit</th>
								<th col-index = 3>Household Number</th>
								<th col-index = 4>Barangay</th>
								<th col-index = 5>Number of Families</th>
								<th col-index = 6>Fullname</th>
								<th col-index = 7>Relationship to Head</th>
								<th col-index = 8>Date of Birth</th>
								<th col-index = 9>Age</th>
								<th col-index = 10>Sex</th>
								<th col-index = 11>Civil Status        
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 12>Educational Attainment</th>
								<th col-index = 13>Religion
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 14>Ethnicity
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 15>4Ps Member    
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>
								<th col-index = 16>4Ps number
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>            
								<th col-index = 17>Philhealth Category  
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>      
								<th col-index = 18>Philhealth number                      
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>    
								<th col-index = 19>Medical history                  
									
								</th>    
								<th col-index = 20>Classification                     
									
								</th>    
								<th col-index = 21>Menstrual                   
									
									</th>  
								<th col-index = 22>Using Fp method                     
									
								</th>    
								<th col-index = 23>Method use                 
									
								</th>    
								<th col-index = 24>Fp Status                 
									
								</th>    
								<th col-index = 25>Water        
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>    
								<th col-index = 26>Toilet                   
									<select class="table-filter" onchange="filter_rows()">
										<option value="all"></option>
									</select>
								</th>    

							</tr>
                            </tfoot>
							<script src="../../js/filter.js"></script>
						</table>
<script>

var dataTable = $('#filteredData').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'colvis'
    ],
    fixedHeader: {
        header: true, // Fix the header
        footer: false // You can also fix the footer if needed
    }
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
	<script src="../js/script.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	



<script>
    $(document).ready(function () {
        $('.export').on('click', function () {
            $('#exportmodal').modal('show');
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



</body>
</html>