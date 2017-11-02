<?php 
// if (!defined('CONTROLADOR')) exit;
    define('CONTROLADOR', TRUE);

    require_once '../modelos/participante.php';
    //echo "<p>vamos avanzando</p></br>";
    $participante = new Participante();
    $dni = (isset($_POST['Dni'])) ? $_REQUEST['Dni'] : null;
    $participante->setDni($dni);
    //echo $participante->getDni();
    //comensamoa a buscar los datos con el DNI
    if ($dni) {
        $participante = Participante::buscarPorDni($dni);
		session_start();
		$_SESSION['Dni'] = $participante->getDni($dni);
    }else{
    header('Location: \ulf');
    }
//busca el estado del participante
    $codEstado = $participante->getEstado();
//    echo $participante->getEstado();
    $estadopart = new Estados();
    $estadopart->setidEstado($codEstado);
//    echo $estadopart->setidEstado($codEstado);
    if ($codEstado){
//        echo $codEstado;
        $estadopart = Estados::buscarEstado($codEstado);
//        echo $estadopart->getidEstado();
 //       echo $estadopart->getdescEstado();
    }else{
        echo "NO SE ENCUENTRA EL ESTADO";
    }
//busca la zona del participante
    $zonapart= new Zonas;
    $zonapart->setidZonas($participante->getsector());
    if($participante->getsector()){
        $zonapart = Zonas::buscarZonas($participante->getsector());
    }else{
        echo "NO SE ENCONTRO LA ZONA DEL PARTICIPANTE";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modifica el Estado del Participante</title>
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
        <script type="text/javascript">
			//link de referencia http://www.hellogoogle.com/envio_datos_post_sin/
			var form = document.createElement("form"); // crear un form
			with(form) {
			setAttribute("name", "myform"); //nombre del form
			setAttribute("action", ""); // action por defecto
			setAttribute("method", "post"); // method POST }

			var input = document.createElement("input"); // Crea un elemento input
			with(input) {
			setAttribute("name", "theInput"); //nombre del input
			setAttribute("type", "hidden"); // tipo hidden
			setAttribute("value", ""); // valor por defecto
			}

			form.appendChild(input); // añade el input al formulario
			document.getElementsByTagName("body")[0].appendChild(form); // añade el formulario al documento
			window.onload=function(){
			var my_links = document.getElementsByTagName("a");
			for (var a = 0; a < my_links.length; a++) {
			if (my_links[a].name=="post") my_links[a].onclick = function() {
			document.myform.action=this.href;
			document.myform.theInput.value=this.title;
			document.myform.submit();
			return false;}
			}}
		</script>
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <section class="topbar">
                    <div class="center">
                        <p class="sede">Plataforma Virtual ULF - Seguimiento a Participante</p>
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
                        <li><a href="http://virtual.munipuentepiedra.gob.pe/">Plataforma Virtual</a></li>
                        <li><span><em>Estado del Participante</em></span></li>
                    </ul>
                    <div class="content_int">
                        <header><h2>Estado del Participante</h2></header>
						<form method="POST" action="../vistas/busca_participante2.php" class="form_box form">
							<h4>Buscar Participante</h4>
							<div class="fields" id="div1">
								<label for="" class="label">DNI del Participante : </label>
								<span class="field">
									<input type="text" class="form-control" placeholder="Ingrese el DNI del Participante" name="Dni" value="<?php echo $participante->getDni() ?>" required>
								</span>
							</div>
							 <p class='action'>
                                <input type="submit" id="submit" name="submit" value="Buscar" class="btn" >
                                <input type="reset" id="submit" name="submit" value="Limpiar" class="btn" >
                            </p>  
						</form>
                    </div>
                    <div class="content_int">
                        <div class="mock-table">
                            <div class=""> 
                                <span class="field">Nro DNI</span>
                                <span class="field">Datos</span>
                                <span class="field">Direcci&oacute;n</span>
                                <span class="field">Estado</span>
                                <span class="field">Sector</span>
                            </div>
                            <div class=""> 
                                <span class="field"><?php echo $participante->getDni() ?></span>
                                <span class="field"><?php echo utf8_encode($participante->getPaterno()) . " " . utf8_encode($participante->getMaterno()) . " " . utf8_encode($participante->getNombres()) ?></span>
                                <span class="field"><?php echo utf8_encode($participante->getDireccion()) ?></span>
                                <span class="field"><?php echo $estadopart->getdescEstado() ?></span>
                                <span class="field"><?php echo $zonapart->getdescZonas() ?></span>
                                <span class="social-icons icon-circle icon-zoom list-unstyled list-inline"><a href="./estado_participante.php" ><i class="fa fa-pencil" ></i></a></span>
                            </div>
                        </div>
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
        $("#fecha1").datepicker({
            changeMonth:true,   /*activa el selector de mes*/
            changeYear:true,    /*activa el selector de año*/
            showOn: "button",   /*activa el boton que activa el calendario*/
            buttonImage: "./images/calendar.gif", /*Muestra la imagen que representará al boton de calendario*/
            buttonImageOnly:true,
            showButtonPanel:true,
        });
    </script>
<!--contraseña: nathalyo-->
<!--   sotfware y sistemas del peru 20567230300-->
    <!--#http://www.htmlquick.com/es/-->
</html>