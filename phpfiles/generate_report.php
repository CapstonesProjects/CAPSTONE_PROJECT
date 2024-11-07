<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;


include('../config/db_connection.php');


$schoolYear = isset($_GET['schoolYear']) ? $_GET['schoolYear'] : '';


$minorOffenses = [
    "Noncompliance of Academic Requirements - Attendance (exceeded allowable absences)",
    "Noncompliance of Academic Requirements - Habitual tardiness",
    "Noncompliance of Academic Requirements - Truancy or cutting classes",
    "Attitude inside the Classroom - Classroom mischief, failure to turn off or put on silent the mobile phone",
    "Attitude inside the Classroom - Disturbing other classes/activities through excessive noise",
    "Attitude inside the Classroom - Littering",
    "Behavior in Campus - Engaging in bullying",
    "Behavior in Campus - Not wearing the prescribed uniform",
    "Behavior in Campus - Violation on ID - Improper wearing of ID",
    "Behavior in Campus - Violation on ID - Tampering with ID",
    "Behavior in Campus - Violation on ID - Wearing someone else's ID",
    "Behavior in Campus - Violation on ID - Lending one's ID",
    "Behavior in Campus - With a cap/hat inside the classroom or school premises",
    "Behavior in Campus - Exposed tattoos",
    "Behavior in Campus - Piercings other than the ear lobes",
    "Behavior in Campus - Unauthorized use or charging of electric devices or gadgets",
    "Behavior in Campus - Students disrupting classes, school/institutional activities",
    "Behavior in Campus - Posting/Publishing unauthorized announcements",
    "Behavior in Campus - Inflicting harm physically, mentally, and emotionally on other person",
    "Behavior in Campus - Unauthorized use of LOA premises or facilities",
    "Behavior in Campus - Spitting on floors/walls",
    "Behavior in Campus - Littering",
    "Behavior in Campus - Loitering or staying in restricted areas"
];


$majorOffenses = [
    "Violation with Legal Implications - Possession, use, or sale of illegal drugs (RA 9165) inside the school premises and entering the school while intoxicated",
    "Violation with Legal Implications - Possession, use, or sale of cigarettes (RA 9211) / e-cigarettes (Vape). Possession of alcoholic beverages or reporting inside the campus while intoxicated",
    "Violation with Legal Implications - Smoking within the school premises or approved off-campus activities (100 meters from perimeter to any point, RA 9211)",
    "Violation with Legal Implications - Possession/carrying or use of firearms, explosives, knives, or weapons that can cause harm (Presidential Decree No. 1866)",
    "Violation with Legal Implications - Use of the Internet or social media to malign fellow students or persons in authority (Cyberbullying, RA 10175)",
    "Violation with Legal Implications - Violation of RA 7877 (Anti-sexual Harassment)",
    "Violation with Legal Implications - Violation of RA 9995 (Anti-Photo and Video Voyeurism Act of 2009)",
    "Violation with Legal Implications - Violation of Article 364 of the Revised Penal Code (Intriguing against honor)",
    "Violation with Legal Implications - Violation of Article 172 of the Revised Penal Code (Falsification of Documents)",
    "Violation with Legal Implications - Violation of RA 10627 (Anti-Bullying Act)",
    "Violation with Legal Implications - Violation of the Criminal Code of the Philippines (Threatening, assaulting, or challenging others)",
    "Violation with Legal Implications - Violation of RA 8049 (Anti-Hazing Act)",


    "Indecency in Campus - Explicit sexual exposure using devices or social media (pornographic material)",
    "Indecency in Campus - Public display of affection (PDA) or immoral acts such as petting and necking",
    "Indecency in Campus - Affiliation with fraternities, sororities, gangs, or unauthorized organizations",
    "Indecency in Campus - Gambling in any form within the school premises",
    "Indecency in Campus - Vandalism or marking on walls, chairs, tables, or any school property",
    "Indecency in Campus - Distribution of provocative materials (e.g., pornographic or subversive)",


    "Misconduct in Lyceum Campus - Instigating or leading protests resulting in class disruption",
    "Misconduct in Lyceum Campus - Cheating, copying, or allowing copying of exams, projects, or papers",
    "Misconduct in Lyceum Campus - Preempting and disseminating confidential information (e.g., grades or awards)",
    "Misconduct in Lyceum Campus - Disregarding school rules, such as speeding or not following parking procedures",
    "Misconduct in Lyceum Campus - Soliciting money or donations without prior approval",
    "Misconduct in Lyceum Campus - Use of profane or obscene language; disrespectful language",
    "Misconduct in Lyceum Campus - False accusation against the Administration or staff through conspiracy or other means",


    "Violation by Representative - Misbehavior of representatives such as parents or guardians (e.g., raising voice, taunting, or carrying weapons)",
    "Violation by Representative - Sending threatening or harassing messages to LOA employees",
    "Violation by Representative - Physically abusive behavior toward LOA personnel or students",
    "Violation by Representative - Causing damage to LOA properties or moral harm to staff or institution image"
];


