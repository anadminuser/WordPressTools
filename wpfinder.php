<?php
$file_to_search = "version.php";
search_file('.',$file_to_search);
function search_file($dir,$file_to_search){
    $files = scandir($dir);
    foreach($files as $key => $value){

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path) && (strpos($path, 'wp-includes') !== false)) {

            if($file_to_search == $value){
                $contents = file_get_contents($path);
                $beginninng_fluff = strpos($contents, "$wp_version = '") + 4;
                $end_fluff = strpos($contents, "';", $beginninng_fluff);
                $version = substr($contents, $beginninng_fluff, $end_fluff - $beginninng_fluff);
                $path = str_replace('wp-includes/version.php', '<br>', $path);
                echo $version ." - ".$path;
                break;
            }
        } else if($value != "." && $value != "..") {
            search_file($path, $file_to_search);
          }  
    }
}

?>
