<?php
include "../Account/update_data/config.php";

if (!isset($_SESSION['UserName'])) {
    header("Location: ../../index.php"); // Redirect to the login page if not logged in
    exit();
}
?><!DOCTYPE html>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

	<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/calendar.css">
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
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document"></div>
		<div class="profiling-container">
        	<header>Appointment Change Status form</header>
                <form action="../Account/update_data/update_appointment.php" method="POST">
					
				<input type="hidden" name="update_id" id="update_id">
            <div class="profiling-form first">
                <div class="profiling-details personal">
                    <span class="profiling-title">Details</span>
                    <div class="profiling-fields">
							<div class="profiling-input-field">
                                <label>Medicine Given </label>
                                <input type="text" id="water" name="medicine" placeholder="Enter Medicine given" >
                            </div>
							<div class="profiling-input-field">
                                <label>Tooth exctracted </label>
                                <input type="text"  name="tooth" placeholder="Enter tooth extracted" >
                            </div>
                    </div>
                </div>
                    <div class="profiling-button-action">
                        <button type="button" class="cancel" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="profiling-nextBtn">Remark</button>
                    </div>
					</div> 
            </div>
                </form>

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
                <form action="../Account/update_data/delete_approve.php" method="POST">

                    <div class="feedback-content">

                        <input type="hidden" name="delete_id" id="delete_id">
						<span class="feedback-title">Delete Record</span>
                		<p class="feedback-message">Are you sure you want to Delete the Record? All of the data will be permanently removed. This action cannot be undone.</p>
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
                <form action="../Account/update_data/export_appointment.php" method="POST">

                    <div class="feedback-content">

                        <input type="hidden" name="delete_id" id="delete_id">
						<span class="feedback-title">Export Data</span>
                		<p class="feedback-message">Select Date of the data you want to export</p>
						<label for="from">From:</label>
						<input type="date" name="from" class="setdate">
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
			<h1 class="title">Appointment Calendar</h1>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<div class="menu">
							
						</div>
					</div>
                    <div class="calendar-wrapper">
      <header>
        <p class="current-date"></p>
        <div class="icons">
          <span id="prev" class="material-symbols-rounded">chevron_left</span>
          <span id="next" class="material-symbols-rounded">chevron_right</span>
        </div>
      </header>
      <div class="calendar">
        <ul class="weeks">
          <li>Sun</li>
          <li>Mon</li>
          <li>Tue</li>
          <li>Wed</li>
          <li>Thu</li>
          <li>Fri</li>
          <li>Sat</li>
        </ul>
        <ul class="days"></ul>
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
	<script src="../js/script.js"></script>
    <script src="../js/calendar.js"></script>

	<script>
    $(document).ready(function () {
        $('.deletebtn').on('click', function () {
            $('#deletemodal').modal('show');

            var recordId = $(this).closest('tr').find('.record-id').val();
            $('#delete_id').val(recordId);
        });
    });
</script>
<script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

				var recordId = $(this).closest('tr').find('.record-id').val();

				$('#update_id').val(recordId);			
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
        $('.logout').on('click', function () {
            $('#logoutmodal').modal('show');
        });
    });
</script>

</body>
</html>