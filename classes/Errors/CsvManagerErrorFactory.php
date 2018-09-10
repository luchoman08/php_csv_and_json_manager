<?php

require_once(__DIR__.'/Error.php');

class CsvManagerErrorFactory {
    public static $CSV_MANAGER_CLASS_DOES_NOT_EXIST = 41;
    public static $CSV_AND_CLASS_HAVE_DISTINCT_PROPERTIES = 42;
    public static function  csv_manager_class_does_not_exist ($data=null) {
        return new Error(CsvManagerErrorFactory::$CSV_MANAGER_CLASS_DOES_NOT_EXIST, 'La clase que se ha instanciado en el csv manager no existe', $data);
    }
    public static function  csv_and_class_have_distinct_properties($data=null) {
        return new Error(CsvManagerErrorFactory::$CSV_AND_CLASS_HAVE_DISTINCT_PROPERTIES, 'El CSV ingresado no tiene propiedades validas para con la clase a la que intenta asignarle los valores', $data);
    }
}
?>