<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Auth\Access\Response;

class VenuePolicy
{
    public function view(User $user, Venue $venue)
    {
        return $user->venues()->where('venues.id', $venue->id)->exists();
    }

    public function viewBlocks(User $user, Venue $venue)
    {
        return $user->venues()->where('venues.id', $venue->id)->exists();
    }
}
