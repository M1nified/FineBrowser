<?php
/**
 * FineBrowserIterator
 */
class FineBrowserIterator extends RegexIterator
{
  function __construct($file=".*",$path=".",$recursive=false){
    $path = !$path || $path === '' ? '.' : $path;
    $dirIt = new RecursiveDirectoryIterator($path);
    if($recursive){
      $theIt = new RecursiveIteratorIterator($dirIt);
    }else{
      $theIt = new IteratorIterator($dirIt);
    }
    // $iterator = new RegexIterator($theIt, '/\\\\'.$file.'/' ,RecursiveRegexIterator::GET_MATCH);
    parent::__construct($theIt, '/\\\\'.$file.'/' ,RecursiveRegexIterator::GET_MATCH);
  }
}
?>
