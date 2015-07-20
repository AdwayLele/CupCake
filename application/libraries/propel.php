<?php
class CI_Propel
{
 public function CI_Propel()
 {
  define('DS',DIRECTORY_SEPARATOR);
  //EDIT for Virtual hosts
  set_include_path(get_include_path().PATH_SEPARATOR.APPPATH.'models/'); 
  require dirname(__FILE__) . DS . "propel" .DS . 'Propel.php';
  Propel::init(APPPATH . DS ."config".DS."cpu-conf.php");
 }
}
