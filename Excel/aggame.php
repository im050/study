<?php
include('PHPExcel.php');

$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->auth('050050');

//$private_db = get_link('cyj_private');
//$public_db = get_link('cyj_public');
//$manage_db = get_link('manage_cyj');
//$video_db = get_link('shixun_games');


if (($data = ($redis->get('AGGAMES'))) == null) {

    $reader = new PHPExcel_Reader_Excel2007();
    $excel = $reader->load('aggames.xlsx');

    $sheetCount = $excel->getSheetCount();

    $data = array();

    for ($i = 0; $i < $sheetCount; $i++) {
        $sheet = $excel->getSheet($i);
        $rows = $sheet->getHighestRow();
        for ($j = 2; $j < $rows; $j++) {
            $gameId = $sheet->getCell('G' . $j)->getValue();
            $name = $sheet->getCell("C{$j}")->getValue();

            if (is_object($gameId)) $gameId = $gameId->__toString();
            if (is_object($name)) $name = $name->__toString();

            if (trim($gameId) != '') {
                $data[trim($gameId)] = $name;
            }

        }
    }

    unset($reader);
    unset($excel);
    unset($sheet);

    // print_r($data);

//    print_r($data);
//
//    die();
    $data = serialize($data);
//
    $redis->set('AGGAMES', $data);
}
//
$data = unserialize($data);

echo "<pre>";
print_r($data);
echo "</pre>";
/*
$sheet = $excel->getSheet(0);
$rows = $sheet->getHighestRow();
*/

function &get_link($database)
{
    $dsn = 'mysql:host=192.168.1.200;';
    $username = 'root';
    $password = '123456';
    $db = new PDO($dsn, $username, $password);
    $db->query('use `' . $database . '`');
    return $db;
}
