<?php
require_once(__DIR__.'/Validable.php');
require_once(__DIR__.'/Renderable.php');
require_once(__DIR__.'/Errors/Error.php');
/**
 * EstadoAses object 
 * Clase encargada de mapear la informcion dada en la carga masiva de usuarios
 * particularmente en la 'Actualizacion de estados'
 * @see mass_role_management {@link www_root+blocks/ases/view/mass_role_management.php?courseid=<[0-9]+>&instanceid=<[0-9]+>
 */ 
class EstadoAses implements Renderable, Validable{

    public $username;
    public $estado_ases;
    public $estado_icetex;
    public $estado_programa;
    public $tracking_status ;
    public $motivo_ases;
    public $motivo_icetex;
    
    public function __construct() {
        $this->username = '';
        $this->estado_ases = -1;
        $this->estado_icetex = -1;
        $this->estado_programa = -1;
        $this->tracking_status = -1;
        $this->motivo_ases	 = null;
        $this->motivo_icetex = null;
    }
    public function validate() {
        
    }
    
    public function render() {
        
    }
}


?>