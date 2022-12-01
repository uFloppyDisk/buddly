<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = "profile";

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_renter' => false,
    ]; 


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
