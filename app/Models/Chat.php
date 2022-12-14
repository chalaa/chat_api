<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_1',
        'user_2'
    ];

    protected $casts = [
        'user_1' => 'integer',
        'user_2' => 'integer'
    ];

    protected $guarded = [];

    // chat has many chat_messages
    public function chat_messages()
        {
            return $this->hasMany(ChatMessage::class, 'chat_id','id');
        }

    public function user_1(){
        return $this->belongsTo(User::class,'user_1','id');
    }
    public function user_2(){
        return $this->belongsTo(User::class,'user_2','id');
    }
}
