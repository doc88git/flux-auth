# Flux Entity Permission
Biblioteca para implementação de controle de acesso por entidades em aplicações Laravel.

# Requisitos
* Laravel >= 6.0

# Instalação

* Execute o comando abaixo na raiz do projeto para adicionar o pacote à aplicação Laravel:

```php 
    composer require doc88/flux-entity-permission
```

* Na lista de *providers* no arquivo *config/app.php* adicione:

```php     
    'providers' => [
        ...
        Doc88\FluxEntityPermission\FluxEntityPermissionServiceProvider::class,
    ]
```

* Execute o comando abaixo na raiz de seu projeto para publicar o novo provider

```php 
    php artisan vendor:publish
```

* Rode as migrations

```php 
    php artisan migrate
```

* Na sua Model de Usuários adicione as seguintes linhas:

```php     
    use Doc88\FluxEntityPermission\Traits\HasEntityPermissions;

    class User {
        use HasEntityPermissions;
    }
```
# Utilização

## Classe Doc88\FluxEntityPermission\EntityPermission
Classe usada para Listar, Registrar, Verificar e Revogar permissões à entidades.

* **Listar Entidades das Permissões de um Usuário**
```php
    // Entidades as quais o usuário possui acesso
    EntityPermission::list($user);

    // Especificando qual é a entidade que deseja listar
    EntityPermission::list($user, 'App\Empresa');

    /**
     * Retorno: array
    */
```

* **Listar IDs das Entidades das Permissões de um Usuário**
```php
    // Ids das entidades as quais o usuário possui acesso
    EntityPermission::idList($user, 'App\Empresa');

    /**
     * Retorno: array
    */
```

* **Verifica a Permissão de um Usuário à uma Entidade**
```php
    // A entidade que deseja acessar
    $empresa = Empresa::find(1);
    
    // Verificando se o usuário possui acesso a entidade
    EntityPermission::has($user, $empresa);
    
    /**
    * Retorno: true ou false
    */
    
```

* **Registra permissão à uma Entidade para um Usuário**
```php
    // A entidade que deseja acessar
    $empresa = Empresa::find(1);
    
    // Concede permissão à entidade para o Usuário
    EntityPermission::register($user, $empresa);
    
    /**
    * Retorno: true ou false
    */
```

* **Revoga permissão à uma Entidade de um Usuário**
```php
    // A entidade que deseja acessar
    $empresa = Empresa::find(1);
    
    // Revoga permissão à entidade do Usuário
    EntityPermission::revoke($user, $empresa);

    /**
    * Retorno: true ou false
    */
    
```

## Utilizando a Model do Usuário
É possível Listar, Registrar, Verificar e Revogar permissões à entidades usando a classe do Usuário.

* **Listar Permissões do Usuário**
```php
    $user = User::find(1);
    
    // Entidades as quais o usuário possui acesso
    $user->listEntityAccess();

    // Especificando qual é a entidade que deseja listar
    $user->listEntityAccess('App\Empresa');

    /**
     * Retorno: array
    */
```
* **Verifica a Permissão do Usuário à uma Entidade**
```php

    $user = User::find(1);

    // A entidade que deseja acessar
    $empresa = Empresa::find(1);
    
    // Verificando se o usuário possui acesso a entidade
    $user->hasEntityAccess($empresa);
    
    /**
    * Retorno: true ou false
    */
    
```
* **Registra permissão à uma Entidade para o Usuário**
```php
    $user = User::find(1);

    // A entidade que deseja acessar
    $empresa = Empresa::find(1);
    
    // Concede permissão à entidade para o Usuário
    $user->registerEntityAccess($empresa);
    
    /**
    * Retorno: true ou false
    */
```

* **Revoga permissão à uma Entidade do Usuário**
```php    
    $user = User::find(1);

    // A entidade que deseja acessar
    $empresa = Empresa::find(1);
    
    // Revoga permissão à entidade do Usuário
    $user->revokeEntityAccess($empresa);

    /**
    * Retorno: true ou false
    */
    
```
