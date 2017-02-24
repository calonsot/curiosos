<?php
// Funciones para iterar los directorio y asociar el nombre del archivo con el titulo

// Obtiene el titulo del archivo dado
function titulo_pagina($directorio, $archivo, $ruta) {

	$ultima_linea = exec('grep "<title>*" '.$ruta.$directorio.'/'.$archivo);
	$res = preg_match ("/<title>(.*)<\/title>/siU", $ultima_linea, $coincidencia);

	if (! $res)
		return null;

		// Remueve los espacios
		$titulo = preg_replace ('/\s+/', ' ', $coincidencia[1]);
		$titulo = trim ($titulo);
		return $titulo;
}

// Relaciona el nombre del archivo con el titulo
function archivos_titulos($directorio, $ruta)
{
	$archivos = scandir($ruta.$directorio);
	$archivos_titulos = array();

	foreach($archivos as $archivo) {
		if (strpos($archivo, '.php') !== false)  // Nos aseguramos que sea un archivo php
			$archivos_titulos[$archivo] = titulo_pagina($directorio, $archivo, $ruta);
	}
	
	asort($archivos_titulos);
	return $archivos_titulos;
}

// Crea las opciones del select
function options_for_select($ruta)
{
	// Las opciones del select
	$options = '';

	// Directorios de los siglos
	$directorios = array('sXV_anteriores', 'sXVI', 'sXVIII', 'sXIX', 'sXX', 'sociedades');
	$arreglo_archivos_titulos = array();

	// Los itero para obtener todas las relaciones
	foreach ($directorios as $directorio)
		$arreglo_archivos_titulos[$directorio] = archivos_titulos($directorio, $ruta);

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