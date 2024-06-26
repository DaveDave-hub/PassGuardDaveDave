<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory;
    protected $table = 'passes';
    protected $fillable = [
        'user_id',
        'platform',
        'email_username',
        'password',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
