<?php

namespace bulk_load_errors;
require_once(__DIR__.'/Error.php');
require_once(__DIR__.'/../Renderable.php');

$CSV_OTHER_THAN_OBJECT = new Error(40, 'El CSV contiene columnas que no corresponden a la clase a la cual se intenta parsear');
$CSV_MANAGER_CLASS_DOES_NOT_EXIST = new Error
?>