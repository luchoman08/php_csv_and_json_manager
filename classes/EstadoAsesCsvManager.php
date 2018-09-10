<?php
require_once(__DIR__.'/CsvManager.php');
require_once(__DIR__.'/EstadoAses.php');
class EstadoAsesCsvManager extends CsvManager{
    public function __construct() {
        $this->class_or_class_name = EstadoAses;
    }

}


?>