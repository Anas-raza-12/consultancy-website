<?php
require 'vendor/autoload.php'; // Adjust path if necessary
require 'include/db_conn.php';

// Create a new Spreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Fetch data from database
$applicants_sql = "SELECT id, name, email, phone, age, applied_date FROM job_form_details ORDER BY applied_date DESC";
$applicants_result = $conn->query($applicants_sql);

// Add header row
$sheet->setCellValue('A1', 'S.No');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Phone');
$sheet->setCellValue('E1', 'Age');
$sheet->setCellValue('F1', 'Applied Date');

if ($applicants_result->num_rows > 0) {
    $row_number = 2; // Start at row 2 to leave space for headers
    $s_no = 1;
    while ($row = $applicants_result->fetch_assoc()) {
        $formatted_date = (new DateTime($row['applied_date']))->format('d-m-Y');
        $sheet->setCellValue('A' . $row_number, $s_no++);
        $sheet->setCellValue('B' . $row_number, htmlspecialchars($row['name']));
        $sheet->setCellValue('C' . $row_number, htmlspecialchars($row['email']));
        $sheet->setCellValue('D' . $row_number, htmlspecialchars($row['phone']));
        $sheet->setCellValue('E' . $row_number, htmlspecialchars($row['age']));
        $sheet->setCellValue('F' . $row_number, htmlspecialchars($formatted_date));
        $row_number++;
    }
}

// Set headers to force download of Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="job_seekers.xlsx"');
header('Cache-Control: max-age=0');

// Write the file to the output
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

// Close the connection
$conn->close();
exit();
?>
