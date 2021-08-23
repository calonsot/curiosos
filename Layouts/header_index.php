<?php include 'funciones.php'; ?>

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
	<link rel="stylesheet" href="assets/css/main.css" />
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!--link rel="stylesheet" href="TIMELINE3/css/timeline.css" /-->
	<link rel="stylesheet" href="assets/css/fuentes.css"/>
	
	<!-- Header -->
	
	<div id="header-wrapper">
		<header id="header" class="container">
			<div class="row">
				<div class="12u">
					
					<!-- Logo -->
					<h1><img src="../curiosos/images/logo_curiosos_comprometidos.png" width="247" height="117" alt=""/></h1>
					<!--<h1><a href="#" id="logo">Curiosos y comprometidos</a></h1><br>
						<h6>Una historia natural mexicana</h6>-->
					<!-- Nav -->
					<nav id="nav">
						<select id="personajes">
							<option>--- Selecciona ---</option>
							<?php echo options_for_select(dirname(__FILE__).'/../'); ?>
						</select>
						
						<a href="#">Buscador</a>
					</nav>
				</div>
			</div>
		</header>
	</div>
	
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/skel-viewport.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>
	
	<script>
		
		$(document).ready(function(){
			$(document).on('change', '#personajes', function(){
				var pathname = window.location.pathname;
				var split_pathname = pathname.split('/');
				
				// Quito las dos ultimas posiciones y pongo el valor del select que contiene la carpeta y nombre de archivo
				split_pathname.splice(-1,1)
				split_pathname.push($(this).val());
				var new_path = split_pathname.join("/");
				window.location.replace(new_path);
				return false
			});
		});
	
	</script>
			
