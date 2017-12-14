<?php

spl_autoload_register(function($class_name){

	$nomeArquivo = "class".DIRECTORY_SEPARATOR.$class_name.".php";

	if(file_exists($nomeArquivo)){
		
		require_once($nomeArquivo);

	}
});

?>