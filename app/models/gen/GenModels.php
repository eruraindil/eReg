<?php namespace models\gen;
use \helpers\database as Database;

class GenModels {
  
  public static function go() {
    $db = new Database();
    
    $query = $db->prepare("show tables from " . DB_NAME);
    $query->execute();
    
    //$tables = array();
    while($rows = $query->fetch(Database::FETCH_CLASSTYPE)){
      $tableQuery = $db->prepare("show columns from " . $rows[0]);
      $tableQuery->execute();
      
      $rows['columns'] = array();
      while($tableRows = $tableQuery->fetch(Database::FETCH_BOTH)) {
        echo $tableRows . "<br>";
      }
      self::genFile($rows);
    }
  }
  
  public static function genFile($table) {
    echo "<pre>" . print_r($table,1) . "</pre>";
    
    $filename = $table[0] . "DB.php";
    $fileLoc = __DIR__ . "/../db/" . $filename;
    
    $fo = new \SplFileObject( $fileLoc, "w");
    //$fo->fwrite(self::writeFile($table));
  }
  
  public static function writeFile($table) {
    
  }
  
  
}