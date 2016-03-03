<?php 
# Cargamos la librer�a dompdf.
require_once 'dompdf/dompdf_config.inc.php';
 
# Contenido HTML del documento que queremos generar en PDF.

	final class generarPDF
	{
		static public function cargarDocumento($html, $nombre, $salida, $orientacion = 'horizontal')
		{
			//$html = file_get_contents('http://localhost/mercal/index.php?ctrl=almacen&acc=mostAlma');
			//$html = file_get_contents('http://localhost/mercal/index.php?ctrl=entrada&acc=listado');
			 
			# Instanciamos un objeto de la clase DOMPDF.
			$mipdf = new DOMPDF();
			 
			# Definimos el tama�o y orientaci�n del papel que queremos. 
			# O por defecto tomar� el que est� en el fichero de configuraci�n. // portrait
			if($orientacion == 'horizontal')
			{
				$mipdf ->set_paper("A4", "landscape");
			}
			elseif($orientacion == 'vertical')
			{
				$mipdf ->set_paper("A4", "portrait");
			}
			
			$html = preg_replace('/�/', '&aacute;', $html);
			$html = preg_replace('/(�)/', '&Aacute;', $html);
			$html = preg_replace('/�/', '&eacute;', $html);
			$html = preg_replace('/(�)/', '&Eacute;', $html);
			$html = preg_replace('/�/', '&iacute;', $html);
			$html = preg_replace('/(�)/', '&Iacute;', $html);
			$html = preg_replace('/�/', '&oacute;', $html);
			$html = preg_replace('/(�)/', '&Oacute;', $html);
			$html = preg_replace('/�/', '&uacute;', $html);
			$html = preg_replace('/(�)/', '&Uacute;', $html);
			$html = preg_replace('/(�)/', '&ntilde;', $html);
			$html = preg_replace('/(�)/', '&Ntilde;', $html);
			
			# Cargamos el contenido HTML.
			$mipdf ->load_html(utf8_decode($html));
					
			# Renderizamos el documento PDF.
			$mipdf ->render();
			 
			# Enviamos el fichero PDF al navegador.
			//$mipdf ->stream($nombre . '.pdf');
		
			if($salida == 'guardar')
			{
				$output = $mipdf->output();
				file_put_contents($nombre . '.pdf', $output);
			}
			elseif($salida == 'descargar')
			{
				$mipdf ->stream($nombre . '.pdf');
			}
		}
	}