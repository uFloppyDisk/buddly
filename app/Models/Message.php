<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = "message";
    public $timestamps = true;

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

    public function scopeConversationID($query, $conv_id) {
        $query->where("conversation_id", $conv_id)->orderBy('created_at');
    }

    // public function getCreatedAtAttribute($date) {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->timestamp;
    // }

    // public function getUpdatedAtAttribute($date) {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->timestamp;
    // }
}
