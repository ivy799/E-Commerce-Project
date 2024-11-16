<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id;
    }

    // ...other policy methods if needed...
}