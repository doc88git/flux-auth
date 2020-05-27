# Doc88 / Flux

Biblioteca para integrações de aplicações Laravel utilizando o Flux / Doc88 .

# Instalação

 * Execute o comando *composer require doc88/flux*
 * Adicione *Doc88\Flux\FluxServiceProvider* aos providers em *config/app.php*
 * Execute o comando *php artisan vendor:publish*

# Utilização

## Classe Doc88\Flux\Authorization

Classe para realizar funções de Auth no Flux. Os métodos para integração são:

 * **Login** - Função para realizar Login através do Flux.
    ```php
        Authorization::login( $email, $senha, $conta, $produto );
    ```
    * **Parâmetros :**
        * *email :* Email do usuário no Flux
        * *senha :* Senha do usuário no Flux
        * *conta :* Slug identificador da conta / empresa no Flux. Exemplo: *comerc*
        * *produto :* Slug identificador do produto / aplicativo no Flux. Exemplo: *zordon*
    * **Retorno :**
        Em caso de sucesso, o retorno será um objeto json, como no exemplo abaixo.
        ```json
            {
                "data": {
                    "id": "b1041a3e-d196-4dca-9b35-37278b6511cf",
                    "type": "Bearer",
                    "token": "ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6STFOaUo5LmV5SnBjM01pT2lKR2JIVjRJaXdpYVdGMElqb2lNakF5TUMwd05TMHhPRlF4T1Rvek16bzBOU3N3TURvd01DSXNJbVZoZENJNklqSXdNakF0TURVdE1UaFVNVGs2TXpNNk5EVXJNREE2TURBaUxDSjFjMlZ5WDJsa0lqb2lOREE1T0dJMU5HVXRZekZpWXkwME5UTTVMV0ZqTURndE9EVXdaVFEzWWpGaVlqSTNJaXdpWVdOamIzVnVkRjlwWkNJNklqWXpabVUxTjJRM0xXUTRZMll0TkRJek1DMWlOamxrTFRBeU5tVXpORGxpWW1FNE55SXNJbkJ5YjJSMVkzUmZhV1FpT2lKaVkyVm1ZakE0WkMwd09EZGxMVFJqTkRVdE9UQmxOQzAyWkdWa01tRmlaRFkzTlRVaWZRLlZjU0x2NlpENWljZjIxWXp4bjVqS0plWHNwQXNBNkNYZUw0aHNzNl9NaEE=",
                    "expires_at": "2020-06-17T19:33:45.000000Z",
                    "created_at": "2020-05-18T19:33:45.000000Z",
                    "account": {
                        "id": "63fe57d7-d8cf-4230-b69d-026e349bba87",
                        "name": "Comerc",
                        "slug": "comerc",
                        "active": true,
                        "created_at": "2020-04-14T19:59:43.000000Z",
                        "updated_at": "2020-04-14T19:59:43.000000Z",
                        "addresses": []
                    },
                    "product": {
                        "id": "bcefb08d-087e-4c45-90e4-6ded2abd6755",
                        "name": "Zordon",
                        "slug": "zordon",
                        "active": true,
                        "created_at": "2020-04-14T17:45:35.000000Z",
                        "updated_at": "2020-04-14T17:45:35.000000Z",
                        "modules": []
                    },
                    "user": {
                        "id": "4098b54e-c1bc-4539-ac08-850e47b1bb27",
                        "name": "Moacir Durazzo Junior",
                        "email": "moacir.junior@doc89.com.br",
                        "created_at": "2020-04-09T20:02:17.000000Z",
                        "updated_at": "2020-04-09T20:02:17.000000Z"
                    }
                }
            }
        ```
* **Module** - Função para verificar se um usuário possui acesso a um módulo de uma aplicação/produto.
    ```php
        Authorization::module( $token, $account, $product, $module )
    ```
    * **Parâmetros :**
        * *token :* Token de Login do Usuário, recebido através da função *Login*
        * *conta :* Slug identificador da conta / empresa no Flux. Exemplo: *comerc*
        * *produto :* Slug identificador do produto / aplicativo no Flux. Exemplo: *zordon*
        * *module :* Slug identificador do módulo no Flux. Exemplo: *monitoria*
    * **Retorno :**
        Em caso de sucesso, o retorno será um objeto json, como no exemplo abaixo.
        ```json
            {
                "permission": true
            }
        ```
* **Permission** - Função para verificar se um usuário possui acesso a uma ação específica de uma aplicação/produto.
    ```php
        Authorization::permission( $token, $account, $product, $action )
    ```
    * **Parâmetros :**
        * *token :* Token de Login do Usuário, recebido através da função *Login*
        * *conta :* Slug identificador da conta / empresa no Flux. Exemplo: *comerc*
        * *produto :* Slug identificador do produto / aplicativo no Flux. Exemplo: *zordon*
        * *action :* Slug identificador da ação no Flux. Exemplo: *cadastro-de-alarme*
    * **Retorno :**
        Em caso de sucesso, o retorno será um objeto json, como no exemplo abaixo.
        ```json
            {
                "permission": true
            }
        ```