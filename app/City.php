<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    /**
     * @return BelongsTo
     *
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
