<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // return $user->hasRole(['finance']);
        // if($user->hasPermissionTo('View user') || $user->hasRole(['finance'])){
        //     return true;
        // }
        // return false;
        return $user->hasRole(['finance','user','pimpinan']);
        // return $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // return $user->hasRole(['finance','user','pimpinan']);
        // if($user->hasPermissionTo('View user') || $user->hasRole(['finance'])){
        //     return true;
        // }
        // return false;
         if($user->id == $model->id){
            return $user->hasRole(['finance']);
        }else{
            return false;
        }
        // return $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // return  $user->hasRole(['finance']);
        // if($user->hasPermissionTo('Add user')){
        //     return true;
        // }
        // return false;
        return $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {

        // if($user->id == $model->id || $user->hasRole(['finance'])){
        //     if($user->hasPermissionTo('Update user')){
        //         return true;
        //     }
        // }else{
        //     return false;
        // }
        // return  $user->hasRole(['finance']);
        return $user->hasRole(['finance', 'user', 'pimpinan']);
   
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
        // return  $user->hasRole(['finance']);
        // if($user->hasPermissionTo('Delete user')){
        //     return true;
        // }
        // return false;
        return $user->hasRole(['finance','user','pimpinan']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return  $user->hasRole(['finance']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // return  $user->hasRole(['finance']);
        // if($user->hasPermissionTo('Delete user')){
        //     return true;
        // }
        // return false;
        return $user->hasRole(['finance','user','pimpinan']);
    }
}
