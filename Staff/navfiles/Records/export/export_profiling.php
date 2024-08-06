<?php
include "../Add Record/config.php";

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['exportdata']))
{
    $fileName = "Profiling";
    $file_ext_name = 'xlsx';
    $from = $_POST['from'];
    $to = $_POST['to'];



    $sql ="SELECT p.*, pi.*, mi.*, oi.*, age.*, ta.* FROM profiling p
    LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
    LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
  LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
  LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
  LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID					    
    WHERE p.Date_input BETWEEN ' $from' AND '$to';
    ";
    $query_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Date of Visit');
        $sheet->setCellValue('B1', 'Household Number');
        $sheet->setCellValue('C1', 'Barangay');
        $sheet->setCellValue('D1', 'Number of Famil/ies in the Household');
        $sheet->setCellValue('E1', 'Last Name');
        $sheet->setCellValue('F1', 'Full Name');
        $sheet->setCellValue('G1', 'Middle Name');
        $sheet->setCellValue('H1', 'Relationship to the HH Head');
        $sheet->setCellValue('I1', 'Birthday (mm/dd/yyyy)');
        $sheet->setCellValue('J1', 'Age in Years and Months');
        $sheet->setCellValue('K1', 'Sex');
        $sheet->setCellValue('L1', 'Civil Status');
        $sheet->setCellValue('M1', 'Educational Attainment');
        $sheet->setCellValue('N1', 'Religion');
        $sheet->setCellValue('O1', 'Ethnicity');
        $sheet->setCellValue('P1', '4Ps Member');
        $sheet->setCellValue('Q1', 'if Yes: 4Ps number');
        $sheet->setCellValue('R1', 'Philhealth Category');
        $sheet->setCellValue('S1', 'Philhealth Number');
        $sheet->setCellValue('T1', 'Medical History');
        $sheet->setCellValue('U1', 'Classification by Age/Health risk Group');
        $sheet->setCellValue('V1', 'If Pregnant;
        Last Menstrual Period (LMP)
        (yyyy-mm-dd)');
        $sheet->setCellValue('W1', 'Using any FP methods?');
        $sheet->setCellValue('X1', 'FP methods Used');
        $sheet->setCellValue('Y1', 'FP Status');
        $sheet->setCellValue('Z1', 'Type of Water Source');
        $sheet->setCellValue('AA1', 'Type of Toilet Facility');





        $rowCount = 2;
        foreach($query_run as $data)
        {
            $sheet->setCellValue('A'.$rowCount, $data['Visit']);
            $sheet->setCellValue('B'.$rowCount, $data['household_num']);
            $sheet->setCellValue('C'.$rowCount, $data['Barangay']);
            $sheet->setCellValue('D'.$rowCount, $data['number_family']);
            $sheet->setCellValue('E'.$rowCount, $data['LName']);
            $sheet->setCellValue('F'.$rowCount, $data['FName']);
            $sheet->setCellValue('G'.$rowCount, $data['MName']);
            $sheet->setCellValue('H'.$rowCount, $data['relationship']);
            $sheet->setCellValue('I'.$rowCount, $data['birthdate']);
            $sheet->setCellValue('J'.$rowCount, $data['Age_in_years_months']);     
            $sheet->setCellValue('K'.$rowCount, $data['sex']);
            $sheet->setCellValue('L'.$rowCount, $data['civil_status']);
            $sheet->setCellValue('M'.$rowCount, $data['education']);
            $sheet->setCellValue('N'.$rowCount, $data['religion']);
            $sheet->setCellValue('O'.$rowCount, $data['Ethinicity']);
            $sheet->setCellValue('P'.$rowCount, $data['fourps']);
            $sheet->setCellValue('Q'.$rowCount, $data['fourps_number']);
            $sheet->setCellValue('R'.$rowCount, $data['phil_category']);
            $sheet->setCellValue('S'.$rowCount, $data['phil_number']);
            $sheet->setCellValue('T'.$rowCount, $data['history']);
            $sheet->setCellValue('U'.$rowCount, $data['classification']);
            $sheet->setCellValue('V'.$rowCount, $data['mentraul']);
            $sheet->setCellValue('W'.$rowCount, $data['UsingFp']);
            $sheet->setCellValue('X'.$rowCount, $data['method_use']);
            $sheet->setCellValue('Y'.$rowCount, $data['fp_status']);
            $sheet->setCellValue('Z'.$rowCount, $data['water']);
            $sheet->setCellValue('AA'.$rowCount, $data['toilet']);




            $rowCount++;
        }
    }
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
                WHERE pi.Date_input BETWEEN '$from' AND '$to'

                GROUP BY education; ";
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

if ($sqlresult) {
    while ($row = mysqli_fetch_assoc($sqlresult)) {
        $ageInYears = $row['Age']; // Get the age in years from the database
        $ageInDays = ageInDays($ageInYears);

      
    }
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
    ELSE '70 years old'
END AS Age_Group,
SUM(CASE WHEN sex = 'M' THEN 1 ELSE 0 END) AS Male_Count,
SUM(CASE WHEN sex = 'F' THEN 1 ELSE 0 END) AS Female_Count
FROM profiling pro
INNER JOIN age_table age ON pro.Record_ID = age.Record_ID
INNER JOIN personal_information pi ON pi.Record_ID = pro.Record_ID  WHERE pro.Date_input BETWEEN '$from' AND '$to'

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
    header("Location: ../index.php?error=The username is taken try another");
}


$query7 = "SELECT `religion`, COUNT(*) AS religion_count FROM profiling p 
INNER JOIN other_information oi ON p.Record_ID = oi.Record_ID  WHERE p.Date_input BETWEEN '$from' AND '$to'
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
$method = [];
$NonfourPs = [];
$fourPs = [];
$unknown = [];
$total = [];

$donut = "SELECT method_use,
                SUM(CASE WHEN fourps = 'Yes' THEN 1 ELSE 0 END) AS '4Ps',
                SUM(CASE WHEN fourps = 'NO' THEN 1 ELSE 0 END) AS 'Non-4Ps',
                SUM(CASE WHEN fourps = 'Unknown' THEN 1 ELSE 0 END) AS 'Unknown',
                SUM(CASE WHEN fourps IN ('Yes', 'NO', 'Unknown') THEN 1 ELSE 0 END) AS 'Total'
                FROM profiling pi
                INNER JOIN medical_information oi ON pi.Record_ID = oi.Record_ID
                WHERE pi.Date_input BETWEEN '$from' AND '$to'

                GROUP BY method_use;";
$donut_result = mysqli_query($conn, $donut);

if ($donut_result) {
    while ($row = mysqli_fetch_assoc($donut_result)) {
        $method_num = $row["method_use"];
        $fourPs_num = $row["4Ps"];
        $NonfourPs_num = $row["Non-4Ps"];
        $unknown_num = $row["Unknown"];
        $total_num = $row['Total'];

        $method[] = $method_num; // Store the method value in the array
        $NonfourPs[] = $NonfourPs_num;
        $fourPs[] = $fourPs_num;
        $unknown[] = $unknown_num;
        $total[] = $total_num;
    }
} else {
    header("Location: ../index.php?error=The username is taken try another");
}
$water = [];
$Nonfour = [];
$four = [];
$known= [];
$equal = [];
$query = "SELECT water,
                SUM(CASE WHEN fourps = 'Yes' THEN 1 ELSE 0 END) AS '4Ps',
                SUM(CASE WHEN fourps = 'NO' THEN 1 ELSE 0 END) AS 'Non-4Ps',
                SUM(CASE WHEN fourps = 'Unknown' THEN 1 ELSE 0 END) AS 'Unknown',
                SUM(CASE WHEN fourps IN ('Yes', 'NO', 'Unknown') THEN 1 ELSE 0 END) AS 'Total'
                FROM profiling pi
                WHERE pi.Date_input BETWEEN '$from' AND '$to'

                GROUP BY water;";
$donut_result = mysqli_query($conn, $query);
if ($donut_result) {
    while ($row = mysqli_fetch_assoc($donut_result)) {
        $water_num = $row["water"]; // Get the education value from the database
        $four_num = $row["4Ps"];
        $Nonfour_num = $row["Non-4Ps"];
        $un_num = $row["Unknown"];
        $equal_num = $row['Total'];

        $water  [] =  $water_num; // Store the education value in the array
        $Nonfour [] = $Nonfour_num;
        $four [] = $four_num;
        $known[] = $un_num;
        $equal  [] = $equal_num;
    }
} else {
    header("Location: ../index.php?error=The username is taken try another");
}

$query = "SELECT `sex`, COUNT(*) AS NUMER FROM profiling p INNER JOIN personal_information pi ON p.Record_ID = pi.Record_ID 
 WHERE p.Date_input BETWEEN '$from' AND '$to'
GROUP BY sex";
$result = mysqli_query($conn, $query);

$datas = array(); // Initialize an array to store your data

if ($result) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $sex = $rows["sex"];
        $counter = $rows["NUMER"];
        // Add data to the array
        $datas[] = array('sex' => $sex, 'counts' => $counter);
    }
} else {
    // Handle the error appropriately, e.g., redirect to an error page
    die("Database query failed: " . mysqli_error($conn));
}
$query = "SELECT `Ethinicity`, COUNT(*) AS num FROM profiling p INNER JOIN other_information pi ON p.Record_ID = pi.Record_ID GROUP BY Ethinicity";
$result = mysqli_query($conn, $query);

