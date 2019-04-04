<?php
$userid = "2813446918";
$accessToken = "2813446918.1677ed0.409a2c4a8d7e46eca33ba9aa33358b43";

// Retornando a URL personalizada
function fetchData($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$resultado = curl_exec($ch);
	curl_close($ch);
	return $resultado;
}

// Recebendo dados da API em json
$resultado = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
$resultado = json_decode($resultado);
// print_r($resultado); // Retorna a um json dos dados da API para identificação dos elementos

$limite = 9; // Total de imagens mostradas
$i = 0;

foreach ($resultado->data as $post):
  if ($i < $limite ): 
    
    echo '<a href="' . $post->link . '" target="_blank"><img src="' . $post->images->standard_resolution->url . '" width="500" height="500"></a>';
    
  $i ++; endif;
endforeach; ?>