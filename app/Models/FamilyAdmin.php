<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_name',
        'user_id',
    ];
}
