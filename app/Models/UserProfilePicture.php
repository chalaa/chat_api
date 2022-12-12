<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfilePicture extends Model
{
    use HasFactory;

    protected $table = 'user_profile_pictures';

    protected $primaryKey = 'id';


    protected $fillable = [
        'user_id',
         'url'
        ];
    protected $guarded = [];


    // profile_image belongsTo  user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
