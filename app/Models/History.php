<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class History extends Model
{
    protected $fillable = [
        'stock_id',
        'user_id'
    ];

    public function addHistory($mycart_items)
    {
        foreach($mycart_items as $mycart_item){
            $data = [
                'user_id' => $mycart_item['user_id'],
                'stock_id' => $mycart_item['stock_id'],
                'created_at' => date('Y/m/d H:i:s')
            ];
            History::insert($data);
        }
        return $data;
    }

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }
}
