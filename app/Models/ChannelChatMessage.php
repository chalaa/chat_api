<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelChatMessage extends Model
{
    use HasFactory;

    protected $table = 'channel_chat_messages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'channel_id',
        'message_title',
        'message',
        'is_read',
        'send_at'];

    protected $guarded = [];

    // message belongsTo this channel
    public function channel()
    {
        return $this->belongsTo(Channel::class,'channel_id','id');
    }
}
