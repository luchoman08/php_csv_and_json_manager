<?php
require_once(__DIR__.'/Csv.php');
require_once(__DIR__.'/../lib/reflection.php');
require_once(__DIR__.'/Errors/CsvManagerErrorFactory.php');
class CsvManager {
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
     * Create instances of type $this->$class_or_class_name based on contents of $file
     * @param php file $file Csv file where each row is returned as class instance
     * @returns array of $class_or_class_name instances
     */ 
    public function create_instances($file) {
        if(!Csv::csv_compatible_with_class($file, $this->class_or_class_name)) {
            $this->add_error(CsvManagerErrorFactory::csv_and_class_have_distinct_properties(array('class'=>$this->class_or_class_name)));
            return ;
        }
        $std_objects = Csv::csv_file_to_std_objects($file);
        if(!class_exists($this->class_or_class_name)) {
            $error = CsvManagerErrorFactory::csv_manager_class_does_not_exist(array('std_objects' => $std_objects, 'class'=>$class));
            $this->add_error ($error);
            return;
        }
        $instances = array_map(
            function($std_object) {
                $instance = \reflection\make_from_std_object($std_object, $this->class_or_class_name);
                return $instance;
        }, $std_objects);
        
        return $instances;
       
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

?>