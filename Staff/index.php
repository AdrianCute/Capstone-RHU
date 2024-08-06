<?php

include "config.php";

if (!isset($_SESSION['Usertype']) || $_SESSION['Usertype'] !== 'Staff') {
    header("Location: ../index.php"); 
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
	<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
             <a href="navfiles/Records/update_data/logout.php"><button class="logout-desactivate" type="button">Logout</button></a>
            <a href=""> <button class="logout-cancel" type="button" data-dismiss="modal">Cancel</button></a>
          </div>
        </div>
        </div>
        </div>
    </div>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand"><img src="../images/LOGO.png" alt="" class='bx icon'>
 RHU</a>
		<ul class="side-menu">
			<li><a href="#" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li class="divider" data-text="main">Main</li>
			<li>
				<a href="#"><i class='bx bxs-receipt icon' ></i> Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="navfiles/Records/Profiling/profiling-all.php">Profiling</a></li>
					<li><a href="navfiles/Records/checkup/checkup-all.php">Checkup</a></li>
					<li><a href="navfiles/Records/OTP/OTP-all.php">OTP</a></li>
					<li><a href="navfiles/Records/Immunization/Immunization-all.php">Immunization</a></li>
					<li><a href="navfiles/Records/Vaccination/vaccination-all.php">Vaccination</a></li>
					<li><a href="navfiles/Records/Senior/Senior-all.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
			<li>
				<a href="#"><i class='bx bxs-receipt icon' ></i> Barangay Records <i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="navfiles/Records/profiling-choices.php">Profiling</a></li>
					<li><a href="navfiles/Records/checkup-choices.php">Checkup</a></li>
					<li><a href="navfiles/Records/OTP-choices.php">OTP</a></li>
					<li><a href="navfiles/Records/Immunization-choices.php">Immunization</a></li>
					<li><a href="navfiles/Records/vaccination-choices.php">Vaccination</a></li>
					<li><a href="navfiles/Records/senior-choices.php">Senior Citizen Master Listing</a></li>

				</ul>
			</li>
		
			<li>
				<a href="#"><i class='bx bxs-user icon'></i>Profile<i class='bx bx-chevron-right icon-right' ></i></a>
				<ul class="side-dropdown">
					<li><a href="navfiles/Account Managment/Profile.php" >Personal Information</a></li>
					<li><a href="navfiles/Account Managment/Account Settings.php">Account Settings</a></li>
				</ul>
			</li>
			<li><a href="navfiles/Records/search.php"><i class='bx bx-search-alt-2 icon'></i>Search Information</a></li>
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
				echo '<img src="navfiles/Account Managment/images/default-avatar.png" class="profile-img">';
					}else{
				echo '<img src="navfiles/Account Managment/uploaded_img/'.$fetch['Profile'].'" class="profile-img">';
				}
				?>
								<ul class="profile-link">
					<li><a href="navfiles/Account Managment/Profile.php"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="navfiles/Account Managment/Account Settings.php"><i class='bx bxs-cog' ></i> Settings</a></li>
					<li><a href="#" class="logout"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<h1 class="title">Dashboard</h1>
			<div class="info-data">
				<div class="card">
					<div class="head">
						<div>
							<h2><?php 

                        $query = "SELECT Record_ID FROM personal_information ORDER BY Record_ID";
                        $query_run =mysqli_query($conn, $query);

                        $row = mysqli_num_rows($query_run);

                        echo "$row";?></h2>
							<p>Total Population</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
				
				</div>

				<div class="card">
					<div class="head">
						<div>
							<h2><?php 

$query = "SELECT Record_ID FROM profiling ORDER BY Record_ID";
$query_run =mysqli_query($conn, $query);

$row = mysqli_num_rows($query_run);

echo "$row";?></h2>
							<p>Total Profiling Record</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					
				</div>
				<div class="card">
					<div class="head">
						<div>
							<h2><?php 

$query = "SELECT Record_ID FROM checkup ORDER BY Record_ID";
$query_run =mysqli_query($conn, $query);

$row = mysqli_num_rows($query_run);

echo "$row";?></h2>
							<p>Total Checkup Record</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					
				</div>
                <div class="card">
					<div class="head">
						<div>
							<h2><?php 

$query = "SELECT Record_ID FROM vaccination ORDER BY Record_ID";
$query_run =mysqli_query($conn, $query);

$row = mysqli_num_rows($query_run);

