<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeNameEqual($query, $str) {
        return $query->orWhereHas('user', function($q) use ($str) {
           $q->where('name', 'like' , '%'.$str.'%');
        });
    }

    public function scopeKeywordLike($query, $str) {
        $query->orwhere('title', 'like', '%'.$str.'%')
        ->orWhere('comment', 'like', '%'.$str.'%');
        return $query;
    }

    public function scopeShareTokenEqual($query, $str) {
        return $query->orWhere('share_token', 'like', '%'.$str.'%');
    }

}
