<?php
include "config.php";

require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['exportdata']))
{
    $fileName = "Appointment Records";
    $file_ext_name = 'xlsx';
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT a.*, age.*, pi.*, ai.*
    FROM appointment a INNER JOIN age_table age ON a.Record_ID = age.Record_ID
    INNER JOIN personal_information pi ON pi.Record_ID = a.Record_ID
    INNER JOIN address_information ai ON ai.Record_ID = a.Record_ID
    WHERE Status ='Reject' AND Date BETWEEN ' $from' AND '$to';
    ";
    $query_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Full Name');
        $sheet->setCellValue('B1', 'Address');
        $sheet->setCellValue('C1', 'Number');
        $sheet->setCellValue('D1', 'Age');
        $sheet->setCellValue('E1', 'Birthday');
        $sheet->setCellValue('F1', 'Service Acquired');
        $sheet->setCellValue('G1', 'Date of Transaction');
     


        $rowCount = 2;
        foreach($query_run as $data)
        {
            $lastName = $data['LName']; 
            $firstName = $data['FName']; 
            $middleName = $data['MName']; 
            $sheet->setCellValue('A'.$rowCount, $lastName . ' ' . $firstName . ' ' . $middleName);
            $sheet->setCellValue('B'.$rowCount, $data['Barangay']);
            $sheet->setCellValue('C'.$rowCount, $data['contact_num']);
            $sheet->setCellValue('D'.$rowCount, $data['Age']);
            $sheet->setCellValue('E'.$rowCount, $data['birthdate']);
            $sheet->setCellValue('F'.$rowCount, $data['Service']);
            $sheet->setCellValue('G'.$rowCount, $data['Appointment_date']);
          
            $rowCount++;
        }
        $sheet->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12);
        $sheet->setAutoFilter('A1:G1'); 
        
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
                'size' => 12,
            ],
        ];
        
        $sheet->getStyle('A1:G1')->applyFromArray($style);      
          $sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet->getStyle('A1:G1')->getFill()->setRotation(0);
        $sheet->getStyle('A1:G1')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet->getStyle('A1:G1')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
        foreach (range('A', 'G') as $column) {
            $sheet->getRowDimension($sheet->getCell($column . '1')->getRow())->setRowHeight(30);
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
        header('Location: ../../files/Rejected.php');
        exit(0);
    }
}

?>