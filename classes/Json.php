<?php
require_once(__DIR__.'/../lib/reflection.php');
class Json {

    /**
     * Check if an input JSON string have header names compatible with the properties
     * of a given class or classname
     * @param string Json 
     * @return bool If the json properties are equal to class properties
     */ 
     public static function json_compatible_with_class($csv_file, $class_or_classname) {
         $json_properties = \reflection\get_properties(json_decode($class_or_classname));
         $class_or_classname_properties = \reflection\get_properties($class_or_classname);
         return $class_or_classname_properties == $class_or_classname_properties;
     }
     /**
      * Check if an input JSON string is valid
      * @param string Json
      * @return bool If the json is well formed return true
      */ 
      public static function valid_json($json_string) {
        json_decode($json);
        return json_last_error() == JSON_ERROR_NONE;
      }
}
?>