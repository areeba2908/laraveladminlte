<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCustomerMapping extends Model
{
    protected $table = 'stores_customers';

    protected $fillable = [
        'name','slug','status'
    ];
}
