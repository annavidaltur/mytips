<?php 

$path = '';
$old = '';
$new = '';

echo 'Scanning ' . $path . PHP_EOL;

if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
        if ('.' === $file) continue;
        if ('..' === $file) continue;
		
		$content = file_get_contents($path . $file) . PHP_EOL;
		
		if (strpos($content, $old) !== false) {
			$content = str_replace($old, $new, $content);  
			file_put_contents($path . $file, $content);
			echo $file . ' replaced' . PHP_EOL;
		}
	}     
	closedir($handle);
}
echo  '-- END --' . PHP_EOL;
?>