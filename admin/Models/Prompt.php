<?php

namespace Admin\Models;

require "./admin/Bootstrap.php";

use Illuminate\Database\Eloquent\Model;

class Prompt extends Model


{
    public $timestamps = false;

    protected $table = 'prompts';
    protected $fillable = ['title', 'description', 'tags', 'user_id', 'category_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
}
