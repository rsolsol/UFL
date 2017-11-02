<!DOCTYPE html>
<html>
<head>
    <title>Grabar-Demandante</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    //funcion javascript en la cabecera del documento
	<script type="text/javascript">
	<!--
	function mostrarReferencia(){
	//Si la opcion con id Conocido_1 (dentro del documento > formulario con name fdemandante > y a la vez dentro del array de Conocido) esta activada
		if (document.fdemandante.Conocido[1].checked == true) {
		//muestra (cambiando la propiedad display del estilo) el div con id 'desdeotro'
			document.getElementById('desdeotro').style.display='block';
		//por el contrario, si no esta seleccionada
		} else {
		//oculta el div con id 'desdeotro'
			document.getElementById('desdeotro').style.display='none';
		}
	}
	-->
	</script>
</head>
<body>

	//se le asigna un name al formulario de contacto.
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="fdemandante">
		//inputs

		<p>A través de donde nos has conocido:<br />
			//importante llamar a la función
			<input type="radio" name="Conocido" value="Google" id="Conocido_0" onclick="mostrarReferencia();" checked/> Google
			<input type="radio" name="Conocido" value="Otros" id="Conocido_1" onclick="mostrarReferencia();" /> Otros
		</p>
	//div oculto
	<div id="desdeotro" style="display:none;">
	<p>Referencia de la oferta:</p>
	<p><input type="text" name="otro" class="input" /></p>
	</div>
	</form>
	

</body>
</html>