echo "$row";?></h2>
							<p>Total Vaccination Record</p>
						</div>
						<i class='bx bx-trending-up icon' ></i>
					</div>
					
				</div>
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Vaccination Charts</h3>
						
					</div>
					<div class="chart">
					<div class="chart-container">
						    <div id="chart" style="width: 300px; height: 500px; margin: 0;"></div>
						</div>						<?php

$query = "SELECT `First_Dose`, COUNT(*) AS NUM FROM vaccine GROUP BY `First_Dose`";
$result = mysqli_query($conn, $query);

$datas = array(); // Initialize an array to store your data

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $manufacturer = $row["First_Dose"];
        $count = $row["NUM"];
        // Add data to the array
        $datas[] = array('manufacturer' => $manufacturer, 'count' => $count);
    }
} else {
    // Handle the error appropriately, e.g., redirect to an error page
    die("Database query failed: " . mysqli_error($conn));
}


?>
  <script>
  var data = <?php echo json_encode($datas); ?>; // Get the dynamic data from PHP

// Calculate the total count
var total = data.reduce((sum, items) => sum + items.count, 0);

// Normalize the data
var normalizedData = data.map(items => ({
    manufacturer: items.manufacturer,
    count: (items.count / total) * 100, // Calculate the percentage
}));

        var options = {
            series: normalizedData.map(items => items.count),
            chart: {
                width: 500,
                type: 'pie',
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true | '<img src="/static/icons/reset.png" width="20">',
                        customIcons: []
                    },
                    export: {
                        csv: {
                            filename: undefined,
                            columnDelimiter: ',',
                            headerCategory: 'category',
                            headerValue: 'value',
                            dateFormatter(timestamp) {
                                return new Date(timestamp).toDateString()
                            }
                        },
                        svg: {
                            filename: undefined,
                        },
                        png: {
                            filename: undefined,
                        }
                    },
                    autoSelected: 'zoom'
                },
            },
    labels: normalizedData.map(items => items.manufacturer), // Use dynamic data for labels
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }],tooltip: {
    y: {
        formatter: function (value, { series, seriesIndex, dataPointIndex, w }) {
            // Retrieve the unnormalized count for tooltip display
            var unnormalizedCount = data[dataPointIndex].count; // Use the dynamic data
            return unnormalizedCount.toString(); // Show the unnormalized count as a string
        }
    }
}
};

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
						<div class="explanation" style="width: 450px; margin: 0;">
						<div id="barchart"></div>
						<?php
    $sql = "SELECT `Category`, COUNT(*) AS NUM FROM vaccination GROUP BY `Category`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $categories = [];
        $totals = [];
        while ($row = $result->fetch_assoc()) {
            $category = $row["Category"];
            $total = $row["NUM"];
            $categories[] = $category;
            $totals[] = $total;
        }
    } else {
        echo "No data found.";
    }
?>

