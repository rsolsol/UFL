<?php
define('CONTROLADOR', TRUE);
require_once '../modelos/participante.php';
//echo "<p>vamos avanzando</p></br>";
$participante = new Participante();
$dni = (isset($_POST['Dni'])) ? $_REQUEST['Dni'] : null;
session_start();
$dni=$_SESSION['Dni'];
$participante->setDni($dni);
//echo $participante->getDni();
//comensamoa a buscar los datos con el DNI
if ($dni) {
    $participante = Participante::buscarPorDni($dni);
}else{
    header('Location: \ulf');
}
//llama los estados de los participante para cargar el select
$estado_participantes = new Estados();
$estado_participantes = Estados::cargarEstados();

//llama las Zonas de los participante para cargar el select
$zonas_participantes = new Zonas();
$zonas_participantes = Zonas::cargarZonas();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifica estado del Participante</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
        <meta name="viewport" content="width=device-width; initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/jquery-ui.min.css">
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/datepicker-es.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <section class="topbar">
                    <div class="center">
                        <p class="sede">Plataforma virtual ULF - Seguimiento a Participante</p>
                    </div>
                </section>
                <section class="navbar">
                    <div class="center">
                        <h1 class="logoAyto"><a href="http://www.munipuentepiedra.gob.pe/"><img alt="Municipalidad de puente piedra" src="http://virtual.munipuentepiedra.gob.pe/consultatramite/img/logo_muni.png" style="height:48px;width:240px;margin-bottom:10px;"></a></h1>
                    </div>
                </section>
                <div class="banner">
                    <div class="center">
                        <img alt="" src="../images/fondo.jpg">
                    </div>
                </div>
            </header>
            <section class="content">
                <div class="center">
                    <ul class="breadcrumbs">
                        <li><a href="http://www.munipuentepiedra.gob.pe/">Inicio</a></li>
                        <li><span><em>Estado del Participante</em></span></li>
                    </ul>
                    <div class="content_int">
                        <header><h2>Estado del Participante</h2></header>
						<form method="POST" action="grabar_participante.php" class="form_box form">
							<h4>Seguimiento</h4>
							<div class="fields" id="div1">
								<label for="" class="label">DNI del Participante : </label>
								<span class="field">
									<input type="text" class="form-control" name="Dni" value="<?php echo $participante->getDni() ?>" readonly>
								</span>
                                <label for="" class="label">Datos Completos del Participante : </label>
								<span class="field">
									<input type="text" class="form-control" name="datosCompletos" value="<?php echo utf8_encode($participante->getPaterno()) . " " . utf8_encode($participante->getMaterno()) . " " . utf8_encode($participante->getNombres())?>" readonly>
								</span>
                                <label for="" class="label">Domiciliado en : </label>
								<span class="field">
									<input type="text" class="form-control" name="domicilio" value="<?php echo utf8_encode($participante->getDireccion()) ?>" readonly>
								</span>
                                <label for="" class="label">Sexo : </label>
                                <span class="field">
									<input type="text" class="form-control" name="sexo" value="<?php 
                                        if ($participante->getSexo() == 1 ){
                                            echo "Masculino";
                                        } else {
                                            echo "Femenino";
                                        }?>" readonly>
								</span>
                                <label for="" class="label">Fecha de Nacimiento : </label>
                                <span class="field">
									<input type="text" class="form-control" value="<?php echo $participante->getFnac(); ?>" readonly>
								</span>
                               
                                <label for="" class="label">Estado del Participante : </label>
                                <span class="field">
                                    <select name="estado" id="" >
                                        <?php foreach($estado_participantes as $item){ ?>
                                            <option value="<?php  echo $item['id_estado'];?>"><?php echo $item['des_estado']; ?></option>
                                        <?php } ?>
                                    </select>
								</span>
                                <label for="" class="label">Zona del Participante : </label>
                                <span class="field">
									<select name="zonas" id="">
                                        <?php foreach($zonas_participantes as $item){ ?>
                                            <option value="<?php print($item['idZonas']);?>"><?php print($item['descZonas']); ?></option>
                                        <?php } ?>
                                    </select>
								</span>
                                <label for="" class="label">Fecha de Visita al Participante : </label>
                               <span class="field">
                                 <input type="text" id="fechaEmp" name="fechaEmp" placeholder="dd/mm/yyyy" value="<?php echo $participante->getFempadrono()?>" required>
                             </span>
							</div>
							 <p class='action'>
                                <input type="submit" id="submit" name="submit" value="Guardar" class="btn" >
                                <input type="reset" id="submit" name="submit" value="Limpiar" class="btn" >
                                <input type="submit" value="Cancelar" class="btn" onclick = "location=/busca_participante.php">
                            </p>  
						</form>
                    </div>
                </div>
            </section>
        </div>
        <br><br>
        <footer>
            <div class="center">
                <ul class="logos">
                    <li><img src="../images/logo_muni.gif"></li>
                </ul>
                <div class="stamp"><img alt="" src="../images/blank.png"></div>
                <p class="info">
                    Calle 9 de Junio N° 100 - Cercado de Puente Piedra
                    <br>
                    Tlf.:
                    219 - 6200
                    Línea Gratuita:
                    0800-26200
                    <br>
                    Email:
                    <a target="_blank" href="mailto:webmaster@munipuentepiedra.gob.pe">webmaster@munipuentepiedra.gob.pe</a>
                    Dirección web:
                    <a target="_blank" href="http://www.munipuentepiedra.gob.pe">http://www.munipuentepiedra.gob.pe</a>
                </p>
                <p>
                <?php echo $participante->getDni(); ?>
                </p>
                <div class="footer_right">
                    <ul class="footer_links">
                        <li><a href="http://www.munipuentepiedra.gob.pe/index.php?option=com_content&view=article&id=12">Procedimientos Administrativos</a></li>
                        <li><a href="http://www.munipuentepiedra.gob.pe/index.php?option=com_content&view=article&id=167">Sistema de control interno</a></li>
                        <li><a href="http://www.munipuentepiedra.gob.pe/index.php?option=com_content&view=article&id=45">Libro de reclamaciones</a></li>
                    </ul>
                </div>
            </div>
        </footer>    
    </body>
    <!-- scrip que llama a la formacion del calendario ademas aqui damos las caracteristicas del calendario -->
    <script>
        $("#fechaEmp").datepicker({
            changeMonth:true,   /*activa el selector de mes*/
            changeYear:true,    /*activa el selector de año*/
            showOn: "button",   /*activa el boton que activa el calendario*/
            buttonImage: "../images/calendar.gif", /*Muestra la imagen que representará al boton de calendario*/
            buttonImageOnly:true,
            showButtonPanel:true,
        });
    </script>
<!--contraseña: nathalyo-->
<!--   sotfware y sistemas del peru 20567230300-->
    <!--#http://www.htmlquick.com/es/-->
</html>