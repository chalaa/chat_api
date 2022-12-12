<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;

    protected $table = 'group_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'group_id',
        'user_id',
        'is_admin'
    ];

    protected $guarded = [];

    // user has many groups
    public function group()
    {
        return $this->hasMany(Group::class,'group_id','id');
    }

    //groups has many users
    public function user()
    {
        return $this->hasMany(User::class,'user_id','id');
    }
}
