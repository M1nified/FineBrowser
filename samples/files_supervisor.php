<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
include_once('../src/load.php');//Load class_uses
echo 'FilesSupervisor example';
$filesSupervisor = new FilesSupervisor(".");
$filesSupervisor->sum_to_file('.','md5s.csv');
// $filesSupervisor->sum_to_file();

$changes = $filesSupervisor->cmp_sum_files('files_supervisor_md5_2016-02-06-15-04-18.csv','md5s.csv');
ob_start();
print_r($changes);
$output = ob_get_contents();
ob_end_flush();
file_put_contents('differences.txt',$output);
?>
