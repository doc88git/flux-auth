-- Flux Auth --

Componente para Autenticação e Permissionamento utilizando o Flux.

-- Instalação --

Realize as alterações abaixo em seu arquivo composer.json e então execute o comando composer update.

...
"require": {
    ...
    "flux/auth": "^1.0.0"
},
...
"repositories": [
    {
        "type": "vcs",
        "url": "https://gitlab-cloud.doc88.com.br/flux/flux-auth.git"
    }
]
...

-- Utilização --

A classe Flux\Auth\Auth deve ser utilizada para realização das autenticações.