$dataser = array(); // Initialize an array to store your data

if ($result) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $sex = $rows["Ethinicity"];
        $counter = $rows["num"];
        // Add data to the array
        $dataser[] = array('Ethinicity' => $sex, 'count' => $counter);
    }
} else {
    // Handle the error appropriately, e.g., redirect to an error page
    die("Database query failed: " . mysqli_error($conn));
}
$query = "SELECT `civil_status`, COUNT(*) AS num FROM profiling p
 INNER JOIN other_information pi ON p.Record_ID = pi.Record_ID 
 WHERE p.Date_input BETWEEN '$from' AND '$to'

 
 GROUP BY Ethinicity";
$result = mysqli_query($conn, $query);

$datase = array(); // Initialize an array to store your data

if ($result) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $civil = $rows["civil_status"];
        $counter = $rows["num"];
        // Add data to the array
        $datase[] = array('civil_status' => $civil, 'count' => $counter);
    }
} else {
    // Handle the error appropriately, e.g., redirect to an error page
    die("Database query failed: " . mysqli_error($conn));
}

            $sheet3 = $spreadsheet->createSheet();       
            $sheet3->setTitle('SUMMARY');

        $sheet3->mergeCells('A1:H1');
        $sheet3->mergeCells('A2:C2');
        $sheet3->mergeCells('A3:C3');
        $sheet3->mergeCells('E2:H2');
        $sheet3->mergeCells('E3:H3');

        $sheet3->setCellValue('E2', 'Province: camarines Sur');
        $sheet3->setCellValue('E3', 'Date:'.$to.''
    );

        $sheet3->setCellValue('A1', 'HOUSEHOLD PROFILE SUMMARY');
        $sheet3->setCellValue('A2', 'Region: V');
        $sheet3->setCellValue('A3', 'Municility: San Jose');
        $sheet3->setCellValue('A4', 'Education');
        $sheet3->setCellValue('B4', '4Ps');
        $sheet3->setCellValue('C4', 'Non-4Ps');
        $sheet3->setCellValue('D4', 'Unknown');
        $sheet3->setCellValue('E4', 'Total');

        $style = $sheet3->getStyle('A1:E3');

        // Set the horizontal alignment to center
        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $style->getFont()->setBold(true);

        $rowCount = 5;
        foreach ($education_uwu as $keys => $education) {
        

            $sheet3->setCellValue('A' . $rowCount, $education);
            $sheet3->setCellValue('B' . $rowCount, $fourPs_count[$keys]);
            $sheet3->setCellValue('C' . $rowCount, $NonfourPs_count[$keys]);
            $sheet3->setCellValue('D' . $rowCount, $unknown_count[$keys]);
            $sheet3->setCellValue('E' . $rowCount, $femaleCounts[$keys]);
        
            $rowCount++;
        } 
      
      
        $sheet3->setCellValue('A26', 'Age Group');
        $sheet3->setCellValue('B16', 'Female');
        $sheet3->setCellValue('C26', 'Male');
        
        $rowCount = 27;
        foreach ($ageCategories as $key => $ageCategory) {
            $sheet3->setCellValue('A' . $rowCount, $ageCategory);
            $sheet3->setCellValue('B' . $rowCount, $femaleCounts[$key]);
            $sheet3->setCellValue('C' . $rowCount, $maleCounts[$key]);
        
            $rowCount++;
        }

        $sheet3->setCellValue('G4', 'Religion');
        $sheet3->setCellValue('H4', 'Count');
    
        $rowCount = 5;
        foreach ($data as $item) {
            $sheet3->setCellValue('G' . $rowCount, $item['religion']);
            $sheet3->setCellValue('H' . $rowCount, $item['count']);
        
            $rowCount++;
        }
       
        $sheet3->setCellValue('A13', 'Family Planning use');
        $sheet3->setCellValue('B13', '4Ps');
        $sheet3->setCellValue('C13', 'Non-4Ps');
        $sheet3->setCellValue('D13', 'Unknown');
        $sheet3->setCellValue('E13', 'Total');
        
        $rowCount = 14;
        foreach ($method as $index => $method_num) {
            $sheet3->setCellValue('A' . $rowCount, $method_num);
            $sheet3->setCellValue('B' . $rowCount, $fourPs[$index]); // Use $fourPs[$index] instead of $fourPs_num[$index]
            $sheet3->setCellValue('C' . $rowCount, $NonfourPs[$index]); // Use $NonfourPs[$index] instead of $NonfourPs_num[$index]
            $sheet3->setCellValue('D' . $rowCount, $unknown[$index]); // Use $unknown[$index] instead of $unknown_num[$index]
            $sheet3->setCellValue('E' . $rowCount, $total[$index]); // Use $total[$index] instead of $total_num[$index]
            $rowCount++;
        }
   
 $sheet3->setCellValue('A21', 'Water Source');
 $sheet3->setCellValue('B21', '4Ps');
 $sheet3->setCellValue('C21', 'Non-4Ps');
 $sheet3->setCellValue('D21', 'Unknown');
 $sheet3->setCellValue('E21', 'Total');

