<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestCategory extends Model
{
    use HasFactory;

    protected $table = "interest_category";
    public $timestamps = false;

    public function interests() {
        return $this->belongsToMany(Interest::class, 'interest_category_assoc', 'category_id', 'interest_id');
    }
}
