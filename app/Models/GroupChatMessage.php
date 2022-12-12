<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupChatMessage extends Model
{
    use HasFactory;

    protected $table = 'group_chat_messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'group_id',
        'sender_id',
        'message_titles',
        'messages',
        'is_read',
        'send_at'];
    
    protected $casts = [
        'is_read' => 'boolean',
        'send_at' => 'datetime',
        'sender_id' => 'integer',
        'group_id' => 'integer',
        'message_titles' => 'string',
        'messages' =>'string',
    ];

    protected $guarded = [];

    //messages belongs to the group

    public function group()
    {
        return $this->belongsTo(Group::class,'group_id','id');
    }
}
