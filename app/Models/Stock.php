<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [
        'id'
    ];

    public function create($request)
    {
        $stock = new Stock;
        $new_stock = $request->only(['name', 'detail', 'fee', 'imgpath']);
        $stock->fill($new_stock)->save();
        return $stock;
    }
}
