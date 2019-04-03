# Integrar feed do instagram com website
Este projeto tem o intuito de auxiliar o desenvolvedor na integração dos feeds do instagram com o website. 

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

## Autor
Rahel William

## License
ISC
