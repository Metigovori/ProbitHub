<?php

namespace Admin\Models;

require "./admin/Bootstrap.php";

use Illuminate\Database\Eloquent\Model;

class Comments extends Model

{

    public $timestamps = false;

    protected $table = 'comments'; // Table name

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
