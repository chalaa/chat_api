<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $primaryKey = 'id';

    protected $fillable = [
        'group_name',
        'group_link',
        'profile_image',
        'super_user_id'
    ];

    // group belongs to many users 
    public function group_users(){
        return $this->belongsToMany(GroupUser::class, 'group_id','id');
    }

    //group has many chat_messages
    public function group_chat_messages(){
        return $this->hasMany(GroupChatMessage::class, 'group_id','id');
    }

    // group belongs to many users

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_id','id');
    }
}
