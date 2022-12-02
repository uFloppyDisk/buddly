<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class Account extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasUuids;

    protected $table = "account";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'name_first',
        'name_last',
        'name_middle',
    ];

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => 0,
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

    public function profile() {
        return $this->hasOne(Profile::class, 'account_id');
    }

    public function interests() {
        return $this->belongsToMany(Interest::class, 'user_interest_assoc', 'user_id', 'interest_id');
    }

    public function interest_categories() {
        // TODO: Implement interest category relation
        return null;
    }

    public function conv_initiator() {
        return $this->hasMany(Conversation::class, 'initiator_id');
    }

    public function conv_participant() {
        return $this->hasMany(Conversation::class, 'participant_id');
    }

    public function conversations() {
        return $this->conv_initiator->merge($this->conv_participant);
    }

    public function getNameFullAttribute() {
        return "{$this->name_first} {$this->name_middle} {$this->name_last}";
    }
}
