<?php
include "update_data/config.php";

// session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: ../../index.php"); // Redirect to the login page if not logged in
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
	<link rel="icon" href="../../images/LOGO.png">


	<title>RHU</title>
</head>
<body>
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image</h5>
				<div class="image-close" data-dismiss="modal"><i class='bx bx-x icon'></i>   </div>       
            </div>
            <div class="modal-body">
                <img id="enlargedImg" src="" alt="Enlarged Image">
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
                        <form action="update_data/update.php" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="update_user" id="update_request">

						<div class="user-detail">
                            <div class="input-boxes">
                              <span class="details">Full Name</span>
                              <input type="text" id="name" name="fullname" placeholder="Enter your name" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Username</span>
                              <input type="text" id="uname" name="uname" placeholder="Enter your username" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Barangay</span>
                              <input type="text" id="address" name="address" placeholder="Enter your Address"  required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Phone Number</span>
                              <input type="text" id="number" name="number" placeholder="Enter your number" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Password</span>
                              <input type="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Confirm Password</span>
                              <input type="password"  name="confirm" placeholder="Confirm your password" required>
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
<div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                              <span class="details">Username</span>
                              <input type="text" name="uname" placeholder="Enter your username" required>
                            </div>
                            <div class="input-boxes">
                              <span class="details">Barangay</span>
                              <input type="text" name="address" placeholder="Enter your Address"  value="<?php echo $_SESSION['Address'] ?>" required>
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
						  <div class="gender-detail">
										<span class="details">Profile Picture</span>
										<div class="container-imges">
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
					<div class="profiling-action">
                        <button type="submit" name="updatedata" class="export">Add Account</button>
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

			<div class="feedback-image">
				<svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                        <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                        </svg>
					</div>
                <form action="update_data/delete_account.php" method="POST">

                    <div class="feedback-content">

                        <input type="hidden" name="delete_id" id="delete_id">
						<span class="feedback-title">Delete Account Request</span>
                		<p class="feedback-message">Are you sure you want to Delete this account Request?</p>
                    </div>
                    <div class="profiling-button-action">
                        <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="deletedata" class="approve">Delete</button>
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
             <a href="update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
            <a href=""> <button class="logout-cancel" type="button" data-dismiss="modal">Cancel</button></a>
          </div>
        </div>
        </div>
        </div>
    </div>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand"><img src="../../images/LOGO.png" class="bx icon" alt=""> RHU</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="../index.php" ><i class='bx bxs-calendar-plus icon' ></i> Appointments </a>
			</li>
			<li>
				<a href="../files/Pending Appointments.php" ><i class='bx bxs-receipt icon' ></i> Pending Appointments </a>
			</li>
			<li>
				<a href="../files/Records.php"><i class='bx bxs-receipt icon' ></i> Records </a>
			</li>
			<li><a href="../files/Rejected.php" ><i class='bx bxs-receipt icon' ></i> Rejected Appointments</a></li>

			<li>
				<a href="../files/profiling-all.php" ><i class='bx bxs-receipt icon' ></i> Profiling Records</a>
			</li>
			<li>
				<a href="#"><i class='bx bxs-user-account icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="Profile.php" >Personal Information</a></li>
					<li><a href="Account Settings.php" >Account Settings</a></li>
				</ul>
			</li>			
			<li><a href="users.php" class="active"><i class='bx bxs-user icon' ></i> Users</a></li>
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
				echo '<img src="images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
				}
				?>							<ul class="profile-link">
					<li><a href="Profile.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="Account Settings.php"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Barangay</h1>
			<?php
    // Check if there is data for the first container
	$sql = "SELECT * FROM `users` WHERE UserType='Dental' AND Status='Approve'";
    $result = mysqli_query($conn, $sql);
    $hasDataApprove = mysqli_num_rows($result) > 0;

    // Check if there is data for the second container
    $sql = "SELECT * FROM `users` WHERE UserType='Dental' AND Status='Pending'";
    $result = mysqli_query($conn, $sql);
    $hasDataPending = mysqli_num_rows($result) > 0;
    ?>

    <!-- Container 1: Approved Data -->
    <?php if ($hasDataApprove) { ?>
		<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Dental Account</h3>
						<div class="menu">
							  
						</div>
					</div>
					<div class="table-container">
					<div class="reg">
							<button class="add add-user" id="profiling-add"> Add Account</button></span>
						</div>
					<div class="table-wrapper">
						<table  id="myTable" class="emp-table">
							<thead>
								<tr>
								<th col-index = 1>Full Name</th>
								<th col-index = 2>Birthday</th>
								<th col-index = 3>User Name</th>
								<th col-index = 4>Barangay</th>
								<th col-index = 6>Contact Number</th>
								<th col-index = 6>Profile</th>

								<th col-index = 6>Action</th>

							</tr>
							</thead>
							<tbody>
								<?php
								$sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
								LEFT JOIN user_information ui ON u.User_ID = ui.User_ID 
								LEFT JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
								LEFT JOIN address_information ai ON ui.Record_ID = ai.Record_ID
							   WHERE UserType='Dental' AND Status='Approve'";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									?>
								  <tr>
								  <input type="hidden" class="record-id" value="<?php echo $row["User_ID"]; ?>">

							
								  <td><?php echo $row["FName"].' '.$row["MName"].' '.$row["LName"] ?></td>
								  <td><?php echo $row["birthdate"] ?></td>
								    <td><?php echo $row["UserName"] ?></td>
								    <td><?php echo $row["Barangay"] ?></td>
								    <td><?php echo $row["contact_num"] ?></td>

									<td><img class="enlarge-image" src="uploaded_img/<?php echo $row["Profile"] ?>" 
									alt="Person Image" data-image-url="uploaded_img/<?php echo $row["Profile"] ?>">
								</td>

									<td>
									<button type="button" class="btnn updateaccount"> Update </button>
											<button type="button" class="btn btn-danger deletebtn"> Delete </button>
								    </td>
								  </tr>
								<?php
								 }
								 ?>
							</tbody>
							<script src="../js/filter.js"></script>
						</table>
						</script>
						<script>
							window.onload = () => {
								console.log(document.querySelector(".emp-table > tbody > tr:nth-child(1) > td:nth-child(2) ").innerHTML);
							};
					
							getUniqueValuesFromColumn()
							
						</script>
					</div>
				</div></div>
			</div>        
    <?php } ?>

    <!-- Container 2: Pending Data -->
    <?php if ($hasDataPending) { ?>
        <div class="data">
		<div class="content-data">
					<div class="head">
						<h3>Requested Dental Account</h3>
						<div class="menu">
							 
						</div>
					</div>
					<div class="table-container">
					<div class="reg">
					<button class="add add-user" id="profiling-add"> Add Account</button></span>
						</div>
					<div class="table-wrapper">
						<table  id="myTable" class="emp-table">
							<thead>
								<tr>
								<th col-index = 1>Full Name</th>
								<th col-index = 2>Birthday </th>
								<th col-index = 3>User Name</th>
								<th col-index = 4>Address</th>
								<th col-index = 5>Number</th>
								<th col-index = 6>Profile</th>
								<th col-index = 6>Action</th>

							</tr>
							</thead>
							<tbody>
								<?php
								$sql = "SELECT ui.*, u.*, pi.*, ai.* FROM users u
	 							LEFT JOIN user_information ui ON u.User_ID = ui.User_ID 
	 							LEFT JOIN personal_information pi ON ui.Record_ID = pi.Record_ID
	 							LEFT JOIN address_information ai ON ui.Record_ID = ai.Record_ID
								WHERE UserType='Dental' AND Status='Pending'";								
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_assoc($result)) {
									?>
								  <tr>
								  <input type="hidden" class="record-id" value="<?php echo $row["User_ID"]; ?>">

								  <td><?php echo $row["FName"].' '.$row["MName"].' '.$row["LName"] ?></td>
								  <td><?php echo $row["birthdate"] ?></td>
								    <td><?php echo $row["UserName"] ?></td>
								    <td><?php echo $row["Barangay"] ?></td>
								    <td><?php echo $row["contact_num"] ?></td>

									<td>
									<img class="enlarge-image" src="uploaded_img/<?php echo $row["Profile"] ?>" alt="Person Image" data-image-url="uploaded_img/<?php echo $row["Profile"] ?>">
</td>		
								    <td>
									<button type="button" class="btnn updateaccount"> Update </button>
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
    <?php } ?>
		</main>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script>
    // After the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Hide the containers with no data
        if (!$hasDataApprove) {
            document.querySelectorAll("div.data")[0].style.display = "none";
        }
        if (!$hasDataPending) {
            document.querySelectorAll("div.data")[1].style.display = "none";
        }
    });
</script>

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
        $('.add-user').on('click', function () {
            $('#addusermodal').modal('show');
        });
    });
</script>
<script>
		$(document).ready(function() {
    $(".enlarge-image").click(function() {
        var imageUrl = $(this).data("image-url");
        $("#enlargedImg").attr("src", imageUrl);
        $("#imageModal").modal("show");
    });
});
	</script>
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
        $('.updateaccount').on('click', function () {
            $('#add_user_update').modal('show');
			$tr = $(this).closest('tr');

            var recordId = $(this).closest('tr').find('.record-id').val();
			
			var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

            $('#update_request').val(recordId);
			$('#name').val(data[0]);
                $('#uname').val(data[1]);
                $('#address').val(data[2]);
                $('#number').val(data[3]);
        });
    });
</script>
</body>
</html>