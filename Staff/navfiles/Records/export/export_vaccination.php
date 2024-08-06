<?php
include "config.php";

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;



if(isset($_POST['exportdata']))
{
    $fileName = "vaccination Record";
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql ="SELECT p.*, pi.*, mi.*, vi.*, age.*, ta.*
    FROM vaccination p
    LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
    LEFT JOIN vaccine mi ON pi.Record_ID = mi.Record_ID
    LEFT JOIN vaccine_other_information vi ON pi.Record_ID = vi.Record_ID
    LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
    LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE p.Date_input BETWEEN '$from' AND '$to'
    GROUP BY p.Record_ID;
    ";
    $query_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Category');
        $sheet->setCellValue('B1', 'Comorbidity');
        $sheet->setCellValue('C1', 'Unique  Person ID');
        $sheet->setCellValue('D1', 'Person With Disability(Specify)');
        $sheet->setCellValue('E1', 'IP Group(Specify)');
        $sheet->setCellValue('F1', 'Last Name');
        $sheet->setCellValue('G1', 'Full Name');
        $sheet->setCellValue('H1', 'Middle Name');        
        $sheet->setCellValue('I1', 'Contact Number');
        $sheet->setCellValue('J1', 'Guardian');
        $sheet->setCellValue('K1', 'Region');
        $sheet->setCellValue('L1', 'Province');
        $sheet->setCellValue('M1', 'Municipality');
        $sheet->setCellValue('N1', 'Barangay');
        $sheet->setCellValue('O1', 'Sex');
        $sheet->setCellValue('P1', 'Birthday');
        $sheet->setCellValue('Q1', 'Deferral');
        $sheet->setCellValue('R1', 'Reason for Deferral');
        $sheet->setCellValue('S1', 'Date of Vaccination');
        $sheet->setCellValue('T1', 'Vaccine Manufacturer');
        $sheet->setCellValue('U1', 'Batch Number');
        $sheet->setCellValue('V1', 'Lot No.');
        $sheet->setCellValue('W1', 'Bakuna');
        $sheet->setCellValue('X1', 'Vaccinator Name');
        $sheet->setCellValue('Y1', 'First Dose');
        $sheet->setCellValue('Z1', 'Second Dose');
        $sheet->setCellValue('AA1', 'First Booster Dose');
        $sheet->setCellValue('AB1', 'Second Booster Dose');
        $sheet->setCellValue('AC1', 'Adverse');
        $sheet->setCellValue('AD1', 'Adverse Event Condition');
        $sheet->setCellValue('AE1', 'Row Hash');

        $rowCount = 2;
        foreach($query_run as $data)
        {
            $sheet->setCellValue('A'.$rowCount, $data['Category']);
            $sheet->setCellValue('B'.$rowCount, $data['Comorbidity']);
            $sheet->setCellValue('C'.$rowCount, $data['Unique_Person_ID']);
            $sheet->setCellValue('D'.$rowCount, $data['PWD']);
            $sheet->setCellValue('E'.$rowCount, $data['IP']);
            $sheet->setCellValue('F'.$rowCount, $data['LName']);
            $sheet->setCellValue('G'.$rowCount, $data['FName']);
            $sheet->setCellValue('H'.$rowCount, $data['MName']);
            $sheet->setCellValue('I'.$rowCount, $data['contact_num']);     
            $sheet->setCellValue('J'.$rowCount, $data['Guardian']);
            $sheet->setCellValue('K'.$rowCount, $data['Region']);
            $sheet->setCellValue('L'.$rowCount, $data['Province']);
            $sheet->setCellValue('M'.$rowCount, $data['Municipality']);
            $sheet->setCellValue('N'.$rowCount, $data['Barangay']);
            $sheet->setCellValue('O'.$rowCount, $data['sex']);
            $sheet->setCellValue('P'.$rowCount, $data['birthdate']);
            $sheet->setCellValue('Q'.$rowCount, $data['Deferral']);
            $sheet->setCellValue('R'.$rowCount, $data['Reason_for_Deferral']);
            $sheet->setCellValue('S'.$rowCount, $data['Vaccination_Date']);
            $sheet->setCellValue('T'.$rowCount, $data['Vaccine_Manufacturer']);
            $sheet->setCellValue('U'.$rowCount, $data['Batch_Number']);
            $sheet->setCellValue('V'.$rowCount, $data['Lot_num']);
            $sheet->setCellValue('W'.$rowCount, $data['Bakuna']);
            $sheet->setCellValue('X'.$rowCount, $data['Vaccinator']);
            $sheet->setCellValue('Y'.$rowCount, $data['First_Dose']);
            $sheet->setCellValue('Z'.$rowCount, $data['Second_Dose']);
            $sheet->setCellValue('AA'.$rowCount, $data['First_Booster']);
            $sheet->setCellValue('AB'.$rowCount, $data['Second_Booster']);
            $sheet->setCellValue('AC'.$rowCount, $data['Adverse_Event']);
            $sheet->setCellValue('AD'.$rowCount, $data['Adverse_Condition']);
            $sheet->setCellValue('AE'.$rowCount, $data['Row_hash']);


            $rowCount++;
        }
        $sheet->getStyle('A1:Ae1')->getFont()->setBold(true)->setSize(12);
        
        $sheet->setAutoFilter('A1:AE1'); 
        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }   