$rowCount = 22;
foreach ($water as $index => $water_num) {
    $sheet3->setCellValue('A' . $rowCount, $water_num);
    $sheet3->setCellValue('B' . $rowCount, $four[$index]); // Use $four[$index] instead of $four_num[$index]
    $sheet3->setCellValue('C' . $rowCount, $Nonfour[$index]); // Use $Nonfour[$index] instead of $Nonfour_num[$index]
    $sheet3->setCellValue('D' . $rowCount, $known[$index]); // Use $known[$index] instead of $un_num[$index]
    $sheet3->setCellValue('E' . $rowCount, $equal[$index]); // Use $equal[$index] instead of $equal_num[$index]
    $rowCount++;
}

$sheet3->setCellValue('G9', 'Sex');
$sheet3->setCellValue('H9', 'Count');

$rowCount = 10;
foreach ($datas as $data) {
    $sheet3->setCellValue('G' . $rowCount, $data['sex']);  // Fix variable name here
    $sheet3->setCellValue('H' . $rowCount, $data['counts']);  // Fix variable name here

    $rowCount++;
}

$sheet3->setCellValue('G21', 'Ethnicity');
$sheet3->setCellValue('H21', 'Count');

$rowCount = 22;
foreach ($dataser as $data) {
    $sheet3->setCellValue('G' . $rowCount, $data['Ethinicity']);  // Fix variable name here
    $sheet3->setCellValue('H' . $rowCount, $data['count']);  // Fix variable name here

    $rowCount++;
}

 $sheet3->setCellValue('G13', 'Civil Status');
 $sheet3->setCellValue('H13', 'Count');

