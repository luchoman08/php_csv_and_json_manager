<?php
require_once(__DIR__.'/Json.php');
require_once(__DIR__.'/../lib/reflection.php');
require_once(__DIR__.'/Errors/CsvManagerErrorFactory.php');
/**
 * For implement this trait your class should be have public property named
 * class_or_class_name and function named add_error, oherwise this doesnt work
 * 
 */ 
trait JsonManager {
    /**
     * Check for required functions and properties for implement this trait
     */ 
    private function validate_caller_json() {
        $current_class =  get_class($this);
        if(property_exists($current_class, 'class_or_class_name') && method_exists ($current_class, 'add_error')) {
            return true;
        } else {
            throw new Error("La clase $current_class no cumple con los requisitos para implementar el trait JsonManager, (debe tener la propiedad class_or_class_name y el metodo add_error)");
        }
    }
    /**
     * Create instances of type $this->$class_or_class_name based on string formated as json
     * @param php file $file Csv file where each row is returned as class instance
     * @returns array of $class_or_class_name instances
     */ 
    public function create_instances_from_json($string) {
        $this->validate_caller_json();
        if(!Json::valid_json($string)) {
            $this->add_error(JsonErrorsFactory::json_malformed(array('json_string'=>$string)));
            return ;
        }
        $std_objects = json_decode($string);
        if(count($std_objects) == 0) {
            return [];
        }
        // If the JSON is well formed but its respective std_object is not an array,
        // return an error
        if(!is_array($std_objects)) {
            $this->add_error(JsonErrorsFactory::json_should_be_an_array(array('json_string'=>$string)));
            return;
        }
        if(!class_exists($this->class_or_class_name)) {
            $error = CsvManagerErrorFactory::csv_manager_class_does_not_exist(array('std_objects' => $std_objects, 'class'=>$class));
            $this->add_error ($error);
            return;
        }
        $instances = [];
        foreach($std_objects as $std_object) {
            $instance = new \stdClass();
            try {
            $instance = \reflection\make_from_std_object($std_object, $this->class_or_class_name);
            array_push($instances, $instance);
            } catch(Exception  $e) {
                $error = ReflectionErrorsFactory::class_and_std_object_or_array_distinct_properties(array('object'=>$std_object));
                $error->message = $e->getMessage();
                $this->add_error($error);
            }
            
        }
        
        return $instances;
       
    }
 
    
}

?>