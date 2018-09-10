<?php

require_once(__DIR__.'/Error.php');

class JsonErrorsFactory {
    public static $JSON_MALFORMED = 61;
    public static $JSON_AND_CLASS_HAVE_DISTINCT_PROPERTIES = 62;
     public static $JSON_SHOULD_BE_AN_ARRAY = 63;
    public static function json_malformed($data=null) {
        return new Error(JsonManagerErrorFactory::$JSON_MALFORMED, 'El json ingresado esta malformado', $data);
    }
    public static function  json_and_class_have_distinct_properties($data=null) {
        return new Error(JsonManagerErrorFactory::$JSON_AND_CLASS_HAVE_DISTINCT_PROPERTIES, 'El JSON ingresado no tiene propiedades validas para con la clase a la que intenta asignarle los valores', $data);
    }
        public static function  json_should_be_an_array($data=null) {
        return new Error(JsonManagerErrorFactory::$JSON_SHOULD_BE_AN_ARRAY, 'El JSON ingresado debe ser un array', $data);
    }
}
?>