$rowCount = 14;
foreach ($datase as $data) {
    $sheet3->setCellValue('G' . $rowCount, $data['civil_status']);  // Fix variable name here
    $sheet3->setCellValue('H' . $rowCount, $data['count']);  // Fix variable name here

    $rowCount++;
}

        $goldAccent4Lighter60 = [
            'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 0,
            'startcolor' => new \PhpOffice\PhpSpreadsheet\Style\Color('FFF2DD8A'), 
            'endcolor' => new \PhpOffice\PhpSpreadsheet\Style\Color('FFF2DD8A'),
        ];
        
        $style = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
        ];
        

        $sheet->getStyle('A1:Z1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet->getStyle('A1:Z1')->getFill()->setRotation(0);
        $sheet->getStyle('A1:Z1')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet->getStyle('A1:Z1')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true)->setSize(12);
        $sheet->setAutoFilter('A1:Z1'); 
        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet3->getStyle('A4:E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('A4:E4')->getFill()->setRotation(0);
        $sheet3->getStyle('A4:E4')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('A4:E4')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('A4:E4')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('A4:E4')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'E') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        $sheet3->getStyle('A26:E26')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('A26:E26')->getFill()->setRotation(0);
        $sheet3->getStyle('A26:E26')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('A26:E26')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('A26:E26')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('A26:E26')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'C') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        $sheet3->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('G4:H4')->getFill()->setRotation(0);
        $sheet3->getStyle('G4:H4')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('G4:H4')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('G4:H4')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('G4:H4')->getFont()->setBold(true)->setSize(12);
        foreach (range('G', 'H') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        $sheet3->getStyle('A13:E13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('A13:E13')->getFill()->setRotation(0);
        $sheet3->getStyle('A13:E13')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('A13:E13')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('A13:E13')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('A13:E13')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'E') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
         $sheet3->getStyle('A21:E21')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
         $sheet3->getStyle('A21:E21')->getFill()->setRotation(0);
         $sheet3->getStyle('A21:E21')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
         $sheet3->getStyle('A21:E21')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
         $sheet3->getStyle('A21:E21')->getFont()->setBold(true)->setSize(12);
         $sheet3->getStyle('A21:E21')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'E') as $column) {
             $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        $sheet3->getStyle('G9:H9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('G9:H9')->getFill()->setRotation(0);
        $sheet3->getStyle('G9:H9')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('G9:H9')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('G9:H9')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('G9:H9')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'B') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        $sheet3->getStyle('A13:B13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('A13:B13')->getFill()->setRotation(0);
        $sheet3->getStyle('A13:B13')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('A13:B13')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('A13:B13')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('A13:B13')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'B') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        if($file_ext_name == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';
        }
        $sheet3->getStyle('G21:H21')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet3->getStyle('G21:H21')->getFill()->setRotation(0);
        $sheet3->getStyle('G21:H21')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('G21:H21')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('G21:H21')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('G21:H21')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'B') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
        if($file_ext_name == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';
        }

        // $writer->save($final_filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
        $writer->save('php://output');

    }
    else
    {
        $_SESSION['message'] = "No Record Found";
        header('Location: ../../files/Records.php');
        exit(0);
    }


?>