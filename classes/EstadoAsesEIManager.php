<?php
require_once(__DIR__.'/ExternInfoManager.php');
require_once(__DIR__.'/EstadoAses.php');
class EstadoAsesEIManager extends ExternInfoManager {
    public function __construct() {
        $this->class_or_class_name = EstadoAses;
    }
    
}


?>