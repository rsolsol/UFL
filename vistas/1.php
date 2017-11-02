<?php if (!defined('CONTROLADOR')) exit; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Consulta Visita a Funcionarios</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
        <meta name="viewport" content="width=device-width; initial-scale=1">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/jquery-ui.min.css">
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/datepicker-es.js"></script>
        <script type="text/javascript">
			//se utiliza para cargar los paises.
            $("document").ready(function(){
                $("#naciones, #naciones2").load("modelos/funciones.php");
            })
        </script>
        <script type="text/javascript">
	<!--
		function mostrarReferencia(){
		//Si la opcion con id radio# (dentro del documento > formulario con name fdemandante > y a la vez dentro del array de tipo) esta activada
			if (document.fdemandante.tipo[0].checked == true) {
			//muestra (cambiando la propiedad display del estilo) el div con id 'div#'
				document.getElementById('div1').style.display='block';
				document.getElementById('div2').style.display='none';
			//por el contrario, si no esta seleccionada
			} else {
			//oculta el div con id 'div1' y muestra el div con id 'div2'.
				document.getElementById('div1').style.display='none';
				document.getElementById('div2').style.display='block';
			}
		}
		-->
	</script>
        
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <section class="topbar">
                    <div class="center">
                        <p class="sede">Plataforma virtual Procuradur&iacute;a - Registro de Demandante</p>
                    </div>
                </section>
                <section class="navbar">
                    <div class="center">
                        <h1 class="logoAyto"><a href="http://www.munipuentepiedra.gob.pe/"><img alt="Municipalidad de puente piedra" src="http://virtual.munipuentepiedra.gob.pe/consultatramite/img/logo_muni.png" style="height:48px;width:240px;margin-bottom:10px;"></a></h1>
                    </div>
                </section>
                <div class="banner">
                    <div class="center">
                        <img alt="" src="images/fondo.jpg">
                    </div>
                </div>
            </header>
            <section class="content">
                <div class="center">
                    <ul class="breadcrumbs">
                        <li><a href="http://www.munipuentepiedra.gob.pe/">Inicio</a></li>
                        <li><a href="http://virtual.munipuentepiedra.gob.pe/">Plataforma Virtual</a></li>
                        <li><span><em>Registro de demandante</em></span></li>
                    </ul>
                    <div class="content_int">
                        <header><h2>Registro de demandante</h2></header>
                        <form id="frm" method="post" action="../vistas/guarda_demandante.php" class="form_box form" name="fdemandante"><br>
                            <h4>Registar</h4>
                            <div class="fields" id='red123'>
                                <input type="radio" name="tipo" id="radio1" class="css-checkbox" value="<?php #echo $demandantes->getTipoPersona('1') ?>" onclick="mostrarReferencia();" checked />
                                <label for="radio1" class="css-label">Persona Natural</label>
                                <input type="radio" name="tipo" id="radio2" class="css-checkbox" value="<?php #echo $demandantes->getTipoPersona('1') ?>" onclick="mostrarReferencia();" />
                                <label for="radio2" class="css-label">Persona Jur&iacute;dica</label>	
                            </div>
                            <div class="fields" id="div1" style="display:;">
                                <label class="label">NACIONALIDAD : </label>
                                <span class="field">
                                    <select name="nacion" id="naciones">
                                        <option value="0">NACION</option>
									<?php
										//llama al cargado de paises
										require_once 'modelos/funciones.php';
									?>
                                    </select>
                                </span>
                                <label for="" class="label">TIPO DOCUMENTO : </label>
                                <span class="field" >
                                    <select name="t_dni" id="">
                                        <option value="<?php #$demandantes->getTipoDoc('1'); ?>">D.N.I.</option>
                                        <option value="<?php #$demandantes->getTipoDoc('2'); ?>">C.E.</option>
                                    </select>
                                </span>
                                <label for="" class="label">NRO DOCUMENTO : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese el # del DNI" value="<?php #$demandantes->setNroDniRuc() ?>" required>
                                </span>
                                <label for="" class="label">NOMBRES : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese los nombres del Demandante" value="<?php #echo $demandantes->getNombres(); ?>" required>
                                </span>
                                <label for="" class="label">APELLIDO PATERNO : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese el Apellido del Demandante" value="<?php #echo $demandantes->getApelPaterno(); ?>" required>
                                </span>
                                <label for="" class="label">APELLIDO MATERNO : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese el Apellido del Demandante" value="<?php #echo $demandantes->getApelMaterno(); ?>" required>
                                </span>
                                <label for="" class="label">SEXO : </label>
                                <span class="field">
                                    <select name="sexo" id="">
                                        <option value="<?php #$demandantes->getSexo('1'); ?>">HOMBRE</option>
                                        <option value="<?php #$demandantes->getSexo('2'); ?>">MUJER</option>
                                    </select>
                                </span>
                                <label for="" class="label">DIRECCIÓN : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese la Direcci&oacute;n Demandante" value="<?php #echo $demandantes->getDireccion(); ?>" required>
                                </span>
                                <label for="" class="label">FECHA DE NACIMIENTO : </label>
                                <span class="field">
                                    <input type="text" id="fecha1" name="fecha1" placeholder="dd/mm/yyyy" required>
                                </span>
                            </div>
							<div class="fields" id="div2" style="display:none;"> 
								<label class="label">NACIONALIDAD : </label>
                                <span class="field">
                                    <select name="nacion" id="naciones2">
                                        <option value="0">NACION</option>
                                    </select>
                                </span>	
                                <label for="" class="label">NRO DOCUMENTO : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese el # del DNI" value="<?php #echo $demandantes->getNroDniRuc(); ?>" required>
                                </span>	
                                <label for="" class="label">RAZON SOCIAL : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese los nombres del Demandante" value="<?php #echo $demandantes->getNombres(); ?>" required>
                                </span>
                                <label for="" class="label">DIRECCIÓN : </label>
                                <span class="field">
                                    <input type="text" class="form-control" placeholder="Ingrese la Direcci&oacute;n Demandante" value="<?php #echo $demandantes->getDireccion(); ?>" required>
                                </span>			
                            </div>
                            <p class='action'>
                                <input type="submit" id="submit" name="submit" value="Guardar" class="btn" >
                                <input type="reset" id="submit" name="submit" value="Limpiar" class="btn" >
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
                    <li><img src="images/logo_muni.gif"></li>
                </ul>
                <div class="stamp"><img alt="" src="images/blank.png"></div>
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
            buttonImage: "images/calendar.gif", /*Muestra la imagen que representará al boton de calendario*/
            buttonImageOnly:true,
            showButtonPanel:true,
        });
    </script>
<!--contraseña: nathalyo-->
<!--   sotfware y sistemas del peru 20567230300-->
    <!--#http://www.htmlquick.com/es/-->
</html>