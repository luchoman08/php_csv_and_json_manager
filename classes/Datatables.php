<?php
class JSONDataTable {
    /** Data for JSONDataTable, can be stdClass objects or class instances
     * @link https://datatables.net/reference/option/data
     */ 
    public $data;
    /** Columns of JSONDataTable, each column must correspond with at least one property of the objects
     *  than exist in '$this->data'
     * @see JSONColumn
     * @link https://datatables.net/reference/option/columns
     */ 
    public $columns;
    public $responsive = true;
    public $sPaginationType = "full_numbers";
    
    public function __construct($data=[], $columns=[]) {
        $this->data = $data;
        $this->columns = $columns;
    }
}
/**
 * JSONColumn, jquery datatables column than extract data from json
 * for more information about how it works go to 
 * {@link https://datatables.net/reference/option/columns}, or for concrete 
 * example {@link https://editor.datatables.net/examples/advanced/deepObjects.html}
 * 
 */
class JSONColumn {
    /**
     * @link https://datatables.net/reference/option/columns.data
     */ 
    public $data;
    /**
     * @link https://datatables.net/reference/option/columns.title
     */ 
    public $title;
    function __construct($data='', $title='') {
        $this->data = $data;
        $this->title = $title;
    }
    /**
     * Return column title based in standard object property name
     * ej. ('userEmail' ->  'User Email'}. 
     * @param   string  $property_name  Standard property name, with words separed by underscores or capital letters. examples: userEmail, user_email
     * @return string return standard datatable column title based in property name ej. user_email -> 'User Email'.
     */
    public static function get_column_title_from_property_name($property_name) {
        $column_title = '';
        $separed_words_chain_by_spaces = [];
        if (strpos($property_name, '_') != false) {
            $separed_words_chain_by_spaces = preg_replace("/_+/", " ", $property_name);
            $column_title = ucwords($separed_words_chain_by_spaces);
        } 
        else if(preg_match("/[A-Z]+/", $property_name)) {
            $separed_words_chain_by_spaces = preg_replace('/([A-Z])/', ' $1', $property_name);
            $column_title = ucwords($separed_words_chain_by_spaces);
        } else {
            $column_title = ucwords($property_name);
        }
        // All words should be in uppercase
        
        return $column_title;
    }
    /**
     * Return column based in standard object property name, 
     * ej. (userEmail -> {data: 'userEmail', title: 'User Email'}). 
     * @param   string  $property_name  Standard property name, with words separed by underscores or capital letters. examples: userEmail, user_email
     * @return JSONColumn return standard datatable column based in property name ej. (user_email -> {data: 'user_email', title: 'User Email'}).
     */
    public static function get_column_from_property_name($property_name) {
        $data = $property_name;
        $title = JSONColumn::get_column_title_from_property_name($property_name);
        return new JSONColumn($data, $title);
    }
    
    /**
     * Return jquery datatable columns than extract the data from JSON formated
     * object, that based in a object instance or in a class.
     * @see JSONColumn::get_column_from_property_name
     * @see JSONColumn
     * @param string|object instance $class_name_or_object Data structure for extract JSON columns, that are generated based in object or class properties
     * @return array<JSONColumn> JSON columns for jquery datatable than should print the information than contain instances of object or class given as an input
     * 
     */ 
    public static function get_JSON_columns($class_name_or_object) {
        $object;
        $object_properties;
        $sourceProperties;
        $data_table_columns = [];
        if (is_string($class_name_or_object)) {
            if (class_exists ($class_name_or_object)) {
                $object = new $class_name_or_object();
            } else {
                throw new \ValueError("La clase $class_name_or_object no esta definida");
            }
        } else {
            $object = $class_name_or_object;
        }
        $sourceProperties = new \ReflectionObject($object);
        $object_properties = $sourceProperties->getProperties();
        foreach($object_properties as $object_property) {
            $object_property_name = $object_property->name;
            $json_column = JSONColumn::get_column_from_property_name($object_property_name);
            array_push($data_table_columns, $json_column);
        }
        return $data_table_columns;
       
    }
}

?>