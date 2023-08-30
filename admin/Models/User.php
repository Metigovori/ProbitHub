<?php

namespace Admin\Models;

require "./admin/Bootstrap.php";

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $primaryKey = 'id'; // or whatever the primary key column is named in the users table


    protected $table_rows = [
        'id',
        'username', 'email', 'password', 'role', 'registration_date', 'photo'
    ];

    public function verifyUser($username, $password)
    {
        return $this->where('username', $username)
            ->where('password', $password)
            ->first();
    }
}
