<?php
// Funciones para iterar los directorio y asociar el nombre del archivo con el titulo

// Obtiene el titulo del archivo dado
function titulo_pagina($directorio, $archivo) {
	
	$ultima_linea = exec('grep "<title>*" '.dirname(__FILE__).'/../'.$directorio.'/'.$archivo);
	$res = preg_match ("/<title>(.*)<\/title>/siU", $ultima_linea, $coincidencia);

	if (! $res)
		return null;
		
	// Remueve los espacios
	$titulo = preg_replace ('/\s+/', ' ', $coincidencia[1]);
	$titulo = trim ($titulo);
	return $titulo;
}

// Relaciona el nombre del archivo con el titulo
function archivos_titulos($directorio)
{
	$archivos = scandir(dirname(__FILE__).'/../'.$directorio);
	$archivos_titulos = array();
	
	foreach($archivos as $archivo) {
		if (strpos($archivo, '.php') !== false)  // Nos aseguramos que sea un archivo php
			$archivos_titulos[$archivo] = titulo_pagina($directorio, $archivo);		
	}
	
	return $archivos_titulos;
}

// Crea las opciones del select
function options_for_select()
{
	// Las opciones del select
	$options = '';
	
	// Directorios de los siglos
	$directorios = array('sXV_anteriores', 'sXVI', 'sXVIII', 'sXIX', 'sXX');
	$arreglo_archivos_titulos = array();
	
	// Los itero para obtener todas las relaciones
	foreach ($directorios as $directorio)
		$arreglo_archivos_titulos[$directorio] = archivos_titulos($directorio);
	
	// El nombre del archivo solicitado
	$archivos = explode("/", $_SERVER['REQUEST_URI']);
	$archivo_actual = end($archivos);
	
	foreach ($arreglo_archivos_titulos as $siglo => $personajes)
	{
		$options.= "<optgroup label=\"$siglo\">";
		
		foreach ($personajes as $archivo => $personaje)
		{
			if ($archivo == $archivo_actual)
				$options.= "<option value=\"$siglo/$archivo\" selected=\"selected\">$personaje</option>";
			else
				$options.= "<option value=\"$siglo/$archivo\">$personaje</option>";
		}
		
		$options.= '</optgroup>';
	}
	
	return $options;
}

?>

<!DOCTYPE HTML>
<!--
	Halcyonic by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
--><head>
	<title>Curiosos y comprometidos</title>
	<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="stylesheet" href="../TIMELINE3/css/timeline.css" />
        <link rel="stylesheet" href="../assets/css/fuentes.css"/>
    
			<!-- Header -->
				
    <div id="header-wrapper">
					<header id="header" class="container">
						<div class="row">
							<div class="12u">

								<!-- Logo -->
							  <h1><a href="../index.html" id="logo">Curiosos y comprometidos</a></h1><br>
						      <h6>Una historia natural</h6>
                              <!-- Nav -->
									<nav id="nav">
									<select id="personajes">
										<?php echo options_for_select(); ?>
									</select>
									
                                    <a href="#">Buscador</a>
                                    </nav>
							</div>
						</div>
					</header>
				</div>
                
                <!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/skel-viewport.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
			
			<script>

				$(document).ready(function(){
					$(document).on('change', '#personajes', function(){
						var pathname = window.location.pathname;
						var split_pathname = pathname.split('/');

						// Quito las dos ultimas posiciones y pongo el valor del select que contiene la carpeta y nombre de archivo
						split_pathname.splice(-1,1)
						split_pathname.splice(-1,1)
						split_pathname.push($(this).val());
						var new_path = split_pathname.join("/");
						window.location.replace(new_path);
						return false
					});	
				});

			</script>
			