<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelUser extends Model
{
    use HasFactory;
    protected $table = 'channel_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'channel_id',
        'user_id',
        'is_admin'
    ];

    protected $guarder = [];

    // public function channel()
    // {
    //     return $this->hasMany(Channel::class,'channel_id','id');
    // }

    // public function user()
    // {
    //     return $this->hasMany(User::class,'user_id','id');
    // }
}
