<?php
include "../Add Record/config.php";

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['exportdata']))
{
    $fileName = "Checkup Data";
    $file_ext_name = 'xlsx';
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql ="SELECT p.*, pi.*, mi.*, oi.*, age.*, ta.*
    FROM checkup p
    LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
    LEFT JOIN medical_information mi ON pi.Record_ID = mi.Record_ID
    LEFT JOIN other_information oi ON pi.Record_ID = oi.Record_ID
    LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
    LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE p.Date_input BETWEEN '$from' AND '$to'";
    
    $query_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Family Serial Number');
        $sheet->setCellValue('B1', 'Full Name');
        $sheet->setCellValue('C1', 'Birthdate');
        $sheet->setCellValue('D1', 'Age');
        $sheet->setCellValue('E1', 'Gender');
        $sheet->setCellValue('F1', 'Address');
        $sheet->setCellValue('G1', 'Medical History');
        $sheet->setCellValue('H1', 'Attending Physician');
        $sheet->setCellValue('I1', 'House Hold Head');
        $sheet->setCellValue('J1', 'Classification(NHTS, Non-NHTS, Non-NHTS Poor)');
        $sheet->setCellValue('K1', 'Philhealth Number');
        $sheet->setCellValue('L1', 'PWD (specify)');
        $sheet->setCellValue('M1', 'Date');
        $sheet->setCellValue('N1', 'Vs/ Chief Complaint');
        $sheet->setCellValue('O1', 'Diagnosis');
        $sheet->setCellValue('P1', 'Treatment');


        $rowCount = 2;
        foreach($query_run as $data)
        {
            $lastName = $data['LName']; 
$firstName = $data['FName']; 
$middleName = $data['MName']; 
$Barangay = $data['Barangay'];
$Municipality = $data ['Municipality'];
$Province = $data ['Province'];

            $sheet->setCellValue('A'.$rowCount, $data['Family_Serial_num']);
            $sheet->setCellValue('B'.$rowCount, $lastName . ' ' . $firstName . ' ' . $middleName);
            $sheet->setCellValue('C'.$rowCount, $data['birthdate']);
            $sheet->setCellValue('D'.$rowCount, $data['Age']);
            $sheet->setCellValue('E'.$rowCount, $data['sex']);
            $sheet->setCellValue('F'.$rowCount, $Barangay .' '.$Municipality.''.$Province);
            $sheet->setCellValue('G'.$rowCount, $data['history']);     
            $sheet->setCellValue('H'.$rowCount, $data['physician']);
            $sheet->setCellValue('I'.$rowCount, $data['Head']);
            $sheet->setCellValue('J'.$rowCount, $data['classification']);
            $sheet->setCellValue('K'.$rowCount, $data['philhealthnum']);
            $sheet->setCellValue('L'.$rowCount, $data['contact_num']);
            $sheet->setCellValue('M'.$rowCount, $data['Date']);
            $sheet->setCellValue('N'.$rowCount, $data['VSChief_Complaint']);
            $sheet->setCellValue('O'.$rowCount, $data['Diagnosis']);
            $sheet->setCellValue('P'.$rowCount, $data['treatment']);



                        $rowCount++;
        }
        $sheet->getStyle('A1:P1')->getFont()->setBold(true)->setSize(11);

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
        
        $sheet->getStyle('A1:P1')->applyFromArray($style);      


        $sheet->getStyle('A1:P1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet->getStyle('A1:P1')->getFill()->setRotation(0);
        $sheet->getStyle('A1:P1')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet->getStyle('A1:P1')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet->setAutoFilter('A1:P1'); 
        foreach (range('A', 'P') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        if($file_ext_name == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $fileName.'.xlsx';
        }

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