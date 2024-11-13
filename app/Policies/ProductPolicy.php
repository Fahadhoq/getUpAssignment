<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;

class ProductPolicy
{
    // Check if the user can view the product
    public function view(User $user)
    {
        // Both Admin and Editor can view products
        return $user->hasRole('Admin') || $user->hasRole('Editor');
    }

    public function create(User $user)
    {
        if (!$user->hasRole('Admin')) {
            throw new AuthorizationException('You do not have permission to create products.');
        }
    
        return true; // This is implicit if no exception is thrown
    }

    // Check if the user can update the product
    public function update(User $user, Product $product)
    {
        // Admin can update all products, Editor can only update specific sections
        return $user->hasRole('Admin') || $user->hasRole('Editor');
    }

    // Check if the user can delete the product
    public function delete(User $user)
    {
        // Only Admin can delete a product
        return $user->hasRole('Admin') ? true : throw new AuthorizationException('You do not have permission to delete products.');
    }

}


