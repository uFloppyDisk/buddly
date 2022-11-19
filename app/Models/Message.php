<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = "message";
    protected $timestamps = true;

    protected $fillable = [
        'conversation_id',
        'author_id',
        'message',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public function conversation() {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }

    public function author() {
        return $this->belongsTo(Account::class, 'author_id', 'id');
    }
}
