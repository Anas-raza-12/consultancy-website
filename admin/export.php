<?php
require 'vendor/autoload.php'; // Adjust path if necessary
require 'include/db_conn.php';

// Create a new Spreadsheet object
$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Fetch data from database
$applicants_sql = "SELECT id, first_name, last_name, email, phone, age, gender, cover_letter, location, expected_salary, current_salary, skills, education, certification, language, experience, socialLink, linkedIn, applied_date FROM job_form_data ORDER BY applied_date DESC";
$applicants_result = $conn->query($applicants_sql);

// Add header row
$sheet->setCellValue('A1', 'S.No');
$sheet->setCellValue('B1', 'First Name');
$sheet->setCellValue('C1', 'Last Name');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Phone');
$sheet->setCellValue('F1', 'Age');
$sheet->setCellValue('G1', 'Gender');
$sheet->setCellValue('H1', 'Cover Letter');
$sheet->setCellValue('I1', 'Location');
$sheet->setCellValue('J1', 'Expected Salary');
$sheet->setCellValue('K1', 'Current Salary');
$sheet->setCellValue('L1', 'Skills');
$sheet->setCellValue('M1', 'Education');
$sheet->setCellValue('N1', 'Certification');
$sheet->setCellValue('O1', 'Language');
$sheet->setCellValue('P1', 'Experience');
$sheet->setCellValue('Q1', 'Socail Link');
$sheet->setCellValue('R1', 'LinkedIn');
$sheet->setCellValue('S1', 'Applied Date');


if ($applicants_result->num_rows > 0) {
    $row_number = 2; // Start at row 2 to leave space for headers
    $s_no = 1;
    while ($row = $applicants_result->fetch_assoc()) {
        $formatted_date = (new DateTime($row['applied_date']))->format('d-m-Y');
        $sheet->setCellValue('A' . $row_number, $s_no++);
        $sheet->setCellValue('B' . $row_number, htmlspecialchars($row['first_name']));
        $sheet->setCellValue('C' . $row_number, htmlspecialchars($row['last_name']));
        $sheet->setCellValue('D' . $row_number, htmlspecialchars($row['email']));
        $sheet->setCellValue('E' . $row_number, htmlspecialchars($row['phone']));
        $sheet->setCellValue('F' . $row_number, htmlspecialchars($row['age']));
        $sheet->setCellValue('G' . $row_number, htmlspecialchars($row['gender']));
        $sheet->setCellValue('H' . $row_number, htmlspecialchars($row['cover_letter']));
        $sheet->setCellValue('I' . $row_number, htmlspecialchars($row['location']));
        $sheet->setCellValue('J' . $row_number, htmlspecialchars($row['expected_salary']));
        $sheet->setCellValue('K' . $row_number, htmlspecialchars($row['current_salary']));
        $sheet->setCellValue('L' . $row_number, htmlspecialchars($row['skills']));
        $sheet->setCellValue('M' . $row_number, htmlspecialchars($row['education']));
        $sheet->setCellValue('N' . $row_number, htmlspecialchars($row['certification']));
        $sheet->setCellValue('O' . $row_number, htmlspecialchars($row['language']));
        $sheet->setCellValue('P' . $row_number, htmlspecialchars($row['experience']));
        $sheet->setCellValue('Q' . $row_number, htmlspecialchars($row['socialLink']));
        $sheet->setCellValue('R' . $row_number, htmlspecialchars($row['linkedIn']));
        $sheet->setCellValue('S' . $row_number, htmlspecialchars($formatted_date));
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
