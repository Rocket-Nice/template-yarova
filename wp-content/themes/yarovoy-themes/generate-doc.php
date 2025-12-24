<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
// use CloudConvert\CloudConvert;
// use CloudConvert\Models\Job;
// use CloudConvert\Models\Task;
use Ilovepdf\Ilovepdf;

// Данные по дате и контракту
$contract_date = $_POST['contract_date'];
$contract_place = $_POST['contract_place'];

// Данные покупателя
$buyer_full_name = $_POST['buyer_full_name'];
$buyer_birth_date = $_POST['buyer_birth_date'];
$buyer_registration_address = $_POST['buyer_registration_address'];
$buyer_passport_details = explode(' ', $_POST['buyer_passport_details']);
$buyer_passport_issue_date = $_POST['buyer_passport_issue_date'];
$buyer_passport_issued_by = $_POST['buyer_passport_issued_by'];

// Данные представителя покупателя
$buyer_proxy_registry_number = $_POST['buyer_proxy_registry_number'];
$buyer_proxy_full_name = $_POST['buyer_proxy_full_name'];
$buyer_proxy_birth_date = $_POST['buyer_proxy_birth_date'];
$buyer_proxy_passport_details = explode(' ', $_POST['buyer_proxy_passport_details']);
$buyer_proxy_passport_issue_date = $_POST['buyer_proxy_passport_issue_date'];
$buyer_proxy_passport_issued_by = $_POST['buyer_proxy_passport_issued_by'];
$buyer_proxy_registration_address = $_POST['buyer_proxy_registration_address'];

// Данные продавца
$seller_full_name = $_POST['seller_full_name'];
$seller_birth_date = $_POST['seller_birth_date'];
$seller_registration_address = $_POST['seller_registration_address'];
$seller_passport_details = explode(' ', $_POST['seller_passport_details']);
$seller_passport_issue_date = $_POST['seller_passport_issue_date'];
$seller_passport_issued_by = $_POST['seller_passport_issued_by'];

// Данные представителя продавца
$seller_proxy_registry_number = $_POST['seller_proxy_registry_number'];
$seller_proxy_full_name = $_POST['seller_proxy_full_name'];
$seller_proxy_birth_date = $_POST['seller_proxy_birth_date'];
$seller_proxy_passport_details = explode(' ', $_POST['seller_proxy_passport_details']);
$seller_proxy_passport_issue_date = $_POST['seller_proxy_passport_issue_date'];
$seller_proxy_passport_issued_by = $_POST['seller_proxy_passport_issued_by'];
$seller_proxy_registration_address = $_POST['seller_proxy_registration_address'];

// Данные транспортного средства
$vehicle_vin = $_POST['vehicle_vin'];
$vehicle_brand_model = $_POST['vehicle_brand_model'];
$vehicle_type = $_POST['vehicle_type'];
$vehicle_category = $_POST['vehicle_category'];
$vehicle_year = $_POST['vehicle_year'];
$vehicle_engine_model = explode(' ', $_POST['vehicle_engine_model']);
$vehicle_chassis_number = $_POST['vehicle_chassis_number'];
$vehicle_body_number = $_POST['vehicle_body_number'];
$vehicle_color = $_POST['vehicle_color'];
$vehicle_engine_power = $_POST['vehicle_engine_power'];
$vehicle_engine_volume = $_POST['vehicle_engine_volume'];
$vehicle_pts_series_number = isset($_POST['epts'])
    ? $_POST['vehicle_pts_series_number']
    : (isset($_POST['vehicle_pts_series_number']) ? explode(' ', $_POST['vehicle_pts_series_number']) : '');
$vehicle_pts_issued_by = $_POST['vehicle_pts_issued_by'];
$vehicle_pts_issue_date = $_POST['vehicle_pts_issue_date'];
$vehicle_sts_series_number = $_POST['vehicle_sts_series_number'];
$vehicle_sts_issued_by = $_POST['vehicle_sts_issued_by'];
$vehicle_sts_issue_date = $_POST['vehicle_sts_issue_date'];
$vehicle_license_plate = $_POST['vehicle_license_plate'];
$vehicle_price = $_POST['vehicle_price'];
$vehicle_mileage = $_POST['vehicle_mileage'];

