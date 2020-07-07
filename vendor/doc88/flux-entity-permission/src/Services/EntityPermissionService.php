<?php

namespace Doc88\FluxEntityPermission\Services;

use Doc88\FluxEntityPermission\Models\EntityUser;

class EntityPermissionService {

    protected $entity;
    protected $user;

    public function __construct($entity, $user)
    {
        $this->entity = $entity;
        $this->user = $user;
    }

    public function checkIfHasAccess()
    {
        return $this->user->admin ? $this->user->admin :
            EntityUser::whereEntityId($this->entity->id)
                ->whereEntity(get_class($this->entity))
                ->whereUserId($this->user->id)
                ->exists();
    }

    public function listEntitiesHasAccess()
    {   
        $entity = $this->entity;

        $entities_user = EntityUser::when(!is_null($entity), function ($query) use ($entity) {
            return $query->where('entity', $entity);
        })->whereUserId($this->user->id)->get();

        $entities = [];

        if (!empty($entities_user)) {
            foreach ($entities_user as $entity_user) {
                $entity = $entity_user->entity::find($entity_user->entity_id);

                if (!empty($entity)) {
                    $entities[] = $entity;
                }
            }
        }

        return $entities;
    }

    public function listIdsEntitiesHasAccess()
    {
        return EntityUser::whereUserId($this->user->id)
        ->whereEntity($this->entity)
        ->get()
        ->keyBy('entity_id')
        ->keys()
        ->toArray();
    }

    public function registerNewEntityAccess()
    {
        return EntityUser::firstOrNew([
                'user_id' => $this->user->id,
                'entity_id' => $this->entity->id,
                'entity' => get_class($this->entity)
            ])
            ->save();
    }

    public function deleteEntityAccess()
    {
        return EntityUser::whereEntityId($this->entity->id)
            ->whereEntity(get_class($this->entity))
            ->whereUserId($this->user->id)
            ->delete();
    }
}