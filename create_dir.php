<?php 
$path = ".";
$dirs_to_create = array(
	'R/calendario_concentracion',
	'R/calendario_dispersion',
	'R/distribucion_temporal',
	'R/rosa',
	'R/rosa_contaminantes',
	'R/rosa_contaminantes_estacional',
	'R/rosa_estacional',
	'R/rosa_percentil'
);

$permissions = 0777;

$exclude = array(
	'informes',
	'logo',
	'processing'
);

echo 'Create ' . rtrim(implode(', ', $dirs_to_create), ', ') . ' in ' . $path . PHP_EOL;

if ($handle = opendir($path)) {
	// Abrimos $path y leemos el contenido
    while (false !== ($file = readdir($handle))) {
		// Filtramos el . y ..
        if ('.' === $file) continue; 
        if ('..' === $file) continue;
		
		// Comprobamos que sea un directorio y que no esté en la lista de excluidos
		if (is_dir($file) && !in_array($file, $exclude)){
			// echo $file . PHP_EOL;
			foreach($dirs_to_create as $dir){
				// Creamos los directorios si no existen ya
				if(!file_exists($dir) && !is_dir($dir)){
					mkdir($file . '/' . $dir . '/');
					chmod($file . '/' . $dir . '/', $permissions);
					echo $path . '/' . $file . '/' . $dir . ' created with permission ' . $permissions . PHP_EOL;
				}								
			}			
		}
			
	}     
	closedir($handle);
}
echo 'Finished!';
?>