// Тут определение нужного шаблона от чекбокса зависит
$templatePath = __DIR__ . '/blank-bez.docx';
if (isset($_POST['agree_seller']) || isset($_POST['agree_buyer'])) {
    $templatePath = __DIR__ . '/blank-s.docx';
}

$templateProcessor = new TemplateProcessor($templatePath);

// Заполнение отсюда
$templateProcessor->setValue('{дс}', htmlspecialchars($contract_date));
$templateProcessor->setValue('{мс}', htmlspecialchars($contract_place));

// Данные покупателя
$templateProcessor->setValue('{фп}', htmlspecialchars($buyer_full_name));
$templateProcessor->setValue('{дрп}', htmlspecialchars($buyer_birth_date));
$templateProcessor->setValue('{агп}', htmlspecialchars($buyer_registration_address));
$templateProcessor->setValue('{сп}', htmlspecialchars($buyer_passport_details[0]));
$templateProcessor->setValue('{нппо}', htmlspecialchars($buyer_passport_details[1]));
$templateProcessor->setValue('{ДВПП}', htmlspecialchars($buyer_passport_issue_date));
$templateProcessor->setValue('{квпп}', htmlspecialchars($buyer_passport_issued_by));

// Данные представителя покупателя
if (!empty($buyer_proxy_full_name) && isset($_POST['agree_buyer'])) {
    $templateProcessor->setValue(
        '{Р_Н_ПО}',
        !empty($buyer_proxy_registry_number) ? "Представитель покупателя по доверенности, реестровый номер: " . htmlspecialchars($buyer_proxy_registry_number) : ''
    );

    $templateProcessor->setValue(
        '{фппо}',
        !empty($buyer_proxy_full_name) ? ", \nгр. " . htmlspecialchars($buyer_proxy_full_name) : ''
    );

    $templateProcessor->setValue(
        '{дрпо}',
        !empty($buyer_proxy_birth_date) ? ", дата рождения: " . htmlspecialchars($buyer_proxy_birth_date) : ''
    );

    $templateProcessor->setValue(
        '{агппо}',
        !empty($buyer_proxy_registration_address) ? ", зарегистрированный(ая) по адресу: " . htmlspecialchars($buyer_proxy_registration_address) : ''
    );

    $templateProcessor->setValue(
        '{сппо}',
        !empty($buyer_proxy_passport_details[0]) ? ", паспорт: " . htmlspecialchars($buyer_proxy_passport_details[0]) : ''
    );

    $templateProcessor->setValue(
        '{нппок}',
        !empty($buyer_proxy_passport_details[1]) ? " " . htmlspecialchars($buyer_proxy_passport_details[1]) : ''
    );

    $templateProcessor->setValue(
        '{ДВППО}',
        !empty($buyer_proxy_passport_issue_date) ? ", выдан: " . htmlspecialchars($buyer_proxy_passport_issue_date) . " г." : ''
    );

    $templateProcessor->setValue(
        '{квппо}',
        !empty($buyer_proxy_passport_issued_by) ? ", " . htmlspecialchars($buyer_proxy_passport_issued_by) : ''
    );
} else {
    $templateProcessor->setValue('{Р_Н_ПО}', '');
    $templateProcessor->setValue('{фппо}', '');
    $templateProcessor->setValue('{дрпо}', '');
    $templateProcessor->setValue('{агппо}', '');
    $templateProcessor->setValue('{сппо}', '');
    $templateProcessor->setValue('{нппок}', '');
    $templateProcessor->setValue('{ДВППО}', '');
    $templateProcessor->setValue('{квппо}', '');
}

