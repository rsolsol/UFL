<?php

if (!defined('CONTROLADOR'))
    exit;

require_once 'conexion.php';

class Participante {
    private $id;
    private $nroDni;
    private $apelPaterno;
    private $apelMaterno;
    private $nombres;
    private $direccion;
    private $sexo;
    private $fechaNac;
    private $estado;
    private $sector;
    private $fechaEmpadrono;
    
    const TABLA = 'enpadronados';
    
    public function __construct($id = null, $nroDni = null, $apelPaterno = null, $apelMaterno = null, $nombres = null, $direccion = null, $sexo = null, $fechaNac = null, $estado = null, $sector = null, $fechaEmpadrono = null){
        $this->id = $id;
        $this->nroDni = $nroDni;
        $this->apelPaterno = $apelPaterno;
        $this->apelMaterno = $apelMaterno;
        $this->nombres = $nombres;
        $this->direccion = $direccion;
        $this->sexo = $sexo;
        $this->fechaNac = $fechaNac;
        $this->estado = $estado;
        $this->sector = $sector;
        $this->fechaEmpadrono = $fechaEmpadrono;
    }
    public function getId() {
        return $this->id;
    }
    public function getDni() {
        return $this->nroDni;
    }
    public function getPaterno() {
        return $this->apelPaterno;
    }
    public function getMaterno() {
        return $this->apelMaterno;
    }
    public function getNombres() {
        return $this->nombres;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getsexo() {
        return $this->sexo;
    }
    public function getFnac() {
        return $this->fechaNac;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getsector() {
        return $this->sector;
    }
    public function getFempadrono(){
        return $this->fechaEmpadrono;
    }
    
    public function setId($id) {$this->id = $id;}
    public function setDni($nroDni) {$this->nroDni = $nroDni;}
    public function setPaterno($apelPaterno) {$this->apelPaterno = $apelPaterno;}
    public function setMaterno($apelMaterno) {$this->apelMaterno = $apelMaterno;}
    public function setNombres($nombres) {$this->nombres = $nombres;}
    public function setDireccion($direccion) {$this->direccion = $direccion;}
    public function setsexo($sexo) {$this->sexo = $sexo;}
    public function setFnac($fechaNac) {$this->fechaNac = $fechaNac;}
    public function setEstado($estado) {$this->estado = $estado;}
    public function setsector($sector) {$this->sector = $sector;}
    public function setFempadrono($fechaEmpadrono){$this->fechaEmpadrono=$fechaEmpadrono;}
    
    public function guardar(){
        $conexion = new Conexion();
        if ($this->nroDni ) /*Modifica*/ {
            $consulta = $conexion->prepare('UPDATE ' . self::TABLA . ' SET estado = :estado, sector = :sector, fechaEmpadrono = :fechaEmpadrono WHERE nroDni = :nroDni');
            $consulta->bindParam(':estado', $this->estado);
            $consulta->bindParam(':sector', $this->sector);
            $consulta->bindParam(':fechaEmpadrono', $this->fechaEmpadrono);
            $consulta->bindParam(':nroDni', $this->nroDni);
            $consulta->execute();
        }else /*Inserta*/ {
            $consulta = $conexion->prepare('INSERT INTO ' . self::TABLA . ' (nroDni, apelPaterno,  	apelMaterno, nombres, direccion, sexo, fechaNac, estado, sector, fechaEmpadrono) VALUES(:nroDni; :apelPaterno; :apelMaterno; :nombres; :direccion; :sexo; :fechaNac; :estado; :sector)');
            $consulta->bindParam(':nroDni', $this->nroDni);
            $consulta->bindParam(':apelPaterno', $this->apelPaterno);
            $consulta->bindParam(':apelMaterno',$this->apelMaterno);
            $consulta->bindParam(':nombres', $this->nombres);
            $consulta->bindParam(':direccion', $this->direccion);
            $consulta->bindParam(':sexo', $this->sexo);
            $consulta->bindParam(':fechaNac', $this->fechaNac);
            $consulta->bindParam(':estado', $this->estado);
            $consulta->bindParam(':sector', $this->sector);
            $consulta->bindParam(':fechaEmpadrono', $this->fechaEmpadrono);
            $consulta->execute();
            $this->id = $conexion->lastInsertId();
        }
        $conexion = null;
    }
    public function buscarPorDni($nroDni) {
//        echo "estoy dentro del buscar por ID";
//    echo $nroDni. "</br>";

        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT Id, nroDni, apelPaterno, apelMaterno, nombres, direccion, sexo, fechaNac, estado, sector, fechaEmpadrono FROM ' . self::TABLA . ' WHERE nroDni = :nroDni');
        $consulta->bindParam(':nroDni', $nroDni);
        $consulta->execute();
        $registro = $consulta->fetch();
        $conexion = null;
        if ($registro){
            return new self($registro['Id'],$registro['nroDni'], $registro['apelPaterno'], $registro['apelMaterno'], $registro['nombres'], $registro['direccion'], $registro['sexo'], $registro['fechaNac'], $registro['estado'],
            $registro['sector'], $registro['fechaEmpadrono'], $nroDni);
        }else {
            return false;
        }
//        echo $registro['nombres'];
    }

}
class Estados {
    private $idEstado;
    private $descEstado;
    
    public function __construct($idEstado = null, $descEstado = null){
        $this->idEstado = $idEstado;
        $this->descEstado = $descEstado;
    }
    
    public function getidEstado(){ return $this->idEstado; }
    public function getdescEstado(){ return $this->descEstado; }
    
    public function setidEstado($idEstado) { $this->idEstado = $idEstado; }
    public function setdescEstado($descEstado) { $this->descEstado = $descEstado; }
    

    
    public function cargarEstados(){
        $conexion = new Conexion();
        $consEstado = $conexion->prepare('SELECT id_estado, des_estado FROM estado_participante');
        $consEstado->execute();
        $regEstados = $consEstado->fetchAll();
        $conexion = null;
        return $regEstados;
    }
   public function buscarEstado($idEstado) {
//    echo "estoy dentro del buscar por ID";
       $conexion = new Conexion();
  //     echo $idEstado;
       $consulta = $conexion->prepare('SELECT id_estado, des_estado FROM estado_participante WHERE id_estado = :idEstado');
       $consulta->bindParam(':idEstado', $idEstado);
       $consulta->execute();
       $registro = $consulta->fetch();
       $consulta = null;
       if($registro) {
           return new self($registro['id_estado'], $registro['des_estado'], $idEstado);
       }else{
           echo "NO SE A PODIDO ENCONTRAR EL LISTADO DE ESTADOS!!!!!";
       }
   }
}

class Zonas {
    private $idZonas;
    private $descZonas;
    
    public function __construct($idZonas = null, $descZonas = null){
        $this->idZonas = $idZonas;
        $this->descZonas = $descZonas;
    }
    
    public function getidZonas(){ return $this->idZonas; }
    public function getdescZonas(){ return $this->descZonas; }
    
    public function setidZonas($idZonas){ $this->idZonas =$idZonas; }
    public function setdescZonas($descZonas){ $this->$descZonas =$descZonas; }
    
    public function cargarZonas(){
        $conexion = new Conexion();
        $consultazonas = $conexion->prepare('SELECT idZonas, descZonas FROM zonas_participante');
        $consultazonas->execute();
        $regZonas = $consultazonas->fetchAll();
        $conexion = null;
        return $regZonas;
    }
    public function buscarZonas($idZonas){
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT idZonas, descZonas FROM zonas_participante WHERE idZonas = :idZonas');
        $consulta->bindParam(':idZonas', $idZonas);
        $consulta->execute();
        $registro = $consulta->fetch();
        $consulta = null;
        if ($registro) {
            return new self($registro['idZonas'],$registro['descZonas']);
        }else{
           echo "NO SE A PODIDO ENCONTRAR EL LISTADO DE ESTADOS!!!!!";
       }
    }
}
/*participante se va a llamar la tabla*/
?>