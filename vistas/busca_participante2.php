<?php 
// if (!defined('CONTROLADOR')) exit;
    define('CONTROLADOR', TRUE);
    require_once '../modelos/participante.php';
    $participante = new Participante();
    $dni = (isset($_POST['Dni'])) ? $_REQUEST['Dni'] : null;
    $participante->setDni($dni);
    if ($dni) {
        $participante = Participante::buscarPorDni($dni);
		if (! $participante){ //verifica que si no encontrado un DNI regresa a su index
			header('Location: \ulf');		
		}
		session_start();
		$_SESSION['Dni'] = $participante->getDni($dni);
    }else{
    header('Location: \ulf');
    }
//busca el estado del participante
    $codEstado = $participante->getEstado();
    $estadopart = new Estados();
    $estadopart->setidEstado($codEstado);
    if ($codEstado){
        $estadopart = Estados::buscarEstado($codEstado);
    }

//busca la zona del participante
    $zonapart= new Zonas;
    $zonapart->setidZonas($participante->getsector());
    if($participante->getsector()){
        $zonapart = Zonas::buscarZonas($participante->getsector());
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
                                <span class="field">Prioridad</span>
                                <span class="field">Sector</span>
                            </div>
                            <div class=""> 
                                <span class="field"><?php echo $participante->getDni() ?></span>
                                <span class="field"><?php echo utf8_encode($participante->getPaterno()) . " " . utf8_encode($participante->getMaterno()) . " " . utf8_encode($participante->getNombres()) ?></span>
                                <span class="field"><?php echo utf8_encode($participante->getDireccion()) ?></span>
                                <span class="field"><?php echo $participante->getPrioridad() ?></span>
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
</html>