// Данные продавца
$templateProcessor->setValue('{ФИО_ПРОДАВЕЦ}', htmlspecialchars($seller_full_name));
$templateProcessor->setValue('{дрпр}', htmlspecialchars($seller_birth_date));
$templateProcessor->setValue('{арпро}', htmlspecialchars($seller_registration_address));
$templateProcessor->setValue('{серия_продавец}', htmlspecialchars($seller_passport_details[0]));
$templateProcessor->setValue('{номер_продавец}', htmlspecialchars($seller_passport_details[1]));
$templateProcessor->setValue('{двппр}', htmlspecialchars($seller_passport_issue_date));
$templateProcessor->setValue('{квппро}', htmlspecialchars($seller_passport_issued_by));

// Данные представителя продавца
if (!empty($seller_proxy_registry_number) && isset($_POST['agree_seller'])) {
    $templateProcessor->setValue(
        '{Р_Н_ПР}',
        !empty($seller_proxy_registry_number) ? "Представитель продавца по доверенности, реестровый номер: " . htmlspecialchars($seller_proxy_registry_number) : ''
    );

    $templateProcessor->setValue(
        '{ФИО_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}',
        !empty($seller_proxy_full_name) ? ", \nгр. " . htmlspecialchars($seller_proxy_full_name) : ''
    );

    $templateProcessor->setValue(
        '{ДАТА_РОЖДЕНИЯ_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}',
        !empty($seller_proxy_birth_date) ? ", дата рождения: " . htmlspecialchars($seller_proxy_birth_date) : ''
    );

    $templateProcessor->setValue(
        '{АДРЕС_РЕГИСТРАЦИИ_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}',
        !empty($seller_proxy_registration_address) ? ", зарегистрированный(ая) по адресу: " . htmlspecialchars($seller_proxy_registration_address) : ''
    );

    $templateProcessor->setValue(
        '{сппр}',
        !empty($seller_proxy_passport_details[0]) ? ", паспорт: " . htmlspecialchars($seller_proxy_passport_details[0]) : ''
    );

    $templateProcessor->setValue(
        '{нппр}',
        !empty($seller_proxy_passport_details[1]) ? " " . htmlspecialchars($seller_proxy_passport_details[1]) : ''
    );

    $templateProcessor->setValue(
        '{КЕМ_ВЫДАН_ПАСПОРТ_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}',
        !empty($seller_proxy_passport_issue_date) ? ", выдан: " . htmlspecialchars($seller_proxy_passport_issue_date) . " г." : ''
    );

    $templateProcessor->setValue(
        '{двппп}',
        !empty($seller_proxy_passport_issued_by) ? ", " . htmlspecialchars($seller_proxy_passport_issued_by) : ''
    );
} else {
    $templateProcessor->setValue('{Р_Н_ПР}', '');
    $templateProcessor->setValue('{ФИО_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}', '');
    $templateProcessor->setValue('{ДАТА_РОЖДЕНИЯ_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}', '');
    $templateProcessor->setValue('{АДРЕС_РЕГИСТРАЦИИ_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}', '');
    $templateProcessor->setValue('{сппр}', '');
    $templateProcessor->setValue('{нппр}', '');
    $templateProcessor->setValue('{КЕМ_ВЫДАН_ПАСПОРТ_ПРЕДСТАВИТЕЛЬ_ПРОДАВЕЦ}', '');
    $templateProcessor->setValue('{двппп}', '');
}

