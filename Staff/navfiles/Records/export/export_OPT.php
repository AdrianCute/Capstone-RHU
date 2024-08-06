<?php
include "../Add Record/config.php";

require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if(isset($_POST['exportdata']))
{
    $fileName = "Operation Timbang Record";
    $file_ext_name = 'xlsx';
    $from = $_POST['from'];
    $to = $_POST['to'];

   
    $sql ="SELECT p.*, pi.*, age.*, ta.*
    FROM operation_timbang p
    LEFT JOIN personal_information pi ON p.Record_ID = pi.Record_ID
    LEFT JOIN age_table age ON pi.Record_ID = age.Record_ID
LEFT JOIN address_information ta ON pi.Record_ID = ta.Record_ID
    WHERE p.Date_input BETWEEN '$from' AND '$to'
    ";
    $query_run = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query_run) > 0)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Address');
        $sheet->setCellValue('B1', 'Mothers Name');
        $sheet->setCellValue('C1', 'Childs Name');
        $sheet->setCellValue('D1', 'Belongs to IP (Specify)');
        $sheet->setCellValue('E1', 'Sex');
        $sheet->setCellValue('F1', 'Birthdate');
        $sheet->setCellValue('G1', 'Date Measured');
        $sheet->setCellValue('H1', 'Weight');
        $sheet->setCellValue('I1', 'Height');
        $sheet->setCellValue('J1', 'Age in Months');
        $sheet->setCellValue('K1', 'Weight for Age Status');
        $sheet->setCellValue('L1', 'Heightfor Age Status');
        $sheet->setCellValue('M1', 'Weight for LT/HT status');


        $rowCount = 2;
        foreach($query_run as $data)
        {
            
            $lastName = $data['LName']; // Assuming 'LName' is a key in your $data array
            $firstName = $data['FName']; // Assuming 'FName' is a key in your $data array
            $middleName = $data['MName']; 
            $zone = $data['zone'];
            $Barangay = $data['Barangay'];
$Municipality = $data ['Municipality'];
$Province = $data ['Province'];
            $sheet->setCellValue('A'.$rowCount, $zone.' '.$Barangay .' '.$Municipality.''.$Province);
            $sheet->setCellValue('B'.$rowCount, $data['MothersName']);
            $sheet->setCellValue('C'.$rowCount, $lastName . ' ' . $firstName . ' ' . $middleName);
            $sheet->setCellValue('D'.$rowCount, $data['IP']);
            $sheet->setCellValue('E'.$rowCount, $data['sex']);
            $sheet->setCellValue('F'.$rowCount, $data['birthdate']);    
            $sheet->setCellValue('G'.$rowCount, $data['DateMeasured']);
            $sheet->setCellValue('H'.$rowCount, $data['Weight']);
            $sheet->setCellValue('I'.$rowCount, $data['Height']); 
            $sheet->setCellValue('J'.$rowCount, $data['Age__months']);
            $sheet->setCellValue('K'.$rowCount, $data['Weight_in_Age_stat']);
            $sheet->setCellValue('L'.$rowCount, $data['Height_in_Age_stat']);
            $sheet->setCellValue('M'.$rowCount, $data['Weight_in_LTandHt_stat']);
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
        

        $sheet->getStyle('A1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR);
        $sheet->getStyle('A1:M1')->getFill()->setRotation(0);
        $sheet->getStyle('A1:M1')->getFill()->setStartColor($goldAccent4Lighter60['startcolor']);
        $sheet->getStyle('A1:M1')->getFill()->setEndColor($goldAccent4Lighter60['endcolor']);
        $sheet->getStyle('A1:M1')->getFont()->setBold(true)->setSize(12);
        $sheet->setAutoFilter('A1:M1'); 
        foreach (range('A', 'M') as $column) {
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