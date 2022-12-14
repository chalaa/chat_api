<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'chat_id',
        'sender_id',
        'receiver_id',
        'chat_messages',
        'is_read'
    ];

    protected $guarded = [];


    protected $casts = [
        'is_read' => 'boolean',
        'sender_id' => 'integer',
        'receiver_id' => 'integer',
        'chat_id' => 'integer',
        'chat_messages' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'send_at' => 'datetime',
    ];

    // this message belongs to a specific chat
    public function chat()
    {
        return $this->belongsTo(Chat::class,'chat_id','id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }
}
