<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'role_has_stores_access');
    }
}