<script>
    var options = {
        series: [{
            data: <?php echo json_encode($totals); ?>
        }],
        chart: {
            height: 350,
            type: 'bar',
            events: {
                click: function (chart, w, e) {
                }
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: <?php echo json_encode($categories); ?>,
            labels: {
                style: {
                    fontSize: '12px'
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#barchart"), options);
    chart.render();
</script>

	
						  </div>
					</div>
				</div>
			</div>
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Profiling Diagram</h3>
					</div>
					<div class="chart">
					<div class="">
						<div id="donutchart" style="width: 500px; height: 500px; margin: 0;"></div>
                        <?php
$education_uwu = [];
$NonfourPs_count = [];
$fourPs_count = [];
$unknown_count = [];
$total_count = [];
$donut_query = "SELECT education,
                SUM(CASE WHEN fourps = 'Yes' THEN 1 ELSE 0 END) AS '4Ps',
                SUM(CASE WHEN fourps = 'NO' THEN 1 ELSE 0 END) AS 'Non-4Ps',
                SUM(CASE WHEN fourps = 'Unknown' THEN 1 ELSE 0 END) AS 'Unknown',
                SUM(CASE WHEN fourps IN ('Yes', 'NO', 'Unknown') THEN 1 ELSE 0 END) AS 'Total'
                FROM profiling pi
                INNER JOIN other_information oi ON pi.Record_ID = oi.Record_ID
				INNER JOIN address_information ai ON pi.Record_ID = ai.Record_ID 
				
                GROUP BY education ";
$donut_result = mysqli_query($conn, $donut_query);
if ($donut_result) {
    while ($row = mysqli_fetch_assoc($donut_result)) {
        $education = $row["education"]; // Get the education value from the database
        $fourPs = $row["4Ps"];
        $NonfourPs = $row["Non-4Ps"];
        $unknown = $row["Unknown"];
        $total = $row['Total'];

        $education_uwu[] = $education; // Store the education value in the array
        $NonfourPs_count[] = $NonfourPs;
        $fourPs_count[] = $fourPs;
        $unknown_count[] = $unknown;
        $total_count[] = $total;
    }
} else {
    header("Location: ../index.php?error=The username is taken try another");
}
?>

<script>
    var options = {
        series: [{
            name: 'Non-4Ps',
            data: <?php echo json_encode($NonfourPs_count); ?>
        }, {
            name: '4Ps',
            data: <?php echo json_encode($fourPs_count); ?>
        }, {
            name: 'Unknown',
            data: <?php echo json_encode($unknown_count); ?>
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: <?php echo json_encode($education_uwu); ?>,
        },
        yaxis: {
            title: {
                text: '$ (Person)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " Person"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#donutchart"), options);
    chart.render();
</script>

					</div>						
					<div class="explanation" style="width: 450px; margin: 0;">
						<div id="prochart"></div>
                        <?php

// Arrays to store the data
$ageCategories = [];
$maleCounts = [];
$femaleCounts = [];

function ageInDays($ageInYears) {
    // Assuming an average year has 365.25 days to account for leap years
    $daysInYear = 365.25;
    
    // Calculate the age in days
    $ageInDays = $ageInYears * $daysInYear;
    
    return $ageInDays;
}

$sqli = "SELECT Age FROM profiling pro INNER JOIN age_table age ON pro.Record_ID = age.Record_ID 
INNER JOIN personal_information pi ON pi.Record_ID = pro.Record_ID";
$sqlresult = mysqli_query($conn, $sqli);
$ageInDays = 0;
if ($sqlresult) {
    while ($row = mysqli_fetch_assoc($sqlresult)) {
        $ageInYears = $row['Age']; // Get the age in years from the database
            
        $ageInDays = ageInDays($ageInYears);
    }
}else{
    echo "No Record Found";
}

$query = "SELECT
CASE
    WHEN $ageInDays >= 1 AND $ageInDays <= 28 THEN '1-28 days'
    WHEN $ageInDays >= 29 AND $ageInDays <= 334.584 THEN '29-11mos'
    WHEN Age >= 1 AND Age <= 4 THEN '1-4 year old'
    WHEN Age >= 5 AND Age <= 9 THEN '5-9 years old'
    WHEN Age >= 10 AND Age <= 14 THEN '10-14 years old'
    WHEN Age >= 15 AND Age <= 19 THEN '15-19 years old'
    WHEN Age >= 20 AND Age <= 24 THEN '20-24 years old'
    WHEN Age >= 25 AND Age <= 29 THEN '25-29 years old'
    WHEN Age >= 30 AND Age <= 34 THEN '30-34 years old'
    WHEN Age >= 35 AND Age <= 39 THEN '35-39 years old'
    WHEN Age >= 40 AND Age <= 44 THEN '40-44 years old'
    WHEN Age >= 45 AND Age <= 49 THEN '45-49 years old'
    WHEN Age >= 50 AND Age <= 54 THEN '50-54 years old'
    WHEN Age >= 55 AND Age <= 59 THEN '55-59 years old'
    WHEN Age >= 60 AND Age <= 64 THEN '60-64 years old'
    WHEN Age >= 65 AND Age <= 69 THEN '65-69 years old'
    ELSE '>70 years old'
END AS Age_Group,
SUM(CASE WHEN sex = 'M' THEN 1 ELSE 0 END) AS Male_Count,
SUM(CASE WHEN sex = 'F' THEN 1 ELSE 0 END) AS Female_Count
FROM profiling pro
INNER JOIN age_table age ON pro.Record_ID = age.Record_ID
INNER JOIN personal_information pi ON pi.Record_ID = pro.Record_ID
INNER JOIN address_information ai ON pro.Record_ID = ai.Record_ID 

GROUP BY Age_Group;";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ageCategory = $row["Age_Group"];
        $femaleCount = $row["Female_Count"];
        $maleCount = $row["Male_Count"];

        // Populate the arrays
        $ageCategories[] = $ageCategory;
        $maleCounts[] = $maleCount;
        $femaleCounts[] = $femaleCount;
    }
} else {
   echo "No Record Found";
}

?>

<script>
    var options = {
        series: [{
            name: 'Male',
            data: <?php echo json_encode($maleCounts); ?>
        }, {
            name: 'Female',
            data: <?php echo json_encode($femaleCounts); ?>
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: <?php echo json_encode($ageCategories); ?>,
        },
        yaxis: {
            title: {
                text: '$ (Person)'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " Person"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#prochart"), options);
    chart.render();
</script>

					</div>
                    <div class="chart-container">
                    <div id="dochart" style="width: 500px; height: 500px; margin: 0;"></div>
                    <?php
$education_uwu = [];
$NonfourPs_count = [];
$fourPs_count = [];
$unknown_count = [];
$total_count = [];
$donut_query = "SELECT method_use,
                SUM(CASE WHEN fourps = 'Yes' THEN 1 ELSE 0 END) AS '4Ps',
                SUM(CASE WHEN fourps = 'NO' THEN 1 ELSE 0 END) AS 'Non-4Ps',
                SUM(CASE WHEN fourps = 'Unknown' THEN 1 ELSE 0 END) AS 'Unknown',
                SUM(CASE WHEN fourps IN ('Yes', 'NO', 'Unknown') THEN 1 ELSE 0 END) AS 'Total'
                FROM profiling pi
                INNER JOIN medical_information oi ON pi.Record_ID = oi.Record_ID
				INNER JOIN address_information ai ON pi.Record_ID = ai.Record_ID

                GROUP BY method_use;";
$donut_result = mysqli_query($conn, $donut_query);
if ($donut_result) {
    while ($row = mysqli_fetch_assoc($donut_result)) {
        $education = $row["method_use"]; // Get the education value from the database
        $fourPs = $row["4Ps"];
        $NonfourPs = $row["Non-4Ps"];
        $unknown = $row["Unknown"];
        $total = $row['Total'];

        $education_uwu[] = $education; // Store the education value in the array
        $NonfourPs_count[] = $NonfourPs;
        $fourPs_count[] = $fourPs;
        $unknown_count[] = $unknown;
        $total_count[] = $total;
    }
} else {
    header("Location: ../index.php?error=The username is taken try another");
}
?>

                    <script>
    var options = {
        series: [{
            name: 'Non-4Ps',
            data: <?php echo json_encode($NonfourPs_count); ?>
        }, {
            name: '4Ps',
            data: <?php echo json_encode($fourPs_count); ?>
        }, {
            name: 'Unknown',
            data: <?php echo json_encode($unknown_count); ?>
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: <?php echo json_encode($education_uwu); ?>,
        },
        yaxis: {
            title: {
                text: ' (Person)'
            },
            forceNiceScale: false,

        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return  val + " Person"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#dochart"), options);
    chart.render();
</script>
                    </div>
					<div class="explanation" style="width: 500px; margin: 0;">
                    <div id="lachart"></div>
                    <?php
$query7 = "SELECT `religion`, COUNT(*) AS religion_count FROM profiling p 
INNER JOIN other_information oi ON p.Record_ID = oi.Record_ID
INNER JOIN address_information ai ON p.Record_ID = ai.Record_ID 
 
GROUP BY `religion`";
$result7 = mysqli_query($conn, $query7);

$data = array(); // Initialize an array to store your data

if ($result7) {
    while ($row = mysqli_fetch_assoc($result7)) {
        $religion = $row["religion"];
        $count = $row["religion_count"];
        // Add data to the array
        $data[] = array('religion' => $religion, 'count' => $count);
    }
} else {
    // Handle the error appropriately, e.g., redirect to an error page
    die("Database query failed: " . mysqli_error($conn));
}
?>

<script>
var data = <?php echo json_encode($data); ?>; // Get the dynamic data from PHP

// Calculate the total count
var total = data.reduce((sum, item) => sum + item.count, 0);

// Normalize the data
var normalizedData = data.map(item => ({
    religion: item.religion,
    count: (item.count / total) * 100, // Calculate the percentage
}));

var options = {
    series: normalizedData.map(item => item.count), // Use dynamic data for the series
    chart: {
        type: 'donut',
        toolbar: {
                show: true,
                tools: {
                    download: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    reset: true | '<img src="/static/icons/reset.png" width="20">',
                    customIcons: []
                },
                export: {
                    csv: {
                        filename: undefined,
                        columnDelimiter: ',',
                        headerCategory: 'category',
                        headerValue: 'value',
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                        }
                    },
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
                autoSelected: 'zoom'
            },
    },
    labels: normalizedData.map(item => item.religion), // Use dynamic data for labels
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }], tooltip: {
    y: {
        formatter: function (value, { series, seriesIndex, dataPointIndex, w }) {
            // Retrieve the original count from the unnormalized data
            var originalCount = data[dataPointIndex].count; // Use the dynamic data
            return originalCount.toString(); // Show the original count as a string
        }
    }
}

};

var chart = new ApexCharts(document.querySelector("#lachart"), options);
chart.render();
</script>





                    </div>
                    <div class="explanation" style="width: 450px; margin: 0;">
                    <div id="sexchart"></div>
                    <?php
$query = "SELECT `sex`, COUNT(*) AS NUM FROM profiling p INNER JOIN personal_information pi ON p.Record_ID = pi.Record_ID 
INNER JOIN address_information ai ON p.Record_ID = ai.Record_ID 
GROUP BY `sex`";
$result = mysqli_query($conn, $query);

$data = array(); // Initialize an array to store your data

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sex = $row["sex"];
        $count = $row["NUM"];
        // Add data to the array
        $data[] = array('sex' => $sex, 'count' => $count);
    }
} else {
    // Handle the error appropriately, e.g., redirect to an error page
    die("Database query failed: " . mysqli_error($conn));
}
?>

<script>
    var chartData = <?php echo json_encode($data); ?>;

    // Calculate the total sum of counts
    var total = chartData.reduce((sum, item) => sum + item.count, 0);

    // Normalize the data
    var normalizedData = chartData.map(item => ({
        sex: item.sex, // Use the correct key 'sex'
        count: (item.count / total) * 100
    }));

    var options = {
        series: normalizedData.map(item => item.count),
        chart: {
            width: 430,
            type: 'donut',
            toolbar: {
                show: true,
                tools: {
                    download: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    reset: true | '<img src="/static/icons/reset.png" width="20">',
                    customIcons: []
                },
                export: {
                    csv: {
                        filename: undefined,
                        columnDelimiter: ',',
                        headerCategory: 'category',
                        headerValue: 'value',
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                        }
                    },
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
                autoSelected: 'zoom'
            },
        },
        labels: normalizedData.map(item => item.sex),
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 500
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
            y: {
                formatter: function (value, { series, seriesIndex, dataPointIndex, w }) {
                    // Retrieve the original count from the unnormalized data
                    var originalCount = chartData[dataPointIndex].count;
                    return originalCount.toString(); // Show the original count as a string
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#sexchart"), options);
    chart.render();
</script>

                    </div>
                    <div class="chart-container">
                    <div id="sochart" style="width: 500px; height: 500px; margin: 0;"></div>
                    <?php
$education_uwu = [];
$NonfourPs_count = [];
$fourPs_count = [];
$unknown_count = [];
$total_count = [];
$donut_query = "SELECT water,
                SUM(CASE WHEN fourps = 'Yes' THEN 1 ELSE 0 END) AS '4Ps',
                SUM(CASE WHEN fourps = 'NO' THEN 1 ELSE 0 END) AS 'Non-4Ps',
                SUM(CASE WHEN fourps = 'Unknown' THEN 1 ELSE 0 END) AS 'Unknown',
                SUM(CASE WHEN fourps IN ('Yes', 'NO', 'Unknown') THEN 1 ELSE 0 END) AS 'Total'
                FROM profiling pi
				INNER JOIN address_information ai ON pi.Record_ID = ai.Record_ID
                GROUP BY water;";
$donut_result = mysqli_query($conn, $donut_query);
if ($donut_result) {
    while ($row = mysqli_fetch_assoc($donut_result)) {
        $education = $row["water"]; // Get the education value from the database
        $fourPs = $row["4Ps"];
        $NonfourPs = $row["Non-4Ps"];
        $unknown = $row["Unknown"];
        $total = $row['Total'];

        $education_uwu[] = $education; // Store the education value in the array
        $NonfourPs_count[] = $NonfourPs;
        $fourPs_count[] = $fourPs;
        $unknown_count[] = $unknown;
        $total_count[] = $total;
    }
} else {
    header("Location: ../index.php?error=The username is taken try another");
}
?>

                    <script>
    var options = {
        series: [{
            name: 'Non-4Ps',
            data: <?php echo json_encode($NonfourPs_count); ?>
        }, {
            name: '4Ps',
            data: <?php echo json_encode($fourPs_count); ?>
        }, {
            name: 'Unknown',
            data: <?php echo json_encode($unknown_count); ?>
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: <?php echo json_encode($education_uwu); ?>,
        },
        yaxis: {
            title: {
                text: ' (Person)'
            },
            forceNiceScale: false,

        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return  val + " Person"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#sochart"), options);
    chart.render();
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