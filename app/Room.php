<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    /**
     * @return HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(Department::class);
    }
}
