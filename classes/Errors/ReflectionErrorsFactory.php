<?php

require_once(__DIR__.'/Error.php');

class ReflectionErrorFactory {
    public static $CLASS_DOES_NOT_EXIST = 50;
    public static $CLASS_AND_STD_OBJECT_OR_ARRAY_DISTINCT_PROPERTIES = 51;
    
    public static function  class_does_not_exist ($data=null) {
        return new Error(ReflectionErrorFactory::$CLASS_DOES_NOT_EXIST, 'La clase solicitada no exite', $data);
    }
    
    public static function  class_and_std_object_or_array_distinct_properties($data=null) {
        return new Error(ReflectionErrorFactory::$CLASS_AND_STD_OBJECT_OR_ARRAY_DISTINCT_PROPERTIES, 'Esta tratando de asignar un std object o array con propiedades distintas a la clase solicitada', $data);
    }
}
?>