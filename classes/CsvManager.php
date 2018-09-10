<?php
require_once(__DIR__.'/Csv.php');
require_once(__DIR__.'/../lib/reflection.php');
require_once(__DIR__.'/Errors/CsvManagerErrorFactory.php');
/**
 * For implement this trait your class should be have public property named
 * class_or_class_name and function named add_error, oherwise this doesnt work
 * 
 */ 
trait CsvManager {
    /**
     * Check for required functions and properties for implement this trait
     */ 
    private function validate_caller_csv() {
        $current_class =  get_class($this);
        if(property_exists($current_class, 'class_or_class_name') && method_exists ($current_class, 'add_error')) {
            return true;
        } else {
            throw new Error("La clase $current_class no cumple con los requisitos para implementar el trait CsvManager, (debe tener la propiedad class_or_class_name y el metodo add_error)");
        }
    }
    /**
     * Create instances of type $this->$class_or_class_name based on contents of $file
     * @param php file $file Csv file where each row is returned as class instance
     * @returns array of $class_or_class_name instances
     */ 
    public function create_instances_from_csv($file) {
        $this->validate_caller_csv();
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
}
?>