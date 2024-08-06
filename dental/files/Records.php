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
		   <a href="../Account/update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
            <a href=""> <button class="logout-cancel" type="button" data-dismiss="modal">Cancel</button></a>
          </div>
        </div>
        </div>
        </div>
    </div>
	<div class="modal fade" id="add_user_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="full-container-box">
		<div class="container-box">
                      <div class="title" >Registration</div>
                      <div class="content">
                        <form action="../Account/update_data/update_record.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="update_record_id" id="update_record_id">

						<div class="user-detail">
                            <div class="input-boxes">
                              <span class="details">Full Name</span>
                              <input type="text" id="name" name="fullname" placeholder="Enter your name" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Address</span>
                              <input type="text" id="address" name="address" placeholder="Enter your username" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Phone Number</span>
                              <input type="text" id="number" name="number" placeholder="Enter your number" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Birthday</span>
                              <input type="date" name="bday" id="bday" placeholder="Enter Birthdate" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Date of Appointment</span>
                              <input type="date" name="appointment" id="appointment" placeholder="Confirm your password" required>
							  
                            </div>
							<div class="input-boxes">
                              <span class="details">Medecine Given</span>
                              <input type="text"  name="medicine" id="medicine" placeholder="Enter medicine given" required>
                            </div>
							<div class="input-boxes">
                              <span class="details">Tooth Extracted</span>
                              <input type="text"  name="tooth" id="tooth" placeholder="Enter name of Tooth extracted" required>
                            </div>
                          </div>
						  <div class="profiling-action">
                        <button type="submit" name="updatedata" class="export">Update </button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>

                    </div>
                        </form>
                      </div>
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
                <form action="../Account/update_data/delete.php" method="POST">

                    <div class="feedback-content">

                        <input type="hidden" name="delete_id" id="delete_id">
						<span class="feedback-title">Delete Record</span>
                		<p class="feedback-message">Are you sure you want to Delete the Tecord? All of the data will be permanently removed. This action cannot be undone.</p>
                    </div>
					<div class="profiling-action">
                        <button type="submit" name="deletedata" class="export">Delete</button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>

                    </div>
                </form>

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
                <form action="../Account/update_data/export_data.php" method="POST">

                    <div class="feedback-content">

                        <input type="hidden" name="delete_id" id="delete_id">
						<span class="feedback-title">Export Data</span>
                		<p class="feedback-message">Select Date of the data you want to export</p>
						<label for="from">From:</label>
						<input type="date" name="from" id="update_id" class="setdate">
						<label for="from">To:</label>
						<input type="date" name="to" id="update_id" class="setdate">
                    </div>
                    <div class="profiling-action">
                        <button type="submit" name="exportdata" class="export">Export</button>
						<button type="button" class="dismiss" data-dismiss="modal"> Cancel </button>

                    </div>
                </form>

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
			<li><a href="#"class="active" ><i class='bx bxs-receipt icon' ></i> Records</a></li>
			<li><a href="Rejected.php" ><i class='bx bxs-receipt icon' ></i> Rejected Appointments</a></li>

			<li><a href="profiling-all.php" ><i class='bx bxs-receipt icon' ></i> Profiling Records</a></li>
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
				echo '<img src="../Account/images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="../Account/uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
				}
				?>				
				<ul class="profile-link">
					<li><a href="../Account/Profile.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="..//Account/Account Settings.php"><i class='bx bxs-cog' ></i> Settings</a></li>
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
						<h3>Records</h3>
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
					<button class="gen export"> Generate Report</button>
					<form action="generate/report_elder.php" method="POST">
						</form>
							</div>
<div class="table-wrapper">
						<table  id="myTable" class="emp-table">
						<thead>
								<tr>
								<th col-index = 1>Full Name</th>
								<th col-index = 2>Address</th>
								<th col-index = 3>Contact Number</th>
								<th col-index = 5>Age</th>
								<th col-index = 6>Birthday (mm/dd/yyyy)</th>
								<th col-index = 7>Date of Appointment</th>
								<th col-index = 9>Medicine Given</th>
								<th col-index = 9>Tooth Extracted</th>
								<th col-index = 10>Action</th>
								 
							</tr>
							</thead>
							<tbody>
							<!-- WHERE Status='Done' -->
							<?php
					$sql = "SELECT a.*, pi.*, age.*, ai.*FROM appointment a INNER JOIN personal_information pi ON a.Record_ID = pi.Record_ID
					INNER JOIN age_table age ON a.Record_ID = pi.Record_ID INNER JOIN address_information ai on ai.Record_ID = a.Record_ID  WHERE Status='Complete' GROUP BY a.Appointment_ID";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									?>
								  <tr>
								  <input type="hidden" class="record_id" value="<?php echo $row["Appointment_ID"]; ?>">

								  <td><?php echo $row["FName"].' '.$row["MName"].' '.$row["MName"] ?></td>
								  <td><?php echo $row["Barangay"] ?></td>
								    <td><?php echo $row["contact_num"] ?></td>
									<td><?php echo $row["Age"] ?></td>
								  <td><?php echo $row["birthdate"] ?></td>
									<td><?php echo $row["Appointment_date"] ?></td>
									<td><?php echo $row["Medicine_given"] ?></td>
									<td><?php echo $row["tooth"] ?></td>

									<td>
									<button type="button" class="btnn updatebtn"> Update </button>
											<button type="button" class="btn btn-danger deletebtn"> Delete </button>
								    </td>
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
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<script src="js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script>
    $(document).ready(function () {
        $('.deletebtn').on('click', function () {
            $('#deletemodal').modal('show');

            var recordId = $(this).closest('tr').find('.record_id').val();
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

            $('.updatebtn').on('click', function () {

                $('#add_user_update').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

				$('#update_record_id').val(recordId);
                $('#name').val(data[0]);
                $('#address').val(data[1]);
                $('#number').val(data[2]);
                $('#bday').val(data[4]);
				$('#appointment').val(data[5]);
                $('#medicine').val(data[6]);
                $('#tooth').val(data[7]);


				
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