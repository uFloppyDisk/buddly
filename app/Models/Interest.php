<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $table = "interest";
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'description_long',
    ];
}
