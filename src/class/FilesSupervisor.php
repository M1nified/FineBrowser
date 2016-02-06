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
    // var_dump($filename);
    $filepath = $location . DIRECTORY_SEPARATOR . $filename;
    // var_dump($filepath);
    if(!($filehandler = fopen($filepath,'w'))){
      throw new Exception("#100 Error openning file to store md5 checksums", 100);
    }
    $md5it = new MD5Iterator('.*',$this->path,$this->is_recursive);
    foreach ($md5it as $key => $value) {
      if(!$value){
        continue;
      }
      // print_r($value);
      fputcsv($filehandler,$value);
    }
    fclose($filehandler);
  }
  function cmp_sum_files($oldfile,$latestfile){
    if(!($oldfilehandler = fopen($oldfile,'r')) || !($latestfilehandler = fopen($latestfile,'r'))){
      throw new Exception("#101 Error openning file width md5 checksums", 101);
    }
    $oldsums = [];
    $latestsums = [];
    while (($data = fgetcsv($oldfilehandler))) {
      $oldsums[$data[0]] = $data[1];
    }
    while (($data = fgetcsv($latestfilehandler))) {
      $latestsums[$data[0]] = $data[1];
    }

    $f_added = [];
    $f_changed = [];
    $f_removed = [];
    foreach ($latestsums as $file => $checksum) {
      if(array_key_exists($file,$oldsums)){
        if($oldsums[$file] != $checksum){
          $f_changed []= $file;
        }
        unset($oldsums[$file]);//remove from oldsums to leave only removed files
      }else{
        $f_added []= $file;
      }
    }
    $f_removed = $oldsums;
    // foreach ($oldsums as $file => $checksum) {
    //   # code...
    // }
    $differences = [
      "NEW" => $f_added,
      "MODIFIED" => $f_changed,
      "REMOVED" => $f_removed
    ];
    return $differences;
  }
}

?>
