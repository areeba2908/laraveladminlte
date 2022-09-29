<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarehouseCategory extends Model
{
    protected $table = 'warehousecategories';

    protected $fillable = [
        'name','status','slug'
    ];
}
