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

    public function showHistory()
    {
        $user_id = Auth::id();
        $data['my_history'] = $this->where('user_id', $user_id)->get();
        foreach($data['my_history'] as $my_history)
        {
            $data['stock'] = $my_history->stock;
        }
        return $data;
    }
}
