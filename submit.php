<?php
require 'vendor/autoload.php'; 

$servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'comuter';
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // phase 1 
    $firstName = $_POST['firstName'] ?? '';
    $occupation = $_POST['occupation'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $residentialArea = $_POST['residentialArea'] ?? '';
    $workArea = $_POST['workArea'] ?? '';
    $licenseExpiration = $_POST['licenseExpiration'] ?? '';
    $serviceStartDate = $_POST['serviceStartDate'] ?? '';

    // phase 2 
    $carBrand = $_POST['carBrand'] ?? '';
    $carModel = $_POST['carModel'] ?? '';
    $carYear = $_POST['carYear'] ?? '';
    $carKilometers = $_POST['carKilometers'] ?? '';
    $carCondition = $_POST['carCondition'] ?? '';
    $carAc = $_POST['carAc'] ?? '';
    $carFuelType = $_POST['carFuelType'] ?? '';
    $carLicenseExpiration = $_POST['carLicenseExpiration'] ?? '';   
    $dateParts = explode('-', $carLicenseExpiration);
    $year = $dateParts[0];
    $month = $dateParts[1];
    $day = 1; // Assuming you want to set the day to 1st of the selected month
    // Create a valid date format (YYYY-MM-DD)
    $validDate = "$year-$month-$day";

    //phase 3
    $daysInMonth = $_POST['daysInMonth'] ?? '';
    $startZone = $_POST['startZone'] ?? '';
    $endZone = $_POST['endZone'] ?? '';
    $departureTime = $_POST['departureTime'] ?? '';
    $returnTime = $_POST['returnTime'] ?? '';

    //phase 4
    $passengerCount = $_POST['passengerCount'] ?? '';
    $passengerType = $_POST['passengerType'] ?? '';
    $passengerAge = $_POST['passengerAge'] ?? '';
    $tripType = $_POST['tripType'] ?? '';

    //phase 5 
    // Get values from the select elements
    $calculationMethod = $_POST['calculationMethod'] ?? '';
    $paymentMethod = $_POST['paymentMethod'] ?? '';
    $paymentSchedule = $_POST['paymentSchedule'] ?? '';

    // phase 6: Inquiries
    $carInquiries = $_POST['carInquiries'] ?? '';
    $tripInquiries = $_POST['tripInquiries'] ?? '';
    $passengersInquiries1 = $_POST['passengersInquiries1'] ?? '';
    $paymentInquiries = $_POST['paymentInquiries'] ?? '';
    $otherInquiries = $_POST['otherInquiries'] ?? '';

    
    // Insert data into the database
    $sql = "INSERT INTO userTrue (first_name, occupation, phone, whatsapp, residential_area, work_area, license_expiration, service_start_date,
            car_brand, car_model, car_year, car_kilometers, car_condition, car_ac, car_fuel_type, car_license_expiration,
            daysInMonth, startZone, endZone, departureTime, returnTime,
            passengerCount, passengerType, passengerAge, tripType,
            calculation_method, payment_method, payment_schedule,
            car_inquiries, trip_inquiries, passengers_inquiries_1, payment_inquiries, other_inquiries)
            VALUES ('$firstName', '$occupation', '$phone', '$whatsapp', '$residentialArea', '$workArea', '$licenseExpiration', '$serviceStartDate',
            '$carBrand', '$carModel', '$carYear', '$carKilometers', '$carCondition', '$carAc', '$carFuelType', '$validDate',
            '$daysInMonth', '$startZone', '$endZone', '$departureTime', '$returnTime',
            '$passengerCount', '$passengerType', '$passengerAge', '$tripType',
            '$calculationMethod', '$paymentMethod', '$paymentSchedule',
            '$carInquiries', '$tripInquiries', '$passengersInquiries1', '$paymentInquiries', '$otherInquiries')";



        // Execute the query
    if ($conn->query($sql) === TRUE) {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $headers = [
    'id',
    'الاسم الأول',
    'المهنة العامة',
    'تليفون',
    'واتس',
    'منطقة السكن',
    'منطقة العمل',
    'رخصة القيادة سارية حتى سنة',
    'تاريخ الاستعداد لبدء تقديم الخدمة',
    'الماركة العامة',
    'الماركة التفصيلية',
    'الموديل (سنة الصنع)',
    'عداد الكيلومتر',
    'الحالة العامة للسيارة',
    'حالة التكييف',
    'نوع الوقود',
    'رخصة السيارة سارية حتى شهر/سنة',
    'عدد أيام التكرار في الشهر',
    'منطقة بداية رحلة الذهاب',
    'منطقة نهاية رحلة الذهاب',
    'موعد نهاية رحلة الذهاب',
    'موعد بداية رحلة العودة',
    'عدد الركاب',
    'نوع الركاب',
    'سن الراكب',
    'نوع الدورة',
    'مقابل الخدمة',
    'طريقة الدفع (في حالة المقابل المادي المباشر)',
    'الدفعات (في حالة المقابل المادي المباشر)',
    'استفسارات متعلقة بالسيارة',
    'استفسارات متعلقة بالرحلة المنتظمة',
    'استفسارات متعلقة بالركاب الممكن توصيلهم',
    'استفسارات متعلقة بطريقة الحساب والدفع',
    'استفسارات أخرى'
];

        
        $sheet->fromArray($headers, null, 'A1');
        // Fetch data from the database (modify the SQL query if needed)
        $dataQuery = "SELECT * FROM userTrue";
        $dataResult = $conn->query($dataQuery);

        // Add data to the Excel file
        $rowIndex = 2;
        while ($row = $dataResult->fetch_assoc()) {
            $colIndex = 1;
            foreach ($row as $value) {
                $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $value);
                $colIndex++;
            }
            $rowIndex++;
        }

        // Save the Excel file
        $excelFileName = 'exported_data.xlsx';
        $excelFilePath = __DIR__ . '/' . $excelFileName;
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($excelFilePath);
    header("Location: thank_you.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

}