$query = "SELECT `First_Dose`, COUNT(*) AS NUM 
          FROM vaccine 
          INNER JOIN vaccination p ON p.Record_ID = vaccine.Record_ID
          WHERE p.Date_input BETWEEN '$from' AND '$to' 
          GROUP BY `First_Dose`";
        $result = mysqli_query($conn, $query);
        
        $data = array(); // Initialize an array to store your data
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $manufacturer = $row["First_Dose"];
                $count = $row["NUM"];
                // Add data to the array
                $data[] = array('First_Dose' => $manufacturer, 'NUM' => $count);
            }
        } else {
            // Handle the error appropriately, e.g., redirect to an error page
            die("Database query failed: " . mysqli_error($conn));
        }
        
         $query = "SELECT `Second_Dose`, COUNT(*) AS NUMBER FROM vaccine  INNER JOIN vaccination p ON p.Record_ID = vaccine.Record_ID
          WHERE p.Date_input BETWEEN '$from' AND '$to'  GROUP BY `Second_Dose`";
        $result = mysqli_query($conn, $query);
        
        $dataser = array(); // Initialize an array to store your data
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $vaccine = $row["Second_Dose"];
                $counter = $row["NUMBER"];
                // Add data to the array
                $dataser[] = array('Second_Dose' => $vaccine, 'NUMBER' => $counter);
            }
        } else {
            // Handle the error appropriately, e.g., redirect to an error page
            die("Database query failed: " . mysqli_error($conn));
        }
          $query = "SELECT `Second_Booster`, COUNT(*) AS number FROM vaccine  INNER JOIN vaccination p ON p.Record_ID = vaccine.Record_ID
          WHERE p.Date_input BETWEEN '$from' AND '$to'  GROUP BY `Second_Dose`";
        $result = mysqli_query($conn, $query);
        
        $item = array(); // Initialize an array to store your data
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $second = $row["Second_Booster"];
                $counte_second = $row["number"];
                // Add data to the array
                $item[] = array('Second_Booster' =>  $second, 'number' => $counte_second);
            }
        } else {
            // Handle the error appropriately, e.g., redirect to an error page
            die("Database query failed: " . mysqli_error($conn));
        }
         $query = "SELECT `First_Booster`, COUNT(*) AS NUMBERS FROM vaccine  INNER JOIN vaccination p ON p.Record_ID = vaccine.Record_ID
          WHERE p.Date_input BETWEEN '$from' AND '$to'  GROUP BY `Second_Dose`";
        $result = mysqli_query($conn, $query);
        
        $d = array();// Initialize an array to store your data
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $vacci = $row["First_Booster"];
                $vaccine_booster = $row["NUMBERS"];
                // Add data to the array
                $d[] = array('First_Booster' => $vacci, 'NUMBERS' => $vaccine_booster);
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

    $sheet3->setCellValue('E2', 'Province: Camarines Sur');
    $sheet3->setCellValue('E3', 'Date:'.$to.''
);

    $sheet3->setCellValue('A1', 'Covid 19 Vaccination SUMMARY');
    $sheet3->setCellValue('A2', 'Region: V');
    $sheet3->setCellValue('A3', 'Municipality: San Jose');
    $sheet3->setCellValue('A4', 'First Dose Vaccine');
    $sheet3->setCellValue('B4', 'Number');


    $style = $sheet3->getStyle('A1:E3');

    // Set the horizontal alignment to center
    $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $style->getFont()->setBold(true);

    $rowCount = 5;
 
    foreach ($data as $datas) {
        $sheet3->setCellValue('A' . $rowCount, $datas['First_Dose']);  // Fix variable name here
        $sheet3->setCellValue('B' . $rowCount, $datas['NUM']);  // Fix variable name here
    
        $rowCount++;
    } 

    
        $sheet3->setCellValue('D4', 'Second Dose Vaccine');
    $sheet3->setCellValue('E4', 'Number');


    $style = $sheet3->getStyle('D4:E4');

    $style->getFont()->setBold(true);

    $rowCount = 5;
 
    foreach ($dataser as $dat) {
        $sheet3->setCellValue('D' . $rowCount, $dat['Second_Dose']);  // Fix variable name here
        $sheet3->setCellValue('E' . $rowCount, $dat['NUMBER']);  // Fix variable name here
    
        $rowCount++;
    } 
        $sheet3->setCellValue('A13', 'First Booster Dose Vaccine');
    $sheet3->setCellValue('B13', 'Number');


    $style = $sheet3->getStyle('D4:E4');

    $style->getFont()->setBold(true);

    $rowCount = 14;
 
    foreach ($d as $da) {
        $sheet3->setCellValue('A' . $rowCount, $da['First_Booster']);  // Fix variable name here
        $sheet3->setCellValue('B' . $rowCount, $da['NUMBERS']);  // Fix variable name here
    
        $rowCount++;
    } 
    $sheet3->setCellValue('D13', 'Second Booster Dose Vaccine');
    $sheet3->setCellValue('E13', 'Number');


    $style = $sheet3->getStyle('D13:E13');

    $style->getFont()->setBold(true);

    $rowCount = 14;
 
    foreach ($item as $items) {
        $sheet3->setCellValue('D' . $rowCount, $items['Second_Booster']);  // Fix variable name here
        $sheet3->setCellValue('E' . $rowCount, $items['number']);  // Fix variable name here
    
        $rowCount++;
    } 
    $sql = "SELECT `Category`, 
               SUM(CASE WHEN `Dose_Type` = 'First Dose' THEN 1 ELSE 0 END) AS FirstDoseCount,
               SUM(CASE WHEN `Dose_Type` = 'Second Dose' THEN 1 ELSE 0 END) AS SecondDoseCount,
               SUM(CASE WHEN `Dose_Type` = 'First Booster' THEN 1 ELSE 0 END) AS FirstBoosterCount,
               SUM(CASE WHEN `Dose_Type` = 'Second Booster' THEN 1 ELSE 0 END) AS SecondBoosterCount
        FROM vaccination INNER JOIN vaccine v ON vaccination.Record_ID = v.Record_ID
        WHERE vaccination.Date_input BETWEEN '$from' AND '$to' 
        GROUP BY `Category`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $categories = [];
    $firstDoseCounts = [];
    $secondDoseCounts = [];
    $firstBoosterCounts = [];
    $secondBoosterCounts = [];

    while ($row = $result->fetch_assoc()) {
        $category = $row["Category"];
        $firstDoseCount = $row["FirstDoseCount"];
        $secondDoseCount = $row["SecondDoseCount"];
        $firstBoosterCount = $row["FirstBoosterCount"];
        $secondBoosterCount = $row["SecondBoosterCount"];

        $categories[] = $category;
        $firstDoseCounts[] = $firstDoseCount;
        $secondDoseCounts[] = $secondDoseCount;
        $firstBoosterCounts[] = $firstBoosterCount;
        $secondBoosterCounts[] = $secondBoosterCount;
    }
} else {
    echo "No data found.";
}
$sheet3->setCellValue('A22', 'Category');
$sheet3->setCellValue('B22', 'First Dose');
$sheet3->setCellValue('C22', 'Second Dose');
$sheet3->setCellValue('D22', 'First Dooster Dose');
$sheet3->setCellValue('E22', 'Second Dooster Dose');


