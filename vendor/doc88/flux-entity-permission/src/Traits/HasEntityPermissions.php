<?php

namespace Doc88\FluxEntityPermission\Traits;

use Doc88\FluxEntityPermission\Services\EntityPermissionService;

trait HasEntityPermissions
{       
    /**
     * Lista as permissões de entidade do usuário
     */
    public function listEntityAccess($entity = null)
    {
        return (new EntityPermissionService($entity, $this))->listEntitiesHasAccess();
    }

    /**
     * Verifica se o usuário possui acesso a uma entidade
     */
    public function hasEntityAccess($entity)
    {   
        return (new EntityPermissionService($entity, $this))->checkIfHasAccess();
    }    

    /**
     * Registra uma nova permissão de entidade ao usuário
     */
    public function registerEntityAccess($entity)
    {   
        return (new EntityPermissionService($entity, $this))->registerNewEntityAccess();             
    }

    /**
     * Revoga uma permissão de entidade de um usuário
     */
    public function revokeEntityAccess($entity)
    {
        return (new EntityPermissionService($entity, $this))->deleteEntityAccess();
    }
}
