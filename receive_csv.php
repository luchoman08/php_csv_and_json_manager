<?php
require_once('classes/EstadoAsesCsvManager.php');
require_once('classes/Datatables.php');
$estado_ases_csv_manager = new EstadoAsesCsvManager();
$estados_ases = $estado_ases_csv_manager->create_instances(file($_FILES["fileToUpload"]["tmp_name"]));
$sample_std_object = $estados_ases[0];
$datatable_columns = new \stdClass();
$json_datatable = new \stdClass();
if($estado_ases_csv_manager->is_valid()) {
    $datatable_columns = JSONColumn::get_JSON_columns($sample_std_object);
    $json_datatable = new JSONDataTable($estados_ases, $datatable_columns);
}

$response = new \stdClass();
$response->jquery_datatable = $json_datatable;

$response->errors = $estado_ases_csv_manager->get_errors();
$arrayEncoded = json_encode($response);
print_r($arrayEncoded);
?>