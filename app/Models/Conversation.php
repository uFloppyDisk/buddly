<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = "conversation";
    public $timestamps = false;

    protected $fillable = [
        'initiator_id',
        'participant_id',
    ];

    public function initiator() {
        return $this->belongsTo(Account::class, 'initiator_id', 'id');
    }

    public function participant() {
        return $this->belongsTo(Account::class, 'participant_id', 'id');
    }

    public function messages() {
        return $this->hasMany(Message::class, 'conversation_id', 'id')->orderBy('created_at', 'desc');
    }

    public function messages_asc() {
        return $this->hasMany(Message::class, 'conversation_id', 'id')->orderBy('created_at', 'asc');
    }

    public function scopeId($query, $id) {
        $query->where('initiator_id', $id)->orWhere('participant_id', $id);
    }
}
