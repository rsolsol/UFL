<?php 
//function invertirFecha($fecha){
//	$fecha = explode("-", $fecha);
//	$fec=$fecha[0]."-".$fecha[1]."-".$fecha[2];
//	return $fec;
//}
	define('CONTROLADOR', false);
//	echo "estamos por aki ";
	require_once '../modelos/participante.php';
//$nroDni = $_POST['Dni'];
//$estado = $_POST['estado'];
//$zona = $_POST['zonas'];
//$fecEmpadronado = $_POST['fecha1'];

//	$dni_participante = (isset($_REQUEST['Dni'])) ? $_REQUEST['Dni'] : null;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	
	$nroDni = $_POST['Dni'];
	$estado = $_POST['estado'];
	$zona = $_POST['zonas'];
    
	$date = str_replace('/', '-', $_POST['fechaEmp']) ;
	$fechaEmpadrono = date("Y/m/d", strtotime($date)) ;
//	$fechaEmpadrono = '2017-10-19';
	
//	echo 'Dni: '. $nroDni . ' Estado: ' . $estado . ' Zona: ' . $zona . ' F-Emp: ' . $fecEmpadronado . '</br>';
//	$fecEmpadronado2= invertirFecha($fecEmpadronado);
//	$fecEmpadronado = date("Y-m-d", strtotime($fecEmpadronado));
//	$objeto_DateTime = date_create_from_format('Y-m-d', $fecEmpadronado);
//	echo 'Dni: '. $nroDni . ' Estado: ' . $estado . ' Zona: ' . $zona . ' F-Emp: ' . $objeto_DateTime . '</br>';
	$participante2 = new Participante();
	
	$participante2->setDni($nroDni);
	$participante2->setEstado($estado);
	$participante2->setsector($zona);
	$participante2->setFempadrono($fechaEmpadrono);
//    echo "El valor valor de getFempadrono => " . $participante2->getFempadrono($fechaEmpadrono);
	$participante2->guardar();
//	echo $participante2->setEstado($estado);
	header('Location: \ulf');
//	
}else{
	echo "HUBO PROBLEMAS AL ACTUALIZAR LOS DATOS, POR FAVOR COMUNICARSE CON INFORMATICA.";
}


//
//echo "prueba";

?>