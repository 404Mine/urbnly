<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    public function viewAny($customer): bool
    {
        return $customer->isAdmin() || $customer->isSeller();
    }

    public function view($customer, Order $order): bool
    {
        return $customer->isAdmin() || $customer->isSeller();
    }

    public function create($customer): bool
    {
        return $customer->isSeller();
    }

    public function update($customer, Order $order): bool
    {
        return $customer->isSeller();
    }

    public function delete($customer, Order $order): bool
    {
        return $customer->isSeller();
    }

    public function deleteAny($customer): bool
    {
        return $customer->isSeller();
    }

    public function restore($customer, Order $order): bool
    {
        return $customer->isSeller();
    }

    public function restoreAny($customer): bool
    {
        return $customer->isSeller();
    }

    public function forceDelete($customer, Order $order): bool
    {
        return $customer->isSeller();
    }

    public function forceDeleteAny($customer): bool
    {
        return $customer->isSeller();
    }
}
