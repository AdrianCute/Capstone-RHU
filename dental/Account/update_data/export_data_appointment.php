<?php
include "config.php";

require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['exportdata']))
{
    $fileName = "Pending Appointment List";
    $file_ext_name = 'xlsx';
    $from = $_POST['from'];
    $to = $_POST['to'];

    $sql = "SELECT a.*, age.*, pi.*, ai.*
    FROM appointment a INNER JOIN age_table age ON a.Record_ID = age.Record_ID
    INNER JOIN personal_information pi ON pi.Record_ID = a.Record_ID
    INNER JOIN address_information ai ON ai.Record_ID = a.Record_ID

    WHERE Status ='Pending' AND Date BETWEEN ' $from' AND '$to';
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
        $sheet->setCellValue('F1', 'Date send of Appointment');
        $sheet->setCellValue('G1', 'Service Acquired');




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
            $sheet->setCellValue('G'.$rowCount, $data['Date']);     

            $rowCount++;
        }
        $sheet->getStyle('A1:G1')->getFont()->setBold(true)->setSize(12);
        $sheet->setAutoFilter('A1:G1'); 
        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
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
}

?>