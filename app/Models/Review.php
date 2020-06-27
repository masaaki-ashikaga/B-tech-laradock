<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [
        'id'
    ];

    public function stock()
    {
        return $this->belongsTo('App\Models\Stock');
    }

    public function reviewCreate($request)
    {
        $review = new Review;
        $new_review = $request->only(['review_title', 'review', 'evaluation', 'review_imgpath', 'stock_id', 'user_id']);
        $review->fill($new_review)->save();
        return $review;
    }
}
