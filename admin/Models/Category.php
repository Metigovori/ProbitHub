<?php

namespace Admin\Models;

require "./admin/Bootstrap.php";

use Illuminate\Database\Eloquent\Model;

class Category extends Model

{
    protected $table = 'categories'; // Table name

    public function prompts()
    {
        return $this->hasMany(Prompt::class, 'category_id');
    }
}
