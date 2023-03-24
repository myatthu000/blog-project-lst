<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

//    protected $guarded = ['multiple_photos'];
    protected $fillable = ['title','description','feature_image','slug','excerpt','user_id','category_id'];

//    protected $with = ['category','user'];

    public function scopeSearch($q)
    {
        return $q->when(\request('keyword'),function ($q){
            $keyword = \request('keyword');
            $q->orWhere("title","like","%$keyword%")
                ->orWhere("description","like","%$keyword%");
        });
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
