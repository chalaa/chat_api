<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Channel extends Model
{
    use HasFactory;

    protected $table = 'channels';

    protected $primaryKey = 'id';

    protected $fillable =[
        'user_id',
        'channel_name',
        'channel_link',
        'channel_description',
        'channel_icon',
        'channel_profile',
        'is_private'
    ];

    protected $guarded =[];

    //channel belongsTo user as admin
    public function user()
    {
        return $this->belongsToMany(User::class,'user_id','id');
    }

    //channel belongs to many users
    public function channel_users()
    {
        return $this->belongsToMany(ChannelUser::class, 'channel_id','id');
    }

    // channel has many chat_messages
    public function channel_chat_messages(){
        return $this->hasMany(ChannelChatMessage::class, 'channel_id','id');
    }
}
