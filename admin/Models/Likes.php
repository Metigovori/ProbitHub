<?php

namespace Admin\Models;

require "./admin/Bootstrap.php";

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table_rows = [
        'like_id', 'content_type', 'user_id', 'prompt_id'
    ];

    public $timestamps = false;
    protected $table = 'likes';

    public function prompt()
    {
        return $this->belongsTo(Prompt::class, 'prompt_id');
    }
}