// Данные транспортного средства
$templateProcessor->setValue('{VIN}', htmlspecialchars($vehicle_vin));
$templateProcessor->setValue('{МАРКА_МОДЕЛЬ}', htmlspecialchars($vehicle_brand_model));
$templateProcessor->setValue('{ТИП_ТС}', htmlspecialchars($vehicle_type));
$templateProcessor->setValue('{КАТЕГОРИЯ_ТС}', htmlspecialchars($vehicle_category));
$templateProcessor->setValue('{ГОД_ВЫПУСКА}', htmlspecialchars($vehicle_year));
$templateProcessor->setValue('{МОДЕЛЬ_ДВИГАТЕЛЯ}', htmlspecialchars($vehicle_engine_model[0]) . ' / ' . htmlspecialchars($vehicle_engine_model[1]));
$templateProcessor->setValue('{НОМЕР_ШАССИ}', htmlspecialchars($vehicle_chassis_number));
$templateProcessor->setValue('{НОМЕР_КУЗОВА}', htmlspecialchars($vehicle_body_number));
$templateProcessor->setValue('{ЦВЕТ}', htmlspecialchars($vehicle_color));
$templateProcessor->setValue('{МОЩНОСТЬ_ДВИГАТЕЛЯ}', htmlspecialchars($vehicle_engine_power));
$templateProcessor->setValue('{ОБЪЕМ_ДВИГАТЕЛЯ}', htmlspecialchars($vehicle_engine_volume));
if (!isset($_POST['epts'])) {
    $pts_parts = array_map('htmlspecialchars', $vehicle_pts_series_number);
    $pts_combined = implode(' ', $pts_parts);
    $templateProcessor->setValue('{ПТС_СЕРИЯ}', $pts_combined);
} else {
    $templateProcessor->setValue('{ПТС_СЕРИЯ}', htmlspecialchars($vehicle_pts_series_number));
}

$templateProcessor->setValue('{ПТС_КЕМ_ВЫДАН}', htmlspecialchars($vehicle_pts_issued_by));
$templateProcessor->setValue('{ПТС_ДАТА_ВЫДАЧИ}', htmlspecialchars($vehicle_pts_issue_date));

if (isset($_POST['epts'])) {
    $templateProcessor->setValue('{эптс}', 'электронный');
} else {
    $templateProcessor->setValue('{эптс}', '');
}

$sts_issued_by_text = '';
if (preg_match('/^\d{6}$/', $vehicle_sts_issued_by)) {
    $sts_issued_by_text = "Код подразделения: " . htmlspecialchars($vehicle_sts_issued_by);
} else {
    $sts_issued_by_text = "Выдано: " . htmlspecialchars($vehicle_sts_issued_by);
}

$templateProcessor->setValue('{СТС_СЕРИЯ_НОМЕР}', htmlspecialchars($vehicle_sts_series_number));
$templateProcessor->setValue('{СТС_КЕМ_ВЫДАН}', $sts_issued_by_text);
$templateProcessor->setValue('{СТС_ДАТА_ВЫДАЧИ}', htmlspecialchars($vehicle_sts_issue_date));
$templateProcessor->setValue('{ГОС_НОМЕР}', htmlspecialchars($vehicle_license_plate));
if (!empty($vehicle_mileage)) {
    $templateProcessor->setValue('{ПРОБЕГ}', htmlspecialchars($vehicle_mileage));
} else {
    $templateProcessor->setValue('{ПРОБЕГ}', '');
}

