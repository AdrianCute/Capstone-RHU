<?php
session_start();
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
    <link rel="stylesheet" href="../css/another.css">
    <link rel="icon" href="../../../images/LOGO.png">



    </script>

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
    <a href="#" class="brand"><img src="../../../images/LOGO.png" alt="" class='bx icon'> RHU</a>
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
				<a href="#" ><i class='bx bxs-receipt icon' ></i>Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li ><a href="profiling-choices.php">Profiling</a></li>
					<li><a href="checkup-choices.php">Checkup </a></li>
					<li><a href="OTP-choices.php">OPT</a></li>
					<li><a href="Immunization-choices.php">Immunization</a></li>
					<li><a href="vaccination-choices.php">Vaccination</a></li>
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
			<li><a href="#"class="active"><i class='bx bx-search-alt-2 icon'></i>Search Information</a></li>
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
            <form action="" method="GET" class="search-form">
    <div class="form-group">
        <input type="text" id="searchInput" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" placeholder="Search...">
        <i class='bx bx-search icon'></i>
    </div>
    <div id="suggestions-container">
        <div id="suggestions"></div>
    </div>
    <!-- Add a submit button -->
    <input type="submit" value="Search" id="searchButton" hidden>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const suggestions = document.getElementById("suggestions");
    const searchButton = document.getElementById("searchButton"); // Add this line to get the submit button

    searchInput.addEventListener("input", function() {
        const inputValue = this.value.trim();
        if (inputValue !== "") {
            fetchSuggestions(inputValue);
        } else {
            suggestions.innerHTML = ""; // Clear suggestions if input is empty
        }
    });

    // Function to set the clicked suggestion as the input value
    window.setSuggestionValue = function(suggestion) {
        const selectedValue = suggestion.dataset.value;
        searchInput.value = selectedValue;
        suggestions.innerHTML = ""; // Clear suggestions
        // Trigger a click event on the submit button when a suggestion is clicked
        searchButton.click();
    }

    function fetchSuggestions(query) {
        // Send an AJAX request to fetch suggested names or family numbers based on the query
        // You can use PHP to query your database and return suggestions
        fetch(`update_data/search.php?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let suggestionList = "<ul>";
                data.forEach(item => {
                    if (item.fullName) {
                        suggestionList += `<li data-value="${item.fullName}" onclick="setSuggestionValue(this)">${item.fullName}</li>`;
                    } else if (item.familyNumber) {
                        suggestionList += `<li data-value="${item.familyNumber}" onclick="setSuggestionValue(this)">${item.familyNumber}</li>`;
                    }
                });
                suggestionList += "</ul>";
                suggestions.innerHTML = suggestionList;
            })
            .catch(error => {
                console.error("Error fetching suggestions:", error);
                suggestions.innerHTML = ""; // Clear suggestions on error
            });
    }
});
</script>



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
            <div class="mains">
			<h1 class="title">Search Records</h1>
			<?php 
if(isset($_GET['search']))
{
    $filtervalues = $_GET['search'];

 if (preg_match('/\d/',  $filtervalues)) {
           $sql = "SELECT p.*, pi.*, mi.*, bi.*
            FROM immunization p
            LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
            LEFT JOIN immunization_information mi ON pi.Record_ID = mi.Record_ID
            LEFT JOIN baby_information bi ON pi.Record_ID = bi.Record_ID
                    WHERE Familynum = '$filtervalues'
                    GROUP BY p.Record_ID";
    
            $result = mysqli_query($conn, $sql);
    
            if(mysqli_num_rows($result) > 0)
            {
              
                      
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                              
                <div class="datas">
                    <div class="content-data">
                            <h5>Family Members (Family Serial Number: <?php echo $filtervalues; ?>)</h5><br>
                                                    <div class="information-container">
                                                        <br>

                                <div class="inline-container">
                                    <div class="inline">
                         <!-- Block 1 -->
                         
                         <?php if (!empty($row['LName']) || !empty($row['FName']) || !empty($row['MName'])) : ?>
    <b>FullName: </b><small><?php echo $row['LName'].' '.$row['FName'].' '.$row['MName']; ?></small><br>
<?php endif; ?>
        <?php if (!empty($row["PlaceOfBirth"])) : ?>
            <b>Place of Birth: </b><small><?php echo $row["PlaceOfBirth"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["FathersName"])) : ?>
            <b>Fathers Name: </b><small><?php echo $row["FathersName"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["MothersName"])) : ?>
            <b>Mother Name: </b><small><?php echo $row["MothersName"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["birth_height"])) : ?>
            <b>Birth Weight: </b><small><?php echo $row["birth_height"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["birth_weight"])) : ?>
            <b>Birth Height: </b><small><?php echo $row["birth_weight"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["health_center"])) : ?>
            <b>Health Center: </b><small><?php echo $row["health_center"] ?></small><br>
        <?php endif; ?>
        
     
        <?php if (!empty($row["atbirth"])) : ?>
            <b>At birth Dose: </b><small><?php echo $row["atbirth"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["firstDose"])) : ?>
            <b>6 weeks: </b><small><?php echo $row["firstDose"] ?></small><br>
        <?php endif; ?>
        </div>
        
        <!-- Block 2 -->
        <div class="inline">
        <?php if (!empty($row["secondDose"])) : ?>
            <b>10 weeks: </b><small><?php echo $row["secondDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["thirdDose"])) : ?>
            <b>14 Weeks: </b><small><?php echo $row["thirdDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["fourthDose"])) : ?>
            <b>9 Months: </b><small><?php echo $row["fourthDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["fifthDose"])) : ?>
            <b>12 Months Dose: </b><small><?php echo $row["fifthDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["eye_prophy"])) : ?>
            <b>Eye Prophylaxis: </b><small><?php echo $row["eye_prophy"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["vitamin_K"])) : ?>
            <b>Vitamin K: </b><small><?php echo $row["vitamin_K"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["exclusive_breastfeeding"])) : ?>
            <b>Exclusive Breastfeeding: </b><small><?php echo $row["exclusive_breastfeeding"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["nb_screening"])) : ?>
            <b>Newborn Screening: </b><small><?php echo $row["nb_screening"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["nb_hscreening"])) : ?>
            <b>Newborn Hearing Screening: </b><small><?php echo $row["nb_hscreening"] ?></small><br>
        <?php endif; ?>
                            </div> 
        
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }

            
 }
    
    {    $query = "SELECT p.*, pi.*, mi.*, oi.*, age.*, ta.*
	FROM personal_information pi
	LEFT JOIN profiling p ON p.Record_ID = pi.Record_ID
	LEFT JOIN immunization_information mi ON pi.Record_ID = mi.Record_ID
	LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
    LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
    LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE CONCAT(LName,FName,MName) LIKE '%$filtervalues%' 
    GROUP BY pi.Record_ID  LIMIT 1";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        ?>
        <div class="datas">
            <div class="content-data">
                <div class="head">    
                    <h3>Personal Information</h3>
                    <div class="menu">
                       
                    </div>
                </div>
                <div class="information-container">
                    <?php
                    foreach($query_run as $items)
					{
						?>
                        <div class="inline-container">
                        <div class="inline">
			            <b>FullName: </b><?= $items['FName'].', '.$items['MName'].', '.$items['LName']; ?><br>
                        
						<b>Age: </b><?= $items['Age']?><br>
                   		<b>Birthday: </b><?= $items['birthdate']?><br>
                          

                    	<b>Sex: </b><?= $items['sex']?> <br>
                        </div>
                           <div class="inline">
                        <?php if (!empty($items["MothersName"])) : ?>
    <b>Mothers Name:</b> <?php echo $items["MothersName"] ?><br>
<?php endif; ?>
<?php if (!empty($items["FathersName"])) : ?>
    <b>Fathers Name:</b> <?php echo $items["FathersName"] ?><br>
<?php endif; ?>                        <?php if (!empty($items['Barangay'].' '.$items['Municipality'].' '. $items['Province'])) : ?>
    <b>Address:</b> <?php echo $items['Barangay'].' '.$items['Municipality'].' '. $items['Province'] ?><br>
<?php endif; ?>                        <?php if (!empty($items['education'])) : ?>
    <b>Educational Attainment:</b> <?php echo $items["education"] ?><br>
<?php endif; ?>
                        
                        </div>

                        <div class="inline">
                        
                        <?php if (!empty($items['religion'])) : ?>
                            <b>Religion:</b> <?php echo $items["religion"] ?><br>
                        <?php endif; ?>          
                         <?php if (!empty($items['Ethinicity'])) : ?>
                            <b>Ethnicity:</b> <?php echo $items["Ethinicity"] ?><br>
                        <?php endif; ?>           
                        <?php if (!empty($items['civil_status'])) : ?>
                            <b>Civil Status:</b> <?php echo $items["civil_status"] ?><br>
                        <?php endif; ?>           
                        <?php if (!empty($items['contact_num'])) : ?>
                            <b>Contact Number:</b> <?php echo $items["contact_num"] ?><br>
                        <?php endif; ?>
                        
                        </div>
                        </div>
						<?php
					}
                    ?>
                </div>
            </div>
        </div>
        <?php
    }


}
?>
    
			<?php 
if(isset($_GET['search']))
{
    $filtervalues = $_GET['search'];

    // Profiling Records
    $query = "SELECT p.*, pi.*, mi.*, oi.*
	FROM profiling p
	LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
	LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
	LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
            WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%'
            GROUP BY p.Record_ID";
    $query_run = mysqli_query($conn, $query);
    if(mysqli_num_rows($query_run) > 0)
    {
        ?>
        <div class="datas">
            <div class="content-data">
                <div class="head">    
                    <h3>Profiling Records</h3>
                    <div class="menu">
                       
                    </div>
                </div>
                <div class="information-container">
                    <?php
                    foreach($query_run as $row)
					{
                        $household = $row["household_num"] ;
                        $displayedHouseholdNums[] = $household;

						?>
                        <div class="inline-container">
                        <div class="inline">
                        <?php if (!empty($row["Visit"])) : ?>
			     <b>Date of Visit: </b><small><?php echo $row["Visit"] ?></small><br>
                 <?php endif; ?>
                 
                 <!-- Block 1 -->
<!-- Block 1 -->
<?php if (!empty($row["household_num"])) : ?>
    <b>Household Number: </b><small><?php echo $row["household_num"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["number_family"])) : ?>
    <b>Number of family in household: </b><small><?php echo $row["number_family"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["relationship"])) : ?>
    <b>Relationship to head: </b><small><?php echo $row["relationship"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fourps"])) : ?>
    <b>4ps Member: </b><small><?php echo $row["fourps"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fourps_number"])) : ?>
    <b>4Ps Number: </b><small><?php echo $row["fourps_number"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 2 -->
<div class="inline">
<?php if (!empty($row["phil_category"])) : ?>
    <b>Philhealth Category: </b><small><?php echo $row["phil_category"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["phil_number"])) : ?>
    <b>Philhealth Number: </b><small><?php echo $row["phil_number"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["history"])) : ?>
    <b>Medical History: </b><small><?php echo $row["history"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["classification"])) : ?>
    <b>Classification by Age/Health risk Group: </b><small><?php echo $row["classification"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["mentraul"])) : ?>
    <b>If Pregnant; Last Menstrual Period: </b><small><?php echo $row["mentraul"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["UsingFp"])) : ?>
    <b>Using any FP methods?: </b><small><?php echo $row["UsingFp"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 3 -->
<div class="inline">
<?php if (!empty($row["method_use"])) : ?>
    <b>FP methods Used: </b><small><?php echo $row["method_use"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fp_status"])) : ?>
    <b>FP Status: </b><small><?php echo $row["fp_status"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["water"])) : ?>
    <b>Type of Water Source: </b><small><?php echo $row["water"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["toilet"])) : ?>
    <b>Type of Toilet Facility: </b><small><?php echo $row["toilet"] ?></small><br><br>
<?php endif; ?>


                                                </div>
                                                </div>
						<?php
                       }
                       ?>
					
                   
                </div>
                
            </div>
        </div>
        <?php
    }

    if(!empty($displayedHouseholdNums))
    {
        foreach($displayedHouseholdNums as $householdNum)
        {
            $sql = "SELECT p.*, pi.*, mi.*, oi.*
                    FROM profiling p
                    LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
                    LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
                    LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
                    WHERE household_num = '$householdNum' AND p.Record_ID NOT IN (SELECT Record_ID FROM profiling WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%')
                    GROUP BY p.Record_ID";
    
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) > 0) {
                ?>
                <div class="datas">
                <div class="content-data">
                <h5>Household Members (Household Number: <?php echo $householdNum; ?>)</h5><br>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="information-container">
                           
                                <div class="inline-container">
                                    <div class="inline">
                                    <?php if (!empty($row['LName']) || !empty($row['FName']) || !empty($row['MName'])) : ?>
    <b>FullName: </b><small><?php echo $row['LName'].' '.$row['FName'].' '.$row['MName']; ?></small><br>
<?php endif; ?>

<?php if (!empty($row["relationship"])) : ?>
    <b>Relationship to head: </b><small><?php echo $row["relationship"] ?></small><br>
<?php endif; ?>
<!-- Block 1 -->
<?php if (!empty($row["fourps"])) : ?>
    <b>4ps Member: </b><small><?php echo $row["fourps"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fourps_number"])) : ?>
    <b>4Ps Number: </b><small><?php echo $row["fourps_number"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 2 -->
<div class="inline">
<?php if (!empty($row["phil_category"])) : ?>
    <b>Philhealth Category: </b><small><?php echo $row["phil_category"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["phil_number"])) : ?>
    <b>Philhealth Number: </b><small><?php echo $row["phil_number"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["history"])) : ?>
    <b>Medical History: </b><small><?php echo $row["history"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["classification"])) : ?>
    <b>Classification by Age/Health risk Group: </b><small><?php echo $row["classification"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 3 -->
<div class="inline">
<?php if (!empty($row["mentraul"])) : ?>
    <b>If Pregnant; Last Menstrual Period: </b><small><?php echo $row["mentraul"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["UsingFp"])) : ?>
    <b>Using any FP methods?: </b><small><?php echo $row["UsingFp"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["method_use"])) : ?>
    <b>FP methods Used: </b><small><?php echo $row["method_use"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fp_status"])) : ?>
    <b>FP Status: </b><small><?php echo $row["fp_status"] ?></small><br>
<?php endif; ?>

</div>
                                </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}
?>
	
			<?php 
if(isset($_GET['search']))
{
    $filtervalues = $_GET['search'];

    // Profiling Records
    $query = "SELECT p.*, pi.*, mi.*, bi.*
	FROM immunization p
	LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
	LEFT JOIN immunization_information mi ON pi.Record_ID = mi.Record_ID
    LEFT JOIN baby_information bi ON pi.Record_ID = bi.Record_ID
            WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%'
            GROUP BY p.Record_ID";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        ?>
        <div class="datas">
            <div class="content-data">
                <div class="head">    
                    <h3>Immunization Records</h3>
                    <div class="menu">
                       
                    </div>
                </div>
                <div class="information-container">
                    <?php
                    foreach($query_run as $row)
					{
                        $familynum = $row["Familynum"] ;
                        $displayedfamilynum[] = $familynum;
						?>
                        <div class="inline-container">
                            <div class="inline">
                 <!-- Block 1 -->
<?php if (!empty($row["PlaceOfBirth"])) : ?>
    <b>Place of Birth: </b><small><?php echo $row["PlaceOfBirth"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["FathersName"])) : ?>
    <b>Fathers Name: </b><small><?php echo $row["FathersName"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["MothersName"])) : ?>
    <b>Mother Name: </b><small><?php echo $row["MothersName"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["birth_height"])) : ?>
    <b>Birth Weight: </b><small><?php echo $row["birth_height"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["birth_weight"])) : ?>
    <b>Birth Height: </b><small><?php echo $row["birth_weight"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["health_center"])) : ?>
    <b>Health Center: </b><small><?php echo $row["health_center"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Familynum"])) : ?>
    <b>Family Number: </b><small><?php echo $row["Familynum"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["atbirth"])) : ?>
    <b>At birth Dose: </b><small><?php echo $row["atbirth"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["firstDose"])) : ?>
    <b>6 weeks: </b><small><?php echo $row["firstDose"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 2 -->
<div class="inline">
<?php if (!empty($row["secondDose"])) : ?>
    <b>10 weeks: </b><small><?php echo $row["secondDose"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["thirdDose"])) : ?>
    <b>14 Weeks: </b><small><?php echo $row["thirdDose"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fourthDose"])) : ?>
    <b>9 Months: </b><small><?php echo $row["fourthDose"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["fifthDose"])) : ?>
    <b>12 Months Dose: </b><small><?php echo $row["fifthDose"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["eye_prophy"])) : ?>
    <b>Eye Prophylaxis: </b><small><?php echo $row["eye_prophy"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["vitamin_K"])) : ?>
    <b>Vitamin K: </b><small><?php echo $row["vitamin_K"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["exclusive_breastfeeding"])) : ?>
    <b>Exclusive Breastfeeding: </b><small><?php echo $row["exclusive_breastfeeding"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["nb_screening"])) : ?>
    <b>Newborn Screening: </b><small><?php echo $row["nb_screening"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["nb_hscreening"])) : ?>
    <b>Newborn Hearing Screening: </b><small><?php echo $row["nb_hscreening"] ?></small><br>
<?php endif; ?>
                    </div> 

                        </div>
						<?php
					}
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    if(!empty($displayedfamilynum))
    {
        foreach($displayedfamilynum as $familynum)
        {
            $sql = "SELECT p.*, pi.*, mi.*, bi.*
            FROM immunization p
            LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
            LEFT JOIN immunization_information mi ON pi.Record_ID = mi.Record_ID
            LEFT JOIN baby_information bi ON pi.Record_ID = bi.Record_ID
                    WHERE Familynum = '$familynum' AND p.Record_ID NOT IN (SELECT Record_ID FROM immunization WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%')
                    GROUP BY p.Record_ID";
    
            $result = mysqli_query($conn, $sql);
    
            if(mysqli_num_rows($result) > 0)
            {
                ?>
                <div class="datas">
                    <div class="content-data">
                            <h5>Family Members (Family Serial Number: <?php echo $familynum; ?>)</h5><br>
                       <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                                    <div class="information-container">

                                <div class="inline-container">
                                    <div class="inline">
                         <!-- Block 1 -->
                         <?php if (!empty($row['LName']) || !empty($row['FName']) || !empty($row['MName'])) : ?>
    <b>FullName: </b><small><?php echo $row['LName'].' '.$row['FName'].' '.$row['MName']; ?></small><br>
<?php endif; ?>
        <?php if (!empty($row["PlaceOfBirth"])) : ?>
            <b>Place of Birth: </b><small><?php echo $row["PlaceOfBirth"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["FathersName"])) : ?>
            <b>Fathers Name: </b><small><?php echo $row["FathersName"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["MothersName"])) : ?>
            <b>Mother Name: </b><small><?php echo $row["MothersName"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["birth_height"])) : ?>
            <b>Birth Weight: </b><small><?php echo $row["birth_height"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["birth_weight"])) : ?>
            <b>Birth Height: </b><small><?php echo $row["birth_weight"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["health_center"])) : ?>
            <b>Health Center: </b><small><?php echo $row["health_center"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["Familynum"])) : ?>
            <b>Family Number: </b><small><?php echo $row["Familynum"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["atbirth"])) : ?>
            <b>At birth Dose: </b><small><?php echo $row["atbirth"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["firstDose"])) : ?>
            <b>6 weeks: </b><small><?php echo $row["firstDose"] ?></small><br>
        <?php endif; ?>
        </div>
        
        <!-- Block 2 -->
        <div class="inline">
        <?php if (!empty($row["secondDose"])) : ?>
            <b>10 weeks: </b><small><?php echo $row["secondDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["thirdDose"])) : ?>
            <b>14 Weeks: </b><small><?php echo $row["thirdDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["fourthDose"])) : ?>
            <b>9 Months: </b><small><?php echo $row["fourthDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["fifthDose"])) : ?>
            <b>12 Months Dose: </b><small><?php echo $row["fifthDose"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["eye_prophy"])) : ?>
            <b>Eye Prophylaxis: </b><small><?php echo $row["eye_prophy"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["vitamin_K"])) : ?>
            <b>Vitamin K: </b><small><?php echo $row["vitamin_K"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["exclusive_breastfeeding"])) : ?>
            <b>Exclusive Breastfeeding: </b><small><?php echo $row["exclusive_breastfeeding"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["nb_screening"])) : ?>
            <b>Newborn Screening: </b><small><?php echo $row["nb_screening"] ?></small><br>
        <?php endif; ?>
        
        <?php if (!empty($row["nb_hscreening"])) : ?>
            <b>Newborn Hearing Screening: </b><small><?php echo $row["nb_hscreening"] ?></small><br>
        <?php endif; ?>
                            </div> 
        
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}
?>

<?php 
if(isset($_GET['search']))
{
    $filtervalues = $_GET['search'];

    // Profiling Records
    $query = "SELECT p.*, pi.*, mi.*, oi.*
	FROM checkup p
	LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
	LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
	LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
            WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%'
            GROUP BY p.Record_ID";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        ?>
        <div class="datas">
            <div class="content-data">
                <div class="head">    
                    <h3>Checkup Records</h3>
                    <div class="menu">
                        
                    </div>
                </div>
                <div class="information-container">
                    <?php
                    foreach($query_run as $row)
					{
						?>
                        <div class="inline-container">
                            <div class="inline">
                 <!-- Block 1 -->
<?php if (!empty($row["Family_Serial_num"])) : ?>
    <b>Family Serial Number: </b><small><?php echo $row["Family_Serial_num"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["history"])) : ?>
    <b>Medical history: </b><small><?php echo $row["history"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["physician"])) : ?>
    <b>Attending Physician: </b><small><?php echo $row["physician"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Head"])) : ?>
    <b>House Hol Head: </b><small><?php echo $row["Head"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["classification"])) : ?>
    <b>Classification: </b><small><?php echo $row["classification"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["philhealthnum"])) : ?>
    <b>Philhealth Number: </b><small><?php echo $row["philhealthnum"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 2 -->
<div class="inline">
<?php if (!empty($row["PWD"])) : ?>
    <b>Person With Disability: </b><small><?php echo $row["PWD"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Date"])) : ?>
    <b>Date: </b><small><?php echo $row["Date"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["VSChief_Complaint"])) : ?>
    <b>Vs/ Chief Complaint: </b><small><?php echo $row["VSChief_Complaint"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Diagnosis"])) : ?>
    <b>Diagnosis: </b><small><?php echo $row["Diagnosis"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["treatment"])) : ?>
    <b>Treatment: </b><small><?php echo $row["treatment"] ?></small><br>
<?php endif; ?>
                        </div>
                        </div>
						<?php
					}
                    ?>
                </div>
            </div>
        </div>
        <?php
    }


}
?>
   <?php 
if(isset($_GET['search']))
{
    $filtervalues = $_GET['search'];

    // Profiling Records
    $query = "SELECT p.*, pi.*, age.*
	FROM operation_timbang p
	LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
    LEFT JOIN age_table age ON p.Record_ID = age.Record_ID

            WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%'
            GROUP BY p.Record_ID";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        ?>
        <div class="datas">
            <div class="content-data">
                <div class="head">    
                    <h3>Operation Timbang Records</h3>
                    <div class="menu">
                       
                    </div>
                </div>
                <div class="information-container">
                    <?php
                    foreach($query_run as $row)
					{
						?>
                        <div class="inline-container">
                            <div class="inline">
                            <?php if (!empty($row["DateMeasured"])) : ?>
    <b>Date Measured: </b><small><?php echo $row["DateMeasured"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Weight"])) : ?>
    <b>Weight: </b><small><?php echo $row["Weight"] ?></small> Inches<br>
<?php endif; ?>

<?php if (!empty($row["Height"])) : ?>
    <b>Height: </b><small><?php echo $row["Height"] ?></small> Kg<br>
<?php endif; ?>

<?php if (!empty($row["Age__months"])) : ?>
    <b>Age in Months:</b> <small><?php echo $row["Age__months"] ?></small> months<br>
<?php endif; ?>
</div>

<!-- Block 2 -->
<div class="inline">
<?php if (!empty($row["Weight_in_Age_stat"])) : ?>
    <b>Weight in Age Status: </b><small><?php echo $row["Weight_in_Age_stat"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Height_in_Age_stat"])) : ?>
    <b>Height in Age Status: </b><small><?php echo $row["Height_in_Age_stat"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Weight_in_LTandHt_stat"])) : ?>
    <b>Weight in LT/HT Status: </b><small><?php echo $row["Weight_in_LTandHt_stat"] ?></small><br>
<?php endif; ?>
                        </div>
                        </div>
						<?php
					}
                    ?>
                </div>
            </div>
        </div>
        <?php
    }


}
?>    
 <?php 
if(isset($_GET['search']))
{
    $filtervalues = $_GET['search'];

    // Profiling Records
    $query = "SELECT p.*, pi.*, mi.*, vi.*, oi.*, ta.*
	FROM vaccination p
	LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
	LEFT JOIN vaccine mi ON pi.Record_ID = mi.Record_ID
	LEFT JOIN vaccine_other_information vi ON pi.Record_ID = vi.Record_ID
	LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
    LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
            WHERE CONCAT(pi.LName, pi.FName, pi.MName) LIKE '%$filtervalues%'
            GROUP BY p.Record_ID";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        ?>
        <div class="datas">
            <div class="content-data">
                <div class="head">    
                    <h3>Vaccination Records</h3>
                    <div class="menu">
                       
                    </div>
                </div>
                <div class="information-container">
                    <?php
                    foreach($query_run as $row)
					{
						?>
                        <div class="inline-container">
                            <div class="inline">
		 			<!-- Block 1 -->
<?php if (!empty($row["Category"])) : ?>
    <b>Category: </b><small><?php echo $row["Category"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Comorbidity"])) : ?>
    <b>Comorbidity: </b><small><?php echo $row["Comorbidity"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Unique_Person_ID"])) : ?>
    <b>Unique Person ID: </b><small><?php echo $row["Unique_Person_ID"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Guardian"])) : ?>
    <b>Guardian: </b><small><?php echo $row["Guardian"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Region"])) : ?>
    <b>Region: </b><small><?php echo $row["Region"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Deferral"])) : ?>
    <b>Deferral: </b><small><?php echo $row["Deferral"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 2 -->
<div class="inline">
<?php if (!empty($row["Reason_for_Deferral"])) : ?>
    <b>Reason for Deferral: </b><small><?php echo $row["Reason_for_Deferral"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Vaccination_Date"])) : ?>
    <b>Vaccination Date: </b><small><?php echo $row["Vaccination_Date"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Vaccine_Manufacturer"])) : ?>
    <b>Vaccine Manufacturer: </b><small><?php echo $row["Vaccine_Manufacturer"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Batch_Number"])) : ?>
    <b>Batch Number: </b><small><?php echo $row["Batch_Number"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Lot_num"])) : ?>
    <b>Lot Number: </b><small><?php echo $row["Lot_num"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Bakuna"])) : ?>
    <b>Bakuna: </b><small><?php echo $row["Bakuna"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Vaccinator"])) : ?>
    <b>Vaccinator: </b><small><?php echo $row["Vaccinator"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["First_Dose"])) : ?>
    <b>First Dose: </b><small><?php echo $row["First_Dose"] ?></small><br>
<?php endif; ?>
</div>

<!-- Block 3 -->
<div class="inline">
<?php if (!empty($row["Second_Dose"])) : ?>
    <b>Second Dose: </b><small><?php echo $row["Second_Dose"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["First_Booster"])) : ?>
    <b>First Booster Dose: </b><small><?php echo $row["First_Booster"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Second_Booster"])) : ?>
    <b>Second Booster Dose: </b><small><?php echo $row["Second_Booster"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Adverse_Event"])) : ?>
    <b>Adverse Event: </b><small><?php echo $row["Adverse_Event"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Adverse_Condition"])) : ?>
    <b>Adverse Event condition: </b><small><?php echo $row["Adverse_Condition"] ?></small><br>
<?php endif; ?>

<?php if (!empty($row["Row_hash"])) : ?>
    <b>Row Hash: </b><small><?php echo $row["Row_hash"] ?></small><br>
<?php endif; ?>
                        </div>
                        </div>
						<?php
					}
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

}
}
?>        
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
	<script>
    $(document).ready(function () {
        $('.logout').on('click', function () {
            $('#logoutmodal').modal('show');
        });
    });
</script>
</body>
</html>
