
<?php
include "files/update_data/config.php";

if (!isset($_SESSION['UserName'])) {
    header("Location: ../index.php"); // Redirect to the login page if not logged in
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
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="../images/LOGO.png">

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
             <a href="files/update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
            <a href=""> <button class="logout-cancel" type="button" data-dismiss="modal">Cancel</button></a>
          </div>
        </div>
        </div>
        </div>
    </div>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<i class=" bx bx-x icons" id="closeToggle"></i>
		<a href="#" class="brand"><img src="../images/LOGO.png" alt="" class='bx icon'>RHU
		</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li><a href="files/Appointment.php"><i class='bx bxs-calendar icon' ></i> Set Appointment</a></li>
			<li><a href="files/personal_record.php"><i class='bx bxs-receipt icon' ></i> Personal Record</a></li>
			<li><a href="files/Profile.php"><i class='bx bxs-user icon' ></i> Profile</a></li>
			<li><a href="files/Account_settings.php"><i class='bx bx-cog icon' ></i> Account Settings</a></li>
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
					<!-- <input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i> -->
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
						echo '<img src="files/images/default-avatar.png" class="profile-img">';
					}else{
						echo '<img src="files/uploaded_img/'.$fetch['Profile'].'" class="profile-img" >';
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
			<h1 class="title">Dashboard</h1>
			<div class="data">

				<div class="content-data">
					<div class="head">
						<h3>Appointment Status</h3>
						<div class="menu">
						
						</div>
					</div>
					<?php
$sql = "SELECT a.*, ui.*, ai.*, age.* FROM appointment a INNER JOIN personal_information ui ON ui.Record_ID = a.Record_ID
INNER JOIN address_information ai ON ai.Record_ID = a.Record_ID
INNER JOIN age_table age ON age.Record_ID = a.Record_ID
 WHERE  Status = 'Pending' AND a.User_ID = '".$_SESSION['User_ID']."' LIMIT 1";
$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
      <form action="php/appointment.php" method="POST" class="form">
		<div class="column">
        <div class="input-box">
          <label>Full Name:</label>
          <input type="text" name="Fname" value="<?php echo $_SESSION['FName'].' '.$_SESSION['MName'].' '.$_SESSION['LName']?>" required disabled />
         </div>
		 <div class="input-box">
          <label>Address:</label>
          <input type="text" name="Address" value="<?php echo $row["Barangay"]?>" required disabled/>
         </div>

		 <div class="input-box">
          <label>Contact Number:</label>
          <input type="text" name="number" value="<?php echo $row["contact_num"] ?>" required disabled/>
         </div>
		 </div>

		 <div class="column">
		 <div class="input-box">
          <label>Date Sent:</label>
          <input type="text" name="address" value="<?php echo $row["Date"] ?>" required disabled/>
         </div>
          <div class="input-box">
            <label>Age: </label>
            <input type="text" name="number" value="<?php echo $row["Age"] ?>" placeholder="" required disabled/>
          </div>
          <div class="input-box">
            <label>Birthday:</label>
            <input type="date" name="birthday" value="<?php echo $row["birthdate"]  ?>" placeholder="Enter birth date" required disabled/>
          </div>
		  </div>
		  <div class="column">
          <div class="input-box">
            <label>Service Acquiring: </label>
            <input type="text" name="number" value="<?php echo $row["Service"] ?>" placeholder="" required disabled/>
          </div>
		  <div class="input-box">
            <label>Appoinment Date: </label>
            <input type="date" name="number" value="<?php echo $row["Appointment_date"] ?>" placeholder="" required disabled/>
          </div>
          <div class="input-box">
            <label>Status:</label>
            <input type="text" name="birthday" value="<?php echo $row["Status"]  ?>" style="color: red;" placeholder="Enter birth date" required disabled/>
          </div>
		  
		  
        </div>
      </form>
         
		   <?php
        }
    } else {
        // Add a class to hide the entire data container
        ?>
        <?php
    }
    ?>
					</div>
				</div>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- NAVBAR -->

	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<script src="js/script.js"></script>
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