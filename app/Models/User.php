<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //user has many channel
    public function channel(){
        return $this->belongsToMany(Channel::class,'channel_users','user_id','id');
    }

    //user has many groups
    public function groups(){
        return $this->belongsToMany(Group::class,'group_users','user_id','id');
    }

    // // user uses many channels
    // public function channel_users(){
    //     return $this->belongsToMany(ChannelUser::class,'user_id','id');
    // }

    // //user uses many groups
    // public function group_users(){
    //     return $this->belongsToMany(GroupUser::class,'user_id','id');
    // }

    //user has many user profile pictures
    public function user_profile_pictures()
    {
        return $this->hasMany(UserProfilePicture::class,'user_id','id');
    } 
    
    public function chat_user_1(){
        return $this->hasMany(Chat::class,'user_1','id');
    }

    public function chat_user_2(){
        return $this->hasMany(Chat::class,'user_2','id');
    }

    public function chat_message_sender(){
        return $this->hasOne(ChatMessage::class,'sender_id','id');
    }

    public function chat_message_receiver(){
        return $this->hasOne(ChatMessage::class,'receiver_id','id');
    }
}
