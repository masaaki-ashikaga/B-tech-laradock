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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reviewCreate($request)
    {
        $review = new Review;
        $new_review = $request->only(['review_title', 'review', 'evaluation', 'review_imgpath', 'stock_id', 'user_id']);
        $review->fill($new_review)->save();
        return $review;
    }

    public function reviewUpdate($id, $request)
    {
        $review = Review::find($id);
        $update_review = $request->only(['review_title', 'review', 'evaluation', 'review_imgpath']);
        $review->fill($update_review)->save();
        return;
    }
}
