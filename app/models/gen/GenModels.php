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
    
    $fnDB = $table[0] . "DB.php";
    $flDB = __DIR__ . "/../db/" . $fnDB;
    
    $foDB = new \SplFileObject( $flDB, "w");
    $foDB->fwrite(self::writeDBFile($table));
    \chmod($flDB ,0775);
    
    $fn = $table[0] . ".php";
    $fl = __DIR__ . "/../" . $fn;
    try {
      $fo = new \SplFileObject( $fl, "x");
    } catch(\Exception $e) {
      //do nothing
    } 
    if( $fo ) {
      $fo->fwrite(self::writeFile($table));
      \chmod($fl ,0775);
    }
  }
  
  public static function writeDBFile($table) {
    $output = "";
    $output .= "<?php namespace models\db;\n";
    $output .= "use \\core\\model as Model;\n\n";
    $output .= "class $table[0]DB implements \\models\\gen\\ModelInterface {\n";
    
    $output .= "\tprotected \$db;\n";
    foreach($table['columns'] as $column) {
      $output .= "\tprotected \$" . $column->Field . ";\n";
    }
    
    $output .= "\n\tfunction __construct( \$fields = null ){\n";
    $output .= "\t\tforeach( \$fields as \$key => \$value ) {\n";
    $output .= "\t\t\t\$this->\$key = \$value;\n";
    $output .= "\t\t}\n";
    $output .= "\t\t\$model = new Model();\n";
		$output .= "\t\t\$this->db = \$model->getDb();\n";
      
    $output .= "\t}\n\n";
    
    foreach($table['columns'] as $column) {
      $output .= "\tpublic function get" . \ucfirst($column->Field) . "() {\n";
      $output .= "\t\treturn \$this->" . $column->Field . ";\n";
      $output .= "\t}\n";
      
      $output .= "\tpublic function set" . \ucfirst($column->Field) . "(\$" . $column->Field . ") {\n";
      $output .= "\t\t\$this->" . $column->Field . " = \$" . $column->Field . ";\n";
      $output .= "\t}\n";
    }
    
    $output .= "\n\tpublic function save() {\n";
    $output .= "\t\t\$obj = self::getObj(\$this->id);\n";
    $output .= "\t\t\$data = array(";
    $i = 1;
    for($i; $i < \count($table['columns']) - 1; $i++) {
      $output .= "'" . $table['columns'][$i]->Field . "' => \$this->" . $table['columns'][$i]->Field . ", ";
    }
    $output .= "'" . $table['columns'][$i]->Field . "' => \$this->" . $table['columns'][$i]->Field;
    $output .= ");";
    $output .= "\t\tif(\$obj) {//update\n";
    $output .= "\t\t\t\$this->db->update(\"" . PREFIX . $table[0] . "\",\$data,array('id' => \$this->id));\n";
    $output .= "\t\t\treturn \$this->id;\n";
    $output .= "\t\t} else {//insert\n";
    $output .= "\t\t\t\$this->db->insert(\"" . PREFIX . $table[0] . "\",\$data);\n";
    $output .= "\t\t\t\$obj = self::getObj(\"select * from " . PREFIX . $table[0] . " where ";
    $i = 1;
    for($i; $i < \count($table['columns']) - 1; $i++) {
      $output .= $table['columns'][$i]->Field . " = :" . $table['columns'][$i]->Field . " AND ";
    }
    $output .= $table['columns'][$i]->Field . " = :" . $column->Field;
    $output .= "\",array(";
    $i = 1;
    for($i; $i < \count($table['columns']) - 1; $i++) {
      $output .= "':" . $table['columns'][$i]->Field . "' => \$this->" . $table['columns'][$i]->Field . ", ";
    }
    $output .= "':" . $table['columns'][$i]->Field . "' => \$this->" . $table['columns'][$i]->Field;
    $output .= "));\n";
    $output .= "\t\t\treturn \$obj->id;\n";
    $output .= "\t\t}\n";
    $output .= "\t}\n";
    
    $output .= "\n\t//////////////////////////////////////////////////////////////////////////////\n";
    
    $output .= "\tpublic static function getObj(\$sql,\$params = array()) {\n";
    $output .= "\t\t\$model = new Model();\n";
    $output .= "\t\t\$db = \$model->getDb();\n";
    $output .= "\t\tif(\\is_numeric(\$sql) == 'integer') {\n";
    $output .= "\t\t\t\$obj = \$db->select('select * from " . PREFIX . $table[0] . " where id = :id limit 1', array(':id' => \$sql));\n";
    $output .= "\t\t} else {\n";
    $output .= "\t\t\t\$obj = \$db->select(\$sql . ' limit 1',\$params);\n";
    $output .= "\t\t}\n";
    $output .= "\t\treturn new \\models\\" . $table[0] . "(\$obj[0]);\n";
    $output .= "\t}\n\n";
    
    $output .= "\tpublic static function getObjs(\$sql,\$params = array()) {\n";
    $output .= "\t\t\$model = new Model();\n";
    $output .= "\t\t\$db = \$model->getDb();\n";
    $output .= "\t\t\$objs = \$db->select(\$sql,\$params);\n";
    $output .= "\t\t\$output = array();\n";
    $output .= "\t\tforeach( \$objs as \$obj ) {\n";
    $output .= "\t\t\t\$output[] = new \\models\\" . $table[0] . "(\$obj);\n";
    $output .= "\t\t}\n";
    $output .= "\t\treturn \$output;\n";
    $output .= "\t}\n\n";
    
    $output .= "\tpublic static function getObjsAll() {\n";
    $output .= "\t\treturn self::getObjs('select * from " . PREFIX . $table[0] . "');\n";
    $output .= "\t}\n\n";
    
    foreach($table['columns'] as $column) {
      $output .= "\tpublic static function getObjBy" . \ucfirst($column->Field) . "(\$" . $column->Field . ") {\n";
      $output .= "\t\treturn self::getObj('select * from " . PREFIX . $table[0] . " where " . $column->Field . " = :" . $column->Field . "',array(':" . $column->Field . "' => \$" . $column->Field . "));\n";
      $output .= "\t}\n\n";
      
      $output .= "\tpublic static function getObjsBy" . \ucfirst($column->Field) . "(\$" . $column->Field . ") {\n";
      $output .= "\t\treturn self::getObjs('select * from " . PREFIX . $table[0] . " where " . $column->Field . " = :" . $column->Field . "',array(':" . $column->Field . "' =>\$" . $column->Field . "));\n";
      $output .= "\t}\n\n";
    }
    
    $output .= "}\n";
    
    return $output;
  }
  
  public static function writeFile($table) {
    $output = "";
    $output .= "<?php namespace models;\n\n";
    $output .= "class $table[0] implements \\models\\db\\$table[0]DB {\n";
    
    foreach($table['columns'] as $column) {
      $output .= "\tprotected \$" . $column->Field . ";\n";
    }
    
    $output .= "\n\tfunction __construct( \$fields = null ){\n";
    $output .= "\t\tparent::__construct( \$fields );";
    $output .= "\t}\n\n";
    $output .= "}\n";
    
    return $output;
  }
}