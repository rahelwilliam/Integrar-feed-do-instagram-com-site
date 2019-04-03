# Integrar feed do instagram com website
Este projeto tem o intuito de auxiliar o desenvolvedor na integração dos feeds do instagram com o website. 

## Demos

* [Demo via JS (codepen)](https://codepen.io/rahelwilliam/pen/OGMXbR).
* [Demo via JS (jsfiddle)](https://jsfiddle.net/rahelwilliam/bg5jcu4w/22/).

## O que é preciso para implementar?
Para esta função é possível realizar duas formas de integração, conforme passos abaixo:

### 1 - API de integração do instagram

Siga o passo a passo do [tutorial de como gerar sua API no instagram](http://www.tokdigital.cc/desenvolver-site/api/mostrar-feed-instagram-site/).

### 2.a - Integração via JS
A primeira forma de integração é via JS, utilizando a biblioteca do [Instafeed](http://instafeedjs.com).

* Faça download da biblioteca [Instafeed](http://instafeedjs.com) ou realize a chamada da biblioteca direto do site `<script type="text/javascript" src="https://raw.githubusercontent.com/stevenschobert/instafeed.js/master/instafeed.min.js"></script>`.

* Em seguida adicione a chamada da função `Instafeed` (*[conforme função de exemplo abaixo](#função-de-exemplo-no-js)*).

* Adicione o `userId`, `limit`, `accessToken` e `template` (*[conforme função de exemplo abaixo](#função-de-exemplo-no-js)*).

* Por fim, crie uma div com id `instafeed` para incorporar o feed do instagram.

#### Qual comando será usado do JS?
O comando usado para executar essa função será o `Instafeed.run`.

#### Função de Exemplo no JS
Caso você já seja experiente e queira simplesmente utilizar a função sem seguir o passo a passo, poderá utilizar o script:

```js
// Criando uma váriavel chamada "userFeed" para definir os parâmetros
var userFeed = new Instafeed({
  get: 'user',
  sortBy: 'most-recent',
  // userId é os primeiros numerais gerados pelo token até o ponto
  userId: '1234567890',
  limit: 9,
  template: '<a href="{{link}}" class="feed-a" target="_blank"><img src="{{image}}" class="feed-img" /></a>',
  // O Token é gerado após criação da API do instagram
  accessToken: '1234567890.1677ed0.409a2c4a8d7e46eca33ba9aa33358b43'
});
// Executando a variável "userFeed" com a função "run();"
userFeed.run();
```

#### Html de exemplo
Mesmo sendo uma tag simples, veja abaixo um exemplo da div html a ser criada:

```html
<div id="instafeed"></div>

```

### 2.b - Integração via PHP
A segunda forma de integração é utilizando o PHP.

* Crie uma variável para o `userid` (*userId é os primeiros numerais gerados pelo token até o ponto*). Ex: `<?php $userid = "1234567890"; ?>`.

* Em seguida crie uma variável para o `accessToken` (*O Token é gerado após criação da API do instagram*). Ex: `<?php $accessToken = "1234567890.1677ed0.409a2c4a8d7e46eca33ba9aa33358b43"; ?>`.

* Agora é criado a função `fetchData`, que deverá definir os parâmetros da nossa URL e retornará esses parâmetros uma variável chamada `$resultado` (*[conforme função de exemplo abaixo](#função-de-exemplo-no-php)*).

* Depois alteramos a variável `$resultado`, utilizando a função `fetchData` (*criada anteriormente*) e mesclando os dados de `userid` e `accessToken`.

* O próximo passo é criar um json do resultado retornado, para isso declaramos novamente a variável `$resultado`, usando a função `json_decode` no `$resultado` retornado anteriormente.

* Por fim, geramos um `foreach` com os dados retornados no json (*[conforme função de exemplo abaixo](#função-de-exemplo-no-php)*).

#### Qual comando será usado do php?
Para realizar estas tarefas iremos utilizar alguns comandos, tais como `curl_init` (*que deve inicializar uma sessão com a URL indicada e retorna um id para uso da próxima função*), `curl_setopt` (*utilizada para definir os parâmetros de transferência da URL*), `curl_exec` (*é obrigatório chamar essa função após o uso das demais citadas anteriorment*), `curl_close` (*responsável por finalizar a sessão de URL e remover a variável $ch após seu uso*) e por fim o `json_decode` que deverá retornar uma API em json dos dados, coforme URL, CH e Resultado gerado na variável anterior.

#### Função de Exemplo no PHP
Caso você já seja experiente e queira simplesmente utilizar a função sem seguir o passo a passo, poderá utilizar:

```php
<?php
$userid = "1234567890";
$accessToken = "1234567890.1677ed0.409a2c4a8d7e46eca33ba9aa33358b43";

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
$i = 0; ?>

<?php foreach ($resultado->data as $post): ?>
	<?php if ($i < $limite ): ?>
		<a href="<?= $post->link ?>" target="_blank"><img src="<?= $post->images->standard_resolution->url ?>" width="500" height="500"></a>
		<?php $i ++;

// Iniciando um "foreach" para separar os dados do json que estão dentro o object "data"
foreach ($resultado->data as $post):
  // Adicionando um "if" para mostrar as imagens enquando a contagem for menor que o limite indicado (iniciando em 0)
  if ($i < $limite ): ?>
    
    <!-- Criando o elemento que será retornado (em nosso exemplo retornar um link com a imagem dentro) -->
	  <a href="<?= $post->link ?>" target="_blank"><img src="<?= $post->images->standard_resolution->url ?>" width="500" height="500"></a>
    
  <?php $i ++; endif;
endforeach; ?>
```

## Autor
Rahel William

## License
ISC
