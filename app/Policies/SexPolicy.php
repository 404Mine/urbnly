<?php

namespace App\Policies;

use App\Models\Sex;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;

class SexPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($customer): bool
    {
        return $customer->isSeller() || $customer->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($customer, Sex $sex): bool
    {
        return $customer->isSeller() || $customer->isAdmin();
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
    public function update($customer, Sex $sex): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($customer, Sex $sex): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny($customer): bool
    {
        return $customer->isAdmin() || $customer->isSeller();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($customer, Sex $sex): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can bulk restore the model.
     */
    public function restoreAny($customer): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($customer, Sex $sex): bool
    {
        return $customer->isAdmin();
    }

    /**
     * Determine whether the user can permanently bulk delete the model.
     */
    public function forceDeleteAny($customer): bool
    {
        return $customer->isAdmin();
    }
}
