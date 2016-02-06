<?php
/**
 *
 */
include_once("MD5Iterator.php");
class FilesSupervisor
{
  function __construct($path,$recursive=true)
  {
    $this->path = $path;
    $this->is_recursive = $recursive;
  }
  function sum_to_file($location = '.', $filename = false){
    if(!$filename){
      $filename = 'files_supervisor_md5_'.date('Y-m-d-H-i-s').'.csv';
    }
    var_dump($filename);
    $filepath = $location . DIRECTORY_SEPARATOR . $filename;
    var_dump($filepath);
    if(!($filehandler = fopen($filepath,'w'))){
      throw new Exception("#100 Error openning file to store md5 checksums", 100);
    }
    $md5it = new MD5Iterator('.*',$this->path,$this->is_recursive);
    foreach ($md5it as $key => $value) {
      if(!$value){
        continue;
      }
      print_r($value);
      fputcsv($filehandler,$value);
    }
    fclose($filehandler);
  }
}

?>
