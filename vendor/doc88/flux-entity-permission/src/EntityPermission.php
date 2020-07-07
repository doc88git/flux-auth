<?php

namespace Doc88\FluxEntityPermission;

use Doc88\FluxEntityPermission\Services\EntityPermissionService;

class EntityPermission {

    /**
     * Lista as entidades as quais um usuário possui permissão
     */
    public static function list($user, $entity = null)
    {   
        return (new EntityPermissionService($entity, $user))->listEntitiesHasAccess();
    }

    /**
     * Lista os ids das entidades as quais um usuário possui permissão
     */
    public static function idList($user, $entity)
    {   
        return (new EntityPermissionService($entity, $user))->listIdsEntitiesHasAccess();
    }

    /**
     * Verifica se o usuário possui permissão para tal entidade
     */
    public static function has($user, $entity)
    {   
        return (new EntityPermissionService($entity, $user))->checkIfHasAccess();
    }

    /**
     * Registra um novo vinculo de permissão entre um usuário e uma permissão
     */
    public static function register($user, $entity)
    {
        return (new EntityPermissionService($entity, $user))->registerNewEntityAccess();
    }

    /**
     * Revoga a permissão a uma entidade de um usuário
     */
    public static function revoke($user, $entity)
    {   
        return (new EntityPermissionService($entity, $user))->deleteEntityAccess();
    }    
}