// Сюда ценник отдельно вынес, т.к много кода
function num2text($number)
{
    $units = array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять');
    $teens = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array('', 'десять', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundreds = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $thousands = array('тысяча', 'тысячи', 'тысяч');
    $millions = array('миллион', 'миллиона', 'миллионов');
    $billions = array('миллиард', 'миллиарда', 'миллиардов');

    if ($number == 0) {
        return 'ноль';
    }

    $result = '';

    if ($number >= 1000000000) {
        $billions_part = intval($number / 1000000000);
        $result .= $hundreds[intval($billions_part / 100)] . ' ';
        $billions_part %= 100;
        if ($billions_part < 10) {
            $result .= $units[$billions_part] . ' ';
        } elseif ($billions_part < 20) {
            $result .= $teens[$billions_part - 10] . ' ';
        } else {
            $result .= $tens[intval($billions_part / 10)] . ' ' . $units[$billions_part % 10] . ' ';
        }
        $result .= getNoun($billions_part, $billions) . ' ';
        $number %= 1000000000;
    }

    if ($number >= 1000000) {
        $millions_part = intval($number / 1000000);
        $result .= $hundreds[intval($millions_part / 100)] . ' ';
        $millions_part %= 100;
        if ($millions_part < 10) {
            $result .= $units[$millions_part] . ' ';
        } elseif ($millions_part < 20) {
            $result .= $teens[$millions_part - 10] . ' ';
        } else {
            $result .= $tens[intval($millions_part / 10)] . ' ' . $units[$millions_part % 10] . ' ';
        }
        $result .= getNoun($millions_part, $millions) . ' ';
        $number %= 1000000;
    }

    if ($number >= 1000) {
        $thousands_part = intval($number / 1000);
        $result .= $hundreds[intval($thousands_part / 100)] . ' ';
        $thousands_part %= 100;
        if ($thousands_part < 10) {
            $result .= $units[$thousands_part] . ' ';
        } elseif ($thousands_part < 20) {
            $result .= $teens[$thousands_part - 10] . ' ';
        } else {
            $result .= $tens[intval($thousands_part / 10)] . ' ' . $units[$thousands_part % 10] . ' ';
        }
        $result .= getNoun($thousands_part, $thousands) . ' ';
        $number %= 1000;
    }

    if ($number > 0) {
        $result .= $hundreds[intval($number / 100)] . ' ';
        $number %= 100;
        if ($number < 10) {
            $result .= $units[$number] . ' ';
        } elseif ($number < 20) {
            $result .= $teens[$number - 10] . ' ';
        } else {
            $result .= $tens[intval($number / 10)] . ' ' . $units[$number % 10] . ' ';
        }
    }

    return trim($result);
}

function getNoun($number, $titles)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

if ($vehicle_price) {
    $formatted_price = number_format($vehicle_price, 0, '', '.');
    $text_price = num2text($vehicle_price);
    $templateProcessor->setValue('{СТОИМОСТЬ}', htmlspecialchars("$formatted_price ($text_price)"));
} else {
    $empty_value = str_repeat("\u{00A0}", 40) . '(' . str_repeat("\u{00A0}", 120) . ')';
    $templateProcessor->setValue('{СТОИМОСТЬ}', $empty_value);
}

$tempDocxPath = __DIR__ . '/ДКП_заполненный.docx';
$templateProcessor->saveAs($tempDocxPath);

$finalPdfPath = __DIR__ . '/ДКП_заполненный.pdf';

// $apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTM5OGRkMDQ3Mjg5MWM1MWIwYTc4ZWE1MTYxN2YxMDUzMGZhNThkOTdlZmQ4ZDRkNjFlOTI1ODUzMzljNzhmOWU2MjYwYWNhMGEzYTQ1NDAiLCJpYXQiOjE3NDI1NjE2ODEuNjUzMjA5LCJuYmYiOjE3NDI1NjE2ODEuNjUzMjEsImV4cCI6NDg5ODIzNTI4MS42NDg3MSwic3ViIjoiNzE0MDM5OTEiLCJzY29wZXMiOlsidXNlci5yZWFkIiwidXNlci53cml0ZSIsInRhc2sucmVhZCIsInRhc2sud3JpdGUiLCJ3ZWJob29rLnJlYWQiLCJ3ZWJob29rLndyaXRlIiwicHJlc2V0LnJlYWQiLCJwcmVzZXQud3JpdGUiXX0.nVLRWf6_pX4sNxfEvkaAfasMDClxbszPzBsPP4BhGM57r7iKnid6P5n42wBxF7Zh24aMa09pgX6rLDq_y4BlXo4yzbuKiOGc1MVtqI61vtuvLgeiFWXmhnm9qjvmSnwh7t85qEZkFROA2aXMulHZqxFtJTvfOO-6Gq3Fn8N8JoY5xeYXgpsCWBF4Xi247_1RfSQiZi1CiAVpz2OF0324RYDvabjXtGpP3zPY7yB6gIs0hnTThgqR-Rp5ufphmalqxsdzks2E-b1SYt6cPdbzQJS8a2RjQu7tTXqGpVWvJH2bwFtiJ635zZniJAZ1w-dZiYjEYkrh_IxsD2y6bxQydzBj786AqrPNqTZHca-ntW_X5s_xTe04M5p_uszHuxeKL9IX-JOFlWyRE2T6Lqxx1Y-n63lpq5-6JMmOqLgxOqi8PvdoaWDszD8kAf2hc9yNoa_2ORqqLKvEvNZ-OdzIMlvjryKAnzF-z5dQ7JRtycnrq2WWCwm5hGDi2GLpLtziF0cZ8P3ZrorZBgdL2YoREAzwGHI33-HMqO0DulwhdEIy7aklFal9I7zZ1g1mGexrLATcwyS9UCuxuB__omKLiR-IAcuYRQQzVKRS_liV2jbTKNWSNkoodT0tNridKIdQv0f_Q12yYkXarAdCgFWOhz9GYK_kiRW4FIfKHhZIaUQ';
// $cloudconvert = new CloudConvert([
//     'api_key' => $apiKey,
//     'sandbox' => false
// ]);

// $job = (new Job())
//     ->addTask(
//         (new Task('import/upload', 'import'))
//     )
//     ->addTask(
//         (new Task('convert', 'convert'))
//             ->set('input', ['import'])
//             ->set('output_format', 'pdf')
//     )
//     ->addTask(
//         (new Task('export/url', 'export'))
//             ->set('input', ['convert'])
//     );

// try {
//     $cloudconvert->jobs()->create($job);
//     $uploadTask = $job->getTasks()->whereName('import')[0];
//     $cloudconvert->tasks()->upload($uploadTask, fopen($tempDocxPath, 'r'), 'ДКП_заполненный.docx');
//     $cloudconvert->jobs()->wait($job);

//     $exportTask = $job->getTasks()->whereName('export')[0];
//     $tempPdfPath = __DIR__ . '/ДКП_заполненный.pdf';
//     file_put_contents($tempPdfPath, fopen($exportTask->getResult()->files[0]->url, 'r'));

//     header('Content-Description: File Transfer');
//     header('Content-Type: application/pdf');
//     header('Content-Disposition: attachment; filename="ДКП_заполненный.pdf"');
//     header('Expires: 0');
//     header('Cache-Control: must-revalidate');
//     header('Pragma: public');
//     header('Content-Length: ' . filesize($tempPdfPath));

//     readfile($tempPdfPath);

//     unlink($tempPdfPath);
//     unlink($tempDocxPath);
//     exit;

try {
    $public_key = 'project_public_430ca0e693b31134ad9cd40163eb2846_baUO2dcc199c15566865675bd72b75191170c';
    $secret_key = 'secret_key_bc193adb40d0dba89e3c84396f0fac25_qK7suf0de492bcd994fc1cb760abac687d9bc';

    $ilovepdf = new Ilovepdf($public_key, $secret_key);
    $myTask = $ilovepdf->newTask('officepdf');
    $file = $myTask->addFile($tempDocxPath);
    $myTask->execute();

    $tempDir = sys_get_temp_dir();
    $myTask->download($tempDir);

    $downloadedFiles = glob($tempDir . '/*.pdf');
    if (!empty($downloadedFiles)) {
        if (filesize($downloadedFiles[0]) > 1024) {
            rename($downloadedFiles[0], $finalPdfPath);
        } else {
            throw new Exception('PDF файл пустой или слишком мал');
        }
    } else {
        throw new Exception('PDF не был создан');
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="ДКП_заполненный.pdf"');
    header('Content-Length: ' . filesize($finalPdfPath));
    readfile($finalPdfPath);

    unlink($finalPdfPath);
    unlink($tempDocxPath);
    exit;
} catch (\Exception $e) {
    error_log('PDF conversion error: ' . $e->getMessage());
    // Сюда добавил вариант скачивания документа, если пдф токены закончатся или еще чего не так пойдет
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="ДКП_заполненный.docx"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tempDocxPath));

    readfile($tempDocxPath);

    unlink($tempDocxPath);
    exit;
}