$style = $sheet3->getStyle('A22:E22');

$style->getFont()->setBold(true);

$rowCount = 23;

foreach ($categories as $key => $category) {
    $sheet3->setCellValue('A' . $rowCount,$category);
    $sheet3->setCellValue('B' . $rowCount, $firstDoseCounts[$key]);
    $sheet3->setCellValue('C' . $rowCount,  $secondDoseCounts[$key]);  // Fix variable name here
    $sheet3->setCellValue('D' . $rowCount,  $firstBoosterCounts[$key]);  // Fix variable name here
    $sheet3->setCellValue('E' . $rowCount,   $secondBoosterCounts[$key]);  // Fix variable name here

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
        $sheet3->getStyle('A4:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);

        $sheet3->getStyle('A4:B4')->getFill()->setRotation(0);
        $sheet3->getStyle('A4:B4')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('A4:B4')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('A4:B4')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('A4:B4')->getFont()->setBold(true)->setSize(12);
        foreach (range('A', 'B') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
           $sheet3->getStyle('D4:E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);

        $sheet3->getStyle('D4:E4')->getFill()->setRotation(0);
        $sheet3->getStyle('D4:E4')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('D4:E4')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('D4:E4')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('D4:E4')->getFont()->setBold(true)->setSize(12);
        foreach (range('D', 'E') as $column) {
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
          $sheet3->getStyle('D13:E13')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);

        $sheet3->getStyle('D13:E13')->getFill()->setRotation(0);
        $sheet3->getStyle('D13:E13')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet3->getStyle('D13:E13')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet3->getStyle('D13:E13')->getFont()->setBold(true)->setSize(12);
        $sheet3->getStyle('D13:E13')->getFont()->setBold(true)->setSize(12);
        foreach (range('D', 'E') as $column) {
            $sheet3->getColumnDimension($column)->setAutoSize(true);
        }
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';

        // $writer->save($final_filename);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.urlencode($final_filename).'"');
        $writer->save('php://output');

    }
    else
    {
        $_SESSION['message'] = "No Record Found";
        header('Location: ../../files/Records.php');
        exit(0);
    }
}

?>