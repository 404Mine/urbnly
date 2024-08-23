<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($customer): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($customer, User $model): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($customer): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($customer, User $model): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($customer, User $model): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($customer, User $model): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($customer, User $model): bool
    {
        return $customer->isAdmin();
    }
}
