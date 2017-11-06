<?php
 class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = 'localhost';
   private $nombre_de_base = 'ulfmeta';
   private $usuario = 'root';
   private $contrasena = ''; 
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   } 
 } 


//coneccion al servidor para realizar la consulta
//    $host = 'localhost';
//    $user = 'root';
//    $pass = '';
//    $bd   = 'procuraduria_mdpp';
//
//    $coneccion = mysqli_connect($host, $user, $pass, $bd) or die ('no se Puede Conectar: '. mysqli_errno());

// fin de la conecion al servidor
?>