$escapedMinorOffenses = array_map(function($offense) use ($conn) {
    return mysqli_real_escape_string($conn, $offense);
}, $minorOffenses);

$escapedMajorOffenses = array_map(function($offense) use ($conn) {
    return mysqli_real_escape_string($conn, $offense);
}, $majorOffenses);


$sql = "SELECT Offense, COUNT(*) as count 
        FROM tblcases 
        WHERE SchoolYear = '$schoolYear' 
        AND CaseResolution IS NOT NULL
        AND (Offense IN ('" . implode("','", $escapedMinorOffenses) . "') 
        OR Offense IN ('" . implode("','", $escapedMajorOffenses) . "')) 
        GROUP BY Offense";
$result = $conn->query($sql);


$offenseCounts = array_fill_keys(array_merge($minorOffenses, $majorOffenses), 0);

while ($data = $result->fetch_assoc()) {
    $offenseCounts[$data['Offense']] = $data['count'];
}


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$sheet->setCellValue('A1', 'School Year: ' . $schoolYear);
$sheet->mergeCells('A1:C1');


$sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


$sheet->setCellValue('A2', 'Minor Offenses');
$sheet->mergeCells('A2:C2');
$sheet->setCellValue('A3', 'Offense');
$sheet->setCellValue('B3', 'Category');
$sheet->setCellValue('C3', 'Count');


$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['argb' => Color::COLOR_WHITE],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['argb' => Color::COLOR_DARKBLUE],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => Color::COLOR_BLACK],
        ],
    ],
];
$sheet->getStyle('A1:C3')->applyFromArray($headerStyle);


$row = 4;
$minorTotal = 0;
foreach ($minorOffenses as $offense) {
    $count = $offenseCounts[$offense];
    $sheet->setCellValue('A' . $row, $offense);
    $sheet->setCellValue('B' . $row, 'Minor');
    $sheet->setCellValue('C' . $row, $count);
    $minorTotal += $count;
    $row++;
}


$sheet->setCellValue('A' . $row, 'Total Minor Offenses');
$sheet->setCellValue('C' . $row, $minorTotal);
$sheet->getStyle('A' . $row . ':C' . $row)->applyFromArray($headerStyle);


$row += 2; 
$sheet->setCellValue('A' . $row, 'Major Offenses');
$sheet->mergeCells('A' . $row . ':C' . $row);
$row++;
$sheet->setCellValue('A' . $row, 'Offense');
$sheet->setCellValue('B' . $row, 'Category');
$sheet->setCellValue('C' . $row, 'Count');
$sheet->getStyle('A' . ($row - 1) . ':C' . $row)->applyFromArray($headerStyle);


$row++;
$majorTotal = 0;
foreach ($majorOffenses as $offense) {
    $count = $offenseCounts[$offense];
    $sheet->setCellValue('A' . $row, $offense);
    $sheet->setCellValue('B' . $row, 'Major');
    $sheet->setCellValue('C' . $row, $count);
    $majorTotal += $count;
    $row++;
}


$sheet->setCellValue('A' . $row, 'Total Major Offenses');
$sheet->setCellValue('C' . $row, $majorTotal);
$sheet->getStyle('A' . $row . ':C' . $row)->applyFromArray($headerStyle);


$dataStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => Color::COLOR_BLACK],
        ],
    ],
];
$sheet->getStyle('A4:C' . ($row - 1))->applyFromArray($dataStyle);

// Auto-fit columns
foreach (range('A', 'C') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Set the header for the response
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="CasesReport_' . $schoolYear . '.xlsx"');
header('Cache-Control: max-age=0');

// Write the spreadsheet to the output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

// Close the database connection
$conn->close();
?>