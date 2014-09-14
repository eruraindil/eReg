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
      while($tableRows = $tableQuery->fetch(Database::FETCH_OBJ)) {
        $rows['columns'][] = $tableRows;
      }
      self::genFile($rows);
    }
  }
  
  public static function genFile($table) {
    //echo "<pre>" . print_r($table,1) . "</pre>";
    
    $filename = $table[0] . "DB.php";
    $fileLoc = __DIR__ . "/../db/" . $filename;
    
    $fo = new \SplFileObject( $fileLoc, "w");
    $fo->fwrite(self::writeFile($table));
    //echo "<pre>" . print_r(self::writeFile($table),1) . "</pre>";
    //die();
  }
  
  public static function writeFile($table) {
    $output = "";
    $output .= "<?php namespace models\db;\n";
    $output .= "use \core\model as Model;\n\n";
    $output .= "class $table[0]DB implements \models\gen\ModelInterface {\n";
    
    foreach($table['columns'] as $column) {
      $output .= "\tprotected \$" . $column->Field . ";\n";
    }
    
    $output .= "\n\tfunction __construct( \$fields = null ){\n";
    $output .= "\t\tforeach( \$fields as \$key => \$value ) {\n";
    $output .= "\t\t\t\$this->\$key = \$value;\n";
    $output .= "\t\t}\n";
    $output .= "\t}\n\n";
    
    foreach($table['columns'] as $column) {
      $output .= "\tpublic function get" . \ucfirst($column->Field) . "() {\n";
      $output .= "\t\treturn \$this->" . $column->Field . ";\n";
      $output .= "\t}\n";
      
      $output .= "\tpublic function set" . \ucfirst($column->Field) . "(\$" . $column->Field . ") {\n";
      $output .= "\t\t\$this->" . $column->Field . " = \$" . $column->Field . ";\n";
      $output .= "\t}\n";
    }
    
    $output .= "\n\t//////////////////////////////////////////////////////////////////////////////\n";
    
    $output .= "\tpublic static function getObj(\$id) {\n";
    $output .= "\t\t\$model = new Model();\n";
    $output .= "\t\t\$db = \$model->getDb();\n";
    $output .= "\t\treturn \$db->select('select * from " . $table[0] . " where id = :id', array(':id' => \$id));\n";
    $output .= "\t}\n\n";
    
    $output .= "\tpublic static function getObjs(\$sql) {\n";
    $output .= "\t\t\$model = new Model();\n";
    $output .= "\t\t\$db = \$model->getDb();\n";
    $output .= "\t\t\$objs = \$db->select(\$sql);\n";
    $output .= "\t\t\$output = array();\n";
    $output .= "\t\tforeach( \$objs as \$obj ) {\n";
    $output .= "\t\t\t\$output[] = new \models\\" . $table[0] . "(\$obj);\n";
    $output .= "\t\t}\n";
    $output .= "\t\treturn \$output;";
    $output .= "\t}\n\n";
    
    $output .= "\tpublic static function getObjsAll() {\n";
    $output .= "\t\treturn self::getObjs('select * from " . $table[0] . "');\n";
    $output .= "\t}\n\n";
    $output .= "}\n";
    
    return $output;
  }
  
  
}