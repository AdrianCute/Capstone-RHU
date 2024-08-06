<?php
include "../Add Record/config.php";

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['exportdata']))
{
    $fileName = "Immunization Record";
    $file_ext_name = 'xlsx';
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql ="SELECT p.*, pi.*, mi.*, age.*, ta.*, bi.*
    FROM immunization p
    LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
    LEFT JOIN immunization_information mi ON pi.Record_ID = mi.Record_ID
    LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
    LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
    LEFT JOIN baby_information bi ON pi.Record_ID = bi.Record_ID

    WHERE p.Date_input BETWEEN '$from' AND '$to'

    ";
    $query_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Child Name');
        $sheet->setCellValue('B1', 'Date Of Birth');
        $sheet->setCellValue('C1', 'Place of Birth');
        $sheet->setCellValue('D1', 'Address');
        $sheet->setCellValue('E1', 'Mothers Name');
        $sheet->setCellValue('F1', 'Fathers Name');
        $sheet->setCellValue('G1', 'Birth Height');
        $sheet->setCellValue('H1', 'Birth Weight');
        $sheet->setCellValue('I1', 'Sex');
        $sheet->setCellValue('J1', 'Health Center');
        $sheet->setCellValue('K1', 'Barangay');
        $sheet->setCellValue('L1', 'Family Number');
        $sheet->setCellValue('M1', 'At Birth Dose');
        $sheet->setCellValue('N1', '6 Weeks');
        $sheet->setCellValue('O1', '10 Weeks');
        $sheet->setCellValue('P1', '14 Weeks');
        $sheet->setCellValue('Q1', '9 Months');
        $sheet->setCellValue('R1', '12 Months');
        $sheet->setCellValue('S1', 'Eye Prophylaxis');
        $sheet->setCellValue('T1', 'vitamin-K');
        $sheet->setCellValue('U1', 'Exclusive Breest feeding');
        $sheet->setCellValue('V1', 'New Bord Screening');
        $sheet->setCellValue('W1', 'New Born Hearing Screening');







        $rowCount = 2;
        foreach($query_run as $data)
        {
            $lastName = $data['LName']; // Assuming 'LName' is a key in your $data array
            $firstName = $data['FName']; // Assuming 'FName' is a key in your $data array
            $middleName = $data['MName']; // Assuming 'Mname' is a key in your $data array
            $Barangay = $data['Barangay'];
$Municipality = $data ['Municipality'];
$Province = $data ['Province'];

            
            $sheet->setCellValue('A'.$rowCount, $lastName . ' ' . $firstName . ' ' . $middleName);
            $sheet->setCellValue('B'.$rowCount, $data['birthdate']);
            $sheet->setCellValue('C'.$rowCount, $data['PlaceOfBirth']);
            $sheet->setCellValue('D'.$rowCount, $Barangay .' '.$Municipality.''.$Province);
            $sheet->setCellValue('E'.$rowCount, $data['MothersName']);
            $sheet->setCellValue('F'.$rowCount, $data['FathersName']);    
            $sheet->setCellValue('G'.$rowCount, $data['birth_height']);
            $sheet->setCellValue('H'.$rowCount, $data['birth_weight']);
            $sheet->setCellValue('I'.$rowCount, $data['sex']); 
            $sheet->setCellValue('J'.$rowCount, $data['health_center']);
            $sheet->setCellValue('K'.$rowCount, $data['Barangay']);
            $sheet->setCellValue('L'.$rowCount, $data['Familynum']);
            $sheet->setCellValue('M'.$rowCount, $data['atbirth']);
            $sheet->setCellValue('N'.$rowCount, $data['firstDose']);
            $sheet->setCellValue('O'.$rowCount, $data['secondDose']);
            $sheet->setCellValue('P'.$rowCount, $data['thirdDose']);
            $sheet->setCellValue('Q'.$rowCount, $data['fourthDose']);
            $sheet->setCellValue('R'.$rowCount, $data['fifthDose']);
            $sheet->setCellValue('S'.$rowCount, $data['eye_prophy']);
            $sheet->setCellValue('T'.$rowCount, $data['vitamin_K']);
            $sheet->setCellValue('U'.$rowCount, $data['breest_feed']);
            $sheet->setCellValue('V'.$rowCount, $data['nb_screening']);
            $sheet->setCellValue('W'.$rowCount, $data['nb_hscreening']);





            $rowCount++;
        }

        $query = "SELECT `atbirth`, COUNT(*) AS num FROM immunization
        WHERE Date_input BETWEEN '$from' AND '$to'
        
        GROUP BY atbirth";
       $result = mysqli_query($conn, $query);
       
       $data = array(); // Initialize an array to store your data
       
       if ($result) {
           while ($rows = mysqli_fetch_assoc($result)) {
            $atbirth = $rows["atbirth"];
               $counter = $rows["num"];
               // Add data to the array
               $data[] = array('atbirth' => $atbirth, 'count' => $counter);
           }
       } else {
           // Handle the error appropriately, e.g., redirect to an error page
           die("Database query failed: " . mysqli_error($conn));
       }

        $sheet->getStyle('A1:W1')->getFont()->setBold(true)->setSize(12);
        $sheet->setAutoFilter('A1:W1'); 
        foreach (range('A', 'W') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
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

    $sheet3->setCellValue('A1', 'IMMUNIZATION SUMMARY');
    $sheet3->setCellValue('A2', 'Region: V');
    $sheet3->setCellValue('A3', 'Municility: San Jose');
    $sheet3->setCellValue('A4', 'At-Birth Dose');
    $sheet3->setCellValue('B4', 'Count');
   

    $style = $sheet3->getStyle('A1:E3');

    // Set the horizontal alignment to center
    $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    
    $style->getFont()->setBold(true);

    $rowCount = 5;
    foreach ($data as $keys ) {
    

        $sheet3->setCellValue('A' . $rowCount, $keys['atbirth']);
        $sheet3->setCellValue('B' . $rowCount, $keys['count']);
       
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
    


        if($file_ext_name == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';
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
}

?>