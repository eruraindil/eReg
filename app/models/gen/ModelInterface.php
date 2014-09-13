<?php namespace models\gen;

/**
 *
 * @author Matthew
 */
interface ModelInterface {
  public static function getObj($id);
  
  public static function getObjs($sql);
  
  public static function getObjsAll();
}
