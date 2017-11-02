<?php 
echo "entre por aki";
//echo $_POST['post'];
//echo $_POST['theInput'];
session_start();
$dni=$_SESSION['Dni'];
echo "llego el valor de $dni";
define('CONTROLADOR', TRUE);
require_once '../modelos/participante.php';
//echo $participante->getDni();
?>