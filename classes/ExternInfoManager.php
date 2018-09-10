<?php
require_once(__DIR__.'/JsonManager.php');
require_once(__DIR__.'/CsvManager.php');
require_once(__DIR__.'/../lib/reflection.php');
require_once(__DIR__.'/Errors/CsvManagerErrorFactory.php');
class ExternInfoManager {
    use CsvManager, JsonManager;
    /**
     * PHP class than model the csv, the csv headers and the class properties
     * should be the same, otherwise it is taken as error
     */ 
    public $class_or_class_name;
    /**
     * Instance of array of errors
     * @see Error
     */ 
    private $errors = [];
    private $valid = true;
    public function __construct($class_or_class_name) {
        $this->class_or_class_name = $class_or_class_name;
    }
    
        /**
     * Return true if current manager does not have any errors, false otherwise
     * @return bool is valid manager or not 
     */ 
    public function is_valid() {
        return $this->valid;
    }
    /**
     * Get errors from current manager, if doesnt exist errors return empty array
     * @return array of Errors
     */ 
    public function get_errors() {
        return $this->errors;
    }
    private function add_error($error) {
        $this->valid = false;
        array_push($this->errors, $error);
    }
}
