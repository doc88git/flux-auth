# Doc88 / Flux

Biblioteca para integrações de aplicações Laravel utilizando o Flux / Doc88 .

# Instalação

 * Execute o comando *composer require doc88/flux*
 * Adicione *Doc88\Flux\FluxServiceProvider* aos providers em *config/app.php*
 * Execute o comando *php artisan vendor:publish*

# Utilização

## Classe Doc88\Flux\Authorization

Classe para realizar funções de Auth no Flux. Os métodos para integração são:

 * *Login* :
    ```php
        Auth::login('moacir.junior@doc89.com.br','123456','comerc','zordon');
    ```