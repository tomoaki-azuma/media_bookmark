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
        return $query->whereHas('user', function($q) use ($str) {
           $q->where('name', 'like' , '%'.$str.'%');
        });
    }

    public function scopeKeywordLike($query, $str) {
        $word_list = preg_split('/\s/', $str);
        foreach ($word_list as $word) {
            $query->where(function($query) use ($word) {
                $query->where('title', 'like', '%'.$word.'%')
                ->orWhere('comment', 'like', '%'.$word.'%');
            });
        }
        return $query;
    }

    public function scopeShareTokenEqual($query, $str) {
        return $query->where('share_token', 'like', '%'.$str.'%');
    }

}
