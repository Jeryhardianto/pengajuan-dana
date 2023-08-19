<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // if($user->hasPermissionTo('View permission') || $user->hasRole(['finance'])){
        //     return true;
        // }
        return false;

        // return $user->hasRole(['finance','user','pimpinan']);
        // return $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        // if($user->hasPermissionTo('View permission') || $user->hasRole(['finance'])){
        //     return true;
        // }
        // return false;
        return $user->hasRole(['finance','user','pimpinan']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // if($user->hasPermissionTo('Add permission')){
        //     return true;
        // }
        // return false;
        // return true;
        return  $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        // if($user->hasRole(['finance'])){
        //     if($user->hasPermissionTo('Update permission')){
        //         return true;
        //     }
        // }else{
        //     return false;
        // }
        // return true;
        return $user->hasRole(['finance','user','pimpinan']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        // if($user->hasPermissionTo('Delete permission')){
        //     return true;
        // }
        // return false;
        return  $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        return  $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return  $user->hasRole(['finance']);
    }
}
